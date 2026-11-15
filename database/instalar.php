<?php
declare(strict_types=1);
if(PHP_SAPI!=='cli')exit(1);
$dsn=getenv('CAFEBAR_INSTALL_DSN')?:'mysql:host=127.0.0.1;charset=utf8mb4';
$pdo=new PDO($dsn,getenv('CAFEBAR_INSTALL_USER')?:'root',getenv('CAFEBAR_INSTALL_PASSWORD')?:'',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES=>false]);
$q=$pdo->prepare('SELECT COUNT(*) FROM information_schema.schemata WHERE schema_name=?');$q->execute(['cafebar_mvc']);
$existe=(bool)$q->fetchColumn();
if($existe&&!in_array('--config-only',$argv,true)){fwrite(STDERR,"La base cafebar_mvc ya existe. No se modifica. Usa --config-only para conectar una instalación existente.\n");exit(1);}
if(is_file(dirname(__DIR__).'/app/config/local.php')){fwrite(STDERR,"Ya existe local.php. Se conserva sin cambios.\n");exit(1);}
if(!$existe){
    $sql=file_get_contents(__DIR__.'/cafebar_mvc.sql');
    foreach(preg_split('/;\s*(?:\r?\n|$)/',$sql) as $statement){if(trim($statement)!=='')$pdo->prepare($statement)->execute();}
}
$usuario='cafebar_'.bin2hex(random_bytes(4));$clave=bin2hex(random_bytes(24));
$pdo->prepare("CREATE USER '".$usuario."'@'127.0.0.1' IDENTIFIED BY ".$pdo->quote($clave))->execute();
$pdo->prepare("GRANT SELECT,INSERT,UPDATE,DELETE ON cafebar_mvc.* TO '".$usuario."'@'127.0.0.1'")->execute();
$config=['dsn'=>'mysql:host=127.0.0.1;dbname=cafebar_mvc;charset=utf8mb4','usuario'=>$usuario,'clave'=>$clave];
file_put_contents(dirname(__DIR__).'/app/config/local.php',"<?php\ndeclare(strict_types=1);\nreturn ".var_export($config,true).";\n");
echo "Instalación local completada. Base nueva y usuario de aplicación con permisos limitados.\nUsuarios: admin, empleado, cliente. Contraseña de laboratorio: CafeBar2026!\n";
