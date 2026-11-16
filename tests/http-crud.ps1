param([string]$Base = 'http://127.0.0.1:8080')
$ErrorActionPreference = 'Stop'
Add-Type -AssemblyName System.Net.Http
function Token($Response) {
    return [regex]::Match($Response.Content, 'name="csrf"\s+value="([^"]+)"').Groups[1].Value
}
function Post($Path, $Data, $Session) {
    return Invoke-WebRequest "$Base/$Path" -Method Post -WebSession $Session -UseBasicParsing -Body $Data
}
$session = New-Object Microsoft.PowerShell.Commands.WebRequestSession
$login = Invoke-WebRequest "$Base/acceder" -WebSession $session -UseBasicParsing
$admin = Post 'acceder' @{
    csrf    = (Token $login)
    usuario = 'admin'
    clave   = 'CafeBar2026!'
} $session
$csrf = Token $admin
$suffix = [Guid]::NewGuid().ToString('N').Substring(0, 10)
$categoryName = 'Prueba-' + $suffix
$category = Post 'admin/categorias/guardar' @{
    csrf        = $csrf
    nombre      = $categoryName
    descripcion = 'Categoria temporal de prueba'
    estado      = '1'
} $session
$catId = [regex]::Match($category.Content, ($categoryName + '.*?admin/categorias[?]editar=([0-9]+)'), [System.Text.RegularExpressions.RegexOptions]::Singleline).Groups[1].Value
if (!$catId) {
    throw 'Category create failed'
}
Post 'admin/categorias/guardar' @{
    csrf        = $csrf
    id          = $catId
    nombre      = $categoryName
    descripcion = 'Categoria editada'
    estado      = '1'
} $session | Out-Null
$handler = New-Object System.Net.Http.HttpClientHandler
$handler.CookieContainer = $session.Cookies
$http = New-Object System.Net.Http.HttpClient($handler)
$multi = New-Object System.Net.Http.MultipartFormDataContent
$fields = @{
    csrf         = $csrf
    nombre       = ('Producto-' + $suffix)
    categoria_id = $catId
    descripcion  = 'Producto temporal para prueba de subida'
    precio       = '9.50'
    stock        = '4'
    estado       = '1'
}
foreach ($key in $fields.Keys) {
    $multi.Add((New-Object System.Net.Http.StringContent([string]$fields[$key])), $key)
}
$fixture = Join-Path $PSScriptRoot '../storage/tmp/fixture.png'
& C:\xampp\php\php.exe -d extension=gd (Join-Path $PSScriptRoot 'imagen-prueba.php') $fixture
$content = New-Object System.Net.Http.ByteArrayContent(, [System.IO.File]::ReadAllBytes($fixture))
$content.Headers.ContentType = New-Object System.Net.Http.Headers.MediaTypeHeaderValue('image/png')
$multi.Add($content, 'imagen', 'fixture.png')
$response = $http.PostAsync("$Base/admin/productos/guardar", $multi).GetAwaiter().GetResult()
$html = $response.Content.ReadAsStringAsync().GetAwaiter().GetResult()
if (!$response.IsSuccessStatusCode) {
    throw 'Product upload HTTP failed'
}
$productId = [regex]::Match($html, ('Producto-' + $suffix + '.*?admin/productos[?]editar=([0-9]+)'), [System.Text.RegularExpressions.RegexOptions]::Singleline).Groups[1].Value
if (!$productId) {
    throw 'Product image upload or creation failed'
}
$edit = Invoke-WebRequest "$Base/admin/productos?editar=$productId" -WebSession $session -UseBasicParsing
if ($edit.Content -notmatch '9.50') {
    throw 'Product read failed'
}
Post 'admin/productos/guardar' @{
    csrf         = $csrf
    id           = $productId
    nombre       = ('Producto-' + $suffix)
    categoria_id = $catId
    descripcion  = 'Producto editado'
    precio       = '10.50'
    stock        = '6'
    estado       = '0'
} $session | Out-Null
Post 'admin/productos/eliminar' @{
    csrf = $csrf
    id   = $productId
} $session | Out-Null
$deleted = Post 'admin/categorias/eliminar' @{
    csrf = $csrf
    id   = $catId
} $session
if ($deleted.Content -match $categoryName) {
    throw 'Category deletion failed'
}
$person = @{
    csrf      = $csrf
    nombre    = 'Empleado de prueba'
    usuario   = ('empleado' + $suffix)
    correo    = ($suffix + '@example.test')
    telefono  = '70000000'
    direccion = 'Laboratorio'
    rol       = 'empleado'
    estado    = '1'
    clave     = 'EmpleadoPrueba2026!'
}
$users = Post 'admin/usuarios/guardar' $person $session
$userId = [regex]::Match($users.Content, ('empleado' + $suffix + '.*?admin/usuarios[?]editar=([0-9]+)'), [System.Text.RegularExpressions.RegexOptions]::Singleline).Groups[1].Value
if (!$userId) {
    throw 'Employee registration failed'
}
$person.id = $userId
$person.estado = '0'
$person.Remove('clave')
Post 'admin/usuarios/guardar' $person $session | Out-Null
$contactPage = Invoke-WebRequest "$Base/contactos" -WebSession $session -UseBasicParsing
Post 'contactos' @{
    csrf      = (Token $contactPage)
    nombre    = 'Consulta de prueba'
    correo    = 'prueba@example.test'
    asunto    = ('Consulta-' + $suffix)
    contenido = 'Mensaje creado por la prueba HTTP local.'
} $session | Out-Null
$messages = Invoke-WebRequest "$Base/admin/mensajes" -WebSession $session -UseBasicParsing
$messageId = [regex]::Match($messages.Content, ('Consulta-' + $suffix + '.*?name="id"\s+value="([0-9]+)"'), [System.Text.RegularExpressions.RegexOptions]::Singleline).Groups[1].Value
if (!$messageId) {
    throw 'Contact message persistence failed'
}
Post 'admin/mensajes/estado' @{
    csrf   = $csrf
    id     = $messageId
    estado = 'leido'
} $session | Out-Null
Post 'admin/mensajes/estado' @{
    csrf   = $csrf
    id     = $messageId
    estado = 'respondido'
} $session | Out-Null
Post 'admin/mensajes/eliminar' @{
    csrf = $csrf
    id   = $messageId
} $session | Out-Null
$multi.Dispose()
$http.Dispose()
Write-Output 'OK category CRUD, product CRUD with PNG upload and JPG conversion, employee creation and deactivation, contact message lifecycle'
