<html>

<link rel="stylesheet" type="text/css" href="../css/Colaborador.css">
<script src="/controle_frios/js/esconder_elemento.js"></script>
<script type="module" src="/controle_frios/js/submit_onclick.js"></script>
<script src='/controle_frios/js/validar_form.js'></script>
<head><title>Colaborador</title></head>

<body>

<?php  
require("../static/cabecalho_adm.php");

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
		<?php  
		/**
		importa e executa a função listar operadores
		*/
		require "listar_colaboradores.php";
		listar_colaboradores();?> 

</div>

</body>



</html>