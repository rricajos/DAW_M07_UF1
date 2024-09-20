<?php include 'include/header.php'; ?>

/**
Usa [] cuando crees arrays manualmente, ya que es más eficiente en rendimiento y moderno.
Usa array() si necesitas compatibilidad con versiones de PHP más antiguas (pre PHP 5.4).
Usa range() para generar arrays secuenciales de manera eficiente, especialmente cuando los valores siguen un patrón o secuencia clara.
*/
<?php
// Array indexado
$arr = [1, 2, 3, "patata"];

// Array con range()
$numeros = range(1, 100);

// Array con array()
$frutas = array("manzana", "plátano", "naranja");
echo "Primera fruta: " . $frutas[0] . "<br>"; // Salida: manzana

// Recorrer array con for
for ($i = 0; $i < count($frutas); $i++) {
    echo "Fruta $i: " . $frutas[$i] . "<br>";
}

// Array asociativo manual (clave => valor)
$edades = array("Ana" => 28, "Juan" => 32);
echo "<br>La edad de Ana es: " . $edades["Ana"] . "<br>"; // Salida: 28

// Recorrer array asociativo con foreach
foreach ($edades as $nombre => $edad) {
    echo "$nombre tiene $edad años.<br>";
}

// Array asociativo con array_combine()
// ! Que ambos arrays tengan la misma longitud para evitar errores !
$claves = ["nombre", "edad", "ciudad"];
$valores = ["Juan", 30, "Madrid"];
$persona = array_combine($claves, $valores);

?>


<?php include 'include/footer.php'; ?>