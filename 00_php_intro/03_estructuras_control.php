<?php include 'include/header.php'; ?>

<h2>Ejemplos de Estructuras de Control</h2>

<h3>Condicional If</h3>
<?php
$hora = 20;
if ($hora < 12) {
    echo "Buenos días!";
} elseif ($hora < 18) {
    echo "Buenas tardes!";
} else {
    echo "Buenas noches!";
}
?>

<h3>Bucle For</h3>
<?php
for ($i = 0; $i < 5; $i++) {
    echo "Número: $i <br>";
}
?>

<h3>Bucle Foreach</h3>
<?php
$colores = array("rojo", "verde", "azul");
foreach ($colores as $color) {
    echo "Color: $color <br>";
}
?>

<h3>Try-Catch</h3>
<?php
$numerador = 10;
$denominador = 0;

try {
    if ($denominador == 0) {
        throw new Exception("No se puede dividir entre 0.");
    }
    $resultado = $numerador / $denominador;
    echo "El resultado de la división es: " . $resultado;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<?php include 'include/footer.php'; ?>
