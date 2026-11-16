# Verificación realizada

## Respuestas, compras del administrador, red local y factura

- Migración de contactos ejecutada dos veces sin perder consultas: propietario por ID de sesión, enlace privado con hash, respuesta, administrador responsable y fecha UTC.
- HTTP en base aislada: respuesta del administrador visible al visitante con su enlace y al cliente en Mis mensajes; no hay asociación automática por correo. Se rechazaron consultas por ID adivinable, tokens inexistentes, suplantación de propietario, respuestas sin rol administrativo y CSRF inválido. No se permite marcar respondido sin texto.
- Compra del administrador por HTTP: selección desde la carta, confirmación, descuento de stock, carrito vaciado, pedido vinculado al administrador y acceso administrativo conservado. Los empleados siguen sin acceso a compras. No se hicieron compras en la base de uso habitual.
- Factura: CSS externo servido por HTTP, botón data-print con JavaScript externo, datos antes del detalle, NIT y razón social del comprador editables por la ruta propia, acceso a documentos ajenos rechazado y datos malformados con estado 422. Se comprobaron importes desde cero hasta un millón, incluidos 1.250,50. No se generaron códigos fiscales simulados.
- Red: se inició un servidor PHP en la dirección Wi-Fi del equipo y se comprobaron Inicio y los recursos por esa dirección. La regla existente de Windows permite PHP/TCP en el perfil activo; no se desactivó ni se cambió el firewall. No se dispuso de un segundo dispositivo para verificar el recorrido completo desde otro equipo.
- La factura es de demostración. La prueba del botón comprueba la llamada a window.print; no se completó un diálogo físico de impresión ni se emitió una factura fiscal real.

## Código legible e indentación multilínea

Se reorganizaron los 98 archivos de código PHP, JavaScript, CSS, SQL, PowerShell y SVG que forman la aplicación y sus pruebas. Se conservaron las modificaciones previas de la vista de categorías. Se añadieron nombres de variables descriptivos, bloques explícitos y separación de instrucciones, junto con `.editorconfig` para mantener cuatro espacios de indentación.

La comparación de 38 páginas renderizadas antes y después conserva la estructura HTML, los textos y los atributos, excluyendo los tokens de sesión. Las hojas CSS conservan sus reglas; las fotografías y fuentes no se modificaron. Esta comparación no equivale a una inspección visual en un navegador.

Pasaron las pruebas de usuarios por HTTP en una base aislada, integración de pedidos y permisos, concurrencia de stock, música y reportes, además de las comprobaciones de sintaxis y contraste. Las expresiones de las pruebas aceptan espacios y saltos de línea entre atributos HTML.

## Actualización de música, ubicación y modo claro

- Jaqueline: creación con hash y autenticación correcta por modelo y HTTP como administradora.
- Google Maps: dirección del Instituto Técnico Jesús María, Oblitas Nº 364, Oruro; enlace al establecimiento y mapa integrado tomados del sitio institucional. No se comprobó visualmente el mapa remoto dentro del navegador.
- Música en base aislada: cliente activo, rechazo de duplicados y de roles no autorizados, moderación previa, cola prioritaria, avance al catálogo, historial, exclusión de otro dispositivo, liberación, catálogo inactivo y validación de enlaces YouTube. Base final conservada: coffe_music_test_df1293751a.
- Música por HTTP: sugerencia de cliente y rechazo por administradora, protección de reproductor, CSRF, JSON de control y permisos de YouTube limitados a esa página. Se conserva una solicitud de laboratorio rechazada.
- Audio: WAV de silencio generado por la prueba, subido mediante multipart, MIME reconocido, nombre aleatorio, descarga HTTP con tipo audio y posterior desactivación. El archivo de prueba no se incluye en el ZIP ni en la playlist activa.
- Regresión en bases aisladas: pedidos, contraseñas, claves foráneas y concurrencia de compradores aprobados tras añadir Jaqueline.
- Contraste calculado: todos los siete pares principales comprobados superan 4,5:1, con un mínimo de 5,61:1 en texto secundario sobre superficie elevada. No equivale a una inspección visual completa de todos los estados.

No se reprodujo sonido real ni se probó un video externo de YouTube en navegador. El catálogo activo se deja vacío para que el personal agregue su música. El autoplay puede necesitar un gesto explícito del operador, además de permisos, conexión y disponibilidad del proveedor. Los audios requieren subirlos al equipo donde corre PHP; luego se reproducen desde el navegador conectado a los parlantes.

## Actualización Coffe Music Bar

Se verificaron por HTTP el inicio, catálogo, Nosotros, Contactos, acceso y registro; la fuente Nunito local, el logotipo y la nueva hoja cristal.css responden con estado 200 y MIME correcto. Se revisó la sintaxis PHP de vistas, configuración, helpers, Front Controller y router. Se comprobaron por CLI la normalización de WhatsApp, el mensaje codificado, los dominios Maps permitidos, el rechazo de URL ejecutables o dominios engañosos y la generación del iframe. Los valores de prueba se establecieron exclusivamente en el entorno de ese proceso CLI y no se publicaron en la web. La dirección y WhatsApp reales están pendientes del usuario. No se afirma una revisión visual en navegador ni una comprobación de la ubicación del negocio.

## Actualización de diseño WE GO

Se revisó el recurso fotográfico y se verificaron las páginas y archivos del rediseño por HTTP, además de sintaxis PHP/JavaScript y acceso privado. No se repitieron compras o escrituras en la base para una modificación visual. El control visual de Edge fue detenido por la herramienta al no poder confirmar la URL actual con suficiente confianza. Véase DISENO-WEGO.md para el alcance del rediseño y sus límites de verificación.

Entorno: Windows, PHP 8.2.12, PDO MySQL y MariaDB 10.4.32 de XAMPP. La aplicación local utiliza una cuenta propia de MySQL con SELECT, INSERT, UPDATE y DELETE; no utiliza root para las peticiones web. GD se habilita en el arranque local.

## Comprobaciones aprobadas

- Sintaxis PHP mediante php -l y sintaxis JavaScript mediante node --check.
- Importación completa del SQL, con seis tablas, tres roles, cuatro categorías y nueve productos.
- Integración en una base aislada: autenticación de los tres roles, rechazo de inyección, precios oficiales e importes exactos, descuento de existencias, idempotencia, rollback sin cabecera parcial, cancelación con reposición única, protección de estados finales, claves foráneas, último administrador activo, cambio de contraseña con verificación y aislamiento de pedidos entre clientes.
- Concurrencia real con dos procesos PHP y dos compradores: un único producto con stock uno; un pedido aceptado, otro rechazado, stock final cero y una sola cabecera de pedido. Base conservada: cafebar_race_6686bfd6a1.
- HTTP: todas las páginas públicas y administrativas, indicadores, redirección de visitantes, restricciones de empleado y cliente por URL, CSRF inválido, checkout, total oficial, cancelación y logout.
- CRUD por HTTP: categoría, producto, subida PNG con conversión a JPG, edición y eliminación; registro y desactivación de empleado; recepción, lectura, cambio de estado y eliminación de mensajes.

Las bases aisladas de integración se conservan para revisión, incluida cafebar_test_6653aa7529. La base local de demostración conserva dos pedidos cancelados y un empleado de pruebas desactivado; las existencias del catálogo fueron repuestas.

## Límites de esta verificación

MySQL 8 y Apache/mod_rewrite no se ejecutaron directamente: las pruebas usaron MariaDB y el servidor integrado de PHP. El conector del navegador no estaba disponible y la ventana Chrome seleccionada estaba minimizada, por lo que no se pudo completar la inspección visual ni la interacción real de carrito en navegador. Se verificó su sintaxis; el checkout y los permisos sí se comprobaron por HTTP. No se ejecutó prueba de carga ni auditoría externa de seguridad.

No se hicieron envíos de correo, pagos ni publicaciones externas. Las imágenes iniciales son ilustraciones de código SVG; la subida de fotografías fue comprobada con una imagen de prueba.
