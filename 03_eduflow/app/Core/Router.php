<?php
namespace App\Core;

final class Router
{
  private string $basePath;

  public function __construct(string $basePath)
  {
    $this->basePath = $basePath;
    // Ya no registramos autoload aquí.
    require_once __DIR__ . '/Controller.php'; // base Controller
  }

  public function dispatch(string $action): void
  {
    $map = [
      'home.index' => ['App\Controllers\HomeController', 'index'],
      'auth.loginForm' => ['App\Controllers\AuthController', 'loginForm'],
      'auth.doLogin' => ['App\Controllers\AuthController', 'doLogin'],
      'auth.logout' => ['App\Controllers\AuthController', 'logout'],
      'dashboard.index' => ['App\Controllers\DashboardController', 'index'],
      'user.create' => ['App\Controllers\UserController', 'create'],
      'user.confirm' => ['App\Controllers\UserController', 'confirm'],
      'user.store' => ['App\Controllers\UserController', 'store'],
      'user.bulkDelete' => ['App\Controllers\UserController', 'bulkDelete'],
      'user.seed' => ['App\Controllers\UserController', 'seed'],
      'user.bulkRole' => ['App\Controllers\UserController', 'bulkRole'],

      // Calendario y tareas
      'calendar.week' => ['App\Controllers\CalendarController', 'week'],
      'task.index' => ['App\Controllers\TaskController', 'index'],
      'task.create' => ['App\Controllers\TaskController', 'create'],
      'task.store' => ['App\Controllers\TaskController', 'store'],
      'task.edit' => ['App\Controllers\TaskController', 'edit'],
      'task.update' => ['App\Controllers\TaskController', 'update'],
      'task.delete' => ['App\Controllers\TaskController', 'delete'],
    ];

    if (!isset($map[$action])) {
      http_response_code(404);
      echo "404 Not Found";
      return;
    }

    [$class, $method] = $map[$action];

    // Defensa extra: verifica que el autoload encontró la clase
    if (!class_exists($class)) {
      http_response_code(500);
      echo "Autoload no encontró la clase: $class";
      return;
    }

    $controller = new $class($this->basePath);
    $controller->$method();
  }
}
