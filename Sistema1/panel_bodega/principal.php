<?php
session_start();
include('conexion.php');
if(isset($_SESSION['usuario'])==false or isset($_SESSION['id_area'])==false){
    header('Location:../panel_administracion/error.php');
}
elseif(!($_SESSION['id_area']=='2' || $_SESSION['id_area'] == '1')){
    header('Location:../panel_administracion/error.php');
    session_destroy();
}
elseif($_SESSION['id_area']=='2' || $_SESSION['id_area'] == '1')
{
    $fechaGuardada = $_SESSION["ultimoAcceso"]; 
    $ahora = date("Y-n-j H:i:s"); 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 
    $self = $_SERVER['PHP_SELF']; 
    header("refresh:1200; url=$self");
    if($tiempo_transcurrido >=1200) {
        print "<script>window.location='../panel_administracion/login.php';</script>";  
    }else { 
        $_SESSION["ultimoAcceso"] = $ahora; 
    } 
}
else{
    if($_SESSION['id_area'] == '1'){
        header('Location:../panel_administracion/principal.php');
    }
}

?>
<?php
$invent="SELECT preformas.gramaje, inventario_preformas.cantidad  FROM inventario_preformas, preformas WHERE preformas.id_preforma=inventario_preformas.id_preforma";
$invenPreformas=mysqli_query($conexion,$invent);
$filasPreformas=mysqli_num_rows($invenPreformas);

$inventResina="SELECT resina.nombre, inventario_resina.cantidad FROM inventario_resina, resina WHERE resina.id_resina=inventario_resina.id_resina";
$inventResin=mysqli_query($conexion,$inventResina);
$filasResina=mysqli_num_rows($inventResin);

$invenTapas ="SELECT tapas.id_tapa, tapas.tamano,  tapas.unidad_medida, inventario_tapas.id_tapa, inventario_tapas.cantidad, inventario_tapas.id_inventarioTapas FROM tapas, inventario_tapas WHERE inventario_tapas.id_tapa=tapas.id_tapa";
$invenTa=mysqli_query($conexion,$invenTapas);
$filasTapas=mysqli_num_rows($invenTa);

$invenBotellas="SELECT ib.id_inventarioBotella,b.tipo_botella,ib.cantidad FROM botellas b, inventario_botellas ib 
where  b.id_botella=ib.tipo_botella";
$invenBo=mysqli_query($conexion,$invenBotellas);
$filasBotellas=mysqli_num_rows($invenBo);

?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Menú Principal | Tejeria Envases Plásticos </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <link rel="stylesheet" href="css/app-green.css">
        <script src="js/jquery.js"></script>
        <script>
            //loader pagina
            $(window).load(function() {
                $(".loader").fadeOut("slow");
            });
            $(document).ready(function() {
                $('table.display').DataTable({
                    //"paging":   false,
                    "ordering": false,
                    "info":     false,
                    //"searching": false

                });
            } );
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
                background: url('img/pre_loader.svg') 50% 50% no-repeat rgb(249, 249, 249);
            }

        </style>

        <!-- Theme initialization -->

    </head>

    <body>
        <div class="loader"></div>
        <div class="main-wrapper">
            <div class="app" id="app">
                <!--Inicia estructura del header-->
                <header class="header">
                    <div class="header-block header-block-collapse hidden-lg-up"> <button class="collapse-btn" id="sidebar-collapse-btn">
                        <i class="fa fa-bars"></i>
                        </button> </div>
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
                <?php include('nav_bodega.php'); ?>
                
                <!--Inicia estructura BODY-->
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content dashboard-page">
                    <section class="section">
                        <div class="row sameheight-container">
                            <div class="title-block">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="title">
                                            Inventario de materia prima

                                        </h3>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-9 stats-col">
                                    <div class="card sameheight-item stats" data-exclude="xs">
                                        <div class="card-block">
                                            <div class="title-block">
                                                <h4 class="title">
                                                    <center>
                                                        <button type="button" class="btn btn-primary btn-sm btn-block display"> <i class="fa fa-edit"></i> Estado del inventario de preformas</button>
                                                    </center>
                                                </h4>

                                            </div>

                                            <?php if ($filasPreformas>0){ ?>
                                            <div class="table-responsive">
                                                <table  class="table table-striped table-bordered table-hover flip-content display" id="tabla" width="100%" cellspacing="0">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                            <th><center>Concepto</center></th>
                                                            <th>Stock</th>
                                                            <th><center>Estatus</center></th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php while ($row=mysqli_fetch_array($invenPreformas)) {   ?>

                                                        <tr>
                                                            <td><?php echo $row['gramaje'];?></td>
                                                            <td><?php echo $cantidadInventario=$row['cantidad'];?></td>
                                                            <td>
                                                                <?php if($cantidadInventario<=20000 && $cantidadInventario>0){?>
                                                                <center><button type="button" class="btn  btn-warning btn-sm rounded-s"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Con baja existencia</button></center>

                                                                <?php } elseif ($cantidadInventario<=0) {?>
                                                                <center><button type="button" class="btn btn-danger btn-sm rounded-s"><i class="fa fa-times-circle" aria-hidden="true"></i> Sin existencias</button></center>

                                                                <?php }  else {?>


                                                                <center><button type="button" class="btn  btn-primary btn-sm rounded-s"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Con exedentes</button></center>

                                                                <?php }?>


                                                            </td>

                                                        </tr>

                                                        <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>


                                            <?php } else {?>
                                            <br>
                                            <center><button type="button" class="btn btn-danger btn-large rounded-s"><i class="fa fa-times-circle" aria-hidden="true"></i> No hay preformas en el inventario</button></center>
                                            <br>

                                            <?php }?>





                                        </div>
                                    </div>
                                </div> 
                            </div>
                            
                            <p>Se considera con baja existencia cuando existen menos de 20,000 piezas</p>
                            <p>Con excedentes se considera si existen más de 20,000 piezas</p>
                            
                            <div class="row">
                                <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-9 stats-col">
                                    <div class="card sameheight-item stats" data-exclude="xs">
                                        <div class="card-block">
                                            <div class="title-block">
                                                <h4 class="title">
                                                    <center>
                                                        <button type="button" class="btn btn-primary btn-sm btn-block display"> <i class="fa fa-edit"></i> Estado del inventario de Botellas</button>
                                                    </center>
                                                </h4>

                                            </div>

                                            <?php if ($filasBotellas>0){ ?>
                                            <div class="table-responsive">
                                                <table  class="table table-striped table-bordered table-hover flip-content display" id="tabla" width="100%" cellspacing="0">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                            <th><center>No.</center></th>
                                                            <th>Tipo de botella</th>
                                                            <th><center>Cantidad</center></th>
                                                            <th>Estatus</th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php while ($row=mysqli_fetch_array($invenBo)) {   ?>

                                                        <tr>
                                                            <td><?php echo $row['id_inventarioBotella'];?></td>
                                                            <td><?php echo $row['tipo_botella'];?></td>
                                                            <td><?php echo $cantidadInventario=$row['cantidad'];?></td>
                                                            <td>
                                                                <?php if($cantidadInventario<=20000 && $cantidadInventario>0){?>
                                                                <center><button type="button" class="btn  btn-warning btn-sm rounded-s"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Con baja existencia</button></center>

                                                                <?php } elseif ($cantidadInventario<=0) {?>
                                                                <center><button type="button" class="btn btn-danger btn-sm rounded-s"><i class="fa fa-times-circle" aria-hidden="true"></i> Sin existencias</button></center>

                                                                <?php }  else {?>


                                                                <center><button type="button" class="btn  btn-primary btn-sm rounded-s"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Con exedentes</button></center>

                                                                <?php }?>


                                                            </td>

                                                        </tr>

                                                        <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>


                                            <?php } else {?>
                                            <br>
                                            <center><button type="button" class="btn btn-danger btn-large rounded-s"><i class="fa fa-times-circle" aria-hidden="true"></i> No hay preformas en el inventario</button></center>
                                            <br>

                                            <?php }?>





                                        </div>
                                    </div>
                                </div> 
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            

                            <div class="row">
                                <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-9 stats-col">
                                    <div class="card sameheight-item stats" data-exclude="xs">
                                        <div class="card-block">
                                            <div class="title-block">
                                                <h4 class="title">
                                                    <center>
                                                        <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-edit"></i> Estado del inventario de resina</button>
                                                    </center>
                                                </h4>

                                            </div>
                                            <?php if($filasResina>0){ ?>
                                            <div class="table-responsive">
                                                <table  class="table table-striped table-bordered table-hover flip-content display" id="tabla" width="100%" cellspacing="0">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                            <th><center>Nombre</center></th>
                                                            <th>Stock</th>
                                                            <th><center>Estatus</center></th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php while ($row=mysqli_fetch_array($inventResin)) { ?>

                                                        <tr>
                                                            <td><?php echo $row['nombre'];?></td>
                                                            <td><?php echo $cantidadInventarioResina=$row['cantidad'];?></td>
                                                            <td>
                                                                <?php if($cantidadInventarioResina<=20000 && $cantidadInventarioResina>0){?>
                                                                <center><button type="button" class="btn  btn-warning btn-sm rounded-s"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Con baja existencia</button></center>

                                                                <?php } elseif ($cantidadInventarioResina<=0) {?>
                                                                <center><button type="button" class="btn btn-sm rounded-s btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Sin existencias</button></center>

                                                                <?php }  else {?>


                                                                <center><button type="button" class="btn btn-sm rounded-s btn-primary"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Con exedentes</button></center>

                                                                <?php }?>


                                                            </td>

                                                        </tr>

                                                        <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php } else {?>
                                            <br>
                                            <center><button type="button" class="btn btn-danger btn-large rounded-s"><i class="fa fa-times-circle" aria-hidden="true"></i> No hay resina en el inventario</button></center>
                                            <br>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-9 stats-col">
                                    <div class="card sameheight-item stats" data-exclude="xs">
                                        <div class="card-block">
                                            <div class="title-block">
                                                <h4 class="title">
                                                    <center>
                                                        <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-edit"></i> Estado del inventario de tapas</button>
                                                    </center>
                                                </h4>

                                            </div>
                                            <?php  if($filasTapas>0){ ?>
                                            <div class="table-responsive">
                                                <table  class="table table-striped table-bordered table-hover flip-content display" id="tabla" width="100%" cellspacing="0">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                            <th><center>Concepto</center></th>
                                                            <th><center>Color</center></th>
                                                            <th>Stock</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php while ($row=mysqli_fetch_array($invenTa)) { ?>

                                                        <tr>
                                                            <td><?php echo $row['tamano'];?></td>
                                                            <td><?php echo $cantidadInventarioTapas=$row['cantidad'];?></td>
                                                            <td>
                                                                <?php if($cantidadInventarioTapas<=20000 && $cantidadInventarioTapas>0){?>
                                                                <center><button type="button" class="btn  btn-warning btn-sm rounded-s"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Con baja existencia</button></center>

                                                                <?php } elseif ($cantidadInventarioTapas<=0) {?>
                                                                <center><button type="button" class="btn btn-sm rounded-s btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Sin existencias</button></center>

                                                                <?php }  else {?>


                                                                <center><button type="button" class="btn btn-sm rounded-s btn-primary"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Con exedentes</button></center>

                                                                <?php }?>


                                                            </td>

                                                        </tr>

                                                        <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php } else{ ?>
                                            <br>
                                            <center><button type="button" class="btn btn-danger btn-large rounded-s"><i class="fa fa-times-circle" aria-hidden="true"></i> No hay tapas en el inventario</button></center>
                                            <br>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </section>
                </article>

            </div>
        </div>

        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
        <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    </body>

</html>
