#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")"

php artisan optimize:clear
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
npm ci
npm run build
php artisan migrate --force

if [ ! -L public/storage ] && [ ! -e public/storage ]; then
    php artisan storage:link
fi

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache