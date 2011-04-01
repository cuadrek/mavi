<?	session_start();

	include("../script/php/settings.php");

	//ESPECIFICAMOS EL TIPO DE MODULO, Y EL TIPO DE USUARIOS QUE ACEPTARA
	$ACCESO="Administrador";
	$item_seleccionado="CATALOGOS";
	$item_subSeleccionado="REACTIVOS";

	//RECIBIMOS LA VARIABLE PRINCIPAL DEL id_usuario
	$id_usuario=$_SESSION["id_usuario"];
	
	//METODOS PARA MODIFICAR LA BASE DE DATOS
	if($Accion =="buscarReactivo")
			{
			foreach($_POST as $nombre_campo => $valor)
			{
			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
			eval($asignacion);
			}
			include("../script/php/conexion.php");
			$consultaReactivoID="SELECT 	id,pregunta,opcion1,opcion2,opcion3,opcion4,respuesta,grado_dificultad,tipo FROM preguntas where id like '$idReactivo'";
			$consultaReactivoEJID=mysql_query($consultaReactivoID);
			$maratonesAID=mysql_fetch_array($consultaReactivoEJID);
			$preguntaC=$maratonesAID["pregunta"];
			$opcion1c=$maratonesAID["opcion1"];
			$opcion2c=$maratonesAID["opcion2"];
			$opcion3c=$maratonesAID["opcion3"];
			$opcion4c=$maratonesAID["opcion4"];
			$respuestaC=$maratonesAID["respuesta"];
			$gradoC=$maratonesAID["grado_dificultad"];
			$tipoC=$maratonesAID["tipo"];
			
			mysql_close();
			}
				if($Accion =="eliminaReactivo")
			{
			foreach($_POST as $nombre_campo => $valor)
			{
			$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
			eval($asignacion);
			}
			include("../script/php/conexion.php");
			$consultaReactivoID="DELETE FROM preguntas WHERE id = '$idReactivo' ;";
			$consultaReactivoEJID=mysql_query($consultaReactivoID);
			
			$borraReactivoCP="DELETE FROM cuestionario_pregunta WHERE preguntas_id = '$idReactivo' ;";
			$consultaborraCP=mysql_query($borraReactivoCP);
			
			mysql_close();
			}
	
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

    <div id="panelCatalogos" style="height:600px;">
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
            <p>Edición de reactivos</p>
            <p>
            <form id="primerForm" name="primerForm" method="post" action="altaReactivos.php">
            <div id="capaReactivos" style="position:absolute; left: 695px; top: 226px; width:380px; overflow:scroll;" >
            <select name="idReactivo" size="15" id="idReactivo" onClick="buscarReactivo();"  style="width:365px">
            <?
			include("../script/php/conexion.php");
$consultaReactivo="SELECT 	id,pregunta,opcion1,opcion2,opcion3,opcion4,respuesta,grado_dificultad,tipo FROM preguntas ";
$consultaReactivoEJ=mysql_query($consultaReactivo);
				while($maratonesA=mysql_fetch_array($consultaReactivoEJ))
				{
				
				if($maratonesA["id"]==$idReactivo)
				{
					?>
					<option value="<?=$maratonesA["id"]?>" selected="selected"><?=utf8_encode($maratonesA["pregunta"])?></option>
					<?
					}
					else
					{
					?>
					<option value="<?=$maratonesA["id"]?>"><?=utf8_encode($maratonesA["pregunta"])?></option>
					<?
					}
					
				}
				mysql_close();
            ?>
            </select>
            <br>
                     <a href="#" class="button" id="bteliminaReactivo" name="bteliminaReactivo"><span>Eliminar</span></a>        </p>

            </div>
            <input name="Accion" type="hidden" value="" id="Accion" />
           Pregunta:
            &nbsp;
            <label>
            <textarea name="pregunta" cols="50" id="pregunta" ><? echo utf8_encode($preguntaC); ?></textarea>
            </label>
            </p>
                     <p>Opción 1:
            &nbsp;
            <label>
            <textarea name="opcion1" cols="50" id="opcion1"><? echo utf8_encode($opcion1c); ?></textarea>
            </label>
            </p>
                     <p>Opción 2:
            &nbsp;
            <label>
            <textarea name="opcion2" cols="50" id="opcion2"><? echo utf8_encode($opcion2c); ?></textarea>
            </label>
            </p>
                     <p>
           Opción 3:
            &nbsp;
            <label>
            <textarea name="opcion3" cols="50" id="opcion3"><? echo utf8_encode($opcion3c); ?></textarea>
            </label>
            </p>
                     <p>Opción 4:
            &nbsp;
            <label>
            <textarea name="opcion4" cols="50" id="opcion4"><? echo utf8_encode($opcion4c); ?></textarea>
            </label>
            </p>
                     <p>
           Respuesta correcta:
            &nbsp;
            <label>
            <select name="respuesta" id="respuesta">
	          <option value="">Seleccione una</option>
              <option value="1" <? if($respuestaC=="1"){?> selected <? }?>>Opción 1</option>
              <option value="2" <? if($respuestaC=="2"){?> selected <? }?>>Opción 2</option>
              <option value="3" <? if($respuestaC=="3"){?> selected <? }?>>Opción 3</option>
              <option value="4" <? if($respuestaC=="4"){?> selected <? }?>>Opción 4</option>
            </select>
            </label>
            </p>
                     <p>
           Tipo de pregunta:
            &nbsp;
            <label>
            <select name="tipo" id="tipo">
            <option value="">Seleccione una</option>
              <option value="1" <? if($tipoC=="1"){?> selected <? }?>>Teorica</option>
              <option value="2" <? if($tipoC=="2"){?> selected <? }?>>Práctica</option>
            </select>
            </label>
            </p>
                <p>Grado de dificultad:
            &nbsp;
            <label>
            <select name="grado" id="grado">
            <option value="">Seleccione una</option>
              <option value="3" <? if($gradoC=="3"){?> selected <? }?>>Facil</option>
              <option value="4" <? if($gradoC=="4"){?> selected <? }?>>Medio</option>
              <option value="5" <? if($gradoC=="5"){?> selected <? }?>>Dificil</option>
            </select>
            </label>
            </p>
            <p>

      
        <?
       	if($Accion =="buscarReactivo")
			{ ?>
            
        <a href="#" class="button" id="btmodificaReactivo" name="btmodificaReactivo"><span>Modificar</span></a>        </p>
        <?
        }
        else
		{
		?>
          <a href="#" class="button" id="btguardaReactivo" name="btguardaReactivo"><span>Guardar</span></a>        </p>
          <?
          }
     ?>
         <a href="altaReactivos.php" class="button" id="btnuevoReactivo" name="btnuevoReactivo"><span>Nuevo</span></a>        </p>
</form>            <? /************* TERMINA CONTENIDO DEFAULT *************/?>
      </div>
     </div>
     <? /***************** TERMINA CONTENIDO *******************/ ?>
     </div><!-- TERMINA DIV panelPrincipal -->
</div>
<script type="text/javascript" src="../script/js/ajaxScript.js"></script>
<script src="monitorAdmon.js"></script>
<?
if($Accion =="guardaReactivo")
{
include("../script/php/conexion.php");
foreach($_POST as $nombre_campo => $valor)
{
$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
eval(utf8_decode($asignacion));
}
echo $guardaReactivo="INSERT INTO preguntas 
	(cat_temas_id, 
	cat_area_id, 
	nombre_docente, 
	pregunta, 
	opcion1, 
	opcion2, 
	opcion3, 
	opcion4, 
	respuesta, 
	grado_dificultad, 
	tipo, 
	justificacion
	)
	VALUES
	('1', 
	'1', 
	'nombre_docente', 
	'$pregunta', 
	'$opcion1', 
	'$opcion2', 
	'$opcion3', 
	'$opcion4', 
	'$respuesta', 
	'$grado', 
	'$tipo', 
	'justificacion'
	);
";
$guardaReactivoEjecuta=mysql_query($guardaReactivo);

?>
<script languaje="javascript">
mensajeGuarda('altaReactivos.php');

</script> 
<?
	mysql_close();
}
?>
<?
if($Accion =="modificaReactivo")
{
include("../script/php/conexion.php");
foreach($_POST as $nombre_campo => $valor)
{
$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
eval(utf8_decode($asignacion));
}
echo $modificaReactivo="
UPDATE preguntas 
	SET
	cat_temas_id = '1' , 
	cat_area_id = '1' , 
	nombre_docente = '1' , 
	pregunta = '$pregunta' , 
	opcion1 = '$opcion1' , 
	opcion2 = '$opcion2' , 
	opcion3 = '$opcion3' , 
	opcion4 = '$opcion4' , 
	respuesta = '$respuesta' , 
	grado_dificultad = '$grado' , 
	tipo = '$tipo'
	
	WHERE
	id = '$idReactivo'";
$modificaReactivoEjecuta=mysql_query($modificaReactivo);

?>
<script languaje="javascript">
mensajeModifica('altaReactivos.php');

</script> 
<?
	mysql_close();
}
?>
</body>
</html>

