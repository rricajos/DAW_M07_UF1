<?php

/**
 * Combinar Arrays en PHP
 *
 * Este archivo contiene ejemplos de funciones para combinar arrays en PHP.
 */

// Ejemplo de arrays
$frutas1 = ["manzana", "banana", "naranja"];
$frutas2 = ["kiwi", "pera"];

/**
 * array_merge() - Combina dos o más arrays.
 * 
 * Ejemplo: Combinar dos arrays.
 */
$frutasCombinadas = array_merge($frutas1, $frutas2);

/**
 * array_combine() - Crea un array asociativo a partir de dos arrays.
 * 
 * Ejemplo: Crear un array asociativo de claves y valores.
 */
$claves = ["nombre", "edad"];
$valores = ["Juan", 30];
$persona = array_combine($claves, $valores);

/**
 * array_intersect() - Devuelve los valores de un array que están presentes en todos los arrays.
 * 
 * Ejemplo: Encontrar elementos comunes entre dos arrays.
 */
$frutas3 = ["banana", "kiwi", "uva"];
$frutasComunes = array_intersect($frutas1, $frutas3);

/**
 * array_diff() - Devuelve los valores del primer array que no están presentes en los demás arrays.
 * 
 * Ejemplo: Encontrar elementos únicos en un array.
 */
$frutasDiferentes = array_diff($frutas1, $frutas3);

/**
 * array_merge_recursive() - Combina arrays recursivamente.
 * 
 * Ejemplo: Combinar arrays que contienen arrays.
 */
$array1 = ["a" => ["rojo"], "b" => ["verde"]];
$array2 = ["a" => ["azul"], "b" => ["amarillo"]];
$arrayCombinadoRecursivo = array_merge_recursive($array1, $array2);

?>
