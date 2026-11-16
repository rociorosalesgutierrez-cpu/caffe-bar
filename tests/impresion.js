'use strict';

const fs = require('node:fs');
const vm = require('node:vm');
const path = require('node:path');
const assert = require('node:assert/strict');

let imprimir;
let impresiones = 0;
const boton = {
    addEventListener(evento, accion) {
        assert.equal(evento, 'click');
        imprimir = accion;
    }
};

const documento = {
    documentElement: { dataset: { theme: 'dark' } },
    querySelectorAll(selector) {
        return selector === '[data-print]' ? [boton] : [];
    },
    querySelector() {
        return null;
    }
};

vm.runInNewContext(fs.readFileSync(path.join(__dirname, '../public/js/app.js'), 'utf8'), {
    document: documento,
    window: {
        print() {
            impresiones++;
        }
    },
    localStorage: {
        getItem() {
            return null;
        },
        setItem() {}
    },
    TextEncoder
});

assert.equal(typeof imprimir, 'function');
imprimir();
assert.equal(impresiones, 1);
console.log('OK botón data-print abre la impresión mediante JavaScript externo');
