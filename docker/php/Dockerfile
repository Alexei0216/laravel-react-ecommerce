FROM php:8.4-fpm

# системные зависимости
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    libonig-dev \
    && rm -rf /var/lib/apt/lists/*

# GD конфигурация
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

# PHP расширения
RUN docker-php-ext-install \
    pdo_mysql \
    bcmath \
    zip \
    exif \
    intl \
    gd \
    mbstring

# Redis extension
RUN pecl install redis \
    && docker-php-ext-enable redis

RUN docker-php-ext-install opcache

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD ["php-fpm"]