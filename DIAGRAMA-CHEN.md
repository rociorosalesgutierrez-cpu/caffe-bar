# Diagrama de la base de datos en notación de Chen

El diagrama representa el esquema actual de `cafebar_mvc`: **9 entidades, 69 atributos y 10 relaciones declaradas mediante claves foráneas**. Se obtuvo consultando únicamente metadatos de la base de datos; no contiene registros, contraseñas ni datos personales.

## Archivos

- [Imagen PNG](diagrama-base-datos-chen.png): versión de alta resolución para visualizar o insertar en un documento.
- [Diagrama SVG](diagrama-base-datos-chen.svg): versión vectorial que permite ampliar sin perder calidad.
- [Fuente Graphviz DOT](diagrama-base-datos-chen.dot): código editable del diagrama.

## Notación

- **Rectángulo:** entidad.
- **Rombo:** relación entre entidades.
- **Óvalo:** atributo. Se conservan los nombres reales de los campos de la base de datos.
- **Atributo subrayado:** clave primaria.
- **1 y N:** relación de uno a muchos.
- **Línea doble entre entidad y relación:** participación obligatoria; la clave foránea correspondiente no admite `NULL`.
- **Línea simple entre entidad y relación:** participación opcional. Las líneas que unen atributos con entidades no expresan participación.

## Relaciones verificadas

| Entidad del lado 1 | Relación | Entidad del lado N | Campo que establece la relación | Participación del lado N |
|---|---|---|---|---|
| `categorias` | clasifica | `productos` | `categoria_id` | Obligatoria |
| `usuarios` | realiza | `pedidos` | `usuario_id` | Obligatoria |
| `pedidos` | incluye | `detalle_pedido` | `pedido_id` | Obligatoria |
| `productos` | corresponde a | `detalle_pedido` | `producto_id` | Obligatoria |
| `usuarios` | envía | `mensajes_contacto` | `usuario_id` | Opcional: se permiten visitantes |
| `usuarios` | responde | `mensajes_contacto` | `respondido_por` | Opcional: puede no haber respuesta |
| `usuarios` | registra | `musica_sugerencias` | `usuario_id` | Obligatoria |
| `usuarios` | modera | `musica_sugerencias` | `moderador_id` | Opcional |
| `musica_canciones` | se solicita en | `musica_sugerencias` | `cancion_id` | Opcional |
| `musica_sugerencias` | reproduce | `musica_reproductor` | `sugerencia_id` | Opcional |

## Precisiones del esquema

- `ultima_cancion_id` se muestra como atributo de control de `musica_reproductor`: actualmente no tiene una clave foránea declarada.
- La aplicación utiliza el reproductor con `id = 1`. La cardinalidad del diagrama refleja las restricciones de la base de datos: `sugerencia_id` no tiene una restricción `UNIQUE`.
- Administrador, empleado y cliente son valores del atributo `usuarios.rol`.
- Los datos de la vista de factura provienen de `pedidos` y `detalle_pedido`; el esquema actual no tiene una tabla de facturas.

## Editar y volver a renderizar

Con Graphviz instalado:

```powershell
dot -Tsvg diagrama-base-datos-chen.dot -o diagrama-base-datos-chen.svg
dot -Tpng diagrama-base-datos-chen.dot -o diagrama-base-datos-chen.png
```

El archivo DOT conserva entidades, atributos, relaciones y cardinalidades. Los archivos entregados incluyen además el título y la leyenda de lectura.
