FROM php:7.3-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
        libicu-dev \
        libxml2-dev \
        libzip-dev \
        libmagickwand-dev
    && docker-php-ext-configure intl \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo \
    && docker-php-ext-install pdo_mysql
    && pecl install imagick
    && docker-php-ext-enable imagick
