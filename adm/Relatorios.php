<?php
set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Entrada_Saida/") ;
require_once("registro/listar_registros.php");
#$lista = listar_registro_data_colaborador(28,03,20,1);
#echo var_dump($lista);
#$lista = listar_registro_data(28,03,20,);
#echo var_dump($lista);
?>

<html>
<link rel="stylesheet" type="text/css" href="../css/relatorios.css">
    <div class="form_relatorio">
	<form action="gerar_relatorio.php" method="get" id="formRelatorio">
		<input type="number" name="matricula" id="matricula"></input>
		<input type="submit" name="enviarRelatorio" id="enviarRelatorio" value="Gerar"></input>
	</form>
</div>

    </html>