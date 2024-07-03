<?php
require_once '../../conexion.php';
$id=trim(htmlspecialchars($_POST['id']));
$nombre_usuario=trim(htmlspecialchars($_POST['nombre_usuario']));
$usuario=trim(htmlspecialchars($_POST['usuario']));
$contrasena=trim(htmlspecialchars($_POST['contrasena']));
$turno=trim(htmlspecialchars($_POST['turno']));
$area=trim(htmlspecialchars($_POST['area']));
if ($contrasena=="")
{
    $sql="UPDATE usuarios SET nombre_usuario='$nombre_usuario', usuario='$usuario', turno='$turno', id_area='$area' WHERE id_usuario='$id'";
$insert=mysqli_query($conexion,$sql) or die ("Error al actualizar el usuario");
}
else
{
    $contra=sha1(md5($contrasena));
    $sql2="UPDATE usuarios SET contrasena='$contra' where id_usuario='$id'";
    $insert2=mysqli_query($conexion,$sql2);
}
mysqli_close($conexion);
header("location: usuarios.php");

?>
