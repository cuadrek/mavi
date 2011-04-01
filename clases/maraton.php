<?
class Maraton{
	private $idMaraton;
	private $fechaCreacion;
	private $universidad;
	private $region;
	private $tema;
	private $fechaAplicacion;
	private $cuestionario_pregunta_id;
	private $preguntaActual;
	private $etapaActual;
	private $secuencia;
	private $estado;
	
	function __construct($ID_MARATON=null,$ETAPA_ACTUAL=null,$CUESTIONARIO=null,$ADMINISTRADOR=null){
		if(is_null($CUESTIONARIO)){
		   	require_once("../script/php/conexion.php");
			$buscaMaraton="SELECT maraton.fecha_creacion AS fecha_creacion, maraton.cat_universidad_id AS cat_universidad_id, maraton.cat_regiones_id AS cat_regiones_id, maraton.nombre_tema AS nombre_tema, cuestionario_pregunta.id AS id FROM maraton, cuestionario_pregunta WHERE maraton.id LIKE '".$ID_MARATON."' AND maraton.id LIKE cuestionario_pregunta.maraton_id AND cuestionario_pregunta.secuencia LIKE '1' AND cuestionario_pregunta.etapa_id LIKE '".$ETAPA_ACTUAL."' LIMIT 1";
			$ejecuta=mysql_query($buscaMaraton);
			$resultado=mysql_fetch_array($ejecuta);
			$this->idMaraton=$ID_MARATON;
			$this->setEtapaActual($ETAPA_ACTUAL);
			$this->fechaCreacion=$resultado["fecha_creacion"];
			$this->universidad=$resultado["cat_universidad_id"];
			$this->region=$resultado["cat_regiones_id"];
			$this->tema=$resultado["nombre_tema"];
			$this->cuestionario_pregunta_id=$resultado["id"];		
			$this->secuencia=1;
			mysql_close();
		}
		else if(!is_null($ADMINISTRADOR)){
			require_once("../script/php/conexion.php");
			$buscaMaraton="SELECT maraton.fecha_creacion AS fecha_creacion, maraton.cat_universidad_id AS cat_universidad_id, maraton.cat_regiones_id AS cat_regiones_id, maraton.nombre_tema AS nombre_tema, cuestionario_pregunta.id AS id, cuestionario_pregunta.secuencia AS secuencia, cuestionario_pregunta.etapa_id AS etapa FROM maraton, cuestionario_pregunta,maraton_activo WHERE maraton.id LIKE '".$ID_MARATON."' AND maraton.id LIKE cuestionario_pregunta.maraton_id AND maraton_activo.usuario_id LIKE '".$ADMINISTRADOR."' AND maraton_activo.cuestionario_pregunta_id LIKE cuestionario_pregunta.id LIMIT 1";
			$ejecuta=mysql_query($buscaMaraton);
			$resultado=mysql_fetch_array($ejecuta);
			$this->idMaraton=$ID_MARATON;
			$this->setEtapaActual($resultado["etapa"]);
			$this->fechaCreacion=$resultado["fecha_creacion"];
			$this->universidad=$resultado["cat_universidad_id"];
			$this->region=$resultado["cat_regiones_id"];
			$this->tema=$resultado["nombre_tema"];
			$this->cuestionario_pregunta_id=$resultado["id"];		
			$this->secuencia=$resultado["secuencia"];
			mysql_close();
		}
		else{
			require_once("../script/php/conexion.php");
			$buscaMaraton="SELECT cuestionario_pregunta.etapa_id, maraton.id, maraton.fecha_creacion AS fecha_creacion, maraton.cat_universidad_id AS cat_universidad_id, maraton.cat_regiones_id AS cat_regiones_id, maraton.nombre_tema AS nombre_tema, cuestionario_pregunta.secuencia FROM maraton, cuestionario_pregunta WHERE cuestionario_pregunta.maraton_id = maraton.id AND cuestionario_pregunta.id LIKE '".$CUESTIONARIO."' LIMIT 1";
			/*$buscaMaraton="SELECT cuestionario_pregunta.etapa_id, maraton.id, cuestionario_pregunta.secuencia FROM maraton_activo INNER JOIN cuestionario_pregunta ON (maraton_activo.cuestionario_pregunta_id = cuestionario_pregunta.id) INNER JOIN mavi_db.maraton ON (cuestionario_pregunta.maraton_id = maraton.id) WHERE cuestionario_pregunta.id LIKE '".$CUESTIONARIO."' LIMIT 1;";*/
			$ejecuta=mysql_query($buscaMaraton);
			$resultado=mysql_fetch_array($ejecuta);
			$this->idMaraton=$resultado["id"];
			$this->setEtapaActual($resultado["etapa_id"]);
			$this->cuestionario_pregunta_id=$CUESTIONARIO;		
			$this->secuencia=$resultado["secuencia"];
			$this->fechaCreacion=$resultado["fecha_creacion"];
			$this->universidad=$resultado["cat_universidad_id"];
			$this->region=$resultado["cat_regiones_id"];
			$this->tema=$resultado["nombre_tema"];
			mysql_close();	
		}
	}
		
	function setSecuencia($SECUENCIA){
		$this->secuencia=$SECUENCIA;
	}
	
	function setEtapaActual($ETAPA){
		$this->etapaActual=$ETAPA;
	}
	
	function setCuestionarioPreguntaId($CUESTIONARIO){
		$this->cuestionario_pregunta_id=$CUESTIONARIO;	
	}
	function getSecuencia(){
		return $this->secuencia;	
	}
	
	function setNext($SECUENCIA){
		$this->secuencia=$SECUENCIA+1;	
	}
	
	function getIdMaraton(){
		return $this->idMaraton;	
	}
	
	function getFechaCreacion(){
		return $this->fechaCreacion;	
	}
	
	function setFechaCreacion($FECHA_CREACION){
		$this->fechaCreacion=$FECHA_CREACION;	
	}
	
	function getPreguntaActual(){
		return $this->preguntaActual;	
	}
	
	function getTema(){
		return $this->tema;	
	}

	function getEtapaActual(){
		return $this->etapaActual;
	}
	
	function getEstado(){
		return $this->estado;
	}
	
	function getCuestionarioPreguntaId(){
		return $this->cuestionario_pregunta_id;	
	}
	
	function getTotalPreguntasEtapa($ETAPA){
		include("../script/php/conexion.php");
		$buscaTotal="SELECT COUNT(*) AS TOTAL FROM cuestionario_pregunta WHERE etapa_id LIKE '".$ETAPA."' AND maraton_id LIKE '".$this->idMaraton."' LIMIT 1";
		$ejecuta=mysql_query($buscaTotal);
		$resultado=mysql_fetch_array($ejecuta);
		mysql_close();
		return $resultado["TOTAL"];
	}
	
	function setPreguntaActual(Pregunta $PREGUNTA){
		$this->preguntaActual=$PREGUNTA;	
	}
	
	function setEstado($ESTADO){
			$this->estado=$ESTADO;
	}
	
	function siguientePregunta(){
		include("../script/php/conexion.php");
		$busca="SELECT id FROM cuestionario_pregunta WHERE maraton_id LIKE '".$this->idMaraton."' AND etapa_id LIKE '".$this->etapaActual."' AND secuencia LIKE '".($this->getSecuencia()+1)."'";
		$ejecuta=mysql_query($busca);
		$resultado=mysql_fetch_array($ejecuta);
		if($resultado["id"]>0)
		{
			$this->setCuestionarioPreguntaId($resultado["id"]);
		}
		else{
			$busca="SELECT id FROM cuestionario_pregunta WHERE maraton_id LIKE '".$this->idMaraton."' AND etapa_id LIKE '".$this->etapaActual."' AND secuencia LIKE '".($this->getSecuencia())."'";
			$ejecuta=mysql_query($busca);
			$resultado=mysql_fetch_array($ejecuta);
			$this->setCuestionarioPreguntaId($resultado["id"]);
		}
		mysql_close();
	}
	
	function getPermisoResponder(){
		include("../script/php/conexion.php");
		$busca="SELECT activo FROM maraton_activo WHERE cuestionario_pregunta_id LIKE '".$this->getCuestionarioPreguntaId()."' LIMIT 1";
		$ejecuta=mysql_query($busca);
		$resultado=mysql_fetch_array($ejecuta);
		mysql_close();
		return $resultado["activo"];		
	}
	
	function buscaRespuestaCompetidor(Competidor $miCompetidor){
		include("../script/php/conexion.php");
		$busca="SELECT id FROM respuesta WHERE cuestionario_pregunta_id LIKE '".$this->getCuestionarioPreguntaId()."' AND usuario_id LIKE '".$miCompetidor->getIdEquipo()."'";
		$ejecuta=mysql_query($busca);
		$resultado=mysql_num_rows($ejecuta);
		mysql_close();
		return $resultado;
	}
	function registrarActual(){
		
	}
}
	
?>