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

5. **Emisión de Facturas Fiscales Bolivianas Imprimibles:**
   - Generación de factura legal con Número correlativo, NIT emisor (72320623018), Código de Autorización y Código Único de Facturación (CUF).
   - Conversión automática del importe total a palabras (numeral a literal en Bolivianos).
   - Edición en caliente del NIT/CI y Razón Social del cliente antes de imprimir.
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
   php -S 127.0.0.1:8080 -t public public/router.php
   ```
   - Abrir en el navegador: [http://127.0.0.1:8080/](http://127.0.0.1:8080/)

---

## 👥 Credenciales de Acceso de Demostración

| Rol | Usuario | Contraseña |
|---|---|---|
| **Administrador** | `admin` | `CafeBar2026!` |
| **Administradora** | `jaqueline` | `jaqui123` |
| **Personal / Empleado** | `empleado` | `CafeBar2026!` |
| **Cliente** | `cliente` | `CafeBar2026!` |

---

## 📁 Estructura del Proyecto

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
