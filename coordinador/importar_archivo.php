<?
	session_start();
	
	include("../script/php/settings.php");
	require_once("../script/excel/reader.php");
	require_once("funciones.php");
	
	//ESPECIFICAMOS EL TIPO DE MODULO, Y EL TIPO DE USUARIOS QUE ACEPTARA
	$ACCESO="Coordinador";
	$item_seleccionado="IMPORTAR";
	
	//RECIVIMOS LA VARIABLE PRINCIPAL DEL id_usuario
	$id_usuario=$_SESSION["id_usuario"];
	$hoja=$_POST["hoja"];
	$Archivo = $_FILES[Archivo][name];
	$ArchivoTemporal = $_FILES[Archivo][tmp_name];
	
	//COMPROBAMOS SI ESTA LOGEADO Y SI TIENE LOS PERMISOS NECESARIOS
	echo (validarSession($_SESSION["nivel"],$ACCESO)?"":"<script>alert('Usted no cuenta con los permisos necesarios.'); window.location.href='../script/php/salir.php'</script>");
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
	<link href="../css/excel.css" rel="stylesheet" type="text/css" />

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
		  <div id="divOpcion">
			<button id="btMax" name="btMax">&lt;-&gt;</button>
		  </div>
		  <?
		  if(is_null($_POST["Accion"])){
		  ?>
		  <p>Si esta de acuerdo con los datos visualizados por favor haga clic en el botón Continuar, de no ser así, haga clic en el botón Cancelar y seleccione otro archivo.</p>
		  <ol>
			  <li>Puede seleccionar los reactivos que desee importar haciendo click los 'checkbox' que se encuentran en cada fila</li>
			  <li>Si ha revisado los reactivos y desea importar todos, haga clic en la opcion 'Todos', o tambien puede hacerlo manualmente.</li>
			  <li>En la primer fila de la tabla, usted puede seleccionar a que tipo de dato corresponde esa columna, puede seleccionar segun corresponda.</li>
			</ol>
				<a href="#" name="btContinuar" id="btContinuar" class="button"><span>Continuar</span></a>
				<label>
				  <input type="checkbox" name="todosCHK" id="todosCHK" onchange="todos(); return false"/>Todos
				</label>
				<br/>
				<br/>
		  <?
		  }
		  else{
		  ?>	  
		  <p>Se ha realizado la transacción:</p>
		  <?
		  }
		  ?> 
				  <?
					if($_POST["Accion"]=="GUARDAR"){
						echo "<p>Se han guardado ".guardarDatos($_POST["ruta"], $_POST["filas"],$_POST["columnas"],$_POST["campos"],$_POST["arreglo"],$hoja)." registro(s) con exito!</p>";
					}
					else{ 
						if(strpos($Archivo,".xls"))
						{
							$ruta="../archivos/$Archivo";
							move_uploaded_file($ArchivoTemporal,$ruta);
							$data = new Spreadsheet_Excel_Reader();
							// Set output Encoding.
							$data->setOutputEncoding('CP1251');
							$data->read("../archivos/".$Archivo);
							error_reporting(E_ALL ^ E_NOTICE);
							echo "<div id='divTablaReactivos'>";
							echo "<form id='Datos' name='Datos' method='post' action='".$PHP_SELF."'/>";
							echo "<input type='hidden' name='hoja' id='hoja' value='".$hoja."' />";
							echo "<input type='hidden' name='filas' id='filas' value='".$data->sheets[$hoja]['numRows']."' >";
							echo "<input type='hidden' name='ruta' id='ruta' value='".$ruta."' >";
							echo "<input type='hidden' name='columnas' id='columnas' value='".$data->sheets[$hoja]['numCols']."' >";
							echo "<input type='hidden' name='campos' id='campos' />";
							echo "<input type='hidden' name='arreglo' id='arreglo' />";
							echo "<input type='hidden' name='Accion' id='Accion' value='GUARDAR'/>";
							echo "</form>";
							echo "<table class='reactivos' border='0' cellspacing='0' cellpadding='0' width='100%'>";
							for($i = 0; $i <= $data->sheets[$hoja]['numRows']; $i++) {
								echo "<tr>";
								for($j=0;$j<=$data->sheets[$hoja]['numCols'];$j++){
									echo "<td>";
									if($i==0&&$j>0){
										echo '<label><select name="nombreCampo'.$j.'" id="nombreCampo'.$j.'">';
										for($x=0;$x<count($camposImportacion);$x++){
											if($x==$j){
												echo '<option value="'.$x.'" selected="selected">'.$camposImportacion[$x].'</option>';
											}else{
												echo '<option value="'.$x.'">'.$camposImportacion[$x].'</option>';
											}
										}
										echo '</select></label>';
									}else{
										if($j>0){
											echo utf8_encode($data->sheets[$hoja]['cells'][$i][$j]);
										}
										else if($i==0){
											echo "Importar";
										}
										else{
											echo "<input type='checkbox' name='chk".$i."_".$j."' id='chk".$i."_".$j."' />";
										}
									}
									echo "</td>";
								}
								echo "</tr>";
							}
							echo "<table>";
							echo "</div>";
						}
						else{
							echo '<script>document.location.href="importar.php?msj=FD";</script>';	
							//FD - FORMATO DESCONOCIDO
						}	
					}
				?>
		  </div>
		  </div>
		</div>
	</div>
	<script language="javascript" type="text/javascript" src="importar.js"></script>
</body>
</html>