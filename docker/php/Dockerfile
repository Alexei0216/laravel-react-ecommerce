FROM php:8.4-fpm

ARG UID=1000
ARG GID=1000

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

RUN groupmod -g ${GID} www-data \
    && usermod -u ${UID} -g ${GID} www-data

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN chown -R www-data:www-data /var/www

USER www-data

CMD ["php-fpm"]