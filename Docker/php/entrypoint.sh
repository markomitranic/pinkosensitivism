#!/bin/bash
set -e

php bin/console doctrine:migrations:migrate

php-fpm -F -R
