<?php
$datosContacto = Negocio::datos();
$contactWhatsapp = Negocio::whatsapp();
$contactMaps = Negocio::maps();
$mapaIntegrado = Negocio::mapaIntegrado();
?>
<section class="pagina-hero compacta">
    <p class="etiqueta">NOS GUSTA SABER DE TI</p>
    <h1>Un mensaje.<br><em>Un buen comienzo.</em></h1>
    <p>Una consulta, un plan con amigos o simplemente un hola. Estamos para escucharte.</p>
</section>
<div class="dos-columnas">
    <section class="contacto-datos">
        <div class="tarjeta contacto-cristal">
            <span
                class="contacto-icono"
                aria-hidden="true"
            >⌖</span>
            <h2>Nos encontramos<br>en caffe music bar.</h2>
            <p> <?= $datosContacto['direccion'] !== '' ? e($datosContacto['direccion']) . '<br>' : '' ?> <?= e($datosContacto['ciudad']) ?> </p>
            <div
                class="contacto-canales"
                style="margin-block: 1.2rem; display: grid; gap: 0.8rem;"
            >
                <div style="display: flex; align-items: center; gap: 0.8rem;">
                    <span style="font-size: 1.4rem;">📞</span>
                    <div>
                        <strong
                            style="display: block; font-size: 0.85rem; color: var(--texto-principal);"
                        >Teléfono / Celular</strong>
                        <a
                            href="tel:+59172320623"
                            style="font-size: 1.05rem; font-weight: 700; color: var(--acento);"
                        > +591 72320623 </a>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 0.8rem;">
                    <span style="font-size: 1.4rem;">💬</span>
                    <div>
                        <strong
                            style="display: block; font-size: 0.85rem; color: var(--texto-principal);"
                        >WhatsApp Directo</strong>
                        <a
                            href="https://wa.me/59172320623"
                            target="_blank"
                            rel="noopener noreferrer"
                            style="font-size: 1.05rem; font-weight: 700; color: var(--verde);"
                        > +591 72320623 </a>
                    </div>
                </div>
            </div>
            <div class="acciones">
                <?php if ($contactWhatsapp): ?>
                    <a
                        class="boton boton-whatsapp"
                        href="<?= e($contactWhatsapp) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                    > Abrir WhatsApp (+591 72320623) ↗ </a>
                <?php endif; ?>
                <?php if ($contactMaps): ?>
                    <a
                        class="boton secundario"
                        href="<?= e($contactMaps) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                    > Cómo llegar ↗ </a>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($mapaIntegrado): ?>
            <div
                class="mapa-embed"
                style="margin-top: 1.5rem;"
            >
                <iframe
                    src="<?= e($mapaIntegrado) ?>"
                    title="Ubicación de caffe music bar en Google Maps"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen
                ></iframe>
                <a
                    href="<?= e($contactMaps) ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                > Abrir indicaciones en Google Maps ↗ </a>
            </div>
        <?php endif; ?>
    </section>
    <section
        class="tarjeta"
        id="mensaje"
    >
        <p class="etiqueta">CONVERSEMOS</p>
        <h2>Escríbenos algo.</h2>
        <p class="muted">
            <?= $actual ? 'La respuesta aparecerá en Mis mensajes de tu cuenta.' : 'Al enviar recibirás un enlace privado para leer nuestra respuesta.' ?>
        </p>
        <form
            method="post"
            action="<?= e(url('contactos')) ?>"
        >
            <?= CsrfToken::campo() ?>
            <label> Tu nombre
                <input
                    name="nombre"
                    value="<?= e($actual['nombre'] ?? '') ?>"
                    minlength="3"
                    maxlength="120"
                    pattern="[\p{L}][\p{L}\p{M}]*(?:[ '’\-][\p{L}][\p{L}\p{M}]*)*"
                    title="Solo letras, espacios, apóstrofes y guiones; sin números."
                    data-person-name
                    autocomplete="name"
                    placeholder="¿Cómo te llamas?"
                    required
                >
            </label>
            <label> Correo electrónico
                <input
                    type="email"
                    name="correo"
                    value="<?= e($actual['correo'] ?? '') ?>"
                    maxlength="190"
                    autocomplete="email"
                    placeholder="tu@correo.com"
                    required
                >
            </label>
            <label> Asunto
                <input
                    name="asunto"
                    minlength="3"
                    maxlength="150"
                    placeholder="¿En qué podemos ayudarte?"
                    required
                >
            </label>
            <label> Mensaje
                <textarea
                    name="contenido"
                    minlength="10"
                    maxlength="5000"
                    placeholder="Cuéntanos un poco más…"
                    required
                ></textarea>
            </label>
            <button>Enviar mi mensaje <span aria-hidden="true">↗</span></button>
        </form>
    </section>
</div>
