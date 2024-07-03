<?php
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
        //Define tipo de letra a usar, Arial, Negrita, 15
        $this->SetFont('Arial','B',13);
        $this->Line(10,10,206,10);
        $this->Line(10,35.5,206,35.5);
        $this->Cell(200,27,utf8_decode('E N V A S E S  P L Á S T I C O S  L A  T E J E R Í A '),0,0,'C', $this->Image('../img/logo.png',10,12,40));
        $this->Ln(25);
         $this->SetFont('Arial','B',12);
        $this->Cell(190,25,utf8_decode('L I S T A  D E  T A P A S '),0,0,'C');
        $this->Ln(25);
        $this->SetFont('Arial','B',11);
        $fecha = date("d/m/Y");
        $fecha1="Fecha:   ".$fecha."";
        $this->Cell(310,10,$fecha1 ,0,0,'C');
        $this->Line(162, 67, 185, 67);
    }
}
?>
<?php
 require '../conexion.php';
$pdf = new PDF();
$pdf->AddPage('P', 'Letter'); //Vertical, Carta
$pdf->SetFont('Arial','B',11); //Arial, negrita, 12 puntos
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(14,8,"",0);
$pdf->Cell(20,8, 'No.', 1 );
$pdf->Cell(60,8,utf8_decode('Concepto'), 1);
$pdf->Cell(45,8, 'Unidad', 1);
$pdf->Cell(35,8, 'Precio', 1);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$tapa="SELECT * FROM tapas";
$tapas=mysqli_query($conexion,$tapa);
$id=1;
while($arreglo=mysqli_fetch_array($tapas))
{
    $pdf->SetFont('Arial','',10); //Arial, negrita, 12 puntos
    $pdf->Cell(14,8,"",0);
    $pdf->Cell(20,8, $id, 1);
    $pdf->Cell(60,8, $arreglo['tamano'], 1);
    $pdf->Cell(45,8, $arreglo['unidad_medida'], 1);
    $pdf->Cell(35,8, $arreglo['precio'], 1);
    $id++;
    $pdf->Ln(8);
}
    $pdf->Ln();
    $pdf->Output();
?>