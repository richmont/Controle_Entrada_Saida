<# 
Script powershell simples para execução do MYSQLDUMP e compactação em zip
#>

# guarda o local atual do terminal Powershell antes de executar o comando
$local_atual = Get-Location
# local dos executáveis MySQL
$mysql_bin = "C:\xampp\mysql\bin"

# data de hoje em formado dia-mes-ano_hora_minuto
$data = Get-Date -UFormat "%d-%m-%Y_%Hh%Mm"
# endereço do servidor mysql
$localizacao = "localhost"
# credenciais
$usuario = "root"
$senha = "<sua senha>"
# base de dados a receber backup
$database = "controle_higiene"
# local onde vai ser armazenado o backup e o log
$local_backup = "C:\ProgramData\"
# nome do arquivo de log e do backup
$log_file = "$database-$data.log" 
$output_file = "$database-$data.sql"
# comando completo do mysqldump
$comando = ".\mysqldump -h $localizacao -u $usuario --databases $database  -p$senha > $output_file 2> $log_file "
# define localização para pasta de executáveis do mysql
Set-Location -Path $mysql_bin
# executa o comando
Invoke-Expression $comando
# checa se o arquivo de log é maior que 0 bytes
if ( (get-childitem $log_file).length -eq 0 )
  {
    # se o arquivo de log não reportar erros, 
    # compacta o backup em formato SQL para zip, e copia pra pasta de backup
    Compress-Archive -Path $output_file -CompressionLevel Optimal -DestinationPath $local_backup$output_file".zip"
    # remove o arquivo de backup SQL da pasta de executáveis do MySQL
    Remove-Item $output_file
    Remove-Item $log_file
    "Backup realizado com sucesso"
  }else{
    # imprime na tela um aviso para verificar o log, pois houve um erro no backup
    Copy-Item $log_file $local_backup
    "Erro verifique o log"

  }
# retorna o caminho do terminal Powershell para onde estava antes de rodar o comando
Set-Location $local_atual