<?

class Administrador{
	private $idAdministrador;
	private $permiso;
	function __construct($ID_ADMINISTRADOR){
		$this->setIdAdministrador($ID_ADMINISTRADOR);
	}
	function iniciarMaraton(Maraton $maratonActual){
		if(!$this->verificarMaraton($maratonActual))
		{
			include("../script/php/conexion.php");
			$sentencia="INSERT INTO maraton_activo(cuestionario_pregunta_id, activo,usuario_id) VALUES('".$maratonActual->getCuestionarioPreguntaId()."','0','".$this->getIdAdministrador()."')";
			if(mysql_query($sentencia)){
				$maratonActual->setEstado("nuevo");	
			}
			else{
				$maratonActual->setEstado("no");	
			}
			mysql_close();
		}
		else{
			$maratonActual->setEstado("empezado");	
		}
	}
	
	function verificarMaraton(Maraton $maratonActual)
	{
		include("../script/php/conexion.php");
		$busca="SELECT maraton_activo.activo FROM maraton_activo, cuestionario_pregunta WHERE cuestionario_pregunta.maraton_id LIKE '".$maratonActual->getIdMaraton()."' AND maraton_activo.cuestionario_pregunta_id LIKE cuestionario_pregunta.id AND maraton_activo.usuario_id LIKE '".$this->getIdAdministrador()."'";
		$resultado=mysql_query($busca);
		if(mysql_num_rows($resultado)>0){
			return true;	
		}
		else{
			return false;	
		}
		mysql_close();
	}
	
	function permitirResponder(Maraton $maratonActual){
		include("../script/php/conexion.php");
		$permitir="UPDATE maraton_activo SET activo=1 WHERE cuestionario_pregunta_id LIKE '".$maratonActual->getCuestionarioPreguntaId()."' LIMIT 1";
		$resultado=mysql_query($permitir);
		mysql_close();
	}
	
	function desactivaPermiso(Maraton $maratonActual){
		include("../script/php/conexion.php");
		$permitir="UPDATE maraton_activo SET activo=2 WHERE cuestionario_pregunta_id LIKE '".$maratonActual->getCuestionarioPreguntaId()."'";
		$resultado=mysql_query($permitir);
		mysql_close();
	}
	
	function setIdAdministrador($ID_ADMINISTRADOR){
		$this->idAdministrador=$ID_ADMINISTRADOR;	
	}
	
	function getIdAdministrador(){
		return $this->idAdministrador;	
	}
	
	function equiposRegistrados(Maraton $maratonAtual,$CUESTIONARIO){
		include("../script/php/conexion.php");
		$busca="SELECT COUNT(*) AS TOTAL FROM competencia WHERE cuestionario_pregunta_id LIKE '".$maratonAtual->getCuestionarioPreguntaId()."' OR cuestionario_pregunta_id LIKE '".$CUESTIONARIO."'";	
		$ejecuta=mysql_query($busca);
		$resultado=mysql_fetch_array($ejecuta);
		$total=$resultado["TOTAL"];
		mysql_close();
		return $total;
	}
	
	function cuentaEquipos($ID_CUESTIONARIO){
		include("../script/php/conexion.php");
		$busca="SELECT COUNT(respuesta.usuario_id) AS TOTAL FROM cuestionario_pregunta INNER JOIN maraton ON (cuestionario_pregunta.maraton_id = maraton.id) INNER JOIN respuesta ON (respuesta.cuestionario_pregunta_id = cuestionario_pregunta.id) WHERE cuestionario_pregunta.id LIKE '".$ID_CUESTIONARIO."';";	
		$ejecuta=mysql_query($busca);
		$resultado=mysql_fetch_array($ejecuta);
		$total=$resultado["TOTAL"];
		mysql_close();
		return $total;
	}
	
	function verificaEquipo($ID_CUESTIONARIO,$indice){
		include("../script/php/conexion.php");
		$busca="SELECT respuesta.usuario_id AS USUARIO FROM cuestionario_pregunta INNER JOIN maraton ON (cuestionario_pregunta.maraton_id = maraton.id) INNER JOIN respuesta ON (respuesta.cuestionario_pregunta_id = cuestionario_pregunta.id) WHERE cuestionario_pregunta.id LIKE '".$ID_CUESTIONARIO."' LIMIT ".$indice.", 1;";	
		$ejecuta=mysql_query($busca);
		$resultado=mysql_fetch_array($ejecuta);
		$usuario=$resultado["USUARIO"];
		mysql_close();
		return $usuario;
	}
	
	function siguientePregunta(Maraton $maratonActual){
		include("../script/php/conexion.php");
		$permitir="UPDATE maraton_activo SET cuestionario_pregunta_id='".$maratonActual->getCuestionarioPreguntaId()."', activo=0 WHERE usuario_id LIKE '".$this->getIdAdministrador()."'";
		mysql_query($permitir);
		mysql_close();
	}
	
	function permisoSiguiente(Maraton $maratonActual){
		include("../script/php/conexion.php");
		$permitir="SELECT activo FROM maraton_activo WHERE cuestionario_pregunta_id LIKE '".$maratonActual->getCuestionarioPreguntaId()."' AND usuario_id LIKE '".$this->getIdAdministrador()."' LIMIT 1";
		$ejecuta=mysql_query($permitir);
		$fila=mysql_fetch_array($ejecuta);
		$respuesta=$fila["activo"];
		mysql_close();	
		return $respuesta;
	}
}
?>