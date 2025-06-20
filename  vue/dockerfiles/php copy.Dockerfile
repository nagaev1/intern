FROM php:8.4-fpm-alpine

WORKDIR /var/www/laravel

RUN docker-php-ext-install pdo pdo_mysql

FROM composer:latest

RUN apt-get install -y nodejs

RUN npm run build

WORKDIR /var/www/laravel

COPY . .

RUN composer install

RUN composer run dev