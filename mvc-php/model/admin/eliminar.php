<?php
include '../../db/connection.php';
$id = $_GET['documento'];
$eliminarusu="DELETE FROM usuario WHERE documento = '$id'";
$eliminar=mysqli_query($mysqli, $eliminarusu);

header("location:view_usu.php");
?>