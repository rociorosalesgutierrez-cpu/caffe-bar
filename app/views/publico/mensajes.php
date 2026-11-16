<section class="pagina-hero compacta">
    <p class="etiqueta">CONVERSEMOS</p>
    <h1><?= $privada ? 'Tu consulta.' : 'Mis mensajes.' ?></h1>
    <p>Lee aquí la respuesta de nuestro equipo.</p>
    <?php if ($privada): ?>
        <p class="muted">Guarda este enlace privado para volver a consultar. Cualquier persona que lo tenga podrá leer esta consulta.</p>
        <button type="button" class="secundario" data-copy-link>Copiar enlace privado</button>
    <?php endif; ?>
</section>

<div class="mensajes-grid">
    <?php foreach ($mensajes as $mensaje): ?>
        <article class="tarjeta">
            <div class="titulo-seccion">
                <h2><?= e($mensaje['asunto']) ?></h2>
                <span class="estado <?= !empty($mensaje['respuesta']) ? 'entregado' : 'pendiente' ?>">
                    <?= !empty($mensaje['respuesta']) ? 'Respondido' : 'Esperando respuesta' ?>
                </span>
            </div>
            <p class="muted">Consulta #<?= e($mensaje['id']) ?> · <?= e(fechaBolivia($mensaje['fecha'])) ?></p>
            <h3>Tu mensaje</h3>
            <p class="texto-mensaje"><?= e($mensaje['contenido']) ?></p>

            <?php if (!empty($mensaje['respuesta'])): ?>
                <section class="respuesta-contacto">
                    <h3>Respuesta de Coffe Music Bar</h3>
                    <p class="texto-mensaje"><?= e($mensaje['respuesta']) ?></p>
                    <p class="muted"><?= e(fechaBolivia($mensaje['respuesta_fecha'])) ?></p>
                </section>
            <?php else: ?>
                <p class="muted">Te responderemos en este espacio. Vuelve a abrir esta página para ver las novedades.</p>
            <?php endif; ?>
        </article>
    <?php endforeach; ?>
</div>

<?php if (!$mensajes): ?>
    <p class="vacio">Todavía no has enviado consultas desde tu cuenta.</p>
<?php endif; ?>

<p><a class="texto-link" href="<?= e(url('contactos#mensaje')) ?>">Enviar una nueva consulta →</a></p>
