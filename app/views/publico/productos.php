<section class="pagina-hero compacta">
    <p class="etiqueta">PREPARADOS PARA TU ANTOJO</p>
    <h1>La buena vida<br>está en <em>la carta.</em></h1>
    <p>Café para empezar. Algo fresco para seguir. Un bocado para quedarte un rato más.</p>
</section>
<nav
    class="catalogo-tabs"
    aria-label="Categorías de la carta"
><a
        href="<?= e(url('productos')) ?>"
        <?= !$categoria ? 'aria-current="page"' : '' ?>
    >Toda la carta</a>
    <?php foreach ($categorias as $categoriaOpcion): ?>
        <a
            href="<?= e(url('productos?categoria=' . $categoriaOpcion['id'])) ?>"
            <?= $categoria === (int) $categoriaOpcion['id'] ? 'aria-current="page"' : '' ?>
        ><?= e($categoriaOpcion['nombre']) ?></a>
    <?php endforeach; ?>
</nav>
<form
    class="filtros"
    method="get"
    action="<?= e(url('productos')) ?>"
>
    <label>Encuentra tu favorito
        <input
            name="q"
            id="catalog-search"
            value="<?= e($q) ?>"
            maxlength="120"
            placeholder="¿Qué se te antoja?"
            type="search"
        >
    </label>
    <label>Categoría<select
            name="categoria"
            id="catalog-category"
        >
            <option value="0">Todas las categorías</option>
            <?php foreach ($categorias as $categoriaOpcion): ?>
                <option
                    value="<?= e($categoriaOpcion['id']) ?>"
                    <?= $categoria === (int) $categoriaOpcion['id'] ? 'selected' : '' ?>
                ><?= e($categoriaOpcion['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <button>Buscar <span aria-hidden="true">↗</span></button>
</form>
<div class="catalogo-meta">
    <p
        class="muted"
        id="catalog-status"
        role="status"
    ><?= e(count($productos)) ?> opciones para disfrutar · Precios en Bs.</p>
    <?php if ($q !== '' || $categoria): ?>
        <a
            class="texto-link"
            href="<?= e(url('productos')) ?>"
        >Restablecer filtros ×</a>
    <?php endif; ?>
</div>
<?php
require __DIR__ . '/tarjetas.php';
?>
<p class="catalogo-nota">El stock y el precio se verifican al confirmar tu pedido. Encuentra tus
    favoritos y agrégalos a tu carrito desde tu cuenta de cliente.</p>
