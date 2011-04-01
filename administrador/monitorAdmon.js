// JavaScript de Archivo monitorAdmon.php

var DivReloj1='<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="229" height="230"><param name="movie" value="../animaciones/reloj.swf" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="swfversion" value="9.0.45.0" /><!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. --><param name="expressinstall" value="../Scripts/expressInstall.swf" /><!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. --><!--[if !IE]>--><object type="application/x-shockwave-flash" data="../animaciones/reloj.swf" width="229" height="230"><!--<![endif]--><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="swfversion" value="9.0.45.0" /><param name="expressinstall" value="../Scripts/expressInstall.swf" /><!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. --><div><h4>Content on this page requires a newer version of Adobe Flash Player.</h4><p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p></div><!--[if !IE]>--></object><!--<![endif]--></object><script type="text/javascript"><!-- swfobject.registerObject("FlashID"); //--> </script>';

var DivReloj3='<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="229" height="230"><param name="movie" value="../animaciones/reloj3.swf" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="swfversion" value="9.0.45.0" /><!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. --><param name="expressinstall" value="../Scripts/expressInstall.swf" /><!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. --><!--[if !IE]>--><object type="application/x-shockwave-flash" data="../animaciones/reloj3.swf" width="229" height="230"><!--<![endif]--><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="swfversion" value="9.0.45.0" /><param name="expressinstall" value="../Scripts/expressInstall.swf" /><!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. --><div><h4>Content on this page requires a newer version of Adobe Flash Player.</h4><p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p></div><!--[if !IE]>--></object><!--<![endif]--></object><script type="text/javascript"><!-- swfobject.registerObject("FlashID"); //--> </script>';

//var botonContinuar='<a href="#" class="button" onclick="continuarMaraton(); return false"><span>Continuar</span></a>';
var botonContinuar='<button type="button" name="btContinuar" id="btContinuar" onclick="continuarMaraton(); return false">Continuar</button>';

//var botonReiniciar='<a href="#" class="button" onclick="reiniciarMaraton(); return false"><span>Reiniciar</span></a>';
var botonReiniciar='<button type="button" name="btReiniciar" id="btReiniciar" onclick="continuarMaraton(); return false">Reiniciar</button>';

$("#btMaraton").click(function(){
	if($("#maratones_sl").val()>0 && $("#etapas_sl").val()>0 ){
		iniciar($("#maratones_sl").val(),$("#etapas_sl").val());
	}
	else{
		var contenidoTiny="<p class='mensajeTiny'>Debe seleccionar un Marat&oacute;n y/o la etapa de la(s) lista(s).</p><p class='mensajeTiny'><a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p></center><p class='mensajeTiny'>&nbsp;</p>";
		mensajeError(contenidoTiny,0,0,0,1);
	}
});


$("#btRespuesta").click(function(){
	mostrarRespuesta();
});

$("#btPuntaje").click(function(){
	muestraPuntaje();
});

$("#btSiguiente").click(function(){
	siguientePregunta();
});

function iniciar(ID_MARATON,ID_ETAPA){
	
	peticion=new objetoAjax();
	peticion.open("POST","monitorXML.php",true);
	peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");// text/html; charset=iso-8859-1
	peticion.send("ACCION=SINCRONIZAR&ID_MARATON="+ID_MARATON+"&ID_ETAPA="+ID_ETAPA+"&ID_ADMINISTRADOR="+document.getElementById("fr_id_admon").value);
	peticion.onreadystatechange=function()
	{
		if(peticion.readyState==4){
			if(peticion.status==200){
				$("#mcContenTop").slideToggle("slow");
				var xml=peticion.responseXML.documentElement;
				var maraton=xml.getElementsByTagName("maraton")[0];
				exito=maraton.getElementsByTagName("exito")[0];
				if(exito.firstChild.data==1){
					obtenerDatosNuevos(ID_MARATON,ID_ETAPA);
				}
				else if(exito.firstChild.data==0){
					document.getElementById("default").innerHTML="Lo sentimos intentelo m&aacute;s tarde.";	
					var contenidoTiny="<p class='mensajeTiny'>Error inesperado, por favor, contacte al Administrador del Sistema.</p><p class='mensajeTiny'><a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p></center><p class='mensajeTiny'>&nbsp;</p>";
					mensajeError(contenidoTiny,0,0,0,1);		
				}
				else{
					document.getElementById("default").innerHTML="Al parecer usted tenia un maratón que no se cerro correctamente, ¿Desea continuarlo, o desea reiniciarlo? "+botonContinuar+"&nbsp;"+botonReiniciar;
					document.getElementById("fr_id_maraton").value=maraton.getElementsByTagName("idMaraton")[0].firstChild.data;
					document.getElementById("fr_cuestionario_pregunta").value=maraton.getElementsByTagName("cuestionario")[0].firstChild.data;
					
					/**VALOR OCULTO***/
					document.getElementById("fr_etapa").value=maraton.getElementsByTagName("etapa")[0].firstChild.data;
					document.getElementById("fr_total").value=maraton.getElementsByTagName("total")[0].firstChild.data;
					
					/***VALOR VISIBLE****/
					document.getElementById("etEtapa").innerHTML=maraton.getElementsByTagName("etapa")[0].firstChild.data;
					document.getElementById("etTotal").innerHTML=maraton.getElementsByTagName("total")[0].firstChild.data;
					
					var contenidoTiny="<p class='mensajeTiny'>Al parecer el maraton que usted eligio ya habia sido iniciado, ¿Desea continuarlo?</p><p class='mensajeTiny'><a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p></center><p class='mensajeTiny'>&nbsp;</p>";
					mensajeAlerta(contenidoTiny,0,0,0,1);
				}
			}
			else{
				//document.getElementById("panelPrincipal").innerHTML="No se encontro";
				var contenidoTiny="<p class='mensajeTiny'>Página no encontrada!.</p><p class='mensajeTiny'><a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p></center><p class='mensajeTiny'>&nbsp;</p>";
				document.getElementById("fr_id_maraton").value=maraton.getElementsByTagName("idMaraton")[0].firstChild.data;
				document.getElementById("fr_cuestionario_pregunta").value=maraton.getElementsByTagName("cuestionario")[0].firstChild.data;
				mensajeError(contenidoTiny,0,0,0,1);
			}
		}
		else{
			//document.getElementById("panelPrincipal").innerHTML="Cargando...";
			var contenidoTiny="<p class='mensajeTiny'>cargando...</p>";
			mensajeNormal(contenidoTiny,0,0,0,1);
		}
	}
}

function obtenerDatosNuevos(ID_MARATON,ID_ETAPA){
	obtener=new objetoAjax();
	obtener.open("POST","monitorXML.php",true);
	obtener.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");// text/html; charset=iso-8859-1
	obtener.send("ACCION=OBTENER&ID_MARATON="+ID_MARATON+"&ID_ETAPA="+ID_ETAPA+"&ID_ADMINISTRADOR="+document.getElementById("fr_id_admon").value);
	obtener.onreadystatechange=function()
	{
		if(obtener.readyState==4)
		{
			if(obtener.status==200)
			{
				var xml=obtener.responseXML.documentElement;
				var maraton=xml.getElementsByTagName("maraton")[0];
				document.getElementById("fr_id_maraton").value=maraton.getElementsByTagName("idMaraton")[0].firstChild.data;
				document.getElementById("fr_cuestionario_pregunta").value=maraton.getElementsByTagName("cuestionario")[0].firstChild.data;
				
				/**VALOR OCULTO***/
				document.getElementById("fr_etapa").value=maraton.getElementsByTagName("etapa")[0].firstChild.data;
				document.getElementById("fr_total").value=maraton.getElementsByTagName("total")[0].firstChild.data;
				
				/***VALOR VISIBLE****/
				document.getElementById("etEtapa").innerHTML=maraton.getElementsByTagName("etapa")[0].firstChild.data;
				document.getElementById("etTotal").innerHTML=maraton.getElementsByTagName("total")[0].firstChild.data;
				
				leerPregunta(ID_MARATON,ID_ETAPA);
			}
			else{
				var contenidoTiny="<p class='mensajeTiny'>Página no encontrada!.</p><p class='mensajeTiny'><a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p></center><p class='mensajeTiny'>&nbsp;</p>";
				mensajeError(contenidoTiny,0,0,0,1);	
			}
		}
		else{
			var contenidoTiny="<p class='mensajeTiny'>cargando...</p>";
			mensajeNormal(contenidoTiny,0,0,0,1);
		}
	}
}

function leerPregunta(ID_MARATON,ID_ETAPA){
	leer=new objetoAjax();
	leer.open("POST","monitorXML.php",true);
	leer.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");// text/html; charset=iso-8859-1
	//leer.send("ACCION=LEERPREGUNTA&ID_ADMINISTRADOR="+document.getElementById("fr_id_admon").value+"&ID_MARATON="+ID_MARATON+"&ID_ETAPA="+ID_ETAPA);
	leer.send("ACCION=LEERPREGUNTA&ID_CUESTIONARIO="+document.getElementById("fr_cuestionario_pregunta").value);
	leer.onreadystatechange=function()
	{
		if(leer.readyState==4)
		{
			if(leer.status==200){
				var xml=leer.responseXML.documentElement;
				var maraton=xml.getElementsByTagName("maraton")[0];
				
				/**VALOR OCULTO***/
				document.getElementById("fr_no_pregunta").value=maraton.getElementsByTagName("numeroPregunta")[0].firstChild.data;
				document.getElementById("fr_tipo").value=maraton.getElementsByTagName("tipo")[0].firstChild.data;
				
				/**VALOR VISIBLE***/
				document.getElementById("etNumeroPregunta").innerHTML=maraton.getElementsByTagName("numeroPregunta")[0].firstChild.data;
				if(maraton.getElementsByTagName("tipo")[0].firstChild.data=="1"){
					document.getElementById("etTipo").innerHTML="Te&oacute;rica";
					document.getElementById("etTiempo").innerHTML="1 minuto";
					document.getElementById("fr_tiempo").value=1;
				}
				else{
					document.getElementById("etTipo").innerHTML="Pr&aacute;ctica";	
					document.getElementById("etTiempo").innerHTML="3 minutos";
					document.getElementById("fr_tiempo").value=3;
				}
				document.getElementById("default").innerHTML="La sincronizaci&oacute;n fue exitosa!, para ver la primer pregunta, haga clic en el bot&oacute;n 'Pregunta' del menu superior.";	
				var contenidoTiny="<p class='mensajeTiny'>Se ha iniciado con exito.</p><p class='mensajeTiny'><a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p></center><p class='mensajeTiny'>&nbsp;</p>";
				mensajeExito(contenidoTiny,0,0,0,1);
				
			}
			else{
				var contenidoTiny="<p class='mensajeTiny'>Página no encontrada!.</p><p class='mensajeTiny'><a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p></center><p class='mensajeTiny'>&nbsp;</p>";
				mensajeError(contenidoTiny,0,0,0,1);	
			}
		}
		else{
			var contenidoTiny="<p class='mensajeTiny'>cargando...</p>";
			mensajeNormal(contenidoTiny,0,0,0,1);
		}
	}// TERMINA leer.onreadystatechange
}

$("#btPregunta").click(function(){
	if(document.getElementById("fr_id_maraton").value!=0){
		mostrarPregunta();
	}							   
});
$("#btAltaMaraton").click(function(){
	agregarMaraton();	   
});

$("#btguardaMaraton").click(function(){
	if(!validaTexto("nombreMaraton","Falta nombre de maraton"))return;
	document.getElementById("Accion").value="guardaMaraton";
	document.primerForm.submit();
});
$("#btGenerarEquipos").click(function(){
	if(!validaTexto("numero","Falta numero de equipos"))return;
	document.getElementById("Accion").value="guardaEquipos";
	document.primerForm.submit();
});
$("#btguardaEtapa").click(function(){
	if(!validaTexto("nombreEtapa","Falta nombre de etapa"))return;
	document.getElementById("Accion").value="guardaEtapa";
	document.primerForm.submit();
});
$("#btguardaReactivo").click(function()
									  {
						if(!validaTexto("pregunta","Falta pregunta"))return;
						if(!validaTexto("opcion1","Falta posible respuesta"))return;
						if(!validaTexto("opcion2","Falta posible respuesta"))return;
						if(!validaTexto("opcion3","Falta posible respuesta"))return;
						if(!validaTexto("opcion4","Falta posible respuesta"))return;
						if(!validaLista("respuesta","Falta la respuesta correcta"))return;
						if(!validaLista("tipo","Falta el tipo de pregunta"))return;
						if(!validaLista("grado","Falta el grado"))return;	
						document.getElementById("Accion").value="guardaReactivo";
						document.primerForm.submit();
});

$("#bteliminaReactivo").click(function()
									  {
						if(!validaLista("idReactivo","Seleccione un reactivo"))return;
						document.getElementById("Accion").value="eliminaReactivo";
						document.primerForm.submit();
});
$("#bteliminaMaraton").click(function()
									  {
						if(!validaLista("idMaraton","Seleccione un maraton"))return;
						document.getElementById("Accion").value="eliminaMaraton";
						document.primerForm.submit();
});
$("#btrestauraMaraton").click(function()
									  {
						if(!validaLista("idMaraton","Seleccione un maraton"))return;
						document.getElementById("Accion").value="restauraMaraton";
						document.primerForm.submit();
});
$("#btrestauraMaratonCompleto").click(function()
									  {
										  if(confirm("\n \n¿ Le gustaría restaurar a la configuración de inicio esto hara que se borren todos los datos ?"))
										  {
											  	document.getElementById("Accion").value="restauraMaratonCompleto";
						document.primerForm.submit();
										  }
										  else
										  {
											  					

										  }
});


$("#bteliminaEtapa").click(function()
									  {
						if(!validaLista("idEtapa","Seleccione una etapa"))return;
						document.getElementById("Accion").value="eliminaEtapa";
						document.primerForm.submit();
});

$("#btmodificaReactivo").click(function()
									  {
						if(!validaTexto("pregunta","Falta pregunta"))return;
						if(!validaTexto("opcion1","Falta posible respuesta"))return;
						if(!validaTexto("opcion2","Falta posible respuesta"))return;
						if(!validaTexto("opcion3","Falta posible respuesta"))return;
						if(!validaTexto("opcion4","Falta posible respuesta"))return;
						if(!validaLista("respuesta","Falta la respuesta correcta"))return;
						if(!validaLista("tipo","Falta el tipo de pregunta"))return;
						if(!validaLista("grado","Falta el grado"))return;	
						document.getElementById("Accion").value="modificaReactivo";
						document.primerForm.submit();
});
$("#btmodificaMaraton").click(function()
									  {
						if(!validaTexto("nombreMaraton","Falta nombre de maraton"))return;
						document.getElementById("Accion").value="modificaMaraton";
						document.primerForm.submit();
});
$("#btmodificaEtapa").click(function()
									  {
						if(!validaTexto("nombreEtapa","Falta nombre de etapa"))return;
						document.getElementById("Accion").value="modificaEtapa";
						document.primerForm.submit();
});


//******valida cosas///

function trim(cadena)
{
	for(i=0; i<cadena.length; )
	{
		if(cadena.charAt(i)==" ")
			cadena=cadena.substring(i+1, cadena.length);
		else
			break;
	}

	for(i=cadena.length-1; i>=0; i=cadena.length-1)
	{
		if(cadena.charAt(i)==" ")
			cadena=cadena.substring(0,i);
		else
			break;
	}
	return cadena;
}

function validaTexto(campo,texto)
{
	if( trim(document.getElementById(campo).value)==='')
	{
		alert(texto);
		document.getElementById(campo).style.border='1px #FF0000 solid';
		document.getElementById(campo).focus();
		return false
	}
	else
	{
		document.getElementById(campo).style.border='1px #666666 solid';
		return true;	
	}
}

function validaLista(campo,texto)
{
	if( document.getElementById(campo).value==0)
	{
		alert(texto);
		document.getElementById(campo).style.border='1px #FF0000 solid';
		document.getElementById(campo).focus();
		return false;
	}
	else
	{
		document.getElementById(campo).style.border='1px #666666 solid';
		return true;	
	}
}

function validaOpciones(campo,mensaje)
{

	if(campo[0].checked || campo[1].checked)
	{
		campo[0].style.border="1px #999999 solid";
		campo[1].style.border="1px #999999 solid";
		campo[0].style.border="1px #999999 solid";
		campo[1].style.border="1px #999999 solid";
		return true;
	}
	else
	{
		alert(mensaje);
		campo[0].style.border="1px #FF0000 solid";
		campo[1].style.border="1px #FF0000 solid";
		campo[0].focus();
		campo[0].style.border="1px #FF0000 solid";
		campo[1].style.border="1px #FF0000 solid";
		campo[0].focus();

		return false;
	}
	
}
function mensajeGuarda(pagina)
{
									
	var contenidoTiny="<p class='mensajeTiny'>Se ha guardado con exito.</p><p class='mensajeTiny'><a href='"+pagina+"' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p></center><p class='mensajeTiny'>&nbsp;</p>";
			mensajeNormal(contenidoTiny,0,0,0,1);	   
}
function mensajeModifica(pagina)
{
									
	var contenidoTiny="<p class='mensajeTiny'>Se ha modificado con exito.</p><p class='mensajeTiny'><a href='"+pagina+"' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p></center><p class='mensajeTiny'>&nbsp;</p>";
			mensajeNormal(contenidoTiny,0,0,0,1);	   
}
function buscarReactivo()
{ 
var alerta=document.getElementById("idReactivo").value;
//alert(alerta);
document.getElementById("Accion").value="buscarReactivo";
document.primerForm.submit();
	
}
function buscarMaraton()
{ 
var alerta=document.getElementById("idMaraton").value;
//alert(alerta);
document.getElementById("Accion").value="buscarMaraton";
document.primerForm.submit();
	
}
function buscarEtapa()
{ 
var alerta=document.getElementById("idEtapa").value;
//alert(alerta);
document.getElementById("Accion").value="buscarEtapa";
document.primerForm.submit();
	
}


function agregarMaraton()
{
	peticion=new objetoAjax();
	peticion.open("POST","guardaMaraton.php",true);
	peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");/* text/html; charset=iso-8859-1*/
	peticion.send(null);
	peticion.onreadystatechange=function()
	{
			if(peticion.readyState==4)
			{
					if(peticion.status==200)
					{
					var	respuesta = peticion.responseText;
					document.getElementById("default").innerHTML="";
					document.getElementById("default").innerHTML=respuesta
					}
					else
					{
				/*EN CASO DE NO ENCONTRAR LA PAGINA*/	
					}
			}
			else
			{
			/*CUANDO AUN NO TERMINA LA PETICION*/	
			}
	}
	
}
function mostrarPregunta(){
	peticion=new objetoAjax();
	peticion.open("POST","monitorXML.php",true);
	peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");/* text/html; charset=iso-8859-1*/
	peticion.send("ACCION=MOSTRAR&ID_CUESTIONARIO="+document.getElementById("fr_cuestionario_pregunta").value);
	peticion.onreadystatechange=function()
	{
		if(peticion.readyState==4)
		{
			/*UNA VEZ QUE LA PETICION SE ENTREGA CON EXITO*/
			if(peticion.status==200)
			{
				/*EN CASO DE ENCONTRAR LA PAGINA*/
				var xml=peticion.responseXML.documentElement;
				var maraton=xml.getElementsByTagName("maraton")[0];
				document.getElementById("default").innerHTML="";
				document.getElementById("pregunta").innerHTML=maraton.getElementsByTagName("pregunta")[0].firstChild.data;
				document.getElementById("opcionA").innerHTML="A) "+maraton.getElementsByTagName("opcionA")[0].firstChild.data;
				document.getElementById("opcionB").innerHTML="B) "+maraton.getElementsByTagName("opcionB")[0].firstChild.data;
				document.getElementById("opcionC").innerHTML="C) "+maraton.getElementsByTagName("opcionC")[0].firstChild.data;
				document.getElementById("opcionD").innerHTML="D) "+maraton.getElementsByTagName("opcionD")[0].firstChild.data;
				document.getElementById("fr_tiempo").value=maraton.getElementsByTagName("tipo")[0].firstChild.data;
				if(document.getElementById("fr_tiempo").value==1)
				{
					document.getElementById("reloj").innerHTML=DivReloj1;
				}
				else
				{
					document.getElementById("reloj").innerHTML=DivReloj3;
				}
				/***********MOVEMOS LOS PANELES PRINCIPALES***************************/
				$("#competencia_lateral").hide("fast");
				$("#reloj").fadeIn("slow");
				$("#competencia_principal").animate({"width": "100%"}, "slow");
			}
			else{
				/*EN CASO DE NO ENCONTRAR LA PAGINA*/	
			}
		}
		else{
			/*CUANDO AUN NO TERMINA LA PETICION*/	
		}
	}
}

function continuarMaraton(){
	continuarAJ=new objetoAjax();
	continuarAJ.open("POST","monitorXML.php",true);
	continuarAJ.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");/* text/html; charset=iso-8859-1*/
	continuarAJ.send("ACCION=CONTINUAR&ID_MARATON="+document.getElementById("fr_id_maraton").value+"&ID_ADMINISTRADOR="+document.getElementById("fr_id_admon").value);
	continuarAJ.onreadystatechange=function()
	{
		if(continuarAJ.readyState==4)
		{
			/*UNA VEZ QUE LA PETICION SE ENTREGA CON EXITO*/
			if(continuarAJ.status==200)
			{
				var xml=continuarAJ.responseXML.documentElement;
				var maraton=xml.getElementsByTagName("maraton")[0];
				document.getElementById("fr_id_maraton").value=maraton.getElementsByTagName("idMaraton")[0].firstChild.data;
				document.getElementById("fr_cuestionario_pregunta").value=maraton.getElementsByTagName("cuestionario")[0].firstChild.data;
				
				/**VALOR OCULTO***/
				document.getElementById("fr_etapa").value=maraton.getElementsByTagName("etapa")[0].firstChild.data;
				document.getElementById("fr_total").value=maraton.getElementsByTagName("total")[0].firstChild.data;
				
				/***VALOR VISIBLE****/
				document.getElementById("etEtapa").innerHTML=maraton.getElementsByTagName("etapa")[0].firstChild.data;
				document.getElementById("etTotal").innerHTML=maraton.getElementsByTagName("total")[0].firstChild.data;
				leerPregunta(document.getElementById("fr_id_maraton").value,maraton.getElementsByTagName("etapa")[0].firstChild.data);	
			}/*TERMINA status 200*/
		}/*TERMINA readyState 4*/
		else{
			
		}
	}
}

function reiniciarMaraton(){
	continuarAJ=new objetoAjax();
	continuarAJ.open("POST","monitorXML.php",true);
	continuarAJ.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");/* text/html; charset=iso-8859-1*/
	continuarAJ.send("ACCION=LEERPREGUNTAACTUAL&ID_CUESTIONARIO="+document.getElementById("fr_cuestionario_pregunta").value);
	continuarAJ.onreadystatechange=function()
	{
		if(continuarAJ.readyState==4)
		{
			/*UNA VEZ QUE LA PETICION SE ENTREGA CON EXITO*/
			if(continuarAJ.status==200)
			{
				leerPregunta(document.getElementById("fr_id_maraton").value,document.getElementById("fr_etapa").value);	
			}/*TERMINA status 200*/
		}/*TERMINA readyState 4*/
		else{
			
		}
	}
}

function iniciaTiempo(){
	tiempo=new objetoAjax();
	tiempo.open("POST","tiempo.php",true);
	tiempo.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");/* text/html; charset=iso-8859-1*/
	tiempo.send("ACCION=INICIARTIEMPO&ID_CUESTIONARIO="+document.getElementById("fr_cuestionario_pregunta").value+"&ID_ADMINISTRADOR="+document.getElementById("fr_id_admon").value);
	tiempo.onreadystatechange=function()
	{
		if(tiempo.readyState==4)
		{
			if(tiempo.status==200)
			{
				document.getElementById("fr_preguntando").value=1;
				monitoreaEquipos();
			}/*TERMINA status 200*/
		}/*TERMINA readyState 4*/	
	}
}

function actualizarPermiso(){
	termino=new objetoAjax();
	termino.open("POST","tiempo.php",true);
	termino.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");/* text/html; charset=iso-8859-1*/
	termino.send("ACCION=TERMINATIEMPO&ID_CUESTIONARIO="+document.getElementById("fr_cuestionario_pregunta").value+"&ID_ADMINISTRADOR="+document.getElementById("fr_id_admon").value);
	termino.onreadystatechange=function()
	{
		if(termino.readyState==4)
		{
			if(termino.status==200)
			{
				document.getElementById("fr_preguntando").value=0;
			}/*TERMINA status 200*/
		}/*TERMINA readyState 4*/	
	}
}

function mostrarRespuesta(){
	respuesta=new objetoAjax();
	respuesta.open("POST","monitorXML.php",true);
	respuesta.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");/* text/html; charset=iso-8859-1*/
	respuesta.send("ACCION=RESPUESTA&ID_ADMINISTRADOR="+document.getElementById("fr_id_admon").value+"&ID_CUESTIONARIO="+document.getElementById("fr_cuestionario_pregunta").value);
	respuesta.onreadystatechange=function()
	{
		if(respuesta.readyState==4)
		{
			if(respuesta.status==200)
			{
				var xml=respuesta.responseXML.documentElement;
				var maraton=xml.getElementsByTagName("maraton")[0];
				buena=maraton.getElementsByTagName("respuesta")[0].firstChild.data;
				justificacion=maraton.getElementsByTagName("justificacion")[0].firstChild.data;
				switch(buena)
				{
					case '1':
						document.getElementById("pregunta").innerHTML="<span style='color:red;'>A) "+maraton.getElementsByTagName("opcionA")[0].firstChild.data+"</span>"+"</br><p class='justi'>"+justificacion+"</p>";		
					break;
					case '2':
						document.getElementById("pregunta").innerHTML="<span style='color:red;'>B) "+maraton.getElementsByTagName("opcionB")[0].firstChild.data+"</span>"+"</br><p class='justi'>"+justificacion+"</p>";
					break;
					case '3':
						document.getElementById("pregunta").innerHTML="<span style='color:red;'>C) "+maraton.getElementsByTagName("opcionC")[0].firstChild.data+"</span>"+"</br><p class='justi'>"+justificacion+"</p>";
					break;
					case '4':
						document.getElementById("pregunta").innerHTML="<span style='color:red;'>D) "+maraton.getElementsByTagName("opcionD")[0].firstChild.data+"</span>"+"</br><p class='justi'>"+justificacion+"</p>";
					break;
				}
				var numero=maraton.getElementsByTagName("numero")[0].firstChild.data;
				var tabla="Las respuestas de los equipos fueron:<br/><br/>";
				for(var i=1;i<=numero;i++){
					var respTemp="";
					//alert(document.getElementById("fr_cuestionario_pregunta").value);
					//alert(maraton.getElementsByTagName("equipo"+i)[0].firstChild.data);
					//alert(maraton.getElementsByTagName("tiempoEquipo"+i)[0].firstChild.data);
					if(maraton.getElementsByTagName("tiempoEquipo"+i)[0].firstChild.data=='1')
					{
					switch(maraton.getElementsByTagName("equipo"+i)[0].firstChild.data)
					{
						case '1':
							if(buena==1){
								respTemp="A <img src='../imagenes/bien.png' width='16' height='16' />";	
							}
							else{
								respTemp="A <img src='../imagenes/chk_off.png' width='16' height='16' />";		
							}
							
						break;
						case '2':
							if(buena==2){
								respTemp="B <img src='../imagenes/bien.png' width='16' height='16' />";	
							}
							else{
								respTemp="B <img src='../imagenes/chk_off.png' width='16' height='16' />";		
							}
						break;
						case '3':
							if(buena==3){
								respTemp="C <img src='../imagenes/bien.png' width='16' height='16' />";	
							}
							else{
								respTemp="C <img src='../imagenes/chk_off.png' width='16' height='16' />";		
							}
						break;
						case '4':
							if(buena==4){
								respTemp="D <img src='../imagenes/bien.png' width='16' height='16' />";	
							}
							else{
								respTemp="D <img src='../imagenes/chk_off.png' width='16' height='16' />";		
							}
						break;
					}
					}
					else
					{
					switch(maraton.getElementsByTagName("equipo"+i)[0].firstChild.data)
					{
						case '1':
							if(buena==1){
								respTemp="A <img src='../imagenes/bien.png' width='16' height='16' /> FUERA DE TIEMPO";	
							}
							else{
								respTemp="A <img src='../imagenes/chk_off.png' width='16' height='16' /> FUERA DE TIEMPO";		
							}
							
						break;
						case '2':
							if(buena==2){
								respTemp="B <img src='../imagenes/bien.png' width='16' height='16' /> FUERA DE TIEMPO";	
							}
							else{
								respTemp="B <img src='../imagenes/chk_off.png' width='16' height='16' /> FUERA DE TIEMPO";		
							}
						break;
						case '3':
							if(buena==3){
								respTemp="C <img src='../imagenes/bien.png' width='16' height='16' /> FUERA DE TIEMPO";	
							}
							else{
								respTemp="C <img src='../imagenes/chk_off.png' width='16' height='16' /> FUERA DE TIEMPO";		
							}
						break;
						case '4':
							if(buena==4){
								respTemp="D <img src='../imagenes/bien.png' width='16' height='16' /> FUERA DE TIEMPO";	
							}
							else{
								respTemp="D <img src='../imagenes/chk_off.png' width='16' height='16' /> FUERA DE TIEMPO";		
							}
						break;
					}
					}
					tabla=tabla+"<strong>"+maraton.getElementsByTagName("nombreEquipo"+i)[0].firstChild.data+" :</strong> "+respTemp+"<br/>";
				}
				document.getElementById("opcionA").innerHTML=tabla;
				document.getElementById("opcionB").innerHTML="";
				document.getElementById("opcionC").innerHTML="";
				document.getElementById("opcionD").innerHTML="";
				document.getElementById("default").innerHTML="";
				/************ DESDE AQUI EMPIEZA A MOSTRAR LOS DATOS DE LA SIGUIENTE PREGUNTA *********/
				/*if(document.getElementById("fr_no_pregunta").value < document.getElementById("fr_total").value){
					siguientePregunta();
				}
				else{
					termino();
				}*/
				
				/**********REORDENAMOS EL PANEL PRINCIPAL********/
				//$("#reloj").html("&nbsp;");
				
				
				if( document.getElementById("fr_no_pregunta").value == document.getElementById("fr_total").value ){
					alert('Etapa Finalizada!');
					document.getElementById("fin_cuestionario").style.display = "block";

				}else{
					document.getElementById("fin_cuestionario").style.display = "none";
				}
				
				$("#reloj").fadeOut("slow");
				$("#competencia_lateral").show("slow");
				$("#competencia_principal").animate({"width": "650px"}, "fast");
			}/*TERMINA status 200*/
		}/*TERMINA readyState 4*/	
	}
}

function siguientePregunta(){
	siguiente=new objetoAjax();
	siguiente.open("POST","monitorXML.php",true);
	siguiente.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");/* text/html; charset=iso-8859-1*/
	siguiente.send("ACCION=SIGUIENTE&ID_ADMINISTRADOR="+document.getElementById("fr_id_admon").value+"&ID_CUESTIONARIO="+document.getElementById("fr_cuestionario_pregunta").value);
	siguiente.onreadystatechange=function()
	{
		if(siguiente.readyState==4)
		{
			if(siguiente.status==200)
			{
				var xml=siguiente.responseXML.documentElement;
				var maraton=xml.getElementsByTagName("maraton")[0];
				var permiso=maraton.getElementsByTagName("permiso")[0].firstChild.data;
				if(permiso!=4)
				{
					/**VALOR OCULTO***/
					document.getElementById("fr_cuestionario_pregunta").value=maraton.getElementsByTagName("cuestionario")[0].firstChild.data;
					document.getElementById("fr_no_pregunta").value=maraton.getElementsByTagName("numeroPregunta")[0].firstChild.data;
					document.getElementById("fr_tipo").value=maraton.getElementsByTagName("tipo")[0].firstChild.data;
					
					/**VALOR VISIBLE***/
					document.getElementById("etNumeroPregunta").innerHTML=maraton.getElementsByTagName("numeroPregunta")[0].firstChild.data;
					if(maraton.getElementsByTagName("tipo")[0].firstChild.data=="1"){
						document.getElementById("etTipo").innerHTML="Te&oacute;rica";
						document.getElementById("etTiempo").innerHTML="1 minuto";
						document.getElementById("fr_tiempo").innerHTML="1";
					}
					else{
						document.getElementById("etTipo").innerHTML="Pr&aacute;ctica";	
						document.getElementById("etTiempo").innerHTML="3 minuto";
						document.getElementById("fr_tiempo").innerHTML="3";
					}
					document.getElementById("default").innerHTML="Para ver la siguiente pregunta, haga clic en el botón 'mostrar' del menu superior.";
					document.getElementById("pregunta").innerHTML="";
					document.getElementById("opcionA").innerHTML="";
					document.getElementById("opcionB").innerHTML="";
					document.getElementById("opcionC").innerHTML="";
					document.getElementById("opcionD").innerHTML="";
					
					if( document.getElementById("fr_no_pregunta").value == document.getElementById("fr_total").value ){
						document.getElementById("btSiguiente").style.display = "none";
						
					}
					
				}//TERMINA IF
				else{
					mensajeAlerta("<p class='mensajeTiny'>Usted no puede avanzar a la siguiente pregunta, hasta que el tiempo se termine o todos los equipos contesten.</p><a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a><p class='mensajeTiny'>&nbsp;</p>");	
				}//TERMINA ELSE
			}
		}
	}
}

function termino(){
	var contenidoTiny="<p class='mensajeTiny'>Se terminaron los reactivos de esta etapa.</p><p class='mensajeTiny'><a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p></center><p class='mensajeTiny'>&nbsp;</p>";
	mensajeAlerta(contenidoTiny,0,0,0,1);
	document.getElementById("default").innerHTML="Usted ha terminado todas los reactivos de esta etapa para este maratón de conocimientos.";		
	document.getElementById("pregunta").innerHTML="";
	document.getElementById("opcionA").innerHTML="";
	document.getElementById("opcionB").innerHTML="";
	document.getElementById("opcionC").innerHTML="";
	document.getElementById("opcionD").innerHTML="";
}

function monitoreaEquipos(){
	monitorea=new objetoAjax();
	monitorea.open("POST","monitorXML.php",true);
	monitorea.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");/* text/html; charset=iso-8859-1*/
	monitorea.send("ACCION=MONITOREA&ID_ADMINISTRADOR="+document.getElementById("fr_id_admon").value+"&ID_CUESTIONARIO="+document.getElementById("fr_cuestionario_pregunta").value+"&ULTIMO="+document.getElementById("fr_total").value);
	monitorea.onreadystatechange=function()
	{
		if(monitorea.readyState==4)
		{
			if(monitorea.status==200)
			{	
				/************************************/
				var xml=monitorea.responseXML.documentElement;
				var maraton=xml.getElementsByTagName("maraton")[0];
				var total=maraton.getElementsByTagName("total")[0].firstChild.data;
				var equipos=maraton.getElementsByTagName("equipos")[0].firstChild.data;
				var tabla="<strong>Equipos que ya contestaron:</strong><br/><br/>";
				if(equipos>0)
				{
					for(var i=1;i<=equipos;i++){
						tabla=tabla+"<a href='#' class='button2'><span>"+maraton.getElementsByTagName("nombreEquipo"+i)[0].firstChild.data+"</span></a>&nbsp;";
					}
					document.getElementById("default").innerHTML=tabla+"<br/><br/>";
				}
				if(equipos==total){
					finalizarAntes();
				}
				else//if(equipos<total || equipos==0)
				{
					setTimeout("monitoreaEquipos()", 3000);	
				}
				/**********************************/
			}
		}
	}
}

function finalizarAntes(){
	actualizarPermiso();
	var contenidoTiny="<p class='mensajeTiny'>Todos los equipos han contestado la pregunta.</p><p class='mensajeTiny'><a href='#'class='button' onclick='javascript:TINY.box.hide(); mostrarRespuesta()'><span>Aceptar</span></a></p></center><p class='mensajeTiny'>&nbsp;</p>";
	mensajeInformacion(contenidoTiny,0,0,0,1);
}
function sacarEquipo(idEquipo)
{
	var equipoId=idEquipo;
	document.getElementById("Accion").value="quitarEquipo";
	document.getElementById("idEquipo").value=equipoId;
	document.primerForm.submit();
}

function muestraPuntaje(){
	puntaje=new objetoAjax();
	puntaje.open("POST","puntajeAcumulado.php",true);
	puntaje.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");/* text/html; charset=iso-8859-1*/
	puntaje.send("ID_MARATON="+document.getElementById("fr_id_maraton").value);
	puntaje.onreadystatechange=function()
	{
		if(puntaje.readyState==4)
		{
			if(puntaje.status==200)
			{
				mensajeNormal("<p class='mensajeTiny'>"+puntaje.responseText+"</p><p class='mensajeTiny'>&nbsp;</p>");
			}//TERMINA STATUS 200
		}//TERMINA READYSTATE 4
	}//TERMINA ONREADYSTATE
}