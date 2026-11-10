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

3. Ejecuta las migraciones, los seeders y enlaza el almacenamiento público de imágenes:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

### Credenciales de demostración (generadas por `DatabaseSeeder`)

- **Administrador:** `admin@jeweblrystore.com` / `password`
- **Cliente:** `customer@jeweblrystore.com` / `password`

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
| `price`    | number  | Precio base en dólares estadounidenses (`USD`) |
| `material` | string  | Material principal                            |
| `stock`    | integer | Unidades disponibles (siempre mayor que 0)    |
| `image`    | string  | URL absoluta de la imagen                     |
| `link`     | string  | Enlace directo a la vista de detalle de la joya |

### Ejemplo de respuesta

```json
[
    {
        "id": 1,
        "name": "Muzo Imperial Emerald Solitaire Ring",
        "price": 3850,
        "material": "18k Yellow Gold",
        "stock": 9,
        "image": "http://localhost:8000/storage/jewels/jewel-seed-2.jpg",
        "link": "http://localhost:8000/jewels/1"
    }
]
```

## Productos aliados (servicio que consumimos)

La ruta `/productos-aliados` muestra los productos del servicio JSON del equipo aliado. Configura su URL en el `.env`:

```bash
ALLIED_SERVICE_URL=https://url-del-equipo-aliado/api/productos
ALLIED_SERVICE_TIMEOUT=5
```

Si la URL no está configurada o el servicio no responde, la vista muestra un mensaje de "servicio no disponible" en lugar de fallar.

## API de un tercero: Tasa de Cambio (TRM USD → COP)

La tienda consulta en tiempo real la tasa representativa del mercado (`USD → COP`) mediante el servicio público gratuito `ExchangeRate-API` (sin clave de API), cachea la cotización durante 1 hora y muestra el equivalente informativo en pesos colombianos (`COP`) en inicio, catálogo, categorías, detalle, carrito y pago:

```bash
EXCHANGE_RATE_API_URL=https://open.er-api.com/v6/latest/USD
EXCHANGE_RATE_API_TIMEOUT=5
EXCHANGE_RATE_CACHE_TTL=3600
```

Si el servicio externo falla o se deja `EXCHANGE_RATE_API_URL=""`, la aplicación opera normalmente en `USD` mostrando un aviso traducido de disponibilidad y aplica un enfriamiento corto en caché para evitar tiempos de espera repetidos.

## Licencia

Este proyecto se distribuye bajo la licencia MIT.
