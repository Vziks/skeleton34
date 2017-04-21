#!/usr/bin/env bash

composer install --no-interaction --optimize-autoloader --prefer-dist

bin/console doctrine:database:create --if-not-exists
bin/console doctrine:schema:drop --force
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load -n
bin/console assets:install
bin/console sonata:media:fix-media-context
