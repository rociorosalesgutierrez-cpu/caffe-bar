'use strict';
(() => {
  const root=document.querySelector('#reproductor-local');if(!root)return;
  const audio=document.querySelector('#audio-local'),start=document.querySelector('#musica-iniciar'),skip=document.querySelector('#musica-siguiente'),stop=document.querySelector('#musica-detener'),message=document.querySelector('#reproductor-mensaje');
  const bytes=crypto.getRandomValues(new Uint8Array(32));const device=Array.from(bytes,b=>b.toString(16).padStart(2,'0')).join('');
  let track=null,running=false,busy=false,youtube=null,youtubePromise=null,heartbeat=null,waiting=null,failures=0,failedId=null;
  function say(text){message.textContent=text;}
  async function api(action,extra={}){
    const controller=new AbortController();const timeout=setTimeout(()=>controller.abort(),10000);
    try{
      const body=new URLSearchParams({accion:action,dispositivo:device,csrf:document.querySelector('meta[name="csrf-token"]').content,...extra});
      const response=await fetch(root.dataset.control,{method:'POST',body,signal:controller.signal,headers:{Accept:'application/json'}});
      if(!response.headers.get('content-type')?.includes('application/json'))throw new Error('La sesión terminó. Vuelve a iniciar sesión.');
      const data=await response.json();if(!response.ok)throw new Error(data.error||'No se pudo sincronizar la música.');return data;
    }finally{clearTimeout(timeout);}
  }
  function pauseMedia(){audio.pause();if(youtube?.pauseVideo)youtube.pauseVideo();const d=document.querySelector('#admin-disco-vinilo');if(d)d.classList.remove('girando');}
  function ensureYoutube(){
    if(youtubePromise)return youtubePromise;
    youtubePromise=new Promise((resolve,reject)=>{
      const timeout=setTimeout(()=>reject(new Error('YouTube no respondió. Revisa la conexión o usa audio local.')),15000);
      window.onYouTubeIframeAPIReady=()=>{
        youtube=new YT.Player('youtube-local',{host:'https://www.youtube.com',width:'100%',height:'300',playerVars:{playsinline:1,origin:location.origin},events:{
          onReady:()=>{clearTimeout(timeout);resolve(youtube);},
          onStateChange:event=>{if(!running||track?.fuente!=='youtube')return;if(event.data===1){failures=0;say('Reproducción en curso. La siguiente canción se cargará automáticamente.');}if(event.data===0)advance('reproducida');},
          onAutoplayBlocked:()=>say('Pulsa Reproducir / reanudar o el botón de reproducción del video para habilitar el sonido.'),
          onError:()=>{if(running&&track?.fuente==='youtube')mediaError('YouTube no permite reproducir esta canción.');}
        }});
      };
      const script=document.createElement('script');script.src='https://www.youtube.com/iframe_api';script.async=true;script.onerror=()=>{clearTimeout(timeout);reject(new Error('No se pudo cargar YouTube.'));};document.head.append(script);
    });return youtubePromise;
  }
  async function loadTrack(next){
    if(!running)return;
    pauseMedia();track=next;
    document.querySelector('#pista-titulo').textContent=next?.titulo||'El catálogo está vacío.';
    document.querySelector('#pista-artista').textContent=next?.artista||'Añade canciones y se reproducirán automáticamente.';
    const adminDisco=document.querySelector('#admin-disco-vinilo');
    const adminArtista=document.querySelector('#admin-vinilo-artista');
    const adminCancion=document.querySelector('#admin-vinilo-cancion');
    if(adminArtista)adminArtista.textContent=next?.artista||'caffe music';
    if(adminCancion)adminCancion.textContent=next?.titulo||'en vivo';
    if(adminDisco){if(next)adminDisco.classList.add('girando');else adminDisco.classList.remove('girando');}
    skip.disabled=!next;start.textContent=next?'Reproducir / reanudar ▶':'Buscar canciones ▶';
    audio.hidden=!next||next.fuente!=='archivo';document.querySelector('#youtube-contenedor').hidden=!next||next.fuente!=='youtube';
    if(!next){say('Sin canciones activas. El reproductor volverá a consultar en diez segundos.');waiting=setTimeout(()=>advance(),10000);return;}
    if(next.fuente==='archivo'){
      audio.src=next.url;audio.load();
      try{await audio.play();failures=0;say('Reproducción en curso. La siguiente canción se cargará automáticamente.');}
      catch(error){if(error.name==='NotAllowedError')say('Pulsa Reproducir / reanudar o el botón del audio para habilitar el sonido.');else mediaError('El audio no pudo reproducirse.');}
    }else{
      const player=await ensureYoutube();if(!running)return;player.loadVideoById(next.recurso);say('Cargando YouTube. Si no comienza, pulsa el botón del video.');
    }
  }
  async function advance(result){
    if(!running||busy)return;busy=true;clearTimeout(waiting);
    try{
      pauseMedia();const extra=track&&result?{finalizada:String(track.id),resultado:result}:{};
      const data=await api('siguiente',extra);if(running)await loadTrack(data.pista);
    }catch(error){running=false;clearInterval(heartbeat);pauseMedia();say(error.message||'Sin conexión. Pulsa Iniciar música para volver a intentarlo.');start.textContent='Iniciar música ▶';skip.disabled=true;}
    finally{busy=false;}
  }
  function mediaError(text){
    if(!track||failedId===track.id)return;failedId=track.id;
    failures++;say(text);
    if(failures>=3){halt();say('Tres pistas no pudieron reproducirse. Revisa los enlaces o audios antes de reiniciar.');return;}
    setTimeout(()=>advance('omitida'),300);
  }
  async function halt(){running=false;clearTimeout(waiting);clearInterval(heartbeat);pauseMedia();start.textContent='Iniciar música ▶';skip.disabled=true;stop.disabled=true;say('Música detenida. Puedes volver a iniciarla desde este equipo.');try{await api('liberar');}catch{}}
  start.addEventListener('click',async()=>{
    if(busy)return;
    if(running&&track){if(track.fuente==='archivo'){try{await audio.play();say('Reproducción en curso.');}catch{say('Usa el botón del audio para iniciar la reproducción.');}}else if(youtube)youtube.playVideo();return;}
    running=true;failures=0;stop.disabled=false;await advance();
    if(running){clearInterval(heartbeat);heartbeat=setInterval(async()=>{try{const result=await api('latido');if(!result.ok)throw new Error('Otro equipo tomó el control del reproductor.');}catch(error){running=false;pauseMedia();clearInterval(heartbeat);say(error.message||'Sin conexión. La música se ha pausado.');start.textContent='Iniciar música ▶';}},12000);}
  });
  skip.addEventListener('click',()=>advance('omitida'));stop.addEventListener('click',halt);
  audio.addEventListener('ended',()=>{if(running&&track?.fuente==='archivo')advance('reproducida');});
  audio.addEventListener('error',()=>{if(running&&track?.fuente==='archivo')mediaError('El archivo de audio no está disponible.');});
  window.addEventListener('pagehide',()=>{pauseMedia();if(running){const body=new URLSearchParams({accion:'liberar',dispositivo:device,csrf:document.querySelector('meta[name="csrf-token"]').content});navigator.sendBeacon(root.dataset.control,body);}});
})();
