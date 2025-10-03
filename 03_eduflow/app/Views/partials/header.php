<?php
use App\Core\Session;
$auth = Session::user();
$role = Session::role();
?>
<header class="header">
  <div class="wrap container">
    <strong>eduFlow</strong>
    <nav>
      <a href="index.php?action=home.index">Inicio</a>
      <?php if ($auth): ?>
        <a href="index.php?action=calendar.week">Calendario</a>
        <a href="index.php?action=task.index">Tareas</a>
        <?php if ($role === 'admin'): ?>
          <a href="index.php?action=dashboard.index">Usuarios</a>
        <?php endif; ?>
        <a href="index.php?action=auth.logout">Salir</a>
      <?php else: ?>
        <a href="index.php?action=auth.loginForm">Acceder</a>
      <?php endif; ?>
    </nav>
  </div>
</header>