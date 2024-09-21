<?php include 'include/header.php'; ?>

<h2>Ejemplos de Validaciones PHP</h2>

<?php
// Validación de una dirección de correo electrónico
$email = "correo@example.com";

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Correo válido: " . $email . "<br>";
} else {
    echo "Correo no válido.<br>";
}

// Validación de una URL
$url = "https://www.ejemplo.com";

if (filter_var($url, FILTER_VALIDATE_URL)) {
    echo "URL válida: " . $url . "<br>";
} else {
    echo "URL no válida.<br>";
}

// Validación de un número entero
$entero = "12345";

if (filter_var($entero, FILTER_VALIDATE_INT)) {
    echo "Entero válido: " . $entero . "<br>";
} else {
    echo "Entero no válido.<br>";
}

// Validación de un número flotante
$float = "12.345";

if (filter_var($float, FILTER_VALIDATE_FLOAT)) {
    echo "Flotante válido: " . $float . "<br>";
} else {
    echo "Flotante no válido.<br>";
}

// Validación de una dirección IP
$ip = "192.168.0.1";

if (filter_var($ip, FILTER_VALIDATE_IP)) {
    echo "IP válida: " . $ip . "<br>";
} else {
    echo "IP no válida.<br>";
}

// Validación de un número dentro de un rango
$numero = 50;
$min = 1;
$max = 100;

if (filter_var($numero, FILTER_VALIDATE_INT, array("options" => array("min_range" => $min, "max_range" => $max)))) {
    echo "Número $numero está en el rango $min-$max.<br>";
} else {
    echo "Número fuera de rango.<br>";
}

// Validación de una cadena que no exceda cierta longitud
$cadena = "Hola, esto es una prueba!";
$longitudMax = 20;

if (strlen($cadena) <= $longitudMax) {
    echo "Cadena válida (dentro de la longitud permitida).<br>";
} else {
    echo "Cadena demasiado larga, debe ser de máximo $longitudMax caracteres.<br>";
}

// Validación de una fecha en formato Y-m-d
$fecha = "2023-09-20";

$dateRegex = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";

if (preg_match($dateRegex, $fecha)) {
    echo "Fecha válida: " . $fecha . "<br>";
} else {
    echo "Fecha no válida.<br>";
}

// Validación personalizada: Alfanumérico con guiones bajos
$usuario = "usuario_123";

if (preg_match("/^[a-zA-Z0-9_]+$/", $usuario)) {
    echo "Usuario válido: " . $usuario . "<br>";
} else {
    echo "Usuario no válido. Solo se permiten letras, números y guiones bajos.<br>";
}

?>
<?php include 'include/footer.php'; ?>