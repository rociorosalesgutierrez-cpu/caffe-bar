param([string]$Base='http://127.0.0.1:8080')
$ErrorActionPreference='Stop'
function Csrf($page){[regex]::Match($page.Content,'name="csrf" value="([^"]+)"').Groups[1].Value}
function Login($user,$password){
 $session=New-Object Microsoft.PowerShell.Commands.WebRequestSession
 $page=Invoke-WebRequest "$Base/acceder" -WebSession $session -UseBasicParsing
 $next=Invoke-WebRequest "$Base/acceder" -Method Post -WebSession $session -UseBasicParsing -Body @{csrf=(Csrf $page);usuario=$user;clave=$password}
 return @{Session=$session;Token=(Csrf $next);Page=$next}
}
$admin=Login 'jaqueline' 'jaqui123'
if($admin.Page.Content -notmatch 'data-stats-url'){throw 'Jaqueline admin login failed'}
$client=Login 'cliente' 'CafeBar2026!'
$music=Invoke-WebRequest "$Base/musica" -WebSession $client.Session -UseBasicParsing
if($music.Content -notmatch 'musica/sugerir'){throw 'Client suggestions missing'}
$forbidden=$false
try {Invoke-WebRequest "$Base/admin/musica/reproductor" -WebSession $client.Session -UseBasicParsing | Out-Null}
catch {if([int]$_.Exception.Response.StatusCode -eq 403){$forbidden=$true}else{throw}}
if(!$forbidden){throw 'Client can open local player'}
$player=Invoke-WebRequest "$Base/admin/musica/reproductor" -WebSession $admin.Session -UseBasicParsing
if($player.Content -notmatch 'reproductor-local' -or $player.Headers['Content-Security-Policy'] -notmatch 'www.youtube.com'){throw 'Player or YouTube CSP missing'}
$general=Invoke-WebRequest "$Base/" -UseBasicParsing
if($general.Headers['Content-Security-Policy'] -match 'youtube.com'){throw 'YouTube permission leaked to public pages'}
if($general.Content -notmatch 'Instituto T' -or $general.Content -notmatch 'google.com/maps[?]cid=5666542721018396729'){throw 'Maps missing'}
$suffix=[Guid]::NewGuid().ToString('N').Substring(0,8)
$title='PruebaMusical-'+$suffix
$suggested=Invoke-WebRequest "$Base/musica/sugerir" -Method Post -WebSession $client.Session -UseBasicParsing -Body @{csrf=(Csrf $music);titulo=$title;artista='Prueba de laboratorio';youtube='https://youtu.be/abcdefghijk'}
if($suggested.Content -notmatch $title){throw 'Suggestion not persisted'}
$staff=Invoke-WebRequest "$Base/musica" -WebSession $admin.Session -UseBasicParsing
$id=[regex]::Match($staff.Content,($title+'.*?name="id" value="([0-9]+)"'),[System.Text.RegularExpressions.RegexOptions]::Singleline).Groups[1].Value
if(!$id){throw 'Staff cannot see suggestion'}
$done=Invoke-WebRequest "$Base/admin/musica/moderar" -Method Post -WebSession $admin.Session -UseBasicParsing -Body @{csrf=$admin.Token;id=$id;accion='rechazar'}
$history=Invoke-WebRequest "$Base/musica" -WebSession $client.Session -UseBasicParsing
if($history.Content -notmatch 'rechazada'){throw 'Moderation not applied'}
$device='a'*64
$control=Invoke-RestMethod "$Base/admin/musica/control" -Method Post -WebSession $admin.Session -Body @{csrf=$admin.Token;accion='siguiente';dispositivo=$device}
Invoke-RestMethod "$Base/admin/musica/control" -Method Post -WebSession $admin.Session -Body @{csrf=$admin.Token;accion='liberar';dispositivo=$device} | Out-Null
$badCsrf=$false
try {Invoke-WebRequest "$Base/admin/musica/control" -Method Post -WebSession $admin.Session -UseBasicParsing -Body @{csrf='invalid';accion='siguiente';dispositivo=$device} | Out-Null}
catch {if([int]$_.Exception.Response.StatusCode -eq 403){$badCsrf=$true}else{throw}}
if(!$badCsrf){throw 'Invalid CSRF accepted'}
Write-Output 'OK Jaqueline login, client requests, staff moderation, player permissions, YouTube scoped CSP, CSRF and Maps'
