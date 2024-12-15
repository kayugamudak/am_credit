FROM php:8.2-fpm

RUN apt-get update
RUN apt-get upgrade -y

RUN apt-get -y install \
    libxml2-dev \
    libcurl4-openssl-dev \
    libssh-dev \
    libzip-dev \
    libpng-dev

RUN apt-get -y install \
    git \
    zip \
    wget \
    supervisor

RUN docker-php-ext-install \
    intl \
    gd \
    pcntl \
    soap \
    zip \
    bcmath \
    exif \
    opcache

RUN pecl install xdebug

RUN docker-php-ext-enable \
    xdebug \
    zip

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm composer-setup.php
#RUN composer self-update 2 --timeout 120

RUN \
  rm -rf /var/lib/apt/lists/* && \
  sed -i 's/^\(\[supervisord\]\)$/\1\nnodaemon=true/' /etc/supervisor/supervisord.conf

CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
