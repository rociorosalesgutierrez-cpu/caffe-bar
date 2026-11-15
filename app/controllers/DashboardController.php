<?php
declare(strict_types=1);
final class DashboardController
{
    private array $usuario;
    public function __construct() {$this->usuario=AuthMiddleware::exigir(['administrador','empleado']);}
    public function index(): void {vista('admin/dashboard',['indicadores'=>(new PedidoModel())->indicadores($this->usuario['rol']==='administrador')],true);}
    public function indicadores(): void {jsonRespuesta((new PedidoModel())->indicadores($this->usuario['rol']==='administrador'));}
}
