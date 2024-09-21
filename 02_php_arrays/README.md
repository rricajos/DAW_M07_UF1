# Arrays PHP

## Nota

Las funciones que incluyen el prefijo `u` permiten proporcionar una función definida por el usuario para realizar comparaciones personalizadas. Estas funciones permiten mayor flexibilidad, por ejemplo, para realizar comparaciones insensibles a mayúsculas o comparar de una forma específica según las necesidades de la lógica del programa.

## `array_diff` vs `array_udiff`

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

Las funciones de `array_diff` son útiles para comparaciones simples, mientras que las funciones de `array_udiff` ofrecen una flexibilidad adicional para personalizar cómo se comparan los valores y las claves. La elección de una u otra depende de si necesitas comparaciones estándar o personalizadas.

La comparación estándar en PHP considera tanto el tipo como el valor. Por ejemplo, en una comparación estándar, el número entero 1 y la cadena de texto "1" se consideran diferentes porque tienen tipos distintos `1 : int != "1" : string`.

## `array_diff` vs `array_intersect`

array_diff(): Devuelve los elementos que están solo en el primer array, excluyendo los que están en otros arrays.
array_intersect(): Devuelve los elementos que están presentes en todos los arrays proporcionados.

## `array_intersect` vs `array_uintersect`

Las funciones `array_intersect` y `array_uintersect` en PHP permiten encontrar intersecciones entre arrays, es decir, valores o claves que están presentes en todos los arrays involucrados. Algunas de estas funciones permiten personalizar la comparación mediante funciones definidas por el usuario.

| Función                        | Comparación de Claves | Comparación de Valores       | Personalización          |
|--------------------------------|-----------------------|------------------------------|--------------------------|
| `array_intersect()`            | No                    | Estándar                     | No                       |
| `array_intersect_assoc()`      | Estándar              | Estándar                     | No                       |
| `array_intersect_key()`        | Estándar              | No                           | No                       |
| `array_intersect_uassoc()`     | Personalizable        | Estándar                     | Sí                       |
| `array_uintersect()`           | No                    | Personalizable               | Sí                       |
| `array_uintersect_assoc()`     | Estándar              | Personalizable               | Sí                       |
| `array_uintersect_key()`       | Personalizable        | No                           | Sí                       |
| `array_uintersect_uassoc()`    | Personalizable        | Personalizable               | Sí                       |

- **Comparación de Claves**: Indica si las claves de los arrays son comparadas y si esa comparación es estándar o personalizable.
- **Comparación de Valores**: Indica si los valores de los arrays son comparados y si esa comparación es estándar o personalizable.
- **Personalización**: Indica si es posible personalizar la comparación mediante una función definida por el usuario.

### Descripción de las funciones

1. **`array_intersect()`**: Compara los valores de los arrays, sin tener en cuenta las claves. No permite personalización.
2. **`array_intersect_assoc()`**: Compara tanto las claves como los valores utilizando comparación estándar para ambos.
3. **`array_intersect_key()`**: Solo compara las claves, sin tomar en cuenta los valores.
4. **`array_intersect_uassoc()`**: Compara claves de forma personalizable y valores de manera estándar.
5. **`array_uintersect()`**: Solo compara los valores de manera personalizada, sin considerar las claves.
6. **`array_uintersect_assoc()`**: Compara las claves de manera estándar y los valores de forma personalizable.
7. **`array_uintersect_key()`**: Compara solo las claves, permitiendo personalización en su comparación.
8. **`array_uintersect_uassoc()`**: Compara tanto las claves como los valores, y permite personalización en ambos aspectos.

## `array_merge()` vs `array_combine()` vs `array_fill_keys()`

Las funciones `array_merge()`, `array_combine()`, y `array_fill_keys()` tienen usos específicos en PHP para manejar arrays, pero sus objetivos y formas de combinar o crear arrays son diferentes. Mientras `array_merge()` se usa principalmente para combinar múltiples arrays en uno solo, `array_combine()` crea un array asociativo combinando claves y valores de dos arrays, y `array_fill_keys()` genera un array a partir de un conjunto de claves, rellenándolo con un valor común.

| Función                | Claves             | Valores                         | Uso Principal                          |
|------------------------|--------------------|----------------------------------|----------------------------------------|
| `array_merge()`         | Sobrescribe claves coincidentes | Combina múltiples arrays | Combinar arrays, sobrescribiendo valores para claves coincidentes |
| `array_combine()`       | Array de claves    | Array de valores                | Combina un array de claves con uno de valores, formando un array asociativo |
| `array_fill_keys()`     | Define claves      | Usa un solo valor para todas las claves | Crea un array con un conjunto de claves, rellenando todas con el mismo valor |
