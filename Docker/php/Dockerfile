FROM php:7.2.8-fpm AS base

RUN apt-get update
RUN apt-get install wget -y
RUN docker-php-ext-install pdo_mysql

WORKDIR /usr/share/nginx/pinko

FROM base AS prod
COPY conf/php-fpm.conf /usr/local/etc/php-fpm.d/zzz-pinko-fpm.conf
COPY conf/php.ini /usr/local/etc/php/conf.d/pinko-php.ini

FROM base AS dev

ENV PHP_IDE_CONFIG serverName=pinkosensitivism.local
RUN yes | pecl install xdebug
RUN echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.idekey=PINKO-DEBUG" >> /usr/local/etc/php/conf.d/xdebug.ini
