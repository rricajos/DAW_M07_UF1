<?php
// eduflow/app/Views/tasks/edit.php
$t = $task ?? [];
$errors = $errors ?? [];
function err($k, $errors)
{
  return !empty($errors[$k]) ? '<span class="error">' . htmlspecialchars($errors[$k]) . '</span>' : '';
}
?>
<style>
  .form-card {
    max-width: 720px;
    background: #fff;
    border: 1px solid #eaecef;
    border-radius: 8px;
    padding: 16px;
  }

  .form-row {
    margin-bottom: 12px;
  }

  .form-row label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
  }

  .form-row input[type="text"],
  .form-row input[type="date"],
  .form-row textarea {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #ccd1d5;
    border-radius: 6px;
    font: inherit;
  }

  .error {
    color: #b00020;
    display: block;
    margin-top: 6px;
  }

  .muted {
    color: #666;
    font-size: .9em;
  }

  .actions {
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
    margin-top: 12px;
  }

  .btn {
    display: inline-block;
    text-decoration: none;
    border: 0;
    border-radius: 6px;
    padding: 8px 12px;
    background: #4b7bec;
    color: #fff;
    cursor: pointer;
  }

  .btn.secondary {
    background: #555;
  }

  .btn.ghost {
    background: transparent;
    color: #333;
    border: 1px solid #ccc;
  }

  .btn:disabled,
  .disabled {
    pointer-events: none;
    opacity: .6;
  }

  .right {
    margin-left: auto;
  }

  .counter {
    font-size: .85em;
    color: #666;
  }
</style>

<section>
  <h1>Editar tarea</h1>

  <form id="taskForm" class="form-card" method="post" action="index.php?action=task.update">
    <input type="hidden" name="id" value="<?= htmlspecialchars($t['id'] ?? '') ?>">

    <div class="form-row">
      <label for="title">Título</label>
      <input id="title" name="title" type="text" required maxlength="120"
        value="<?= htmlspecialchars($t['title'] ?? '') ?>">
      <?= err('title', $errors) ?>
      <div class="counter"><span id="titleCount">0</span>/120</div>
    </div>

    <div class="form-row">
      <label for="due_date">Fecha de entrega</label>
      <input id="due_date" name="due_date" type="date" required
        value="<?= htmlspecialchars(substr((string) ($t['due_date'] ?? ''), 0, 10)) ?>"
        min="<?= htmlspecialchars(date('Y-m-d')) ?>">
      <?= err('due_date', $errors) ?>
      <div class="muted">Debe ser hoy o posterior.</div>
    </div>

    <div class="form-row">
      <label for="description">Descripción</label>
      <textarea id="description" name="description" rows="6" maxlength="1000"
        placeholder="Qué hay que entregar, criterios de evaluación, formato, enlaces, etc."><?= htmlspecialchars($t['description'] ?? '') ?></textarea>
      <div class="counter"><span id="descCount">0</span>/1000</div>
    </div>

    <div class="actions">
      <button id="btnSave" class="btn" type="submit">Guardar cambios</button>
      <a class="btn ghost" href="index.php?action=task.index">Cancelar</a>
      <span class="muted right" id="dirtyHint" hidden>Hay cambios sin guardar</span>
    </div>
  </form>
</section>

<script>
  (function () {
    const form = document.getElementById('taskForm');
    const save = document.getElementById('btnSave');
    const title = document.getElementById('title');
    const due = document.getElementById('due_date');
    const desc = document.getElementById('description');
    const titleCount = document.getElementById('titleCount');
    const descCount = document.getElementById('descCount');
    const dirtyHint = document.getElementById('dirtyHint');

    // Estado inicial para detectar cambios
    const initial = {
      title: title ? title.value : '',
      due: due ? due.value : '',
      desc: desc ? desc.value : '',
    };

    // Contadores
    function updateCounters() {
      if (titleCount && title) titleCount.textContent = title.value.length;
      if (descCount && desc) descCount.textContent = desc.value.length;
    }

    // Hay cambios respecto al estado inicial
    function isDirty() {
      return (title && title.value !== initial.title)
        || (due && due.value !== initial.due)
        || (desc && desc.value !== initial.desc);
    }

    // Habilitar/Deshabilitar Guardar (evita enviar si no hay cambios o faltan obligatorios)
    function updateState() {
      const requiredOk = title && title.value.trim() !== '' && due && due.value.trim() !== '';
      const dirty = isDirty();
      save.disabled = !(requiredOk && dirty);
      dirtyHint.hidden = !dirty;
      updateCounters();
    }

    // Prevenir salir con cambios sin guardar
    window.addEventListener('beforeunload', (e) => {
      if (isDirty()) {
        e.preventDefault();
        e.returnValue = '';
      }
    });

    // Atajo Ctrl+S / Cmd+S para guardar
    document.addEventListener('keydown', (e) => {
      if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 's') {
        e.preventDefault();
        if (!save.disabled) form.requestSubmit ? form.requestSubmit() : form.submit();
      }
    });

    form.addEventListener('input', updateState);
    form.addEventListener('change', updateState);

    // Al enviar, quitamos la alerta de “salir sin guardar”
    form.addEventListener('submit', () => {
      window.removeEventListener('beforeunload', () => { });
    });

    // Init
    updateCounters();
    updateState();
  })();
</script>