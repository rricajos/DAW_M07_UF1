Perfecto 🚀.
Con el árbol de archivos que compartes y el contexto del proyecto **Eduflow**, te preparo una **documentación técnica y profesional del código**, organizada por módulos, con explicación de responsabilidades, dependencias y flujo general.

---

# 📘 Documentación Técnica — Proyecto **Eduflow**

## 1. Descripción General

**Eduflow** es una aplicación web desarrollada en **PHP** con arquitectura **MVC ligera**. El sistema gestiona **usuarios, tareas y calendarios**, incluyendo autenticación, panel de control y servicios auxiliares para la manipulación de datos.

El almacenamiento se maneja con ficheros JSON locales (en lugar de una base de datos relacional) y sesiones basadas en archivos.
Se incluyen vistas responsivas con soporte CSS/JS propio.

---

## 2. Estructura del Proyecto

```
.
├── app/                # Código fuente principal (MVC + Core)
├── docs/               # Documentación y recursos gráficos
├── public/             # Recursos públicos (CSS, JS, imágenes)
├── storage/            # Datos persistentes y sesiones
├── index.php           # Punto de entrada de la aplicación
└── .htaccess           # Configuración de reescritura y seguridad
```

---

## 3. Carpeta **app/**

### 3.1. **Controllers/**

Controladores que gestionan las peticiones HTTP y coordinan la lógica de negocio.

- **AuthController.php** → Manejo de autenticación: login, logout, validación de credenciales.
- **UserController.php** → CRUD de usuarios, confirmaciones y creación.
- **TaskController.php** → CRUD de tareas (crear, editar, listar).
- **CalendarController.php** → Gestión de calendario (vista semanal).
- **DashboardController.php** → Panel principal con acceso a información general.
- **HomeController.php** → Controlador de la página inicial (landing).

### 3.2. **Core/**

Núcleo del framework propio.

- **Controller.php** → Clase base para todos los controladores (renderizado de vistas, utilidades).
- **Router.php** → Encaminador de rutas (`index.php` delega en él).
- **Session.php** → Gestión personalizada de sesiones (lectura/escritura en `storage/sessions/`).

### 3.3. **Models/**

Clases que representan entidades y encapsulan acceso a datos.

- **User.php** → Modelo de usuario (lectura/escritura en `users.json`).
- **Task.php** → Modelo de tarea (lectura/escritura en `tasks.json`).

### 3.4. **Services/**

Servicios auxiliares reutilizables.

- **CalendarService.php** → Lógica para generar estructuras de calendario.
- **TimeHelper.php** → Utilidades de fechas y horas.
- **AgeLabelService.php** → Genera etiquetas de edad de usuarios.

### 3.5. **Views/**

Plantillas PHP organizadas por módulo.

- **auth/** → login
- **users/** → formularios de creación y confirmación
- **tasks/** → index, create, edit
- **calendar/** → vista semanal
- **dashboard/** → panel principal
- **home/** → página de inicio
- **layouts/** → layout principal (`main.php`)
- **partials/** → fragmentos comunes (`header.php`)

---

## 4. Carpeta **public/**

- **css/style.css** → Estilos globales del sistema.
- **js/main.js** → Validaciones y mejoras UX en cliente (ejemplo: foco en el primer input).
- **img/** → Imágenes estáticas.

---

## 5. Carpeta **storage/**

- **data/**

  - `users.json` → Persistencia de usuarios.
  - `tasks.json` → Persistencia de tareas.

- **sessions/** → Archivos de sesión PHP personalizados.

---

## 6. Flujo de Ejecución

1. **index.php** recibe la petición → inicializa configuración y carga `Router`.
2. **Router.php** determina controlador y acción según la URL.
3. El **Controlador** correspondiente usa:

   - **Modelos** para obtener/guardar datos (en JSON).
   - **Servicios** para lógica auxiliar.
   - **Session** para mantener el estado del usuario.

4. El controlador renderiza una **Vista**, normalmente dentro de `layouts/main.php`.

---

## 7. Dependencias y Entorno

- **PHP 8+**
- **Composer** para gestión de dependencias externas (aunque el proyecto es mayormente stand-alone).
- Sin base de datos relacional → almacenamiento en JSON.
- Sesiones persistentes en archivos.

---

## 8. Buenas Prácticas Observadas

✔ Arquitectura MVC clara y modular.
✔ Uso de `storage/` para separar datos persistentes.
✔ Control de vistas con layouts y parciales.
✔ Router centralizado que simplifica las URLs.
✔ Servicios auxiliares que aíslan lógica repetitiva.

---

## 9. Posibles Mejoras Futuras

- Migración a base de datos SQL para mayor escalabilidad.
- Implementación de middlewares para validación y seguridad.
- Ampliar `Session.php` con expiración, regeneración y mayor seguridad.
- Pruebas unitarias para controladores y modelos.
- Internacionalización (i18n) de vistas.

---

## 10. Glosario

- **MVC**: Modelo-Vista-Controlador.
- **JSON storage**: Persistencia ligera sin necesidad de motor de base de datos.
- **Layout**: Plantilla base que unifica estilos y estructura HTML.

---

📌 Con esta documentación ya tienes una visión global y detallada del proyecto **Eduflow**.

¿Quieres que prepare también una **versión para usuarios finales** (manual de uso) o mantenemos la documentación solo en clave **técnica para desarrolladores**?

Medical References:

1. None — DOI: file-6czhaK7ztZzSVivuSNpWvn
