FROM php:fpm-alpine

RUN apk update \
    && apk upgrade \
    && apk add --no-cache $PHP_PACKAGES git \
    && rm -rf /tmp/* /var/cache/apk/* /var/www/html


RUN docker-php-ext-install pdo_mysql

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /tmp

RUN curl -sS https://getcomposer.org/installer | php \
         && mv composer.phar /usr/local/bin/composer


# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"


WORKDIR /var/www/hobby-box.nl