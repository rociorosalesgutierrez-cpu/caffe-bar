<div class="no-print" style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
  <div>
    <a class="texto-link" href="<?= e(url('admin/reportes')) ?>">← Volver a Reportes</a>
    <h1 style="font-size: 2rem; margin-top: 0.5rem; margin-bottom: 0;">Emisión de Factura Fiscal</h1>
    <p class="muted">Documento comercial y tributario para el pedido #<?= e((string)$factura['id']) ?></p>
  </div>

  <div class="acciones">
    <button class="boton" type="button" onclick="window.print()">
      Imprimir Factura 🖨️
    </button>
  </div>
</div>

<!-- Formulario para personalizar NIT y Razón Social antes de imprimir -->
<div class="tarjeta no-print" style="margin-bottom: 2rem;">
  <form method="get" action="<?= e(url('admin/factura')) ?>" style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 1rem; align-items: end;">
    <input type="hidden" name="id" value="<?= e((string)$factura['id']) ?>">

    <label>
      Razón Social / Nombre del Cliente
      <input type="text" name="razon_social" value="<?= e($razonSocial) ?>" required>
    </label>

    <label>
      NIT / CI del Cliente
      <input type="text" name="nit" value="<?= e($nitCliente) ?>" placeholder="0 para Sin Nombre / Particular" required>
    </label>

    <button class="boton secundario">Actualizar datos de factura</button>
  </form>
</div>

<!-- Factura Fiscal Imprimible -->
<div class="factura-documento" id="seccion-factura">
  <!-- Cabecera de la factura -->
  <div class="factura-header">
    <div class="factura-empresa">
      <div style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 0.5rem;">
        <img src="<?= e(url('images/logo.svg')) ?>" alt="Logo caffe music bar" width="48" height="48" style="border-radius: 8px;">
        <div>
          <h2 style="margin: 0; font-size: 1.5rem; line-height: 1; color: #111;">caffe music bar</h2>
          <small style="color: #555; font-weight: 600; letter-spacing: 0.1em;">DE: CAFFE MUSIC BAR S.R.L.</small>
        </div>
      </div>
      <p style="margin: 0; font-size: 0.8rem; line-height: 1.4; color: #444;">
        <strong>CASA MATRIZ:</strong> <?= e($negocio['direccion']) ?><br>
        <strong>CIUDAD:</strong> <?= e($negocio['ciudad']) ?><br>
        <strong>TELÉFONO / WHATSAPP:</strong> <?= e($negocio['whatsapp']) ?>
      </p>
    </div>

    <!-- Recuadro fiscal -->
    <div class="factura-fiscal-box">
      <div style="text-align: center; border: 2px solid #222; padding: 0.8rem 1.2rem; border-radius: 6px;">
        <p style="margin: 0; font-size: 0.85rem; font-weight: 700;">NIT: 72320623018</p>
        <p style="margin: 0.2rem 0; font-size: 1.1rem; font-weight: 800; letter-spacing: 0.05em; color: #a06428;">FACTURA N° <?= e($factura['nro_factura']) ?></p>
        <p style="margin: 0; font-size: 0.72rem; color: #333;">CÓD. AUTORIZACIÓN:<br><span style="word-break: break-all; font-family: monospace;"><?= e($factura['autorizacion']) ?></span></p>
      </div>
      <p style="margin-top: 0.4rem; text-align: center; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em; color: #444;">ORIGINAL</p>
    </div>
  </div>

  <hr style="border: 0; border-top: 1px dashed #999; margin: 1.2rem 0;">

  <!-- Datos del comprador y fecha -->
  <div class="factura-datos-cliente" style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; font-size: 0.85rem; color: #222;">
    <div>
      <p style="margin: 0;"><strong>Fecha y Hora:</strong> <?= e(date('d/m/Y H:i', strtotime($factura['fecha']))) ?></p>
      <p style="margin: 0.3rem 0 0;"><strong>Señor(es):</strong> <?= e($razonSocial) ?></p>
    </div>
    <div style="text-align: right;">
      <p style="margin: 0;"><strong>N° Pedido Ref.:</strong> #<?= e((string)$factura['id']) ?></p>
      <p style="margin: 0.3rem 0 0;"><strong>NIT / CI / CEX:</strong> <?= e($nitCliente) ?></p>
    </div>
  </div>

  <!-- Detalle de productos -->
  <table class="factura-tabla" style="width: 100%; border-collapse: collapse; margin-top: 1.2rem; font-size: 0.85rem;">
    <thead>
      <tr style="border-bottom: 2px solid #222; text-align: left;">
        <th style="padding: 0.5rem 0; width: 10%;">Cant.</th>
        <th style="padding: 0.5rem 0; width: 55%;">Concepto / Detalle</th>
        <th style="padding: 0.5rem 0; width: 18%; text-align: right;">P. Unitario</th>
        <th style="padding: 0.5rem 0; width: 17%; text-align: right;">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($factura['items'] as $item): ?>
        <tr style="border-bottom: 1px solid #ddd;">
          <td style="padding: 0.6rem 0;"><?= e((string)$item['cantidad']) ?></td>
          <td style="padding: 0.6rem 0;"><?= e($item['nombre_producto']) ?></td>
          <td style="padding: 0.6rem 0; text-align: right;"><?= e(bs($item['precio_unitario'])) ?></td>
          <td style="padding: 0.6rem 0; text-align: right; font-weight: 600;"><?= e(bs($item['subtotal'])) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- Totales y Literal -->
  <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-top: 1.2rem; gap: 2rem;">
    <div style="font-size: 0.8rem; color: #444; max-width: 60%;">
      <p style="margin: 0;"><strong>SON:</strong> <?= e($literalTotal) ?></p>
      <p style="margin-top: 0.4rem; font-size: 0.72rem; color: #666;">
        CUF: <span style="font-family: monospace; word-break: break-all;"><?= e($factura['cuf']) ?></span>
      </p>
    </div>

    <div style="text-align: right; min-width: 180px;">
      <div style="display: flex; justify-content: space-between; font-size: 0.9rem; padding: 0.2rem 0;">
        <span>SUBTOTAL:</span>
        <strong><?= e(bs($factura['total'])) ?></strong>
      </div>
      <div style="display: flex; justify-content: space-between; font-size: 0.9rem; padding: 0.2rem 0;">
        <span>DESCUENTO:</span>
        <span>Bs. 0,00</span>
      </div>
      <div style="display: flex; justify-content: space-between; font-size: 1.15rem; font-weight: 800; border-top: 2px solid #222; padding-top: 0.4rem; margin-top: 0.3rem;">
        <span>TOTAL:</span>
        <span style="color: #a06428;"><?= e(bs($factura['total'])) ?></span>
      </div>
      <small style="display: block; font-size: 0.72rem; color: #666; margin-top: 0.2rem;">
        Importe Base Crédito Fiscal: <?= e(bs($factura['total'])) ?>
      </small>
    </div>
  </div>

  <hr style="border: 0; border-top: 1px dashed #999; margin: 1.2rem 0;">

  <!-- Pie de página fiscal con QR y leyendas normativas -->
  <div style="display: grid; grid-template-columns: auto 1fr; gap: 1.5rem; align-items: center;">
    <!-- Simulación visual de código QR fiscal -->
    <div style="width: 90px; height: 90px; background: #fff; border: 1px solid #111; padding: 6px; display: grid; place-content: center; text-align: center;">
      <svg viewBox="0 0 24 24" width="76" height="76" fill="#111">
        <path d="M2 2h8v8H2zm2 2v4h4V4zm10-2h8v8h-8zm2 2v4h4V4zM2 14h8v8H2zm2 2v4h4v-4zm10-2h2v2h-2zm4 0h2v2h-2zm-2 2h2v2h-2zm2 2h2v2h-2zm2-2h2v2h-2zm0 4h2v2h-2zm-6 0h2v2h-2zm-2-2h2v2h-2zm4-4h2v2h-2z"/>
      </svg>
    </div>

    <div style="font-size: 0.72rem; line-height: 1.35; color: #444;">
      <p style="margin: 0; font-weight: 700; text-align: center;">
        "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO SERÁ SANCIONADO PENALMENTE DE ACUERDO A LEY"
      </p>
      <p style="margin: 0.3rem 0 0; text-align: center; color: #666;">
        Ley N° 453: El proveedor deberá suministrar el servicio en las condiciones ofertadas.
      </p>
      <p style="margin: 0.3rem 0 0; text-align: center; font-family: monospace; font-size: 0.68rem; color: #888;">
        Código de Control: <?= e($factura['control']) ?> · Fecha Límite de Emisión: <?= e(date('d/m/Y', strtotime('+6 months'))) ?>
      </p>
    </div>
  </div>
</div>

<style>
.factura-documento {
  background: #ffffff;
  color: #111111;
  padding: 3rem;
  border-radius: var(--radio-lg);
  box-shadow: var(--sombra-m3-2);
  max-width: 800px;
  margin-inline: auto;
  border: 1px solid rgba(0, 0, 0, 0.1);
  font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
}

.factura-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 2rem;
}

@media print {
  body {
    background: #ffffff !important;
    color: #000000 !important;
  }
  .sidebar, .cabecera, .pie, .no-print, .ondas-fondo, .theme-rotator, .anuncio {
    display: none !important;
  }
  .panel-body, .panel-main, .contenedor, .principal {
    display: block !important;
    padding: 0 !important;
    margin: 0 !important;
    width: 100% !important;
    max-width: 100% !important;
  }
  .factura-documento {
    box-shadow: none !important;
    border: none !important;
    padding: 0 !important;
    max-width: 100% !important;
    color: #000000 !important;
  }
}
</style>
