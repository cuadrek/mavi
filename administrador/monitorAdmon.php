<?
	session_start();

	include("../script/php/settings.php");

	//ESPECIFICAMOS EL TIPO DE MODULO, Y EL TIPO DE USUARIOS QUE ACEPTARA
	$ACCESO="Administrador";
	$item_seleccionado="MARATON";

	//RECIBIMOS LA VARIABLE PRINCIPAL DEL id_usuario
	$id_usuario=$_SESSION["id_usuario"];

	//COMPROBAMOS SI ESTA LOGEADO Y SI TIENE LOS PERMISOS NECESARIOS
	echo (validarSession($_SESSION["nivel"],$ACCESO)?"":"<script>alert('Usted no cuenta con los permisos necesarios.'); window.location.href='../script/php/salir.php'</script>");

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
	<link href="../css/competidor_maraton.css" rel="stylesheet" type="text/css" />

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
		            <? include("menu_admin.php"); ?>
	        	</ul>
	    	</div>
	    </div>

    	<div id="contenCenter">
		    <div id="panelPrincipal">
		    <? /***************** CONTENIDO *******************/ ?>
		    <input type="hidden" name="fr_id_admon" id="fr_id_admon" value="<?=$id_usuario?>"/>
		    <input type="hidden" name="fr_id_maraton" id="fr_id_maraton" value="0"/>
		    <input type="hidden" name="fr_cuestionario_pregunta" id="fr_cuestionario_pregunta" value="0"/>
		    <input type="hidden" name="fr_preguntando" id="fr_preguntando" value="0"/>
			<div id="competencia_principal">
		      <div id="competencia_menu">
		    	  <? include("submenu_admon.php"); ?>
		   	  </div>
		      <div id="reloj"></div>
		        <div id="competencia_centro">
		        	<? /***************** CONTENIDO DEFAULT ***************/ ?>
		            <span id="default">
		            <p>Seleccione un maraton de la siguiente lista, despues elija la etapa con la que se desea sincronizar y posteriormente haga clic en el boton sincronizar.</p><p>
		            <select name="maratones_sl" id="maratones_sl"><option value="0">&lt; seleccione &gt;</option>
		           		<?
						include("../script/php/conexion.php");
						$conMaratones="SELECT*FROM maraton";
						$ejMaratones=mysql_query($conMaratones);
						while($maratones=mysql_fetch_array($ejMaratones))
						{
							?>
							<option value="<?=$maratones["id"]?>"><?=utf8_encode($maratones["nombre_tema"])?></option>
							<?
						}
						mysql_close();
						?>
		            </select>
		            &nbsp;
		            <select name="etapas_sl" id="etapas_sl">
		            	<option value="0">&lt; seleccione &gt;</option>
		                <?
						include("../script/php/conexion.php");
						$conEtapas="SELECT*FROM etapa";
						$ejEtapas=mysql_query($conEtapas);
						while($etapas=mysql_fetch_array($ejEtapas))
						{
							?>
							<option value="<?=$etapas["id"]?>"><?=$etapas["nombre"]?></option>
							<?
						}
						mysql_close();
						?>
		            </select>
		            </p>
		            <p>
		        <a href="#" class="button" id="btMaraton" name="btMaraton"><span>Sincronizar</span></a>
		        </p>
		            </span>
		            <? /************* TERMINA CONTENIDO DEFAULT *************/?>
		        	<p><span id="pregunta"></span></p>
		            <h1 class="barrah1">&nbsp;</h1>
		            <p><span id="opcionA"></span></p>
		            <p><span id="opcionB"></span></p>
		            <p><span id="opcionC"></span></p>
		            <p><span id="opcionD"></span></p>
		      </div>
		     </div>
		     <div id="competencia_lateral">
		     	<div id="marco" class="lineaLateral">
		        	<ol>
						<li>N&uacute;m. pregunta: <span id="etNumeroPregunta" class="indicador">&nbsp;</span>
					  		<input type="hidden" name="fr_no_pregunta" id="fr_no_pregunta" value=""/>
		                </li>
		          		<li>Tipo: <span id="etTipo" class="indicador">&nbsp;</span>
		            		<input type="hidden" name="fr_tipo" id="fr_tipo" value=""/>
		                </li>
		                <li>Tiempo: <span id="etTiempo" class="indicador">&nbsp;</span>
		            		<input type="hidden" name="fr_tiempo" id="fr_tiempo" value=""/>
		                </li>
		         	</ol>

		        <div id="separador">&nbsp;</div>
		        	<ol>
						<li>Etapa: <span id="etEtapa" class="indicador">&nbsp;</span>
		                  <input type="hidden" name="fr_etapa" id="fr_etapa" value=""/>
						</li>
						<li>Total de Preguntas: <span id="etTotal" class="indicador">&nbsp;</span>
						  <input type="hidden" name="fr_total" id="fr_total" value=""/>
					  </li>
		         	</ol>
					
				<div id="separador">&nbsp;</div>
				
					<div id="fin_cuestionario" style="display:none;">
						<b>Etapa Finalizada</b>
					</div>
		     </div>
		     </div>
		     <div id="competencia_fondo">&nbsp;</div>
		     <? /***************** TERMINA CONTENIDO *******************/ ?>
		     </div><!-- TERMINA DIV panelPrincipal -->
		</div>
	</div>
	<script language="javascript" type="text/javascript" src="../script/js/ajaxScript.js"></script>
	<script language="javascript" type="text/javascript" src="monitorAdmon.js"></script>
</body>
</html>