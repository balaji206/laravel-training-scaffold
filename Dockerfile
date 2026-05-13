FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpq-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Install frontend dependencies
RUN npm install

# Build frontend assets
RUN npm run build

# Clear and cache configs
RUN php artisan config:clear
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Create storage link safely
RUN php artisan storage:link || true

# Expose Render port
EXPOSE 10000

# Start Laravel
CMD php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=10000