<?php
require '../conexion.php';

session_start();
if(!isset($_SESSION['contadorTapas'])){$_SESSION['contadorTapas'] = 0;}

mysqli_set_charset($conexion, "utf8");
echo $_SESSION['contadorTapas'];
 	for($i = 0;$i<$_SESSION['contadorTapas'];$i++){
        if ($_SESSION['Tapas'][$i]!=0)
        {
        $idtapa=$_SESSION['Tapas'][$i];
        $cantidad=$_SESSION['cantidadTapas'][$i];
        $cajas=$_SESSION['cajas'][$i];
        $codigo=$_SESSION['codigoTapas'][$i];
        $proveedor=$_SESSION['proveedorTapas'][$i];
        $flete=$_SESSION['flete'][$i];
        
        echo "Flete: ".$flete." ";
        $peticion = "SELECT * FROM tapas WHERE id_tapa=".$_SESSION['Tapas'][$i]."";
	    $resultado = mysqli_query($conexion, $peticion);
	    while($fila = mysqli_fetch_array($resultado)) {
	    $total=$_SESSION['cantidadTapas'][$i]*$fila['precio']; 
            }      
        $preformas="SELECT cantidad FROM inventario_tapas WHERE id_tapa='$idtapa'";
        $pre=mysqli_query($conexion,$preformas);
        $filas=mysqli_num_rows($pre);
        if($filas>0)
        {
        $actualizar="UPDATE inventario_tapas SET cantidad=cantidad+'$cantidad' WHERE id_tapa='$idtapa'";
        $actu=mysqli_query($conexion,$actualizar);
        $peticion2 = "INSERT INTO compra_tapas(codigo_compraTapas, id_proveedor, total_compra,flete) VALUES ('$codigo','$proveedor','$total','$flete')";
        echo $peticion2;
        $resultado2 = mysqli_query($conexion, $peticion2);
        $peticion3 = "INSERT INTO detalle_compratapas(codigo_compraTapas, id_tapa, cantidad,cajas) VALUES ('$codigo','$idtapa','$cantidad','$cajas')";
         //echo $peticion3;
        $resultado3 = mysqli_query($conexion, $peticion3);
        }
        else
        {
        $peticion = "INSERT INTO inventario_tapas(id_tapa,cantidad) VALUES ('$idtapa','$cantidad')";
        $resultado = mysqli_query($conexion, $peticion);
        $peticion2 = "INSERT INTO compra_tapas(codigo_compraTapas, id_proveedor, total_compra,flete) VALUES ('$codigo','$proveedor','$total','$flete')";
        echo $peticion2;
            $resultado2 = mysqli_query($conexion, $peticion2);
        $peticion3 = "INSERT INTO detalle_compratapas(codigo_compraTapas, id_tapa, cantidad,cajas) VALUES ('$codigo','$idtapa','$cantidad','$cajas')";
        $resultado3 = mysqli_query($conexion, $peticion3); 
        
        }
        }
    }
    
  
unset($_SESSION['contadorTapas']);
unset($_SESSION['Tapas']);
unset($_SESSION['cantidadTapas']);
unset($_SESSION['codigoTapas']);
unset($_SESSION['proveedorTapas']);
unset($_SESSION['cajas']);
unset($_SESSION['flete']);
    
mysqli_close($conexion);

header("Location: comprar_tapas.php")
?>
