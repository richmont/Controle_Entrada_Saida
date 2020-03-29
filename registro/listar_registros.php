<?php  
set_include_path($_SERVER['DOCUMENT_ROOT'] . "/Controle_Entrada_Saida/") ;
require_once("db/db_conexao.php");

function tamanho_numero($numero){
	/** EU NÃO SEI COMO ISSO FUNCIONA 
	*ok agora sei mais ou menos
	*https://stackoverflow.com/questions/28433798/php-get-length-of-digits-in-a-number
	*/
	if($numero !== 0){
		return floor(log10($numero) + 1);
	}
	else{
		return 1;
	}
	
}


function listar_registro_data($dia,$mes,$ano){
/** recebe todos os registros */
	global $conexao;
	if(tamanho_numero($dia)>2){
		return NULL;
	} elseif (tamanho_numero($mes)>2) {
		return NULL;
	}elseif (tamanho_numero($ano)>4) {
		return NULL;		
		}else{
			# numeros nao são aloprados, continua
			
			# sempre o valor vai ter 2 dítigos
			$mes_c = sprintf('%02d', $mes);
			$dia_c = sprintf('%02d', $dia);
			# ou quatro, no caso de ano
			$ano_c = sprintf('20%d', $ano);
			#echo "dia: ".$dia_c." mes: ".$mes_c." ano: ".$ano_c;
			$lista_registros_dia = [];
			$query_listar_reg = "SELECT id_registro, hora_entrada, hora_saida FROM registro WHERE hora_entrada LIKE '%".$ano_c."-".$mes_c."-".$dia_c."%'";
			$r_listar_reg = mysqli_query($conexao, $query_listar_reg);
			if(!$r_listar_reg){
				print("Erro: " . mysqli_error($conexao));
			} else {
				if (mysqli_num_rows($r_listar_reg) > 0) {
				    // saída dos dados de cada coluna
				    while($coluna = mysqli_fetch_assoc($r_listar_reg)){
				    	array_push($lista_registros_dia, $coluna);
				    }
				    return $lista_registros_dia;
				    
				}
			}
		}
}



function listar_registros_array(){
/** recebe todos os registros */
	global $conexao;

	$lista_registros = [];
	$query_listar_reg = "SELECT * FROM registro ORDER BY id_registro DESC;";
	$r_listar_reg = mysqli_query($conexao, $query_listar_reg);
	if(!$r_listar_reg){
		print("Erro: " . mysqli_error($conexao));
	} else {
		if (mysqli_num_rows($r_listar_reg) > 0) {
		    // saída dos dados de cada coluna
		    while($coluna = mysqli_fetch_assoc($r_listar_reg)){
		    	array_push($lista_registros, $coluna);
		    }
		    return $lista_registros;
		    
		}
	}
}

function id_colaborador_pelo_id_registro($id_registro){
	/** retorna o id_colaborador atrelado a um id_registro */
	global $conexao;
	$query_listar_reg = "SELECT id_registro, id_colaborador FROM registro";
	$r_listar_reg = mysqli_query($conexao, $query_listar_reg);
	if(!$r_listar_reg){
		print("Erro: " . mysqli_error($conexao));
	} else {
		if (mysqli_num_rows($r_listar_reg) > 0) {
		    // saída dos dados de cada coluna
		    while($coluna = mysqli_fetch_assoc($r_listar_reg)){
		    	# se o id_registro do banco bate com o recebido na função
		    	# retorna o campo id_colaborador
		    	if($coluna['id_registro'] == $id_registro){
		    		return $coluna['id_colaborador'];
		    	}
		    	
		    }
		    
		    
		}
	}
}

function hora_entrada_pelo_id_registro($id_registro){
	/** retorna a hora de entrada de um certo $id_registro */
	global $conexao;
	$query_listar_reg = "SELECT id_registro, hora_entrada FROM registro";
	$r_listar_reg = mysqli_query($conexao, $query_listar_reg);
	if(!$r_listar_reg){
		print("Erro: " . mysqli_error($conexao));
	} else {
		if (mysqli_num_rows($r_listar_reg) > 0) {
		    // saída dos dados de cada coluna
		    while($coluna = mysqli_fetch_assoc($r_listar_reg)){
		    	# se o id_registro do banco bate com o recebido na função
		    	# retorna o campo id_colaborador
		    	if($coluna['id_registro'] == $id_registro){
		    		return $coluna['hora_entrada'];
		    	}
		    	
		    }
		    
		    
		}
	}
}

function hora_saida_pelo_id_registro($id_registro){
	/** retorna a hora de saida de um certo $id_registro */
	global $conexao;
	$query_listar_reg = "SELECT id_registro, hora_saida FROM registro";
	$r_listar_reg = mysqli_query($conexao, $query_listar_reg);
	if(!$r_listar_reg){
		print("Erro: " . mysqli_error($conexao));
	} else {
		if (mysqli_num_rows($r_listar_reg) > 0) {
		    // saída dos dados de cada coluna
		    while($coluna = mysqli_fetch_assoc($r_listar_reg)){
		    	# se o id_registro do banco bate com o recebido na função
		    	# retorna o campo id_colaborador
		    	if($coluna['id_registro'] == $id_registro){
		    		return $coluna['hora_saida'];
		    	}
		    	
		    }
		    
		    
		}
	}
}

function colaborador_com_entrada_sem_saida($id_colaborador){
	/** recebe um id de colaborador, retorna o id do registro se ele tiver uma entrada e não uma saída */
	global $conexao;
	$query_listar_reg = "SELECT * FROM registro";
	$r_listar_reg = mysqli_query($conexao, $query_listar_reg);
	if(!$r_listar_reg){
		print("Erro: " . mysqli_error($conexao));
	} else {
		if (mysqli_num_rows($r_listar_reg) > 0) {
		    // saída dos dados de cada coluna
		    while($coluna = mysqli_fetch_assoc($r_listar_reg)){
		    	# se há um registro de entrada, mas nenhum de saída
		    	/**echo "id_colaborador atual: " . $coluna['id_colaborador']. "<br>";
		    	echo "hora_entrada atual: " . $coluna['hora_entrada']. "<br>";
		    	echo "hora_saida atual: " . $coluna['hora_saida']. "<br>";
		    	echo "id_registro atual: " . $coluna['id_registro']. "<br>";*/
		    	if($coluna['id_colaborador'] == $id_colaborador){
			    	if($coluna['hora_entrada'] != NULL and $coluna['hora_saida'] == NULL){
			    		return $coluna['id_registro'];
			    		
			    	} /** inserir um else aqui criou o bug de, caso fosse identificado o id_colaborador, mas ele não passasse no teste de não ter um valor de saída, retornava nulo.
			    	Então ele parava o loop no momento que não passasse no teste */
		    	
		    	} 
			}
		    
		    
		}
	}
}



function lista_colaboradores_na_camara(){
	/** retorna um array com os ids de todos os colaboradores que tem entrada mas não uma saída na câmara */

	$lista_colaboradores_sem_saida_camara = [];
	global $conexao;
	$query_listar_reg = "SELECT * FROM registro";
	$r_listar_reg = mysqli_query($conexao, $query_listar_reg);
	if(!$r_listar_reg){
		print("Erro: " . mysqli_error($conexao));
	} else {
		if (mysqli_num_rows($r_listar_reg) > 0) {
		    // saída dos dados de cada coluna
		    while($coluna = mysqli_fetch_assoc($r_listar_reg)){
		    	# se há um registro de entrada, mas nenhum de saída
		    	if($coluna['hora_entrada'] != NULL & $coluna['hora_saida'] == NULL){
		    		array_push($lista_colaboradores_sem_saida_camara, $coluna['id_colaborador']);
		    	}
		    	
		    }
		    return $lista_colaboradores_sem_saida_camara;
		    
		    
		}
	}
}

function ultimo_registro_colaborador($id_colaborador){
	/** retorna um array com os ids de todos os registros de um colaborador*/
	if(is_int($id_colaborador)){
		$lista_registros_por_colaborador = [];
		global $conexao;
		$query_listar_reg = "SELECT id_registro, id_colaborador FROM registro where id_colaborador = ".$id_colaborador." ORDER BY id_registro DESC LIMIT 1";
		$r_listar_reg = mysqli_query($conexao, $query_listar_reg);
		if(!$r_listar_reg){
			print("Erro: " . mysqli_error($conexao));
		} else {
			if (mysqli_num_rows($r_listar_reg) > 0) {
				// saída dos dados de cada coluna
				$coluna = mysqli_fetch_assoc($r_listar_reg);
				return $coluna['id_registro'];
			}
		}
	} else {
		# não é inteiro, id inválido
		return NULL;
	}
}

function lista_registros_por_colaborador($id_colaborador){
	/** retorna um array com os ids de todos os registros de um colaborador*/
	if(is_int($id_colaborador)){
		$lista_registros_por_colaborador = [];
		global $conexao;
		$query_listar_reg = "SELECT id_registro, id_colaborador FROM registro where id_colaborador = " . $id_colaborador;
		$r_listar_reg = mysqli_query($conexao, $query_listar_reg);
		echo "<br><br><br><br>".var_dump($r_listar_reg);
		if(!$r_listar_reg){
			print("Erro: " . mysqli_error($conexao));
		} else {
			if (mysqli_num_rows($r_listar_reg) > 0) {
				// saída dos dados de cada coluna
				while($coluna = mysqli_fetch_assoc($r_listar_reg)){
						array_push($lista_registros_por_colaborador, $coluna['id_registro']);

				}
				
				return $lista_registros_por_colaborador;
			}
		}
	} else {
		# não é inteiro, id inválido
		return NULL;
	}
}

function tabela_registros_por_colaborador($id_colaborador){

	/** retorna um array de arrays com id_registro, nome, matricula, hora_entrada, hora_saida
     * da consulta, nulo caso receba um $id_colaborador inválido ou o colaborador não tem registros
    */
    if(is_int($id_colaborador)){
        # valor recebido precisa ser um inteiro, ou falha
        $tabela_registros_por_colaborador = [];
        global $conexao;
        $query_tabela_reg = "SELECT registro.id_registro, colaboradores.nome, colaboradores.matricula, registro.hora_entrada, registro.hora_saida FROM colaboradores INNER JOIN registro on colaboradores.id_colaborador = registro.id_colaborador where colaboradores.id_colaborador = " . $id_colaborador;
        
        $r_tabela_reg = mysqli_query($conexao, $query_tabela_reg);
        if(!$r_tabela_reg){
            print("Erro: " . mysqli_error($conexao));
        } else {
            if (mysqli_num_rows($r_tabela_reg) > 0) {
                // saída dos dados de cada coluna
                while($coluna = mysqli_fetch_assoc($r_tabela_reg)){
                    # se há um registro de entrada, mas nenhum de saída
                        array_push($tabela_registros_por_colaborador, $coluna);
                }
                
                return $tabela_registros_por_colaborador;
            }
            # colaborador não tem nenhum registro 
            return NULL;
        }
    
    } else{
        # valor recebido não é um inteiro
        return NULL;
    }
}



function listar_registro_data_colaborador($dia,$mes,$ano, $id_colaborador){
	/** recebe todos os registros */
		global $conexao;
	
	
		if(tamanho_numero($dia)>2){
			return NULL;
		} elseif (tamanho_numero($mes)>2) {
			return NULL;
		}elseif (tamanho_numero($ano)>4) {
			return NULL;		
			}else{
				# numeros nao são aloprados, continua
				
				# sempre o valor vai ter 2 dítigos
				$mes_c = sprintf('%02d', $mes);
				$dia_c = sprintf('%02d', $dia);
				# ou quatro, no caso de ano
				$ano_c = sprintf('20%d', $ano);
				#echo "dia: ".$dia_c." mes: ".$mes_c." ano: ".$ano_c;
				$lista_registros_dia_colaborador = [];

				$query_listar_reg = "SELECT colaboradores.nome, colaboradores.matricula, registro.hora_entrada, registro.hora_saida FROM colaboradores INNER JOIN registro on colaboradores.id_colaborador = registro.id_colaborador WHERE registro.id_colaborador = ".$id_colaborador." AND hora_entrada LIKE '%".$ano_c."-".$mes_c."-".$dia_c."%'";
				$r_listar_reg = mysqli_query($conexao, $query_listar_reg);
				#echo var_dump($r_listar_reg);
				#echo $r_listar_reg->field_count;
				#echo mysqli_num_rows($r_listar_reg);
				if(!$r_listar_reg){
					print("Erro: " . mysqli_error($conexao));
				} else {
					if (mysqli_num_rows($r_listar_reg) > 0) {
						// saída dos dados de cada coluna
						while($coluna = mysqli_fetch_assoc($r_listar_reg)){
							#echo var_dump($lista_registros_dia_colaborador);
							array_push($lista_registros_dia_colaborador, $coluna);
						}
					
						
						return $lista_registros_dia_colaborador;
						
					} else {
						echo "Consulta retornou nulo";
					}
				}
			}
	}
?>