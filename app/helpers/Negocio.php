<?php
declare(strict_types=1);
final class Negocio
{
    public static function datos(): array
    {
        $d=require dirname(__DIR__).'/config/datos-negocio.php';
        foreach(['direccion'=>'COFFE_DIRECCION','maps_url'=>'COFFE_MAPS_URL','whatsapp'=>'COFFE_WHATSAPP'] as $clave=>$variable){
            $valor=getenv($variable);if($valor!==false&&$valor!=='')$d[$clave]=$valor;
        }
        return $d;
    }
    public static function whatsapp(): ?string
    {
        $d=self::datos();$numero=preg_replace('/[\s()+-]/','',$d['whatsapp']);
        if(!preg_match('/^[1-9][0-9]{7,14}$/D',$numero))return null;
        return 'https://wa.me/'.$numero.'?text='.rawurlencode($d['mensaje_whatsapp']);
    }
    public static function maps(): ?string
    {
        $d=self::datos();
        if($d['maps_url']!==''){
            $u=parse_url($d['maps_url']);$host=strtolower($u['host']??'');
            if(($u['scheme']??'')==='https'&&in_array($host,['maps.app.goo.gl','goo.gl','www.google.com','google.com','maps.google.com'],true)&&empty($u['user'])&&empty($u['pass']))return $d['maps_url'];
        }
        return $d['direccion']!==''?'https://www.google.com/maps/search/?api=1&query='.rawurlencode($d['direccion'].', '.$d['ciudad']):null;
    }
    public static function mapaIntegrado(): ?string
    {
        $d=self::datos();
        if(!empty($d['maps_embed'])&&!getenv('COFFE_DIRECCION')&&!getenv('COFFE_MAPS_URL')){
            $u=parse_url($d['maps_embed']);
            if(($u['scheme']??'')==='https'&&($u['host']??'')==='www.google.com'&&($u['path']??'')==='/maps/embed'&&empty($u['user'])&&empty($u['pass']))return $d['maps_embed'];
        }
        return $d['direccion']!==''?'https://maps.google.com/maps?q='.rawurlencode($d['direccion'].', '.$d['ciudad']).'&output=embed':null;
    }
}
