#!/bin/sh

# Establecer permisos adecuados para el directorio storage y el archivo laravel.log
chown -R www-data:www-data /var/www/storage
chmod -R 755 /var/www/storage
touch /var/www/storage/logs/laravel.log
chown www-data:www-data /var/www/storage/logs/laravel.log
chmod 644 /var/www/storage/logs/laravel.log

# Iniciar el proceso principal (por ejemplo, php-fpm)
exec "$@"
