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
        $id = Validador::entero($_GET, 'id');

        $model = new ReporteModel();
        $factura = $model->datosFactura($id);

        $nitCliente = trim($_GET['nit'] ?? '');
        $razonSocial = trim($_GET['razon_social'] ?? '');

        if ($nitCliente === '') {
            $nitCliente = '0';
        }
        if ($razonSocial === '') {
            $razonSocial = $factura['cliente'];
        }

        $literalTotal = $this->convertirNumeroALetras((float) $factura['total']);

        vista(
            'admin/factura',
            [
                'factura' => $factura,
                'nitCliente' => $nitCliente,
                'razonSocial' => $razonSocial,
                'literalTotal' => $literalTotal,
                'negocio' => Negocio::datos()
            ],
            true
        );
    }

    public function facturaCliente(): void
    {
        $id = Validador::entero($_GET, 'id');
        $model = new ReporteModel();
        $factura = $model->datosFactura($id);

        // Si es cliente, validar que el pedido le pertenece
        if (
            $this->usuario['rol'] === 'cliente' &&
            (int) $factura['usuario_id'] !== (int) $this->usuario['id']
        ) {
            throw new DomainException('No tienes permiso para ver la factura de este pedido.');
        }

        $nitCliente = trim($_GET['nit'] ?? '0');
        $razonSocial = trim($_GET['razon_social'] ?? $factura['cliente']);
        $literalTotal = $this->convertirNumeroALetras((float) $factura['total']);

        vista(
            'admin/factura',
            [
                'factura' => $factura,
                'nitCliente' => $nitCliente,
                'razonSocial' => $razonSocial,
                'literalTotal' => $literalTotal,
                'negocio' => Negocio::datos()
            ],
            false
        );
    }

    private function convertirNumeroALetras(float $numero): string
    {
        $centavos = (int) round(($numero - floor($numero)) * 100);
        $entero = (int) floor($numero);

        $unidades = ['', 'UN', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO', 'NUEVE'];
        $especiales = [
            11 => 'ONCE',
            12 => 'DOCE',
            13 => 'TRECE',
            14 => 'CATORCE',
            15 => 'QUINCE',
            16 => 'DIECISEIS',
            17 => 'DIECISIETE',
            18 => 'DIECIOCHO',
            19 => 'DIECINUEVE'
        ];
        $decenas = [
            '',
            'DIEZ',
            'VEINTE',
            'TREINTA',
            'CUARENTA',
            'CINCUENTA',
            'SESENTA',
            'SETENTA',
            'OCHENTA',
            'NOVENTA'
        ];
        $centenas = [
            '',
            'CIENTO',
            'DOSCIENTOS',
            'TRESCIENTOS',
            'CUATROCIENTOS',
            'QUINIENTOS',
            'SEISCIENTOS',
            'SETECIENTOS',
            'OCHOCIENTOS',
            'NOVECIENTOS'
        ];

        if ($entero === 0) {
            $texto = 'CERO';
        } elseif ($entero === 100) {
            $texto = 'CIEN';
        } else {
            $c = (int) ($entero / 100);
            $resto = $entero % 100;
            $d = (int) ($resto / 10);
            $u = $resto % 10;

            $partes = [];
            if ($c > 0) {
                $partes[] = $centenas[$c];
            }

            if ($resto > 10 && $resto < 20) {
                $partes[] = $especiales[$resto];
            } else {
                if ($d > 0) {
                    if ($d === 2 && $u > 0) {
                        $partes[] = 'VEINTI' . $unidades[$u];
                        $u = 0;
                    } else {
                        $partes[] = $decenas[$d];
                    }
                }
                if ($u > 0) {
                    if ($d > 2) {
                        $partes[] = 'Y';
                    }
                    $partes[] = $unidades[$u];
                }
            }
            $texto = implode(' ', $partes);
        }

        return trim($texto) .
            ' ' .
            str_pad((string) $centavos, 2, '0', STR_PAD_LEFT) .
            '/100 BOLIVIANOS';
    }
}
