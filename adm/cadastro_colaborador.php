<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de colaborador</title>
	<link rel="stylesheet" type="text/css" href="../css/Colaborador.css">
	<script src="/controle_frios/js/definir_foco.js"></script>
</head>
<body onload="Definir_Foco('btnColaborador')">
<?php 
	require "../db/db_conexao.php";
	require "../static/cabecalho_adm.php";
	$conexao = conectar_banco($db_credenciais);
	mysqli_select_db ( $conexao , $db_credenciais["database"] );

	$bool1 = empty($_GET["nome"]);
	$bool2 = empty($_GET["matricula"]);
	// verifica se há valores recebidos por GET
	if($bool1 | $bool2){
		echo "Insira os dados do colaborador na página anterior";

	} else{
		$nome = $_GET["nome"];
		$matricula = $_GET["matricula"];
		function adicionar_colaborador($nome, $matricula){
			# verificação via regex se o valor recebido é válido
			# nome deve conter apenas letra
			# matrícula deve conter apenas números
			$array_saida_nome = array();
			$array_saida_matricula = array();

			$regex_nome = '/[0-9!@#$%^&*(),.?":{}|<>]/';
			$regex_matricula = '/[a-zA-Z!@#$%^&*(),.?":{}|<>]/';

			preg_match_all($regex_matricula, $matricula, $array_saida_matricula);
			preg_match_all($regex_nome, $nome, $array_saida_nome);

			if(sizeof($array_saida_nome[0]) > 0 | sizeof($array_saida_matricula[0]) > 0){
				echo 'Dados inseridos inválidos';
				
			} else{
				# necessário declarar que $conexao é uma variável de fora da função
			global $conexao;
			
			# verificar se contém algo além de letras, mas só depois
			# query para inserir na tabela
			$query_add_colab = "INSERT into colaboradores (nome, matricula)
VALUES ('" . $nome. "', '". $matricula . "')";

			$r_add_colab = mysqli_query($conexao, $query_add_colab);

			if(!$r_add_colab){
				print("Erro: " . mysqli_error($conexao));
			} else {
				echo "Colaborador de matrícula ".$matricula." e nome ".$nome." cadastrado com sucesso!";
			}
		}
			
				
			}
			
			adicionar_colaborador($nome,$matricula);
	}		

 ?>
 
 <button onclick="location.href='/controle_frios/adm/Colaborador.php'" class="btnColaborador" name="btnColaborador" id="btnColaborador" value="Colaborador" >Retornar a página Colaborador</button>
</body>
</html>

