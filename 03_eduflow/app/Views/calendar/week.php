<?php
use App\Services\TimeHelper;
/** @var array $week */
/** $week['days'] = [ ['n'=>1..5,'label'=>'Lun 02/10','iso'=>'2025-10-02'], ... ] */
$role = $role ?? 'estudiante';
?>
<section>
  <h1>Calendario semanal</h1>
  <p><small>Semana que empieza el <?= htmlspecialchars($week['monday']) ?></small></p>

  <div class="table-wrap" style="overflow:auto;">
    <table class="table" style="width:100%; border-collapse:collapse;">
      <thead>
        <tr>
          <?php foreach ($week['days'] as $d): ?>
            <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;"><?= htmlspecialchars($d['label']) ?>
            </th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php for ($day = 1; $day <= 5; $day++): ?>
            <td style="vertical-align:top; padding:8px; border-bottom:1px solid #f0f0f0;">
              <?php foreach ($week['events'] as $ev):
                if ($ev['day'] !== $day)
                  continue; ?>
                <div style="margin-bottom:8px;">
                  <strong><?= htmlspecialchars($ev['time']) ?></strong> ·
                  <?= htmlspecialchars($ev['title']) ?> <small>(<?= htmlspecialchars($ev['where']) ?>)</small>
                </div>
              <?php endforeach; ?>
              <?php if ($role !== 'estudiante'): ?>
                <em style="opacity:.7;">(El profesorado podrá editar el plan en futuras mejoras)</em>
              <?php endif; ?>
            </td>
          <?php endfor; ?>
        </tr>
      </tbody>
    </table>
  </div>
</section>