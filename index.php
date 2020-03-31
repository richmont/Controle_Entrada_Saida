
<!DOCTYPE html>
<html>
<script src='/Controle_Entrada_Saida/js/relogio.js'></script>
<link rel="stylesheet" type="text/css" href="css/index.css">
<script src="/Controle_Entrada_Saida/js/definir_foco.js"></script>
<script src="/Controle_Entrada_Saida/js/som.js"></script>
<head>
	<title>Controle de Higiene</title>
	<?php  
	set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Entrada_Saida/") ;
	require_once "static/cabecalho_padrao.php";
	require_once "registro/listar_registros.php";
	require_once "adm/listar_colaboradores.php";
	?>

</head>


<body onload="relogio() ; Definir_Foco('matriculaRegistro')">
	<meta http-equiv="Refresh" content="30">
	<div id="relogio" class="relogio"></div>

	
<!--Logo do Atacadão-->
<style>
#img-content { float:left; margin:5px; padding-top:24px;}
</style>
<div id="img-content">
<img src="/Controle_Entrada_Saida/atacadao.png" width="200" height="60" />
<p>

<div class="dentro_camara">
	
		<?php  
		$timezone = new datetimezone('America/Belem');
		$agora = new DateTime(NULL, $timezone);
		$agora->settimezone($timezone);
		$na_camara = lista_colaboradores_na_camara();
		if($na_camara==NULL){
			echo "Nenhum colaborador lavando as mãos no momento";
		} else{
			foreach ($na_camara as $str_id_colaborador) {
				$id_colaborador = intval($str_id_colaborador);
				$nome = colaborador_nome($id_colaborador);
				$ultimo_registro_colaborador = ultimo_registro_colaborador($id_colaborador);
				# se o último registro não for nulo, trabalha nos dados e os define para exibir
				if($ultimo_registro_colaborador!=NULL){
					$db_hora_entrada = hora_entrada_pelo_id_registro($ultimo_registro_colaborador);
					# timezone tem de ser idêntico nos dois valores datetime para diff dar certo
					# diff converte automaticamente valores sem timezone para UTC
					$obj_hora_entrada = new DateTime($db_hora_entrada, $timezone);
					$obj_intervalo = $obj_hora_entrada->diff($agora);
					#$obj_hora_entrada->settimezone($timezone);
					$hora_entrada = $obj_hora_entrada->format('H:i:s');
					$intervalo = $obj_intervalo->format('%Hh:%Im');
				}else{
					# exibe erro e não horário atual
					$hora_entrada = "Erro";
					$intervalo = $hora_entrada;
				}

				echo "<ul id='colab_$id_colaborador'>
				
				<li>".$nome."</li>
				<li>Ida: ".$hora_entrada."</li>
				<li>Tempo lavando as mãos: ".$intervalo."</li>
				</ul>";
				$intervalo_horas = $obj_intervalo->format('%Hh');
				$intervalo_minutos = $obj_intervalo->format('%Im');
				# se pessoa está a mais de 10min registrada como foi lavar as mãos
				if($intervalo_minutos>10){
					echo "<style> #colab_$id_colaborador {background-color: red; color: white;}</style>";
					echo "<script>tocarAudio(`audio.mp3`);</script>";
				} else { if($intervalo_horas>1){
					echo "<style> #colab_$id_colaborador {background-color: red; color: white;}</style>";
					echo "<script>tocarAudio(`audio.mp3`);</script>";
				}
					
				}


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
<?php require("static/rodape.php"); ?>
</html>