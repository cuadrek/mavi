<?
	session_start();

	include("script/php/settings.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>MAVI</title>
	<link rel="shortcut icon" href="imagenes/favicon.ico" />
	<link href="css/default.css" rel="stylesheet" type="text/css" />
	<link href="css/login.css" rel="stylesheet" type="text/css" />
	<link href="css/contenido.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />

	<script language="javascript" type="text/javascript" src="script/js/jquery-1.3.2.produccion.js"></script>
	<script language="javascript" type="text/javascript" src="script/js/tinybox.js"></script>
</head>

<body>
	<div id="contenedor_absoluto">

		<div id="mcContenTop">
	    	<div id="contenTop1">
	    		<img src="imagenes/maviLogo.png" alt="Logo" />
	    	</div>
	    </div>

	    <div id="barra_principal">
	    	<div id="contenTop2">
	    		<ul class="principal">
		            <? include("menu_default.php"); ?>
	        	</ul>
	    	</div>
	    </div>

		<div id="contenCenter">
		    <div id="centrar">
		    <form id="Datos" name="Datos" action="script/php/autenticar.php" method="post">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0">
		        <tr>
		          <td width="34%">
		          <table width="231" border="0" align="right" cellpadding="0" cellspacing="0" class="login">
		            <tr>
		              <td width="75">Usuario</td>
		              <td width="156"><label>
		                <input name="txtUsuario" type="text" id="txtUsuario" maxlength="12" />
		              </label></td>
		            </tr>
		            <tr>
		              <td>Contrase&ntilde;a</td>
		              <td><input name="txtContrasenia" type="password" id="txtContrasenia" maxlength="12" /></td>
		            </tr>
		            <tr>
		              <td>&nbsp;</td>
		              <td>
		                <button type="button" name="btEntrar" id="btEntrar">Entrar</button>
		                </td>
		            </tr>
		            <tr>
		              <td colspan="2">
		                </td>
		            </tr>
		          </table>
		          </td>
		          <td width="66%">
		          <div id="contenidoLogin">
		          	<h1 class="barrah1">Bienvenido</h1>
		            <p>Bienvenido al Maratón Virtual (MAVI) de la Facultad de Contaduría y Administración de la Universidad Veracruzana en conjunto con la Asociación Nacional de Facultades  de Contaduría y Administración (ANFECA).</p>
		            <p>Ten en cuenta que si eres competidor, debes poner correctamente tu número de equipo y tu contraseña.</p>
		            <p>Recuerda poner correctamente Mayúsculas y minúsculas</p>
		          </div>
		          </td>
		        </tr>
		      </table>
		    </form>
		    </div>
		    <div id="nota">
		    	<h1 class="barrah1">&nbsp;</h1>
				<p><strong>Nota:</strong> Para obtener el máximo rendimiento de este sitio, sugerimos utilizar Firefox (versión 3 ó superior). Y en una resolución de 1280 x 768 o superior</p>
			</div>
		</div>
	</div>
	<script language="javascript" type="text/javascript" src="login.js"></script>
</body>
</html>