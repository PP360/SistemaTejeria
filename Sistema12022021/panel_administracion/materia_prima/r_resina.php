<?php
require '../conexion.php';
$nombre=trim(htmlspecialchars($_POST['nombre']));
$unidad_medida=trim(htmlspecialchars($_POST['unidad_medida']));
$precio=trim(htmlspecialchars($_POST['precio']));
$existe="SELECT nombre FROM resina WHERE nombre='$nombre'";
$resina=mysqli_query($conexion,$existe);
$filas=mysqli_num_rows($resina);
    if($filas>0)
    {
         print "<script>alert(\"La resina ya existe registrada.\");window.location='resina.php';</script>";
    }
else
{
$sql="insert into resina (nombre, unidad_medida, precio) values('$nombre','$unidad_medida','$precio')";
$insert=mysqli_query($conexion,$sql) or die ("Error al registrar la resina");
mysqli_close($conexion);
header("Location: resina.php");
}
?>