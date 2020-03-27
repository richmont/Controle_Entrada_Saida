
<!DOCTYPE html>
<html>
<script src='/Controle_Higiene/js/relogio.js'></script>
<link rel="stylesheet" type="text/css" href="css/index.css">
<head>
	<title>Página inicial</title>
	<?php  
	set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Higiene/") ;
	require_once "static/cabecalho_padrao.php";
	require_once "registro/listar_registros.php";
	require_once "adm/listar_colaboradores.php";
	?>

</head>
<body onload="relogio()">
	<meta http-equiv="Refresh" content="240"> 


	
<div id="relogio" class="relogio"></div>
<div class="dentro_camara">
	
		<?php  

		date_default_timezone_set('America/Belem');
		$agora = new DateTime();
		$na_camara = lista_colaboradores_na_camara();
		if($na_camara==NULL){
			echo "Nenhum colaborador lavando as mãos no momento";
		} else{
			foreach ($na_camara as $id_colaborador) {
				# recebe o nome e a lista de todos os registros do colaborador
				$nome = colaborador_nome($id_colaborador);
				$lista_id_registro = lista_registros_por_colaborador($id_colaborador);
				$numero_registros_colaborador = sizeof($lista_id_registro);
				# recebe o último registro do colaborador, presumivelmente aquele sem a saída
				$index_ultimo_registro = $numero_registros_colaborador - 1;
				$ultimo_registro_colaborador = $lista_id_registro[$index_ultimo_registro];
				$hora_entrada = hora_entrada_pelo_id_registro($ultimo_registro_colaborador);
				$data = new DateTime($hora_entrada);
				#$data->format('H:i:s');
				$intervalo = $agora->diff($data);

				echo "<ul>
				<li>".$nome."</li>
				<li>Entrada: ".$data->format('H:i')."</li>
				<li>Tempo na câmara: ".$intervalo->format('%Hh:%Im')."</li>
				</ul>";

				}
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