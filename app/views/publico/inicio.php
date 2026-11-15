<section class="hero" aria-labelledby="hero-title"><div class="hero-texto"><div class="music-chip"><span class="ecualizador" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></span> Tu pausa tiene su propio ritmo.</div><p class="etiqueta"><span class="mini-linea"></span> COFFE MUSIC BAR · ORURO</p><h1 id="hero-title">Buen café.<br><em>Buena vibra.</em></h1><p class="entradilla">Un café que abraza, tu música favorita y algo rico en la mesa. Ven a bajar el ritmo y a disfrutar lo que de verdad importa.</p><div class="acciones"><a class="boton" href="<?= e(url('productos')) ?>">Se me antoja un café <span aria-hidden="true">↗</span></a><a class="texto-link" href="<?= e(url('nosotros')) ?>">Conócenos <span aria-hidden="true">→</span></a></div><div class="hero-firma"><span class="firma-icono" aria-hidden="true">♫</span><p>Sabores que se disfrutan.<br><strong>Momentos que se quedan.</strong></p><span class="firma-coordenada">CAFÉ<br>& MÚSICA</span></div></div>
<div class="hero-visual"><div class="foto-marco"><img class="hero-foto" src="<?= e(url('images/wego-hero.png')) ?>" alt="Café latte y un croissant en una mesa cálida, imagen conceptual de Coffe Music Bar" width="1122" height="1402" fetchpriority="high"><span class="foto-indice">UN SORBO. UNA CANCIÓN. TU MOMENTO.</span><div class="foto-caption"><span>LO BUENO SE DISFRUTA SIN PRISA</span><strong>Quédate por otra canción.</strong></div></div><div class="sello" aria-hidden="true">COFFE<br><span>&</span><br>GOOD VIBES</div><span class="hero-vertical" aria-hidden="true">COFFE MUSIC BAR — DISFRUTA EL MOMENTO</span></div></section>
<div class="banda-valores"><span><b aria-hidden="true">✦</b> Café con carácter</span><span><b aria-hidden="true">✦</b> Sabores para compartir</span><span><b aria-hidden="true">♫</b> El ritmo lo pones tú</span><span><b aria-hidden="true">✦</b> Un ratito para ti</span></div>

<!-- Sección Tocadiscos y Vinilo en Vivo: Reproducción simulada con nombre de artista -->
<section class="seccion tocadiscos-seccion" id="reproductor-vivo">
  <div class="tarjeta tocadiscos-card">
    <div class="tocadiscos-contenedor">
      <!-- Plato del Tocadiscos con Vinilo Giratorio -->
      <div class="tocadiscos-plato" id="tocadiscos-plato">
        <div class="tocadiscos-brazo" id="tocadiscos-brazo" aria-hidden="true"></div>
        <div class="disco-vinilo girando" id="disco-vinilo" aria-label="Disco de vinilo girando con música del local">
          <div class="vinilo-surcos"></div>
          <div class="vinilo-etiqueta">
            <span class="vinilo-logo">caffe music</span>
            <span class="vinilo-centro"></span>
            <strong class="vinilo-artista" id="vinilo-artista-label">Frank Sinatra</strong>
            <small class="vinilo-cancion" id="vinilo-cancion-label">Fly Me to the Moon</small>
          </div>
        </div>
      </div>

      <!-- Información de la Pista y Controles -->
      <div class="tocadiscos-info">
        <div class="en-vivo-badge">
          <span class="punto-vivo"></span>
          <span>SONANDO AHORA EN EL LOCAL</span>
        </div>

        <h2 class="pista-activa-titulo" id="reproductor-titulo">Fly Me to the Moon</h2>
        <p class="pista-activa-artista" id="reproductor-artista">Frank Sinatra</p>
        <span class="pista-activa-genero" id="reproductor-genero">Classic Jazz & Coffee Lounge · 1964</span>

        <!-- Ecualizador de ondas animado -->
        <div class="ecualizador-ondas" id="ecualizador-ondas" aria-hidden="true">
          <span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span>
        </div>

        <!-- Barra de progreso -->
        <div class="progreso-contenedor">
          <span id="tiempo-actual">1:24</span>
          <div class="barra-progreso">
            <div class="barra-progreso-fill" id="progreso-fill" style="width: 42%;"></div>
          </div>
          <span id="tiempo-total">3:30</span>
        </div>

        <!-- Botones de Control Interactivos -->
        <div class="controles-reproductor">
          <button type="button" class="btn-control" id="btn-prev" title="Canción anterior" aria-label="Canción anterior">⏮</button>
          <button type="button" class="btn-control btn-play" id="btn-toggle-play" title="Pausar o reproducir" aria-label="Pausar o reproducir">
            <span id="play-icon">⏸</span>
          </button>
          <button type="button" class="btn-control" id="btn-next" title="Siguiente canción" aria-label="Siguiente canción">⏭</button>
          <span class="separador-control"></span>
          <button type="button" class="btn-control" id="btn-sound" title="Sonido ambiente de cafetería" aria-label="Sonido ambiente">
            <span id="sound-icon">🔊</span>
          </button>
          <span class="estado-reproduccion" id="estado-texto">Vinilo girando en vivo</span>
        </div>

        <p class="muted" style="margin-top: 1.2rem; font-size: 0.82rem;">
          ♫ Cada visita a <strong>caffe music bar</strong> tiene su propia banda sonora. ¿Quieres elegir? <a class="texto-link" href="<?= e(url('musica')) ?>">Pide tu canción aquí →</a>
        </p>
      </div>
    </div>
  </div>
</section>
<section class="seccion categorias-inicio" aria-labelledby="categorias-titulo"><div class="titulo-seccion"><div><p class="etiqueta">SIGUE TU ANTOJO</p><h2 id="categorias-titulo">¿A qué sabe tu plan?</h2></div><span class="muted">Algo rico para cada momento.</span></div><div class="categorias-grid"><?php foreach($categorias as $indice=>$c): ?><a class="categoria-tile" href="<?= e(url('productos?categoria='.$c['id'])) ?>"><span class="categoria-numero"><?= e(str_pad((string)($indice+1),2,'0',STR_PAD_LEFT)) ?></span><strong><?= e($c['nombre']) ?></strong><span class="categoria-flecha" aria-hidden="true">↗</span></a><?php endforeach ?></div></section>
<section class="seccion favoritos" aria-labelledby="favoritos-titulo"><div class="titulo-seccion"><div><p class="etiqueta">BUENAS COMBINACIONES</p><h2 id="favoritos-titulo">Dale gusto a tu día.</h2></div><a class="texto-link" href="<?= e(url('productos')) ?>">Ver toda la carta <span aria-hidden="true">↗</span></a></div><?php require __DIR__.'/tarjetas.php'; ?></section>
<section class="ritual"><div class="ritual-numero" aria-hidden="true">♫</div><div><p class="etiqueta">CAFÉ EN LA MESA. MÚSICA EN EL ALMA.</p><h2>Tu lugar.<br>Tu gente.<br><em>Tu buena vibra.</em></h2><p>Una charla que se alarga. Esa canción que te sabes de memoria. El primer sorbo de café. En Coffe Music Bar nos gustan los pequeños planes que se convierten en grandes momentos.</p><a class="texto-link" href="<?= e(url('nosotros')) ?>">Descubre nuestra esencia →</a></div></section>
<section class="invitacion"><div><p class="etiqueta">LA VIDA SUENA MEJOR CON CAFÉ</p><h2>Hoy toca<br><em>disfrutarte.</em></h2><p>Elige tus favoritos, arma tu pedido y deja el resto en pausa.</p></div><div class="invitacion-accion"><a class="boton" href="<?= e(url($actual?'productos':'registro')) ?>"><?= $actual?'Elegir mis favoritos':'Me sumo al plan' ?> <span aria-hidden="true">↗</span></a><span>Un buen momento empieza aquí.</span></div></section>
