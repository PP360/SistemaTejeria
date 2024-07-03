<?php
require '../conexion.php';
$tipo_cambio=trim(htmlspecialchars($_POST['tipo_cambio']));
$sql="UPDATE preformas SET tipo_cambio='$tipo_cambio'";
$insert=mysqli_query($conexion,$sql) or die ("Error al registrar el tipo de cambio");
mysqli_close($conexion);
header("Location: comprar_preformas.php");

?>