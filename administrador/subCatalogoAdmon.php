<ul class="mm_competidor">
	<li id="item_puntaje"><span id="usuario">Usuario : <?=$_SESSION["usuario"] ?></span></li>
    <li ><a href="altaMaraton.php" <? if( $item_subSeleccionado=="MARATON"){  ?> style="color:#FF3F00" <? }?>>Maraton</a></li>
    <li id="item_pregunta"><a href="altaUniversidad.php" <? if( $item_subSeleccionado=="RELACION"){  ?> style="color:#FF3F00" <? }?>>Seleccion Reactivos</a></li>
    <li id="item_pregunta"><a href="altaEtapa.php" <? if( $item_subSeleccionado=="ETAPA"){  ?> style="color:#FF3F00" <? }?>>Etapa</a></li>
    <li id="item_puntaje"><a href="altaReactivos.php" <? if( $item_subSeleccionado=="REACTIVOS"){  ?> style="color:#FF3F00" <? }?>>Reactivos</a></li>
    <li id="item_puntaje"><a href="altaEquipos.php" <? if( $item_subSeleccionado=="EQUIPOS"){  ?> style="color:#FF3F00" <? }?>>Equipos</a></li>
	<li id="item_generar"><a href="generarReactivos.php" <? if( $item_subSeleccionado=="GENERAR"){  ?> style="color:#FF3F00" <? }?>>Generar</a></li>
</ul>