<?php
declare(strict_types=1);
final class Validador
{
    public static function texto(array $d,string $k,int $min,int $max): string {
        $v=$d[$k]??null;
        if(!is_string($v))throw new DomainException('Campo inválido: '.$k);
        $v=trim($v);
        $longitud=preg_match_all('/./us',$v);
        if($longitud===false||$longitud<$min||$longitud>$max||preg_match('/[\x00-\x08\x0B\x0C\x0E-\x1F]/',$v))throw new DomainException('Revisa el campo '.$k.' ('.$min.'–'.$max.' caracteres).');
        return $v;
    }
    public static function entero(array $d,string $k,int $min=1,int $max=2147483647): int {
        $v=filter_var($d[$k]??null,FILTER_VALIDATE_INT,['options'=>['min_range'=>$min,'max_range'=>$max]]);
        if($v===false)throw new DomainException('Número inválido: '.$k);return $v;
    }
    public static function opcion(array $d,string $k,array $opciones): string {
        $v=self::texto($d,$k,1,40);if(!in_array($v,$opciones,true))throw new DomainException('Selección inválida: '.$k);return $v;
    }
    public static function correo(array $d): string {
        $v=strtolower(self::texto($d,'correo',3,190));if(!filter_var($v,FILTER_VALIDATE_EMAIL))throw new DomainException('Correo inválido.');return $v;
    }
    public static function clave(array $d,string $k='clave'): string {
        $v=$d[$k]??null;if(!is_string($v)||strlen($v)<12||strlen($v)>72)throw new DomainException('La contraseña debe tener entre 12 y 72 bytes.');return $v;
    }
    public static function precio(array $d): string {
        $v=self::texto($d,'precio',1,12);
        if(!preg_match('/^\d{1,6}(\.\d{1,2})?$/D',$v)||centavos($v)<1)throw new DomainException('Precio inválido. Usa punto decimal y un importe mayor que cero.');
        return decimal(centavos($v));
    }
    public static function persona(array $d): array {
        $usuario=self::texto($d,'usuario',3,40);
        if(!preg_match('/^[a-zA-Z0-9_.-]+$/D',$usuario))throw new DomainException('El usuario solo admite letras, números, punto, guion y guion bajo.');
        $telefono=self::texto($d,'telefono',0,25);
        if($telefono!==''&&!preg_match('/^[+0-9 ()-]{6,25}$/D',$telefono))throw new DomainException('Teléfono inválido.');
        return ['nombre'=>self::texto($d,'nombre',3,120),'usuario'=>$usuario,'correo'=>self::correo($d),'telefono'=>$telefono,'direccion'=>self::texto($d,'direccion',0,250)];
    }
    public static function fecha(mixed $v): bool {
        if(!is_string($v)||!preg_match('/^\d{4}-\d{2}-\d{2}$/D',$v))return false;
        [$y,$m,$d]=array_map('intval',explode('-',$v));
        return checkdate($m,$d,$y);
    }
}
