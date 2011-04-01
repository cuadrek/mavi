<?
	session_start();
	
	include("../script/php/settings.php");
	include("../script/php/conexion.php");	
	//LA VARIABLE ACCESO NOS INDICAR EL TIPO DE USUARIO QUE PUEDE VISUALIZAR LA INTERFAZ
	$ACCESO="Competidor";
	//LA VARIABLE item_seleccionado NOS INDICA QUE PARTE DEL MENU PRINCIPAL ESTA SELECCIONADA PARA INDICARLA MEDIANTE UNA PROPIEDAD CSS
	$item_seleccionado="INICIO";
	
	//RECIBIMOS LA VARIABLE PRINCIPAL DEL id_usuario
	$id_usuario=$_SESSION["id_usuario"];
	
	//COMPROBAMOS SI ESTA LOGEADO Y SI TIENE LOS PERMISOS NECESARIOS
	echo (validarSession($_SESSION["nivel"],$ACCESO)?"":"<script>alert('Usted no cuenta con los permisos necesarios.'); window.location.href='../script/php/salir.php'</script>");
	
	$registroMonitorUsuario="UPDATE usuario SET online='1' WHERE id = '$id_usuario'";
	$ejecutaRMU=mysql_query($registroMonitorUsuario);
	
	mysql_close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>MAVI</title>
	<link rel="shortcut icon" href="../imagenes/favicon.ico" />
	<link href="../css/default.css" rel="stylesheet" type="text/css" />
	<link href="../css/login.css" rel="stylesheet" type="text/css" />
	<link href="../css/contenido.css" rel="stylesheet" type="text/css" />
	<link href="../css/style.css" rel="stylesheet" type="text/css" />

	<script language="javascript" type="text/javascript" src="../script/js/jquery-1.3.2.produccion.js"></script>
	<script language="javascript" type="text/javascript" src="../script/js/tinybox.js"></script>
</head>

<body>
	<div id="contenedor_absoluto">

		<div id="mcContenTop">
	    	<div id="contenTop1">
	    		<img src="../imagenes/maviLogo.png" alt="Logo" />
	    	</div>
	    </div>

	    <div id="barra_principal">
	    	<div id="contenTop2">
	    		<ul class="principal">
		            <? include("menu_competidor.php"); ?>
	        	</ul>
	    	</div>
	    </div>

		<div id="contenCenter">
			<div id="panelPrincipal">
			<div id="marco">
				<h1 class="barrah1">Bienvenido</h1>
				<p>Usted acaba de entrar al m&oacute;dulo de Competidor, el principal para poder participar en un Marat&oacute;n Virtual.</p>
				<p>Buena Suerte!</p>
			</div>
		  </div>
		</div>
		
	</div>
</body>
</html>