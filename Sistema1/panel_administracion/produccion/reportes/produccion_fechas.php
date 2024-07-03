<?php
require '../../conexion.php';
//$id=base64_decode($_GET['Cod']);
$f_inicio=($_POST['fecha_inicio']);
$f_fin=($_POST['fecha_fin']); 
$turno=($_POST['turno']);

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
        //$id=base64_decode($_GET['Cod']);

        //Define tipo de letra a usar, Arial, Negrita, 15
        $this->SetFont('Arial','B',13);
        $this->Line(10,10,206,10);
        $this->Line(10,35.5,206,35.5);
        $this->Cell(200,27,utf8_decode('E N V A S E S  P L Á S T I C O S  L A  T E J E R Í A '),0,0,'C', $this->Image('../img/logo.png',10,12,40));
        $this->Ln(25);
        $this->SetFont('Arial','B',12);
        $this->Cell(190,25,utf8_decode('R E P O R T E      D E        P R O D U C C I O N    '),0,0,'C');
        $this->Ln(8);
        $this->SetFont('Arial','',11);
        $this->Ln(17);
        $this->SetFont('Arial','B',11);
        $fecha = date("d/m/Y");
        $fecha1="Fecha de elaboracion:  ".$fecha."";
        $this->Cell(312,10,$fecha1 ,0,0,'C');
      
        $this->Ln(10);
        $fecha = date("d/m/Y");
        //Tipo de cambio

        require '../../conexion.php';

        
        

    }

}
?>
<?php
//$id=base64_decode($_GET['Cod']);
$pdf = new PDF();
$pdf->AddPage('L', 'Letter'); //Vertical, Carta
$pdf->SetFont('Arial','B',11); //Arial, negrita, 12 puntos
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(1,8,"",0);
$pdf->Cell(8,8, 'No.', 1 );
$pdf->Cell(25,8, 'Fecha', 1 );
$pdf->Cell(65,8, 'tipo_botella', 1 );
$pdf->Cell(23,8,utf8_decode('elaboradas'), 1);
$pdf->Cell(20,8,utf8_decode('merma'), 1);
$pdf->Cell(23,8,utf8_decode('devolución'), 1);
$pdf->Cell(40,8, 'nombre_usuario', 1);

$pdf->Ln();
$pdf->SetFont('Arial','',12);
 
$f_inicio=date("Y-m-d",strtotime($f_inicio));
$f_inicio.=" 00:00:00";
$f_fin=date("Y-m-d",strtotime($f_fin));
$f_fin.=" 23:59:59";
$produccion="SELECT PB.fecha_produccion,B.tipo_botella,PB.elaboradas,PB.merma,PB.devolucion,u.nombre_usuario FROM produccion_botella PB, botellas B, usuarios U WHERE 
PB.id_tipobotella=B.id_botella AND u.id_usuario=PB.id_usuarioProduce  AND u.turno='$turno' AND PB.fecha_produccion BETWEEN '$f_inicio' AND '$f_fin'";


$produc=mysqli_query($conexion,$produccion);
if (mysqli_num_rows($produc)>0)
{
    $numeroEntrega=1;
    while($arreglo=mysqli_fetch_array($produc))
    {
        $fecha_prod=date("d-m-Y",strtotime($arreglo['fecha_produccion']));
        
        $pdf->SetFont('Arial','',10); //Arial, negrita, 12 puntos
        $pdf->Cell(1,8,"",0);
        $pdf->Cell(8,8, $numeroEntrega, 1);
        //$pdf->Cell(35,8, $arreglo['fecha_produccion'], 1);
        $pdf->Cell(25,8, $fecha_prod, 1);
        $pdf->Cell(65,8, $arreglo['tipo_botella'], 1);
        $pdf->Cell(23,8, $arreglo['elaboradas'], 1);
		$pdf->Cell(20,8, $arreglo['merma'], 1);
		$pdf->Cell(23,8, $arreglo['devolucion'], 1);
		$pdf->Cell(40,8, $arreglo['nombre_usuario'], 1);
	
        $pdf->Ln(8);
        $numeroEntrega++;
        
    }
	//PARA VER CONSULTA SQL
    //$pdf->cell(0,5,$produccion,1);
	//Checar consulta 
	        // $pdf->SetFont('Arial','B',3);
        	 //$pdf->Line(200, 67, 200, 67);
             //$pdf->Cell(190,10,$produccion ,0,0,'C');
             //$pdf->Line(45, 150, 165, 150);
    $pdf->Ln();
    $pdf->Output();
    $pdf->Output();
}
else 
{
    
}



?>
