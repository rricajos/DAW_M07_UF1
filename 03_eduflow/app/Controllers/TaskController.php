<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Task;

/**
 * Controlador de Tareas.
 *
 * Gestiona el CRUD de tareas:
 * - Listar todas las tareas
 * - Crear nuevas tareas (solo profesores y admin)
 * - Editar/actualizar tareas existentes
 * - Eliminar tareas
 */
final class TaskController extends Controller
{
  /**
   * Devuelve el repositorio de tareas (JSON).
   */
  private function repo(): Task
  {
    return new Task($this->basePath . '/storage/data/tasks.json');
  }

  /**
   * Lista todas las tareas.
   * Solo accesible si hay sesión iniciada.
   */
  public function index(): void
  {
    Session::requireAuth();
    $tasks = $this->repo()->all();
    $this->view('tasks/index.php', [
      'title' => 'Tareas',
      'tasks' => $tasks,
      'role' => Session::role(),
    ]);
  }

  /**
   * Muestra el formulario para crear una nueva tarea.
   * Solo profesores y administradores pueden acceder.
   */
  public function create(): void
  {
    Session::requireAuth();
    if (!in_array(Session::role(), ['profesor', 'admin'], true)) {
      $this->redirect('task.index');
    }
    $this->view('tasks/create.php', ['title' => 'Nueva tarea']);
  }

  /**
   * Procesa el formulario de creación de tareas.
   * Solo profesores y administradores pueden crear.
   */
  public function store(): void
  {
    Session::requireAuth();
    if (!in_array(Session::role(), ['profesor', 'admin'], true)) {
      $this->redirect('task.index');
    }
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST')
      $this->redirect('task.index');

    $payload = [
      'title' => trim($_POST['title'] ?? ''),
      'due_date' => trim($_POST['due_date'] ?? ''),
      'description' => trim($_POST['description'] ?? ''),
    ];

    // Validación simple
    if ($payload['title'] === '' || $payload['due_date'] === '') {
      $_SESSION['flash'] = 'Título y fecha son obligatorios';
      $this->redirect('task.create');
    }

    $this->repo()->insert($payload);
    $_SESSION['flash'] = 'Tarea creada';
    $this->redirect('task.index');
  }

  /**
   * Muestra el formulario de edición de una tarea.
   * Valida que el usuario tenga permisos y que la tarea exista.
   */
  public function edit(): void
  {
    Session::requireAuth();
    if (!in_array(Session::role(), ['profesor', 'admin'], true)) {
      $this->redirect('task.index');
    }

    $id = $_GET['id'] ?? '';
    $task = $this->repo()->find((string) $id);

    if (!$task) {
      $_SESSION['flash'] = 'Tarea no encontrada';
      $this->redirect('task.index');
    }

    // Recuperar errores/datos previos de la sesión
    $errors = $_SESSION['form_errors'] ?? [];
    $old = $_SESSION['form_old'] ?? [];
    unset($_SESSION['form_errors'], $_SESSION['form_old']);

    // Repoblar campos si hubo error
    if ($old)
      $task = array_merge($task, $old);

    $this->view('tasks/edit.php', [
      'title' => 'Editar tarea',
      'task' => $task,
      'errors' => $errors,
    ]);
  }

  /**
   * Procesa la actualización de una tarea existente.
   * Valida campos y gestiona errores con mensajes de sesión.
   */
  public function update(): void
  {
    Session::requireAuth();
    if (!in_array(Session::role(), ['profesor', 'admin'], true)) {
      $this->redirect('task.index');
    }
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST')
      $this->redirect('task.index');

    $id = trim($_POST['id'] ?? '');
    $data = [
      'title' => trim($_POST['title'] ?? ''),
      'due_date' => trim($_POST['due_date'] ?? ''),
      'description' => trim($_POST['description'] ?? ''),
    ];

    // Validación
    $errors = [];
    if ($data['title'] === '')
      $errors['title'] = 'El título es obligatorio';
    if ($data['due_date'] === '')
      $errors['due_date'] = 'La fecha de entrega es obligatoria';
    if ($data['due_date'] !== '' && strtotime($data['due_date']) < strtotime(date('Y-m-d'))) {
      $errors['due_date'] = 'La fecha debe ser hoy o posterior';
    }

    // Si hay errores, guardarlos en sesión y redirigir
    if ($errors) {
      $_SESSION['form_errors'] = $errors;
      $_SESSION['form_old'] = $data;
      $this->redirect('task.edit&id=' . urlencode($id));
    }

    // Intentar actualizar
    $ok = $id && $this->repo()->update($id, $data);
    $_SESSION['flash'] = $ok ? 'Tarea actualizada' : 'No se pudo actualizar';
    $this->redirect('task.index');
  }

  /**
   * Elimina una tarea existente.
   * Solo accesible por POST y con rol de profesor/admin.
   */
  public function delete(): void
  {
    Session::requireAuth();
    if (!in_array(Session::role(), ['profesor', 'admin'], true)) {
      $this->redirect('task.index');
    }
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST')
      $this->redirect('task.index');

    $id = $_POST['id'] ?? '';
    $ok = $id && $this->repo()->delete((string) $id);
    $_SESSION['flash'] = $ok ? 'Tarea eliminada' : 'No se eliminó ninguna tarea';
    $this->redirect('task.index');
  }
}
