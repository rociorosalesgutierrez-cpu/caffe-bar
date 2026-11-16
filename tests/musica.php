<?php

declare(strict_types = 1);

require dirname(__DIR__) . '/app/helpers/Funciones.php';
function ok(bool $v, string $m): void
{
    if (!$v) {
        throw new RuntimeException($m);
    }
    echo 'OK ' . $m . PHP_EOL;
}
function no(callable $f, string $m): void
{
    try {
        $f();
    } catch (DomainException) {
        echo 'OK ' . $m . PHP_EOL;
        return;
    }
    throw new RuntimeException($m);
}
$pdo = new PDO(
    getenv('CAFEBAR_TEST_DSN') ?: 'mysql:host=127.0.0.1;charset=utf8mb4',
    getenv('CAFEBAR_TEST_USER') ?: 'root',
    getenv('CAFEBAR_TEST_PASSWORD') ?: '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false]
);
$db = 'coffe_music_test_' . bin2hex(random_bytes(5));
$sql = str_replace(
    'cafebar_mvc',
    $db,
    file_get_contents(dirname(__DIR__) . '/database/cafebar_mvc.sql')
);
foreach (preg_split('/;\s*(?:\r?\n|$)/', $sql) as $s) {
    if (trim($s) !== '') {
        $pdo->prepare($s)->execute();
    }
}
foreach (
    preg_split('/;\s*(?:\r?\n|$)/', file_get_contents(dirname(__DIR__) . '/database/musica.sql'))
    as $s
) {
    if (trim($s) !== '') {
        $pdo->prepare($s)->execute();
    }
}
putenv('CAFEBAR_DSN=mysql:host=127.0.0.1;dbname=' . $db . ';charset=utf8mb4');
putenv('CAFEBAR_DB_USER=' . (getenv('CAFEBAR_TEST_USER') ?: 'root'));
putenv('CAFEBAR_DB_PASSWORD=' . (getenv('CAFEBAR_TEST_PASSWORD') ?: ''));
$m = new MusicaModel();
$m->agregar('Tema de prueba', 'Artista de prueba', 'youtube', 'abcdefghijk');
$song = (int) Conexion::obtener()->lastInsertId();
no(fn() => $m->sugerir(2, $song, '', '', null), 'empleado no suplanta cliente al sugerir');
$m->sugerir(3, $song, '', '', null);
$s = (int) $m->solicitudes(3)[0]['id'];
no(fn() => $m->sugerir(3, $song, '', '', null), 'duplicado activo rechazado');
ok(count($m->estado()['cola']) === 0, 'pendiente no entra en reproducción');
$m->moderar($s, 1, true, null);
ok(count($m->estado()['cola']) === 1, 'aprobación agrega a la cola');
$device = str_repeat('a', 64);
$other = str_repeat('b', 64);
$track = $m->siguiente($device, 1);
ok((int) $track['id'] === $s, 'prioridad de la sugerencia aprobada');
no(fn() => $m->siguiente($other, 1), 'segundo dispositivo no puede reproducir simultáneamente');
ok($m->latido($device), 'latido mantiene el reproductor');
ok(!$m->latido($other), 'latido de otro dispositivo rechazado');
no(fn() => $m->siguiente($device, 1, 999, 'reproducida'), 'finalización de otra pista rechazada');
$next = $m->siguiente($device, 1, $s, 'reproducida');
ok((int) $next['id'] !== $s, 'continúa catálogo al terminar la cola');
ok(
    Conexion::consulta('SELECT estado FROM musica_sugerencias WHERE id=?', [$s])->fetchColumn() ===
        'reproducida',
    'se conserva historial de reproducción'
);
$m->liberar($device);
ok((bool) $m->siguiente($other, 1), 'liberar permite otro equipo');
$m->liberar($other);
$m->activar($song, 0);
ok($m->siguiente($device, 1) === null, 'catálogo inactivo no se reproduce');
ok(
    AudioArchivo::youtube('https://youtu.be/abcdefghijk') === 'abcdefghijk',
    'YouTube corto validado'
);
no(
    fn() => AudioArchivo::youtube('https://youtube.com.evil.test/watch?v=abcdefghijk'),
    'dominio engañoso rechazado'
);
no(fn() => AudioArchivo::youtube('javascript:alert(1)'), 'URL ejecutable rechazada');
echo 'Base aislada conservada: ' . $db . PHP_EOL;
