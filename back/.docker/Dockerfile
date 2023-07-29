FROM php:8.1-apache

USER root

WORKDIR /app

RUN apt-get update && apt-get install -y \
        git \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

#instal o composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
 docker-php-ext-install pdo_mysql

COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

RUN chown -R www-data:www-data /app \
    && a2enmod rewrite
