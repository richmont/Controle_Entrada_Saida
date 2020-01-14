<?php  
include("ler_json.php");


# elementos a serem verificados se existem no json
$index_keys = array("usuario","senha","db_hostname","db_port","database");

# lê o arquivo json com as credenciais de conexão ao banco
$db_credenciais = json2var(dirname(__FILE__) . "/credenciais_banco.json", $index_keys);

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
		#echo "Conexão com o banco estabelecida";
		return $conexao;
	}

}

$conexao = conectar_banco($db_credenciais);
mysqli_select_db ( $conexao , $db_credenciais["database"] );
?>