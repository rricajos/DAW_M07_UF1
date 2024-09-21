<?php include 'include/header.php'; ?>

<h2>Ejemplo de Variables en PHP</h2>

<h3>Declaración de Variables</h3>
<?php
// Declaración de variables
$nombre = "Ana";
$edad = 28;

echo "Nombre: " . $nombre . "<br>"; // Salida: Nombre: Ana
echo "Edad: " . $edad . " años<br>"; // Salida: Edad: 28 años
?>

<h3>Uso de Comillas Simples y Dobles</h3>
<?php
// Uso de comillas simples y dobles
echo 'Hola, $nombre'; // Salida: Hola, $nombre (no interpreta la variable)
echo "<br>";
echo "Hola, $nombre"; // Salida: Hola, Ana (interpreta la variable)
?>

<h3>Concatenación de Cadenas</h3>
<?php
// Concatenación con el operador "."
echo "Nombre: " . $nombre . " - Edad: " . $edad . " años"; // Salida: Nombre: Ana - Edad: 28 años
?>

<h3>Operador de Concatenación vs Aritmético</h3>
<?php
$a = 5;
$b = 10;
echo "<br>El resultado de la suma es: " . ($a + $b); // Salida: El resultado de la suma es: 15
?>

<?php include 'include/footer.php'; ?>
