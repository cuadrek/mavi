<?
class Competidor{
	private $idEquipo;	
	private $nombreUsuario;
	private $preguntaActual;
	private $respuestaActual;
	private $maratonActual;
	private $permisoResponder;
	
	function __construct($ID_EQUIPO){
			$this->setIdEquipo($ID_EQUIPO);
	}
	
	function setIdEquipo($ID_EQUIPO){
		$this->idEquipo=$ID_EQUIPO;
	}
	
	function getIdEquipo(){
		return $this->idEquipo;
	}
	function getNombreUsuario($ID){
		include("../script/php/conexion.php");
		$busca="SELECT nombre FROM usuario WHERE id LIKE '".$ID."' LIMIT 1";	
		$ejecuta=mysql_query($busca);
		$resultado=mysql_fetch_array($ejecuta);
		mysql_close();
		return $this->nombreUsuario=$resultado["nombre"];
	}
	
	function sincronizar(Maraton $maratonActual){
		include("../script/php/conexion.php");
		$sincornizarSQL="INSERT INTO competencia(usuario_id, cuestionario_pregunta_id) VALUES('".$this->getIdEquipo()."','".$maratonActual->getCuestionarioPreguntaId()."')";
		mysql_query($sincornizarSQL);
		/*IMPLEMENTAR MEJORAS DE SEGURIDAD*/
		mysql_close();
	}
	
	function buscaSincronizacion(){
		include("../script/php/conexion.php");
		$buscaSincronizacionSQL="SELECT*FROM competencia WHERE usuario_id LIKE '".$this->getIdEquipo()."'";
		$resultado=mysql_query($buscaSincronizacionSQL);
		if(mysql_num_rows($resultado)>0){
			$fila=mysql_fetch_array($resultado);
			return $fila["cuestionario_pregunta_id"];	
		}else{
			return "0";
		}
		/*IMPLEMENTAR MEJORAS DE SEGURIDAD*/
		mysql_close();
	}
	
	function actualizaSincronizacion(Maraton $maratonActual){
		include("../script/php/conexion.php");
		$sincornizarSQL="UPDATE competencia SET cuestionario_pregunta_id='".$maratonActual->getCuestionarioPreguntaId()."' WHERE usuario_id LIKE '".$this->getIdEquipo()."'";
		mysql_query($sincornizarSQL);
		/*IMPLEMENTAR MEJORAS DE SEGURIDAD*/
		mysql_close();
	}
	
	function setPreguntaActual($PREGUNTA_ACTUAL){
		$this->preguntaActual=$PREGUNTA_ACTUAL;
	}
	
	function getPreguntaActual(){
		return $this->preguntaActual;
	}
	
	function setRespuestaActual($RESPUESTA_ACTUAL){
		$this->respuestaActual=$RESPUESTA_ACTUAL;	
	}
	
	function getRespuestaActual(){
		return $this->respuestaActual;	
	}
	
	function setMaratonActual($MARATON_ACTUAL){
		$this->maratonActual=$MARATON_ACTUAL;	
	}
	
	function getMaratonActual(){
		return $this->maratonActual;	
	}
	
	function miRespuesta($ID_CUESTIONARIO){
		include("../script/php/conexion.php");
		$busca="SELECT respuesta FROM respuesta WHERE cuestionario_pregunta_id LIKE '".$ID_CUESTIONARIO."' AND usuario_id LIKE '".$this->getIdEquipo()."'";
		$ejecuta=mysql_query($busca);
		$resultado=mysql_fetch_array($ejecuta);
		$respuesta=$resultado["respuesta"];
		mysql_close();
		return $respuesta;
	}
	function miTiempoRespuesta($ID_CUESTIONARIO){
		include("../script/php/conexion.php");
		$busca="SELECT tiempo FROM respuesta WHERE cuestionario_pregunta_id LIKE '".$ID_CUESTIONARIO."' AND usuario_id LIKE '".$this->getIdEquipo()."'";
		$ejecuta=mysql_query($busca);
		$resultado=mysql_fetch_array($ejecuta);
		$tiempo=$resultado["tiempo"];
		mysql_close();
		return $tiempo;
	}
	function getPermisoResponder($ID_CUESTIONARIO){
		include("../script/php/conexion.php");
		$busca="SELECT activo FROM maraton_activo WHERE cuestionario_pregunta_id LIKE '".$ID_CUESTIONARIO."' LIMIT 1";
		$ejecuta=mysql_query($busca);
		if(mysql_num_rows($ejecuta)>0){
			$fila=mysql_fetch_array($ejecuta);
			mysql_close();
			return $this->permisoResponder=$fila["activo"];			
		}
		else{
			mysql_close();
			return $this->permisoResponder=0;			
		}
		
	}
	
	function guardarRespuesta($MIRESPUESTA, Maraton $miMaraton){
		$permiso_temp=$miMaraton->getPermisoResponder();
		include("../script/php/conexion.php");
		
		//$idEquipo=$this->getIdEquipo();
		//$cuestionarioPreguntaId=$miMaraton->getCuestionarioPreguntaId();
		//$consultaRespuestaGuardada
		
		$consutlaSiguienteId="SELECT MAX(id)+1 AS idMaximo FROM respuesta";
		$ejecutaResultado=mysql_query($consutlaSiguienteId);
		$arregloConsultaId=mysql_fetch_array($ejecutaResultado);
		$idSiguiente=$arregloConsultaId["idMaximo"];
		if(empty($idSiguiente))
		{
		$idSiguiente=1;
		}
		$insertaRespuesta="INSERT INTO respuesta(id,usuario_id,cuestionario_pregunta_id,respuesta,tiempo) VALUES('$idSiguiente','".$this->getIdEquipo()."','".$miMaraton->getCuestionarioPreguntaId()."','".$MIRESPUESTA."','".$permiso_temp."');";	
		
		
		mysql_query($insertaRespuesta) or die("CONEXION BLOQUEADA ".mysql_error());
		if($permiso_temp==1){
			//SI LA RESPUESTA FUE GUARDA A TIEMPO
			return 1;	
		}
		else{
			//SI LA RESPUESTA FUE GUARDADA DESPUES DEL TIEMPO CONSEDIDO POR EL ADMINISRADOR
			return 2;	
		}
		mysql_close();
	}
	
	function buscaEtapa(){
		
		$buscaEtapa="SELECT cuestionario_pregunta.etapa_id AS ETAPA FROM competencia, cuestionario_pregunta WHERE competencia.usuario_id LIKE '".$this->getIdEquipo()."' AND competencia.cuestionario_pregunta_id LIKE cuestionario_pregunta.id LIMIT 1";
		$ejecutaEtapa=mysql_query($buscaEtapa);
		$resultadoEtapa=mysql_fetch_array($ejecutaEtapa);	
		$etapa=$resultadoEtapa["ETAPA"];
	
		return $etapa;
	}
	
	function calculaAciertos(){
		include("../script/php/conexion.php");			
		$aciertos="SELECT COUNT(*) AS ACIERTOS FROM respuesta,cuestionario_pregunta, preguntas WHERE respuesta.usuario_id LIKE '".$this->getIdEquipo()."' AND cuestionario_pregunta.id LIKE respuesta.cuestionario_pregunta_id AND preguntas.id LIKE cuestionario_pregunta.preguntas_id AND respuesta.respuesta LIKE preguntas.respuesta AND respuesta.tiempo LIKE '1' AND cuestionario_pregunta.etapa_id LIKE '".$this->buscaEtapa()."'";
		$ejecuta=mysql_query($aciertos);
		$fila=mysql_fetch_array($ejecuta);
		$aciertos=$fila["ACIERTOS"];
		mysql_close();
		return $aciertos;
	}
	
	function calculaErrores(){
		include("../script/php/conexion.php");	
		$aciertos="SELECT COUNT(*) AS ERRORES FROM respuesta,cuestionario_pregunta, preguntas WHERE respuesta.usuario_id LIKE '".$this->getIdEquipo()."' AND cuestionario_pregunta.id LIKE respuesta.cuestionario_pregunta_id AND preguntas.id LIKE cuestionario_pregunta.preguntas_id AND cuestionario_pregunta.etapa_id LIKE '".$this->buscaEtapa()."' AND ( respuesta.respuesta NOT LIKE preguntas.respuesta OR respuesta.tiempo LIKE '2')";
		$ejecuta=mysql_query($aciertos);
		$fila=mysql_fetch_array($ejecuta);
		$aciertos=$fila["ERRORES"];
		mysql_close();
		return $aciertos;
	}
	
	function calculaPuntaje(){
		include("../script/php/conexion.php");	
			$etapa=$this->buscaEtapa();
		mysql_close();	
		$total=$this->calculaAciertos()*$etapa;
		return $total;
	}
}

?>