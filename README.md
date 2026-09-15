# Proyecto_ArquitecturaSoftware

Este repositorio incluye el proyecto web de joyería `JeWeblryStore`, desarrollado con Laravel.

## Descripción general

La aplicación principal está dentro de la carpeta:

- `JeWeblryStore/`

Allí se instalan las dependencias, se ejecuta el servidor y se gestionan las rutas del sistema.

## Requisitos

- PHP 8.3 o superior
- Composer
- Node.js y npm (opcional para frontend)
- Base de datos local configurada

## Cómo ejecutar el proyecto

1. Abre la terminal y entra a la carpeta del proyecto:

```bash
cd JeWeblryStore
```

2. Instala las dependencias de PHP:

```bash
composer install
```

3. Configura el archivo `.env` y genera la clave de la aplicación:

```bash
cp .env.example .env
php artisan key:generate
```

4. Ejecuta las migraciones y carga los datos iniciales:

```bash
php artisan migrate
php artisan db:seed --class=StatusSeeder
```

5. Inicia la aplicación:

```bash
php artisan serve
```

La aplicación quedará disponible normalmente en:

```text
http://127.0.0.1:8000
```

## Ruta principal a invocar

La ruta principal del sistema es la página de inicio:

```text
/
```

Rutas relevantes del proyecto:

- `/` - inicio
- `/about` - información del negocio
- `/contact` - contacto
- `/cart` - carrito de compras
- `/orders` - pedidos del usuario autenticado

## Frontend y assets

Si deseas compilar los estilos y scripts del frontend en desarrollo, ejecuta:

```bash
npm install
npm run dev
```

## Setup rápido

También existe un comando de preparación rápida:

```bash
composer run setup
```

Este comando intenta:

- instalar dependencias,
- crear el `.env` si no existe,
- generar la clave de la aplicación,
- ejecutar migraciones,
- cargar el seeder de estados.

## Estructura relevante

- `JeWeblryStore/routes/web.php` define las rutas públicas y protegidas de la aplicación.
- `JeWeblryStore/app/Http/Controllers/` contiene los controladores.
- `JeWeblryStore/database/migrations/` contiene las tablas de la base de datos.
- `JeWeblryStore/database/seeders/` contiene los datos iniciales.

## Observaciones importantes

- El proyecto se ejecuta desde la carpeta `JeWeblryStore`, no desde la raíz del repositorio.
- La ruta principal para abrir en navegador es `/`.
- Si usas SQLite, asegúrate de que exista `database/database.sqlite` antes de correr migraciones.

## Nota final

Este proyecto está pensado para desarrollarse localmente con Laravel y puede iniciarse con el comando `php artisan serve` en su carpeta principal.
