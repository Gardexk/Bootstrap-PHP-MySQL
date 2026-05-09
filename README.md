# Bootstrap PHP MySQL

CRUD sencillo de productos hecho con PHP, MySQL y Bootstrap 5. Permite listar, crear, editar y eliminar productos con nombre, precio y existencia.

## Tecnologias

- PHP 8 o superior
- MySQL / MariaDB
- Bootstrap 5.2.3
- Font Awesome 6.4.0

## Instalacion

1. Clona o descarga el proyecto en tu servidor local, por ejemplo dentro de `htdocs` si usas XAMPP.
2. Crea la base de datos y la tabla ejecutando el archivo `database.sql` en MySQL.
3. Configura la conexion a la base de datos con variables de entorno:

```bash
DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=empresa
```

Si no defines variables de entorno, el proyecto usa esos mismos valores por defecto.

En XAMPP normalmente puedes dejar los valores por defecto si tu usuario de MySQL es `root`, no tiene contraseña y la base se llama `empresa`.

4. Abre el proyecto desde el navegador:

```text
http://localhost/Bootstrap-PHP-MySQL/
```

Tambien puedes usar el servidor integrado de PHP desde la carpeta del proyecto:

```bash
php -S 127.0.0.1:8000
```

## Estructura

```text
.
+-- add-new.php    # Formulario para crear productos
+-- db_conn.php    # Conexion a MySQL
+-- delete.php     # Eliminacion de productos
+-- edit.php       # Edicion de productos
+-- helpers.php    # Funciones auxiliares
+-- index.php      # Listado principal
+-- database.sql   # Script de base de datos
```

## Mejoras aplicadas

- Consultas preparadas para reducir riesgo de inyeccion SQL.
- Escape de salida HTML para evitar contenido no seguro en la interfaz.
- Validacion basica de identificadores, precios y existencias.
- Conexion con `utf8mb4` para soportar acentos y caracteres especiales.
- Mensajes de estado codificados correctamente en las redirecciones.
- Confirmacion antes de eliminar productos.
- Script SQL incluido para crear la base de datos.

## Tabla principal

La tabla `productos` contiene:

- `idpro`: identificador del producto.
- `nombre`: nombre del producto.
- `precio`: precio del producto.
- `existencia`: cantidad disponible.
- `created_at`: fecha de creacion del registro.
