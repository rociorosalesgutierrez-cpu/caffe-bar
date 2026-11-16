<?php

declare(strict_types = 1);

final class ConsultaController
{
    public function mias(): void
    {
        $usuario = AuthMiddleware::exigir();

        vista('publico/mensajes', [
            'mensajes' => (new MensajeModel())->mios((int) $usuario['id']),
            'privada' => false
        ]);
    }

    public function privada(): void
    {
        try {
            $token = Validador::texto($_GET, 'token', 64, 64);
            $mensaje = (new MensajeModel())->porToken($token);
        } catch (DomainException $error) {
            http_response_code(404);
            throw $error;
        }

        vista('publico/mensajes', ['mensajes' => [$mensaje], 'privada' => true]);
    }
}
