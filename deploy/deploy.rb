# config valid only for current version of Capistrano
lock '3.7.2'

set :application, 'skeleton'
set :scm, :git
set :repo_url, 'git@bitbucket.org:prodhub/skeleton.git'
set :symfony_directory_structure, 2
set :composer_install_flags, '--no-interaction --optimize-autoloader --prefer-dist'
set :format_options, log_file: "var/logs/capistrano.log"

set :frontend_dist_path, "web/bundles/frontend"
set :frontend_archive_name, "build.tar"
set :frontend_archive_path, "#{fetch(:frontend_dist_path)}/#{fetch(:frontend_archive_name)}"

set :keep_releases, 3

# The next 3 settings are lazily evaluated from the above values, so take care
# when modifying them
set :app_config_path, "app/config"

# Dirs that need to remain the same between deploys (shared dirs)
set :linked_dirs, fetch(:linked_dirs, []).push('web/uploads')

# Files that need to remain the same between deploys
set :linked_files, fetch(:linked_files, []).push('app/config/parameters.yml', 'web/robots.txt')

set :symfony_console_path, "bin/console"

set :file_permissions_paths, ["var/logs", "var/cache"]
set :file_permissions_users, ["www-data"]
set :permission_method, 'chmod'


# Apply migrations
after 'deploy:updated', 'deploy:migrate'

# Fix Sonata Media contexts
after 'deploy:updated', 'deploy:fix_media'

# Build html
after 'deploy:updated', 'deploy:dump_api_doc'

# Install assets
after 'deploy:updated', 'symfony:assets:install'

# Dump exposed js routes
after 'deploy:updated', 'deploy:dump_js_routes'

# Build and upload frontend
after 'deploy:updated', 'deploy:upload_frontend'

# Set new version to all assets
after 'deploy:updated', 'deploy:set_assets_version'

namespace :deploy do
    desc "Dump exposed js routes"
    task :dump_js_routes do
        on roles(:all) do
            symfony_console "fos:js-routing:dump"
        end
    end

    desc "Dump api documentation"
    task :dump_api_doc do
        on roles(:all) do
            execute "mkdir -p #{release_path}/web/doc/"
            symfony_console "api:doc:dump", "--format=html --no-sandbox > #{release_path}/web/doc/api.html"
        end
    end

    task :migrate do
        on roles(:db) do
            symfony_console "doctrine:migrations:migrate", "--no-interaction"
        end
    end

    task :fix_media do
        on roles(:db) do
            symfony_console "sonata:media:fix-media-context"
        end
    end

    task :build_frontend do
        run_locally do
            execute "npm i -g gulp"
            #execute "npm i -g bower"
            execute "npm i"
            #execute "bower i"
            execute "npm run dist"
        end
    end

    task :upload_frontend do
        invoke 'deploy:build_frontend'
        on roles(:all) do
            run_locally do
                execute "tar -cvf #{fetch(:frontend_archive_path)} #{fetch(:frontend_dist_path)}"
            end

            # Upload 1 archive file faster then upload multiple small files
            upload! "#{fetch(:frontend_archive_path)}", "#{release_path}"
            execute "tar -xvf #{release_path}/#{fetch(:frontend_archive_name)} -C #{release_path} && rm -f #{release_path}/#{fetch(:frontend_archive_name)}"

            run_locally do
                execute "rm -f #{fetch(:frontend_archive_path)}"
            end
        end
    end

    task :set_assets_version do
        on roles(:all) do
            symfony_console "assets-version:increment"
            symfony_console "cache:clear"
        end
    end
end