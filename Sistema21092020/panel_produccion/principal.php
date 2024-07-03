<?php 
include('../val_usuario.php'); 

$idRecibe=$_SESSION['id_usuario'];
$usuario="SELECT nombre_usuario FROM usuarios WHERE id_area='3' AND id_usuario = $idRecibe";
$usuar=mysqli_query($conexion,$usuario);
if ($filasUsuarios=mysqli_num_rows($usuar) == 0){
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = '/Sistema/panel_administracion';
    header("Location: http://$host$uri/produccion/principal.php");
}

$id=$_SESSION['id_usuario'];
$prefor="SELECT EP1.id_entregaPreformas, EP1.fecha_entrega, (U1.nombre_usuario) entrego, U1.turno FROM entrega_preformas EP1, entrega_preformas EP2, usuarios U1 WHERE U1.id_usuario=EP1.id_usuarioEntrega AND EP1.id_usuarioRecibe='$idRecibe'    GROUP BY  EP1.id_entregaPreformas";
$entregaPreformas=mysqli_query($conexion,$prefor);
$filaEntregaPreformas=mysqli_num_rows($entregaPreformas);
$resin="SELECT ER1.id_entregaResina, ER1.fecha_entrega, (U1.nombre_usuario) entrego, U1.turno FROM entrega_resina ER1, entrega_resina ER2, usuarios U1, usuarios U2 WHERE U1.id_usuario=ER1.id_usuarioEntrega AND  ER1.id_usuarioRecibe='$idRecibe' GROUP BY  ER1.id_entregaResina";
$entregaResina=mysqli_query($conexion,$resin);
$filasResina=mysqli_num_rows($entregaResina);
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
                   scrollY:        '50vh',
                    scrollCollapse: true,
                    paging:         true,
                    scrollX:        true

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
                            <div class="title-block">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="title">
                                            Materia en producción
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
                                                        <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-edit"></i> Preforma en producción</button>
                                                    </center>
                                                </h4>

                                            </div>
                                            <?php if ($filaEntregaPreformas>0){ ?>
                                            <div class="dataTables_scroll">
                                                 <table  class="table table-striped table-bordered table-hover flip-content display" id="tabla" width="100%" cellspacing="0">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Fecha entrega</th>
                                                            <th>Entregó</th>
                                                            <th>Turno</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php $id=1; while ($row=mysqli_fetch_array($entregaPreformas)) {  ?>
                                                        <tr>
                                                            <td><?php echo $id ?></td>
                                                            <td><?php echo $row['fecha_entrega'];?></td>
                                                            <td><?php echo $row['entrego'];?></td>
                                                            <td><?php echo $row['turno'];?></td>
                                                            <td> <a href="reportes/entrega_preformasProduccion.php?Cod=<?php echo base64_encode($row['id_entregaPreformas'])?>">
                                                                <button data-toggle="tooltip" data-placement="right" title="Ver entrega" type="button" class="btn btn-danger btn-sm rounded-s"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> </button>
                                                                </a>
                                                                <a href="detalle_entrega_preformas.php?Cod=<?php echo base64_encode($row['id_entregaPreformas'])?>">
                                                                    <button data-toggle="tooltip" data-placement="right" title="Ver entrega" type="button" class="btn btn-primary btn-sm rounded-s"><i class="fa fa-eye" aria-hidden="true"></i> </button>
                                                                </a>

                                                            </td>



                                                        </tr>

                                                        <?php $id++;  } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php } else {?>
                                            <br>
                                            <center><button type="button" class="btn btn-danger btn-large rounded-s"><i class="fa fa-times-circle" aria-hidden="true"></i> No hay preformas en produccion</button></center>
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
                                                        <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-edit"></i> Resina en producción (Preformas)</button>
                                                    </center>
                                                </h4>

                                            </div>
                                            <?php if ($filasResina>0) {?>
                                            <div class="dataTables_scroll">
                                                 <table  class="table table-striped table-bordered table-hover flip-content display" id="tabla" width="100%" cellspacing="0">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Fecha entrega</th>
                                                            <th>Entregó</th>
                                                            <th>Turno</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php $id=1; while ($row=mysqli_fetch_array($entregaResina)) { ?>
                                                        <tr>
                                                            <td><?php echo $id ?></td>
                                                            <td><?php echo $row['fecha_entrega'];?></td>
                                                            <td><?php echo $row['entrego'];?></td>
                                                            <td><?php echo $row['turno'];?></td>

                                                            <td> 
                                                                <a href="reportes/entrega_resinaProduccion.php?Cod=<?php echo base64_encode($row['id_entregaResina'])?>">
                                                                    <button data-toggle="tooltip" data-placement="right" title="Ver entrega" type="button" class="btn btn-danger btn-sm rounded-s"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> </button>
                                                                </a>


                                                                <a href="detalle_entrega_resina.php?Cod=<?php echo base64_encode($row['id_entregaResina'])?>">
                                                                    <button data-toggle="tooltip" data-placement="right" title="Ver entrega" type="button" class="btn btn-primary btn-sm rounded-s"><i class="fa fa-eye" aria-hidden="true"></i> </button>
                                                                </a>

                                                            </td>



                                                        </tr>

                                                        <?php $id++;  } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <?php } else {?>
                                            <br>
                                            <center><button type="button" class="btn btn-danger btn-large rounded-s"><i class="fa fa-times-circle" aria-hidden="true"></i> No hay resina en produccion</button></center>
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
                                                        <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-edit"></i> Resina en producción (Tapas)</button>
                                                    </center>
                                                </h4>

                                            </div>

                                            <div class="dataTables_scroll">
                                                <table  class="table table-striped table-bordered table-hover flip-content display" id="tabla" width="100%" cellspacing="0">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                            <th><center>Nombre</center></th>
                                                            <th>Stock</th>
                                                            <th><center>Estatus</center></th>


                                                        </tr>
                                                    </thead>
                                                    <tbody>



                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>

                </article>
   
                <!-- /.modal -->
                <div class="modal fade" id="myModal3" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <center>
                                    <h4 class="modal-title">Envases Plásticos la Tejería</h4>
                                </center>
                            </div>
                            <div class="modal-body">
                                <center>
                                    <p>Cierre de sesión por inactividad</p>
                                </center>
                                <div class="form-group"> <i class="fa fa-user fa-lg"></i> <label for="username">Nombre de Usuario: <?php echo $_SESSION['usuario'];?></label>
                                    <div class="form-group"> <i class="fa fa-lock fa-lg"></i> <label for="password">Contraseña</label> <input type="password" id="pass" class="form-control underlined" name="password" required> </div>

                                </div>
                                <div class="modal-footer">
                                    <button id="ingresar"> Ingresar</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
        <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    </body>

</html>
