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
        $this->Cell(190,25,utf8_decode('L I S T A  D E  P R E F O R M A S'),0,0,'C');
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
$pdf->Cell(15,8,"",0);
$pdf->Cell(30,8, 'No.', 1 );
$pdf->Cell(60,8,utf8_decode('Concepto'), 1);
$pdf->Cell(45,8, 'Millar x caja', 1);
$pdf->Cell(25,8, 'Precio usd', 1);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$prefor="SELECT * FROM preformas";
$preformas=mysqli_query($conexion,$prefor);
$id=1;
while($arreglo=mysqli_fetch_array($preformas))
{
    $pdf->SetFont('Arial','',10); //Arial, negrita, 12 puntos
    $pdf->Cell(15,8,"",0);
    $pdf->Cell(30,8, $id, 1);
    $pdf->Cell(60,8, $arreglo['gramaje'], 1);
    $pdf->Cell(45,8, $arreglo['millarcaja'], 1);
    $pdf->Cell(25,8, $arreglo['usd'], 1);
    $pdf->Ln(8);
    $id++;
}
    $pdf->Ln();
    $pdf->Output();
?>
<?php

require '../conexion.php';

include('libreria/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage('P', 'Letter');
$pdf->Image('../img/logo.png' , 83 ,22, 60 , 38,'PNG', '');
$pdf->Ln(30);
$pdf->Cell(70);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(70,50, ' M A T E R I A   P R I M A');
$pdf->Ln(10);
$pdf->Cell(60);
$pdf->SetFont('Arial','B',15);
$pdf->Cell(100,50, 'L I S T A  D E  P R E F O R M A S');

$pdf->Ln();

$pdf->SetFont('Arial','B',11);

$pdf->Cell(20,8,"",0);
$pdf->Cell(40,8, 'Id Preforma', 0);
$pdf->Cell(40,8, 'Gramaje', 0);
$pdf->Cell(45,8, 'Tipo de Preforma', 0);
$pdf->Cell(45,8, 'Unidad de Medida', 0);

$pdf->Ln();

$pdf->SetFont('Arial','',12);
$prefor="SELECT * FROM preformas";
$preformas=mysqli_query($conexion,$prefor);
$id=1;

while($arreglo=mysqli_fetch_array($preformas))
{
    $pdf->Cell(20,8,"",0);
    $pdf->Cell(40,8, $id, 0);
    $pdf->Cell(40,8, $arreglo['gramaje'], 0);
    $pdf->Cell(45,8, $arreglo['unidad_medida'], 0);
    $id++;
    $pdf->Ln(8);
}

$pdf->Ln();

$pdf->Output();

?>