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
# Permissions (important for Laravel)
# ------------------------------
RUN mkdir -p storage/framework/{cache,sessions,views} \
    && chmod -R 775 storage bootstrap/cache

# ------------------------------
# Clear caches (safe for build)
# ------------------------------
RUN php artisan config:clear \
 && php artisan cache:clear \
 && php artisan view:clear || true

# ------------------------------
# DO NOT RUN MIGRATIONS HERE
# (Railway handles runtime DB)
# ------------------------------

# ------------------------------
# Expose port (Railway uses $PORT dynamically)
# ------------------------------
EXPOSE 8080

# ------------------------------
# Start Laravel using PHP built-in server
# (IMPORTANT: uses Railway $PORT correctly)
# ------------------------------
CMD php -S 0.0.0.0:$PORT -t public