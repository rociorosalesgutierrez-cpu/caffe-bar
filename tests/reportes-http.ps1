param([string]$Base='http://127.0.0.1:8080')
$ErrorActionPreference='Stop'
function Login($user){
    $session=New-Object Microsoft.PowerShell.Commands.WebRequestSession
    $page=Invoke-WebRequest "$Base/acceder" -WebSession $session -UseBasicParsing
    $token=[regex]::Match($page.Content,'name="csrf" value="([^"]+)"').Groups[1].Value
    $panel=Invoke-WebRequest "$Base/acceder" -Method Post -WebSession $session -UseBasicParsing -Body @{csrf=$token;usuario=$user;clave='CafeBar2026!'}
    if($panel.Content -match 'autocomplete="current-password"'){throw "Login failed: $user"}
    return $session
}
$admin=Login 'admin'
$report=Invoke-WebRequest "$Base/admin/reportes" -WebSession $admin -UseBasicParsing
$first=(Get-Date).ToUniversalTime().ToString('yyyy-MM-01')
$today=(Get-Date).ToUniversalTime().ToString('yyyy-MM-dd')
if($report.Content -notmatch "name=`"desde`" value=`"$first`"" -or $report.Content -notmatch "name=`"hasta`" value=`"$today`""){throw 'Default report period missing'}
if($report.Content -notmatch 'data-print' -or $report.Content -match 'onclick='){throw 'Print button blocked by CSP'}
foreach($query in @('desde=2026-01-01','hasta=2026-01-31','desde=invalid&hasta=2026-02-30','desde[]=2026-01-01&hasta[]=2026-01-31','desde=2026-01-01&hasta=2026-01-31&estado=entregado')){
    $page=Invoke-WebRequest "$Base/admin/reportes?$query" -WebSession $admin -UseBasicParsing
    if($page.StatusCode -ne 200 -or $page.Content -notmatch 'Historial de Pedidos'){throw "Report filter failed: $query"}
}
foreach($query in @('','?desde=2026-01-01&hasta=2026-01-31&estado=entregado')){
    $csv=Invoke-WebRequest "$Base/admin/reportes/csv$query" -WebSession $admin -UseBasicParsing
    if($csv.Headers['Content-Type'] -notmatch 'text/csv' -or $csv.Headers['Content-Disposition'] -notmatch '[.]csv'){throw 'CSV download failed'}
    $body=if($csv.Content -is [byte[]]){[Text.Encoding]::UTF8.GetString($csv.Content)}else{[string]$csv.Content}
    if($body -notmatch 'RESUMEN GENERAL' -or $body -match 'Warning:|Deprecated:|No se pudo completar'){throw 'CSV invalid'}
}
$employee=Login 'empleado'
Invoke-WebRequest "$Base/admin/reportes" -WebSession $employee -UseBasicParsing | Out-Null
$client=Login 'cliente'
foreach($path in @('admin/reportes','admin/reportes/csv')){
    $denied=$false
    try{Invoke-WebRequest "$Base/$path" -WebSession $client -UseBasicParsing | Out-Null}
    catch{if([int]$_.Exception.Response.StatusCode -eq 403){$denied=$true}else{throw}}
    if(!$denied){throw "Client can read reports: $path"}
}
Write-Output 'OK reports without filters, partial/invalid filters, CSV export, staff access and client denial'
