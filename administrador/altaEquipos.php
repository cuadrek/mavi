<?	session_start();

	include("../script/php/settings.php");

	//ESPECIFICAMOS EL TIPO DE MODULO, Y EL TIPO DE USUARIOS QUE ACEPTARA
	$ACCESO="Administrador";
	$item_seleccionado="CATALOGOS";
	$item_subSeleccionado="EQUIPOS";

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
    <div id="panelCatalogos" style="height:450px;">
    <? /***************** CONTENIDO *******************/ ?>
    <input type="hidden" name="fr_id_admon" id="fr_id_admon" value="<?=$id_usuario?>"/>
    <input type="hidden" name="fr_id_maraton" id="fr_id_maraton" value="0"/>
    <input type="hidden" name="fr_cuestionario_pregunta" id="fr_cuestionario_pregunta" value="0"/>
    <input type="hidden" name="fr_preguntando" id="fr_preguntando" value="0"/>
	<div id="competencia_catalogo">
      <div id="competencia_menu">
   	    <? include("subCatalogoAdmon.php"); ?>
   	  </div>
        <div id="competencia_centro">
        	<? /***************** CONTENIDO ***************/ ?>
            <span id="default">     
                        <form id="primerForm" name="primerForm" method="post" action="altaEquipos.php">
                        <input name="Accion" type="hidden" value="" id="Accion" />
                        <input name="idEquipo" type="hidden" value="" id="idEquipo" />

                        <p>Dar de alta equipos</p>
                        <div id="capaReactivos" style="position:absolute; left: 695px; top: 226px; width:380px; overflow:scroll;" >
            <select name="idMaraton" size="15" id="idMaraton" style="width:300px">
            <?
			include("../script/php/conexion.php");
$consultaReactivo="SELECT 	* FROM 	usuario where cat_privilegios_id = '4' ";
$consultaReactivoEJ=mysql_query($consultaReactivo);
				while($maratonesA=mysql_fetch_array($consultaReactivoEJ))
				{
				
				if($maratonesA["id"]==$idMaraton)
				{
					?>
					<option value="<?=$maratonesA["id"]?>" selected="selected"><?=utf8_encode($maratonesA["nombre"])?></option>
					<?
					}
					else
					{
					?>
					<option value="<?=$maratonesA["id"]?>"><?=utf8_encode($maratonesA["nombre"])?></option>
					<?
					}
					
				}
				mysql_close();
            ?>
            </select>
            
            </div>
            <p>
           Número de equipos:
            &nbsp;
            <label>
            <input name="numero" type="text" id="numero" size="20"  />
            </label>
            </p>
            
            
            <p><a href="#" class="button" id="btGenerarEquipos" name="btGenerarEquipos"><span>Generar</span></a></p>
            <p>&nbsp;</p>        
            </p>
      

            </form>
            </span>
            
    
            <table width="35%" border="0">
  <tr>
    <td>Equipo</td>
    <td>Etapa</td>
    <td>&nbsp;</td>
  </tr>
   <?
   include("../script/php/conexion.php");
	 $consultaEquipos="SELECT usuario_id AS usuario,etapa_id AS etapa FROM competencia,cuestionario_pregunta WHERE cuestionario_pregunta_id = cuestionario_pregunta.id";
	 $mapaEquipos=mysql_query($consultaEquipos);
	 while($equiposAID=mysql_fetch_array($mapaEquipos))
	 {
     $usuario=$equiposAID["usuario"];	
	 $etapa=$equiposAID["etapa"];			
	 
	 $consultarNombre="SELECT nombre FROM usuario WHERE id = '$usuario'";
	 $consultaNombreEjecuta=mysql_query($consultarNombre);
     $nombreAID=mysql_fetch_array($consultaNombreEjecuta);
	 
	 $nombre=$nombreAID["nombre"];	
	 
     ?>   
  <tr>
    <td><? echo $nombre ?></td>
    <td><? echo $etapa ?></td>
    <td><input type="button" name="Button" value="Eliminar" onclick="sacarEquipo('<? echo $usuario?>')" /></td>
  </tr>
  <?
  }
  	mysql_close();
  ?>
</table>
<table width="35%" border="0">
  <tr>
    <td>Equipos en línea</td>
    <td>&nbsp;</td>
  </tr>
   <?
   include("../script/php/conexion.php");
	 $consultaEquiposO="SELECT nombre FROM usuario WHERE id != '$id_usuario' AND online='1'";
	 $mapaEquiposO=mysql_query($consultaEquiposO);
	 while($equiposAIDO=mysql_fetch_array($mapaEquiposO))
	 {
	 $nombre=$equiposAIDO["nombre"];
	 
     ?>
  <tr>
    <td><? echo $nombre ?></td>
    <td><input type="button" name="Button" value="Eliminar" onclick="sacarEquipo('<? echo $usuario?>')" /></td>
  </tr>
  <?
  }
  	mysql_close();
  ?>
</table>


            <? /************* TERMINA CONTENIDO DEFAULT *************/?>
      </div>
     </div>
     <div id="competencia_fondo" style="height:296px">&nbsp;</div>
     <? /***************** TERMINA CONTENIDO *******************/ ?>
     </div><!-- TERMINA DIV panelPrincipal -->
</div>
<script type="text/javascript" src="../script/js/ajaxScript.js"></script>
<script src="monitorAdmon.js"></script>
<?
if($Accion =="guardaEquipos")
{
include("../script/php/conexion.php");
foreach($_POST as $nombre_campo => $valor)
{
$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
eval(utf8_decode($asignacion));
}

$eliminaEquipos=mysql_query("DELETE FROM usuario  where cat_privilegios_id = '4'");


for ($i = 1; $i <= $numero ; $i++) 
{
    echo $i;
	$usuarioContrasenia="equipo".$i;
	$guardaReactivo="INSERT INTO usuario (cat_privilegios_id, nombre, contrasenia, online)VALUES('4','$usuarioContrasenia','$usuarioContrasenia','0')";
	$guardaReactivoEjecuta=mysql_query($guardaReactivo);
	
}


?>
<script languaje="javascript">
mensajeGuarda('altaEquipos.php');

</script> 
<?
	mysql_close();
}
?>
<?
if($Accion =="quitarEquipo")
{
include("../script/php/conexion.php");
foreach($_POST as $nombre_campo => $valor)
{
$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
eval(utf8_decode($asignacion));
}

$eliminaEquipo=mysql_query("DELETE FROM competencia where usuario_id = '$idEquipo'");




?>
<script languaje="javascript">
mensajeGuarda('altaEquipos.php');

</script> 
<?
	mysql_close();
}
?>


</body>
</html>

