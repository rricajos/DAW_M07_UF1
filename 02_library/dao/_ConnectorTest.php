<?php
// Incluir el archivo de conexión
include_once '_Connector.php';

// Crear una instancia de la clase Connection
$conn = new Connector();

// Obtener la conexión a la base de datos
$db = $conn->connect();

// Verificar si la conexión fue exitosa
if ($db) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Fallo en la conexión a la base de datos.";
}
?>
