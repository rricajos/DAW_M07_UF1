<?php
// Incluir el archivo de conexión
include_once 'Conexion.php';

// Crear una instancia de la clase Conexion
$conexion = new Conexion();

// Obtener la conexión a la base de datos
$db = $conexion->conectar();

// Verificar si la conexión fue exitosa
if ($db) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Fallo en la conexión a la base de datos.";
}
?>
