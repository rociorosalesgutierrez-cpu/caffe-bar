<div class="productos-grid">
    <?php foreach ($productos as $producto): ?>
        <article
            class="producto"
            data-product-card
            data-category="<?= e($producto['categoria_id']) ?>"
            data-name="<?= e($producto['nombre']) ?>"
        >
            <div class="producto-imagen">
                <img
                    src="<?= e(url(Imagen::producto($producto))) ?>"
                    alt="<?= e($producto['nombre']) ?>"
                    loading="lazy"
                    width="600"
                    height="450"
                >
                <span class="categoria-chip"> <?= e($producto['categoria']) ?> </span>
            </div>
            <div class="producto-info">
                <div class="producto-titulo">
                    <h3><?= e($producto['nombre']) ?></h3>
                    <strong><?= e(bs($producto['precio'])) ?></strong>
                </div>
                <p><?= e($producto['descripcion']) ?></p>
                <div class="producto-final">
                    <small> <?= $producto['stock'] > 0 ? e($producto['stock']) . ' disponibles' : 'Agotado' ?> </small>
                    <?php if ($actual && $actual['rol'] === 'cliente'): ?>
                        <button
                            class="agregar"
                            data-add
                            data-id="<?= e($producto['id']) ?>"
                            data-name="<?= e($producto['nombre']) ?>"
                            data-price="<?= e($producto['precio']) ?>"
                            data-stock="<?= e($producto['stock']) ?>"
                            <?= $producto['stock'] < 1 ? 'disabled' : '' ?>
                            aria-label="Agregar <?= e($producto['nombre']) ?> al carrito"
                        > + Agregar </button>
                    <?php else: ?>
                        <a
                            class="enlace"
                            href="<?= e(url($actual ? 'admin' : 'acceder')) ?>"
                        > <?= $actual ? 'Ver en panel' : 'Pedir ahora ↗' ?> </a>
                    <?php endif; ?>
                </div>
            </div>
        </article>
    <?php endforeach; ?>
</div>
<?php if (!$productos): ?>
    <div class="vacio"> No hay productos que coincidan con la búsqueda. </div>
<?php endif; ?>
