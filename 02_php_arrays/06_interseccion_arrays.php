<?php 

/**
 * array_intersect() - Devuelve los valores de un array que están presentes en todos los arrays.
 * 
 * Ejemplo: Encontrar elementos comunes entre dos arrays.
 */
$frutas1 = ["manzana", "banana", "naranja"];
$frutas2 = ["kiwi", "pera"];
$frutas3 = ["banana", "kiwi", "uva"];
$frutasComunes = array_intersect($frutas1, $frutas3);

/**
 * array_intersect_key() - Devuelve los elementos de un array que están presentes en todos los arrays, comparando las claves.
 * 
 * Ejemplo: Encontrar elementos comunes basados en las claves.
 */
$array1 = ["a" => 1, "b" => 2, "c" => 3];
$array2 = ["b" => 4, "c" => 5, "d" => 6];
$interseccionClaves = array_intersect_key($array1, $array2);



?>
