<?
	//$ruta_raiz="http://192.168.1.254/mavi";
	//$ruta_raiz="http://148.226.17.218/mavi";
	//$ruta_raiz="http://localhost/mavi_adair";
	$runnin=0;

	function validarSession($param,$tipo){
		switch($param){
			case 1:
			/*ADMINISTRADOR - 1*/
				return ($tipo=="Administrador")?1:0;
			break;
			case 2:
			/*COORDINADOR - 2*/
				return ($tipo=="Coordinador")?1:0;
			break;
			case 3:
			/*JURADO - 3*/
				return ($tipo=="Jurado")?1:0;
			break;
			case 4:
			/*COMPETIDOR - 4*/
				return ($tipo=="Competidor")?1:0;
			break;
			default:
			/*SALIR*/
				return 0;
			break;
		}
	}

	function properHTML($cadena)
	{
		$buscar = array("á", "é", "í", "ó", "ú", "ñ", "Á", "É", "Í", "Ó", "Ú", "Ñ");
		$reemplazar = array("&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&ntilde;", "&Aacute;", "&Eacute;", "&Iacute;", "&Oacute;", "&Uacute;", "&Ntilde;");
   		return str_replace($buscar, $reemplazar, $cadena);
	}
?>