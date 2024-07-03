<?php
require '../conexion.php';
$numero=$_POST['numero'];
$gramaje=$_POST['gramaje'];
$cantidad=$_POST['cantidad'];
$destino_preforma=$_POST['destino_preforma'];
$entrega=$_POST['entrega'];
$recibio=$_POST['recibe'];
$NumeroCaja=$_POST['NumeroCaja'];

if ($gramaje=="0" or $cantidad=="" or $entrega=="0" or $recibio=="0")
{
    print "<script>alert(\"Complete todos los campos.\");window.location='salida_preforma.php';</script>";

}
else
{
    $inventario="SELECT cantidad FROM inventario_preformas WHERE id_preforma='$gramaje'";
    $inven=mysqli_query($conexion,$inventario);
    $filas=mysqli_num_rows($inven);
    while($registro2 = mysqli_fetch_array($inven)){
        $cantidadInventario=$registro2['cantidad'];
        if ($cantidadInventario<$cantidad)
        {
            print "<script>alert(\"No hay suficiente existencias en el inventario.\");window.location='principal.php';</script>";
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
            $sql="INSERT INTO entrega_preformas (id_usuarioEntrega, id_usuarioRecibe) values('$entrega','$recibio')";
            $insert=mysqli_query($conexion,$sql) or die ("Error al registrar la entrega");
            $sql2="INSERT INTO detalle_entregapreformas(id_entregaPreformas,id_preforma,NumeroCaja,cantidad, tipo_botella) values('$numero','$gramaje','$NumeroCaja','$cantidad', '$destino_preforma')";
            $insert2=mysqli_query($conexion, $sql2) or die ("Error al registrar el detalle de entrega");
            $actualizar="UPDATE inventario_preformas SET cantidad=cantidad-'$cantidad' WHERE id_preforma='$gramaje'";
            $actu=mysqli_query($conexion,$actualizar) or die ("Error al actualizar la cantidad");
            mysqli_close($conexion);
            header("Location: salida_preforma.php");
        }



    }

}








?>
