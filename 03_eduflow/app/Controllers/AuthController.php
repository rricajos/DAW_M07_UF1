<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;

/**
 * Controlador de autenticación.
 * 
 * Gestiona el inicio de sesión, cierre de sesión y la vista del formulario
 * de login. Extiende de la clase base `Controller` para poder usar helpers
 * como `view()` y `redirect()`.
 */
final class AuthController extends Controller
{
  /**
   * Muestra el formulario de login.
   */
  public function loginForm(): void
  {
    // Renderiza la vista "auth/login.php" con el título "Acceso"
    $this->view('auth/login.php', ['title' => 'Acceso']);
  }

  /**
   * Procesa el envío del formulario de login.
   * Valida credenciales contra usuarios reales (JSON) o cuentas demo.
   */
  public function doLogin(): void
  {
    // Asegura que el método sea POST; si no, redirige al formulario
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
      $this->redirect('auth.loginForm');
    }

    // Obtiene campos enviados: usuario y contraseña
    // "username" puede ser un ID o "Nombre Apellidos"
    $userField = trim($_POST['username'] ?? '');
    $pass = (string) ($_POST['password'] ?? '');

    // 1) Intento con usuarios reales (almacenados en users.json)
    $repo = new \App\Models\User($this->basePath . '/storage/data/users.json');
    $u = $repo->findForLogin($userField);

    if ($u && isset($u['password']) && hash_equals((string) $u['password'], $pass)) {
      // Construye el nombre a mostrar (first_name + last_name o "usuario")
      $displayName = trim(($u['first_name'] ?? '') . ' ' . ($u['last_name'] ?? '')) ?: 'usuario';
      // Rol del usuario: admin | profesor | estudiante (default: estudiante)
      $role = (string) ($u['profile'] ?? 'estudiante');

      // Inicia sesión con la info obtenida
      Session::login($displayName, $role, (string) ($u['id'] ?? null));
      $this->redirect('home.index'); // redirige a la home
    }

    // 2) Fallback: cuentas demo predefinidas (admin, prof, estu)
    $validUsers = ['admin', 'prof', 'estu'];
    if (in_array($userField, $validUsers, true) && $pass === 'abcdef') {
      // Aquí Session::login infiere el rol según el usuario
      Session::login($userField);
      $this->redirect('home.index');
    }

    // 3) Si nada funcionó → mostrar error
    $this->view('auth/login.php', [
      'title' => 'Acceso',
      'error' => 'Usuario o contraseña incorrectos',
      // Mantiene el valor del campo username para no obligar a reescribirlo
      'old' => ['username' => htmlspecialchars($userField, ENT_QUOTES)]
    ]);
  }

  /**
   * Cierra la sesión y redirige al formulario de login.
   */
  public function logout(): void
  {
    Session::logout();               // destruye la sesión
    $this->redirect('auth.loginForm'); // vuelve al login
  }
}
