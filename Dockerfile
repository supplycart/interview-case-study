FROM php:8.4-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl
RUN docker-php-ext-configure gd \
    && docker-php-ext-install pdo_mysql gd
RUN apt-get install -y fish nano vim

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --prefer-dist --optimize-autoloader

# RUN pnpm install && pnpm run build
# RUN php artisan migrate && php artisan db:seed

# set proper permissions for Laravel related file access
RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 /var/www/storage /var/www/bootstrap/cache
