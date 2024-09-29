<?php
session_start();
include_once '../Conection.php';
include_once 'UserDAO.php';
include_once 'User.php';

if (!isset($_SESSION['user_id'])) {
  echo "ID de usuario no especificado.";
  exit;
}

$conn = new Conexion();
$db = $conn->conectar(); // Obtén la conexión aquí
$userDAO = new UserDAO($db);

// Obtener el usuario por ID
$usuarioId = $_SESSION['user_id'];
$usuario = $userDAO->findById($usuarioId); // Asegúrate de implementar este método en UsuarioDAO


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  if ($usuario) {
    echo "<h1>Detalles del Usuario</h1>";
    echo "<p>ID: " . $usuario->getId() . "</p>";
    echo "<p>Nombre: " . $usuario->getNombre() . "</p>";
    echo "<p>Email: " . $usuario->getEmail() . "</p>";
    echo "<p>Rol: " . $usuario->getRol() . "</p>";
  } else {
    echo "Usuario no encontrado.";
  }
  ?>
</body>

</html>