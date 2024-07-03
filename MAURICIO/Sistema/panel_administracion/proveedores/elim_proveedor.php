<?php
require '../conexion.php';
$id=base64_decode($_GET['id']);
$sql="DELETE FROM proveedores WHERE id_proveedor='$id'";
$insert=mysqli_query($conexion,$sql) or die ("Error al eliminar al proveedor");
mysqli_close($conexion);
header("Location: proveedores.php");
?>