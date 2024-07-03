<?php
include('../../val_usuario.php'); 
?>
<?php
$id=base64_decode($_GET['Cod']);
$resina="SELECT R.nombre, R.unidad_medida, ER1.id_entregaResina, DE.cantidad FROM entrega_resina ER1, entrega_resina ER2, usuarios U1, usuarios U2, detalle_entregaresina DE,resina R WHERE U1.id_usuario=ER1.id_usuarioEntrega AND U2.id_usuario=ER1.id_usuarioRecibe  AND ER1.id_entregaResina=DE.id_entregaResina AND R.id_resina=DE.id_resina AND DE.id_entregaResina='$id'  GROUP BY  ER1.id_entregaResina";
$entregaResina=mysqli_query($conexion,$resina);
$filaEntregaResina=mysqli_num_rows($entregaResina);
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
                <?php include('nav_produccion.php'); ?>
                
                <!--Inicia estructura BODY-->
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content dashboard-page">
                    <section class="section">
                        <div class="row sameheight-container">
                              <div class="row">

                                <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-9 stats-col">
                                    <div class="card sameheight-item stats" data-exclude="xs">
                                        <div class="card-block">
                                            <div class="title-block">
                                                <h4 class="title">
                                                    <center>
                                                        <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-edit"></i> Detalle de producción</button>
                                                    </center>
                                                </h4>

                                            </div>
                                            <?php if ($filaEntregaResina>0){ ?>
                                            
                                            <div class="table-responsive">
                                                <table id="example" class="table table-striped table-bordered table-hover flip-content" id="tabla" width="100%" cellspacing="0">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Concepto</th>
                                                            <th>Unidad</th>
                                                            <th>Cantidad</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php $id=1; while ($row=mysqli_fetch_array($entregaResina)) {  ?>
                                                        <tr>
                                                            <td><?php echo $id ?></td>
                                                            <td><?php echo $row['nombre'];?></td>
                                                            <td><?php echo $row['unidad_medida'];?></td>
                                                            <td><?php echo $row['cantidad'];?></td>
                                                        </tr>

                                                        <?php $id++;  } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php } else {?>
                                            <br>
                                            <center><button type="button" class="btn btn-danger btn-large rounded-s btn-sm"><i class="fa fa-times-circle" aria-hidden="true"></i> No hay detalles de produccion</button></center>
                                            <br>
                                            <?php }?>
                                            <a href="principal.php">
                                                <button class="btn btn-oval btn-danger"><i class="fa fa-arrow-left" aria-hidden="true" ></i> Regresar</button>
                                            </a>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>

                </article>
                <!-- /.modal -->
            </div>
        </div>

        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
        <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    </body>

</html>