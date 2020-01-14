<?php  
require "../db/db_conexao.php";
$conexao = conectar_banco($db_credenciais);
mysqli_select_db ( $conexao , $db_credenciais["database"] );

function listar_colaboradores(){
	global $conexao;

	$query_listar_colab = "SELECT id_colaborador, nome, matricula FROM colaboradores ORDER BY id_colaborador DESC;";

	$r_listar_colab = mysqli_query($conexao, $query_listar_colab);

	if(!$r_listar_colab){
		print("Erro: " . mysqli_error($conexao));
	} else {
		if (mysqli_num_rows($r_listar_colab) > 0) {
		    // saída dos dados de cada coluna
		    while($coluna = mysqli_fetch_assoc($r_listar_colab)) {
		        echo "id_colaborador: " . $coluna["id_colaborador"]. " - Name: " . $coluna["nome"]. " " . $coluna["matricula"]. "<br>";
		    }
		} else {
		    echo "0 results";
			}
		
	}
}	
listar_colaboradores();



?>