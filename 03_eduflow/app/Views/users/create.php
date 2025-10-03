<?php
$old = $old ?? [];
$errors = $errors ?? [];


// Mapear a $GLOBALS para que los helpers actuales funcionen
$GLOBALS['old'] = $old;
$GLOBALS['errors'] = $errors;

function old($k, $d = '')
{
  return htmlspecialchars((string) ($GLOBALS['old'][$k] ?? $d), ENT_QUOTES);
}
function err($k)
{
  if (!empty($GLOBALS['errors'][$k])) {
    echo '<span class="error">' . htmlspecialchars((string) $GLOBALS['errors'][$k], ENT_QUOTES) . '</span>';
  }
}


?>
<section>
  <h1>Nuevo usuario</h1>
  <form method="post" action="index.php?action=user.confirm">
    <div>
      <label>Nombre
        <input name="first_name" value="<?= old('first_name') ?>" required>
        <?php err('first_name'); ?>
      </label>
    </div>
    <div>
      <label>Apellidos
        <input name="last_name" value="<?= old('last_name') ?>" required>
        <?php err('last_name'); ?>
      </label>
    </div>
    <div>
      <label>Edad
        <input type="number" name="age" min="12" max="120" value="<?= old('age', '12') ?>" required>
        <?php err('age'); ?>
      </label>
    </div>
    <div>
      <label>Perfil
        <select name="profile" required>
          <?php
          $opts = ['estudiante' => 'Estudiante', 'profesor' => 'Profesor', 'admin' => 'Admin'];
          $sel = $old['profile'] ?? 'estudiante';
          foreach ($opts as $v => $t) {
            $s = $sel === $v ? 'selected' : '';
            echo "<option value=\"$v\" $s>$t</option>";
          }
          ?>
        </select>
        <?php err('profile'); ?>
      </label>
    </div>
    <div>
      <label>Contraseña (mín. 6)
        <input type="password" name="password" minlength="6" required value="<?= old('password') ?>">
        <!-- <- añadir esto -->
        <?php err('password'); ?>
      </label>

    </div>
    <button type="submit">Continuar</button>
  </form>
</section>