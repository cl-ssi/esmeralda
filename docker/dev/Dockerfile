FROM php:8.1-fpm-alpine

# Install dependencies for GD and install GD with support for jpeg, png webp and freetype
# Info about installing GD in PHP https://www.php.net/manual/en/image.installation.php
RUN apk add --no-cache \
        libjpeg-turbo-dev \
        libpng-dev \
        libwebp-dev \
        freetype-dev \
        libxml2-dev \
        libzip-dev \
        npm \
        git \
        shadow \
        wget \
        bash

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

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"

# Algunos alias
RUN echo "PS1='\[\033[01;90m\]Esmeralda\[\033[00m\]@\[\033[01;34m\]\w\[\033[00m\]:\\$ '" >> ~/.bashrc
RUN echo "alias serve='php artisan serve --host=0.0.0.0 --port=8000'" >> ~/.bashrc
RUN echo "alias tinker='php artisan tinker'" >> ~/.bashrc
RUN echo "alias ll='ls -l'" >> ~/.bashrc
RUN echo "alias s='cd ..'" >> ~/.bashrc
RUN echo "alias www='su www-data'" >> ~/.bashrc

# Preparar el usuario www-data
RUN chmod 777 /root
RUN usermod -u 1000 -s /bin/bash -d /root www-data && groupmod -g 1000 www-data && usermod -s /bin/bash root

##  Algunos Alias para el terminal
# alias dbuild='docker build docker/dev -t `basename "$PWD"`'
# alias drun='docker run --rm -it -v $(pwd):/var/www/html -p 8000:8000 -d --name `basename "$PWD"` `basename "$PWD"`'
# alias dexec='docker exec -it `basename "$PWD"` /bin/bash'
# alias dstop='docker stop `basename "$PWD"`'
