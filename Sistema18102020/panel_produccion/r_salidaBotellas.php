<?php
require ("conexion.php");
$entrega=$_POST['entrega'];
$botella=$_POST['botella'];
$merma = $_POST['cant_merma'];
$pendiente=$_POST['cant_pendiente'];
$elaboradas=$_POST['elaborada'];
$estatus=$_POST['estatus'];
$unidad="Pza";
$idRecibe=$_POST['idRecibe'];
$tipo_preforma=$_POST['tipo_pre'];

$botellas="SELECT cantidad FROM inventario_botellas WHERE tipo_botella='$botella'";
$id_botella="SELECT id_botella FROM botellas WHERE tipo_botella='$botella'";

$bote=mysqli_query($conexion,$botellas);
$filas=mysqli_num_rows($bote);

//mysqli_begin_transaction($conexion, MYSQLI_TRANS_START_READ_WRITE);

//try{
    if($filas>0)
    {
        $actualizar="UPDATE inventario_botellas SET cantidad=cantidad+'$elaboradas' WHERE tipo_botella='$botella'";
        $actu=mysqli_query($conexion,$actualizar);
        //$produccion="INSERT INTO produccion_botella(id_entregaPreformas,id_usuarioProduce,estatus, merma, devolucion, elaboradas) VALUES('$entrega','$idRecibe','$estatus', '$merma', '$pendiente', '$elaboradas')";
		//$produccion="INSERT INTO produccion_botella(id_entregaPreformas,id_tipobotella,id_usuarioProduce,estatus, merma, devolucion, elaboradas) VALUES('$entrega','$botella','$idRecibe','$estatus', '$merma', '$pendiente', '$elaboradas')";
		$produccion="INSERT INTO produccion_botella(id_entregaPreformas,id_tipobotella,id_usuarioProduce,estatus, merma, devolucion, elaboradas) VALUES('$entrega','$botella','$idRecibe','$estatus', '$merma', '$pendiente', '$elaboradas')";
        $produc=mysqli_query($conexion,$produccion);
        $id_preConsulta="SELECT id_preforma FROM detalle_entregapreformas WHERE id_entregapreformas=$tipo_preforma";
        
        $devolucionPreforma="UPDATE inventario_preformas set cantidad=cantidad+$pendiente WHERE id_preforma=(SELECT id_preforma FROM detalle_entregapreformas WHERE id_entregapreformas=$tipo_preforma)";
        $devol=mysqli_query($conexion,$devolucionPreforma);
    }
    else
    {
        $sql="INSERT INTO inventario_botellas (tipo_botella,unidad_medida,cantidad) VALUES('$botella','$unidad','$elaboradas')";
        $query=mysqli_query($conexion,$sql);
        $produccion="INSERT INTO produccion_botella(id_entregaPreformas,id_usuarioProduce,estatus, merma, devolucion, elaboradas) VALUES('$entrega','$idRecibe','$estatus', '$merma', '$pendiente', '$elaboradas')";
        $produc=mysqli_query($conexion,$produccion);
        $devolucionPreforma="UPDATE inventario_preformas set cantidad=cantidad+$pendiente WHERE id_preforma=(SELECT id_preforma FROM detalle_entregapreformas WHERE id_entregapreformas=$tipo_preforma)";
        $devol=mysqli_query($conexion,$devolucionPreforma);
    }

    // Tapas
    if ($pendiente > 0){
        $entrega = mysqli_query($conexion, "SELECT id_tapas FROM detalle_entregatapas WHERE id_entregapreformas = $entrega");
        $entrega = mysqli_fetch_array($entrega);
       $id_tapas = $entrega['id_tapas'];

       mysqli_query($conexion, "UPDATE inventario_tapas SET cantidad = cantidad + $pendiente WHERE id_tapa = $id_tapas");
   }

  //  mysqli_commit($conexion);
//}catch(Exception $e){
    
    //echo "Ha ocurrido una excepción no controlada: ", $e->getMessage();
   // mysqli_rollback($conexion);
//}

mysqli_close($query);
header("Location: salida_botellas.php");
 
?>