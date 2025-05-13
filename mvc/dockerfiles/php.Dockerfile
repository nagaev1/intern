FROM php:8-cli

WORKDIR /app

RUN apt-get update && apt-get install -y curl git zip

RUN docker-php-ext-install pdo mysqli pdo_mysql