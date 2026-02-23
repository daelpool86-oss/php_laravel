FROM php:8.2-cli

WORKDIR /var/www

# 1. Install system dependencies and MySQL driver
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libmariadb-dev \
    && docker-php-ext-install pdo pdo_mysql

# 2. Copy project files
COPY . .

# 3. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# 5. Fix permissions for Laravel (Crucial for Render/Linux)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# 6. Start the server
CMD php artisan serve --host=0.0.0.0 --port=10000