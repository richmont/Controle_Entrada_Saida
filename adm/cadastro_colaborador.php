<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de colaborador</title>
	<link rel="stylesheet" type="text/css" href="../css/Colaborador.css">
	<script src="/Controle_Entrada_Saida/js/definir_foco.js"></script>
	<link rel="stylesheet" type="text/css" href="/Controle_Entrada_Saida/css/resposta.css">
</head>
<body onload="Definir_Foco('btnColaborador')">
	<?php 
	// trecho de cabeçalho colocado fora da div resposta pra não ser afetado pelo css
	set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Entrada_Saida/") ;
	require_once "../db/db_conexao.php";
	require_once "listar_colaboradores.php";
	require "../static/cabecalho_adm.php";
	 ?>
<div class='resposta'>	
<?php 
	
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
			# antes de inserir, verifica se outro colaborador com o mesmo nome ou matrícula já existe no banco
			$id_consulta_pelo_nome = colaborador_id_pelo_nome($nome);
			$id_consulta_pela_matricula = colaborador_id_pela_matricula($matricula);
			# se a consulta resultar em NULL, o colaborador não existe
			if($id_consulta_pela_matricula == NULL){
				if($id_consulta_pelo_nome == NULL){
							$query_add_colab = "INSERT into colaboradores (nome, matricula)
		VALUES ('" . $nome. "', '". $matricula . "')";

					$r_add_colab = mysqli_query($conexao, $query_add_colab);

					if(!$r_add_colab){
						print("Erro: " . mysqli_error($conexao));
					} else {
						echo "Colaborador de matrícula ".$matricula." e nome ".$nome." cadastrado com sucesso!";
					}
				} else {
					echo "Colaborador já existe, é identificado pelo código: " . $id_consulta_pelo_nome;	
				}
			} else {
				echo "Colaborador já existe, é identificado pelo código: " . $id_consulta_pela_matricula;
			}


			# verificar se contém algo além de letras, mas só depois
			# query para inserir na tabela
			
		}
			
				
			}



			
			adicionar_colaborador($nome,$matricula);
	}		

 ?>
 <br>
 <button onclick="location.href='/Controle_Entrada_Saida/adm/Colaborador.php'" class="btnColaborador" name="btnColaborador" id="btnColaborador" value="Colaborador" >Retornar a página Colaborador</button>
 </div>
</body>
</html>

