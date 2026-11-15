<?php
declare(strict_types=1);
final class MusicaModel
{
    public function catalogo(bool $todos=false): array
    {
        return Conexion::consulta('SELECT * FROM musica_canciones'.($todos?'':' WHERE activo=1').' ORDER BY titulo LIMIT 500')->fetchAll();
    }
    public function agregar(string $titulo,string $artista,string $fuente,string $recurso): void
    {
        Conexion::consulta('INSERT INTO musica_canciones(titulo,artista,fuente,recurso) VALUES(?,?,?,?)',[$titulo,$artista,$fuente,$recurso]);
    }
    public function activar(int $id,int $activo): void
    {
        Conexion::consulta('UPDATE musica_canciones SET activo=? WHERE id=?',[$activo,$id]);
    }
    public function sugerir(int $usuario,?int $cancion,string $titulo,string $artista,?string $youtube): void
    {
        $db=Conexion::obtener();$db->beginTransaction();
        try{
            $u=Conexion::consulta('SELECT rol,estado FROM usuarios WHERE id=? FOR UPDATE',[$usuario])->fetch();
            if(!$u||!$u['estado']||$u['rol']!=='cliente')throw new DomainException('Solo clientes activos pueden enviar sugerencias.');
            $n=(int)Conexion::consulta("SELECT COUNT(*) FROM musica_sugerencias WHERE usuario_id=? AND estado IN ('pendiente','en_cola','reproduciendo')",[$usuario])->fetchColumn();
            if($n>=3)throw new DomainException('Ya tienes tres sugerencias pendientes o en la cola. Espera tu turno.');
            $hoy=(int)Conexion::consulta('SELECT COUNT(*) FROM musica_sugerencias WHERE usuario_id=? AND creado>DATE_SUB(UTC_TIMESTAMP(),INTERVAL 1 DAY)',[$usuario])->fetchColumn();
            if($hoy>=10)throw new DomainException('Puedes sugerir hasta diez canciones cada 24 horas.');
            if($cancion){
                $c=Conexion::consulta('SELECT * FROM musica_canciones WHERE id=? AND activo=1',[$cancion])->fetch();
                if(!$c)throw new DomainException('La canción ya no está disponible.');
                $titulo=$c['titulo'];$artista=$c['artista'];$youtube=null;
            }
            $duplicada=Conexion::consulta("SELECT id FROM musica_sugerencias WHERE usuario_id=? AND titulo=? AND artista=? AND estado IN ('pendiente','en_cola','reproduciendo')",[$usuario,$titulo,$artista])->fetch();
            if($duplicada)throw new DomainException('Esa canción ya está entre tus sugerencias activas.');
            Conexion::consulta('INSERT INTO musica_sugerencias(usuario_id,cancion_id,titulo,artista,youtube_id) VALUES(?,?,?,?,?)',[$usuario,$cancion,$titulo,$artista,$youtube]);
            $db->commit();
        }catch(Throwable $e){$db->rollBack();throw $e;}
    }
    public function solicitudes(?int $usuario=null): array
    {
        $where=$usuario?' WHERE s.usuario_id=?':" WHERE s.estado IN ('pendiente','en_cola','reproduciendo')";
        return Conexion::consulta('SELECT s.*,u.nombre cliente FROM musica_sugerencias s JOIN usuarios u ON u.id=s.usuario_id'.$where.' ORDER BY s.id DESC LIMIT 100',$usuario?[$usuario]:[])->fetchAll();
    }
    public function moderar(int $id,int $moderador,bool $aprobar,?int $cancion): void
    {
        $db=Conexion::obtener();$db->beginTransaction();
        try{
            $s=Conexion::consulta('SELECT * FROM musica_sugerencias WHERE id=? FOR UPDATE',[$id])->fetch();
            if(!$s||$s['estado']!=='pendiente')throw new DomainException('La sugerencia ya fue atendida o no existe.');
            if(!$aprobar){Conexion::consulta("UPDATE musica_sugerencias SET estado='rechazada',moderador_id=? WHERE id=?",[$moderador,$id]);$db->commit();return;}
            $cancion=$cancion?:($s['cancion_id']?(int)$s['cancion_id']:null);
            if(!$cancion&&$s['youtube_id']){
                $this->agregar($s['titulo'],$s['artista'],'youtube',$s['youtube_id']);$cancion=(int)$db->lastInsertId();
            }
            if(!$cancion||!Conexion::consulta('SELECT id FROM musica_canciones WHERE id=? AND activo=1',[$cancion])->fetch())throw new DomainException('Selecciona un audio del catálogo o registra un enlace de YouTube para poder reproducirla.');
            Conexion::consulta("UPDATE musica_sugerencias SET estado='en_cola',cancion_id=?,moderador_id=?,aprobado=UTC_TIMESTAMP() WHERE id=?",[$cancion,$moderador,$id]);
            $db->commit();
        }catch(Throwable $e){$db->rollBack();throw $e;}
    }
    public function encolar(int $cancion,int $operador): void
    {
        $c=Conexion::consulta('SELECT * FROM musica_canciones WHERE id=? AND activo=1',[$cancion])->fetch();
        if(!$c)throw new DomainException('Canción no disponible.');
        Conexion::consulta("INSERT INTO musica_sugerencias(usuario_id,cancion_id,titulo,artista,estado,moderador_id,aprobado) VALUES(?,?,?,?,'en_cola',?,UTC_TIMESTAMP())",[$operador,$cancion,$c['titulo'],$c['artista'],$operador]);
    }
    public function estado(): array
    {
        $actual=Conexion::consulta("SELECT s.id,c.titulo,c.artista FROM musica_reproductor r JOIN musica_sugerencias s ON s.id=r.sugerencia_id JOIN musica_canciones c ON c.id=s.cancion_id WHERE r.id=1 AND s.estado='reproduciendo' AND r.actualizado>DATE_SUB(UTC_TIMESTAMP(),INTERVAL 45 SECOND)")->fetch();
        $cola=Conexion::consulta("SELECT s.id,c.titulo,c.artista FROM musica_sugerencias s JOIN musica_canciones c ON c.id=s.cancion_id WHERE s.estado='en_cola' AND c.activo=1 ORDER BY s.aprobado,s.id LIMIT 20")->fetchAll();
        return ['actual'=>$actual?:null,'cola'=>$cola];
    }
    private function pista(int $solicitud): array|false
    {
        return Conexion::consulta('SELECT s.id,c.titulo,c.artista,c.fuente,c.recurso,c.activo FROM musica_sugerencias s JOIN musica_canciones c ON c.id=s.cancion_id WHERE s.id=?',[$solicitud])->fetch();
    }
    public function siguiente(string $dispositivo,int $operador,?int $finalizada=null,string $resultado='reproducida'): ?array
    {
        $db=Conexion::obtener();$db->beginTransaction();
        try{
            $r=Conexion::consulta('SELECT * FROM musica_reproductor WHERE id=1 FOR UPDATE')->fetch();
            if(!$r)throw new DomainException('Instala primero las tablas de música.');
            $vigente=$r['actualizado']&&strtotime($r['actualizado'].' UTC')>time()-45;
            if($r['dispositivo']&&$r['dispositivo']!==$dispositivo&&$vigente)throw new DomainException('Otro reproductor está activo en el local. Detén esa sesión o espera 45 segundos.');
            Conexion::consulta('UPDATE musica_reproductor SET dispositivo=?,actualizado=UTC_TIMESTAMP() WHERE id=1',[$dispositivo]);
            if($finalizada!==null){
                if((int)$r['sugerencia_id']!==$finalizada)throw new DomainException('La pista actual cambió. Sincroniza el reproductor.');
                if(!in_array($resultado,['reproducida','omitida'],true))throw new DomainException('Resultado de reproducción inválido.');
                Conexion::consulta('UPDATE musica_sugerencias SET estado=? WHERE id=?',[$resultado,$finalizada]);
                Conexion::consulta('UPDATE musica_reproductor SET sugerencia_id=NULL WHERE id=1');$r['sugerencia_id']=null;
            }
            if($r['sugerencia_id']){
                $p=$this->pista((int)$r['sugerencia_id']);
                if($p&&$p['activo']){$db->commit();return $p;}
                Conexion::consulta("UPDATE musica_sugerencias SET estado='omitida' WHERE id=?",[$r['sugerencia_id']]);
            }
            while(true){
                $s=Conexion::consulta("SELECT s.id,s.cancion_id FROM musica_sugerencias s JOIN musica_canciones c ON c.id=s.cancion_id WHERE s.estado='en_cola' AND c.activo=1 ORDER BY s.aprobado,s.id LIMIT 1 FOR UPDATE")->fetch();
                if(!$s){
                    $c=Conexion::consulta('SELECT * FROM musica_canciones WHERE activo=1 AND id>? ORDER BY id LIMIT 1',[(int)($r['ultima_cancion_id']??0)])->fetch();
                    if(!$c)$c=Conexion::consulta('SELECT * FROM musica_canciones WHERE activo=1 ORDER BY id LIMIT 1')->fetch();
                    if(!$c){Conexion::consulta('UPDATE musica_reproductor SET sugerencia_id=NULL WHERE id=1');$db->commit();return null;}
                    $this->encolar((int)$c['id'],$operador);continue;
                }
                Conexion::consulta("UPDATE musica_sugerencias SET estado='reproduciendo' WHERE id=?",[$s['id']]);
                Conexion::consulta('UPDATE musica_reproductor SET sugerencia_id=?,ultima_cancion_id=? WHERE id=1',[$s['id'],$s['cancion_id']]);
                $p=$this->pista((int)$s['id']);$db->commit();return $p?:null;
            }
        }catch(Throwable $e){if($db->inTransaction())$db->rollBack();throw $e;}
    }
    public function latido(string $dispositivo): bool
    {
        Conexion::consulta('UPDATE musica_reproductor SET actualizado=UTC_TIMESTAMP() WHERE id=1 AND dispositivo=?',[$dispositivo]);
        return (bool)Conexion::consulta('SELECT id FROM musica_reproductor WHERE id=1 AND dispositivo=?',[$dispositivo])->fetch();
    }
    public function liberar(string $dispositivo): void
    {
        Conexion::consulta('UPDATE musica_reproductor SET dispositivo=NULL,actualizado=NULL WHERE id=1 AND dispositivo=?',[$dispositivo]);
    }
}
