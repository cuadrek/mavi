// JavaScript Document
$("#btMax").toggle(function(){
	$("#panelPrincipal").animate({
		width:"100%",
	},"slow");
	$("#btMax").text(">-<");
},function(){
	$("#panelPrincipal").animate({
		width:"800px",
	},"slow");						   			   
	$("#btMax").text("<->");
});

$("#btImportar").click(function(){
	document.getElementById("hoja").value=document.getElementById("hoja").value-1;
	document.getElementById("Datos").submit();
});

$("#btContinuar").click(function(){
	guardar();
});

$("#todosCHK").bind("onchange", function(e){
	todos();
});


$("#btCancelar").click(function(){
	history.back();
});

function todos(){
	var columnas=$("#columnas").val();	
	var filas=$("#filas").val();
	if(document.getElementById("todosCHK").checked==true)
	{
		for(i=1;i<=filas;i++){
			document.getElementById("chk"+i+"_0").checked=true;
		}
	}
	else{
		for(i=1;i<=filas;i++){
			document.getElementById("chk"+i+"_0").checked=false;
		}
	}
}

function guardar(){
	var num_var=0;
	var arreglo="";
	var campos="";
	
	for(i=1; i<=$("#filas").val(); i++){
		if( $("#chk" + i + "_0").is(":checked") ){
			num_var++;
			if( i == $("#filas").val() )
			{
				arreglo = arreglo + i;
			}
			else{
				arreglo = arreglo + i + ",";
			}
		}
	}
	
	for(j=1; j<=$("#columnas").val(); j++){
		
		temp = "nombreCampo" + j;
		
		if( j == $("#columnas").val() )
		{
			campos = campos + document.getElementById(temp).value;
		}
		else
		{
			campos = campos + document.getElementById(temp).value + ",";
		}
	}

	/*MANDA LA INFORMACION HACIA LA PAGINA termina_importar.php QUE ES DONDE GUARDA LA INFORMACION */
	document.getElementById("arreglo").value=arreglo;
	document.getElementById("campos").value=campos;
	document.getElementById("Datos").submit();
	//alert(arreglo);
	//alert(campos);
}