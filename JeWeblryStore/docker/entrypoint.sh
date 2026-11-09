#!/bin/bash
# ============================================================
# Entrypoint para JeWeblryStore en GCP (Cloud SQL)
# Prepara la app antes de arrancar Apache.
# ============================================================
set -e

cd /var/www/html

# 1. Crear .env si no existe (en producción las variables llegan por -e / --env-file)
if [ ! -f ".env" ]; then
    cp .env.example .env
fi

# 2. Generar APP_KEY solo si está vacía
if ! grep -q "^APP_KEY=base64" .env; then
    php artisan key:generate --force
fi

# 3. Esperar a que la base de datos Cloud SQL responda (hasta ~60s)
echo "Esperando a la base de datos en ${DB_HOST}:${DB_PORT:-3306} ..."
for i in $(seq 1 30); do
    if php -r "exit(@fsockopen(getenv('DB_HOST'), getenv('DB_PORT') ?: 3306) ? 0 : 1);" 2>/dev/null; then
        echo "Base de datos disponible."
        break
    fi
    sleep 2
done

# 4. Migraciones y datos iniciales (idempotente)
php artisan migrate --force || true
php artisan db:seed --class=StatusSeeder --force || true

# 5. Cachear configuración/rutas/vistas para producción
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# 6. Enlace de almacenamiento público
php artisan storage:link || true

# 7. Arrancar Apache (o el comando que se pase)
exec "$@"
