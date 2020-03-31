
<html>
<body onload="Definir_Foco('btnIndex')">
	<head>
		<script src="/Controle_Entrada_Saida/js/definir_foco.js"></script>
		<link rel="stylesheet" type="text/css" href="/Controle_Entrada_Saida/css/resposta.css">
</head>
<div class='resposta'>
<?php  
set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Entrada_Saida/") ;
require_once "db/db_conexao.php";
require_once "registro/listar_registros.php";
require_once "adm/listar_colaboradores.php";
$agora = new datetime();
$timezone = new datetimezone('America/Belem');
$agora->settimezone($timezone);
#echo $agora->format('d-m-Y H:i:s');



function insere_registro_banco($id_colaborador,$horario){
	/** verifica se tem entrada, caso positivo, insere o horário na saída do ID de
	registro informado, negativo, insere na entrada 
	*/
	global $conexao;
	# consultar se colab já tem registro de entrada
	$id_registro = colaborador_com_entrada_sem_saida($id_colaborador);
	if($id_registro == NULL){
		# se não houver um registro, armazena o horário no campo de entrada
				$query_add_reg = "INSERT into ch_registro (id_colaborador, hora_entrada)
				VALUES ('" . $id_colaborador. "', '". $horario . "')";
				$r_add_reg = mysqli_query($conexao, $query_add_reg);

				if(!$r_add_reg){
					print("Erro: " . mysqli_error($conexao));
				} else {
					$nome = colaborador_nome($id_colaborador);
					echo " ". $nome ." registrou a IDA com sucesso";
				}
	} else {
		# caso já tenha registro, precisamos realizar a inserção no id_registro já existente
		$query_update_reg = "UPDATE ch_registro SET hora_saida = '". $horario . "' WHERE id_registro = ". $id_registro;
				$r_update_reg = mysqli_query($conexao, $query_update_reg);

				if(!$r_update_reg){
					print("Erro: " . mysqli_error($conexao));
				} else {
					$nome = colaborador_nome($id_colaborador);
					echo " ". $nome ." registrou a VOLTA com sucesso";
				}
	}
}
$bool = empty($_GET["matricula"]);
	// verifica se há valores recebidos por GET
if($bool){
	echo "Matrícula ausente, insira na tela de registro";
} else{
	$matricula = $_GET["matricula"];
	# verificação via regex se o valor recebido é válido
	# matrícula deve conter apenas números
	$array_saida_matricula = array();
	$regex_matricula = '/[a-zA-Z!@#$%^&*(),.?":{}|<>]/';

	preg_match_all($regex_matricula, $matricula, $array_saida_matricula);
	# se valor for maior que zero, a matrícula não contém apenas números
	if(sizeof($array_saida_matricula[0]) > 0){
		echo 'Matrícula deve conter apenas números';
		
	} else{
		# verifica no banco se matrícula corresponde a um colaborador
		$id_colaborador = colaborador_id_pela_matricula($matricula);
		if($id_colaborador == NULL){
			echo "Matrícula inexistente";
		} else{
			# matrícula encontrada, finalmente
			insere_registro_banco($id_colaborador,$agora->format('Y-m-d H:i:s'));
		}
	}			
}

#Retorna automaticamente à página anterior
echo "<meta HTTP-EQUIV='refresh' CONTENT='3;URL=..'>";
?><br>

<!--<button onclick="location.href='/Controle_Entrada_Saida/'" class="btnIndex" name="btnIndex" id="btnIndex" value="Página inicial" >Retornar a página inicial</button>-->
</div>

</body>
</html>
