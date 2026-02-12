FROM php:8.2-cli

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

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

# ✅ Correct Vite build step
RUN npm install && npm run build

RUN php artisan config:clear \
 && php artisan cache:clear \
 && php artisan view:clear \
 && mkdir -p storage/framework/{cache,sessions,views} \
 && chmod -R 775 storage bootstrap/cache \
 && php artisan storage:link || true

EXPOSE 8080

CMD sh -c "php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"
