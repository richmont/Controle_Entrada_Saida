<html>
    <head><title>Relatório de Colaborador</title></head>
        <body>
        <link rel="stylesheet" type="text/css" href="../css/relatorios.css">

            <div class="relat-body">
            <table>
                <tr><th>Data</th><th colspan=2>28/03/20</th></tr>
                <tr class="linha_assinatura"><td>Assinatura</td><td colspan=2></td></tr>
                    <tr>
                        <th rowspan=2 >Nome</th><th colspan=2 >Horário</th>
                        </tr>
                    <tr>
                        <th >Ida</th><th >Volta</th>
                        </tr>

                        <?php
                        set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Entrada_Saida/") ;
                        require_once("registro/listar_registros.php");
                        
                        ?>
                    <tr>
                        <td>Richelmy</td><td>11:00</td><td>11:05</td>
                        </tr>
                    <tr>
                        <td>Richelmy</td><td>11:30</td><td>11:35</td>
                        </tr>
                    <tr>
                        <td>Richelmy</td><td>12:30</td><td>12:35</td>
                        </tr>    
                </table>
            </div>
        </body>
</html>
