<?php
require '../conexion.php';
$id=trim(htmlspecialchars($_POST['id']));
$tipo=trim(htmlspecialchars($_POST['nombre']));
$unidad=trim(htmlspecialchars($_POST['unidad_medida']));
$precio=trim(htmlspecialchars($_POST['precio']));
$sql="UPDATE resina SET nombre='$nombre', unidad_medida='$unidad_medida', precio='$precio' WHERE id_resina='$id'";
$insert=mysqli_query($conexion,$sql) or die ("Error al actualizar la resina");
mysqli_close($conexion);
header("Location: resina.php");

?>