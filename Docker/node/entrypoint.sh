#!/bin/sh

set -e

yarn install
yarn build production
