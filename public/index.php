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
 'GET /admin/reportes'=>[ReporteController::class,'index'],'GET /admin/reportes/csv'=>[ReporteController::class,'csv'],
 'GET /admin/factura'=>[ReporteController::class,'factura'],'GET /factura'=>[ReporteController::class,'facturaCliente'],
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
