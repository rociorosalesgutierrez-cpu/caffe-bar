<?php

declare(strict_types = 1);

final class Autocargador
{
    private static bool $registrado = false;

    public static function registrar(): void
    {
        if (self::$registrado) {
            return;
        }

        spl_autoload_register([self::class, 'cargar']);
        self::$registrado = true;
    }

    public static function cargar(string $clase): void
    {
        if (!preg_match('/^[A-Za-z]+$/D', $clase)) {
            return;
        }

        $raiz = dirname(__DIR__);
        $carpetas = ['core', 'app/config', 'app/helpers', 'app/models', 'app/controllers'];

        foreach ($carpetas as $carpeta) {
            $archivo = $raiz . '/' . $carpeta . '/' . $clase . '.php';

            if (is_file($archivo)) {
                require_once $archivo;
                return;
            }
        }
    }
}
