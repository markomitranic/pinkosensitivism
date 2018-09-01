#!/bin/bash
set -e

# Start composer
cd /usr/share/nginx/pinko/
COMPOSER_ALLOW_SUPERUSER=1 composer install

# Tail is used to keep the container running in development environment.
echo "[Operation] Composer deployment finished. The container will stay up in dev environment."
tail -f /dev/null
