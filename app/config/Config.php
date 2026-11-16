<?php

declare(strict_types = 1);

final class Config
{
    public static function db(): array
    {
        if (getenv('CAFEBAR_DSN')) {
            return [
                'dsn' => getenv('CAFEBAR_DSN'),
                'usuario' => getenv('CAFEBAR_DB_USER') ?: 'cafebar',
                'clave' => getenv('CAFEBAR_DB_PASSWORD') ?: ''
            ];
        }
        $archivoConfiguracion = __DIR__ . '/local.php';
        if (is_file($archivoConfiguracion)) {
            return require $archivoConfiguracion;
        }

        return [
            'dsn' => getenv('CAFEBAR_DSN') ?: 'mysql:host=127.0.0.1;dbname=cafebar_mvc;charset=utf8mb4',
            'usuario' => getenv('CAFEBAR_DB_USER') ?: 'cafebar',
            'clave' => getenv('CAFEBAR_DB_PASSWORD') ?: ''
        ];
    }
}
