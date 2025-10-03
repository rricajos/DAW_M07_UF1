<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;

/**
 * Controlador de la página de inicio.
 * 
 * Muestra la vista principal (`home/index.php`), pasando información
 * sobre el usuario autenticado (si existe).
 */
final class HomeController extends Controller
{
  /**
   * Acción por defecto: renderiza la página de inicio.
   * 
   * Flujo:
   * 1. Obtiene el usuario autenticado desde la sesión (si lo hay).
   * 2. Renderiza la vista `home/index.php` con:
   *    - `auth`: datos del usuario en sesión (o null si no hay).
   *    - `title`: título de la página ("Inicio").
   */
  public function index(): void
  {
    // 1) Recupera información del usuario en sesión
    $auth = Session::user();

    // 2) Renderiza la vista con los datos
    $this->view('home/index.php', [
      'auth' => $auth,
      'title' => 'Inicio'
    ]);
  }
}
