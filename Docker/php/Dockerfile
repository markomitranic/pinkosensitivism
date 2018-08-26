FROM php:7.2.8-fpm AS base

RUN apt-get update
RUN apt-get install wget -y
RUN docker-php-ext-install pdo_mysql

WORKDIR /usr/share/nginx/pinko

FROM base AS prod
COPY conf/php-fpm.conf /usr/local/etc/php-fpm.d/zzz-pinko-fpm.conf
COPY conf/php.ini /usr/local/etc/php/conf.d/pinko-php.ini
