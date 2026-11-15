# Rediseño WE GO

Se conserva la marca WE GO y su identidad azul marino/crema presente en los archivos del usuario. Nueva dirección editorial: tipografía serif de sistema para titulares y sans para controles; mayor espacio entre secciones; fotografía cálida con recorte arqueado; botones uniformes; superficies y estados coherentes en catálogo y administración.

## Cambios de experiencia

- Menú móvil con estado aria-expanded, cierre mediante Escape y clic exterior; indicador de página activa y enlace para saltar al contenido.
- Temas oscuro y claro persistentes mediante atributos CSS. Inicialización en script local antes de cargar la hoja; sin estilos inline ni dependencias externas bloqueadas por CSP.
- Portada con categorías reales de la base y productos de distintas categorías, sin precios ni valoraciones inventadas.
- Carta con pestañas por categoría, búsqueda, número de resultados, restablecimiento y mensajes de selección vacía. La selección de categoría vuelve a consultar el catálogo para evitar filtrar sobre un subconjunto incompleto.
- Tarjetas con imagen contenida, precio visible, existencias y acción de compra. Los datos y las fotografías subidas del catálogo permanecen en la base.
- Dashboard, tablas, formularios, autenticación y carrito comparten tipografía, superficies, botones y estados legibles en ambos temas.
- Breakpoints en 1200, 960, 700 y 450 píxeles; tablas con desplazamiento horizontal; soporte de movimiento reducido y foco visible.

La hoja activa es `public/css/refinado.css`; `estilos.css` la importa como alias de compatibilidad. `styles.css`, que contenía las modificaciones anteriores, se conserva pero no se carga. Las copias de vistas y app.js previas al rediseño están en storage/diseno-anterior y no se incluyen en el ZIP.

## Recurso fotográfico

Archivo: `public/images/wego-hero.png` (1122 × 1402 píxeles). Generado mediante la herramienta integrada de generación de imágenes, sin API ni claves del usuario. Es una imagen conceptual de marca, no una fotografía documental del negocio.

Prompt utilizado:

> Use case: photorealistic-natural. Asset type: editorial hero photograph for an elegant independent coffee shop website named WE GO, dark midnight navy and warm cream branding. Create a premium, realistic food still-life photograph: a large ceramic ivory cup filled with beautiful flat white latte art on a matching saucer, a flaky golden croissant on a small charcoal ceramic plate, a small spoon, a few scattered coffee beans. Rich dark walnut cafe table and deep navy out-of-focus background, soft directional warm morning window lighting from upper left, beautifully tactile ceramic and pastry texture, cinematic chiaroscuro, sophisticated cafe magazine photography. Portrait composition 4:5, coffee cup is the focal point in center-right, croissant visible lower left, no people, no text, no logos, no watermark, absolutely photographic rather than illustration. This will fill a tall rounded rectangular hero panel on a web page.

## Verificación

Se inspeccionó la imagen generada y se comprobaron sintaxis PHP y JavaScript, entrega HTTP de las páginas públicas y recursos, permisos privados y lectura del dashboard. La revisión visual en Edge fue detenida por la herramienta al no poder determinar la URL con suficiente confianza; no se afirma una comprobación visual completa en navegador o móvil. Las comprobaciones finales no crean pedidos ni alteran existencias.
