'use strict';

const fs = require('node:fs');
const vm = require('node:vm');
const path = require('node:path');
const assert = require('node:assert/strict');

async function comprobarActualizacion() {
    const clases = new Set(['estado', 'pendiente']);
    const etiqueta = {
        dataset: { pedidoEstado: '42', estado: 'pendiente' },
        textContent: 'Pendiente',
        classList: {
            remove(...nombres) {
                nombres.forEach((nombre) => clases.delete(nombre));
            },
            add(nombre) {
                clases.add(nombre);
            }
        }
    };
    const aviso = { textContent: '' };
    const pagina = { dataset: { pedidosUrl: '/mis-pedidos/estado?id=42' } };
    const eventos = {};
    const tiempos = new Map();
    let siguienteTiempo = 0;
    let estadoServidor = 'pendiente';
    let sinConexion = false;
    let sesionTerminada = false;
    let consultas = 0;

    const documento = {
        hidden: false,
        querySelector(selector) {
            return selector === '[data-pedidos-url]' ? pagina : aviso;
        },
        querySelectorAll() {
            return [etiqueta];
        },
        addEventListener(nombre, accion) {
            eventos[nombre] = accion;
        }
    };

    vm.runInNewContext(fs.readFileSync(path.join(__dirname, '../public/js/pedidos.js'), 'utf8'), {
        document: documento,
        window: {
            addEventListener(nombre, accion) {
                eventos[nombre] = accion;
            }
        },
        AbortController,
        setTimeout(accion, espera) {
            const id = ++siguienteTiempo;
            tiempos.set(id, { accion, espera });
            return id;
        },
        clearTimeout(id) {
            tiempos.delete(id);
        },
        async fetch(url, opciones) {
            consultas++;
            assert.equal(url, '/mis-pedidos/estado?id=42');
            assert.equal(opciones.cache, 'no-store');
            if (sinConexion) {
                throw new Error('Sin red');
            }
            return {
                ok: true,
                redirected: sesionTerminada,
                headers: {
                    get() {
                        return 'application/json';
                    }
                },
                async json() {
                    return { pedidos: [{ id: 42, estado: estadoServidor }] };
                }
            };
        }
    });

    const esperarRespuesta = () => new Promise(setImmediate);
    async function siguienteConsulta() {
        const turno = [...tiempos.entries()].find(([, tiempo]) => tiempo.espera === 5000);
        assert.ok(turno, 'Debe programarse la siguiente consulta');
        tiempos.delete(turno[0]);
        await turno[1].accion();
    }

    await esperarRespuesta();
    assert.equal(etiqueta.textContent, 'Pendiente');
    estadoServidor = 'preparando';
    await siguienteConsulta();
    assert.equal(etiqueta.textContent, 'Preparando');
    assert.ok(clases.has('preparando') && !clases.has('pendiente'));

    sinConexion = true;
    await siguienteConsulta();
    assert.equal(etiqueta.textContent, 'Preparando');
    assert.match(aviso.textContent, /desactualizados/);

    sinConexion = false;
    estadoServidor = 'entregado';
    documento.hidden = true;
    const anteriores = consultas;
    await siguienteConsulta();
    assert.equal(consultas, anteriores);
    documento.hidden = false;
    eventos.visibilitychange();
    await esperarRespuesta();
    assert.equal(etiqueta.textContent, 'Entregado');

    estadoServidor = '<script>alert(1)</script>';
    await siguienteConsulta();
    assert.equal(etiqueta.textContent, 'Entregado');

    sesionTerminada = true;
    await siguienteConsulta();
    assert.match(aviso.textContent, /sesión terminó/);
    assert.equal([...tiempos.values()].filter((tiempo) => tiempo.espera === 5000).length, 0);

    console.log('OK estados en pantalla, pérdida de conexión, pestaña oculta y sesión caducada');
}

comprobarActualizacion().catch((error) => {
    console.error(error);
    process.exitCode = 1;
});
