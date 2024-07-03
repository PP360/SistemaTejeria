
<?php 
require '../conexion.php';

session_start();
if(!isset($_SESSION['contadorResina'])){$_SESSION['contadorResina'] = 0;}
$suma = 0;
if(isset($_GET['p'])){
    $_SESSION['Resina'][$_SESSION['contadorResina']] = $_GET['p'];
    $_SESSION['cantidadResina'][$_SESSION['contadorResina']] = $_GET['cant'];
    $_SESSION['codigoResina'][$_SESSION['contadorResina']] = $_GET['cod'];
    $_SESSION['proveedorResina'][$_SESSION['contadorResina']] = $_GET['pro'];
    $_SESSION['contadorResina']++;
}
mysqli_set_charset($conexion, "utf8");

echo "<div class='table-responsive'>";
echo "<table class='table table-striped table-bordered table-hover' id='tabla'>";
echo "<thead class='thead-inverse'><tr>  <th>Cantidad </th> <th> Nombre </th> <th>Importe</th> </tr></thead>";
for($i = 0;$i< $_SESSION['contadorResina'];$i++){
    $peticion = "SELECT * FROM resina WHERE id_resina=".$_SESSION['Resina'][$i]."";
    $resultado = mysqli_query($conexion, $peticion);
    while($fila = mysqli_fetch_array($resultado)) {
        if ($_SESSION['codigoResina'][$i]=="" or $_SESSION['cantidadResina'][$i]=="" or $_SESSION['proveedorResina'][$i]=="0")
        {
            print "<script>alert(\"Complete todos los campos.\");window.location='../comprar/comprar_tapas.php';</script>";
            $_SESSION['Resina'][$i]=0;
            $_SESSION['cantidadResina'][$i]=0;
            $_SESSION['codigoResina'][$i]=0;
        }
        else
        {
        echo "<tr><td>".$_SESSION['cantidadResina'][$i]."</td><td>".$fila['nombre']."</td><td> ".number_format(($_SESSION['cantidadResina'][$i]*$fila['precio']),4)."</td></tr>";
        $suma+= $_SESSION['cantidadResina'][$i]*$fila['precio'];      
        }
    }
}         
echo "<tbody><tr><td></td><td><h5> <strong>Subtotal</strong></h5></td><td><h5>$".number_format(($suma),4)."</h5></td></tr></tbody>";
echo"</table>";
echo "</div>";
mysqli_close($conexion);



?>