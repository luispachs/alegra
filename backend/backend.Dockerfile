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
RUN printf "APP_NAME=Laravel \ 
APP_ENV=production \
APP_KEY=base64:sp+N5qMwpkVlh8wYm6dvaDNnbqCwhyCKI7NuJeJMx0Q=  \
APP_DEBUG=true \
APP_TIMEZONE=UTC \
APP_URL=http://localhost \

APP_LOCALE=en \
APP_FALLBACK_LOCALE=en \
APP_FAKER_LOCALE=en_US \

APP_MAINTENANCE_DRIVER=file \
# APP_MAINTENANCE_STORE=database
 
BCRYPT_ROUNDS=12 \

LOG_CHANNEL=stack \
LOG_STACK=single \
LOG_DEPRECATIONS_CHANNEL=null \
LOG_LEVEL=debug \

DB_CONNECTION=mysql \
DB_HOST= \
DB_PORT= \
DB_DATABASE= \
DB_USERNAME= \
DB_PASSWORD= \

SESSION_DRIVER=memcached \
SESSION_LIFETIME=120 \
SESSION_ENCRYPT=false \
SESSION_PATH=/   \
SESSION_DOMAIN=null \

BROADCAST_CONNECTION=log \
FILESYSTEM_DISK=local \
QUEUE_CONNECTION=database \

CACHE_STORE=memcached \
CACHE_PREFIX=alegra \


REDIS_CLIENT=phpredis \
REDIS_HOST=127.0.0.1 \
REDIS_PASSWORD=null \
REDIS_PORT=6379 \

MAIL_MAILER=log \
MAIL_HOST=127.0.0.1 \
MAIL_PORT=2525 \
MAIL_USERNAME=null \
MAIL_PASSWORD=null \
MAIL_ENCRYPTION=null \
MAIL_FROM_ADDRESS="hello@example.com" \
MAIL_FROM_NAME="${APP_NAME}" \

AWS_ACCESS_KEY_ID=AKIAVSG33HGTRWLMV37Q \
AWS_SECRET_ACCESS_KEY=RyXeHTJMIfO37TVDJzMpVcHFsJRS37Q1sPS9J07W \
AWS_DEFAULT_REGION=us-east-1 \
AWS_BUCKET= \
AWS_USE_PATH_STYLE_ENDPOINT=false\

#### SQS URL ###
SQS_ORDEN_QUEUE="https://sqs.us-east-1.amazonaws.com/382713149863/orders.fifo" \
SQS_PURCHASE_QUEUE="https://sqs.us-east-1.amazonaws.com/382713149863/purchase.fifo" \
VITE_APP_NAME="${APP_NAME}" \


JWT_KEY=5c7cfd2da9de3dc0fe0982ee2feaa1344bb120c6  \ 

QUEUE_CONNECTION=sqs \  

MEMCACHED_USERNAME=admin \  
MEMCACHED_PASSWORD=admin \ 
MEMCACHED_HOST=0.0.0.0  \  
MEMCACHED_PORT=11211" >> .env
RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan lang:publish
RUN php artisan webpush:vapid

WORKDIR /home/backend
EXPOSE 8000
CMD [ "php",'artisan','serve' ]


