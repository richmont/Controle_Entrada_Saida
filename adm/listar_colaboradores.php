<script src='/controle_frios/js/validar_form.js'></script>
<script src="/controle_frios/js/submit_onclick.js"></script>

<?php  
require "../db/db_conexao.php";

function listar_colaboradores_array(){
	/**
	Consulta o banco, recebe todo o conteúdo da tabela Colaboradores
	ordena pelo id_colaborador, retorna ao usuário um array.
	*/
	global $conexao;
	$lista_colaboradores = [];
	$query_listar_colab = "SELECT * FROM colaboradores ORDER BY id_colaborador DESC;";
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
	$query_consultar_id_colab = 'SELECT id_colaborador, nome FROM colaboradores;';
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
				}else { # se não receber nenhuma coluna, representa tabela vazia
			echo "Tabela vazia, cadastre colaboradores";
		}
			}
		} 
function colaborador_matricula($id_colaborador){
	# consulta a matricula do colaborador informando o id
	global $conexao;
	$query_consultar_id_colab = 'SELECT id_colaborador, matricula FROM colaboradores;';
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
				}else { # se não receber nenhuma coluna, representa tabela vazia
			echo "Tabela vazia, cadastre colaboradores";
		}
			}
		}
?>