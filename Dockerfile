# ------------------------------
# Base PHP image
# ------------------------------
FROM php:8.2-cli

# ------------------------------
# Install system dependencies including Node
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
# Copy project files
# ------------------------------
COPY . .

# ------------------------------
# Install PHP dependencies
# ------------------------------
RUN composer install --no-dev --optimize-autoloader

# ------------------------------
# Install Node dependencies & build frontend assets (Vite)
# ------------------------------
RUN npm install --verbose
RUN npm run build --verbose

# Verify the build output
RUN echo "Listing public/build directory:" && ls -la public/build

# ------------------------------
# Run migrations and seed admin user
# ------------------------------
RUN php artisan migrate --force \
 && php artisan db:seed --class=AdminUserSeeder || true

# ------------------------------
# Clear caches and fix permissions
# ------------------------------
RUN php artisan config:clear \
 && php artisan cache:clear \
 && php artisan view:clear \
 && mkdir -p storage/framework/{cache,sessions,views} \
 && chmod -R 775 storage bootstrap/cache \
 && php artisan storage:link || true

# ------------------------------
# Expose Railway port
# ------------------------------
EXPOSE 8080

# ------------------------------
# Start Laravel using Railway $PORT
# ------------------------------
CMD sh -c "php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"
