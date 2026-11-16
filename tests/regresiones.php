<?php

declare(strict_types = 1);

require dirname(__DIR__) . '/app/helpers/Funciones.php';
function comprobar(bool $ok, string $mensaje): void
{
    if (!$ok) {
        throw new RuntimeException($mensaje);
    }
    echo 'OK ' . $mensaje . PHP_EOL;
}
comprobar(
    Validador::texto(['nombre' => 'Café ☕'], 'nombre', 6, 6) === 'Café ☕',
    'longitud Unicode sin depender de mbstring'
);
foreach (["\xff", 'demasiado largo'] as $valor) {
    try {
        Validador::texto(['nombre' => $valor], 'nombre', 1, 6);
        throw new RuntimeException('Texto inválido aceptado');
    } catch (DomainException) {
        echo 'OK texto inválido rechazado' . PHP_EOL;
    }
}
comprobar(
    Imagen::producto(['nombre' => 'Sándwich vegetariano', 'imagen' => 'images/sandwich.svg']) ===
        'images/sandwich-vegetariano.jpg',
    'foto real para catálogo anterior'
);
comprobar(
    Imagen::producto([
        'nombre' => 'Producto propio',
        'imagen' => 'uploads/productos/personalizada.jpg'
    ]) === 'uploads/productos/personalizada.jpg',
    'foto cargada conservada'
);
