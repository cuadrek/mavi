<?
	include("../script/php/conexion.php");

	$camposImportacion=array(0=>"Ignorar",
						 1=>"Pregunta",
						 2=>"Respuesta A",
						 3=>"Respuesta B",
						 4=>"Respuesta C",
						 5=>"Respuesta D",
						 6=>"Respuesta Correcta",
						 7=>"Tipo",
						 8=>"Justificacion",
						 9=>"Autor",
						 10=>"Area de Conocimiento",
						 11=>"Grado de Dificultad"
						 );

	$tiposReactivo=array(0=>"desconocido",
					   1=>"Teórica",
					   2=>"Práctica");

	$gradoDificultad=array(0=>"desconocido",
					   1=>"desconocido",
					   2=>"desconocido",
					   3=>"Básico",
					   4=>"Medio",
					   5=>"Avanzado");

	function guardarDatos($ArchivoRuta, $filas,$columnas,$campos,$arreglo,$hoja){
		$camposTot = explode(",", $campos);
		$arregloTot = explode(",", $arreglo);
		$preguntas="";
		$data = new Spreadsheet_Excel_Reader();
		// Set output Encoding.
		$data->setOutputEncoding('CP1251');
		$data->read($ArchivoRuta);
		
		error_reporting(E_ALL ^ E_NOTICE);
		
		echo '<table width="100%" border="1">';
		for($i=1;$i <= $data->sheets[$hoja]['numRows']; $i++){
		
			if(in_array($i,$arregloTot)){
			
				echo "<tr>";
				
				for($j=1;$j <= $data->sheets[$hoja]['numCols'];$j++){
				
						echo "<td>";
						
						switch($camposTot[$j-1]){
						
							case "1":
								echo $insertar[$i][1] = $data->sheets[$hoja]['cells'][$i][$j];
								break;
								
							case "2":
								echo $insertar[$i][2] = $data->sheets[$hoja]['cells'][$i][$j];
								break;
								
							case "3":
								echo $insertar[$i][3] = $data->sheets[$hoja]['cells'][$i][$j];
								break;
								
							case "4":
								echo $insertar[$i][4] = $data->sheets[$hoja]['cells'][$i][$j];
								break;
								
							case "5":
								echo $insertar[$i][5] = $data->sheets[$hoja]['cells'][$i][$j];
								break;
								
							case "6":
								switch( $data->sheets[$hoja]['cells'][$i][$j] ){
									case 'A':
										echo $insertar[$i][6] = "1";
										break;
									case 'B':
										echo $insertar[$i][6] = "2";
										break;
									case 'C':
										echo $insertar[$i][6] = "3";
										break;
									case 'D':
										echo $insertar[$i][6] = "4";
										break;
									case '1':
										echo $insertar[$i][6] = "1";
										break;
									case '2':
										echo $insertar[$i][6] = "2";
										break;
									case '3':
										echo $insertar[$i][6] = "3";
										break;
									case '4':
										echo $insertar[$i][6] = "4";
										break;
									default:
										echo $insertar[$i][6] = "1";
										break;
								}
								break;
								
							case "7":
								if($data->sheets[$hoja]['cells'][$i][$j] == 1){
									echo $insertar[$i][7]="1";
								}else{
									echo $insertar[$i][7]="2";	
								}
								break;
								
							case "8":
								echo $insertar[$i][8] = $data->sheets[$hoja]['cells'][$i][$j];
								break;
								
							case "9":
								echo $insertar[$i][9]=$data->sheets[$hoja]['cells'][$i][$j];
								break;
								
							case "10":
								echo $insertar[$i][10]=$data->sheets[$hoja]['cells'][$i][$j];
								break;
								
							case "11":
								echo $insertar[$i][11]=$data->sheets[$hoja]['cells'][$i][$j];
								break;
						}
						echo "</td>";
					//}TERMINA IF
				}//TERMINAFOR j
				echo "</tr>";
			}//TERMINA IF IGUAL
		}//TERMINA FOR i
			
		echo "</table>";
		
		$exito=0;
		
		for($i=1; $i <= $data->sheets[$hoja]['numRows']; $i++){
		
			if(in_array($i,$arregloTot)){
			
				$agregaPregunta = "INSERT INTO preguntas(cat_temas_id, cat_area_id, nombre_docente, pregunta, opcion1, opcion2, opcion3, opcion4, respuesta, grado_dificultad, tipo, justificacion) values (1, 1, '" . $insertar[$i][9] . "', '".$insertar[$i][1]."', '".$insertar[$i][2]."', '".$insertar[$i][3]."', '".$insertar[$i][4]."', '".$insertar[$i][5]."', '".$insertar[$i][6]."', '".$insertar[$i][11]."', '".$insertar[$i][7]."', '".$insertar[$i][8]."')";
				if(mysql_query($agregaPregunta)){
					$exito++;
				}
			}
		}
		mysql_close();
		return $exito;
	}
?>