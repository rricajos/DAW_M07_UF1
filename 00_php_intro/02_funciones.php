<?php include 'include/header.php'; ?>

<?php
// Definición de una función simple
function saludar($nombre) {
    return "Hola, " . $nombre;
}

// Llamada a la función
echo saludar("Ana"); // Salida: Hola, Ana

// Otra función que suma dos números
function suma($a, $b) {
    return $a + $b;
}

echo "<br>La suma de 5 + 10 es: " . suma(5, 10); // Salida: La suma de 5 + 10 es: 15
?>


<?php include 'include/footer.php'; ?>
