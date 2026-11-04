# Sistema de inventario de equipos tecnológicos

Aplicación web en **Laravel 12** y **MySQL** para que una empresa controle sus computadores, impresoras y demás dispositivos tecnológicos, organizados por categorías.

Evaluación Laravel – Grupo 1, Ejercicio 1.

## Módulos (CRUD)

| Módulo | Campos | Operaciones |
|---|---|---|
| **Equipos tecnológicos** | código, nombre, marca, modelo, número de serie, estado (disponible, asignado, mantenimiento), fecha de adquisición, categoría | crear, consultar (tabla con búsqueda y filtro por categoría), ver detalle, editar, eliminar con confirmación |
| **Categorías de equipos** | nombre, descripción, ubicación, estado (activa, inactiva) | crear, consultar (tabla con número de equipos), ver detalle con sus equipos, editar, eliminar con confirmación |

**Relación:** cada equipo pertenece a una categoría (`equipos.categoria_id` → `categorias.id`, clave foránea). Una categoría que todavía tiene equipos no se puede eliminar: el sistema muestra un mensaje de error y la base de datos también lo impide (`ON DELETE RESTRICT`).

### Validaciones

- Todos los campos marcados con `*` son obligatorios.
- Código del equipo, número de serie y nombre de categoría no se pueden repetir.
- El estado solo acepta los valores de la lista.
- La fecha de adquisición debe ser una fecha válida y no puede ser futura.
- La categoría elegida debe existir.
- Los mensajes de validación, éxito y error se muestran en español.

## Tecnologías

- PHP 8.2 o superior
- Laravel 12
- MySQL / MariaDB (XAMPP)
- Bootstrap 5.3 y Bootstrap Icons (por CDN, no requiere `npm`)
- PHPUnit para las pruebas y GitHub Actions para ejecutarlas en cada push

## Instalación

Requisitos: PHP 8.2+, Composer, Git y MySQL (por ejemplo, XAMPP con MySQL encendido).

```bash
# 1. Clonar el repositorio
git clone https://github.com/<usuario>/inventario-equipos.git
cd inventario-equipos

# 2. Instalar dependencias de PHP
composer install

# 3. Crear el archivo de entorno y la llave de la aplicación
cp .env.example .env        # en Windows (cmd): copy .env.example .env
php artisan key:generate
```

4. Crear la base de datos vacía `inventario_equipos` en phpMyAdmin (cotejamiento `utf8mb4_unicode_ci`) o con:

```sql
CREATE DATABASE inventario_equipos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

5. Revisar en `.env` los datos de conexión (los de XAMPP vienen por defecto):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventario_equipos
DB_USERNAME=root
DB_PASSWORD=
```

6. Crear las tablas y cargar los datos de prueba, y arrancar el servidor:

```bash
php artisan migrate --seed
php artisan serve
```

Abrir <http://127.0.0.1:8000>.

Para volver a dejar la base de datos con los datos de prueba originales: `php artisan migrate:fresh --seed`.

## Datos de prueba

El seeder (`database/seeders/DatabaseSeeder.php`) registra 5 categorías (Computadores, Impresoras, Redes y conectividad, Audiovisuales y Periféricos) y 13 equipos con marcas, modelos y números de serie de ejemplo.

## Pruebas

```bash
php artisan test
```

Las pruebas (`tests/Feature`) cubren las cuatro operaciones de cada CRUD, las validaciones y la regla de no eliminar categorías con equipos. En local usan SQLite en memoria; en GitHub Actions (`.github/workflows/tests.yml`) se ejecutan contra un servicio de **MySQL 8** en cada push y pull request a `main` y `develop`.

## Estructura principal

```
app/Http/Controllers/CategoriaController.php
app/Http/Controllers/EquipoController.php
app/Http/Requests/CategoriaRequest.php     # reglas de validación
app/Http/Requests/EquipoRequest.php
app/Models/Categoria.php                   # hasMany equipos
app/Models/Equipo.php                      # belongsTo categoria
database/migrations/                       # tablas categorias y equipos
database/seeders/DatabaseSeeder.php        # datos de prueba
resources/views/layouts/                   # plantilla Bootstrap, menú y alertas
resources/views/categorias/                # vistas del CRUD de categorías
resources/views/equipos/                   # vistas del CRUD de equipos
routes/web.php                             # Route::resource de ambos módulos
tests/Feature/                             # pruebas automatizadas
```

## Flujo de trabajo con Git

- `main`: versión estable.
- `develop`: integración de los avances.
- Los cambios se hacen en `develop` (o en ramas `feature/...`) y se integran a `main` mediante Pull Requests.
- El archivo `.env`, las contraseñas y la carpeta `vendor` no se suben al repositorio (ver `.gitignore`).
