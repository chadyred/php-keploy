FROM php:8.2-alpine

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev git

RUN docker-php-ext-install pdo pdo_pgsql pgsql
RUN apk add --no-cache bash && curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash && apk add symfony-cli

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

EXPOSE 8000