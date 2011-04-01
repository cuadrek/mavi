<li <?=($item_seleccionado=="INICIO")?'class="seleccionado"':'';?>><a href="<?="index.php" ?>">Inicio</a></li>
<li <?=($item_seleccionado=="IMPORTAR")?'class="seleccionado"':'';?>><a href="<?="importar.php" ?>">Importar Reactivos</a></li>
<li <?=($item_seleccionado=="ORDENAR")?'class="seleccionado"':'';?>><a href="#">Ordenar Reactivos</a></li>
<li <?=($item_seleccionado=="ACTUALIZAR")?'class="seleccionado"':'';?>><a href="#">Actualizar Marat&oacute;n</a>
   <!-- <ul class="interno">
        <li><a href="#">Pregunta</a></li>
        <li><a href="#">Puntaje</a></li>
        <li><a href="#">Total</a></li>
        </ul> -->
    </li>
<li <?=($item_seleccionado=="SALIR")?'class="seleccionado"':'';?>><a href="<?="../script/php/salir.php" ?>">Salir</a></li>