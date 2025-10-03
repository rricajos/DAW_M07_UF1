<?php
namespace App\Models;

final class User
{
  private string $file;

  public function __construct(string $jsonPath)
  {
    $this->file = $jsonPath;
    if (!is_file($this->file)) {
      if (!is_dir(dirname($this->file)))
        mkdir(dirname($this->file), 0777, true);
      file_put_contents($this->file, json_encode([], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
  }

  public function all(): array
  {
    return json_decode((string) file_get_contents($this->file), true) ?: [];
  }

  public function insert(array $data): string
  {
    $all = $this->all();
    $id = bin2hex(random_bytes(6));
    $all[] = [
      'id' => $id,
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'age' => (int) $data['age'],
      'profile' => $data['profile'],
      // En práctica guardamos plano; en real usar password_hash.
      'password' => $data['password'],
      'created_at' => date('c'),
    ];
    file_put_contents($this->file, json_encode($all, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    return $id;
  }

  public function deleteMany(array $ids): int
  {
    if (!$ids)
      return 0;
    $want = array_flip(array_map('strval', $ids));
    $all = $this->all();
    $before = count($all);
    $filtered = array_values(array_filter($all, function ($u) use ($want) {
      return !isset($want[(string) ($u['id'] ?? '')]);
    }));
    file_put_contents($this->file, json_encode($filtered, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    return $before - count($filtered);
  }

  public function updateRoleMany(array $ids, string $role): int
  {
    $ids = array_map('strval', $ids);
    if (!$ids)
      return 0;

    $allowed = ['admin', 'profesor', 'estudiante'];
    if (!in_array($role, $allowed, true))
      return 0;

    $want = array_flip($ids);
    $all = $this->all();
    $count = 0;
    foreach ($all as &$u) {
      $id = (string) ($u['id'] ?? '');
      if ($id !== '' && isset($want[$id])) {
        $u['profile'] = $role;
        $count++;
      }
    }
    if ($count > 0) {
      file_put_contents($this->file, json_encode($all, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
    return $count;
  }


  public function findForLogin(string $identifier): ?array
  {
    $identifier = trim($identifier);
    if ($identifier === '')
      return null;

    $all = $this->all();

    // 1) Coincidencia exacta por ID
    foreach ($all as $u) {
      if (isset($u['id']) && (string) $u['id'] === $identifier) {
        return $u;
      }
    }

    // 2) Coincidencia por "Nombre Apellidos" (case-insensitive, espacios normalizados)
    $norm = function (string $s): string {
      $s = preg_replace('/\s+/', ' ', trim($s ?? ''));
      return mb_strtolower($s, 'UTF-8');
    };
    $identNorm = $norm($identifier);

    foreach ($all as $u) {
      $full = $norm(($u['first_name'] ?? '') . ' ' . ($u['last_name'] ?? ''));
      if ($full !== '' && $full === $identNorm) {
        return $u;
      }
    }

    return null;
  }


}


