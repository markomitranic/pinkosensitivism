#!/usr/bin/env bash

set -e

operation()
{
    printf '%*s\n' "${COLUMNS:-$(tput cols)}" | tr ' ' W
    echo '🤖 [Operation]' $1
}

operation "Re-Create the .env file."
rm -rf ./.env
cp ./.env.dist ./.env

operation "Build Docker container images"
docker-compose build

operation "Ready to take on the world! Try to run: docker-compose up"
