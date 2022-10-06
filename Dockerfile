FROM php:8.1.5-fpm-alpine3.15

RUN apk update \
    && apk --no-cache add $PHPIZE_DEPS openssl-dev nginx bash git nano icu-dev libzip-dev apk-cron libxml2-dev oniguruma-dev libpng-dev libxslt-dev \
    &&  curl -sS https://getcomposer.org/installer | php -- \
    &&  mv composer.phar /usr/local/bin/composer \
    &&  curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash \
    &&  apk add symfony-cli
RUN docker-php-ext-configure intl
RUN docker-php-ext-install pdo pdo_mysql opcache intl zip calendar dom mbstring gd xsl
RUN pecl install apcu && docker-php-ext-enable apcu

WORKDIR /var/www

CMD nginx && php-fpm