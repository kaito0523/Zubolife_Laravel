FROM php:8.3-fpm
WORKDIR /src
COPY ./zubolaapp /src

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --working-dir=/src

RUN chown -R www-data:www-data /src/storage /src/bootstrap/cache
