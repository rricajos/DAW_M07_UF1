<?php
$numeros = [1, 2, 3, 2];
$personas = [
  ["nombre" => "Juan", "edad" => 30],
  ["nombre" => "Ana", "edad" => 25],
];

// array_unique() - Filtra valores duplicados de una array
array_unique($numeros);


// array_rand() - Devuelve una o más claves aleatorias de un array.
array_rand($personas);


// array_filter() - Filtra elementos de un array usando una función de callback.
array_filter($numeros, function ($n) {
  return $n % 2 == 0;
});


// aray_map() + array_filter() - Usa array_map() para transformar elementos y luego array_filter() para filtrar.
array_filter(array_map('intval', $numeros), function ($value) {
  return $value > 2; // Filtra los valores convertidos que son mayores que 2
});


// in_array() - Comprueba si un valor existe en un array.
in_array(2, $numeros);


// array_search() - Busca un valor y devuelve la clave correspondiente.
array_search("Juan", $personas);


// array_column() - Devuelve los valores de una columna específica en un array multidimensional.
array_column($personas, "nombre");
