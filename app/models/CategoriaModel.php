<?php

declare(strict_types = 1);

final class CategoriaModel
{
    public function listar(bool $publico = false): array
    {
        return Conexion::consulta(
            'SELECT * FROM categorias' . ($publico ? ' WHERE estado=1' : '') . ' ORDER BY nombre'
        )->fetchAll();
    }

    public function buscar(int $id): array|false
    {
        return Conexion::consulta('SELECT * FROM categorias WHERE id=?', [$id])->fetch();
    }

    public function guardar(string $nombre, string $descripcion, int $estado, ?int $id): void
    {
        if ($id) {
            if (!$this->buscar($id)) {
                throw new DomainException('Categoría inexistente.');
            }
            Conexion::consulta('UPDATE categorias SET nombre=?,descripcion=?,estado=? WHERE id=?', [
                $nombre,
                $descripcion,
                $estado,
                $id
            ]);
        } else {
            Conexion::consulta('INSERT INTO categorias(nombre,descripcion,estado) VALUES(?,?,?)', [
                $nombre,
                $descripcion,
                $estado
            ]);
        }
    }

    public function eliminar(int $id): void
    {
        Conexion::consulta('DELETE FROM categorias WHERE id=?', [$id]);
    }
}
