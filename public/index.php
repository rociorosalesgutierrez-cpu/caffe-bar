<?php

declare(strict_types = 1);

define('BASE_URL', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/.'));

require_once dirname(__DIR__) . '/core/inicio.php';
require_once dirname(__DIR__) . '/app/helpers/Funciones.php';

$aplicacion = new Aplicacion();
$aplicacion->ejecutar();
