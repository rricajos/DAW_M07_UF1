<section>
  <h1>Nueva tarea</h1>
  <form method="post" action="index.php?action=task.store">
    <label>Título
      <input name="title" required>
    </label>
    <label>Fecha de entrega
      <input type="date" name="due_date" required>
    </label>
    <label>Descripción
      <textarea name="description" rows="4"></textarea>
    </label>
    <button type="submit">Guardar</button>
    <a class="btn" href="index.php?action=task.index">Volver</a>
  </form>
</section>