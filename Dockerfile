#
# Docker build for the Laravel app (PHP + Apache) with Vite assets built via Node.
#

FROM node:20-alpine AS node-build
WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build

FROM composer:2 AS composer-base

FROM php:8.2-apache AS app

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    libjpeg-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libwebp-dev \
    libfreetype6-dev \
    zip \
    unzip \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl gd zip

COPY --from=composer-base /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

COPY . .
COPY --from=node-build /app/public/build ./public/build

# Ensure required writable dirs exist.
RUN mkdir -p storage bootstrap/cache \
  && chown -R www-data:www-data storage bootstrap/cache

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["apache2-foreground"]

