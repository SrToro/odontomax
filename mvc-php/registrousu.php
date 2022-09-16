<?php
  
  require_once("db/connection.php");

?>


<?php
    // $control = "SELECT * From tip_user WHERE id_tip_user >= 2";
    // $query=mysqli_query($mysqli,$control);
    // $fila=mysqli_fetch_assoc($query);
?>



<?php
    if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
    {
        $cedula=    $_POST['documento'];
        $clave=     $_POST['contrasena'];
        $nombre=    $_POST['nombre'];
        $apellido=  $_POST['apellido'];
        $direccion= $_POST['direccion'];
        $telefono=  $_POST['telefono'];
        $correo=    $_POST['correo'];
        

        $validar ="SELECT * FROM usuario WHERE documento='$cedula' or correo='$correo'";
        $queryi=mysqli_query($mysqli,$validar);
        $fila1=mysqli_fetch_assoc($queryi);
    
       if ($fila1) {
           echo '<script>alert ("DOCUMENTO O USUARIO EXISTEN //CAMBIELOS//");</script>';
           echo '<script>windows.location="registrousu.php"</script>';
       }
        else if ($cedula=="" || $nombre=="" || $correo=="" || $clave=="" || $apellido=="" || $direccion=="")
        {
            echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
           echo '<script>windows.location="registrousu.php"</script>';
        }

        else
        {
           $insertsql="INSERT INTO usuario(documento,contrasena,nombre,apellido,numTarjProf,direccion,telefono,correo,idtipousuario) VALUES('$cedula','$clave','$nombre','$apellido',NULL,'$direccion','$telefono','$correo','3')";
           mysqli_query($mysqli,$insertsql);
           echo '<script>alert (" Registro Exitoso, Gracias");</script>';
           echo '<script>window.location="index.html"</script>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="controller/image/iconoventana.png" type="image/x-icon">
    <link rel="stylesheet" href="controller/css/style.css">
    <title>Registro paciente OdontoMax</title>
    
</head>
<body>
    <div class="login-box">
        <img src="controller/image/iconoiniciodesesion.jpg " class="avatar" alt="Imagen Avar">
               
        <form method="POST" name="formreg" autocomplete="off">
            <label for="usuario"> REGISTRO DE USUARIOS </label>

            <input type="number" name="documento" placeholder="Ingrese Documento Identidad" >
            <input type="password" name="contrasena" placeholder="Ingrese Contraseña" >
            <input type="text" name="nombre" placeholder="Ingrese Nombres Completos" >
            <input type="text" name="apellido" placeholder="Ingrese Apellidos Completos" >
            <input type="text" name="correo" placeholder="Ingrese su correo" >
            <input type="text" name="direccion" placeholder="Ingrese su direccion" >
            <input type="number" name="telefono" placeholder="Ingrese su telefono" >

            <input style="margin-bottom: 5px;" type="submit" name="validar" value="Registrarme">
            <a href="../mvc-php/index.html">Volver Pagina Principal</a>
            <input type="hidden" name="MM_insert" value="formreg">
        </form>


    
    </div>
</body>
</html>