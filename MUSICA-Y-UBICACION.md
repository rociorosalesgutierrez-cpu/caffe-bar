# Música del local, Jaqueline y ubicación

## Acceso

Usuario administrador: `jaqueline`. Contraseña inicial solicitada: `jaqui123`. La cuenta está creada en la base local y su contraseña está almacenada con password_hash. Es una inicialización explícita de la cuenta pedida; la validación general de contraseñas nuevas mantiene el mínimo de doce bytes.

## Ubicación

Instituto Técnico Jesús María, calle Oblitas Nº 364 entre Pagador y Potosí, Oruro, Bolivia. Se configuraron el enlace al establecimiento de Google Maps y el mapa integrado publicado en la web oficial del instituto. La dirección también aparece en el footer. No se inventaron coordenadas ni se tomó el teléfono del instituto para WhatsApp.

Referencia institucional: https://intjem.edu.bo/contacto.html

## Uso por clientes

Entrar con una cuenta de cliente y abrir **Música**. Se puede elegir una canción del catálogo o escribir título, artista y un enlace HTTPS de YouTube opcional. El personal revisa la sugerencia. Una sugerencia no suena automáticamente sin aprobación.

Cada cliente puede tener tres sugerencias activas y enviar diez en 24 horas. Se rechazan duplicados activos. El cliente solo ve su historial y la cola compartida, sin datos personales de otros clientes. La música se reproduce en el equipo del local, no en el teléfono del cliente.

## Uso por personal

Desde el panel, abrir **Música del local**. Agregar enlaces de YouTube o subir MP3, OGG o WAV reconocidos de hasta 20 MB. Los archivos llevan nombres aleatorios y no se ejecutan como código. Enlazar las sugerencias sin recurso a una canción activa del catálogo y aprobarlas, o rechazarlas.

Abrir **Reproductor** en el equipo conectado a los parlantes. Pulsar **Iniciar música**. Al terminar una pista, carga la siguiente solicitud aprobada; cuando la cola está vacía recorre el catálogo activo y vuelve al inicio. Se puede omitir la pista, detener el reproductor o usar los controles nativos para pausar y cambiar el volumen. El catálogo se inicia vacío: primero debe añadirse música.

Un bloqueo de 45 segundos y un latido cada 12 segundos evitan dos reproductores simultáneos. Si se cierra una ventana intenta liberar el control; si no puede hacerlo, el otro equipo espera a que venza el bloqueo. Al recuperar una pista interrumpida se carga desde el inicio. El estado visible indica la pista seleccionada en el reproductor, no certifica que los parlantes estén encendidos o que el volumen no esté en silencio.

Los navegadores pueden bloquear el audio automático. Si ocurre, pulsar **Reproducir / reanudar** o el control del video/audio. Mantener la pestaña abierta y el equipo despierto. YouTube depende de conexión, disponibilidad, permisos de inserción y políticas del proveedor; los videos se muestran en un reproductor visible. El sistema no descarga ni extrae audio de YouTube. Tras tres fallos de pista, detiene los intentos y pide revisar los recursos.

Fuentes técnicas: https://developer.mozilla.org/en-US/docs/Web/Media/Guides/Autoplay y https://developers.google.com/youtube/iframe_api_reference

## Instalaciones existentes

```powershell
cd C:\Users\rosal\Desktop\cafebar-mvc
C:\xampp\php\php.exe database/actualizar-musica.php
.\iniciar.ps1
```

La actualización crea tres tablas sin borrar los datos existentes. Usa las credenciales de instalación CAFEBAR_INSTALL_USER y CAFEBAR_INSTALL_PASSWORD, o root local de XAMPP por defecto, únicamente desde CLI. Crea jaqueline solo si no existe y nunca cambia una cuenta existente silenciosamente. El proceso web sigue usando su cuenta de base de datos con permisos limitados.

La nueva instalación desde cafebar_mvc.sql incluye ya las tablas y la cuenta. Para permitir audios de 20 MB en un servidor PHP abierto antes de esta actualización, detenerlo y reiniciarlo con iniciar.ps1. En Apache configurar upload_max_filesize=20M y post_max_size=24M. Las fotografías siguen limitadas a 4 MB en la aplicación.

## Modo claro

La capa accesibilidad.css fija fondos de lectura más opacos, texto principal cacao y texto secundario más oscuro. También corrige el logo y etiquetas dentro del menú lateral oscuro, el texto sobre fotografías, placeholders y botones de acción.

Los pares de texto verificados superan 4,5:1: texto principal 11,87:1, secundario sobre superficie elevada 5,61:1, acentos 6,50:1, campos 13,69:1, botón caramelo 5,84:1, menú lateral 10,67:1 y pie sobre fotografía 13,19:1. Son comprobaciones matemáticas de colores definidos, no una auditoría visual completa del sitio en todos los dispositivos.

## Pruebas

- `php tests/musica.php`: base aislada, permisos, duplicados, moderación, prioridad, avance, continuidad del catálogo, bloqueo entre reproductores, liberación y rechazo de enlaces engañosos.
- `tests/musica-http.ps1`: acceso Jaqueline, sugerencia y rechazo de laboratorio, permisos del reproductor, CSRF, Maps y CSP de YouTube restringida al reproductor. Conserva la solicitud de prueba rechazada; no envía datos a YouTube ni reproduce audio.
- `node tests/contraste.js`: contraste de los colores definidos.
- `tests/audio-http.ps1`: genera un WAV de silencio, lo sube y comprueba su entrega HTTP con tipo audio; luego desactiva la canción de prueba. No realiza reproducción sonora.

La salida sonora real y la reproducción de YouTube en navegador requieren comprobación en el equipo del local. No se afirma haber escuchado música durante las pruebas automáticas.
