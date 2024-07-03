<?php
require_once '../../conexion.php';
$id=base64_decode($_GET['id']);
$sql="DELETE FROM usuarios WHERE id_usuario='$id'";
$insert=mysqli_query($conexion,$sql) or die ("Error al eliminar al usuario");
mysqli_close($conexion);
header("Location: usuarios.php");
?>