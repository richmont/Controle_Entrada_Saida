
<!DOCTYPE html>
<html>
<script src='/controle_frios/js/relogio.js'></script>
<link rel="stylesheet" type="text/css" href="css/index.css">
<head>
	<title>Página inicial</title>
	<?php  
	require("static/cabecalho_padrao.php");


	?>

</head>
<body onload="relogio()">
<div id="relogio" class="relogio"></div>

<div class="registrar">
	<form action="registro/cadastrar_registro.php" method="get" id="formRegistro">
		<input type="number" name="matricula" id="matriculaRegistro"></input>
		<input type="submit" name="enviarRegistro" id="enviarRegistro" value="Registrar"></input>
	</form>
</div>
<div class="dentro_camara">
	
	</div>
</body>
</html>