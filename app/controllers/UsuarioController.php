<?php
declare(strict_types=1);
final class UsuarioController
{
    private array $usuario;
    public function __construct(){$this->usuario=AuthMiddleware::exigir(['administrador']);}
    public function index(): void {
        $m=new UsuarioModel();$q=isset($_GET['q'])?Validador::texto($_GET,'q',0,120):'';
        vista('admin/usuarios',['usuarios'=>$m->listar($q),'editar'=>isset($_GET['editar'])?$m->buscar(Validador::entero($_GET,'editar')):null,'q'=>$q],true);
    }
    public function guardar(): void {
        postAccion(function(): string {
            $id=empty($_POST['id'])?null:Validador::entero($_POST,'id');$rol=Validador::opcion($_POST,'rol',['administrador','empleado','cliente']);$estado=Validador::entero($_POST,'estado',0,1);
            if($id===$this->usuario['id']&&($rol!=='administrador'||!$estado))throw new DomainException('No puedes desactivar tu propia cuenta ni retirar tu rol administrativo.');
            $guardado=(new UsuarioModel())->guardar(Validador::persona($_POST),$rol,$estado,$id,$id?null:Validador::clave($_POST));
            return 'Usuario #'.$guardado.($id?' actualizado':' registrado').' correctamente.';
        },'admin/usuarios');
    }
}
