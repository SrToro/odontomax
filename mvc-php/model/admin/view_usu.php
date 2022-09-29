<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE correo = '".$_SESSION['usuario']."' AND usuario.idtipousuario = tipousuario.idtipo";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
?>

<form method="POST">

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

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="estilos.css">
        <title>Usuarios registrados</title>
    </head>
    <body>
        <div class="tittle-bg">
            <div class="title">
                <h1>USUARIOS REGISTRADOS</h1> 
            </div>
        </div>

        <div class="view-usu">
            <table >
                <tr>
                    <th>Documento</th>
                    <th>Contraseña</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Numero de tarjeta profesional</th>
                    <th>Direccion</th>
                    <th>telefono</th>
                    <th>Correo</th>
                    <th>Tipo de usuario</th>
                </tr>
                
                <?php
                    $sqlusu="SELECT * FROM usuario";
                    $resultadousu=mysqli_query($mysqli,$sqlusu);
                    while($mostrar=mysqli_fetch_array($resultadousu)){
                ?>   
                <tr >
                    <td><?php echo $mostrar['documento']?></td>
                    <td><?php echo $mostrar['contrasena']?></td>
                    <td><?php echo $mostrar['nombre']?></td>
                    <td><?php echo $mostrar['apellido']?></td>
                    <td><?php echo $mostrar['numTarjProf']?></td>
                    <td><?php echo $mostrar['direccion']?></td>
                    <td><?php echo $mostrar['telefono']?></td>
                    <td><?php echo $mostrar['correo']?></td>
                    <?php
                        $idtipousu= $mostrar['idtipousuario'];
                        $sqltipo="SELECT tipo FROM tipousuario WHERE idtipo = '$idtipousu' ";
                        $resultadotipusu=mysqli_query($mysqli,$sqltipo);
                        $show=mysqli_fetch_array($resultadotipusu);
                    ?>
                    <td><?php echo $show['tipo']?></td>
                    <td><h3><a href='eliminar.php?documento=<?php echo $mostrar['documento'];?>'><i class="bi bi-trash"></i></a></td></h3>
                </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </body>
</html>
