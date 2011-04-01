<?
	session_start();

	include("../script/php/settings.php");

	//ESPECIFICAMOS EL TIPO DE MODULO, Y EL TIPO DE USUARIOS QUE ACEPTARA
	$ACCESO="Coordinador";
	$item_seleccionado="INICIO";

	//RECIVIMOS LA VARIABLE PRINCIPAL DEL id_usuario
	$id_usuario=$_SESSION["id_usuario"];

	//COMPROBAMOS SI ESTA LOGEADO Y SI TIENE LOS PERMISOS NECESARIOS
	echo (validarSession($_SESSION["nivel"],$ACCESO)?"":"<script>alert('Usted no cuenta con los permisos necesarios.'); window.location.href='../script/php/salir.php';</script>");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>MAVI</title>
	<link rel="shortcut icon" href="imagenes/favicon.ico" />
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
		            <? include("menu_coordinador.php"); ?>
	        	</ul>
	    	</div>
	    </div>

		<div id="contenCenter">
		  <div id="panelPrincipal">
		  	<div id="marco">
		    <h2 class="barra">Modulo Coordinador</h2>
		    <p>Bienvenido al m&oacute;dulo de coordinador, en el cual usted podr&aacute;:</p>
		    <ol>
		    <li>Importar reactivos desde un archivo en excel.</li>
		    <li>Ordenar y preparar un Marat&oacute;n Virtual.</li>
		    <li>Actualizar el Cat&aacute;logo de Reactivos.</li>
		    <li>Generar reportes.</li>
		    <li>En desarrollo...</li>
		    </ol>
		    </div>
		  </div>
		</div>
	</div>
	<script language="javascript" type="text/javascript" src="../script/js/jquery-1.3.2.js"></script>
	<script language="javascript" type="text/javascript">
		$("#prueba").toggle(function(){
			$("#mcContenTop").slideToggle("slow");
			$("#sombra_top").slideToggle("slow");
			$("body").css("background-position","0px 0px");
		},function(){
			$("#mcContenTop").slideToggle("slow");
			$("#sombra_top").slideToggle("slow");
			$("body").css("background-position","0px 58px");
		});
		$("#panelPrincipal_top").click(function(){
			$("#panelPrincipal_top").fadeOut("slow");
		});
	</script>
</body>
</html>