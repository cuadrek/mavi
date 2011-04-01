<?
	session_start();
	
	include("conexion.php");
	$nickN = $_SESSION["usuario"];
	mysql_query("UPDATE usuario SET online = 0 WHERE nombre = '$nickN'");
	
	session_unset();
	session_destroy();

	header("Location: ../../index.php");
?>