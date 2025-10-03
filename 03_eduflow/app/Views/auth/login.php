<?php
$oldUser = $old['username'] ?? '';
?>
<section class="auth">
  <h1>Acceso</h1>
  <?php if (!empty($error)): ?>
    <p class=" error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>
  <form method="post" action="index.php?action=auth.doLogin">
    <label>Usuario
      <input type="text" name="username" required value="<?= htmlspecialchars($oldUser) ?>">
    </label>
    <label>Contraseña
      <input type="password" name="password" required>
    </label>
    <button type="submit">Entrar</button>
  </form>
  <p><small>

      <H3>Usuario / Contraseña demo:</H3>
      <ul>
        <li><strong>estu / abcdef</strong> <br> ver calendario y tareas</li><br>
        <li><strong>prof / abcdef</strong> <br> estu + ver y crear/editar/eliminar tareas</li><br>
        <li><strong>admin / abcdef</strong> <br> prof + ver y crear/editar/eliminar usuarios</li>
      </ul>

      También puedes entrar con un usuario creado con su <strong>ID</strong> o <strong>Nombre Apellidos</strong>
      tal como aparece en el Panel, y su contraseña.
    </small>
  </p>
</section>