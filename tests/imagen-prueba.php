<?php

declare(strict_types = 1);

if (PHP_SAPI !== 'cli' || empty($argv[1])) {
    exit(1);
}
$imagen = imagecreatetruecolor(32, 32);
imagefill($imagen, 0, 0, imagecolorallocate($imagen, 200, 125, 85));
imagepng($imagen, $argv[1]);
imagedestroy($imagen);
