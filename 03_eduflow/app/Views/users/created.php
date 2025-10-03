<?php
use App\Services\AgeLabelService;
$u = $user;
$isSec = AgeLabelService::isSecundaria((int) $u['age']);
?>
<section>
  <h1>Usuario creado</h1>
  <p>ID: <strong><?= htmlspecialchars($id) ?></strong></p>
  <p><?= htmlspecialchars($u['first_name'] . ' ' . $u['last_name']) ?> (<?= (int) $u['age'] ?>) — Perfil:
    <strong><?= htmlspecialchars($u['profile']) ?></strong>
  </p>
  <p>Etiqueta por edad: <strong><?= htmlspecialchars($label) ?></strong>
    <?php if ($isSec): ?>
      <img src="public/img/secundaria.png" alt="Secundaria" style="height:1.2em;vertical-align:middle">
    <?php endif; ?>
  </p>
  <p><a class="btn" href="index.php?action=home.index">Volver al inicio</a></p>
</section>