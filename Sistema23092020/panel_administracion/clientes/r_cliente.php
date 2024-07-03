<?php
if(isset($_POST['nombre_cliente'])=="" or isset($_POST['direccion'])=="" )
{
    echo "Acceso Denegado";
}
else
{
require '../conexion.php';
$nombre_cliente=trim(htmlspecialchars($_POST['nombre_cliente']));
$rfc=trim(htmlspecialchars($_POST['rfc']));
$direccion= trim(htmlspecialchars($_POST['direccion']));
$email=trim(htmlspecialchars($_POST['email']));
$telefono=htmlspecialchars($_POST['telefono']);
$celular=trim(htmlspecialchars($_POST['celular']));
$existe="SELECT nombre_cliente FROM clientes WHERE nombre_cliente='$nombre_cliente'";
$cliente=mysqli_query($conexion,$existe);
$filas=mysqli_num_rows($cliente);
    if($filas>0)
    {
         print "<script>alert(\"El cliente ya existe registrado.\");window.location='clientes.php';</script>";
    }
else
{
$sql="INSERT INTO clientes (nombre_cliente, rfc, direccion, email, telefono, celular) VALUES ('$nombre_cliente','$rfc','$direccion','$email','$telefono','$celular')";
$insert=mysqli_query($conexion,$sql) or die ("Error al registrar al cliente");
mysqli_close($conexion);
header("Location: clientes.php");
}
}
?>