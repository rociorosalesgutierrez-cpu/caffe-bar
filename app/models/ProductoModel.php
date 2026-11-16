<?php

declare(strict_types = 1);

final class ProductoModel
{
    public function listar(bool $publico = false, string $buscar = '', int $categoria = 0): array
    {
        $sql =
            'SELECT p.*,c.nombre categoria FROM productos p JOIN categorias c ON c.id=p.categoria_id WHERE p.nombre LIKE ?';
        $d = ['%' . $buscar . '%'];
        if ($publico) {
            $sql .= ' AND p.estado=1 AND c.estado=1';
        }
        if ($categoria) {
            $sql .= ' AND p.categoria_id=?';
            $d[] = $categoria;
        }
        return Conexion::consulta($sql . ' ORDER BY p.id DESC LIMIT 500', $d)->fetchAll();
    }

    public function buscar(int $id): array|false
    {
        return Conexion::consulta('SELECT * FROM productos WHERE id=?', [$id])->fetch();
    }

    public function guardar(array $d, ?int $id): void
    {
        if (!(new CategoriaModel())->buscar($d['categoria_id'])) {
            throw new DomainException('Categoría inexistente.');
        }
        if ($id) {
            if (!$this->buscar($id)) {
                throw new DomainException('Producto inexistente.');
            }
            Conexion::consulta(
                'UPDATE productos SET categoria_id=?,nombre=?,descripcion=?,precio=?,stock=?,imagen=?,estado=? WHERE id=?',
                [...array_values($d), $id]
            );
        } else {
            Conexion::consulta(
                'INSERT INTO productos(categoria_id,nombre,descripcion,precio,stock,imagen,estado) VALUES(?,?,?,?,?,?,?)',
                array_values($d)
            );
        }
    }

    public function eliminar(int $id): void
    {
        Conexion::consulta('DELETE FROM productos WHERE id=?', [$id]);
    }
}
