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

?>