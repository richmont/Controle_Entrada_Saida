<html>

<link rel="stylesheet" type="text/css" href="../css/Setor.css">
<script type="module" src="/Controle_Entrada_Saida/js/submit_onclick.js"></script>
<script src='/Controle_Entrada_Saida/js/validar_form.js'></script>
<head><title>Setor</title></head>
<body>


<?php  
set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Entrada_Saida/") ;
require("static/cabecalho_adm.php");
$lista = array();
array_push($lista, array("id_setor"=> 1, "nome_setor" => "Frente de caixa", "num_colab"=> 20));
array_push($lista, array("id_setor"=> 2, "nome_setor" => "CPD", "num_colab"=> 5));
array_push($lista, array("id_setor"=> 3, "nome_setor" => "Loja", "num_colab"=> 22));

echo "
<div class='tab_listagem_setores'>
<table>
    <th>ID</th>
    <th>Setor</th>
    <th>Número de colaboradores</th>
    <th>Relatório do dia</th>";
    foreach($lista as $coluna){
        echo "<tr><td>".$coluna["id_setor"]."</td>";
        echo "<td>".$coluna["nome_setor"]."</td>";
        echo "<td>".$coluna["num_colab"]."</td>";
        echo "<td><a href=gerar_relatorio.php?id_setor=2>Gerar Relatório</a></td></tr>";
    }

    echo "
</table>
</div>
";

?>
<body>
<html>