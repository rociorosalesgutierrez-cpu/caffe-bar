<?php

declare(strict_types = 1);

final class MensajeController
{
    public function __construct()
    {
        AuthMiddleware::exigir(['administrador']);
    }

    public function index(): void
    {
        vista('admin/mensajes', ['mensajes' => (new MensajeModel())->listar()], true);
    }

    public function estado(): void
    {
        postAccion(function (): void {
            (new MensajeModel())->estado(
                Validador::entero($_POST, 'id'),
                Validador::opcion($_POST, 'estado', ['nuevo', 'leido', 'respondido'])
            );
        }, 'admin/mensajes');
    }

    public function eliminar(): void
    {
        postAccion(function (): void {
            (new MensajeModel())->eliminar(Validador::entero($_POST, 'id'));
        }, 'admin/mensajes');
    }
}
