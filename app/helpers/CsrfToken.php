<?php

declare(strict_types = 1);

final class CsrfToken
{
    public static function valor(): string
    {
        return $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
    }

    public static function campo(): string
    {
        return '<input type="hidden" name="csrf" value="' . e(self::valor()) . '">';
    }

    public static function verificar(): void
    {
        $token = $_POST['csrf'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null);
        if (!is_string($token) || !hash_equals(self::valor(), $token)) {
            http_response_code(403);
            throw new DomainException(
                'Formulario caducado o token CSRF inválido. Recarga la página.'
            );
        }
    }
}
