# Use official PHP image with required extensions
FROM php:8.4-fpm

WORKDIR /var/www

# Install OS dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring gd xml
RUN apt-get install -y fish nano vim net-tools iputils-ping

# Install Composer, NodeJS & PNPM
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g pnpm

COPY . .
COPY .env.example .env

# Install dependencies
RUN composer install --no-dev --optimize-autoloader
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
RUN pnpm install && pnpm run build

# serve app
EXPOSE 8000
CMD php artisan migrate --force && php artisan db:seed && php artisan serve --host=0.0.0.0 --port=8000
