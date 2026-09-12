FROM php:8.2-apache

# MySQL + cURL are required by LifeVault (Google OAuth uses cURL).
RUN apt-get update \
    && apt-get install -y --no-install-recommends libcurl4-openssl-dev \
    && docker-php-ext-install mysqli curl \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

WORKDIR /var/www/html

COPY . /var/www/html

RUN mkdir -p /var/www/html/application/cache/sessions /var/www/html/application/logs /var/www/html/uploads \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/application/cache /var/www/html/application/logs /var/www/html/uploads

EXPOSE 80

CMD ["apache2-foreground"]
