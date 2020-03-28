<html>
    <head><title>Relatório de Colaborador</title></head>
        <body>
        <link rel="stylesheet" type="text/css" href="../css/relatorios.css">

            <div class="relat-body">
            

                        <?php
                        set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Entrada_Saida/") ;
                        require_once("registro/listar_registros.php");
                        require_once("listar_colaboradores.php");
                        $agora = new datetime();
                        $timezone = new datetimezone('America/Belem');
                        $agora->settimezone($timezone);
                        #echo $agora->format('d-m-Y H:i:s');
                        $agora->format('d-m-Y');
                        $dia = $agora->format('d');
                        $mes = $agora->format('m');
                        $ano = $agora->format('y');
                        $bool = empty($_GET["matricula"]);
                         // verifica se há valores recebidos por GET
                        if($bool){
                            #echo "Matrícula ausente, insira na tela de registro";
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
                                    
                                    #echo "Colaborador de código ". $id_colaborador. " recebido";
                                    echo "
                                    <table>
                                    <tr><th>Data</th><th colspan=2>" .$dia."/".$mes."/".$ano."</th></tr>
                                    <tr class='linha_assinatura'><td>Assinatura</td><td colspan=2></td></tr>
                                    <tr>
                                    <th rowspan=2 >Nome</th><th colspan=2 >Horário</th>
                                    </tr>
                                    <tr>
                                    <th >Ida</th><th >Volta</th>
                                    </tr>
                                    ";
                                    $lista = listar_registro_data_colaborador($dia,$mes,$ano,$id_colaborador);
                                    foreach($lista as $coluna){
                                        echo "<tr><td>".$coluna["nome"]."</td><td>".$coluna["hora_entrada"]."</td><td>".$coluna["hora_saida"]."</td>";
                                    }

		                        }
	                        }			
                        }   

                        ?>
                    
                </table>
            </div>
        </body>
</html>
