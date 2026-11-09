# ============================================================
# Dockerfile para JeWeblryStore (Laravel 13 / PHP 8.3)
# Basado en los Tutoriales 05, 06 y 07
# ============================================================

FROM php:8.3-apache

# --- 1. Paquetes del sistema y extensiones PHP requeridas por Laravel ---
RUN apt-get update && apt-get install -y \
        git \
        unzip \
        zip \
        libzip-dev \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mysqli mbstring zip exif pcntl bcmath gd \
    && rm -rf /var/lib/apt/lists/*

# --- 2. Composer ---
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# --- 3. Apache: apuntar el DocumentRoot a /public y habilitar mod_rewrite ---
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && a2enmod rewrite

WORKDIR /var/www/html

# --- 4. Dependencias PHP (se cachean si composer.json/lock no cambian) ---
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction

# --- 5. Copiar el resto del proyecto ---
COPY . .

# --- 6. Optimizar autoload y permisos ---
RUN composer dump-autoload --optimize \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# --- 7. Script de arranque (key, cache, migraciones, seeder) ---
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
CMD ["apache2-foreground"]
