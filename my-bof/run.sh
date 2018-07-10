#!/bin/bash
php app/console cache:clear
php app/console assets:install
php app/console assetic:dump
php app/console doctrine:database:create
php app/console doctrine:migrations:migrate
phpunit -c app/
php app/console server:run