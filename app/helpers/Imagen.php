<?php

declare(strict_types = 1);

final class Imagen
{
    public static function producto(array $producto): string
    {
        $ruta = $producto['imagen'] ?? '';
        if (
            $ruta !== '' &&
            !in_array(
                $ruta,
                ['images/cafe.svg', 'images/jugo.svg', 'images/postre.svg', 'images/sandwich.svg'],
                true
            )
        ) {
            return $ruta;
        }
        $nombre = strtolower(
            strtr($producto['nombre'], [
                'á' => 'a',
                'é' => 'e',
                'í' => 'i',
                'ó' => 'o',
                'ú' => 'u',
                'Á' => 'a',
                'É' => 'e',
                'Í' => 'i',
                'Ó' => 'o',
                'Ú' => 'u'
            ])
        );
        $fotos = [
            'espresso' => 'espresso',
            'capuchino' => 'capuchino',
            'latte' => 'latte',
            'naranja' => 'jugo-naranja',
            'jugo de frutos' => 'jugo-frutos-rojos',
            'chocolate' => 'torta-chocolate',
            'cheesecake' => 'cheesecake',
            'pollo' => 'sandwich-pollo',
            'vegetariano' => 'sandwich-vegetariano'
        ];
        foreach ($fotos as $palabra => $foto) {
            if (str_contains($nombre, $palabra)) {
                return 'images/' . $foto . '.jpg';
            }
        }
        return match ($ruta) {
            'images/jugo.svg' => 'images/jugo-naranja.jpg',
            'images/postre.svg' => 'images/torta-chocolate.jpg',
            'images/sandwich.svg' => 'images/sandwich-pollo.jpg',
            default => 'images/espresso.jpg'
        };
    }

    public static function guardar(array $archivo): ?string
    {
        if (($archivo['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return null;
        }
        if (
            !isset($archivo['error']) ||
            is_array($archivo['error']) ||
            $archivo['error'] !== UPLOAD_ERR_OK ||
            ($archivo['size'] ?? 0) > 4 * 1024 * 1024
        ) {
            throw new DomainException(
                'La imagen no debe superar 4 MB y debe subirse correctamente.'
            );
        }
        if (!is_uploaded_file($archivo['tmp_name'])) {
            throw new DomainException('Archivo de imagen inválido.');
        }
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($archivo['tmp_name']);
        $info = getimagesize($archivo['tmp_name']);
        if (
            !in_array($mime, ['image/jpeg', 'image/png', 'image/webp'], true) ||
            !$info ||
            $info[0] > 3000 ||
            $info[1] > 3000
        ) {
            throw new DomainException(
                'Usa una imagen JPG, PNG o WebP de hasta 3000 × 3000 píxeles.'
            );
        }
        $original = imagecreatefromstring(file_get_contents($archivo['tmp_name']));
        if (!$original) {
            throw new DomainException('No se pudo decodificar la imagen.');
        }
        $nueva = imagecreatetruecolor($info[0], $info[1]);
        imagefill($nueva, 0, 0, imagecolorallocate($nueva, 250, 246, 240));
        imagecopy($nueva, $original, 0, 0, 0, 0, $info[0], $info[1]);
        $ruta = 'uploads/productos/' . bin2hex(random_bytes(20)) . '.jpg';
        try {
            if (!imagejpeg($nueva, dirname(__DIR__, 2) . '/public/' . $ruta, 85)) {
                throw new RuntimeException('No se pudo almacenar la imagen.');
            }
        } finally {
            imagedestroy($original);
            imagedestroy($nueva);
        }
        return $ruta;
    }

    public static function quitar(?string $ruta): void
    {
        if ($ruta && preg_match('~^uploads/productos/[a-f0-9]{40}\.jpg$~D', $ruta)) {
            $file = dirname(__DIR__, 2) . '/public/' . $ruta;
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
}
