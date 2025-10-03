<?php
declare(strict_types=1);

// Autoload PSR-4 (App\Foo\Bar ⇒ app/Foo/Bar.php)
// Sirve para cargar automáticamente las clases del namespace App\ desde la carpeta app/ siguiendo la convención PSR-4 sin necesidad de hacer require manual.
// Ej. Cuando instancias una clase como App\Models\User, PHP no necesita un require; el autoloader busca y carga automáticamente el archivo app/Models/User.php.
spl_autoload_register(function (string $class): void {

  // Prefijo de los namespaces que queremos manejar
  $prefix = 'App\\';

  // 1. Verifica si la clase comienza con el prefijo "App\" (que queremos manejar), permitiendo coexsitencia si hay más apps en este directorio
  if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
    return;

  }

  // 2. Obtiene el nombre de clase relativo, quitando el prefijo "App\"
  $relative = substr($class, strlen($prefix));

  // 3. Convierte los backslashes de namespace "\" en "/" para formar la ruta de archivo
  $path = __DIR__ . '/app/' . str_replace('\\', '/', $relative) . '.php';

  // 4. Si el archivo existe en esa ruta, lo incluye
  if (is_file($path)) {
    require $path;

  }
});


// Ok del Autoload -> Cargamos el núcleo mínimo
require_once __DIR__ . '/app/Core/Session.php';
require_once __DIR__ . '/app/Core/Router.php';

// Entorno consistente (fechas/logs)
date_default_timezone_set('Europe/Madrid');

use App\Core\Session;
use App\Core\Router;

// Sesión (estado + expiración por inactividad)
Session::start([
  'save_path' => __DIR__ . '/storage/sessions', // fuera de public/
  'lifetime_minutes' => 30,
]);

// Routing (?action=controlador.metodo). Por defecto: home.index
$router = new Router(__DIR__);
$router->dispatch($_GET['action'] ?? 'home.index');
