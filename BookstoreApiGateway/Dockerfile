FROM php:7.4-alpine3.15

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY . /src
WORKDIR /src

RUN docker-php-ext-install sockets

RUN composer update

WORKDIR /src/database

RUN touch database.sqlite

WORKDIR /src

RUN php artisan migrate && \
php artisan passport:install
