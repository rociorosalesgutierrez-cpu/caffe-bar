<?php

declare(strict_types = 1);

final class MensajeModel
{
    public function listar(): array
    {
        return Conexion::consulta(
            'SELECT * FROM mensajes_contacto ORDER BY id DESC LIMIT 500'
        )->fetchAll();
    }

    public function crear(
        string $nombre,
        string $correo,
        string $asunto,
        string $contenido,
        ?int $usuario = null
    ): array {
        $token = bin2hex(random_bytes(32));

        Conexion::consulta(
            'INSERT INTO mensajes_contacto(nombre,correo,asunto,contenido,usuario_id,token_hash)
             VALUES(?,?,?,?,?,?)',
            [$nombre, $correo, $asunto, $contenido, $usuario, hash('sha256', $token)]
        );

        return ['id' => (int) Conexion::obtener()->lastInsertId(), 'token' => $token];
    }

    public function mios(int $usuario): array
    {
        return Conexion::consulta(
            'SELECT * FROM mensajes_contacto WHERE usuario_id=? ORDER BY id DESC LIMIT 100',
            [$usuario]
        )->fetchAll();
    }

    public function porToken(string $token): array
    {
        if (!preg_match('/^[a-f0-9]{64}$/D', $token)) {
            throw new DomainException('Consulta inexistente o enlace privado inválido.');
        }

        $mensaje = Conexion::consulta('SELECT * FROM mensajes_contacto WHERE token_hash=?', [
            hash('sha256', $token)
        ])->fetch();

        if (!$mensaje) {
            throw new DomainException('Consulta inexistente o enlace privado inválido.');
        }

        return $mensaje;
    }

    public function responder(int $id, int $administrador, string $respuesta): void
    {
        $respuesta = Validador::texto(['respuesta' => $respuesta], 'respuesta', 3, 5000);
        $conexion = Conexion::obtener();
        $conexion->beginTransaction();

        try {
            $usuario = Conexion::consulta('SELECT rol,estado FROM usuarios WHERE id=? FOR UPDATE', [
                $administrador
            ])->fetch();

            if (!$usuario || !$usuario['estado'] || $usuario['rol'] !== 'administrador') {
                throw new DomainException(
                    'Solo un administrador activo puede responder consultas.'
                );
            }

            $mensaje = Conexion::consulta(
                'SELECT id FROM mensajes_contacto WHERE id=? FOR UPDATE',
                [$id]
            )->fetch();

            if (!$mensaje) {
                throw new DomainException('La consulta ya no existe.');
            }

            Conexion::consulta(
                "UPDATE mensajes_contacto SET respuesta=?,respondido_por=?,
                 respuesta_fecha=UTC_TIMESTAMP(),estado='respondido' WHERE id=?",
                [$respuesta, $administrador, $id]
            );
            $conexion->commit();
        } catch (Throwable $error) {
            $conexion->rollBack();
            throw $error;
        }
    }

    public function estado(int $id, string $estado): void
    {
        if (!in_array($estado, ['nuevo', 'leido', 'respondido'], true)) {
            throw new DomainException('Estado de consulta inválido.');
        }

        $conexion = Conexion::obtener();
        $conexion->beginTransaction();

        try {
            $mensaje = Conexion::consulta(
                'SELECT respuesta FROM mensajes_contacto WHERE id=? FOR UPDATE',
                [$id]
            )->fetch();

            if (!$mensaje) {
                throw new DomainException('La consulta ya no existe.');
            }

            if ($estado === 'respondido' && empty($mensaje['respuesta'])) {
                throw new DomainException(
                    'Escribe y guarda una respuesta antes de marcar como respondido.'
                );
            }

            Conexion::consulta('UPDATE mensajes_contacto SET estado=? WHERE id=?', [$estado, $id]);
            $conexion->commit();
        } catch (Throwable $error) {
            $conexion->rollBack();
            throw $error;
        }
    }

    public function eliminar(int $id): void
    {
        Conexion::consulta('DELETE FROM mensajes_contacto WHERE id=?', [$id]);
    }
}
