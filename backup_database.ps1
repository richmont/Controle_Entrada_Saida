<# 

#>
$mysql_bin = "C:\xampp\mysql\bin"
$data = Get-Date -UFormat "%d-%m-%Y"
$localizacao = "localhost"
$usuario = "root"
$senha = "<sua senha>"
$database = "controle_frios"
$local_backup = "C:\Users\<seu usuario>"

$comando = ".\mysqldump -h $localizacao -u $usuario --databases $database > $local_backup\$database-$data.sql -p$senha"


Set-Location -Path $mysql_bin
Invoke-Expression $comando