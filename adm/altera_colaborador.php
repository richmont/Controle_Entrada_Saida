<?php  
set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Entrada_Saida/") ;
require_once "adm/listar_colaboradores.php";
require_once "adm/listar_setor.php";
function alterar_setor_colaborador($matricula, $id_setor){
    global $conexao;
    $query_alterar_setor = "UPDATE ch_colaborador SET setor = '". $id_setor . "' WHERE matricula = ". $matricula;
    $r_alterar_setor = mysqli_query($conexao, $query_alterar_setor);
	if(!$r_alterar_setor){
		print("Erro: " . mysqli_error($conexao));
	} else {
		if (mysqli_num_rows($r_alterar_setor) > 0) {
		    // saída dos dados de cada coluna
		    while($coluna = mysqli_fetch_assoc($r_alterar_setor)){
		    	$num_colaboradores_setor =  $coluna["num_colaboradores"];
		    }
		    return $num_colaboradores_setor;
		    
		}
	}
}
echo empty($_REQUEST["matricula"]);

$bool_id_setor = empty($_REQUEST["id_setor"]);
$bool_matricula = empty($_REQUEST["matricula"]);
// verifica se há valores recebidos por GET
if($bool_id_setor != 0 | $bool_matricula != 0){
	echo "Dados ausentes";
} else{
    $matricula = $_GET["matricula"];
    $id_setor = $_GET["id_setor"];
    echo "id_setor recebido: ".$id_setor;
	if(colaborador_id_pela_matricula($matricula) != NULL){
        if(numero_colaboradores_setor($id_setor) !=NULL){
            alterar_setor_colaborador($matricula, $id_setor);
            
        } else {
            echo "Setor ausente no banco de dados";
        }
        
	} else {
		echo "Colaborador ausente no banco de dados";
	}
	
}

?>
<button onclick="location.href='/Controle_Entrada_Saida/adm/Colaborador.php'" class="btnColaborador" name="btnColaborador" id="btnColaborador" value="Colaborador" >Retornar a página Colaborador</button>