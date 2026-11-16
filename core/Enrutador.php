<?php

declare(strict_types = 1);

final class Enrutador
{
    private array $rutas;

    public function __construct(array $rutas)
    {
        $this->rutas = $rutas;
    }

    public function despachar(string $metodoHttp, string $direccion): void
    {
        $destino = $this->rutas[$metodoHttp . ' ' . $direccion] ?? null;

        if ($destino === null) {
            http_response_code(404);
            vista('publico/error', ['mensaje' => 'La página solicitada no existe.']);
            return;
        }

        $claseControlador = $destino[0];
        $metodo = $destino[1];
        $controlador = new $claseControlador();
        $controlador->$metodo();
    }
}
