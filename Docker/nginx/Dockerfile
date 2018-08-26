FROM nginx:latest AS base

RUN rm /etc/nginx/conf.d/*

FROM base AS prod
COPY conf /etc/nginx/conf.d
