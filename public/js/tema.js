'use strict';
(() => {
    let theme = 'dark';
    try {
        const saved = localStorage.getItem('cafebar-theme');
        if (saved === 'light' || saved === 'dark') {
            theme = saved;
        }
    } catch {}
    document.documentElement.dataset.theme = theme;
})();
