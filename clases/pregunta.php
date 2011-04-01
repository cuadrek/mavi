<?

class Pregunta{
	private $numeroPregunta;
	private $pregunta;
	private $opcionA;
	private $opcionB;
	private $opcionC;
	private $opcionD;
	private $respuestaCorrecta;
	private $area;
	private $tema;
	private $justificacion;
	private $docente;
	private $gradoDificultad;
	private $tipo;
	
	function __construct($CUESTIONARIO_PREGUNTA){
		//if(!is_null($CUESTIONARIO_PREGUNTA)){
			include("../script/php/conexion.php");
			//$buscaPregunta="SELECT*FROM preguntas,cuestionario_pregunta WHERE preguntas.id LIKE cuestionario_pregunta.preguntas_id AND cuestionario_pregunta.secuencia LIKE '".$SECUENCIA."' AND cuestionario_pregunta.maraton_id LIKE '".$ID_MARATON."' AND cuestionario_pregunta.etapa_id LIKE '".$ETAPA."' LIMIT 1";
			$ejecutaPregunta=mysql_query("SELECT*FROM preguntas, cuestionario_pregunta WHERE cuestionario_pregunta.preguntas_id LIKE preguntas.id AND cuestionario_pregunta.id LIKE '".$CUESTIONARIO_PREGUNTA."' LIMIT 1 ");
			$resultado=mysql_fetch_array($ejecutaPregunta);
			$this->setNumeroPregunta($resultado["secuencia"]);
			$this->setPregunta(htmlspecialchars(utf8_encode($resultado["pregunta"])));
			$this->setOpcionA(htmlspecialchars(utf8_encode($resultado["opcion1"])));
			$this->setOpcionB(htmlspecialchars(utf8_encode($resultado["opcion2"])));
			$this->setOpcionC(htmlspecialchars(utf8_encode($resultado["opcion3"])));
			$this->setOpcionD(htmlspecialchars(utf8_encode($resultado["opcion4"])));
			$this->setRespuestaCorrecta($resultado["respuesta"]);
			$variableTemporal=".";
			$this->setJustificacion(htmlspecialchars(utf8_encode($variableTemporal)));
			$this->setArea($resultado["cat_area_id"]);
			$this->setTema($resultado["cat_temas_id"]);
			$this->setDocente(htmlspecialchars($resultado["nombre_docente"]));
			$this->setGradoDificultad($resultado["grado_dificultad"]);
			$this->setTipo($resultado["tipo"]);
			mysql_close();
		//}
		/*else{
			$miConsulta="INSERT INTO pregunta VALUES('".$PREGUNTA."')";
			//algo asi
		}*/
			
	}
		
	function setNumeroPregunta($NUMERO_PREGUNTA){
		$this->numeroPregunta=$NUMERO_PREGUNTA;	
	}
	
	function setPregunta($PREGUNTA){
		$this->pregunta=$PREGUNTA;	
	}
	
	function setOpcionA($OPCION_A){
		$this->opcionA=$OPCION_A;
	}
	
	function setOpcionB($OPCION_B){
		$this->opcionB=$OPCION_B;
	}
	
	function setOpcionC($OPCION_C){
		$this->opcionC=$OPCION_C;
	}
	
	function setOpcionD($OPCION_D){
		$this->opcionD=$OPCION_D;
	}
	
	function setRespuestaCorrecta($RESPUESTA_CORRECTA){
		$this->respuestaCorrecta=$RESPUESTA_CORRECTA;
	}
	
	function setJustificacion($JUSTIFICACION){
		$this->justificacion=$JUSTIFICACION;
	}
	
	function setArea($AREA){
		$this->area=$AREA;
	}
	
	function setTema($TEMA){
		$this->tema=$TEMA;
	}
	
	function setTipo($TIPO){
		$this->tipo=$TIPO;
	}
	
	function setDocente($DOCENTE){
		$this->docente=$DOCENTE;
	}
	
	function setGradoDificultad($GRADO_DIFICULTAD){
		$this->gradoDificultad=$GRADO_DIFICULTAD;
	}
		
	function getNumeroPregunta(){
		return $this->numeroPregunta;	
	}
	
	function getPregunta(){
		return $this->pregunta;	
	}

	function getOpcionA(){
		return $this->opcionA;
	}
	
	function getOpcionB(){
		return $this->opcionB;
	}
	
	function getOpcionC(){
		return $this->opcionC;
	}
	
	function getOpcionD(){
		return $this->opcionD;
	}
	
	function getRespuestaCorrecta(){
		return $this->respuestaCorrecta;
	}
	
	function getJustificacion(){
		return $this->justificacion;
	}
	
	function getArea(){
		return $this->area;
	}
	
	function getDocente(){
		return $this->docente;
	}
	
	function getTipo(){
		return $this->tipo;
	}
	
	function getGradoDificultad(){
		return $this->gradoDificultad;
	}	
}
?>