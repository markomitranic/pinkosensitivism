#!/bin/bash
set -e

# Start composer
cd /usr/share/nginx/rush-b/
COMPOSER_ALLOW_SUPERUSER=1 composer install

# Install a new cron
crontab -l > mycron
echo "0,15,30,45 * * * * php /usr/share/nginx/pinko/bin/console app:instagram:sync" >> mycron
crontab mycron
rm mycron

# Tail is used to keep the container running in development environment.
tail -f /dev/null
