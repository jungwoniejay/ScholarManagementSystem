# ------------------------------
# Base PHP image
# ------------------------------
FROM php:8.2-fpm

# ------------------------------
# Install system dependencies
# ------------------------------
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    nodejs \
    npm \
 && docker-php-ext-install pdo pdo_mysql zip \
 && rm -rf /var/lib/apt/lists/*

# ------------------------------
# Install Composer
# ------------------------------
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ------------------------------
# Set working directory
# ------------------------------
WORKDIR /var/www/html

# ------------------------------
# Copy app code
# ------------------------------
COPY . .

# ------------------------------
# Install PHP dependencies
# ------------------------------
RUN composer install --no-dev --optimize-autoloader

# ------------------------------
# Make storage & cache folders
# ------------------------------
RUN mkdir -p storage/framework/{cache,sessions,views} \
    && chmod -R 775 storage bootstrap/cache

# ------------------------------
# Build frontend assets
# ------------------------------
RUN npm install && npm run build

# ------------------------------
# Clear caches & link storage
# ------------------------------
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan view:clear \
    && php artisan storage:link

# ------------------------------
# Expose port
# ------------------------------
EXPOSE 8080

# ------------------------------
# Start command (Laravel dev server)
# ------------------------------
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
