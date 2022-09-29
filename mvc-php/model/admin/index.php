
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
        <h1><?php echo $usua['nombre'] ,' ',$usua['apellido']?></h1>
        <input style="border-radius:16px;height:50px; height:40px; width:100px" type="submit" value="Cerrar sesión" name="btncerrar" />
    </div>
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
    <link rel="shortcut icon" href="../../controller/image/iconoventana.png" type="image/x-icon">
    <link rel="stylesheet" href="estilos.css">
    <title>Administrador</title>
</head>
    <body>
        <div class="tittle-bg">
            <div class="title">
                <h1>MENÚ ADMINISTRADOR</h1> 
            </div>
        </div>
    
        <nav class="navegacion">
           
            <ul class="menu wrapper" >
    
                <li class="first-item">
                    <a href="agreg_usu.php">
                        <img src="img/analisis.png" alt="" class="imagen">
                        <span class="text-item">CREAR USUARIO</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="view_usu.php">
                        <img src="img/usuario.png" alt="" class="imagen">
                        <span class="text-item">VER USUARIOS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="img/historia.png" alt="" class="imagen">
                        <span class="text-item">VER HISTORIAS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="img/vercita.png" alt="" class="imagen">
                        <span class="text-item">VER CITAS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
            </ul>
            
        </nav>
    </body>
</html>