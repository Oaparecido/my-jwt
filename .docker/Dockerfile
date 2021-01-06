FROM php:8.0.0-fpm-alpine

RUN apk update \
    && docker-php-ext-install pdo \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin/ --filename=composer --no-ansi

ENV PATH="/var/www/html/vendor/bin:${PATH}"
