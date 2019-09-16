#!/bin/bash
set -e

COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader
php bin/console doctrine:migrations:migrate

php-fpm -F -R
