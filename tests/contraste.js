'use strict';
const fs = require('node:fs');
const css = fs.readFileSync(
    require('node:path').join(__dirname, '../public/css/accesibilidad.css'),
    'utf8'
);
const root = css.match(/:root\[data-theme=["']?light["']?\]\s*\{([^}]+)\}/)[1];
const colors = Object.fromEntries(
    [...root.matchAll(/--([a-z-]+):\s*(#[a-f0-9]{6})\s*;/g)].map((m) => [m[1], m[2]])
);
function lum(hex) {
    const v = hex
        .slice(1)
        .match(/../g)
        .map((s) => parseInt(s, 16) / 255)
        .map((n) => (n <= 0.04045 ? n / 12.92 : ((n + 0.055) / 1.055) ** 2.4));
    return 0.2126 * v[0] + 0.7152 * v[1] + 0.0722 * v[2];
}
function ratio(a, b) {
    const x = lum(a),
        y = lum(b);
    return (Math.max(x, y) + 0.05) / (Math.min(x, y) + 0.05);
}
for (const [label, fg, bg] of [
    ['Texto principal', colors.ink, colors.base],
    ['Texto secundario', colors.muted, colors.raised],
    ['Acentos pequeños', colors.accent, colors.base],
    ['Campos', colors.ink, colors.input],
    ['Botón caramelo', '#3c261a', '#d69a66'],
    ['Menú lateral', '#d9c9b8', '#221916'],
    ['Texto sobre foto', '#fff3e0', '#38251e']
]) {
    const value = ratio(fg, bg);
    if (value < 4.5) {
        throw new Error(`${label}: contraste ${value.toFixed(2)} insuficiente`);
    }
    console.log(`OK ${label}: ${value.toFixed(2)}:1`);
}
