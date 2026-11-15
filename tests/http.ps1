param([string]$Base='http://127.0.0.1:8080')
$ErrorActionPreference='Stop'
function Token($Response) { return [regex]::Match($Response.Content,'name="csrf" value="([^"]+)"').Groups[1].Value }
function Login($Name) {
    $session=New-Object Microsoft.PowerShell.Commands.WebRequestSession
    $page=Invoke-WebRequest "$Base/acceder" -WebSession $session -UseBasicParsing
    $result=Invoke-WebRequest "$Base/acceder" -Method Post -WebSession $session -UseBasicParsing -Body @{csrf=(Token $page);usuario=$Name;clave='CafeBar2026!'}
    return @{Session=$session;Page=$result;Token=(Token $result)}
}
function Denied($Address,$Session) {
    $denied=$false
    try { Invoke-WebRequest $Address -WebSession $Session -UseBasicParsing | Out-Null }
    catch { if([int]$_.Exception.Response.StatusCode -eq 403){$denied=$true}else{throw} }
    if(!$denied){throw "Expected 403: $Address"}
}
$public=Invoke-WebRequest "$Base/" -UseBasicParsing
if($public.StatusCode -ne 200 -or $public.Content -notmatch 'CafeBar'){throw 'Public portal failed'}
foreach($path in @('nosotros','productos','contactos','acceder','registro','css/estilos.css','js/carrito.js','images/cafe.svg')) {
    if((Invoke-WebRequest "$Base/$path" -UseBasicParsing).StatusCode -ne 200){throw "Route failed: $path"}
}
$guest=Invoke-WebRequest "$Base/admin" -UseBasicParsing
if($guest.Content -notmatch 'autocomplete="current-password"'){throw 'Private middleware failed'}
$admin=Login 'admin'
foreach($path in @('admin','admin/productos','admin/categorias','admin/usuarios','admin/pedidos','admin/mensajes','perfil')) {
    if((Invoke-WebRequest "$Base/$path" -WebSession $admin.Session -UseBasicParsing).StatusCode -ne 200){throw "Admin route failed: $path"}
}
$stats=Invoke-RestMethod "$Base/admin/indicadores" -WebSession $admin.Session
if($stats.productos -ne 9 -or $stats.categorias -ne 4 -or $stats.usuarios -lt 3){throw 'Dashboard stats failed'}
$csrfDenied=$false
try {Invoke-WebRequest "$Base/admin/categorias/guardar" -Method Post -WebSession $admin.Session -UseBasicParsing -Body @{csrf='invalid';nombre='Invalid';descripcion='Invalid request';estado='1'} | Out-Null}
catch {if([int]$_.Exception.Response.StatusCode -eq 403){$csrfDenied=$true}else{throw}}
if(!$csrfDenied){throw 'CSRF check failed'}
$employee=Login 'empleado'
foreach($path in @('admin','admin/productos','admin/pedidos','perfil')){Invoke-WebRequest "$Base/$path" -WebSession $employee.Session -UseBasicParsing | Out-Null}
foreach($path in @('admin/categorias','admin/usuarios','admin/mensajes','carrito')){Denied "$Base/$path" $employee.Session}
$client=Login 'cliente'
foreach($path in @('admin','admin/productos','admin/categorias','admin/usuarios','admin/pedidos','admin/mensajes')){Denied "$Base/$path" $client.Session}
$cart=Invoke-WebRequest "$Base/carrito" -WebSession $client.Session -UseBasicParsing
$orderToken=[regex]::Match($cart.Content,'name="token" value="([^"]+)"').Groups[1].Value
$posted=Invoke-WebRequest "$Base/carrito/confirmar" -Method Post -WebSession $client.Session -UseBasicParsing -Body @{csrf=(Token $cart);token=$orderToken;items='{"1":2,"4":1}'}
if($posted.Content -notmatch 'data-clear-cart="1"'){throw 'Checkout did not confirm and clear cart'}
$id=[regex]::Match($posted.Content,'pedido[?]id=([0-9]+)').Groups[1].Value
if(!$id){throw 'Order id missing'}
$detail=Invoke-WebRequest "$Base/pedido?id=$id" -WebSession $client.Session -UseBasicParsing
if($detail.Content -notmatch '39,00'){throw 'Order total failed'}
$changed=Invoke-WebRequest "$Base/admin/pedidos/estado" -Method Post -WebSession $employee.Session -UseBasicParsing -Body @{csrf=$employee.Token;id=$id;estado='cancelado'}
if($changed.Content -notmatch 'cancelado'){throw 'Order cancellation failed'}
Invoke-WebRequest "$Base/salir" -Method Post -WebSession $client.Session -UseBasicParsing -Body @{csrf=(Token $detail)} | Out-Null
$after=Invoke-WebRequest "$Base/carrito" -WebSession $client.Session -UseBasicParsing
if($after.Content -notmatch 'autocomplete="current-password"'){throw 'Logout failed'}
Write-Output 'OK public routes, admin routes, stats, role isolation, CSRF, checkout, official total, cancellation and logout'
