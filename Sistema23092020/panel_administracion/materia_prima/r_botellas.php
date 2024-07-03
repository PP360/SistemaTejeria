<?php
require '../conexion.php';
$tipo=trim(htmlspecialchars($_POST['tipo_botella']));
$unidad=trim(htmlspecialchars($_POST['unidad_medida']));
$existe="SELECT tipo_botella FROM botellas WHERE tipo_botella='$tipo'";
$tapa=mysqli_query($conexion,$existe);
$filas=mysqli_num_rows($tapa);
    if($filas>0)
    {
         print "<script>alert(\"La botella ya existe registrada.\");window.location='botella.php';</script>";
    }
else
{
$sql="insert into botellas (tipo_botella,unidad_medida) values('$tipo','$unidad')";
$insert=mysqli_query($conexion,$sql) or die ("Error al registrar la botella");
mysqli_close($conexion);
header("Location: botella.php");
}
?>