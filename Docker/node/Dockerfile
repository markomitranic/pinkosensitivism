FROM node:10.16-jessie-slim AS prod
ENV NPM_CONFIG_LOGLEVEL info
USER root
RUN npm install -g yarn
COPY ./src /app/src
WORKDIR /app/src
RUN yarn install
COPY ./Docker/node/entrypoint.sh /app/entrypoint.sh
RUN ["chmod", "+x", "/app/entrypoint.sh"]

FROM prod AS dev
COPY ./Docker/node/entrypoint-dev.sh /app/entrypoint.sh
RUN ["chmod", "+x", "/app/entrypoint.sh"]
