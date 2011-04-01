<?	session_start();

	include("../script/php/settings.php");

	//ESPECIFICAMOS EL TIPO DE MODULO, Y EL TIPO DE USUARIOS QUE ACEPTARA
	$ACCESO="Administrador";
	$item_seleccionado="CATALOGOS";
	$item_subSeleccionado="ETAPA";

	//RECIBIMOS LA VARIABLE PRINCIPAL DEL id_usuario
	$id_usuario=$_SESSION["id_usuario"];
	
	//COMPROBAMOS SI ESTA LOGEADO Y SI TIENE LOS PERMISOS NECESARIOS
	echo (validarSession($_SESSION["nivel"],$ACCESO)?"":"<script>alert('Usted no cuenta con los permisos necesarios.'); window.location.href='../script/php/salir.php'</script>");
	
				if($Accion =="buscarEtapa")
			{
			foreach($_POST as $nombre_campo => $valor)
			{
			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
			eval(utf8_decode($asignacion));
			}
			include("../script/php/conexion.php");
			$consultaReactivoID="SELECT * FROM etapa where id like '$idEtapa'";
			$consultaReactivoEJID=mysql_query($consultaReactivoID);
			$maratonesAID=mysql_fetch_array($consultaReactivoEJID);
			$nombreC=$maratonesAID["nombre"];			
			mysql_close();
			}
				if($Accion =="eliminaEtapa")
			{
			foreach($_POST as $nombre_campo => $valor)
			{
			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
			eval(utf8_decode($asignacion));
			}
			include("../script/php/conexion.php");
			$consultaReactivoID="DELETE FROM etapa WHERE id = '$idEtapa' ;";
			$consultaReactivoEJID=mysql_query($consultaReactivoID);
			
			mysql_close();
			}


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
	<div id="competencia_catalogo">
      <div id="competencia_menu">
   	    <? include("subCatalogoAdmon.php"); ?>
   	  </div>
        <div id="competencia_centro">
        	<? /***************** CONTENIDO ***************/ ?>
            <span id="default">     
                        <form id="primerForm" name="primerForm" method="post" action="altaEtapa.php">
                        <input name="Accion" type="hidden" value="" id="Accion" />

                        <p>Dar de alta etapa</p>
                        <div id="capaReactivos" style="position:absolute; left: 695px; top: 226px; width:380px; overflow:scroll;" >
            <select name="idEtapa" size="15" id="idEtapa" onClick="buscarEtapa();" style="width:380px">
            <?
			include("../script/php/conexion.php");
$consultaReactivo="SELECT * FROM etapa ";
$consultaReactivoEJ=mysql_query($consultaReactivo);
				while($maratonesA=mysql_fetch_array($consultaReactivoEJ))
				{
				
				if($maratonesA["id"]==$idEtapa)
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
             <a href="#" class="button" id="bteliminaEtapa" name="bteliminaEtapa"><span>Eliminar</span></a> 
            </div>
            <p>
           Nombre:
            &nbsp;
            <label>
            <input name="nombreEtapa" type="text" id="nombreEtapa" size="50" value="<? echo utf8_encode($nombreC) ?>" />
            </label>
            </p>
            <?
       	if($Accion =="buscarEtapa")
			{ ?>
            
        <a href="#" class="button" id="btmodificaEtapa" name="btmodificaEtapa"><span>Modificar</span></a>        </p>
        <?
        }
        else
		{
		?>
        <a href="#" class="button" id="btguardaEtapa" name="btguardaEtapa"><span>Guardar</span></a>    
          <?
          }
		  
     ?>
              <a href="altaEtapa.php" class="button" id="btnuevoReactivo" name="btnuevoReactivo"><span>Nuevo</span></a>        </p>

</form>
            </span>

            <? /************* TERMINA CONTENIDO DEFAULT *************/?>
      </div>
     </div>
     <div id="competencia_fondo" style="height:296px">&nbsp;</div>
     <? /***************** TERMINA CONTENIDO *******************/ ?>
     </div><!-- TERMINA DIV panelPrincipal -->
</div>
<script type="text/javascript" src="../script/js/ajaxScript.js"></script>
<script src="monitorAdmon.js"></script>
</body>
<?
if($Accion =="guardaEtapa")
{
include("../script/php/conexion.php");
foreach($_POST as $nombre_campo => $valor)
{
$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
eval(utf8_decode($asignacion));
}
$guardaReactivo="INSERT INTO etapa(nombre)VALUES('$nombreEtapa')";
$guardaReactivoEjecuta=mysql_query($guardaReactivo);

?>
<script languaje="javascript">
mensajeGuarda('altaEtapa.php');

</script> 
<?
	mysql_close();
}
?>
<?
if($Accion =="modificaEtapa")
{
include("../script/php/conexion.php");
foreach($_POST as $nombre_campo => $valor)
{
$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
eval(utf8_decode($asignacion));
}
echo $modificaReactivo="UPDATE etapa SET	nombre = '$nombreEtapa' WHERE	id = '$idEtapa'";
$modificaReactivoEjecuta=mysql_query($modificaReactivo);

?>
<script languaje="javascript">
mensajeModifica('altaEtapa.php');

</script> 
<?
	mysql_close();
}
?>

</html>

