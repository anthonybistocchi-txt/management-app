# syntax=docker/dockerfile:1

FROM node:20-bookworm AS frontend
WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci
# Lockfile criado no Windows pode omitir optional deps do Rollup para Linux (native.js)
RUN ROLLUP_VER=$(node -p "require('rollup/package.json').version") \
    && case "$(uname -m)" in \
         x86_64) npm install "@rollup/rollup-linux-x64-gnu@${ROLLUP_VER}" --no-save ;; \
         aarch64|arm64) npm install "@rollup/rollup-linux-arm64-gnu@${ROLLUP_VER}" --no-save ;; \
         *) echo "Arquitetura não suportada: $(uname -m)" && exit 1 ;; \
       esac

COPY . .
RUN npm run build

FROM php:8.2-fpm-bookworm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    libicu-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) intl pdo_mysql mbstring exif pcntl bcmath gd zip opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Repassa variáveis do Docker (DB_*, APP_*, etc.) aos workers do PHP-FPM
RUN sed -i 's/^clear_env = yes/clear_env = no/' /usr/local/etc/php-fpm.d/www.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY docker/php/php.ini /usr/local/etc/php/conf.d/99-laravel.ini

WORKDIR /var/www/html

COPY . .
COPY --from=frontend /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader --no-scripts \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwx storage bootstrap/cache

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]
