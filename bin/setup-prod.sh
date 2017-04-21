#!/usr/bin/env bash

bin/console doctrine:migrations:migrate -n -e prod
bin/console assets:install -e prod
bin/console sonata:media:fix-media-context -e prod
PASSWORD=`date +%s|sha256sum|base64|head -c 32`
bin/console adw:create:admin admin $PASSWORD
echo "Admin password: " $PASSWORD;