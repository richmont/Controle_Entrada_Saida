<# 

#>
$local_atual = Get-Location

$mysql_bin = "C:\xampp\mysql\bin"
$data = Get-Date -UFormat "%d-%m-%Y_%Hh%Mm"
$localizacao = "localhost"
$usuario = "root"
$senha = "<senha>"
$database = "controle_frios"
$local_backup = "C:\"
$log_file = "$database-$data.log" 
$output_file = "$database-$data.sql"
$comando = ".\mysqldump -h $localizacao -u $usuario --databases $database  -p$senha > $output_file 2> $local_backup$log_file "

Set-Location -Path $mysql_bin
Invoke-Expression $comando

if ( (get-childitem $log_file).length -eq 0 )
  {
    Compress-Archive -Path $output_file -CompressionLevel Optimal -DestinationPath $local_backup$output_file".zip"
    Remove-Item $output_file
    "Backup realizado com sucesso"

    
  }else{
    "Erro verifique o log"

  }

Set-Location $local_atual