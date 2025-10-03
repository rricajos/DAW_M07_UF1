<?php
namespace App\Models;

final class Task
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

  public function find(string $id): ?array
  {
    foreach ($this->all() as $t)
      if (($t['id'] ?? '') === $id)
        return $t;
    return null;
  }

  public function insert(array $data): string
  {
    $all = $this->all();
    $id = bin2hex(random_bytes(6));
    $all[] = [
      'id' => $id,
      'title' => $data['title'],
      'due_date' => $data['due_date'], // ISO o Y-m-d
      'description' => $data['description'] ?? '',
      'created_at' => date('c'),
      'updated_at' => date('c'),
    ];
    file_put_contents($this->file, json_encode($all, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    return $id;
  }

  public function update(string $id, array $data): bool
  {
    $all = $this->all();
    $ok = false;
    foreach ($all as &$t) {
      if (($t['id'] ?? '') === $id) {
        $t['title'] = $data['title'];
        $t['due_date'] = $data['due_date'];
        $t['description'] = $data['description'] ?? '';
        $t['updated_at'] = date('c');
        $ok = true;
        break;
      }
    }
    if ($ok)
      file_put_contents($this->file, json_encode($all, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    return $ok;
  }

  public function delete(string $id): bool
  {
    $all = $this->all();
    $before = count($all);
    $all = array_values(array_filter($all, fn($t) => ($t['id'] ?? '') !== $id));
    file_put_contents($this->file, json_encode($all, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    return $before !== count($all);
  }
}
