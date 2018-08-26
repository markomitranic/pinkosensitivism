#!/bin/sh

set -e

yarn install
yarn encore dev --watch
