<?php
require '../conexion.php';
session_start();
if(!isset($_SESSION['contadorPreformas'])){$_SESSION['contadorPreformas'] = 0;}

    mysqli_set_charset($conexion, "utf8");
for($i = 0;$i<$_SESSION['contadorPreformas'];$i++){
    if ($_SESSION['Preforma'][$i]!=0)
    {
        $idpreforma=$_SESSION['Preforma'][$i]; 
        $cantidad=$_SESSION['cantidadPreforma'][$i];
        $codigo=$_SESSION['codigoPreforma'][$i];
        $proveedor=$_SESSION['proveedorPreforma'][$i];
        $cajas=$_SESSION['cajasPreformas'][$i];
        $flete=$_SESSION['flete'][$i];
        $peticion = "SELECT * FROM preformas WHERE id_preforma=".$_SESSION['Preforma'][$i]."";
        $resultado = mysqli_query($conexion, $peticion);
        while($fila = mysqli_fetch_array($resultado)) {
            $total=($_SESSION['cantidadPreforma'][$i]*$fila['usd']/1000*$fila['tipo_cambio']);
        }      
        $preformas="SELECT cantidad FROM inventario_preformas WHERE id_preforma='$idpreforma'";
        $pre=mysqli_query($conexion,$preformas);
        $filas=mysqli_num_rows($pre);
        if($filas>0)
        {
            $actualizar="UPDATE inventario_preformas SET cantidad=cantidad+'$cantidad' WHERE id_preforma='$idpreforma'";
            $actu=mysqli_query($conexion,$actualizar);
            $peticion2 = "INSERT INTO compra_preformas(codigo_compraPreformas,id_proveedor,total_compra,flete) VALUES ('$codigo','$proveedor','$total','$flete')";
            $resultado2 = mysqli_query($conexion, $peticion2);
            $peticion3 = "INSERT INTO detalle_comprapreformas(id_preforma,codigo_compraPreformas,cantidad,cajas) VALUES ('$idpreforma','$codigo','$cantidad','$cajas')";
            $resultado3 = mysqli_query($conexion, $peticion3);
        }
        else
        {
            $peticion = "INSERT INTO inventario_preformas(id_preforma,cantidad) VALUES ('$idpreforma','$cantidad')";
            $resultado = mysqli_query($conexion, $peticion);
            $peticion2 = "INSERT INTO compra_preformas(codigo_compraPreformas,id_proveedor,total_compra,flete) VALUES ('$codigo','$proveedor','$total','$flete')";
            $resultado2 = mysqli_query($conexion, $peticion2);
            $peticion3 = "INSERT INTO detalle_comprapreformas(id_preforma,codigo_compraPreformas,cantidad,cajas) VALUES ('$idpreforma','$codigo','$cantidad','$cajas')";
            $resultado3 = mysqli_query($conexion, $peticion3);
        }

    }  

}

unset($_SESSION['contadorPreformas']);
unset($_SESSION['Preforma']);
unset($_SESSION['cantidadPreforma']);
unset($_SESSION['codigoPreforma']);
unset($_SESSION['proveedorPreforma']);
unset($_SESSION['cajas']);
unset($_SESSION['flete']);


mysqli_close($conexion);
header("Location: comprar_preformas.php")

?>
