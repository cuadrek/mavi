<?
	session_start();

	include("../script/php/settings.php");

	include("../script/php/conexion.php");

	//ESPECIFICAMOS EL TIPO DE MODULO, Y EL TIPO DE USUARIOS QUE ACEPTARA
	$ACCESO="Administrador";
	$item_seleccionado="CATALOGOS";
	$item_subSeleccionado="GENERAR";

	//RECIVIMOS LA VARIABLE PRINCIPAL DEL id_usuario
	$id_usuario=$_SESSION["id_usuario"];

	//COMPROBAMOS SI ESTA LOGEADO Y SI TIENE LOS PERMISOS NECESARIOS
	echo (validarSession($_SESSION["nivel"],$ACCESO) ? "" : "<script>alert('Usted no cuenta con los permisos necesarios.'); 	window.location.href='../script/php/salir.php'</script>");

	
	$maraton = $_POST[maraton];
	$etapa = $_POST[etapa];
	$teoricas = $_POST[teoricas];
	$practicas = $_POST[practicas];
	$accion = $_POST[accion];
	
	if($accion=="generar"){
		$SQL = "SELECT preguntas.id AS id FROM preguntas LEFT JOIN cuestionario_pregunta ON preguntas.id = cuestionario_pregunta.preguntas_id
				WHERE tipo = 1 AND cuestionario_pregunta.id is null
				ORDER BY RAND() LIMIT 0, $teoricas";
		$pregTeoricas = mysql_query($SQL);
		
		$key = 0;
		while($fila = mysql_fetch_array($pregTeoricas)){
			$preguntas[$key] = $fila[id];
			$key++;
		}
		
		$SQL = "SELECT preguntas.id AS id FROM preguntas LEFT JOIN cuestionario_pregunta ON preguntas.id = cuestionario_pregunta.preguntas_id
				WHERE tipo = 2 AND cuestionario_pregunta.id is null
				ORDER BY RAND() LIMIT 0, $practicas";
		$pregPracticas = mysql_query($SQL);
		
		while($fila = mysql_fetch_array($pregPracticas)){
			$preguntas[$key] = $fila[id];
			$key++;
		}
		
		$randKeys = array_rand($preguntas,count($preguntas));
		
		foreach($randKeys as $posicion => $key ){
			$secuencia = $posicion + 1;
			$SQL2 = "INSERT INTO cuestionario_pregunta(etapa_id, maraton_id, preguntas_id, secuencia) VALUES($etapa, $maraton, $preguntas[$key], $secuencia)";
			mysql_query($SQL2);
		}
		
		echo "
			<script>
				alert('Cuestionario generado.');
			</script>
		";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Generar Reactivos</title>
	<link rel="shortcut icon" href="../imagenes/favicon.ico" />
	<link href="../css/default.css" rel="stylesheet" type="text/css" />
	<link href="../css/login.css" rel="stylesheet" type="text/css" />
	<link href="../css/contenido.css" rel="stylesheet" type="text/css" />
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
	<link href="../css/competidor_maraton.css" rel="stylesheet" type="text/css" />
	<!--script language="javascript" type="text/javascript" src="../script/js/jquery-1.3.2.produccion.js"></script>
	<script language="javascript" type="text/javascript" src="../script/js/tinybox.js"></script-->
	<script language="javascript" type="text/javascript" src="../script/js/generarReactivos.js"></script>	


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
		    <div id="marco">
		        <h1 class="barrah1">Bienvenido</h1>
		        <p>Usted acaba de entrar al m�dulo de Administrador, el principal para poder efectuar un Marat�n Virtual, en este m�dulo usted podr� :</p>

	<div id="general">
		<div id="cabeza">
			<form id="frm" name="frm" action="<?=$PHP_SELF; ?>" method="post">
			<!--form id="frm" name="frm" action="generarReactivos.php" method="post"-->			
			<input type="hidden" name="accion" value="generar" />
			<table>
				<tr>
					<td>
						Marat�n:
						<select name="maraton">
							<option value="">Seleccionar...</option>
							<?
								$SQL = "SELECT id, nombre_tema FROM maraton";
								$res = mysql_query($SQL);
								while($fila = mysql_fetch_array($res)){
							?>
							<option value="<?=$fila[id]; ?>" <?=($fila[id] == $maraton ? "selected" : "" ) ?> ><?=$fila[nombre_tema] ?></option>
							<?
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Etapa:
						<select name="etapa">
							<option value="">Seleccionar...</option>
							<?
								$SQL = "SELECT * FROM etapa";
								$res = mysql_query($SQL);
								while($fila = mysql_fetch_array($res)){
							?>
							<option value="<?=$fila[id]; ?>" <?=($fila[id] == $etapa ? "selected" : "" ) ?> ><?=$fila[nombre] ?></option>
							<?
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Preguntas teoricas: <input type="text" name="teoricas" id="teoricas"/></td>
				</tr>
				<tr>
					<td>Preguntas prácticas: <input type="text" name="practicas" id="practicas" /></td>
				</tr>
				<tr>
					<td>
						<!--input type="submit" value="Generar" /-->
						<input type="button" value="Generar"  onclick="javascript:var enviar=0; if(document.frm.teoricas.value.length==0){alert('Favor de llenar el campo de Teoricas'); document.frm.teoricas.focus(); }else{enviar+=1;}if(document.frm.practicas.value.length==0){alert('Favor de llenar el campo de Practicas'); document.frm.practicas.focus(); }else{enviar+=1;}if(enviar==2){document.forms.frm.submit();}"/>
					</td>
				</tr>
			</table>
			</form>
		</div>
		<div id="contenido">
			
		</div>
		<div id="pie">
			
		</div>
	</div>
	
			    </div>
		  </div>
		</div>
	</div>
</body>
</html>
