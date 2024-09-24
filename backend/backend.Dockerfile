FROM php
USER root:root
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
COPY . /home/backend
WORKDIR /home/backend
RUN apt-get update && apt-get install -y libmemcached-dev libssl-dev zlib1g-dev zip\
	&& pecl install memcached-3.2.0 \
    && pecl install memcache-8.0 \
	&& docker-php-ext-enable memcached memcache
RUN composer install
WORKDIR /home/backend
EXPOSE 8000
CMD [ "php",'artisan','serve' ]


