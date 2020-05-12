FROM php:7.4.1-fpm

COPY composer.phar /usr/local/bin/composer

RUN apt-get update
RUN apt-get install -y wget git unzip libpq-dev
RUN : 'Install Node.js'
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -y nodejs
RUN : 'Install PHP Extensions'
RUN docker-php-ext-install -j$(nproc) pdo_pgsql

WORKDIR /var/www/html/frema
