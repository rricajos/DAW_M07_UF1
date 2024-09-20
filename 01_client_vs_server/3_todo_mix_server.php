<?php

// Si se recibe una solicitud POST (para agregar una tarea)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Captura la tarea enviada por el cliente
    $task = $_POST['task'];

    // Si la tarea no está vacía, se almacena en el archivo tasks.txt
    if (!empty($task)) {
        file_put_contents('tasks.txt', $task . PHP_EOL, FILE_APPEND); // Añade la tarea al final del archivo
    }
    exit;
}

// Si se recibe una solicitud GET para eliminar una tarea
if (isset($_GET['delete'])) {

    // Lee todas las tareas desde el archivo
    $tasks = file('tasks.txt', FILE_IGNORE_NEW_LINES);

    // Elimina la tarea seleccionada
    unset($tasks[$_GET['delete']]);

    // Sobrescribe el archivo con las tareas restantes
    file_put_contents('tasks.txt', implode(PHP_EOL, $tasks) . PHP_EOL);

    exit;
}

// Carga las tareas del archivo, si existe
$tasks = file_exists('tasks.txt') ? file('tasks.txt', FILE_IGNORE_NEW_LINES) : [];

// Indica que la respuesta será en formato JSON
header('Content-Type: application/json');

// Devuelve las tareas como un array JSON
echo json_encode($tasks);
