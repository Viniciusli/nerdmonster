FROM php:8.1-apache

USER root

WORKDIR /app

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

#instal o composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
 docker-php-ext-install pdo_mysql
