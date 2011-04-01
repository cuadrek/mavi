<?

header("Content-Type: application/xml");

$ACCION=$_POST["ACCION"];
$ID_MARATON=$_POST["ID_MARATON"];
$ID_ETAPA=$_POST["ID_ETAPA"];
$ID_CUESTIONARIO=$_POST["ID_CUESTIONARIO"];
$ID_COMPETIDOR=$_POST["ID_COMPETIDOR"];
$RESPUESTA=$_POST["RESPUESTA"];

require_once("../clases/maraton.php");
require_once("../clases/competidor.php");
require_once("../clases/pregunta.php");

echo "<xml version='1.0' encoding='utf-8'><maraton>";

if($ACCION=="SINCRONIZAR"){
	$miMaraton=new Maraton($ID_MARATON,$ID_ETAPA);
	$competidorActual=new Competidor($ID_COMPETIDOR);
	$respSincronizacion=$competidorActual->buscaSincronizacion();
	if($respSincronizacion>0){
		$miNuevoMaraton=new Maraton(false,false,$respSincronizacion);
		$miNuevoMaraton->setPreguntaActual(new Pregunta($miNuevoMaraton->getCuestionarioPreguntaId()));
		echo "<fechaCreacion>".$miNuevoMaraton->getFechaCreacion()."</fechaCreacion>";
		echo "<tema>".$miNuevoMaraton->getTema()."</tema>";
		echo "<idMaraton>".$miNuevoMaraton->getIdMaraton()."</idMaraton>";
		echo "<cuestionario>".$miNuevoMaraton->getCuestionarioPreguntaId()."</cuestionario>";
		echo "<etapa>".$miNuevoMaraton->getEtapaActual()."</etapa>";
		echo "<totalPreguntasEtapa>".$miNuevoMaraton->getTotalPreguntasEtapa($miMaraton->getEtapaActual())."</totalPreguntasEtapa>";
		echo "<no_pregunta>".$miNuevoMaraton->getPreguntaActual()->getNumeroPregunta()."</no_pregunta>";
		$elementos_XML=$elementos_XML."<tipo>".$miNuevoMaraton->getPreguntaActual()->getTipo()."</tipo>";	
	}
	else{
		$miMaraton->setPreguntaActual(new Pregunta($miMaraton->getCuestionarioPreguntaId()));
		$competidorActual->sincronizar($miMaraton);	
		echo "<fechaCreacion>".$miMaraton->getFechaCreacion()."</fechaCreacion>";
		echo "<tema>".$miMaraton->getTema()."</tema>";
		echo "<idMaraton>".$miMaraton->getIdMaraton()."</idMaraton>";
		echo "<cuestionario>".$miMaraton->getCuestionarioPreguntaId()."</cuestionario>";
		echo "<etapa>".$miMaraton->getEtapaActual()."</etapa>";
		echo "<totalPreguntasEtapa>".$miMaraton->getTotalPreguntasEtapa($miMaraton->getEtapaActual())."</totalPreguntasEtapa>";
		echo "<no_pregunta>".$miMaraton->getPreguntaActual()->getNumeroPregunta()."</no_pregunta>";
		echo "<tipo>".$miMaraton->getPreguntaActual()->getTipo()."</tipo>";
	
	}
	echo $elementos_XML;
}

if($ACCION=="VERPREGUNTA"){
	$miPregunta=new Pregunta($ID_CUESTIONARIO);
	echo "<pregunta>".$miPregunta->getPregunta()."</pregunta>";
	echo "<opcionA>".$miPregunta->getOpcionA()."</opcionA>";
	echo "<opcionB>".$miPregunta->getOpcionB()."</opcionB>";
	echo "<opcionC>".$miPregunta->getOpcionC()."</opcionC>";
	echo "<opcionD>".$miPregunta->getOpcionD()."</opcionD>";
}

if($ACCION=="GUARDAR"){
	echo "<exito>";
	$miMaraton=new Maraton(false,false,$ID_CUESTIONARIO);
	$competidorActual=new Competidor($ID_COMPETIDOR);
	echo $competidorActual->guardarRespuesta($RESPUESTA,$miMaraton)."</exito>";
	echo "<aciertos>".$competidorActual->calculaAciertos()."</aciertos>";
	echo "<errores>".$competidorActual->calculaErrores()."</errores>";
	echo "<puntaje>".$competidorActual->calculaPuntaje()."</puntaje>";
}

if($ACCION=="REVISACONTESTO")
{
	echo "<resultado>";
	$miMaraton=new Maraton(false,false,$ID_CUESTIONARIO);
	$competidorActual=new Competidor($ID_COMPETIDOR);
	$miMaraton->buscaRespuestaCompetidor($competidorActual);
	echo "</resultado>";
	
}
if($ACCION=="SIGUIENTE"){
	$miMaraton=new Maraton(false,false,$ID_CUESTIONARIO);
	$miMaraton->siguientePregunta();	
	$miPregunta=new Pregunta($miMaraton->getCuestionarioPreguntaId());
	$competidorActual=new Competidor($ID_COMPETIDOR);
	$competidorActual->actualizaSincronizacion($miMaraton);
	echo "<cuestionario>".$miMaraton->getCuestionarioPreguntaId()."</cuestionario>";
	echo "<numeroPregunta>".$miPregunta->getNumeroPregunta()."</numeroPregunta>";
	echo "<tipo>".$miPregunta->getTipo()."</tipo>";
}
echo "</maraton></xml>";
?>