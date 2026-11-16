param([string]$Base = 'http://127.0.0.1:8080')
$ErrorActionPreference = 'Stop'
Add-Type -AssemblyName System.Net.Http
$session = New-Object Microsoft.PowerShell.Commands.WebRequestSession
$login = Invoke-WebRequest "$Base/acceder" -WebSession $session -UseBasicParsing
$csrf = [regex]::Match($login.Content, 'name="csrf"\s+value="([^"]+)"').Groups[1].Value
$panel = Invoke-WebRequest "$Base/acceder" -Method Post -WebSession $session -UseBasicParsing -Body @{
    csrf    = $csrf
    usuario = 'jaqueline'
    clave   = 'jaqui123'
}
$csrf = [regex]::Match($panel.Content, 'name="csrf"\s+value="([^"]+)"').Groups[1].Value
$title = 'PruebaAudio-' + [Guid]::NewGuid().ToString('N').Substring(0, 8)
$fixture = Join-Path $PSScriptRoot '../storage/tmp/prueba-audio.wav'
$writer = [IO.BinaryWriter]::new([IO.File]::Create($fixture))
try {
    $writer.Write([Text.Encoding]::ASCII.GetBytes('RIFF'))
    $writer.Write([int]16036)
    $writer.Write([Text.Encoding]::ASCII.GetBytes('WAVEfmt '))
    $writer.Write([int]16)
    $writer.Write([int16]1)
    $writer.Write([int16]1)
    $writer.Write([int]8000)
    $writer.Write([int]16000)
    $writer.Write([int16]2)
    $writer.Write([int16]16)
    $writer.Write([Text.Encoding]::ASCII.GetBytes('data'))
    $writer.Write([int]16000)
    $writer.Write([byte[]]::new(16000))
}
finally {
    $writer.Dispose()
}
$handler = New-Object System.Net.Http.HttpClientHandler
$handler.CookieContainer = $session.Cookies
$client = New-Object System.Net.Http.HttpClient($handler)
$form = New-Object System.Net.Http.MultipartFormDataContent
$fields = @{
    csrf    = $csrf
    titulo  = $title
    artista = 'Silencio de prueba'
    fuente  = 'archivo'
}
foreach ($key in $fields.Keys) {
    $form.Add((New-Object System.Net.Http.StringContent([string]$fields[$key])), $key)
}
$audio = New-Object System.Net.Http.ByteArrayContent(, [IO.File]::ReadAllBytes($fixture))
$audio.Headers.ContentType = New-Object System.Net.Http.Headers.MediaTypeHeaderValue('audio/wav')
$form.Add($audio, 'audio', 'prueba.wav')
$response = $client.PostAsync("$Base/admin/musica/agregar", $form).GetAwaiter().GetResult()
$html = $response.Content.ReadAsStringAsync().GetAwaiter().GetResult()
if (!$response.IsSuccessStatusCode -or $html -notmatch $title) {
    throw 'Audio upload failed'
}
$row = & C:\xampp\php\php.exe -r 'require ''app/helpers/Funciones.php''; echo json_encode(Conexion::consulta(''SELECT id,recurso FROM musica_canciones WHERE titulo=?'',[$argv[1]])->fetch());' $title | ConvertFrom-Json
if (!$row.id -or $row.recurso -notmatch '^uploads/musica/[a-f0-9]{40}[.]wav$') {
    throw 'Audio path not normalized'
}
$served = Invoke-WebRequest "$Base/$($row.recurso)" -UseBasicParsing
if ($served.StatusCode -ne 200 -or $served.Headers['Content-Type'] -notmatch '^audio/') {
    throw 'Audio not served as media'
}
Invoke-WebRequest "$Base/admin/musica/activar" -Method Post -WebSession $session -UseBasicParsing -Body @{
    csrf   = $csrf
    id     = $row.id
    activo = '0'
} | Out-Null
$form.Dispose()
$client.Dispose()
Write-Output 'OK WAV upload, MIME validation, random media path, HTTP audio and deactivation of fixture'
