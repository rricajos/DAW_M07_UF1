<?php
namespace App\Services;

final class AgeLabelService
{
  public static function labelForAge(int $age): string
  {
    if ($age >= 12 && $age <= 16)
      return 'Secundaria';
    if ($age >= 17 && $age <= 18)
      return 'Bachillerato';
    return 'Otro';
  }

  public static function isSecundaria(int $age): bool
  {
    return $age >= 12 && $age <= 16;
  }
}
