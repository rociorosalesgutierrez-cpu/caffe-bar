<section class="tarjeta error-pagina">
    <p class="etiqueta">CAFFE MUSIC BAR</p>
    <h1>No se pudo completar la solicitud</h1>
    <p role="alert"><?= e($mensaje) ?></p>
    <div class="acciones">
        <a
            class="boton"
            href="<?= e(url()) ?>"
        >Ir al inicio</a>
        <a
            class="texto-link"
            href="<?= e(url('carrito')) ?>"
        >Revisar mi carrito</a>
    </div>
</section>
