<?php
namespace App\Core;

abstract class Controller
{
  protected string $basePath;

  public function __construct(string $basePath)
  {
    $this->basePath = $basePath;
  }

  protected function view(string $path, array $data = [], string $layout = 'layouts/main.php'): void
  {
    extract($data, EXTR_OVERWRITE);
    $viewFile = $this->basePath . '/app/Views/' . $path;
    $layoutFile = $this->basePath . '/app/Views/' . $layout;

    ob_start();
    require $viewFile;
    $content = ob_get_clean();

    require $layoutFile;
  }

  protected function redirect(string $action, array $params = []): never
  {
    $query = http_build_query(array_merge(['action' => $action], $params));
    header("Location: index.php?$query");
    exit;
  }

  protected function isPost(): bool
  {
    return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
  }
}
