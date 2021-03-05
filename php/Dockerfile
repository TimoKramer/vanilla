FROM php:7.4-apache

RUN set -xe; \
    apt-get update \
    && apt-get install -y \
        # for intl extension
        libicu-dev \
        # for gd
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        # for mbstring
        libonig-dev \
        # memchached extension
        libmemcached-dev \
        # allow mailing to work
        sendmail \
        # allow reading of image exif
        exiftool \
        # pecl installs
    && docker-php-ext-install exif \
    && pecl install memcached \
    && pecl install apcu \
    # enable pecl installed extentions
    && docker-php-ext-enable memcached \
    && docker-php-ext-enable apcu \
    && docker-php-ext-enable exif \
    && docker-php-ext-enable opcache \
    # built in extensions install
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        mbstring \
        pdo \
        pdo_mysql \
        intl \
    # syslogd
    && apt-get install -y rsyslog \
    # cleanup
    && pecl clear-cache \
    && rm -rf \
    /var/lib/apt/lists/* \
    /usr/src/php/ext/* \
    /tmp/*

COPY ./php.ini /usr/local/etc/php/php.ini
