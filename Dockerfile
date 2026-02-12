# ------------------------------
# Base PHP image
# ------------------------------
FROM php:8.2-cli

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
# Build frontend assets (Vite)
# ------------------------------
ENV NODE_ENV=production
RUN npm install
RUN npm run build

# ------------------------------
# Ensure caches & storage directories exist, set permissions
# ------------------------------
RUN mkdir -p storage/framework/{cache,sessions,views} \
 && chmod -R 775 storage bootstrap/cache \
 && php artisan config:clear \
 && php artisan cache:clear \
 && php artisan view:clear \
 && php artisan storage:link || true

# ------------------------------
# Expose Railway port
# ------------------------------
EXPOSE 8080

# ------------------------------
# Start Laravel using Railway $PORT
# ------------------------------
CMD sh -c "php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"
