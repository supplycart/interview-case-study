# Use an official PHP runtime as a base image
FROM php:8.1-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        git \
        curl

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer.json and composer.lock into the container
COPY composer.json composer.lock ./

# Install application dependencies
RUN composer install --no-scripts

# Copy the application code into the container
COPY . .

# Expose port 80 for the Apache web server
EXPOSE 8000