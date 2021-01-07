FROM php:fpm-alpine

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir /app

WORKDIR /app

COPY . .

RUN php artisan config:cache && php artisan view:cache

ENTRYPOINT [ "php", "artisan", "serve" ]