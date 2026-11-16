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
        return ['status' => $status, 'html' => $html];
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
    solicitar('/contactos', $visitante, $mensaje);
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
    solicitar('/admin/mensajes/estado', $cookies, [
        'csrf' => token($respuesta),
        'id' => $m['id'],
        'estado' => 'respondido'
    ]);
    $q = $lector->prepare('SELECT estado FROM mensajes_contacto WHERE id=?');
    $q->execute([$m['id']]);
    comprobar($q->fetchColumn() === 'respondido', 'estado del mensaje persistido');
    echo 'Base aislada conservada: ' . $nombreDb . PHP_EOL;
} finally {
    proc_terminate($proceso);
    proc_close($proceso);
}
