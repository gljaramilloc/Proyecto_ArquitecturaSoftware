#!/bin/bash
set -e
cd /var/www/html

[ -f .env ] || cp .env.example .env
grep -q "^APP_KEY=base64" .env || php artisan key:generate --force

echo "Esperando a la BD en ${DB_HOST}:${DB_PORT:-3306} ..."
for i in $(seq 1 30); do
  php -r "exit(@fsockopen(getenv('DB_HOST'), getenv('DB_PORT') ?: 3306) ? 0 : 1);" 2>/dev/null && break || sleep 2
done

php artisan migrate --force || true
php artisan db:seed --class=StatusSeeder --force || true
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true
php artisan storage:link || true

exec "$@"
