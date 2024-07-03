
<?php 
require '../conexion.php';

session_start();
if(!isset($_SESSION['contadorPreformas'])){$_SESSION['contadorPreformas'] = 0;}
$suma = 0;
if(isset($_GET['p'])){
    $_SESSION['Preforma'][$_SESSION['contadorPreformas']] = $_GET['p'];
    $_SESSION['cantidadPreforma'][$_SESSION['contadorPreformas']] = $_GET['cant'];
    $_SESSION['codigoPreforma'][$_SESSION['contadorPreformas']] = $_GET['cod'];
    $_SESSION['proveedorPreforma'][$_SESSION['contadorPreformas']] = $_GET['pro'];
    $_SESSION['contadorPreformas']++;
}
mysqli_set_charset($conexion, "utf8");

echo "<div class='table-responsive'>";
echo "<table class='table table-striped table-bordered table-hover' id='tabla'>";
echo "<thead class='thead-inverse'><tr>  <th>Cantidad </th> <th> Concepto </th> <th>Importe</th> </tr></thead>";

for($i = 0;$i< $_SESSION['contadorPreformas'];$i++){
        $peticion = "SELECT * FROM preformas WHERE id_preforma=".$_SESSION['Preforma'][$i]."";
        $resultado = mysqli_query($conexion, $peticion);
        while($fila = mysqli_fetch_array($resultado)) {
            if ($fila['tipo_cambio']<=0)
            {
                print "<script>alert(\"No ha agregado Tipo de Cambio a la Preforma.\");window.location='../comprar/comprar_preformas.php';</script>";
                $_SESSION['Preforma'][$i]=0;
                $_SESSION['cantidadPreforma'][$i]=0;
                $_SESSION['codigoPreforma'][$i]=0;
            }
            elseif ($_SESSION['Preforma'][$i]=="" or $_SESSION['cantidadPreforma'][$i]=="" or $_SESSION['proveedorPreforma'][$i]=="0")
            {
                 print "<script>alert(\"Complete todos los campos.\");window.location='../comprar/comprar_preformas.php';</script>";
               $_SESSION['Preforma'][$i]=0;
                $_SESSION['cantidadPreforma'][$i]=0;
                $_SESSION['codigoPreforma'][$i]=0;
            }
            else
            {
                echo "<tr><td>".$_SESSION['cantidadPreforma'][$i]."</td><td>".$fila['gramaje']."</td><td> ".number_format(($_SESSION['cantidadPreforma'][$i]*$fila['usd']/1000*$fila['tipo_cambio']),4)."</td></tr>";
                $suma+= $_SESSION['cantidadPreforma'][$i]*$fila['usd']/1000*$fila['tipo_cambio'];
            }

 
        }
   
}         
echo "<tbody><tr><td></td><td><h5> <strong>Subtotal</strong></h5></td><td><h5>$".number_format(($suma),4)."</h5></td></tr></tbody>";

echo"</table>";
echo "</div>";


mysqli_close($conexion);



?>
