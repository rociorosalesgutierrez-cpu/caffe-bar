<?php
declare(strict_types=1);
final class MensajeModel
{
    public function listar(): array {return Conexion::consulta('SELECT * FROM mensajes_contacto ORDER BY id DESC LIMIT 500')->fetchAll();}
    public function crear(string $nombre,string $correo,string $asunto,string $contenido): void {Conexion::consulta('INSERT INTO mensajes_contacto(nombre,correo,asunto,contenido) VALUES(?,?,?,?)',[$nombre,$correo,$asunto,$contenido]);}
    public function estado(int $id,string $estado): void {Conexion::consulta('UPDATE mensajes_contacto SET estado=? WHERE id=?',[$estado,$id]);}
    public function eliminar(int $id): void {Conexion::consulta('DELETE FROM mensajes_contacto WHERE id=?',[$id]);}
}
