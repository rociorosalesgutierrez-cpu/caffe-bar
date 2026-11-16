<section class="pagina-hero compacta">
    <p class="etiqueta">TUS FAVORITOS, EN UN SOLO LUGAR</p>
    <h1>Mi <em>carrito.</em></h1>
    <p>Revisa las cantidades antes de confirmar. El importe final se calcula en el servidor.</p>
</section>
<div id="cart-page">
    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="cart-lines"></tbody>
        </table>
    </div>
    <p
        id="cart-empty"
        class="vacio"
        hidden
    > Tu carrito está vacío. <a href="<?= e(url('productos')) ?>">Explorar la carta</a>
    </p>
    <section class="resumen-carrito tarjeta">
        <h2> Total estimado <span id="cart-total">Bs. 0,00</span>
        </h2>
        <p class="muted"> Pedidos para atención en el local. Sin pago en línea ni envío a domicilio.
        </p>
        <form
            id="checkout"
            method="post"
            action="<?= e(url('carrito/confirmar')) ?>"
        >
            <?= CsrfToken::campo() ?>
            <input
                type="hidden"
                name="token"
                value="<?= e($token) ?>"
            >
            <input
                type="hidden"
                id="cart-items"
                name="items"
                value="{}"
            >
            <button id="checkout-button">Confirmar pedido ↗</button>
        </form>
        <a href="<?= e(url('productos')) ?>">Seguir eligiendo</a>
    </section>
</div>
