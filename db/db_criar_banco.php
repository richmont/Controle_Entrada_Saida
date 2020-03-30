<?php  
set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Entrada_Saida/") ;
include("db/ler_json.php");


# elementos a serem verificados se existem no json
$index_keys = array("usuario","senha","db_hostname","db_port","database");

# lê o arquivo json com as credenciais de conexão ao banco
$db_credenciais = json2var("credenciais_banco.json", $index_keys);
if($db_credenciais["senha"]=="password"){
	echo "<br>Senha padrão encontrada";
	echo "<br>Por favor, altere a senha para corresponder ao seu banco de dados";
	echo "<br>no arquivo credenciais_banco.json na pasta db";
}

# conecta no banco
function conectar_banco($db_credenciais){
	
	$conexao = mysqli_connect(
		$db_credenciais["db_hostname"],
		$db_credenciais["usuario"],
		$db_credenciais["senha"]
		);

	if (mysqli_connect_errno()) {
	    echo "Conexão falhou " . mysqli_connect_error();
		exit();
	} else {
		echo "Conexão com o banco estabelecida";
		return $conexao;
	}

}

function criar_database($conexao){
	$query_criar_database = "CREATE DATABASE IF NOT EXISTS controle_higiene";

	$r_criar_database = mysqli_query($conexao, $query_criar_database);

	if(!$r_criar_database){
		print("Erro: " . mysqli_error($conexao));
	} else {
		echo "<br>Database criada com sucesso<br>";
	}
}



function criar_tabela_colaboradores($conexao){
	$query_criar_tabela_colaboradores =
	"CREATE TABLE IF NOT EXISTS colaboradores ( 
	id_colaborador INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	nome VARCHAR(50) NOT NULL,
	matricula INT(9) NOT NULL);";

	# cria a tabela de colaboradores
	$r_criar_colab = mysqli_query($conexao, $query_criar_tabela_colaboradores);
	if(!$r_criar_colab){
		print("Erro: " . mysqli_error($conexao));
	} else {
		echo "<br>Tabela Colaboradores criada com sucesso<br>";
	}

}

function criar_tabela_registro($conexao){
	$query_criar_tabela_registro = 
	"CREATE TABLE IF NOT EXISTS registro ( 
	id_registro int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	id_colaborador int(6) REFERENCES colaboradores(id_colaborador),
	hora_entrada datetime,
	hora_saida datetime);";

	$r_criar_registro = mysqli_query($conexao, $query_criar_tabela_registro);
	if(!$r_criar_registro){
		print("Erro: " . mysqli_error($conexao));
	} else {
		echo "<br>Tabela Registro criada com sucesso<br>";
	}
}



$conexao = conectar_banco($db_credenciais);
criar_database($conexao);
# seleciona a base recém criada como padrão
mysqli_select_db ( $conexao , $db_credenciais["database"] );
criar_tabela_colaboradores($conexao);
criar_tabela_registro($conexao);
mysqli_close($conexao);
?>
