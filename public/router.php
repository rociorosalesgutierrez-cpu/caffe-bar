<?php
declare(strict_types=1);
$path=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)?:'/';
if(preg_match('~^/(css/[a-z-]+\.css|js/[a-z-]+\.js|fonts/[a-z-]+\.ttf|images/[a-z-]+\.(?:svg|png)|uploads/productos/[a-f0-9]{40}\.jpg|uploads/musica/[a-f0-9]{40}\.(?:mp3|ogg|wav))$~D',$path)&&is_file(__DIR__.$path))return false;
$_SERVER['SCRIPT_NAME']='/index.php';require __DIR__.'/index.php';
