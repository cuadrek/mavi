<?
	include("../script/php/conexion.php");
	$buskEquipos="SELECT*FROM usuario WHERE online LIKE '1'";
	$re_equipos=mysql_query($buskEquipos);
	$resultado="";
	while($fila=mysql_fetch_array($re_equipos))
	{
		$resultado=$resultado."<li>".$fila["nombre"]."</li>";
	}
	echo "<ol>".$resultado."</ol>";
?>