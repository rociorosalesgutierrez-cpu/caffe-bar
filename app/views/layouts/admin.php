<!doctype html>
<html lang="es">
<head>
  <?php require __DIR__ . '/cabecera.php'; ?>
</head>
<body class="panel-body" data-cart-key="<?= e('cafebar-cart-' . $actual['id']) ?>">

  <!-- Ondas Vectoriales de Fondo -->
  <div class="ondas-fondo" aria-hidden="true">
    <svg class="onda onda-bottom" viewBox="0 0 1440 320" preserveAspectRatio="none">
      <path
        class="onda-path-1"
        d="M0,192L60,170.7C120,149,240,107,360,112C480,117,600,171,720,186.7C840,203,960,181,1080,154.7C1200,128,1320,96,1380,80L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"
      ></path>
    </svg>
  </div>

  <!-- Barra Lateral Administrativa -->
  <aside class="sidebar">
    <a href="<?= e(url('admin')) ?>" class="logo" aria-label="Coffe Music Bar, panel principal"><?php require __DIR__.'/marca.php'; ?></a>

    <p class="etiqueta">ESPACIO DE TRABAJO</p>

    <nav aria-label="Administración">
      <a href="<?= e(url('admin')) ?>">◫ &nbsp; Dashboard</a>
      <a href="<?= e(url('admin/productos')) ?>">◉ &nbsp; Productos</a>

      <?php if ($actual['rol'] === 'administrador'): ?>
        <a href="<?= e(url('admin/categorias')) ?>">▦ &nbsp; Categorías</a>
        <a href="<?= e(url('admin/usuarios')) ?>">♙ &nbsp; Usuarios</a>
      <?php endif; ?>

      <a href="<?= e(url('admin/pedidos')) ?>">▤ &nbsp; Pedidos</a>
      <a href="<?= e(url('admin/reportes')) ?>">☷ &nbsp; Reportes y Facturas</a>
      <a href="<?= e(url('musica')) ?>">♫ &nbsp; Música del local</a>

      <?php if ($actual['rol'] === 'administrador'): ?>
        <a href="<?= e(url('admin/mensajes')) ?>">✉ &nbsp; Mensajes</a>
      <?php endif; ?>

      <a href="<?= e(url('perfil')) ?>">○ &nbsp; Mi perfil</a>
      <a href="<?= e(url()) ?>">↗ &nbsp; Ver sitio público</a>
    </nav>

    <!-- Botón de Contraste (contrast / brightness-medium / theme-light-dark) -->
    <div class="theme-actions">
      <button
        class="theme-rotator"
        id="theme-rotator"
        type="button"
        aria-label="Contraste"
        title="Contraste"
      >
        <span class="rotator-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="9"></circle>
            <path d="M12 3a9 9 0 0 0 0 18z" fill="currentColor"></path>
          </svg>
        </span>
      </button>
    </div>

    <div class="sidebar-perfil">
      <strong><?= e($actual['nombre']) ?></strong>
      <small><?= e($actual['rol']) ?></small>
      <form method="post" action="<?= e(url('salir')) ?>">
        <?= CsrfToken::campo() ?>
        <button class="secundario">Cerrar sesión</button>
      </form>
    </div>
  </aside>

  <!-- Panel Principal -->
  <main class="panel-main">
    <header class="panel-top">
      <span>COFFE MUSIC BAR / ADMINISTRACIÓN</span>
      <span><?= e(date('d/m/Y')) ?> · Bs.</span>
    </header>

    <?php
      require __DIR__ . '/aviso.php';
      require dirname(__DIR__) . '/' . $archivo . '.php';
    ?>
  </main>
</body>
</html>
