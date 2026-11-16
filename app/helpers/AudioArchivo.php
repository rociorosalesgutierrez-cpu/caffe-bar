<?php

declare(strict_types = 1);

final class AudioArchivo
{
    public static function guardar(array $f): string
    {
        if (
            !isset($f['error']) ||
            is_array($f['error']) ||
            $f['error'] !== UPLOAD_ERR_OK ||
            ($f['size'] ?? 0) < 44 ||
            $f['size'] > 20 * 1024 * 1024
        ) {
            throw new DomainException('Sube un archivo MP3, OGG o WAV de hasta 20 MB.');
        }
        if (!is_uploaded_file($f['tmp_name'])) {
            throw new DomainException('Origen de archivo inválido.');
        }
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
        $tipos = [
            'audio/mpeg' => 'mp3',
            'audio/mp3' => 'mp3',
            'audio/ogg' => 'ogg',
            'application/ogg' => 'ogg',
            'audio/x-wav' => 'wav',
            'audio/wav' => 'wav',
            'audio/vnd.wave' => 'wav'
        ];
        if (!isset($tipos[$mime])) {
            throw new DomainException('El archivo no es un audio MP3, OGG o WAV reconocido.');
        }
        $dir = dirname(__DIR__, 2) . '/public/uploads/musica';
        if (!is_dir($dir) && !mkdir($dir, 0750, true) && !is_dir($dir)) {
            throw new RuntimeException('No se pudo preparar el directorio de música.');
        }
        $ruta = 'uploads/musica/' . bin2hex(random_bytes(20)) . '.' . $tipos[$mime];
        if (!move_uploaded_file($f['tmp_name'], dirname(__DIR__, 2) . '/public/' . $ruta)) {
            throw new RuntimeException('No se pudo guardar el audio.');
        }
        return $ruta;
    }

    public static function youtube(string $url): string
    {
        $p = parse_url(trim($url));
        if (!$p || ($p['scheme'] ?? '') !== 'https' || isset($p['user']) || isset($p['pass'])) {
            throw new DomainException('Usa un enlace HTTPS de YouTube válido.');
        }
        $host = strtolower($p['host'] ?? '');
        $id = '';
        if ($host === 'youtu.be') {
            $id = trim($p['path'] ?? '', '/');
        } elseif (in_array($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com'], true)) {
            parse_str($p['query'] ?? '', $q);
            if (($p['path'] ?? '') === '/watch') {
                $id = is_string($q['v'] ?? null) ? $q['v'] : '';
            } elseif (
                preg_match('~^/(?:shorts|embed)/([A-Za-z0-9_-]{11})/?$~D', $p['path'] ?? '', $m)
            ) {
                $id = $m[1];
            }
        }
        if (!preg_match('/^[A-Za-z0-9_-]{11}$/D', $id)) {
            throw new DomainException('No se encontró un video de YouTube válido en el enlace.');
        }
        return $id;
    }
}
