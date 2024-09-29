<?php
session_start();

$email = trim($_POST['email']);
$password = trim($_POST['password']);

if (empty($email) || empty($password)) {
  // Redirigir con un mensaje de error
  $_SESSION['error'] = "Los campos no pueden estar vacíos.";
  header('Location: user.php');
  exit();  // Detener la ejecución después de la redirección
}


include_once 'controller/UserController.php';
$controller = new UserController();

if ($controller->signin($email, $password)) {

  $controller->session($email);

} else {
  // Si las credenciales son incorrectas, redirigir a la página de usuario con un mensaje de error
  $_SESSION['error'] = "Credenciales incorrectas. Inténtalo de nuevo.";

}

header('Location: user.php');
exit();
