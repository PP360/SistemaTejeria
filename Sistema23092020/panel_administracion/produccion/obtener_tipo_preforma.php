<?php
include 'conexion.php';

$consulta = "SELECT (detalle_entregapreformas.id_preforma) id_preforma FROM detalle_entregapreformas WHERE id_entregapreformas=".$_GET['id'];  
$query = mysqli_query($conexion,$consulta);
while ($fila = mysqli_fetch_array($query)) {
     echo '<option value="'.$fila['id_preforma'].'">'.$fila['id_preforma'].'</option>';
};

?>