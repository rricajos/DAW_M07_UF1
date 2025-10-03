<?php
namespace App\Services;

final class CalendarService
{
  /**
   * Devuelve la semana "actual" con eventos de ejemplo.
   * $mondayFormat: formato para devolver la fecha del lunes (opcional).
   */
  public static function currentWeek(string $mondayFormat = 'Y-m-d'): array
  {
    $today = new \DateTimeImmutable('today');
    $dow = (int) $today->format('N'); // 1..7 (L..D)
    $monday = $today->modify('-' . ($dow - 1) . ' days'); // Lunes

    // Eventos de ejemplo (clases, tutorías, exámenes...)
    $events = [
      ['day' => 1, 'time' => '08:30', 'title' => 'Matemáticas', 'where' => 'Aula 101'],
      ['day' => 1, 'time' => '11:30', 'title' => 'Lengua', 'where' => 'Aula 102'],
      ['day' => 2, 'time' => '09:30', 'title' => 'Historia', 'where' => 'Aula 103'],
      ['day' => 3, 'time' => '12:00', 'title' => 'Tutoría', 'where' => 'Depto.'],
      ['day' => 4, 'time' => '10:00', 'title' => 'Física', 'where' => 'Lab 2'],
      ['day' => 5, 'time' => '08:30', 'title' => 'Examen Inglés', 'where' => 'Aula 105'],
    ];

    return [
      'monday' => $monday->format($mondayFormat),
      'days' => array_map(function ($i) use ($monday) {
        $d = $monday->modify('+' . ($i - 1) . ' days');
        return ['n' => $i, 'label' => $d->format('D d/m'), 'iso' => $d->format('Y-m-d')];
      }, [1, 2, 3, 4, 5]),
      'events' => $events
    ];
  }
}
