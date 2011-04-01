function hola(){
	alert('hola como estas');	
	
}

function validarReac(){
	var enviar=0;
	var t=document.frm.teoricas.value;
	var p=document.frm.practicas.value;
	if(t.length==0){
		alert('Favor ingresar cuantas teoricas desea');
		document.frm.teoricas.focus();
	}else if(t==""){
		alert('Favor ingresar cuantas teoricas desea');
		document.frm.teoricas.focus();
	}else{
		enviar+=1;
	}
	
	if(p.length==0){
		alert('Favor ingresar cuantas practicas desea');
		document.frm.practicas.focus();
	}else if(p==""){
		alert('Favor ingresar cuantas practicas desea');
		document.frm.practicas.focus();
	}else{
		enviar+=1;
	}
	
	if(enviar==2){
		document.forms.frm.action="generarReactivos.php";
		document.forms.frm.submit();
	}
}
