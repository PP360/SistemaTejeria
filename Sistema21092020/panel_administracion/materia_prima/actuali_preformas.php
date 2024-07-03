
<?php
if(isset($_POST['id'])==0)
{
    echo "Acceso Denegado";
}
else
{
require '../conexion.php';
$id=$_POST['id'];
$unidad_medida=trim(htmlspecialchars($_POST['unidad_medida']));
$gramaje=trim(htmlspecialchars($_POST['gramaje']));
$dolar=trim(htmlspecialchars($_POST['dolar']));
    if ($id=="0" or $unidad_medida=="" or $gramaje=="0")
{
    print "<script>alert(\"Complete todos los Campos.\");window.location='preformas.php';</script>";
}
    else
    {
$sql="UPDATE preformas SET unidad_medida='$unidad_medida', gramaje='$gramaje', usd='$dolar' WHERE id_preforma='$id'";
$insert=mysqli_query($conexion,$sql) or die ("Error al actualizar la preforma");
mysqli_close($conexion);
header("Location: preformas.php");
    }
}
?>