<?php

/**
 * Transformar Arrays en PHP
 *
 * Este archivo contiene ejemplos de funciones para transformar arrays en PHP.
 */

$frutas = ["manzana", "banana", "naranja"];

/**
 * Agregar elementos
 * 
 * array_push() - Agrega uno o más elementos al final del array.
 */
array_push($frutas, "kiwi");

/**
 * array_unshift() - Agrega uno o más elementos al inicio del array.
 */
array_unshift($frutas, "fresa");

/**
 * Eliminar elementos
 * 
 * array_pop() - Elimina el último elemento del array.
 */
array_pop($frutas);

/**
 * array_shift() - Elimina el primer elemento del array.
 */
array_shift($frutas);


/**
 * Otras funciones de array
 * 
 * array_slice() - Extrae una porción de un array.
 */
$porcion = array_slice($frutas, 1, 2);

/**
 * array_splice() - Elimina y reemplaza elementos en un array.
 */
array_splice($frutas, 1, 1, ["cereza"]);

/**
 * array_unique() - Elimina valores duplicados de un array.
 */
$frutasDuplicadas = ["manzana", "banana", "manzana"];
$frutasUnicas = array_unique($frutasDuplicadas);





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
 * array_keys() - Devuelve todas las claves de un array.
 * 
 * Ejemplo: Obtener las claves de un array asociativo.
 */
$claves = array_keys($persona); // ["Juan", "Ana", "Luis"]

/**
 * array_values() - Devuelve todos los valores de un array.
 * 
 * Ejemplo: Obtener los valores de un array asociativo.
 */
$valores = array_values($persona); // [30, 25, 28]






/**
 * array_reduce() - Reduce un array a un solo valor utilizando una función de callback.
 * 
 * Ejemplo: Operar todos los valores del array
 */
$suma = array_reduce($numeros, function ($carry, $item) {
    return $carry + $item + ($item / 2);
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
 * array_flip() - Intercambia las claves y los valores de un array.
 * 
 * Ejemplo: Convertir un array de claves a valores y viceversa.
 */
$colores = ["rojo" => "R", "verde" => "G", "azul" => "B"];
$coloresInvertidos = array_flip($colores);


