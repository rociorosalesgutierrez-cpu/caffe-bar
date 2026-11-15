<?php
declare(strict_types=1);
final class Intentos
{
    public static function registrar(string $grupo,int $limite,int $segundos): void {
        $archivo=dirname(__DIR__,2).'/storage/limites/'.hash('sha256',$grupo.'|'.($_SERVER['REMOTE_ADDR']??'local')).'.json';
        $f=fopen($archivo,'c+');if(!$f)throw new RuntimeException('No se pudo abrir el limitador.');
        try {
            if(!flock($f,LOCK_EX))throw new RuntimeException('No se pudo bloquear el limitador.');
            $d=json_decode(stream_get_contents($f),true)?:['inicio'=>time(),'total'=>0];
            if(time()-$d['inicio']>=$segundos)$d=['inicio'=>time(),'total'=>0];
            if($d['total']>=$limite)throw new DomainException('Demasiados intentos. Vuelve a intentarlo más tarde.');
            $d['total']++;rewind($f);ftruncate($f,0);fwrite($f,json_encode($d,JSON_THROW_ON_ERROR));fflush($f);
        }finally{flock($f,LOCK_UN);fclose($f);}
    }
}
