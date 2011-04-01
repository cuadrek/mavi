<?
    session_start();
	include("../script/php/conexion.php");
	include("../script/php/settings.php");

	//ESPECIFICAMOS EL TIPO DE MODULO, Y EL TIPO DE USUARIOS QUE ACEPTARA
	$ACCESO="Administrador";
	$item_seleccionado="REPORTE";

	//RECIVIMOS LA VARIABLE PRINCIPAL DEL id_usuario
	$id_usuario=$_SESSION["id_usuario"];

	//COMPROBAMOS SI ESTA LOGEADO Y SI TIENE LOS PERMISOS NECESARIOS
	echo (validarSession($_SESSION["nivel"],$ACCESO) ? "" : "<script>alert('Usted no cuenta con los permisos necesarios.'); window.location.href='../script/php/salir.php'</script>");
	

	$id = $_POST[id];
	$maraton = $_POST[maraton];
	$etapa = $_POST[etapa];
	$accion = $_POST[accion];
	
	if($accion=="anular"){
		
		$SQL = "SELECT id FROM cuestionario_pregunta WHERE preguntas_id = $id";
		$res = mysql_query($SQL);
		$fila = mysql_fetch_array($res);
		
		$SQL2 = "UPDATE respuesta SET tiempo = 2 WHERE cuestionario_pregunta_id = $fila[id]";
		mysql_query($SQL2);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Reporte</title>
	<link rel="shortcut icon" href="../imagenes/favicon.ico" />
	<link href="../css/default.css" rel="stylesheet" type="text/css" />
	<link href="../css/login.css" rel="stylesheet" type="text/css" />
	<link href="../css/contenido.css" rel="stylesheet" type="text/css" />
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="reporte.css" />
	<script language="javascript" type="text/javascript">
		function verRespuestas(id){
		
			var frmMaraton = document.getElementById("frm");
		
			var frm = document.getElementById("frmResp");
			frm.id.value = id;
			frm.maraton.value = frmMaraton.maraton.value;
			frm.etapa.value = frmMaraton.etapa.value;
			frm.submit();
		}
		
		function verRespuestasEquipo(id){
			var frmMaraton = document.getElementById("frm");
			
			var frm = document.getElementById("frmRespEq");
			frm.id.value = id;
			frm.maraton.value = frmMaraton.maraton.value;
			frm.etapa.value = frmMaraton.etapa.value;
			frm.submit();
		}
		
		function anularPregunta(id){
			var frmMaraton = document.getElementById("frm");
			
			var frm = document.getElementById("frmAnular");
			frm.id.value = id;
			frm.maraton.value = frmMaraton.maraton.value;
			frm.etapa.value = frmMaraton.etapa.value;
			frm.submit();
		}
	</script>
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
		    <div id="marco">
		        <h1 class="barrah1">Bienvenido</h1>
		        <p>Usted acaba de entrar al módulo de Administrador, el principal para poder efectuar un Maratón Virtual, en este módulo usted podrá :</p>

	
	<form id="frmAnular" action="reporte2.php" method="post">
		<input type="hidden" name="accion" value="anular" />
		<input type="hidden" name="id" />
		<input type="hidden" name="maraton" />
		<input type="hidden" name="etapa" />
	</form>
	
	<form id="frmResp" action="reporte2.php" method="post">
		<input type="hidden" name="id" />
		<input type="hidden" name="maraton" />
		<input type="hidden" name="etapa" />
	</form>
	
	<form id="frmRespEq" action="reporte3.php" method="post">
		<input type="hidden" name="id" />
		<input type="hidden" name="maraton" />
		<input type="hidden" name="etapa" />
	</form>

	<div id="general">
		<div id="cabeza">
			<form id="frm" action="reporte.php" method="post">
			<input type="hidden" name="accion" value="mostrar" />
			<table>
				<tr>
					<td>
						Maratón:
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
					<td>
						<input type="submit" value="Mostrar" />
					</td>
				</tr>
			</table>
			</form>
		</div>
		<div id="contenido">
			<?
				if($id != ""){
				
					$respuestas = array( 1 => "A", 2 => "B", 3 => "C", 4 => "D");
					$correcta = 0;
					
					$SQL = "SELECT 
				       	      preguntas.id AS id,
					          cuestionario_pregunta.secuencia AS secuencia,
					          preguntas.pregunta AS pregunta,
						      preguntas.opcion1 AS opcion1,
       						  preguntas.opcion2 AS opcion2,
					          preguntas.opcion3 AS opcion3,
					          preguntas.opcion4 AS opcion4,
					          preguntas.respuesta AS respuesta,
					          preguntas.tipo AS tipo
							FROM cuestionario_pregunta, preguntas
							WHERE cuestionario_pregunta.preguntas_id = preguntas.id AND preguntas.id = $id";
					
					$res = mysql_query($SQL);
					if($fila = mysql_fetch_array($res)){
						$respuestas[1] = "A) " . $fila[opcion1];
						$respuestas[2] = "B) " . $fila[opcion2];
						$respuestas[3] = "C) " . $fila[opcion3];
						$respuestas[4] = "D) " . $fila[opcion4];
						$correcta = $fila[respuesta];
			?>
			<div class="pregunta">
				<table>
					<tr>
						<td class="texto" colspan="3">
							<a href="#" onclick="verRespuestas(<?=$fila[id] ?>);"><?=$fila[secuencia]; ?>) <?=$fila[pregunta] ?><a/>
						</td>
						<td>
							<input type="button" value="Anular" onclick="anularPregunta(<?=$fila[id] ?>);" />
						</td>
					</tr>
					<tr>
						<td class="tipo" colspan="4">(Tipo: <?=($fila[tipo]==1 ? "Teórica" : "Práctica" )?>)</td>
					</tr>
					<tr>
						<td <?=($fila[respuesta] == 1 ? "class=\"opcionCorrecta\"" : "class=\"opcion\"") ?> >A) <?=$fila[opcion1] ?></td>
						<td <?=($fila[respuesta] == 2 ? "class=\"opcionCorrecta\"" : "class=\"opcion\"") ?> >B) <?=$fila[opcion2] ?></td>
						<td <?=($fila[respuesta] == 3 ? "class=\"opcionCorrecta\"" : "class=\"opcion\"") ?> >C) <?=$fila[opcion3] ?></td>
						<td <?=($fila[respuesta] == 4 ? "class=\"opcionCorrecta\"" : "class=\"opcion\"") ?> >D) <?=$fila[opcion4] ?></td>
					</tr>
					
				</table>
			</div>
			<?
					}
					
					$SQL = "SELECT
					 		  usuario.id AS id,
							  usuario.nombre AS nombre,
							  respuesta.respuesta AS respuesta,
							  respuesta.tiempo AS tiempo
							FROM usuario, respuesta, cuestionario_pregunta
							WHERE usuario.id = respuesta.usuario_id AND
					              respuesta.cuestionario_pregunta_id = cuestionario_pregunta.id AND
					              cuestionario_pregunta.preguntas_id = $id
						    ORDER BY usuario.id";
					$lista = mysql_query($SQL);
					while($fila = mysql_fetch_array($lista)){
			?>
			<div class="equipo">
				<table>
					<tr>
						<td rowspan="2">
							<img src="<?=( $fila[respuesta] == $correcta ? "../imagenes/bien.png" : "../imagenes/chk_off.png" )?>" />
						</td>
						<td class="nombre"><a href="#" onclick="verRespuestasEquipo(<?=$fila[id] ?>)"><?=$fila[nombre] ?></a></td>
						<td class="tiempo"><?=($fila[tiempo] == 2 ? "(Fuera de tiempo)" : "" )?></td>
					</tr>
					<tr>
						<td class="opcion-equipo" colspan="2"><?=$respuestas[$fila['respuesta']] ?></td>
					</tr>
				</table>
			</div>
			<?
					}
				}
			?>
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