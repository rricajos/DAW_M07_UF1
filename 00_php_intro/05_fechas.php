<?php include 'include/header.php'; ?>

<?php
// Obtener la fecha actual
echo "La fecha y hora actual es: " . date("Y-m-d H:i:s") . "<br>";

// Mostrar solo la hora
echo "La hora actual es: " . date("H:i") . "<br>";

// Mostrar solo la fecha
echo "La fecha actual es: " . date("d/m/Y") . "<br>";

// Crear una fecha específica
$fecha_nacimiento = mktime(0, 0, 0, 7, 20, 1995);
echo "Fecha de nacimiento: " . date("d-m-Y", $fecha_nacimiento);
?>

<?php include 'include/footer.php'; ?>
