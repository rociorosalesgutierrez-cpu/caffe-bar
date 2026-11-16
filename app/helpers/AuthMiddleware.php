<?php

declare(strict_types = 1);

final class AuthMiddleware
{
    public static function usuario(): ?array
    {
        if (empty($_SESSION['uid'])) {
            return null;
        }
        if (
            time() - ($_SESSION['actividad'] ?? 0) > 1800 ||
            time() - ($_SESSION['inicio'] ?? 0) > 28800
        ) {
            self::salir();
            return null;
        }
        $usuario = (new UsuarioModel())->buscar((int) $_SESSION['uid']);
        if (!$usuario || !$usuario['estado']) {
            self::salir();
            return null;
        }
        $_SESSION['actividad'] = time();
        return $usuario;
    }

    public static function exigir(array $roles = []): array
    {
        $usuario = self::usuario();
        if (!$usuario) {
            redirigir('acceder');
        }
        if ($roles && !in_array($usuario['rol'], $roles, true)) {
            http_response_code(403);
            throw new DomainException('No tienes permiso para acceder a este módulo.');
        }
        return $usuario;
    }

    public static function entrar(array $usuario): void
    {
        session_regenerate_id(true);
        $_SESSION = [
            'uid' => $usuario['id'],
            'inicio' => time(),
            'actividad' => time(),
            'csrf' => bin2hex(random_bytes(32))
        ];
    }

    public static function salir(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $parametrosCookie = session_get_cookie_params();
            setcookie(session_name(), '', [
                'expires' => time() - 42000,
                'path' => $parametrosCookie['path'],
                'secure' => $parametrosCookie['secure'],
                'httponly' => true,
                'samesite' => 'Lax'
            ]);
        }
        session_destroy();
        session_start();
        session_regenerate_id(true);
    }
}
