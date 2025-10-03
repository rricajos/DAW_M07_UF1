<?php
$users = $users ?? [];
$flash = $flash ?? null;
?>
<style>

</style>

<section>
  <h1>Administración de Usuarios</h1>

  <?php if ($flash): ?>
    <p class="flash"><?= htmlspecialchars($flash) ?></p>
  <?php endif; ?>

  <div class="actions">
    <a id="btnCreate" class="btn" href="index.php?action=user.create">Crear usuario</a>

    <!-- Borrar seleccionados -->
    <form id="formDelete" method="post" action="index.php?action=user.bulkDelete"
      onsubmit="return confirm('¿Eliminar los usuarios seleccionados?');">
      <button id="btnDelete" class="btn" type="submit" disabled>Eliminar seleccionados</button>
      <div id="hiddenIdsDelete"></div>
    </form>

    <a class="btn" href="index.php?action=user.seed">Generar 3 usuarios plantilla</a>

    <!-- Cambiar rol masivo -->
    <form id="formRole" method="post" action="index.php?action=user.bulkRole">
      <label style="margin: 0;">Rol:&nbsp;
        <select id="roleTarget" name="role" required>
          <option value="">-- elegir --</option>
          <option value="admin">admin</option>
          <option value="profesor">profesor</option>
          <option value="estudiante">estudiante</option>
        </select>
      </label>
      <button id="btnRole" class="btn" type="submit" disabled>Cambiar rol</button>
      <div id="hiddenIdsRole"></div>
    </form>

  </div>

  <?php if (empty($users)): ?>
    <p>No hay usuarios creados aún.</p>
  <?php else: ?>
    <div class="table-wrap">
      <table class="table">
        <thead>
          <tr>
            <th><input type="checkbox" id="chkAll" aria-label="Seleccionar todos"></th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Perfil</th>
            <th>Creado</th>
            <th>ID</th>
          </tr>
        </thead>
        <tbody id="userTbody">
          <?php foreach ($users as $u): ?>
            <tr>
              <td><input type="checkbox" class="chkRow" value="<?= htmlspecialchars($u['id']) ?>"></td>
              <td><?= htmlspecialchars(($u['first_name'] ?? '') . ' ' . ($u['last_name'] ?? '')) ?></td>
              <td><?= (int) ($u['age'] ?? 0) ?></td>
              <td><?= htmlspecialchars($u['profile'] ?? '') ?></td>
              <td><?= \App\Services\TimeHelper::format($u['created_at'] ?? '') ?></td>
              <td class="mono"><?= htmlspecialchars($u['id'] ?? '') ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</section>

<script>
  (function () {
    const chkAll = document.getElementById('chkAll');
    const tbody = document.getElementById('userTbody');
    const btnDel = document.getElementById('btnDelete');
    const btnCreate = document.getElementById('btnCreate');
    const hiddenDel = document.getElementById('hiddenIdsDelete');
    const hiddenRole = document.getElementById('hiddenIdsRole');
    const roleSel = document.getElementById('roleTarget');
    const btnRole = document.getElementById('btnRole');

    function syncHidden(container, ids) {
      container.innerHTML = '';
      ids.forEach(id => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ids[]';
        input.value = id;
        container.appendChild(input);
      });
    }

    function getSelectedIds() {
      return [...document.querySelectorAll('.chkRow')]
        .filter(c => c.checked)
        .map(c => c.value);
    }


    function updateState() {
      const selected = getSelectedIds();
      const hasSel = selected.length > 0;
      const roleChosen = roleSel && roleSel.value !== '';

      // Eliminar
      btnDel.disabled = !hasSel;
      btnDel.classList.toggle('disabled', !hasSel);

      // Cambiar rol
      btnRole.disabled = !(hasSel && roleChosen);
      btnRole.classList.toggle('disabled', !(hasSel && roleChosen));

      // Crear
      if (btnCreate) btnCreate.classList.toggle('disabled', hasSel);

      if (hiddenDel) syncHidden(hiddenDel, selected);
      if (hiddenRole) syncHidden(hiddenRole, selected);

      if (chkAll) {
        const total = document.querySelectorAll('.chkRow').length;
        chkAll.checked = hasSel && selected.length === total && total > 0;
        chkAll.indeterminate = hasSel && selected.length > 0 && selected.length < total;
      }
    }

    if (chkAll) {
      chkAll.addEventListener('change', () => {
        document.querySelectorAll('.chkRow').forEach(c => c.checked = chkAll.checked);
        updateState();
      });
    }
    if (tbody) {
      tbody.addEventListener('change', (e) => {
        if (e.target && e.target.classList.contains('chkRow')) updateState();
      });
    }
    if (roleSel) roleSel.addEventListener('change', updateState);

    updateState();
  })();
</script>