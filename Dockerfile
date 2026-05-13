FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpq-dev \
    default-mysql-client \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql

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

# Clear Laravel caches
RUN php artisan config:clear

# Create storage symlink safely
RUN php artisan storage:link || true

# Expose Render port
EXPOSE 10000

# Start Laravel application
CMD php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=10000