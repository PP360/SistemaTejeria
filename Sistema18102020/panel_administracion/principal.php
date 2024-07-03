
<?php
session_start();
require_once('../conexion.php');
if(isset($_SESSION['usuario'])==false or isset($_SESSION['id_area'])==false){
    header('Location: error.php');
    session_destroy(); 
}elseif($_SESSION['id_area']!='1'){
    header('Location: error.php');
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
        print "<script>window.location='login.php';</script>";
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
$prefor=mysqli_query($conexion, "SET lc_time_names = 'es_ES'"); 
$query="SELECT CP.id_compraPreformas,  CP.codigo_compraPreformas, MONTHNAME(CP.fecha_compra) , SUM(CP.total_compra) FROM compra_preformas CP  GROUP BY MONTHNAME(CP.fecha_compra)  ORDER BY CP.id_compraPreformas";
$compraPreforma=mysqli_query($conexion,$query);
$filas=mysqli_num_rows($compraPreforma);

$query2="SELECT CR.id_compraResina, CR.codigo_compraResina,MONTHNAME(CR.fecha_compra),SUM(CR.total_compra)FROM compra_resina CR  GROUP BY MONTHNAME(CR.fecha_compra)";
$compraResina=mysqli_query($conexion,$query2);
$filasResina=mysqli_num_rows($compraResina);


$query3="SELECT CT.id_compraTapas, CT.codigo_compraTapas,MONTHNAME(CT.fecha_compra),SUM(CT.total_compra)FROM compra_tapas CT  GROUP BY MONTHNAME(CT.fecha_compra)  ORDER BY CT.id_compraTapas";
$compraTapas=mysqli_query($conexion,$query3);
$filasTapas=mysqli_num_rows($compraTapas);

?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Menú Principal | Tejeria Envases Plasticos </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="../css/vendor.css">
        <link rel="stylesheet" href="../css/app-green.css">
        <script src="js/jquery.js"></script>


        <!-- Theme initialization -->
        <script>
            $(window).load(function() {
                $(".loader").fadeOut("slow");
            });
            $(document).ready(function() {
                $('table.display').DataTable({
                    //"paging":   false,
                    "ordering": false,
                    "info":     false,
                    "searching": false

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
                background: url('img/pre_loader.svg') 50% 50% no-repeat rgb(249,249,249);
            }
        </style>
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
                                <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> <span class="name">
                                    Bienvenido <?php echo $_SESSION['usuario']; ?>
                                    </span> </a>
                            </li>
                        </ul>
                    </div>
                </header>
                <!-- Panel de navegación -->
                <?php include('nav_admin.php'); ?>
                
                <!--Inicia estructura BODY-->
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content dashboard-page">
                    <div class="title-block">
                        <h3 class="title">
                            Estado de compra de materia prima
                        </h3>
                    </div>
                    <section class="section">
                        <div class="row">
                            <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-6 stats-col">
                                <div class="card sameheight-item stats" data-exclude="xs">
                                    <div class="card-block">
                                        <div class="title-block">
                                            <h4 class="title">
                                                <center>
                                                    <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-edit"></i> Compras mensuales (Preforma)</button>
                                                </center>
                                            </h4>

                                        </div>
                                        <?php  if($filas>0){ ?>
                                        <div class="table-responsive">
                                            <table  class="table table-striped table-bordered table-hover flip-content display" id="tabla" width="100%" cellspacing="0">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Mes</th>
                                                        <th>Importe</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php $id=1; while ($row=mysqli_fetch_array($compraPreforma)) { ?>
                                                    <tr>
                                                        <td><?php echo $id ?></td>
                                                        <td><?php echo $row['MONTHNAME(CP.fecha_compra)'];?></td>
                                                        <td><strong>$ <?php echo round( $row['SUM(CP.total_compra)'],4);?></strong></td>
                                                    </tr>

                                                    <?php $id++;  } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php } else{ ?>
                                        <br>
                                        <center><button type="button" class="btn btn-danger btn-large rounded-s"><i class="fa fa-times-circle" aria-hidden="true"></i> No hay compras de preformas</button></center>
                                        <br>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-6 stats-col">
                                <div class="card sameheight-item stats" data-exclude="xs">
                                    <div class="card-block">
                                        <div class="title-block">
                                            <h4 class="title">
                                                <center>
                                                    <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-line-chart" aria-hidden="true"></i> Compra de preformas</button>
                                                </center>
                                            </h4>

                                        </div>
                                        <label for="">Año</label> <select onChange="mostrarResultados(this.value);">

                                        <?php
                                        for($i=2016;$i<2020;$i++){
                                            if($i == 2017){
                                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                            }else{
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                        }
                                        ?>
                                        </select>

                                        <div><canvas id="graficoPreformas" height="210px"></canvas></div>

                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-6 stats-col">
                                <div class="card sameheight-item stats" data-exclude="xs">
                                    <div class="card-block">
                                        <div class="title-block">
                                            <h4 class="title">
                                                <center>
                                                    <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-edit"></i> Compras mensuales (Resina)</button>
                                                </center>
                                            </h4>

                                        </div>
                                        <?php  if($filasResina>0){ ?>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover flip-content display"  id="tabla" width="100%" cellspacing="0">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Mes</th>
                                                        <th>Importe</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php $id=1; while ($row=mysqli_fetch_array($compraResina)) { ?>
                                                    <tr>
                                                        <td><?php echo $id ?></td>
                                                        <td><?php echo $row['MONTHNAME(CR.fecha_compra)'];?></td>
                                                        <td><strong>$ <?php echo round($row['SUM(CR.total_compra)'],4);?></strong></td>
                                                    </tr>

                                                    <?php $id++;  } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php } else{ ?>
                                        <br>
                                        <center><button type="button" class="btn btn-danger btn-large rounded-s"><i class="fa fa-times-circle" aria-hidden="true"></i> No hay compras de resinas</button></center>
                                        <br>
                                        <?php } ?>


                                    </div>
                                </div>
                            </div>
                            <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-6 stats-col">
                                <div class="card sameheight-item stats" data-exclude="xs">
                                    <div class="card-block">
                                        <div class="title-block">
                                            <h4 class="title">
                                                <center>
                                                    <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-line-chart" aria-hidden="true"></i> Compra de resina</button>
                                                </center>
                                            </h4>

                                        </div>
                                        <label for="">Año</label> <select onChange="mostrarResultadosResina(this.value);">
                                        <?php
                                        for($i=2017;$i<2020;$i++){
                                            if($i == 2017){
                                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                            }else{
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                        }
                                        ?>
                                        </select>

                                        <div><canvas id="graficoResina" height="210px"></canvas></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-6 stats-col">
                                <div class="card sameheight-item stats" data-exclude="xs">
                                    <div class="card-block">
                                        <div class="title-block">
                                            <h4 class="title">
                                                <center>
                                                    <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-edit"></i> Compras mensuales (Tapas)</button>
                                                </center>
                                            </h4>

                                        </div>
                                        <?php  if($filasTapas>0){ ?>
                                        <div class="table-responsive">
                                            <table  class="table table-striped table-bordered table-hover flip-content display" id="tabla" width="100%" cellspacing="0">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Mes</th>
                                                        <th>Importe</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php $id=1; while ($row=mysqli_fetch_array($compraTapas)) { ?>
                                                    <tr>
                                                        <td><?php echo $id ?></td>
                                                        <td><?php echo $row['MONTHNAME(CT.fecha_compra)'];?></td>
                                                        <td><strong>$ <?php echo round($row['SUM(CT.total_compra)'],4);?></strong></td>
                                                    </tr>

                                                    <?php $id++;  } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php } else{ ?>
                                        <br>
                                        <center><button type="button" class="btn btn-danger btn-large rounded-s"><i class="fa fa-times-circle" aria-hidden="true"></i> No hay compras de tapas</button></center>
                                        <br>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-6 stats-col">
                                <div class="card sameheight-item stats" data-exclude="xs">
                                    <div class="card-block">
                                        <div class="title-block">
                                            <h4 class="title">
                                                <center>
                                                    <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-line-chart" aria-hidden="true"></i> Compra de tapas</button>
                                                </center>
                                            </h4>

                                        </div>
                                        <label for="">Año</label> <select onChange="mostrarResultadosTapas(this.value);">
                                        <?php
                                        for($i=2017;$i<2020;$i++){
                                            if($i == 2017){
                                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                            }else{
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                        }
                                        ?>
                                        </select>

                                        <div><canvas id="graficoTapas" height="210px"></canvas></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
                <!-- /.modal -->
                <!-- /.modal -->
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
        <script type="text/javascript" src="js/chartJS/Chart.min.js"></script>
        <script src="js/graficaCompraPreformas.js"></script>
        <script src="js/graficaCompraResina.js"></script>
        <script src="js/graficaCompraTapas.js"></script>
        <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    </body>

</html>
