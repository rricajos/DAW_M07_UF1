# Arrays PHP

## Comparación de Funciones y Subfucniones de `array_diff` y `array_udiff`

Prácticamente utilizaremos `array_diff()` y `array_udiff()` con arrays **simples** o **indexadas**, es decir, arrays sin clave. En cambio, utilizaremos subfunciones como `array_diff_ukey()` o `array_udiff_assoc()` en **arrays asociativas**, es decir, arrays con clave.

| Función                     | Comparación de Claves | Comparación de Valores       | Personalización          |
|-----------------------------|-----------------------|------------------------------|--------------------------|
| `array_diff()`              | No                    | Estándar                     | No                       |
| `array_diff_assoc()`        | Estándar              | Estándar                     | No                       |
| `array_diff_key()`          | Estándar              | No                           | No                       |
| `array_diff_uassoc()`       | Estándar              | Personalizable               | Sí                       |
| `array_diff_ukey()`         | Personalizable        | Estándar                     | Sí                       |
| `array_udiff()`             | No                    | Personalizable               | Sí                       |
| `array_udiff_assoc()`       | Estándar              | Personalizable               | Sí                       |
| `array_udiff_uassoc()`      | Personalizable        | Personalizable               | Sí                       |

## Conclusión

Las funciones de `array_diff` son útiles para comparaciones simples, mientras que las funciones de `array_udiff` ofrecen una flexibilidad adicional para personalizar cómo se comparan los valores y las claves. La elección de una u otra depende de si necesitas comparaciones estándar o personalizadas.

La comparación estándar en PHP considera tanto el tipo como el valor. Por ejemplo, en una comparación estándar, el número entero 1 y la cadena de texto "1" se consideran diferentes porque tienen tipos distintos `1 : int != "1" : string`.


## Comparación de `array_merge()`, `array_combine()` y `array_fill_keys()`

Las funciones `array_merge()`, `array_combine()`, y `array_fill_keys()` tienen usos específicos en PHP para manejar arrays, pero sus objetivos y formas de combinar o crear arrays son diferentes. Mientras `array_merge()` se usa principalmente para combinar múltiples arrays en uno solo, `array_combine()` crea un array asociativo combinando claves y valores de dos arrays, y `array_fill_keys()` genera un array a partir de un conjunto de claves, rellenándolo con un valor común.

| Función                | Claves             | Valores                         | Uso Principal                          |
|------------------------|--------------------|----------------------------------|----------------------------------------|
| `array_merge()`         | Sobrescribe claves coincidentes | Combina múltiples arrays | Combinar arrays, sobrescribiendo valores para claves coincidentes |
| `array_combine()`       | Array de claves    | Array de valores                | Combina un array de claves con uno de valores, formando un array asociativo |
| `array_fill_keys()`     | Define claves      | Usa un solo valor para todas las claves | Crea un array con un conjunto de claves, rellenando todas con el mismo valor |
