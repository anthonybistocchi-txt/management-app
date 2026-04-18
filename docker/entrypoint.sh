#!/bin/sh
set -e
cd /var/www/html

if [ ! -f .env ]; then
    if [ -f .env.example ]; then
        cp .env.example .env
    fi
fi

if [ ! -f vendor/autoload.php ]; then
    composer install --no-interaction --prefer-dist --optimize-autoloader
    chown -R www-data:www-data vendor bootstrap/cache storage 2>/dev/null || true
fi

if [ -f .env ]; then
    if ! grep -q "^APP_KEY=base64:" .env 2>/dev/null; then
        php artisan key:generate --force --ansi || true
    fi
fi

php artisan migrate --force --no-interaction || true

exec docker-php-entrypoint "$@"
