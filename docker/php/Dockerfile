# Stage 1
FROM composer:2 AS vendor
WORKDIR /app
RUN echo "default_socket_timeout=6000" > /usr/local/etc/php/conf.d/socket-timeout.ini
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --ignore-platform-reqs
COPY . .
RUN mkdir -p bootstrap/cache \
    storage/framework/cache \
    storage/framework/data \
    storage/framework/sessions \
    storage/framework/testing \
    storage/framework/views \
    storage/logs
RUN composer dump-autoload --optimize --no-dev

# Stage 2
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
    && apk del $PHPIZE_DEPS

WORKDIR /var/www/html

COPY --from=vendor /app/vendor ./vendor
COPY . .

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

USER www-data

EXPOSE 9000
CMD ["php-fpm"]
