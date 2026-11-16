<div class="titulo-seccion">
    <div>
        <p class="etiqueta">GESTIÓN FINANCIERA Y OPERATIVA</p>
        <h1>Reportes y Ventas</h1>
        <p class="muted">Analiza ingresos, pedidos completados y emisión de facturación.</p>
    </div>
    <div class="acciones">
        <a
            class="boton secundario"
            href="<?= e(url('admin/reportes/csv?desde=' . $desde . '&hasta=' . $hasta . '&estado=' . $estado)) ?>"
        > Exportar CSV 📥 </a>
        <button
            class="boton"
            type="button"
            data-print
        > Imprimir Reporte 🖨️ </button>
    </div>
</div>
<!-- Filtros de fecha y estado -->
<form
    class="filtros"
    method="get"
    action="<?= e(url('admin/reportes')) ?>"
>
    <div class="campos-dos filtros-fechas">
        <label> Desde
            <input
                type="date"
                name="desde"
                value="<?= e($desde) ?>"
                required
            >
        </label>
        <label> Hasta
            <input
                type="date"
                name="hasta"
                value="<?= e($hasta) ?>"
                required
            >
        </label>
    </div>
    <label> Estado del pedido <select name="estado">
            <option value="">Todos los estados</option>
            <option
                value="entregado"
                <?= $estado === 'entregado' ? 'selected' : '' ?>
            >Entregados (Completados)</option>
            <option
                value="preparando"
                <?= $estado === 'preparando' ? 'selected' : '' ?>
            >En preparación</option>
            <option
                value="pendiente"
                <?= $estado === 'pendiente' ? 'selected' : '' ?>
            >Pendientes</option>
            <option
                value="cancelado"
                <?= $estado === 'cancelado' ? 'selected' : '' ?>
            >Cancelados</option>
        </select>
    </label>
    <button>Filtrar reporte</button>
</form>
<!-- Indicadores KPI -->
<div
    class="indicadores"
    style="margin-block: 2rem;"
>
    <article class="indicador">
        <p>Ingresos Totales</p>
        <strong style="color: var(--acento);"><?= e(bs($resumen['total_ingresos'])) ?></strong>
        <small>Excluye pedidos cancelados</small>
    </article>
    <article class="indicador">
        <p>Total de Pedidos</p>
        <strong><?= e((string) $resumen['total_pedidos']) ?></strong>
        <small><?= e((string) $resumen['pedidos_entregados']) ?> completados / <?= e((string) $resumen['pedidos_cancelados']) ?> cancelados</small>
    </article>
    <article class="indicador">
        <p>Ticket Promedio</p>
        <strong><?= e(bs($resumen['ticket_promedio'])) ?></strong>
        <small>Promedio por orden</small>
    </article>
    <article class="indicador">
        <p>Unidades Vendidas</p>
        <strong><?= e((string) $resumen['unidades_vendidas']) ?></strong>
        <small>Bebidas y bocados servidos</small>
    </article>
</div>
<!-- Dos columnas: Top Productos y Ventas por Día -->
<div
    class="dos-columnas seccion"
    style="padding-top: 0;"
>
    <section class="tarjeta">
        <p class="etiqueta">TOP FAVORITOS</p>
        <h2>Productos Más Vendidos</h2>
        <?php if ($top_productos): ?>
            <div class="tabla-contenedor">
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Unidades</th>
                            <th>Total Bs.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($top_productos as $tp): ?>
                            <tr>
                                <td><strong><?= e($tp['nombre_producto']) ?></strong></td>
                                <td><?= e($tp['categoria'] ?? 'Sin categoría') ?></td>
                                <td><?= e((string) $tp['unidades']) ?></td>
                                <td><?= e(bs($tp['total_ventas'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="muted">No hay ventas registradas en el período seleccionado.</p>
        <?php endif; ?>
    </section>
    <section class="tarjeta">
        <p class="etiqueta">EVOLUCIÓN</p>
        <h2>Ventas por Día</h2>
        <?php if ($dias): ?>
            <div class="tabla-contenedor">
                <table>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Pedidos</th>
                            <th>Total Facturado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dias as $d): ?>
                            <tr>
                                <td><?= e(date('d/m/Y', strtotime($d['dia']))) ?></td>
                                <td><?= e((string) $d['cantidad_pedidos']) ?></td>
                                <td><strong><?= e(bs($d['total_dia'])) ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="muted">No hay registros para las fechas indicadas.</p>
        <?php endif; ?>
    </section>
</div>
<!-- Desglose de Pedidos y Emisión de Facturas -->
<section
    class="tarjeta"
    style="margin-top: 2rem;"
>
    <div class="titulo-seccion">
        <div>
            <p class="etiqueta">DOCUMENTOS FISCALES</p>
            <h2>Historial de Pedidos y Emisión de Facturas</h2>
            <p class="muted">Haz clic en "Emitir / Ver Factura" para generar el documento tributario
                imprimible.</p>
        </div>
    </div>
    <?php if ($pedidos): ?>
        <div class="tabla-contenedor">
            <table>
                <thead>
                    <tr>
                        <th>N° Pedido</th>
                        <th>Fecha y Hora</th>
                        <th>Cliente</th>
                        <th>Estado</th>
                        <th>Importe</th>
                        <th>Facturación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $p): ?>
                        <tr>
                            <td>#<?= e((string) $p['id']) ?></td>
                            <td><?= e(date('d/m/Y H:i', strtotime($p['fecha']))) ?></td>
                            <td>
                                <strong><?= e($p['cliente']) ?></strong>
                                <small><?= e($p['correo']) ?></small>
                            </td>
                            <td>
                                <span class="estado <?= e($p['estado']) ?>"> <?= e(ucfirst($p['estado'])) ?> </span>
                            </td>
                            <td><strong><?= e(bs($p['total'])) ?></strong></td>
                            <td>
                                <a
                                    class="boton pequeno"
                                    href="<?= e(url('admin/factura?id=' . $p['id'])) ?>"
                                    target="_blank"
                                    title="Emitir o imprimir factura fiscal de este pedido"
                                > Emitir Factura 📄 </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="vacio">No se encontraron pedidos en el rango seleccionado.</p>
    <?php endif; ?>
</section>
