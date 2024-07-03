


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
        $this->Line(10,10,265,10);
        $this->Line(10,35.5,265,35.5);
        $this->Cell(260,27,utf8_decode('E N V A S E S  P L Á S T I C O S  L A  T E J E R Í A '),0,0,'C', $this->Image('../img/logo.png',35,12,40));
        $this->Ln(25);
         $this->SetFont('Arial','B',12);
        $this->Cell(260,25,utf8_decode('L I S T A  D E  C L I E N T E S   '),0,0,'C');
        $this->Ln(25);
        $this->SetFont('Arial','B',11);
        $fecha = date("d/m/Y");
        $fecha1="Fecha:   ".$fecha."";
        $this->Cell(470,10,$fecha1 ,0,0,'C');
        $this->Line(240, 67, 265, 67);
    }
}
?>
<?php
 require '../conexion.php';
$pdf = new PDF();
$pdf->AddPage('L', 'Letter'); //Vertical, Carta
$pdf->SetFont('Arial','B',11); //Arial, negrita, 12 puntos
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(1,8,"",0);
$pdf->Cell(15,8, 'No.', 1);
$pdf->Cell(58,8,'Nombre', 1);
$pdf->Cell(85,8, utf8_decode('Dirección'), 1);
$pdf->Cell(45,8, 'Email', 1);
$pdf->Cell(25,8, utf8_decode('Teléfono'), 1);
$pdf->Cell(25,8, utf8_decode('Celular'), 1);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$clientes="SELECT * FROM clientes";
$id=1;
$cli=mysqli_query($conexion,$clientes);
while($arreglo=mysqli_fetch_array($cli))
{
    $pdf->SetFont('Arial','',9); //Arial, negrita, 12 puntos
    $pdf->Cell(1,8,"",0);
    $pdf->Cell(15,8,  $id, 1);
    $pdf->Cell(58,8,  utf8_decode($arreglo['nombre_cliente']), 1);
    $pdf->Cell(85,8, utf8_decode($arreglo['direccion']), 1);
    $pdf->Cell(45,8, $arreglo['email'], 1);
    $pdf->Cell(25,8, $arreglo['telefono'], 1);
    $pdf->Cell(25,8, $arreglo['celular'], 1);
    $id++;
    $pdf->Ln(8);
}
    $pdf->Ln();
    $pdf->Output();
?>