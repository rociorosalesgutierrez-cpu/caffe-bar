<?php
declare(strict_types=1);
final class Config
{
    public static function db(): array
    {
        if(getenv('CAFEBAR_DSN'))return ['dsn'=>getenv('CAFEBAR_DSN'),'usuario'=>getenv('CAFEBAR_DB_USER')?:'cafebar','clave'=>getenv('CAFEBAR_DB_PASSWORD')?:''];
        $file=__DIR__.'/local.php';
        return is_file($file) ? require $file : [
            'dsn'=>getenv('CAFEBAR_DSN') ?: 'mysql:host=127.0.0.1;dbname=cafebar_mvc;charset=utf8mb4',
            'usuario'=>getenv('CAFEBAR_DB_USER') ?: 'cafebar',
            'clave'=>getenv('CAFEBAR_DB_PASSWORD') ?: '',
        ];
    }
}
