<?php include 'include/header.php'; ?>

<h2>Resultado del Formulario</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    echo "<h2>Datos enviados por POST:</h2>";
    echo "Nombre: $nombre<br>";
    echo "Email: $email<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['busqueda'])) {
        $busqueda = htmlspecialchars($_GET['busqueda']);
        echo "<h2>Búsqueda enviada por GET:</h2>";
        echo "Has buscado: $busqueda<br>";
    }
}
?>


<?php include 'include/footer.php'; ?>
