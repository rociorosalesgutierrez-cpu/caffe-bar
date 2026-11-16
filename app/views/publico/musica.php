<section class="pagina-hero compacta">
    <p class="etiqueta">EL RITMO TAMBIÉN LO PONES TÚ</p>
    <h1>Tu café.<br><em>Tu próxima canción.</em></h1>
    <p>Sugiere lo que te gustaría escuchar en el local. Nuestro equipo revisará tu elección y la
        añadirá a la cola.</p>
</section>
<section
    class="tarjeta musica-actual"
    data-musica-estado="<?= e(url('musica/estado')) ?>"
>
    <span
        class="ecualizador"
        aria-hidden="true"
    ><i></i><i></i><i></i><i></i><i></i></span>
    <div class="musica-actual-info">
        <p class="etiqueta">SELECCIONADA EN EL REPRODUCTOR DEL LOCAL</p>
        <strong id="musica-actual-titulo"><?= e($estado['actual']['titulo'] ?? 'El local aún no ha iniciado el reproductor') ?></strong>
        <p id="musica-actual-artista"><?= e($estado['actual']['artista'] ?? 'Mientras tanto, deja tu sugerencia.') ?></p>
    </div>
    <span class="estado preparando">En el local</span>
</section>
<div class="dos-columnas seccion">
    <section class="tarjeta">
        <p class="etiqueta">¿QUÉ TE GUSTARÍA ESCUCHAR?</p>
        <h2>Deja tu sugerencia.</h2>
        <form
            method="post"
            action="<?= e(url('musica/sugerir')) ?>"
        >
            <?= CsrfToken::campo() ?>
            <label>Elige del catálogo<select name="cancion_id">
                    <option value="">Prefiero sugerir otra canción</option>
                    <?php foreach ($catalogo as $cancion): ?>
                        <option value="<?= e($cancion['id']) ?>"><?= e($cancion['titulo'] . ' — ' . $cancion['artista']) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <p class="muted">Si eliges una canción del catálogo, no necesitas completar los
                siguientes campos.</p>
            <label>Título de otra canción
                <input
                    name="titulo"
                    minlength="2"
                    maxlength="150"
                    placeholder="El nombre de tu canción"
                >
            </label>
            <label>Artista
                <input
                    name="artista"
                    minlength="2"
                    maxlength="120"
                    placeholder="¿Quién la interpreta?"
                >
            </label>
            <label>Enlace de YouTube (opcional)
                <input
                    type="url"
                    name="youtube"
                    maxlength="400"
                    placeholder="https://www.youtube.com/watch?v=..."
                >
            </label>
            <button>Enviar mi sugerencia ♫</button><small class="muted">Hasta tres sugerencias
                activas y diez por día. La música se reproduce en el equipo del local, no en tu
                teléfono.</small>
        </form>
    </section>
    <section>
        <div class="tarjeta">
            <p class="etiqueta">PRÓXIMAMENTE EN EL LOCAL</p>
            <h2>La cola musical.</h2>
            <ol
                id="musica-cola"
                class="musica-lista"
            >
                <?php foreach ($estado['cola'] as $cancion): ?>
                    <li><strong><?= e($cancion['titulo']) ?></strong><span><?= e($cancion['artista']) ?></span></li>
                <?php endforeach; ?>
            </ol>
            <p
                id="musica-cola-vacia"
                class="muted"
                <?= $estado['cola'] ? 'hidden' : '' ?>
            >Cuando se aprueben canciones, aparecerán aquí.</p>
            <p
                class="muted"
                id="musica-estado-conexion"
                role="status"
            >Actualización cada diez segundos.</p>
        </div>
    </section>
</div>
<section>
    <div class="titulo-seccion">
        <h2>Mis sugerencias</h2><span class="muted">Tu historial reciente</span>
    </div>
    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>Canción</th>
                    <th>Artista</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($solicitudes as $solicitud): ?>
                    <tr>
                        <td><?= e($solicitud['titulo']) ?></td>
                        <td><?= e($solicitud['artista']) ?></td>
                        <td><span class="estado <?= in_array($solicitud['estado'], ['rechazada', 'omitida'], true)
                            ? 'cancelado'
                            : ($solicitud['estado'] === 'pendiente'
                                ? 'pendiente'
                                : 'entregado') ?>"><?= e(str_replace('_', ' ', $solicitud['estado'])) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
