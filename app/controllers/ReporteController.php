<?php

declare(strict_types = 1);

final class ReporteController
{
    private array $usuario;

    public function __construct()
    {
        $this->usuario = AuthMiddleware::exigir();
    }

    private function filtros(): array
    {
        $desde = $_GET['desde'] ?? date('Y-m-01');
        $hasta = $_GET['hasta'] ?? date('Y-m-d');
        $estado = $_GET['estado'] ?? '';

        return [
            Validador::fecha($desde) ? $desde : date('Y-m-01'),
            Validador::fecha($hasta) ? $hasta : date('Y-m-d'),
            in_array($estado, ['pendiente', 'preparando', 'entregado', 'cancelado'], true)
                ? $estado
                : ''
        ];
    }

    public function index(): void
    {
        AuthMiddleware::exigir(['administrador', 'empleado']);

        [$desde, $hasta, $estado] = $this->filtros();

        $model = new ReporteModel();
        $datos = $model->obtenerVentas($desde, $hasta, $estado);

        vista(
            'admin/reportes',
            [
                'desde' => $desde,
                'hasta' => $hasta,
                'estado' => $estado,
                'resumen' => $datos['resumen'],
                'dias' => $datos['dias'],
                'top_productos' => $datos['top_productos'],
                'pedidos' => $datos['pedidos']
            ],
            true
        );
    }

    public function csv(): void
    {
        AuthMiddleware::exigir(['administrador', 'empleado']);

        [$desde, $hasta, $estado] = $this->filtros();

        $model = new ReporteModel();
        $datos = $model->obtenerVentas($desde, $hasta, $estado);

        header('Content-Type: text/csv; charset=utf-8');
        header(
            'Content-Disposition: attachment; filename="reporte_ventas_' .
                $desde .
                '_a_' .
                $hasta .
                '.csv"'
        );

        // BOM para compatibilidad con Excel
        echo "\xEF\xBB\xBF";

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Reporte de Ventas - caffe music bar'], ';');
        fputcsv($output, ['Periodo:', $desde . ' al ' . $hasta], ';');
        fputcsv($output, ['Generado el:', date('d/m/Y H:i:s')], ';');
        fputcsv($output, [], ';');

        fputcsv($output, ['Nro Pedido', 'Fecha y Hora', 'Cliente', 'Estado', 'Total (Bs.)'], ';');
        foreach ($datos['pedidos'] as $p) {
            fputcsv(
                $output,
                [
                    $p['id'],
                    $p['fecha'],
                    $p['cliente'],
                    strtoupper($p['estado']),
                    number_format((float) $p['total'], 2, ',', '.')
                ],
                ';'
            );
        }

        fputcsv($output, [], ';');
        fputcsv($output, ['RESUMEN GENERAL'], ';');
        fputcsv(
            $output,
            [
                'Total Ingresos (Bs.)',
                number_format((float) $datos['resumen']['total_ingresos'], 2, ',', '.')
            ],
            ';'
        );
        fputcsv($output, ['Total Pedidos', $datos['resumen']['total_pedidos']], ';');
        fputcsv($output, ['Pedidos Entregados', $datos['resumen']['pedidos_entregados']], ';');
        fputcsv($output, ['Unidades Vendidas', $datos['resumen']['unidades_vendidas']], ';');

        fclose($output);
        exit();
    }

    public function factura(): void
    {
        AuthMiddleware::exigir(['administrador', 'empleado']);
        $this->mostrarFactura(true);
    }

    public function facturaCliente(): void
    {
        $this->mostrarFactura(false);
    }

    private function mostrarFactura(bool $panel): void
    {
        $id = Validador::entero($_GET, 'id');
        $factura = (new ReporteModel())->datosFactura($id);

        if (!$panel && (int) $factura['usuario_id'] !== (int) $this->usuario['id']) {
            http_response_code(403);
            throw new DomainException('No tienes permiso para ver la factura de este pedido.');
        }

        $nitCliente = isset($_GET['nit']) ? Validador::texto($_GET, 'nit', 1, 25) : '0';
        if (!preg_match('/^[a-zA-Z0-9-]{1,25}$/D', $nitCliente)) {
            throw new DomainException('El NIT o CI solo admite letras, números y guiones.');
        }

        $razonSocial = $factura['cliente'];
        if (isset($_GET['razon_social'])) {
            $razonSocial = Validador::texto($_GET, 'razon_social', 3, 120);
        }

        vista(
            'admin/factura',
            [
                'factura' => $factura,
                'nitCliente' => $nitCliente,
                'razonSocial' => $razonSocial,
                'literalTotal' => ImporteLiteral::bolivianos((string) $factura['total']),
                'negocio' => Negocio::datos(),
                'rutaFactura' => $panel ? 'admin/factura' : 'factura',
                'volver' => $panel ? 'admin/pedidos' : 'mis-pedidos',
                'fechaEmision' => fechaBolivia(gmdate('Y-m-d H:i:s'))
            ],
            $panel
        );
    }
}
