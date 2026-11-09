# Proyecto_ArquitecturaSoftware Entregable I

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


# Proyecto_ArquitecturaSoftware Entregable II

## Configuración de Docker Compose

### Ejecución en local con Docker Compose

El proyecto incluye un `Dockerfile` y un `docker-compose.yml` que levantan la aplicación junto con una base de datos MySQL, sin necesidad de instalar PHP, Composer ni MySQL de forma manual.

### Requisitos previos

- Docker Desktop instalado y en ejecución.
- Git.

### Pasos para levantar el proyecto

1. Clonar el repositorio y entrar a la carpeta del proyecto:

```bash
git clone https://github.com/gljaramilloc/Proyecto_ArquitecturaSoftware.git
cd Proyecto_ArquitecturaSoftware/JeWeblryStore
```

2. Construir y levantar los contenedores (app + base de datos):

```bash
docker compose up --build -d
```

> La primera vez tarda varios minutos (construye la imagen e instala dependencias). Las migraciones y el `StatusSeeder` se ejecutan automáticamente al arrancar.

3. Cargar los datos de ejemplo (categorías, joyas, usuarios, etc.):

```bash
docker compose exec app php artisan db:seed --force
```

4. Abrir la aplicación en el navegador:

```
http://localhost:8080
```

### Credenciales de administrador (datos de ejemplo)

- Correo: `admin@jeweblrystore.com`
- Contraseña: la definida en `database/seeders/UserSeeder.php`

### Comandos útiles

```bash
# Ver el estado de los contenedores
docker compose ps

# Ver logs de la aplicación
docker compose logs -f app

# Ejecutar comandos de Artisan dentro del contenedor
docker compose exec app php artisan <comando>

# Detener los contenedores (conserva la base de datos)
docker compose down

# Detener y borrar también la base de datos local
docker compose down -v
```

### Notas del entorno local

- La aplicación se expone en el puerto **8080** del host.
- La base de datos MySQL se expone en el puerto **3307** del host (se usa 3307 en lugar de 3306 para evitar conflictos con un MySQL ya instalado en la máquina).
- `FILESYSTEM_DISK=public`: en local las imágenes se guardan en el almacenamiento del contenedor (no se usa Google Cloud Storage).
- `APP_URL=http://localhost:8080`: necesario para que las URLs de las imágenes se generen con el puerto correcto.

## Documentación del contrato Json

### Requisitos locales

- PHP 8.3+
- Composer
- Node.js y npm
- SQLite o tu base de datos local configurada

### Inicio del proyecto para desarrollo local

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

### Setup rápido del proyecto

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

### Regla de desarrollo para estados

Cuando un modelo tenga una relación con `statuses`, los valores base deben agregarse dentro del seeder inicial y no dentro de la migración. La migración solo crea la estructura; el seeder inicializa los datos de dominio.

### Arquitectura relevante

- Las tablas de dominio se crean con migraciones.
- Los datos iniciales, como estados, roles o categorías base, van en seeders.
- El script `composer run setup` debe dejar el proyecto listo para desarrollo sin pasos extra.

### Servicio JSON para el equipo aliado

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

### Productos aliados (servicio que consumimos)

La ruta `/productos-aliados` muestra los productos del servicio JSON del equipo aliado. Configura su URL en el `.env`:

```bash
ALLIED_SERVICE_URL=https://url-del-equipo-aliado/api/productos
ALLIED_SERVICE_TIMEOUT=5
```

Si la URL no está configurada o el servicio no responde, la vista muestra un mensaje de "servicio no disponible" en lugar de fallar.

### Licencia

Este proyecto se distribuye bajo la licencia MIT.

