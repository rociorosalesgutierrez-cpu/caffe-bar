<div class="titulo-seccion">
    <h1>Mensajes de contacto</h1><span class="muted">Últimos 500 mensajes</span>
</div>
<div class="mensajes-grid">
    <?php foreach ($mensajes as $mensaje): ?>
        <article class="tarjeta">
            <div class="titulo-seccion">
                <h2><?= e($mensaje['asunto']) ?></h2><span class="estado <?= $mensaje['estado'] === 'nuevo' ? 'pendiente' : 'entregado' ?>"><?= e($mensaje['estado']) ?></span>
            </div>
            <p><strong><?= e($mensaje['nombre']) ?></strong><br><?= e($mensaje['correo']) ?> · <?= e($mensaje['fecha']) ?> UTC</p>
            <details>
                <summary>Leer consulta</summary>
                <p class="texto-mensaje"><?= e($mensaje['contenido']) ?></p>
            </details>
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
