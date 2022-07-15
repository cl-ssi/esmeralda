FROM php:8.1-fpm-alpine

RUN apk add --no-cache nginx wget

# Install dependencies for GD and install GD with support for jpeg, png webp and freetype
# Info about installing GD in PHP https://www.php.net/manual/en/image.installation.php
RUN apk add --no-cache \
        libjpeg-turbo-dev \
        libpng-dev \
        libwebp-dev \
        freetype-dev \
        libxml2-dev \
        libzip-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN docker-php-ext-enable pdo_mysql

# As of PHP 7.4 we don't need to add --with-png
RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype

RUN docker-php-ext-install gd

RUN docker-php-ext-install soap

RUN docker-php-ext-install zip

RUN docker-php-ext-install bcmath

RUN cd /usr/local/etc/php/conf.d/ && \
  echo 'memory_limit = 256M' >> docker-php-memlimit.ini

RUN echo 'display_errors = Off' >> /usr/local/etc/php/conf.d/docker-php-errors.ini
RUN echo 'display_startup_errors = Off' >> /usr/local/etc/php/conf.d/docker-php-errors.ini
RUN echo 'error_reporting = E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED' >> /usr/local/etc/php/conf.d/docker-php-errors.ini
RUN echo 'html_errors = On' >> /usr/local/etc/php/conf.d/docker-php-errors.ini
RUN echo 'log_errors = On' >> /usr/local/etc/php/conf.d/docker-php-errors.ini
RUN echo 'error_log = On' >> /usr/local/etc/php/conf.d/docker-php-errors.ini

RUN mkdir -p /run/nginx

COPY docker/nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /app
COPY . /app

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN cd /app && \
    /usr/local/bin/composer install --no-dev

RUN chown -R www-data: /app

CMD sh /app/docker/startup.sh
