# Guías de Estilo de Programación y Formateo de Código

Este documento describe los estándares obligatorios de arquitectura, diseño, convención de nombres y estilo de código que rigen el proyecto, basados en los lineamientos de la "Dictadura del Curso" definidos en [JeWeblryStore/AGENTS.md](JeWeblryStore/AGENTS.md), así como las instrucciones de formateo con Laravel Pint.

---

## 1. Convenciones y Estándares de Arquitectura (MVC)

### 1.1. Rutas ([JeWeblryStore/routes/web.php](JeWeblryStore/routes/web.php))
* **Responsabilidad Única:** Las rutas únicamente deben actuar como enrutadores hacia métodos de controladores.
* **Prohibición de Lógica:** Queda estrictamente prohibido incluir lógica de negocio, closures, cálculos o retornos directos de vistas dentro del archivo de rutas.
* **Sintaxis y Consistencia:** Se debe mantener un único estilo uniforme para declarar rutas en todo el proyecto. Si se usan tuplas de array (`[Controller::class, 'method']`) o sintaxis string con namespace completo, no se deben mezclar estilos sin justificación.
* **CRUD Estándar:** Se recomienda el uso de `Route::resource()` siempre que se cumpla el ciclo de 5 operaciones básicas (`index`, `create`, `store`, `show`, `destroy`).

---

### 1.2. Controladores ([JeWeblryStore/app/Http/Controllers](JeWeblryStore/app/Http/Controllers))
* **Aislamiento Visual:** El controlador no debe contener elementos visuales, etiquetas HTML ni lógica de presentación.
* **Empaquetado de Datos:** Todos los datos enviados a una vista deben encapsularse dentro de un único arreglo asociativo (por convención `$viewData`).
* **Tipado Estricto (Type Hinting):** Todos los métodos deben declarar explícitamente los tipos de sus argumentos y el tipo de retorno (`View`, `RedirectResponse`, etc.).
* **Validación Delegada:** Las validaciones de formularios deben desacoplarse usando clases `Form Request` (`App\Http\Requests\...`), evitando validaciones inline manuales.
* **Nomenclatura y DRY:** Nombres de variables descriptivos y autoexplicativos (evitar `$data`). Si dos controladores repiten lógica, se debe extraer a una clase o servicio compartido.
* **Importaciones:** Usar directivas `use` al inicio del archivo para todos los modelos, requests y clases utilizadas.

---

### 1.3. Modelos y Encapsulamiento (CRÍTICO) ([JeWeblryStore/app/Models](JeWeblryStore/app/Models))
* **Docblock `@property` Obligatorio:** En la cabecera de cada modelo debe existir un docblock detallando cada columna y tipo de dato.
* **Getters y Setters para TODO Atributo:** Se deben definir métodos `get` y `set` tradicionales para cada atributo (incluyendo obligatoriamente `createdAt`, `updatedAt` y llaves foráneas).
* **Regla de Oro (Acceso Restringido):** Queda estrictamente prohibido el acceso directo a propiedades de un modelo (`$model->attribute`). Cualquier acceso o modificación debe realizarse mediante `$model->getAttribute()` o `$model->setAttribute(...)`.
* **Asignación Masiva:** Definir siempre de forma explícita la propiedad `$fillable` (o `$guarded`).
* **Encapsulamiento de Relaciones:** Al definir y consumir relaciones (`hasMany`, `belongsTo`, etc.), se debe proveer y utilizar un método getter explícito (ejemplo: `getComments()`, `getJewels()`) en lugar de acceder a la propiedad mágica de Eloquent.
* **Prevención N+1:** Usar siempre carga ansiosa (`with([...])`) en consultas donde se vayan a iterar relaciones.

---

### 1.4. Vistas Blade ([JeWeblryStore/resources/views](JeWeblryStore/resources/views))
* **Uso Exclusivo de Blade:** Prohibido escribir código PHP puro (`<?php ... ?>`). Utilizar directivas Blade (`@foreach`, `@if`, `@extends`, etc.).
* **Lectura Controlada de Modelos:** En las vistas SIEMPRE se debe invocar el getter del modelo (ejemplo: `{{ $jewel->getName() }}` en lugar de `{{ $jewel->name }}`).
* **Internacionalización (i18n):** Ningún texto estático debe estar quemado en el HTML. Se deben utilizar archivos de traducción con la función `__('file.key')` o directiva `@lang('file.key')`.

---

## 2. Reglas Generales de Código

* **Idioma Inglés:** Todo el código fuente (nombres de clases, métodos, variables, atributos y comentarios de código) debe estar escrito en inglés.
* **Convención de Casing:**
  * **Clases:** `PascalCase` en singular (ej. `JewelController`, `Category`).
  * **Métodos y Funciones:** `camelCase` (ej. `getTotalPrice()`, `store()`).
  * **Variables y Atributos:** `camelCase` (ej. `$viewData`, `$orderItems`).
  * **Tablas y Columnas en Base de Datos:** `snake_case` (ej. `order_items`, `created_at`).
* **Seguridad:** Consultas a base de datos realizadas exclusivamente con Eloquent ORM o Query Builder con parámetros enlazados (PDO bindings). Prohibida la concatenación directa de cadenas en sentencias SQL.

---

## 3. Formateo Automatizado con Laravel Pint

El proyecto utiliza **Laravel Pint** para asegurar el cumplimiento de los estándares de estilo PHP (PSR-12 / Laravel Preset).

### 3.1. Requisitos Previos
Ubicarse dentro del directorio de la aplicación Laravel:
```bash
cd JeWeblryStore
```

### 3.2. Comandos de Ejecución

#### A. Revisar estilo sin aplicar cambios (Dry Run / Test)
Para validar si el código cumple las reglas de formato sin modificar ningún archivo:
```bash
./vendor/bin/pint --test
```

#### B. Formatear automáticamente todo el proyecto
Para corregir automáticamente el estilo en todos los archivos de la aplicación:
```bash
./vendor/bin/pint
```

#### C. Formatear solo archivos con cambios sin confirmar (Git Dirty)
Para formatear únicamente los archivos modificados localmente:
```bash
./vendor/bin/pint --dirty
```

#### D. Formatear un archivo o directorio específico
Para limitar la ejecución a una carpeta o clase concreta:
```bash
# Formatear todos los modelos
./vendor/bin/pint app/Models

# Formatear todos los controladores
./vendor/bin/pint app/Http/Controllers

# Formatear un archivo específico
./vendor/bin/pint app/Models/Jewel.php
```

#### E. Modo detallado (Verbose)
Para visualizar exactamente qué reglas o líneas fueron ajustadas:
```bash
./vendor/bin/pint -v
```

---

## 4. Checklist de Evaluación y Penalizaciones

Antes de enviar cambios o realizar un commit, verificar:

| Criterio | Impacto de Penalización | Verificación |
| :--- | :--- | :--- |
| **Docblock `@property`** | -0.2 puntos | ¿El modelo incluye el docblock con todas sus propiedades y tipos al inicio? |
| **Getters y Setters** | -0.4 puntos | ¿Todos los atributos (incluyendo `createdAt` y `updatedAt`) tienen `get` y `set`? |
| **Acceso a Atributos** | Reducción constante | ¿Se está accediendo al modelo usando getters tanto en controladores como en vistas? |
| **Rutas limpias** | Falta grave | ¿Las rutas solo apuntan a controladores sin closures ni lógica? |
| **Datos a Vistas** | Falta grave | ¿Los datos enviados a la vista están encapsulados en un único arreglo `$viewData`? |
| **Form Request** | Falta grave | ¿La validación de formularios está delegada en una clase `Form Request`? |
| **Laravel Pint** | Estilo | ¿Se ejecutó `./vendor/bin/pint` y no hay errores de formato? |
