<div class="titulo-seccion">
  <div>
    <p class="etiqueta"><?= $cliente ? 'TUS MOMENTOS EN EL LOCAL' : 'OPERACIÓN DIARIA' ?></p>
    <h1><?= $cliente ? 'Mis pedidos' : 'Pedidos recibidos' ?></h1>
  </div>

  <div class="acciones">
    <?php if ($cliente): ?>
      <a class="boton" href="<?= e(url('productos')) ?>">Nuevo pedido ↗</a>
    <?php else: ?>
      <a class="boton secundario" href="<?= e(url('admin/reportes')) ?>">Ver reportes y balances ☷</a>
    <?php endif; ?>
  </div>
</div>

<div class="tabla-contenedor">
  <table>
    <thead>
      <tr>
        <th>Pedido</th>
        <th>Cliente</th>
        <th>Fecha (Bolivia)</th>
        <th>Total</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pedidos as $p): ?>
        <tr>
          <td>#<?= e((string)$p['id']) ?></td>
          <td><strong><?= e($p['cliente']) ?></strong></td>
          <td>
            <?= e((new DateTimeImmutable($p['fecha'], new DateTimeZone('UTC')))
              ->setTimezone(new DateTimeZone('America/La_Paz'))
              ->format('d/m/Y H:i')) ?>
          </td>
          <td><strong><?= e(bs($p['total'])) ?></strong></td>
          <td>
            <span class="estado <?= e($p['estado']) ?>">
              <?= e(ucfirst($p['estado'])) ?>
            </span>
          </td>
          <td>
            <div style="display: flex; align-items: center; gap: 0.6rem; flex-wrap: wrap;">
              <a href="<?= e(url('pedido?id=' . $p['id'])) ?>">Ver detalle →</a>
              <a
                class="boton pequeno secundario"
                href="<?= e(url(($cliente ? 'factura' : 'admin/factura') . '?id=' . $p['id'])) ?>"
                target="_blank"
                title="Emitir o imprimir factura de este pedido"
              >
                Factura 📄
              </a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php if (!$pedidos): ?>
  <p class="vacio">Aún no hay pedidos registrados.</p>
<?php endif; ?>
