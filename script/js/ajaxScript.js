// JavaScript Document
function objetoAjax()
{
	/*******PARA NEVEGADORES QUE SIGUEN LOS ESTANDARES***************/
	if(window.XMLHttpRequest) 
	{
		return new XMLHttpRequest();
	}
	/*******PARA NEVEGADORES QUE NO SIGUEN LOS ESTANDARES***************/
	else if(window.ActiveXObject) 
	{
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	/*var xmlhttp=false;
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
	return xmlhttp;*/
}

function mensajeError(contenido){
	var mensajeCompleto="<div id='mensajeError'><img class='mensaje' src='../imagenes/error.png'/>";
	mensajeCompleto+=contenido;
	mensajeCompleto+="</div>";
	TINY.box.show(mensajeCompleto,0,0,0,1)	
}

function mensajeAlerta(contenido){
	var mensajeCompleto="<div id='mensajeAlerta'><img class='mensaje' src='../imagenes/alerta.png'/>";
	mensajeCompleto+=contenido;
	mensajeCompleto+="</div>";
	TINY.box.show(mensajeCompleto,0,0,0,1)	
}

function mensajeInformacion(contenido){
	var mensajeCompleto="<div id='mensajeInformacion'><img class='mensaje' src='../imagenes/info.png'/>";
	mensajeCompleto+=contenido;
	mensajeCompleto+="</div>";
	TINY.box.show(mensajeCompleto,0,0,0,1);	
}

function mensajeExito(contenido){
	var mensajeCompleto="<div id='mensajeExito'><img class='mensaje' src='../imagenes/exito.png'/>";
	mensajeCompleto+=contenido;
	mensajeCompleto+="</div>";
	TINY.box.show(mensajeCompleto,0,0,0,1);	
}

function mensajeNormal(contenido){
	var mensajeCompleto="<div id='mensajeNormal'>";
	mensajeCompleto+=contenido;
	mensajeCompleto+="</div>";
	TINY.box.show(mensajeCompleto,0,0,0,1);	
}