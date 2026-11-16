<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#221916">
<meta name="description" content="Coffe Music Bar: café, música y buena compañía. Explora nuestra carta y disfruta tu próximo buen momento.">
<meta name="csrf-token" content="<?= e(CsrfToken::valor()) ?>">
<title>Coffe Music Bar · Café, música y buena vibra</title>
<link rel="preload" href="<?= e(url('fonts/nunito-variable.ttf')) ?>" as="font" type="font/ttf" crossorigin>
<script src="<?= e(url('js/tema.js?v=3')) ?>"></script>
<link rel="stylesheet" href="<?= e(url('css/refinado.css?v=3')) ?>">
<link rel="stylesheet" href="<?= e(url('css/cristal.css?v=3')) ?>">
<link rel="stylesheet" href="<?= e(url('css/accesibilidad.css?v=4')) ?>">
<?php if(in_array($archivo,['publico/musica','admin/musica','admin/reproductor'],true)): ?>
<link rel="stylesheet" href="<?= e(url('css/musica.css?v=4')) ?>">
<script src="<?= e(url('js/musica.js?v=4')) ?>" defer></script>
<?php endif ?>
<?php if($archivo==='admin/reproductor'): ?><script src="<?= e(url('js/reproductor.js?v=4')) ?>" defer></script><?php endif ?>
<link rel="stylesheet" href="<?= e(url('css/responsive.css?v=2')) ?>">
<script src="<?= e(url('js/app.js?v=8')) ?>" defer></script>
<script src="<?= e(url('js/carrito.js?v=3')) ?>" defer></script>
