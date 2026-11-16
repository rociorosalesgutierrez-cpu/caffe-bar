<?php

declare(strict_types = 1);

final class ImporteLiteral
{
    public static function bolivianos(string $importe): string
    {
        $total = centavos($importe);
        $entero = intdiv($total, 100);
        $decimal = str_pad((string) ($total % 100), 2, '0', STR_PAD_LEFT);

        return self::entero($entero) . ' ' . $decimal . '/100 BOLIVIANOS';
    }

    private static function entero(int $numero): string
    {
        $primeros = [
            'CERO',
            'UN',
            'DOS',
            'TRES',
            'CUATRO',
            'CINCO',
            'SEIS',
            'SIETE',
            'OCHO',
            'NUEVE',
            'DIEZ',
            'ONCE',
            'DOCE',
            'TRECE',
            'CATORCE',
            'QUINCE',
            'DIECISÉIS',
            'DIECISIETE',
            'DIECIOCHO',
            'DIECINUEVE',
            'VEINTE',
            'VEINTIÚN',
            'VEINTIDÓS',
            'VEINTITRÉS',
            'VEINTICUATRO',
            'VEINTICINCO',
            'VEINTISÉIS',
            'VEINTISIETE',
            'VEINTIOCHO',
            'VEINTINUEVE'
        ];

        if ($numero < 30) {
            return $primeros[$numero];
        }

        if ($numero < 100) {
            $decenas = [
                '',
                '',
                '',
                'TREINTA',
                'CUARENTA',
                'CINCUENTA',
                'SESENTA',
                'SETENTA',
                'OCHENTA',
                'NOVENTA'
            ];
            $texto = $decenas[intdiv($numero, 10)];
            $resto = $numero % 10;

            return $resto === 0 ? $texto : $texto . ' Y ' . self::entero($resto);
        }

        if ($numero === 100) {
            return 'CIEN';
        }

        if ($numero < 1000) {
            $centenas = [
                '',
                'CIENTO',
                'DOSCIENTOS',
                'TRESCIENTOS',
                'CUATROCIENTOS',
                'QUINIENTOS',
                'SEISCIENTOS',
                'SETECIENTOS',
                'OCHOCIENTOS',
                'NOVECIENTOS'
            ];
            $texto = $centenas[intdiv($numero, 100)];
            $resto = $numero % 100;

            return $resto === 0 ? $texto : $texto . ' ' . self::entero($resto);
        }

        if ($numero < 1000000) {
            $miles = intdiv($numero, 1000);
            $texto = $miles === 1 ? 'MIL' : self::entero($miles) . ' MIL';
            $resto = $numero % 1000;

            return $resto === 0 ? $texto : $texto . ' ' . self::entero($resto);
        }

        $millones = intdiv($numero, 1000000);
        $texto = $millones === 1 ? 'UN MILLÓN' : self::entero($millones) . ' MILLONES';
        $resto = $numero % 1000000;

        return $resto === 0 ? $texto : $texto . ' ' . self::entero($resto);
    }
}
