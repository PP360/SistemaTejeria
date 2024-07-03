<?php
if (isset($_GET['id'])==0)
{
    echo "Acceso Denegado";
}
else
{

require '../conexion.php';
$id=base64_decode($_GET['id']);
$sql="DELETE FROM preformas WHERE id_preforma='$id'";
$insert=mysqli_query($conexion,$sql) or die ("Error al eliminar la preforma");
mysqli_close($conexion);
header("Location: preformas.php");

}
?>