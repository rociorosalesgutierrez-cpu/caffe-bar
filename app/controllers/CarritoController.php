<?php

declare(strict_types = 1);

final class CarritoController
{
    private array $usuario;
    public function __construct()
    {
        $this->usuario = AuthMiddleware::exigir(AuthMiddleware::ROLES_COMPRA);
    }

    public function index(): void
    {
        $_SESSION['pedido_token'] ??= bin2hex(random_bytes(32));
        vista('publico/carrito', ['token' => $_SESSION['pedido_token']]);
    }

    public function confirmar(): void
    {
        CsrfToken::verificar();
        $token = Validador::texto($_POST, 'token', 64, 64);
        if (!hash_equals($_SESSION['pedido_token'] ?? '', $token)) {
            throw new DomainException(
                'Pedido ya procesado o formulario caducado. Consulta Mis pedidos.'
            );
        }
        $items = json_decode(
            Validador::texto($_POST, 'items', 2, 12000),
            true,
            32,
            JSON_THROW_ON_ERROR
        );
        if (!is_array($items)) {
            throw new DomainException('Carrito inválido.');
        }
        $id = (new PedidoModel())->crear((int) $this->usuario['id'], $items, $token);
        unset($_SESSION['pedido_token']);
        $_SESSION['vaciar_carrito'] = true;
        flash('Pedido #' . $id . ' confirmado correctamente.');
        redirigir('mis-pedidos');
    }
}
