<?php
declare(strict_types=1);
final class PedidoController
{
    private array $usuario;
    public function __construct(){$this->usuario=AuthMiddleware::exigir();}
    public function index(): void {
        AuthMiddleware::exigir(['administrador','empleado']);vista('admin/pedidos',['pedidos'=>(new PedidoModel())->listar(),'cliente'=>false],true);
    }
    public function mios(): void {AuthMiddleware::exigir(['cliente']);vista('admin/pedidos',['pedidos'=>(new PedidoModel())->listar((int)$this->usuario['id']),'cliente'=>true]);}
    public function detalle(): void {
        $cliente=$this->usuario['rol']==='cliente';
        vista('admin/pedido',['pedido'=>(new PedidoModel())->detalle(Validador::entero($_GET,'id'),$cliente?(int)$this->usuario['id']:null),'cliente'=>$cliente],!$cliente);
    }
    public function estado(): void {
        AuthMiddleware::exigir(['administrador','empleado']);
        postAccion(function(): void {(new PedidoModel())->estado(Validador::entero($_POST,'id'),Validador::opcion($_POST,'estado',['pendiente','preparando','entregado','cancelado']));},'admin/pedidos');
    }
}
