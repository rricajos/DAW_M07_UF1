<?php
// Iniciar la sesión
session_start();

// Eliminar todas las variables de sesión
$_SESSION = array();

// Si se desea destruir también la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio o de login
header("Location: user.php");  // Redirige a la página que prefieras
exit;
?>
