# Guía de Controladores, Autenticación y Middlewares en Laravel

Esta guía práctica y educativa explica cómo estructurar los controladores y gestionar la autenticación de usuarios siguiendo las directrices de codificación del proyecto (**Coding Guidelines** / **Dictadura del Curso**).

---

## 1. Estándares Obligatorios para Controladores

Cada controlador debe cumplir con las siguientes reglas arquitectónicas:

1. **Tipado Estricto (PHP 8+ / Laravel 10+):** Todos los métodos deben declarar explícitamente los tipos de sus argumentos y el tipo de retorno (`: View`, `: RedirectResponse`, `: JsonResponse`, etc.).
2. **Empaquetado de Datos (`$viewData`):** Todos los datos enviados a una vista deben encapsularse en un único arreglo asociativo llamado `$viewData`.
3. **Aislamiento Visual:** Cero HTML o lógica de presentación dentro del controlador.
4. **Validaciones Delegadas:** No validar datos con `$request->validate()` dentro del método; delegar siempre a clases `FormRequest`.
5. **Uso de Getters / Setters:** Al interactuar con instancias de Modelos, nunca acceder a propiedades directamente (`$user->name` ❌); usar siempre el getter correspondiente (`$user->getName()` ✅).
6. **Código en Inglés:** Nombres de clases, métodos, variables y comentarios deben escribirse en inglés.

---

## 2. Rutas y Sistema de Autenticación (`Auth::routes()`)

En `routes/web.php`, la directiva `Auth::routes()` registra automáticamente las rutas de:
* **Login:** `GET /login` (`login`), `POST /login`
* **Logout:** `POST /logout` (`logout`)
* **Registro:** `GET /register` (`register`), `POST /register`
* **Recuperación de Contraseña:** `password.request`, `password.email`, `password.reset`, etc.

### Configuración en [JeWeblryStore/routes/web.php](JeWeblryStore/routes/web.php)
```php
<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Rutas estáticas públicas
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');

// Rutas de autenticación
Auth::routes();
```

---

## 3. Cómo Comprobar si el Usuario está Autenticado

Existen tres formas estándar y limpias de verificar las credenciales y el estado de la sesión:

### Forma 1: Middleware en las Rutas (`routes/web.php`) — *Recomendada para grupos*
Se utiliza el middleware nativo `auth` para interceptar la petición antes de que llegue al controlador. Si el usuario no ha iniciado sesión, Laravel lo redirige automáticamente al formulario de login.

```php
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

// 1. Ruta individual protegida
Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile.index')
    ->middleware('auth');

// 2. Grupo de rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});
```

---

### Forma 2: Middleware en el Constructor del Controlador — *Recomendada para controladores dedicados*
Permite definir dentro de la clase del controlador qué acciones requieren autenticación mediante `$this->middleware('auth')`.

```php
<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        // Protege TODOS los métodos de este controlador
        $this->middleware('auth');
    }

    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'My Profile - Online Store';

        return view('profile.index')->with('viewData', $viewData);
    }
}
```

#### Protección selectiva con `only` o `except`:
```php
public function __construct()
{
    // Solo requiere login para crear, guardar o eliminar
    $this->middleware('auth')->only(['create', 'store', 'destroy']);

    // O alternativamente: requiere login para todo EXCEPTO index y show
    // $this->middleware('auth')->except(['index', 'show']);
}
```

---

### Forma 3: Verificación Manual en el Código (Lógica Condicional)
Cuando un método es accesible para todo público pero debe ejecutar una lógica diferente si el usuario está conectado:

```php
use Illuminate\Support\Facades\Auth;

// Comprobar si hay una sesión activa
if (Auth::check()) {
    // Obtener la instancia del modelo User
    /** @var \App\Models\User $user */
    $user = Auth::user();

    // Acceso mediante getters obligatorios
    $userName = $user->getName();
    $userEmail = $user->getEmail();
}
```

---

## 4. Ejemplos Prácticos Completos

### Ejemplo A: Controlador Público ([JeWeblryStore/app/Http/Controllers/HomeController.php](JeWeblryStore/app/Http/Controllers/HomeController.php))
```php
<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = 'Home Page - Online Store';

        return view('home.index')->with('viewData', $viewData);
    }

    public function about(): View
    {
        $viewData = [];
        $viewData['title'] = 'About us - Online Store';
        $viewData['subtitle'] = 'About us';
        $viewData['description'] = 'This is an about page ...';
        $viewData['author'] = 'Developed by: Gisel Jaramillo';

        return view('home.about')->with('viewData', $viewData);
    }

    public function contact(): View
    {
        $viewData = [];
        $viewData['title'] = 'Contact - Online Store';
        $viewData['subtitle'] = 'Contact';
        $viewData['email'] = 'contact@jewelstore.com';
        $viewData['address'] = '355 Medellín, Colombia';
        $viewData['phone'] = '+49 123 456 789';

        return view('home.contact')->with('viewData', $viewData);
    }
}
```

---

### Ejemplo B: Controlador Protegido por Autenticación (`OrderController`)
```php
<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $viewData = [];
        $viewData['title'] = 'My Orders - Online Store';
        $viewData['orders'] = Order::where('user_id', $user->getId())->get();

        return view('orders.index')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $order = Order::findOrFail($id);

        $viewData = [];
        $viewData['title'] = 'Order Details #' . $order->getId();
        $viewData['order'] = $order;

        return view('orders.show')->with('viewData', $viewData);
    }
}
```

---

### Ejemplo C: Verificación de Usuario en Vistas Blade ([JeWeblryStore/resources/views/layouts/app.blade.php](JeWeblryStore/resources/views/layouts/app.blade.php))

En las vistas Blade, se emplean las directivas `@guest` y `@auth`. Siempre se debe utilizar el método getter (`getName()`) para leer datos del usuario:

```blade
<!-- Menú de Autenticación en la Barra de Navegación -->
<ul class="navbar-nav ms-auto">
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                {{ Auth::user()->getName() }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
```

---

## 5. Resumen Rápido de Buenas Prácticas

| Tarea | Forma Correcta | Forma Incorrecta (Penalizable) |
| :--- | :--- | :--- |
| **Proteger ruta** | `Route::get(...)->middleware('auth');` | Verificar manualmente en cada vista con `if` |
| **Proteger controlador** | `$this->middleware('auth');` en `__construct()` | Dejar métodos públicos sin validación |
| **Pasar datos a vista** | `return view('...')->with('viewData', $viewData);` | `return view('...', compact('user', 'orders'));` |
| **Tipado de retorno** | `public function index(): View` | `public function index()` |
| **Leer nombre de usuario** | `Auth::user()->getName()` | `Auth::user()->name` |
| **Leer ID de usuario** | `Auth::user()->getId()` | `Auth::user()->id` |
