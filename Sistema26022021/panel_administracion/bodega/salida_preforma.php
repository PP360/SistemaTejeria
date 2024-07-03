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
$idEntrega=$_SESSION['id_usuario'];
//Mostrar tabla de preformas
$query="SELECT EP1.id_entregaPreformas, EP1.fecha_entrega, (U1.nombre_usuario) entrego, (U2.nombre_usuario) recibe FROM entrega_preformas EP1, entrega_preformas EP2, usuarios U1, usuarios U2 WHERE U1.id_usuario=EP1.id_usuarioEntrega AND U2.id_usuario=EP1.id_usuarioRecibe GROUP BY  EP1.id_entregaPreformas";
$entrega=mysqli_query($conexion,$query);
$filas=mysqli_num_rows($entrega);
$preformas="SELECT P.gramaje,IP.id_preforma FROM inventario_preformas IP, preformas P WHERE P.id_preforma=IP.id_preforma";
$preform=mysqli_query($conexion,$preformas);
$filasPreformas=mysqli_num_rows($preform);
$consulta1 = mysqli_query($conexion,'SELECT MAX(id_entregaPreformas) as id_entregaPreformas FROM entrega_preformas LIMIT 1');
$consulta = mysqli_fetch_array($consulta1);
$numero = (empty($consulta['id_entregaPreformas']) ? 1 : $consulta['id_entregaPreformas']+=1);
$usuario="SELECT id_usuario, nombre_usuario FROM usuarios WHERE id_area='3'";
$usuar=mysqli_query($conexion,$usuario);
$filasUsuarios=mysqli_num_rows($usuar);
$id=$_SESSION['id_usuario'];

//TIPO DE BOTELLA A ELABORAR
$botella="SELECT * FROM botellas";
$tipo=mysqli_query($conexion,$botella);

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bodega | Tejeria Envases Plásticos </title>
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
            $('#example').DataTable({
                scrollY: '50vh',
                scrollCollapse: true,
                paging: true,
                scrollX: true
            });
        });
        //loader pagina
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
        //Toltip
        //Aquí
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $("#gramaje").change(function(event) {
                console.log("Prueba de entrada");
                calcularPreformas();

                var tipoPreforma = $("#gramaje").find(':selected').val();
                if (tipoPreforma == "Seleccione una opción") {
                    document.calcularPreformas.cantidad.value = 0;
                }


        });


        function calcularPreformas() {
                
                console.log(document.getElementById("gramaje").value);                
                var tipoPreforma = document.getElementById("gramaje").value;
                var totalPreformas = 0;
                // Preforma de 9.9grs CSN 26
                if (tipoPreforma == 1) {
                    totalPreformas=23184;
                    document.getElementById("cantidad").value=totalPreformas;                    
                    
                } else if (tipoPreforma == 11) {
                    
                    
                    totalPreformas = 18816;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                    //Preforma 21 Grs Corvaglia
                } else if (tipoPreforma == 12) {
                    totalPreformas = 13440;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                    // Preforma 18 Grs CSN 26
                } else if (tipoPreforma == 13) {
                    totalPreformas = 13008;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                    //Preforma 31 Grs Corvaglia
                } else if (tipoPreforma == 14) {
                    totalPreformas = 9120;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                } 
                //Preforma 25 Grs CSN 26
             else if (tipoPreforma == 15) {
                    totalPreformas = 9120;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                } 
                //Preforma 10 Grs CSN 26
                else if (tipoPreforma == 16) {
                    totalPreformas= 23184;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                }
                //Preforma 13 Grs Corvaglia
                else if (tipoPreforma == 17) {
                    totalPreformas = 18816;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                }  
                //Preforma 24 Grs Corvaglia
                else if (tipoPreforma == 18) {
                    totalPreformasCompradas = 13158;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                } 
                //Preforma 36 Grs Corvaglia 
                else if (tipoPreforma == 19) {
                    totalPreformasCompradas = 9120;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                }
                //Preforma 40 Grs Corvaglia 
                else if (tipoPreforma ==20) {
                    totalPreformas = 7000;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                }
                //Preforma 45 Grs Corvaglia 
                else if (tipoPreforma ==21) {
                    totalPreformas = 6772;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                }
                //Preforma 46 Grs Corvaglia 
                else if (tipoPreforma ==22) {
                    totalPreformasCompradas = 7808;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                }
                //Preforma 50 Grs Corvaglia 
                else if (tipoPreforma ==23) {
                    totalPreformas = 5808;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                }
                //Preforma 57 Grs Corvaglia 
                else if (tipoPreforma ==24) {
                    totalPreformas = 5808;
                    document.getElementById("cantidad").value = totalPreformas;
                    
                }
                else {
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

            <?php  if($filas>0){?>
            <div class="sidebar-overlay" id="sidebar-overlay"></div>
            <article class="content items-list-page">
                <div class="title-search-block">
                    <div class="title-block">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="title">
                                    Salida de preformas
                                    <a class="btn btn-primary btn-sm rounded-s" data-toggle="modal" data-target="#registroSalida">
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
                                                <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-archive"></i> Salida de preformas</button>
                                            </center>

                                        </h3>
                                    </div>
                                    <section>

                                        <center>
                                            <form action="../reportes/entregas_preformas.php" method="post">
                                                <strong> Desde&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                <input type="date" id="p-desde" name="p-desde" />
                                                <strong>Hasta&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                <input type="date" id="p-hasta" name="p-hasta" />
                                                <td><button data-toggle="tooltip" data-placement="right" title="Exportar lista" title="Exportar salida" class="btn  btn-sm rounded-s btn-danger test"> <i class="fa fa-file-pdf-o "></i></button>
                                            </form>
                                        </center>
                                    </section>
                                    <br>
                                    <section class="example">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered table-hover flip-content" id="tabla" width="100%" cellspacing="0">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Fecha</th>
                                                        <th>Entregó</th>
                                                        <th>Recibió</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php $id=1; while ($row=mysqli_fetch_array($entrega)) { ?>
                                                    <tr>
                                                        <td><?php echo $id ?></td>
                                                        <td><?php echo $row['fecha_entrega'];?></td>
                                                        <td><?php echo $row['entrego'];?></td>
                                                        <td><?php echo $row['recibe'];?></td>

                                                        <td> <a href="../reportes/entrega_preformas.php?Cod=<?php echo base64_encode($row['id_entregaPreformas'])?>">
                                                                <button data-toggle="tooltip" data-placement="right" title="Ver entrega" type="button" class="btn btn-primary btn-sm rounded-s"><i class="fa fa-eye" aria-hidden="true"></i> </button>
                                                            </a>
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
                <div class="title-search-block">
                    <div class="title-block">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="title">
                                    Salida de preformas
                                    <a class="btn btn-primary btn-sm rounded-s" data-toggle="modal" data-target="#registroSalida">
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
                                                <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-archive"></i> Salida de preformas</button>
                                            </center>

                                        </h3>
                                    </div>

                                    <section class="">

                                        <center>
                                            <h5> <i class="fa fa-close" aria-hidden="true"></i> No se han realizado entregas de preformas a producción </h5>

                                        </center>

                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </article>

            <?php }?>

            <!-- MODAL NUEVA SALIDA PREFORMA -->

            <div class="modal fade" id="registroSalida" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="r_salidaPreformas.php" method="post">
                            <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <center>
                                    <h4 class="modal-title"><i class="fa fa-archive"></i> Salida de preformas</h4>
                                </center>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" name="numero" value="<?php echo $numero; ?>">
                                <input type="hidden" name="entrega" value="<?php echo $idEntrega; ?>">
                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Unidad</label>
                                    <div class="col-sm-10"> <input type="text" name="unidad_medida" id="unidad_medida" class="form-control" placeholder="" required maxlength="10" onkeypress="letras()" value="Pza"> </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-control-label">Concepto</label>
                                    <?php if($filasPreformas>0){ ?>
                                    <div class="col-sm-10">
                                        <select class="form-control form-control-sm" name="gramaje" id="gramaje">
                                            <option value="0">Seleccione una opción </option>
                                            <?php while ($row=mysqli_fetch_array($preform)) { ?>
                                            <?php echo'<OPTION VALUE="'.$row['id_preforma'].'">'.$row['gramaje'].'</OPTION>';?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php } else {?>
                                    <div class="col-sm-10">
                                        <select class="form-control form-control-sm" name="gramaje" id="gramaje">
                                            <option value="0">No hay preformas registradas en el inventario</option>
                                        </select>
                                    </div>
                                    <?php }?>
                                </div>
                                <!--                                TIPO DE BOTELLA A ELABORAR-->
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-control-label">Botella</label>
                                    <div class="col-sm-10"> <select class="form-control form-control-sm  " name="destino_preforma" id="destino_preforma">
                                            <option value="0">Seleccione una opción</option>
                                            <?php while ($row=mysqli_fetch_array($tipo)) { ?>
                                            <?php echo'<OPTION VALUE="'.$row['id_botella'].'">'.$row['tipo_botella'].'</OPTION>';?>
                                            <?php } ?>
                                        </select></div>
                                    <!--
                                    <div class="col-sm-10">
                                        <input type="text" id="destino_preforma" name="destino_preforma" class="form-control" required>
                                    </div>
-->
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-control-label">No. Caja</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="NumeroCaja" id="NumeroCaja" class="form-control" placeholder="" required maxlength="10" onkeypress="numeros()">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-control-label">Cantidad</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="" required maxlength="10" onkeypress="numeros()">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 form-control-label">Recibió</label>
                                    <?php if($filasUsuarios>0){?>
                                    <div class="col-sm-10">
                                        <select class="form-control form-control-sm" name="recibe" id="recibe">
                                            <option value="0">Seleccione una opción </option>
                                            <?php while ($row=mysqli_fetch_array($usuar)) { ?>
                                            <?php echo'<OPTION VALUE="'.$row['id_usuario'].'">'.$row['nombre_usuario'].'</OPTION>';?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php } else { ?>
                                    <div class="col-sm-10">
                                        <select class="form-control form-control-sm" name="recibe" id="recibe">
                                            <option value="0">No hay usuarios registrados en producción </option>
                                        </select>
                                    </div>
                                    <?php } ?>

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
