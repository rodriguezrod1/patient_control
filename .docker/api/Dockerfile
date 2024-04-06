# Establecer la imagen base
FROM php:8.1-fpm

# Instalar las dependencias necesarias
RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    git \
    libpq-dev \
    libonig-dev \
    nginx

# Instalar las extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_pgsql mbstring

# Copiar la aplicación Laravel al contenedor
COPY ./ /var/www

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar las dependencias de Laravel
RUN composer install --working-dir=/var/www --no-interaction --no-progress

# Copiar el archivo .env al contenedor
COPY ./.env /var/www/.env

# Copiar el archivo de entrada personalizado al contenedor
COPY ./.docker/api/entrypoint.sh /usr/local/bin/

# Establecer el punto de entrada
ENTRYPOINT ["entrypoint.sh"]

# Copiar el archivo de configuración de Nginx
COPY ./.docker/api/laravel.conf /etc/nginx/sites-available/default

# Exponer el puerto 3000
EXPOSE 8080

# Iniciar Nginx y PHP-FPM
CMD ["sh", "-c", "nginx && php-fpm"]
