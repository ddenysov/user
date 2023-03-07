FROM php:8.2-alpine

WORKDIR /var/www

RUN apk update && apk --no-cache add bash git supervisor
RUN apk add libpq-dev && docker-php-ext-install pdo pdo_pgsql pgsql

COPY ./etc/supervisor/conf/messenger-worker.conf /etc/supervisor/conf.d/messenger-worker.conf

CMD supervisord -c /etc/supervisor/conf.d/messenger-worker.conf