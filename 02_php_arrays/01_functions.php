<?php

/**
 * Funciones de Array en PHP
 *
 * Este archivo contiene ejemplos de las funciones más comunes para manipular arrays en PHP.
 */

// Ejemplo de array
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
 * Transformar Arrays
 * 
 * array_map() - Aplica una función a cada elemento de un array.
 */
$numeros = [1, 2, 3];
$dobles = array_map(function ($n) {
  return $n * 2;
}, $numeros);

/**
 * array_filter() - Filtra elementos de un array usando una función de callback.
 */
$pares = array_filter($numeros, function ($n) {
  return $n % 2 == 0;
});

/**
 * Combinar Arrays
 * 
 * array_merge() - Combina dos o más arrays.
 */
$frutas2 = ["kiwi", "pera"];
$frutasCombinadas = array_merge($frutas, $frutas2);

/**
 * array_combine() - Crea un array asociativo a partir de dos arrays.
 */
$claves = ["nombre", "edad"];
$valores = ["Juan", 30];
$persona = array_combine($claves, $valores);

/**
 * Ordenar Arrays
 * 
 * sort() - Ordena un array indexado.
 */
sort($frutas);

/**
 * asort() - Ordena un array asociativo manteniendo la asociación de claves.
 */
asort($persona);

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

/**
 * array_rand() - Devuelve una o más claves aleatorias de un array.
 */
$claveAleatoria = array_rand($frutas);
