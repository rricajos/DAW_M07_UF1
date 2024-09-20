<?php

/**
 * Transformar Arrays en PHP
 *
 * Este archivo contiene ejemplos de funciones para transformar arrays en PHP.
 */

// Ejemplo de array
$numeros = [1, 2, 3, 4, 5];

/**
 * array_map() - Aplica una función a cada elemento de un array.
 * 
 * Ejemplo: Duplicar los valores del array.
 */
$dobles = array_map(function ($n) {
    return $n * 2;
}, $numeros);

/**
 * array_filter() - Filtra elementos de un array usando una función de callback.
 * 
 * Ejemplo: Filtrar números pares.
 */
$pares = array_filter($numeros, function ($n) {
    return $n % 2 == 0;
});

/**
 * array_reduce() - Reduce un array a un solo valor utilizando una función de callback.
 * 
 * Ejemplo: Sumar todos los valores del array.
 */
$suma = array_reduce($numeros, function ($carry, $item) {
    return $carry + $item;
}, 0);

/**
 * array_walk() - Aplica una función a cada elemento de un array (por referencia).
 * 
 * Ejemplo: Convertir números a cadenas.
 */
array_walk($numeros, function (&$item) {
    $item = (string)$item;
});

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

/**
 * array_flip() - Intercambia las claves y los valores de un array.
 * 
 * Ejemplo: Convertir un array de claves a valores y viceversa.
 */
$colores = ["rojo" => "R", "verde" => "G", "azul" => "B"];
$coloresInvertidos = array_flip($colores);
