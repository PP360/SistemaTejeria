<?php
if (isset($_GET['id'])==0)
{
    echo "Acceso Denegado";
}
else
{
require '../conexion.php';
$id=base64_decode($_GET['id']);
$sql="DELETE FROM clientes WHERE id_cliente='$id'";
$insert=mysqli_query($conexion,$sql) or die ("Error al eliminar al cliente");
mysqli_close($conexion);
header("Location: clientes.php");
}
?>