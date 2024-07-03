<?php
require ("conexion.php");
$botella=$_POST['botella'];
$elaboradas=$_POST['elaborada'];
$unidad="Pza";
$idRecibe=$_POST['idRecibe'];
$entrega=$_POST['entrega'];
$estatus=$_POST['estatus'];

$botellas="SELECT cantidad FROM inventario_botellas WHERE tipo_botella='$botella'";
$bote=mysqli_query($conexion,$botellas);
$filas=mysqli_num_rows($bote);
if($filas>0)
{
    $actualizar="UPDATE inventario_botellas SET cantidad=cantidad+'$elaboradas' WHERE tipo_botella='$botella'";
    $actu=mysqli_query($conexion,$actualizar);
    $produccion="INSERT INTO produccion_botella(id_entregaPreformas,id_usuarioProduce,estatus) VALUES('$entrega','$idRecibe','$estatus')";
    $produc=mysqli_query($conexion,$produccion);
}
else
{
    $sql="INSERT INTO inventario_botellas (tipo_botella,unidad_medida,cantidad) VALUES('$botella','$unidad','$elaboradas')";
    $query=mysqli_query($conexion,$sql);
    $produccion="INSERT INTO produccion_botella(id_entregaPreformas,id_usuarioProduce,estatus) VALUES('$entrega','$idRecibe','$estatus')";
    $produc=mysqli_query($conexion,$produccion);

}

mysqli_close($query);
header("Location: salida_botellas.php");
?>