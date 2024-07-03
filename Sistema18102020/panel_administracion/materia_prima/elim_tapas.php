<?php
require '../conexion.php';
$id=base64_decode($_GET['id']);
$sql="DELETE FROM tapas WHERE id_tapa='$id'";
$insert=mysqli_query($conexion,$sql) or die ("Error al eliminar la Tapa");
mysqli_close($conexion);
header("Location: tapas.php");
?>