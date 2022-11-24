function mudaValueApagarColab(id){
	document.getElementById('valor_form_apagar').value = id;
}

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
	// regex pra símbolos
	regLetras = /[0-9!@#$%^&*(),.?":{}|<>]/g
	regNumeros = /[a-zA-Z!@#$%^&*(),.?":{}|<>]/g

	if(regLetras.test(nome)){
		alert("Nome de colaborador inválido, use apenas letras");
		document.getElementById('inputNome').focus();
	} else {
		console.log("Nome validado, contém apenas letras");
	}

	if(regNumeros.test(matricula)){
		alert("Matrícula do colaborador inválido, use apenas números")
		document.getElementById('inputMatricula').focus();
	} else{
		console.log("Matrícula validada, contém apenas números");
		
	}

}