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

    public function responder(): void
    {
        $administrador = AuthMiddleware::exigir(['administrador']);

        postAccion(function () use ($administrador): string {
            (new MensajeModel())->responder(
                Validador::entero($_POST, 'id'),
                (int) $administrador['id'],
                Validador::texto($_POST, 'respuesta', 3, 5000)
            );

            return 'Respuesta guardada. El cliente puede consultarla desde su cuenta o enlace privado.';
        }, 'admin/mensajes');
    }

    public function eliminar(): void
    {
        postAccion(function (): void {
            (new MensajeModel())->eliminar(Validador::entero($_POST, 'id'));
        }, 'admin/mensajes');
    }
}
