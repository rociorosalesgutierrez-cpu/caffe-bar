# CafeBar MVC: construccion y codigo completo

## 1. Crear estructura desde PowerShell
```powershell
New-Item -ItemType Directory -Force cafebar-mvc/database, cafebar-mvc/app/config, cafebar-mvc/app/helpers, cafebar-mvc/app/models, cafebar-mvc/app/controllers, cafebar-mvc/app/views/layouts, cafebar-mvc/app/views/publico, cafebar-mvc/app/views/auth, cafebar-mvc/app/views/admin, cafebar-mvc/public/css, cafebar-mvc/public/js, cafebar-mvc/public/images, cafebar-mvc/public/uploads/productos, cafebar-mvc/tests
New-Item -ItemType File -Force cafebar-mvc/database/cafebar_mvc.sql
New-Item -ItemType File -Force cafebar-mvc/database/musica.sql
New-Item -ItemType File -Force cafebar-mvc/database/actualizar-musica.php
New-Item -ItemType File -Force cafebar-mvc/public/index.php
New-Item -ItemType File -Force cafebar-mvc/public/.htaccess
New-Item -ItemType File -Force cafebar-mvc/app/config/Config.php
New-Item -ItemType File -Force cafebar-mvc/app/config/Conexion.php
New-Item -ItemType File -Force cafebar-mvc/app/config/local.example.php
New-Item -ItemType File -Force cafebar-mvc/app/config/datos-negocio.php
New-Item -ItemType File -Force cafebar-mvc/app/helpers/Funciones.php
New-Item -ItemType File -Force cafebar-mvc/app/helpers/AuthMiddleware.php
New-Item -ItemType File -Force cafebar-mvc/app/helpers/CsrfToken.php
New-Item -ItemType File -Force cafebar-mvc/app/helpers/Validador.php
New-Item -ItemType File -Force cafebar-mvc/app/helpers/Intentos.php
New-Item -ItemType File -Force cafebar-mvc/app/helpers/Imagen.php
New-Item -ItemType File -Force cafebar-mvc/app/helpers/Negocio.php
New-Item -ItemType File -Force cafebar-mvc/app/helpers/AudioArchivo.php
New-Item -ItemType File -Force cafebar-mvc/app/models/UsuarioModel.php
New-Item -ItemType File -Force cafebar-mvc/app/models/CategoriaModel.php
New-Item -ItemType File -Force cafebar-mvc/app/models/ProductoModel.php
New-Item -ItemType File -Force cafebar-mvc/app/models/PedidoModel.php
New-Item -ItemType File -Force cafebar-mvc/app/models/MensajeModel.php
New-Item -ItemType File -Force cafebar-mvc/app/models/MusicaModel.php
New-Item -ItemType File -Force cafebar-mvc/app/controllers/PublicoController.php
New-Item -ItemType File -Force cafebar-mvc/app/controllers/AuthController.php
New-Item -ItemType File -Force cafebar-mvc/app/controllers/CarritoController.php
New-Item -ItemType File -Force cafebar-mvc/app/controllers/DashboardController.php
New-Item -ItemType File -Force cafebar-mvc/app/controllers/ProductoController.php
New-Item -ItemType File -Force cafebar-mvc/app/controllers/CategoriaController.php
New-Item -ItemType File -Force cafebar-mvc/app/controllers/UsuarioController.php
New-Item -ItemType File -Force cafebar-mvc/app/controllers/PedidoController.php
New-Item -ItemType File -Force cafebar-mvc/app/controllers/MensajeController.php
New-Item -ItemType File -Force cafebar-mvc/app/controllers/PerfilController.php
New-Item -ItemType File -Force cafebar-mvc/app/controllers/MusicaController.php
New-Item -ItemType File -Force cafebar-mvc/app/views/layouts/cabecera.php
New-Item -ItemType File -Force cafebar-mvc/app/views/layouts/aviso.php
New-Item -ItemType File -Force cafebar-mvc/app/views/layouts/publico.php
New-Item -ItemType File -Force cafebar-mvc/app/views/layouts/admin.php
New-Item -ItemType File -Force cafebar-mvc/app/views/layouts/marca.php
New-Item -ItemType File -Force cafebar-mvc/app/views/publico/inicio.php
New-Item -ItemType File -Force cafebar-mvc/app/views/publico/nosotros.php
New-Item -ItemType File -Force cafebar-mvc/app/views/publico/productos.php
New-Item -ItemType File -Force cafebar-mvc/app/views/publico/tarjetas.php
New-Item -ItemType File -Force cafebar-mvc/app/views/publico/contactos.php
New-Item -ItemType File -Force cafebar-mvc/app/views/publico/carrito.php
New-Item -ItemType File -Force cafebar-mvc/app/views/publico/error.php
New-Item -ItemType File -Force cafebar-mvc/app/views/publico/musica.php
New-Item -ItemType File -Force cafebar-mvc/app/views/auth/acceder.php
New-Item -ItemType File -Force cafebar-mvc/app/views/auth/registro.php
New-Item -ItemType File -Force cafebar-mvc/app/views/admin/campos-persona.php
New-Item -ItemType File -Force cafebar-mvc/app/views/admin/dashboard.php
New-Item -ItemType File -Force cafebar-mvc/app/views/admin/productos.php
New-Item -ItemType File -Force cafebar-mvc/app/views/admin/categorias.php
New-Item -ItemType File -Force cafebar-mvc/app/views/admin/usuarios.php
New-Item -ItemType File -Force cafebar-mvc/app/views/admin/pedidos.php
New-Item -ItemType File -Force cafebar-mvc/app/views/admin/pedido.php
New-Item -ItemType File -Force cafebar-mvc/app/views/admin/mensajes.php
New-Item -ItemType File -Force cafebar-mvc/app/views/admin/perfil.php
New-Item -ItemType File -Force cafebar-mvc/app/views/admin/musica.php
New-Item -ItemType File -Force cafebar-mvc/app/views/admin/reproductor.php
New-Item -ItemType File -Force cafebar-mvc/public/css/estilos.css
New-Item -ItemType File -Force cafebar-mvc/public/css/refinado.css
New-Item -ItemType File -Force cafebar-mvc/public/css/cristal.css
New-Item -ItemType File -Force cafebar-mvc/public/css/accesibilidad.css
New-Item -ItemType File -Force cafebar-mvc/public/css/musica.css
New-Item -ItemType File -Force cafebar-mvc/public/js/tema.js
New-Item -ItemType File -Force cafebar-mvc/public/js/app.js
New-Item -ItemType File -Force cafebar-mvc/public/js/carrito.js
New-Item -ItemType File -Force cafebar-mvc/public/js/musica.js
New-Item -ItemType File -Force cafebar-mvc/public/js/reproductor.js
New-Item -ItemType File -Force cafebar-mvc/public/fonts/OFL-Nunito.txt
New-Item -ItemType File -Force cafebar-mvc/public/images/cafe.svg
New-Item -ItemType File -Force cafebar-mvc/public/images/jugo.svg
New-Item -ItemType File -Force cafebar-mvc/public/images/postre.svg
New-Item -ItemType File -Force cafebar-mvc/public/images/sandwich.svg
New-Item -ItemType File -Force cafebar-mvc/public/images/logo.svg
New-Item -ItemType File -Force cafebar-mvc/public/uploads/productos/.htaccess
New-Item -ItemType File -Force cafebar-mvc/public/uploads/musica/.htaccess
New-Item -ItemType File -Force cafebar-mvc/public/router.php
New-Item -ItemType File -Force cafebar-mvc/database/instalar.php
New-Item -ItemType File -Force cafebar-mvc/iniciar.ps1
New-Item -ItemType File -Force cafebar-mvc/tests/integracion.php
New-Item -ItemType File -Force cafebar-mvc/tests/concurrencia.php
New-Item -ItemType File -Force cafebar-mvc/tests/http.ps1
New-Item -ItemType File -Force cafebar-mvc/tests/http-crud.ps1
New-Item -ItemType File -Force cafebar-mvc/tests/imagen-prueba.php
New-Item -ItemType File -Force cafebar-mvc/tests/musica.php
New-Item -ItemType File -Force cafebar-mvc/tests/musica-http.ps1
New-Item -ItemType File -Force cafebar-mvc/tests/audio-http.ps1
New-Item -ItemType File -Force cafebar-mvc/tests/contraste.js
New-Item -ItemType File -Force cafebar-mvc/.gitignore
New-Item -ItemType File -Force cafebar-mvc/README.md
New-Item -ItemType File -Force cafebar-mvc/VERIFICACION.md
New-Item -ItemType File -Force cafebar-mvc/DISENO-WEGO.md
New-Item -ItemType File -Force cafebar-mvc/DISENO-COFFE.md
New-Item -ItemType File -Force cafebar-mvc/MUSICA-Y-UBICACION.md
New-Item -ItemType File -Force cafebar-mvc/generar-entrega.ps1
Set-Location cafebar-mvc
```

## 2. database/cafebar_mvc.sql
```sql
CREATE DATABASE IF NOT EXISTS cafebar_mvc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cafebar_mvc;
CREATE TABLE usuarios (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(120) NOT NULL,
 usuario VARCHAR(40) NOT NULL UNIQUE,
 correo VARCHAR(190) NOT NULL UNIQUE,
 telefono VARCHAR(25) NOT NULL DEFAULT '',
 direccion VARCHAR(250) NOT NULL DEFAULT '',
 password_hash VARCHAR(255) NOT NULL,
 rol ENUM('administrador','empleado','cliente') NOT NULL DEFAULT 'cliente',
 estado BOOLEAN NOT NULL DEFAULT 1,
 creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE categorias (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(80) NOT NULL UNIQUE,
 descripcion VARCHAR(500) NOT NULL,
 estado BOOLEAN NOT NULL DEFAULT 1
) ENGINE=InnoDB;
CREATE TABLE productos (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 categoria_id INT UNSIGNED NOT NULL,
 nombre VARCHAR(120) NOT NULL,
 descripcion VARCHAR(1000) NOT NULL,
 precio DECIMAL(10,2) NOT NULL,
 stock INT UNSIGNED NOT NULL DEFAULT 0,
 imagen VARCHAR(255) NOT NULL DEFAULT 'images/cafe.svg',
 estado BOOLEAN NOT NULL DEFAULT 1,
 FOREIGN KEY(categoria_id) REFERENCES categorias(id) ON DELETE RESTRICT,
 CHECK(precio > 0),
 INDEX(categoria_id,estado)
) ENGINE=InnoDB;
CREATE TABLE pedidos (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 usuario_id INT UNSIGNED NOT NULL,
 fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 total DECIMAL(12,2) NOT NULL,
 estado ENUM('pendiente','preparando','entregado','cancelado') NOT NULL DEFAULT 'pendiente',
 token CHAR(64) NOT NULL UNIQUE,
 FOREIGN KEY(usuario_id) REFERENCES usuarios(id) ON DELETE RESTRICT,
 INDEX(usuario_id,fecha),
 INDEX(estado,fecha),
 CHECK(total >= 0)
) ENGINE=InnoDB;
CREATE TABLE detalle_pedido (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 pedido_id BIGINT UNSIGNED NOT NULL,
 producto_id INT UNSIGNED NOT NULL,
 nombre_producto VARCHAR(120) NOT NULL,
 cantidad INT UNSIGNED NOT NULL,
 precio_unitario DECIMAL(10,2) NOT NULL,
 subtotal DECIMAL(12,2) NOT NULL,
 UNIQUE(pedido_id,producto_id),
 FOREIGN KEY(pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
 FOREIGN KEY(producto_id) REFERENCES productos(id) ON DELETE RESTRICT,
 CHECK(cantidad > 0 AND precio_unitario > 0 AND subtotal > 0)
) ENGINE=InnoDB;
CREATE TABLE mensajes_contacto (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(120) NOT NULL,
 correo VARCHAR(190) NOT NULL,
 asunto VARCHAR(150) NOT NULL,
 contenido TEXT NOT NULL,
 fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 estado ENUM('nuevo','leido','respondido') NOT NULL DEFAULT 'nuevo'
) ENGINE=InnoDB;
-- Cuentas de laboratorio: admin, empleado y cliente. Contraseña para las tres: CafeBar2026!
-- Hash real generado con password_hash('CafeBar2026!', PASSWORD_DEFAULT).
INSERT INTO usuarios(nombre,usuario,correo,telefono,direccion,password_hash,rol) VALUES
('Administración CafeBar','admin','admin@cafebar.test','70000001','Oruro, Bolivia','$2y$10$R2xVBfMwa/LobobjsjhGSO8qu/YURDGjHwk4GbpdzR0eGOg3FUK7m','administrador'),
('Personal CafeBar','empleado','empleado@cafebar.test','70000002','Oruro, Bolivia','$2y$10$R2xVBfMwa/LobobjsjhGSO8qu/YURDGjHwk4GbpdzR0eGOg3FUK7m','empleado'),
('Cliente de demostración','cliente','cliente@cafebar.test','70000003','Oruro, Bolivia','$2y$10$R2xVBfMwa/LobobjsjhGSO8qu/YURDGjHwk4GbpdzR0eGOg3FUK7m','cliente');
INSERT INTO categorias(nombre,descripcion) VALUES
('Cafés','Café recién preparado para acompañar tu día.'),('Jugos','Fruta y frescura en cada vaso.'),('Postres','Dulces elaborados en nuestra cocina.'),('Sándwiches','Una pausa sabrosa y completa.');
INSERT INTO productos(categoria_id,nombre,descripcion,precio,stock,imagen) VALUES
(1,'Espresso de la casa','Café intenso, aromático y de extracción corta.',12.00,60,'images/cafe.svg'),
(1,'Capuchino cremoso','Espresso con leche vaporizada y una suave capa de espuma.',18.00,45,'images/cafe.svg'),
(1,'Latte caramelo','Café con leche y un delicado toque de caramelo.',22.00,35,'images/cafe.svg'),
(2,'Jugo de naranja','Naranja exprimida al momento, sin azúcar añadida.',15.00,30,'images/jugo.svg'),
(2,'Jugo de frutos rojos','Una mezcla fresca de frutas rojas de temporada.',18.00,25,'images/jugo.svg'),
(3,'Torta de chocolate','Porción de bizcocho de cacao con cobertura de chocolate.',20.00,18,'images/postre.svg'),
(3,'Cheesecake de frutos rojos','Base crujiente, crema de queso y salsa de frutos rojos.',24.00,15,'images/postre.svg'),
(4,'Sándwich de pollo','Pan tostado con pollo, lechuga, tomate y salsa de la casa.',25.00,25,'images/sandwich.svg'),
(4,'Sándwich vegetariano','Verduras frescas, queso y una suave crema de hierbas.',23.00,20,'images/sandwich.svg');
INSERT INTO mensajes_contacto(nombre,correo,asunto,contenido) VALUES
('Ana de prueba','ana@example.test','Consulta sobre reservas','Hola, ¿puedo reservar una mesa para cuatro personas?');
-- Cuenta solicitada: usuario jaqueline, contraseña inicial jaqui123.
INSERT INTO usuarios(nombre,usuario,correo,password_hash,rol,estado) VALUES
('Jaqueline','jaqueline','jaqueline@cafebar.test','$2y$10$FJCBQpqLmFTNft4Nit8MPeL5yvNmlztMKWnFGA1I8To00Do4Qc282','administrador',1);

CREATE TABLE IF NOT EXISTS musica_canciones (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 titulo VARCHAR(150) NOT NULL,
 artista VARCHAR(120) NOT NULL,
 fuente ENUM('archivo','youtube') NOT NULL,
 recurso VARCHAR(255) NOT NULL,
 activo BOOLEAN NOT NULL DEFAULT 1,
 creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS musica_sugerencias (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 usuario_id INT UNSIGNED NOT NULL,
 cancion_id INT UNSIGNED NULL,
 titulo VARCHAR(150) NOT NULL,
 artista VARCHAR(120) NOT NULL,
 youtube_id CHAR(11) NULL,
 estado ENUM('pendiente','en_cola','reproduciendo','reproducida','rechazada','omitida') NOT NULL DEFAULT 'pendiente',
 creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 aprobado DATETIME NULL,
 moderador_id INT UNSIGNED NULL,
 FOREIGN KEY(usuario_id) REFERENCES usuarios(id) ON DELETE RESTRICT,
 FOREIGN KEY(cancion_id) REFERENCES musica_canciones(id) ON DELETE RESTRICT,
 FOREIGN KEY(moderador_id) REFERENCES usuarios(id) ON DELETE RESTRICT,
 INDEX(estado,aprobado,id),
 INDEX(usuario_id,creado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS musica_reproductor (
 id TINYINT UNSIGNED PRIMARY KEY,
 sugerencia_id BIGINT UNSIGNED NULL,
 ultima_cancion_id INT UNSIGNED NULL,
 dispositivo CHAR(64) NULL,
 actualizado DATETIME NULL,
 FOREIGN KEY(sugerencia_id) REFERENCES musica_sugerencias(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT IGNORE INTO musica_reproductor(id) VALUES(1);

```

## 3. database/musica.sql
```sql
CREATE TABLE IF NOT EXISTS musica_canciones (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 titulo VARCHAR(150) NOT NULL,
 artista VARCHAR(120) NOT NULL,
 fuente ENUM('archivo','youtube') NOT NULL,
 recurso VARCHAR(255) NOT NULL,
 activo BOOLEAN NOT NULL DEFAULT 1,
 creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS musica_sugerencias (
 id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 usuario_id INT UNSIGNED NOT NULL,
 cancion_id INT UNSIGNED NULL,
 titulo VARCHAR(150) NOT NULL,
 artista VARCHAR(120) NOT NULL,
 youtube_id CHAR(11) NULL,
 estado ENUM('pendiente','en_cola','reproduciendo','reproducida','rechazada','omitida') NOT NULL DEFAULT 'pendiente',
 creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 aprobado DATETIME NULL,
 moderador_id INT UNSIGNED NULL,
 FOREIGN KEY(usuario_id) REFERENCES usuarios(id) ON DELETE RESTRICT,
 FOREIGN KEY(cancion_id) REFERENCES musica_canciones(id) ON DELETE RESTRICT,
 FOREIGN KEY(moderador_id) REFERENCES usuarios(id) ON DELETE RESTRICT,
 INDEX(estado,aprobado,id),
 INDEX(usuario_id,creado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
CREATE TABLE IF NOT EXISTS musica_reproductor (
 id TINYINT UNSIGNED PRIMARY KEY,
 sugerencia_id BIGINT UNSIGNED NULL,
 ultima_cancion_id INT UNSIGNED NULL,
 dispositivo CHAR(64) NULL,
 actualizado DATETIME NULL,
 FOREIGN KEY(sugerencia_id) REFERENCES musica_sugerencias(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT IGNORE INTO musica_reproductor(id) VALUES(1);

```

## 4. database/actualizar-musica.php
```php
<?php
declare(strict_types=1);
if(PHP_SAPI!=='cli')exit(1);
require dirname(__DIR__).'/app/helpers/Funciones.php';
$c=Config::db();$pdo=new PDO($c['dsn'],getenv('CAFEBAR_INSTALL_USER')?:'root',getenv('CAFEBAR_INSTALL_PASSWORD')?:'',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES=>false]);
foreach(preg_split('/;\s*(?:\r?\n|$)/',file_get_contents(__DIR__.'/musica.sql')) as $sql){if(trim($sql)!=='')$pdo->prepare($sql)->execute();}
$column=$pdo->prepare('SELECT COUNT(*) FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name=? AND column_name=?');$column->execute(['musica_reproductor','ultima_cancion_id']);
if(!$column->fetchColumn())$pdo->prepare('ALTER TABLE musica_reproductor ADD COLUMN ultima_cancion_id INT UNSIGNED NULL')->execute();
$q=$pdo->prepare('SELECT id FROM usuarios WHERE usuario=?');$q->execute(['jaqueline']);$id=$q->fetchColumn();
if(!$id){
    $pdo->prepare('INSERT INTO usuarios(nombre,usuario,correo,password_hash,rol,estado) VALUES(?,?,?,?,?,1)')->execute(['Jaqueline','jaqueline','jaqueline@cafebar.test',password_hash('jaqui123',PASSWORD_DEFAULT),'administrador']);
    echo "Administradora jaqueline creada con la contraseña solicitada, almacenada como hash.\n";
}else{
    echo "La cuenta jaqueline ya existe y se conserva sin modificar su contraseña ni su rol.\n";
}
echo "Tablas musicales actualizadas sin borrar datos existentes.\n";

```

## 5. public/index.php
```php
<?php
declare(strict_types=1);
define('BASE_URL',rtrim(str_replace('\\','/',dirname($_SERVER['SCRIPT_NAME'])),'/.'));
require dirname(__DIR__).'/app/helpers/Funciones.php';
ini_set('display_errors','0');ini_set('session.use_strict_mode','1');ini_set('session.use_only_cookies','1');
foreach(['sessions','limites','tmp'] as $dir){$path=dirname(__DIR__).'/storage/'.$dir;if(!is_dir($path)&&!mkdir($path,0700,true)&&!is_dir($path)){http_response_code(503);exit('No se pudo preparar el almacenamiento privado.');}}
session_save_path(dirname(__DIR__).'/storage/sessions');session_name('cafebar_session');
session_set_cookie_params(['lifetime'=>0,'path'=>BASE_URL?:'/','secure'=>!empty($_SERVER['HTTPS'])&&$_SERVER['HTTPS']!=='off','httponly'=>true,'samesite'=>'Lax']);
if(!session_start()){http_response_code(503);exit('No se pudo iniciar la sesión.');}
$solicitudPath='/'.trim(substr(rawurldecode(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)?:'/'),strlen(BASE_URL)),'/');
$youtubePermitido=$solicitudPath==='/admin/musica/reproductor';
$scriptPolicy=$youtubePermitido?"'self' https://www.youtube.com https://s.ytimg.com":"'self'";
$framePolicy='https://maps.google.com https://www.google.com'.($youtubePermitido?' https://www.youtube.com https://www.youtube-nocookie.com':'');
header("Content-Security-Policy: default-src 'self'; script-src $scriptPolicy; style-src 'self'; font-src 'self'; img-src 'self' data:; media-src 'self'; frame-src $framePolicy; object-src 'none'; base-uri 'self'; frame-ancestors 'none'; form-action 'self'");
header('X-Content-Type-Options: nosniff');header('Referrer-Policy: same-origin');header('Cache-Control: no-store');
$path='/'.trim(substr(rawurldecode(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)?:'/'),strlen(BASE_URL)),'/');
$routes=[
 'GET /'=>[PublicoController::class,'inicio'],'GET /nosotros'=>[PublicoController::class,'nosotros'],
 'GET /productos'=>[PublicoController::class,'productos'],'GET /contactos'=>[PublicoController::class,'contactos'],'POST /contactos'=>[PublicoController::class,'enviar'],
 'GET /acceder'=>[AuthController::class,'acceder'],'POST /acceder'=>[AuthController::class,'login'],
 'GET /registro'=>[AuthController::class,'registro'],'POST /registro'=>[AuthController::class,'registrar'],'POST /salir'=>[AuthController::class,'salir'],
 'GET /carrito'=>[CarritoController::class,'index'],'POST /carrito/confirmar'=>[CarritoController::class,'confirmar'],
 'GET /admin'=>[DashboardController::class,'index'],'GET /admin/indicadores'=>[DashboardController::class,'indicadores'],
 'GET /admin/productos'=>[ProductoController::class,'index'],'POST /admin/productos/guardar'=>[ProductoController::class,'guardar'],'POST /admin/productos/eliminar'=>[ProductoController::class,'eliminar'],
 'GET /admin/categorias'=>[CategoriaController::class,'index'],'POST /admin/categorias/guardar'=>[CategoriaController::class,'guardar'],'POST /admin/categorias/eliminar'=>[CategoriaController::class,'eliminar'],
 'GET /admin/usuarios'=>[UsuarioController::class,'index'],'POST /admin/usuarios/guardar'=>[UsuarioController::class,'guardar'],
 'GET /admin/pedidos'=>[PedidoController::class,'index'],'POST /admin/pedidos/estado'=>[PedidoController::class,'estado'],
 'GET /mis-pedidos'=>[PedidoController::class,'mios'],'GET /pedido'=>[PedidoController::class,'detalle'],
 'GET /admin/mensajes'=>[MensajeController::class,'index'],'POST /admin/mensajes/estado'=>[MensajeController::class,'estado'],'POST /admin/mensajes/eliminar'=>[MensajeController::class,'eliminar'],
 'GET /perfil'=>[PerfilController::class,'index'],'POST /perfil'=>[PerfilController::class,'guardar'],
 'GET /musica'=>[MusicaController::class,'index'],'GET /musica/estado'=>[MusicaController::class,'estado'],
 'POST /musica/sugerir'=>[MusicaController::class,'sugerir'],
 'POST /admin/musica/agregar'=>[MusicaController::class,'agregar'],'POST /admin/musica/moderar'=>[MusicaController::class,'moderar'],
 'POST /admin/musica/encolar'=>[MusicaController::class,'encolar'],'POST /admin/musica/activar'=>[MusicaController::class,'activar'],
 'GET /admin/musica/reproductor'=>[MusicaController::class,'reproductor'],'POST /admin/musica/control'=>[MusicaController::class,'control'],
];
try{
    $ruta=$routes[$_SERVER['REQUEST_METHOD'].' '.$path]??null;
    if(!$ruta){http_response_code(404);vista('publico/error',['mensaje'=>'La página solicitada no existe.']);}
    else{(new $ruta[0]())->{$ruta[1]}();}
}catch(DomainException $e){if(http_response_code()<400)http_response_code(422);vista('publico/error',['mensaje'=>$e->getMessage()]);}
catch(JsonException $e){http_response_code(422);vista('publico/error',['mensaje'=>'El carrito contiene un formato inválido.']);}
catch(Throwable $e){error_log((string)$e);http_response_code(500);if($path==='/admin/indicadores')jsonRespuesta(['error'=>'Servicio no disponible.'],500);vista('publico/error',['mensaje'=>'No se pudo completar la solicitud. Revisa la conexión o el registro del servidor.']);}

```

## 6. public/.htaccess
```text
Options -Indexes
DirectoryIndex index.php
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]

```

## 7. app/config/Config.php
```php
<?php
declare(strict_types=1);
final class Config
{
    public static function db(): array
    {
        if(getenv('CAFEBAR_DSN'))return ['dsn'=>getenv('CAFEBAR_DSN'),'usuario'=>getenv('CAFEBAR_DB_USER')?:'cafebar','clave'=>getenv('CAFEBAR_DB_PASSWORD')?:''];
        $file=__DIR__.'/local.php';
        return is_file($file) ? require $file : [
            'dsn'=>getenv('CAFEBAR_DSN') ?: 'mysql:host=127.0.0.1;dbname=cafebar_mvc;charset=utf8mb4',
            'usuario'=>getenv('CAFEBAR_DB_USER') ?: 'cafebar',
            'clave'=>getenv('CAFEBAR_DB_PASSWORD') ?: '',
        ];
    }
}

```

## 8. app/config/Conexion.php
```php
<?php
declare(strict_types=1);
final class Conexion
{
    public static function obtener(): PDO
    {
        static $pdo;
        if (!$pdo) {
            $c=Config::db();
            $pdo=new PDO($c['dsn'],$c['usuario'],$c['clave'],[
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES=>false,
            ]);
            $pdo->prepare("SET time_zone = '+00:00'")->execute();
        }
        return $pdo;
    }
    public static function consulta(string $sql,array $datos=[]): PDOStatement
    {
        $q=self::obtener()->prepare($sql);$q->execute($datos);return $q;
    }
}

```

## 9. app/config/local.example.php
```php
<?php
declare(strict_types=1);
return [
 'dsn'=>'mysql:host=127.0.0.1;dbname=cafebar_mvc;charset=utf8mb4',
 'usuario'=>'cafebar',
 'clave'=>'CAMBIAR_POR_LA_CLAVE_DE_LA_BASE',
];

```

## 10. app/config/datos-negocio.php
```php
<?php
declare(strict_types=1);
return [
    'nombre'=>'Coffe Music Bar',
    'ciudad'=>'Oruro, Bolivia',
    'direccion'=>'Instituto Técnico Jesús María, calle Oblitas Nº 364 entre Pagador y Potosí',
    'maps_url'=>'https://www.google.com/maps?cid=5666542721018396729',
    'maps_embed'=>'https://www.google.com/maps/embed?pb=%211m14%211m8%211m3%211d15181.010390780475%212d-67.10326981627426%213d-17.966981247305554%213m2%211i1024%212i768%214f13.1%213m3%211m2%211s0x0%3A0x4ea39a9506e08039%212zSW5zdGl0dXRvIFTDqWNuaWNvIEplc8O6cyBNYXLDrWE%215e0%213m2%211ses-419%212sbo%214v1511760647220',
    'whatsapp'=>'',
    'mensaje_whatsapp'=>'Hola, Coffe Music Bar. Quisiera hacer una consulta.',
];

```

## 11. app/helpers/Funciones.php
```php
<?php
declare(strict_types=1);
date_default_timezone_set('UTC');
spl_autoload_register(function(string $clase): void {
    if (!preg_match('/^[A-Za-z]+$/D',$clase)) return;
    foreach(['config','helpers','models','controllers'] as $dir) {
        $file=dirname(__DIR__).'/'.$dir.'/'.$clase.'.php';
        if(is_file($file)) {require $file;return;}
    }
});
function e(mixed $v): string {return htmlspecialchars((string)$v,ENT_QUOTES|ENT_SUBSTITUTE,'UTF-8');}
function url(string $ruta=''): string {return BASE_URL.'/'.ltrim($ruta,'/');}
function redirigir(string $ruta): never {header('Location: '.url($ruta),true,303);exit;}
function bs(mixed $valor): string {return 'Bs. '.number_format((float)$valor,2,',','.');}
function centavos(string $precio): int {[$entero,$decimal]=array_pad(explode('.',$precio),2,'0');return (int)$entero*100+(int)str_pad($decimal,2,'0');}
function decimal(int $centavos): string {return intdiv($centavos,100).'.'.str_pad((string)($centavos%100),2,'0',STR_PAD_LEFT);}
function flash(string $mensaje,bool $ok=true): void {$_SESSION['flash']=['mensaje'=>$mensaje,'ok'=>$ok];}
function vista(string $archivo,array $datos=[],bool $panel=false): void {
    extract($datos,EXTR_SKIP);
    $actual=AuthMiddleware::usuario();
    $aviso=$_SESSION['flash']??null;unset($_SESSION['flash']);
    require dirname(__DIR__).'/views/layouts/'.($panel?'admin':'publico').'.php';
}
function jsonRespuesta(array $datos,int $codigo=200): never {
    http_response_code($codigo);header('Content-Type: application/json; charset=utf-8');
    echo json_encode($datos,JSON_UNESCAPED_UNICODE|JSON_THROW_ON_ERROR);exit;
}
function postAccion(callable $accion,string $volver): never {
    CsrfToken::verificar();
    try {$accion();flash('Cambios guardados correctamente.');}
    catch(DomainException $ex){flash($ex->getMessage(),false);}
    catch(PDOException $ex){if($ex->getCode()==='23000')flash('No se puede guardar: hay un dato duplicado o registros relacionados.',false);else throw $ex;}
    redirigir($volver);
}

```

## 12. app/helpers/AuthMiddleware.php
```php
<?php
declare(strict_types=1);
final class AuthMiddleware
{
    public static function usuario(): ?array {
        if(empty($_SESSION['uid']))return null;
        if(time()-($_SESSION['actividad']??0)>1800||time()-($_SESSION['inicio']??0)>28800){self::salir();return null;}
        $u=(new UsuarioModel())->buscar((int)$_SESSION['uid']);
        if(!$u||!$u['estado']){self::salir();return null;}
        $_SESSION['actividad']=time();return $u;
    }
    public static function exigir(array $roles=[]): array {
        $u=self::usuario();if(!$u)redirigir('acceder');
        if($roles&&!in_array($u['rol'],$roles,true)){http_response_code(403);throw new DomainException('No tienes permiso para acceder a este módulo.');}
        return $u;
    }
    public static function entrar(array $u): void {
        session_regenerate_id(true);
        $_SESSION=['uid'=>$u['id'],'inicio'=>time(),'actividad'=>time(),'csrf'=>bin2hex(random_bytes(32))];
    }
    public static function salir(): void {
        $_SESSION=[];
        if(ini_get('session.use_cookies')){
            $p=session_get_cookie_params();setcookie(session_name(),'', ['expires'=>time()-42000,'path'=>$p['path'],'secure'=>$p['secure'],'httponly'=>true,'samesite'=>'Lax']);
        }
        session_destroy();session_start();session_regenerate_id(true);
    }
}

```

## 13. app/helpers/CsrfToken.php
```php
<?php
declare(strict_types=1);
final class CsrfToken
{
    public static function valor(): string {return $_SESSION['csrf']??=bin2hex(random_bytes(32));}
    public static function campo(): string {return '<input type="hidden" name="csrf" value="'.e(self::valor()).'">';}
    public static function verificar(): void {
        $token=$_POST['csrf']??($_SERVER['HTTP_X_CSRF_TOKEN']??null);
        if(!is_string($token)||!hash_equals(self::valor(),$token)) {http_response_code(403);throw new DomainException('Formulario caducado o token CSRF inválido. Recarga la página.');}
    }
}

```

## 14. app/helpers/Validador.php
```php
<?php
declare(strict_types=1);
final class Validador
{
    public static function texto(array $d,string $k,int $min,int $max): string {
        $v=$d[$k]??null;
        if(!is_string($v))throw new DomainException('Campo inválido: '.$k);
        $v=trim($v);
        if(!preg_match('//u',$v)||mb_strlen($v)<$min||mb_strlen($v)>$max||preg_match('/[\x00-\x08\x0B\x0C\x0E-\x1F]/',$v))throw new DomainException('Revisa el campo '.$k.' ('.$min.'–'.$max.' caracteres).');
        return $v;
    }
    public static function entero(array $d,string $k,int $min=1,int $max=2147483647): int {
        $v=filter_var($d[$k]??null,FILTER_VALIDATE_INT,['options'=>['min_range'=>$min,'max_range'=>$max]]);
        if($v===false)throw new DomainException('Número inválido: '.$k);return $v;
    }
    public static function opcion(array $d,string $k,array $opciones): string {
        $v=self::texto($d,$k,1,40);if(!in_array($v,$opciones,true))throw new DomainException('Selección inválida: '.$k);return $v;
    }
    public static function correo(array $d): string {
        $v=strtolower(self::texto($d,'correo',3,190));if(!filter_var($v,FILTER_VALIDATE_EMAIL))throw new DomainException('Correo inválido.');return $v;
    }
    public static function clave(array $d,string $k='clave'): string {
        $v=$d[$k]??null;if(!is_string($v)||strlen($v)<12||strlen($v)>72)throw new DomainException('La contraseña debe tener entre 12 y 72 bytes.');return $v;
    }
    public static function precio(array $d): string {
        $v=self::texto($d,'precio',1,12);
        if(!preg_match('/^\d{1,6}(\.\d{1,2})?$/D',$v)||centavos($v)<1)throw new DomainException('Precio inválido. Usa punto decimal y un importe mayor que cero.');
        return decimal(centavos($v));
    }
    public static function persona(array $d): array {
        $usuario=self::texto($d,'usuario',3,40);
        if(!preg_match('/^[a-zA-Z0-9_.-]+$/D',$usuario))throw new DomainException('El usuario solo admite letras, números, punto, guion y guion bajo.');
        $telefono=self::texto($d,'telefono',0,25);
        if($telefono!==''&&!preg_match('/^[+0-9 ()-]{6,25}$/D',$telefono))throw new DomainException('Teléfono inválido.');
        return ['nombre'=>self::texto($d,'nombre',3,120),'usuario'=>$usuario,'correo'=>self::correo($d),'telefono'=>$telefono,'direccion'=>self::texto($d,'direccion',0,250)];
    }
}

```

## 15. app/helpers/Intentos.php
```php
<?php
declare(strict_types=1);
final class Intentos
{
    public static function registrar(string $grupo,int $limite,int $segundos): void {
        $archivo=dirname(__DIR__,2).'/storage/limites/'.hash('sha256',$grupo.'|'.($_SERVER['REMOTE_ADDR']??'local')).'.json';
        $f=fopen($archivo,'c+');if(!$f)throw new RuntimeException('No se pudo abrir el limitador.');
        try {
            if(!flock($f,LOCK_EX))throw new RuntimeException('No se pudo bloquear el limitador.');
            $d=json_decode(stream_get_contents($f),true)?:['inicio'=>time(),'total'=>0];
            if(time()-$d['inicio']>=$segundos)$d=['inicio'=>time(),'total'=>0];
            if($d['total']>=$limite)throw new DomainException('Demasiados intentos. Vuelve a intentarlo más tarde.');
            $d['total']++;rewind($f);ftruncate($f,0);fwrite($f,json_encode($d,JSON_THROW_ON_ERROR));fflush($f);
        }finally{flock($f,LOCK_UN);fclose($f);}
    }
}

```

## 16. app/helpers/Imagen.php
```php
<?php
declare(strict_types=1);
final class Imagen
{
    public static function guardar(array $archivo): ?string {
        if(($archivo['error']??UPLOAD_ERR_NO_FILE)===UPLOAD_ERR_NO_FILE)return null;
        if(!isset($archivo['error'])||is_array($archivo['error'])||$archivo['error']!==UPLOAD_ERR_OK||($archivo['size']??0)>4*1024*1024)throw new DomainException('La imagen no debe superar 4 MB y debe subirse correctamente.');
        if(!is_uploaded_file($archivo['tmp_name']))throw new DomainException('Archivo de imagen inválido.');
        $mime=(new finfo(FILEINFO_MIME_TYPE))->file($archivo['tmp_name']);
        $info=getimagesize($archivo['tmp_name']);
        if(!in_array($mime,['image/jpeg','image/png','image/webp'],true)||!$info||$info[0]>3000||$info[1]>3000)throw new DomainException('Usa una imagen JPG, PNG o WebP de hasta 3000 × 3000 píxeles.');
        $original=imagecreatefromstring(file_get_contents($archivo['tmp_name']));
        if(!$original)throw new DomainException('No se pudo decodificar la imagen.');
        $nueva=imagecreatetruecolor($info[0],$info[1]);
        imagefill($nueva,0,0,imagecolorallocate($nueva,250,246,240));imagecopy($nueva,$original,0,0,0,0,$info[0],$info[1]);
        $ruta='uploads/productos/'.bin2hex(random_bytes(20)).'.jpg';
        try {if(!imagejpeg($nueva,dirname(__DIR__,2).'/public/'.$ruta,85))throw new RuntimeException('No se pudo almacenar la imagen.');}
        finally{imagedestroy($original);imagedestroy($nueva);}
        return $ruta;
    }
    public static function quitar(?string $ruta): void {
        if($ruta&&preg_match('~^uploads/productos/[a-f0-9]{40}\.jpg$~D',$ruta)){
            $file=dirname(__DIR__,2).'/public/'.$ruta;if(is_file($file))unlink($file);
        }
    }
}

```

## 17. app/helpers/Negocio.php
```php
<?php
declare(strict_types=1);
final class Negocio
{
    public static function datos(): array
    {
        $d=require dirname(__DIR__).'/config/datos-negocio.php';
        foreach(['direccion'=>'COFFE_DIRECCION','maps_url'=>'COFFE_MAPS_URL','whatsapp'=>'COFFE_WHATSAPP'] as $clave=>$variable){
            $valor=getenv($variable);if($valor!==false&&$valor!=='')$d[$clave]=$valor;
        }
        return $d;
    }
    public static function whatsapp(): ?string
    {
        $d=self::datos();$numero=preg_replace('/[\s()+-]/','',$d['whatsapp']);
        if(!preg_match('/^[1-9][0-9]{7,14}$/D',$numero))return null;
        return 'https://wa.me/'.$numero.'?text='.rawurlencode($d['mensaje_whatsapp']);
    }
    public static function maps(): ?string
    {
        $d=self::datos();
        if($d['maps_url']!==''){
            $u=parse_url($d['maps_url']);$host=strtolower($u['host']??'');
            if(($u['scheme']??'')==='https'&&in_array($host,['maps.app.goo.gl','goo.gl','www.google.com','google.com','maps.google.com'],true)&&empty($u['user'])&&empty($u['pass']))return $d['maps_url'];
        }
        return $d['direccion']!==''?'https://www.google.com/maps/search/?api=1&query='.rawurlencode($d['direccion'].', '.$d['ciudad']):null;
    }
    public static function mapaIntegrado(): ?string
    {
        $d=self::datos();
        if(!empty($d['maps_embed'])&&!getenv('COFFE_DIRECCION')&&!getenv('COFFE_MAPS_URL')){
            $u=parse_url($d['maps_embed']);
            if(($u['scheme']??'')==='https'&&($u['host']??'')==='www.google.com'&&($u['path']??'')==='/maps/embed'&&empty($u['user'])&&empty($u['pass']))return $d['maps_embed'];
        }
        return $d['direccion']!==''?'https://maps.google.com/maps?q='.rawurlencode($d['direccion'].', '.$d['ciudad']).'&output=embed':null;
    }
}

```

## 18. app/helpers/AudioArchivo.php
```php
<?php
declare(strict_types=1);
final class AudioArchivo
{
    public static function guardar(array $f): string
    {
        if(!isset($f['error'])||is_array($f['error'])||$f['error']!==UPLOAD_ERR_OK||($f['size']??0)<44||$f['size']>20*1024*1024)throw new DomainException('Sube un archivo MP3, OGG o WAV de hasta 20 MB.');
        if(!is_uploaded_file($f['tmp_name']))throw new DomainException('Origen de archivo inválido.');
        $mime=(new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
        $tipos=['audio/mpeg'=>'mp3','audio/mp3'=>'mp3','audio/ogg'=>'ogg','application/ogg'=>'ogg','audio/x-wav'=>'wav','audio/wav'=>'wav','audio/vnd.wave'=>'wav'];
        if(!isset($tipos[$mime]))throw new DomainException('El archivo no es un audio MP3, OGG o WAV reconocido.');
        $dir=dirname(__DIR__,2).'/public/uploads/musica';
        if(!is_dir($dir)&&!mkdir($dir,0750,true)&&!is_dir($dir))throw new RuntimeException('No se pudo preparar el directorio de música.');
        $ruta='uploads/musica/'.bin2hex(random_bytes(20)).'.'.$tipos[$mime];
        if(!move_uploaded_file($f['tmp_name'],dirname(__DIR__,2).'/public/'.$ruta))throw new RuntimeException('No se pudo guardar el audio.');
        return $ruta;
    }
    public static function youtube(string $url): string
    {
        $p=parse_url(trim($url));
        if(!$p||($p['scheme']??'')!=='https'||isset($p['user'])||isset($p['pass']))throw new DomainException('Usa un enlace HTTPS de YouTube válido.');
        $host=strtolower($p['host']??'');$id='';
        if($host==='youtu.be')$id=trim($p['path']??'','/');
        elseif(in_array($host,['youtube.com','www.youtube.com','m.youtube.com'],true)){
            parse_str($p['query']??'',$q);
            if(($p['path']??'')==='/watch')$id=is_string($q['v']??null)?$q['v']:'';
            elseif(preg_match('~^/(?:shorts|embed)/([A-Za-z0-9_-]{11})/?$~D',$p['path']??'',$m))$id=$m[1];
        }
        if(!preg_match('/^[A-Za-z0-9_-]{11}$/D',$id))throw new DomainException('No se encontró un video de YouTube válido en el enlace.');
        return $id;
    }
}

```

## 19. app/models/UsuarioModel.php
```php
<?php
declare(strict_types=1);
final class UsuarioModel
{
    public function buscar(int $id): array|false {return Conexion::consulta('SELECT id,nombre,usuario,correo,telefono,direccion,rol,estado FROM usuarios WHERE id=?',[$id])->fetch();}
    public function listar(string $buscar=''): array {
        $q='%'.$buscar.'%';return Conexion::consulta('SELECT id,nombre,usuario,correo,telefono,direccion,rol,estado FROM usuarios WHERE nombre LIKE ? OR usuario LIKE ? OR correo LIKE ? ORDER BY id DESC LIMIT 500',[$q,$q,$q])->fetchAll();
    }
    public function autenticar(string $usuario,string $clave): array|false {
        $u=Conexion::consulta('SELECT * FROM usuarios WHERE usuario=?',[$usuario])->fetch();
        $hash=$u['password_hash']??'$2y$10$R2xVBfMwa/LobobjsjhGSO8qu/YURDGjHwk4GbpdzR0eGOg3FUK7m';
        $valido=password_verify($clave,$hash);
        if(!$valido||!$u||!$u['estado'])return false;
        if(password_needs_rehash($hash,PASSWORD_DEFAULT))Conexion::consulta('UPDATE usuarios SET password_hash=? WHERE id=?',[password_hash($clave,PASSWORD_DEFAULT),$u['id']]);
        unset($u['password_hash']);return $u;
    }
    public function guardar(array $d,string $rol,int $estado,?int $id=null,?string $clave=null): void {
        $pdo=Conexion::obtener();$pdo->beginTransaction();
        try {
            $admins=Conexion::consulta("SELECT id FROM usuarios WHERE rol='administrador' AND estado=1 ORDER BY id FOR UPDATE")->fetchAll();
            if($id){
                $anterior=Conexion::consulta('SELECT id,rol,estado FROM usuarios WHERE id=? FOR UPDATE',[$id])->fetch();
                if(!$anterior)throw new DomainException('Usuario inexistente.');
                if($anterior['rol']==='administrador'&&$anterior['estado']&&($rol!=='administrador'||!$estado)&&count($admins)<=1)throw new DomainException('Debe quedar al menos un administrador activo.');
                Conexion::consulta('UPDATE usuarios SET nombre=?,usuario=?,correo=?,telefono=?,direccion=?,rol=?,estado=? WHERE id=?',[...array_values($d),$rol,$estado,$id]);
            }else{
                if(!$clave)throw new DomainException('Falta la contraseña.');
                Conexion::consulta('INSERT INTO usuarios(nombre,usuario,correo,telefono,direccion,rol,estado,password_hash) VALUES(?,?,?,?,?,?,?,?)',[...array_values($d),$rol,$estado,password_hash($clave,PASSWORD_DEFAULT)]);
            }
            $pdo->commit();
        }catch(Throwable $e){$pdo->rollBack();throw $e;}
    }
    public function perfil(int $id,array $d,?string $actual,?string $nueva): void {
        $pdo=Conexion::obtener();$pdo->beginTransaction();
        try {
            $u=Conexion::consulta('SELECT password_hash FROM usuarios WHERE id=? FOR UPDATE',[$id])->fetch();
            if(!$u)throw new DomainException('Usuario inexistente.');
            if($nueva!==null){
                if(!$actual||!password_verify($actual,$u['password_hash']))throw new DomainException('La contraseña actual es incorrecta.');
                Conexion::consulta('UPDATE usuarios SET password_hash=? WHERE id=?',[password_hash($nueva,PASSWORD_DEFAULT),$id]);
            }
            Conexion::consulta('UPDATE usuarios SET nombre=?,usuario=?,correo=?,telefono=?,direccion=? WHERE id=?',[...array_values($d),$id]);
            $pdo->commit();
        }catch(Throwable $e){$pdo->rollBack();throw $e;}
    }
}

```

## 20. app/models/CategoriaModel.php
```php
<?php
declare(strict_types=1);
final class CategoriaModel
{
    public function listar(bool $publico=false): array {return Conexion::consulta('SELECT * FROM categorias'.($publico?' WHERE estado=1':'').' ORDER BY nombre')->fetchAll();}
    public function buscar(int $id): array|false {return Conexion::consulta('SELECT * FROM categorias WHERE id=?',[$id])->fetch();}
    public function guardar(string $nombre,string $descripcion,int $estado,?int $id): void {
        if($id){if(!$this->buscar($id))throw new DomainException('Categoría inexistente.');Conexion::consulta('UPDATE categorias SET nombre=?,descripcion=?,estado=? WHERE id=?',[$nombre,$descripcion,$estado,$id]);}
        else Conexion::consulta('INSERT INTO categorias(nombre,descripcion,estado) VALUES(?,?,?)',[$nombre,$descripcion,$estado]);
    }
    public function eliminar(int $id): void {Conexion::consulta('DELETE FROM categorias WHERE id=?',[$id]);}
}

```

## 21. app/models/ProductoModel.php
```php
<?php
declare(strict_types=1);
final class ProductoModel
{
    public function listar(bool $publico=false,string $buscar='',int $categoria=0): array {
        $sql='SELECT p.*,c.nombre categoria FROM productos p JOIN categorias c ON c.id=p.categoria_id WHERE p.nombre LIKE ?';$d=['%'.$buscar.'%'];
        if($publico)$sql.=' AND p.estado=1 AND c.estado=1';
        if($categoria){$sql.=' AND p.categoria_id=?';$d[]=$categoria;}
        return Conexion::consulta($sql.' ORDER BY p.id DESC LIMIT 500',$d)->fetchAll();
    }
    public function buscar(int $id): array|false {return Conexion::consulta('SELECT * FROM productos WHERE id=?',[$id])->fetch();}
    public function guardar(array $d,?int $id): void {
        if(!(new CategoriaModel())->buscar($d['categoria_id']))throw new DomainException('Categoría inexistente.');
        if($id){if(!$this->buscar($id))throw new DomainException('Producto inexistente.');Conexion::consulta('UPDATE productos SET categoria_id=?,nombre=?,descripcion=?,precio=?,stock=?,imagen=?,estado=? WHERE id=?',[...array_values($d),$id]);}
        else Conexion::consulta('INSERT INTO productos(categoria_id,nombre,descripcion,precio,stock,imagen,estado) VALUES(?,?,?,?,?,?,?)',array_values($d));
    }
    public function eliminar(int $id): void {Conexion::consulta('DELETE FROM productos WHERE id=?',[$id]);}
}

```

## 22. app/models/PedidoModel.php
```php
<?php
declare(strict_types=1);
final class PedidoModel
{
    public function crear(int $usuario,array $carrito,string $token): int {
        if(!$carrito||count($carrito)>50)throw new DomainException('El carrito debe contener entre 1 y 50 productos.');
        $items=[];
        foreach($carrito as $id=>$cantidad){
            $id=Validador::entero(['id'=>$id],'id');$cantidad=Validador::entero(['cantidad'=>$cantidad],'cantidad',1,99);$items[$id]=$cantidad;
        }
        ksort($items,SORT_NUMERIC);
        $pdo=Conexion::obtener();$pdo->beginTransaction();
        try {
            $user=Conexion::consulta('SELECT id,rol,estado FROM usuarios WHERE id=? FOR UPDATE',[$usuario])->fetch();
            if(!$user||!$user['estado']||$user['rol']!=='cliente')throw new DomainException('Solo clientes activos pueden confirmar pedidos.');
            $previo=Conexion::consulta('SELECT id,usuario_id FROM pedidos WHERE token=?',[$token])->fetch();
            if($previo){if((int)$previo['usuario_id']!==$usuario)throw new DomainException('Solicitud inválida.');$pdo->commit();return (int)$previo['id'];}
            $detalles=[];$total=0;
            foreach($items as $id=>$cantidad){
                $p=Conexion::consulta('SELECT p.*,c.estado categoria_activa FROM productos p JOIN categorias c ON c.id=p.categoria_id WHERE p.id=? FOR UPDATE',[$id])->fetch();
                if(!$p||!$p['estado']||!$p['categoria_activa']||$p['stock']<$cantidad)throw new DomainException('Stock insuficiente o producto no disponible: '.($p['nombre']??$id));
                $subtotal=centavos($p['precio'])*$cantidad;$total+=$subtotal;
                if($total>999999999999)throw new DomainException('El importe del pedido excede el límite.');
                $detalles[]=[$p,$cantidad,$subtotal];
            }
            Conexion::consulta('INSERT INTO pedidos(usuario_id,total,token) VALUES(?,?,?)',[$usuario,decimal($total),$token]);
            $pedido=(int)$pdo->lastInsertId();
            foreach($detalles as [$p,$cantidad,$subtotal]){
                Conexion::consulta('INSERT INTO detalle_pedido(pedido_id,producto_id,nombre_producto,cantidad,precio_unitario,subtotal) VALUES(?,?,?,?,?,?)',[$pedido,$p['id'],$p['nombre'],$cantidad,$p['precio'],decimal($subtotal)]);
                Conexion::consulta('UPDATE productos SET stock=stock-? WHERE id=?',[$cantidad,$p['id']]);
            }
            $pdo->commit();return $pedido;
        }catch(Throwable $e){if($pdo->inTransaction())$pdo->rollBack();throw $e;}
    }
    public function listar(?int $usuario=null): array {
        return Conexion::consulta('SELECT p.*,u.nombre cliente FROM pedidos p JOIN usuarios u ON u.id=p.usuario_id'.($usuario?' WHERE p.usuario_id=?':'').' ORDER BY p.id DESC LIMIT 500',$usuario?[$usuario]:[])->fetchAll();
    }
    public function detalle(int $id,?int $usuario=null): array {
        $p=Conexion::consulta('SELECT p.*,u.nombre cliente,u.telefono FROM pedidos p JOIN usuarios u ON u.id=p.usuario_id WHERE p.id=?'.($usuario?' AND p.usuario_id=?':''),$usuario?[$id,$usuario]:[$id])->fetch();
        if(!$p)throw new DomainException('Pedido inexistente o sin permiso.');
        $p['detalles']=Conexion::consulta('SELECT * FROM detalle_pedido WHERE pedido_id=? ORDER BY id',[$id])->fetchAll();return $p;
    }
    public function estado(int $id,string $nuevo): void {
        $pdo=Conexion::obtener();$pdo->beginTransaction();
        try {
            $p=Conexion::consulta('SELECT * FROM pedidos WHERE id=? FOR UPDATE',[$id])->fetch();
            if(!$p)throw new DomainException('Pedido inexistente.');
            if($p['estado']===$nuevo){$pdo->commit();return;}
            $transiciones=['pendiente'=>['preparando','cancelado'],'preparando'=>['entregado','cancelado'],'entregado'=>[],'cancelado'=>[]];
            if(!in_array($nuevo,$transiciones[$p['estado']],true))throw new DomainException('Transición no permitida. Entregados y cancelados son estados finales.');
            if($nuevo==='cancelado'){
                $det=Conexion::consulta('SELECT producto_id,cantidad FROM detalle_pedido WHERE pedido_id=? ORDER BY producto_id',[$id])->fetchAll();
                foreach($det as $d)Conexion::consulta('UPDATE productos SET stock=stock+? WHERE id=?',[$d['cantidad'],$d['producto_id']]);
            }
            Conexion::consulta('UPDATE pedidos SET estado=? WHERE id=?',[$nuevo,$id]);$pdo->commit();
        }catch(Throwable $e){$pdo->rollBack();throw $e;}
    }
    public function indicadores(bool $administrador): array {
        $datos=['productos'=>(int)Conexion::consulta('SELECT COUNT(*) FROM productos')->fetchColumn(),'pedidos'=>(int)Conexion::consulta('SELECT COUNT(*) FROM pedidos')->fetchColumn(),'pendientes'=>(int)Conexion::consulta("SELECT COUNT(*) FROM pedidos WHERE estado='pendiente'")->fetchColumn()];
        if($administrador){$datos['categorias']=(int)Conexion::consulta('SELECT COUNT(*) FROM categorias')->fetchColumn();$datos['usuarios']=(int)Conexion::consulta('SELECT COUNT(*) FROM usuarios')->fetchColumn();}
        return $datos;
    }
}

```

## 23. app/models/MensajeModel.php
```php
<?php
declare(strict_types=1);
final class MensajeModel
{
    public function listar(): array {return Conexion::consulta('SELECT * FROM mensajes_contacto ORDER BY id DESC LIMIT 500')->fetchAll();}
    public function crear(string $nombre,string $correo,string $asunto,string $contenido): void {Conexion::consulta('INSERT INTO mensajes_contacto(nombre,correo,asunto,contenido) VALUES(?,?,?,?)',[$nombre,$correo,$asunto,$contenido]);}
    public function estado(int $id,string $estado): void {Conexion::consulta('UPDATE mensajes_contacto SET estado=? WHERE id=?',[$estado,$id]);}
    public function eliminar(int $id): void {Conexion::consulta('DELETE FROM mensajes_contacto WHERE id=?',[$id]);}
}

```

## 24. app/models/MusicaModel.php
```php
<?php
declare(strict_types=1);
final class MusicaModel
{
    public function catalogo(bool $todos=false): array
    {
        return Conexion::consulta('SELECT * FROM musica_canciones'.($todos?'':' WHERE activo=1').' ORDER BY titulo LIMIT 500')->fetchAll();
    }
    public function agregar(string $titulo,string $artista,string $fuente,string $recurso): void
    {
        Conexion::consulta('INSERT INTO musica_canciones(titulo,artista,fuente,recurso) VALUES(?,?,?,?)',[$titulo,$artista,$fuente,$recurso]);
    }
    public function activar(int $id,int $activo): void
    {
        Conexion::consulta('UPDATE musica_canciones SET activo=? WHERE id=?',[$activo,$id]);
    }
    public function sugerir(int $usuario,?int $cancion,string $titulo,string $artista,?string $youtube): void
    {
        $db=Conexion::obtener();$db->beginTransaction();
        try{
            $u=Conexion::consulta('SELECT rol,estado FROM usuarios WHERE id=? FOR UPDATE',[$usuario])->fetch();
            if(!$u||!$u['estado']||$u['rol']!=='cliente')throw new DomainException('Solo clientes activos pueden enviar sugerencias.');
            $n=(int)Conexion::consulta("SELECT COUNT(*) FROM musica_sugerencias WHERE usuario_id=? AND estado IN ('pendiente','en_cola','reproduciendo')",[$usuario])->fetchColumn();
            if($n>=3)throw new DomainException('Ya tienes tres sugerencias pendientes o en la cola. Espera tu turno.');
            $hoy=(int)Conexion::consulta('SELECT COUNT(*) FROM musica_sugerencias WHERE usuario_id=? AND creado>DATE_SUB(UTC_TIMESTAMP(),INTERVAL 1 DAY)',[$usuario])->fetchColumn();
            if($hoy>=10)throw new DomainException('Puedes sugerir hasta diez canciones cada 24 horas.');
            if($cancion){
                $c=Conexion::consulta('SELECT * FROM musica_canciones WHERE id=? AND activo=1',[$cancion])->fetch();
                if(!$c)throw new DomainException('La canción ya no está disponible.');
                $titulo=$c['titulo'];$artista=$c['artista'];$youtube=null;
            }
            $duplicada=Conexion::consulta("SELECT id FROM musica_sugerencias WHERE usuario_id=? AND titulo=? AND artista=? AND estado IN ('pendiente','en_cola','reproduciendo')",[$usuario,$titulo,$artista])->fetch();
            if($duplicada)throw new DomainException('Esa canción ya está entre tus sugerencias activas.');
            Conexion::consulta('INSERT INTO musica_sugerencias(usuario_id,cancion_id,titulo,artista,youtube_id) VALUES(?,?,?,?,?)',[$usuario,$cancion,$titulo,$artista,$youtube]);
            $db->commit();
        }catch(Throwable $e){$db->rollBack();throw $e;}
    }
    public function solicitudes(?int $usuario=null): array
    {
        $where=$usuario?' WHERE s.usuario_id=?':" WHERE s.estado IN ('pendiente','en_cola','reproduciendo')";
        return Conexion::consulta('SELECT s.*,u.nombre cliente FROM musica_sugerencias s JOIN usuarios u ON u.id=s.usuario_id'.$where.' ORDER BY s.id DESC LIMIT 100',$usuario?[$usuario]:[])->fetchAll();
    }
    public function moderar(int $id,int $moderador,bool $aprobar,?int $cancion): void
    {
        $db=Conexion::obtener();$db->beginTransaction();
        try{
            $s=Conexion::consulta('SELECT * FROM musica_sugerencias WHERE id=? FOR UPDATE',[$id])->fetch();
            if(!$s||$s['estado']!=='pendiente')throw new DomainException('La sugerencia ya fue atendida o no existe.');
            if(!$aprobar){Conexion::consulta("UPDATE musica_sugerencias SET estado='rechazada',moderador_id=? WHERE id=?",[$moderador,$id]);$db->commit();return;}
            $cancion=$cancion?:($s['cancion_id']?(int)$s['cancion_id']:null);
            if(!$cancion&&$s['youtube_id']){
                $this->agregar($s['titulo'],$s['artista'],'youtube',$s['youtube_id']);$cancion=(int)$db->lastInsertId();
            }
            if(!$cancion||!Conexion::consulta('SELECT id FROM musica_canciones WHERE id=? AND activo=1',[$cancion])->fetch())throw new DomainException('Selecciona un audio del catálogo o registra un enlace de YouTube para poder reproducirla.');
            Conexion::consulta("UPDATE musica_sugerencias SET estado='en_cola',cancion_id=?,moderador_id=?,aprobado=UTC_TIMESTAMP() WHERE id=?",[$cancion,$moderador,$id]);
            $db->commit();
        }catch(Throwable $e){$db->rollBack();throw $e;}
    }
    public function encolar(int $cancion,int $operador): void
    {
        $c=Conexion::consulta('SELECT * FROM musica_canciones WHERE id=? AND activo=1',[$cancion])->fetch();
        if(!$c)throw new DomainException('Canción no disponible.');
        Conexion::consulta("INSERT INTO musica_sugerencias(usuario_id,cancion_id,titulo,artista,estado,moderador_id,aprobado) VALUES(?,?,?,?,'en_cola',?,UTC_TIMESTAMP())",[$operador,$cancion,$c['titulo'],$c['artista'],$operador]);
    }
    public function estado(): array
    {
        $actual=Conexion::consulta("SELECT s.id,c.titulo,c.artista FROM musica_reproductor r JOIN musica_sugerencias s ON s.id=r.sugerencia_id JOIN musica_canciones c ON c.id=s.cancion_id WHERE r.id=1 AND s.estado='reproduciendo' AND r.actualizado>DATE_SUB(UTC_TIMESTAMP(),INTERVAL 45 SECOND)")->fetch();
        $cola=Conexion::consulta("SELECT s.id,c.titulo,c.artista FROM musica_sugerencias s JOIN musica_canciones c ON c.id=s.cancion_id WHERE s.estado='en_cola' AND c.activo=1 ORDER BY s.aprobado,s.id LIMIT 20")->fetchAll();
        return ['actual'=>$actual?:null,'cola'=>$cola];
    }
    private function pista(int $solicitud): array|false
    {
        return Conexion::consulta('SELECT s.id,c.titulo,c.artista,c.fuente,c.recurso,c.activo FROM musica_sugerencias s JOIN musica_canciones c ON c.id=s.cancion_id WHERE s.id=?',[$solicitud])->fetch();
    }
    public function siguiente(string $dispositivo,int $operador,?int $finalizada=null,string $resultado='reproducida'): ?array
    {
        $db=Conexion::obtener();$db->beginTransaction();
        try{
            $r=Conexion::consulta('SELECT * FROM musica_reproductor WHERE id=1 FOR UPDATE')->fetch();
            if(!$r)throw new DomainException('Instala primero las tablas de música.');
            $vigente=$r['actualizado']&&strtotime($r['actualizado'].' UTC')>time()-45;
            if($r['dispositivo']&&$r['dispositivo']!==$dispositivo&&$vigente)throw new DomainException('Otro reproductor está activo en el local. Detén esa sesión o espera 45 segundos.');
            Conexion::consulta('UPDATE musica_reproductor SET dispositivo=?,actualizado=UTC_TIMESTAMP() WHERE id=1',[$dispositivo]);
            if($finalizada!==null){
                if((int)$r['sugerencia_id']!==$finalizada)throw new DomainException('La pista actual cambió. Sincroniza el reproductor.');
                if(!in_array($resultado,['reproducida','omitida'],true))throw new DomainException('Resultado de reproducción inválido.');
                Conexion::consulta('UPDATE musica_sugerencias SET estado=? WHERE id=?',[$resultado,$finalizada]);
                Conexion::consulta('UPDATE musica_reproductor SET sugerencia_id=NULL WHERE id=1');$r['sugerencia_id']=null;
            }
            if($r['sugerencia_id']){
                $p=$this->pista((int)$r['sugerencia_id']);
                if($p&&$p['activo']){$db->commit();return $p;}
                Conexion::consulta("UPDATE musica_sugerencias SET estado='omitida' WHERE id=?",[$r['sugerencia_id']]);
            }
            while(true){
                $s=Conexion::consulta("SELECT s.id,s.cancion_id FROM musica_sugerencias s JOIN musica_canciones c ON c.id=s.cancion_id WHERE s.estado='en_cola' AND c.activo=1 ORDER BY s.aprobado,s.id LIMIT 1 FOR UPDATE")->fetch();
                if(!$s){
                    $c=Conexion::consulta('SELECT * FROM musica_canciones WHERE activo=1 AND id>? ORDER BY id LIMIT 1',[(int)($r['ultima_cancion_id']??0)])->fetch();
                    if(!$c)$c=Conexion::consulta('SELECT * FROM musica_canciones WHERE activo=1 ORDER BY id LIMIT 1')->fetch();
                    if(!$c){Conexion::consulta('UPDATE musica_reproductor SET sugerencia_id=NULL WHERE id=1');$db->commit();return null;}
                    $this->encolar((int)$c['id'],$operador);continue;
                }
                Conexion::consulta("UPDATE musica_sugerencias SET estado='reproduciendo' WHERE id=?",[$s['id']]);
                Conexion::consulta('UPDATE musica_reproductor SET sugerencia_id=?,ultima_cancion_id=? WHERE id=1',[$s['id'],$s['cancion_id']]);
                $p=$this->pista((int)$s['id']);$db->commit();return $p?:null;
            }
        }catch(Throwable $e){if($db->inTransaction())$db->rollBack();throw $e;}
    }
    public function latido(string $dispositivo): bool
    {
        Conexion::consulta('UPDATE musica_reproductor SET actualizado=UTC_TIMESTAMP() WHERE id=1 AND dispositivo=?',[$dispositivo]);
        return (bool)Conexion::consulta('SELECT id FROM musica_reproductor WHERE id=1 AND dispositivo=?',[$dispositivo])->fetch();
    }
    public function liberar(string $dispositivo): void
    {
        Conexion::consulta('UPDATE musica_reproductor SET dispositivo=NULL,actualizado=NULL WHERE id=1 AND dispositivo=?',[$dispositivo]);
    }
}

```

## 25. app/controllers/PublicoController.php
```php
<?php
declare(strict_types=1);
final class PublicoController
{
    public function inicio(): void {
        $seleccion=[];
        foreach(array_reverse((new ProductoModel())->listar(true)) as $p){if(!isset($seleccion[$p['categoria_id']]))$seleccion[$p['categoria_id']]=$p;}
        vista('publico/inicio',['productos'=>array_slice(array_values($seleccion),0,3),'categorias'=>(new CategoriaModel())->listar(true)]);
    }
    public function nosotros(): void {vista('publico/nosotros');}
    public function productos(): void {
        $q=isset($_GET['q'])?Validador::texto($_GET,'q',0,120):'';
        $categoria=isset($_GET['categoria'])?Validador::entero($_GET,'categoria',0):0;
        vista('publico/productos',['productos'=>(new ProductoModel())->listar(true,$q,$categoria),'categorias'=>(new CategoriaModel())->listar(true),'q'=>$q,'categoria'=>$categoria]);
    }
    public function contactos(): void {vista('publico/contactos');}
    public function enviar(): void {
        postAccion(function(): void {
            Intentos::registrar('contacto',5,900);
            (new MensajeModel())->crear(Validador::texto($_POST,'nombre',3,120),Validador::correo($_POST),Validador::texto($_POST,'asunto',3,150),Validador::texto($_POST,'contenido',10,5000));
        },'contactos');
    }
}

```

## 26. app/controllers/AuthController.php
```php
<?php
declare(strict_types=1);
final class AuthController
{
    public function acceder(): void {vista('auth/acceder');}
    public function registro(): void {vista('auth/registro');}
    public function login(): void {
        CsrfToken::verificar();
        try {
            Intentos::registrar('login',10,900);
            $usuario=Validador::texto($_POST,'usuario',3,40);
            $clave=$_POST['clave']??null;
            if(!is_string($clave)||strlen($clave)>72||$clave==='')throw new DomainException('Usuario o contraseña incorrectos.');
            $u=(new UsuarioModel())->autenticar($usuario,$clave);
            if(!$u)throw new DomainException('Usuario o contraseña incorrectos.');
            AuthMiddleware::entrar($u);redirigir($u['rol']==='cliente'?'productos':'admin');
        }catch(DomainException $e){flash($e->getMessage(),false);redirigir('acceder');}
    }
    public function registrar(): void {
        CsrfToken::verificar();
        try {
            Intentos::registrar('registro',5,900);
            $clave=Validador::clave($_POST);
            if($clave!==($_POST['confirmacion']??null))throw new DomainException('Las contraseñas no coinciden.');
            (new UsuarioModel())->guardar(Validador::persona($_POST),'cliente',1,null,$clave);
            flash('Cuenta creada. Ya puedes iniciar sesión.');redirigir('acceder');
        }catch(DomainException $e){flash($e->getMessage(),false);redirigir('registro');}
        catch(PDOException $e){if($e->getCode()!=='23000')throw $e;flash('El usuario o correo ya está registrado.',false);redirigir('registro');}
    }
    public function salir(): void {AuthMiddleware::exigir();CsrfToken::verificar();AuthMiddleware::salir();redirigir('acceder');}
}

```

## 27. app/controllers/CarritoController.php
```php
<?php
declare(strict_types=1);
final class CarritoController
{
    private array $usuario;
    public function __construct() {$this->usuario=AuthMiddleware::exigir(['cliente']);}
    public function index(): void {
        $_SESSION['pedido_token']??=bin2hex(random_bytes(32));
        vista('publico/carrito',['token'=>$_SESSION['pedido_token']]);
    }
    public function confirmar(): void {
        CsrfToken::verificar();
        $token=Validador::texto($_POST,'token',64,64);
        if(!hash_equals($_SESSION['pedido_token']??'',$token))throw new DomainException('Pedido ya procesado o formulario caducado. Consulta Mis pedidos.');
        $items=json_decode(Validador::texto($_POST,'items',2,12000),true,32,JSON_THROW_ON_ERROR);
        if(!is_array($items))throw new DomainException('Carrito inválido.');
        $id=(new PedidoModel())->crear((int)$this->usuario['id'],$items,$token);
        unset($_SESSION['pedido_token']);$_SESSION['vaciar_carrito']=true;
        flash('Pedido #'.$id.' confirmado correctamente.');redirigir('mis-pedidos');
    }
}

```

## 28. app/controllers/DashboardController.php
```php
<?php
declare(strict_types=1);
final class DashboardController
{
    private array $usuario;
    public function __construct() {$this->usuario=AuthMiddleware::exigir(['administrador','empleado']);}
    public function index(): void {vista('admin/dashboard',['indicadores'=>(new PedidoModel())->indicadores($this->usuario['rol']==='administrador')],true);}
    public function indicadores(): void {jsonRespuesta((new PedidoModel())->indicadores($this->usuario['rol']==='administrador'));}
}

```

## 29. app/controllers/ProductoController.php
```php
<?php
declare(strict_types=1);
final class ProductoController
{
    public function __construct(){AuthMiddleware::exigir(['administrador','empleado']);}
    public function index(): void {
        $q=isset($_GET['q'])?Validador::texto($_GET,'q',0,120):'';
        $editar=isset($_GET['editar'])?(new ProductoModel())->buscar(Validador::entero($_GET,'editar')):null;
        vista('admin/productos',['productos'=>(new ProductoModel())->listar(false,$q),'categorias'=>(new CategoriaModel())->listar(),'editar'=>$editar,'q'=>$q],true);
    }
    public function guardar(): void {
        postAccion(function(): void {
            $modelo=new ProductoModel();$id=empty($_POST['id'])?null:Validador::entero($_POST,'id');
            $viejo=$id?$modelo->buscar($id):null;
            if($id&&!$viejo)throw new DomainException('Producto inexistente.');
            $datos=['categoria_id'=>Validador::entero($_POST,'categoria_id'),'nombre'=>Validador::texto($_POST,'nombre',2,120),'descripcion'=>Validador::texto($_POST,'descripcion',5,1000),'precio'=>Validador::precio($_POST),'stock'=>Validador::entero($_POST,'stock',0,1000000),'imagen'=>$viejo['imagen']??'images/cafe.svg','estado'=>Validador::entero($_POST,'estado',0,1)];
            $imagen=Imagen::guardar($_FILES['imagen']??[]);
            if($imagen)$datos['imagen']=$imagen;
            try{$modelo->guardar($datos,$id);}catch(Throwable $e){Imagen::quitar($imagen);throw $e;}
            if($imagen&&$viejo)Imagen::quitar($viejo['imagen']);
        },'admin/productos');
    }
    public function eliminar(): void {
        postAccion(function(): void {$m=new ProductoModel();$id=Validador::entero($_POST,'id');$p=$m->buscar($id);$m->eliminar($id);if($p)Imagen::quitar($p['imagen']);},'admin/productos');
    }
}

```

## 30. app/controllers/CategoriaController.php
```php
<?php
declare(strict_types=1);
final class CategoriaController
{
    public function __construct(){AuthMiddleware::exigir(['administrador']);}
    public function index(): void {
        $m=new CategoriaModel();$editar=isset($_GET['editar'])?$m->buscar(Validador::entero($_GET,'editar')):null;
        vista('admin/categorias',['categorias'=>$m->listar(),'editar'=>$editar],true);
    }
    public function guardar(): void {
        postAccion(function(): void {(new CategoriaModel())->guardar(Validador::texto($_POST,'nombre',2,80),Validador::texto($_POST,'descripcion',3,500),Validador::entero($_POST,'estado',0,1),empty($_POST['id'])?null:Validador::entero($_POST,'id'));},'admin/categorias');
    }
    public function eliminar(): void {postAccion(function(): void {(new CategoriaModel())->eliminar(Validador::entero($_POST,'id'));},'admin/categorias');}
}

```

## 31. app/controllers/UsuarioController.php
```php
<?php
declare(strict_types=1);
final class UsuarioController
{
    private array $usuario;
    public function __construct(){$this->usuario=AuthMiddleware::exigir(['administrador']);}
    public function index(): void {
        $m=new UsuarioModel();$q=isset($_GET['q'])?Validador::texto($_GET,'q',0,120):'';
        vista('admin/usuarios',['usuarios'=>$m->listar($q),'editar'=>isset($_GET['editar'])?$m->buscar(Validador::entero($_GET,'editar')):null,'q'=>$q],true);
    }
    public function guardar(): void {
        postAccion(function(): void {
            $id=empty($_POST['id'])?null:Validador::entero($_POST,'id');$rol=Validador::opcion($_POST,'rol',['administrador','empleado','cliente']);$estado=Validador::entero($_POST,'estado',0,1);
            if($id===$this->usuario['id']&&($rol!=='administrador'||!$estado))throw new DomainException('No puedes desactivar tu propia cuenta ni retirar tu rol administrativo.');
            (new UsuarioModel())->guardar(Validador::persona($_POST),$rol,$estado,$id,$id?null:Validador::clave($_POST));
        },'admin/usuarios');
    }
}

```

## 32. app/controllers/PedidoController.php
```php
<?php
declare(strict_types=1);
final class PedidoController
{
    private array $usuario;
    public function __construct(){$this->usuario=AuthMiddleware::exigir();}
    public function index(): void {
        AuthMiddleware::exigir(['administrador','empleado']);vista('admin/pedidos',['pedidos'=>(new PedidoModel())->listar(),'cliente'=>false],true);
    }
    public function mios(): void {AuthMiddleware::exigir(['cliente']);vista('admin/pedidos',['pedidos'=>(new PedidoModel())->listar((int)$this->usuario['id']),'cliente'=>true]);}
    public function detalle(): void {
        $cliente=$this->usuario['rol']==='cliente';
        vista('admin/pedido',['pedido'=>(new PedidoModel())->detalle(Validador::entero($_GET,'id'),$cliente?(int)$this->usuario['id']:null),'cliente'=>$cliente],!$cliente);
    }
    public function estado(): void {
        AuthMiddleware::exigir(['administrador','empleado']);
        postAccion(function(): void {(new PedidoModel())->estado(Validador::entero($_POST,'id'),Validador::opcion($_POST,'estado',['pendiente','preparando','entregado','cancelado']));},'admin/pedidos');
    }
}

```

## 33. app/controllers/MensajeController.php
```php
<?php
declare(strict_types=1);
final class MensajeController
{
    public function __construct(){AuthMiddleware::exigir(['administrador']);}
    public function index(): void {vista('admin/mensajes',['mensajes'=>(new MensajeModel())->listar()],true);}
    public function estado(): void {postAccion(function(): void {(new MensajeModel())->estado(Validador::entero($_POST,'id'),Validador::opcion($_POST,'estado',['nuevo','leido','respondido']));},'admin/mensajes');}
    public function eliminar(): void {postAccion(function(): void {(new MensajeModel())->eliminar(Validador::entero($_POST,'id'));},'admin/mensajes');}
}

```

## 34. app/controllers/PerfilController.php
```php
<?php
declare(strict_types=1);
final class PerfilController
{
    private array $usuario;
    public function __construct(){
        $this->usuario=AuthMiddleware::exigir();
    }
    public function index(): void {
        vista('admin/perfil',
        ['perfil'=>$this->usuario],
        $this->usuario['rol']!=='cliente'
    );
}
    public function guardar(): void {
        postAccion(function(): void {
            $nueva=empty($_POST['nueva_clave'])?null:Validador::clave($_POST,'nueva_clave');
            if($nueva!==null&&$nueva!==($_POST['confirmacion']??null))throw new DomainException('Las contraseñas nuevas no coinciden.');
            $actual=isset($_POST['clave_actual'])&&is_string($_POST['clave_actual'])?$_POST['clave_actual']:null;
            (new UsuarioModel())->perfil((int)$this->usuario['id'],Validador::persona($_POST),$actual,$nueva);
            if($nueva!==null)session_regenerate_id(true);
        },'perfil');
    }
}

```

## 35. app/controllers/MusicaController.php
```php
<?php
declare(strict_types=1);
final class MusicaController
{
    private array $usuario;
    public function __construct(){$this->usuario=AuthMiddleware::exigir();}
    public function index(): void
    {
        $cliente=$this->usuario['rol']==='cliente';$m=new MusicaModel();
        vista($cliente?'publico/musica':'admin/musica',['cliente'=>$cliente,'catalogo'=>$m->catalogo(!$cliente),'solicitudes'=>$m->solicitudes($cliente?(int)$this->usuario['id']:null),'estado'=>$m->estado()],!$cliente);
    }
    public function sugerir(): void
    {
        AuthMiddleware::exigir(['cliente']);
        postAccion(function(): void {
            $cancion=empty($_POST['cancion_id'])?null:Validador::entero($_POST,'cancion_id');
            $titulo=$cancion?'':Validador::texto($_POST,'titulo',2,150);$artista=$cancion?'':Validador::texto($_POST,'artista',2,120);
            $youtube=empty($_POST['youtube'])?null:AudioArchivo::youtube(Validador::texto($_POST,'youtube',10,400));
            (new MusicaModel())->sugerir((int)$this->usuario['id'],$cancion,$titulo,$artista,$youtube);
        },'musica');
    }
    public function agregar(): void
    {
        AuthMiddleware::exigir(['administrador','empleado']);
        postAccion(function(): void {
            $titulo=Validador::texto($_POST,'titulo',2,150);$artista=Validador::texto($_POST,'artista',2,120);$fuente=Validador::opcion($_POST,'fuente',['archivo','youtube']);
            $recurso=$fuente==='youtube'?AudioArchivo::youtube(Validador::texto($_POST,'youtube',10,400)):AudioArchivo::guardar($_FILES['audio']??[]);
            try{(new MusicaModel())->agregar($titulo,$artista,$fuente,$recurso);}catch(Throwable $e){if($fuente==='archivo')unlink(dirname(__DIR__,2).'/public/'.$recurso);throw $e;}
        },'musica');
    }
    public function moderar(): void
    {
        AuthMiddleware::exigir(['administrador','empleado']);
        postAccion(function(): void {(new MusicaModel())->moderar(Validador::entero($_POST,'id'),(int)$this->usuario['id'],Validador::opcion($_POST,'accion',['aprobar','rechazar'])==='aprobar',empty($_POST['cancion_id'])?null:Validador::entero($_POST,'cancion_id'));},'musica');
    }
    public function encolar(): void
    {
        AuthMiddleware::exigir(['administrador','empleado']);
        postAccion(function(): void {(new MusicaModel())->encolar(Validador::entero($_POST,'id'),(int)$this->usuario['id']);},'musica');
    }
    public function activar(): void
    {
        AuthMiddleware::exigir(['administrador','empleado']);
        postAccion(function(): void {(new MusicaModel())->activar(Validador::entero($_POST,'id'),Validador::entero($_POST,'activo',0,1));},'musica');
    }
    public function reproductor(): void
    {
        AuthMiddleware::exigir(['administrador','empleado']);vista('admin/reproductor',[],true);
    }
    public function estado(): void {jsonRespuesta((new MusicaModel())->estado());}
    public function control(): void
    {
        AuthMiddleware::exigir(['administrador','empleado']);CsrfToken::verificar();
        try{
            $dispositivo=Validador::texto($_POST,'dispositivo',64,64);
            if(!preg_match('/^[a-f0-9]{64}$/D',$dispositivo))throw new DomainException('Identificador de reproductor inválido.');
            $accion=Validador::opcion($_POST,'accion',['siguiente','latido','liberar']);$m=new MusicaModel();
            if($accion==='liberar'){$m->liberar($dispositivo);jsonRespuesta(['ok'=>true]);}
            if($accion==='latido')jsonRespuesta(['ok'=>$m->latido($dispositivo)]);
            $p=$m->siguiente($dispositivo,(int)$this->usuario['id'],empty($_POST['finalizada'])?null:Validador::entero($_POST,'finalizada'),isset($_POST['resultado'])?Validador::opcion($_POST,'resultado',['reproducida','omitida']):'reproducida');
            if($p&&$p['fuente']==='archivo')$p['url']=url($p['recurso']);
            jsonRespuesta(['pista'=>$p]);
        }catch(DomainException $e){jsonRespuesta(['error'=>$e->getMessage()],409);}
    }
}

```

## 36. app/views/layouts/cabecera.php
```php
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#221916">
<meta name="description" content="Coffe Music Bar: café, música y buena compañía. Explora nuestra carta y disfruta tu próximo buen momento.">
<meta name="csrf-token" content="<?= e(CsrfToken::valor()) ?>">
<title>Coffe Music Bar · Café, música y buena vibra</title>
<link rel="preload" href="<?= e(url('fonts/nunito-variable.ttf')) ?>" as="font" type="font/ttf" crossorigin>
<script src="<?= e(url('js/tema.js?v=3')) ?>"></script>
<link rel="stylesheet" href="<?= e(url('css/refinado.css?v=3')) ?>">
<link rel="stylesheet" href="<?= e(url('css/cristal.css?v=3')) ?>">
<link rel="stylesheet" href="<?= e(url('css/accesibilidad.css?v=4')) ?>">
<?php if(in_array($archivo,['publico/musica','admin/musica','admin/reproductor'],true)): ?>
<link rel="stylesheet" href="<?= e(url('css/musica.css?v=4')) ?>">
<script src="<?= e(url('js/musica.js?v=4')) ?>" defer></script>
<?php endif ?>
<?php if($archivo==='admin/reproductor'): ?><script src="<?= e(url('js/reproductor.js?v=4')) ?>" defer></script><?php endif ?>
<script src="<?= e(url('js/app.js?v=4')) ?>" defer></script>
<script src="<?= e(url('js/carrito.js?v=3')) ?>" defer></script>

```

## 37. app/views/layouts/aviso.php
```php
<?php if ($aviso): ?>
  <div class="aviso <?= $aviso['ok'] ? 'exito' : 'error' ?>" role="status">
    <?= e($aviso['mensaje']) ?>
  </div>
<?php endif; ?>

<div id="toast" role="status" aria-live="polite" hidden></div>

```

## 38. app/views/layouts/publico.php
```php
<?php $negocio=Negocio::datos();$whatsapp=Negocio::whatsapp();$maps=Negocio::maps();$accesoLogo=$actual?($actual['rol']==='cliente'?'mis-pedidos':'admin'):'acceder'; ?>
<!doctype html>
<html lang="es"><head><?php require __DIR__.'/cabecera.php'; ?></head>
<body data-cart-key="<?= e('cafebar-cart-'.($actual['id']??'invitado')) ?>" data-clear-cart="<?= !empty($_SESSION['vaciar_carrito'])?'1':'0' ?>">
<?php unset($_SESSION['vaciar_carrito']); ?>
<a class="saltar" href="#contenido">Saltar al contenido</a>
<div class="anuncio"><span class="anuncio-lugar"><span class="punto-vivo"></span><?= e($negocio['ciudad']) ?></span></div>
<header class="cabecera contenedor"><a class="logo" href="<?= e(url($accesoLogo)) ?>" aria-label="Coffe Music Bar, acceder al sistema" title="Acceder al sistema"><?php require __DIR__.'/marca.php'; ?></a>
<div class="cabecera-acciones"><button class="menu-toggle" type="button" aria-expanded="false" aria-controls="navegacion"><span aria-hidden="true">☰</span><span>Menú</span></button><nav id="navegacion" aria-label="Navegación principal"><a href="<?= e(url()) ?>">Inicio</a><a href="<?= e(url('nosotros')) ?>">Nosotros</a><a href="<?= e(url('productos')) ?>">La carta</a><a href="<?= e(url('contactos')) ?>">Contactos</a>
<?php if($actual): ?><?php if($actual['rol']==='cliente'): ?><a href="<?= e(url('mis-pedidos')) ?>">Mis pedidos</a><a class="nav-chip" href="<?= e(url('carrito')) ?>">Carrito <span class="badge" data-cart-count>0</span></a><?php else: ?><a class="nav-chip" href="<?= e(url('admin')) ?>">Mi panel ↗</a><?php endif ?><a href="<?= e(url('musica')) ?>">Música ♫</a><a href="<?= e(url('perfil')) ?>">Mi perfil</a><form method="post" action="<?= e(url('salir')) ?>"><?= CsrfToken::campo() ?><button class="enlace">Salir</button></form><?php else: ?><a class="nav-acceso" href="<?= e(url('acceder')) ?>">Mi cuenta <span aria-hidden="true">↗</span></a><?php endif ?></nav><button class="theme-rotator" id="theme-rotator" type="button" aria-label="Cambiar tema" title="Cambiar tema"><span class="rotator-icon" aria-hidden="true">◐</span></button></div></header>
<main id="contenido" class="contenedor principal"><?php require __DIR__.'/aviso.php';require dirname(__DIR__).'/'.$archivo.'.php'; ?></main>
<footer class="pie"><div class="contenedor"><section class="footer-saludo"><div><span class="etiqueta">TU PRÓXIMO BUEN PLAN</span><h2>Nos vemos<br><em>entre café y canciones.</em></h2></div><a class="boton boton-whatsapp" href="<?= e($whatsapp??url('contactos#mensaje')) ?>" <?= $whatsapp?'target="_blank" rel="noopener noreferrer"':'' ?>><?= $whatsapp?'Hablemos por WhatsApp':'Escríbenos' ?><span aria-hidden="true">↗</span></a></section>
<div class="pie-grid"><div><a class="logo" href="<?= e(url($accesoLogo)) ?>" aria-label="Coffe Music Bar, acceder al sistema" title="Acceder al sistema"><?php require __DIR__.'/marca.php'; ?></a><p>Café en la mesa.<br>Música en el alma.<br>Un ratito para ti.</p><span class="footer-firma">COFFEE · MUSIC · GOOD TIMES</span></div><div><span class="etiqueta">ENCUÉNTRANOS</span><p><?= $negocio['direccion']!==''?e($negocio['direccion']).'<br>':'' ?><?= e($negocio['ciudad']) ?></p><?php if($maps): ?><a class="contact-link" href="<?= e($maps) ?>" target="_blank" rel="noopener noreferrer"><span aria-hidden="true">⌖</span> Cómo llegar · Google Maps ↗</a><?php else: ?><a class="contact-link" href="<?= e(url('contactos#mensaje')) ?>">Consulta nuestra ubicación →</a><?php endif ?><a class="contact-link" href="<?= e($whatsapp??url('contactos#mensaje')) ?>" <?= $whatsapp?'target="_blank" rel="noopener noreferrer"':'' ?>><?= $whatsapp?'WhatsApp · '.e($negocio['whatsapp']):'Envíanos tu consulta' ?> ↗</a></div><div><span class="etiqueta">A TU RITMO</span><a href="<?= e(url('productos')) ?>">Nuestra carta</a><a href="<?= e(url('nosotros')) ?>">Nuestra esencia</a><a href="<?= e(url($actual?'perfil':'registro')) ?>"><?= $actual?'Mi cuenta':'Crea tu cuenta' ?></a><a href="<?= e(url('contactos')) ?>">Contactos</a></div></div>
<?php if($maps): ?><a class="footer-mapa" href="<?= e($maps) ?>" target="_blank" rel="noopener noreferrer"><span class="mapa-dibujo" aria-hidden="true"><svg viewBox="0 0 500 120" preserveAspectRatio="none"><path d="M0 18 500 78M0 105 500 26M92 0l19 120M300 0l-36 120M450 0l-29 120"/></svg><span class="mapa-pin">⌖</span></span><span class="mapa-texto"><strong>Aquí empieza tu próxima pausa.</strong><span><?= e($negocio['direccion']?:$negocio['ciudad']) ?></span></span><span class="mapa-abrir">Abrir Google Maps ↗</span></a><?php endif ?>
<div class="pie-legal"><span>© <?= date('Y') ?> Coffe Music Bar</span><span>Precios en bolivianos · Hecho para disfrutar</span><a href="#contenido">Volver arriba ↑</a></div></div></footer>
<?php if($whatsapp): ?><a class="whatsapp-flotante" href="<?= e($whatsapp) ?>" target="_blank" rel="noopener noreferrer" aria-label="Contactar a Coffe Music Bar por WhatsApp"><svg viewBox="0 0 32 32" width="25" height="25" fill="none" aria-hidden="true"><path d="M27 15a11 11 0 0 1-16.5 9.5L5 26l1.5-5.5A11 11 0 1 1 27 15Z" stroke="currentColor" stroke-width="1.7"/><path d="M12 9c-3 2 0 8 4 10s6 1 5-2l-3-1-1 2c-3-1-5-3-6-6l2-1-1-2Z" fill="currentColor"/></svg><span>Hablemos</span></a><?php endif ?>
</body></html>

```

## 39. app/views/layouts/admin.php
```php
<!doctype html>
<html lang="es">
<head>
  <?php require __DIR__ . '/cabecera.php'; ?>
</head>
<body class="panel-body" data-cart-key="<?= e('cafebar-cart-' . $actual['id']) ?>">

  <!-- Ondas Vectoriales de Fondo -->
  <div class="ondas-fondo" aria-hidden="true">
    <svg class="onda onda-bottom" viewBox="0 0 1440 320" preserveAspectRatio="none">
      <path
        class="onda-path-1"
        d="M0,192L60,170.7C120,149,240,107,360,112C480,117,600,171,720,186.7C840,203,960,181,1080,154.7C1200,128,1320,96,1380,80L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"
      ></path>
    </svg>
  </div>

  <!-- Barra Lateral Administrativa -->
  <aside class="sidebar">
    <a href="<?= e(url('admin')) ?>" class="logo" aria-label="Coffe Music Bar, panel principal"><?php require __DIR__.'/marca.php'; ?></a>

    <p class="etiqueta">ESPACIO DE TRABAJO</p>

    <nav aria-label="Administración">
      <a href="<?= e(url('admin')) ?>">◫ &nbsp; Dashboard</a>
      <a href="<?= e(url('admin/productos')) ?>">◉ &nbsp; Productos</a>

      <?php if ($actual['rol'] === 'administrador'): ?>
        <a href="<?= e(url('admin/categorias')) ?>">▦ &nbsp; Categorías</a>
        <a href="<?= e(url('admin/usuarios')) ?>">♙ &nbsp; Usuarios</a>
      <?php endif; ?>

      <a href="<?= e(url('admin/pedidos')) ?>">▤ &nbsp; Pedidos</a>
      <a href="<?= e(url('musica')) ?>">♫ &nbsp; Música del local</a>

      <?php if ($actual['rol'] === 'administrador'): ?>
        <a href="<?= e(url('admin/mensajes')) ?>">✉ &nbsp; Mensajes</a>
      <?php endif; ?>

      <a href="<?= e(url('perfil')) ?>">○ &nbsp; Mi perfil</a>
      <a href="<?= e(url()) ?>">↗ &nbsp; Ver sitio público</a>
    </nav>

    <!-- Botón de Contraste (contrast / brightness-medium / theme-light-dark) -->
    <div class="theme-actions">
      <button
        class="theme-rotator"
        id="theme-rotator"
        type="button"
        aria-label="Contraste"
        title="Contraste"
      >
        <span class="rotator-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="9"></circle>
            <path d="M12 3a9 9 0 0 0 0 18z" fill="currentColor"></path>
          </svg>
        </span>
      </button>
    </div>

    <div class="sidebar-perfil">
      <strong><?= e($actual['nombre']) ?></strong>
      <small><?= e($actual['rol']) ?></small>
      <form method="post" action="<?= e(url('salir')) ?>">
        <?= CsrfToken::campo() ?>
        <button class="secundario">Cerrar sesión</button>
      </form>
    </div>
  </aside>

  <!-- Panel Principal -->
  <main class="panel-main">
    <header class="panel-top">
      <span>COFFE MUSIC BAR / ADMINISTRACIÓN</span>
      <span><?= e(date('d/m/Y')) ?> · Bs.</span>
    </header>

    <?php
      require __DIR__ . '/aviso.php';
      require dirname(__DIR__) . '/' . $archivo . '.php';
    ?>
  </main>
</body>
</html>

```

## 40. app/views/layouts/marca.php
```php
<img class="marca-logo" src="<?= e(url('images/logo.svg')) ?>" alt="" width="48" height="48"><span class="marca-texto">Coffe<span class="marca-subtitulo">MUSIC BAR</span></span>

```

## 41. app/views/publico/inicio.php
```php
<section class="hero" aria-labelledby="hero-title"><div class="hero-texto"><div class="music-chip"><span class="ecualizador" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></span> Tu pausa tiene su propio ritmo.</div><p class="etiqueta"><span class="mini-linea"></span> COFFE MUSIC BAR · ORURO</p><h1 id="hero-title">Buen café.<br><em>Buena vibra.</em></h1><p class="entradilla">Un café que abraza, tu música favorita y algo rico en la mesa. Ven a bajar el ritmo y a disfrutar lo que de verdad importa.</p><div class="acciones"><a class="boton" href="<?= e(url('productos')) ?>">Se me antoja un café <span aria-hidden="true">↗</span></a><a class="texto-link" href="<?= e(url('nosotros')) ?>">Conócenos <span aria-hidden="true">→</span></a></div><div class="hero-firma"><span class="firma-icono" aria-hidden="true">♫</span><p>Sabores que se disfrutan.<br><strong>Momentos que se quedan.</strong></p><span class="firma-coordenada">CAFÉ<br>& MÚSICA</span></div></div>
<div class="hero-visual"><div class="foto-marco"><img class="hero-foto" src="<?= e(url('images/wego-hero.png')) ?>" alt="Café latte y un croissant en una mesa cálida, imagen conceptual de Coffe Music Bar" width="1122" height="1402" fetchpriority="high"><span class="foto-indice">UN SORBO. UNA CANCIÓN. TU MOMENTO.</span><div class="foto-caption"><span>LO BUENO SE DISFRUTA SIN PRISA</span><strong>Quédate por otra canción.</strong></div></div><div class="sello" aria-hidden="true">COFFE<br><span>&</span><br>GOOD VIBES</div><span class="hero-vertical" aria-hidden="true">COFFE MUSIC BAR — DISFRUTA EL MOMENTO</span></div></section>
<div class="banda-valores"><span><b aria-hidden="true">✦</b> Café con carácter</span><span><b aria-hidden="true">✦</b> Sabores para compartir</span><span><b aria-hidden="true">♫</b> El ritmo lo pones tú</span><span><b aria-hidden="true">✦</b> Un ratito para ti</span></div>
<section class="seccion categorias-inicio" aria-labelledby="categorias-titulo"><div class="titulo-seccion"><div><p class="etiqueta">SIGUE TU ANTOJO</p><h2 id="categorias-titulo">¿A qué sabe tu plan?</h2></div><span class="muted">Algo rico para cada momento.</span></div><div class="categorias-grid"><?php foreach($categorias as $indice=>$c): ?><a class="categoria-tile" href="<?= e(url('productos?categoria='.$c['id'])) ?>"><span class="categoria-numero"><?= e(str_pad((string)($indice+1),2,'0',STR_PAD_LEFT)) ?></span><strong><?= e($c['nombre']) ?></strong><span class="categoria-flecha" aria-hidden="true">↗</span></a><?php endforeach ?></div></section>
<section class="seccion favoritos" aria-labelledby="favoritos-titulo"><div class="titulo-seccion"><div><p class="etiqueta">BUENAS COMBINACIONES</p><h2 id="favoritos-titulo">Dale gusto a tu día.</h2></div><a class="texto-link" href="<?= e(url('productos')) ?>">Ver toda la carta <span aria-hidden="true">↗</span></a></div><?php require __DIR__.'/tarjetas.php'; ?></section>
<section class="ritual"><div class="ritual-numero" aria-hidden="true">♫</div><div><p class="etiqueta">CAFÉ EN LA MESA. MÚSICA EN EL ALMA.</p><h2>Tu lugar.<br>Tu gente.<br><em>Tu buena vibra.</em></h2><p>Una charla que se alarga. Esa canción que te sabes de memoria. El primer sorbo de café. En Coffe Music Bar nos gustan los pequeños planes que se convierten en grandes momentos.</p><a class="texto-link" href="<?= e(url('nosotros')) ?>">Descubre nuestra esencia →</a></div></section>
<section class="invitacion"><div><p class="etiqueta">LA VIDA SUENA MEJOR CON CAFÉ</p><h2>Hoy toca<br><em>disfrutarte.</em></h2><p>Elige tus favoritos, arma tu pedido y deja el resto en pausa.</p></div><div class="invitacion-accion"><a class="boton" href="<?= e(url($actual?'productos':'registro')) ?>"><?= $actual?'Elegir mis favoritos':'Me sumo al plan' ?> <span aria-hidden="true">↗</span></a><span>Un buen momento empieza aquí.</span></div></section>

```

## 42. app/views/publico/nosotros.php
```php
<section class="pagina-hero">
  <p class="etiqueta">NUESTRA ESENCIA</p>
  <h1>Más que café,<br>un lugar para <em>conectar.</em></h1>
  <p>Una propuesta de cafetería y cocina sencilla, pensada para acompañar los pequeños momentos del día.</p>
</section>

<div class="dos-columnas seccion">
  <img
    class="imagen-historia"
    src="<?= e(url('images/cafe.svg')) ?>"
    alt="Ilustración de una taza de café"
    width="600"
    height="450"
  >

  <section>
    <p class="etiqueta">NUESTRA HISTORIA</p>
    <h2>Todo empieza con una buena taza</h2>
    <p>
      Coffe Music Bar nace como un concepto de encuentro: un espacio donde el café, la música y una comida sabrosa invitan a conversar, compartir o simplemente descansar.
    </p>
    <p>
      Esta historia es parte del negocio de demostración. Puedes adaptar los textos, dirección y horarios a tu cafetería antes de publicarla.
    </p>
  </section>
</div>

<div class="tres-columnas seccion">
  <section class="tarjeta">
    <h2>Misión</h2>
    <p>Ofrecer bebidas y alimentos preparados con dedicación, junto a una atención cercana y una experiencia cómoda.</p>
  </section>

  <section class="tarjeta">
    <h2>Visión</h2>
    <p>Ser un punto de encuentro apreciado por su sabor, su ambiente y el cuidado de cada detalle.</p>
  </section>

  <section class="tarjeta">
    <h2>Valores</h2>
    <p>Hospitalidad, calidad, respeto, honestidad y compromiso con quienes nos eligen.</p>
  </section>
</div>

```

## 43. app/views/publico/productos.php
```php
<section class="pagina-hero compacta"><p class="etiqueta">PREPARADOS PARA TU ANTOJO</p><h1>La buena vida<br>está en <em>la carta.</em></h1><p>Café para empezar. Algo fresco para seguir. Un bocado para quedarte un rato más.</p></section>
<nav class="catalogo-tabs" aria-label="Categorías de la carta"><a href="<?= e(url('productos')) ?>" <?= !$categoria?'aria-current="page"':'' ?>>Toda la carta</a><?php foreach($categorias as $c): ?><a href="<?= e(url('productos?categoria='.$c['id'])) ?>" <?= $categoria===(int)$c['id']?'aria-current="page"':'' ?>><?= e($c['nombre']) ?></a><?php endforeach ?></nav>
<form class="filtros" method="get" action="<?= e(url('productos')) ?>"><label>Encuentra tu favorito<input name="q" id="catalog-search" value="<?= e($q) ?>" maxlength="120" placeholder="¿Qué se te antoja?" type="search"></label><label>Categoría<select name="categoria" id="catalog-category"><option value="0">Todas las categorías</option><?php foreach($categorias as $c): ?><option value="<?= e($c['id']) ?>" <?= $categoria===(int)$c['id']?'selected':'' ?>><?= e($c['nombre']) ?></option><?php endforeach ?></select></label><button>Buscar <span aria-hidden="true">↗</span></button></form>
<div class="catalogo-meta"><p class="muted" id="catalog-status" role="status"><?= e(count($productos)) ?> opciones para disfrutar · Precios en Bs.</p><?php if($q!==''||$categoria): ?><a class="texto-link" href="<?= e(url('productos')) ?>">Restablecer filtros ×</a><?php endif ?></div>
<?php require __DIR__.'/tarjetas.php'; ?>
<p class="catalogo-nota">El stock y el precio se verifican al confirmar tu pedido. Encuentra tus favoritos y agrégalos a tu carrito desde tu cuenta de cliente.</p>

```

## 44. app/views/publico/tarjetas.php
```php
<div class="productos-grid">
  <?php foreach ($productos as $p): ?>
    <article
      class="producto"
      data-product-card
      data-category="<?= e($p['categoria_id']) ?>"
      data-name="<?= e(mb_strtolower($p['nombre'])) ?>"
    >
      <div class="producto-imagen">
        <img
          src="<?= e(url($p['imagen'])) ?>"
          alt="<?= e($p['nombre']) ?>"
          loading="lazy"
          width="600"
          height="450"
        >
        <span class="categoria-chip">
          <?= e($p['categoria']) ?>
        </span>
      </div>

      <div class="producto-info">
        <div class="producto-titulo">
          <h3><?= e($p['nombre']) ?></h3>
          <strong><?= e(bs($p['precio'])) ?></strong>
        </div>

        <p><?= e($p['descripcion']) ?></p>

        <div class="producto-final">
          <small>
            <?= $p['stock'] > 0 ? e($p['stock']) . ' disponibles' : 'Agotado' ?>
          </small>

          <?php if ($actual && $actual['rol'] === 'cliente'): ?>
            <button
              class="agregar"
              data-add
              data-id="<?= e($p['id']) ?>"
              data-name="<?= e($p['nombre']) ?>"
              data-price="<?= e($p['precio']) ?>"
              data-stock="<?= e($p['stock']) ?>"
              <?= $p['stock'] < 1 ? 'disabled' : '' ?>
              aria-label="Agregar <?= e($p['nombre']) ?> al carrito"
            >
              + Agregar
            </button>
          <?php else: ?>
            <a class="enlace" href="<?= e(url($actual ? 'admin' : 'acceder')) ?>">
              <?= $actual ? 'Ver en panel' : 'Pedir ahora ↗' ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </article>
  <?php endforeach; ?>
</div>

<?php if (!$productos): ?>
  <div class="vacio">
    No hay productos que coincidan con la búsqueda.
  </div>
<?php endif; ?>

```

## 45. app/views/publico/contactos.php
```php
<?php $datosContacto=Negocio::datos();$contactWhatsapp=Negocio::whatsapp();$contactMaps=Negocio::maps();$mapaIntegrado=Negocio::mapaIntegrado(); ?>
<section class="pagina-hero compacta"><p class="etiqueta">NOS GUSTA SABER DE TI</p><h1>Un mensaje.<br><em>Un buen comienzo.</em></h1><p>Una consulta, un plan con amigos o simplemente un hola. Estamos para escucharte.</p></section>
<div class="dos-columnas"><section class="contacto-datos"><div class="tarjeta contacto-cristal"><span class="contacto-icono" aria-hidden="true">⌖</span><h2>Nos encontramos<br>en Coffe.</h2><p><?= $datosContacto['direccion']!==''?e($datosContacto['direccion']).'<br>':'' ?><?= e($datosContacto['ciudad']) ?></p><div class="acciones"><?php if($contactMaps): ?><a class="boton secundario" href="<?= e($contactMaps) ?>" target="_blank" rel="noopener noreferrer">Cómo llegar ↗</a><?php endif ?><?php if($contactWhatsapp): ?><a class="boton boton-whatsapp" href="<?= e($contactWhatsapp) ?>" target="_blank" rel="noopener noreferrer">WhatsApp ↗</a><?php else: ?><a class="texto-link" href="#mensaje">Déjanos tu consulta ↓</a><?php endif ?></div></div>
<?php if($mapaIntegrado): ?><div class="mapa-embed"><iframe src="<?= e($mapaIntegrado) ?>" title="Ubicación de Coffe Music Bar en Google Maps" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe><a href="<?= e($contactMaps) ?>" target="_blank" rel="noopener noreferrer">Abrir indicaciones en Google Maps ↗</a></div><?php endif ?></section>
<section class="tarjeta" id="mensaje"><p class="etiqueta">CONVERSEMOS</p><h2>Escríbenos algo.</h2><p class="muted">Guardaremos tu consulta para que nuestro equipo pueda atenderla.</p><form method="post" action="<?= e(url('contactos')) ?>"><?= CsrfToken::campo() ?><label>Tu nombre<input name="nombre" minlength="3" maxlength="120" autocomplete="name" placeholder="¿Cómo te llamas?" required></label><label>Correo electrónico<input type="email" name="correo" maxlength="190" autocomplete="email" placeholder="tu@correo.com" required></label><label>Asunto<input name="asunto" minlength="3" maxlength="150" placeholder="¿En qué podemos ayudarte?" required></label><label>Mensaje<textarea name="contenido" minlength="10" maxlength="5000" placeholder="Cuéntanos un poco más…" required></textarea></label><button>Enviar mi mensaje <span aria-hidden="true">↗</span></button></form></section></div>

```

## 46. app/views/publico/carrito.php
```php
<section class="pagina-hero compacta">
  <p class="etiqueta">TUS FAVORITOS, EN UN SOLO LUGAR</p>
  <h1>Mi <em>carrito.</em></h1>
  <p>Revisa las cantidades antes de confirmar. El importe final se calcula en el servidor.</p>
</section>

<div id="cart-page">
  <div class="tabla-contenedor">
    <table>
      <thead>
        <tr>
          <th>Producto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Subtotal</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody id="cart-lines"></tbody>
    </table>
  </div>

  <p id="cart-empty" class="vacio" hidden>
    Tu carrito está vacío. <a href="<?= e(url('productos')) ?>">Explorar la carta</a>
  </p>

  <section class="resumen-carrito tarjeta">
    <h2>
      Total estimado
      <span id="cart-total">Bs. 0,00</span>
    </h2>

    <p class="muted">
      Pedidos para atención en el local. Sin pago en línea ni envío a domicilio.
    </p>

    <form id="checkout" method="post" action="<?= e(url('carrito/confirmar')) ?>">
      <?= CsrfToken::campo() ?>
      <input type="hidden" name="token" value="<?= e($token) ?>">
      <input type="hidden" id="cart-items" name="items" value="{}">
      <button id="checkout-button">Confirmar pedido ↗</button>
    </form>

    <a href="<?= e(url('productos')) ?>">Seguir eligiendo</a>
  </section>
</div>

```

## 47. app/views/publico/error.php
```php
<section class="tarjeta error-pagina">
  <p class="etiqueta">CAFFE MUSIC BAR</p>
  <h1>No se pudo completar la solicitud</h1>
  <p role="alert"><?= e($mensaje) ?></p>

  <div class="acciones">
    <a class="boton" href="<?= e(url()) ?>">Ir al inicio</a>
    <a class="texto-link" href="<?= e(url('carrito')) ?>">Revisar mi carrito</a>
  </div>
</section>

```

## 48. app/views/publico/musica.php
```php
<section class="pagina-hero compacta"><p class="etiqueta">EL RITMO TAMBIÉN LO PONES TÚ</p><h1>Tu café.<br><em>Tu próxima canción.</em></h1><p>Sugiere lo que te gustaría escuchar en el local. Nuestro equipo revisará tu elección y la añadirá a la cola.</p></section>
<section class="tarjeta musica-actual" data-musica-estado="<?= e(url('musica/estado')) ?>"><span class="ecualizador" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></span><div><p class="etiqueta">SELECCIONADA EN EL REPRODUCTOR DEL LOCAL</p><strong id="musica-actual-titulo"><?= e($estado['actual']['titulo']??'El local aún no ha iniciado el reproductor') ?></strong><p id="musica-actual-artista"><?= e($estado['actual']['artista']??'Mientras tanto, deja tu sugerencia.') ?></p></div><span class="estado preparando">En el local</span></section>
<div class="dos-columnas seccion"><section class="tarjeta"><p class="etiqueta">¿QUÉ TE GUSTARÍA ESCUCHAR?</p><h2>Deja tu sugerencia.</h2><form method="post" action="<?= e(url('musica/sugerir')) ?>"><?= CsrfToken::campo() ?><label>Elige del catálogo<select name="cancion_id"><option value="">Prefiero sugerir otra canción</option><?php foreach($catalogo as $c): ?><option value="<?= e($c['id']) ?>"><?= e($c['titulo'].' — '.$c['artista']) ?></option><?php endforeach ?></select></label><p class="muted">Si eliges una canción del catálogo, no necesitas completar los siguientes campos.</p><label>Título de otra canción<input name="titulo" minlength="2" maxlength="150" placeholder="El nombre de tu canción"></label><label>Artista<input name="artista" minlength="2" maxlength="120" placeholder="¿Quién la interpreta?"></label><label>Enlace de YouTube (opcional)<input type="url" name="youtube" maxlength="400" placeholder="https://www.youtube.com/watch?v=..."></label><button>Enviar mi sugerencia ♫</button><small class="muted">Hasta tres sugerencias activas y diez por día. La música se reproduce en el equipo del local, no en tu teléfono.</small></form></section><section><div class="tarjeta"><p class="etiqueta">PRÓXIMAMENTE EN EL LOCAL</p><h2>La cola musical.</h2><ol id="musica-cola" class="musica-lista"><?php foreach($estado['cola'] as $c): ?><li><strong><?= e($c['titulo']) ?></strong><span><?= e($c['artista']) ?></span></li><?php endforeach ?></ol><p id="musica-cola-vacia" class="muted" <?= $estado['cola']?'hidden':'' ?>>Cuando se aprueben canciones, aparecerán aquí.</p><p class="muted" id="musica-estado-conexion" role="status">Actualización cada diez segundos.</p></div></section></div>
<section><div class="titulo-seccion"><h2>Mis sugerencias</h2><span class="muted">Tu historial reciente</span></div><div class="tabla-contenedor"><table><thead><tr><th>Canción</th><th>Artista</th><th>Estado</th></tr></thead><tbody><?php foreach($solicitudes as $s): ?><tr><td><?= e($s['titulo']) ?></td><td><?= e($s['artista']) ?></td><td><span class="estado <?= in_array($s['estado'],['rechazada','omitida'],true)?'cancelado':($s['estado']==='pendiente'?'pendiente':'entregado') ?>"><?= e(str_replace('_',' ',$s['estado'])) ?></span></td></tr><?php endforeach ?></tbody></table></div></section>

```

## 49. app/views/auth/acceder.php
```php
<div class="auth-grid">
  <section class="auth-bienvenida">
    <p class="etiqueta">UN GUSTO TENERTE AQUÍ</p>
    <h1>Tu próxima<br>pausa empieza<br>con <em>un clic.</em></h1>
    <img
      src="<?= e(url('images/cafe.svg')) ?>"
      alt="Café de bienvenida"
      width="600"
      height="450"
    >
  </section>

  <section class="auth-form tarjeta">
    <h2>Bienvenido de nuevo</h2>
    <p class="muted">Ingresa a tu cuenta para continuar.</p>

    <form method="post" action="<?= e(url('acceder')) ?>">
      <?= CsrfToken::campo() ?>

      <label>
        Nombre de usuario
        <input
          name="usuario"
          minlength="3"
          maxlength="40"
          autocomplete="username"
          required
        >
      </label>

      <label>
        Contraseña
        <input
          name="clave"
          type="password"
          maxlength="72"
          autocomplete="current-password"
          required
        >
      </label>

      <button>Ingresar a mi cuenta ↗</button>
    </form>

    <p>¿Primera visita? <a href="<?= e(url('registro')) ?>">Crea tu cuenta</a></p>
  </section>
</div>

```

## 50. app/views/auth/registro.php
```php
<section class="formulario-central tarjeta">
  <p class="etiqueta">BIENVENIDO A CAFFE MUSIC BAR</p>
  <h1>Crea tu cuenta</h1>
  <p class="muted">Guarda tus datos y disfruta de pedidos más sencillos.</p>

  <form method="post" action="<?= e(url('registro')) ?>">
    <?= CsrfToken::campo() ?>

    <?php
      $persona = [];
      require dirname(__DIR__) . '/admin/campos-persona.php';
    ?>

    <label>
      Contraseña
      <input
        type="password"
        name="clave"
        minlength="12"
        maxlength="72"
        autocomplete="new-password"
        required
      >
    </label>

    <label>
      Repetir contraseña
      <input
        type="password"
        name="confirmacion"
        minlength="12"
        maxlength="72"
        autocomplete="new-password"
        required
      >
    </label>

    <button>Crear cuenta de cliente</button>
  </form>

  <p>¿Ya tienes cuenta? <a href="<?= e(url('acceder')) ?>">Accede aquí</a></p>
</section>

```

## 51. app/views/admin/campos-persona.php
```php
<label>
  Nombre completo
  <input
    name="nombre"
    value="<?= e($persona['nombre'] ?? '') ?>"
    minlength="3"
    maxlength="120"
    autocomplete="name"
    required
  >
</label>

<div class="campos-dos">
  <label>
    Nombre de usuario
    <input
      name="usuario"
      value="<?= e($persona['usuario'] ?? '') ?>"
      minlength="3"
      maxlength="40"
      pattern="[a-zA-Z0-9_.\-]+"
      autocomplete="username"
      required
    >
  </label>

  <label>
    Correo electrónico
    <input
      name="correo"
      type="email"
      value="<?= e($persona['correo'] ?? '') ?>"
      maxlength="190"
      autocomplete="email"
      required
    >
  </label>
</div>

<div class="campos-dos">
  <label>
    Teléfono
    <input
      type="tel"
      name="telefono"
      value="<?= e($persona['telefono'] ?? '') ?>"
      maxlength="25"
      autocomplete="tel"
    >
  </label>

  <label>
    Dirección
    <input
      name="direccion"
      value="<?= e($persona['direccion'] ?? '') ?>"
      maxlength="250"
      autocomplete="street-address"
    >
  </label>
</div>

```

## 52. app/views/admin/dashboard.php
```php
<div class="titulo-seccion"><div><p class="etiqueta">EL PULSO DE TU CAFETERÍA</p><h1>Hola, <?= e(explode(' ',$actual['nombre'])[0]) ?>.</h1><p class="muted">Todo listo para un nuevo buen momento.</p></div><a class="boton" href="<?= e(url('admin/pedidos')) ?>">Ver pedidos →</a></div>
<div class="indicadores" data-stats-url="<?= e(url('admin/indicadores')) ?>"><?php foreach($indicadores as $k=>$v): ?><article class="indicador"><p><?= e(ucfirst($k)) ?></p><strong data-stat="<?= e($k) ?>"><?= e($v) ?></strong><small>Registros actuales</small></article><?php endforeach ?></div><p id="stats-status" class="muted" role="status">Los indicadores se actualizan cada 10 segundos.</p>
<div class="dos-columnas seccion"><section class="tarjeta"><p class="etiqueta">OPERACIÓN DIARIA</p><h2>De la carta a la mesa</h2><p>Revisa existencias, consulta los pedidos entrantes y acompaña su preparación hasta la entrega.</p><a class="texto-link" href="<?= e(url('admin/productos')) ?>">Gestionar productos →</a></section><section class="tarjeta"><p class="etiqueta">UN FLUJO CLARO</p><h2>Pendiente → Preparando → Entregado</h2><p>La cancelación devuelve el stock. Los pedidos entregados y cancelados conservan su estado final.</p><a class="texto-link" href="<?= e(url('perfil')) ?>">Actualizar mi perfil →</a></section></div>

```

## 53. app/views/admin/productos.php
```php
<div class="titulo-seccion"><div><p class="etiqueta">NUESTRA CARTA</p><h1>Productos</h1></div><a href="<?= e(url('admin/productos')) ?>" class="boton">+ Nuevo producto</a></div>
<div class="gestion-grid"><section class="tarjeta"><h2><?= $editar?'Editar producto':'Registrar producto' ?></h2><form method="post" enctype="multipart/form-data" action="<?= e(url('admin/productos/guardar')) ?>"><?= CsrfToken::campo() ?><input type="hidden" name="id" value="<?= e($editar['id']??'') ?>"><label>Nombre<input name="nombre" value="<?= e($editar['nombre']??'') ?>" minlength="2" maxlength="120" required></label><label>Categoría<select name="categoria_id" required><option value="">Selecciona</option><?php foreach($categorias as $c): ?><option value="<?= e($c['id']) ?>" <?= ($editar['categoria_id']??null)==$c['id']?'selected':'' ?>><?= e($c['nombre']) ?></option><?php endforeach ?></select></label><label>Descripción<textarea name="descripcion" minlength="5" maxlength="1000" required><?= e($editar['descripcion']??'') ?></textarea></label><div class="campos-dos"><label>Precio (Bs.)<input type="number" name="precio" min="0.01" max="999999.99" step="0.01" value="<?= e($editar['precio']??'') ?>" required></label><label>Stock<input type="number" name="stock" min="0" max="1000000" value="<?= e($editar['stock']??0) ?>" required></label></div><label>Fotografía<input type="file" name="imagen" accept="image/jpeg,image/png,image/webp"><small>Hasta 4 MB y 3000 × 3000 px. Se guarda como JPG seguro.</small></label><label>Estado<select name="estado"><option value="1">Activo</option><option value="0" <?= isset($editar['estado'])&&!$editar['estado']?'selected':'' ?>>Inactivo</option></select></label><button>Guardar producto</button></form></section>
<section><form method="get" class="busqueda"><input type="search" name="q" value="<?= e($q) ?>" maxlength="120" placeholder="Buscar producto" aria-label="Buscar producto"><button>Buscar</button></form><div class="tabla-contenedor"><table><thead><tr><th>Producto</th><th>Precio</th><th>Stock</th><th>Estado</th><th>Acciones</th></tr></thead><tbody><?php foreach($productos as $p): ?><tr><td><strong><?= e($p['nombre']) ?></strong><small><?= e($p['categoria']) ?></small></td><td><?= e(bs($p['precio'])) ?></td><td><?= e($p['stock']) ?></td><td><span class="estado <?= $p['estado']?'entregado':'cancelado' ?>"><?= $p['estado']?'Activo':'Inactivo' ?></span></td><td><a href="<?= e(url('admin/productos?editar='.$p['id'])) ?>">Editar</a><form method="post" action="<?= e(url('admin/productos/eliminar')) ?>" data-confirm="¿Eliminar este producto? Si tiene pedidos asociados se conservará."><?= CsrfToken::campo() ?><input type="hidden" name="id" value="<?= e($p['id']) ?>"><button class="enlace peligro">Eliminar</button></form></td></tr><?php endforeach ?></tbody></table></div><p class="muted">Los productos con ventas se conservan por integridad histórica. Puedes desactivarlos.</p></section></div>

```

## 54. app/views/admin/categorias.php
```php
<div class="titulo-seccion"><h1>Categorías</h1><a class="boton" href="<?= e(url('admin/categorias')) ?>">+ Nueva categoría</a></div><div class="gestion-grid"><section class="tarjeta"><h2><?= $editar?'Editar':'Crear' ?> categoría</h2><form method="post" action="<?= e(url('admin/categorias/guardar')) ?>"><?= CsrfToken::campo() ?><input type="hidden" name="id" value="<?= e($editar['id']??'') ?>"><label>Nombre<input name="nombre" minlength="2" maxlength="80" value="<?= e($editar['nombre']??'') ?>" required></label><label>Descripción<textarea name="descripcion" minlength="3" maxlength="500" required><?= e($editar['descripcion']??'') ?></textarea></label><label>Estado<select name="estado"><option value="1">Activa</option><option value="0" <?= isset($editar['estado'])&&!$editar['estado']?'selected':'' ?>>Inactiva</option></select></label><button>Guardar categoría</button></form></section><div class="tabla-contenedor"><table><thead><tr><th>Nombre / descripción</th><th>Estado</th><th>Acciones</th></tr></thead><tbody><?php foreach($categorias as $c): ?><tr><td><strong><?= e($c['nombre']) ?></strong><small><?= e($c['descripcion']) ?></small></td><td><?= $c['estado']?'Activa':'Inactiva' ?></td><td><a href="<?= e(url('admin/categorias?editar='.$c['id'])) ?>">Editar</a><form method="post" action="<?= e(url('admin/categorias/eliminar')) ?>" data-confirm="¿Eliminar categoría? Solo es posible si no tiene productos."><?= CsrfToken::campo() ?><input type="hidden" name="id" value="<?= e($c['id']) ?>"><button class="enlace peligro">Eliminar</button></form></td></tr><?php endforeach ?></tbody></table></div></div>

```

## 55. app/views/admin/usuarios.php
```php
<div class="titulo-seccion"><h1>Usuarios</h1><a class="boton" href="<?= e(url('admin/usuarios')) ?>">+ Nuevo usuario</a></div><div class="gestion-grid"><section class="tarjeta"><h2><?= $editar?'Editar usuario':'Registrar usuario' ?></h2><form method="post" action="<?= e(url('admin/usuarios/guardar')) ?>"><?= CsrfToken::campo() ?><input type="hidden" name="id" value="<?= e($editar['id']??'') ?>"><?php $persona=$editar?:[];require __DIR__.'/campos-persona.php'; ?>
<?php if(!$editar): ?><label>Contraseña inicial<input type="password" name="clave" minlength="12" maxlength="72" autocomplete="new-password" required></label><?php endif ?>
<label>Rol<select name="rol"><?php foreach(['empleado','cliente','administrador'] as $r): ?><option value="<?= e($r) ?>" <?= ($editar['rol']??'empleado')===$r?'selected':'' ?>><?= e(ucfirst($r)) ?></option><?php endforeach ?></select></label><label>Estado<select name="estado"><option value="1">Activo</option><option value="0" <?= isset($editar['estado'])&&!$editar['estado']?'selected':'' ?>>Inactivo</option></select></label><button>Guardar usuario</button></form></section><section><form method="get" class="busqueda"><input name="q" type="search" maxlength="120" value="<?= e($q) ?>" placeholder="Nombre, usuario o correo" aria-label="Buscar usuarios"><button>Buscar</button></form><div class="tabla-contenedor"><table><thead><tr><th>Persona</th><th>Rol</th><th>Estado</th><th>Acción</th></tr></thead><tbody><?php foreach($usuarios as $u): ?><tr><td><strong><?= e($u['nombre']) ?></strong><small><?= e($u['usuario'].' · '.$u['correo']) ?></small></td><td><?= e($u['rol']) ?></td><td><?= $u['estado']?'Activo':'Inactivo' ?></td><td><a href="<?= e(url('admin/usuarios?editar='.$u['id'])) ?>">Editar</a></td></tr><?php endforeach ?></tbody></table></div></section></div>

```

## 56. app/views/admin/pedidos.php
```php
<div class="titulo-seccion"><div><p class="etiqueta"><?= $cliente?'TUS MOMENTOS CAFEBAR':'OPERACIÓN DIARIA' ?></p><h1><?= $cliente?'Mis pedidos':'Pedidos recibidos' ?></h1></div><?php if($cliente): ?><a class="boton" href="<?= e(url('productos')) ?>">Nuevo pedido ↗</a><?php endif ?></div>
<div class="tabla-contenedor"><table><thead><tr><th>Pedido</th><th>Cliente</th><th>Fecha (Bolivia)</th><th>Total</th><th>Estado</th><th>Detalle</th></tr></thead><tbody><?php foreach($pedidos as $p): ?><tr><td>#<?= e($p['id']) ?></td><td><?= e($p['cliente']) ?></td><td><?= e((new DateTimeImmutable($p['fecha'],new DateTimeZone('UTC')))->setTimezone(new DateTimeZone('America/La_Paz'))->format('d/m/Y H:i')) ?></td><td><?= e(bs($p['total'])) ?></td><td><span class="estado <?= e($p['estado']) ?>"><?= e(ucfirst($p['estado'])) ?></span></td><td><a href="<?= e(url('pedido?id='.$p['id'])) ?>">Ver pedido →</a></td></tr><?php endforeach ?></tbody></table></div><?php if(!$pedidos): ?><p class="vacio">Aún no hay pedidos registrados.</p><?php endif ?>

```

## 57. app/views/admin/pedido.php
```php
<div class="titulo-seccion"><h1>Pedido #<?= e($pedido['id']) ?></h1><span class="estado <?= e($pedido['estado']) ?>"><?= e(ucfirst($pedido['estado'])) ?></span></div><section class="tarjeta"><p><strong><?= e($pedido['cliente']) ?></strong> · <?= e($pedido['telefono']) ?></p><div class="tabla-contenedor"><table><thead><tr><th>Producto</th><th>Cantidad</th><th>Precio unitario</th><th>Subtotal</th></tr></thead><tbody><?php foreach($pedido['detalles'] as $d): ?><tr><td><?= e($d['nombre_producto']) ?></td><td><?= e($d['cantidad']) ?></td><td><?= e(bs($d['precio_unitario'])) ?></td><td><?= e(bs($d['subtotal'])) ?></td></tr><?php endforeach ?></tbody></table></div><h2 class="total-pedido">Total <?= e(bs($pedido['total'])) ?></h2>
<?php if(!$cliente): ?><form class="form-inline" method="post" action="<?= e(url('admin/pedidos/estado')) ?>"><?= CsrfToken::campo() ?><input type="hidden" name="id" value="<?= e($pedido['id']) ?>"><label>Estado del pedido<select name="estado"><?php foreach(['pendiente','preparando','entregado','cancelado'] as $s): ?><option value="<?= e($s) ?>" <?= $pedido['estado']===$s?'selected':'' ?>><?= e(ucfirst($s)) ?></option><?php endforeach ?></select></label><button>Actualizar estado</button></form><p class="muted">Pendiente → Preparando → Entregado. Se puede cancelar antes de entregar; la cancelación repone el stock.</p><?php endif ?></section><a href="<?= e(url($cliente?'mis-pedidos':'admin/pedidos')) ?>">← Volver a pedidos</a>

```

## 58. app/views/admin/mensajes.php
```php
<div class="titulo-seccion"><h1>Mensajes de contacto</h1><span class="muted">Últimos 500 mensajes</span></div><div class="mensajes-grid"><?php foreach($mensajes as $m): ?><article class="tarjeta"><div class="titulo-seccion"><h2><?= e($m['asunto']) ?></h2><span class="estado <?= $m['estado']==='nuevo'?'pendiente':'entregado' ?>"><?= e($m['estado']) ?></span></div><p><strong><?= e($m['nombre']) ?></strong><br><?= e($m['correo']) ?> · <?= e($m['fecha']) ?> UTC</p><details><summary>Leer consulta</summary><p class="texto-mensaje"><?= e($m['contenido']) ?></p></details><form class="form-inline" method="post" action="<?= e(url('admin/mensajes/estado')) ?>"><?= CsrfToken::campo() ?><input type="hidden" name="id" value="<?= e($m['id']) ?>"><label>Estado<select name="estado"><?php foreach(['nuevo','leido','respondido'] as $s): ?><option value="<?= e($s) ?>" <?= $m['estado']===$s?'selected':'' ?>><?= e($s) ?></option><?php endforeach ?></select></label><button>Guardar</button></form><form method="post" action="<?= e(url('admin/mensajes/eliminar')) ?>" data-confirm="¿Eliminar este mensaje definitivamente?"><?= CsrfToken::campo() ?><input type="hidden" name="id" value="<?= e($m['id']) ?>"><button class="enlace peligro">Eliminar mensaje</button></form></article><?php endforeach ?></div>

```

## 59. app/views/admin/perfil.php
```php
<div class="titulo-seccion"><div><p class="etiqueta">TU CUENTA</p><h1>Mi perfil</h1></div><span class="estado preparando"><?= e($perfil['rol']) ?></span></div><section class="tarjeta perfil-form"><form method="post" action="<?= e(url('perfil')) ?>"><?= CsrfToken::campo() ?><?php $persona=$perfil;require __DIR__.'/campos-persona.php'; ?><fieldset><legend>Cambiar contraseña</legend><p class="muted">Completa estos campos solo si deseas cambiar tu contraseña.</p><label>Contraseña actual<input name="clave_actual" type="password" maxlength="72" autocomplete="current-password"></label><label>Nueva contraseña<input name="nueva_clave" type="password" minlength="12" maxlength="72" autocomplete="new-password"></label><label>Confirmar nueva contraseña<input name="confirmacion" type="password" minlength="12" maxlength="72" autocomplete="new-password"></label></fieldset><button>Guardar mi perfil</button></form></section>

```

## 60. app/views/admin/musica.php
```php
<div class="titulo-seccion"><div><p class="etiqueta">COFFE MUSIC BAR</p><h1>Música del local</h1><p class="muted">Aprueba sugerencias y prepara la playlist que acompañará cada café.</p></div><a class="boton" href="<?= e(url('admin/musica/reproductor')) ?>">Abrir reproductor ♫</a></div>
<div class="dos-columnas"><section class="tarjeta"><h2>Añadir al catálogo</h2><form method="post" action="<?= e(url('admin/musica/agregar')) ?>" enctype="multipart/form-data"><?= CsrfToken::campo() ?><label>Título<input name="titulo" minlength="2" maxlength="150" required></label><label>Artista<input name="artista" minlength="2" maxlength="120" required></label><label>Fuente<select name="fuente" id="musica-fuente"><option value="youtube">YouTube</option><option value="archivo">Archivo de audio</option></select></label><div data-fuente="youtube"><label>Enlace de YouTube<input name="youtube" type="url" maxlength="400" placeholder="https://youtu.be/..."></label></div><div data-fuente="archivo" hidden><label>Audio MP3, OGG o WAV<input type="file" name="audio" accept="audio/mpeg,audio/ogg,audio/wav"><small>Máximo 20 MB. Carga audios que el local pueda utilizar.</small></label></div><button>Guardar canción</button></form></section><section class="tarjeta"><p class="etiqueta">CÓMO FUNCIONA</p><h2>Una playlist compartida.</h2><ol class="musica-pasos"><li>El cliente registrado sugiere una canción.</li><li>El personal la aprueba o la vincula a un audio del catálogo.</li><li>El equipo conectado al sonido del local reproduce la cola automáticamente.</li></ol><p class="muted">Al terminar las solicitudes aprobadas, continúa el catálogo activo en orden y vuelve al inicio. El navegador requiere un primer clic para habilitar el sonido. Abre un único reproductor para el local.</p><a class="texto-link" href="<?= e(url('admin/musica/reproductor')) ?>">Ir al reproductor →</a></section></div>
<section class="seccion"><div class="titulo-seccion"><h2>Sugerencias y cola</h2><span class="muted">Las nuevas solicitudes requieren aprobación</span></div><div class="mensajes-grid"><?php foreach($solicitudes as $s): ?><article class="tarjeta"><div class="titulo-seccion"><h3><?= e($s['titulo']) ?></h3><span class="estado <?= $s['estado']==='pendiente'?'pendiente':'preparando' ?>"><?= e(str_replace('_',' ',$s['estado'])) ?></span></div><p><?= e($s['artista']) ?><br><small class="muted">Sugerida por <?= e($s['cliente']) ?></small></p><?php if($s['youtube_id']): ?><a href="<?= e('https://www.youtube.com/watch?v='.$s['youtube_id']) ?>" target="_blank" rel="noopener noreferrer">Revisar enlace en YouTube ↗</a><?php endif ?><?php if($s['estado']==='pendiente'): ?><form method="post" action="<?= e(url('admin/musica/moderar')) ?>"><?= CsrfToken::campo() ?><input type="hidden" name="id" value="<?= e($s['id']) ?>"><label>Vincular audio o canción (opcional)<select name="cancion_id"><option value="">Usar la canción o enlace sugerido</option><?php foreach($catalogo as $c): if(!$c['activo'])continue; ?><option value="<?= e($c['id']) ?>"><?= e($c['titulo'].' — '.$c['artista']) ?></option><?php endforeach ?></select></label><div class="acciones"><button name="accion" value="aprobar">Aprobar</button><button class="secundario" name="accion" value="rechazar">Rechazar</button></div></form><?php endif ?></article><?php endforeach ?></div><?php if(!$solicitudes): ?><p class="vacio">No hay solicitudes pendientes ni canciones en cola.</p><?php endif ?></section>
<section><h2>Catálogo musical</h2><div class="tabla-contenedor"><table><thead><tr><th>Canción / artista</th><th>Fuente</th><th>Estado</th><th>Acciones</th></tr></thead><tbody><?php foreach($catalogo as $c): ?><tr><td><strong><?= e($c['titulo']) ?></strong><small><?= e($c['artista']) ?></small></td><td><?= e($c['fuente']) ?></td><td><?= $c['activo']?'Activa':'Inactiva' ?></td><td><?php if($c['activo']): ?><form method="post" action="<?= e(url('admin/musica/encolar')) ?>"><?= CsrfToken::campo() ?><input type="hidden" name="id" value="<?= e($c['id']) ?>"><button class="enlace">Añadir a la cola</button></form><?php endif ?><form method="post" action="<?= e(url('admin/musica/activar')) ?>"><?= CsrfToken::campo() ?><input type="hidden" name="id" value="<?= e($c['id']) ?>"><input type="hidden" name="activo" value="<?= $c['activo']?0:1 ?>"><button class="enlace"><?= $c['activo']?'Desactivar':'Activar' ?></button></form></td></tr><?php endforeach ?></tbody></table></div></section>

```

## 61. app/views/admin/reproductor.php
```php
<div class="titulo-seccion"><div><p class="etiqueta">SONIDO DEL LOCAL</p><h1>Que suene Coffe.</h1><p class="muted">Mantén abierta esta página en el equipo conectado a los parlantes.</p></div><a class="texto-link" href="<?= e(url('musica')) ?>">Gestionar música →</a></div>
<section class="tarjeta reproductor" id="reproductor-local" data-control="<?= e(url('admin/musica/control')) ?>" data-musica-estado="<?= e(url('musica/estado')) ?>"><div class="disco-musical" aria-hidden="true"><span>♫</span></div><p class="etiqueta">COFFE MUSIC BAR · PLAYLIST DEL LOCAL</p><h2 id="pista-titulo">Tu playlist está lista para empezar.</h2><p id="pista-artista" class="muted">Primero añade canciones al catálogo o aprueba las sugerencias.</p><div class="acciones controles-musica"><button id="musica-iniciar" type="button">Iniciar música ▶</button><button id="musica-siguiente" type="button" class="secundario" disabled>Siguiente ↗</button><button id="musica-detener" type="button" class="secundario" disabled>Detener</button></div><p id="reproductor-mensaje" class="aviso" role="status" aria-live="polite">Pulsa Iniciar música para permitir el sonido en este navegador.</p><audio id="audio-local" controls preload="metadata" hidden></audio><div id="youtube-contenedor" hidden><div id="youtube-local"></div></div><p class="muted">Si YouTube bloquea la reproducción, usa el botón de reproducción del video. Los videos no disponibles pueden omitirse con Siguiente.</p><h3>A continuación</h3><ol id="musica-cola" class="musica-lista"></ol><p id="musica-cola-vacia" class="muted">Sin solicitudes en cola: continuará el catálogo activo.</p><p id="musica-estado-conexion" class="muted" role="status"></p></section>

```

## 62. public/css/estilos.css
```css
@import "refinado.css";

```

## 63. public/css/refinado.css
```css
/* WE GO — diseño editorial, temas locales y componentes adaptables. */
:root{color-scheme:dark;--base:#0b1828;--surface:#111f30;--raised:#172739;--ink:#f3ebda;--muted:#b3b9bf;--accent:#dbb48b;--line:#ffffff1c;--input:#0d1a2b;--shadow:0 20px 60px #0002;--serif:Georgia,'Times New Roman',serif;--sans:Inter,'Segoe UI',Arial,sans-serif}
:root[data-theme=light]{color-scheme:light;--base:#f8f3e9;--surface:#fffdf8;--raised:#eee5d7;--ink:#152235;--muted:#5d665f;--accent:#8a522c;--line:#15223524;--input:#fffcf5;--shadow:0 18px 60px #1925360b}
*{box-sizing:border-box}html{scroll-behavior:smooth;scroll-padding-top:2rem}body{margin:0;min-height:100vh;background:var(--base);color:var(--ink);font:1rem/1.65 var(--sans);-webkit-font-smoothing:antialiased}::selection{background:var(--accent);color:var(--base)}h1,h2,h3,p{margin-top:0}h1,h2{font-family:var(--serif);font-weight:400;line-height:1.08;letter-spacing:-.045em}h1{font-size:clamp(2.8rem,5.5vw,5rem);margin-bottom:1.7rem}h2{font-size:clamp(2rem,3.3vw,3.25rem);margin-bottom:1rem}h3{font-size:1.08rem;line-height:1.35}em{font-family:var(--serif);font-weight:400;color:var(--accent)}a{color:inherit;text-underline-offset:.3em}a:hover{color:var(--accent)}img{display:block;max-width:100%;height:auto}button,input,select,textarea{font:inherit}button{cursor:pointer;color:inherit}button:disabled{cursor:not-allowed;opacity:.45}button,a,input,select,textarea{touch-action:manipulation}small{font-size:.76rem}.contenedor{width:min(1240px,calc(100% - 6rem));margin-inline:auto}.principal{min-height:65vh;padding-bottom:5rem}.etiqueta{font-size:.62rem;font-weight:700;letter-spacing:.19em;color:var(--accent);line-height:1.6;margin-bottom:1rem}.muted{color:var(--muted);font-size:.83rem}.saltar{position:fixed;z-index:100;top:-6rem;left:1rem;padding:1rem;background:var(--ink);color:var(--base)}.saltar:focus{top:1rem}
.anuncio{display:flex;justify-content:space-between;gap:1rem;padding:.65rem max(3rem,calc((100% - 1240px)/2));font-size:.55rem;font-weight:600;letter-spacing:.17em;border-bottom:1px solid var(--line);color:var(--muted)}.anuncio-lugar{display:flex;align-items:center;gap:.6rem;letter-spacing:.04em}.punto-vivo{width:5px;height:5px;background:var(--accent);border-radius:50%}.cabecera{display:flex;justify-content:space-between;align-items:center;gap:1.5rem;padding-block:1.6rem;border-bottom:1px solid var(--line);position:relative;z-index:10}.logo{display:inline-flex;align-items:center;gap:.7rem;text-decoration:none;white-space:nowrap;font-family:var(--sans);font-size:1.8rem;font-weight:850;letter-spacing:-.07em;line-height:1}.logo:hover{color:var(--ink)}.logo-punto{color:var(--accent)}.logo small{display:block;font-size:.43rem;font-weight:500;letter-spacing:.25em;margin-top:.6rem}.marca-icono{color:var(--accent);width:34px;height:38px}.cabecera-acciones{display:flex;align-items:center;gap:1.5rem}.cabecera nav{display:flex;align-items:center;gap:1.5rem}.cabecera nav a,.cabecera nav .enlace{font-size:.73rem;text-decoration:none;white-space:nowrap;color:var(--muted);font-weight:500}.cabecera nav a:hover,.cabecera nav a[aria-current=page]{color:var(--ink)}.cabecera nav a[aria-current=page]:not(.nav-chip):not(.nav-acceso){position:relative}.cabecera nav a[aria-current=page]:not(.nav-chip):not(.nav-acceso)::after{content:'';height:3px;width:3px;border-radius:50%;background:var(--accent);position:absolute;bottom:-.7rem;left:50%}.cabecera nav form{display:block;margin:0}.cabecera nav .nav-acceso{border:1px solid var(--line);padding:.7rem 1rem;border-radius:2rem;color:var(--ink);display:flex;gap:1.2rem;align-items:center}.nav-chip{display:inline-flex;align-items:center;gap:.6rem;background:var(--raised);padding:.45rem .8rem;border-radius:2rem}.badge{font-size:.6rem;padding:.1rem .4rem;background:var(--accent);color:var(--base);border-radius:1rem;min-width:1.2rem;text-align:center}.theme-rotator,.menu-toggle{display:inline-flex;align-items:center;justify-content:center;border:1px solid var(--line);background:transparent;color:var(--ink);border-radius:50%;height:39px;min-width:39px;padding:0;flex-shrink:0}.rotator-icon{font-size:1.3rem;line-height:1;transition:transform .3s}.theme-rotator:hover .rotator-icon{transform:rotate(90deg)}.menu-toggle{display:none}.acciones{display:flex;gap:1.8rem;align-items:center;flex-wrap:wrap}
.boton,button:not(.enlace):not(.agregar):not(.cart-remove):not(.theme-rotator):not(.menu-toggle){display:inline-flex;justify-content:center;align-items:center;gap:1.7rem;min-height:48px;background:var(--ink);color:var(--base);border:1px solid var(--ink);border-radius:2rem;padding:.85rem 1.5rem;text-decoration:none;font-size:.76rem;font-weight:650;line-height:1.5;transition:background .2s,transform .2s,border-color .2s;white-space:normal}.boton:hover,button:not(.enlace):not(.agregar):not(.cart-remove):not(.theme-rotator):not(.menu-toggle):hover{background:var(--accent);border-color:var(--accent);color:var(--base);transform:translateY(-2px)}.texto-link{display:inline-flex;align-items:center;gap:1rem;font-size:.76rem;font-weight:600;text-decoration:none;border-bottom:1px solid var(--line);padding-bottom:.3rem}.texto-link:hover{border-color:var(--accent)}.enlace{background:none;border:0;padding:0;color:inherit;text-decoration:underline;font-weight:600;font-size:.8rem;cursor:pointer}.secundario{background:transparent!important;color:var(--ink)!important;border-color:var(--line)!important}
.hero{display:grid;grid-template-columns:1.03fr 1fr;align-items:center;gap:5rem;padding-block:4.25rem 4rem}.hero-texto{padding-block:1.5rem}.hero .etiqueta{display:flex;align-items:center;gap:.65rem;margin-bottom:1.8rem;font-size:.56rem}.mini-linea{display:inline-block;background:var(--accent);width:25px;height:1px}.hero h1{font-size:clamp(3rem,5.6vw,5.5rem);line-height:1.1;letter-spacing:-.06em;margin-bottom:1.7rem}.hero h1 em{white-space:nowrap}.entradilla{color:var(--muted);max-width:25rem;font-size:.89rem;line-height:1.9;margin-bottom:2rem}.hero .acciones{gap:1.6rem}.hero .boton{font-size:.73rem}.hero-firma{display:flex;align-items:center;gap:.9rem;border-top:1px solid var(--line);margin-top:3.5rem;padding-top:1.5rem;max-width:27rem}.firma-icono{font-size:2rem;color:var(--accent);line-height:1}.hero-firma p{font-size:.68rem;line-height:1.8;color:var(--muted);margin:0}.hero-firma strong{font-weight:500;color:var(--ink)}.firma-coordenada{margin-left:auto;padding-left:1rem;border-left:1px solid var(--line);font-size:.5rem;letter-spacing:.15em;line-height:1.8;color:var(--muted)}.hero-visual{position:relative;min-width:0}.foto-marco{overflow:hidden;position:relative;border-radius:12rem 12rem 1.2rem 1.2rem;aspect-ratio:4/4.75;background:#342c26}.hero-foto{width:100%;height:100%;object-fit:cover}.foto-marco::after{content:'';position:absolute;inset:45% 0 0;background:linear-gradient(transparent,#10141bd4);pointer-events:none}.foto-indice{position:absolute;z-index:1;left:2rem;top:2.2rem;color:#f6e9d1bf;font-size:.45rem;letter-spacing:.19em}.foto-caption{position:absolute;z-index:1;bottom:2rem;left:2.2rem;color:#f6eddd;display:grid;gap:.55rem}.foto-caption>span{font-size:.5rem;letter-spacing:.18em}.foto-caption strong{font:italic 2rem var(--serif);font-weight:400}.sello{position:absolute;z-index:2;left:-2.2rem;top:2.5rem;width:6rem;height:6rem;border-radius:50%;background:#dfc49f;border:6px solid var(--base);color:#172438;display:grid;place-content:center;text-align:center;font-size:.55rem;font-weight:650;letter-spacing:.08em;line-height:1.5;transform:rotate(-12deg)}.sello span{font:italic 1rem var(--serif);line-height:.5}.sello br{display:none}.hero-vertical{position:absolute;right:-1.7rem;top:35%;writing-mode:vertical-rl;font-size:.48rem;letter-spacing:.22em;color:var(--muted)}
.banda-valores{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;border-block:1px solid var(--line);padding:1.5rem 0;color:var(--muted);font-size:.68rem}.banda-valores b{font-weight:400;color:var(--accent);margin-right:.7rem}.seccion{padding-block:3.5rem}.titulo-seccion{display:flex;justify-content:space-between;align-items:end;gap:2rem;margin-bottom:2rem}.titulo-seccion h1,.titulo-seccion h2{margin-bottom:0}.titulo-seccion .etiqueta{margin-bottom:.65rem}.titulo-seccion>.muted{margin-bottom:.25rem}.categorias-inicio{padding-bottom:1.5rem}.categorias-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem}.categoria-tile{display:grid;grid-template-columns:1fr auto;gap:.9rem;text-decoration:none;border:1px solid var(--line);border-radius:.6rem;padding:1.2rem 1.3rem;background:var(--surface);transition:background .2s,transform .2s}.categoria-tile:hover{background:var(--raised);transform:translateY(-3px);color:var(--ink)}.categoria-numero{grid-column:1/-1;font-size:.55rem;letter-spacing:.1em;color:var(--accent)}.categoria-tile strong{font:1.5rem var(--serif);font-weight:400}.categoria-flecha{color:var(--accent);font-size:1.15rem}
.productos-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:1.5rem}.producto{background:var(--surface);border:1px solid var(--line);border-radius:.8rem;overflow:hidden;display:flex;flex-direction:column;transition:transform .25s,box-shadow .25s}.producto:hover{transform:translateY(-5px);box-shadow:var(--shadow)}.producto-imagen{position:relative;aspect-ratio:4/3;overflow:hidden;background:#d7c5a9}.producto-imagen img{width:100%;height:100%;object-fit:cover;transition:transform .5s}.producto:hover .producto-imagen img{transform:scale(1.04)}.categoria-chip{position:absolute;top:1rem;left:1rem;font-size:.5rem;letter-spacing:.13em;text-transform:uppercase;padding:.38rem .65rem;background:#fbf5eae8;color:#29322e;border:1px solid #fff7;border-radius:2rem}.producto-info{padding:1.4rem;display:flex;flex-direction:column;flex:1}.producto-titulo{display:flex;justify-content:space-between;align-items:start;gap:1rem}.producto-titulo h3{font-family:var(--serif);font-weight:400;font-size:1.35rem;margin-bottom:.75rem;letter-spacing:-.02em}.producto-titulo strong{font-size:.82rem;color:var(--accent);white-space:nowrap;line-height:1.7}.producto-info>p{color:var(--muted);font-size:.75rem;line-height:1.8;flex:1;margin-bottom:1.3rem}.producto-final{display:flex;align-items:center;justify-content:space-between;gap:.75rem;border-top:1px solid var(--line);padding-top:1rem}.producto-final small{font-size:.62rem;color:var(--muted)}.producto-final small::before{content:'';display:inline-block;width:4px;height:4px;background:var(--accent);border-radius:50%;margin-right:.4rem}.producto-final .enlace{font-size:.7rem;color:var(--ink);text-decoration:none}.agregar{border:1px solid var(--line);border-radius:2rem;background:var(--raised);color:var(--ink);padding:.5rem 1rem;font-size:.72rem;font-weight:600;min-height:38px}.agregar:hover{background:var(--ink);color:var(--base)}
.ritual{display:grid;grid-template-columns:.75fr 1fr;align-items:center;gap:5rem;margin:2rem 0 4rem;padding:3rem 4rem;background:var(--surface);border:1px solid var(--line);border-radius:.9rem;overflow:hidden}.ritual-numero{font:italic clamp(8rem,17vw,16rem)/1 var(--serif);color:var(--accent);opacity:.85;text-align:center;letter-spacing:-.15em;padding-right:.15em}.ritual h2{font-size:2.6rem}.ritual p:not(.etiqueta){font-size:.8rem;color:var(--muted);max-width:28rem;line-height:1.9}.invitacion{display:flex;align-items:center;justify-content:space-between;gap:2rem;border-block:1px solid var(--line);padding:3rem 0 0}.invitacion h2{font-size:3rem}.invitacion p:last-child{font-size:.8rem;color:var(--muted);margin-bottom:0}.invitacion-accion{display:grid;gap:1rem;text-align:center}.invitacion-accion>span{font-size:.6rem;color:var(--muted)}.pie{padding:3.5rem 0 1.5rem;background:var(--surface);border-top:1px solid var(--line)}.pie-grid{display:grid;grid-template-columns:1.5fr 1fr 1fr;gap:2rem}.pie-grid .logo{font-size:2.3rem;margin-bottom:1rem}.pie p{font-size:.8rem;line-height:1.8;color:var(--muted)}.pie-grid .etiqueta{display:block;margin:0 0 1rem;font-size:.55rem}.pie-grid>div>a:not(.logo){display:block;font-size:.75rem;text-decoration:none;color:var(--muted);margin-bottom:.5rem}.pie-legal{display:flex;justify-content:space-between;align-items:center;gap:1rem;flex-wrap:wrap;font-size:.58rem;color:var(--muted);border-top:1px solid var(--line);padding-top:1.3rem;margin-top:2.5rem}.pie-legal a{text-decoration:none}
.pagina-hero{padding:4rem 0 2.5rem;max-width:52rem}.pagina-hero p:not(.etiqueta){font-size:.9rem;color:var(--muted);max-width:35rem}.pagina-hero.compacta{padding:3.5rem 0 1rem}.pagina-hero.compacta h1{font-size:3.8rem}.filtros{display:grid;grid-template-columns:2fr 1fr auto;gap:1rem;align-items:end;padding:1.3rem;border:1px solid var(--line);border-radius:.75rem;background:var(--surface);margin:1rem 0}.dos-columnas{display:grid;grid-template-columns:1fr 1fr;gap:2.5rem;align-items:start}.tres-columnas{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:1.5rem}.tarjeta{border:1px solid var(--line);border-radius:.8rem;background:var(--surface);padding:1.8rem}.tarjeta h2{font-size:1.8rem}.tarjeta p{overflow-wrap:anywhere}.imagen-historia{border-radius:.8rem}.contacto-datos{padding-top:1.5rem}.contacto-datos h2{font-size:2.6rem}.contacto-datos>p{color:var(--muted)}form{display:grid;gap:1.1rem}label{display:grid;gap:.5rem;font-size:.75rem;font-weight:550;min-width:0}input,select,textarea{width:100%;min-width:0;padding:.8rem 1rem;border:1px solid var(--line);border-radius:.4rem;background:var(--input);color:var(--ink);font-size:.83rem;line-height:1.5}input::placeholder,textarea::placeholder{color:var(--muted);opacity:.8}input[type=file]{font-size:.72rem}textarea{min-height:7rem;resize:vertical}label small{font-size:.65rem;color:var(--muted);font-weight:400}.campos-dos{display:grid;grid-template-columns:1fr 1fr;gap:1rem}fieldset{border:1px solid var(--line);border-radius:.5rem;padding:1.3rem;display:grid;gap:1rem;margin:1rem 0}legend{font-size:.8rem;font-weight:600}.auth-grid{display:grid;grid-template-columns:1fr 1fr;gap:5rem;padding:4rem 0;align-items:center}.auth-bienvenida h1{font-size:3.6rem}.auth-bienvenida img{width:16rem;border-radius:50%;opacity:.9}.auth-form{max-width:29rem;width:100%;justify-self:end}.auth-form>p:last-child{font-size:.75rem;margin:1.5rem 0 0}.formulario-central{max-width:46rem;margin:3.5rem auto}.formulario-central h1{font-size:3rem}.aviso{padding:1rem 1.3rem;border:1px solid var(--line);border-left:3px solid var(--accent);border-radius:.4rem;background:var(--raised);font-size:.8rem;margin:1.5rem 0;color:var(--ink)}.aviso.exito{border-left-color:#7dba8d}.aviso.error{border-left-color:#e99484}.error-pagina{margin:3rem 0}.error-pagina h1{font-size:2.7rem}.vacio{padding:3rem;text-align:center;border:1px dashed var(--line);border-radius:.6rem;color:var(--muted);margin-block:1.5rem;font-size:.85rem}
.tabla-contenedor{overflow-x:auto;background:var(--surface);border:1px solid var(--line);border-radius:.6rem}table{width:100%;border-collapse:collapse;text-align:left;font-size:.78rem}th,td{padding:1rem;border-bottom:1px solid var(--line);vertical-align:middle}th{background:var(--raised);color:var(--muted);font-size:.58rem;text-transform:uppercase;letter-spacing:.08em;white-space:nowrap}td small{display:block;color:var(--muted);font-size:.65rem}td form{margin-top:.5rem}td a{white-space:nowrap}tr:last-child td{border-bottom:0}.estado{display:inline-flex;align-items:center;gap:.4rem;font-size:.62rem;line-height:1.5;padding:.3rem .7rem;border-radius:2rem;font-weight:650;white-space:nowrap}.estado::before{content:'';width:4px;height:4px;border-radius:50%;background:currentColor}.pendiente{background:#56421c;color:#ffe0a2}.preparando{background:#203c56;color:#add4ff}.entregado{background:#204537;color:#b0e2ba}.cancelado{background:#542e2c;color:#ffc0b0}:root[data-theme=light] .pendiente{background:#f8e9c5;color:#795112}:root[data-theme=light] .preparando{background:#e0ebfa;color:#305884}:root[data-theme=light] .entregado{background:#dfeddf;color:#36623b}:root[data-theme=light] .cancelado{background:#f9e3db;color:#934a32}.peligro{color:#e89e8f}:root[data-theme=light] .peligro{color:#9b3d2c}.total-pedido{text-align:right;margin-top:1.5rem}.form-inline{display:flex;align-items:end;gap:1rem;flex-wrap:wrap}.resumen-carrito{max-width:33rem;margin:2rem 0 0 auto}.resumen-carrito h2{display:flex;justify-content:space-between;gap:1rem;font-size:1.6rem}.resumen-carrito>a{display:block;font-size:.75rem;margin-top:1rem}.cart-quantity{width:5rem}.cart-remove{border:0;background:transparent;color:var(--accent);text-decoration:underline}
.panel-body{display:grid;grid-template-columns:235px minmax(0,1fr);min-height:100vh}.ondas-fondo{display:none}.sidebar{padding:2rem 1.25rem;background:#091421;color:#f2e9d9;border-right:1px solid #ffffff15;position:sticky;top:0;height:100vh;display:flex;flex-direction:column;gap:1.7rem}.sidebar .logo{font-size:1.65rem;color:#f2e9d9;letter-spacing:-.05em}.sidebar .logo-icono{font-size:1.4rem}.sidebar>.etiqueta{font-size:.5rem;color:#a9a89f;margin-bottom:-.7rem}.sidebar nav{display:grid;gap:.3rem}.sidebar nav a{display:block;text-decoration:none;font-size:.75rem;padding:.7rem .8rem;border-radius:.4rem;color:#afb7bf;transition:background .2s}.sidebar nav a:hover,.sidebar nav a.activo{background:#ffffff0c;color:#f3ebda}.sidebar nav a.activo{box-shadow:inset 2px 0 #dbb48b}.sidebar-perfil{margin-top:auto;border-top:1px solid #ffffff1c;padding-top:1.3rem;display:grid;gap:.3rem}.sidebar-perfil strong{font-size:.75rem}.sidebar-perfil small{font-size:.63rem;color:#aeb5be;text-transform:capitalize}.sidebar .secundario{color:#e4ddcf!important;border-color:#ffffff24!important;font-size:.65rem!important;min-height:38px!important;margin-top:.75rem}.sidebar .theme-rotator{color:#f3ebda;border-color:#ffffff24}.panel-main{min-width:0;padding:0 2.5rem 4rem}.panel-top{display:flex;justify-content:space-between;gap:1rem;border-bottom:1px solid var(--line);padding:1.5rem 0;margin-bottom:2.5rem;font-size:.56rem;letter-spacing:.12em;color:var(--muted)}.panel-main h1{font-size:3rem}.indicadores{display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:1rem}.indicador{border:1px solid var(--line);border-radius:.6rem;padding:1.4rem;background:var(--surface);position:relative;overflow:hidden}.indicador::after{content:'';position:absolute;top:0;left:1.4rem;width:24px;height:2px;background:var(--accent)}.indicador p{font-size:.7rem;color:var(--muted);margin-bottom:.75rem}.indicador strong{display:block;font:2.7rem/1.2 var(--serif)}.indicador small{font-size:.57rem;color:var(--muted)}.gestion-grid{display:grid;grid-template-columns:minmax(270px,.85fr) minmax(0,1.5fr);gap:1.5rem;align-items:start}.gestion-grid .campos-dos{grid-template-columns:1fr}.busqueda{display:flex;gap:.75rem;margin-bottom:1rem}.perfil-form{max-width:48rem}.mensajes-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:1.5rem}.mensajes-grid .titulo-seccion{align-items:start}.mensajes-grid h2{font-size:1.45rem}.mensajes-grid .form-inline{margin-block:1rem}.texto-mensaje{white-space:pre-wrap;overflow-wrap:anywhere}.mensajes-grid summary{cursor:pointer;font-size:.8rem;font-weight:600}#toast{position:fixed;left:50%;bottom:1.5rem;transform:translateX(-50%);background:var(--ink);color:var(--base);box-shadow:var(--shadow);padding:.9rem 1.4rem;border-radius:2rem;z-index:100;max-width:90vw;font-size:.75rem}:focus-visible{outline:2px solid var(--accent);outline-offset:5px}[hidden]{display:none!important}
.catalogo-tabs{display:flex;flex-wrap:wrap;gap:.6rem;margin:.5rem 0 1.75rem}.catalogo-tabs a{font-size:.73rem;text-decoration:none;border:1px solid var(--line);border-radius:2rem;padding:.55rem 1.1rem;color:var(--muted);transition:background .2s,color .2s}.catalogo-tabs a[aria-current=page],.catalogo-tabs a:hover{background:var(--ink);color:var(--base);border-color:var(--ink)}.catalogo-meta{display:flex;justify-content:space-between;align-items:center;gap:1rem;margin:1.5rem 0}.catalogo-meta p{margin:0}.catalogo-meta .texto-link{font-size:.65rem}.catalogo-nota{font-size:.7rem;line-height:1.8;color:var(--muted);text-align:center;border-top:1px solid var(--line);padding-top:1.5rem;margin-top:2rem}.theme-actions{display:flex;justify-content:center;margin-block:.5rem}
@media(min-width:1600px){.panel-main{width:100%;max-width:1600px;margin:auto}}
@media(max-width:1200px){.cabecera nav{gap:1rem}.cabecera-acciones{gap:1rem}.hero{gap:3rem}.hero h1{font-size:clamp(3rem,5.5vw,4.8rem)}.gestion-grid{grid-template-columns:1fr}.gestion-grid .campos-dos{grid-template-columns:1fr 1fr}.panel-main{padding-inline:1.7rem}.hero-firma{margin-top:2.5rem}.cabecera nav a,.cabecera nav .enlace{font-size:.65rem}}
@media(max-width:960px){.contenedor{width:calc(100% - 3rem)}.anuncio{padding-inline:1.5rem}.hero{gap:2.5rem;padding-block:3rem}.hero h1{font-size:3.5rem}.hero .acciones{gap:1rem}.hero .boton{padding-inline:1.2rem}.hero .texto-link{font-size:.7rem}.hero-firma{margin-top:2rem}.firma-coordenada{display:none}.sello{width:5rem;height:5rem;font-size:.45rem;left:-1.5rem;top:1.5rem}.hero-vertical{right:-1rem}.foto-caption{left:1.5rem;bottom:1.5rem}.foto-caption strong{font-size:1.6rem}.categorias-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.productos-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.favoritos .producto:last-child:nth-child(3){grid-column:1/-1;max-width:calc(50% - .75rem);justify-self:center}.ritual{gap:2rem;padding:2.5rem}.ritual h2{font-size:2.2rem}.panel-body{grid-template-columns:190px minmax(0,1fr)}.mensajes-grid{grid-template-columns:1fr}.tres-columnas{grid-template-columns:1fr}.menu-toggle{display:inline-flex;border-radius:2rem;padding:0 .85rem;gap:.5rem;font-size:.65rem}.cabecera nav{display:none;position:absolute;top:calc(100% + 1px);left:-1.5rem;right:-1.5rem;background:var(--surface);padding:1.5rem;box-shadow:0 20px 25px #0002;flex-wrap:wrap;gap:1rem 1.5rem;border-bottom:1px solid var(--line)}.cabecera nav.abierto{display:flex}.cabecera nav a,.cabecera nav .enlace{font-size:.8rem}.auth-grid{gap:2rem}.auth-bienvenida h1{font-size:3rem}}
@media(max-width:700px){.contenedor{width:calc(100% - 2.5rem)}.anuncio{padding-inline:1.25rem;font-size:.46rem;letter-spacing:.1em}.anuncio-lugar{font-size:.5rem}.cabecera{padding-block:1.1rem}.logo{font-size:1.55rem}.logo small{font-size:.36rem}.marca-icono{width:29px;height:34px}.cabecera-acciones{gap:.6rem}.cabecera nav{left:-1.25rem;right:-1.25rem;flex-direction:column;align-items:stretch;gap:.25rem}.cabecera nav a,.cabecera nav .enlace{display:flex;padding:.7rem .5rem;min-height:42px}.cabecera nav a[aria-current=page]::after{display:none}.cabecera nav .nav-acceso{margin-top:.5rem;justify-content:space-between}.cabecera nav .nav-chip{justify-content:space-between}.hero{grid-template-columns:1fr;gap:2rem;padding-block:2.5rem}.hero-texto{padding:0}.hero .etiqueta{margin-bottom:1.2rem}.hero h1{font-size:clamp(2.9rem,9vw,4.4rem);margin-bottom:1.3rem}.entradilla{font-size:.85rem;max-width:31rem;margin-bottom:1.5rem}.hero-firma{margin-top:1.8rem;padding-top:1rem;max-width:none}.firma-coordenada{display:block}.hero-visual{width:calc(100% - 1rem);margin-inline:auto}.foto-marco{aspect-ratio:4/3.7;border-radius:8rem 8rem .8rem .8rem}.hero-foto{object-position:center 55%}.sello{top:1.4rem;left:-1.2rem;width:5.5rem;height:5.5rem;font-size:.48rem}.hero-vertical{right:-1.2rem;font-size:.42rem}.foto-indice{top:1.8rem;left:2rem}.foto-caption{left:1.8rem;bottom:1.5rem}.foto-caption strong{font-size:2rem}.banda-valores{display:grid;grid-template-columns:1fr 1fr;font-size:.58rem;padding-block:1.2rem;gap:.8rem}.banda-valores b{margin-right:.4rem}.seccion{padding-block:2.5rem}.categorias-inicio{padding-bottom:0}.titulo-seccion{gap:1rem;align-items:start;flex-direction:column;margin-bottom:1.5rem}.titulo-seccion h2{font-size:2.1rem}.categoria-tile{padding:1.1rem}.categoria-tile strong{font-size:1.4rem}.ritual{grid-template-columns:1fr;gap:0;padding:2rem;margin-block:1rem 3rem}.ritual-numero{font-size:6rem;justify-self:start;line-height:1;margin-bottom:1.5rem}.ritual h2{font-size:2.2rem}.invitacion{flex-direction:column;align-items:start;padding-top:2.5rem}.invitacion h2{font-size:2.7rem}.invitacion-accion{text-align:left}.pie-grid{grid-template-columns:1fr 1fr;gap:1.5rem}.pie-grid>div:first-child{grid-column:1/-1}.pie{padding-top:2.5rem}.pie-legal{font-size:.55rem;gap:.75rem}.pie-legal>a{margin-left:auto}.dos-columnas,.auth-grid{grid-template-columns:1fr}.auth-grid{padding-block:2.5rem}.auth-bienvenida{display:none}.auth-form{max-width:none}.pagina-hero,.pagina-hero.compacta{padding-top:2.5rem}.pagina-hero.compacta h1{font-size:3rem}.filtros{grid-template-columns:1fr;padding:1.1rem}.filtros button{width:100%}.campos-dos,.gestion-grid .campos-dos{grid-template-columns:1fr}.tarjeta{padding:1.35rem}.formulario-central{margin-block:2rem}.panel-body{display:block}.sidebar{position:static;height:auto;padding:1.2rem;gap:1rem}.sidebar>.etiqueta{display:none}.sidebar nav{display:flex;flex-wrap:wrap;gap:.25rem}.sidebar nav a{font-size:.67rem;padding:.5rem .6rem}.sidebar .logo{font-size:1.5rem}.sidebar>.theme-actions{position:absolute;right:1.2rem;top:1.2rem}.sidebar-perfil{display:flex;flex-wrap:wrap;align-items:center;gap:.8rem;padding-top:.8rem}.sidebar-perfil form{margin-left:auto}.sidebar-perfil .secundario{margin:0}.panel-main{padding:0 1.1rem 2.5rem}.panel-top{font-size:.5rem;margin-bottom:1.8rem;padding-block:1.2rem}.panel-main h1{font-size:2.5rem}.indicadores{grid-template-columns:repeat(2,minmax(0,1fr))}.indicador{padding:1.1rem}.indicador strong{font-size:2.3rem}.tabla-contenedor td,.tabla-contenedor th{padding:.85rem}.resumen-carrito{max-width:none}.form-inline{align-items:stretch;flex-direction:column}.form-inline label{width:100%}.form-inline button{align-self:start}.gestion-grid{gap:1.5rem}}
@media(max-width:450px){.productos-grid{grid-template-columns:1fr}.favoritos .producto:last-child:nth-child(3){grid-column:auto;max-width:none}.producto-info{padding:1.3rem}.producto-imagen{aspect-ratio:4/2.8}.hero h1{font-size:2.85rem}.hero .acciones{gap:1rem}.hero .boton{font-size:.7rem;gap:1rem}.hero .texto-link{font-size:.65rem}.anuncio-lugar{display:none}.anuncio{justify-content:center}.hero-firma{gap:.6rem}.firma-coordenada{font-size:.43rem}.categorias-grid{gap:.7rem}.categoria-tile{padding:.9rem}.categoria-tile strong{font-size:1.2rem}.categoria-flecha{font-size:1rem}.busqueda{flex-direction:column}.panel-top span:last-child{display:none}.resumen-carrito h2{font-size:1.45rem}.menu-toggle{min-width:38px}.menu-toggle>span:last-child{display:none}.hero .etiqueta{font-size:.5rem}.contacto-datos h2{font-size:2.2rem}}
@media(prefers-reduced-motion:reduce){html{scroll-behavior:auto}*,*::before,*::after{transition:none!important;animation:none!important}}

```

## 64. public/css/cristal.css
```css
@font-face {
  font-family: 'Nunito';
  src: url('../fonts/nunito-variable.ttf') format('truetype');
  font-style: normal;
  font-weight: 200 1000;
  font-display: swap;
}

:root {
  --base: #221916;
  --surface: #302520;
  --raised: #3c3029;
  --ink: #faefdc;
  --muted: #c6b7a9;
  --accent: #edb986;
  --line: #f8e9ce29;
  --input: #291f1c;
  --sans: 'Nunito', 'Segoe UI', sans-serif;
  --serif: 'Nunito', 'Segoe UI', sans-serif;
  --glass: rgba(56, 43, 35, .76);
  --glass-top: rgba(255, 240, 209, .14);
  --glass-bottom: rgba(255, 240, 209, .035);
  --edge: rgba(255, 238, 202, .19);
  --bevel: rgba(255, 244, 219, .2);
  --depth: rgba(9, 5, 3, .28);
  --shadow: 0 16px 40px var(--depth), inset 0 1px 0 var(--bevel);
  --contact: #b9dbbc;
}

:root[data-theme=light] {
  --base: #f4ecdf;
  --surface: #fff9ef;
  --raised: #eaddcb;
  --ink: #3f2d25;
  --muted: #766356;
  --accent: #96552f;
  --line: #7b503b2b;
  --input: #fffcf6;
  --glass: rgba(255, 251, 241, .78);
  --glass-top: rgba(255, 255, 255, .88);
  --glass-bottom: rgba(255, 255, 255, .2);
  --edge: rgba(255, 255, 255, .86);
  --bevel: rgba(255, 255, 255, .98);
  --depth: rgba(95, 63, 41, .12);
  --contact: #316240;
}

body {
  font-family: var(--sans);
  background:
    radial-gradient(ellipse at 93% 0, #bf865e23, transparent 40rem),
    radial-gradient(ellipse at 0 45%, #97a78412, transparent 36rem),
    var(--base);
  background-attachment: fixed;
  font-weight: 500;
}
h1, h2, h3 { font-family: var(--sans); font-weight: 750; letter-spacing: -.045em; }
h1 { line-height: 1.08; }
h2 { line-height: 1.16; }
h3 { letter-spacing: -.025em; }
em { font-family: var(--sans); font-style: normal; font-weight: 800; }
.etiqueta { font-weight: 800; letter-spacing: .14em; font-size: .65rem; }
.muted { font-size: .88rem; }
.anuncio { border: 0; font-size: .56rem; padding-top: .9rem; padding-bottom: .9rem; }
.cabecera {
  background: linear-gradient(130deg, var(--glass-top), var(--glass-bottom)), var(--glass);
  border: 1px solid var(--edge);
  border-radius: 24px;
  padding: 1rem 1.4rem;
  box-shadow: 0 8px 30px var(--depth), inset 0 1px 0 var(--bevel), inset 0 -1px 0 #0000000d;
  -webkit-backdrop-filter: blur(22px) saturate(135%);
  backdrop-filter: blur(22px) saturate(135%);
}
.logo { gap: .7rem; letter-spacing: -.04em; font-weight: 900; }
.marca-logo, .logo-imagen {
  width: 48px;
  height: 48px;
  border-radius: 16px;
  box-shadow: 0 4px 9px #00000029, inset 0 1px 0 #fff5;
  flex-shrink: 0;
}
.marca-texto { display: grid; font-size: 1.7rem; line-height: 1; text-shadow: 0 1px 0 #fff2, 0 3px 5px #0002; }
.marca-subtitulo { font-size: .5rem; letter-spacing: .24em; font-weight: 750; margin-top: .45rem; }
.logo-marca { display: grid; line-height: 1; gap: .2rem; }
.logo-linea-1 { font-size: 1.5rem; font-weight: 900; }
.logo-linea-2, .logo-linea-3 { font-size: .7rem; letter-spacing: .15em; }
.cabecera nav a, .cabecera nav .enlace { font-size: .79rem; font-weight: 650; }
.cabecera nav .nav-acceso, .nav-chip, .theme-rotator, .menu-toggle {
  background: linear-gradient(140deg, var(--glass-top), var(--glass-bottom));
  border-color: var(--edge);
  box-shadow: inset 0 1px 0 var(--bevel), 0 3px 8px #0000000c;
}
.cabecera nav .nav-acceso { padding: .7rem 1rem; }
.theme-rotator { width: 42px; height: 42px; }
.hero { padding-block: 4rem; gap: 4rem; }
.hero h1 {
  font-size: clamp(3.2rem, 6.1vw, 5.7rem);
  font-weight: 850;
  letter-spacing: -.065em;
  line-height: 1.05;
  text-shadow: 0 1px 0 #fff2, 0 2px 0 #0001, 0 5px 12px #0002;
}
.hero h1 em { display: inline-block; padding-top: .05em; color: var(--accent); font-weight: 850; }
.entradilla { font-size: 1rem; max-width: 27rem; line-height: 1.85; }
.hero .etiqueta { font-size: .62rem; }
.hero-firma { border-top: 0; background: var(--glass); border: 1px solid var(--line); padding: 1rem 1.2rem; border-radius: 18px; box-shadow: inset 0 1px 0 var(--bevel); }
.hero-firma p { font-size: .76rem; }
.firma-icono { font-size: 1.7rem; }
.firma-coordenada { font-size: .5rem; }
.hero-visual { perspective: 1000px; }
.foto-marco {
  border-radius: 36px;
  border: 7px solid var(--glass);
  box-shadow: 0 28px 65px #0003, 0 7px 14px #0002, 0 0 0 1px var(--edge), inset 0 1px 0 var(--bevel);
  transform: rotate(2deg);
  aspect-ratio: 4 / 4.6;
  transition: transform .45s ease, box-shadow .45s ease;
}
.hero-visual:hover .foto-marco { transform: rotate(0); }
.foto-marco::after { background: linear-gradient(transparent, #261711c9); inset: 55% 0 0; }
.foto-indice { font-size: .53rem; color: #ffefdb; background: #38241859; border: 1px solid #fff3; padding: .55rem .8rem; border-radius: 2rem; backdrop-filter: blur(14px); left: 1.4rem; top: 1.4rem; }
.foto-caption {
  left: 1.1rem;
  right: 1.1rem;
  bottom: 1.1rem;
  padding: 1.2rem 1.4rem;
  background: linear-gradient(130deg, #ffffff26, #ffffff05), #30201768;
  border: 1px solid #fff5;
  border-radius: 22px;
  box-shadow: inset 0 1px 0 #fff4, 0 10px 25px #0002;
  backdrop-filter: blur(18px) saturate(125%);
  -webkit-backdrop-filter: blur(18px) saturate(125%);
}
.foto-caption>span { font-size: .55rem; }
.foto-caption strong { font: 750 1.6rem/1.2 var(--sans); letter-spacing: -.04em; }
.sello { background: linear-gradient(145deg, #f7d4a5, #c78d57); border: 4px solid #fff3; box-shadow: 0 9px 20px #0003, inset 0 2px 1px #fff8, inset 0 -3px 2px #9e603a30; color: #4b3020; font-size: .57rem; left: -2rem; top: 2.5rem; }
.hero-vertical { font-size: .48rem; right: -1.8rem; }
.music-chip { display: inline-flex; align-items: center; gap: .7rem; color: var(--ink); font-size: .69rem; padding: .6rem 1rem; border-radius: 30px; background: var(--glass); border: 1px solid var(--edge); box-shadow: 0 6px 18px var(--depth), inset 0 1px 0 var(--bevel); margin-bottom: 1.5rem; }
.ecualizador { height: 18px; display: flex; align-items: center; gap: 3px; }
.ecualizador i { width: 3px; border-radius: 3px; height: 9px; background: var(--accent); }
.ecualizador i:nth-child(2), .ecualizador i:nth-child(4) { height: 15px; }
.ecualizador i:nth-child(3) { height: 20px; }
.boton, button:not(.enlace):not(.agregar):not(.cart-remove):not(.theme-rotator):not(.menu-toggle) {
  background: linear-gradient(145deg, #f0c497, #d69a66);
  color: #3c261a;
  border: 1px solid #f5d3ad;
  border-radius: 18px;
  box-shadow: 0 5px 0 #88542f33, 0 10px 20px #00000015, inset 0 1px 0 #fff9, inset 0 -2px 0 #9a603425;
  font-size: .86rem;
  font-weight: 800;
  min-height: 50px;
  padding: .9rem 1.4rem;
}
.boton:hover, button:not(.enlace):not(.agregar):not(.cart-remove):not(.theme-rotator):not(.menu-toggle):hover {
  background: linear-gradient(145deg, #f6d1a9, #e2a874);
  color: #3c261a;
  border-color: #f8dfbf;
  transform: translateY(-3px);
  box-shadow: 0 7px 0 #88542f22, 0 15px 25px #0002, inset 0 1px 0 #fff9;
}
.boton:active, button:not(.enlace):not(.agregar):not(.cart-remove):not(.theme-rotator):not(.menu-toggle):active { transform: translateY(2px); box-shadow: 0 1px 0 #88542f33, inset 0 2px 3px #0001; }
.hero .boton { font-size: .83rem; }
.secundario { background: var(--glass)!important; box-shadow: inset 0 1px 0 var(--bevel), 0 5px 12px var(--depth)!important; }
.texto-link { font-size: .83rem; font-weight: 750; }
.banda-valores { border: 1px solid var(--line); border-radius: 22px; padding: 1.2rem 1.4rem; background: var(--glass); box-shadow: inset 0 1px 0 var(--bevel); font-size: .75rem; }
.categoria-tile, .tarjeta, .producto, .indicador {
  background: linear-gradient(140deg, var(--glass-top), var(--glass-bottom)), var(--glass);
  border: 1px solid var(--edge);
  box-shadow: var(--shadow);
  border-radius: 24px;
  backdrop-filter: blur(18px) saturate(125%);
  -webkit-backdrop-filter: blur(18px) saturate(125%);
}
.categoria-tile { padding: 1.4rem; transition: transform .25s, box-shadow .25s; }
.categoria-tile:hover { background: var(--raised); transform: translateY(-5px); box-shadow: 0 20px 35px var(--depth), inset 0 1px 0 var(--bevel); }
.categoria-tile strong { font: 800 1.4rem/1.2 var(--sans); letter-spacing: -.03em; }
.categoria-numero { font-size: .64rem; }
.categoria-flecha { width: 32px; height: 32px; border: 1px solid var(--line); border-radius: 12px; display: grid; place-items: center; box-shadow: inset 0 1px 0 var(--bevel); }
.producto { padding: .6rem; }
.producto-imagen { border-radius: 18px; }
.producto-info { padding: 1.2rem .8rem .8rem; }
.producto-titulo h3 { font: 800 1.3rem/1.25 var(--sans); letter-spacing: -.035em; }
.producto-titulo strong { font-size: .93rem; }
.producto-info>p { font-size: .85rem; }
.producto-final small { font-size: .72rem; }
.producto-final .enlace { font-size: .78rem; }
.categoria-chip { font-size: .59rem; font-weight: 800; background: #fff7e6db; border-color: #fff9; box-shadow: 0 3px 8px #38241920, inset 0 1px 0 #fff; backdrop-filter: blur(12px); }
.agregar { border-radius: 13px; font-size: .78rem; box-shadow: inset 0 1px 0 var(--bevel), 0 4px 8px var(--depth); }
.ritual { border-radius: 30px; background: linear-gradient(140deg, var(--glass-top), transparent), var(--glass); border-color: var(--edge); box-shadow: var(--shadow); }
.ritual-numero { font: 900 clamp(6rem, 12vw, 12rem)/1 var(--sans); letter-spacing: -.1em; text-shadow: 0 2px 0 #fff2, 0 6px 2px #b5744720, 0 15px 25px #0002; }
.ritual h2 { font-size: 2.5rem; }
.ritual p:not(.etiqueta) { font-size: .9rem; }
.invitacion { padding: 2.5rem; border: 1px solid var(--edge); border-radius: 30px; background: linear-gradient(115deg, var(--glass-top), var(--glass-bottom)), var(--glass); box-shadow: var(--shadow); }
.invitacion h2 { font-size: 2.7rem; }
.invitacion p:last-child { font-size: .88rem; }
.pagina-hero h1 { text-shadow: 0 2px 0 #00000009; }
.pagina-hero p:not(.etiqueta) { font-size: .98rem; }
.filtros, .tabla-contenedor { background: var(--glass); border-radius: 20px; border-color: var(--edge); box-shadow: inset 0 1px 0 var(--bevel), 0 10px 25px var(--depth); }
.filtros { backdrop-filter: blur(18px); }
label { font-size: .84rem; font-weight: 750; }
input, select, textarea { border-radius: 14px; font-size: .92rem; box-shadow: inset 0 2px 4px #0000000d, 0 1px 0 var(--bevel); border-color: var(--line); }
input:focus, select:focus, textarea:focus { border-color: var(--accent); }
table { font-size: .87rem; }
th { font-size: .66rem; }
td small { font-size: .74rem; }
.catalogo-tabs a { font-size: .83rem; box-shadow: inset 0 1px 0 var(--bevel); }
.estado { font-size: .73rem; }
.auth-bienvenida img { border: 6px solid var(--glass); box-shadow: var(--shadow); width: 18rem; }
.sidebar { background: #221916ed; border-color: #f7e5c51f; backdrop-filter: blur(20px); }
.sidebar .logo { color: #f7e8d3; }
.sidebar nav a { font-size: .83rem; border-radius: 14px; color: #cab9a8; }
.sidebar nav a.activo { background: linear-gradient(120deg, #dba77126, #dba7710a); box-shadow: inset 0 1px 0 #ffe6c421, inset 3px 0 #edb986, 0 5px 10px #0001; }
.sidebar-perfil strong { font-size: .82rem; }
.sidebar-perfil small { font-size: .73rem; }
.indicador strong { font-family: var(--sans); font-weight: 850; }
.indicador p { font-size: .8rem; }
.indicador small { font-size: .65rem; }
.pie {
  background: linear-gradient(135deg, var(--glass-top), transparent), var(--glass);
  border-top: 1px solid var(--edge);
  border-radius: 45px 45px 0 0;
  box-shadow: 0 -20px 60px var(--depth), inset 0 1px 0 var(--bevel);
  padding-top: 3rem;
  backdrop-filter: blur(24px) saturate(120%);
  -webkit-backdrop-filter: blur(24px) saturate(120%);
}
.footer-saludo { display: flex; align-items: center; justify-content: space-between; gap: 2rem; border-bottom: 1px solid var(--line); padding-bottom: 2.5rem; margin-bottom: 2.5rem; }
.footer-saludo h2 { font-size: clamp(1.8rem, 3vw, 2.7rem); margin: .7rem 0 0; }
.boton-whatsapp { background: linear-gradient(135deg, #c8e3c4, #9dc49b); color: #24452d; border-color: #e6f7df; box-shadow: 0 5px 0 #42694125, 0 10px 20px #0001, inset 0 1px 0 #fff9; }
.boton-whatsapp:hover { background: linear-gradient(135deg, #d6edcf, #b3d5ac); color: #24452d; border-color: #e6f7df; }
.pie-grid { grid-template-columns: 1.1fr 1.3fr .8fr; }
.pie-grid .logo { font-size: 1.8rem; }
.pie p, .pie-grid>div>a:not(.logo) { font-size: .86rem; }
.pie-grid>div>a.contact-link { display: flex; align-items: center; gap: .6rem; color: var(--ink); margin-bottom: .8rem; }
.pie-grid .etiqueta { font-size: .64rem; }
.footer-firma { font-size: .6rem; color: var(--accent); letter-spacing: .14em; }
.pie-legal { font-size: .68rem; }
.footer-mapa { display: flex; align-items: center; gap: 1.5rem; padding: 1rem; border: 1px solid var(--edge); border-radius: 22px; background: var(--glass); margin-top: 2rem; text-decoration: none; box-shadow: inset 0 1px 0 var(--bevel), 0 10px 22px var(--depth); }
.mapa-dibujo { position: relative; align-self: stretch; width: 190px; min-height: 90px; border-radius: 15px; overflow: hidden; background: #809b7226; flex-shrink: 0; }
.mapa-dibujo svg { width: 100%; height: 100%; position: absolute; inset: 0; fill: none; stroke: var(--line); stroke-width: 16px; }
.mapa-pin { position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%); width: 42px; height: 42px; display: grid; place-items: center; border-radius: 50%; background: var(--accent); color: var(--base); font-size: 1.7rem; box-shadow: 0 6px 10px #0002, inset 0 1px 0 #fff7; }
.mapa-texto { display: grid; gap: .5rem; }
.mapa-texto strong { font-size: 1.1rem; }
.mapa-texto>span { font-size: .8rem; color: var(--muted); }
.mapa-abrir { margin-left: auto; padding-right: .8rem; font-size: .8rem; white-space: nowrap; }
.contacto-datos { padding: 0; }
.contacto-cristal { padding: 2rem; }
.contacto-icono { width: 52px; height: 52px; display: grid; place-items: center; font-size: 2rem; background: var(--raised); color: var(--accent); border-radius: 18px; box-shadow: inset 0 1px 0 var(--bevel), 0 5px 10px var(--depth); margin-bottom: 1.8rem; }
.contacto-cristal h2 { font-size: 2.1rem; }
.contacto-cristal>p { font-size: .95rem; color: var(--muted); }
.contacto-cristal .acciones { margin-top: 1.5rem; gap: 1rem; }
.mapa-embed { margin-top: 1.5rem; border: 1px solid var(--edge); border-radius: 24px; overflow: hidden; box-shadow: var(--shadow); background: var(--glass); }
.mapa-embed iframe { width: 100%; height: 290px; display: block; border: 0; }
.mapa-embed>a { display: block; padding: 1rem 1.2rem; text-decoration: none; font-size: .83rem; }
.whatsapp-flotante { position: fixed; z-index: 30; right: 1.5rem; bottom: 1.5rem; display: flex; align-items: center; gap: .6rem; padding: .85rem 1.15rem; color: #eaffdf; background: linear-gradient(145deg, #456b47, #2e5038); border: 1px solid #bbd8aa66; border-radius: 24px; box-shadow: 0 5px 0 #102d2122, 0 12px 25px #0003, inset 0 1px 0 #e7ffd85c; text-decoration: none; font-size: .8rem; font-weight: 800; }
.whatsapp-flotante:hover { color: white; transform: translateY(-3px); }
@supports not (backdrop-filter: blur(1px)) {
  .cabecera, .producto, .tarjeta, .categoria-tile, .indicador, .pie, .filtros { background: var(--surface); }
  .foto-caption { background: #302017e8; }
}
@media (max-width: 1200px) {
  .hero { gap: 3rem; }
  .cabecera nav a, .cabecera nav .enlace { font-size: .72rem; }
}
@media (max-width: 960px) {
  .cabecera nav { left: 0; right: 0; top: calc(100% + 10px); border: 1px solid var(--edge); border-radius: 20px; background: var(--surface); box-shadow: var(--shadow); }
  .cabecera nav a, .cabecera nav .enlace { font-size: .9rem; }
  .hero h1 { font-size: 3.6rem; }
  .hero { gap: 2.5rem; }
  .footer-saludo h2 { font-size: 2rem; }
  .pie-grid { gap: 1.5rem; }
  .foto-caption strong { font-size: 1.3rem; }
  .mapa-dibujo { width: 120px; }
}
@media (max-width: 700px) {
  .cabecera { border-radius: 22px; padding: .9rem 1rem; }
  .marca-logo, .logo-imagen { width: 43px; height: 43px; border-radius: 14px; }
  .marca-texto { font-size: 1.55rem; }
  .marca-subtitulo { font-size: .45rem; }
  .hero { padding-block: 2.5rem 3rem; gap: 2.5rem; }
  .hero h1 { font-size: clamp(3rem, 10vw, 4.5rem); }
  .hero h1 em { white-space: normal; }
  .entradilla { font-size: .95rem; }
  .hero .boton { font-size: .82rem; }
  .hero-visual { width: calc(100% - 1rem); }
  .foto-marco { border-radius: 28px; aspect-ratio: 4 / 3.9; }
  .foto-caption { border-radius: 18px; padding: 1rem; }
  .foto-caption strong { font-size: 1.5rem; }
  .foto-indice { top: 1rem; left: 1rem; }
  .sello { left: -1.3rem; top: -1.2rem; width: 5.3rem; height: 5.3rem; font-size: .5rem; }
  .banda-valores { font-size: .67rem; padding: 1rem; }
  .hero-firma { margin-top: 1.5rem; padding: .9rem; }
  .hero-firma p { font-size: .72rem; }
  .categoria-tile { padding: 1.2rem; }
  .categoria-tile strong { font-size: 1.25rem; }
  .titulo-seccion h2 { font-size: 2rem; }
  .ritual { padding: 1.6rem; }
  .ritual h2 { font-size: 2rem; }
  .ritual-numero { font-size: 6rem; }
  .invitacion { padding: 1.7rem; }
  .invitacion h2 { font-size: 2.3rem; }
  .footer-saludo { flex-direction: column; align-items: start; gap: 1.5rem; }
  .pie { border-radius: 30px 30px 0 0; padding-top: 2rem; }
  .pie-grid { grid-template-columns: 1fr 1fr; }
  .footer-mapa { flex-wrap: wrap; gap: 1rem; }
  .mapa-dibujo { width: 90px; min-height: 80px; }
  .mapa-texto { flex: 1; }
  .mapa-texto strong { font-size: .95rem; }
  .mapa-abrir { width: 100%; margin: 0; padding: 0 .3rem .3rem; }
  .whatsapp-flotante { right: 1rem; bottom: 1rem; padding: .8rem; border-radius: 20px; }
  .whatsapp-flotante span { display: none; }
  .contacto-cristal { padding: 1.5rem; }
  .contacto-cristal h2 { font-size: 2rem; }
  .sidebar .marca-logo { width: 38px; height: 38px; }
}
@media (max-width: 400px) {
  .marca-texto { font-size: 1.35rem; }
  .marca-logo { width: 39px; height: 39px; }
  .cabecera { padding-inline: .8rem; }
  .hero h1 { font-size: 3rem; }
  .hero .acciones { gap: 1rem; }
  .hero .texto-link { font-size: .78rem; }
  .categoria-tile strong { font-size: 1.1rem; }
  .foto-caption strong { font-size: 1.25rem; }
  .pie-grid { grid-template-columns: 1fr; }
}
@media (prefers-reduced-motion: reduce) {
  .foto-marco { transform: none; }
  .whatsapp-flotante:hover, .categoria-tile:hover { transform: none; }
}

```

## 65. public/css/accesibilidad.css
```css
/* Superficies de lectura sólidas y contraste comprobable en el tema claro. */
:root[data-theme=light] {
  --base: #f4ecdf;
  --surface: #fffaf2;
  --raised: #eaddcb;
  --ink: #3b281f;
  --muted: #645143;
  --accent: #81431e;
  --line: #79533a50;
  --input: #fffdf8;
  --glass: rgba(255, 250, 241, .93);
  --glass-top: rgba(255, 255, 255, .82);
  --glass-bottom: rgba(255, 255, 255, .16);
  --edge: #ddcbb6;
  --contact: #245132;
}
:root[data-theme=light] .cabecera nav a,
:root[data-theme=light] .cabecera nav .enlace,
:root[data-theme=light] .pie-grid>div>a:not(.logo),
:root[data-theme=light] .producto-final small,
:root[data-theme=light] .pie-legal,
:root[data-theme=light] .catalogo-nota { color: #645143; }
:root[data-theme=light] .cabecera nav a[aria-current=page],
:root[data-theme=light] .producto-final .enlace { color: #3b281f; }
:root[data-theme=light] .etiqueta,
:root[data-theme=light] .producto-titulo strong,
:root[data-theme=light] .categoria-numero,
:root[data-theme=light] .footer-firma { color: #81431e; }
:root[data-theme=light] .foto-caption { color: #fff3e0; background: #38251ee6; border-color: #e6ccb5; }
:root[data-theme=light] .foto-caption span,
:root[data-theme=light] .foto-caption strong { color: #fff3e0; }
:root[data-theme=light] .sidebar { color: #faefdc; background: #221916; }
:root[data-theme=light] .sidebar .logo,
:root[data-theme=light] .sidebar .marca-texto,
:root[data-theme=light] .sidebar .marca-subtitulo,
:root[data-theme=light] .sidebar .sidebar-perfil strong { color: #faefdc; }
:root[data-theme=light] .sidebar nav a,
:root[data-theme=light] .sidebar-perfil small { color: #d9c9b8; }
:root[data-theme=light] .sidebar .etiqueta { color: #edb986; }
:root[data-theme=light] .sidebar nav a.activo { color: #fff4df; }
:root[data-theme=light] input::placeholder,
:root[data-theme=light] textarea::placeholder { color: #78604f; opacity: 1; }
:root[data-theme=light] .boton.secundario { color: #3b281f!important; }
:root[data-theme=light] .sidebar .secundario { color: #faefdc!important; background: #3b2c25!important; }
:root[data-theme=light] .agregar { background: #eaddcb; color: #3b281f; border-color: #ad8c70; }
:root[data-theme=light] .agregar:hover { background: #3b281f; color: #fff4df; }
:root[data-theme=light] .estado { opacity: 1; }
:root[data-theme=light] .hero h1 { text-shadow: 0 1px 0 #fff9, 0 3px 8px #64382112; }
label, .producto-info>p, .muted { line-height: 1.7; }
.catalogo-meta, .catalogo-nota { font-size: .82rem; }
:focus-visible { outline-width: 3px; }
@media (prefers-contrast:more) {
  .tarjeta,.producto,.indicador,.cabecera,.pie { backdrop-filter:none; background:var(--surface); }
  .sidebar { background:#221916; }
  .muted { color:var(--ink); }
}

```

## 66. public/css/musica.css
```css
.musica-actual{display:flex;gap:1.5rem;align-items:center}.musica-actual>div{flex:1}.musica-actual .etiqueta{margin-bottom:.5rem}.musica-actual strong{font-size:1.2rem}.musica-actual p:last-child{margin:0;color:var(--muted);font-size:.9rem}.musica-actual .ecualizador{width:45px;height:45px;justify-content:center;border-radius:16px;background:var(--raised);box-shadow:inset 0 1px 0 var(--bevel),0 6px 15px var(--depth)}.musica-lista{padding-left:1.4rem;margin:1rem 0}.musica-lista li{padding:.7rem .3rem;border-bottom:1px solid var(--line);font-size:.9rem}.musica-lista strong{display:block;font-weight:800}.musica-lista span{font-size:.8rem;color:var(--muted)}.musica-pasos{padding-left:1.4rem;line-height:1.8}.musica-pasos li{padding-bottom:.8rem}.mensajes-grid article form{margin-top:1rem}.reproductor{max-width:900px;margin-inline:auto;text-align:center;padding:2.5rem}.disco-musical{width:120px;height:120px;border-radius:50%;background:repeating-radial-gradient(#2a211f 0px,#3b3029 2px,#221916 4px,#392c26 6px);border:7px solid var(--raised);display:grid;place-items:center;margin:0 auto 2rem;box-shadow:0 15px 25px var(--depth),inset 0 1px 0 var(--bevel)}.disco-musical span{width:48px;height:48px;display:grid;place-items:center;border-radius:50%;background:#d2a575;color:#39271e;font-size:1.8rem}.controles-musica{justify-content:center;margin:1.5rem 0}.reproductor audio{width:100%;margin:1rem 0}.reproductor .musica-lista{text-align:left}.reproductor h2{font-size:2rem}#youtube-contenedor{margin:1rem auto;width:min(100%,640px);min-width:200px;min-height:300px;border-radius:18px;overflow:hidden;background:#000}#youtube-local,#youtube-contenedor iframe{width:100%;min-height:300px;border:0;display:block}.reproductor .aviso{font-size:.9rem}.musica-enlace{margin-top:1rem}@media(max-width:700px){.musica-actual{flex-wrap:wrap;gap:1rem}.musica-actual>.estado{margin-left:3.5rem}.reproductor{padding:1.3rem}.controles-musica{gap:.7rem}.controles-musica button{width:100%}.musica-actual strong{font-size:1rem}.reproductor h2{font-size:1.6rem}}

```

## 67. public/js/tema.js
```javascript
'use strict';
(() => {
  let theme = 'dark';
  try { const saved = localStorage.getItem('cafebar-theme'); if (saved === 'light' || saved === 'dark') theme = saved; } catch {}
  document.documentElement.dataset.theme = theme;
})();

```

## 68. public/js/app.js
```javascript
'use strict';
(() => {
  const buttons = document.querySelectorAll('.theme-rotator');
  function applyTheme(theme) {
    document.documentElement.dataset.theme = theme;
    try { localStorage.setItem('cafebar-theme', theme); } catch {}
    buttons.forEach(button => {
      const next = theme === 'dark' ? 'Activar tema claro' : 'Activar tema oscuro';
      button.setAttribute('aria-label', next);
      button.setAttribute('title', next);
      button.setAttribute('aria-pressed', String(theme === 'light'));
    });
  }
  applyTheme(document.documentElement.dataset.theme === 'light' ? 'light' : 'dark');
  buttons.forEach(button => button.addEventListener('click', () => applyTheme(document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark')));
  const menu = document.querySelector('.menu-toggle');
  const nav = document.querySelector('#navegacion');
  if (menu && nav) {
    const close = () => { menu.setAttribute('aria-expanded','false'); nav.classList.remove('abierto'); };
    menu.addEventListener('click', () => { const open = menu.getAttribute('aria-expanded') !== 'true'; menu.setAttribute('aria-expanded',String(open)); nav.classList.toggle('abierto',open); });
    document.addEventListener('keydown', event => { if (event.key === 'Escape' && menu.getAttribute('aria-expanded') === 'true') { close(); menu.focus(); } });
    document.addEventListener('click', event => { if (!event.target.closest('.cabecera')) close(); });
    window.matchMedia('(max-width:960px)').addEventListener('change',close);
  }
  document.querySelectorAll('.sidebar nav a, #navegacion a').forEach(a => {
    if (new URL(a.href).pathname === location.pathname) { a.classList.add('activo'); a.setAttribute('aria-current','page'); }
  });
})();
document.querySelectorAll('form').forEach(form => {
  form.addEventListener('submit', event => {
    form.querySelectorAll('input[type="password"]').forEach(input => input.setCustomValidity(new TextEncoder().encode(input.value).length > 72 ? 'La contraseña no puede superar 72 bytes.' : ''));
    const first = form.querySelector('[name="nueva_clave"], [name="clave"][minlength]');
    const second = form.querySelector('[name="confirmacion"]');
    if (first && second) second.setCustomValidity(first.value !== second.value ? 'Las contraseñas no coinciden.' : '');
    const file = form.querySelector('input[type="file"]');
    if (file) {
      const maximum = file.name === 'audio' ? 20971520 : 4194304;
      file.setCustomValidity(!file.disabled && file.files[0] && file.files[0].size > maximum ? (file.name === 'audio' ? 'El audio debe pesar como máximo 20 MB.' : 'La imagen debe pesar como máximo 4 MB.') : '');
    }
    if (!form.checkValidity()) { event.preventDefault(); form.reportValidity(); return; }
    if (form.dataset.confirm && !confirm(form.dataset.confirm)) event.preventDefault();
  });
  form.addEventListener('input', () => form.querySelectorAll('input').forEach(input => input.setCustomValidity('')));
});
const search = document.querySelector('#catalog-search');
const category = document.querySelector('#catalog-category');
const catalogStatus = document.querySelector('#catalog-status');
if (search && category) {
  search.addEventListener('input', () => {
    const query = search.value.trim().toLocaleLowerCase('es'); let visible = 0;
    document.querySelectorAll('[data-product-card]').forEach(card => { card.hidden = !card.dataset.name.includes(query); if (!card.hidden) visible++; });
    if (catalogStatus) catalogStatus.textContent = visible ? `${visible} opciones visibles. Pulsa Buscar para consultar toda la carta.` : 'Sin coincidencias en esta selección. Pulsa Buscar o restablece los filtros.';
  });
  category.addEventListener('change', () => category.form.requestSubmit());
}
const stats = document.querySelector('[data-stats-url]');
if (stats) {
  const status = document.querySelector('#stats-status');
  async function updateStats() {
    const controller = new AbortController(); const timeout = setTimeout(() => controller.abort(),8000);
    try {
      const response = await fetch(stats.dataset.statsUrl,{signal:controller.signal,cache:'no-store'});
      if (!response.ok || !response.headers.get('content-type')?.includes('application/json')) throw new Error('Sin conexión');
      const data = await response.json();
      Object.entries(data).forEach(([key,value]) => { const output = stats.querySelector('[data-stat="'+key+'"]'); if (output) output.textContent = String(value); });
      status.textContent = 'Actualizado a las '+new Date().toLocaleTimeString('es-BO');
    } catch { status.textContent = 'Sin actualización. Los indicadores visibles pueden estar desactualizados.'; }
    finally { clearTimeout(timeout); setTimeout(updateStats,10000); }
  }
  setTimeout(updateStats,10000);
}

```

## 69. public/js/carrito.js
```javascript
'use strict';
(() => {
  const key = document.body.dataset.cartKey;
  if (!key) return;
  let cart = {};
  try {
    const saved = JSON.parse(localStorage.getItem(key) || '{}');
    if (saved && typeof saved === 'object' && !Array.isArray(saved)) {
      Object.entries(saved).slice(0,50).forEach(([id,item]) => {
        if (/^[1-9]\d{0,9}$/.test(id) && item && typeof item.name === 'string' && item.name.length <= 120 && Number.isSafeInteger(item.price) && item.price > 0 && item.price <= 99999999 && Number.isInteger(item.quantity) && item.quantity > 0 && item.quantity <= 99) {
          cart[id] = {name:item.name,price:item.price,quantity:item.quantity};
        }
      });
    }
  } catch { cart = {}; }
  if (document.body.dataset.clearCart === '1') cart = {};
  const money = cents => 'Bs. ' + (cents / 100).toLocaleString('es-BO', {minimumFractionDigits:2,maximumFractionDigits:2});
  const make = (tag,text) => {const element=document.createElement(tag);if(text !== undefined)element.textContent=text;return element;};
  let toastTimer;
  function toast(text) {
    const output=document.querySelector('#toast');if(!output)return;
    output.textContent=text;output.hidden=false;clearTimeout(toastTimer);toastTimer=setTimeout(()=>output.hidden=true,3000);
  }
  function save() {
    try {localStorage.setItem(key,JSON.stringify(cart));} catch {toast('Tu navegador no permite guardar el carrito. Mantén esta página abierta.');}
    document.querySelectorAll('[data-cart-count]').forEach(el=>el.textContent=String(Object.values(cart).reduce((n,p)=>n+p.quantity,0)));
  }
  function render() {
    save();
    const target=document.querySelector('#cart-lines');if(!target)return;
    target.replaceChildren();let total=0;
    Object.entries(cart).forEach(([id,p])=>{
      total+=p.price*p.quantity;
      const row=make('tr');const quantityCell=make('td');const input=make('input');
      input.type='number';input.min='1';input.max='99';input.step='1';input.value=String(p.quantity);input.className='cart-quantity';input.setAttribute('aria-label','Cantidad de '+p.name);
      input.addEventListener('change',()=>{const n=Number(input.value);if(!Number.isInteger(n)||n<1||n>99){input.value=String(p.quantity);toast('La cantidad debe estar entre 1 y 99.');return;}cart[id].quantity=n;render();});
      quantityCell.append(input);
      const action=make('td');const remove=make('button','Quitar');remove.type='button';remove.className='cart-remove';remove.setAttribute('aria-label','Quitar '+p.name);
      remove.addEventListener('click',()=>{delete cart[id];render();});action.append(remove);
      row.append(make('td',p.name),make('td',money(p.price)),quantityCell,make('td',money(p.price*p.quantity)),action);target.append(row);
    });
    const empty=Object.keys(cart).length===0;
    document.querySelector('#cart-empty').hidden=!empty;
    document.querySelector('#checkout-button').disabled=empty;
    document.querySelector('#cart-total').textContent=money(total);
    document.querySelector('#cart-items').value=JSON.stringify(Object.fromEntries(Object.entries(cart).map(([id,p])=>[id,p.quantity])));
  }
  document.querySelectorAll('[data-add]').forEach(button=>button.addEventListener('click',()=>{
    const id=button.dataset.id;const stock=Number(button.dataset.stock);const quantity=(cart[id]?.quantity||0)+1;
    if(quantity>Math.min(stock,99)){toast('Alcanzaste el stock disponible o el máximo por producto.');return;}
    if(!cart[id]&&Object.keys(cart).length>=50){toast('Puedes agregar hasta 50 productos diferentes.');return;}
    cart[id]={name:button.dataset.name,price:Math.round(Number(button.dataset.price)*100),quantity};render();toast('Agregado: '+button.dataset.name);
  }));
  const checkout=document.querySelector('#checkout');
  if(checkout)checkout.addEventListener('submit',event=>{
    render();if(!Object.keys(cart).length){event.preventDefault();toast('Agrega productos antes de confirmar.');}
  });
  window.addEventListener('storage',event=>{if(event.key===key)location.reload();});
  render();
})();

```

## 70. public/js/musica.js
```javascript
'use strict';
(() => {
  const source = document.querySelector('#musica-fuente');
  if (source) {
    const update = () => document.querySelectorAll('[data-fuente]').forEach(group => { group.hidden = group.dataset.fuente !== source.value; group.querySelectorAll('input').forEach(input => input.disabled = group.hidden); });
    source.addEventListener('change',update);update();
  }
  const panel = document.querySelector('[data-musica-estado]');
  if (!panel) return;
  async function refresh() {
    const controller = new AbortController();const timeout=setTimeout(()=>controller.abort(),8000);
    try {
      const response=await fetch(panel.dataset.musicaEstado,{cache:'no-store',signal:controller.signal});
      if(!response.ok||!response.headers.get('content-type')?.includes('application/json'))throw new Error('Sesión o conexión no disponible');
      const data=await response.json();
      const title=document.querySelector('#musica-actual-titulo');const artist=document.querySelector('#musica-actual-artista');
      if(title)title.textContent=data.actual?.titulo||'El local aún no ha iniciado el reproductor';
      if(artist)artist.textContent=data.actual?.artista||'Mientras tanto, deja tu sugerencia.';
      const list=document.querySelector('#musica-cola');list.replaceChildren();
      data.cola.forEach(track=>{const li=document.createElement('li');const name=document.createElement('strong');const by=document.createElement('span');name.textContent=track.titulo;by.textContent=track.artista;li.append(name,by);list.append(li);});
      document.querySelector('#musica-cola-vacia').hidden=data.cola.length>0;
      document.querySelector('#musica-estado-conexion').textContent='Actualizado: '+new Date().toLocaleTimeString('es-BO');
    }catch{document.querySelector('#musica-estado-conexion').textContent='Sin actualización. Revisa tu conexión o inicia sesión nuevamente.';}
    finally{clearTimeout(timeout);setTimeout(refresh,10000);}
  }
  refresh();
})();

```

## 71. public/js/reproductor.js
```javascript
'use strict';
(() => {
  const root=document.querySelector('#reproductor-local');if(!root)return;
  const audio=document.querySelector('#audio-local'),start=document.querySelector('#musica-iniciar'),skip=document.querySelector('#musica-siguiente'),stop=document.querySelector('#musica-detener'),message=document.querySelector('#reproductor-mensaje');
  const bytes=crypto.getRandomValues(new Uint8Array(32));const device=Array.from(bytes,b=>b.toString(16).padStart(2,'0')).join('');
  let track=null,running=false,busy=false,youtube=null,youtubePromise=null,heartbeat=null,waiting=null,failures=0,failedId=null;
  function say(text){message.textContent=text;}
  async function api(action,extra={}){
    const controller=new AbortController();const timeout=setTimeout(()=>controller.abort(),10000);
    try{
      const body=new URLSearchParams({accion:action,dispositivo:device,csrf:document.querySelector('meta[name="csrf-token"]').content,...extra});
      const response=await fetch(root.dataset.control,{method:'POST',body,signal:controller.signal,headers:{Accept:'application/json'}});
      if(!response.headers.get('content-type')?.includes('application/json'))throw new Error('La sesión terminó. Vuelve a iniciar sesión.');
      const data=await response.json();if(!response.ok)throw new Error(data.error||'No se pudo sincronizar la música.');return data;
    }finally{clearTimeout(timeout);}
  }
  function pauseMedia(){audio.pause();if(youtube?.pauseVideo)youtube.pauseVideo();}
  function ensureYoutube(){
    if(youtubePromise)return youtubePromise;
    youtubePromise=new Promise((resolve,reject)=>{
      const timeout=setTimeout(()=>reject(new Error('YouTube no respondió. Revisa la conexión o usa audio local.')),15000);
      window.onYouTubeIframeAPIReady=()=>{
        youtube=new YT.Player('youtube-local',{host:'https://www.youtube.com',width:'100%',height:'300',playerVars:{playsinline:1,origin:location.origin},events:{
          onReady:()=>{clearTimeout(timeout);resolve(youtube);},
          onStateChange:event=>{if(!running||track?.fuente!=='youtube')return;if(event.data===1){failures=0;say('Reproducción en curso. La siguiente canción se cargará automáticamente.');}if(event.data===0)advance('reproducida');},
          onAutoplayBlocked:()=>say('Pulsa Reproducir / reanudar o el botón de reproducción del video para habilitar el sonido.'),
          onError:()=>{if(running&&track?.fuente==='youtube')mediaError('YouTube no permite reproducir esta canción.');}
        }});
      };
      const script=document.createElement('script');script.src='https://www.youtube.com/iframe_api';script.async=true;script.onerror=()=>{clearTimeout(timeout);reject(new Error('No se pudo cargar YouTube.'));};document.head.append(script);
    });return youtubePromise;
  }
  async function loadTrack(next){
    if(!running)return;
    pauseMedia();track=next;
    document.querySelector('#pista-titulo').textContent=next?.titulo||'El catálogo está vacío.';
    document.querySelector('#pista-artista').textContent=next?.artista||'Añade canciones y se reproducirán automáticamente.';
    skip.disabled=!next;start.textContent=next?'Reproducir / reanudar ▶':'Buscar canciones ▶';
    audio.hidden=!next||next.fuente!=='archivo';document.querySelector('#youtube-contenedor').hidden=!next||next.fuente!=='youtube';
    if(!next){say('Sin canciones activas. El reproductor volverá a consultar en diez segundos.');waiting=setTimeout(()=>advance(),10000);return;}
    if(next.fuente==='archivo'){
      audio.src=next.url;audio.load();
      try{await audio.play();failures=0;say('Reproducción en curso. La siguiente canción se cargará automáticamente.');}
      catch(error){if(error.name==='NotAllowedError')say('Pulsa Reproducir / reanudar o el botón del audio para habilitar el sonido.');else mediaError('El audio no pudo reproducirse.');}
    }else{
      const player=await ensureYoutube();if(!running)return;player.loadVideoById(next.recurso);say('Cargando YouTube. Si no comienza, pulsa el botón del video.');
    }
  }
  async function advance(result){
    if(!running||busy)return;busy=true;clearTimeout(waiting);
    try{
      pauseMedia();const extra=track&&result?{finalizada:String(track.id),resultado:result}:{};
      const data=await api('siguiente',extra);if(running)await loadTrack(data.pista);
    }catch(error){running=false;clearInterval(heartbeat);pauseMedia();say(error.message||'Sin conexión. Pulsa Iniciar música para volver a intentarlo.');start.textContent='Iniciar música ▶';skip.disabled=true;}
    finally{busy=false;}
  }
  function mediaError(text){
    if(!track||failedId===track.id)return;failedId=track.id;
    failures++;say(text);
    if(failures>=3){halt();say('Tres pistas no pudieron reproducirse. Revisa los enlaces o audios antes de reiniciar.');return;}
    setTimeout(()=>advance('omitida'),300);
  }
  async function halt(){running=false;clearTimeout(waiting);clearInterval(heartbeat);pauseMedia();start.textContent='Iniciar música ▶';skip.disabled=true;stop.disabled=true;say('Música detenida. Puedes volver a iniciarla desde este equipo.');try{await api('liberar');}catch{}}
  start.addEventListener('click',async()=>{
    if(busy)return;
    if(running&&track){if(track.fuente==='archivo'){try{await audio.play();say('Reproducción en curso.');}catch{say('Usa el botón del audio para iniciar la reproducción.');}}else if(youtube)youtube.playVideo();return;}
    running=true;failures=0;stop.disabled=false;await advance();
    if(running){clearInterval(heartbeat);heartbeat=setInterval(async()=>{try{const result=await api('latido');if(!result.ok)throw new Error('Otro equipo tomó el control del reproductor.');}catch(error){running=false;pauseMedia();clearInterval(heartbeat);say(error.message||'Sin conexión. La música se ha pausado.');start.textContent='Iniciar música ▶';}},12000);}
  });
  skip.addEventListener('click',()=>advance('omitida'));stop.addEventListener('click',halt);
  audio.addEventListener('ended',()=>{if(running&&track?.fuente==='archivo')advance('reproducida');});
  audio.addEventListener('error',()=>{if(running&&track?.fuente==='archivo')mediaError('El archivo de audio no está disponible.');});
  window.addEventListener('pagehide',()=>{pauseMedia();if(running){const body=new URLSearchParams({accion:'liberar',dispositivo:device,csrf:document.querySelector('meta[name="csrf-token"]').content});navigator.sendBeacon(root.dataset.control,body);}});
})();

```

## 72. public/fonts/OFL-Nunito.txt
```text
Copyright 2014 The Nunito Project Authors (https://github.com/googlefonts/nunito)

This Font Software is licensed under the SIL Open Font License, Version 1.1.
This license is copied below, and is also available with a FAQ at:
http://scripts.sil.org/OFL


-----------------------------------------------------------
SIL OPEN FONT LICENSE Version 1.1 - 26 February 2007
-----------------------------------------------------------

PREAMBLE
The goals of the Open Font License (OFL) are to stimulate worldwide
development of collaborative font projects, to support the font creation
efforts of academic and linguistic communities, and to provide a free and
open framework in which fonts may be shared and improved in partnership
with others.

The OFL allows the licensed fonts to be used, studied, modified and
redistributed freely as long as they are not sold by themselves. The
fonts, including any derivative works, can be bundled, embedded, 
redistributed and/or sold with any software provided that any reserved
names are not used by derivative works. The fonts and derivatives,
however, cannot be released under any other type of license. The
requirement for fonts to remain under this license does not apply
to any document created using the fonts or their derivatives.

DEFINITIONS
"Font Software" refers to the set of files released by the Copyright
Holder(s) under this license and clearly marked as such. This may
include source files, build scripts and documentation.

"Reserved Font Name" refers to any names specified as such after the
copyright statement(s).

"Original Version" refers to the collection of Font Software components as
distributed by the Copyright Holder(s).

"Modified Version" refers to any derivative made by adding to, deleting,
or substituting -- in part or in whole -- any of the components of the
Original Version, by changing formats or by porting the Font Software to a
new environment.

"Author" refers to any designer, engineer, programmer, technical
writer or other person who contributed to the Font Software.

PERMISSION & CONDITIONS
Permission is hereby granted, free of charge, to any person obtaining
a copy of the Font Software, to use, study, copy, merge, embed, modify,
redistribute, and sell modified and unmodified copies of the Font
Software, subject to the following conditions:

1) Neither the Font Software nor any of its individual components,
in Original or Modified Versions, may be sold by itself.

2) Original or Modified Versions of the Font Software may be bundled,
redistributed and/or sold with any software, provided that each copy
contains the above copyright notice and this license. These can be
included either as stand-alone text files, human-readable headers or
in the appropriate machine-readable metadata fields within text or
binary files as long as those fields can be easily viewed by the user.

3) No Modified Version of the Font Software may use the Reserved Font
Name(s) unless explicit written permission is granted by the corresponding
Copyright Holder. This restriction only applies to the primary font name as
presented to the users.

4) The name(s) of the Copyright Holder(s) or the Author(s) of the Font
Software shall not be used to promote, endorse or advertise any
Modified Version, except to acknowledge the contribution(s) of the
Copyright Holder(s) and the Author(s) or with their explicit written
permission.

5) The Font Software, modified or unmodified, in part or in whole,
must be distributed entirely under this license, and must not be
distributed under any other license. The requirement for fonts to
remain under this license does not apply to any document created
using the Font Software.

TERMINATION
This license becomes null and void if any of the above conditions are
not met.

DISCLAIMER
THE FONT SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO ANY WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT
OF COPYRIGHT, PATENT, TRADEMARK, OR OTHER RIGHT. IN NO EVENT SHALL THE
COPYRIGHT HOLDER BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
INCLUDING ANY GENERAL, SPECIAL, INDIRECT, INCIDENTAL, OR CONSEQUENTIAL
DAMAGES, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF THE USE OR INABILITY TO USE THE FONT SOFTWARE OR FROM
OTHER DEALINGS IN THE FONT SOFTWARE.

```

## 73. public/images/cafe.svg
```xml
<svg xmlns="http://www.w3.org/2000/svg" width="600" height="450" viewBox="0 0 600 450"><defs><radialGradient id="b"><stop stop-color="#f4e8d5"/><stop offset="1" stop-color="#d3b78c"/></radialGradient><linearGradient id="c" x2=".7" y2="1"><stop stop-color="#fffdf5"/><stop offset="1" stop-color="#ddc9a8"/></linearGradient><filter id="s"><feGaussianBlur stdDeviation="12"/></filter></defs><path fill="url(#b)" d="M0 0h600v450H0z"/><ellipse cx="305" cy="340" rx="154" ry="25" fill="#6e4936" opacity=".2" filter="url(#s)"/><ellipse cx="294" cy="325" rx="151" ry="44" fill="#f7eedb"/><ellipse cx="294" cy="321" rx="123" ry="30" fill="#e7d8bd"/><path d="M390 202c98-30 101 101 3 91" fill="none" stroke="#f7eedb" stroke-width="25"/><path d="M187 184h216l-15 108q-4 45-90 45t-96-45z" fill="url(#c)"/><ellipse cx="295" cy="184" rx="108" ry="42" fill="#fff9e9"/><ellipse cx="295" cy="187" rx="95" ry="33" fill="#885133"/><ellipse cx="295" cy="188" rx="86" ry="27" fill="#bd8954"/><path d="M295 205c-48-23-38-47-13-29 8-31 54-18 13 29" fill="#f5e2b9"/><path d="M270 126c-31-31 28-38 3-66m45 68c-25-32 22-37 3-64" fill="none" stroke="#fff9ec" stroke-width="7" stroke-linecap="round" opacity=".65"/><g fill="#674531" transform="rotate(-20 100 350)"><ellipse cx="92" cy="354" rx="15" ry="10"/><ellipse cx="120" cy="376" rx="14" ry="9"/></g><g stroke="#b08b67" stroke-width="2"><path d="m82 360 21-11m8 32 20-11"/></g><text x="300" y="413" text-anchor="middle" fill="#74543d" font-family="Georgia,serif" font-size="15" letter-spacing="5">CAFEBAR · CAFÉ DE LA CASA</text></svg>

```

## 74. public/images/jugo.svg
```xml
<svg xmlns="http://www.w3.org/2000/svg" width="600" height="450" viewBox="0 0 600 450"><defs><linearGradient id="b" x2="1" y2="1"><stop stop-color="#f5ead6"/><stop offset="1" stop-color="#e6c691"/></linearGradient><linearGradient id="j" x2=".5" y2="1"><stop stop-color="#edba48"/><stop offset="1" stop-color="#df802c"/></linearGradient></defs><path fill="url(#b)" d="M0 0h600v450H0z"/><ellipse cx="300" cy="349" rx="120" ry="20" fill="#c49658" opacity=".2"/><path d="m240 126 15 214q45 24 90 0l15-214z" fill="#fff9e8" opacity=".7"/><path d="m246 156 13 177q41 20 82 0l13-177z" fill="url(#j)"/><ellipse cx="300" cy="155" rx="54" ry="13" fill="#ffcc64"/><path d="m310 266 18-182 45-24" fill="none" stroke="#7c946b" stroke-width="8"/><path d="m266 177 10 135" stroke="#ffe2a4" stroke-width="6" opacity=".7"/><circle cx="366" cy="147" r="36" fill="#e79729"/><circle cx="366" cy="147" r="30" fill="#ffdc8d"/><g stroke="#f1a64a" stroke-width="2"><path d="m366 117v60m-30-30h60m-51-21 42 42m0-42-42 42"/></g><ellipse cx="208" cy="327" rx="39" ry="33" fill="#e99c32"/><path d="M200 295q20-42 43-19-12 25-43 19" fill="#657c49"/><text x="300" y="413" text-anchor="middle" fill="#85613f" font-family="Georgia,serif" font-size="15" letter-spacing="5">CAFEBAR · FRESCURA NATURAL</text></svg>

```

## 75. public/images/postre.svg
```xml
<svg xmlns="http://www.w3.org/2000/svg" width="600" height="450" viewBox="0 0 600 450"><defs><linearGradient id="b" x2="1" y2="1"><stop stop-color="#eee1d1"/><stop offset="1" stop-color="#ccb19c"/></linearGradient></defs><path fill="url(#b)" d="M0 0h600v450H0z"/><ellipse cx="300" cy="333" rx="158" ry="43" fill="#fff7e7"/><ellipse cx="300" cy="333" rx="124" ry="28" fill="#e4d3be"/><path d="m207 245 152-41 46 97-198 12z" fill="#5e3627"/><path d="m207 262 159-42 8 17-167 45z" fill="#b68a66"/><path d="m207 292 174-44 8 17-182 45z" fill="#b68a66"/><path d="m207 240 113-90 85 111-198 38z" fill="#784b35"/><path d="m207 240 113-90 85 61-198 52z" fill="#4e3025"/><path d="m209 241 3 31 18-10 8 13 10-20 24 3 14-22 35 5 11-22 18 9 20-20" fill="#4e3025"/><circle cx="320" cy="155" r="16" fill="#a8403b"/><path d="M318 141q-2-24 21-28" fill="none" stroke="#5c6d3b" stroke-width="4"/><circle cx="347" cy="182" r="10" fill="#b94b42"/><text x="300" y="413" text-anchor="middle" fill="#745342" font-family="Georgia,serif" font-size="15" letter-spacing="5">CAFEBAR · UN DULCE MOMENTO</text></svg>

```

## 76. public/images/sandwich.svg
```xml
<svg xmlns="http://www.w3.org/2000/svg" width="600" height="450" viewBox="0 0 600 450"><defs><linearGradient id="b" x2="1" y2="1"><stop stop-color="#ece8d9"/><stop offset="1" stop-color="#cbbd9c"/></linearGradient></defs><path fill="url(#b)" d="M0 0h600v450H0z"/><ellipse cx="300" cy="325" rx="162" ry="43" fill="#fff9e9"/><path d="m183 273 193-59 54 76-205 41z" fill="#bf874a"/><path d="m184 259 190-54 51 64-205 47z" fill="#89a259"/><path d="m187 249 183-52 51 61-204 47z" fill="#ce6645"/><path d="m182 237 186-54 52 59-204 47z" fill="#f4d782"/><path d="m182 226 179-52 53 57-201 49z" fill="#e7c39a"/><path d="m178 214 161-89 80 91-204 48z" fill="#dca75b"/><path d="m193 215 144-76 62 70-184 42z" fill="#efc982"/><g stroke="#ba8444" stroke-width="3" opacity=".7"><path d="m246 191 47 42m-18-59 49 41m-20-59 51 43"/></g><path d="m337 151 20-76" stroke="#8c6440" stroke-width="3"/><circle cx="357" cy="74" r="7" fill="#b74b3f"/><path d="M426 302q27-43 51-8-18 22-51 8" fill="#6c894f"/><text x="300" y="413" text-anchor="middle" fill="#74603f" font-family="Georgia,serif" font-size="15" letter-spacing="5">CAFEBAR · SABOR PARA COMPARTIR</text></svg>

```

## 77. public/images/logo.svg
```xml
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400" width="400" height="400">
  <!-- Fondo marrón oscuro con esquinas suaves M3 -->
  <rect width="400" height="400" rx="60" fill="#221916" />

  <!-- Silueta del oso en tono crema -->
  <path fill="#F7ECCE" d="
    M 164 114
    C 155 103, 138 113, 146 128
    C 138 148, 122 225, 118 258
    C 115 282, 133 295, 152 293
    C 166 291, 173 278, 174 260
    C 175 245, 184 240, 200 240
    C 216 240, 225 245, 226 260
    C 227 278, 234 291, 248 293
    C 267 295, 285 282, 282 258
    C 278 225, 262 148, 254 128
    C 262 113, 245 103, 236 114
    C 222 106, 178 106, 164 114
    Z
  " />

  <!-- Ojos y nariz del oso (espacio negativo) -->
  <circle cx="177" cy="143" r="3.8" fill="#221916" />
  <circle cx="223" cy="143" r="3.8" fill="#221916" />
  <path fill="#221916" d="M 193 142 L 207 142 C 207 147, 202 151, 200 151 C 198 151, 193 147, 193 142 Z" />

  <!-- Taza y espacio negativo inferior entre las patas -->
  <path fill="#221916" d="
    M 171 215
    C 171 206, 229 206, 229 215
    C 229 229, 220 238, 211 241
    C 207 254, 213 276, 221 294
    L 179 294
    C 187 276, 193 254, 189 241
    C 180 238, 171 229, 171 215
    Z
  " />

  <!-- Asa de la taza -->
  <path fill="none" stroke="#221916" stroke-width="4.5" stroke-linecap="round" d="
    M 172 217
    C 159 217, 159 231, 173 231
  " />

  <!-- Detalle de crema/café dentro de la taza -->
  <ellipse cx="200" cy="215" rx="22" ry="3.2" fill="#F7ECCE" />
</svg>

```

## 78. public/uploads/productos/.htaccess
```text
Options -Indexes -ExecCGI
<FilesMatch "\.(php[0-9]?|phtml|phar|cgi|pl|html?|svg)$">
Require all denied
</FilesMatch>

```

## 79. public/uploads/musica/.htaccess
```text
Options -Indexes -ExecCGI
<FilesMatch "\.(php[0-9]?|phtml|phar|cgi|pl|html?|svg)$">
Require all denied
</FilesMatch>

```

## 80. public/router.php
```php
<?php
declare(strict_types=1);
$path=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)?:'/';
if(preg_match('~^/(css/[a-z-]+\.css|js/[a-z-]+\.js|fonts/[a-z-]+\.ttf|images/[a-z-]+\.(?:svg|png)|uploads/productos/[a-f0-9]{40}\.jpg|uploads/musica/[a-f0-9]{40}\.(?:mp3|ogg|wav))$~D',$path)&&is_file(__DIR__.$path))return false;
$_SERVER['SCRIPT_NAME']='/index.php';require __DIR__.'/index.php';

```

## 81. database/instalar.php
```php
<?php
declare(strict_types=1);
if(PHP_SAPI!=='cli')exit(1);
$dsn=getenv('CAFEBAR_INSTALL_DSN')?:'mysql:host=127.0.0.1;charset=utf8mb4';
$pdo=new PDO($dsn,getenv('CAFEBAR_INSTALL_USER')?:'root',getenv('CAFEBAR_INSTALL_PASSWORD')?:'',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES=>false]);
$q=$pdo->prepare('SELECT COUNT(*) FROM information_schema.schemata WHERE schema_name=?');$q->execute(['cafebar_mvc']);
$existe=(bool)$q->fetchColumn();
if($existe&&!in_array('--config-only',$argv,true)){fwrite(STDERR,"La base cafebar_mvc ya existe. No se modifica. Usa --config-only para conectar una instalación existente.\n");exit(1);}
if(is_file(dirname(__DIR__).'/app/config/local.php')){fwrite(STDERR,"Ya existe local.php. Se conserva sin cambios.\n");exit(1);}
if(!$existe){
    $sql=file_get_contents(__DIR__.'/cafebar_mvc.sql');
    foreach(preg_split('/;\s*(?:\r?\n|$)/',$sql) as $statement){if(trim($statement)!=='')$pdo->prepare($statement)->execute();}
}
$usuario='cafebar_'.bin2hex(random_bytes(4));$clave=bin2hex(random_bytes(24));
$pdo->prepare("CREATE USER '".$usuario."'@'127.0.0.1' IDENTIFIED BY ".$pdo->quote($clave))->execute();
$pdo->prepare("GRANT SELECT,INSERT,UPDATE,DELETE ON cafebar_mvc.* TO '".$usuario."'@'127.0.0.1'")->execute();
$config=['dsn'=>'mysql:host=127.0.0.1;dbname=cafebar_mvc;charset=utf8mb4','usuario'=>$usuario,'clave'=>$clave];
file_put_contents(dirname(__DIR__).'/app/config/local.php',"<?php\ndeclare(strict_types=1);\nreturn ".var_export($config,true).";\n");
echo "Instalación local completada. Base nueva y usuario de aplicación con permisos limitados.\nUsuarios: admin, empleado, cliente. Contraseña de laboratorio: CafeBar2026!\n";

```

## 82. iniciar.ps1
```powershell
$ErrorActionPreference='Stop'
Set-Location -LiteralPath $PSScriptRoot
$phpCommand=Get-Command php -ErrorAction SilentlyContinue
if($phpCommand){$phpExecutable=$phpCommand.Source}
elseif(Test-Path -LiteralPath 'C:\xampp\php\php.exe'){$phpExecutable='C:\xampp\php\php.exe'}
else{throw 'PHP 8+ no se encuentra en PATH ni en C:\xampp\php.'}
if(!(Test-Path -LiteralPath 'app/config/local.php') -and !$env:CAFEBAR_DSN){throw 'Configura app/config/local.php o ejecuta database/instalar.php primero.'}
New-Item -ItemType Directory -Force storage/tmp,public/uploads/productos,public/uploads/musica | Out-Null
$gd=& $phpExecutable -r 'echo extension_loaded(''gd'') ? ''1'' : ''0'';'
$phpOptions=@()
if($gd -eq '0'){$phpOptions+=@('-d','extension=gd')}
$phpOptions+=@('-d',('upload_tmp_dir='+ (Join-Path $PSScriptRoot 'storage/tmp')),'-d','upload_max_filesize=20M','-d','post_max_size=24M')
Write-Output 'CafeBar MVC: http://127.0.0.1:8080/ | Detener: Ctrl+C'
& $phpExecutable @phpOptions -S 127.0.0.1:8080 -t public public/router.php

```

## 83. tests/integracion.php
```php
<?php
declare(strict_types=1);
if(PHP_SAPI!=='cli')exit(1);
require dirname(__DIR__).'/app/helpers/Funciones.php';
function comprobar(bool $ok,string $nombre): void {if(!$ok)throw new RuntimeException($nombre);echo 'OK '.$nombre.PHP_EOL;}
function rechazar(callable $fn,string $nombre): void {try{$fn();}catch(DomainException|PDOException){echo 'OK '.$nombre.PHP_EOL;return;}throw new RuntimeException('No se rechazó: '.$nombre);}
$admin=new PDO(getenv('CAFEBAR_TEST_DSN')?:'mysql:host=127.0.0.1;charset=utf8mb4',getenv('CAFEBAR_TEST_USER')?:'root',getenv('CAFEBAR_TEST_PASSWORD')?:'',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES=>false]);
$nombre='cafebar_test_'.bin2hex(random_bytes(5));
$sql=str_replace('cafebar_mvc',$nombre,file_get_contents(dirname(__DIR__).'/database/cafebar_mvc.sql'));
foreach(preg_split('/;\s*(?:\r?\n|$)/',$sql) as $statement){if(trim($statement)!=='')$admin->prepare($statement)->execute();}
$conf=['dsn'=>'mysql:host=127.0.0.1;dbname='.$nombre.';charset=utf8mb4','usuario'=>getenv('CAFEBAR_TEST_USER')?:'root','clave'=>getenv('CAFEBAR_TEST_PASSWORD')?:''];
putenv('CAFEBAR_DSN='.$conf['dsn']);putenv('CAFEBAR_DB_USER='.$conf['usuario']);putenv('CAFEBAR_DB_PASSWORD='.$conf['clave']);
$db=Conexion::obtener();$usuarios=new UsuarioModel();$pedidos=new PedidoModel();
foreach(['admin','empleado','cliente'] as $usuario)comprobar((bool)$usuarios->autenticar($usuario,'CafeBar2026!'),'autenticación '.$usuario);
comprobar(!$usuarios->autenticar('admin',"' OR 1=1 --"),'inyección no autentica');
rechazar(fn()=>Validador::entero(['id'=>'1 OR 1=1'],'id'),'validación de identificadores');
$stock=(int)Conexion::consulta('SELECT stock FROM productos WHERE id=?',[1])->fetchColumn();
$token=bin2hex(random_bytes(32));$id=$pedidos->crear(3,[1=>2,4=>1],$token);
$pedido=$pedidos->detalle($id,3);
comprobar($pedido['total']==='39.00','precio oficial y total exacto');
comprobar((int)Conexion::consulta('SELECT stock FROM productos WHERE id=?',[1])->fetchColumn()===$stock-2,'descuento de stock');
comprobar($pedidos->crear(3,[1=>2,4=>1],$token)===$id,'confirmación idempotente');
rechazar(fn()=>$pedidos->crear(3,[1=>1,6=>99],bin2hex(random_bytes(32))),'stock insuficiente revierte todo');
comprobar((int)Conexion::consulta('SELECT stock FROM productos WHERE id=?',[1])->fetchColumn()===$stock-2,'rollback conserva stock');
comprobar((int)Conexion::consulta('SELECT COUNT(*) FROM pedidos')->fetchColumn()===1,'rollback no crea cabecera parcial');
rechazar(fn()=>$pedidos->crear(2,[1=>1],bin2hex(random_bytes(32))),'empleado no compra como cliente');
$pedidos->estado($id,'cancelado');$pedidos->estado($id,'cancelado');
comprobar((int)Conexion::consulta('SELECT stock FROM productos WHERE id=?',[1])->fetchColumn()===$stock,'cancelación repone stock una sola vez');
rechazar(fn()=>$pedidos->estado($id,'preparando'),'estado final protegido');
rechazar(fn()=>(new CategoriaModel())->eliminar(1),'categoría con productos no se elimina');
rechazar(fn()=>(new ProductoModel())->eliminar(1),'historial de productos vendido protegido');
$d=Validador::persona(['nombre'=>'Administrador','usuario'=>'admin','correo'=>'admin@cafebar.test','telefono'=>'','direccion'=>'']);
Conexion::consulta("UPDATE usuarios SET estado=0 WHERE usuario=?",['jaqueline']);
rechazar(fn()=>$usuarios->guardar($d,'empleado',1,1),'último administrador activo protegido');
rechazar(fn()=>$usuarios->perfil(3,Validador::persona($usuarios->buscar(3)),'incorrecta','NuevaClave2026!'),'cambio de clave exige actual');
$usuarios->perfil(3,Validador::persona($usuarios->buscar(3)),'CafeBar2026!','NuevaClave2026!');
comprobar((bool)$usuarios->autenticar('cliente','NuevaClave2026!'),'cambio de clave verificado');
$usuarios->guardar(Validador::persona(['nombre'=>'Otro cliente','usuario'=>'otro','correo'=>'otro@example.test','telefono'=>'','direccion'=>'']),'cliente',1,null,'OtroCliente2026!');
$otroId=(int)Conexion::consulta('SELECT id FROM usuarios WHERE usuario=?',['otro'])->fetchColumn();
rechazar(fn()=>$pedidos->detalle($id,$otroId),'aislamiento de pedidos entre clientes');
echo 'Base aislada conservada: '.$nombre.PHP_EOL;

```

## 84. tests/concurrencia.php
```php
<?php
declare(strict_types=1);
if(PHP_SAPI!=='cli')exit(1);
require dirname(__DIR__).'/app/helpers/Funciones.php';
if(($argv[1]??'')==='--worker'){
    $hasta=microtime(true)+5;
    while(!is_file($argv[3])&&microtime(true)<$hasta)usleep(10000);
    try{$id=(new PedidoModel())->crear((int)$argv[2],[1=>1],bin2hex(random_bytes(32)));echo json_encode(['ok'=>true,'pedido'=>$id]);}
    catch(DomainException $e){echo json_encode(['ok'=>false,'error'=>$e->getMessage()]);}
    exit;
}
$admin=new PDO(getenv('CAFEBAR_TEST_DSN')?:'mysql:host=127.0.0.1;charset=utf8mb4',getenv('CAFEBAR_TEST_USER')?:'root',getenv('CAFEBAR_TEST_PASSWORD')?:'',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES=>false]);
$nombre='cafebar_race_'.bin2hex(random_bytes(5));
$sql=str_replace('cafebar_mvc',$nombre,file_get_contents(dirname(__DIR__).'/database/cafebar_mvc.sql'));
foreach(preg_split('/;\s*(?:\r?\n|$)/',$sql) as $s){if(trim($s)!=='')$admin->prepare($s)->execute();}
putenv('CAFEBAR_DSN=mysql:host=127.0.0.1;dbname='.$nombre.';charset=utf8mb4');
putenv('CAFEBAR_DB_USER='.(getenv('CAFEBAR_TEST_USER')?:'root'));putenv('CAFEBAR_DB_PASSWORD='.(getenv('CAFEBAR_TEST_PASSWORD')?:''));
Conexion::consulta('UPDATE productos SET stock=? WHERE id=?',[1,1]);
(new UsuarioModel())->guardar(Validador::persona(['nombre'=>'Segundo comprador','usuario'=>'comprador2','correo'=>'comprador2@example.test','telefono'=>'','direccion'=>'']),'cliente',1,null,'Comprador2026!');
$segundoComprador=(int)Conexion::consulta('SELECT id FROM usuarios WHERE usuario=?',['comprador2'])->fetchColumn();
$dir=dirname(__DIR__).'/storage/tests';if(!is_dir($dir))mkdir($dir,0700,true);
$barrera=$dir.'/race-'.bin2hex(random_bytes(8));$procesos=[];
foreach([3,$segundoComprador] as $usuario){
    $pipes=[];$proc=proc_open([PHP_BINARY,__FILE__,'--worker',(string)$usuario,$barrera],[0=>['pipe','r'],1=>['pipe','w'],2=>['pipe','w']],$pipes);
    if(!is_resource($proc))throw new RuntimeException('No se pudo iniciar un proceso de prueba.');
    fclose($pipes[0]);$procesos[]=[$proc,$pipes];
}
file_put_contents($barrera,'iniciar');$resultados=[];
foreach($procesos as [$proc,$pipes]){
    $salida=stream_get_contents($pipes[1]);$error=stream_get_contents($pipes[2]);fclose($pipes[1]);fclose($pipes[2]);$codigo=proc_close($proc);
    if($codigo!==0)throw new RuntimeException($error);
    $resultados[]=json_decode($salida,true,32,JSON_THROW_ON_ERROR);
}
$exitos=count(array_filter($resultados,fn($r)=>$r['ok']));
if($exitos!==1||(int)Conexion::consulta('SELECT stock FROM productos WHERE id=?',[1])->fetchColumn()!==0||(int)Conexion::consulta('SELECT COUNT(*) FROM pedidos')->fetchColumn()!==1)throw new RuntimeException('Falló la exclusión concurrente de stock.');
echo "OK dos compradores concurrentes: un pedido aceptado, uno rechazado, stock final cero.\nBase aislada conservada: ".$nombre.PHP_EOL;

```

## 85. tests/http.ps1
```powershell
param([string]$Base='http://127.0.0.1:8080')
$ErrorActionPreference='Stop'
function Token($Response) { return [regex]::Match($Response.Content,'name="csrf" value="([^"]+)"').Groups[1].Value }
function Login($Name) {
    $session=New-Object Microsoft.PowerShell.Commands.WebRequestSession
    $page=Invoke-WebRequest "$Base/acceder" -WebSession $session -UseBasicParsing
    $result=Invoke-WebRequest "$Base/acceder" -Method Post -WebSession $session -UseBasicParsing -Body @{csrf=(Token $page);usuario=$Name;clave='CafeBar2026!'}
    return @{Session=$session;Page=$result;Token=(Token $result)}
}
function Denied($Address,$Session) {
    $denied=$false
    try { Invoke-WebRequest $Address -WebSession $Session -UseBasicParsing | Out-Null }
    catch { if([int]$_.Exception.Response.StatusCode -eq 403){$denied=$true}else{throw} }
    if(!$denied){throw "Expected 403: $Address"}
}
$public=Invoke-WebRequest "$Base/" -UseBasicParsing
if($public.StatusCode -ne 200 -or $public.Content -notmatch 'CafeBar'){throw 'Public portal failed'}
foreach($path in @('nosotros','productos','contactos','acceder','registro','css/estilos.css','js/carrito.js','images/cafe.svg')) {
    if((Invoke-WebRequest "$Base/$path" -UseBasicParsing).StatusCode -ne 200){throw "Route failed: $path"}
}
$guest=Invoke-WebRequest "$Base/admin" -UseBasicParsing
if($guest.Content -notmatch 'autocomplete="current-password"'){throw 'Private middleware failed'}
$admin=Login 'admin'
foreach($path in @('admin','admin/productos','admin/categorias','admin/usuarios','admin/pedidos','admin/mensajes','perfil')) {
    if((Invoke-WebRequest "$Base/$path" -WebSession $admin.Session -UseBasicParsing).StatusCode -ne 200){throw "Admin route failed: $path"}
}
$stats=Invoke-RestMethod "$Base/admin/indicadores" -WebSession $admin.Session
if($stats.productos -ne 9 -or $stats.categorias -ne 4 -or $stats.usuarios -lt 3){throw 'Dashboard stats failed'}
$csrfDenied=$false
try {Invoke-WebRequest "$Base/admin/categorias/guardar" -Method Post -WebSession $admin.Session -UseBasicParsing -Body @{csrf='invalid';nombre='Invalid';descripcion='Invalid request';estado='1'} | Out-Null}
catch {if([int]$_.Exception.Response.StatusCode -eq 403){$csrfDenied=$true}else{throw}}
if(!$csrfDenied){throw 'CSRF check failed'}
$employee=Login 'empleado'
foreach($path in @('admin','admin/productos','admin/pedidos','perfil')){Invoke-WebRequest "$Base/$path" -WebSession $employee.Session -UseBasicParsing | Out-Null}
foreach($path in @('admin/categorias','admin/usuarios','admin/mensajes','carrito')){Denied "$Base/$path" $employee.Session}
$client=Login 'cliente'
foreach($path in @('admin','admin/productos','admin/categorias','admin/usuarios','admin/pedidos','admin/mensajes')){Denied "$Base/$path" $client.Session}
$cart=Invoke-WebRequest "$Base/carrito" -WebSession $client.Session -UseBasicParsing
$orderToken=[regex]::Match($cart.Content,'name="token" value="([^"]+)"').Groups[1].Value
$posted=Invoke-WebRequest "$Base/carrito/confirmar" -Method Post -WebSession $client.Session -UseBasicParsing -Body @{csrf=(Token $cart);token=$orderToken;items='{"1":2,"4":1}'}
if($posted.Content -notmatch 'data-clear-cart="1"'){throw 'Checkout did not confirm and clear cart'}
$id=[regex]::Match($posted.Content,'pedido[?]id=([0-9]+)').Groups[1].Value
if(!$id){throw 'Order id missing'}
$detail=Invoke-WebRequest "$Base/pedido?id=$id" -WebSession $client.Session -UseBasicParsing
if($detail.Content -notmatch '39,00'){throw 'Order total failed'}
$changed=Invoke-WebRequest "$Base/admin/pedidos/estado" -Method Post -WebSession $employee.Session -UseBasicParsing -Body @{csrf=$employee.Token;id=$id;estado='cancelado'}
if($changed.Content -notmatch 'cancelado'){throw 'Order cancellation failed'}
Invoke-WebRequest "$Base/salir" -Method Post -WebSession $client.Session -UseBasicParsing -Body @{csrf=(Token $detail)} | Out-Null
$after=Invoke-WebRequest "$Base/carrito" -WebSession $client.Session -UseBasicParsing
if($after.Content -notmatch 'autocomplete="current-password"'){throw 'Logout failed'}
Write-Output 'OK public routes, admin routes, stats, role isolation, CSRF, checkout, official total, cancellation and logout'

```

## 86. tests/http-crud.ps1
```powershell
param([string]$Base='http://127.0.0.1:8080')
$ErrorActionPreference='Stop'
Add-Type -AssemblyName System.Net.Http
function Token($Response){return [regex]::Match($Response.Content,'name="csrf" value="([^"]+)"').Groups[1].Value}
function Post($Path,$Data,$Session){return Invoke-WebRequest "$Base/$Path" -Method Post -WebSession $Session -UseBasicParsing -Body $Data}
$session=New-Object Microsoft.PowerShell.Commands.WebRequestSession
$login=Invoke-WebRequest "$Base/acceder" -WebSession $session -UseBasicParsing
$admin=Post 'acceder' @{csrf=(Token $login);usuario='admin';clave='CafeBar2026!'} $session
$csrf=Token $admin
$suffix=[Guid]::NewGuid().ToString('N').Substring(0,10)
$categoryName='Prueba-'+$suffix
$category=Post 'admin/categorias/guardar' @{csrf=$csrf;nombre=$categoryName;descripcion='Categoria temporal de prueba';estado='1'} $session
$catId=[regex]::Match($category.Content,($categoryName+'.*?admin/categorias[?]editar=([0-9]+)'),[System.Text.RegularExpressions.RegexOptions]::Singleline).Groups[1].Value
if(!$catId){throw 'Category create failed'}
Post 'admin/categorias/guardar' @{csrf=$csrf;id=$catId;nombre=$categoryName;descripcion='Categoria editada';estado='1'} $session | Out-Null
$handler=New-Object System.Net.Http.HttpClientHandler
$handler.CookieContainer=$session.Cookies
$http=New-Object System.Net.Http.HttpClient($handler)
$multi=New-Object System.Net.Http.MultipartFormDataContent
$fields=@{csrf=$csrf;nombre=('Producto-'+$suffix);categoria_id=$catId;descripcion='Producto temporal para prueba de subida';precio='9.50';stock='4';estado='1'}
foreach($key in $fields.Keys){$multi.Add((New-Object System.Net.Http.StringContent([string]$fields[$key])),$key)}
$fixture=Join-Path $PSScriptRoot '../storage/tmp/fixture.png'
& C:\xampp\php\php.exe -d extension=gd (Join-Path $PSScriptRoot 'imagen-prueba.php') $fixture
$content=New-Object System.Net.Http.ByteArrayContent(,[System.IO.File]::ReadAllBytes($fixture))
$content.Headers.ContentType=New-Object System.Net.Http.Headers.MediaTypeHeaderValue('image/png')
$multi.Add($content,'imagen','fixture.png')
$response=$http.PostAsync("$Base/admin/productos/guardar",$multi).GetAwaiter().GetResult()
$html=$response.Content.ReadAsStringAsync().GetAwaiter().GetResult()
if(!$response.IsSuccessStatusCode){throw 'Product upload HTTP failed'}
$productId=[regex]::Match($html,('Producto-'+$suffix+'.*?admin/productos[?]editar=([0-9]+)'),[System.Text.RegularExpressions.RegexOptions]::Singleline).Groups[1].Value
if(!$productId){throw 'Product image upload or creation failed'}
$edit=Invoke-WebRequest "$Base/admin/productos?editar=$productId" -WebSession $session -UseBasicParsing
if($edit.Content -notmatch '9.50'){throw 'Product read failed'}
Post 'admin/productos/guardar' @{csrf=$csrf;id=$productId;nombre=('Producto-'+$suffix);categoria_id=$catId;descripcion='Producto editado';precio='10.50';stock='6';estado='0'} $session | Out-Null
Post 'admin/productos/eliminar' @{csrf=$csrf;id=$productId} $session | Out-Null
$deleted=Post 'admin/categorias/eliminar' @{csrf=$csrf;id=$catId} $session
if($deleted.Content -match $categoryName){throw 'Category deletion failed'}
$person=@{csrf=$csrf;nombre='Empleado de prueba';usuario=('empleado'+$suffix);correo=($suffix+'@example.test');telefono='70000000';direccion='Laboratorio';rol='empleado';estado='1';clave='EmpleadoPrueba2026!'}
$users=Post 'admin/usuarios/guardar' $person $session
$userId=[regex]::Match($users.Content,('empleado'+$suffix+'.*?admin/usuarios[?]editar=([0-9]+)'),[System.Text.RegularExpressions.RegexOptions]::Singleline).Groups[1].Value
if(!$userId){throw 'Employee registration failed'}
$person.id=$userId;$person.estado='0';$person.Remove('clave');Post 'admin/usuarios/guardar' $person $session | Out-Null
$contactPage=Invoke-WebRequest "$Base/contactos" -WebSession $session -UseBasicParsing
Post 'contactos' @{csrf=(Token $contactPage);nombre='Consulta de prueba';correo='prueba@example.test';asunto=('Consulta-'+$suffix);contenido='Mensaje creado por la prueba HTTP local.'} $session | Out-Null
$messages=Invoke-WebRequest "$Base/admin/mensajes" -WebSession $session -UseBasicParsing
$messageId=[regex]::Match($messages.Content,('Consulta-'+$suffix+'.*?name="id" value="([0-9]+)"'),[System.Text.RegularExpressions.RegexOptions]::Singleline).Groups[1].Value
if(!$messageId){throw 'Contact message persistence failed'}
Post 'admin/mensajes/estado' @{csrf=$csrf;id=$messageId;estado='leido'} $session | Out-Null
Post 'admin/mensajes/estado' @{csrf=$csrf;id=$messageId;estado='respondido'} $session | Out-Null
Post 'admin/mensajes/eliminar' @{csrf=$csrf;id=$messageId} $session | Out-Null
$multi.Dispose();$http.Dispose()
Write-Output 'OK category CRUD, product CRUD with PNG upload and JPG conversion, employee creation and deactivation, contact message lifecycle'

```

## 87. tests/imagen-prueba.php
```php
<?php
declare(strict_types=1);
if(PHP_SAPI!=='cli'||empty($argv[1]))exit(1);
$imagen=imagecreatetruecolor(32,32);imagefill($imagen,0,0,imagecolorallocate($imagen,200,125,85));
imagepng($imagen,$argv[1]);imagedestroy($imagen);

```

## 88. tests/musica.php
```php
<?php
declare(strict_types=1);
require dirname(__DIR__).'/app/helpers/Funciones.php';
function ok(bool $v,string $m): void {if(!$v)throw new RuntimeException($m);echo 'OK '.$m.PHP_EOL;}
function no(callable $f,string $m): void {try{$f();}catch(DomainException){echo 'OK '.$m.PHP_EOL;return;}throw new RuntimeException($m);}
$pdo=new PDO(getenv('CAFEBAR_TEST_DSN')?:'mysql:host=127.0.0.1;charset=utf8mb4',getenv('CAFEBAR_TEST_USER')?:'root',getenv('CAFEBAR_TEST_PASSWORD')?:'',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES=>false]);
$db='coffe_music_test_'.bin2hex(random_bytes(5));
$sql=str_replace('cafebar_mvc',$db,file_get_contents(dirname(__DIR__).'/database/cafebar_mvc.sql'));
foreach(preg_split('/;\s*(?:\r?\n|$)/',$sql) as $s){if(trim($s)!=='')$pdo->prepare($s)->execute();}
foreach(preg_split('/;\s*(?:\r?\n|$)/',file_get_contents(dirname(__DIR__).'/database/musica.sql')) as $s){if(trim($s)!=='')$pdo->prepare($s)->execute();}
putenv('CAFEBAR_DSN=mysql:host=127.0.0.1;dbname='.$db.';charset=utf8mb4');putenv('CAFEBAR_DB_USER='.(getenv('CAFEBAR_TEST_USER')?:'root'));putenv('CAFEBAR_DB_PASSWORD='.(getenv('CAFEBAR_TEST_PASSWORD')?:''));
$m=new MusicaModel();$m->agregar('Tema de prueba','Artista de prueba','youtube','abcdefghijk');$song=(int)Conexion::obtener()->lastInsertId();
no(fn()=>$m->sugerir(2,$song,'','',null),'empleado no suplanta cliente al sugerir');
$m->sugerir(3,$song,'','',null);$s=(int)$m->solicitudes(3)[0]['id'];
no(fn()=>$m->sugerir(3,$song,'','',null),'duplicado activo rechazado');
ok(count($m->estado()['cola'])===0,'pendiente no entra en reproducción');
$m->moderar($s,1,true,null);ok(count($m->estado()['cola'])===1,'aprobación agrega a la cola');
$device=str_repeat('a',64);$other=str_repeat('b',64);$track=$m->siguiente($device,1);
ok((int)$track['id']===$s,'prioridad de la sugerencia aprobada');
no(fn()=>$m->siguiente($other,1),'segundo dispositivo no puede reproducir simultáneamente');
ok($m->latido($device),'latido mantiene el reproductor');ok(!$m->latido($other),'latido de otro dispositivo rechazado');
no(fn()=>$m->siguiente($device,1,999,'reproducida'),'finalización de otra pista rechazada');
$next=$m->siguiente($device,1,$s,'reproducida');ok((int)$next['id']!==$s,'continúa catálogo al terminar la cola');
ok(Conexion::consulta('SELECT estado FROM musica_sugerencias WHERE id=?',[$s])->fetchColumn()==='reproducida','se conserva historial de reproducción');
$m->liberar($device);ok((bool)$m->siguiente($other,1),'liberar permite otro equipo');$m->liberar($other);
$m->activar($song,0);ok($m->siguiente($device,1)===null,'catálogo inactivo no se reproduce');
ok(AudioArchivo::youtube('https://youtu.be/abcdefghijk')==='abcdefghijk','YouTube corto validado');
no(fn()=>AudioArchivo::youtube('https://youtube.com.evil.test/watch?v=abcdefghijk'),'dominio engañoso rechazado');
no(fn()=>AudioArchivo::youtube('javascript:alert(1)'),'URL ejecutable rechazada');
echo 'Base aislada conservada: '.$db.PHP_EOL;

```

## 89. tests/musica-http.ps1
```powershell
param([string]$Base='http://127.0.0.1:8080')
$ErrorActionPreference='Stop'
function Csrf($page){[regex]::Match($page.Content,'name="csrf" value="([^"]+)"').Groups[1].Value}
function Login($user,$password){
 $session=New-Object Microsoft.PowerShell.Commands.WebRequestSession
 $page=Invoke-WebRequest "$Base/acceder" -WebSession $session -UseBasicParsing
 $next=Invoke-WebRequest "$Base/acceder" -Method Post -WebSession $session -UseBasicParsing -Body @{csrf=(Csrf $page);usuario=$user;clave=$password}
 return @{Session=$session;Token=(Csrf $next);Page=$next}
}
$admin=Login 'jaqueline' 'jaqui123'
if($admin.Page.Content -notmatch 'data-stats-url'){throw 'Jaqueline admin login failed'}
$client=Login 'cliente' 'CafeBar2026!'
$music=Invoke-WebRequest "$Base/musica" -WebSession $client.Session -UseBasicParsing
if($music.Content -notmatch 'musica/sugerir'){throw 'Client suggestions missing'}
$forbidden=$false
try {Invoke-WebRequest "$Base/admin/musica/reproductor" -WebSession $client.Session -UseBasicParsing | Out-Null}
catch {if([int]$_.Exception.Response.StatusCode -eq 403){$forbidden=$true}else{throw}}
if(!$forbidden){throw 'Client can open local player'}
$player=Invoke-WebRequest "$Base/admin/musica/reproductor" -WebSession $admin.Session -UseBasicParsing
if($player.Content -notmatch 'reproductor-local' -or $player.Headers['Content-Security-Policy'] -notmatch 'www.youtube.com'){throw 'Player or YouTube CSP missing'}
$general=Invoke-WebRequest "$Base/" -UseBasicParsing
if($general.Headers['Content-Security-Policy'] -match 'youtube.com'){throw 'YouTube permission leaked to public pages'}
if($general.Content -notmatch 'Instituto T' -or $general.Content -notmatch 'google.com/maps[?]cid=5666542721018396729'){throw 'Maps missing'}
$suffix=[Guid]::NewGuid().ToString('N').Substring(0,8)
$title='PruebaMusical-'+$suffix
$suggested=Invoke-WebRequest "$Base/musica/sugerir" -Method Post -WebSession $client.Session -UseBasicParsing -Body @{csrf=(Csrf $music);titulo=$title;artista='Prueba de laboratorio';youtube='https://youtu.be/abcdefghijk'}
if($suggested.Content -notmatch $title){throw 'Suggestion not persisted'}
$staff=Invoke-WebRequest "$Base/musica" -WebSession $admin.Session -UseBasicParsing
$id=[regex]::Match($staff.Content,($title+'.*?name="id" value="([0-9]+)"'),[System.Text.RegularExpressions.RegexOptions]::Singleline).Groups[1].Value
if(!$id){throw 'Staff cannot see suggestion'}
$done=Invoke-WebRequest "$Base/admin/musica/moderar" -Method Post -WebSession $admin.Session -UseBasicParsing -Body @{csrf=$admin.Token;id=$id;accion='rechazar'}
$history=Invoke-WebRequest "$Base/musica" -WebSession $client.Session -UseBasicParsing
if($history.Content -notmatch 'rechazada'){throw 'Moderation not applied'}
$device='a'*64
$control=Invoke-RestMethod "$Base/admin/musica/control" -Method Post -WebSession $admin.Session -Body @{csrf=$admin.Token;accion='siguiente';dispositivo=$device}
Invoke-RestMethod "$Base/admin/musica/control" -Method Post -WebSession $admin.Session -Body @{csrf=$admin.Token;accion='liberar';dispositivo=$device} | Out-Null
$badCsrf=$false
try {Invoke-WebRequest "$Base/admin/musica/control" -Method Post -WebSession $admin.Session -UseBasicParsing -Body @{csrf='invalid';accion='siguiente';dispositivo=$device} | Out-Null}
catch {if([int]$_.Exception.Response.StatusCode -eq 403){$badCsrf=$true}else{throw}}
if(!$badCsrf){throw 'Invalid CSRF accepted'}
Write-Output 'OK Jaqueline login, client requests, staff moderation, player permissions, YouTube scoped CSP, CSRF and Maps'

```

## 90. tests/audio-http.ps1
```powershell
param([string]$Base='http://127.0.0.1:8080')
$ErrorActionPreference='Stop'
Add-Type -AssemblyName System.Net.Http
$session=New-Object Microsoft.PowerShell.Commands.WebRequestSession
$login=Invoke-WebRequest "$Base/acceder" -WebSession $session -UseBasicParsing
$csrf=[regex]::Match($login.Content,'name="csrf" value="([^"]+)"').Groups[1].Value
$panel=Invoke-WebRequest "$Base/acceder" -Method Post -WebSession $session -UseBasicParsing -Body @{csrf=$csrf;usuario='jaqueline';clave='jaqui123'}
$csrf=[regex]::Match($panel.Content,'name="csrf" value="([^"]+)"').Groups[1].Value
$title='PruebaAudio-'+[Guid]::NewGuid().ToString('N').Substring(0,8)
$fixture=Join-Path $PSScriptRoot '../storage/tmp/prueba-audio.wav'
$writer=[IO.BinaryWriter]::new([IO.File]::Create($fixture))
try {
 $writer.Write([Text.Encoding]::ASCII.GetBytes('RIFF'));$writer.Write([int]16036);$writer.Write([Text.Encoding]::ASCII.GetBytes('WAVEfmt '));$writer.Write([int]16)
 $writer.Write([int16]1);$writer.Write([int16]1);$writer.Write([int]8000);$writer.Write([int]16000);$writer.Write([int16]2);$writer.Write([int16]16)
 $writer.Write([Text.Encoding]::ASCII.GetBytes('data'));$writer.Write([int]16000);$writer.Write([byte[]]::new(16000))
}finally{$writer.Dispose()}
$handler=New-Object System.Net.Http.HttpClientHandler;$handler.CookieContainer=$session.Cookies
$client=New-Object System.Net.Http.HttpClient($handler)
$form=New-Object System.Net.Http.MultipartFormDataContent
$fields=@{csrf=$csrf;titulo=$title;artista='Silencio de prueba';fuente='archivo'}
foreach($key in $fields.Keys){$form.Add((New-Object System.Net.Http.StringContent([string]$fields[$key])),$key)}
$audio=New-Object System.Net.Http.ByteArrayContent(,[IO.File]::ReadAllBytes($fixture));$audio.Headers.ContentType=New-Object System.Net.Http.Headers.MediaTypeHeaderValue('audio/wav');$form.Add($audio,'audio','prueba.wav')
$response=$client.PostAsync("$Base/admin/musica/agregar",$form).GetAwaiter().GetResult()
$html=$response.Content.ReadAsStringAsync().GetAwaiter().GetResult()
if(!$response.IsSuccessStatusCode -or $html -notmatch $title){throw 'Audio upload failed'}
$row=& C:\xampp\php\php.exe -r 'require ''app/helpers/Funciones.php''; echo json_encode(Conexion::consulta(''SELECT id,recurso FROM musica_canciones WHERE titulo=?'',[$argv[1]])->fetch());' $title | ConvertFrom-Json
if(!$row.id -or $row.recurso -notmatch '^uploads/musica/[a-f0-9]{40}[.]wav$'){throw 'Audio path not normalized'}
$served=Invoke-WebRequest "$Base/$($row.recurso)" -UseBasicParsing
if($served.StatusCode -ne 200 -or $served.Headers['Content-Type'] -notmatch '^audio/'){throw 'Audio not served as media'}
Invoke-WebRequest "$Base/admin/musica/activar" -Method Post -WebSession $session -UseBasicParsing -Body @{csrf=$csrf;id=$row.id;activo='0'} | Out-Null
$form.Dispose();$client.Dispose()
Write-Output 'OK WAV upload, MIME validation, random media path, HTTP audio and deactivation of fixture'

```

## 91. tests/contraste.js
```javascript
'use strict';
const fs=require('node:fs');
const css=fs.readFileSync(require('node:path').join(__dirname,'../public/css/accesibilidad.css'),'utf8');
const root=css.match(/:root\[data-theme=light\]\s*\{([^}]+)\}/)[1];
const colors=Object.fromEntries([...root.matchAll(/--([a-z-]+):\s*(#[a-f0-9]{6})\s*;/g)].map(m=>[m[1],m[2]]));
function lum(hex){const v=hex.slice(1).match(/../g).map(s=>parseInt(s,16)/255).map(n=>n<=.04045?n/12.92:((n+.055)/1.055)**2.4);return .2126*v[0]+.7152*v[1]+.0722*v[2];}
function ratio(a,b){const x=lum(a),y=lum(b);return (Math.max(x,y)+.05)/(Math.min(x,y)+.05);}
for(const [label,fg,bg] of [['Texto principal',colors.ink,colors.base],['Texto secundario',colors.muted,colors.raised],['Acentos pequeños',colors.accent,colors.base],['Campos',colors.ink,colors.input],['Botón caramelo','#3c261a','#d69a66'],['Menú lateral','#d9c9b8','#221916'],['Texto sobre foto','#fff3e0','#38251e']]){
  const value=ratio(fg,bg);if(value<4.5)throw new Error(`${label}: contraste ${value.toFixed(2)} insuficiente`);console.log(`OK ${label}: ${value.toFixed(2)}:1`);
}

```

## 92. .gitignore
```text
app/config/local.php
storage/*
public/uploads/productos/*.jpg
public/uploads/musica/*.mp3
public/uploads/musica/*.ogg
public/uploads/musica/*.wav
*.log

```

## 93. README.md
```text
# CafeBar MVC

Actualización musical y de ubicación: disponible el módulo **Música** para clientes y **Música del local** para personal, con catálogo, sugerencias moderadas y reproducción secuencial. Administradora solicitada: `jaqueline` / `jaqui123`. Mapa configurado en el Instituto Técnico Jesús María, Oblitas Nº 364, Oruro. Véase `MUSICA-Y-UBICACION.md` para funcionamiento, instalación y límites. La base incorpora tres tablas musicales adicionales a las seis originales. El contraste del modo claro se corrige con accesibilidad.css.

Identidad actual: **Coffe Music Bar**, paleta espresso/crema/caramelo, tipografía Nunito local y superficies con efecto liquid glass. Los datos públicos de Google Maps y WhatsApp se configuran en `app/config/datos-negocio.php`. Véase `DISENO-COFFE.md` para la configuración y los recursos. La sección WE GO describe una versión de diseño anterior.

Rediseño actual: **WE GO**, identidad azul marino y crema con portada fotográfica, navegación móvil y temas claro/oscuro. Ver `DISENO-WEGO.md` para cambios, recursos y prompt de la imagen. La hoja de estilo activa usa CSS puro y fuentes locales de sistema. El ZIP y el documento de código incluyen el rediseño y la imagen conceptual generada.

Sistema de cafetería y restaurante en PHP 8+, PDO, MySQL, HTML5, CSS3 y JavaScript nativo. Sin frameworks ni paquetes de terceros. Incluye portal público, tres roles, carrito, pedidos transaccionales y gestión administrativa.

## Abrir la instalación preparada

El proyecto está en `C:\Users\rosal\Desktop\cafebar-mvc`. Mientras el servidor local esté activo, abrir http://127.0.0.1:8080/ y acceder desde el menú. Si se detuvo, iniciar MySQL desde XAMPP y ejecutar:

```powershell
Set-Location C:\Users\rosal\Desktop\cafebar-mvc
.\iniciar.ps1
```

| Usuario | Contraseña de laboratorio | Rol |
|---|---|---|
| admin | CafeBar2026! | Administrador |
| empleado | CafeBar2026! | Empleado |
| cliente | CafeBar2026! | Cliente |

Las contraseñas se verifican con password_verify y se guardan únicamente como hashes. Los secretos escritos en el SQL y esta guía pertenecen exclusivamente a las cuentas de demostración solicitadas. Cambiarlos desde Mi Perfil antes de publicar.

## Instalación nueva

Requisitos: PHP 8.1 o posterior con pdo_mysql, mbstring, fileinfo y GD; MySQL 8.0.16 o posterior o MariaDB compatible; Apache 2.4 con mod_rewrite para el despliegue. El arranque local habilita GD si no estaba cargado. No requiere Composer ni npm.

1. Importar `database/cafebar_mvc.sql` en una base vacía. Define seis tablas InnoDB con utf8mb4_unicode_ci, claves foráneas, restricciones e índices; contiene las cuentas y el catálogo de laboratorio.
2. Crear un usuario MySQL exclusivo con SELECT, INSERT, UPDATE y DELETE sobre `cafebar_mvc.*`. No utilizar root como cuenta del proceso web.
3. Copiar `app/config/local.example.php` a `app/config/local.php` y completar DSN y credenciales. También se pueden usar CAFEBAR_DSN, CAFEBAR_DB_USER y CAFEBAR_DB_PASSWORD; el entorno tiene prioridad sobre el archivo local.
4. Ejecutar `iniciar.ps1` para desarrollo o configurar Apache con DocumentRoot exclusivamente en `public`, `AllowOverride All` y mod_rewrite.

En el XAMPP local, el instalador opcional crea la base vacía, importa el SQL, genera una cuenta MySQL con permisos limitados y guarda la configuración local:

```powershell
& C:\xampp\php\php.exe database/instalar.php
```

El instalador toma CAFEBAR_INSTALL_DSN, CAFEBAR_INSTALL_USER y CAFEBAR_INSTALL_PASSWORD; por defecto se conecta al MySQL local de XAMPP con root sin contraseña. Ese acceso solo se usa en la instalación por CLI. No vuelve a importar ni sobrescribe una base existente. Con `--config-only` puede crear la cuenta de aplicación y la configuración para una base ya importada; no sustituye un local.php existente. Los identificadores y el secreto de la cuenta se generan con random_bytes. CREATE USER no permite marcadores para la contraseña en este entorno: el secreto generado se cita con PDO::quote y toda la sentencia se ejecuta con prepare/execute.

## Organización y rutas

- `database`: esquema y herramienta CLI de instalación.
- `app/config`: configuración privada y conexión PDO con emulación desactivada.
- `app/helpers`: middleware, CSRF, validación, imágenes, limitador y utilidades.
- `app/models`: acceso a datos y reglas de negocio.
- `app/controllers`: validación de peticiones y autorización por operación.
- `app/views`: layouts y vistas públicas, de autenticación y de administración.
- `public`: Front Controller, CSS, JavaScript, ilustraciones y fotografías normalizadas.
- `storage`: sesiones, temporales y límites por IP; se crea automáticamente, fuera del directorio público.

Las rutas públicas son `/`, `/nosotros`, `/productos`, `/contactos`, `/acceder` y `/registro`. Los clientes acceden a `/carrito`, `/mis-pedidos`, `/pedido?id=ID` y `/perfil`. El panel utiliza `/admin` y los módulos `/admin/productos`, `/admin/categorias`, `/admin/usuarios`, `/admin/pedidos` y `/admin/mensajes`. Las operaciones que modifican datos solo admiten POST con CSRF.

| Capacidad | Administrador | Empleado | Cliente |
|---|---|---|---|
| Portal público | Sí | Sí | Sí |
| Dashboard, productos y pedidos recibidos | Sí | Sí | No |
| Categorías, usuarios y mensajes | Sí | No | No |
| Carrito y pedidos propios | No | No | Sí |
| Perfil y contraseña propia | Sí | Sí | Sí |

El empleado recibe indicadores de productos y pedidos. Categorías y usuarios son indicadores exclusivos del administrador, de acuerdo con sus permisos. El dashboard consulta datos cada diez segundos y marca fallos de actualización.

## Pedidos y existencias

El carrito se guarda en localStorage bajo una clave por usuario. Permite agregar, quitar y editar cantidades, y calcula importes orientativos en centavos. El servidor vuelve a validar cantidades, categorías y productos activos; no acepta los precios del navegador.

PedidoModel inicia una transacción, bloquea el cliente y los productos con SELECT FOR UPDATE, consulta el precio oficial, guarda cabecera y detalle histórico, descuenta stock y confirma. Ante cualquier error revierte todo. Un token único evita duplicar el mismo envío. Los precios se calculan en centavos enteros y se almacenan como DECIMAL, evitando acumulación de errores de punto flotante. Máximo 50 productos distintos y 99 unidades por producto en cada pedido.

Estados: pendiente → preparando → entregado. Se puede cancelar desde pendiente o preparando. La cancelación repone las existencias dentro de una transacción y solo una vez; entregado y cancelado son finales. Los productos con ventas no se eliminan para preservar las referencias: se desactivan. Las categorías con productos tampoco se eliminan.

El sistema confirma pedidos para atención en el local. No incluye cobros electrónicos, facturación tributaria, reparto ni envío de correo. Marcar un mensaje como respondido registra una gestión hecha por el operador; no envía respuestas automáticamente.

## Seguridad y despliegue

Autenticación con password_hash/password_verify, rehash y regeneración del ID de sesión. La sesión expira tras 30 minutos de inactividad o 8 horas absolutas; cuenta y rol se releen en cada petición privada. El logout limpia la sesión y cookie, destruye el acceso y abre una sesión anónima nueva. Las contraseñas no aparecen en listados ni formularios de edición.

Todos los formularios POST llevan CSRF, incluso contacto y autenticación. Se validan datos en servidor y con HTML5/JavaScript; el registro público fija el rol cliente. HTML escapado y carrito construido con textContent; CSP sin scripts ni estilos inline. Límite persistente por IP: diez logins, cinco registros y cinco mensajes cada quince minutos. No se confía en X-Forwarded-For. Los clientes detrás de una misma IP comparten cuota.

Las fotografías aceptan JPG, PNG y WebP hasta 4 MB y 3000 × 3000 píxeles; se comprueba MIME, dimensiones y origen de subida y se decodifican y normalizan como JPG con nombre aleatorio. No se permite subir SVG. Las ilustraciones SVG iniciales forman parte del código del proyecto. El directorio de uploads impide ejecución en Apache; el router de desarrollo solo sirve los formatos previstos.

En producción configurar HTTPS, cookie Secure y el servidor/proxy correctamente; permisos de escritura solo para storage y uploads; display_errors=Off; registros fuera de public; backups y limpieza programada de sesiones, temporales y archivos antiguos de límites. Configurar upload_max_filesize=4M y post_max_size=6M. No exponer app, database o storage. El servidor integrado de PHP es exclusivamente para desarrollo.

## Pruebas y código completo

```powershell
& C:\xampp\php\php.exe tests/integracion.php
& C:\xampp\php\php.exe tests/concurrencia.php
.\tests\http.ps1
.\tests\http-crud.ps1
.\generar-entrega.ps1
```

Integración y concurrencia crean bases aisladas con nombres aleatorios y las conservan para revisión. Requieren credenciales con permiso de crear bases mediante CAFEBAR_TEST_DSN, CAFEBAR_TEST_USER y CAFEBAR_TEST_PASSWORD; por defecto usan el MySQL local de XAMPP. Nunca cambian la configuración local del servidor web.

Las pruebas HTTP se ejecutan contra el servidor local y crean pedidos de demostración que luego cancelan; el test CRUD elimina sus productos, categorías y mensajes temporales y conserva su empleado desactivado. Ejecutarlas solo en un entorno de laboratorio. Repetirlas puede alcanzar la cuota de login.

`CODIGO-COMPLETO.md` contiene comandos de creación, SQL y cada archivo íntegro en orden de construcción. `cafebar-mvc-entrega.zip` se genera junto al directorio del proyecto, excluyendo credenciales locales, cookies y fotografías cargadas durante las pruebas. `VERIFICACION.md` registra las comprobaciones realizadas y sus límites.

Los textos comerciales, ubicación, horarios, cuentas e imágenes iniciales son demostrativos. Sustituirlos por información y fotografías del negocio antes de publicar.

```

## 94. VERIFICACION.md
```text
# Verificación realizada

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

```

## 95. DISENO-WEGO.md
```text
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

```

## 96. DISENO-COFFE.md
```text
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

```

## 97. MUSICA-Y-UBICACION.md
```text
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

```

## 98. generar-entrega.ps1
```powershell
$ErrorActionPreference='Stop'
$project=$PSScriptRoot
$files=@(
 'database/cafebar_mvc.sql','database/musica.sql','database/actualizar-musica.php','public/index.php','public/.htaccess',
 'app/config/Config.php','app/config/Conexion.php','app/config/local.example.php','app/config/datos-negocio.php',
 'app/helpers/Funciones.php','app/helpers/AuthMiddleware.php','app/helpers/CsrfToken.php','app/helpers/Validador.php','app/helpers/Intentos.php','app/helpers/Imagen.php','app/helpers/Negocio.php','app/helpers/AudioArchivo.php',
 'app/models/UsuarioModel.php','app/models/CategoriaModel.php','app/models/ProductoModel.php','app/models/PedidoModel.php','app/models/MensajeModel.php','app/models/MusicaModel.php',
 'app/controllers/PublicoController.php','app/controllers/AuthController.php','app/controllers/CarritoController.php','app/controllers/DashboardController.php','app/controllers/ProductoController.php','app/controllers/CategoriaController.php','app/controllers/UsuarioController.php','app/controllers/PedidoController.php','app/controllers/MensajeController.php','app/controllers/PerfilController.php','app/controllers/MusicaController.php',
 'app/views/layouts/cabecera.php','app/views/layouts/aviso.php','app/views/layouts/publico.php','app/views/layouts/admin.php','app/views/layouts/marca.php',
 'app/views/publico/inicio.php','app/views/publico/nosotros.php','app/views/publico/productos.php','app/views/publico/tarjetas.php','app/views/publico/contactos.php','app/views/publico/carrito.php','app/views/publico/error.php','app/views/publico/musica.php',
 'app/views/auth/acceder.php','app/views/auth/registro.php','app/views/admin/campos-persona.php','app/views/admin/dashboard.php','app/views/admin/productos.php','app/views/admin/categorias.php','app/views/admin/usuarios.php','app/views/admin/pedidos.php','app/views/admin/pedido.php','app/views/admin/mensajes.php','app/views/admin/perfil.php',
 'app/views/admin/musica.php','app/views/admin/reproductor.php','public/css/estilos.css','public/css/refinado.css','public/css/cristal.css','public/css/accesibilidad.css','public/css/musica.css','public/js/tema.js','public/js/app.js','public/js/carrito.js','public/js/musica.js','public/js/reproductor.js','public/fonts/OFL-Nunito.txt',
 'public/images/cafe.svg','public/images/jugo.svg','public/images/postre.svg','public/images/sandwich.svg','public/images/logo.svg','public/uploads/productos/.htaccess','public/uploads/musica/.htaccess','public/router.php',
 'database/instalar.php','iniciar.ps1','tests/integracion.php','tests/concurrencia.php','tests/http.ps1','tests/http-crud.ps1','tests/imagen-prueba.php','tests/musica.php','tests/musica-http.ps1','tests/audio-http.ps1','tests/contraste.js','.gitignore','README.md','VERIFICACION.md','DISENO-WEGO.md','DISENO-COFFE.md','MUSICA-Y-UBICACION.md','generar-entrega.ps1'
)
$text=New-Object System.Text.StringBuilder
[void]$text.AppendLine('# CafeBar MVC: construccion y codigo completo')
[void]$text.AppendLine('')
[void]$text.AppendLine('## 1. Crear estructura desde PowerShell')
[void]$text.AppendLine('```powershell')
[void]$text.AppendLine('New-Item -ItemType Directory -Force cafebar-mvc/database, cafebar-mvc/app/config, cafebar-mvc/app/helpers, cafebar-mvc/app/models, cafebar-mvc/app/controllers, cafebar-mvc/app/views/layouts, cafebar-mvc/app/views/publico, cafebar-mvc/app/views/auth, cafebar-mvc/app/views/admin, cafebar-mvc/public/css, cafebar-mvc/public/js, cafebar-mvc/public/images, cafebar-mvc/public/uploads/productos, cafebar-mvc/tests')
foreach($file in $files){[void]$text.AppendLine(('New-Item -ItemType File -Force cafebar-mvc/{0}' -f $file))}
[void]$text.AppendLine('Set-Location cafebar-mvc')
[void]$text.AppendLine('```')
$section=2
foreach($file in $files){
    $lang=switch([IO.Path]::GetExtension($file)){'.php'{'php'} '.sql'{'sql'} '.css'{'css'} '.js'{'javascript'} '.svg'{'xml'} '.ps1'{'powershell'} default{'text'}}
    [void]$text.AppendLine('')
    [void]$text.AppendLine(('## {0}. {1}' -f $section,$file))
    [void]$text.AppendLine(('```{0}' -f $lang))
    [void]$text.AppendLine([IO.File]::ReadAllText((Join-Path $project $file)))
    [void]$text.AppendLine('```')
    $section++
}
[IO.File]::WriteAllText((Join-Path $project 'CODIGO-COMPLETO.md'),$text.ToString(),(New-Object Text.UTF8Encoding($false)))
Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem
$zipPath=Join-Path (Split-Path $project -Parent) 'cafebar-mvc-entrega.zip'
$zipStream=[IO.File]::Open($zipPath,[IO.FileMode]::Create,[IO.FileAccess]::ReadWrite)
$zip=New-Object IO.Compression.ZipArchive($zipStream,[IO.Compression.ZipArchiveMode]::Create)
try {
    foreach($file in ($files + @('CODIGO-COMPLETO.md','public/images/wego-hero.png','public/fonts/nunito-variable.ttf'))){[IO.Compression.ZipFileExtensions]::CreateEntryFromFile($zip,(Join-Path $project $file),('cafebar-mvc/'+$file)) | Out-Null}
}finally{$zip.Dispose()}
Write-Output 'Entrega creada: CODIGO-COMPLETO.md y cafebar-mvc-entrega.zip.'

```
