#!/bin/sh
set -e

export $(egrep -v '^#' .env | xargs)

docker build \
    -t sanechek/php:"${PHP_VERSION}" \
    -t sanechek/php:latest \
    --build-arg PHP_BASE_IMAGE_VERSION="${PHP_VERSION}" \
    ./docker/php/
