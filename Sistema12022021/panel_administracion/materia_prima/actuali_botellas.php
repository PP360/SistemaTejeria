<?php
require '../conexion.php';
$id=trim(htmlspecialchars($_POST['id']));
$tipo=trim(htmlspecialchars($_POST['tipo_botella']));
$unidad_medida=trim(htmlspecialchars($_POST['unidad_medida']));
$sql="UPDATE botellas SET tipo_botella='$tipo', unidad_medida='$unidad_medida' WHERE id_botella='$id'";
$insert=mysqli_query($conexion,$sql) or die ("Error al actualizar la botella");
mysqli_close($conexion);
header("Location: botella.php");

?>