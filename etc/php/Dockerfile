FROM php:8.2-alpine

WORKDIR /var/www

RUN apk update && apk --no-cache add bash git
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash
RUN apk add symfony-cli
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.3.1
RUN apk add libpq-dev && docker-php-ext-install pdo pdo_pgsql pgsql

CMD symfony server:start && symfony server:start