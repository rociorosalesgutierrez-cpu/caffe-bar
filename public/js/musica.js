'use strict';
(() => {
    const source = document.querySelector('#musica-fuente');
    if (source) {
        const update = () =>
            document.querySelectorAll('[data-fuente]').forEach((group) => {
                group.hidden = group.dataset.fuente !== source.value;
                group.querySelectorAll('input').forEach((input) => (input.disabled = group.hidden));
            });
        source.addEventListener('change', update);
        update();
    }
    const panel = document.querySelector('[data-musica-estado]');
    if (!panel) {
        return;
    }
    async function refresh() {
        const controller = new AbortController();
        const timeout = setTimeout(() => controller.abort(), 8000);
        try {
            const response = await fetch(panel.dataset.musicaEstado, {
                cache: 'no-store',
                signal: controller.signal
            });
            if (
                !response.ok ||
                !response.headers.get('content-type')?.includes('application/json')
            ) {
                throw new Error('Sesión o conexión no disponible');
            }
            const data = await response.json();
            const title = document.querySelector('#musica-actual-titulo');
            const artist = document.querySelector('#musica-actual-artista');
            const discoArtista = document.querySelector('#musica-disco-artista');
            if (title) {
                title.textContent =
                    data.actual?.titulo || 'El local aún no ha iniciado el reproductor';
            }
            if (artist) {
                artist.textContent = data.actual?.artista || 'Mientras tanto, deja tu sugerencia.';
            }
            if (discoArtista) {
                discoArtista.textContent = data.actual?.artista || 'Caffe Bar';
            }
            const list = document.querySelector('#musica-cola');
            list.replaceChildren();
            data.cola.forEach((track) => {
                const li = document.createElement('li');
                const name = document.createElement('strong');
                const by = document.createElement('span');
                name.textContent = track.titulo;
                by.textContent = track.artista;
                li.append(name, by);
                list.append(li);
            });
            document.querySelector('#musica-cola-vacia').hidden = data.cola.length > 0;
            document.querySelector('#musica-estado-conexion').textContent =
                'Actualizado: ' + new Date().toLocaleTimeString('es-BO');
        } catch {
            document.querySelector('#musica-estado-conexion').textContent =
                'Sin actualización. Revisa tu conexión o inicia sesión nuevamente.';
        } finally {
            clearTimeout(timeout);
            setTimeout(refresh, 10000);
        }
    }
    refresh();
})();
