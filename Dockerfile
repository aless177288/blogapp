# ==========================================
# Imagen de Produccion PHP-FPM (Alpine)
# ==========================================
FROM php:8.2-fpm-alpine

# Instalar dependencias del sistema y extensiones de PHP requeridas
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    zip \
    unzip \
    oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        opcache

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar configuraciones optimizadas
COPY docker/php/local.ini /usr/local/etc/php/conf.d/local.ini
COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/zz-docker.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Copiar archivos del proyecto (incluye assets ya compilados en public/)
COPY . .

# Instalar dependencias de Composer optimizadas para produccion
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist --no-scripts

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
