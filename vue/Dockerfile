FROM php:8.2-fpm-alpine

WORKDIR /var/www/server

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli  

# Copy the Laravel application code
COPY server/ .

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer.json and composer.lock
COPY server/composer.json server/composer.lock ./

RUN docker-php-ext-install pcntl

# Install composer dependencies
RUN composer update
RUN composer install --optimize-autoloader --ignore-platform-reqs
RUN composer dump-autoload
# Install Node.js and npm
RUN apk add --no-cache nodejs npm
COPY server/package.json server/package-lock.json ./

RUN docker-php-ext-configure pcntl --enable-pcntl \
  && docker-php-ext-install \
    pcntl

RUN npm install

 
