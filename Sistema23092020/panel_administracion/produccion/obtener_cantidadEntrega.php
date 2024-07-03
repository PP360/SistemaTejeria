<?php
include 'conexion.php';

$consulta = "SELECT (detalle_entregapreformas.cantidad) cantidad FROM detalle_entregapreformas WHERE id_detalleEntregaPreformas=".$_GET['id'];  

$query = mysqli_query($conexion,$consulta);
while ($fila = mysqli_fetch_array($query)) {
     echo '<option value="'.$fila['cantidad'].'">'.$fila['cantidad'].'</option>';
};

?>