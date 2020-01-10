<?php  
include("ler_json.php");

# elementos a serem verificados se existem no json
$index_keys = array("usuario","senha","db_hostname","db_port","database");

# lê o arquivo json com as credenciais de conexão ao banco
$db_credenciais = json2var("credenciais_banco.json", $index_keys);

# conecta no banco
$connection = mysqli_connect(
	$db_credenciais["db_hostname"],
	$db_credenciais["usuario"],
	$db_credenciais["senha"]
	);

if (mysqli_connect_errno()) {
    echo "Conexão falhou " . mysqli_connect_error();
	exit();
} else {
	echo "Conexão com o banco estabelecida";
}


$query_criar_database = "CREATE DATABASE IF NOT EXISTS controle_frios;";

$r_criar_database = mysqli_query($connection, $query_criar_database);

if(!$r_criar_database){
	print("Erro: " . mysqli_error($connection));
} else {
	echo "<br>Database criada com sucesso<br>";
}
# seleciona a base recém criada como padrão
 mysqli_select_db ( $connection , $db_credenciais["database"] );


$query_criar_tabela_colaboradores =
	"CREATE TABLE IF NOT EXISTS Colaboradores ( 
	id_colaborador INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	nome VARCHAR(50) NOT NULL,
	matricula INT(9) NOT NULL);";

# cria a tabela de colaboradores
$r_criar_colab = mysqli_query($connection, $query_criar_tabela_colaboradores);
if(!$r_criar_colab){
	print("Erro: " . mysqli_error($connection));
} else {
	echo "<br>Tabela Colaboradores criada com sucesso<br>";
}

$query_criar_tabela_registro = 
	"CREATE TABLE IF NOT EXISTS Registro ( 
	id_registro int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	id_colaborador int(6) REFERENCES Colaboradores(id_colaborador),
	hora_entrada datetime,
	hora_saida datetime);";
	
$r_criar_registro = mysqli_query($connection, $query_criar_tabela_registro);
if(!$r_criar_registro){
	print("Erro: " . mysqli_error($connection));
} else {
	echo "<br>Tabela Registro criada com sucesso<br>";
}



mysqli_close($connection);
?>
