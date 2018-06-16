#!/usr/bin/env bash

if [ ! -f app/phpunit.xml ]; then
    cp app/phpunit.xml.dist app/phpunit.xml
fi

rm -f app/logs/**/*.log app/logs/*.log


php app/console doctrine:schema:drop --force -e test
php app/console doctrine:migrations:migrate --no-interaction -e test
#php app/console doctrine:fixtures:load -n -e test
php app/console sonata:media:fix-media-context -e test
php app/console assets:install --symlink web -e test