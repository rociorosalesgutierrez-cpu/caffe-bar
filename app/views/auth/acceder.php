<div class="auth-grid">
    <section class="auth-bienvenida">
        <p class="etiqueta">UN GUSTO TENERTE AQUÍ</p>
        <h1>Tu próxima<br>pausa empieza<br>con <em>un clic.</em></h1>
        <img
            src="<?= e(url('images/cafe.svg')) ?>"
            alt="Café de bienvenida"
            width="600"
            height="450"
        >
    </section>
    <section class="auth-form tarjeta">
        <h2>Bienvenido de nuevo</h2>
        <p class="muted">Ingresa a tu cuenta para continuar.</p>
        <form
            method="post"
            action="<?= e(url('acceder')) ?>"
        >
            <?= CsrfToken::campo() ?>
            <label> Nombre de usuario
                <input
                    name="usuario"
                    minlength="3"
                    maxlength="40"
                    autocomplete="username"
                    required
                >
            </label>
            <label> Contraseña
                <input
                    name="clave"
                    type="password"
                    maxlength="72"
                    autocomplete="current-password"
                    required
                >
            </label>
            <button>Ingresar a mi cuenta ↗</button>
        </form>
        <p>¿Primera visita? <a href="<?= e(url('registro')) ?>">Crea tu cuenta</a></p>
    </section>
</div>
