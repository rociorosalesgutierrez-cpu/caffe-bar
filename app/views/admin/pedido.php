<div class="titulo-seccion">
    <div>
        <p class="etiqueta">DETALLE DEL PEDIDO</p>
        <h1>Pedido #<?= e((string) $pedido['id']) ?></h1>
    </div>
    <div class="acciones">
        <span
            class="estado <?= e($pedido['estado']) ?>"
            style="font-size: 0.9rem; padding: 0.4rem 1rem;"
        > <?= e(ucfirst($pedido['estado'])) ?> </span>
        <a
            class="boton"
            href="<?= e(url(($cliente ? 'factura' : 'admin/factura') . '?id=' . $pedido['id'])) ?>"
            target="_blank"
        > Emitir Factura 📄 </a>
    </div>
</div>
<section class="tarjeta">
    <div
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h3 style="margin-bottom: 0.2rem;"><?= e($pedido['cliente']) ?></h3>
            <p
                class="muted"
                style="margin: 0;"
            > Teléfono: <?= $pedido['telefono'] ? e($pedido['telefono']) : 'No registrado' ?> </p>
        </div>
        <div style="text-align: right;">
            <p
                class="muted"
                style="margin: 0;"
            >Fecha de emisión:</p>
            <strong><?= e(date('d/m/Y H:i', strtotime($pedido['fecha']))) ?></strong>
        </div>
    </div>
    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedido['detalles'] as $d): ?>
                    <tr>
                        <td><strong><?= e($d['nombre_producto']) ?></strong></td>
                        <td><?= e((string) $d['cantidad']) ?></td>
                        <td><?= e(bs($d['precio_unitario'])) ?></td>
                        <td><strong><?= e(bs($d['subtotal'])) ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <h2
        class="total-pedido"
        style="font-size: 1.8rem; margin-top: 1.5rem; color: var(--acento);"
    > Total <?= e(bs($pedido['total'])) ?> </h2>
    <?php if (!$cliente): ?>
        <hr style="border: 0; border-top: 1px solid var(--superficie-borde); margin: 2rem 0 1.5rem;">
        <form
            class="form-inline"
            method="post"
            action="<?= e(url('admin/pedidos/estado')) ?>"
        >
            <?= CsrfToken::campo() ?>
            <input
                type="hidden"
                name="id"
                value="<?= e((string) $pedido['id']) ?>"
            >
            <label> Cambiar estado del pedido <select name="estado">
                    <?php foreach (
                        ['pendiente', 'preparando', 'entregado', 'cancelado']
                        as $s
                    ): ?>
                        <option
                            value="<?= e($s) ?>"
                            <?= $pedido['estado'] === $s ? 'selected' : '' ?>
                        > <?= e(ucfirst($s)) ?> </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <button>Actualizar estado</button>
        </form>
        <p
            class="muted"
            style="margin-top: 0.8rem; font-size: 0.82rem;"
        > Pendiente → Preparando → Entregado. Se puede cancelar antes de entregar; la cancelación repone
            automáticamente el stock. </p>
    <?php endif; ?>
</section>
<div style="margin-top: 1.5rem;">
    <a
        class="texto-link"
        href="<?= e(url($cliente ? 'mis-pedidos' : 'admin/pedidos')) ?>"
    > ← Volver al listado de pedidos </a>
</div>
