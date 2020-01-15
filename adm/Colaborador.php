<html>

<link rel="stylesheet" type="text/css" href="../css/Colaborador.css">
<script src="/controle_frios/js/esconder_elemento.js"></script>

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


	<input type="button" class="btnMostrarFormCadastro" name="btnMostrarCadastro" value="Cadastrar Colaborador" onclick="esconderElemento('form_in_colab')"></input>
	
	<div id="form_in_colab" class="form_in_colab" style="display: none;">
		<form action="cadastro_colaborador.php" method="get" id="form_colaborador">
			<ul>
				<li>Nome: <input type="text" name="nome"></li>
				<li>Matrícula: <input type="number" name="matricula"></li>
				<li><input type="submit" value="Cadastrar"></input></li>
			</ul>
		</form>

</div>
<br>
		<?php  
		require "listar_colaboradores.php";
		listar_colaboradores();?> 

</div>

</body>



</html>