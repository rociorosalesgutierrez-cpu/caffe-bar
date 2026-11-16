param([string]$Base = 'http://127.0.0.1:8080')
$ErrorActionPreference = 'Stop'
function Token($page) {
    [regex]::Match($page.Content, 'name="csrf"\s+value="([^"]+)"').Groups[1].Value
}
function Login($user) {
    $session = New-Object Microsoft.PowerShell.Commands.WebRequestSession
    $page = Invoke-WebRequest "$Base/acceder" -WebSession $session -UseBasicParsing
    $result = Invoke-WebRequest "$Base/acceder" -Method Post -WebSession $session -UseBasicParsing -Body @{
        csrf    = (Token $page)
        usuario = $user
        clave   = 'CafeBar2026!'
    }
    if ($result.Content -match 'current-password|No se pudo completar la solicitud') {
        throw "Login failed: $user"
    }
    return @{
        Session = $session
        Page    = $result
    }
}
$portal = Invoke-WebRequest "$Base/" -UseBasicParsing
if ($portal.Content -match 'btn-toggle-play|mini-btn-play|Frank Sinatra') {
    throw 'Simulated player still public'
}
$photos = [regex]::Matches($portal.Content, 'src="([^"]+[.]jpg)"')
if ($photos.Count -lt 3) {
    throw 'Featured photos missing'
}
foreach ($photo in $photos) {
    $image = Invoke-WebRequest ([uri]::new([uri]$Base, $photo.Groups[1].Value)) -UseBasicParsing
    if ($image.StatusCode -ne 200 -or $image.Headers['Content-Type'] -notmatch '^image/jpeg') {
        throw 'Photo unavailable'
    }
}
$client = Login 'cliente'
$music = Invoke-WebRequest "$Base/musica" -WebSession $client.Session -UseBasicParsing
if ($music.Content -notmatch 'musica/sugerir' -or $music.Content -match '<audio|<iframe|musica-iniciar|mini-btn-play') {
    throw 'Client music interface incorrect'
}
foreach ($path in @('admin/musica/reproductor', 'admin/musica/control', 'admin/musica/encolar', 'admin/musica/moderar', 'admin/musica/agregar', 'admin/musica/activar')) {
    $denied = $false
    try {
        if ($path -eq 'admin/musica/reproductor') {
            Invoke-WebRequest "$Base/$path" -WebSession $client.Session -UseBasicParsing | Out-Null
        }
        else {
            Invoke-WebRequest "$Base/$path" -Method Post -WebSession $client.Session -UseBasicParsing -Body @{
                csrf = (Token $music)
            } | Out-Null
        }
    }
    catch {
        if ([int]$_.Exception.Response.StatusCode -eq 403) {
            $denied = $true
        }
        else {
            throw
        }
    }
    if (!$denied) {
        throw "Client has staff permission: $path"
    }
}
foreach ($role in @('admin', 'empleado')) {
    $staff = Login $role
    $player = Invoke-WebRequest "$Base/admin/musica/reproductor" -WebSession $staff.Session -UseBasicParsing
    if ($player.Content -notmatch 'id="musica-iniciar"') {
        throw "Player unavailable: $role"
    }
}
Write-Output 'OK login, JPG photos, client read-only playback interface and staff-only music controls'
