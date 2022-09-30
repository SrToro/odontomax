<?php
session_start();

include '../../db/connection.php';
include("../../controller/validarSesion.php");

$id = $_GET['documento'];

$consulmod = "SELECT * FROM usuario WHERE documento = '$id'";
$modfyusu = mysqli_query($mysqli, $consulmod);
$ususel=mysqli_fetch_array($modfyusu);

$sql = "SELECT * FROM usuario, tipousuario WHERE correo = '".$_SESSION['usuario']."' AND usuario.idtipousuario = tipousuario.idtipo";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);

?>

<form  method="POST">

<div colspan='2' align=center>
    <h1><?php echo $usua['nombre'] ,' ',$usua['apellido'], ' - Administrador'?></h1>
    <input style="border-radius:16px;height:50px; height:40px; width:100px" type="submit"  value="Cerrar sesión" name="btncerrar" />
    <input style="border-radius:16px;height:50px; height:40px; width:100px" type="submit" formaction="./index.php" value="Regresar" />
</div>
</form>
<?php 

if(isset($_POST['btncerrar']))
{
session_destroy();
header('location: ../../index.html');
}

?>


<?php

        if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
        {
            $cedula=            $_POST['documento'];
            $clave=             $_POST['contrasena'];
            $nombre=            $_POST['nombre'];
            $apellido=          $_POST['apellido'];
            $ntarjprof=         $_POST['numTarjProf'];
            $direccion=         $_POST['direccion'];
            $telefono=          $_POST['telefono'];
            $correo=            $_POST['correo'];
            $idtipousuario=     $_POST['tipousu'];
            
            
            if ($cedula=="" || $nombre=="" || $correo=="" || $clave=="" || $apellido=="" || $direccion=="")
            {
                echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
                echo '<script>windows.location="editar.php"</script>';
            }
            else if($idtipousuario=="2" && $ntarjprof=="0"){
                echo '<script>alert ("El odontologo requiere de numero de tarjeta profesional");</script>';
                echo '<script>windows.location="editar.php"</script>';
            }
            else if($idtipousuario=="1"|| $idtipousuario=="3")
            {
                $updatesql="UPDATE usuario SET `documento`='$cedula',`contrasena`='$clave',`nombre`='$nombre',`apellido`='$apellido',`numTarjProf`=NULL,`direccion`='$direccion',`telefono`='$telefono',`correo`='$correo',`idtipousuario`='$idtipousuario' WHERE documento = '$id';";
                mysqli_query($mysqli,$updatesql);
                echo '<script>alert (" Registro Exitoso, Gracias");</script>';
                echo '<script>window.location="view_usu.php"</script>';
            }
            else{

                $updatesql="UPDATE usuario SET `documento`='$cedula',`contrasena`='$clave',`nombre`='$nombre',`apellido`='$apellido',`numTarjProf`='$ntarjprof',`direccion`='$direccion',`telefono`='$telefono',`correo`='$correo',`idtipousuario`='$idtipousuario' WHERE documento = '$id';";
                mysqli_query($mysqli,$updatesql);
                echo '<script>alert (" Registro Exitoso, Gracias");</script>';
                echo '<script>window.location="view_usu.php"</script>';
            }
        }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../controller/image/iconoventana.png" type="image/x-icon">
        <link rel="stylesheet" href="estilos.css">
        <title>Usuarios registrados</title>
    </head>
    <body>
        <div class="tittle-bg">
            <div class="title">
                <h1>USUARIOS REGISTRADOS</h1> 
            </div>
        </div>

        <?php
            $idtipousu= $ususel['idtipousuario'];
            $sqltipo="SELECT tipo FROM tipousuario WHERE idtipo = '$idtipousu' ";
            $resultadotipusu=mysqli_query($mysqli,$sqltipo);
            $show=mysqli_fetch_array($resultadotipusu);
        ?>
        <div class="login-box">
            <form class="update-usu" method="POST" name="formreg" autocomplete="off">            

                <!-- body para formulario -->
                <label>Documento: </label>
                <input type="number" name="documento" placeholder="Ingrese Documento Identidad" value="<?php echo $ususel['documento']?>" >
                <label>Contraseña: </label>
                <input type="text" name="contrasena" placeholder="Ingrese Contraseña" value="<?php echo $ususel['contrasena']?>"  >
                <label>Nombre: </label>
                <input type="text" name="nombre" placeholder="Ingrese Nombres Completos"value="<?php echo $ususel['nombre']?>"  >
                <label>Apellido: </label>
                <input type="text" name="apellido" placeholder="Ingrese Apellidos Completos" value="<?php echo $ususel['apellido']?>">
                <label>Correo: </label>
                <input type="text" name="correo" placeholder="Ingrese su correo"  value="<?php echo $ususel['correo']?>">
                <label>Direccion: </label>
                <input type="text" name="direccion" placeholder="Ingrese su direccion" value="<?php echo $ususel['direccion']?>" >
                <label>Telefono: </label>
                <input type="number" name="telefono" placeholder="Ingrese su telefono" value="<?php echo $ususel['telefono']?>">
                <label>tipo de usuario: </label>
                <select id="listatipusu" name="tipousu" >
                    <optgroup id="listatipusu">
                <?php
                    $sqltipo="SELECT * FROM tipousuario";
                    $resultadotipusu=mysqli_query($mysqli,$sqltipo);
                    while($mostrar=mysqli_fetch_array($resultadotipusu)){
                ?>
                        <option value="<?php echo $mostrar['idtipo'] ?>"><?php echo $mostrar['tipo']?></option>
                <?php
                    }
                ?>
                    </optgroup>
                    <i></i>
                </select>
                <label >Numero de tarjeta profesional: </label>
                <input type="number" name="numTarjProf" placeholder="Ingrese el num de tarj prof" value="<?php echo $ususel['numTarjProf']?>" >
                <input style="margin-bottom:5px; border-radius:16px;height:50px;" type="submit" name="validar" value="Actualizar usuario">
                <input type="hidden" name="MM_insert" value="formreg">
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
            </form>
            
        </div>
    </body>
</html>