<?php
declare(strict_types=1);
final class PerfilController
{
    private array $usuario;
    public function __construct(){
        $this->usuario=AuthMiddleware::exigir();
    }
    public function index(): void {
        vista('admin/perfil',
        ['perfil'=>$this->usuario],
        $this->usuario['rol']!=='cliente'
    );
}
    public function guardar(): void {
        postAccion(function(): void {
            $nueva=empty($_POST['nueva_clave'])?null:Validador::clave($_POST,'nueva_clave');
            if($nueva!==null&&$nueva!==($_POST['confirmacion']??null))throw new DomainException('Las contraseñas nuevas no coinciden.');
            $actual=isset($_POST['clave_actual'])&&is_string($_POST['clave_actual'])?$_POST['clave_actual']:null;
            (new UsuarioModel())->perfil((int)$this->usuario['id'],Validador::persona($_POST),$actual,$nueva);
            if($nueva!==null)session_regenerate_id(true);
        },'perfil');
    }
}
