FROM php:7.3-apache
COPY . /var/www/html
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf
RUN chown -R www-data:www-data /var/www/html/ && a2enmod rewrite

RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer && composer global require hirak/prestissimo --no-plugins --no-scripts

RUN composer install --prefer-dist --no-scripts --no-dev --no-autoloader && rm -rf /root/.composer

RUN composer dump-autoload --no-scripts --no-dev --optimize