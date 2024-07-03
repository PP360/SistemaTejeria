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
        $this->Cell(260,27,utf8_decode('D E T A L L E  C O M P R A  P R E F O R M A    '),0,0,'C');
        $this->Ln(8);
        $this->SetFont('Arial','',11);
        $this->Ln(17);
        $this->SetFont('Arial','B',11);
        $fecha = date("d/m/Y");
        $fecha1="Fecha:  ".$fecha."";
        $this->Cell(450,10,$fecha1 ,0,0,'C');
        $this->Line(232, 67, 253, 67);
        $this->Ln(0);
        $fecha = date("d/m/Y");
        //Tipo de cambio
        require '../conexion.php';
        $sql="SELECT tipo_cambio FROM preformas LIMIT 1";
        $filas=mysqli_query($conexion,$sql);
        while($arreglo=mysqli_fetch_array($filas))
        {
            $fecha1="Tipo de cambio:  ".$arreglo["tipo_cambio"]."";
            $this->Cell(70,10,$fecha1 ,0,0,'C');
            $this->Line(53, 67, 75, 67);
        }

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
$pdf->Cell(10,8,"",0);
$pdf->Cell(12,8, 'No', 1 );
$pdf->Cell(80,8, 'Proveedor', 1 );
$pdf->Cell(60,8, 'Concepto', 1 );
$pdf->Cell(20,8,utf8_decode('Unidad'), 1);
$pdf->Cell(35,8,utf8_decode('Cantidad'), 1);
$pdf->Cell(35,8,utf8_decode('Importe'), 1);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$preforma="SELECT cp.id_proveedor,pv.nombre_fiscal, dc.id_detallecomprapreformas,p.gramaje,p.unidad_medida, dc.cantidad, (dc.cantidad*((p.usd*p.tipo_cambio)/1000)) importePreforma FROM detalle_comprapreformas dc, compra_preformas cp, preformas p, proveedores pv WHERE p.id_preforma=dc.id_preforma AND cp.codigo_compraPreformas='$id' and pv.id_proveedor=cp.id_proveedor and cp.codigo_compraPreformas=dc.codigo_comprapreformas group by (dc.id_detallecomprapreformas )";
$prefor=mysqli_query($conexion,$preforma);
if (mysqli_num_rows($prefor)>0)
{
    $total_compra=0;
    $id=1;
    while($arreglo=mysqli_fetch_array($prefor))
    {

        $total_compra=round($total_compra+$arreglo['importePreforma'],4);
        $pdf->SetFont('Arial','',10); //Arial, negrita, 12 puntos
        $pdf->Cell(10,8,"",0);
        $pdf->Cell(12,8, $id, 1);
        $pdf->Cell(80,8, $arreglo['nombre_fiscal'], 1);
        $pdf->Cell(60,8, $arreglo['gramaje'], 1);
        $pdf->Cell(20,8, $arreglo['unidad_medida'], 1);
        $pdf->Cell(35,8, $arreglo['cantidad'], 1);
        $pdf->Cell(35,8,'$'.round($arreglo['importePreforma'],4), 1);
        $pdf->Ln(8);
        $id++;
    }
    $pdf->Cell(182,8,'',0);
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