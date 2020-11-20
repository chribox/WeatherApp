FROM php:7.4.12-fpm-alpine
RUN apk --update --no-cache add git
RUN docker-php-ext-install pdo_mysql
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer self-update
WORKDIR /var/www
CMD composer install ;  php-fpm
EXPOSE 9000

