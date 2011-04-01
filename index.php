<?
	session_start();

	include("script/php/settings.php");

	if( $_SESSION["usuario"] != "" ){

		switch($_SESSION["nivel"]){
			case 1:
				header("Location: administrador/index.php");
				break;
			case 2:
				/*COORDINADOR - 2*/
				header("Location: coordinador/index.php");
				break;
			case 3:
				/*JURADO - 3*/
				header("Location: jurado/index.php");
				break;
			case 4:
				/*COMPETIDOR - 4*/
				header("Location: competidor/index.php");
				break;
			default:
				header("Location: login.php");
		}
	}else{
		header("Location: login.php");
	}
?>