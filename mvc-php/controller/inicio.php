<?php
require_once("../db/connection.php");
session_start();
if($_POST["inicio"]){

	// inicia sesion para los usuarios

	$usuario = $_POST["usuario"];
	$clave = $_POST["clave"];
	
	
	/// consultamos el usuario segun el usuario y la clave
	$con="select * from usuario where correo = '$usuario' and contrasena = '$clave'"; 	
	$query=mysqli_query($mysqli, $con);
	$fila=mysqli_fetch_assoc($query);

	if($fila){		

		/// si el usario y la clave son correctas, creamo las sessiones 
		$_SESSION['id_user'] = $fila['documento']; 
		$_SESSION['nombres'] = $fila['nombre']; 
		$_SESSION['tipo'] = $fila['idtipousuario'];
		$_SESSION['usuario'] = $fila['correo'];
		
				/// dependiendo del tipo de usuario lo redireccinamos a una pagina
				
		/// si es un admin
		if($_SESSION['tipo'] == 1){
			// header("Location: ../model/admin/index1.php"); 
			header("Location: ../index.html");
			exit();
		}
		/// si es un odontologo
		elseif($_SESSION['tipo'] == 2){
			// header("Location: ../model/odontologo/index1.php"); 
			header("Location: ../hola.html");
			exit();		
		}
		//si es paciente
		elseif($_SESSION['tipo'] == 3){
			// header("Location: ../model/paciente/index1.php"); 
			header("Location: ../hola.html");
			exit();		
		}
		
	}else{
		/// si el usuario y la clave son incorrectas lo lleva a la pagina de inio y se muestra un mensaje
		header("Location: ../errorlog.html"); 
		exit();
	}
	
}	
?>