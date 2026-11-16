'use strict';
document.querySelectorAll('[data-print]').forEach((button) => {
    button.addEventListener('click', () => window.print());
});
(() => {
    const buttons = document.querySelectorAll('.theme-rotator');
    function applyTheme(theme) {
        document.documentElement.dataset.theme = theme;
        try {
            localStorage.setItem('cafebar-theme', theme);
        } catch {}
        buttons.forEach((button) => {
            const next = theme === 'dark' ? 'Activar tema claro' : 'Activar tema oscuro';
            button.setAttribute('aria-label', next);
            button.setAttribute('title', next);
            button.setAttribute('aria-pressed', String(theme === 'light'));
        });
    }
    applyTheme(document.documentElement.dataset.theme === 'light' ? 'light' : 'dark');
    buttons.forEach((button) =>
        button.addEventListener('click', () =>
            applyTheme(document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark')
        )
    );
    const menu = document.querySelector('.menu-toggle');
    const nav = document.querySelector('#navegacion');
    if (menu && nav) {
        const close = () => {
            menu.setAttribute('aria-expanded', 'false');
            nav.classList.remove('abierto');
        };
        menu.addEventListener('click', () => {
            const open = menu.getAttribute('aria-expanded') !== 'true';
            menu.setAttribute('aria-expanded', String(open));
            nav.classList.toggle('abierto', open);
        });
        nav.addEventListener('click', (event) => {
            if (event.target.closest('a')) {
                close();
            }
        });
        document.addEventListener('focusin', (event) => {
            if (!event.target.closest('.cabecera')) {
                close();
            }
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && menu.getAttribute('aria-expanded') === 'true') {
                close();
                menu.focus();
            }
        });
        document.addEventListener('click', (event) => {
            if (!event.target.closest('.cabecera')) {
                close();
            }
        });
        window.matchMedia('(max-width:1200px)').addEventListener('change', close);
    }
    document.querySelectorAll('.sidebar nav a, #navegacion a').forEach((a) => {
        if (new URL(a.href).pathname === location.pathname) {
            a.classList.add('activo');
            a.setAttribute('aria-current', 'page');
        }
    });
})();
function validateFields(form) {
    form.querySelectorAll('[data-person-name]').forEach((input) => {
        const valid = /^[\p{L}][\p{L}\p{M}]*(?:[ '’\-][\p{L}][\p{L}\p{M}]*)*$/u.test(input.value);
        input.setCustomValidity(
            input.value && !valid
                ? 'El nombre solo admite letras, espacios, apóstrofes y guiones; no admite números.'
                : ''
        );
    });
    form.querySelectorAll('input[type="password"]').forEach((input) => {
        const tooShort =
            input.value && input.minLength > 0 && Array.from(input.value).length < input.minLength;
        input.setCustomValidity(
            new TextEncoder().encode(input.value).length > 72
                ? 'La contraseña no puede superar 72 bytes.'
                : tooShort
                  ? 'La contraseña debe tener al menos 8 caracteres.'
                  : ''
        );
    });
    const first = form.querySelector('[name="nueva_clave"], [name="clave"][minlength]');
    const second = form.querySelector('[name="confirmacion"]');
    if (first && second) {
        second.setCustomValidity(
            first.value !== second.value ? 'Las contraseñas no coinciden.' : ''
        );
    }
    const file = form.querySelector('input[type="file"]');
    if (file) {
        const maximum = file.name === 'audio' ? 20971520 : 4194304;
        file.setCustomValidity(
            !file.disabled && file.files[0] && file.files[0].size > maximum
                ? file.name === 'audio'
                    ? 'El audio debe pesar como máximo 20 MB.'
                    : 'La imagen debe pesar como máximo 4 MB.'
                : ''
        );
    }
}
document.querySelectorAll('form').forEach((form) => {
    form.addEventListener('submit', (event) => {
        validateFields(form);
        if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
            return;
        }
        if (form.dataset.confirm && !confirm(form.dataset.confirm)) {
            event.preventDefault();
        }
    });
    form.addEventListener('input', () => validateFields(form));
});
const search = document.querySelector('#catalog-search');
const category = document.querySelector('#catalog-category');
const catalogStatus = document.querySelector('#catalog-status');
if (search && category) {
    search.addEventListener('input', () => {
        const query = search.value.trim().toLocaleLowerCase('es');
        let visible = 0;
        document.querySelectorAll('[data-product-card]').forEach((card) => {
            card.hidden = !card.dataset.name.toLocaleLowerCase('es').includes(query);
            if (!card.hidden) {
                visible++;
            }
        });
        if (catalogStatus) {
            catalogStatus.textContent = visible
                ? `${visible} opciones visibles. Pulsa Buscar para consultar toda la carta.`
                : 'Sin coincidencias en esta selección. Pulsa Buscar o restablece los filtros.';
        }
    });
    category.addEventListener('change', () => category.form.requestSubmit());
}
const stats = document.querySelector('[data-stats-url]');
if (stats) {
    const status = document.querySelector('#stats-status');
    async function updateStats() {
        const controller = new AbortController();
        const timeout = setTimeout(() => controller.abort(), 8000);
        try {
            const response = await fetch(stats.dataset.statsUrl, {
                signal: controller.signal,
                cache: 'no-store'
            });
            if (
                !response.ok ||
                !response.headers.get('content-type')?.includes('application/json')
            ) {
                throw new Error('Sin conexión');
            }
            const data = await response.json();
            Object.entries(data).forEach(([key, value]) => {
                const output = stats.querySelector('[data-stat="' + key + '"]');
                if (output) {
                    output.textContent = String(value);
                }
            });
            status.textContent = 'Actualizado a las ' + new Date().toLocaleTimeString('es-BO');
        } catch {
            status.textContent =
                'Sin actualización. Los indicadores visibles pueden estar desactualizados.';
        } finally {
            clearTimeout(timeout);
            setTimeout(updateStats, 10000);
        }
    }
    setTimeout(updateStats, 10000);
}
