<?php
require '../conexion.php';
$id=base64_decode($_GET['id']);
$sql="DELETE FROM resina WHERE id_resina='$id'";
$insert=mysqli_query($conexion,$sql) or die ("Error al eliminar la resina");
mysqli_close($conexion);
header("Location: resina.php");
?>