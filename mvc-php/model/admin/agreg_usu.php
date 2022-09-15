
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
        <td colspan='2' align="center"><?php echo $usua['nombre'] ,' ',$usua['apellido']?></td>
    </tr>
<tr><br>
    <td colspan='2' align="center">
    
    
        <input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
        <input type="submit" formaction="../index.php" value="Regresar" />
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
    <title>taller</title>
</head>
    <body>
        <section class="title">
            <h1>FORMULARIO CREACION TIPO USUARIOS </h1>
        </section>
        <table class="centrar">
            <form method="POST" name="fanadd" autocomplete="off">
                <tr>
                    <td colspan="2">Tipos de Usuario</td>
                </tr>
                <tr>
                    <td>Identificador</td>
                    <td><input type="text"></td>
                </tr>
                
            </form>
            
        </table>
    
    </body>
</html>