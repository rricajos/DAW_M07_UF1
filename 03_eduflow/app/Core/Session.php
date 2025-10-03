<?php
namespace App\Core;

final class Session
{
  public static function start(array $opts = []): void
  {
    $savePath = $opts['save_path'] ?? null;
    $lifetimeMinutes = (int) ($opts['lifetime_minutes'] ?? 30);

    if ($savePath) {
      if (!is_dir($savePath))
        mkdir($savePath, 0777, true);
      session_save_path($savePath);
    }

    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_strict_mode', '1');
    session_set_cookie_params([
      'lifetime' => 0,
      'path' => '/',
      'httponly' => true,
      'samesite' => 'Lax',
    ]);

    session_start();
    // Gestión de inactividad (rolling)
    $now = time();
    $ttl = $lifetimeMinutes * 60;
    if (isset($_SESSION['__last_activity']) && ($now - (int) $_SESSION['__last_activity']) > $ttl) {
      session_unset();
      session_destroy();
      session_start();
    }
    $_SESSION['__last_activity'] = $now;
  }

  public static function login(string $username, ?string $role = null, ?string $userId = null): void
  {
    // Compatibilidad con cuentas demo si no viene $role
    if ($role === null) {
      $role = 'estudiante';
      if ($username === 'admin')
        $role = 'admin';
      elseif ($username === 'prof')
        $role = 'profesor';
      elseif ($username === 'estu')
        $role = 'estudiante';
    }

    $_SESSION['auth'] = [
      'user' => $username,   // nombre a mostrar
      'role' => $role,       // admin | profesor | estudiante
      'user_id' => $userId,     // id del JSON (si aplica)
      'login_time' => date('Y-m-d H:i:s'),
    ];
    session_regenerate_id(true);
  }

  public static function role(): ?string
  {
    return $_SESSION['auth']['role'] ?? null;
  }

  public static function logout(): void
  {
    session_unset();
    session_destroy();
  }

  public static function user(): ?array
  {
    return $_SESSION['auth'] ?? null;
  }

  public static function requireAuth(): void
  {
    if (!self::user()) {
      header('Location: index.php?action=auth.loginForm');
      exit;
    }
  }

  public static function requireRole(string|array $roles): void
  {
    $r = self::role();
    $roles = (array) $roles;
    if (!$r || !in_array($r, $roles, true)) {
      // Sin permiso → redirige a una vista segura (por ejemplo tareas)
      header('Location: index.php?action=task.index');
      exit;
    }
  }

}
