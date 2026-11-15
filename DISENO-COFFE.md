# Coffe Music Bar · Cristal cálido

Identidad actual: Coffe Music Bar, con el logotipo SVG existente del negocio. El nombre se mantiene con la grafía indicada por el usuario.

## Paleta

| Uso | Tema oscuro | Tema claro |
|---|---|---|
| Fondo | Espresso #221916 | Crema #F4ECDF |
| Texto | Marfil #FAEFDC | Cacao #3F2D25 |
| Acento | Caramelo #EDB986 | Canela #96552F |
| Texto secundario | #C6B7A9 | #766356 |

El verde suave se reserva para contacto y los colores semánticos de pedidos se conservan. El cristal usa superficies cálidas translúcidas, desenfoque, bordes de luz y reflejos; los formularios mantienen campos sólidos legibles. El relieve se construye con sombras exteriores, luces interiores y gradientes de botón; no hay sombras de texto en párrafos. Existen alternativas de fondo sólido para navegadores sin backdrop-filter y soporte de movimiento reducido.

## Tipografía

Nunito variable, alojada en `public/fonts/nunito-variable.ttf`, con licencia incluida en `public/fonts/OFL-Nunito.txt`. Forma redondeada, informal y legible; pesos 500–850 para distinguir lectura, acciones y titulares. Se sirve localmente, sin peticiones de fuentes a terceros al visitar la página.

Fuente y licencia oficiales: https://github.com/google/fonts/tree/main/ofl/nunito

## Contacto y mapas

Configurar `app/config/datos-negocio.php` con `direccion`, `maps_url` y `whatsapp`. Se pueden sustituir por COFFE_DIRECCION, COFFE_MAPS_URL y COFFE_WHATSAPP en el entorno. WhatsApp admite número internacional con código de país, por ejemplo +591 seguido del número local. No se publica un número inventado.

Cuando hay datos reales, el footer ofrece el enlace de Google Maps, una tarjeta de ubicación y WhatsApp con mensaje inicial. Se incluye un botón flotante de WhatsApp. La página Contactos también muestra los accesos y, cuando hay dirección, un mapa integrado con carga diferida. Las URL Maps solo admiten HTTPS y dominios de Google previstos; el chat se construye como wa.me a partir de dígitos validados. Los enlaces abren otra pestaña con noopener/noreferrer. Abrir el chat no envía el mensaje automáticamente.

Si todavía no se ha proporcionado el número o ubicación exacta, se utiliza el formulario de consulta como alternativa. Los botones no conducen a destinos ficticios. La tarjeta gráfica del footer es decorativa y no constituye cartografía; el enlace lleva al mapa real configurado.

## Archivos

`refinado.css` mantiene la estructura adaptable y `cristal.css` aplica la nueva identidad y materiales. La cabecera carga ambas hojas en ese orden. El logo original se comparte mediante `layouts/marca.php` entre portal y administración. La imagen conceptual de café creada durante el diseño previo se conserva.

No se modificaron usuarios, contraseñas, precios, existencias ni pedidos. Las copias del diseño previo están en storage/diseno-antes-cristal, fuera de public y de la entrega.
