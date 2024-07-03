<?php
session_start();
include('../conexion.php');
if(isset($_SESSION['usuario'])==false or isset($_SESSION['id_area'])==false){
    header('Location: ../error.php');
    session_destroy(); 
}elseif($_SESSION['id_area']!='1'){
    header('Location: ../error.php');
    session_destroy(); 
}
elseif($_SESSION['id_area']=='1')
{
    $fechaGuardada = $_SESSION["ultimoAcceso"]; 
    $ahora = date("Y-n-j H:i:s"); 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 
    $self = $_SERVER['PHP_SELF']; 
    header("refresh:1200; url=$self");
    if($tiempo_transcurrido >=1200) {
        print "<script>window.location='../login.php';</script>";
        session_unset();
        session_destroy();
    }else { 
        $_SESSION["ultimoAcceso"] = $ahora; 
    } 
}

else{
    if($_SESSION['id_area'] == '2'){
        header('Location:../panel_bodega/principal.php');

    }
}

?>
<?php
//Mostrar tabla de preformas
$query="SELECT tipo_cambio FROM preformas LIMIT 1";
$tipoCambio=mysqli_query($conexion,$query);
$filas=mysqli_num_rows($tipoCambio);
$query2="SELECT * FROM preformas";
$Preformas=mysqli_query($conexion,$query2);
$filasPreforma=mysqli_num_rows($Preformas);

$consulta1 = mysqli_query($conexion,'SELECT MAX(codigo_CompraPreformas) as codigo_CompraPreformas FROM compra_preformas LIMIT 1');
$consulta = mysqli_fetch_array($consulta1);
$codigo = (empty($consulta['codigo_CompraPreformas']) ? 1 : $consulta['codigo_CompraPreformas']+=1);
$proveedores="SELECT id_proveedor, nombre_fiscal FROM proveedores";
$proveedo=mysqli_query($conexion,$proveedores);
$filasProveedores=mysqli_num_rows($proveedo);
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Preformas | Tejeria Envases Plásticos </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="../css/vendor.css">
    <link rel="stylesheet" href="../css/app-green.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/validator.js"></script>
    <script src="../js/compra_Preformas.js"></script>

    <!-- Theme initialization -->
    <script>
        //loader pagina
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
        //Toltip
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $("#cantidadCajas").change(function(event) {
                console.log("Prueba de entrada");
                calcularPreformas();

                var tipoPreforma = $("#gramaje").find(':selected').val();
                if (tipoPreforma == "Seleccione una opción") {
                    document.calcularPreformas.cantidad.value = 0;
                }
            });
            //console.log("a ver si entra");  
            function calcularPreformas() {
                var flete = document.getElementById("flete").value;

                var cajas = document.getElementById("cantidadCajas").value;


                var tipoPreforma = document.getElementById("gramaje").value;
                var totalPreformasCompradas = 0;



                if (tipoPreforma == 1) {
                    totalPreformasCompradas = 23184 * cajas;
                    document.getElementById("cantidad").value = totalPreformasCompradas;
                } else if (tipoPreforma == 11) {
                    totalPreformasCompradas = 18816 * cajas;
                    document.getElementById("cantidad").value = totalPreformasCompradas;

                } else if (tipoPreforma == 12) {
                    totalPreformasCompradas = 1344 * cajas;
                    document.getElementById("cantidad").value = totalPreformasCompradas;

                } else if (tipoPreforma == 13) {
                    totalPreformasCompradas = 18816 * cajas;
                    document.getElementById("cantidad").value = totalPreformasCompradas;

                } else if (tipoPreforma == 14) {
                    totalPreformasCompradas = 9120 * cajas;
                    document.getElementById("cantidad").value = totalPreformasCompradas;

                } else {
                    $('#mensaje').addClass('error').html('<i class="fa fa-check" aria-hidden="true"></i> Tipo de Preforma no especificada ').show(150).delay(3800).hide(150);
                }

            }


        });

    </script>
    <style>
        /*Loader pagina al cargar*/

        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('../img/pre_loader.svg') 50% 50% no-repeat rgb(249, 249, 249);
        }

    </style>
</head>

<body>
    <div class="loader"></div>
    <div class="main-wrapper">
        <div class="app" id="app">
            <!--Inicia estructura del header-->
            <header class="header">
                <div class="header-block header-block-collapse hidden-lg-up">
                    <button class="collapse-btn" id="sidebar-collapse-btn">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="header-block header-block-search hidden-sm-down">
                </div>
                <div class="header-block header-block-nav">
                    <ul class="nav-profile">
                        <li class="profile dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="name">
                                    Bienvenido <?php echo $_SESSION['usuario']; ?>
                                </span> </a>
                        </li>
                    </ul>
                </div>
            </header>
            <!-- Panel de navegación -->
            <?php include('../nav_admin.php'); ?>

            <!--Inicia estructura BODY-->
            <div class="sidebar-overlay" id="sidebar-overlay"></div>
            <article class="content dashboard-page items-list-page">
                <div class="title-search-block">
                    <div class="title-block">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="title">
                                    Compra de preformas
                                    <button title="Nueva compra" class="btn  btn-sm rounded-s btn-danger test" data-toggle="modal" data-target="#registroCompraPreforma"> <i class="fa fa-cart-plus  fa-lg"></i></button>
                                    <a href="verCompraPreformas.php"><button title="Ver compras" data-toggle="tooltip" data-placement="right" title="Ver compras" class="btn   btn-sm rounded-s btn-danger test"> <i class="fa fa-eye  fa-lg"></i></button></a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <?php while ($row=mysqli_fetch_array($tipoCambio)) { ?>
                    <div class="items-search">
                        <form class="form-inline">
                            <div class="input-group"> <input type="text" class="form-control boxed rounded-s" value="<?php echo $row['tipo_cambio']; ?>" disabled> <span class="input-group-btn">
                                    <a class="btn btn-primary  rounded-s" data-toggle="modal" data-target="#tipoCambio" data-toggle="tooltip" title="Tipo de Cambio" data-placement="top">
                                        <i class="fa fa-usd" aria-hidden="true"></i>
                                    </a>
                                    <i class="fa fa-search"></i>

                                </span> </div>
                        </form>
                    </div>
                    <?php } ?>
                </div>
                <section class="section">
                    <div class="row sameheight-container">
                        <div class="col-md-7">
                            <div class="card tasks inline-block">
                                <div class="card-header bordered">
                                    <div class="header-block">
                                        <center>
                                            <i class="fa fa-shopping-cart fa-lg"></i>
                                            <h3 class="title">
                                                Lista de compra
                                            </h3>
                                        </center>
                                    </div>

                                    <div class="header-block pull-right">

                                        <a href="vaciarCompraPreformas.php"><button data-toggle="tooltip" data-placement="right" title="Vaciar carrito" onclick='return vaciarCarrito()' id="btnvaciar" type="submit" class="btn msg-cond btn-danger btn-sm rounded pull-right"><i class="fa fa-trash" aria-hidden="true"></i></button></a>

                                        <a href="rCompraPreformas.php"><button data-toggle="tooltip" data-placement="left" title="Confirmar compras" onclick='return comprar()' disabled id="btncomprar" class="btn btn-primary btn-sm rounded pull-right"> <i class="fa fa-check" aria-hidden="true"></i></button></a>



                                    </div>

                                </div>

                                <div class="card-block">
                                    <div class="tasks-block">
                                        <ul class="item-list">
                                            <li class="item">
                                                <div class="item-row">
                                                    <div class="item-col item-col-title">

                                                        <div id="carritoPreformas"></div>


                                                    </div>


                                                </div>


                                            </li>

                                        </ul>

                                        <nav class="text-xs-left">
                                            <a href="../materia_prima/preformas.php"><button title="Exportar compra" class="btn  btn-sm rounded-s btn-danger test"> <i class="fa fa-undo"></i> Regresar</button></a>
                                        </nav>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </article>

            <div class="modal fade" id="registroCompraPreformas" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <center>
                                <h4 class="modal-title"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Nueva compra</h4>
                            </center>
                        </div>

                        <div class="modal-body">
                            <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Numero</label>
                                <div class="col-sm-10"> <input type="text" name="codigo" id="codigo" class="form-control" placeholder="" required disabled autofocus value="<?php echo $codigo; ?>" onkeypress="numeros()"> </div>
                            </div>
                            <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Proveedor</label>
                                <?php if($filasProveedores>0){?>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm" name="proveedor" id="proveedor">
                                        <option value="0">Seleccione un proveedor</option>
                                        <?php while ($row=mysqli_fetch_array($proveedo)) { ?>
                                        <?php echo'<OPTION VALUE="'.$row['id_proveedor'].'">'.$row['nombre_fiscal'].'</OPTION>';?>
                                        <?php } ?>
                                    </select> </div>
                                <?php } else{ ?>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm" name="proveedor" id="proveedor">
                                        <option value="0">No hay proveedores agregados</option>
                                    </select> </div>
                                <?php }?>
                            </div>

                            <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Tipo</label>

                                <?php if ($filasPreforma>0){ ?>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm  " name="gramaje" id="gramaje">
                                        <option value="0">Seleccione una opción</option>
                                        <?php while ($row=mysqli_fetch_array($Preformas)) { ?>
                                        <?php echo'<OPTION VALUE="'.$row['id_preforma'].'">'.$row['gramaje'].'</OPTION>';?>
                                        <?php } ?>
                                    </select>
                                </div>

                                <?php } else { ?>
                                <div class="col-sm-10">
                                    <select class="form-control form-control-sm  " name="gramaje" id="gramaje">
                                        <option value="0">No hay preformas agregadas</option>
                                    </select>
                                </div>
                                <?php }?>
                            </div>
                            <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Cajas</label>
                                <div class="col-sm-10">
                                    <input type="number" name="cantidadCajas" id="cantidadCajas" class="form-control" placeholder="" required maxlength="10" autofocus onkeypress="numeros()">
                                </div>

                            </div>
                            <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Preformas</label>

                                <div class="col-sm-10"> <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="" maxlength="10" onkeypress="numeros()"> </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2">
                                    <label for="labelflete" class="col-sm-2 form-control-label">Flete</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" class="form-control boxed rounded-s" id="flete" name="flete" value="0">

                                </div>
                            </div>
                            <div>
                                <button title="Guardar Flete" class="btn  btn-sm rounded-s btn-danger test" data-toggle="modal" data-target="#guardarFlete"> <i class="fa fa-truck fa-lg"></i></button>
                            </div>

                        </div>
                        <center>
                            <div id="mensaje" class="col-md-12"></div>
                        </center>


                        <div class="modal-footer">

                            <button type="submit" class="btn btn-oval btn-primary botoncompraPreformas"> <i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
                            <button type="submit" id="cerrar" class="btn btn-oval btn-primary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>


                            <!--<button type="button" class="btn btn-oval btn-secondary" data-dismiss="modal">Cerrar</button>-->
                        </div>



                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--        </div>-->




            <div class="modal fade" id="tipoCambio" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="r_tipoCambio.php" method="post">
                            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <center>
                                    <h4 class="modal-title"><i class="fa fa-money"></i> Tipo de cambio</h4>
                                </center>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" name="numero" value="<?php echo $numero; ?>">
                                <input type="hidden" name="entrega" value="<?php echo $id; ?>">
                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-3 form-control-label">Tipo de cambio</label>
                                    <div class="col-sm-12"> <input type="text" name="tipo_cambio" id="tipo_cambio" class="form-control" placeholder="" required maxlength="10" autofocus onkeypress="return onKeyDecimal(event,this);"> </div>
                                </div>
                            </div>
                            <div class="modal-footer">

                                <button type="submit" class="btn btn-oval btn-primary"> <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                                <button type="submit" id="cerrar" class="btn btn-oval btn-primary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>


                                <!--<button type="button" class="btn btn-oval btn-secondary" data-dismiss="modal">Cerrar</button>-->
                            </div>

                        </form>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--    </div>-->




            <!-- Reference block for JS -->
            <div class="ref" id="ref">
                <div class="color-primary"></div>
                <div class="chart">
                    <div class="color-primary"></div>
                    <div class="color-secondary"></div>
                </div>
            </div>
            <script src="../js/vendor.js"></script>
            <script src="../js/app.js"></script>
</body>

</html>
