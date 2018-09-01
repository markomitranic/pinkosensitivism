FROM php:7.2.8-fpm AS base

RUN apt-get update
RUN apt-get install wget -y
RUN apt-get install cron -y
RUN docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN apt-get install git -y
RUN apt-get install zip unzip zlib1g-dev -y
RUN docker-php-ext-install zip

WORKDIR /usr/share/nginx/

FROM base AS prod
COPY entrypoint.sh /usr/share/nginx/entrypoint.sh
RUN ["chmod", "+x", "/usr/share/nginx/entrypoint.sh"]