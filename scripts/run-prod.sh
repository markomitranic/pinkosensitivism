#!/bin/bash

docker-compose down --remove-orphans || true
docker-compose build
docker-compose up