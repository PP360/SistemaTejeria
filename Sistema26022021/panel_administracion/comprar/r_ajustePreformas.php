<?php
require '../conexion.php';


$idCompraPreforma=$_POST['idCompraPRE'];
//echo "ID Compra Preforma: ".$idCompraPreforma;
$gramaje=$_POST['gramaje'];
//echo "ID Preforma".$gramaje;
$cantidadExcedente=$_POST['cantidadExcedente'];
//echo "Cantidad Excedente: ".$cantidadExcedente;
$numeroCaja=$_POST['NumeroCaja'];
$sql="INSERT INTO ajuste_preformas(id_compraPreformas,Gramaje,NumeroCaja,Cantidad_ajustada) VALUES($idCompraPreforma,'$gramaje',$numeroCaja,$cantidadExcedente)";
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
//$('#mensaje').addClass('error').html('<i class="fa fa-check" aria-hidden="true"></i> El inventario de preformas se ha ajustado se ha ajustado. ').show(150).delay(3800).hide(150);
echo "<script>alert('El inventario de preformas se ha ajustado se ha ajustado.')</script>";
header("Location: comprar_preformas.php");

?>
