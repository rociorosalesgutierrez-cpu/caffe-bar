# Núcleo MVC

Esta carpeta contiene la infraestructura común de la aplicación. Las reglas del negocio siguen en `app/controllers` y `app/models`.

| Archivo | Responsabilidad |
|---|---|
| `inicio.php` | Configura la zona horaria interna y registra el cargador de clases. |
| `Autocargador.php` | Busca clases en `core` y en las carpetas de `app`. |
| `Aplicacion.php` | Prepara sesiones, encabezados de seguridad y manejo de errores. |
| `rutas.php` | Relaciona cada método HTTP y dirección con un controlador y una acción. |
| `Enrutador.php` | Busca la ruta y ejecuta la acción del controlador. |
| `Vista.php` | Carga la plantilla pública o administrativa y la vista solicitada. |
| `Conexion.php` | Abre la conexión PDO y ejecuta consultas preparadas. |

## Recorrido de una solicitud

1. `public/index.php` carga el inicio del núcleo y las funciones auxiliares.
2. `Aplicacion` prepara la sesión y recibe la dirección solicitada.
3. `Enrutador` busca la dirección en `rutas.php`.
4. El controlador consulta el modelo y presenta una vista o una respuesta JSON.

Ejemplos de rutas actuales:

```php
'GET /mis-pedidos' => [PedidoController::class, 'mios'],
'GET /mis-pedidos/estado' => [PedidoController::class, 'estados'],
'POST /admin/pedidos/estado' => [PedidoController::class, 'estado'],
```

El cliente puede leer el estado de sus pedidos. Los cambios de estado requieren una cuenta administrativa o de personal y un token CSRF válido.

La configuración privada de MySQL permanece en `app/config/local.php`, excluida de Git. El directorio público continúa siendo `public`; `core` no se publica como carpeta de archivos.
