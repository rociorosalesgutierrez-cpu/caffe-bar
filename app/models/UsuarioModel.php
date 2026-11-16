<?php
declare(strict_types=1);
final class UsuarioModel
{
    public function buscar(int $id): array|false {return Conexion::consulta('SELECT id,nombre,usuario,correo,telefono,direccion,rol,estado FROM usuarios WHERE id=?',[$id])->fetch();}
    public function listar(string $buscar=''): array {
        $q='%'.$buscar.'%';return Conexion::consulta('SELECT id,nombre,usuario,correo,telefono,direccion,rol,estado FROM usuarios WHERE nombre LIKE ? OR usuario LIKE ? OR correo LIKE ? ORDER BY id DESC LIMIT 500',[$q,$q,$q])->fetchAll();
    }
    public function autenticar(string $usuario,string $clave): array|false {
        $u=Conexion::consulta('SELECT * FROM usuarios WHERE usuario=?',[$usuario])->fetch();
        $hash=$u['password_hash']??'$2y$10$R2xVBfMwa/LobobjsjhGSO8qu/YURDGjHwk4GbpdzR0eGOg3FUK7m';
        $valido=password_verify($clave,$hash);
        if(!$valido||!$u||!$u['estado'])return false;
        if(password_needs_rehash($hash,PASSWORD_DEFAULT))Conexion::consulta('UPDATE usuarios SET password_hash=? WHERE id=?',[password_hash($clave,PASSWORD_DEFAULT),$u['id']]);
        unset($u['password_hash']);return $u;
    }
    public function guardar(array $d,string $rol,int $estado,?int $id=null,?string $clave=null): int {
        $d=Validador::persona($d);
        $rol=Validador::opcion(['rol'=>$rol],'rol',['administrador','empleado','cliente']);
        $estado=Validador::entero(['estado'=>$estado],'estado',0,1);
        if($id!==null)$id=Validador::entero(['id'=>$id],'id');
        if($id===null)$clave=Validador::clave(['clave'=>$clave]);
        $pdo=Conexion::obtener();$pdo->beginTransaction();
        try {
            $admins=Conexion::consulta("SELECT id FROM usuarios WHERE rol='administrador' AND estado=1 ORDER BY id FOR UPDATE")->fetchAll();
            if($id){
                $anterior=Conexion::consulta('SELECT id,rol,estado FROM usuarios WHERE id=? FOR UPDATE',[$id])->fetch();
                if(!$anterior)throw new DomainException('Usuario inexistente.');
                if($anterior['rol']==='administrador'&&$anterior['estado']&&($rol!=='administrador'||!$estado)&&count($admins)<=1)throw new DomainException('Debe quedar al menos un administrador activo.');
                Conexion::consulta('UPDATE usuarios SET nombre=?,usuario=?,correo=?,telefono=?,direccion=?,rol=?,estado=? WHERE id=?',[...array_values($d),$rol,$estado,$id]);
            }else{
                if(!$clave)throw new DomainException('Falta la contraseña.');
                Conexion::consulta('INSERT INTO usuarios(nombre,usuario,correo,telefono,direccion,rol,estado,password_hash) VALUES(?,?,?,?,?,?,?,?)',[...array_values($d),$rol,$estado,password_hash($clave,PASSWORD_DEFAULT)]);
                $id=(int)$pdo->lastInsertId();
            }
            $pdo->commit();return $id;
        }catch(Throwable $e){$pdo->rollBack();throw $e;}
    }
    public function perfil(int $id,array $d,?string $actual,?string $nueva): void {
        $d=Validador::persona($d);
        if($nueva!==null)$nueva=Validador::clave(['clave'=>$nueva]);
        $pdo=Conexion::obtener();$pdo->beginTransaction();
        try {
            $u=Conexion::consulta('SELECT password_hash FROM usuarios WHERE id=? FOR UPDATE',[$id])->fetch();
            if(!$u)throw new DomainException('Usuario inexistente.');
            if($nueva!==null){
                if(!$actual||!password_verify($actual,$u['password_hash']))throw new DomainException('La contraseña actual es incorrecta.');
                Conexion::consulta('UPDATE usuarios SET password_hash=? WHERE id=?',[password_hash($nueva,PASSWORD_DEFAULT),$id]);
            }
            Conexion::consulta('UPDATE usuarios SET nombre=?,usuario=?,correo=?,telefono=?,direccion=? WHERE id=?',[...array_values($d),$id]);
            $pdo->commit();
        }catch(Throwable $e){$pdo->rollBack();throw $e;}
    }
}
