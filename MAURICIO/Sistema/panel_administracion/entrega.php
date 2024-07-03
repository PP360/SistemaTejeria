<?php
require_once('../conexion.php');
$entrega = $_POST['entregas'];

$query = $conexion->query("SELECT cantidad FROM detalle_entregapreformas WHERE id_entregaPreformas = $entrega");

echo '<option value="0">Seleccione</option>';

while ( $row = $query->fetch_assoc() )
{
	echo '<option value="' . $row['cantidad']. '">' . $row['cantidad'] . '</option>' . "\n";
}
?>