  <?php

  $desde = $_POST['p-desde'];
  $hasta = $_POST['p-hasta'];

  if ($desde=="" or $hasta=="")
        {
            print "<script>alert(\"Seleccione un Rango de Fechas.\");window.location='../bodega/salida_preforma.php';</script>";  
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
        $this->Cell(200,25,utf8_decode('E N T R E G A S    D E   P  R E F O R M A S  '),0,0,'C');
        $this->Ln(8);
         $this->SetFont('Arial','',11);
         $this->Cell(195,25,utf8_decode('Desde: '.$desde.' Hasta: '.$hasta),0,0,'C');
        $this->Ln(17);
        $this->SetFont('Arial','B',11);
        $fecha = date("d/m/Y");
        $fecha1="Fecha:  ".$fecha."";
        $this->Cell(355,10,$fecha1 ,0,0,'C');
        $this->Line(183, 67, 205, 67);
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
$pdf->Cell(5,8,"",0);
$pdf->Cell(20,8, 'No.', 1 );
$pdf->Cell(37,8,utf8_decode('Fecha de entrega'), 1);
$pdf->Cell(65,8, utf8_decode('Entregó'), 1);
$pdf->Cell(65,8,utf8_decode(' Recibió'), 1);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$preforma="SELECT EP1.id_entregaPreformas, EP1.fecha_entrega,  (U1.nombre_usuario) entrego, (U2.nombre_usuario) recibe FROM entrega_preformas EP1, entrega_preformas EP2, usuarios U1, usuarios U2 WHERE U1.id_usuario=EP1.id_usuarioEntrega AND U2.id_usuario=EP1.id_usuarioRecibe  AND DATE(EP1.fecha_entrega) BETWEEN '.$desde' AND '$hasta' GROUP BY  EP1.id_entregaPreformas  ORDER BY EP1.id_entregaPreformas ASC";
$prefor=mysqli_query($conexion,$preforma);
if (mysqli_num_rows($prefor)>0)
{

while($arreglo=mysqli_fetch_array($prefor))
{
    $pdf->SetFont('Arial','',10); //Arial, negrita, 12 puntos
    $pdf->Cell(5,8,"",0);
    $pdf->Cell(20,8, $arreglo['id_entregaPreformas'], 1);
    $pdf->Cell(37,8, $arreglo['fecha_entrega'], 1);
    $pdf->Cell(65,8, $arreglo['entrego'], 1);
    $pdf->Cell(65,8, $arreglo['recibe'], 1);
    $pdf->Ln(8);
}
    
    
    $pdf->Ln();
    $pdf->Output();
}
else 
{
  $total=0;  
}

?>