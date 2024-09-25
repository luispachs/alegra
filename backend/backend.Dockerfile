FROM php
USER root:root
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
COPY . /home/backend
WORKDIR /home/backend
RUN apt-get update && apt-get install -y libmemcached-dev libssl-dev zlib1g-dev zip\
	&& pecl install memcached-3.2.0 \
    && pecl install memcache-8.0  && \
	docker-php-ext-install   pdo pdo_mysql  \
	&& docker-php-ext-enable memcached memcache 
RUN apt-get install -y unzip
RUN composer install
RUN printf "APP_NAME=Laravel \n\
APP_ENV=production \n\
APP_KEY=base64:sp+N5qMwpkVlh8wYm6dvaDNnbqCwhyCKI7NuJeJMx0Q=  \n\
APP_DEBUG=true \n\
APP_TIMEZONE=UTC \n\
APP_URL=http://localhost \n\
APP_LOCALE=en \n\
APP_FALLBACK_LOCALE=en \n\
APP_FAKER_LOCALE=en_US \n\
APP_MAINTENANCE_DRIVER=file \n\
# APP_MAINTENANCE_STORE=database\n\
BCRYPT_ROUNDS=12 \n\
LOG_CHANNEL=stack \n\
LOG_STACK=single \n\
LOG_DEPRECATIONS_CHANNEL=null \n\
LOG_LEVEL=debug \n\
DB_CONNECTION=mysql \n\
DB_HOST=database-1.cosfjltrhf00.us-east-1.rds.amazonaws.com \n\
DB_PORT=3306 \n\
DB_DATABASE=test_alegra \n\
DB_USERNAME=admin \n\
DB_PASSWORD="L4pZDev-10129113" \n\
SESSION_DRIVER=memcached \n\
SESSION_LIFETIME=120 \n\
SESSION_ENCRYPT=false \n\
SESSION_PATH=/   \n\
SESSION_DOMAIN=null \n\
BROADCAST_CONNECTION=log \n\
FILESYSTEM_DISK=local \n\
QUEUE_CONNECTION=database \n\
CACHE_STORE=memcached \n\
CACHE_PREFIX=alegra \n\
REDIS_CLIENT=phpredis \n\
REDIS_HOST=127.0.0.1 \n\
REDIS_PASSWORD=null \n\
REDIS_PORT=6379 \n\
MAIL_MAILER=log \n\
MAIL_HOST=127.0.0.1 \n\
MAIL_PORT=2525 \n\
MAIL_USERNAME=null \n\
MAIL_PASSWORD=null \n\
MAIL_ENCRYPTION=null \n\
MAIL_FROM_ADDRESS="hello@example.com" \n\
MAIL_FROM_NAME="\${APP_NAME}" \n\
AWS_ACCESS_KEY_ID=AKIAVSG33HGTRWLMV37Q \n\
AWS_SECRET_ACCESS_KEY=RyXeHTJMIfO37TVDJzMpVcHFsJRS37Q1sPS9J07W \n\
AWS_DEFAULT_REGION=us-east-1 \n\
AWS_BUCKET= \n\
AWS_USE_PATH_STYLE_ENDPOINT=false\n\
SQS_ORDEN_QUEUE="https://sqs.us-east-1.amazonaws.com/382713149863/orders.fifo" \n\
SQS_PURCHASE_QUEUE="https://sqs.us-east-1.amazonaws.com/382713149863/purchase.fifo" \n\
VITE_APP_NAME="\${APP_NAME}" \n\
JWT_KEY=5c7cfd2da9de3dc0fe0982ee2feaa1344bb120c6  \n\
QUEUE_CONNECTION=sqs \n\
MEMCACHED_USERNAME=admin \n\  
MEMCACHED_PASSWORD=admin \n\
MEMCACHED_HOST=0.0.0.0  \n\ 
MEMCACHED_PORT=11211" >> .env
RUN php artisan key:generate
RUN php artisan config:cache
RUN php artisan lang:publish
RUN php artisan webpush:vapid

WORKDIR /home/backend
EXPOSE 8000
CMD [ "php",'artisan','serve' ]


