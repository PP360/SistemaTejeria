<?php 
require 'conexion.php';
$numero=$_POST['numero'];
$nombre=$_POST['nombre'];
$cantidad=$_POST['cantidad'];
$entrega=$_POST['entrega'];
$recibio=$_POST['recibe'];
if ($nombre=="0" or $cantidad=="" or $entrega=="0" or $recibio=="0")
{
    print "<script>alert(\"Complete todos los campos.\");window.location='salida_resina.php';</script>";
}
else
{
$inventario="SELECT cantidad FROM  inventario_resina WHERE id_resina='$nombre'";
$inven=mysqli_query($conexion,$inventario);
while($registro2= mysqli_fetch_array($inven)){
    $cantidadInventario=$registro2['cantidad'];
    if($cantidadInventario<$cantidad)
    {
        print "<script>alert(\"No hay suficiente existencia en el inventario.\");window.location='principal.php'; </script>";
    }
    elseif($cantidadInventario<=20000 && $cantidadInventario>0)
    {
        print "<script>alert(\"Con baja existencia en el inventario.\");window.location='principal.php';</script>";
        
    }
    elseif ($cantidadInventario<=0)
    {
        print "<script>alert(\"Sin existencias en el inventario.\");window.location='principal.php';</script>";
    }
    else
    {
        $sql="insert into entrega_resina (id_usuarioEntrega, id_usuarioRecibe) values('$entrega','$recibio')";
        $insert=mysqli_query($conexion,$sql) or die ("Error al registrar la entrega");
        $sql2="INSERT INTO detalle_entregaresina(id_entregaResina, id_resina, cantidad) values('$numero','$nombre','$cantidad')";
        $insert2=mysqli_query($conexion, $sql2) or die ("Error al registrar el detalle de entrega");
        $actualizar="UPDATE inventario_resina SET cantidad=cantidad-'$cantidad' WHERE id_resina='$nombre'";
        $actu=mysqli_query($conexion,$actualizar) or die ("Error al actualizar la cantidad");
        mysqli_close($conexion);
        header("Location: salida_resina.php");
    }
}

}



?>