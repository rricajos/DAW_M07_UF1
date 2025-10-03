<?php
use App\Core\Session;
$auth = $auth ?? Session::user();
$role = Session::role();
?>
<section>
  <h1>Bienvenido a eduFlow</h1>
  <?php if ($auth): ?>
    <p>Has iniciado sesión como <strong><?= htmlspecialchars($auth['user']) ?></strong>
      (<?= htmlspecialchars($role ?? '') ?>).</p>
    <p>
      <!-- Muestra SIEMPRE Calendario y Tareas -->
      <a class="btn" href="index.php?action=calendar.week">Calendario</a>
      <a class="btn" href="index.php?action=task.index">Tareas</a>
      <!-- Y, si es admin, además el Panel -->
      <?php if ($role === 'admin'): ?>
        <a class="btn" href="index.php?action=dashboard.index">Usuarios</a>
      <?php endif; ?>
    </p>
  <?php else: ?>
    <p>Para continuar, accede con tu usuario.</p>
    <p><a class="btn" href="index.php?action=auth.loginForm">Ir a Acceso</a></p>
  <?php endif; ?>
</section>