<?php  
set_include_path($_SERVER['DOCUMENT_ROOT'] . "/controle_frios/") ;
require "adm/listar_colaboradores.php";

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

$id = $_GET["id_colaborador"];
$bool1 = empty($id);
// verifica se há valores recebidos por GET
if($bool1){
	echo "Insira os dados do colaborador na página anterior";

} else{
	if(colaborador_matricula($id) != NULL){
		apagar_colaborador($id);
	} else {
		echo "Colaborador ausente no banco de dados";
	}
	
}

?>
<button onclick="location.href='/controle_frios/adm/Colaborador.php'" class="btnColaborador" name="btnColaborador" id="btnColaborador" value="Colaborador" >Retornar a página Colaborador</button>