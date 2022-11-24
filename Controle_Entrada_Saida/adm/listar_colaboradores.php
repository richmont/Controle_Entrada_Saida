<script src='/Controle_Entrada_Saida/js/validar_form.js'></script>
<script src="/Controle_Entrada_Saida/js/submit_onclick.js"></script>

<?php  

set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Entrada_Saida/") ;
include_once "db/db_conexao.php";

function listar_colaboradores_array(){
	/**
	Consulta o banco, recebe todo o conteúdo da tabela Colaboradores
	ordena pelo id_colaborador, retorna ao usuário um array.
	*/
	global $conexao;
	$lista_colaboradores = [];
	$query_listar_colab = "SELECT * FROM ch_colaboradores ORDER BY id_colaborador DESC;";
	$r_listar_colab = mysqli_query($conexao, $query_listar_colab);
	if(!$r_listar_colab){
		print("Erro: " . mysqli_error($conexao));
	} else {
		if (mysqli_num_rows($r_listar_colab) > 0) {
		    // saída dos dados de cada coluna
		    while($coluna = mysqli_fetch_assoc($r_listar_colab)){
		    	array_push($lista_colaboradores, $coluna);
		    }
		    return $lista_colaboradores;
		    
		}
	}
}

function colaborador_nome($id_colaborador){
	# consulta nome do colaborador informando o id
	global $conexao;
	$query_consultar_id_colab = 'SELECT id_colaborador, nome FROM ch_colaboradores;';
	$r_consultar_id_colab = mysqli_query($conexao, $query_consultar_id_colab);		
	if(!$r_consultar_id_colab){
			print("Erro: " . mysqli_error($conexao));
		} else {
			# se as colunas recebidas não forem igual a zero, continua
			if (mysqli_num_rows($r_consultar_id_colab) > 0) {
	    		# enquanto houverem colunas a serem consultadas, continua
			    while($coluna = mysqli_fetch_assoc($r_consultar_id_colab)) {
					if($coluna['id_colaborador'] == $id_colaborador){
						# id do colaborador encontrado
						$nome = $coluna['nome'];
						return $nome;
					} # se colaborador não for encontrado, retorna null por padrão
					}
				}else { # se não receber nenhum dado, retorna null
			return NULL;
		}
			}
		} 
function colaborador_matricula($id_colaborador){
	# consulta a matricula do colaborador informando o id
	global $conexao;
	$query_consultar_id_colab = 'SELECT id_colaborador, matricula FROM ch_colaboradores;';
	$r_consultar_id_colab = mysqli_query($conexao, $query_consultar_id_colab);		
	if(!$r_consultar_id_colab){
			print("Erro: " . mysqli_error($conexao));
		} else {
			# se as colunas recebidas não forem igual a zero, continua
			if (mysqli_num_rows($r_consultar_id_colab) > 0) {
	    		# enquanto houverem colunas a serem consultadas, continua
			    while($coluna = mysqli_fetch_assoc($r_consultar_id_colab)) {
					if($coluna['id_colaborador'] == $id_colaborador){
						# id do colaborador encontrado
						$matricula = $coluna['matricula'];
						return $matricula;
					} # se colaborador não for encontrado, retorna null por padrão
					}
				}else { # se não receber nenhuma coluna, retorna null
			return NULL;
		}
			}
		}
function colaborador_id_pelo_nome($nome){
	global $conexao;
	$query_consultar_id_colab = 'SELECT id_colaborador, nome FROM ch_colaboradores;';
	$r_consultar_id_colab = mysqli_query($conexao, $query_consultar_id_colab);		
	if(!$r_consultar_id_colab){
			print("Erro: " . mysqli_error($conexao));
		} else {
			# se as colunas recebidas não forem igual a zero, continua
			if (mysqli_num_rows($r_consultar_id_colab) > 0) {
	    		# enquanto houverem colunas a serem consultadas, continua
			    while($coluna = mysqli_fetch_assoc($r_consultar_id_colab)) {
					if($coluna['nome'] == $nome){
						# id do colaborador encontrado
						$id = $coluna['id_colaborador'];
						return $id;
					} # se colaborador não for encontrado, retorna null por padrão
					}
				}else { 
			return NULL;
		}
			}
}

function colaborador_id_pela_matricula($matricula){
	global $conexao;
	$query_consultar_id_colab = 'SELECT id_colaborador, matricula FROM ch_colaboradores;';
	$r_consultar_id_colab = mysqli_query($conexao, $query_consultar_id_colab);		
	if(!$r_consultar_id_colab){
			print("Erro: " . mysqli_error($conexao));
		} else {
			# se as colunas recebidas não forem igual a zero, continua
			if (mysqli_num_rows($r_consultar_id_colab) > 0) {
	    		# enquanto houverem colunas a serem consultadas, continua
			    while($coluna = mysqli_fetch_assoc($r_consultar_id_colab)) {
					if($coluna['matricula'] == $matricula){
						# id do colaborador encontrado
						$id = $coluna['id_colaborador'];
						return $id;
					} # se colaborador não for encontrado, retorna null por padrão
					}
				}else { # se não receber nenhuma coluna, representa tabela vazia
			return NULL;
		}
			}
}

?>