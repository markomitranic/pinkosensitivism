FROM php:7.3-fpm AS base

RUN apt-get update
RUN apt-get install nano -y
RUN apt-get install wget -y
RUN docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN apt-get install git -y

RUN apt-get install -y libjpeg-dev \
    zlib1g-dev \
    libpng-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libxpm-dev \
    libfreetype6-dev \
    libzip-dev

RUN docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir \
    --with-png-dir --with-zlib-dir --with-xpm-dir --with-freetype-dir \
    --enable-gd-native-ttf
RUN docker-php-ext-install gd
RUN docker-php-ext-install zip

COPY conf/php-fpm.conf /usr/local/etc/php-fpm.d/zzz-pinko-fpm.conf
COPY conf/php.ini /usr/local/etc/php/conf.d/pinko-php.ini

WORKDIR /usr/share/nginx/

FROM base AS prod

COPY entrypoint_prod.sh /usr/share/nginx/entrypoint.sh
RUN ["chmod", "+x", "/usr/share/nginx/entrypoint.sh"]

FROM base AS dev

COPY entrypoint_dev.sh /usr/share/nginx/entrypoint.sh
RUN ["chmod", "+x", "/usr/share/nginx/entrypoint.sh"]

ENV PHP_IDE_CONFIG serverName=pinkosensitivism.com
RUN yes | pecl install xdebug-2.7.0beta1
RUN echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini
