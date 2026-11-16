'use strict';

(() => {
    const pagina = document.querySelector('[data-pedidos-url]');
    if (!pagina) {
        return;
    }

    const aviso = document.querySelector('[data-pedidos-status]');
    const etiquetas = {
        pendiente: 'Pendiente',
        preparando: 'Preparando',
        entregado: 'Entregado',
        cancelado: 'Cancelado'
    };

    let temporizador;
    let activa = true;
    let consultando = false;

    function informar(texto) {
        if (aviso && aviso.textContent !== texto) {
            aviso.textContent = texto;
        }
    }

    async function actualizar() {
        if (!activa || consultando) {
            return;
        }

        clearTimeout(temporizador);
        if (document.hidden) {
            temporizador = setTimeout(actualizar, 5000);
            return;
        }

        consultando = true;
        const control = new AbortController();
        const espera = setTimeout(() => control.abort(), 8000);

        try {
            const respuesta = await fetch(pagina.dataset.pedidosUrl, {
                cache: 'no-store',
                signal: control.signal,
                headers: { Accept: 'application/json' }
            });

            if (respuesta.redirected) {
                activa = false;
                informar('Tu sesión terminó. Vuelve a iniciar sesión para actualizar tus pedidos.');
                return;
            }

            if (
                !respuesta.ok ||
                !respuesta.headers.get('content-type')?.includes('application/json')
            ) {
                throw new Error('No se pudo consultar el estado.');
            }

            const datos = await respuesta.json();
            if (!Array.isArray(datos.pedidos)) {
                throw new Error('Respuesta de pedidos inválida.');
            }

            const estados = new Map(
                datos.pedidos.map((pedido) => [String(pedido.id), pedido.estado])
            );
            const cambios = [];

            document.querySelectorAll('[data-pedido-estado]').forEach((elemento) => {
                const id = elemento.dataset.pedidoEstado;
                const estado = estados.get(id);
                if (!Object.hasOwn(etiquetas, estado) || elemento.dataset.estado === estado) {
                    return;
                }

                elemento.classList.remove(...Object.keys(etiquetas));
                elemento.classList.add(estado);
                elemento.dataset.estado = estado;
                elemento.textContent = etiquetas[estado];
                cambios.push('Pedido #' + id + ': ' + etiquetas[estado]);
            });

            informar(
                cambios.length ? cambios.join('. ') : 'Estados al día. Se revisan cada 5 segundos.'
            );
        } catch {
            informar('Sin actualización. Los estados visibles pueden estar desactualizados.');
        } finally {
            clearTimeout(espera);
            consultando = false;
            if (activa) {
                temporizador = setTimeout(actualizar, 5000);
            }
        }
    }

    document.addEventListener('visibilitychange', () => {
        if (!document.hidden) {
            actualizar();
        }
    });

    window.addEventListener('pagehide', () => {
        activa = false;
        clearTimeout(temporizador);
    });

    window.addEventListener('pageshow', (evento) => {
        if (evento.persisted) {
            activa = true;
            actualizar();
        }
    });

    actualizar();
})();
