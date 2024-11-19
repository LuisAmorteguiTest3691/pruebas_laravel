# Usar la imagen base oficial de PHP con extensiones para Laravel
FROM php:8.2-fpm

# Instalar extensiones requeridas de PHP y herramientas adicionales
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Crear y establecer el directorio de trabajo
WORKDIR /var/www

# Copiar todos los archivos del proyecto al contenedor
COPY . .

# Establecer permisos para el almacenamiento y el caché
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Instalar dependencias de Composer
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto del servidor
EXPOSE 8000

# Comando para iniciar la aplicación
CMD php artisan serve --host=0.0.0.0 --port=8000
