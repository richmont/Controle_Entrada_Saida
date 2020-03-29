<?php  
function json2var($arquivo, $index_keys){
	/**
	converte um json em array
	verifica se o json contém todas as chaves requisitadas
	**/
	$arquivo_aberto = file_get_contents($arquivo);
	$array_json = json_decode($arquivo_aberto,true);
#	echo array_key_exists("usuario", $array_json);
	foreach ($index_keys as $key) {
	if(!array_key_exists($key, $array_json)){
		throw new Exception("chave não encontrada: ".$key, 1);
	} else {
		return $array_json;
	};
	
	}
}
?>