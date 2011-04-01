<?
	session_start();
	
	include("../script/php/settings.php");
	
	//ESPECIFICAMOS EL TIPO DE MODULO, Y EL TIPO DE USUARIOS QUE ACEPTARA
	$ACCESO="Coordinador";
	$item_seleccionado="IMPORTAR";
	
	//RECIVIMOS LA VARIABLE PRINCIPAL DEL id_usuario
	$id_usuario= $_SESSION["id_usuario"];
	$ArchivoOriginal = $_POST[ArchivoOriginal];
	$Archivo = $_FILES[Archivo][name];
	$ArchivoTemporal = $_FILES[Archivo][tmp_name];
	
	//COMPROBAMOS SI ESTA LOGEADO Y SI TIENE LOS PERMISOS NECESARIOS
	echo (validarSession($_SESSION["nivel"],$ACCESO)?"":"<script>alert('Usted no cuenta con los permisos necesarios.'); window.location.href='../script/php/salir.php'; </script>"); 
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
			<h2 class="barra">Importar Excel al Cat&aacute;logo de Reactivos.</h2>
			<p>S&iacute; usted desea importar un archivo con formato .xls (Excel), primero debe sersiorarce de:</p>
			<ol>
			<li>Los archivos NO deben contener ningun tipo de filtros, macros y/o algun otra funci&oacute;n especial de Excel.</li>
			<li>Deber&aacute;n respetar el formato establecido por ANFECA.</li>
			</ol>
			<p>Al final del proceso, deber&aacute; serciorarse de que la informaci&oacute;n sea consistente con el archivo orginal en excel.</p>
			<br/>
			<h3 class="barra">Procedimiento</h3>
			<p>Primero deber&aacute; seleccionar el archivo (Archivo en Excel con extenxi&oacute;n xls) y posteriormente hacer cl&iacute;c en el boton importar.</p>
			<form id="Datos" name="Datos" action="importar_archivo.php" method="post" enctype="multipart/form-data">
			<p>
			<label>Especifique la hoja en la que se encuentran los reactivos.</label>
			<label>
			  <input name="hoja" type="text" id="hoja" value="1" size="4" maxlength="3" />
			</label>
			</p>
			<input class="miButton" type="file" name="Archivo" id="Archivo" lang="es" />
			<input type="hidden" id="ArchivoOriginal" name="ArchivoOriginal" value="<? echo $ArchivoOriginal; ?>">
			</form>
			<br/>
			<br/>
			<a href="#" class="button" name="btImportar" id="btImportar"><span>Importar</span></a>
			<br/>
			<br/>
			<br/>
			</div>
		  </div>
		</div>
	</div>
	<script language="javascript" type="text/javascript" src="importar.js"></script>
</body>
</html>