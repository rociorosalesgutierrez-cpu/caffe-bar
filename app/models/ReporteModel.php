<?php

declare(strict_types = 1);

final class ReporteModel
{
    public function obtenerVentas(string $desde, string $hasta, string $estado = ''): array
    {
        $condiciones = ['DATE(p.fecha) >= ?', 'DATE(p.fecha) <= ?'];
        $params = [$desde, $hasta];

        if ($estado !== '') {
            $condiciones[] = 'p.estado = ?';
            $params[] = $estado;
        }

        $where = implode(' AND ', $condiciones);

        // Resumen general
        $sqlResumen = "SELECT
            COUNT(p.id) as total_pedidos,
            COALESCE(SUM(CASE WHEN p.estado != 'cancelado' THEN p.total ELSE 0 END), 0) as total_ingresos,
            COUNT(CASE WHEN p.estado = 'entregado' THEN 1 END) as pedidos_entregados,
            COUNT(CASE WHEN p.estado = 'pendiente' THEN 1 END) as pedidos_pendientes,
            COUNT(CASE WHEN p.estado = 'cancelado' THEN 1 END) as pedidos_cancelados
        FROM pedidos p WHERE $where";

        $resumen = Conexion::consulta($sqlResumen, $params)->fetch() ?: [
            'total_pedidos' => 0,
            'total_ingresos' => '0.00',
            'pedidos_entregados' => 0,
            'pedidos_pendientes' => 0,
            'pedidos_cancelados' => 0
        ];

        // Total de unidades vendidas
        $sqlUnidades = "SELECT COALESCE(SUM(dp.cantidad), 0) FROM detalle_pedido dp
            JOIN pedidos p ON p.id = dp.pedido_id
            WHERE $where AND p.estado != 'cancelado'";
        $resumen['unidades_vendidas'] = (int) Conexion::consulta(
            $sqlUnidades,
            $params
        )->fetchColumn();

        $resumen['ticket_promedio'] =
            $resumen['total_pedidos'] > 0
                ? (float) $resumen['total_ingresos'] / (int) $resumen['total_pedidos']
                : 0;

        // Ventas agrupadas por día
        $sqlDias = "SELECT
            DATE(p.fecha) as dia,
            COUNT(p.id) as cantidad_pedidos,
            COALESCE(SUM(CASE WHEN p.estado != 'cancelado' THEN p.total ELSE 0 END), 0) as total_dia
        FROM pedidos p
        WHERE $where
        GROUP BY DATE(p.fecha)
        ORDER BY dia DESC";
        $dias = Conexion::consulta($sqlDias, $params)->fetchAll();

        // Top 10 productos más vendidos
        $sqlTop = "SELECT
            dp.nombre_producto,
            c.nombre as categoria,
            SUM(dp.cantidad) as unidades,
            SUM(dp.subtotal) as total_ventas
        FROM detalle_pedido dp
        JOIN pedidos p ON p.id = dp.pedido_id
        LEFT JOIN productos pr ON pr.id = dp.producto_id
        LEFT JOIN categorias c ON c.id = pr.categoria_id
        WHERE $where AND p.estado != 'cancelado'
        GROUP BY dp.nombre_producto, c.nombre
        ORDER BY unidades DESC
        LIMIT 10";
        $topProductos = Conexion::consulta($sqlTop, $params)->fetchAll();

        // Lista detallada de pedidos en el rango
        $sqlPedidos = "SELECT p.*, u.nombre as cliente, u.correo
        FROM pedidos p
        JOIN usuarios u ON u.id = p.usuario_id
        WHERE $where
        ORDER BY p.id DESC";
        $pedidos = Conexion::consulta($sqlPedidos, $params)->fetchAll();

        return [
            'resumen' => $resumen,
            'dias' => $dias,
            'top_productos' => $topProductos,
            'pedidos' => $pedidos
        ];
    }

    public function datosFactura(int $pedidoId): array
    {
        $sql = "SELECT p.*, u.nombre as cliente, u.correo, u.telefono
        FROM pedidos p
        JOIN usuarios u ON u.id = p.usuario_id
        WHERE p.id = ?";
        $pedido = Conexion::consulta($sql, [$pedidoId])->fetch();

        if (!$pedido) {
            throw new DomainException('El pedido solicitado para facturación no existe.');
        }

        $sqlDetalles = 'SELECT * FROM detalle_pedido WHERE pedido_id = ? ORDER BY id ASC';
        $pedido['items'] = Conexion::consulta($sqlDetalles, [$pedidoId])->fetchAll();

        // Referencia de demostración. La aplicación no ha emitido un documento fiscal.
        $pedido['nro_factura'] = str_pad((string) $pedido['id'], 6, '0', STR_PAD_LEFT);
        $pedido['es_demostracion'] = true;

        return $pedido;
    }
}
