# JeWeblryStore

## Requisitos locales

- PHP 8.3+
- Composer
- Node.js y npm
- SQLite o tu base de datos local configurada

## Inicio del proyecto para desarrollo local

1. Instala dependencias de PHP:

```bash
composer install
```

2. Crea el archivo de entorno si no existe:

```bash
cp .env.example .env
php artisan key:generate
```

3. Ejecuta las migraciones y el seeder inicial de estados:

```bash
php artisan migrate
php artisan db:seed --class=StatusSeeder
```

4. Inicia el servidor local:

```bash
php artisan serve
```

5. Si quieres compilar assets del frontend:

```bash
npm install
npm run dev
```

## Setup rápido del proyecto

Para preparar un proyecto nuevo de forma automatizada, usa:

```bash
composer run setup
```

Este comando ejecuta:

- `composer install`
- copia `.env.example` a `.env` si hace falta
- genera la `APP_KEY`
- ejecuta migraciones
- ejecuta el seeder de estados

> El seeder de estados debe vivir en `database/seeders/StatusSeeder.php` y debe incluir los valores base para cualquier modelo que use una relación con `statuses`.

## Regla de desarrollo para estados

Cuando un modelo tenga una relación con `statuses`, los valores base deben agregarse dentro del seeder inicial y no dentro de la migración. La migración solo crea la estructura; el seeder inicializa los datos de dominio.

## Arquitectura relevante

- Las tablas de dominio se crean con migraciones.
- Los datos iniciales, como estados, roles o categorías base, van en seeders.
- El script `composer run setup` debe dejar el proyecto listo para desarrollo sin pasos extra.

## Licencia

Este proyecto se distribuye bajo la licencia MIT.
