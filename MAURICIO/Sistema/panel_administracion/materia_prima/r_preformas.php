<?php
require '../conexion.php';

$unidad_medida=trim(htmlspecialchars($_POST['unidad_medida']));
$gramaje=trim(htmlspecialchars($_POST['gramaje']));
$dolar=trim(htmlspecialchars($_POST['dolar']));
$millarxcaja=trim(htmlspecialchars($_POST['millarxcaja']));
$existe="SELECT gramaje FROM preformas WHERE gramaje='$gramaje'";
$preformas=mysqli_query($conexion,$existe);
$filas=mysqli_num_rows($preformas);
if ($unidad_medida=="" or $gramaje==""or $dolar=="" or $millarxcaja=="")
{
    print "<script>alert(\"Complete todos los Campos.\");window.location='preformas.php';</script>";
}
elseif($filas>0)
{
    print "<script>alert(\"La preforma ya existe, ya está registrada.\");window.location='preformas.php';</script>";
}
else
{
    $tipoCambio="SELECT tipo_cambio FROM preformas LIMIT 1";
    $tipo=mysqli_query($conexion,$tipoCambio);
    while ($row=mysqli_fetch_array($tipo)) {
        $tipodeCambio=$row['tipo_cambio'];
        $sql="insert into preformas (unidad_medida, gramaje, usd, tipo_cambio,millarcaja) values('$unidad_medida','$gramaje','$dolar','$tipodeCambio','$millarxcaja')";
        $insert=mysqli_query($conexion,$sql) or die ("Error al registrar la preforma");

    }


    mysqli_close($conexion);
    header("Location: preformas.php");
}
?>
