<?php
	include('../../val_usuario.php');

$idRecibe=$_SESSION['id_usuario'];
//$prefor="SELECT  produccion_botella.fecha_produccion,preformas.gramaje, produccion_botella.id_entregaPreformas, (usuarios.nombre_usuario) 
//entrego, usuarios.turno, produccion_botella.estatus  
//FROM produccion_botella, detalle_entregapreformas, usuarios, preformas 
//WHERE produccion_botella.id_usuarioProduce=$idRecibe AND usuarios.id_usuario=produccion_botella.id_usuarioProduce AND detalle_entregapreformas.id_entregaPreformas=produccion_botella.id_entregaPreformas AND preformas.id_preforma=detalle_entregapreformas.id_preforma";
/*$prefor="SELECT PB.fecha_produccion,P.gramaje, PB.id_entregaPreformas, (U.nombre_usuario) 
entrego, U.turno, PB.estatus 
FROM produccion_botella PB, detalle_entregapreformas DEP, usuarios U, preformas P 
WHERE PB.id_usuarioProduce='$idRecibe'  AND
U.id_usuario=PB.id_usuarioProduce AND DEP.id_detalleEntregaPreformas=PB.id_entregaPreformas AND P.id_preforma=DEP.id_preforma";
*/

//ESTA ERA LA BUENA 20/09/2020
//$prefor="SELECT PB.fecha_produccion,P.gramaje, PB.id_entregaPreformas, (U.nombre_usuario) 
//entrego, U.turno, PB.estatus 
//FROM produccion_botella PB, detalle_entregapreformas DEP, usuarios U, preformas P 
//WHERE 
// DEP.id_detalleEntregaPreformas=PB.id_entregaPreformas AND P.id_preforma=DEP.id_preforma";

//AHORA ESTA ES LA BUENA
$prefor="SELECT 
PB.fecha_produccion,
P.gramaje, 
PB.id_entregaPreformas, 
(U.nombre_usuario) entrego, 
U.turno, 
PB.estatus 
FROM 
produccion_botella PB, detalle_entregapreformas DEP, 
usuarios U, 
preformas P, 
entrega_preformas EP
WHERE 
 DEP.id_EntregaPreformas=PB.id_entregaPreformas AND P.id_preforma=DEP.id_preforma AND
 DEP.id_preforma=P.id_preforma AND
 U.id_usuario=PB.id_usuarioProduce AND
 EP.id_entregaPreformas=DEP.id_entregaPreformas
 ORDER BY (id_entregaPreformas)";

$entregaPreformas=mysqli_query($conexion,$prefor);
$filaEntregaPreformas=mysqli_num_rows($entregaPreformas);

$result = mysqli_query($conexion, "SELECT id_area from usuarios where id_usuario = $idRecibe");
$id_area = mysqli_fetch_array($result);
$detalleEntrega="SELECT entrega_preformas.id_entregaPreformas, concat(entrega_preformas.id_entregaPreformas,' ',preformas.gramaje)as Detalle 
FROM entrega_preformas INNER JOIN detalle_entregapreformas ON (entrega_preformas.id_entregaPreformas = detalle_entregapreformas.id_entregapreformas)
INNER JOIN preformas ON preformas.id_preforma = detalle_entregapreformas.id_preforma";

$detalle=mysqli_query($conexion,$detalleEntrega);
$botella="SELECT * FROM botellas";
$tipo=mysqli_query($conexion,$botella);
?>
<!doctype html>
<html class="no-js" lang="es">

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
            $('#example').DataTable({
                "order": [
                    [1, "desc"]
                ],
                scrollY: '50vh',
                scrollCollapse: true,
                paging: true,
                scrollX: true
            });
        });

        $(document).ready(function() {
            $("#entrega").change(function(event) {

                calcularBotella();
                var id = $("#entrega").find(':selected').val();

                if (id == "0") {
                    document.calcularBotellas.elaborada.value = 0;
                }

                $("#cantidad").load('obtener_cantidadEntrega.php?id=' + id);
                //aqui debo colocar el tipo de preformas en un input text
                //$("#tipo_preforma").load('obtener_tipo_preforma.php?id'+id);
                console.log(id);
                $("#tipo_pre").val(id);
            });


        });

        function calcularBotella() {

            var cantidad = parseInt(document.calcularBotellas.cantidad.value);
            var merma = parseInt(document.calcularBotellas.cant_merma.value);
            var cantPendiente = parseInt(document.calcularBotellas.cant_pendiente.value);
            var botellaElaborada = parseInt(document.calcularBotellas.elaborada.value);
            var estatus = parseInt(document.calcularBotellas.estatus.value);
            var total = document.calcularBotellas.elaborada.value = cantidad - (merma + cantPendiente);
            var suma = merma + cantPendiente;

            if (merma > cantidad || cantPendiente > cantidad) {
                $('#mensaje').addClass('error').html('<i class="fa fa-check" aria-hidden="true"></i> El valor debe ser menor a la cantidad entregada ').show(150).delay(3800).hide(150);
                var cant_merma = $("#cant_merma").val("");
                var elaborada = $("#elaborada").val("");
                var cant_pendiente = $("#cant_pendiente").val("");
            }
            document.calcularBotellas.estatus.value = "Completada";


        }

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
                                        Producto terminado
                                        <a class="btn btn-primary btn-sm rounded-s" data-toggle="modal" data-target="#salida_botella">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                                        </a>
                                    </h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="title">
                                        Reporte de Producción
                                        <a class="btn btn-primary btn-sm rounded-s" data-toggle="modal" data-target="#Reporte_Produccion">
                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generar
                                        </a>
                                    </h3>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="card sameheight-item stats" data-exclude="xs">
                                    <div class="card-block">
                                        <div class="title-block">
                                            <h4 class="title">
                                                <center>
                                                    <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-edit"></i> Botella en producción</button>
                                                </center>
                                            </h4>

                                        </div>
                                        <?php if ($filaEntregaPreformas>0){ ?>
                                        <section class="example">
                                            <div class="dataTables_scroll">
                                                <table id="example" class="table table-striped table-bordered table-hover flip-content" id="tabla" width="100%" cellspacing="0">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Fecha</th>
                                                            <th>Tipo</th>
                                                            <th>Entregó</th>
                                                            <th>Turno</th>
                                                            <th>Estatus</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php $id=1; while ($row=mysqli_fetch_array($entregaPreformas)) {  ?>
                                                        <tr>
                                                            <td><?php echo $id;?></td>
                                                            <td><?php echo $row['fecha_produccion'];?></td>
                                                            <td><?php echo $row['gramaje'];?></td>
                                                            <td><?php echo $row['entrego'];?></td>
                                                            <td><?php echo $row['turno'];?></td>
                                                            <?php $Estatus=$row['estatus'];?>
                                                            <td>
                                                                <?php if($Estatus=="Incompleta"){?>
                                                                <center><button type="button" class="btn  btn-warning btn-sm rounded-s"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Incompleta</button></center>

                                                                <?php } elseif ($Estatus=="Completada") {?>
                                                                <center><button type="button" class="btn  btn-primary btn-sm rounded-s"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Completada</button></center>

                                                                <?php }?>

                                                            </td>

                                                            <td>
                                                                <a href="reportes/terminado_salidaBotellas.php?Cod=<?php echo base64_encode($row['id_entregaPreformas'])?>">
                                                                    <button data-toggle="tooltip" data-placement="right" title="Ver reporte de entrega" type="button" class="btn btn-primary btn-sm rounded-s"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> </button>
                                                                </a>
                                                                <a href="detalle_produccion_botellas.php?Cod=<?php echo base64_encode($row['id_entregaPreformas'])?>">
                                                                    <button data-toggle="tooltip" data-placement="right" title="Ver entrega" type="button" class="btn btn-primary btn-sm rounded-s"><i class="fa fa-eye" aria-hidden="true"></i> </button>
                                                                </a>
                                                            </td>


                                                        </tr>

                                                        <?php $id++;  } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </section>
                                        <?php } else {?>
                                        <br>
                                        <center><button type="button" class="btn btn-danger btn-large rounded-s"><i class="fa fa-times-circle" aria-hidden="true"></i> No hay preformas en producción</button></center>
                                        <br>
                                        <?php }?>



                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </section>

            </article>
            <!-- /.modal -->
            <!-- /.modal -->
            <div class="modal fade" id="salida_botella" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="r_salidaBotellas.php" name="calcularBotellas" method="post">
                            <input type="hidden" name="idRecibe" value="<?php echo $idRecibe; ?>">
                            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <center>
                                    <h4 class="modal-title"><i class="fa fa-archive"></i> Botellas</h4>
                                </center>
                            </div>

                            <div class="modal-body">
                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Entrega</label>
                                    <div class="col-sm-10">
                                        <select class="form-control form-control-sm  " name="entrega" id="entrega">
                                            <option value="0">Seleccione una opción</option>
                                            <?php while ($row=mysqli_fetch_array($detalle)) { ?>
                                            <?php 

                                                echo'<OPTION VALUE="'.$row['id_entregaPreformas'].'">'.$row['Detalle'].'</OPTION>';?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Cantidad</label>
                                    <div class="col-sm-10"> <select class="form-control form-control-sm  " name="cantidad" onkeyup="calcularBotella()" id="cantidad"> </select> </div>
                                </div>
                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Botella</label>
                                    <div class="col-sm-10"> <select class="form-control form-control-sm  " name="botella" id="botella">
                                            <option value="0">Seleccione una opción</option>
                                            <?php while ($row=mysqli_fetch_array($tipo)) { ?>
                                            <?php echo'<OPTION VALUE="'.$row['id_botella'].'">'.$row['tipo_botella'].'</OPTION>';?>
                                            <?php } ?>
                                        </select></div>
                                </div>
                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Merma</label>
                                    <div class="col-sm-10"> <input type="number" name="cant_merma" id="cant_merma" class="form-control" onkeyup="calcularBotella()" placeholder="" required maxlength="50"> </div>
                                </div>
                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Devolución</label>
                                    <div class="col-sm-10"> <input type="number" name="cant_pendiente" id="cant_pendiente" onkeyup="calcularBotella()" class="form-control" placeholder="" required maxlength="50"> </div>
                                </div>

                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Elaboradas</label>
                                    <div class="col-sm-10"> <input type="text" name="elaborada" id="elaborada" class="form-control" placeholder="" value="0" required maxlength="10" onkeypress="letras()"> </div>
                                </div>
                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Estatus</label>
                                    <div class="col-sm-10"> <input type="text" name="estatus" id="estatus" class="form-control" placeholder="" required maxlength="10" onkeypress="letras()"> </div>
                                </div>
                                <div class="col-sm-10"><input type="hidden" name="tipo_pre" id="tipo_pre" class="form-control">

                                </div>
                                <center>
                                    <div id="mensaje" class="col-md-12"></div>
                                </center>
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


            <div class="modal fade" id="Reporte_Produccion" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="reportes/produccion_fechas.php" method="post">
                            <!--                                <input type="hidden" name="idRecibe" value="<?php echo $idRecibe; ?>">-->
                            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <center>
                                    <h4 class="modal-title"><i class="fa fa-archive"></i> Generar Reporte de Producción</h4>
                                </center>
                            </div>

                            <div class="modal-body">
                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Fecha de inicio del reporte</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-addon"> <i class="fa fa-list-ol"></i> </div>
                                            <input type="date" class="form-control" placeholder="Fecha de inicio" required name="fecha_inicio" id="fecha_inicio" />
                                            <span class="input-group-addon" data-toggle="tooltip" title="Fecha de inicio." data-placement="top"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Fecha de finalización del reporte</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-addon"> <i class="fa fa-list-ol"></i> </div>
                                            <input type="date" class="form-control" placeholder="Fecha de Finalización" required name="fecha_fin" id="fecha_fin" />
                                            <span class="input-group-addon" data-toggle="tooltip" title="Fecha de Finalización." data-placement="top"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row"> <label for="lturno" class="col-sm-2 form-control-label">Turno:</label>
                                    <div class="col-sm-10"> <select name="turno" id="turno" class="form-control" required>
                                            <option value="Matutino">Matutino</option>
                                            <option value="Vespertino">Vespertino</option>

                                        </select> </div>
                                </div>


                                <div class="col-sm-10"><input type="hidden" name="tipo_pre" id="tipo_pre" class="form-control">

                                </div>
                                <center>
                                    <div id="mensaje" class="col-md-12"></div>
                                </center>
                            </div>
                            <div class="modal-footer">

                                <button type="submit" class="btn btn-oval btn-primary"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generar pdf</button>
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

    <script src="js/vendor.js"></script>
    <script src="js/app.js"></script>
    <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
</body>

</html>
