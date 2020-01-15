<?php  
require "../db/db_conexao.php";
$conexao = conectar_banco($db_credenciais);
mysqli_select_db ( $conexao , $db_credenciais["database"] );


function apagar_colaborador($id_colaborador){
	global $conexao;


	$query_apagar_colab = "DELETE FROM `colaboradores` WHERE id_colaborador = " . $id_colaborador . ";";

	$r_apagar_colab = mysqli_query($conexao, $query_apagar_colab);

	if(!$r_apagar_colab){
		print("Erro: " . mysqli_error($conexao));
	} else {

		echo "Colaborador deletado com sucesso";

	}
}


$bool1 = empty($_GET["id_colaborador"]);
// verifica se há valores recebidos por GET
if($bool1){
	echo "Insira os dados do colaborador na página anterior";

} else{
	apagar_colaborador($_GET["id_colaborador"]);
}

?>
<button onclick="location.href='/controle_frios/adm/Colaborador.php'" class="btnColaborador" name="btnColaborador" id="btnColaborador" value="Colaborador" >Retornar a página Colaborador</button>