'use strict';
(() => {
  const buttons = document.querySelectorAll('.theme-rotator');
  function applyTheme(theme) {
    document.documentElement.dataset.theme = theme;
    try { localStorage.setItem('cafebar-theme', theme); } catch {}
    buttons.forEach(button => {
      const next = theme === 'dark' ? 'Activar tema claro' : 'Activar tema oscuro';
      button.setAttribute('aria-label', next);
      button.setAttribute('title', next);
      button.setAttribute('aria-pressed', String(theme === 'light'));
    });
  }
  applyTheme(document.documentElement.dataset.theme === 'light' ? 'light' : 'dark');
  buttons.forEach(button => button.addEventListener('click', () => applyTheme(document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark')));
  const menu = document.querySelector('.menu-toggle');
  const nav = document.querySelector('#navegacion');
  if (menu && nav) {
    const close = () => { menu.setAttribute('aria-expanded','false'); nav.classList.remove('abierto'); };
    menu.addEventListener('click', () => { const open = menu.getAttribute('aria-expanded') !== 'true'; menu.setAttribute('aria-expanded',String(open)); nav.classList.toggle('abierto',open); });
    document.addEventListener('keydown', event => { if (event.key === 'Escape' && menu.getAttribute('aria-expanded') === 'true') { close(); menu.focus(); } });
    document.addEventListener('click', event => { if (!event.target.closest('.cabecera')) close(); });
    window.matchMedia('(max-width:960px)').addEventListener('change',close);
  }
  document.querySelectorAll('.sidebar nav a, #navegacion a').forEach(a => {
    if (new URL(a.href).pathname === location.pathname) { a.classList.add('activo'); a.setAttribute('aria-current','page'); }
  });
})();
document.querySelectorAll('form').forEach(form => {
  form.addEventListener('submit', event => {
    form.querySelectorAll('input[type="password"]').forEach(input => input.setCustomValidity(new TextEncoder().encode(input.value).length > 72 ? 'La contraseña no puede superar 72 bytes.' : ''));
    const first = form.querySelector('[name="nueva_clave"], [name="clave"][minlength]');
    const second = form.querySelector('[name="confirmacion"]');
    if (first && second) second.setCustomValidity(first.value !== second.value ? 'Las contraseñas no coinciden.' : '');
    const file = form.querySelector('input[type="file"]');
    if (file) {
      const maximum = file.name === 'audio' ? 20971520 : 4194304;
      file.setCustomValidity(!file.disabled && file.files[0] && file.files[0].size > maximum ? (file.name === 'audio' ? 'El audio debe pesar como máximo 20 MB.' : 'La imagen debe pesar como máximo 4 MB.') : '');
    }
    if (!form.checkValidity()) { event.preventDefault(); form.reportValidity(); return; }
    if (form.dataset.confirm && !confirm(form.dataset.confirm)) event.preventDefault();
  });
  form.addEventListener('input', () => form.querySelectorAll('input').forEach(input => input.setCustomValidity('')));
});
const search = document.querySelector('#catalog-search');
const category = document.querySelector('#catalog-category');
const catalogStatus = document.querySelector('#catalog-status');
if (search && category) {
  search.addEventListener('input', () => {
    const query = search.value.trim().toLocaleLowerCase('es'); let visible = 0;
    document.querySelectorAll('[data-product-card]').forEach(card => { card.hidden = !card.dataset.name.includes(query); if (!card.hidden) visible++; });
    if (catalogStatus) catalogStatus.textContent = visible ? `${visible} opciones visibles. Pulsa Buscar para consultar toda la carta.` : 'Sin coincidencias en esta selección. Pulsa Buscar o restablece los filtros.';
  });
  category.addEventListener('change', () => category.form.requestSubmit());
}
const stats = document.querySelector('[data-stats-url]');
if (stats) {
  const status = document.querySelector('#stats-status');
  async function updateStats() {
    const controller = new AbortController(); const timeout = setTimeout(() => controller.abort(),8000);
    try {
      const response = await fetch(stats.dataset.statsUrl,{signal:controller.signal,cache:'no-store'});
      if (!response.ok || !response.headers.get('content-type')?.includes('application/json')) throw new Error('Sin conexión');
      const data = await response.json();
      Object.entries(data).forEach(([key,value]) => { const output = stats.querySelector('[data-stat="'+key+'"]'); if (output) output.textContent = String(value); });
      status.textContent = 'Actualizado a las '+new Date().toLocaleTimeString('es-BO');
    } catch { status.textContent = 'Sin actualización. Los indicadores visibles pueden estar desactualizados.'; }
    finally { clearTimeout(timeout); setTimeout(updateStats,10000); }
  }
  setTimeout(updateStats,10000);
}

// ==========================================
// Tocadiscos y Reproductor de Vinilo
// Simulación en vivo para caffe music bar
// ==========================================
(() => {
  const tocadiscos = document.querySelector('#tocadiscos-plato');
  const miniReproductor = document.querySelector('#mini-reproductor');

  if (!tocadiscos && !miniReproductor) {
    return;
  }

  const playlist = [
    {
      titulo: 'Fly Me to the Moon',
      artista: 'Frank Sinatra',
      genero: 'Classic Jazz & Lounge · 1964',
      duracion: 210
    },
    {
      titulo: "Don't Know Why",
      artista: 'Norah Jones',
      genero: 'Warm Acoustic & Café Soul · 2002',
      duracion: 185
    },
    {
      titulo: 'Feeling Good',
      artista: 'Nina Simone',
      genero: 'Timeless Soul & Bar Classic · 1965',
      duracion: 174
    },
    {
      titulo: 'Cold Little Heart',
      artista: 'Michael Kiwanuka',
      genero: 'Vintage Soul & Espresso Vibes · 2016',
      duracion: 215
    },
    {
      titulo: 'I Fall in Love Too Easily',
      artista: 'Chet Baker',
      genero: 'Cool Jazz & Midnight Sessions · 1954',
      duracion: 198
    },
    {
      titulo: 'So What',
      artista: 'Miles Davis',
      genero: 'Modal Jazz & Bar Atmosphere · 1959',
      duracion: 240
    }
  ];

  let currentIndex = 0;
  let isPlaying = true;
  let currentTime = 42;
  let timerInterval = null;
  let audioContext = null;
  let noiseNode = null;
  let isSoundActive = false;

  // Elementos del plato principal
  const vinilo = document.querySelector('#disco-vinilo');
  const labelArtista = document.querySelector('#vinilo-artista-label');
  const labelCancion = document.querySelector('#vinilo-cancion-label');
  const displayTitulo = document.querySelector('#reproductor-titulo');
  const displayArtista = document.querySelector('#reproductor-artista');
  const displayGenero = document.querySelector('#reproductor-genero');
  const displayTiempoActual = document.querySelector('#tiempo-actual');
  const displayTiempoTotal = document.querySelector('#tiempo-total');
  const progresoFill = document.querySelector('#progreso-fill');
  const btnToggle = document.querySelector('#btn-toggle-play');
  const playIcon = document.querySelector('#play-icon');
  const btnPrev = document.querySelector('#btn-prev');
  const btnNext = document.querySelector('#btn-next');
  const btnSound = document.querySelector('#btn-sound');
  const soundIcon = document.querySelector('#sound-icon');
  const estadoTexto = document.querySelector('#estado-texto');

  // Elementos del mini reproductor flotante
  const miniDisco = document.querySelector('#mini-disco');
  const miniArtista = document.querySelector('#mini-pista-artista');
  const miniCancion = document.querySelector('#mini-pista-titulo');
  const miniBtnPlay = document.querySelector('#mini-btn-play');

  function formatearTiempo(segundos) {
    const mins = Math.floor(segundos / 60);
    const secs = Math.floor(segundos % 60);
    return `${mins}:${secs.toString().padStart(2, '0')}`;
  }

  function actualizarTrack() {
    const track = playlist[currentIndex];
    currentTime = 0;

    // Actualizar nombre del artista y canción en la etiqueta central del disco
    if (labelArtista) {
      labelArtista.textContent = track.artista;
    }
    if (labelCancion) {
      labelCancion.textContent = track.titulo;
    }

    // Actualizar información en el panel del tocadiscos
    if (displayTitulo) {
      displayTitulo.textContent = track.titulo;
    }
    if (displayArtista) {
      displayArtista.textContent = track.artista;
    }
    if (displayGenero) {
      displayGenero.textContent = track.genero;
    }
    if (displayTiempoTotal) {
      displayTiempoTotal.textContent = formatearTiempo(track.duracion);
    }

    // Actualizar mini reproductor flotante
    if (miniArtista) {
      miniArtista.textContent = track.artista;
    }
    if (miniCancion) {
      miniCancion.textContent = track.titulo;
    }

    actualizarProgreso();
  }

  function actualizarProgreso() {
    const track = playlist[currentIndex];
    if (displayTiempoActual) {
      displayTiempoActual.textContent = formatearTiempo(currentTime);
    }
    if (progresoFill) {
      const porcentaje = Math.min(100, (currentTime / track.duracion) * 100);
      progresoFill.style.width = `${porcentaje.toFixed(1)}%`;
    }
  }

  function setPlaying(play) {
    isPlaying = play;

    // Control del disco de vinilo giratorio y brazo
    if (vinilo) {
      if (isPlaying) {
        vinilo.classList.add('girando');
        if (tocadiscos) {
          tocadiscos.classList.remove('pausado');
        }
      } else {
        vinilo.classList.remove('girando');
        if (tocadiscos) {
          tocadiscos.classList.add('pausado');
        }
      }
    }

    // Control del mini disco flotante
    if (miniDisco) {
      if (isPlaying) {
        miniDisco.classList.add('girando');
      } else {
        miniDisco.classList.remove('girando');
      }
    }

    // Iconos de reproducción
    if (playIcon) {
      playIcon.textContent = isPlaying ? '⏸' : '▶';
    }
    if (miniBtnPlay) {
      miniBtnPlay.textContent = isPlaying ? '⏸' : '▶';
    }
    if (estadoTexto) {
      estadoTexto.textContent = isPlaying ? 'Vinilo girando en vivo' : 'En pausa';
    }

    // Control del temporizador
    if (isPlaying) {
      iniciarProgreso();
      if (isSoundActive) {
        iniciarSonidoVinilo();
      }
    } else {
      detenerProgreso();
      detenerSonidoVinilo();
    }
  }

  function togglePlay() {
    setPlaying(!isPlaying);
  }

  function siguienteTrack() {
    currentIndex = (currentIndex + 1) % playlist.length;
    actualizarTrack();
  }

  function anteriorTrack() {
    currentIndex = (currentIndex - 1 + playlist.length) % playlist.length;
    actualizarTrack();
  }

  function tick() {
    const track = playlist[currentIndex];
    currentTime += 1;
    if (currentTime >= track.duracion) {
      siguienteTrack();
    } else {
      actualizarProgreso();
    }
  }

  function iniciarProgreso() {
    if (timerInterval) clearInterval(timerInterval);
    timerInterval = setInterval(tick, 1000);
  }

  function detenerProgreso() {
    if (timerInterval) {
      clearInterval(timerInterval);
      timerInterval = null;
    }
  }

  // Simulación de sonido de vinilo mediante Web Audio API
  function iniciarSonidoVinilo() {
    try {
      const AudioCtx = window.AudioContext || window.webkitAudioContext;
      if (!AudioCtx) return;
      if (!audioContext) {
        audioContext = new AudioCtx();
      }
      if (audioContext.state === 'suspended') {
        audioContext.resume();
      }

      if (noiseNode) return;

      const bufferSize = audioContext.sampleRate * 2;
      const buffer = audioContext.createBuffer(1, bufferSize, audioContext.sampleRate);
      const data = buffer.getChannelData(0);

      for (let i = 0; i < bufferSize; i++) {
        const white = Math.random() * 2 - 1;
        const crackle = Math.random() > 0.999 ? (Math.random() * 0.8) : 0;
        data[i] = (white * 0.015) + crackle;
      }

      noiseNode = audioContext.createBufferSource();
      noiseNode.buffer = buffer;
      noiseNode.loop = true;

      const filter = audioContext.createBiquadFilter();
      filter.type = 'lowpass';
      filter.frequency.setValueAtTime(800, audioContext.currentTime);

      const gain = audioContext.createGain();
      gain.gain.setValueAtTime(0.08, audioContext.currentTime);

      noiseNode.connect(filter);
      filter.connect(gain);
      gain.connect(audioContext.destination);

      noiseNode.start();
    } catch {
      // Audio no disponible
    }
  }

  function detenerSonidoVinilo() {
    if (noiseNode) {
      try {
        noiseNode.stop();
        noiseNode.disconnect();
      } catch {}
      noiseNode = null;
    }
  }

  function toggleSound() {
    isSoundActive = !isSoundActive;
    if (soundIcon) {
      soundIcon.textContent = isSoundActive ? '🔊' : '🔇';
    }
    if (isSoundActive && isPlaying) {
      iniciarSonidoVinilo();
    } else {
      detenerSonidoVinilo();
    }
  }

  // Listeners de eventos
  if (btnToggle) {
    btnToggle.addEventListener('click', togglePlay);
  }
  if (miniBtnPlay) {
    miniBtnPlay.addEventListener('click', togglePlay);
  }
  if (btnPrev) {
    btnPrev.addEventListener('click', anteriorTrack);
  }
  if (btnNext) {
    btnNext.addEventListener('click', siguienteTrack);
  }
  if (btnSound) {
    btnSound.addEventListener('click', toggleSound);
  }

  if (vinilo) {
    vinilo.style.cursor = 'pointer';
    vinilo.addEventListener('click', togglePlay);
  }

  actualizarTrack();
  setPlaying(true);
})();
