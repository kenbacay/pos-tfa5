FROM php:8.2-apache

RUN apt-get update \
    && apt-get install -y libicu-dev libzip-dev unzip \
    && docker-php-ext-install intl mysqli pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' \
    /etc/apache2/sites-available/000-default.conf

RUN sed -i 's|<Directory /var/www/>|<Directory /var/www/html/public>|' \
    /etc/apache2/apache2.conf

RUN chown -R www-data:www-data /var/www/html/writable

EXPOSE 80