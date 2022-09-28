
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE correo = '".$_SESSION['usuario']."' AND usuario.idtipousuario = tipousuario.idtipo";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>
<form method="POST">

    <tr>
    <span class="usuario"> Odontologo</span>
        <td colspan='2' align="center"><?php echo $usua['nombre'] ,' ',$usua['apellido']?></td>
        
    </tr>
<tr><br>
    <td colspan='2' align="center">
    
    
        <input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
     
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
    <title>ODONTOLOGO</title>
</head>
    <body>
        <section class="title">
            <h1>INTERFAZ  Odontologo <?php echo $usua['nombre'] ,' ',$usua['apellido']?> </h1>
            
        </section>
    
        <nav class="navegacion">
           
            <ul class="menu wrapper" >
    
                <li class="first-item">
                    <a href="agreg_usu.php">
                        <img src="img/analisis.png" alt="" class="imagen">
                        <span class="text-item">CREAR INFORME</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="img/usuario.png" alt="" class="imagen">
                        <span class="text-item">VER HISTORIAS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="img/historia.png" alt="" class="imagen">
                        <span class="text-item">CITAS ODONTOLOGICAS</span>
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
    
                <li>
                    <a href="#">
                    <img src="img/delete.png" alt="" class="imagen">
                        <span class="text-item">BORRAR USUARIO</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                
            </ul>
            
        </nav>
    </body>
</html>