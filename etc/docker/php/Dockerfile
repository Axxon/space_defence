FROM php:7.4.7-fpm-alpine

ENV APCU_VERSION=5.1.8 \
    APCU_BC_VERSION=1.0.4 \
    REDIS_VERSION=4.0.2

RUN apk add --no-cache \
        pcre \
        pcre-dev \
        openssh \
        openssh-keygen \
        bash \
        ca-certificates \
        git \
        icu-libs \
        rabbitmq-c-dev \
        unzip \
        libjpeg-turbo-dev \
        libpng-dev \
        freetype-dev \
        libzip-dev \
        oniguruma \
        zlib-dev && \
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        icu-dev && \
    docker-php-ext-install \
        intl \
        zip && \
    docker-php-ext-install pcntl && \
    docker-php-ext-install sockets && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install bcmath && \
    pecl install amqp-1.10.2 && \
    docker-php-ext-enable amqp && \
    pecl install xdebug-2.9.4 && \
    pecl install mongodb && \
    echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini && \
    echo "short_open_tag = off" >> /usr/local/etc/php/php.ini && \
    echo "date.timezone = Europe/Paris" >> /usr/local/etc/php/conf.d/symfony.ini && \
    echo "opcache.max_accelerated_files = 20000" >> /usr/local/etc/php/conf.d/symfony.ini && \
    echo "realpath_cache_size=4096K" >> /usr/local/etc/php/conf.d/symfony.ini && \
    echo "realpath_cache_ttl=600" >> /usr/local/etc/php/conf.d/symfony.ini && \
    apk del .build-deps && \
    apk add --no-cache su-exec && \
    addgroup bar && \
    adduser -D -h /home -s /bin/sh -G bar foo && \
    echo 'PS1="Docker > php container $ "' > /home/.bashrc

COPY php.ini /usr/local/etc/php/
COPY xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN chmod +x /usr/local/lib/php/extensions/no-debug-non-zts-20190902/xdebug.so

COPY --from=composer /usr/bin/composer /usr/local/bin/composer
RUN su-exec foo composer global require "pyrech/composer-changelogs"

RUN su-exec foo ssh-keygen -f /home/.ssh/id_rsa -t rsa -N ''

ADD entrypoint.sh /sbin/entrypoint
ENTRYPOINT ["entrypoint"]
