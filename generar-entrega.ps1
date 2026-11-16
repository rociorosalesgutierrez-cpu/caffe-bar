param([switch]$SoloCodigo)

$ErrorActionPreference = 'Stop'
$project = $PSScriptRoot
$files = @(
    'database/cafebar_mvc.sql'
    'database/musica.sql'
    'database/actualizar-musica.php'
    'public/index.php'
    'public/.htaccess'
    'app/config/Config.php'
    'core/Conexion.php'
    'app/config/local.example.php'
    'app/config/datos-negocio.php'
    'app/helpers/Funciones.php'
    'app/helpers/AuthMiddleware.php'
    'app/helpers/CsrfToken.php'
    'app/helpers/Validador.php'
    'app/helpers/Intentos.php'
    'app/helpers/Imagen.php'
    'app/helpers/Negocio.php'
    'app/helpers/AudioArchivo.php'
    'app/models/UsuarioModel.php'
    'app/models/CategoriaModel.php'
    'app/models/ProductoModel.php'
    'app/models/PedidoModel.php'
    'app/models/MensajeModel.php'
    'app/models/MusicaModel.php'
    'app/controllers/PublicoController.php'
    'app/controllers/AuthController.php'
    'app/controllers/CarritoController.php'
    'app/controllers/DashboardController.php'
    'app/controllers/ProductoController.php'
    'app/controllers/CategoriaController.php'
    'app/controllers/UsuarioController.php'
    'app/controllers/PedidoController.php'
    'app/controllers/MensajeController.php'
    'app/controllers/PerfilController.php'
    'app/controllers/MusicaController.php'
    'app/views/layouts/cabecera.php'
    'app/views/layouts/aviso.php'
    'app/views/layouts/publico.php'
    'app/views/layouts/admin.php'
    'app/views/layouts/marca.php'
    'app/views/publico/inicio.php'
    'app/views/publico/nosotros.php'
    'app/views/publico/productos.php'
    'app/views/publico/tarjetas.php'
    'app/views/publico/contactos.php'
    'app/views/publico/carrito.php'
    'app/views/publico/error.php'
    'app/views/publico/musica.php'
    'app/views/auth/acceder.php'
    'app/views/auth/registro.php'
    'app/views/admin/campos-persona.php'
    'app/views/admin/dashboard.php'
    'app/views/admin/productos.php'
    'app/views/admin/categorias.php'
    'app/views/admin/usuarios.php'
    'app/views/admin/pedidos.php'
    'app/views/admin/pedido.php'
    'app/views/admin/mensajes.php'
    'app/views/admin/perfil.php'
    'app/views/admin/musica.php'
    'app/views/admin/reproductor.php'
    'public/css/estilos.css'
    'public/css/refinado.css'
    'public/css/cristal.css'
    'public/css/accesibilidad.css'
    'public/css/musica.css'
    'public/js/tema.js'
    'public/js/app.js'
    'public/js/carrito.js'
    'public/js/musica.js'
    'public/js/reproductor.js'
    'public/fonts/OFL-Nunito.txt'
    'public/images/cafe.svg'
    'public/images/jugo.svg'
    'public/images/postre.svg'
    'public/images/sandwich.svg'
    'public/images/logo.svg'
    'public/uploads/productos/.htaccess'
    'public/uploads/musica/.htaccess'
    'public/router.php'
    'database/instalar.php'
    'iniciar.ps1'
    'tests/integracion.php'
    'tests/concurrencia.php'
    'tests/http.ps1'
    'tests/http-crud.ps1'
    'tests/imagen-prueba.php'
    'tests/musica.php'
    'tests/musica-http.ps1'
    'tests/audio-http.ps1'
    'tests/contraste.js'
    '.gitignore'
    'README.md'
    'VERIFICACION.md'
    'DISENO-WEGO.md'
    'DISENO-COFFE.md'
    'MUSICA-Y-UBICACION.md'
    'generar-entrega.ps1'
    'app/controllers/ReporteController.php'
    'app/models/ReporteModel.php'
    'app/views/admin/factura.php'
    'app/views/admin/reportes.php'
    'public/css/responsive.css'
    'public/css/styles.css'
    'styles.css'
    'tests/regresiones.php'
    'tests/reportes-http.ps1'
    'tests/responsive-musica-http.ps1'
    'tests/usuarios.php'
    '.editorconfig'
    'app/controllers/ConsultaController.php'
    'app/helpers/ImporteLiteral.php'
    'app/views/publico/mensajes.php'
    'database/actualizar-contactos.php'
    'public/css/factura.css'
    'tests/importe-literal.php'
    'tests/impresion.js'
    'core/Aplicacion.php'
    'core/Autocargador.php'
    'core/Enrutador.php'
    'core/README.md'
    'core/Vista.php'
    'core/inicio.php'
    'core/rutas.php'
    'public/images/LICENCIAS.md'
    'public/js/pedidos.js'
    'tests/pedidos.js'
)
$text = New-Object System.Text.StringBuilder
[void]$text.AppendLine('# CafeBar MVC: construccion y codigo completo')
[void]$text.AppendLine('')
[void]$text.AppendLine('## 1. Crear estructura desde PowerShell')
[void]$text.AppendLine('```powershell')
[void]$text.AppendLine('New-Item -ItemType Directory -Force cafebar-mvc/database, cafebar-mvc/app/config, cafebar-mvc/app/helpers, cafebar-mvc/app/models, cafebar-mvc/app/controllers, cafebar-mvc/app/views/layouts, cafebar-mvc/app/views/publico, cafebar-mvc/app/views/auth, cafebar-mvc/app/views/admin, cafebar-mvc/public/css, cafebar-mvc/public/js, cafebar-mvc/public/images, cafebar-mvc/public/uploads/productos, cafebar-mvc/tests')
foreach ($file in $files) {
    [void]$text.AppendLine(('New-Item -ItemType File -Force cafebar-mvc/{0}' -f $file))
}
[void]$text.AppendLine('Set-Location cafebar-mvc')
[void]$text.AppendLine('```')
$section = 2
foreach ($file in $files) {
    $lang = switch ([IO.Path]::GetExtension($file)) {
        '.php' {
            'php'
        } '.sql' {
            'sql'
        } '.css' {
            'css'
        } '.js' {
            'javascript'
        } '.svg' {
            'xml'
        } '.ps1' {
            'powershell'
        } default {
            'text'
        }
    }
    [void]$text.AppendLine('')
    [void]$text.AppendLine(('## {0}. {1}' -f $section, $file))
    [void]$text.AppendLine(('````{0}' -f $lang))
    [void]$text.AppendLine([IO.File]::ReadAllText((Join-Path $project $file)))
    [void]$text.AppendLine('````')
    $section++
}
$codigoCompleto = $text.ToString().Replace("`r`n", "`n")
$codigoCompleto = [regex]::Replace($codigoCompleto, '(?m)[ \t]+$', '')
[IO.File]::WriteAllText((Join-Path $project 'CODIGO-COMPLETO.md'), $codigoCompleto, (New-Object Text.UTF8Encoding($false)))
if ($SoloCodigo) {
    Write-Output 'Codigo actualizado: CODIGO-COMPLETO.md.'
    return
}

Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem
$zipPath = Join-Path (Split-Path $project -Parent) 'cafebar-mvc-entrega.zip'
$zipStream = [IO.File]::Open($zipPath, [IO.FileMode]::Create, [IO.FileAccess]::ReadWrite)
$zip = New-Object IO.Compression.ZipArchive($zipStream, [IO.Compression.ZipArchiveMode]::Create)
try {
    $imagenes = Get-ChildItem -LiteralPath (Join-Path $project 'public/images') -File | Where-Object { $_.Extension -in @('.jpg', '.jpeg', '.png', '.webp') }
    $archivosImagen = $imagenes | ForEach-Object { 'public/images/' + $_.Name }
    $archivosZip = $files + @('CODIGO-COMPLETO.md', 'public/fonts/nunito-variable.ttf') + $archivosImagen

    foreach ($file in $archivosZip) {
        [IO.Compression.ZipFileExtensions]::CreateEntryFromFile($zip, (Join-Path $project $file), ('cafebar-mvc/' + $file)) | Out-Null
    }
}
finally {
    $zip.Dispose()
}
Write-Output 'Entrega creada: CODIGO-COMPLETO.md y cafebar-mvc-entrega.zip.'
