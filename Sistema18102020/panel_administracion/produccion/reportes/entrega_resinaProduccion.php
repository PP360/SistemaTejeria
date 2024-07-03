<?php
require_once '../../conexion.php';
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
        $this->Line(10,10,206,10);
        $this->Line(10,35.5,206,35.5);
        $this->Cell(200,27,utf8_decode('E N V A S E S  P L Á S T I C O S  L A  T E J E R Í A '),0,0,'C', $this->Image('../img/logo.png',10,12,40));
        $this->Ln(25);
        $this->SetFont('Arial','B',12);
        $this->Cell(190,25,utf8_decode('S A L I D A  D E    P R E F O R M A    '),0,0,'C');
        $this->Ln(8);
        $this->SetFont('Arial','',11);
        $this->Ln(17);
        $this->SetFont('Arial','B',11);
        $fecha = date("d/m/Y");
        $fecha1="Fecha:  ".$fecha."";
        $this->Cell(312,10,$fecha1 ,0,0,'C');
        $this->Line(162, 67, 185, 67);
        $this->Ln(10);
        $fecha = date("d/m/Y");
        require '../../conexion.php';
        //Tipo de cambio
        $sql="SELECT  (U1.nombre_usuario) entrego,(U1.turno) turno  FROM entrega_resina ER1, usuarios U1, detalle_entregaresina DE WHERE U1.id_usuario=ER1.id_usuarioEntrega AND ER1.id_entregaResina=DE.id_entregaResina AND  DE.id_entregaResina='$id' GROUP BY  ER1.id_entregaResina";
        $filas=mysqli_query($conexion,$sql);
        while($arreglo=mysqli_fetch_array($filas))
        {   
            $fecha1= utf8_decode("Entregó:  ").$arreglo["entrego"]."";
            $this->Line(200, 67, 200, 67);
            $this->Cell(110,10,$fecha1 ,0,0,'C');
             $this->Line(45, 77, 105, 77);
             $fecha1="Turno:  ".$arreglo["turno"]."";
            $this->Line(200, 67, 200, 67);
            $this->Cell(75,10,$fecha1 ,0,0,'C');
             $this->Line(154, 77, 178, 77);
            
        }
        
        
        

    }

}
?>
<?php
$id=base64_decode($_GET['Cod']);
$pdf = new PDF();
$pdf->AddPage('P', 'Letter'); //Vertical, Carta
$pdf->SetFont('Arial','B',11); //Arial, negrita, 12 puntos
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(16,8,"",0);
$pdf->Cell(20,8, 'No', 1 );
$pdf->Cell(70,8, 'Concepto', 1 );
$pdf->Cell(25,8, 'Unidad', 1 );
$pdf->Cell(40,8,utf8_decode('Cantidad'), 1);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$preforma="SELECT R.nombre, R.unidad_medida, ER1.id_entregaResina, DE.cantidad FROM entrega_resina ER1, entrega_resina ER2, usuarios U1, usuarios U2, detalle_entregaresina DE,resina R WHERE U1.id_usuario=ER1.id_usuarioEntrega AND U2.id_usuario=ER1.id_usuarioRecibe  AND ER1.id_entregaResina=DE.id_entregaResina AND R.id_resina=DE.id_resina AND DE.id_entregaResina='$id'  GROUP BY  ER1.id_entregaResina";
$prefor=mysqli_query($conexion,$preforma);
if (mysqli_num_rows($prefor)>0)
{
    $numeroEntrega=1;
    while($arreglo=mysqli_fetch_array($prefor))
    {

        
        $pdf->SetFont('Arial','',10); //Arial, negrita, 12 puntos
        $pdf->Cell(16,8,"",0);
        $pdf->Cell(20,8, $numeroEntrega, 1);
        $pdf->Cell(70,8, $arreglo['nombre'], 1);
        $pdf->Cell(25,8, $arreglo['unidad_medida'], 1);
        $pdf->Cell(40,8, $arreglo['cantidad'], 1);
        $pdf->Ln(50);
        $numeroEntrega++;
        
    }
        $sql="SELECT  (U1.nombre_usuario) recibe FROM entrega_resina ER1, usuarios U1, detalle_entregaresina DE WHERE U1.id_usuario=ER1.id_usuarioRecibe AND ER1.id_entregaResina=DE.id_entregaResina AND  DE.id_entregaResina='$id' GROUP BY  ER1.id_entregaResina";
        $filas=mysqli_query($conexion,$sql);
        while($arreglo=mysqli_fetch_array($filas))
        {   $pdf->SetFont('Arial','B',11);
            $fecha1= $arreglo["recibe"]."";
            $pdf->Line(200, 67, 200, 67);
            $pdf->Cell(190,10,$fecha1 ,0,0,'C');
             $pdf->Line(45, 150, 165, 150);
        }
    $pdf->Ln();
    $pdf->Output();
    $pdf->Output();
}
else 
{
    
}

?>