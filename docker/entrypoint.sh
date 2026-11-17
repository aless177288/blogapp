#!/bin/sh
set -e

# Asegurar permisos en carpetas de almacenamiento
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Enlazar storage a public si no existe
if [ ! -L /var/www/html/public/storage ]; then
    php artisan storage:link || true
fi

# Optimizar Laravel para produccion si APP_ENV es production
if [ "$APP_ENV" = "production" ]; then
    echo "Optimizando caches de Laravel..."
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

# Ejecutar comando principal (php-fpm)
exec "$@"
