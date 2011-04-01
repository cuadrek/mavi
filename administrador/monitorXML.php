<?
header("Content-Type: application/xml");
$ACCION=$_POST["ACCION"];
$ID_MARATON=$_POST["ID_MARATON"];
$ID_ADMINISTRADOR=$_POST["ID_ADMINISTRADOR"];
$ID_ETAPA=$_POST["ID_ETAPA"];
$ID_CUESTIONARIO=$_POST["ID_CUESTIONARIO"];
$ULTIMA=$_POST["ULTIMA"];

require_once("../clases/administrador.php");
require_once("../clases/maraton.php");
require_once("../clases/pregunta.php");
require_once("../clases/competidor.php");

echo '<xml version="1.0" encoding="iso-8859-1">';	
echo "<maraton>";
if($ACCION=="SINCRONIZAR"){
	$miMaraton=new Maraton($ID_MARATON,$ID_ETAPA);
	$miAdmin=new Administrador($ID_ADMINISTRADOR);
	$miAdmin->iniciarMaraton($miMaraton);
	if($miMaraton->getEstado()=="nuevo"){
		echo "<exito>1</exito>";
	}
	else if($miMaraton->getEstado()=="no"){	
		echo "<exito>0</exito>";
	}
	else{
		/*SIGNIFICA QUE YA ESTABA EMPEZADO EL MARATON*/
		echo "<exito>2</exito>";
		echo "<idMaraton>".$miMaraton->getIdMaraton()."</idMaraton>";
		echo "<cuestionario>".$miMaraton->getCuestionarioPreguntaId()."</cuestionario>";
		echo "<etapa>".$miMaraton->getEtapaActual()."</etapa>";
		echo "<total>".$miMaraton->getTotalPreguntasEtapa($ID_ETAPA)."</total>";
	}
}

if($ACCION=="CONTINUAR"){
		$miMaraton=new Maraton($ID_MARATON,false,false,$ID_ADMINISTRADOR);
		echo "<idMaraton>".$miMaraton->getIdMaraton()."</idMaraton>";
		echo "<cuestionario>".$miMaraton->getCuestionarioPreguntaId()."</cuestionario>";
		echo "<etapa>".$miMaraton->getEtapaActual()."</etapa>";
		echo "<total>".$miMaraton->getTotalPreguntasEtapa($miMaraton->getEtapaActual())."</total>";
}
if($ACCION=="OBTENER"){
	$miMaraton=new Maraton($ID_MARATON,$ID_ETAPA);
	echo "<idMaraton>".$miMaraton->getIdMaraton()."</idMaraton>";
	echo "<cuestionario>".$miMaraton->getCuestionarioPreguntaId()."</cuestionario>";
	echo "<etapa>".$miMaraton->getEtapaActual()."</etapa>";
	echo "<total>".$miMaraton->getTotalPreguntasEtapa($ID_ETAPA)."</total>";
}

if($ACCION=="LEERPREGUNTA"){
	$miMaraton=new Maraton(false,false,$ID_CUESTIONARIO);
	$miPregunta=new Pregunta($miMaraton->getCuestionarioPreguntaId());
	echo "<numeroPregunta>".$miPregunta->getNumeroPregunta()."</numeroPregunta>";
	echo "<tipo>".$miPregunta->getTipo()."</tipo>";
}

if($ACCION=="LEERPREGUNTAACUAL"){
	$miMaraton=new Maraton(false,false,$ID_CUESTIONARIO);
	$miPregunta=new Pregunta($miMaraton->getCuestionarioPreguntaId());
	echo "<numeroPregunta>".$miPregunta->getNumeroPregunta()."</numeroPregunta>";
	echo "<tipo>".$miPregunta->getTipo()."</tipo>";
}

if($ACCION=="MOSTRAR"){
	$miPregunta=new Pregunta($ID_CUESTIONARIO);
	echo "<pregunta>".$miPregunta->getPregunta()."</pregunta>";
	echo "<opcionA>".$miPregunta->getOpcionA()."</opcionA>";
	echo "<opcionB>".$miPregunta->getOpcionB()."</opcionB>";
	echo "<opcionC>".$miPregunta->getOpcionC()."</opcionC>";
	echo "<opcionD>".$miPregunta->getOpcionD()."</opcionD>";
	echo "<tipo>".$miPregunta->getTipo()."</tipo>";	
}

if($ACCION=="RESPUESTA"){
	$miAdmin=new Administrador($ID_ADMINISTRADOR);
	$miPregunta=new Pregunta($ID_CUESTIONARIO);
	echo "<opcionA>".$miPregunta->getOpcionA()."</opcionA>";
	echo "<opcionB>".$miPregunta->getOpcionB()."</opcionB>";
	echo "<opcionC>".$miPregunta->getOpcionC()."</opcionC>";
	echo "<opcionD>".$miPregunta->getOpcionD()."</opcionD>";
	echo "<justificacion>".$miPregunta->getJustificacion()."</justificacion>";
	echo "<respuesta>".$miPregunta->getRespuestaCorrecta()."</respuesta>";
	$total=$miAdmin->cuentaEquipos($ID_CUESTIONARIO);
	echo "<numero>".$total."</numero>";
		for($i=0;$i<$total;$i++){
			$idUsuario_temp=$miAdmin->verificaEquipo($ID_CUESTIONARIO,$i);
			$equipo=new Competidor($idUsuario_temp);
			echo "<nombreEquipo".($i+1).">".$equipo->getNombreUsuario($idUsuario_temp)."</nombreEquipo".($i+1).">";
			echo "<equipo".($i+1).">".$equipo->miRespuesta($ID_CUESTIONARIO)."</equipo".($i+1).">";
			echo "<tiempoEquipo".($i+1).">".$equipo->miTiempoRespuesta($ID_CUESTIONARIO)."</tiempoEquipo".($i+1).">";
			
		}
}

if($ACCION=="SIGUIENTE"){
	$miAdmin=new Administrador($ID_ADMINISTRADOR);
	$miMaraton=new Maraton(false,false,$ID_CUESTIONARIO);
	$permiso_temp=$miAdmin->permisoSiguiente($miMaraton);
	echo "<permiso>".$permiso_temp."</permiso>";
	$miMaraton->siguientePregunta();
		$miAdmin->siguientePregunta($miMaraton);
		$miPregunta=new Pregunta($miMaraton->getCuestionarioPreguntaId());
		echo "<cuestionario>".$miMaraton->getCuestionarioPreguntaId()."</cuestionario>";
		echo "<numeroPregunta>".$miPregunta->getNumeroPregunta()."</numeroPregunta>";
		echo "<tipo>".$miPregunta->getTipo()."</tipo>";
	
}

if($ACCION=="MONITOREA"){
	$miMaraton=new Maraton(false,false,$ID_CUESTIONARIO);
	
	$miMaraton->siguientePregunta();
	$miAdmin=new Administrador($ID_ADMINISTRADOR);
	$total=$miAdmin->equiposRegistrados($miMaraton,$ID_CUESTIONARIO);
	$totalTemp=$miAdmin->cuentaEquipos($ID_CUESTIONARIO);
	echo "<total>".$total."</total>";
	echo "<equipos>".$totalTemp."</equipos>";
	if($totalTemp>0){
		for($i=0;$i<$total;$i++){
			$idUsuario_temp=$miAdmin->verificaEquipo($ID_CUESTIONARIO,$i);
			$equipo=new Competidor($idUsuario_temp);
			$miEqui=$equipo->getNombreUsuario($idUsuario_temp);
			$arregloSepara= explode("equipo", $miEqui);
			echo "<nombreEquipo".($i+1).">".$arregloSepara[1]."</nombreEquipo".($i+1).">";
		}
	}
}

echo "</maraton>";
echo "</xml>";	
?>