# ------------------------------
# Base Image
# ------------------------------
FROM php:8.2-cli

# ------------------------------
# System dependencies + Node.js 20.x (LTS) via NodeSource
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
 && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get install -y nodejs \
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
# Fail fast on any error so build logs show the real cause
# ------------------------------
RUN set -e && npm install 2>&1
RUN set -e && npm run build 2>&1

# ------------------------------
# Fix permissions for Laravel
# ------------------------------
RUN mkdir -p storage/framework/{cache,sessions,views} \
    && chmod -R 775 storage bootstrap/cache

# ------------------------------
# Clear caches safely
# ------------------------------
RUN php artisan config:clear || true

# ------------------------------
# Expose Railway port
# ------------------------------
EXPOSE 8080

# ------------------------------
# Start Laravel: run pending migrations then serve
# ------------------------------
CMD sh -c "php artisan migrate --force && php -S 0.0.0.0:${PORT:-8080} -t public"