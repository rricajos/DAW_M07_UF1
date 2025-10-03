<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\User;

/**
 * Controlador del panel de administración.
 *
 * Solo accesible para usuarios autenticados con rol "admin".
 * Permite listar los usuarios registrados en el sistema.
 */
final class DashboardController extends Controller
{
  /**
   * Muestra la vista principal del panel de administración.
   * 
   * Flujo:
   * 1. Verifica que el usuario esté autenticado y que tenga rol de "admin".
   * 2. Obtiene la lista de usuarios desde el repositorio JSON.
   * 3. Recupera un mensaje flash de la sesión (si existe).
   * 4. Renderiza la vista `dashboard/index.php` con los datos obtenidos.
   */
  public function index(): void
  {
    // 1) Seguridad: requiere sesión iniciada y rol "admin"
    Session::requireAuth();
    Session::requireRole('admin');

    // 2) Repositorio de usuarios basado en archivo JSON
    $repo = new User($this->basePath . '/storage/data/users.json');
    $users = $repo->all();

    // 3) Recupera mensaje flash (si existe) y lo elimina de la sesión
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);

    // 4) Renderiza la vista con título, lista de usuarios y mensaje flash
    $this->view('dashboard/index.php', [
      'title' => 'Panel',
      'users' => $users,
      'flash' => $flash
    ]);
  }
}
