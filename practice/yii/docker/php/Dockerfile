FROM php:8.0-fpm

## composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y \
    cron \
    rsyslog \
    nano

RUN apt-get update && apt-get install -y \
    wget \
    libxml2-dev \
    libmemcached-dev zlib1g-dev \
    git unzip libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
        && docker-php-ext-configure opcache --enable-opcache \
        && docker-php-ext-install sockets \
        && docker-php-ext-install opcache \
        && docker-php-ext-install soap \
        && docker-php-ext-install pdo pdo_pgsql \
        && docker-php-ext-install -j$(nproc) iconv \
        && docker-php-ext-install -j$(nproc) gd \
        && docker-php-ext-install zip \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && pecl install xdebug \
        && docker-php-ext-enable xdebug \
        && apt-get clean -y \
        && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/app