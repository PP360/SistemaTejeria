<?php
require '../conexion.php';
$rfc=trim(htmlspecialchars($_POST['rfc']));
$nombre_fiscal=trim(htmlspecialchars($_POST['nombre_fiscal']));
$nombre_contacto=trim(htmlspecialchars($_POST['nombre_contacto']));
$direccion=trim(htmlspecialchars($_POST['direccion']));
$email=trim(htmlspecialchars($_POST['email']));
$telefono=trim(htmlspecialchars($_POST['telefono']));
$celular=trim(htmlspecialchars($_POST['celular']));
$otro=trim(htmlspecialchars($_POST['otro']));
$existe="SELECT nombre_fiscal FROM proveedores WHERE nombre_fiscal='$nombre_fiscal'";
$proveedor=mysqli_query($conexion,$existe);
$filas=mysqli_num_rows($proveedor);
    if($filas>0)
    {
         print "<script>alert(\"El proveedor ya existe registrado.\");window.location='proveedores.php';</script>";
    }
else
{
$sql="insert into proveedores (rfc, nombre_fiscal, nombre_contacto, direccion, email, telefono, celular,otro) values('$rfc','$nombre_fiscal','$nombre_contacto','$direccion','$email','$telefono','$celular','$otro')";
$insert=mysqli_query($conexion,$sql) or die ("Error al registrar al proveedor");
mysqli_close($conexion);
header("Location: proveedores.php");
}
?>