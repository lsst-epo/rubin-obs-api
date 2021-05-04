FROM php:7.2-fpm-alpine3.11

LABEL maintainer="erosas@lsst.org"

USER root

RUN set -ex \
    && apk add --update --no-cache \
    freetype \
    libpng \
    libjpeg-turbo \
    freetype-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libxml2-dev \
    autoconf \
    g++ \
    imagemagick \
    imagemagick-dev \
    libtool \
    make \
    pcre-dev \
    postgresql-dev \
    postgresql \
    libintl \
    icu \
    icu-dev \
    bash \
    jq \
    git \
    findutils \
    gzip \
    vim \
    && docker-php-ext-configure gd \
    --with-freetype-dir=/usr/include/ \
    --with-png-dir=/usr/include/ \
    --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install bcmath mbstring iconv gd soap zip intl pdo_pgsql \
    && pecl install imagick redis \
    && docker-php-ext-enable imagick redis \
    && rm -rf /tmp/pear \
    && apk del freetype-dev libpng-dev libjpeg-turbo-dev autoconf g++ libtool make pcre-dev

RUN apk add gnu-libiconv --update-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/community/ --allow-untrusted
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

COPY ./config/php.ini /usr/local/etc/php/

# Comment the below lines out if you do not want to drop/create the DB upon docker run
COPY ./db/db.sql /var/www/db/
RUN chown -R www-data:www-data /var/www/db 

COPY scripts/ /scripts/
RUN chown -R www-data:www-data /scripts \
    && chmod -R +x /scripts

WORKDIR /var/www/html
RUN chown -R www-data:www-data .    

RUN chown -R www-data:www-data /var/www/html/
USER www-data

VOLUME [ "/var/www/html" ]

ENTRYPOINT [ "/scripts/run.sh" ]

CMD [ "docker-php-entrypoint", "php-fpm"]
