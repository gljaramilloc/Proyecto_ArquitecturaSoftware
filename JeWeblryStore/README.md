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

## Servicio JSON para el equipo aliado

Exponemos las joyas activas y con stock disponible para que otro equipo las consuma.

- **Método y URL:** `GET {APP_URL}/api/jewels` (en local: `http://localhost:8000/api/jewels`)
- **Autenticación:** no requiere.
- **Respuesta:** `200 OK` con un arreglo JSON (vacío `[]` si no hay joyas disponibles).

### Campos de cada joya

| Campo      | Tipo    | Descripción                                   |
|------------|---------|-----------------------------------------------|
| `id`       | integer | Identificador de la joya                      |
| `name`     | string  | Nombre de la joya                             |
| `price`    | number  | Precio en pesos                               |
| `material` | string  | Material principal                            |
| `stock`    | integer | Unidades disponibles (siempre mayor que 0)    |
| `image`    | string  | URL absoluta de la imagen                     |
| `link`     | string  | Enlace directo a la vista de detalle de la joya |

### Ejemplo de respuesta

```json
[
    {
        "id": 1,
        "name": "Pulsera de plata refinada.",
        "price": 1250,
        "material": "Oro Blanco",
        "stock": 15,
        "image": "http://localhost:8000/storage/jewels/jewel-seed-1.jpg",
        "link": "http://localhost:8000/jewels/1"
    }
]
```

## Vehículos aliados (servicio que consumimos)

La ruta `/vehiculos-aliados` muestra los vehículos de alquiler que publica el equipo aliado en su servicio JSON. Configura su URL en el `.env`:

```bash
ALLIED_SERVICE_URL=http://34.72.8.240/api/vehiculos
ALLIED_SERVICE_TIMEOUT=5
```

El servicio responde un objeto con la lista de vehículos en `data`. De cada vehículo usamos:

| Campo                          | Uso en la vista                          |
|--------------------------------|------------------------------------------|
| `make`, `model`                | Nombre del vehículo                      |
| `category`                     | Etiqueta de categoría                    |
| `location.name`, `location.city` | Sede donde se recoge                   |
| `daily_rate`, `currency`       | Tarifa por día                           |
| `availability`                 | Disponible / no disponible hoy           |
| `detail_url`                   | Enlace al detalle en la tienda aliada    |

Si la URL no está configurada o el servicio no responde, la vista muestra un mensaje de "servicio no disponible" en lugar de fallar.

## Licencia

Este proyecto se distribuye bajo la licencia MIT.
