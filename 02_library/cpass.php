<?php
session_start(); 

if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "Debes iniciar sesión para cambiar tu contraseña.";
    header('Location: user.php');
    exit();
}

$userId = $_SESSION['id'];

$newPassword = trim($_POST['newpassword']);

if (empty($newPassword)) {
    $_SESSION['error'] = "La contraseña no puede estar vacía.";
    header('Location: user.php');
    exit();
}

include_once 'controller/UserController.php';
$controller = new UserController();

if ($controller->updatePassword($userId, $newPassword)) {
    // Contraseña actualizada con éxito
    $_SESSION['success'] = "Contraseña cambiada correctamente.";
    
    $controller->session($_SESSION['email']);
    
    header('Location: user.php');
} else {
    // Error al actualizar la contraseña
    $_SESSION['error'] = "Error al cambiar la contraseña. Inténtalo de nuevo.";
    header('Location: user.php');
}
exit();
?>
