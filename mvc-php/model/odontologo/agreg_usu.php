
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM informe, usuario, tipousuario WHERE correo = '".$_SESSION['usuario']."' AND usuario.idtipousuario = tipousuario.idtipo";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>

<?php

        if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
        {
            $cedula=            $_POST['documento'];
            $clave=             $_POST['contrasena'];
            $nombre=            $_POST['nombre'];
            $apellido=          $_POST['apellido'];
            $ntarjprof=         $_PSOT['numTarjProf'];
            $direccion=         $_POST['direccion'];
            $telefono=          $_POST['telefono'];
            $idinfome=            $_POST['correo'];
            $idtipousuario=     $_POST['tipousu'];
            
            
    
            $validar ="SELECT * FROM usuario WHERE documento='$cedula' or correo='$correo'";
            $queryi=mysqli_query($mysqli,$validar);
            $fila1=mysqli_fetch_assoc($queryi);
        
           if ($fila1) {
               echo '<script>alert ("DOCUMENTO O USUARIO EXISTEN //CAMBIELOS//");</script>';
               echo '<script>windows.location="agreg_usu.php"</script>';
           }
            else if ($cedula=="" || $nombre=="" || $correo=="" || $clave=="" || $apellido=="" || $direccion=="")
            {
                echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
                echo '<script>windows.location="agreg_usu.php"</script>';
            }
            else if($idtipousuario=="2" && $ntarjprof=="0"){
                echo '<script>alert ("El odontologo requiere de numero de tarjeta profesional");</script>';
                echo '<script>windows.location="agreg_usu.php"</script>';
            }
            else if($idtipousuario=="1"|| $idtipousuario=="3")
            {
               $insertsql="INSERT INTO usuario(documento,contrasena,nombre,apellido,numTarjProf,direccion,telefono,correo,idtipousuario) VALUES('$cedula','$clave','$nombre','$apellido',NULL,'$direccion','$telefono','$correo','$idtipousuario')";
               mysqli_query($mysqli,$insertsql);
               echo '<script>alert (" Registro Exitoso, Gracias");</script>';
               echo '<script>window.location="agreg_usu.php"</script>';
            }
            else{

                $insertsql="INSERT INTO usuario(documento,contrasena,nombre,apellido,numTarjProf,direccion,telefono,correo,idtipousuario) VALUES('$cedula','$clave','$nombre','$apellido','$ntarjprof','$direccion','$telefono','$correo','$idtipousuario')";
                mysqli_query($mysqli,$insertsql);
                echo '<script>alert (" Registro Exitoso, Gracias");</script>';
                echo '<script>window.location="agreg_usu.php"</script>';
            }
        }

?>
<form method="POST">

    <tr>
        <td colspan='2' align="center"><?php echo $usua['nombre'] ,' ',$usua['apellido']?></td>
    </tr>
<tr><br>
    <td colspan='2' align="center">
    
    
        <input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
        <input type="submit" formaction="index.php" value="Regresar" />
    </tr>
</form>

<?php 

if(isset($_POST['btncerrar']))
{
	session_destroy();

   
    header('location: ../../index.html');
}
	
?>

</div>

</div>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Creacion Formulario</title>
</head>
    <body>
        <section class="title">
            <h1>Nuevo Informe </h1> 
        </section>
        <table class="centrar" >
            <form method="POST" name="formreg" autocomplete="off">
                              
                <tr>
                    <td>Id Paciente</td>
                    <td><input type="number" name="documento" placeholder="Ingrese Documento Paciente" ></td>
                </tr>

                <tr>
                    <td>Id Odontologo</td>
                    <td><input type="number" name="documento" placeholder="Ingrese Documento Odontologo" ></td>
                </tr>

                <tr>
                    <td>Fecha del informe</td>
                    <td><input type="number" name="documento" placeholder="Ingrese fecha del informe" ></td>    
                </tr>

                
                <tr>
                    <td>Recomendaciones</td>
                    <td><input type="number" name="documento" placeholder="Ingrese Recomendaciones" ></td> 
                </tr>

                <tr>
                    <td>Medicamentos Formulados</td>
                    <td><input type="number" name="documento" placeholder="Ingrese medicamentos" ></td>
                    
                </tr>
                
                <tr>
                    <td>Procedimiento realizado</td>
                    <td><input type="number" name="documento" placeholder="Ingrese procedimiento realizado" ></td>
                </tr>
                   
                   
                
                    
                    <td colspan='2' align="center"><input style="margin-bottom: 5px;" type="submit" name="validar" value="Guardar Formulario"> <td colspan='2' align="center">
                    
                    <td colspan='2' align="center"><input type="hidden" name="MM_insert" value="formreg">


                
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
            </form>
        </table>
    </body>
</html>