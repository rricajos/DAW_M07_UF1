<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\User;
use App\Services\AgeLabelService;

/**
 * Controlador de usuarios.
 *
 * Flujo de alta con confirmación en dos pasos:
 *  - create()  → muestra el formulario y repuebla si hubo errores previos.
 *  - confirm() → valida inputs; si ok, muestra pantalla de confirmación.
 *  - store()   → persiste el usuario confirmado y muestra “creado”.
 *
 * También incluye acciones masivas: eliminación y cambio de rol.
 * Todas las acciones requieren autenticación y rol admin.
 */
final class UserController extends Controller
{
  /**
   * Muestra el formulario de creación de usuario.
   * Repuebla con datos previos guardados en sesión (form_user), si existen.
   */
  public function create(): void
  {
    Session::requireAuth();
    Session::requireRole('admin');

    $this->view('users/create.php', [
      'title' => 'Crear usuario',
      'old' => $_SESSION['form_user'] ?? []
    ]);
  }

  /**
   * Valida los datos enviados y, si son correctos,
   * muestra la vista de confirmación. Si hay errores,
   * re-renderiza el formulario con errores y valores previos.
   */
  public function confirm(): void
  {
    Session::requireAuth();
    Session::requireRole('admin');

    if (!$this->isPost())
      $this->redirect('user.create');

    $payload = [
      'first_name' => trim($_POST['first_name'] ?? ''),
      'last_name' => trim($_POST['last_name'] ?? ''),
      'age' => (int) ($_POST['age'] ?? 0),
      'profile' => trim($_POST['profile'] ?? ''), // estudiante | profesor | admin
      'password' => (string) ($_POST['password'] ?? ''),
    ];

    // Validación de negocio
    $errors = $this->validate($payload);

    if ($errors) {
      // Guardar para repoblar el formulario
      $_SESSION['form_user'] = $payload;
      $this->view('users/create.php', [
        'title' => 'Crear usuario',
        'old' => $payload,
        'errors' => $errors
      ]);
      return;
    }

    // OK: pasar a confirmación
    $_SESSION['confirm_user'] = $payload;
    $this->view('users/confirm.php', [
      'title' => 'Confirmar datos',
      'user' => $payload
    ]);
  }

  /**
   * Persiste el usuario confirmado.
   * - Si viene “cancel”, vuelve al formulario con los datos previos.
   * - Si no hay datos en confirm_user, redirige a create.
   * - Inserta en storage (users.json) y muestra la vista “created”.
   */
  public function store(): void
  {
    Session::requireAuth();
    Session::requireRole('admin');

    if (isset($_POST['cancel'])) {
      // Volver a edición conservando inputs
      $_SESSION['form_user'] = $_SESSION['confirm_user'] ?? [];
      unset($_SESSION['confirm_user']);
      $this->redirect('user.create');
    }

    $data = $_SESSION['confirm_user'] ?? null;
    if (!$data)
      $this->redirect('user.create');

    // Persistencia
    $repo = new User($this->basePath . '/storage/data/users.json');
    $id = $repo->insert($data);

    // Etiqueta informativa por edad (p. ej., “menor”, “adulto”, etc.)
    $label = AgeLabelService::labelForAge((int) $data['age']);

    // Limpiar estado del flujo
    unset($_SESSION['confirm_user'], $_SESSION['form_user']);

    $this->view('users/created.php', [
      'title' => 'Usuario creado',
      'id' => $id,
      'user' => $data,
      'label' => $label
    ]);
  }

  /**
   * Valida un array de datos de usuario.
   *
   * @param array $u Datos del usuario (first_name, last_name, age, profile, password)
   * @return array Errores en formato campo => mensaje
   */
  private function validate(array $u): array
  {
    $err = [];
    if ($u['first_name'] === '')
      $err['first_name'] = 'Nombre requerido';
    if ($u['last_name'] === '')
      $err['last_name'] = 'Apellidos requeridos';
    if ($u['age'] < 12 || $u['age'] > 120)
      $err['age'] = 'Edad inválida (>=12)';
    if (!in_array($u['profile'], ['estudiante', 'profesor', 'admin'], true))
      $err['profile'] = 'Perfil inválido';
    if (strlen($u['password']) < 6)
      $err['password'] = 'Contraseña mínima 6 caracteres';
    return $err;
  }

  /**
   * Eliminación masiva de usuarios por id.
   * Espera un POST con ids[] y muestra un flash con el resultado.
   */
  public function bulkDelete(): void
  {
    Session::requireAuth();
    Session::requireRole('admin');

    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
      $this->redirect('dashboard.index');
    }

    $ids = $_POST['ids'] ?? [];
    if (!is_array($ids))
      $ids = [];

    $repo = new User($this->basePath . '/storage/data/users.json');
    $count = $repo->deleteMany($ids);

    $_SESSION['flash'] = $count > 0
      ? "Se eliminaron {$count} usuario(s)."
      : "No se eliminó ningún usuario.";

    $this->redirect('dashboard.index');
  }

  /**
   * Crea usuarios de prueba (seed).
   * Inserta 3 plantillas predefinidas y muestra flash de confirmación.
   */
  public function seed(): void
  {
    Session::requireAuth();
    Session::requireRole('admin');

    $repo = new User($this->basePath . '/storage/data/users.json');

    $templates = [
      [
        'first_name' => 'Juan',
        'last_name' => 'Pérez',
        'age' => 15,
        'profile' => 'estudiante',
        'password' => '123456',
      ],
      [
        'first_name' => 'Ana',
        'last_name' => 'García',
        'age' => 17,
        'profile' => 'estudiante',
        'password' => 'abcdef',
      ],
      [
        'first_name' => 'Luis',
        'last_name' => 'Martínez',
        'age' => 35,
        'profile' => 'profesor',
        'password' => 'qwerty',
      ],
    ];

    foreach ($templates as $tpl) {
      $repo->insert($tpl);
    }

    $_SESSION['flash'] = "Se generaron 3 usuarios de plantilla.";
    $this->redirect('dashboard.index');
  }

  /**
   * Cambio masivo de rol.
   * Espera POST con ids[] y role. Valida el rol, aplica el cambio y
   * muestra un flash con el total actualizado.
   */
  public function bulkRole(): void
  {
    Session::requireAuth();
    Session::requireRole('admin');

    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
      $this->redirect('dashboard.index');
    }

    $ids = $_POST['ids'] ?? [];
    if (!is_array($ids))
      $ids = [];

    $role = trim($_POST['role'] ?? '');
    $allowed = ['admin', 'profesor', 'estudiante'];
    if (!in_array($role, $allowed, true)) {
      $_SESSION['flash'] = 'Rol inválido.';
      $this->redirect('dashboard.index');
    }

    $repo = new User($this->basePath . '/storage/data/users.json');
    $count = $repo->updateRoleMany($ids, $role);

    $_SESSION['flash'] = $count > 0
      ? "Rol cambiado a '{$role}' para {$count} usuario(s)."
      : "No se actualizó ningún usuario.";
    $this->redirect('dashboard.index');
  }
}
