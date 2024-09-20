<?php

// Si se recibe una solicitud POST (al agregar una tarea)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task']; // Captura la tarea enviada por el formulario
    // Si la tarea no está vacía, se almacena en el archivo tasks.txt
    if (!empty($task)) {
        file_put_contents('tasks.txt', $task . PHP_EOL, FILE_APPEND); // Añade la tarea al final del archivo
    }
}

// Si se recibe una solicitud GET para eliminar una tarea
if (isset($_GET['delete'])) {
    // Lee todas las tareas desde el archivo
    $tasks = file('tasks.txt', FILE_IGNORE_NEW_LINES);
    unset($tasks[$_GET['delete']]); // Elimina la tarea seleccionada
    // Sobrescribe el archivo con las tareas restantes
    file_put_contents('tasks.txt', implode(PHP_EOL, $tasks) . PHP_EOL);
}

// Carga las tareas del archivo, si existe
$tasks = file_exists('tasks.txt') ? file('tasks.txt', FILE_IGNORE_NEW_LINES) : [];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List - Servidor (PHP)</title>
    <link rel="stylesheet" href="style.css"> <!-- Vincula el archivo de estilos CSS -->
</head>
<body>
    <div class="todo-container">
        <h1>To-Do List (Servidor)</h1>

        <!-- Formulario para agregar una nueva tarea -->
        <form method="POST">
            <input type="text" name="task" placeholder="Nueva tarea">
            <button type="submit">Agregar</button>
        </form>

        <!-- Lista de tareas -->
        <ul>
            
            <!-- Itera sobre las tareas y las muestra -->
            <?php foreach ($tasks as $index => $task): ?>
                <li>
                    <?= htmlspecialchars($task) ?> <!-- Muestra la tarea escapando caracteres especiales -->
                    <a href="?delete=<?= $index ?>" class="delete-btn">Eliminar</a> <!-- Enlace para eliminar -->
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</body>
</html>
