<?php
include 'conexion.php';

$consulta = "SELECT (detalle_entregaresina.cantidad) cantidad FROM detalle_entregaresina WHERE id_entregaResina=".$_GET['id'];  
$query = mysqli_query($conexion,$consulta);
while ($fila = mysqli_fetch_array($query)) {
     echo '<option value="'.$fila['cantidad'].'">'.$fila['cantidad'].'</option>';
};

?>