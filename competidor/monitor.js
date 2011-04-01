// JavaScript Document
var linea="<h1 class='barrah1'>&nbsp;</h1>";
//var botonRespuesta='<a href="#" id="btGuardarRespuesta" name="btGuardarRespuesta" class="button"><span>Guardar Respuesta</span></a>';
var botonRespuesta='<button id="btGuardarRespuesta" name="btGuardarRespuesta" type="button">Guardar Respuesta</button>';

document.getElementById("btPuntaje").style.display = "none";

$("#btIniciar").click(function(){
	iniciarMaraton();
});

$("#btResponder").click(function(){
	responder();
});

function iniciarMaraton(){
	if($("#maratones_sl").val()>0 && $("#etapas_sl").val()>0)
	{
		ajInicia=new objetoAjax();
		ajInicia.open("POST","maratonXML.php",true);
		ajInicia.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");/*text/html; charset=iso-8859-1*/
		ajInicia.send("ACCION=SINCRONIZAR&ID_MARATON="+$("#maratones_sl").val()+"&ID_ETAPA="+$("#etapas_sl").val()+"&ID_COMPETIDOR="+$("#fr_id_competidor").val());
		ajInicia.onreadystatechange=function()
		{
			if(ajInicia.readyState==4)
			{
				if(ajInicia.status == 200)
				{
					var xml=ajInicia.responseXML.documentElement;
					var maraton=xml.getElementsByTagName("maraton")[0];
				 					
					/*********************** VARIABLES OCULTAS ***********************************/
					document.getElementById("fr_id_maraton").value=maraton.getElementsByTagName("idMaraton")[0].firstChild.data;
					document.getElementById("fr_cuestionario_pregunta").value=maraton.getElementsByTagName("cuestionario")[0].firstChild.data;
					document.getElementById("fr_no_pregunta").value=maraton.getElementsByTagName("no_pregunta")[0].firstChild.data;
					document.getElementById("fr_tipo").value=maraton.getElementsByTagName("tipo")[0].firstChild.data;
					document.getElementById("fr_etapa").value=maraton.getElementsByTagName("etapa")[0].firstChild.data;
					document.getElementById("fr_aciertos").value="Pendiente";
					document.getElementById("fr_errores").value="Pendiente";
					document.getElementById("fr_puntaje").value="Pendiente";
					
					/*********************** VARIABLES OCULTAS ***********************************/
					document.getElementById("etNumeroPregunta").innerHTML=maraton.getElementsByTagName("no_pregunta")[0].firstChild.data;
					document.getElementById("etTotalPreguntas").innerHTML=maraton.getElementsByTagName("totalPreguntasEtapa")[0].firstChild.data;
					
					if(maraton.getElementsByTagName("tipo")[0].firstChild.data=="1"){
						document.getElementById("etTipo").innerHTML="Te&oacute;rica";
						document.getElementById("etTiempo").innerHTML="1 minuto";
					}
					else{
						document.getElementById("etTipo").innerHTML="Pr&aacute;ctica";	
						document.getElementById("etTiempo").innerHTML="3 minutos";
					}
					
					document.getElementById("etEtapa").innerHTML=maraton.getElementsByTagName("etapa")[0].firstChild.data;
					document.getElementById("etAciertos").innerHTML="Pendiente";
					document.getElementById("etErrores").innerHTML="Pendiente";
					document.getElementById("etPuntaje").innerHTML="Pendiente";
					
					/****************************** MOVEMOS LOS PANELES *************************************/
					$("#mcContenTop").slideToggle("slow");
					document.getElementById("pregunta").innerHTML="Listo, acaba de comenzar el Marat&oacute;n de: <strong>"+maraton.getElementsByTagName("tema")[0].firstChild.data+"</strong>, espere a la indicación del Moderador, para poder contestar la primer pregunta.";
					var contenidoTiny="<p class='mensajeTiny'>Se han cargado con exito los datos.</p><center><p class='mensajeTiny'><a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p></center><p>&nbsp;</p>";
					mensajeExito(contenidoTiny);
					$("#item_iniciar").hide("slow");
				}
				else{
					document.getElementById("pregunta").innerHTML="Pagina no encontrada";
					var contenidoTiny="<p class='mensajeTiny'>Por favor intentelo m&aacute;s tarde.</p><p class='mensajeTiny'><a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p></center><p>&nbsp;</p>";
					mensajeError(contenidoTiny);
				}
			}
			else{
				document.getElementById("pregunta").innerHTML="Cargando ...";
			}
		}
		
	}
	else{
		var contenidoTiny="<p class='mensajeTiny'>Seleccione un Maratón y una Fase.</p><center><p class='mensajeTiny'><a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a><p></center><p>&nbsp;</p>";
		mensajeError(contenidoTiny);
	}
}


function responder(){
	var idMaraton=$("#fr_id_maraton").val();
	var idCuestionario=$("#fr_cuestionario_pregunta").val();
	var idEquipo=document.getElementById("fr_id_competidor").value
	if( idMaraton >0 && idCuestionario > 0){
		verPregunta(idMaraton,idCuestionario,idEquipo);
	}
	else{
		mensajeAlerta("<p class='mensajeTiny'>Usted no ha sincronizado su sesión con ningun maraton</p><a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a><p class='mensajeTiny'>&nbsp;</p>");
	}
}

function verificarPermiso(IDMARATON,IDCUESTIONARIO,IDEQUIPO)
{
	peticionPermiso=new objetoAjax();	
	peticionPermiso.open("POST","permiso.php",true);
	peticionPermiso.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");// text/html; charset=iso-8859-1
	peticionPermiso.send("ID_MARATON="+IDMARATON+"&ID_CUESTIONARIO="+IDCUESTIONARIO+"&ID_EQUIPO="+IDEQUIPO);
	peticionPermiso.onreadystatechange=function()
	{
		if(peticionPermiso.readyState==4)
		{
			if(peticionPermiso.status==200)
			{
				PERMISO=peticionPermiso.responseText;
				if(PERMISO==1 || PERMISO==2){
					//Es cuando el Administrador ya dio su permiso para que los demas pudieran contestar
					verPregunta(permiso);
				}
				else{
					//Es cuando el Administrador aun no ha dado permiso para que los demas puedan contestar
					mensajeAlerta("<p class='mensajeTiny'>No tiene permiso para contestar a&uacute;n.</p><p class='mensajeTiny'><a href='#' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p><p class='mensajeTiny'>&nbsp;</p>");
				}
			}
			else{
				mensajeError("<p class='mensajeTiny'>Por favor intentelo m&aacute;s tarde.</p><p class='mensajeTiny'><a href='#' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p><p class='mensajeTiny'>&nbsp;</p>");
			}
		}
		else{
			mensajeError("<p class='mensajeTiny'>Por favor intentelo m&aacute;s tarde.</p><p class='mensajeTiny'><a href='#' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p><p class='mensajeTiny'>&nbsp;</p>");	
		}
	}
}

function verPregunta(IDMARATON,IDCUESTIONARIO,IDEQUIPO){
	peticionPermiso=new objetoAjax();	
	peticionPermiso.open("POST","permiso.php",true);
	peticionPermiso.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");// text/html; charset=iso-8859-1
	peticionPermiso.send("ID_MARATON="+IDMARATON+"&ID_CUESTIONARIO="+IDCUESTIONARIO+"&ID_EQUIPO="+IDEQUIPO);
	peticionPermiso.onreadystatechange=function()
	{
		if(peticionPermiso.readyState==4)
		{
			if(peticionPermiso.status==200)
			{
				var PERMISO=peticionPermiso.responseText;
				if(PERMISO==1){
					//Es cuando el Administrador ya dio su permiso para que los demas pudieran contestar
					/*if(PERMISO==2)
					{
						mensajeAlerta("<p class='mensajeTiny'>Esta pregunta ya fue contestada.</p><p class='mensajeTiny'><a href='#' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p><p class='mensajeTiny'>&nbsp;</p>");							
					}*/
					ver=new objetoAjax();	
					ver.open("POST","maratonXML.php",true);
					ver.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");// text/html; charset=iso-8859-1
					ver.send("ACCION=VERPREGUNTA&ID_CUESTIONARIO="+document.getElementById("fr_cuestionario_pregunta").value);
					ver.onreadystatechange=function()
					{
						if(ver.readyState==4)
						{
							if(ver.status==200)
							{
								var respXML=ver.responseXML.documentElement;
								var maraton=respXML.getElementsByTagName("maraton")[0];
								document.getElementById("pregunta").innerHTML='<span>'+maraton.getElementsByTagName("pregunta")[0].firstChild.data+"</span>";
								document.getElementById("opcionA").innerHTML='<input type="radio" name="respuesta" id="respuesta" value="1" ><span> <label>A)'+maraton.getElementsByTagName("opcionA")[0].firstChild.data+'</label></span>';
								document.getElementById("opcionB").innerHTML='<input type="radio" name="respuesta" id="respuesta" value="2" ><span> <label>B)'+maraton.getElementsByTagName("opcionB")[0].firstChild.data+'</label></span>';
								document.getElementById("opcionC").innerHTML='<input type="radio" name="respuesta" id="respuesta" value="3" ><span> <label>C)'+maraton.getElementsByTagName("opcionC")[0].firstChild.data+'</label></span>';
								document.getElementById("opcionD").innerHTML='<input type="radio" name="respuesta" id="respuesta" value="4" ><span> <label>D)'+maraton.getElementsByTagName("opcionD")[0].firstChild.data+'</label></span>';
								document.getElementById("spanResponder").innerHTML=botonRespuesta;
								$("#btGuardarRespuesta").click(function(){
									guardar();
								});
							}
							else{
								mensajeError("<p class='mensajeTiny'>Por favor vuelva a intentarlo.</p><p class='mensajeTiny'><a href='#' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p><p class='mensajeTiny'>&nbsp;</p>");
							}
						}	
						else{
							document.getElementById("pregunta").innerHTML="cargando...";			
						}
					}
				}
				else{
					//Es cuando el Administrador aun no ha dado permiso para que los demas puedan contestar
					mensajeAlerta("<p class='mensajeTiny'>No tiene permiso para contestar a&uacute;n.</p><p class='mensajeTiny'><a href='#' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p><p class='mensajeTiny'>&nbsp;</p>");
					document.getElementById("pregunta").innerHTML="Para ver la siguiente pregunta, haga clic en el botón 'responder' del menu superior, por favor espere a la indicaci&oacute;n del administrador.";		
				}
			}
			else{
				mensajeError("<p class='mensajeTiny'>Por favor, intenelo m&aacute;s tarde.</p><p class='mensajeTiny'><a href='#' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p><p class='mensajeTiny'>&nbsp;</p>");
			}
		}
		else{
			document.getElementById("pregunta").innerHTML="Cargando ...";	
		}
	}
}

function guardar(){
	var miRespuesta=$("input[@name='respuesta'][checked]").val();
	if(miRespuesta>0)
	{
		guardarAJ=new objetoAjax();	
		guardarAJ.open("POST","maratonXML.php",true);
		guardarAJ.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");// text/html; charset=iso-8859-1
		guardarAJ.send("ACCION=GUARDAR&ID_CUESTIONARIO="+document.getElementById("fr_cuestionario_pregunta").value+"&ID_COMPETIDOR="+document.getElementById("fr_id_competidor").value+"&RESPUESTA="+miRespuesta);
		guardarAJ.onreadystatechange=function()
		{
			if(guardarAJ.readyState==4)
			{
				if(guardarAJ.status==200)
				{
					var xml=guardarAJ.responseXML.documentElement;
					var maraton=xml.getElementsByTagName("maraton")[0];
					var respTemp=maraton.getElementsByTagName("exito")[0].firstChild.data;
					document.getElementById("etAciertos").innerHTML=maraton.getElementsByTagName("aciertos")[0].firstChild.data;
					document.getElementById("etErrores").innerHTML=maraton.getElementsByTagName("errores")[0].firstChild.data;
					document.getElementById("etPuntaje").innerHTML=maraton.getElementsByTagName("puntaje")[0].firstChild.data;
			
					if(respTemp=="1")
					{
						if( document.getElementById("fr_no_pregunta").value == document.getElementById("etTotalPreguntas").innerHTML ){
							document.getElementById("fin_cuestionario").style.display = "block";
						}else{
							document.getElementById("fin_cuestionario").style.display = "none";
						}
						
						mensajeInformacion("<p class='mensajeTiny'>Se ha guardado su respuesta correctamente.</p><p class='mensajeTiny'><a href='#' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p><p class='mensajeTiny'>&nbsp;</p>");
						document.getElementById("pregunta").innerHTML="Para ver la siguiente pregunta, haga clic en el botón 'mostrar' del menu superior, por favor espere a la indicaci&oacute;n del administrador.";
						document.getElementById("opcionA").innerHTML="";
						document.getElementById("opcionB").innerHTML="";
						document.getElementById("opcionC").innerHTML='';
						document.getElementById("opcionD").innerHTML='';
						document.getElementById("spanResponder").innerHTML="";
						
						siguientePregunta();	
					}
					else if(respTemp=="2"){
						
						if( document.getElementById("fr_no_pregunta").value == document.getElementById("etTotalPreguntas").innerHTML ){
							document.getElementById("fin_cuestionario").style.display = "block";
						}else{
							document.getElementById("fin_cuestionario").style.display = "none";
						}
						
						mensajeAlerta("<p class='mensajeTiny'>Se ha guardado su respuesta correctamente, aunque por haber contestado fuera del tiempo permitido, su respuesta será tomada como mala.</p><p class='mensajeTiny'><a href='#' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p><p class='mensajeTiny'>&nbsp;</p>");
						document.getElementById("pregunta").innerHTML="Para ver la siguiente pregunta, haga clic en el botón 'mostrar' del menu superior, por favor espere a la indicaci&oacute;n del administrador.";
						document.getElementById("opcionA").innerHTML='';
						document.getElementById("opcionB").innerHTML='';
						document.getElementById("opcionC").innerHTML='';
						document.getElementById("opcionD").innerHTML='';
						document.getElementById("spanResponder").innerHTML="";
						
						siguientePregunta();	
					}
					else{
						mensajeError("<p class='mensajeTiny'>Por favor vuelva a intentarlo.</p><p class='mensajeTiny'><a href='#' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p><p class='mensajeTiny'>&nbsp;</p>");			
					}
				}
				else{
					mensajeError("<p class='mensajeTiny'>Por favor vuelva a intentarlo.</p><p class='mensajeTiny'><a href='#' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p><p class='mensajeTiny'>&nbsp;</p>");	
				}
			}
			else{
				document.getElementById("spanResponder").innerHTML="Guardando...";	
			}
		}
	}
	else{
		mensajeAlerta("<p class='mensajeTiny'>No ha seleccionado una respuesta.</p><p class='mensajeTiny'><a href='#' class='button' onclick='javascript:TINY.box.hide()'><span>Aceptar</span></a></p><p class='mensajeTiny'>&nbsp;</p>");			
	}
}

function siguientePregunta(){
	siguiente=new objetoAjax();	
	siguiente.open("POST","maratonXML.php",true);
	siguiente.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");// text/html; charset=iso-8859-1
	siguiente.send("ACCION=SIGUIENTE&ID_CUESTIONARIO="+document.getElementById("fr_cuestionario_pregunta").value+"&ID_COMPETIDOR="+document.getElementById("fr_id_competidor").value);
	siguiente.onreadystatechange=function()
	{
		if(siguiente.readyState==4)
		{
			if(siguiente.status==200)
			{
				var xml=siguiente.responseXML.documentElement;
				var maraton=xml.getElementsByTagName("maraton")[0];
				
				/**VALOR OCULTO***/
				document.getElementById("fr_cuestionario_pregunta").value=maraton.getElementsByTagName("cuestionario")[0].firstChild.data;
				document.getElementById("fr_no_pregunta").value=maraton.getElementsByTagName("numeroPregunta")[0].firstChild.data;
				document.getElementById("fr_tipo").value=maraton.getElementsByTagName("tipo")[0].firstChild.data;
				
				/**VALOR VISIBLE***/
				document.getElementById("etNumeroPregunta").innerHTML=maraton.getElementsByTagName("numeroPregunta")[0].firstChild.data;
				if(maraton.getElementsByTagName("tipo")[0].firstChild.data=="1"){
					document.getElementById("etTipo").innerHTML="Te&oacute;rica";
					document.getElementById("etTiempo").innerHTML="1 minuto";
					document.getElementById("fr_tiempo").value="1";
				}
				else{
					document.getElementById("etTipo").innerHTML="Pr&aacute;ctica";	
					document.getElementById("etTiempo").innerHTML="3 minutos";
					document.getElementById("fr_tiempo").value="3";
				}
			}
		}
	}
}
/*function contestada(){
	revisaAJ=new objetoAjax();	
	revisaAJ.open("POST","maratonXML.php",true);
	revisaAJ.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");// text/html; charset=iso-8859-1
	revisaAJ.send("ACCION=REVISACONTESTO&ID_CUESTIONARIO="+document.getElementById("fr_cuestionario_pregunta").value+"&ID_COMPETIDOR="+document.getElementById("fr_id_competidor").value);
	guardarAJ.onreadystatechange=function()
	{
		if(guardarAJ.readyState==4)
		{
			if(guardarAJ.status==200)
			{
				var xml=guardarAJ.responseXML.documentElement;
				var maraton=xml.getElementsByTagName("maraton")[0];
				var resultado=maraton.getElementsByTagName("resultado")[0].firstChild.data;
				
			}
		}
	}
}*/                                                                                                                                                            