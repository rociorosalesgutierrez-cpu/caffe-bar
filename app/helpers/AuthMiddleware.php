<?php
declare(strict_types=1);
final class AuthMiddleware
{
    public static function usuario(): ?array {
        if(empty($_SESSION['uid']))return null;
        if(time()-($_SESSION['actividad']??0)>1800||time()-($_SESSION['inicio']??0)>28800){self::salir();return null;}
        $u=(new UsuarioModel())->buscar((int)$_SESSION['uid']);
        if(!$u||!$u['estado']){self::salir();return null;}
        $_SESSION['actividad']=time();return $u;
    }
    public static function exigir(array $roles=[]): array {
        $u=self::usuario();if(!$u)redirigir('acceder');
        if($roles&&!in_array($u['rol'],$roles,true)){http_response_code(403);throw new DomainException('No tienes permiso para acceder a este módulo.');}
        return $u;
    }
    public static function entrar(array $u): void {
        session_regenerate_id(true);
        $_SESSION=['uid'=>$u['id'],'inicio'=>time(),'actividad'=>time(),'csrf'=>bin2hex(random_bytes(32))];
    }
    public static function salir(): void {
        $_SESSION=[];
        if(ini_get('session.use_cookies')){
            $p=session_get_cookie_params();setcookie(session_name(),'', ['expires'=>time()-42000,'path'=>$p['path'],'secure'=>$p['secure'],'httponly'=>true,'samesite'=>'Lax']);
        }
        session_destroy();session_start();session_regenerate_id(true);
    }
}
