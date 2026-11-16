<?php

declare(strict_types = 1);

require dirname(__DIR__) . '/app/helpers/Funciones.php';

$casos = [
    '0.00' => 'CERO 00/100 BOLIVIANOS',
    '21.50' => 'VEINTIÚN 50/100 BOLIVIANOS',
    '100.00' => 'CIEN 00/100 BOLIVIANOS',
    '101.01' => 'CIENTO UN 01/100 BOLIVIANOS',
    '999.99' => 'NOVECIENTOS NOVENTA Y NUEVE 99/100 BOLIVIANOS',
    '1000.00' => 'MIL 00/100 BOLIVIANOS',
    '1250.50' => 'MIL DOSCIENTOS CINCUENTA 50/100 BOLIVIANOS',
    '1000000.00' => 'UN MILLÓN 00/100 BOLIVIANOS'
];

foreach ($casos as $importe => $esperado) {
    if (ImporteLiteral::bolivianos($importe) !== $esperado) {
        throw new RuntimeException('Importe literal incorrecto: ' . $importe);
    }
    echo 'OK importe literal ' . $importe . PHP_EOL;
}
