<?php
declare(strict_types=1);
final class PublicoController
{
    public function inicio(): void {
        $seleccion=[];
        foreach(array_reverse((new ProductoModel())->listar(true)) as $p){if(!isset($seleccion[$p['categoria_id']]))$seleccion[$p['categoria_id']]=$p;}
        vista('publico/inicio',['productos'=>array_slice(array_values($seleccion),0,3),'categorias'=>(new CategoriaModel())->listar(true)]);
    }
    public function nosotros(): void {vista('publico/nosotros');}
    public function productos(): void {
        $q=isset($_GET['q'])?Validador::texto($_GET,'q',0,120):'';
        $categoria=isset($_GET['categoria'])?Validador::entero($_GET,'categoria',0):0;
        vista('publico/productos',['productos'=>(new ProductoModel())->listar(true,$q,$categoria),'categorias'=>(new CategoriaModel())->listar(true),'q'=>$q,'categoria'=>$categoria]);
    }
    public function contactos(): void {vista('publico/contactos');}
    public function enviar(): void {
        postAccion(function(): void {
            Intentos::registrar('contacto',5,900);
            (new MensajeModel())->crear(Validador::texto($_POST,'nombre',3,120),Validador::correo($_POST),Validador::texto($_POST,'asunto',3,150),Validador::texto($_POST,'contenido',10,5000));
        },'contactos');
    }
}
