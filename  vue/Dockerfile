FROM php:8.2-fpm-alpine

WORKDIR /var/www/laravel

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli  

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer.json and composer.lock
COPY src/composer.json src/composer.lock ./

# Install composer dependencies
RUN composer install --no-ansi --no-dev --no-interaction --no-scripts --optimize-autoloader --no-suggest

# Install Node.js and npm
RUN apk add --no-cache nodejs npm

# Copy the Laravel application code
COPY src/ .

# Generate application key (optional, but recommended)
RUN php artisan key:generate

# Set proper file permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 9000 (FPM) and 8000 (Vite, if used)
EXPOSE 9000 8000

# Copy an entrypoint script (if needed, see below)
COPY docker/entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

# Command to start the application using php artisan serve.
CMD ["/docker-entrypoint.sh"]
 