<?php
$numeros = [1, 2, 3];

/**
 * array_rand() - Devuelve una o más claves aleatorias de un array.
 * 
 * Ejemplo: Obtener una clave aleatoria.
 */
$claveAleatoria = array_rand($numeros);


/**
 * array_filter() - Filtra elementos de un array usando una función de callback.
 * 
 * Ejemplo: Filtrar números pares.
 */
$pares = array_filter($numeros, function ($n) {
  return $n % 2 == 0;
});

/**
 * Buscar elementos
 * 
 * in_array() - Comprueba si un valor existe en un array.
 */
$existe = in_array("banana", $frutas);

/**
 * array_search() - Busca un valor y devuelve la clave correspondiente.
 */
$clave = array_search("naranja", $frutas);


/**
 * array_column() - Devuelve los valores de una columna específica en un array multidimensional.
 * 
 * Ejemplo: Extraer la columna "nombre" de un array asociativo.
 */
$personas = [
  ["nombre" => "Juan", "edad" => 30],
  ["nombre" => "Ana", "edad" => 25],
];
$nombres = array_column($personas, "nombre");
