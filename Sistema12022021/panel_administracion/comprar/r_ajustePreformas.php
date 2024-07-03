<?php
require '../conexion.php';


$idCompraPreforma=$_POST['idCompraPRE'];
//echo "ID Compra Preforma: ".$idCompraPreforma;
$gramaje=$_POST['gramaje'];
//echo "ID Preforma".$gramaje;
$cantidadExcedente=$_POST['cantidadExcedente'];
//echo "Cantidad Excedente: ".$cantidadExcedente;

$sql="INSERT INTO ajuste_preformas(id_compraPreformas,Gramaje,Cantidad_ajustada) VALUES($idCompraPreforma,'$gramaje',$cantidadExcedente)";
//echo $sql;
$insert=mysqli_query($conexion,$sql) or die("Error al registrar el ajuste de preformas");
$cantidadPreformasInventario="SELECT cantidad FROM inventario_preformas WHERE id_preforma=$gramaje";
//echo $cantidadPreformasInventario;
$CPI=mysqli_query($conexion,$cantidadPreformasInventario);
$filasCPI=mysqli_num_rows($CPI);

while($row=mysqli_fetch_array($CPI))
{
$cantidadActual=$row['cantidad']+$cantidadExcedente;    
$sqlAjustarInventario="UPDATE inventario_preformas SET cantidad=$cantidadActual WHERE id_preforma=$gramaje";
  //echo $sqlAjustarInventario;  
$AjustarPreformas=mysqli_query($conexion,$sqlAjustarInventario) or die ("Error al actualizar el inventario");

}
mysqli_close($conexion);
header("Location: comprar_preformas.php");

?>
