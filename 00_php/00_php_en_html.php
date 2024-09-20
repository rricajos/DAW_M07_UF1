<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de PHP Integrado en HTML</title>
</head>
<body>
    <h1>Bienvenido a mi sitio web</h1>

    <!-- PHP integrado para mostrar la hora -->
    <?php
        $hora = date("H"); // Obtener la hora actual en formato 24 horas
        if ($hora < 12) {
            echo "<p>¡Buenos días!</p>";
        } elseif ($hora < 18) {
            echo "<p>¡Buenas tardes!</p>";
        } else {
            echo "<p>¡Buenas noches!</p>";
        }
    ?>
    <p>Gracias por visitar mi sitio web. Son las <?php echo date("H:i"); ?> horas.</p>
</body>
</html>
