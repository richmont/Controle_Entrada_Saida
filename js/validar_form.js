function confirmarApagarColab(){
	if(confirm("Tem certeza que quer apagar este colaborador?")){
		return true;
	} else { 
		return false;
	}
}
function validar_cadastro(){
	nome = document.getElementById('inputNome').value;
	matricula = document.getElementById('inputMatricula').value;
}