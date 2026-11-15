<div class="productos-grid">
  <?php foreach ($productos as $p): ?>
    <article
      class="producto"
      data-product-card
      data-category="<?= e($p['categoria_id']) ?>"
      data-name="<?= e(mb_strtolower($p['nombre'])) ?>"
    >
      <div class="producto-imagen">
        <img
          src="<?= e(url($p['imagen'])) ?>"
          alt="<?= e($p['nombre']) ?>"
          loading="lazy"
          width="600"
          height="450"
        >
        <span class="categoria-chip">
          <?= e($p['categoria']) ?>
        </span>
      </div>

      <div class="producto-info">
        <div class="producto-titulo">
          <h3><?= e($p['nombre']) ?></h3>
          <strong><?= e(bs($p['precio'])) ?></strong>
        </div>

        <p><?= e($p['descripcion']) ?></p>

        <div class="producto-final">
          <small>
            <?= $p['stock'] > 0 ? e($p['stock']) . ' disponibles' : 'Agotado' ?>
          </small>

          <?php if ($actual && $actual['rol'] === 'cliente'): ?>
            <button
              class="agregar"
              data-add
              data-id="<?= e($p['id']) ?>"
              data-name="<?= e($p['nombre']) ?>"
              data-price="<?= e($p['precio']) ?>"
              data-stock="<?= e($p['stock']) ?>"
              <?= $p['stock'] < 1 ? 'disabled' : '' ?>
              aria-label="Agregar <?= e($p['nombre']) ?> al carrito"
            >
              + Agregar
            </button>
          <?php else: ?>
            <a class="enlace" href="<?= e(url($actual ? 'admin' : 'acceder')) ?>">
              <?= $actual ? 'Ver en panel' : 'Pedir ahora ↗' ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </article>
  <?php endforeach; ?>
</div>

<?php if (!$productos): ?>
  <div class="vacio">
    No hay productos que coincidan con la búsqueda.
  </div>
<?php endif; ?>
