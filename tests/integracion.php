<?php

declare(strict_types = 1);

if (PHP_SAPI !== 'cli') {
    exit(1);
}
require dirname(__DIR__) . '/app/helpers/Funciones.php';
function comprobar(bool $ok, string $nombre): void
{
    if (!$ok) {
        throw new RuntimeException($nombre);
    }
    echo 'OK ' . $nombre . PHP_EOL;
}
function rechazar(callable $fn, string $nombre): void
{
    try {
        $fn();
    } catch (DomainException | PDOException) {
        echo 'OK ' . $nombre . PHP_EOL;
        return;
    }
    throw new RuntimeException('No se rechazó: ' . $nombre);
}
$admin = new PDO(
    getenv('CAFEBAR_TEST_DSN') ?: 'mysql:host=127.0.0.1;charset=utf8mb4',
    getenv('CAFEBAR_TEST_USER') ?: 'root',
    getenv('CAFEBAR_TEST_PASSWORD') ?: '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false]
);
$nombre = 'cafebar_test_' . bin2hex(random_bytes(5));
$sql = str_replace(
    'cafebar_mvc',
    $nombre,
    file_get_contents(dirname(__DIR__) . '/database/cafebar_mvc.sql')
);
foreach (preg_split('/;\s*(?:\r?\n|$)/', $sql) as $statement) {
    if (trim($statement) !== '') {
        $admin->prepare($statement)->execute();
    }
}
$conf = [
    'dsn' => 'mysql:host=127.0.0.1;dbname=' . $nombre . ';charset=utf8mb4',
    'usuario' => getenv('CAFEBAR_TEST_USER') ?: 'root',
    'clave' => getenv('CAFEBAR_TEST_PASSWORD') ?: ''
];
putenv('CAFEBAR_DSN=' . $conf['dsn']);
putenv('CAFEBAR_DB_USER=' . $conf['usuario']);
putenv('CAFEBAR_DB_PASSWORD=' . $conf['clave']);
$db = Conexion::obtener();
$usuarios = new UsuarioModel();
$pedidos = new PedidoModel();
foreach (['admin', 'empleado', 'cliente'] as $usuario) {
    comprobar((bool) $usuarios->autenticar($usuario, 'CafeBar2026!'), 'autenticación ' . $usuario);
}
comprobar(!$usuarios->autenticar('admin', "' OR 1=1 --"), 'inyección no autentica');
rechazar(fn() => Validador::entero(['id' => '1 OR 1=1'], 'id'), 'validación de identificadores');
$stock = (int) Conexion::consulta('SELECT stock FROM productos WHERE id=?', [1])->fetchColumn();
$token = bin2hex(random_bytes(32));
$id = $pedidos->crear(3, [1 => 2, 4 => 1], $token);
$pedido = $pedidos->detalle($id, 3);
comprobar($pedido['total'] === '39.00', 'precio oficial y total exacto');
comprobar(
    (int) Conexion::consulta('SELECT stock FROM productos WHERE id=?', [1])->fetchColumn() ===
        $stock - 2,
    'descuento de stock'
);
comprobar($pedidos->crear(3, [1 => 2, 4 => 1], $token) === $id, 'confirmación idempotente');
rechazar(
    fn() => $pedidos->crear(3, [1 => 1, 6 => 99], bin2hex(random_bytes(32))),
    'stock insuficiente revierte todo'
);
comprobar(
    (int) Conexion::consulta('SELECT stock FROM productos WHERE id=?', [1])->fetchColumn() ===
        $stock - 2,
    'rollback conserva stock'
);
comprobar(
    (int) Conexion::consulta('SELECT COUNT(*) FROM pedidos')->fetchColumn() === 1,
    'rollback no crea cabecera parcial'
);
rechazar(
    fn() => $pedidos->crear(2, [1 => 1], bin2hex(random_bytes(32))),
    'empleado no compra como cliente'
);
$pedidos->estado($id, 'cancelado');
$pedidos->estado($id, 'cancelado');
comprobar(
    (int) Conexion::consulta('SELECT stock FROM productos WHERE id=?', [1])->fetchColumn() ===
        $stock,
    'cancelación repone stock una sola vez'
);
rechazar(fn() => $pedidos->estado($id, 'preparando'), 'estado final protegido');
rechazar(fn() => (new CategoriaModel())->eliminar(1), 'categoría con productos no se elimina');
rechazar(fn() => (new ProductoModel())->eliminar(1), 'historial de productos vendido protegido');
$d = Validador::persona([
    'nombre' => 'Administrador',
    'usuario' => 'admin',
    'correo' => 'admin@cafebar.test',
    'telefono' => '',
    'direccion' => ''
]);
Conexion::consulta('UPDATE usuarios SET estado=0 WHERE usuario=?', ['jaqueline']);
rechazar(fn() => $usuarios->guardar($d, 'empleado', 1, 1), 'último administrador activo protegido');
rechazar(
    fn() => $usuarios->perfil(
        3,
        Validador::persona($usuarios->buscar(3)),
        'incorrecta',
        'NuevaClave2026!'
    ),
    'cambio de clave exige actual'
);
$usuarios->perfil(3, Validador::persona($usuarios->buscar(3)), 'CafeBar2026!', 'NuevaClave2026!');
comprobar((bool) $usuarios->autenticar('cliente', 'NuevaClave2026!'), 'cambio de clave verificado');
$usuarios->guardar(
    Validador::persona([
        'nombre' => 'Otro cliente',
        'usuario' => 'otro',
        'correo' => 'otro@example.test',
        'telefono' => '',
        'direccion' => ''
    ]),
    'cliente',
    1,
    null,
    'OtroCliente2026!'
);
$otroId = (int) Conexion::consulta('SELECT id FROM usuarios WHERE usuario=?', [
    'otro'
])->fetchColumn();
rechazar(fn() => $pedidos->detalle($id, $otroId), 'aislamiento de pedidos entre clientes');
echo 'Base aislada conservada: ' . $nombre . PHP_EOL;
