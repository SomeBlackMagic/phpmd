FROM php:5.6-cli

RUN mkdir -p /usr/share/man/man1
RUN apt-get update

# zip
RUN apt-get install -y zlib1g-dev
RUN docker-php-ext-install zip
RUN docker-php-ext-enable zip


ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_MEMORY_LIMIT -1

CMD mkdir /.composer_cache
ENV COMPOSER_CACHE_DIR /.composer_cache

RUN apt-get install -y git unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#boost composer
RUN composer -vvv global require hirak/prestissimo


RUN pecl install xdebug-2.5.5
RUN docker-php-ext-enable xdebug

COPY entrypoint.sh /
RUN chmod +x /entrypoint.sh

WORKDIR /app

ENTRYPOINT ["/entrypoint.sh"]