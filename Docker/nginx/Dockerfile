FROM nginx:latest

COPY ./Docker/nginx/ssl /etc/nginx/ssl

RUN rm /etc/nginx/conf.d/*
COPY ./Docker/nginx/conf/gzip.conf /etc/nginx/conf.d/gzip.conf
COPY ./Docker/nginx/conf/nginx.conf /etc/nginx/conf.d/nginx.conf
COPY ./Docker/nginx/conf/tls.conf /etc/nginx/conf.d/tls.conf
COPY ./Docker/nginx/conf/pinko.conf /etc/nginx/conf.d/pinko.conf

COPY ./src /app/src
