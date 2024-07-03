<?php
require '../conexion.php';
$tamano=trim(htmlspecialchars($_POST['tamano']));
$unidad_medida=trim(htmlspecialchars($_POST['unidad_medida']));
$precio=trim(htmlspecialchars($_POST['precio']));
$presentacion=trim(htmlspecialchars($_POST['presentacion']));
$millarCaja=trim(htmlspecialchars($_POST['millarxcaja']));
$existe="SELECT tamano FROM tapas WHERE tamano='$tamano'";
$tapa=mysqli_query($conexion,$existe);
$filas=mysqli_num_rows($tapa);
    if($filas>0)
    {
         print "<script>alert(\"La tapa ya existe registrada.\");window.location='tapas.php';</script>";
    }
else
{
$sql="insert into tapas (tamano, unidad_medida, precio,presentacion,millarcaja,preciomillar) values('$tamano','$unidad_medida','$precio','$presentacion',$millarCaja,'0')";
$insert=mysqli_query($conexion,$sql) or die ("Error al registrar la Tapa");
mysqli_close($conexion);
header("Location: tapas.php");
}
?>