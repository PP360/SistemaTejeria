
<?php
if(isset($_POST['id'])==0)
{
    echo "Acceso Denegado";
}
else
{
require '../conexion.php';
$id=$_POST['id'];
$nombre_cliente=trim(htmlspecialchars($_POST['nombre_cliente']));
$direccion=trim(htmlspecialchars($_POST['direccion']));
$email=trim(htmlspecialchars($_POST['email']));
$telefono=trim(htmlspecialchars($_POST['telefono']));
$celular=trim(htmlspecialchars($_POST['celular']));
$rfc=trim(htmlspecialchars($_POST['rfc']));

$sql="UPDATE clientes SET nombre_cliente='$nombre_cliente', rfc='$rfc', direccion='$direccion', email='$email', telefono='$telefono', celular='$celular' WHERE id_cliente='$id'";

$insert=mysqli_query($conexion,$sql) or die ("Error al actualizar el cliente");
mysqli_close($conexion);
header("Location: clientes.php");
}
?>