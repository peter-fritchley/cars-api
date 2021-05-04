FROM php:8.0-cli

RUN apt-get -y update && apt-get install -y libzip-dev zip

RUN docker-php-ext-install pdo pdo_mysql zip

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY docker_entrypoint /usr/bin/docker_entrypoint

RUN chmod +x /usr/bin/docker_entrypoint

WORKDIR /var/www/html