<?php
use App\Services\TimeHelper;
$role = $role ?? 'estudiante';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section>
  <h1>Tareas</h1>

  <?php if ($flash): ?>
    <p class="flash"><?= htmlspecialchars($flash) ?></p><?php endif; ?>

  <div class="actions" style="display:flex; gap:12px; align-items:center; margin-bottom:12px;">
    <?php if (in_array($role, ['profesor', 'admin'], true)): ?>
      <a class="btn" href="index.php?action=task.create">Nueva tarea</a>
    <?php endif; ?>
    <a class="btn" href="index.php?action=calendar.week">Ver calendario semanal</a>
  </div>

  <?php if (empty($tasks)): ?>
    <p>No hay tareas.</p>
  <?php else: ?>
    <div class="table-wrap" style="overflow:auto;">
      <table class="table" style="width:100%; border-collapse:collapse;">
        <thead>
          <tr>
            <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Título</th>
            <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Entrega</th>
            <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Descripción</th>
            <?php if (in_array($role, ['profesor', 'admin'], true)): ?>
              <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Acciones</th>
            <?php endif; ?>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tasks as $t): ?>
            <tr>
              <td style="padding:8px; border-bottom:1px solid #f0f0f0;"><?= htmlspecialchars($t['title']) ?></td>
              <td style="padding:8px; border-bottom:1px solid #f0f0f0;"><?= TimeHelper::format($t['due_date'], 'd/m/Y') ?>
              </td>
              <td style="padding:8px; border-bottom:1px solid #f0f0f0;"><?= nl2br(htmlspecialchars($t['description'])) ?>
              </td>
              <?php if (in_array($role, ['profesor', 'admin'], true)): ?>
                <td style="padding:8px; border-bottom:1px solid #f0f0f0;">
                  <a class="btn" href="index.php?action=task.edit&id=<?= urlencode($t['id']) ?>">Editar</a>
                  <form method="post" action="index.php?action=task.delete" style="display:inline"
                    onsubmit="return confirm('¿Eliminar tarea?');">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($t['id']) ?>">
                    <button type="submit">Eliminar</button>
                  </form>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</section>