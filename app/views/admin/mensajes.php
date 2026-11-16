<div class="titulo-seccion">
    <div>
        <h1>Mensajes de contacto</h1>
        <p class="muted">Escribe la respuesta aquí. Se mostrará en la cuenta o enlace privado de la consulta.</p>
    </div>
    <span class="muted">Últimos 500 mensajes</span>
</div>
<div class="mensajes-grid">
    <?php foreach ($mensajes as $mensaje): ?>
        <article class="tarjeta">
            <div class="titulo-seccion">
                <h2><?= e($mensaje['asunto']) ?></h2>
                <span class="estado <?= empty($mensaje['respuesta']) ? 'pendiente' : 'entregado' ?>">
                    <?= $mensaje['estado'] === 'respondido' && empty($mensaje['respuesta'])
                        ? 'Sin respuesta guardada'
                        : e($mensaje['estado']) ?>
                </span>
            </div>
            <p><strong><?= e($mensaje['nombre']) ?></strong><br><?= e($mensaje['correo']) ?> · <?= e(fechaBolivia($mensaje['fecha'])) ?></p>
            <details>
                <summary>Leer consulta</summary>
                <p class="texto-mensaje"><?= e($mensaje['contenido']) ?></p>
            </details>
            <form method="post" action="<?= e(url('admin/mensajes/responder')) ?>">
                <?= CsrfToken::campo() ?>
                <input type="hidden" name="id" value="<?= e($mensaje['id']) ?>">
                <label>
                    Respuesta al cliente
                    <textarea name="respuesta" minlength="3" maxlength="5000" required><?= e($mensaje['respuesta'] ?? '') ?></textarea>
                </label>
                <button><?= empty($mensaje['respuesta']) ? 'Guardar respuesta' : 'Actualizar respuesta' ?></button>
            </form>
            <?php if (!empty($mensaje['respuesta_fecha'])): ?>
                <p class="muted">Última respuesta: <?= e(fechaBolivia($mensaje['respuesta_fecha'])) ?></p>
            <?php endif; ?>
            <?php if (empty($mensaje['usuario_id'])): ?>
                <p class="muted">
                    <?= !empty($mensaje['token_hash'])
                        ? 'El visitante puede leerla con el enlace privado que recibió al enviar su consulta.'
                        : 'Esta consulta antigua no tiene cuenta ni enlace privado. Contacta al remitente por correo.' ?>
                </p>
                <a class="texto-link" href="<?= e('mailto:' . $mensaje['correo'] . '?subject=' . rawurlencode('Respuesta: ' . $mensaje['asunto']) . '&body=' . rawurlencode($mensaje['respuesta'] ?? '')) ?>">Abrir correo para responder ↗</a>
            <?php endif; ?>
            <form
                class="form-inline"
                method="post"
                action="<?= e(url('admin/mensajes/estado')) ?>"
            >
                <?= CsrfToken::campo() ?>
                <input
                    type="hidden"
                    name="id"
                    value="<?= e($mensaje['id']) ?>"
                >
                <label>Estado<select name="estado">
                        <?php foreach (['nuevo', 'leido', 'respondido'] as $estado): ?>
                            <option
                                value="<?= e($estado) ?>"
                                <?= $mensaje['estado'] === $estado ? 'selected' : '' ?>
                                <?= $estado === 'respondido' && empty($mensaje['respuesta']) ? 'disabled' : '' ?>
                            ><?= e($estado) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <button>Guardar</button>
            </form>
            <form
                method="post"
                action="<?= e(url('admin/mensajes/eliminar')) ?>"
                data-confirm="¿Eliminar este mensaje definitivamente?"
            >
                <?= CsrfToken::campo() ?>
                <input
                    type="hidden"
                    name="id"
                    value="<?= e($mensaje['id']) ?>"
                >
                <button class="enlace peligro">Eliminar mensaje</button>
            </form>
        </article>
    <?php endforeach; ?>
</div>
