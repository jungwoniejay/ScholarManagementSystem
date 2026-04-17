# ------------------------------
# Base Image
# ------------------------------
FROM php:8.2-cli

# ------------------------------
# System dependencies
# ------------------------------
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    nodejs \
    npm \
 && docker-php-ext-install pdo pdo_mysql zip \
 && rm -rf /var/lib/apt/lists/*

# ------------------------------
# Install Composer
# ------------------------------
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ------------------------------
# Working directory
# ------------------------------
WORKDIR /var/www/html

# ------------------------------
# Copy project files
# ------------------------------
COPY . .

# ------------------------------
# Install PHP dependencies
# ------------------------------
RUN composer install --no-dev --optimize-autoloader

# ------------------------------
# Install frontend dependencies + build assets
# ------------------------------
RUN npm install
RUN npm run build

# ------------------------------
# Fix permissions for Laravel
# ------------------------------
RUN mkdir -p storage/framework/{cache,sessions,views} \
    && chmod -R 775 storage bootstrap/cache

# ------------------------------
# Clear caches safely
# ------------------------------
RUN php artisan config:clear || true \
 && php artisan cache:clear || true \
 && php artisan view:clear || true

# ------------------------------
# IMPORTANT: DO NOT RUN MIGRATIONS HERE
# ------------------------------

# ------------------------------
# Expose Railway port
# ------------------------------
EXPOSE 8080

# ------------------------------
# Start Laravel safely for Railway
# ------------------------------
CMD sh -c "php -S 0.0.0.0:${PORT:-8080} -t public"