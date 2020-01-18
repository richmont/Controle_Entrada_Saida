<script src='/controle_frios/js/validar_form.js'></script>
<script src="/controle_frios/js/submit_onclick.js"></script>
<div class="apagar_colaborador">
<form id='form_apagar_colab' action='apagar_colaborador.php'  class='form_apagar_colab' name='form_apagar_colab' method='get'>

		    <table>
		    <tr>
			    <th>id_colaborador</th>
			    <th>nome</th>
			    <th>matrícula</th>
			    <th>apagar</th>
			    <th>alterar</th>
		    </tr>


<?php  
require "../db/db_conexao.php";
$conexao = conectar_banco($db_credenciais);
mysqli_select_db ( $conexao , $db_credenciais["database"] );

function listar_colaboradores_tabela(){
	global $conexao;

	$query_listar_colab = "SELECT id_colaborador, nome, matricula FROM colaboradores ORDER BY id_colaborador DESC;";

	$r_listar_colab = mysqli_query($conexao, $query_listar_colab);

	if(!$r_listar_colab){
		print("Erro: " . mysqli_error($conexao));
	} else {
		if (mysqli_num_rows($r_listar_colab) > 0) {
		    // saída dos dados de cada coluna
		    while($coluna = mysqli_fetch_assoc($r_listar_colab)) {
		    	echo "<tr>";
		    	echo "<td>" . $coluna['id_colaborador'] . "</td>";
		    	echo "<td>" . $coluna['nome'] . "</td>";
		    	echo "<td>" . $coluna['matricula'] . "</td>";
		    	# input invisível cujo valor padrão é o id_colaborador da linha atual
		    	# permite enviar uma requisição GET com o id do colaborador a ser excluído do banco
		    	echo "
		    	<td>
			    	<input type='hidden' name='id_colaborador' value='" . $coluna['id_colaborador'] . "'>";

			    	echo "
			    	<input type='button' value='Apagar' onclick="
			    	. "\"submitOnClick(confirmarApagarColab('form_apagar_colab'),'form_apagar_colab')\"" .
			    	"></input>

			    	</tr>";
		    }
		    echo "</table></form></div>";
		} else {
		    echo "Nenhuma entrada";
			}
		
	}
}

function listar_colaboradores_array(){
	/**
	Consulta o banco, recebe todo o conteúdo da tabela Colaboradores
	ordena pelo id_colaborador, retorna ao usuário um array.
	*/
	global $conexao;
	$lista_colaboradores = array();
	$query_listar_colab = "SELECT id_colaborador, nome, matricula FROM colaboradores ORDER BY id_colaborador DESC;";

	$r_listar_colab = mysqli_query($conexao, $query_listar_colab);

	$array_tabela = array();
	if(!$r_listar_colab){
		print("Erro: " . mysqli_error($conexao));
	} else {
		if (mysqli_num_rows($r_listar_colab) > 0) {
		    // saída dos dados de cada coluna
		    while($coluna = mysqli_fetch_assoc($r_listar_colab)){
		    	# recebe linha por linha da consulta e insere no fim de um array
		    	 array_push($tabela, $coluna);
		    }
		    return $array_tabela;
		    
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