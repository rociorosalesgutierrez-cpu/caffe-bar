<?php

declare(strict_types = 1);

if (PHP_SAPI !== 'cli') {
    exit(1);
}

require dirname(__DIR__) . '/app/helpers/Funciones.php';

$configuracion = Config::db();
$conexion = new PDO(
    $configuracion['dsn'],
    getenv('CAFEBAR_INSTALL_USER') ?: 'root',
    getenv('CAFEBAR_INSTALL_PASSWORD') ?: '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

$columnas = [
    'usuario_id' => 'INT UNSIGNED NULL',
    'token_hash' => 'CHAR(64) NULL',
    'respuesta' => 'TEXT NULL',
    'respondido_por' => 'INT UNSIGNED NULL',
    'respuesta_fecha' => 'DATETIME NULL'
];

foreach ($columnas as $nombre => $definicion) {
    $consulta = $conexion->prepare(
        'SELECT COUNT(*) FROM information_schema.columns
         WHERE table_schema=DATABASE() AND table_name=? AND column_name=?'
    );
    $consulta->execute(['mensajes_contacto', $nombre]);

    if (!$consulta->fetchColumn()) {
        $conexion->exec('ALTER TABLE mensajes_contacto ADD COLUMN ' . $nombre . ' ' . $definicion);
    }
}

$indices = [
    'contacto_token' => 'UNIQUE KEY contacto_token (token_hash)',
    'contacto_usuario' => 'INDEX contacto_usuario (usuario_id)'
];

foreach ($indices as $nombre => $definicion) {
    $consulta = $conexion->prepare(
        'SELECT COUNT(*) FROM information_schema.statistics
         WHERE table_schema=DATABASE() AND table_name=? AND index_name=?'
    );
    $consulta->execute(['mensajes_contacto', $nombre]);

    if (!$consulta->fetchColumn()) {
        $conexion->exec('ALTER TABLE mensajes_contacto ADD ' . $definicion);
    }
}

$relaciones = [
    'contacto_propietario' => 'FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL',
    'contacto_responsable' =>
        'FOREIGN KEY (respondido_por) REFERENCES usuarios(id) ON DELETE SET NULL'
];

foreach ($relaciones as $nombre => $definicion) {
    $consulta = $conexion->prepare(
        'SELECT COUNT(*) FROM information_schema.table_constraints
         WHERE constraint_schema=DATABASE() AND table_name=? AND constraint_name=?'
    );
    $consulta->execute(['mensajes_contacto', $nombre]);

    if (!$consulta->fetchColumn()) {
        $conexion->exec(
            'ALTER TABLE mensajes_contacto ADD CONSTRAINT ' . $nombre . ' ' . $definicion
        );
    }
}

echo "Mensajes actualizados. Consultas existentes conservadas.\n";
