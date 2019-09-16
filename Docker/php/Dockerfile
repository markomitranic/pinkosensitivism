FROM php:7.3-fpm AS build
RUN apt-get update
RUN apt-get install -y wget zip unzip libzip-dev
RUN docker-php-ext-install zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ADD ./src /app/src
WORKDIR /app/src
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader --no-scripts --no-plugins

FROM php:7.3-fpm AS prod
USER root
WORKDIR /app/src
RUN apt-get update
RUN docker-php-ext-install pdo_mysql
COPY ./Docker/php/conf/php-fpm.conf /usr/local/etc/php-fpm.d/zzz-app-fpm.conf
COPY ./Docker/php/conf/php.ini /usr/local/etc/php/conf.d/app-php.ini
ADD ./src /app/src
COPY --from=build /app/src/vendor/ /app/src/vendor/
RUN mkdir -p /app/src/var/cache
RUN apt-get -y install cron
COPY ./Docker/php/ingest-cron /etc/cron.d/ingest-cron
RUN chmod 0644 /etc/cron.d/ingest-cron
RUN touch /var/log/cron.log
COPY ./Docker/php/entrypoint.sh /app/entrypoint.sh
RUN ["chmod", "+x", "/app/entrypoint.sh"]

FROM prod AS dev
RUN apt-get install -y wget zip unzip libzip-dev git
RUN docker-php-ext-install zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY ./Docker/php/entrypoint-dev.sh /app/entrypoint.sh
RUN ["chmod", "+x", "/app/entrypoint.sh"]
ARG XDEBUG_ACTIVE
ENV XDEBUG_ACTIVE=${XDEBUG_ACTIVE}
RUN if [ "$XDEBUG_ACTIVE" -eq 1 ] ; then \
        yes | pecl install xdebug \
        && PHP_IDE_CONFIG="serverName=pinkosensitivism.com" \
        && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.idekey=KAPUTT-DEBUG" >> /usr/local/etc/php/conf.d/xdebug.ini \
    ; fi
