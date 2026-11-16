<?php

declare(strict_types = 1);

final class MusicaController
{
    private array $usuario;
    public function __construct()
    {
        $this->usuario = AuthMiddleware::exigir();
    }

    public function index(): void
    {
        $cliente = $this->usuario['rol'] === 'cliente';
        $modelo = new MusicaModel();
        vista(
            $cliente ? 'publico/musica' : 'admin/musica',
            [
                'cliente' => $cliente,
                'catalogo' => $modelo->catalogo(!$cliente),
                'solicitudes' => $modelo->solicitudes($cliente ? (int) $this->usuario['id'] : null),
                'estado' => $modelo->estado()
            ],
            !$cliente
        );
    }

    public function sugerir(): void
    {
        AuthMiddleware::exigir(['cliente']);
        postAccion(function (): void {
            $cancion = empty($_POST['cancion_id']) ? null : Validador::entero($_POST, 'cancion_id');
            $titulo = $cancion ? '' : Validador::texto($_POST, 'titulo', 2, 150);
            $artista = $cancion ? '' : Validador::texto($_POST, 'artista', 2, 120);
            $youtube = empty($_POST['youtube'])
                ? null
                : AudioArchivo::youtube(Validador::texto($_POST, 'youtube', 10, 400));
            (new MusicaModel())->sugerir(
                (int) $this->usuario['id'],
                $cancion,
                $titulo,
                $artista,
                $youtube
            );
        }, 'musica');
    }

    public function agregar(): void
    {
        AuthMiddleware::exigir(['administrador', 'empleado']);
        postAccion(function (): void {
            $titulo = Validador::texto($_POST, 'titulo', 2, 150);
            $artista = Validador::texto($_POST, 'artista', 2, 120);
            $fuente = Validador::opcion($_POST, 'fuente', ['archivo', 'youtube']);
            $recurso =
                $fuente === 'youtube'
                    ? AudioArchivo::youtube(Validador::texto($_POST, 'youtube', 10, 400))
                    : AudioArchivo::guardar($_FILES['audio'] ?? []);
            try {
                (new MusicaModel())->agregar($titulo, $artista, $fuente, $recurso);
            } catch (Throwable $e) {
                if ($fuente === 'archivo') {
                    unlink(dirname(__DIR__, 2) . '/public/' . $recurso);
                }
                throw $e;
            }
        }, 'musica');
    }

    public function moderar(): void
    {
        AuthMiddleware::exigir(['administrador', 'empleado']);
        postAccion(function (): void {
            (new MusicaModel())->moderar(
                Validador::entero($_POST, 'id'),
                (int) $this->usuario['id'],
                Validador::opcion($_POST, 'accion', ['aprobar', 'rechazar']) === 'aprobar',
                empty($_POST['cancion_id']) ? null : Validador::entero($_POST, 'cancion_id')
            );
        }, 'musica');
    }

    public function encolar(): void
    {
        AuthMiddleware::exigir(['administrador', 'empleado']);
        postAccion(function (): void {
            (new MusicaModel())->encolar(
                Validador::entero($_POST, 'id'),
                (int) $this->usuario['id']
            );
        }, 'musica');
    }

    public function activar(): void
    {
        AuthMiddleware::exigir(['administrador', 'empleado']);
        postAccion(function (): void {
            (new MusicaModel())->activar(
                Validador::entero($_POST, 'id'),
                Validador::entero($_POST, 'activo', 0, 1)
            );
        }, 'musica');
    }

    public function reproductor(): void
    {
        AuthMiddleware::exigir(['administrador', 'empleado']);
        vista('admin/reproductor', [], true);
    }

    public function estado(): void
    {
        jsonRespuesta((new MusicaModel())->estado());
    }

    public function control(): void
    {
        AuthMiddleware::exigir(['administrador', 'empleado']);
        CsrfToken::verificar();
        try {
            $dispositivo = Validador::texto($_POST, 'dispositivo', 64, 64);
            if (!preg_match('/^[a-f0-9]{64}$/D', $dispositivo)) {
                throw new DomainException('Identificador de reproductor inválido.');
            }
            $accion = Validador::opcion($_POST, 'accion', ['siguiente', 'latido', 'liberar']);
            $modelo = new MusicaModel();
            if ($accion === 'liberar') {
                $modelo->liberar($dispositivo);
                jsonRespuesta(['ok' => true]);
            }
            if ($accion === 'latido') {
                jsonRespuesta(['ok' => $modelo->latido($dispositivo)]);
            }
            $pista = $modelo->siguiente(
                $dispositivo,
                (int) $this->usuario['id'],
                empty($_POST['finalizada']) ? null : Validador::entero($_POST, 'finalizada'),
                isset($_POST['resultado'])
                    ? Validador::opcion($_POST, 'resultado', ['reproducida', 'omitida'])
                    : 'reproducida'
            );
            if ($pista && $pista['fuente'] === 'archivo') {
                $pista['url'] = url($pista['recurso']);
            }
            jsonRespuesta(['pista' => $pista]);
        } catch (DomainException $e) {
            jsonRespuesta(['error' => $e->getMessage()], 409);
        }
    }
}
