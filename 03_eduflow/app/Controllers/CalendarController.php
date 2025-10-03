<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Services\CalendarService;

/**
 * Controlador del calendario.
 * 
 * Se encarga de mostrar la vista del calendario semanal para usuarios autenticados.
 * Extiende la clase base `Controller` para heredar utilidades como `view()` y `redirect()`.
 */
final class CalendarController extends Controller
{
  /**
   * Muestra la vista del calendario semanal.
   * 
   * Flujo:
   * 1. Verifica que el usuario esté autenticado (Session::requireAuth()).
   * 2. Obtiene la semana actual a través de CalendarService::currentWeek().
   * 3. Renderiza la vista `calendar/week.php` pasando:
   *    - `title`: título de la página.
   *    - `week`: datos de la semana actual.
   *    - `role`: rol actual del usuario (admin, profesor, estudiante...).
   */
  public function week(): void
  {
    // 1) Asegura que el usuario tenga sesión iniciada.
    Session::requireAuth();

    // 2) Obtiene los datos de la semana actual mediante el servicio de calendario.
    $week = CalendarService::currentWeek();

    // 3) Renderiza la vista calendar/week.php con los datos correspondientes.
    $this->view('calendar/week.php', [
      'title' => 'Calendario semanal',
      'week' => $week,
      'role' => Session::role(),
    ]);
  }
}
