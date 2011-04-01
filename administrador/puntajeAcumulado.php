<?
$ID_MARATON=$_POST["ID_MARATON"];
?>
<style type="text/css">
.puntaje {
	font-weight: bold;
}
.titulo {
	color: #FFF;
}
table.tablaPuntaje{
	border:1px #000 solid;
	font-family: Arial, Helvetica, sans-serif;
	margin-bottom:10px;
}
</style>
<?
include("../script/php/conexion.php");
?>
<table class="tablaPuntaje" width="723" align="center" cellpadding="3" bordercolor="#750917">
  <tr class="titulo">
    <td width="97" bgcolor="#750917">Equipo</td>
    <td width="61" bgcolor="#750917">Aciertos</td>
    <td width="61" bgcolor="#750917">Errores</td>
    <td width="120" bgcolor="#750917">Puntaje 1a Fase</td>
    <td width="77" bgcolor="#750917">Aciertos</td>
    <td width="54" bgcolor="#750917">Errores</td>
    <td width="126" bgcolor="#750917">Puntaje 2a Fase</td>
    <td width="59" bgcolor="#750917">TOTAL</td>
  </tr>
<?
  $competidores="SELECT competencia.usuario_id AS ID, usuario.nombre AS NOMBRE FROM competencia,usuario WHERE competencia.usuario_id LIKE usuario.id ORDER BY usuario.id";
  $competidores="SELECT DISTINCT usuario.id AS ID, usuario.nombre AS NOMBRE FROM usuario, respuesta, cuestionario_pregunta WHERE respuesta.usuario_id LIKE usuario.id AND respuesta.cuestionario_pregunta_id LIKE cuestionario_pregunta.id AND cuestionario_pregunta.maraton_id LIKE '".$ID_MARATON."'"; 
$resultado=mysql_query($competidores);
while($equipo=mysql_fetch_array($resultado))
{
?>
  <tr>
    <td><?=$equipo["NOMBRE"]?></td>
    <td bgcolor="#6699CC">
    <?
    $aciertos="SELECT COUNT(*) AS ACIERTOS FROM respuesta,cuestionario_pregunta, preguntas WHERE respuesta.usuario_id LIKE '".$equipo["ID"]."' AND cuestionario_pregunta.id LIKE respuesta.cuestionario_pregunta_id AND preguntas.id LIKE cuestionario_pregunta.preguntas_id AND respuesta.respuesta LIKE preguntas.respuesta AND respuesta.tiempo LIKE '1' AND cuestionario_pregunta.etapa_id LIKE '1'";
	$resultado1=mysql_query($aciertos);
	$ej1=mysql_fetch_array($resultado1);
	echo $ej1["ACIERTOS"];
	?>
    </td>
    <td bgcolor="#6699CC">
    <?
    $errores="SELECT COUNT(*) AS ERRORES FROM respuesta,cuestionario_pregunta, preguntas WHERE respuesta.usuario_id LIKE '".$equipo["ID"]."' AND cuestionario_pregunta.id LIKE respuesta.cuestionario_pregunta_id AND preguntas.id LIKE cuestionario_pregunta.preguntas_id AND cuestionario_pregunta.etapa_id LIKE '1' AND ( respuesta.respuesta NOT LIKE preguntas.respuesta OR respuesta.tiempo LIKE '2')";
	$resultado2=mysql_query($errores);
	$ej2=mysql_fetch_array($resultado2);
	echo $ej2["ERRORES"];
	?>
    </td>
    <td bgcolor="#6699CC" class="puntaje"><?
    echo $puntaje=$ej1["ACIERTOS"]*1;
	?></td>
    <td bgcolor="#999966">
    <?
    $aciertos="SELECT COUNT(*) AS ACIERTOS FROM respuesta,cuestionario_pregunta, preguntas WHERE respuesta.usuario_id LIKE '".$equipo["ID"]."' AND cuestionario_pregunta.id LIKE respuesta.cuestionario_pregunta_id AND preguntas.id LIKE cuestionario_pregunta.preguntas_id AND respuesta.respuesta LIKE preguntas.respuesta AND respuesta.tiempo LIKE '1' AND cuestionario_pregunta.etapa_id LIKE '2'";
	$resultado11=mysql_query($aciertos);
	$ej11=mysql_fetch_array($resultado11);
	echo $ej11["ACIERTOS"];
	?>
    </td>
    <td bgcolor="#999966">
    <?
    $errores1="SELECT COUNT(*) AS ERRORES FROM respuesta,cuestionario_pregunta, preguntas WHERE respuesta.usuario_id LIKE '".$equipo["ID"]."' AND cuestionario_pregunta.id LIKE respuesta.cuestionario_pregunta_id AND preguntas.id LIKE cuestionario_pregunta.preguntas_id AND cuestionario_pregunta.etapa_id LIKE '2' AND ( respuesta.respuesta NOT LIKE preguntas.respuesta OR respuesta.tiempo LIKE '2')";
	$resultado21=mysql_query($errores1);
	$ej21=mysql_fetch_array($resultado21);
	echo $ej21["ERRORES"];
	?>
    </td>
    <td bgcolor="#999966" class="puntaje"><?
   echo $puntaje2=$ej11["ACIERTOS"]*2;
	?></td>
    <td bgcolor="#999966" class="puntaje"><?
    echo $TOTAL=$puntaje2+$puntaje;
	?></td>
  </tr>
 <?
}
 ?>
</table>
<a href='#'class='button' onclick='javascript:TINY.box.hide()'><span>Ocultar</span></a>