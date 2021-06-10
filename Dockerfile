FROM php:8.0-fpm-alpine

# persistent / runtime deps
RUN apk add --no-cache \
    acl \
    file \
    gettext \
    git \
    openssl \
    $PHPIZE_DEPS \
    zlib-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    ;

RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql
RUN docker-php-ext-install exif && docker-php-ext-enable exif
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
RUN pecl install redis \
    && pecl install xdebug-3.0.4 \
    && docker-php-ext-enable redis
RUN docker-php-ext-enable opcache

RUN apk add --no-cache nginx

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY docker/php.ini /usr/local/etc/php/php.ini

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /srv/laravel

COPY docker/nginx.conf /etc/nginx/conf.d/default.conf

COPY docker/start-container.sh /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

EXPOSE 80

ENTRYPOINT ["start-container"]
