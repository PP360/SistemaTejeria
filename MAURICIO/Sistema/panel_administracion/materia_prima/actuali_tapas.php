<?php
require '../conexion.php';
$id=trim(htmlspecialchars($_POST['id']));
$tamano=trim(htmlspecialchars($_POST['tamano']));
$unidad_medida=trim(htmlspecialchars($_POST['unidad_medida']));
$precio=trim(htmlspecialchars($_POST['precio']));
$millarCaja=trim(htmlspecialchars($_POST['millarxcaja']));
$presentacion=trim(htmlspecialchars($_POST['presentacion']));
$sql="UPDATE tapas SET tamano='$tamano', unidad_medida='$unidad_medida', precio='$precio',millarcaja='$millarCaja',Presentacion='$presentacion' WHERE id_tapa='$id'";
echo $sql;
$insert=mysqli_query($conexion,$sql) or die ("Error al actualizar la tapa");
mysqli_close($conexion);
header("Location: tapas.php");

?>