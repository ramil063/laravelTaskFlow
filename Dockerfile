FROM php:8.3-fpm-alpine

# Устанавливаем PostgreSQL драйвер и базовые расширения
RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-install pdo_pgsql

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html