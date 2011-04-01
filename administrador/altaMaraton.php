<?	session_start();

	include("../script/php/settings.php");

	//ESPECIFICAMOS EL TIPO DE MODULO, Y EL TIPO DE USUARIOS QUE ACEPTARA
	$ACCESO="Administrador";
	$item_seleccionado="CATALOGOS";
	$item_subSeleccionado="MARATON";

	//RECIBIMOS LA VARIABLE PRINCIPAL DEL id_usuario
	$id_usuario=$_SESSION["id_usuario"];
	
	//COMPROBAMOS SI ESTA LOGEADO Y SI TIENE LOS PERMISOS NECESARIOS
	echo (validarSession($_SESSION["nivel"],$ACCESO)?"":"<script>alert('Usted no cuenta con los permisos necesarios.'); window.location.href='../script/php/salir.php'</script>");
	
				if($Accion =="buscarMaraton")
			{
			foreach($_POST as $nombre_campo => $valor)
			{
			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
			eval(utf8_decode($asignacion));
			}
			include("../script/php/conexion.php");
			$consultaReactivoID="SELECT id, cat_universidad_id, cat_regiones_id, nombre_tema, fecha_creacion, fecha_aplicacion FROM maraton where id like '$idMaraton'";
			$consultaReactivoEJID=mysql_query($consultaReactivoID);
			$maratonesAID=mysql_fetch_array($consultaReactivoEJID);
			$nombreC=$maratonesAID["nombre_tema"];			
			mysql_close();
			}
				if($Accion =="eliminaMaraton")
			{
			foreach($_POST as $nombre_campo => $valor)
			{
			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
			eval(utf8_decode($asignacion));
			}
			include("../script/php/conexion.php");
			$consultaReactivoID="DELETE FROM maraton WHERE id = '$idMaraton' ;";
			$consultaReactivoEJID=mysql_query($consultaReactivoID);
			
			mysql_close();
			}
			if($Accion =="restauraMaraton")
			{
			foreach($_POST as $nombre_campo => $valor)
			{
			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
			eval(utf8_decode($asignacion));
			}
			include("../script/php/conexion.php");
			$elimnaC="TRUNCATE TABLE competencia";
			$consultaEliminaC=mysql_query($elimnaC);
			$elimnaA="TRUNCATE TABLE maraton_activo";
			$consultaEliminaA=mysql_query($elimnaA);
			//$elimnaR="TRUNCATE TABLE respuesta";
			//$consultaEliminaR=mysql_query($elimnaR);
			
			mysql_close();
			}
			if($Accion =="restauraMaratonCompleto")
			{
			foreach($_POST as $nombre_campo => $valor)
			{
			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
			eval(utf8_decode($asignacion));
			}
			include("../script/php/conexion.php");
			$elimnaC="TRUNCATE TABLE competencia";
			$consultaEliminaC=mysql_query($elimnaC);
			$elimnaA="TRUNCATE TABLE maraton_activo";
			$consultaEliminaA=mysql_query($elimnaA);
			$elimnaR="TRUNCATE TABLE respuesta";
			$consultaEliminaR=mysql_query($elimnaR);
			$elimnaP="TRUNCATE TABLE preguntas";
			$consultaEliminaP=mysql_query($elimnaP);
			$elimnaCP="TRUNCATE TABLE cuestionario_pregunta";
			$consultaEliminaCP=mysql_query($elimnaCP);
			$elimnaM="TRUNCATE TABLE maraton";
			$consultaEliminaM=mysql_query($elimnaM);
			$elimnaCP="DELETE FROM usuario where cat_privilegios_id = '4'";
			$consultaEliminaCP=mysql_query($elimnaCP);

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
                        <form id="primerForm" name="primerForm" method="post" action="altaMaraton.php">
                        <input name="Accion" type="hidden" value="" id="Accion" />

                        <p>Dar de alta maratón</p>
                        <div id="capaReactivos" style="position:absolute; left: 695px; top: 226px; width:380px; overflow:scroll;" >
            <select name="idMaraton" size="15" id="idMaraton" onClick="buscarMaraton();" style="width:380px">
            <?
			include("../script/php/conexion.php");
$consultaReactivo="SELECT 	id, cat_universidad_id, cat_regiones_id, nombre_tema, fecha_creacion, fecha_aplicacion 	FROM 	maraton ";
$consultaReactivoEJ=mysql_query($consultaReactivo);
				while($maratonesA=mysql_fetch_array($consultaReactivoEJ))
				{
				
				if($maratonesA["id"]==$idMaraton)
				{
					?>
					<option value="<?=$maratonesA["id"]?>" selected="selected"><?=utf8_encode($maratonesA["nombre_tema"])?></option>
					<?
					}
					else
					{
					?>
					<option value="<?=$maratonesA["id"]?>"><?=utf8_encode($maratonesA["nombre_tema"])?></option>
					<?
					}
					
				}
				mysql_close();
            ?>
            </select>
             <a href="#" class="button" id="bteliminaMaraton" name="bteliminaMaraton"><span>Eliminar</span></a> 
             <a href="#" class="button" id="btrestauraMaraton" name="btrestauraMaraton"><span>Restaurar</span></a> 
            </div>
            <p>
           Nombre:
            &nbsp;
            <label>
            <input name="nombreMaraton" type="text" id="nombreMaraton" size="50" value="<? echo utf8_encode($nombreC) ?>" />
            </label>
            </p>
            <?
       	if($Accion =="buscarMaraton")
			{ ?>
            
        <a href="#" class="button" id="btmodificaMaraton" name="btmodificaMaraton"><span>Modificar</span></a>        </p>
        <?
        }
        else
		{
		?>
        <a href="#" class="button" id="btguardaMaraton" name="btguardaMaraton"><span>Guardar</span></a>    
          <?
          }
		  
     ?>
              <a href="altaMaraton.php" class="button" id="btnuevoReactivo" name="btnuevoReactivo"><span>Nuevo</span></a>        </p>
             <a href="#" class="button" id="btrestauraMaratonCompleto" name="btrestauraMaratonCompleto"><span>Restaurar por completo</span></a> 
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
<?
if($Accion =="guardaMaraton")
{
include("../script/php/conexion.php");
foreach($_POST as $nombre_campo => $valor)
{
$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
eval(utf8_decode($asignacion));
}
$guardaReactivo="
INSERT INTO maraton 
	(cat_universidad_id, 
	cat_regiones_id, 
	nombre_tema, 
	fecha_creacion, 
	fecha_aplicacion
	)
	VALUES
	('1', 
	'1', 
	'$nombreMaraton', 
	'2010', 
	'2010'
	);
";
$guardaReactivoEjecuta=mysql_query($guardaReactivo);

?>
<script languaje="javascript">
mensajeGuarda('altaMaraton.php');

</script> 
<?
	mysql_close();
}
?>
<?
if($Accion =="modificaMaraton")
{
include("../script/php/conexion.php");
foreach($_POST as $nombre_campo => $valor)
{
$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
eval(utf8_decode($asignacion));
}
echo $modificaReactivo="UPDATE maraton SET	nombre_tema = '$nombreMaraton' WHERE	id = '$idMaraton'";
$modificaReactivoEjecuta=mysql_query($modificaReactivo);

?>
<script languaje="javascript">
mensajeModifica('altaMaraton.php');

</script> 
<?
	mysql_close();
}
?>
</body>
</html>

