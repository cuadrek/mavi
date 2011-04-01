function Ajax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function EnviarDatos(cadena){
	ajax=Ajax();
	ajax.open("POST", "guardar.php",true);
	var etapa=document.getElementById('idEtapa').value;
	var maraton=document.getElementById('idMaraton').value;
	ajax.onreadystatechange=function(){
		if (ajax.readyState==4) {
			alert(ajax.responseText);
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("cadena="+cadena+"&idMaraton="+maraton+"&idEtapa="+etapa)
}

