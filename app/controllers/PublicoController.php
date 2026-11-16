<?php

declare(strict_types = 1);

final class PublicoController
{
    public function inicio(): void
    {
        $seleccion = [];
        foreach (array_reverse((new ProductoModel())->listar(true)) as $producto) {
            if (!isset($seleccion[$producto['categoria_id']])) {
                $seleccion[$producto['categoria_id']] = $producto;
            }
        }
        vista('publico/inicio', [
            'productos' => array_slice(array_values($seleccion), 0, 3),
            'categorias' => (new CategoriaModel())->listar(true)
        ]);
    }

    public function nosotros(): void
    {
        vista('publico/nosotros');
    }

    public function productos(): void
    {
        $busqueda = isset($_GET['q']) ? Validador::texto($_GET, 'q', 0, 120) : '';
        $categoria = isset($_GET['categoria']) ? Validador::entero($_GET, 'categoria', 0) : 0;
        vista('publico/productos', [
            'productos' => (new ProductoModel())->listar(true, $busqueda, $categoria),
            'categorias' => (new CategoriaModel())->listar(true),
            'q' => $busqueda,
            'categoria' => $categoria
        ]);
    }

    public function contactos(): void
    {
        vista('publico/contactos');
    }

    public function enviar(): void
    {
        postAccion(function (): void {
            Intentos::registrar('contacto', 5, 900);
            (new MensajeModel())->crear(
                Validador::nombre($_POST),
                Validador::correo($_POST),
                Validador::texto($_POST, 'asunto', 3, 150),
                Validador::texto($_POST, 'contenido', 10, 5000)
            );
        }, 'contactos');
    }
}
