<?php
/**
 * Ordenar Arrays en PHP
 *
 * Este archivo contiene ejemplos de funciones para ordenar arrays en PHP.
 */

// Ejemplo de array
$frutas = ["manzana", "banana", "naranja", "kiwi"];

/**
 * sort() - Ordena un array indexado.
 * 
 * Ejemplo: Ordenar alfabéticamente.
 */
sort($frutas);

/**
 * asort() - Ordena un array asociativo manteniendo la asociación de claves.
 * 
 * Ejemplo: Ordenar un array asociativo por valor.
 */
$persona = [
    "Juan" => 30,
    "Ana" => 25,
    "Luis" => 28,
];
asort($persona);

/**
 * ksort() - Ordena un array asociativo por clave.
 * 
 * Ejemplo: Ordenar un array asociativo por clave.
 */
ksort($persona);

/**
 * usort() - Ordena un array utilizando una función de comparación definida por el usuario.
 * 
 * Ejemplo: Ordenar un array de números en orden descendente.
 */
$numeros = [3, 1, 4, 2];
usort($numeros, function($a, $b) {
    return $b <=> $a; // Orden descendente
});

/**
 * arsort() - Ordena un array asociativo en orden inverso, manteniendo la asociación de claves.
 * 
 * Ejemplo: Ordenar un array asociativo por valor en orden descendente.
 */
arsort($persona);

/**
 * natcasesort() - Ordena un array usando un algoritmo de ordenación natural, sin distinción de mayúsculas.
 * 
 * Ejemplo: Ordenar un array con valores de diferentes casos.
 */
$valores = ["manzana", "Banana", "naranja"];
natcasesort($valores);

/**
 * rsort() - Ordena un array indexado en orden inverso.
 * 
 * Ejemplo: Ordenar un array en orden descendente.
 */
rsort($frutas);

?>
