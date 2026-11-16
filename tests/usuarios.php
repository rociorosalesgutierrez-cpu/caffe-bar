<?php

declare(strict_types = 1);

if (PHP_SAPI !== 'cli') {
    exit(1);
}
require dirname(__DIR__) . '/app/helpers/Funciones.php';
function comprobar(bool $ok, string $mensaje): void
{
    if (!$ok) {
        throw new RuntimeException($mensaje);
    }
    echo 'OK ' . $mensaje . PHP_EOL;
}
function rechazar(callable $accion, string $mensaje): void
{
    try {
        $accion();
    } catch (DomainException) {
        echo 'OK ' . $mensaje . PHP_EOL;
        return;
    }
    throw new RuntimeException($mensaje);
}
foreach (['Ana María', 'Óscar D’Ávila', 'Jean-Luc', "Jose\u{0301} Pérez"] as $nombre) {
    comprobar(Validador::nombre(['nombre' => $nombre]) === $nombre, 'nombre válido: ' . $nombre);
}
foreach (['Ana123', '12345', 'Ana１２', 'Ana ☕', "Ana\nMaría", ['Ana']] as $nombre) {
    rechazar(fn() => Validador::nombre(['nombre' => $nombre]), 'nombre inválido rechazado');
}
foreach (['Clave123', 'áéíóúñAB', str_repeat('a', 72)] as $clave) {
    comprobar(Validador::clave(['clave' => $clave]) === $clave, 'contraseña válida aceptada');
}
foreach (
    ['1234567', 'áéíóúñA', str_repeat('a', 73), str_repeat('ñ', 37), "Clave123\0", [12345678]]
    as $clave
) {
    rechazar(fn() => Validador::clave(['clave' => $clave]), 'contraseña inválida rechazada');
}

// Base aislada: las pruebas HTTP no escriben en cafebar_mvc.
$usuario = getenv('CAFEBAR_TEST_USER') ?: 'root';
$claveDb = getenv('CAFEBAR_TEST_PASSWORD') ?: '';
$admin = new PDO(
    getenv('CAFEBAR_TEST_DSN') ?: 'mysql:host=127.0.0.1;charset=utf8mb4',
    $usuario,
    $claveDb,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
$nombreDb = 'cafebar_users_' . bin2hex(random_bytes(5));
$sql = str_replace(
    'cafebar_mvc',
    $nombreDb,
    file_get_contents(dirname(__DIR__) . '/database/cafebar_mvc.sql')
);
foreach (preg_split('/;\s*(?:\r?\n|$)/', $sql) as $s) {
    if (trim($s) !== '') {
        $admin->prepare($s)->execute();
    }
}
putenv('CAFEBAR_DSN=mysql:host=127.0.0.1;dbname=' . $nombreDb . ';charset=utf8mb4');
putenv('CAFEBAR_DB_USER=' . $usuario);
putenv('CAFEBAR_DB_PASSWORD=' . $claveDb);
$db = Conexion::obtener();
$lector = new PDO(
    'mysql:host=127.0.0.1;dbname=' . $nombreDb . ';charset=utf8mb4',
    $usuario,
    $claveDb,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
);
$socket = stream_socket_server('tcp://127.0.0.1:0', $numero, $error);
if (!$socket) {
    throw new RuntimeException($error);
}
$puerto = (int) substr(strrchr(stream_socket_get_name($socket, false), ':'), 1);
fclose($socket);
$base = 'http://127.0.0.1:' . $puerto;
$ipPrueba = '127.0.' . random_int(1, 254) . '.' . random_int(1, 254);
$raiz = dirname(__DIR__);
$log = $raiz . '/storage/tmp/usuarios-' . $nombreDb . '.log';
$proceso = proc_open(
    [
        PHP_BINARY,
        '-S',
        '127.0.0.1:' . $puerto,
        '-t',
        $raiz . '/public',
        $raiz . '/public/router.php'
    ],
    [0 => ['pipe', 'r'], 1 => ['file', $log, 'a'], 2 => ['file', $log, 'a']],
    $pipes,
    $raiz
);
if (!is_resource($proceso)) {
    throw new RuntimeException('No se pudo iniciar el servidor de pruebas.');
}
fclose($pipes[0]);
function solicitar(string $ruta, array &$cookies, ?array $datos = null): array
{
    global $base, $ipPrueba;
    for ($salto = 0; $salto < 6; $salto++) {
        $cabeceras = ['Connection: close'];
        if ($cookies) {
            $cabeceras[] =
                'Cookie: ' .
                implode(
                    '; ',
                    array_map(fn($k, $v) => $k . '=' . $v, array_keys($cookies), $cookies)
                );
        }
        if ($datos !== null) {
            $cabeceras[] = 'Content-Type: application/x-www-form-urlencoded';
        }
        $contexto = stream_context_create([
            'http' => [
                'method' => $datos === null ? 'GET' : 'POST',
                'header' => implode("\r\n", $cabeceras),
                'content' => $datos === null ? '' : http_build_query($datos),
                'ignore_errors' => true,
                'follow_location' => 0,
                'timeout' => 10
            ],
            'socket' => ['bindto' => $ipPrueba . ':0']
        ]);
        $f = fopen($base . $ruta, 'r', false, $contexto);
        if (!$f) {
            throw new RuntimeException('Falló la solicitud de prueba: ' . $ruta);
        }
        $headers = stream_get_meta_data($f)['wrapper_data'];
        $html = stream_get_contents($f);
        fclose($f);
        preg_match('/\s(\d{3})\s/', $headers[0], $codigo);
        $status = (int) $codigo[1];
        $destino = null;
        foreach ($headers as $header) {
            if (preg_match('/^Set-Cookie: ([^=]+)=([^;]*)/i', $header, $m)) {
                $cookies[$m[1]] = $m[2];
            }
            if (preg_match('/^Location: (.+)$/i', $header, $m)) {
                $destino = $m[1];
            }
        }
        if ($status >= 300 && $status < 400 && $destino !== null) {
            if (!str_starts_with($destino, '/')) {
                throw new RuntimeException('Redirección inesperada.');
            }
            $ruta = $destino;
            $datos = null;
            continue;
        }
        return ['status' => $status, 'html' => $html, 'ruta' => $ruta, 'headers' => $headers];
    }
    throw new RuntimeException('Demasiadas redirecciones.');
}
function token(array $pagina): string
{
    if (!preg_match('/name="csrf"\s+value="([^"]+)"/', $pagina['html'], $m)) {
        throw new RuntimeException('Falta CSRF.');
    }
    return $m[1];
}
function fila(string $usuario): array|false
{
    global $lector;
    $q = $lector->prepare('SELECT * FROM usuarios WHERE usuario=?');
    $q->execute([$usuario]);
    return $q->fetch();
}
try {
    $listo = false;
    for ($i = 0; $i < 50; $i++) {
        $conexion = @fsockopen('127.0.0.1', $puerto, $numero, $error, 0.1);
        if ($conexion) {
            fclose($conexion);
            $listo = true;
            break;
        }
        usleep(100000);
    }
    if (!$listo) {
        throw new RuntimeException('El servidor de pruebas no respondió.');
    }
    $cookies = [];
    $pagina = solicitar('/acceder', $cookies);
    $pagina = solicitar('/acceder', $cookies, [
        'csrf' => token($pagina),
        'usuario' => 'admin',
        'clave' => 'CafeBar2026!'
    ]);
    comprobar(
        $pagina['status'] === 200 && !str_contains($pagina['html'], 'current-password'),
        'acceso del administrador'
    );
    $csrf = token($pagina);
    $datos = [
        'csrf' => $csrf,
        'nombre' => 'Ana María Pérez',
        'usuario' => 'prueba',
        'correo' => 'prueba@example.test',
        'telefono' => '+591 70000000',
        'direccion' => 'Laboratorio',
        'rol' => 'empleado',
        'estado' => '1',
        'clave' => 'Clave123'
    ];
    foreach (['empleado', 'cliente', 'administrador'] as $rol) {
        $d = array_replace($datos, [
            'usuario' => 'prueba_' . $rol,
            'correo' => $rol . '@example.test',
            'rol' => $rol
        ]);
        $respuesta = solicitar('/admin/usuarios/guardar', $cookies, $d);
        $u = fila($d['usuario']);
        comprobar(
            $respuesta['status'] === 200 &&
                $u !== false &&
                str_contains(
                    $respuesta['html'],
                    'Usuario #' . $u['id'] . ' registrado correctamente.'
                ),
            'alta HTTP y confirmación del identificador: ' . $rol
        );
        comprobar(
            $u['rol'] === $rol &&
                $u['nombre'] === $d['nombre'] &&
                password_verify('Clave123', $u['password_hash']),
            'persistencia verificada desde otra conexión: ' . $rol
        );
    }
    foreach (
        [
            ['nombre' => 'Ana123'],
            ['clave' => '1234567'],
            ['correo' => 'incorrecto'],
            ['telefono' => 'telefono'],
            ['usuario' => 'usuario inválido'],
            ['rol' => 'superusuario'],
            ['estado' => '2']
        ]
        as $invalido
    ) {
        $d = array_replace($datos, $invalido);
        $respuesta = solicitar('/admin/usuarios/guardar', $cookies, $d);
        comprobar(
            fila('prueba') === false &&
                !str_contains($respuesta['html'], 'registrado correctamente.'),
            'alta inválida no se guarda ni muestra éxito: ' . array_key_first($invalido)
        );
    }
    $duplicado = array_replace($datos, [
        'usuario' => 'prueba_empleado',
        'correo' => 'duplicado@example.test'
    ]);
    $respuesta = solicitar('/admin/usuarios/guardar', $cookies, $duplicado);
    comprobar(
        str_contains($respuesta['html'], 'No se puede guardar'),
        'usuario duplicado rechazado'
    );
    $duplicado = array_replace($datos, ['correo' => 'empleado@example.test']);
    $respuesta = solicitar('/admin/usuarios/guardar', $cookies, $duplicado);
    comprobar(
        fila('prueba') === false && str_contains($respuesta['html'], 'No se puede guardar'),
        'correo duplicado rechazado'
    );
    $u = fila('prueba_empleado');
    $d = array_replace($datos, [
        'id' => $u['id'],
        'usuario' => $u['usuario'],
        'correo' => $u['correo'],
        'nombre' => 'Óscar D’Ávila'
    ]);
    unset($d['clave']);
    $respuesta = solicitar('/admin/usuarios/guardar', $cookies, $d);
    comprobar(
        fila($u['usuario'])['nombre'] === $d['nombre'] &&
            str_contains($respuesta['html'], 'actualizado correctamente.'),
        'edición persistida sin exigir otra contraseña'
    );

    $cliente = [];
    $pagina = solicitar('/acceder', $cliente);
    $pagina = solicitar('/acceder', $cliente, [
        'csrf' => token($pagina),
        'usuario' => 'prueba_cliente',
        'clave' => 'Clave123'
    ]);
    comprobar(
        $pagina['status'] === 200 && !str_contains($pagina['html'], 'current-password'),
        'cuenta creada accede con contraseña de ocho caracteres'
    );
    $pagina = solicitar('/perfil', $cliente);
    $u = fila('prueba_cliente');
    $perfil = [
        'csrf' => token($pagina),
        'nombre' => $u['nombre'],
        'usuario' => $u['usuario'],
        'correo' => $u['correo'],
        'telefono' => $u['telefono'],
        'direccion' => $u['direccion'],
        'clave_actual' => 'incorrecta',
        'nueva_clave' => 'Nueva123',
        'confirmacion' => 'Nueva123'
    ];
    solicitar('/perfil', $cliente, $perfil);
    comprobar(
        password_verify('Clave123', fila($u['usuario'])['password_hash']),
        'cambio de contraseña exige la actual'
    );
    $perfil['clave_actual'] = 'Clave123';
    solicitar('/perfil', $cliente, $perfil);
    comprobar(
        password_verify('Nueva123', fila($u['usuario'])['password_hash']),
        'nueva contraseña de ocho caracteres persistida'
    );
    $perfil['nombre'] = 'Persona123';
    $perfil['nueva_clave'] = '';
    $perfil['confirmacion'] = '';
    solicitar('/perfil', $cliente, $perfil);
    comprobar(
        fila($u['usuario'])['nombre'] === $u['nombre'],
        'perfil rechaza números en el nombre'
    );
    $respuesta = solicitar('/admin/usuarios', $cliente);
    comprobar($respuesta['status'] === 403, 'cliente no administra usuarios');

    $visitante = [];
    $pagina = solicitar('/registro', $visitante);
    $csrfPublico = token($pagina);
    $registro = [
        'csrf' => $csrfPublico,
        'nombre' => 'María José',
        'usuario' => 'registro_publico',
        'correo' => 'publico@example.test',
        'telefono' => '',
        'direccion' => '',
        'clave' => 'Clave123',
        'confirmacion' => 'Clave123'
    ];
    foreach (
        [
            ['nombre' => 'Maria12'],
            ['clave' => '1234567', 'confirmacion' => '1234567'],
            ['confirmacion' => 'Distinta']
        ]
        as $invalido
    ) {
        solicitar('/registro', $visitante, array_replace($registro, $invalido));
        comprobar(fila('registro_publico') === false, 'registro público inválido rechazado');
    }
    $respuesta = solicitar('/registro', $visitante, $registro);
    comprobar(
        fila('registro_publico') !== false && str_contains($respuesta['html'], 'Cuenta creada.'),
        'registro público de ocho caracteres persistido'
    );

    $pagina = solicitar('/contactos', $visitante);
    $mensaje = [
        'csrf' => token($pagina),
        'nombre' => 'María José',
        'correo' => 'contacto@example.test',
        'asunto' => 'Consulta de prueba aislada',
        'contenido' => 'Mensaje enviado por la prueba de integración.'
    ];
    $totalMensajes = (int) $lector->query('SELECT COUNT(*) FROM mensajes_contacto')->fetchColumn();
    solicitar('/contactos', $visitante, array_replace($mensaje, ['nombre' => 'Maria123']));
    comprobar(
        (int) $lector->query('SELECT COUNT(*) FROM mensajes_contacto')->fetchColumn() ===
            $totalMensajes,
        'contacto rechaza nombres numéricos'
    );
    $confirmacion = solicitar('/contactos', $visitante, $mensaje);
    $enlacePrivado = $confirmacion['ruta'];
    comprobar(
        str_starts_with($enlacePrivado, '/consulta?token='),
        'visitante recibe un enlace privado de seguimiento'
    );
    $m = $lector
        ->query("SELECT * FROM mensajes_contacto WHERE correo='contacto@example.test'")
        ->fetch();
    $respuesta = solicitar('/admin/mensajes', $cookies);
    comprobar(
        $m !== false &&
            $m['nombre'] === $mensaje['nombre'] &&
            str_contains($respuesta['html'], $mensaje['asunto']),
        'Contactos guarda el mensaje y aparece en el panel'
    );
    $sinRespuesta = solicitar('/admin/mensajes/estado', $cookies, [
        'csrf' => token($respuesta),
        'id' => $m['id'],
        'estado' => 'respondido'
    ]);
    comprobar(
        str_contains($sinRespuesta['html'], 'Escribe y guarda una respuesta'),
        'no se marca respondido sin escribir una respuesta'
    );
    solicitar('/admin/mensajes/responder', $cookies, [
        'csrf' => token($respuesta),
        'id' => $m['id'],
        'respuesta' => 'Hola, tenemos mesas disponibles. <script>alert(1)</script>'
    ]);
    $q = $lector->prepare('SELECT estado FROM mensajes_contacto WHERE id=?');
    $q->execute([$m['id']]);
    comprobar($q->fetchColumn() === 'respondido', 'estado del mensaje persistido');

    $lectura = solicitar($enlacePrivado, $visitante);
    comprobar(
        str_contains($lectura['html'], 'Hola, tenemos mesas disponibles.') &&
            !str_contains($lectura['html'], '<script>alert(1)</script>'),
        'visitante lee la respuesta con escape HTML'
    );
    comprobar(
        $m['token_hash'] !== substr($enlacePrivado, strlen('/consulta?token=')),
        'el enlace privado se almacena como hash'
    );
    $invalida = solicitar('/consulta?token=' . str_repeat('f', 64), $visitante);
    comprobar($invalida['status'] === 404, 'token de consulta ajeno o inexistente rechazado');
    $invalida = solicitar('/consulta?id=' . $m['id'], $visitante);
    comprobar($invalida['status'] === 404, 'identificador numérico no revela consultas privadas');

    $pagina = solicitar('/contactos', $cliente);
    $mensajeCliente = array_replace($mensaje, [
        'csrf' => token($pagina),
        'asunto' => 'Consulta privada de cliente',
        'usuario_id' => 1
    ]);
    $lectura = solicitar('/contactos', $cliente, $mensajeCliente);
    comprobar(
        $lectura['ruta'] === '/mis-mensajes' &&
            str_contains($lectura['html'], $mensajeCliente['asunto']) &&
            !str_contains($lectura['html'], $mensaje['asunto']),
        'bandeja vinculada a la sesión y no al correo declarado'
    );
    $propia = $lector
        ->query("SELECT * FROM mensajes_contacto WHERE asunto='Consulta privada de cliente'")
        ->fetch();
    comprobar(
        (int) $propia['usuario_id'] === (int) $u['id'],
        'el remitente no puede suplantar al propietario con el formulario'
    );
    $pagina = solicitar('/admin/mensajes', $cookies);
    $denegada = solicitar('/admin/mensajes/responder', $cliente, [
        'csrf' => token($lectura),
        'id' => $propia['id'],
        'respuesta' => 'Respuesta no autorizada'
    ]);
    comprobar($denegada['status'] === 403, 'cliente no responde como administrador');
    $denegada = solicitar('/admin/mensajes/responder', $cookies, [
        'csrf' => 'invalido',
        'id' => $propia['id'],
        'respuesta' => 'Respuesta no autorizada'
    ]);
    comprobar($denegada['status'] === 403, 'responder exige CSRF válido');
    solicitar('/admin/mensajes/responder', $cookies, [
        'csrf' => token($pagina),
        'id' => $propia['id'],
        'respuesta' => 'Tu reserva está disponible.'
    ]);
    $lectura = solicitar('/mis-mensajes', $cliente);
    comprobar(
        str_contains($lectura['html'], 'Tu reserva está disponible.'),
        'cliente ve la respuesta desde Mis mensajes'
    );
    $ajena = solicitar('/mis-mensajes?usuario_id=' . $u['id'], $cookies);
    comprobar(
        !str_contains($ajena['html'], 'Tu reserva está disponible.'),
        'la bandeja personal no acepta suplantación por URL'
    );

    $lector->exec('UPDATE productos SET precio=1250.50 WHERE id=1');
    $stockAntes = (int) $lector->query('SELECT stock FROM productos WHERE id=1')->fetchColumn();
    $pagina = solicitar('/productos', $cookies);
    comprobar(
        str_contains($pagina['html'], 'data-add'),
        'administrador puede agregar productos desde la carta'
    );
    $pagina = solicitar('/carrito', $cookies);
    preg_match('/name="token"\s+value="([^"]+)"/', $pagina['html'], $pedidoToken);
    $compra = solicitar('/carrito/confirmar', $cookies, [
        'csrf' => token($pagina),
        'token' => $pedidoToken[1],
        'items' => '{"1":1}'
    ]);
    $pedidoAdmin = $lector
        ->query('SELECT * FROM pedidos WHERE usuario_id=1 ORDER BY id DESC LIMIT 1')
        ->fetch();
    comprobar(
        $pedidoAdmin !== false &&
            $compra['ruta'] === '/mis-pedidos' &&
            str_contains($compra['html'], 'data-clear-cart="1"'),
        'compra propia del administrador confirmada y carrito vaciado'
    );
    comprobar(
        (int) $lector->query('SELECT stock FROM productos WHERE id=1')->fetchColumn() ===
            $stockAntes - 1 && fila('admin')['rol'] === 'administrador',
        'compra descuenta stock y conserva el rol administrativo'
    );
    $pagina = solicitar('/admin/usuarios', $cookies);
    comprobar($pagina['status'] === 200, 'administrador mantiene acceso a su panel tras comprar');
    $factura = solicitar('/admin/factura?id=' . $pedidoAdmin['id'], $cookies);
    comprobar(
        $factura['status'] === 200 &&
            str_contains($factura['html'], 'MIL DOSCIENTOS CINCUENTA 50/100 BOLIVIANOS'),
        'factura admite importes mayores de mil con centavos exactos'
    );
    comprobar(
        str_contains($factura['html'], 'css/factura.css') &&
            str_contains($factura['html'], 'data-print') &&
            !str_contains($factura['html'], 'onclick=') &&
            !str_contains($factura['html'], '<style>'),
        'factura usa estilos y botón compatibles con CSP'
    );
    comprobar(
        strpos($factura['html'], 'class="factura-datos"') <
            strpos($factura['html'], 'class="factura-detalle"'),
        'datos del comprador aparecen antes del detalle'
    );
    comprobar(
        str_contains($factura['html'], 'FACTURA DE DEMOSTRACIÓN') &&
            !str_contains($factura['html'], 'CUF:') &&
            !str_contains($factura['html'], '72320623018'),
        'documento no inventa NIT ni códigos fiscales'
    );
    $css = solicitar('/css/factura.css?v=1', $visitante);
    comprobar(
        $css['status'] === 200 && str_contains($css['html'], '@media print'),
        'hoja de impresión responde por HTTP'
    );
    $invalida = solicitar('/admin/factura?id=' . $pedidoAdmin['id'] . '&nit[]=123', $cookies);
    comprobar(
        $invalida['status'] === 422,
        'datos de factura malformados se rechazan sin error 500'
    );
    $ajena = solicitar('/factura?id=' . $pedidoAdmin['id'], $cliente);
    comprobar($ajena['status'] === 403, 'cliente no accede a la factura de otra cuenta');

    $pagina = solicitar('/carrito', $cliente);
    preg_match('/name="token"\s+value="([^"]+)"/', $pagina['html'], $pedidoToken);
    solicitar('/carrito/confirmar', $cliente, [
        'csrf' => token($pagina),
        'token' => $pedidoToken[1],
        'items' => '{"1":1}'
    ]);
    $pedidoCliente = $lector
        ->query(
            'SELECT * FROM pedidos WHERE usuario_id=' . (int) $u['id'] . ' ORDER BY id DESC LIMIT 1'
        )
        ->fetch();
    $factura = solicitar(
        '/factura?id=' . $pedidoCliente['id'] . '&nit=12345&razon_social=Maria%20Perez',
        $cliente
    );
    comprobar(
        $factura['status'] === 200 &&
            str_contains($factura['html'], 'action="/factura"') &&
            str_contains($factura['html'], 'Maria Perez') &&
            !str_contains($factura['html'], 'action="/admin/factura"'),
        'cliente actualiza sus datos de impresión en la ruta correcta'
    );
    $personal = [];
    $pagina = solicitar('/acceder', $personal);
    solicitar('/acceder', $personal, [
        'csrf' => token($pagina),
        'usuario' => 'empleado',
        'clave' => 'CafeBar2026!'
    ]);
    comprobar(
        solicitar('/carrito', $personal)['status'] === 403,
        'empleado mantiene la restricción de compra'
    );

    $paginaPersonal = solicitar('/admin/pedidos', $personal);
    $csrfPersonal = token($paginaPersonal);
    $idCliente = (int) $pedidoCliente['id'];
    $estado = solicitar('/mis-pedidos/estado?id=' . $idCliente, $cliente);
    $json = json_decode($estado['html'], true, 32, JSON_THROW_ON_ERROR);
    comprobar(
        $estado['status'] === 200 && $json['pedidos'][0]['estado'] === 'pendiente',
        'cliente consulta el estado pendiente de su pedido'
    );
    $listado = solicitar('/mis-pedidos', $cliente);
    $detalle = solicitar('/pedido?id=' . $idCliente, $cliente);
    comprobar(
        str_contains($listado['html'], 'js/pedidos.js?v=1') &&
            str_contains($detalle['html'], 'data-pedidos-url='),
        'lista y detalle del cliente incluyen actualización automática'
    );

    $ajeno = solicitar('/mis-pedidos/estado?id=' . $pedidoAdmin['id'], $cliente);
    comprobar($ajeno['status'] === 404, 'cliente no consulta el estado de pedidos ajenos');
    $ajeno = solicitar('/mis-pedidos/estado?usuario_id=1', $cliente);
    $json = json_decode($ajeno['html'], true, 32, JSON_THROW_ON_ERROR);
    comprobar(
        count($json['pedidos']) === 1 && (int) $json['pedidos'][0]['id'] === $idCliente,
        'la URL no puede cambiar el propietario consultado'
    );
    comprobar(
        solicitar('/mis-pedidos/estado', $personal)['status'] === 403,
        'el endpoint personal conserva las restricciones de rol'
    );

    $denegado = solicitar('/admin/pedidos/estado', $cliente, [
        'csrf' => token($detalle),
        'id' => $idCliente,
        'estado' => 'entregado'
    ]);
    comprobar($denegado['status'] === 403, 'el cliente no cambia el estado de su propio pedido');

    foreach (['preparando', 'entregado'] as $nuevoEstado) {
        solicitar('/admin/pedidos/estado', $personal, [
            'csrf' => $csrfPersonal,
            'id' => $idCliente,
            'estado' => $nuevoEstado
        ]);
        $estado = solicitar('/mis-pedidos/estado?id=' . $idCliente, $cliente);
        $json = json_decode($estado['html'], true, 32, JSON_THROW_ON_ERROR);
        $listado = solicitar('/mis-pedidos', $cliente);
        $detalle = solicitar('/pedido?id=' . $idCliente, $cliente);
        $patron = '/data-pedido-estado="' . $idCliente . '"\s+data-estado="' . $nuevoEstado . '"/';
        comprobar(
            $json['pedidos'][0]['estado'] === $nuevoEstado &&
                preg_match($patron, $listado['html']) === 1 &&
                preg_match($patron, $detalle['html']) === 1,
            'cambio del personal visible para el cliente en API, lista y detalle: ' . $nuevoEstado
        );
    }

    solicitar('/admin/pedidos/estado', $personal, [
        'csrf' => $csrfPersonal,
        'id' => $idCliente,
        'estado' => 'pendiente'
    ]);
    $estado = solicitar('/mis-pedidos/estado?id=' . $idCliente, $cliente);
    $json = json_decode($estado['html'], true, 32, JSON_THROW_ON_ERROR);
    comprobar(
        $json['pedidos'][0]['estado'] === 'entregado',
        'estado final entregado no se revierte'
    );

    $pagina = solicitar('/carrito', $cliente);
    preg_match('/name="token"\s+value="([^"]+)"/', $pagina['html'], $pedidoToken);
    solicitar('/carrito/confirmar', $cliente, [
        'csrf' => token($pagina),
        'token' => $pedidoToken[1],
        'items' => '{"1":1}'
    ]);
    $ultimoPedido = (int) $lector
        ->query('SELECT MAX(id) FROM pedidos WHERE usuario_id=' . (int) $u['id'])
        ->fetchColumn();
    $stockTrasCompra = (int) $lector
        ->query('SELECT stock FROM productos WHERE id=1')
        ->fetchColumn();
    foreach ([1, 2] as $intento) {
        solicitar('/admin/pedidos/estado', $personal, [
            'csrf' => $csrfPersonal,
            'id' => $ultimoPedido,
            'estado' => 'cancelado'
        ]);
    }
    $estado = solicitar('/mis-pedidos/estado?id=' . $ultimoPedido, $cliente);
    $json = json_decode($estado['html'], true, 32, JSON_THROW_ON_ERROR);
    comprobar(
        $json['pedidos'][0]['estado'] === 'cancelado' &&
            (int) $lector->query('SELECT stock FROM productos WHERE id=1')->fetchColumn() ===
                $stockTrasCompra + 1,
        'cancelación visible al cliente y reposición de stock una sola vez'
    );

    $nosotros = solicitar('/nosotros', $visitante);
    $foto = solicitar('/images/nosotros-cafeteria.jpg', $visitante);
    comprobar(
        $nosotros['status'] === 200 &&
            str_contains($nosotros['html'], 'images/nosotros-cafeteria.jpg') &&
            substr($foto['html'], 0, 3) === "\xff\xd8\xff",
        'Nosotros muestra una fotografía JPEG real servida localmente'
    );
    $archivoConexion = (new ReflectionClass(Conexion::class))->getFileName();
    comprobar(
        str_replace('\\', '/', $archivoConexion) ===
            str_replace('\\', '/', $raiz . '/core/Conexion.php'),
        'la aplicación utiliza la conexión de la carpeta core'
    );
    comprobar(
        solicitar('/core/Conexion.php', $visitante)['status'] === 404,
        'el núcleo no queda expuesto como archivo público'
    );

    echo 'Base aislada conservada: ' . $nombreDb . PHP_EOL;
} finally {
    proc_terminate($proceso);
    proc_close($proceso);
}
