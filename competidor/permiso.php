<?
	require_once("../clases/maraton.php");
	require_once("../clases/competidor.php");
	
	$ID_CUESTIONARIO=$_POST["ID_CUESTIONARIO"];
	$ID_EQUIPO=$_SESSION["id_usuario"];
	
	$miCompetidor=new Competidor($ID_EQUIPO);
	echo $miCompetidor->getPermisoResponder($ID_CUESTIONARIO);
?>