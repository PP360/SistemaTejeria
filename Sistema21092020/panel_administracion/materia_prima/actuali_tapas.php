<?php
require '../conexion.php';
$id=trim(htmlspecialchars($_POST['id']));
$tamano=trim(htmlspecialchars($_POST['tamano']));
$unidad_medida=trim(htmlspecialchars($_POST['unidad_medida']));
$precio=trim(htmlspecialchars($_POST['precio']));
$sql="UPDATE tapas SET tamano='$tamano', unidad_medida='$unidad_medida', precio='$precio' WHERE id_tapa='$id'";
$insert=mysqli_query($conexion,$sql) or die ("Error al actualizar la tapa");
mysqli_close($conexion);
header("Location: tapas.php");

?>