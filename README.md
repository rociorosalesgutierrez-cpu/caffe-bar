# caffe music bar ☕🎵

Sistema web MVC para cafetería, bar y restaurante desarrollado con arquitectura limpia en **PHP 8.2+**, **MySQL**, **PDO**, **HTML5 semántico**, **CSS3 (Tailwind CSS v4 `@theme` con tokens nativos `light-dark()`)** y **JavaScript moderno**.

**Repositorio oficial:** [https://github.com/rociorosalesgutierrez-cpu/caffe-bar](https://github.com/rociorosalesgutierrez-cpu/caffe-bar)

---

## 🌟 Características Principales

1. **Identidad Visual y Design System M3:**
   - Paleta oficial: Azul marino profundo (`#07162E`), Azul noche (`#0E213E`) y Crema cálido (`#F7EDD9`).
   - Logotipo vectorial oficial del oso tomando café con tipografía en bloque multilínea `caffe music bar`.
   - Rotador de temas Claro / Oscuro con Material Design 3 y función nativa `light-dark()` sin recargar página.

2. **Sugerencias musicales y reproducción en el local:**
   - Los clientes envían recomendaciones y consultan la canción actual, la cola y el estado de sus sugerencias.
   - El administrador y el personal revisan las sugerencias y controlan el reproductor del local.
   - Las páginas públicas y de clientes no incluyen controles de reproducción ni audio simulado.

3. **Carta del Menú con Fotografía Real en Alta Definición:**
   - 9 productos gastronómicos con fotos reales de autor (espresso, capuchino, latte, jugo de naranja natural, jugo de frutos rojos, torta de chocolate, cheesecake de frutos rojos, sándwich de pollo y sándwich vegetariano).

4. **Panel Administrativo con Módulo de Reportes de Ventas:**
   - Filtrado por rango de fechas (desde/hasta) y estado del pedido.
   - Tarjetas de métricas (Ingresos Totales en Bs., Total de Pedidos, Entregados vs. Cancelados, Ticket Promedio y Unidades Vendidas).
   - Ranking de productos más vendidos con gráfico de barras porcentuales.
   - Agrupación de ventas diarias y exportación directa a **CSV / Excel**.

5. **Vista de Factura de Demostración Imprimible:**
   - Datos reales del pedido, referencia, comprador y fechas de Bolivia. El documento está identificado como demostración; no emite facturas fiscales ni inventa NIT, CUF, autorización o QR.
   - Conversión automática del importe total a palabras (numeral a literal en Bolivianos).
   - Edición del NIT/CI y razón social del comprador para esa impresión, desde la ruta autorizada de cada cuenta.
   - Formato listo para impresión física con hoja de estilos `@media print`.

6. **Canales de Contacto Directo:**
   - Número oficial de atención y pedidos por WhatsApp: **+591 72320623**.
   - Integración con Google Maps para ubicación física en Oruro, Bolivia.

---

## 🚀 Puesta en Marcha Local

### Requisitos
- **PHP 8.1 o superior** con extensiones `pdo_mysql`, `mbstring`, `fileinfo` y `gd` activadas.
- **MySQL 8.0** o **MariaDB 10.4+** (ej. XAMPP).
- Apache con módulo `mod_rewrite` activo (o servidor CLI embebido de PHP).

### Instalación Rápida con XAMPP

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/rociorosalesgutierrez-cpu/caffe-bar.git
   cd caffe-bar
   ```

2. **Crear e importar la base de datos:**
   - Abrir **phpMyAdmin** o consola MySQL.
   - Crear una base de datos llamada `cafebar_mvc` con cotejamiento `utf8mb4_unicode_ci`.
   - Importar el archivo SQL ubicado en [`database/cafebar_mvc.sql`](database/cafebar_mvc.sql).

3. **Configuración de Conexión:**
   - Copiar `app/config/local.example.php` a `app/config/local.php` (o configurar variables de entorno):
   ```php
   <?php
   return [
       'dsn' => 'mysql:host=127.0.0.1;dbname=cafebar_mvc;charset=utf8mb4',
       'usuario' => 'root',
       'clave' => '',
   ];
   ```

4. **Iniciar el servidor de desarrollo:**
   - En Windows (PowerShell):
   ```powershell
   .\iniciar.ps1
   ```
   - O mediante el servidor interno de PHP:
   ```bash
   php -S 0.0.0.0:8080 -t public public/router.php
   ```
   - Abrir en el navegador: [http://127.0.0.1:8080/](http://127.0.0.1:8080/)

### Abrir desde un teléfono u otro equipo

`./iniciar.ps1` escucha en la red local y muestra el enlace con la IP del equipo. Ambos dispositivos deben conectarse a la misma red Wi-Fi o LAN. En el otro dispositivo abre `http://IP_DEL_EQUIPO:8080/`; `127.0.0.1` siempre se refiere al dispositivo que abre el enlace. Mantén encendido el equipo que ejecuta PHP. La IP puede cambiar al reconectar el Wi-Fi.

Para limitar el servidor al equipo actual, usa `./iniciar.ps1 -Escuchar 127.0.0.1`. El puerto se puede cambiar con `-Puerto 8081`. Si el firewall bloquea el acceso, permite PHP para la red local; no es necesario desactivar el firewall. Este servidor de desarrollo no publica el proyecto en Internet.

### Actualizar una instalación existente

Después de actualizar el código, ejecuta `php database/actualizar-contactos.php` con las credenciales de mantenimiento en `CAFEBAR_INSTALL_USER` y `CAFEBAR_INSTALL_PASSWORD`, si son necesarias. Añade las columnas de respuesta, propietario y seguimiento privado sin eliminar consultas anteriores. La cuenta web conserva sus permisos limitados de lectura y escritura.

---

### Recuperar una cuenta local de MySQL perdida

Si Inicio, La carta o el inicio de sesión devuelven error 500 y MySQL indica `Access denied`, comprueba la cuenta definida en `app/config/local.php`. Si esa cuenta fue creada por el instalador y ya no existe en MySQL, ejecuta:

```powershell
php database/instalar.php --repair-user
```

La reparación necesita acceso de mantenimiento al MySQL local (por defecto, `root` sin contraseña en XAMPP; las credenciales se pueden configurar con `CAFEBAR_INSTALL_USER` y `CAFEBAR_INSTALL_PASSWORD`). Recupera la cuenta con los permisos `SELECT`, `INSERT`, `UPDATE` y `DELETE` sobre `cafebar_mvc`, y comprueba la conexión. Conserva las tablas, los datos y las credenciales de `local.php`. Si la cuenta ya existe, se detiene sin cambiar su contraseña o permisos. No vuelvas a importar el SQL para resolver este error.

`app/config/local.php` está excluido de Git: las credenciales y la reparación de MySQL son locales; el repositorio conserva la herramienta para recuperarlas.

## 👥 Credenciales de Acceso de Demostración

| Rol | Usuario | Contraseña |
|---|---|---|
| **Administrador** | `admin` | `CafeBar2026!` |
| **Administradora** | `jaqueline` | `jaqui123` |
| **Personal / Empleado** | `empleado` | `CafeBar2026!` |
| **Cliente** | `cliente` | `CafeBar2026!` |

### Registro de usuarios y mensajes

El administrador registra usuarios desde **Mi panel → Usuarios**. El sistema confirma el ID del usuario después de completar la transacción. En la instalación local, los registros se consultan en **cafebar_mvc → usuarios**. Los nombres completos admiten letras Unicode, tildes, ñ, espacios, apóstrofes y guiones; los números se rechazan tanto en el formulario como en PHP. El identificador de usuario sí puede contener números.

Las contraseñas nuevas requieren al menos **8 caracteres**, con un máximo de 72 bytes para evitar el truncamiento de bcrypt. Esta regla se aplica al registro público, al alta administrativa y al cambio de contraseña del perfil. Cambiar una contraseña requiere la actual; las contraseñas existentes conservan su acceso.

El panel **Mensajes de contacto** recibe las consultas de **Contactos → Escríbenos algo** y las guarda en **cafebar_mvc → mensajes_contacto**. El administrador escribe en **Respuesta al cliente → Guardar respuesta**; el estado pasa a respondido y se guarda la fecha. Cambiar solo la etiqueta a respondido se rechaza si no hay una respuesta escrita.

Los usuarios con sesión ven sus consultas en **Mis mensajes**. Los visitantes reciben un enlace privado al enviar el formulario: deben guardarlo para leer la respuesta. Ese enlace da acceso a la consulta y se almacena como hash. Las consultas anteriores sin propietario ni enlace privado siguen en el panel; el administrador puede abrir el correo del remitente para responderlas manualmente. La aplicación no envía correo automáticamente ni integra las conversaciones de WhatsApp.

Las cuentas **cliente y administrador** pueden usar la carta, su carrito y **Mis pedidos**. El administrador conserva su rol y panel; sus compras se vinculan a su propio ID y descuentan stock mediante la misma transacción. El personal empleado mantiene el acceso operativo y no compra desde su cuenta.

**Facturas:** la vista usa los datos del pedido, estilos externos compatibles con CSP y el botón **Imprimir / guardar PDF**. Los datos del comprador aparecen antes del detalle. El importe en letras admite miles y millones. El NIT del emisor solo se muestra si se configura en `datos-negocio.php` o `COFFE_NIT`. La emisión fiscal real requiere la integración y configuración tributaria del negocio, que no forman parte de esta demostración.

Para comprobar validaciones, altas administrativas, registro público, cambio de contraseña y recepción de contactos por HTTP, ejecuta `php tests/usuarios.php`. La prueba crea y conserva una base aislada `cafebar_users_*`, comprueba los registros desde otra conexión MySQL y detiene su servidor temporal al terminar. Usa las variables `CAFEBAR_TEST_DSN`, `CAFEBAR_TEST_USER` y `CAFEBAR_TEST_PASSWORD` si la cuenta local de pruebas requiere configuración.

---

## 📁 Estructura del Proyecto

El código utiliza indentación de cuatro espacios, instrucciones separadas y bloques multilínea. Los nombres de variables describen los datos que contienen. Las vistas conservan sus clases y contenido; las hojas CSS mantienen el diseño. El archivo `.editorconfig` ayuda a conservar este formato en el editor.

Para actualizar la recopilación de código sin crear el ZIP, ejecuta `./generar-entrega.ps1 -SoloCodigo`.

```text
├── app/
│   ├── config/          # Conexión PDO, datos del negocio y configuración
│   ├── controllers/     # Controladores MVC (Auth, Reportes, Pedidos, Productos, etc.)
│   ├── helpers/         # Middleware, Validador, Token CSRF, Imágenes, Utilidades
│   ├── models/          # Modelos de datos con transacciones ACID y SELECT FOR UPDATE
│   └── views/           # Vistas públicas, de administración y layouts con liquid glass
├── database/            # Script SQL cafebar_mvc.sql y herramienta de instalación
├── public/
│   ├── css/             # styles.css, cristal.css, accesibilidad.css
│   ├── images/          # Fotografías reales de productos y logotipo SVG
│   ├── js/              # app.js (tocadiscos vinilo), carrito.js, reproductor.js
│   ├── uploads/         # Almacenamiento protegido de imágenes y pistas
│   └── index.php        # Front Controller y enrutador HTTP
└── storage/             # Almacenamiento privado (sesiones, límites por IP y logs)
```

---

## 🔒 Seguridad Implementada
- Autenticación mediante `password_hash()` con algoritmo BCRYPT y verificación estricta.
- Regeneración de ID de sesión y expiración automática por inactividad.
- Protección integral contra **CSRF** en todas las peticiones `POST`.
- Prevención de **SQL Injection** mediante sentencias preparadas PDO con emulación desactivada.
- Mitigación de **XSS** mediante escapado contextual `e()`.
- Content Security Policy (CSP) restrictiva y encabezados de seguridad HTTP (`X-Content-Type-Options: nosniff`, `Referrer-Policy: same-origin`).
- Rate limiting por IP para login, registro y formularios de contacto.

---

Desarrollado con dedicación para **caffe music bar**.
