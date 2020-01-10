<?php  
include("ler_json.php");

# elementos a serem verificados se existem no json
$index_keys = array("usuario","senha","db_hostname","db_port","database");

# lê o arquivo json com as credenciais de conexão ao banco
$db_credenciais = json2var("credenciais_banco.json", $index_keys);

$connection = mysqli_connect(
	$db_credenciais["db_hostname"],
	$db_credenciais["usuario"],
	$db_credenciais["senha"]
	);

if (mysqli_connect_errno()) {
    echo "Conexão falhou " . mysqli_connect_error();
	exit();
} else {
	#echo "Conexão com o banco estabelecida";
	echo "";
}
#$query_criar_database = "lalalalala; kkkkkk;aaaaa;";
$query_criar_database = "CREATE DATABASE IF NOT EXISTS controle_frios;";

$resultado = mysqli_query($connection, $query_criar_database);
if(!$resultado){
	print("Erro: " . mysqli_error($connection));
} else {
	echo "<br>Database criada com sucesso<br>";
}
// if (!$resultado) {
//     $message  = 'Requisição inválida: ' . mysql_error() . "\n";
//     $message .= 'Requisição inteira: ' . $query_criar_database;
//     die($message);
// }




mysqli_close($connection);
?>
