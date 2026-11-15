<?php
declare(strict_types=1);
if(PHP_SAPI!=='cli')exit(1);
require dirname(__DIR__).'/app/helpers/Funciones.php';
$c=Config::db();$pdo=new PDO($c['dsn'],getenv('CAFEBAR_INSTALL_USER')?:'root',getenv('CAFEBAR_INSTALL_PASSWORD')?:'',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES=>false]);
foreach(preg_split('/;\s*(?:\r?\n|$)/',file_get_contents(__DIR__.'/musica.sql')) as $sql){if(trim($sql)!=='')$pdo->prepare($sql)->execute();}
$column=$pdo->prepare('SELECT COUNT(*) FROM information_schema.columns WHERE table_schema=DATABASE() AND table_name=? AND column_name=?');$column->execute(['musica_reproductor','ultima_cancion_id']);
if(!$column->fetchColumn())$pdo->prepare('ALTER TABLE musica_reproductor ADD COLUMN ultima_cancion_id INT UNSIGNED NULL')->execute();
$q=$pdo->prepare('SELECT id FROM usuarios WHERE usuario=?');$q->execute(['jaqueline']);$id=$q->fetchColumn();
if(!$id){
    $pdo->prepare('INSERT INTO usuarios(nombre,usuario,correo,password_hash,rol,estado) VALUES(?,?,?,?,?,1)')->execute(['Jaqueline','jaqueline','jaqueline@cafebar.test',password_hash('jaqui123',PASSWORD_DEFAULT),'administrador']);
    echo "Administradora jaqueline creada con la contraseña solicitada, almacenada como hash.\n";
}else{
    echo "La cuenta jaqueline ya existe y se conserva sin modificar su contraseña ni su rol.\n";
}
echo "Tablas musicales actualizadas sin borrar datos existentes.\n";
