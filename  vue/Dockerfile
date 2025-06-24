FROM php:8.2-fpm-alpine

WORKDIR /var/www/laravel

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli  

# Copy the Laravel application code
COPY src/ .

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer.json and composer.lock
COPY src/composer.json src/composer.lock ./

# Install composer dependencies
RUN composer update
RUN composer install --optimize-autoloader --no-suggest
RUN composer dump-autoload
# Install Node.js and npm
RUN apk add --no-cache nodejs npm
COPY src/package.json src/package-lock.json ./

RUN npm install

 
