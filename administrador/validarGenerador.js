function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function validarG(){
	var ajax=objetoAjax();
var practicas= document.getElementById('practicas').value;	
var teoricas= document.getElementById('teoricas').value;	
var 
if(teoricas=="" || teoricas==null){
	if(practicas=="" || practicas==null){
		ajax.open('POST','generarReactivos.php',true);
		ajax.setRequestHeader(Content-Type);
	}
}
	
}
