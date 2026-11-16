<?php

declare(strict_types = 1);

final class ProductoController
{
    public function __construct()
    {
        AuthMiddleware::exigir(['administrador', 'empleado']);
    }

    public function index(): void
    {
        $busqueda = isset($_GET['q']) ? Validador::texto($_GET, 'q', 0, 120) : '';
        $editar = isset($_GET['editar'])
            ? (new ProductoModel())->buscar(Validador::entero($_GET, 'editar'))
            : null;
        vista(
            'admin/productos',
            [
                'productos' => (new ProductoModel())->listar(false, $busqueda),
                'categorias' => (new CategoriaModel())->listar(),
                'editar' => $editar,
                'q' => $busqueda
            ],
            true
        );
    }

    public function guardar(): void
    {
        postAccion(function (): void {
            $modelo = new ProductoModel();
            $id = empty($_POST['id']) ? null : Validador::entero($_POST, 'id');
            $viejo = $id ? $modelo->buscar($id) : null;
            if ($id && !$viejo) {
                throw new DomainException('Producto inexistente.');
            }
            $datos = [
                'categoria_id' => Validador::entero($_POST, 'categoria_id'),
                'nombre' => Validador::texto($_POST, 'nombre', 2, 120),
                'descripcion' => Validador::texto($_POST, 'descripcion', 5, 1000),
                'precio' => Validador::precio($_POST),
                'stock' => Validador::entero($_POST, 'stock', 0, 1000000),
                'imagen' => $viejo['imagen'] ?? 'images/cafe.svg',
                'estado' => Validador::entero($_POST, 'estado', 0, 1)
            ];
            $imagen = Imagen::guardar($_FILES['imagen'] ?? []);
            if ($imagen) {
                $datos['imagen'] = $imagen;
            }
            try {
                $modelo->guardar($datos, $id);
            } catch (Throwable $e) {
                Imagen::quitar($imagen);
                throw $e;
            }
            if ($imagen && $viejo) {
                Imagen::quitar($viejo['imagen']);
            }
        }, 'admin/productos');
    }

    public function eliminar(): void
    {
        postAccion(function (): void {
            $modeloProductos = new ProductoModel();
            $id = Validador::entero($_POST, 'id');
            $p = $modeloProductos->buscar($id);
            $modeloProductos->eliminar($id);
            if ($p) {
                Imagen::quitar($p['imagen']);
            }
        }, 'admin/productos');
    }
}
