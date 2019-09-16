#!/bin/bash
set -e

php bin/console doctrine:migrations:migrate

echo 'APP_ENV='$APP_ENV >> /etc/environment
echo 'APP_DEBUG='$APP_DEBUG >> /etc/environment
echo 'DATABASE_URL='$DATABASE_URL >> /etc/environment
echo 'INSTAGRAM_CLIENT_ID='$INSTAGRAM_CLIENT_ID >> /etc/environment
echo 'INSTAGRAM_CLIENT_SECRET='$INSTAGRAM_CLIENT_SECRET >> /etc/environment
echo 'INSTAGRAM_REDIRECT_URI='$INSTAGRAM_REDIRECT_URI >> /etc/environment
echo 'SILLY_PASSWORD_PROTECC='$SILLY_PASSWORD_PROTECC >> /etc/environment
crontab /etc/cron.d/ingest-cron
cron

php-fpm -F -R
