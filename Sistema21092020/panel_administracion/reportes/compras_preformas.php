  <?php

  $desde = $_POST['p-desde'];
  $hasta = $_POST['p-hasta'];
  if ($desde=="" or $hasta=="")
        {
            print "<script>alert(\"Seleccione un Rango de Fechas.\");window.location='../comprar/verCompraPreformas.php';</script>";  
        }
include_once('libreria/fpdf.php');
require '../conexion.php';
date_default_timezone_set('Mexico/General');
class PDF extends FPDF
{
    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Carretera Villahermosa-Teapa Km52+100 Bodega 1 Manuel Buelta, 2da.Secc. C.P.86826 Teapa, Tabasco.','T',0,'C');
    }
    function Header(){
       $desde = $_POST['p-desde'];
        $hasta = $_POST['p-hasta'];
            
        //Define tipo de letra a usar, Arial, Negrita, 15
      $this->SetFont('Arial','B',13);
        $this->Line(10,10,206,10);
        $this->Line(10,35.5,206,35.5);
        $this->Cell(200,27,utf8_decode('E N V A S E S  P L Á S T I C O S  L A  T E J E R Í A '),0,0,'C', $this->Image('../img/logo.png',10,12,40));
        $this->Ln(25);
         $this->SetFont('Arial','B',12);
        $this->Cell(190,25,utf8_decode('C O M P R A   D E  P R E F O R M A S   '),0,0,'C');
        $this->Ln(8);
         $this->SetFont('Arial','',11);
         $this->Cell(190,25,utf8_decode('Desde: '.$desde.' Hasta: '.$hasta),0,0,'C');
        $this->Ln(17);
        $this->SetFont('Arial','B',11);
        $fecha = date("d/m/Y");
        $fecha1="Fecha:  ".$fecha."";
        $this->Cell(310,10,$fecha1 ,0,0,'C');
        $this->Line(162, 67, 185, 67);
    }
    
}
?>
<?php
 require '../conexion.php';
$desde = $_POST['p-desde'];
$hasta = $_POST['p-hasta'];
$pdf = new PDF();
$pdf->AddPage('P', 'Letter'); //Vertical, Carta
$pdf->SetFont('Arial','B',11); //Arial, negrita, 12 puntos
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(13,8,"",0);
$pdf->Cell(40,8, utf8_decode('No'), 1 );
$pdf->Cell(60,8, 'Fecha de compra', 1 );
$pdf->Cell(70,8,utf8_decode('Importe'), 1);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$preforma="SELECT CP.codigo_compraPreformas,DATE(CP.fecha_compra),SUM(CP.total_compra)FROM compra_preformas CP WHERE  DATE(CP.fecha_compra)  BETWEEN '$desde' AND '$hasta' GROUP BY CP.codigo_compraPreformas ORDER BY CP.id_compraPreformas";
$prefor=mysqli_query($conexion,$preforma);
if (mysqli_num_rows($prefor)>0)
{
$total_compra=0;
    $id=1;
while($arreglo=mysqli_fetch_array($prefor))
{
    $total_compra=$total_compra+$arreglo['SUM(CP.total_compra)'];
    $pdf->SetFont('Arial','',10); //Arial, negrita, 12 puntos
    $pdf->Cell(13,8,"",0);
    $pdf->Cell(40,8, $id, 1);
    $pdf->Cell(60,8, $arreglo['DATE(CP.fecha_compra)'], 1);
    $pdf->Cell(70,8, '$'.$arreglo['SUM(CP.total_compra)'], 1);
    $id++;
    $pdf->Ln(8);
}
    $pdf->Cell(53,8,'',0);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(60,8, 'Total', 1);
    $pdf->SetFont('Arial','B',9); 
    $pdf->Cell(70,8, '$'.$total_compra, 1);
    $pdf->Ln(0);
    $pdf->Cell(209,8,'',0);
    $pdf->Cell(30,8, 'HBB', 1);
    $pdf->Ln();
    $pdf->Output();
   }
else 
{
  $total=0; 
    print "<script>alert(\"No hay compra de preformas.\");</script>"; 
}

?>