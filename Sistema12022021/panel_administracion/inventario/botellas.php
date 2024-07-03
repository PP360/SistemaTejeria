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

$query="SELECT botellas.tipo_botella, inventario_botellas.unidad_medida, inventario_botellas.cantidad FROM inventario_botellas,botellas WHERE inventario_botellas.tipo_botella=botellas.id_botella";
$inventarioBotellas=mysqli_query($conexion,$query);
$filas=mysqli_num_rows($inventarioBotellas);

?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Botellas | Tejeria Envases Plásticos </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="../css/vendor.css">
        <link rel="stylesheet" href="../css/app-green.css">
        <script src="../js/jquery.js"></script>
        <script src="../js/validator.js"></script>

        <!-- Theme initialization -->
        <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    scrollY:        '50vh',
                    scrollCollapse: true,
                    paging:         true,
                    scrollX:        true
                } );
            } );
            //loader pagina
            $(window).load(function() {
                $(".loader").fadeOut("slow");
            })
            //Toltip
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
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
            .test + .tooltip.right > .tooltip-arrow {
                border-right: 5px solid black;
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


                <?php  if($filas>0){?>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content items-list-page">
                    <section class="section">
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                                        Inventario de botellas
                                        <a href="../reportes/inventario_tapas.php"><button title="Lista de clientes" class="btn   btn-sm rounded-s btn-danger test"> <i class="fa fa-file-pdf-o  fa-lg"></i></button></a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">
                                                <center>
                                                    <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-archive"></i> Botellas en stock</button>
                                                </center>

                                            </h3> </div>
                                        <section class="example">
                                            <div class="table-responsive">
                                                <table id="example" class="table table-striped table-bordered table-hover flip-content" id="tabla" width="100%" cellspacing="0">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Botella</th>
                                                            <th>Unidad</th>
                                                            <th>En stock</th>
                                                            <th>Estatus</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php $id=1; while ($row=mysqli_fetch_array($inventarioBotellas)) { ?>
                                                        <tr>
                                                            <td><?php echo $id ?></td>
                                                            <td><?php echo $row['tipo_botella'];?></td>
                                                            <td><?php echo $row['unidad_medida'];?></td>
                                                            
                                                            <td><strong><?php echo $row['cantidad'];?></strong></td>
                                                                   <?php  $cantidadInventarioBotellas=$row['cantidad'];?>
                                                        <td>
                                                            <?php if($cantidadInventarioBotellas<=20000 && $cantidadInventarioBotellas>0){?>
                                                            <center><button type="button" class="btn  btn-warning btn-sm rounded-s"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Con baja existencia</button></center>

                                                            <?php } elseif ($cantidadInventarioBotellas<=0) {?>
                                                            <center><button type="button" class="btn btn-sm rounded-s btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Sin existencias</button></center>

                                                            <?php }  else {?>


                                                            <center><button type="button" class="btn btn-sm rounded-s btn-primary"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Con exedentes</button></center>

                                                            <?php }?>


                                                        </td>

                                                        </tr>

                                                        <?php $id++;  } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
                <?php } else {?>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content items-list-page">
                    <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">
                                                <center>
                                                    <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-archive"></i> Botellas en stock</button>
                                                </center>

                                            </h3> </div>

                                        <section class="">

                                            <center>
                                                <h5> <i class="fa fa-close" aria-hidden="true"></i> No se han  agregado botellas al inventario</h5>

                                            </center>

                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
                <?php }?>


            </div>
        </div>
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
        <script src="../js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    </body>

</html>