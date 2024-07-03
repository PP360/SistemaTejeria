<?php
require '../conexion.php';
$id=base64_decode($_GET['id']);
$sql="DELETE FROM botellas WHERE id_botella='$id'";
$insert=mysqli_query($conexion,$sql) or die ("Error al eliminar la botella");
mysqli_close($conexion);
header("Location: botella.php");
?>