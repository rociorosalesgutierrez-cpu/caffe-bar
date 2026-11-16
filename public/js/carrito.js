'use strict';
(() => {
    const key = document.body.dataset.cartKey;
    if (!key) {
        return;
    }
    let cart = {};
    try {
        const saved = JSON.parse(localStorage.getItem(key) || '{}');
        if (saved && typeof saved === 'object' && !Array.isArray(saved)) {
            Object.entries(saved)
                .slice(0, 50)
                .forEach(([id, item]) => {
                    if (
                        /^[1-9]\d{0,9}$/.test(id) &&
                        item &&
                        typeof item.name === 'string' &&
                        item.name.length <= 120 &&
                        Number.isSafeInteger(item.price) &&
                        item.price > 0 &&
                        item.price <= 99999999 &&
                        Number.isInteger(item.quantity) &&
                        item.quantity > 0 &&
                        item.quantity <= 99
                    ) {
                        cart[id] = { name: item.name, price: item.price, quantity: item.quantity };
                    }
                });
        }
    } catch {
        cart = {};
    }
    if (document.body.dataset.clearCart === '1') {
        cart = {};
    }
    const money = (cents) =>
        'Bs. ' +
        (cents / 100).toLocaleString('es-BO', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    const make = (tag, text) => {
        const element = document.createElement(tag);
        if (text !== undefined) {
            element.textContent = text;
        }
        return element;
    };
    let toastTimer;
    function toast(text) {
        const output = document.querySelector('#toast');
        if (!output) {
            return;
        }
        output.textContent = text;
        output.hidden = false;
        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => (output.hidden = true), 3000);
    }
    function save() {
        try {
            localStorage.setItem(key, JSON.stringify(cart));
        } catch {
            toast('Tu navegador no permite guardar el carrito. Mantén esta página abierta.');
        }
        document
            .querySelectorAll('[data-cart-count]')
            .forEach(
                (el) =>
                    (el.textContent = String(
                        Object.values(cart).reduce((n, p) => n + p.quantity, 0)
                    ))
            );
    }
    function render() {
        save();
        const target = document.querySelector('#cart-lines');
        if (!target) {
            return;
        }
        target.replaceChildren();
        let total = 0;
        Object.entries(cart).forEach(([id, p]) => {
            total += p.price * p.quantity;
            const row = make('tr');
            const quantityCell = make('td');
            const input = make('input');
            input.type = 'number';
            input.min = '1';
            input.max = '99';
            input.step = '1';
            input.value = String(p.quantity);
            input.className = 'cart-quantity';
            input.setAttribute('aria-label', 'Cantidad de ' + p.name);
            input.addEventListener('change', () => {
                const n = Number(input.value);
                if (!Number.isInteger(n) || n < 1 || n > 99) {
                    input.value = String(p.quantity);
                    toast('La cantidad debe estar entre 1 y 99.');
                    return;
                }
                cart[id].quantity = n;
                render();
            });
            quantityCell.append(input);
            const action = make('td');
            const remove = make('button', 'Quitar');
            remove.type = 'button';
            remove.className = 'cart-remove';
            remove.setAttribute('aria-label', 'Quitar ' + p.name);
            remove.addEventListener('click', () => {
                delete cart[id];
                render();
            });
            action.append(remove);
            row.append(
                make('td', p.name),
                make('td', money(p.price)),
                quantityCell,
                make('td', money(p.price * p.quantity)),
                action
            );
            target.append(row);
        });
        const empty = Object.keys(cart).length === 0;
        document.querySelector('#cart-empty').hidden = !empty;
        document.querySelector('#checkout-button').disabled = empty;
        document.querySelector('#cart-total').textContent = money(total);
        document.querySelector('#cart-items').value = JSON.stringify(
            Object.fromEntries(Object.entries(cart).map(([id, p]) => [id, p.quantity]))
        );
    }
    document.querySelectorAll('[data-add]').forEach((button) =>
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const stock = Number(button.dataset.stock);
            const quantity = (cart[id]?.quantity || 0) + 1;
            if (quantity > Math.min(stock, 99)) {
                toast('Alcanzaste el stock disponible o el máximo por producto.');
                return;
            }
            if (!cart[id] && Object.keys(cart).length >= 50) {
                toast('Puedes agregar hasta 50 productos diferentes.');
                return;
            }
            cart[id] = {
                name: button.dataset.name,
                price: Math.round(Number(button.dataset.price) * 100),
                quantity
            };
            render();
            toast('Agregado: ' + button.dataset.name);
        })
    );
    const checkout = document.querySelector('#checkout');
    if (checkout) {
        checkout.addEventListener('submit', (event) => {
            render();
            if (!Object.keys(cart).length) {
                event.preventDefault();
                toast('Agrega productos antes de confirmar.');
            }
        });
    }
    window.addEventListener('storage', (event) => {
        if (event.key === key) {
            location.reload();
        }
    });
    render();
})();
