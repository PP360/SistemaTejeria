<?php
require '../../conexion.php';
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
        $this->Line(10,10,268,10);
        $this->Line(10,35.5,268,35.5);
        $this->Cell(282,27,utf8_decode(' E N V A S E S   P L Á S T I C O S   L A   T E J E R Í A '),0,0,'C', $this->Image('../img/logo.png',50,12,40));
        $this->Ln(25);
        $this->SetFont('Arial','B',12);
        $this->Cell(260,25,utf8_decode('P R O D U C C I O N    D E    B O T E L L A S'),0,0,'C');
        $this->Ln(8);
        $this->SetFont('Arial','',11);
        $this->Ln(17);
        $this->SetFont('Arial','B',11);
        $fecha = date("d/m/Y");
        $fecha1="Fecha:  ".$fecha."";
        $this->Cell(430,10,$fecha1,0,0,'C');   #Texto fecha
        $this->Line(245, 67, 221, 67);         #Línea fecha
        $this->Ln(10);
        $fecha = date("d/m/Y");
        //Tipo de cambio
        require '../../conexion.php';
        $sql="SELECT  (U1.nombre_usuario) entrego,(U1.turno) turno  FROM entrega_preformas EP1, usuarios U1, detalle_entregapreformas DE WHERE U1.id_usuario=EP1.id_usuarioEntrega AND EP1.id_entregaPreformas=DE.id_entregaPreformas AND  DE.id_entregaPreformas='$id' GROUP BY  EP1.id_entregaPreformas";
        $filas=mysqli_query($conexion,$sql);
        while($arreglo=mysqli_fetch_array($filas))
        {   
            $fecha1= utf8_decode("Entregó:  ").$arreglo["entrego"]."";
            $this->Line(200, 67, 200, 67);
            $this->Cell(110,10,$fecha1 ,0,0,'C');
            $this->Line(45, 77, 105, 77);
            $fecha1="Turno:  ".$arreglo["turno"]."";
            $this->Line(200, 67, 200, 67);
            $this->Cell(207,10,$fecha1 ,0,0,'C');       #Texto turno 
            $this->Line(245, 77, 222, 77);              #Línea turno
        }

    }

}
?>
<?php
$id=base64_decode($_GET['Cod']);

$pdf = new PDF();
$pdf->AddPage('L', 'Letter');   #Horizontal, Carta
$pdf->SetFont('Arial','B',11);  #Arial, negrita, 12 puntos
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(15,8,"",0);
$pdf->Cell(20,8, 'No', 1 );
$pdf->Cell(50,8, 'Entrega', 1 );
$pdf->Cell(25,8, 'Cantidad', 1 );
$pdf->Cell(40,8, 'Botella', 1 );
$pdf->Cell(25,8, 'Merma', 1 );
$pdf->Cell(25,8,utf8_decode('Devolución'), 1 );
$pdf->Cell(25,8, 'Elaboradas', 1 );
$pdf->Cell(30,8,utf8_decode('Estatus'), 1);
$pdf->Ln();
$pdf->SetFont('Arial','',12);
$preforma="SELECT P.gramaje, P.unidad_medida, EP1.id_entregaPreformas, DE.cantidad, PB.id_entregaPreformas, IB.cantidad, B.tipo_botella, PB.estatus, PB.merma, PB.devolucion, PB.elaboradas FROM entrega_preformas EP1, usuarios U1, usuarios U2, detalle_entregapreformas DE,preformas P, produccion_botella PB, inventario_preformas IP1, inventario_botellas IB, botellas B WHERE U1.id_usuario=EP1.id_usuarioEntrega AND U2.id_usuario=EP1.id_usuarioRecibe  AND EP1.id_entregaPreformas=DE.id_entregaPreformas AND P.id_preforma=DE.id_preforma AND DE.id_entregaPreformas='$id' GROUP BY  EP1.id_entregaPreformas";

$produccion = "SELECT PB.merma, PB.devolucion, PB.elaboradas FROM detalle_entregapreformas DEP, produccion_botella PB WHERE DEP.id_entregaPreformas=PB.id_entregaPreformas";
$produc = mysqli_query($conexion, $produccion);

$prefor=mysqli_query($conexion,$preforma);
if (mysqli_num_rows($prefor)>0)
{
    $numeroEntrega=1;
    while($arreglo=mysqli_fetch_array($prefor))
    {        
        $pdf->SetFont('Arial','',10); //Arial, negrita, 12 puntos
        $pdf->Cell(15,8,"",0);
        $pdf->Cell(20,8, $numeroEntrega, 1);
        $pdf->Cell(50,8, $arreglo['gramaje'], 1);               #Descripcion Entreba
        $pdf->Cell(25,8, $arreglo['cantidad'], 1);              #Cantidad
        $pdf->Cell(40,8, $arreglo['tipo_botella'], 1);         #Tipo botella
        $pdf->Cell(30,8, $arreglo['estatus'], 1);                 #Estatus
        $pdf->Ln(50);
        $numeroEntrega++;
        
    }
    if (mysqli_num_rows($produc)>0)
    {
        $numeroEntrega=1;
        while($arreglo=mysqli_fetch_array($produc))
        {        
            $pdf->SetFont('Arial','',10); //Arial, negrita, 12 puntos
            $pdf->Cell(25,8, $arreglo['merma'], 1);                  #Merma
            $pdf->Cell(25,8, $arreglo['devolucion'], 1);           #Devolución
            $pdf->Cell(25,8, $arreglo['elaboradas'], 1);           #Elaboradas
            $pdf->Ln(50);
            $numeroEntrega++;
            
        }
    }




    
        
        $sql="SELECT  (U1.nombre_usuario) recibe FROM entrega_preformas EP1, usuarios U1, detalle_entregapreformas DE WHERE U1.id_usuario=EP1.id_usuarioRecibe AND EP1.id_entregaPreformas=DE.id_entregaPreformas AND  DE.id_entregaPreformas='$id' GROUP BY  EP1.id_entregaPreformas";
        $filas=mysqli_query($conexion,$sql);
        while($arreglo=mysqli_fetch_array($filas))
        {   $pdf->SetFont('Arial','B',11);
            $fecha1= $arreglo["recibe"]."";
            //$pdf->Line(100, 150, 40, 150);
            $pdf->Cell(276,10,$fecha1 ,0,0,'C');        #Nombre recibe
            $pdf->Line(95, 150, 200, 150);             #Línea nombre recibe
        }
    $pdf->Ln();
    $pdf->Output();
    $pdf->Output();
}
else 
{
    
}

?>