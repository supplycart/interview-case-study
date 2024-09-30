# Stage 1: Build the Vue frontend
FROM node:18-alpine as node_builder

WORKDIR /app

# Copy package.json and package-lock.json (if exists)
COPY package*.json ./

# Install Node.js dependencies
RUN npm install

# Build for production or start dev server depending on target environment
ARG NODE_ENV
RUN if [ "$NODE_ENV" = "production" ]; then npm run build; else npm install -g vite; fi

# Stage 2: Setup Laravel with PHP and Node.js
FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache git curl libpng-dev libjpeg-turbo-dev freetype-dev libzip-dev zip unzip oniguruma-dev bash

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring gd zip exif pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js and npm
RUN apk add --no-cache nodejs npm

WORKDIR /var/www/html

# Copy the Laravel project files
COPY . .

# Copy the Vue build artifacts from the first stage if it's production
COPY --from=node_builder /app/public ./public
COPY --from=node_builder /app/resources/js ./resources/js

# Install PHP dependencies via Composer
RUN composer install --no-dev --optimize-autoloader

# Install Node.js dependencies (for npm/npx)
RUN npm install

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
