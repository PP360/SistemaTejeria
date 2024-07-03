<?php
require '../conexion.php';
$id=trim(htmlspecialchars($_POST['id']));
$rfc=trim(htmlspecialchars($_POST['rfc']));
$nombre_fiscal=trim(htmlspecialchars($_POST['nombre_fiscal']));
$nombre_contacto=trim(htmlspecialchars($_POST['nombre_contacto']));
$direccion=trim(htmlspecialchars($_POST['direccion']));
$email=trim(htmlspecialchars($_POST['email']));
$telefono=trim(htmlspecialchars($_POST['telefono']));
$celular=trim(htmlspecialchars($_POST['celular']));
$otro=trim(htmlspecialchars($_POST['otro']));

$sql="UPDATE proveedores SET rfc='$rfc', nombre_fiscal='$nombre_fiscal', nombre_contacto='$nombre_contacto', direccion='$direccion', email='$email', telefono='$telefono', celular='$celular', otro='$otro' WHERE id_proveedor='$id'";

$insert=mysqli_query($conexion,$sql) or die ("Error al actualizar el proveedor");
mysqli_close($conexion);
header("Location: proveedores.php");

?>
