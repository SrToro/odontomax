
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE correo = '".$_SESSION['usuario']."' AND usuario.idtipousuario = tipousuario.idtipo";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "fanadd")) 
    { 
        $tp = $_POST ['TIP_USU'];
        $sqladd = "SELECT * FROM tipousuario WHERE tipo ='$tp' ";
        $query = mysqli_query($mysqli,$sqladd);
        $fila = mysqli_fetch_assoc($query);
        if($fila)
            {
             echo '<script>alert (" El usuario ya existe ");</script>';
             echo '<script>window.location="agreg_usu.php"</script>';
            }
        elseif ($_POST['TIP_USU'] == "")
            {
             echo '<script>alert (" Existen campos vacios  ");</script>';
             echo '<script>window.location="agreg_usu.php"</script>';
            }
        else
            {
             $tp = $_POST ['TIP_USU'];
             $sqladd = " INSERT INTO tipousuario(tipo) values ('$tp')";
             $query = mysqli_query($mysqli,$sqladd);   
             echo '<script>alert (" Registro Exitoso!!  ");</script>';
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
    <title>Creacion Tipo de Usuario</title>
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
                    <td><input type="text" readonly></td>
                </tr>
                
                <tr>
                    <!--// lowercase -->
                    <td>Tipo Usuario</td>
                    <td><input type="text" name="TIP_USU" placeholder="Ingrese tipo usuario" style="text-transform: uppercase;"></td>
                </tr>
                
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="btnadd" value="Guardar"></td>
                    <input type="hidden" name="btnguardar" value="fanadd">
                </tr>
                
                
            </form>
            
        </table>
    
    </body>
</html>