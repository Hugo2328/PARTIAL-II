<?php 
include_once("_db.php");
switch ($_POST["accion"]) {
	case 'login':
		login();
		break;
	case 'consultar_usuarios':
		consultar_usuarios();
		break;
	case 'insertar_usuario':
		insertar_usuario();
		break;
	default:
 
		break;
}
function login(){
	global $mysqli;
	$mail= $_POST["mail"];
	$pass = $_POST["password"];
	
	if (empty($mail) && empty($pass)) {
	//empty boxes
       echo"2";
	}  
	
	else {
		$query = "SELECT * FROM web_usr WHERE usr_correo = '$mail'";
		$res = $mysqli->query($query);
		$row = $res->fetch_assoc();
   		if ($row == 0) {
   		//Correo no existe
    	 echo "0";
		}else{
	    	$query = "SELECT * FROM web_usr WHERE usr_correo = '$mail' AND usr_pass = '$pass'";
			$res = $mysqli->query($query);
			$row = mysqli_fetch_array($res);
			//Si el password no es correcto, imprimir 0
			if ($row["usr_pass"] != $pass) {
			echo "0";
			//Si el usuario es correcto, imprimir 1
			}elseif ($mail == $row["usr_correo"] && $pass == $row["usr_pass"]) {
			echo "1";
		
	    	}
	    }
	}
}

function consultar_usuarios(){
	global $mysqli;
	$query = "SELECT * FROM web_usr";
	$res = mysqli_query($mysqli, $query);
	$arreglo = [];
	while($fila = mysqli_fetch_array($res)){
		array_push($arreglo, $fila);
	}
	echo json_encode($arreglo); //Imprime el JSON ENCODEADO
}

function insertar_usuario(){
	global $mysqli;
	$nombre= $_POST["nombre"];
	$tel= $_POST["tel"];
	$mail = $_POST["mail"];
	$pass = $_POST["pass"];

	if (empty($nombre) && empty($mail) && empty($tel) && empty($pass)) {
		echo "0";
		
	}elseif (empty($nombre)) {
		echo "0";
	
	}elseif (empty($mail)) {
		echo "0";
	
	}elseif (empty($tel)) {
		echo "0";
	
	}elseif (empty($pass)) {
		echo "0";
	
	}else{

	$query = "INSERT INTO web_usr (id, usr_correo, usr_pass, usr_nombre, usr_telefono)  VALUES ('','$mail','$pass','$nombre','$tel')";
	$res = mysqli_query($mysqli, $query);
	echo "1";
	}
	

}

function eliminar_usuario(){
	global $mysqli;
}

function editar_usuario(){
	global $mysqli;
}
	
?>