<?php

declare(strict_types = 1);

final class CategoriaController
{
    public function __construct()
    {
        AuthMiddleware::exigir(['administrador']);
    }

    public function index(): void
    {
        $modeloCategorias = new CategoriaModel();
        $editar = isset($_GET['editar'])
            ? $modeloCategorias->buscar(Validador::entero($_GET, 'editar'))
            : null;
        vista(
            'admin/categorias',
            ['categorias' => $modeloCategorias->listar(), 'editar' => $editar],
            true
        );
    }

    public function guardar(): void
    {
        postAccion(function (): void {
            (new CategoriaModel())->guardar(
                Validador::texto($_POST, 'nombre', 2, 80),
                Validador::texto($_POST, 'descripcion', 3, 500),
                Validador::entero($_POST, 'estado', 0, 1),
                empty($_POST['id']) ? null : Validador::entero($_POST, 'id')
            );
        }, 'admin/categorias');
    }

    public function eliminar(): void
    {
        postAccion(function (): void {
            (new CategoriaModel())->eliminar(Validador::entero($_POST, 'id'));
        }, 'admin/categorias');
    }
}
