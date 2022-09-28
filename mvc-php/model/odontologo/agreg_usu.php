
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE correo = '".$_SESSION['usuario']."' AND usuario.idtipousuario = tipousuario.idtipo";
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
            $correo=            $_POST['correo'];
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
            <h1>FORMULARIO </h1> 
        </section>
        <table class="centrar" >
            <form method="POST" name="formreg" autocomplete="off">
                              
                <tr>
                    <td>Nombre de paciente</td>
                    <td><input type="number" name="documento" placeholder="Ingrese Documento Identidad" ></td>
                </tr>

                <tr>
                    <td>Documento paciente</td>
                    <td><input type="number" name="documento" placeholder="Ingrese Documento Identidad" ></td>    
                </tr>

                <tr>
                    <td>Fecha consulta</td>
                    <td><input type="number" name="documento" placeholder="Ingrese Documento Identidad" ></td>   
                </tr>

                <tr>
                    <td>Motivo consulta</td>
                    <td><input type="number" name="documento" placeholder="Ingrese Documento Identidad" ></td> 
                </tr>

                <tr>
                    <td>Indicadores de salud bucal</td>
                    <td><input type="number" name="documento" placeholder="Ingrese Documento Identidad" ></td>
                    
                </tr>
                   
                   
                   
                    <!-- <input type="password" name="contrasena" placeholder="Ingrese Contraseña" >
                    <td colspan='2' align="center">



                    <input type="text" name="nombre" placeholder="Ingrese Nombres Completos" >
                    <td colspan='2' align="center">
                    <input type="text" name="apellido" placeholder="Ingrese Apellidos Completos" >
                    <td colspan='2' align="center">
                    <input type="text" name="correo" placeholder="Ingrese su correo" >
                    <td colspan='2' align="center">
                    <input type="text" name="direccion" placeholder="Ingrese su direccion" >
                    <td colspan='2' align="center">
                    <input type="number" name="telefono" placeholder="Ingrese su telefono" >
                    <td colspan='2' align="center">
                    <input type="number" name="numTarjProf" placeholder="Ingrese el num de tarj prof" >
                    <td colspan='2' align="center">
                    <input type="text" name="tipousu" placeholder="Seleccione el tipo de usuario" list="listatipusu">
                    
                        <datalist id="listatipusu">
                        <option value="1">
                        <option value="2">
                        <option value="3">
                        <td colspan='2' align="center">
                    </datalist>-->
                    
                    <td colspan='2' align="center"><input style="margin-bottom: 5px;" type="submit" name="validar" value="Guardar Formulario"> <td colspan='2' align="center">
                    
                    <td colspan='2' align="center"><input type="hidden" name="MM_insert" value="formreg">


                
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
            </form>
        </table>
    </body>
</html>