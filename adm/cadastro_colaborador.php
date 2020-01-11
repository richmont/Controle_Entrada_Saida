<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="../css/navbar.css">
<link rel="stylesheet" type="text/css" href="../css/cadastro-colaborador.css">
<head>
	<title>Cadastro de colaborador</title>
	<div class="navbar">
	<ul>
	  <li><a href="../index.php">Página principal</a></li>
	  <li><a href="cadastro_colaborador.php">Cadastro de colaboradores</a></li>
	  <li><a href="relatorios.php">Relatórios</a></li>
	</ul>
</div>
</head>
<body>
	<div class="form_in_colab">
		<form action="cadastro_colaborador.php" method="get">
			<ul>
				<li>Nome: <input type="text" name="nome"></li>
				<li>Matrícula <input type="text" name="matricula"></li>
				<li><input type="submit" value="Cadastrar"></li>
			</ul>
		</form>
</div>

</body>
</html>
<?php 
	
function adicionar_colaborador(){

}
 ?>
