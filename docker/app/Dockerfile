FROM php:7.4-fpm

RUN docker-php-ext-install -j$(nproc) pdo pdo_mysql

WORKDIR /app
