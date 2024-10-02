# Stage 1: Build stage
FROM node:18-alpine as build

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build

# Stage 2: Production stage
FROM php:8.2-fpm

WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get upgrade -y && apt-get install -y \
      procps \
      nano \
      git \
      unzip \
      libzip-dev \
      libicu-dev \
      zlib1g-dev \
      libxml2 \
      libxml2-dev \
      libreadline-dev \
      cron \
      sudo \
      libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
      intl \
      zip \
      exif \
      pcntl \
      bcmath \
    && rm -rf /tmp/* \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the application code
COPY . .

# Copy the build front end assets from the build stage
COPY --from=build /app/public var/www/html/public

# Install Composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]

