<?php

declare(strict_types = 1);

final class Validador
{
    public static function texto(array $datos, string $campo, int $minimo, int $maximo): string
    {
        $valor = $datos[$campo] ?? null;
        if (!is_string($valor)) {
            throw new DomainException('Campo inválido: ' . $campo);
        }
        $valor = trim($valor);
        $longitud = preg_match_all('/./us', $valor);
        if (
            $longitud === false ||
            $longitud < $minimo ||
            $longitud > $maximo ||
            preg_match('/[\x00-\x08\x0B\x0C\x0E-\x1F]/', $valor)
        ) {
            throw new DomainException(
                'Revisa el campo ' . $campo . ' (' . $minimo . '–' . $maximo . ' caracteres).'
            );
        }
        return $valor;
    }

    public static function entero(
        array $datos,
        string $campo,
        int $minimo = 1,
        int $maximo = 2147483647
    ): int {
        $valor = filter_var($datos[$campo] ?? null, FILTER_VALIDATE_INT, [
            'options' => ['min_range' => $minimo, 'max_range' => $maximo]
        ]);
        if ($valor === false) {
            throw new DomainException('Número inválido: ' . $campo);
        }
        return $valor;
    }

    public static function opcion(array $datos, string $campo, array $opciones): string
    {
        $valor = self::texto($datos, $campo, 1, 40);
        if (!in_array($valor, $opciones, true)) {
            throw new DomainException('Selección inválida: ' . $campo);
        }
        return $valor;
    }

    public static function correo(array $datos): string
    {
        $valor = strtolower(self::texto($datos, 'correo', 3, 190));
        if (!filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            throw new DomainException('Correo inválido.');
        }
        return $valor;
    }

    public static function nombre(array $datos): string
    {
        $valor = self::texto($datos, 'nombre', 3, 120);
        if (
            !preg_match(
                "/^[\\p{L}][\\p{L}\\p{M}]*(?:[ '\x{2019}-][\\p{L}][\\p{L}\\p{M}]*)*$/uD",
                $valor
            )
        ) {
            throw new DomainException(
                'El nombre solo admite letras, espacios, apóstrofes y guiones; no admite números.'
            );
        }
        return $valor;
    }

    public static function clave(array $datos, string $campo = 'clave'): string
    {
        $valor = $datos[$campo] ?? null;
        if (
            !is_string($valor) ||
            str_contains($valor, "\0") ||
            ($longitud = preg_match_all('/./us', $valor)) === false ||
            $longitud < 8 ||
            strlen($valor) > 72
        ) {
            throw new DomainException(
                'La contraseña debe tener al menos 8 caracteres válidos y no superar 72 bytes.'
            );
        }
        return $valor;
    }

    public static function precio(array $datos): string
    {
        $valor = self::texto($datos, 'precio', 1, 12);
        if (!preg_match('/^\d{1,6}(\.\d{1,2})?$/D', $valor) || centavos($valor) < 1) {
            throw new DomainException(
                'Precio inválido. Usa punto decimal y un importe mayor que cero.'
            );
        }
        return decimal(centavos($valor));
    }

    public static function persona(array $datos): array
    {
        $usuario = self::texto($datos, 'usuario', 3, 40);
        if (!preg_match('/^[a-zA-Z0-9_.-]+$/D', $usuario)) {
            throw new DomainException(
                'El usuario solo admite letras, números, punto, guion y guion bajo.'
            );
        }
        $telefono = self::texto($datos, 'telefono', 0, 25);
        if ($telefono !== '' && !preg_match('/^[+0-9 ()-]{6,25}$/D', $telefono)) {
            throw new DomainException('Teléfono inválido.');
        }
        return [
            'nombre' => self::nombre($datos),
            'usuario' => $usuario,
            'correo' => self::correo($datos),
            'telefono' => $telefono,
            'direccion' => self::texto($datos, 'direccion', 0, 250)
        ];
    }

    public static function fecha(mixed $valor): bool
    {
        if (!is_string($valor) || !preg_match('/^\d{4}-\d{2}-\d{2}$/D', $valor)) {
            return false;
        }
        [$y, $m, $datos] = array_map('intval', explode('-', $valor));
        return checkdate($m, $datos, $y);
    }
}
