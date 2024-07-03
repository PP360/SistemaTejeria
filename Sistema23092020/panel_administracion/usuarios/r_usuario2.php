<?php
require_once '../../conexion.php';
$nombre_usuario=trim(htmlspecialchars($_POST['nombre_usuario']));
$usuario=trim(htmlspecialchars($_POST['usuario']));
$contrasena=trim(htmlspecialchars(sha1(md5($_POST['contrasena']))));
$turno=trim(htmlspecialchars($_POST['turno']));
$area=trim(htmlspecialchars($_POST['area']));
$existe=mysqli_query($conexion ,"SELECT usuario from usuarios where usuario='$usuario' OR contrasena='$contrasena'");
    if($nombre_usuario=="" or $usuario=="" or $contrasena=="" or $turno=="0" or $area=="0" )
{
    print "<script>alert(\"Complete todos los campos.\");window.location='usuarios.php';</script>";
}
    elseif(mysqli_num_rows($existe)>0)
    {
         print "<script>alert(\"El usuario o la contraseña ya existen.\");window.location='usuarios.php';</script>";
    }

else
{
$sql="insert into usuarios (nombre_usuario, usuario, contrasena, turno, id_area) values('$nombre_usuario','$usuario','$contrasena','$turno','$area')";
$insert=mysqli_query($conexion,$sql) or die ("Error al registrar al usuario");
mysqli_close($conexion);
header("Location: usuarios.php");
}

?>