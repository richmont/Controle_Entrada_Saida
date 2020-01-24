
<!DOCTYPE html>
<html>
<script src='/controle_frios/js/relogio.js'></script>
<link rel="stylesheet" type="text/css" href="css/index.css">
<head>
	<title>Página inicial</title>
	<?php  
	set_include_path($_SERVER['DOCUMENT_ROOT'] . "/controle_frios/") ;
	require_once "static/cabecalho_padrao.php";
	require_once "registro/listar_registros.php";
	require_once "adm/listar_colaboradores.php";
	?>

</head>
<body onload="relogio()">

	
<div id="relogio" class="relogio"></div>
<div class="dentro_camara">
	<ul>
		<?php  
		$na_camara = lista_colaboradores_na_camara();
		foreach ($na_camara as $id_colaborador) {
			echo $id_colaborador;
		}
		?>
		
	</ul>
	</div>
<div class="registrar">
	<form action="registro/cadastrar_registro.php" method="get" id="formRegistro">
		<input type="number" name="matricula" id="matriculaRegistro"></input>
		<input type="submit" name="enviarRegistro" id="enviarRegistro" value="Registrar"></input>
	</form>
</div>

</body>
</html>