FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    curl \
    && curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean

WORKDIR /src/zubolaapp

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get -y install git unzip libzip-dev default-mysql-client && \
    docker-php-ext-install zip pdo pdo_mysql

COPY ./src /src

RUN mkdir -p /src/storage /src/bootstrap/cache && \
    chown -R www-data:www-data /src && \
    chmod -R 755 /src/storage /src/bootstrap/cache

CMD ["php-fpm"]