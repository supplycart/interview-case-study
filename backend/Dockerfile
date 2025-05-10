FROM php:8.2-fpm-alpine

# Arguments defined in docker-compose.yml
ARG user=sail  # Default user
ARG uid=1000 # Default UID

# Install system dependencies and supervisor for queue worker
RUN apk update && apk add --no-cache \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libzip-dev \
    zip \
    unzip \
    jpegoptim \
    pngquant \
    gifsicle \
    vim \
    git \
    postgresql-dev \
    supervisor \
    autoconf \
    make \
    bash

# Clear cache
RUN rm -rf /var/cache/apk/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql gd zip bcmath
RUN pecl install redis && docker-php-ext-enable redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN addgroup -g ${uid} --system ${user} && \
    adduser -u ${uid} --system -G ${user} ${user}

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Copy application specific permissions
RUN chown -R ${user}:${user} /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Supervisor configuration for queue worker
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port 9000 and start php-fpm server and supervisor
EXPOSE 9000
CMD ["sh", "-c", "/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf && php-fpm"]
