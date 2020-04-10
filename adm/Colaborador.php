<html>

<link rel="stylesheet" type="text/css" href="../css/Colaborador.css">
<script src="/Controle_Entrada_Saida/js/esconder_elemento.js"></script>
<script type="module" src="/Controle_Entrada_Saida/js/submit_onclick.js"></script>
<script src='/Controle_Entrada_Saida/js/validar_form.js'></script>
<head><title>Colaborador</title></head>

<body>

<?php  
set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Entrada_Saida/") ;
require("static/cabecalho_adm.php");

/**
CRUD completo da tabela Colaboradores

botão para criar cadastro do colaborador
lista de colaboradores
ao lado de cada nome, um botão para apagar cadastro
**/
?>

	<!-- 
	Botão que roda a função em js para alterar o atributo display, de hidden para block
	-->
	<input type="button" class="btnMostrarFormCadastro" name="btnMostrarCadastro" value="Cadastrar Colaborador" onclick="esconderElemento('form_in_colab')"></input>
	<input type="button" class="btnRelatorioGeral" name="btnRelatorioGeral" value="Gerar relatório geral" onclick="location.href = 'gerar_relatorio.php';"></input>
	<div id="form_in_colab" class="form_in_colab" style="display: none;">
		<form action="cadastro_colaborador.php" method="get" id="form_colaborador">
			<ul>
				<li>Nome: <input type="text" name="nome" id="inputNome"></li>
				<li>Matrícula: <input type="text" name="matricula" id="inputMatricula"></li>
				<li><input type="submit" value="Cadastrar" onfocus="validar_cadastro()" onmouseover="validar_cadastro()"></input></li>
				
			</ul>
		</form>
		
</div>
<br>
<!-- listagem dos colaboradores deve estar dentro do formulário para apagar -->
<div class="apagar_colaborador">
	<form id='form_apagar_colab' action='apagar_colaborador.php'  class='form_apagar_colab' name='form_apagar_colab' method='get'>
		<input type='hidden' name='id_colaborador' id="valor_form_apagar" value=''>
			    <table>
			    <tr>
					<th>Marcar</th>
				    <th>id</th>
				    <th>Nome</th>
				    <th>Matrícula</th>
				    <!--<th>Apagar</th> -->
			    </tr>
			<?php  
			/**
			importa e executa a função listar operadores
			*/
			require "listar_colaboradores.php";
			$lista = listar_colaboradores_array();
			if($lista != NULL){
				foreach ($lista as $coluna) {
					echo "<tr>
						<td><input type=checkbox id='checkbox_matricula' name ='checkbox_matricula[]' value = ".$coluna["matricula"].">
						<td>" . $coluna['id_colaborador'] . "</td>
						<td>" . $coluna['nome'] . "</td>
						<td><a href='gerar_relatorio.php?matricula=000".$coluna['matricula']."'>" . $coluna['matricula'] . "</a></td>";
						# passa para variável para evitar problemas com aspas escritas no html
						$id = $coluna['id_colaborador'];
			    	
			    	# botão que, ao mesmo tempo, altera o valor do elemento oculto com a id do colaborador clicado, pergunta ao usuário se tem certeza que quer apagar, e submete o formulário.
			    	#echo "
			    	#"<td>
				    #	<input type='hidden' type='button' value='Apagar' onclick="
				    #	. "\" mudaValueApagarColab(" . $id . "); submitOnClick(confirmarApagarColab('form_apagar_colab'),'form_apagar_colab') \"" .
				    #	"></input>";

				    	echo "</tr>";
				}
			} else {
				echo "Tabela vazia, favor cadastrar colaboradores";
			}







			?> 
				</table>
		</form>

</div>

</body>


<?php require("static/rodape.php"); ?>
</html>