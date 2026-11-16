<div class="titulo-seccion">
    <div>
        <p class="etiqueta">TU CUENTA</p>
        <h1>Mi perfil</h1>
    </div><span class="estado preparando"><?= e($perfil['rol']) ?></span>
</div>
<section class="tarjeta perfil-form">
    <form
        method="post"
        action="<?= e(url('perfil')) ?>"
    >
        <?= CsrfToken::campo() ?>
        <?php
        $persona = $perfil;
        require __DIR__ . '/campos-persona.php';
        ?>
        <fieldset>
            <legend>Cambiar contraseña</legend>
            <p class="muted">Completa estos campos solo si deseas cambiar tu contraseña. La nueva
                contraseña debe tener al menos 8 caracteres y no superar 72 bytes.</p>
            <label>Contraseña actual
                <input
                    name="clave_actual"
                    type="password"
                    maxlength="72"
                    autocomplete="current-password"
                >
            </label>
            <label>Nueva contraseña
                <input
                    name="nueva_clave"
                    type="password"
                    minlength="8"
                    maxlength="72"
                    autocomplete="new-password"
                >
            </label>
            <label>Confirmar nueva contraseña
                <input
                    name="confirmacion"
                    type="password"
                    minlength="8"
                    maxlength="72"
                    autocomplete="new-password"
                >
            </label>
        </fieldset>
        <button>Guardar mi perfil</button>
    </form>
</section>
