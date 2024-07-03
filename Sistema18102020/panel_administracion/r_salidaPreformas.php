<?php
require_once("../conexion.php");
$preforma=$_POST['gramaje'];
$elaboradas=$_POST['elaborada'];
$idRecibe=$_POST['idRecibe'];
$entrega=$_POST['entrega'];
$estatus=$_POST['estatus'];

$preformas="SELECT cantidad FROM inventario_preformas WHERE id_preforma='$preforma'";
$pre=mysqli_query($conexion,$preformas);
$filas=mysqli_num_rows($pre);
if($filas>0)
{
    $actualizar="UPDATE inventario_preformas SET cantidad=cantidad+'$elaboradas' WHERE id_preforma='$preforma'";
    $actu=mysqli_query($conexion,$actualizar);
    $produccion="INSERT INTO produccion_preformas(id_entregaResina,id_usuarioProduce,estatus) VALUES('$entrega','$idRecibe','$estatus')";
    $produc=mysqli_query($conexion,$produccion);
}
else
{
    $sql="INSERT INTO inventario_preformas (id_preforma,cantidad) VALUES('$preforma','$elaboradas')";
    $query=mysqli_query($conexion,$sql);
     $produccion="INSERT INTO produccion_preformas(id_entregaResina,id_usuarioProduce,estatus) VALUES('$entrega','$idRecibe','$estatus')";
    $produc=mysqli_query($conexion,$produccion);

}

mysqli_close($query);
header("Location: salida_preformas.php");
?>