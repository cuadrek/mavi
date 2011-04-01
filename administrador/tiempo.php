<?
$ACCION=$_POST["ACCION"];
$ID_ADMINISTRADOR=$_POST["ID_ADMINISTRADOR"];
$ID_CUESTIONARIO=$_POST["ID_CUESTIONARIO"];
require_once("../clases/maraton.php");
require_once("../clases/administrador.php");

if($ACCION=="INICIARTIEMPO"){
	$miMaraton=new Maraton(false,false,$ID_CUESTIONARIO);
	$miAdmin=new Administrador($ID_ADMINISTRADOR);
	$miAdmin->permitirResponder($miMaraton);
}
if($ACCION=="TERMINATIEMPO"){
	$miMaraton=new Maraton(false,false,$ID_CUESTIONARIO);
	$miAdmin=new Administrador($ID_ADMINISTRADOR);
	$miAdmin->desactivaPermiso($miMaraton);
}
?>