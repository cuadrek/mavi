<?php
require('../script/php/conexion2.php');


 $etapa=$_POST['idEtapa'];
 $maraton=$_POST['idMaraton'];
 $cadena=$_POST['cadena'];
$cadenas=explode('/',$cadena);
$nro_cadenas=count($cadenas);
$i=0;

$eliminaMaraton=mysql_query("DELETE FROM cuestionario_pregunta  where etapa_id = '$etapa'",$con);

while($i<$nro_cadenas){
	$elementos=explode(',',$cadenas[$i]);
	$nro_elementos=count($elementos);
	$j=0;
	$secuencia=1;
	while($j<$nro_elementos){
		if($elementos[$j]!=""){
			switch($i){
				case 0:
				//echo "qui van los sueltos";
				//mysql_query("INSERT INTO contratado(nombre_contratado) VALUES ('$elementos[$j]')",$con);
				break;
				case 1:
				//echo "no_secuencia="." ".$secuencia;
				//$elementos[$j];
				mysql_query("INSERT INTO cuestionario_pregunta(etapa_id,maraton_id,preguntas_id,secuencia)VALUES('$etapa', 	'$maraton','$elementos[$j]','$secuencia');",$con);
				break;
			}
			$secuencia++;
		}
		//$secuencia++;
		$j++;
	}
	$i++;
}

echo "Cambios guardados";
?>