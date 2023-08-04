FROM php:5.6-alpine

RUN apk update

RUN apk add --no-cache \
    git \
    nano \
    libpng-dev \
    libmcrypt-dev \
    libpq-dev \
    zip \
    unzip

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer \

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install

RUN composer update
