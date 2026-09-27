# =========================
# Production dependencies
# =========================

FROM composer:2 AS vendor-prod

WORKDIR /app

RUN echo "default_socket_timeout=6000" \
    > /usr/local/etc/php/conf.d/socket-timeout.ini

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --ignore-platform-reqs

COPY . .

RUN mkdir -p \
    bootstrap/cache \
    storage/framework/cache \
    storage/framework/data \
    storage/framework/sessions \
    storage/framework/testing \
    storage/framework/views \
    storage/logs

RUN composer dump-autoload --optimize --no-dev


# =========================
# Development dependencies
# =========================

FROM composer:2 AS vendor-dev

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install --no-scripts --ignore-platform-reqs

COPY . .

RUN mkdir -p \
    bootstrap/cache \
    storage/framework/cache \
    storage/framework/data \
    storage/framework/sessions \
    storage/framework/testing \
    storage/framework/views \
    storage/logs

RUN composer dump-autoload


# =========================
# Frontend
# =========================

FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json* ./

RUN npm ci

COPY . .

RUN npm run build


# =========================
# Production PHP
# =========================

FROM php:8.4-fpm-alpine AS app

RUN apk add --no-cache \
        libpng-dev libjpeg-turbo-dev freetype-dev \
        libzip-dev icu-dev oniguruma-dev \
        libxml2-dev sqlite-dev bash \
        $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_sqlite \
        gd \
        zip \
        intl \
        bcmath \
        pcntl \
        mbstring \
        opcache \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del $PHPIZE_DEPS

WORKDIR /var/www/html

COPY . .

COPY --from=vendor-prod /app/vendor ./vendor

COPY --from=frontend /app/public/build ./public/build

RUN mkdir -p \
        /var/www/html/storage/framework/cache \
        /var/www/html/storage/framework/data \
        /var/www/html/storage/framework/sessions \
        /var/www/html/storage/framework/testing \
        /var/www/html/storage/framework/views \
        /var/www/html/storage/logs \
    && chown -R www-data:www-data \
        /var/www/html/storage \
        /var/www/html/bootstrap/cache \
        /var/www/html/database \
    && chmod -R 775 \
        /var/www/html/storage \
        /var/www/html/bootstrap/cache \
        /var/www/html/database

USER www-data

EXPOSE 9000

CMD ["php-fpm"]


# =========================
# Development PHP
# =========================

FROM php:8.4-fpm-alpine AS app-dev

RUN apk add --no-cache \
        libpng-dev libjpeg-turbo-dev freetype-dev \
        libzip-dev icu-dev oniguruma-dev \
        libxml2-dev sqlite-dev bash \
        $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_sqlite \
        gd \
        zip \
        intl \
        bcmath \
        pcntl \
        mbstring \
        opcache \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del $PHPIZE_DEPS

WORKDIR /var/www/html

COPY . .

COPY --from=vendor-dev /app/vendor ./vendor

RUN mkdir -p \
        /var/www/html/storage/framework/cache \
        /var/www/html/storage/framework/data \
        /var/www/html/storage/framework/sessions \
        /var/www/html/storage/framework/testing \
        /var/www/html/storage/framework/views \
        /var/www/html/storage/logs \
    && chown -R www-data:www-data \
        /var/www/html/storage \
        /var/www/html/bootstrap/cache \
        /var/www/html/database \
    && chmod -R 775 \
        /var/www/html/storage \
        /var/www/html/bootstrap/cache \
        /var/www/html/database

USER www-data

EXPOSE 9000

CMD ["php-fpm"]