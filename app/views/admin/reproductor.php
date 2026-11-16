<div class="titulo-seccion">
    <div>
        <p class="etiqueta">SONIDO DEL LOCAL</p>
        <h1>Que suene Coffe.</h1>
        <p class="muted">Mantén abierta esta página en el equipo conectado a los parlantes.</p>
    </div><a
        class="texto-link"
        href="<?= e(url('musica')) ?>"
    >Gestionar música →</a>
</div>
<section
    class="tarjeta reproductor"
    id="reproductor-local"
    data-control="<?= e(url('admin/musica/control')) ?>"
    data-musica-estado="<?= e(url('musica/estado')) ?>"
>
    <div
        class="disco-vinilo girando"
        id="admin-disco-vinilo"
        style="width: 150px; height: 150px; margin: 1.5rem auto;"
        aria-hidden="true"
    >
        <div class="vinilo-surcos"></div>
        <div
            class="vinilo-etiqueta"
            style="width: 65px; height: 65px;"
        >
            <span
                class="vinilo-logo"
                style="font-size: 0.38rem; top: 8px;"
            >caffe music</span>
            <span
                class="vinilo-centro"
                style="width: 10px; height: 10px;"
            ></span>
            <strong
                class="vinilo-artista"
                id="admin-vinilo-artista"
                style="font-size: 0.52rem; max-width: 55px; bottom: 14px;"
            >caffe music</strong>
            <small
                class="vinilo-cancion"
                id="admin-vinilo-cancion"
                style="font-size: 0.38rem; max-width: 50px; bottom: 6px;"
            >en vivo</small>
        </div>
    </div>
    <p class="etiqueta">COFFE MUSIC BAR · PLAYLIST DEL LOCAL</p>
    <h2 id="pista-titulo">Tu playlist está lista para empezar.</h2>
    <p
        id="pista-artista"
        class="muted"
    >Primero añade canciones al catálogo o aprueba las sugerencias.</p>
    <div class="acciones controles-musica">
        <button
            id="musica-iniciar"
            type="button"
        >Iniciar música ▶</button>
        <button
            id="musica-siguiente"
            type="button"
            class="secundario"
            disabled
        >Siguiente ↗</button>
        <button
            id="musica-detener"
            type="button"
            class="secundario"
            disabled
        >Detener</button>
    </div>
    <p
        id="reproductor-mensaje"
        class="aviso"
        role="status"
        aria-live="polite"
    >Pulsa Iniciar música para permitir el sonido en este navegador.</p>
    <audio
        id="audio-local"
        controls
        preload="metadata"
        hidden
    ></audio>
    <div
        id="youtube-contenedor"
        hidden
    >
        <div id="youtube-local"></div>
    </div>
    <p class="muted">Si YouTube bloquea la reproducción, usa el botón de reproducción del video. Los
        videos no disponibles pueden omitirse con Siguiente.</p>
    <h3>A continuación</h3>
    <ol
        id="musica-cola"
        class="musica-lista"
    ></ol>
    <p
        id="musica-cola-vacia"
        class="muted"
    >Sin solicitudes en cola: continuará el catálogo activo.</p>
    <p
        id="musica-estado-conexion"
        class="muted"
        role="status"
    ></p>
</section>
