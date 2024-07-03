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
$query="SELECT * FROM preformas";
$preformas=mysqli_query($conexion,$query);
$filas=mysqli_num_rows($preformas);

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

    <!-- Theme initialization -->
    <script>
        //loader pagina
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });

        $(document).ready(function() {
            $('#example').DataTable({
                scrollY: '50vh',
                scrollCollapse: true,
                paging: true,
                scrollX: true,
                scroller: true,
                deferRender: true,
                responsive: true
            });
        });
        //Toltip
        $(document).ready(function() {
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
                <div class="title-search-block">
                    <div class="title-block">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="title">
                                    Preformas
                                    <a class="btn btn-primary btn-sm rounded-s" data-toggle="modal" data-target="#registroPreforma">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                                    </a>
                                    <a href="../comprar/comprar_preformas.php"><button data-toggle="tooltip" data-placement="top" title="Comprar preforma" title="Comprar preformas" class="btn   btn-sm rounded-s btn-danger test"> <i class="fa fa-shopping-cart fa-lg"></i></button></a>
                                    <a href="../reportes/lista_preformas.php"><button title="Lista de preformas" data-toggle="tooltip" data-placement="right" title="Lista de preformas" class="btn   btn-sm rounded-s btn-danger test"> <i class="fa fa-file-pdf-o  fa-lg"></i></button></a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="card-title-block">
                                        <h3 class="title">
                                            <center>
                                                <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-archive"></i> Listado de preformas</button>
                                            </center>

                                        </h3>
                                    </div>
                                    <section class="example">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered table-hover flip-content" id="tabla" width="100%" cellspacing="0">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Concepto</th>
                                                        <th>Unidad</th>
                                                        <th> Precio usd</th>
                                                        <th> Mill/Caja</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php $id=1; while ($row=mysqli_fetch_array($preformas)) { ?>
                                                    <tr>
                                                        <td><?php echo $id ?></td>
                                                        <td><?php echo $row['gramaje'];?></td>
                                                        <td><?php echo $row['unidad_medida'];?></td>
                                                        <td><?php echo $row['usd'];?></td>
                                                        <td><?php echo $row['millarcaja'];?></td>



                                                        <td> <a href="mod_preformas.php?id=<?php echo base64_encode($row['id_preforma'])?>">
                                                                <button type="button" class="btn btn-primary btn-sm rounded-s"><i class="fa fa-pencil"></i></button>
                                                            </a><a onclick=" return eliminar();" href="elim_preformas.php?id=<?php echo base64_encode($row['id_preforma'])?>">
                                                                <button type="button" class=" btn msg-cond btn-danger btn-sm rounded-s"><i class="fa fa-trash"></i></button>
                                                            </a></td>



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
                <div class="title-search-block">
                    <div class="title-block">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="title">
                                    Preformas
                                    <a class="btn btn-primary btn-sm rounded-s" data-toggle="modal" data-target="#registroPreforma">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                                    </a>

                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="card-title-block">
                                        <h3 class="title">
                                            <center>
                                                <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-archive"></i> Listado de preformas</button>
                                            </center>

                                        </h3>
                                    </div>

                                    <section class="">

                                        <center>
                                            <h5> <i class="fa fa-close" aria-hidden="true"></i> No se han agregado preformas al sistema, puedes agregar uno dando clic en <a class="btn btn-primary btn-sm rounded-s" data-toggle="modal" data-target="#registroPreforma">
                                                    <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                                                </a> </h5>

                                        </center>

                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </article>
            <?php }?>

            <div class="modal fade" id="registroPreforma" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="r_preformas.php" method="post">
                            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <center>
                                    <h4 class="modal-title"><i class="fa fa-archive"></i> Registro de preformas</h4>
                                </center>
                            </div>

                            <div class="modal-body">

                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-3 form-control-label">Unidad</label>
                                    <div class="col-sm-9"> <input type="text" name="unidad_medida" id="unidad_medida" class="form-control" placeholder="" required maxlength="10" onkeypress="letras()" value="Pza"> </div>
                                </div>
                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-3 form-control-label">Concepto</label>
                                    <div class="col-sm-9"> <input type="text" name="gramaje" id="gramaje" class="form-control" placeholder="" required maxlength="50"> </div>
                                </div>
                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-3 form-control-label">Precio USD</label>
                                    <div class="col-sm-9"> <input type="text" name="dolar" id="dolar" class="form-control" placeholder="" required maxlength="10" onkeypress="return onKeyDecimal(event,this);"> </div>
                                </div>
                                <div class="form-group row"> <label for="inputmillarxcaja" class="col-sm-3 form-control-label">Millar x Caja</label>
                                    <div class="col-sm-9"> <input type="text" name="millarxcaja" id="millarxcaja" class="form-control" placeholder="" required maxlength="10" onkeypress="return onKeyDecimal(event,this);"> </div>
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
        </div>
    </div>

    <!-- /.modal -->


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
