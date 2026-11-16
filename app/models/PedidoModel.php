<?php

declare(strict_types = 1);

final class PedidoModel
{
    public function crear(int $usuario, array $carrito, string $token): int
    {
        if (!$carrito || count($carrito) > 50) {
            throw new DomainException('El carrito debe contener entre 1 y 50 productos.');
        }
        $items = [];
        foreach ($carrito as $id => $cantidad) {
            $id = Validador::entero(['id' => $id], 'id');
            $cantidad = Validador::entero(['cantidad' => $cantidad], 'cantidad', 1, 99);
            $items[$id] = $cantidad;
        }
        ksort($items, SORT_NUMERIC);
        $pdo = Conexion::obtener();
        $pdo->beginTransaction();
        try {
            $user = Conexion::consulta('SELECT id,rol,estado FROM usuarios WHERE id=? FOR UPDATE', [
                $usuario
            ])->fetch();
            if (!AuthMiddleware::puedeComprar($user ?: null)) {
                throw new DomainException(
                    'Solo clientes o administradores activos pueden confirmar pedidos.'
                );
            }
            $previo = Conexion::consulta('SELECT id,usuario_id FROM pedidos WHERE token=?', [
                $token
            ])->fetch();
            if ($previo) {
                if ((int) $previo['usuario_id'] !== $usuario) {
                    throw new DomainException('Solicitud inválida.');
                }
                $pdo->commit();
                return (int) $previo['id'];
            }
            $detalles = [];
            $total = 0;
            foreach ($items as $id => $cantidad) {
                $p = Conexion::consulta(
                    'SELECT p.*,c.estado categoria_activa FROM productos p JOIN categorias c ON c.id=p.categoria_id WHERE p.id=? FOR UPDATE',
                    [$id]
                )->fetch();
                if (!$p || !$p['estado'] || !$p['categoria_activa'] || $p['stock'] < $cantidad) {
                    throw new DomainException(
                        'Stock insuficiente o producto no disponible: ' . ($p['nombre'] ?? $id)
                    );
                }
                $subtotal = centavos($p['precio']) * $cantidad;
                $total += $subtotal;
                if ($total > 999999999999) {
                    throw new DomainException('El importe del pedido excede el límite.');
                }
                $detalles[] = [$p, $cantidad, $subtotal];
            }
            Conexion::consulta('INSERT INTO pedidos(usuario_id,total,token) VALUES(?,?,?)', [
                $usuario,
                decimal($total),
                $token
            ]);
            $pedido = (int) $pdo->lastInsertId();
            foreach ($detalles as [$p, $cantidad, $subtotal]) {
                Conexion::consulta(
                    'INSERT INTO detalle_pedido(pedido_id,producto_id,nombre_producto,cantidad,precio_unitario,subtotal) VALUES(?,?,?,?,?,?)',
                    [$pedido, $p['id'], $p['nombre'], $cantidad, $p['precio'], decimal($subtotal)]
                );
                Conexion::consulta('UPDATE productos SET stock=stock-? WHERE id=?', [
                    $cantidad,
                    $p['id']
                ]);
            }
            $pdo->commit();
            return $pedido;
        } catch (Throwable $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            throw $e;
        }
    }

    public function listar(?int $usuario = null): array
    {
        return Conexion::consulta(
            'SELECT p.*,u.nombre cliente FROM pedidos p JOIN usuarios u ON u.id=p.usuario_id' .
                ($usuario ? ' WHERE p.usuario_id=?' : '') .
                ' ORDER BY p.id DESC LIMIT 500',
            $usuario ? [$usuario] : []
        )->fetchAll();
    }

    public function detalle(int $id, ?int $usuario = null): array
    {
        $p = Conexion::consulta(
            'SELECT p.*,u.nombre cliente,u.telefono FROM pedidos p JOIN usuarios u ON u.id=p.usuario_id WHERE p.id=?' .
                ($usuario ? ' AND p.usuario_id=?' : ''),
            $usuario ? [$id, $usuario] : [$id]
        )->fetch();
        if (!$p) {
            throw new DomainException('Pedido inexistente o sin permiso.');
        }
        $p['detalles'] = Conexion::consulta(
            'SELECT * FROM detalle_pedido WHERE pedido_id=? ORDER BY id',
            [$id]
        )->fetchAll();
        return $p;
    }

    public function estado(int $id, string $nuevo): void
    {
        $pdo = Conexion::obtener();
        $pdo->beginTransaction();
        try {
            $p = Conexion::consulta('SELECT * FROM pedidos WHERE id=? FOR UPDATE', [$id])->fetch();
            if (!$p) {
                throw new DomainException('Pedido inexistente.');
            }
            if ($p['estado'] === $nuevo) {
                $pdo->commit();
                return;
            }
            $transiciones = [
                'pendiente' => ['preparando', 'cancelado'],
                'preparando' => ['entregado', 'cancelado'],
                'entregado' => [],
                'cancelado' => []
            ];
            if (!in_array($nuevo, $transiciones[$p['estado']], true)) {
                throw new DomainException(
                    'Transición no permitida. Entregados y cancelados son estados finales.'
                );
            }
            if ($nuevo === 'cancelado') {
                $det = Conexion::consulta(
                    'SELECT producto_id,cantidad FROM detalle_pedido WHERE pedido_id=? ORDER BY producto_id',
                    [$id]
                )->fetchAll();
                foreach ($det as $d) {
                    Conexion::consulta('UPDATE productos SET stock=stock+? WHERE id=?', [
                        $d['cantidad'],
                        $d['producto_id']
                    ]);
                }
            }
            Conexion::consulta('UPDATE pedidos SET estado=? WHERE id=?', [$nuevo, $id]);
            $pdo->commit();
        } catch (Throwable $e) {
            $pdo->rollBack();
            throw $e;
        }
    }

    public function indicadores(bool $administrador): array
    {
        $datos = [
            'productos' => (int) Conexion::consulta(
                'SELECT COUNT(*) FROM productos'
            )->fetchColumn(),
            'pedidos' => (int) Conexion::consulta('SELECT COUNT(*) FROM pedidos')->fetchColumn(),
            'pendientes' => (int) Conexion::consulta(
                "SELECT COUNT(*) FROM pedidos WHERE estado='pendiente'"
            )->fetchColumn()
        ];
        if ($administrador) {
            $datos['categorias'] = (int) Conexion::consulta(
                'SELECT COUNT(*) FROM categorias'
            )->fetchColumn();
            $datos['usuarios'] = (int) Conexion::consulta(
                'SELECT COUNT(*) FROM usuarios'
            )->fetchColumn();
        }
        return $datos;
    }
}
