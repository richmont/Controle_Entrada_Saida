<?php 
set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Entrada_Saida/") ;
include_once "db/db_conexao.php";


function setor_id_pelo_nome_setor($nome){
	global $conexao;
	$query_consultar_id_setor = 'SELECT id_setor, nome_setor FROM ch_setor;';
	$r_consultar_id_setor = mysqli_query($conexao, $query_consultar_id_setor);		
	if(!$r_consultar_id_setor){
			print("Erro: " . mysqli_error($conexao));
		} else {
			# se as colunas recebidas não forem igual a zero, continua
			if (mysqli_num_rows($r_consultar_id_setor) > 0) {
	    		# enquanto houverem colunas a serem consultadas, continua
			    while($coluna = mysqli_fetch_assoc($r_consultar_id_setor)) {
					if($coluna['nome_setor'] == $nome){
						# id do setor encontrado
						$id = $coluna['id_setor'];
						return $id;
					} # se setor não for encontrado, retorna null por padrão
					}
				}else { 
			return NULL;
		}
			}
}

function listar_setor_array(){
	/**
	Consulta o banco, recebe todo o conteúdo da tabela setor
	ordena pelo id_setor, retorna ao usuário um array.
	*/
	global $conexao;
	$lista_setor = [];
	$query_listar_setor = "SELECT * FROM ch_setor ORDER BY id_setor DESC;";
	$r_listar_setor = mysqli_query($conexao, $query_listar_setor);
	if(!$r_listar_setor){
		print("Erro: " . mysqli_error($conexao));
	} else {
		if (mysqli_num_rows($r_listar_setor) > 0) {
		    // saída dos dados de cada coluna
		    while($coluna = mysqli_fetch_assoc($r_listar_setor)){
		    	array_push($lista_setor, $coluna);
		    }
		    return $lista_setor;
		    
		}
	}
}

function numero_colaboradores_setor($id_setor){
	/**
    Consulta quantos colaboradores estão vinculados a um setor
    setor recebido por parametro
	*/
	global $conexao;
	$query_listar_setor = "SELECT count(ch_colaboradores.setor) as num_colaboradores from ch_colaboradores where ch_colaboradores.setor = ". $id_setor;
	$r_listar_setor = mysqli_query($conexao, $query_listar_setor);
	if(!$r_listar_setor){
		print("Erro: " . mysqli_error($conexao));
	} else {
		if (mysqli_num_rows($r_listar_setor) > 0) {
		    // saída dos dados de cada coluna
		    while($coluna = mysqli_fetch_assoc($r_listar_setor)){
		    	$num_colaboradores_setor =  $coluna["num_colaboradores"];
		    }
		    return $num_colaboradores_setor;
		    
		}
	}
}


?>