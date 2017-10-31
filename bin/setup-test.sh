#!/usr/bin/env bash

cp phpunit.xml.dist phpunit.xml

bin/console doctrine:schema:drop --force -e test
bin/console doctrine:schema:update --force -e test
#bin/console doctrine:fixtures:load -n -e test
bin/console sonata:media:fix-media-context -e test