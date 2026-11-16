<section class="formulario-central tarjeta">
  <p class="etiqueta">BIENVENIDO A CAFFE MUSIC BAR</p>
  <h1>Crea tu cuenta</h1>
  <p class="muted">Guarda tus datos y disfruta de pedidos más sencillos.</p>

  <form method="post" action="<?= e(url('registro')) ?>">
    <?= CsrfToken::campo() ?>

    <?php
      $persona = [];
      require dirname(__DIR__) . '/admin/campos-persona.php';
    ?>

    <label>
      Contraseña
      <input
        type="password"
        name="clave"
        minlength="8"
        maxlength="72"
        autocomplete="new-password"
        required
      >
      <small class="muted">Mínimo 8 caracteres; máximo 72 bytes.</small>
    </label>

    <label>
      Repetir contraseña
      <input
        type="password"
        name="confirmacion"
        minlength="8"
        maxlength="72"
        autocomplete="new-password"
        required
      >
    </label>

    <button>Crear cuenta de cliente</button>
  </form>

  <p>¿Ya tienes cuenta? <a href="<?= e(url('acceder')) ?>">Accede aquí</a></p>
</section>
