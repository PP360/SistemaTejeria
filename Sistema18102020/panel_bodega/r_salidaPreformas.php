<?php
require 'conexion.php';
$numero=$_POST['numero'];
$gramaje=$_POST['gramaje'];
$cantidad=$_POST['cantidad'];
$tapas = $_POST['tapas'];
$entrega=$_POST['entrega'];
$recibio=$_POST['recibe'];

if ($gramaje=="0" or $cantidad=="" or $entrega=="0" or $recibio=="0" or $tapas == "0")
{
    print "<script>alert(\"Complete todos los campos.\");window.location='salida_preforma.php';</script>";
}
else
{
    // Revisar el inventario de preformas para comprobar existencia
    $inventario="SELECT cantidad FROM inventario_preformas WHERE id_preforma='$gramaje'";
    $inven=mysqli_query($conexion,$inventario);

    // Revisar existencia de tapas en el inventario
    $tapasInventario = mysqli_query($conexion, "SELECT cantidad from inventario_tapas WHERE id_tapa = $tapas");
    $tapasInventario = mysqli_fetch_array($tapasInventario);
    $tapasInventario = $tapasInventario['cantidad'];

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
        else if ($tapasInventario < $cantidad){
            print "<script>alert(\"No hay suficientes tapas en el inventario.\");window.location='principal.php';</script>";
        }
        else
        {
//            mysqli_begin_transaction($conexion, MYSQLI_TRANS_START_READ_WRITE);
//            try{
                // Entrega de preformas
                $sql="insert into entrega_preformas (id_usuarioEntrega, id_usuarioRecibe) values('$entrega','$recibio')";
                $insert=mysqli_query($conexion,$sql) or die ("Error al registrar la entrega");
                $sql2="INSERT INTO detalle_entregapreformas(id_entregaPreformas,id_preforma,cantidad) values('$numero','$gramaje','$cantidad')";
                $insert2=mysqli_query($conexion, $sql2) or die ("Error al registrar el detalle de entrega");
                $actualizar="UPDATE inventario_preformas SET cantidad=cantidad-'$cantidad' WHERE id_preforma='$gramaje'";
                $actu=mysqli_query($conexion,$actualizar) or die ("Error al actualizar la cantidad");

                // Entrega de tapas                
                mysqli_query($conexion, "INSERT INTO detalle_entregatapas (id_entregapreformas, id_tapas, cantidad) VALUES  ($numero, $tapas, $cantidad)");
                mysqli_query($conexion, "UPDATE inventario_tapas SET cantidad = cantidad - $cantidad WHERE id_tapa = $tapas");

//                mysqli_commit();
//            }catch(Exception $e){
//                mysqli_rollback();
//                echo "Ha ocurrido un error ", $e->getMessage();
//            }

            mysqli_close($conexion);
            header("Location: salida_preforma.php");
        }
    }
}
?>