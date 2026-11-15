<?php
declare(strict_types=1);
final class Conexion
{
    public static function obtener(): PDO
    {
        static $pdo;
        if (!$pdo) {
            $c=Config::db();
            $pdo=new PDO($c['dsn'],$c['usuario'],$c['clave'],[
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES=>false,
            ]);
            $pdo->prepare("SET time_zone = '+00:00'")->execute();
        }
        return $pdo;
    }
    public static function consulta(string $sql,array $datos=[]): PDOStatement
    {
        $q=self::obtener()->prepare($sql);$q->execute($datos);return $q;
    }
}
