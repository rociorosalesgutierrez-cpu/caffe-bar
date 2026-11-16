<?php

declare(strict_types = 1);

final class UsuarioController
{
    private array $usuario;
    public function __construct()
    {
        $this->usuario = AuthMiddleware::exigir(['administrador']);
    }

    public function index(): void
    {
        $modelo = new UsuarioModel();
        $busqueda = isset($_GET['q']) ? Validador::texto($_GET, 'q', 0, 120) : '';
        $usuarioEditar = null;

        if (isset($_GET['editar'])) {
            $id = Validador::entero($_GET, 'editar');
            $usuarioEditar = $modelo->buscar($id);
        }

        vista(
            'admin/usuarios',
            [
                'usuarios' => $modelo->listar($busqueda),
                'editar' => $usuarioEditar,
                'q' => $busqueda
            ],
            true
        );
    }

    public function guardar(): void
    {
        postAccion(function (): string {
            $id = empty($_POST['id']) ? null : Validador::entero($_POST, 'id');
            $rol = Validador::opcion($_POST, 'rol', ['administrador', 'empleado', 'cliente']);
            $estado = Validador::entero($_POST, 'estado', 0, 1);
            if ($id === $this->usuario['id'] && ($rol !== 'administrador' || !$estado)) {
                throw new DomainException(
                    'No puedes desactivar tu propia cuenta ni retirar tu rol administrativo.'
                );
            }
            $datos = Validador::persona($_POST);
            $clave = null;

            if ($id === null) {
                $clave = Validador::clave($_POST);
            }

            $modelo = new UsuarioModel();
            $guardado = $modelo->guardar(
                $datos,
                $rol,
                $estado,
                $id,
                $clave
            );
            $accion = 'registrado';

            if ($id !== null) {
                $accion = 'actualizado';
            }

            return 'Usuario #' . $guardado . ' ' . $accion . ' correctamente.';
        }, 'admin/usuarios');
    }
}
