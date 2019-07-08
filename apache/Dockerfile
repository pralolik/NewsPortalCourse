# specify base image
FROM php:7.2-apache

ENV PHP_CONFIG_DIR /usr/local/etc/php

##########
#
# install lib packages
#
##########
RUN set -ex; \
    \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        iputils-ping \
        autoconf \
        build-essential \
        gnupg \
        libbsd-dev \
        libbz2-dev \
        libc-client2007e-dev \
        libc-client2007e \
        libc-dev \
        libcurl3 \
        libcurl3-dev \
        libcurl4-openssl-dev \
        libedit-dev \
        libedit2 \
        libexif-dev \
        libfreetype6-dev \
        libicu-dev \
        libjpeg-dev \
        libjpeg62-turbo-dev \
        libkrb5-dev \
        libldap2-dev \
        libmagick++-dev \
        libmagickwand-dev \
        libmagickwand-6.q16-3 \
        libmcrypt4 \
        libmcrypt-dev \
        libmemcached-dev \
        libmemcached11 \
        libmemcachedutil2 \
        libpcre3 \
        libpcre3-dev \
        libpng-dev \
        libpng16-16 \
        libpq-dev \
        libsqlite3-0 \
        libsqlite3-dev \
        libssh2-1 \
        libssh2-1-dev \
        libssl-dev \
        libtinfo-dev \
        libtool \
        libwebp-dev \
        libxml2 \
        libxml2-dev \
        libxpm-dev \
        libxslt1-dev \
        libxslt1.1 \
        locales \
    ; \
    \
    echo "LC_ALL=${OS_LOCALE}" >> /etc/environment; \
    echo "${OS_LOCALE} UTF-8" >> /etc/locale.gen; \
    echo "LANG=${OS_LOCALE}" > /etc/locale.conf; \
    locale-gen ${OS_LOCALE}; \
    \
    docker-php-ext-configure gd \
        --with-png-dir=/usr \
        --with-jpeg-dir=/usr \
        --with-freetype-dir=/usr \
        --with-xpm-dir=/usr \
        --with-webp-dir=/usr \
        --with-vpx-dir=/usr; \
    docker-php-ext-configure imap --with-kerberos --with-imap-ssl; \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu; \
    docker-php-ext-install -j$(nproc) \
        bcmath \
        bz2 \
        calendar \
        dba \
        exif \
        gd \
        gettext \
        iconv \
        imap \
        intl \
        ldap \
        mbstring \
        mysqli \
        opcache \
        pdo_mysql \
        pdo_pgsql  \
        soap \
        sockets \
        xmlrpc \
        xsl \
        zip \
    ; \
    \
    pecl install \
        igbinary-2.0.1 \
        imagick-3.4.3 \
        memcached-3.0.3 \
        msgpack-2.0.2 \
        redis-3.1.3 \
        apcu-5.1.8 \
    ; \
    echo "\n" | pecl install ssh2-1.1.2; \
    docker-php-ext-enable --ini-name pecl.ini \
        igbinary \
        imagick \
        memcached \
        msgpack \
        redis \
        ssh2 \
        apcu \
    ; \
    \
    apt-get install -y --no-install-recommends \
        apt-transport-https \
        apt-utils \
        bash-completion \
        bzip2 \
        curl \
        graphicsmagick \
        git \
        htop \
        imagemagick \
        jq \
        less \
        lftp \
        mysql-client \
        nano \
        rsync \
        screen \
        sshpass \
        ssl-cert \
        supervisor \
        unzip \
        vim \
        wget \
        zip \
    ; \
    \
    curl -sSL https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; \
    \
    rm -rf /tmp/pear /var/lib/apt/lists/*;


####################
#
# configure php
#
####################
ADD config/php.ini $PHP_CONFIG_DIR/php.ini

####################
#
# configure apache
#
####################
RUN a2dissite 000-default.conf
# add all vhost templates and activate them via entrypoint.sh
ADD config/vhost /etc/apache2/sites-enabled/

# set permissions
RUN chmod -R 775 /var/www/html && \
    chown -R www-data:www-data /var/www && \
    mkdir -p /var/lib/php &&  \
    chown -R www-data:www-data /var/lib/php

# enable modules
RUN a2enmod rewrite ssl expires headers

EXPOSE 80
EXPOSE 443