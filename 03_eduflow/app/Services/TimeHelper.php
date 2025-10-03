<?php
namespace App\Services;

use DateTimeImmutable;
use DateTimeInterface;

final class TimeHelper
{
  /**
   * Formatea una fecha/hora a un string legible.
   * Acepta string ISO, timestamp o DateTime.
   */
  public static function format($value, string $format = 'd/m/Y - H:i'): string
  {
    if ($value instanceof DateTimeInterface) {
      $dt = $value;
    } elseif (is_numeric($value)) {
      $dt = (new DateTimeImmutable())->setTimestamp((int) $value);
    } elseif (is_string($value) && $value !== '') {
      try {
        $dt = new DateTimeImmutable($value);
      } catch (\Exception $e) {
        return htmlspecialchars($value, ENT_QUOTES); // fallback
      }
    } else {
      return '';
    }

    return $dt->format($format);
  }
}
