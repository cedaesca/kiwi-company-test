FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --optimize-autoloader

WORKDIR /var/www/html/

RUN chown -R www-data:www-data /var/www/html/
