<section class="factura-botonera no-print">
    <div>
        <a class="texto-link" href="<?= e(url($volver)) ?>">← Volver a pedidos</a>
        <h1>Emisión de factura</h1>
        <p class="muted">Vista de demostración del pedido #<?= e($factura['id']) ?></p>
    </div>
    <button class="boton" type="button" data-print>Imprimir / guardar PDF</button>
</section>

<section class="tarjeta no-print factura-edicion">
    <h2>Datos del comprador</h2>
    <p class="muted">Actualiza los datos de esta impresión antes de abrir el diálogo de impresión.</p>
    <form class="factura-formulario" method="get" action="<?= e(url($rutaFactura)) ?>">
        <input type="hidden" name="id" value="<?= e($factura['id']) ?>">
        <label>
            Razón social / nombre
            <input name="razon_social" value="<?= e($razonSocial) ?>" minlength="3" maxlength="120" required>
        </label>
        <label>
            NIT / CI del comprador
            <input name="nit" value="<?= e($nitCliente) ?>" pattern="[a-zA-Z0-9\-]{1,25}" maxlength="25" required>
        </label>
        <button class="secundario">Actualizar datos</button>
    </form>
</section>

<article class="factura-documento" id="seccion-factura">
    <header class="factura-encabezado">
        <div>
            <div class="factura-marca">
                <img src="<?= e(url('images/logo.svg')) ?>" alt="" width="56" height="56">
                <h2><?= e($negocio['nombre']) ?></h2>
            </div>
            <p><?= e($negocio['direccion']) ?><br><?= e($negocio['ciudad']) ?></p>
            <p>Teléfono: <?= e($negocio['telefono']) ?></p>
            <?php if (!empty($negocio['nit'])): ?>
                <p>NIT del emisor: <?= e($negocio['nit']) ?></p>
            <?php endif; ?>
        </div>
        <div class="factura-referencia">
            <strong>FACTURA DE DEMOSTRACIÓN</strong>
            <span>Referencia <?= e($factura['nro_factura']) ?></span>
            <span>Pedido #<?= e($factura['id']) ?></span>
            <span><?= e(ucfirst($factura['estado'])) ?></span>
        </div>
    </header>

    <dl class="factura-datos">
        <div>
            <dt>Señor(es) / razón social</dt>
            <dd><?= e($razonSocial) ?></dd>
        </div>
        <div>
            <dt>NIT / CI del comprador</dt>
            <dd><?= e($nitCliente) ?></dd>
        </div>
        <div>
            <dt>Fecha del pedido · Bolivia</dt>
            <dd><?= e(fechaBolivia($factura['fecha'])) ?></dd>
        </div>
        <div>
            <dt>Fecha de esta impresión · Bolivia</dt>
            <dd><?= e($fechaEmision) ?></dd>
        </div>
    </dl>

    <div class="factura-detalle">
        <table class="factura-tabla">
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Precio unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($factura['items'] as $item): ?>
                    <tr>
                        <td><?= e($item['cantidad']) ?></td>
                        <td><?= e($item['nombre_producto']) ?></td>
                        <td><?= e(bs($item['precio_unitario'])) ?></td>
                        <td><?= e(bs($item['subtotal'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="factura-totales">
        <p><strong>Son:</strong> <?= e($literalTotal) ?></p>
        <p class="factura-total"><span>Total</span><strong><?= e(bs($factura['total'])) ?></strong></p>
    </div>

    <footer class="factura-aviso">
        <p>Documento de demostración. Sin emisión fiscal ni acreditación de pago.</p>
        <?php if ($factura['estado'] === 'cancelado'): ?>
            <p><strong>Pedido cancelado.</strong></p>
        <?php endif; ?>
    </footer>
</article>
