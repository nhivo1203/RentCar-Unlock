FROM php:8.1-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN docker-php-ext-install pdo pdo_mysql

# INSTALL AND UPDATE COMPOSER
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN composer self-update

WORKDIR /var/www/html

COPY ./ ./

COPY *.json .
COPY *.php .

# INSTALL YOUR DEPENDENCIES
RUN composer install

# PROVIDE PERMISSIONS TO THE FOLDER
RUN chmod -R 777 /var/www/html/public/img