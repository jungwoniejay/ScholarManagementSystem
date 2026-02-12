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
# Build frontend assets
# ------------------------------
RUN npm install && npm run build

# ------------------------------
# Set permissions
# ------------------------------
RUN chmod -R 775 storage bootstrap/cache

# ------------------------------
# Expose Railway port
# ------------------------------
EXPOSE 8080

# ------------------------------
# Start Laravel using the Railway $PORT
# ------------------------------
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=${PORT:-8080}"]
