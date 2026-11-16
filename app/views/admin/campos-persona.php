<label>
  Nombre completo
  <input
    name="nombre"
    value="<?= e($persona['nombre'] ?? '') ?>"
    minlength="3"
    maxlength="120"
    pattern="[\p{L}][\p{L}\p{M}]*(?:[ '’\-][\p{L}][\p{L}\p{M}]*)*"
    title="Solo letras, espacios, apóstrofes y guiones; sin números."
    data-person-name
    autocomplete="name"
    required
  >
</label>

<div class="campos-dos">
  <label>
    Nombre de usuario
    <input
      name="usuario"
      value="<?= e($persona['usuario'] ?? '') ?>"
      minlength="3"
      maxlength="40"
      pattern="[a-zA-Z0-9_.\-]+"
      autocomplete="username"
      required
    >
  </label>

  <label>
    Correo electrónico
    <input
      name="correo"
      type="email"
      value="<?= e($persona['correo'] ?? '') ?>"
      maxlength="190"
      autocomplete="email"
      required
    >
  </label>
</div>

<div class="campos-dos">
  <label>
    Teléfono
    <input
      type="tel"
      name="telefono"
      value="<?= e($persona['telefono'] ?? '') ?>"
      maxlength="25"
      pattern="[+0-9 \(\)\-]{6,25}"
      autocomplete="tel"
    >
  </label>

  <label>
    Dirección
    <input
      name="direccion"
      value="<?= e($persona['direccion'] ?? '') ?>"
      maxlength="250"
      autocomplete="street-address"
    >
  </label>
</div>
