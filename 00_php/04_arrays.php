<?php include 'include/header.php'; ?>

<?php
// Array indexado
$frutas = array("manzana", "plátano", "naranja");
echo "Primera fruta: " . $frutas[0] . "<br>"; // Salida: manzana

// Recorrer array con for
for ($i = 0; $i < count($frutas); $i++) {
    echo "Fruta $i: " . $frutas[$i] . "<br>";
}

// Array asociativo
$edades = array("Ana" => 28, "Juan" => 32);
echo "<br>La edad de Ana es: " . $edades["Ana"] . "<br>"; // Salida: 28

// Recorrer array asociativo con foreach
foreach ($edades as $nombre => $edad) {
    echo "$nombre tiene $edad años.<br>";
}
?>
<?php include 'include/footer.php'; ?>

