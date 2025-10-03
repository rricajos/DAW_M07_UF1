<?php
$u = $user;
?>
<section>
  <h1>Confirmar datos</h1>
  <dl class="confirm">
    <dt>Nombre</dt>
    <dd><?= htmlspecialchars($u['first_name']) ?></dd>
    <dt>Apellidos</dt>
    <dd><?= htmlspecialchars($u['last_name']) ?></dd>
    <dt>Edad</dt>
    <dd><?= (int) $u['age'] ?></dd>
    <dt>Perfil</dt>
    <dd><?= htmlspecialchars($u['profile']) ?></dd>
    <dt>Contraseña</dt>
    <dd>••••••</dd>
  </dl>

  <form method="post" action="index.php?action=user.store" style="display:inline">
    <button type="submit" name="confirm" value="1">Confirmar</button>
  </form>
  <form method="post" action="index.php?action=user.store" style="display:inline">
    <button type="submit" name="cancel" value="1">Cancelar</button>
  </form>
</section>