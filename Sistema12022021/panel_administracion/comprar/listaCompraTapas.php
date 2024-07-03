<?php 
require '../conexion.php';

session_start();
if(!isset($_SESSION['contadorTapas'])){$_SESSION['contadorTapas'] = 0;}
$suma = 0;
if(isset($_GET['p'])){
    $_SESSION['Tapas'][$_SESSION['contadorTapas']] = $_GET['p'];
    $_SESSION['cantidadTapas'][$_SESSION['contadorTapas']] = $_GET['cant'];
    $_SESSION['codigoTapas'][$_SESSION['contadorTapas']] = $_GET['cod'];
    $_SESSION['proveedorTapas'][$_SESSION['contadorTapas']] = $_GET['pro'];
    $_SESSION['cajas'][$_SESSION['contadorTapas']]= $_GET['cajas'];
    $_SESSION['flete'][$_SESSION['contadorTapas']]= $_GET['flete'];
    $_SESSION['contadorTapas']++;
    //echo "Precio del flete: ".$_GET['flete'];
}
mysqli_set_charset($conexion, "utf8");

echo "<div class='table-responsive'>";
echo "<table class='table table-striped table-bordered table-hover' id='tabla'>";
echo "<thead class='thead-inverse'><tr>  <th>Cantidad </th> <th> Concepto </th><th>Cajas</th> <th>Importe</th> </tr></thead>";
for($i = 0;$i< $_SESSION['contadorTapas'];$i++){

    $peticion = "SELECT * FROM tapas WHERE id_tapa=".$_SESSION['Tapas'][$i]."";
    $resultado = mysqli_query($conexion, $peticion);
    while($fila = mysqli_fetch_array($resultado)) {
        if ($_SESSION['codigoTapas'][$i]=="" or $_SESSION['cantidadTapas'][$i]=="" or $_SESSION['proveedorTapas'][$i]=="0")
        {
            print "<script>alert(\"Complete todos los campos.\");window.location='../comprar/comprar_tapas.php';</script>";
            $_SESSION['Tapas'][$i]=0;
            $_SESSION['cajas'][$i]=0;
            $_SESSION['cantidadTapas'][$i]=0;
            $_SESSION['codigoTapas'][$i]=0;
        }
        else
        {
            echo "<tr><td>".$_SESSION['cantidadTapas'][$i]."</td><td>".$fila['tamano']."</td><td> "
            .$_SESSION['cajas'][$i]."</td><td>"
            .number_format(($_SESSION['cantidadTapas'][$i]*$fila['precio']),4)."</td></tr>";
            $suma+= $_SESSION['cantidadTapas'][$i]*$fila['precio']; 
        }

    }
}         
echo "<tbody><tr><td></td><td></td><td><h5> <strong>Subtotal</strong></h5></td><td><h5>$".number_format(($suma),4)."</h5></td></tr></tbody>";
// echo "<tbody><tr><td></td><td></td><td><h5> <strong>Flete</strong></h5></td><td><h5>$".number_format(( $_SESSION['flete']),4)."</h5></td></tr></tbody>";
echo"</table>";
echo "</div>";
mysqli_close($conexion);



?>
