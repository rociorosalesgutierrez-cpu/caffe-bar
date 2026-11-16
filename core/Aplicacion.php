<?php

declare(strict_types = 1);

final class Aplicacion
{
    public function ejecutar(): void
    {
        $this->prepararSesion();
        $ruta = $this->rutaActual();
        $this->enviarEncabezados($ruta);

        try {
            $enrutador = new Enrutador(require __DIR__ . '/rutas.php');
            $enrutador->despachar($_SERVER['REQUEST_METHOD'], $ruta);
        } catch (DomainException $error) {
            if (http_response_code() < 400) {
                http_response_code(422);
            }

            if ($ruta === '/mis-pedidos/estado') {
                jsonRespuesta(['error' => $error->getMessage()], http_response_code());
            }

            vista('publico/error', ['mensaje' => $error->getMessage()]);
        } catch (JsonException $error) {
            http_response_code(422);
            vista('publico/error', ['mensaje' => 'El carrito contiene un formato inválido.']);
        } catch (Throwable $error) {
            error_log((string) $error);
            http_response_code(500);

            if (in_array($ruta, ['/admin/indicadores', '/mis-pedidos/estado'], true)) {
                jsonRespuesta(['error' => 'Servicio no disponible.'], 500);
            }

            vista('publico/error', [
                'mensaje' =>
                    'No se pudo completar la solicitud. Revisa la conexión o el registro del servidor.'
            ]);
        }
    }

    private function prepararSesion(): void
    {
        ini_set('display_errors', '0');
        ini_set('session.use_strict_mode', '1');
        ini_set('session.use_only_cookies', '1');

        $almacenamiento = dirname(__DIR__) . '/storage';

        foreach (['sessions', 'limites', 'tmp'] as $carpeta) {
            $ruta = $almacenamiento . '/' . $carpeta;

            if (!is_dir($ruta) && !mkdir($ruta, 0700, true) && !is_dir($ruta)) {
                http_response_code(503);
                exit('No se pudo preparar el almacenamiento privado.');
            }
        }

        session_save_path($almacenamiento . '/sessions');
        session_name('cafebar_session');
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => BASE_URL ?: '/',
            'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        if (!session_start()) {
            http_response_code(503);
            exit('No se pudo iniciar la sesión.');
        }
    }

    private function rutaActual(): string
    {
        $direccion = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
        $direccion = rawurldecode($direccion);
        $direccion = substr($direccion, strlen(BASE_URL));

        return '/' . trim($direccion, '/');
    }

    private function enviarEncabezados(string $ruta): void
    {
        $youtubePermitido = $ruta === '/admin/musica/reproductor';
        $scriptsPermitidos = "'self'";
        $marcosPermitidos = 'https://maps.google.com https://www.google.com';

        if ($youtubePermitido) {
            $scriptsPermitidos .= ' https://www.youtube.com https://s.ytimg.com';
            $marcosPermitidos .= ' https://www.youtube.com https://www.youtube-nocookie.com';
        }

        header(
            "Content-Security-Policy: default-src 'self'; script-src $scriptsPermitidos; " .
                "style-src 'self'; font-src 'self'; img-src 'self' data:; media-src 'self'; " .
                "frame-src $marcosPermitidos; object-src 'none'; base-uri 'self'; " .
                "frame-ancestors 'none'; form-action 'self'"
        );
        header('X-Content-Type-Options: nosniff');
        header('Referrer-Policy: same-origin');
        header('Cache-Control: no-store');
    }
}
