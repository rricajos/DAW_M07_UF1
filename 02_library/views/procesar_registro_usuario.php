<?php
include_once 'conn.php';
include_once 'UserController.php';

$conn = new Connection();
$db = $conn->conectar();

$usuarioController = new UserController($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];

    $mensaje = $usuarioController->registrarUser($name, $email, $password, $rol);
    echo $mensaje;  // Puedes redirigir a una vista después
}
?>
