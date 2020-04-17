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
	require_once "listar_setores.php";
	require "../static/cabecalho_adm.php";
	 ?>
<div class='resposta'>	
<?php 
	
	$bool_nome_setor_setor = empty($_GET["nome_setor"]);
	// verifica se há valores recebidos por GET
	if($bool_nome_setor_setor){
		echo "Insira o nome_setor do setor na página anterior";

	} else{
		$nome_setor = $_GET["nome_setor"];
		function adicionar_setor($nome_setor){
			# verificação via regex se o valor recebido é válido
			# nome_setor deve conter apenas letra
			$array_saida_nome_setor = array();
			$regex_nome_setor = '/[0-9!@#$%^&*(),.?":{}|<>]/';
			preg_match_all($regex_nome_setor, $nome_setor, $array_saida_nome_setor);
			if(sizeof($array_saida_nome_setor[0]) > 0){
				echo 'Dados inseridos inválidos';
			} else{
				# necessário declarar que $conexao é uma variável de fora da função
			global $conexao;
			# antes de inserir, verifica se outro setor com o mesmo nome_setor já existe no banco
			$id_consulta_pelo_nome_setor = setor_id_pelo_nome_setor($nome_setor);
			# se a consulta resultar em NULL, o setor não existe
			
				if($id_consulta_pelo_nome_setor == NULL){
					$query_add_setor = "INSERT into ch_setor (nome_setor)
VALUES ('" .$nome_setor."')";
					$r_add_setor = mysqli_query($conexao, $query_add_setor);
					if(!$r_add_setor){
						print("Erro: " . mysqli_error($conexao));
					} else {
						echo "Setor de nome ".$nome_setor." cadastrado com sucesso!";
					}
				} else {
					echo "Setor já existe, é identificado pelo código: " . $id_consulta_pelo_nome_setor;	
				}
			# verificar se contém algo além de letras, mas só depois
			# query para inserir na tabela
			
		}
			
				
			}



			
			adicionar_setor($nome_setor);
	}		

 ?>
 <br>
 <button onclick="location.href='/Controle_Entrada_Saida/adm/Colaborador.php'" class="btnColaborador" name="btnColaborador" id="btnColaborador" value="Colaborador" >Retornar a página Colaborador</button>
 </div>
</body>
</html>

