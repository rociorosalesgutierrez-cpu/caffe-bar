<?php

declare(strict_types = 1);

final class Vista
{
    public static function mostrar(string $archivo, array $datos = [], bool $panel = false): void
    {
        extract($datos, EXTR_SKIP);
        $actual = AuthMiddleware::usuario();
        $aviso = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);

        $plantilla = $panel ? 'admin' : 'publico';
        require dirname(__DIR__) . '/app/views/layouts/' . $plantilla . '.php';
    }
}
