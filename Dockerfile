FROM php:8.2.1-fpm

RUN apt-get update && apt-get install -y libonig-dev && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_mysql mbstring

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER www-data
WORKDIR /app
COPY --chown=www-data:www-data . /app
COPY --chown=www-data:www-data .env.docker /app/.env

RUN composer install