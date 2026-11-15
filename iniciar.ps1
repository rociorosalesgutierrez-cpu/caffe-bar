$ErrorActionPreference='Stop'
Set-Location -LiteralPath $PSScriptRoot
$phpCommand=Get-Command php -ErrorAction SilentlyContinue
if($phpCommand){$phpExecutable=$phpCommand.Source}
elseif(Test-Path -LiteralPath 'C:\xampp\php\php.exe'){$phpExecutable='C:\xampp\php\php.exe'}
else{throw 'PHP 8+ no se encuentra en PATH ni en C:\xampp\php.'}
if(!(Test-Path -LiteralPath 'app/config/local.php') -and !$env:CAFEBAR_DSN){throw 'Configura app/config/local.php o ejecuta database/instalar.php primero.'}
New-Item -ItemType Directory -Force storage/tmp,public/uploads/productos,public/uploads/musica | Out-Null
$gd=& $phpExecutable -r 'echo extension_loaded(''gd'') ? ''1'' : ''0'';'
$phpOptions=@()
if($gd -eq '0'){$phpOptions+=@('-d','extension=gd')}
$phpOptions+=@('-d',('upload_tmp_dir='+ (Join-Path $PSScriptRoot 'storage/tmp')),'-d','upload_max_filesize=20M','-d','post_max_size=24M')
Write-Output 'CafeBar MVC: http://127.0.0.1:8080/ | Detener: Ctrl+C'
& $phpExecutable @phpOptions -S 127.0.0.1:8080 -t public public/router.php
