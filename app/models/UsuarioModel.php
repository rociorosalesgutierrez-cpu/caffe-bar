<?php

declare(strict_types = 1);

final class UsuarioModel
{
    public function buscar(int $id): array|false
    {
        return Conexion::consulta(
            'SELECT id,nombre,usuario,correo,telefono,direccion,rol,estado FROM usuarios WHERE id=?',
            [$id]
        )->fetch();
    }

    public function listar(string $buscar = ''): array
    {
        $filtro = '%' . $buscar . '%';
        return Conexion::consulta(
            'SELECT id,nombre,usuario,correo,telefono,direccion,rol,estado FROM usuarios WHERE nombre LIKE ? OR usuario LIKE ? OR correo LIKE ? ORDER BY id DESC LIMIT 500',
            [$filtro, $filtro, $filtro]
        )->fetchAll();
    }

    public function autenticar(string $usuario, string $clave): array|false
    {
        $usuarioEncontrado = Conexion::consulta('SELECT * FROM usuarios WHERE usuario=?', [
            $usuario
        ])->fetch();
        $hash =
            $usuarioEncontrado['password_hash'] ??
            '$2y$10$R2xVBfMwa/LobobjsjhGSO8qu/YURDGjHwk4GbpdzR0eGOg3FUK7m';
        $valido = password_verify($clave, $hash);
        if (!$valido || !$usuarioEncontrado || !$usuarioEncontrado['estado']) {
            return false;
        }
        if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
            Conexion::consulta('UPDATE usuarios SET password_hash=? WHERE id=?', [
                password_hash($clave, PASSWORD_DEFAULT),
                $usuarioEncontrado['id']
            ]);
        }
        unset($usuarioEncontrado['password_hash']);
        return $usuarioEncontrado;
    }

    public function guardar(
        array $datos,
        string $rol,
        int $estado,
        ?int $id = null,
        ?string $clave = null
    ): int {
        $datos = Validador::persona($datos);
        $rol = Validador::opcion(['rol' => $rol], 'rol', ['administrador', 'empleado', 'cliente']);
        $estado = Validador::entero(['estado' => $estado], 'estado', 0, 1);
        if ($id !== null) {
            $id = Validador::entero(['id' => $id], 'id');
        }
        if ($id === null) {
            $clave = Validador::clave(['clave' => $clave]);
        }
        $pdo = Conexion::obtener();
        $pdo->beginTransaction();
        try {
            $admins = Conexion::consulta(
                "SELECT id FROM usuarios WHERE rol='administrador' AND estado=1 ORDER BY id FOR UPDATE"
            )->fetchAll();
            if ($id) {
                $anterior = Conexion::consulta(
                    'SELECT id,rol,estado FROM usuarios WHERE id=? FOR UPDATE',
                    [$id]
                )->fetch();
                if (!$anterior) {
                    throw new DomainException('Usuario inexistente.');
                }
                if (
                    $anterior['rol'] === 'administrador' &&
                    $anterior['estado'] &&
                    ($rol !== 'administrador' || !$estado) &&
                    count($admins) <= 1
                ) {
                    throw new DomainException('Debe quedar al menos un administrador activo.');
                }
                Conexion::consulta(
                    'UPDATE usuarios SET nombre=?,usuario=?,correo=?,telefono=?,direccion=?,rol=?,estado=? WHERE id=?',
                    [...array_values($datos), $rol, $estado, $id]
                );
            } else {
                if (!$clave) {
                    throw new DomainException('Falta la contraseña.');
                }
                Conexion::consulta(
                    'INSERT INTO usuarios(nombre,usuario,correo,telefono,direccion,rol,estado,password_hash) VALUES(?,?,?,?,?,?,?,?)',
                    [
                        ...array_values($datos),
                        $rol,
                        $estado,
                        password_hash($clave, PASSWORD_DEFAULT)
                    ]
                );
                $id = (int) $pdo->lastInsertId();
            }
            $pdo->commit();
            return $id;
        } catch (Throwable $error) {
            $pdo->rollBack();
            throw $error;
        }
    }

    public function perfil(int $id, array $datos, ?string $actual, ?string $nueva): void
    {
        $datos = Validador::persona($datos);
        if ($nueva !== null) {
            $nueva = Validador::clave(['clave' => $nueva]);
        }
        $pdo = Conexion::obtener();
        $pdo->beginTransaction();
        try {
            $usuarioEncontrado = Conexion::consulta(
                'SELECT password_hash FROM usuarios WHERE id=? FOR UPDATE',
                [$id]
            )->fetch();
            if (!$usuarioEncontrado) {
                throw new DomainException('Usuario inexistente.');
            }
            if ($nueva !== null) {
                if (!$actual || !password_verify($actual, $usuarioEncontrado['password_hash'])) {
                    throw new DomainException('La contraseña actual es incorrecta.');
                }
                Conexion::consulta('UPDATE usuarios SET password_hash=? WHERE id=?', [
                    password_hash($nueva, PASSWORD_DEFAULT),
                    $id
                ]);
            }
            Conexion::consulta(
                'UPDATE usuarios SET nombre=?,usuario=?,correo=?,telefono=?,direccion=? WHERE id=?',
                [...array_values($datos), $id]
            );
            $pdo->commit();
        } catch (Throwable $error) {
            $pdo->rollBack();
            throw $error;
        }
    }
}
