<?php

declare(strict_types = 1);

if (PHP_SAPI !== 'cli') {
    exit(1);
}
require dirname(__DIR__) . '/app/helpers/Funciones.php';
if (($argv[1] ?? '') === '--worker') {
    $hasta = microtime(true) + 5;
    while (!is_file($argv[3]) && microtime(true) < $hasta) {
        usleep(10000);
    }
    try {
        $id = (new PedidoModel())->crear((int) $argv[2], [1 => 1], bin2hex(random_bytes(32)));
        echo json_encode(['ok' => true, 'pedido' => $id]);
    } catch (DomainException $e) {
        echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
    }
    exit();
}
$admin = new PDO(
    getenv('CAFEBAR_TEST_DSN') ?: 'mysql:host=127.0.0.1;charset=utf8mb4',
    getenv('CAFEBAR_TEST_USER') ?: 'root',
    getenv('CAFEBAR_TEST_PASSWORD') ?: '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false]
);
$nombre = 'cafebar_race_' . bin2hex(random_bytes(5));
$sql = str_replace(
    'cafebar_mvc',
    $nombre,
    file_get_contents(dirname(__DIR__) . '/database/cafebar_mvc.sql')
);
foreach (preg_split('/;\s*(?:\r?\n|$)/', $sql) as $s) {
    if (trim($s) !== '') {
        $admin->prepare($s)->execute();
    }
}
putenv('CAFEBAR_DSN=mysql:host=127.0.0.1;dbname=' . $nombre . ';charset=utf8mb4');
putenv('CAFEBAR_DB_USER=' . (getenv('CAFEBAR_TEST_USER') ?: 'root'));
putenv('CAFEBAR_DB_PASSWORD=' . (getenv('CAFEBAR_TEST_PASSWORD') ?: ''));
Conexion::consulta('UPDATE productos SET stock=? WHERE id=?', [1, 1]);
(new UsuarioModel())->guardar(
    Validador::persona([
        'nombre' => 'Segundo comprador',
        'usuario' => 'comprador2',
        'correo' => 'comprador2@example.test',
        'telefono' => '',
        'direccion' => ''
    ]),
    'cliente',
    1,
    null,
    'Comprador2026!'
);
$segundoComprador = (int) Conexion::consulta('SELECT id FROM usuarios WHERE usuario=?', [
    'comprador2'
])->fetchColumn();
$dir = dirname(__DIR__) . '/storage/tests';
if (!is_dir($dir)) {
    mkdir($dir, 0700, true);
}
$barrera = $dir . '/race-' . bin2hex(random_bytes(8));
$procesos = [];
foreach ([3, $segundoComprador] as $usuario) {
    $pipes = [];
    $proc = proc_open(
        [PHP_BINARY, __FILE__, '--worker', (string) $usuario, $barrera],
        [0 => ['pipe', 'r'], 1 => ['pipe', 'w'], 2 => ['pipe', 'w']],
        $pipes
    );
    if (!is_resource($proc)) {
        throw new RuntimeException('No se pudo iniciar un proceso de prueba.');
    }
    fclose($pipes[0]);
    $procesos[] = [$proc, $pipes];
}
file_put_contents($barrera, 'iniciar');
$resultados = [];
foreach ($procesos as [$proc, $pipes]) {
    $salida = stream_get_contents($pipes[1]);
    $error = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $codigo = proc_close($proc);
    if ($codigo !== 0) {
        throw new RuntimeException($error);
    }
    $resultados[] = json_decode($salida, true, 32, JSON_THROW_ON_ERROR);
}
$exitos = count(array_filter($resultados, fn($r) => $r['ok']));
if (
    $exitos !== 1 ||
    (int) Conexion::consulta('SELECT stock FROM productos WHERE id=?', [1])->fetchColumn() !== 0 ||
    (int) Conexion::consulta('SELECT COUNT(*) FROM pedidos')->fetchColumn() !== 1
) {
    throw new RuntimeException('Falló la exclusión concurrente de stock.');
}
echo "OK dos compradores concurrentes: un pedido aceptado, uno rechazado, stock final cero.\nBase aislada conservada: " .
    $nombre .
    PHP_EOL;
