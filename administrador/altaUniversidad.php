<?	session_start();

	include("../script/php/settings.php");

	//ESPECIFICAMOS EL TIPO DE MODULO, Y EL TIPO DE USUARIOS QUE ACEPTARA
	$ACCESO="Administrador";
	$item_seleccionado="CATALOGOS";
	$item_subSeleccionado="RELACION";

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

<script type="text/javascript">
	function obtenerElementos() {
	if(document.getElementById('idEtapa').value=="")
{
alert('Seleccione una etapa');
		return false;

}
else
{

		var secciones = document.getElementsByClassName('seccion');
		var alerttext = '';
		var separador = '';
		secciones.each(function(seccion) {
			alerttext += separador + Sortable.sequence(seccion);
			separador = "/";
		});
		EnviarDatos(alerttext);
				return true;

}		
	}
</script>


</head>
<!-- ********************LLAMAMOS A LA LIBRERIA DE JQUERY y TINY*************** -->
<script src="../script/js/prototype.js" type="text/javascript"></script>
<script src="../script/js/scriptaculous.js" type="text/javascript"></script>
<script src="../script/js/ajax.js" type="text/javascript"></script>


<style>
#sueltos{
	background-color:#FFFFCC;
	margin:0px;
	position:absolute;
	left: 200px;
	top: 300px;
}
#paramaraton{
	background-color:#E4ECF3;
	margin:0px;
	position:absolute;
	left: 580px;
	top: 300px;
}
#sueltos div, #paramaraton div{
	margin:4px;
	cursor:move;
}
h3{
	margin:4px;
	background-color:#4B6186;
	color:#FFFFFF;
	cursor:move;
}
#pagina{
	width:350px;
	margin:auto;
	padding-left:50px;
	padding-right:50px;
	height:250px;
}
</style>
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
    <div id="panelCatalogos" style="height:2000px;">
    <form id="relacionReactivos" name="relacionReactivos" method="post" action="altaUniversidad.php">
    <input name="maraton" type="hidden" id="maraton" value="" />
    <input name="etapa" type="hidden" id="etapa"  />
    </form>
    
    <? /***************** CONTENIDO *******************/ ?>
    <input type="hidden" name="fr_id_admon" id="fr_id_admon" value="<?=$id_usuario?>"/>
    <input type="hidden" name="fr_id_maraton" id="fr_id_maraton" value="0"/>
    <input type="hidden" name="fr_cuestionario_pregunta" id="fr_cuestionario_pregunta" value="0"/>
    <input type="hidden" name="fr_preguntando" id="fr_preguntando" value="0"/>
	<div id="competencia_catalogo">
      <div id="competencia_menu">
   	    <? include("subCatalogoAdmon.php"); ?>
   	  </div>     
       <h2 align="center">Arrastra los reactivos de un bloque a otro y presiona Guardar</h2>
         <?
	   	 require('../script/php/conexion2.php');

	   $variableSecuencia=1;
	   $limite=100;
	   $totalErrores=0;
	  $comparaSecuencia="SELECT * FROM cuestionario_pregunta WHERE etapa_id = '$etapa' AND maraton_id = '$maraton'"; 
	 $ejecutaSecuencia=mysql_query($comparaSecuencia,$con);
	 while($arregloSecuencia=mysql_fetch_array($ejecutaSecuencia))
	 {
	 	 $numeroSecuencia=$arregloSecuencia['secuencia'];
		 
		 if($variableSecuencia != $numeroSecuencia)
		 {
		 $totalErrores++;
		 }
		 
		$variableSecuencia++;
	 }
	 if ($totalErrores >='1')
	 {
	
		echo "<p>Existen preguntas de esa etapa que fueron borradas por favor guarde de nuevo los datos para reparar el orden de las preguntas</p>";
    
	 }
       ?>
      
       <p align="center">
         <?php
	//include('../../pub/adsgoogle_fullart_tit.tpl');
?>
       </p>
       <div id="pagina">
         <select name="idMaraton"  id="idMaraton" style="width:300px" onchange="buscaMaratonEtapaReactivo();">
            <?
			include("../script/php/conexion.php");
$consultaReactivo="SELECT 	* 	FROM 	maraton ";
$consultaReactivoEJ=mysql_query($consultaReactivo);
				while($maratonesA=mysql_fetch_array($consultaReactivoEJ))
				{
				
				if($maratonesA["id"]==$maraton)
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
              <select name="idEtapa"  id="idEtapa" style="width:300px" onchange="buscaEtapaReactivo();">
                          <option value="">-Seleccione una fase-</option>

            <?
			include("../script/php/conexion.php");
$consultaReactivo="SELECT *	FROM etapa ";
$consultaReactivoEJ=mysql_query($consultaReactivo);
				while($maratonesA=mysql_fetch_array($consultaReactivoEJ))
				{
				
				if($maratonesA["id"]==$etapa)
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
  <input type="button" name="Button" value="GUARDAR" onclick="obtenerElementos()" />
 
         <div id="sueltos" class="seccion" style="float:left;width:350px;">
           <h3 class="arrastrar">Reactivos sueltos</h3>
           <?php 
	 require('../script/php/conexion2.php');
	 $Resultado=mysql_query("SELECT * FROM preguntas",$con);
	 while($MostrarFila=mysql_fetch_array($Resultado))
	 {
 	 $pregunta=$MostrarFila['id'];
	 $consulta0="SELECT * FROM cuestionario_pregunta where preguntas_id like '$pregunta'";
	 $buscaPregunta=mysql_query($consulta0,$con);
	 $MostrarPregunta=mysql_fetch_array($buscaPregunta);
	 if(isset($MostrarPregunta['id']))
	 {
	
	 }
	 else
	 {
		 if($MostrarFila['tipo']=='1')
		 {
		  echo "<div id='empleados_".$MostrarFila['id']."' style='border:1px solid blue;'>".utf8_encode($MostrarFila['pregunta'])."</div> \n";
         }
		 else
		 {
 		  echo "<div id='empleados_".$MostrarFila['id']."' style='border:1px solid green;'>".utf8_encode($MostrarFila['pregunta'])."</div> \n";
		 }
	 }
	 
	 }
	?>
         </div>
         <div id="paramaraton" class="seccion" style="float:left;width:350px;">
           <h3 class="arrastrar">Reactivos para maraton</h3>
           <?php
			
	  $consulta2="SELECT * FROM cuestionario_pregunta WHERE etapa_id = '$etapa' AND maraton_id = '$maraton'"; 
	 $Resultado2=mysql_query($consulta2,$con);
	 while($MostrarFila2=mysql_fetch_array($Resultado2))
	 {
	 $pregunta2=$MostrarFila2['preguntas_id'];
	  $buscaPregunta2=mysql_query("SELECT * FROM preguntas where id like '$pregunta2'",$con);
	 $MostrarPregunta2=mysql_fetch_array($buscaPregunta2);
	 if($MostrarPregunta2['tipo']=='1')
	 {
	 echo  "<div id='despedidos_".$MostrarPregunta2['id']."' style='border:1px solid blue;'>". utf8_encode($MostrarPregunta2['pregunta'])."</div>";
	 }
	 else
	 {
 	 echo  "<div id='despedidos_".$MostrarPregunta2['id']."' style='border:1px solid green;'>". utf8_encode($MostrarPregunta2['pregunta'])."</div>";
	 }
	 
	 }
	?>
         </div>
       </div>

       
       <p align="center"></p>
     </div>
            <? /************* TERMINA CONTENIDO DEFAULT *************/?>
      </div>
    

     </div>
     <? /***************** TERMINA CONTENIDO *******************/ ?>
     </div><!-- TERMINA DIV panelPrincipal -->
          <div id="competencia_fondo" style="height:100px">&nbsp;</div>

</div>
<script type="text/javascript" src="<?=$ruta_raiz?>/script/js/ajaxScript.js"></script>
<script type="text/javascript">
 // <![CDATA[
	Sortable.create('sueltos',{
		tag:'div',
		dropOnEmpty: true, 
		containment:["sueltos","paramaraton"],
		constraint:false});
	Sortable.create('paramaraton',{
		tag:'div',
		dropOnEmpty: true, 
		containment:["sueltos","paramaraton"],
		constraint:false});
	Sortable.create('pagina',{
		tag:'div',
		only:'seccion',
		handle:'arrastrar'});
 // ]]>
function buscaEtapaReactivo()
{ 
document.relacionReactivos.maraton.value=document.getElementById("idMaraton").value;
document.relacionReactivos.etapa.value=document.getElementById("idEtapa").value;
document.relacionReactivos.submit();
}
function buscaMaratonEtapaReactivo()
{ 
document.relacionReactivos.maraton.value=document.getElementById("idMaraton").value;
document.relacionReactivos.submit();
}


       </script>
</body>
</html>


