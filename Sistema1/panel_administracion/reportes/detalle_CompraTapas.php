<?php
require '../conexion.php';
$id=base64_decode($_GET['Cod']);
include_once('libreria/fpdf.php');
date_default_timezone_set('Mexico/General');
class PDF extends FPDF
{
    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Carretera Villahermosa-Teapa Km52+100 Bodega 1 Manuel Buelta, 2da.Secc. C.P.86826 Teapa, Tabasco.','T',0,'C');
    }
    function Header(){
        $id=base64_decode($_GET['Cod']);

        //Define tipo de letra a usar, Arial, Negrita, 15
        $this->SetFont('Arial','B',13);
        $this->Line(10,10,265,10);
        $this->Line(10,35.5,265,35.5);
        $this->Cell(260,27,utf8_decode('E N V A S E S  P L Á S T I C O S  L A  T E J E R Í A '),0,0,'C', $this->Image('../img/logo.png',10,12,40));
        $this->Ln(25);
        $this->SetFont('Arial','B',12);
        $this->Cell(260,27,utf8_decode('D E T A L L E  C O M P R A  T A P A S   '),0,0,'C');
        $this->Ln(8);
        $this->SetFont('Arial','',11);
        $this->Ln(17);
        $this->SetFont('Arial','B',11);
        $fecha = date("d/m/Y");
        $fecha1="Fecha:  ".$fecha."";
        $this->Cell(450,10,$fecha1 ,0,0,'C');
        $this->Line(232, 67, 253, 67);
        $this->Ln(0);
    }

}
?>
<?php
require '../conexion.php';
$id=base64_decode($_GET['Cod']);
$pdf = new PDF();
$pdf->AddPage('L', 'Letter'); //Vertical, Carta
$pdf->SetFont('Arial','B',11); //Arial, negrita, 12 puntos
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(8,8,"",0);
$pdf->Cell(12,8,utf8_decode('No'), 1 );
$pdf->Cell(80,8,utf8_decode('Proveedor'), 1 );
$pdf->Cell(45,8,utf8_decode('Concepto'), 1 );
$pdf->Cell(20,8,utf8_decode('Unidad'), 1);
$pdf->Cell(35,8,utf8_decode('Piezas'), 1);
$pdf->Cell(20,8,utf8_decode('Cajas'), 1 );
$pdf->Cell(35,8,utf8_decode('Importe'), 1);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$preforma="SELECT PV.nombre_fiscal, T.tamano, T.unidad_medida, DC.cantidad, DC.id_detalleCompraTapas, DC.codigo_compraTapas, (DC.cantidad*T.precio) importeTapas,DC.cajas FROM  detalle_compratapas DC, tapas T, compra_tapas CT, proveedores PV  WHERE DC.codigo_compraTapas='$id' AND T.id_tapa=DC.id_tapa AND PV.id_proveedor=CT.id_proveedor and CT.codigo_compraTapas=DC.codigo_compraTapas GROUP BY DC.id_detalleCompraTapas  ";
$prefor=mysqli_query($conexion,$preforma);
if (mysqli_num_rows($prefor)>0)
{
    $total_compra=0;
    $id=1;
    while($arreglo=mysqli_fetch_array($prefor))
    {
        $total_compra=round($total_compra+$arreglo['importeTapas'],4);
        $pdf->SetFont('Arial','',10); //Arial, negrita, 12 puntos
        $pdf->Cell(8,8,"",0);
        $pdf->Cell(12,8, $id, 1);
        $pdf->Cell(80,8, $arreglo['nombre_fiscal'], 1);
        $pdf->Cell(45,8, $arreglo['tamano'], 1);
        $pdf->Cell(20,8, $arreglo['unidad_medida'], 1);
        $pdf->Cell(35,8, $arreglo['cantidad'], 1);
        $pdf->Cell(20,8, $arreglo['cajas'], 1 );
        $pdf->Cell(35,8, round($arreglo['importeTapas'],4), 1);
        $id++;


        $pdf->Ln(8);
    }
$pdf->Cell(185,8,'',0);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(35,8, 'Total', 1);
    $pdf->SetFont('Arial','B',9); 
    $pdf->Cell(35,8, '$'.$total_compra, 1);
    $pdf->Ln(0);
    $pdf->Cell(300,8,'',0);
    $pdf->Ln();
    $pdf->Output();
    $pdf->Output();
}
else 
{
    $total=0;  
}

?>
