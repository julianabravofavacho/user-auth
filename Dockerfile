FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \                      
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd \
    && a2enmod rewrite
