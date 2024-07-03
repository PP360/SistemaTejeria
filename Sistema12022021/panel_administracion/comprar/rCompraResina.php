<?php
require '../conexion.php';

session_start();
if(!isset($_SESSION['contadorResina'])){$_SESSION['contadorResina'] = 0;}

mysqli_set_charset($conexion, "utf8");
 	for($i = 0;$i<$_SESSION['contadorResina'];$i++){
        if ($_SESSION['Resina'][$i]!=0)
        {
        $idresina=$_SESSION['Resina'][$i];
        $cantidad=$_SESSION['cantidadResina'][$i];
        $precio=$_SESSION['precioResina'][$i];
        $codigo=$_SESSION['codigoResina'][$i];
        $proveedor=$_SESSION['proveedorResina'][$i];
        $peticion = "SELECT * FROM resina WHERE id_resina=".$_SESSION['Resina'][$i]."";
	    $resultado = mysqli_query($conexion, $peticion);
	    while($fila = mysqli_fetch_array($resultado)) {
	    $total=$_SESSION['cantidadResina'][$i]*$fila['precio'];
            }      
        $preformas="SELECT cantidad FROM inventario_resina WHERE id_resina='$idresina'";
        $pre=mysqli_query($conexion,$preformas);
        $filas=mysqli_num_rows($pre);
        if($filas>0)
        {
        $actualizar="UPDATE inventario_resina SET cantidad=cantidad+'$cantidad' WHERE id_resina='$idresina'";
        $actu=mysqli_query($conexion,$actualizar);
        $peticion2 = "INSERT INTO compra_resina(codigo_compraResina, id_proveedor, total_compra) VALUES ('$codigo','$proveedor','$total')";
        $resultado2 = mysqli_query($conexion, $peticion2);
        $peticion3 = "INSERT INTO detalle_compraresina(codigo_compraResina, id_resina, cantidad) VALUES ('$codigo','$idresina','$cantidad')";
        $resultado3 = mysqli_query($conexion, $peticion3);
        }
        else
        {
        $peticion = "INSERT INTO inventario_resina(id_resina,cantidad) VALUES ('$idresina','$cantidad')";
        $resultado = mysqli_query($conexion, $peticion);
       $peticion2 = "INSERT INTO compra_resina(codigo_compraResina, id_proveedor, total_compra) VALUES ('$codigo','$proveedor','$total')";
        $resultado2 = mysqli_query($conexion, $peticion2);
       $peticion3 = "INSERT INTO detalle_compraresina(codigo_compraResina, id_resina, cantidad) VALUES ('$codigo','$idresina','$cantidad')";
        $resultado3 = mysqli_query($conexion, $peticion3);
        }
        }
                   
    }
  
  
unset($_SESSION['contadorResina']);
unset($_SESSION['Resina']);
unset($_SESSION['cantidadResina']);
unset($_SESSION['codigoResina']);
unset($_SESSION['proveedorResina']);
mysqli_close($conexion);
header("Location: comprar_resina.php")
?>