<?php
	include('../val_usuario.php');
//Salida de preformas Panel de producción
$idRecibe=$_SESSION['id_usuario'];
$usuario="SELECT id_usuario, nombre_usuario FROM usuarios WHERE id_area='3'";
$usuar=mysqli_query($conexion,$usuario);
$filasUsuarios=mysqli_num_rows($usuar);
$resin="SELECT  produccion_preformas.fecha_produccion,resina.nombre, produccion_preformas.id_entregaResina, (usuarios.nombre_usuario) as entrego, usuarios.turno, produccion_preformas.estatus  FROM produccion_preformas, detalle_entregaresina, usuarios, resina WHERE produccion_preformas.id_usuarioProduce=$idRecibe AND usuarios.id_usuario=produccion_preformas.id_usuarioProduce AND detalle_entregaresina.id_entregaResina=produccion_preformas.id_entregaResina AND resina.id_resina=detalle_entregaresina.id_resina";
$entregaResina=mysqli_query($conexion,$resin);
$filaEntregaResina=mysqli_num_rows($entregaResina);
$detalleEntrega="SELECT entrega_resina.id_entregaResina, concat(entrega_resina.id_entregaResina,' ',resina.nombre)as Detalle FROM entrega_resina, detalle_entregaresina, resina WHERE entrega_resina.id_entregaResina=detalle_entregaresina.id_entregaResina AND detalle_entregaresina.id_resina=resina.id_resina AND entrega_resina.id_usuarioRecibe='$idRecibe'";
$detalle=mysqli_query($conexion,$detalleEntrega);
$query2="SELECT * FROM preformas";
$Preformas=mysqli_query($conexion,$query2);
$filasPreforma=mysqli_num_rows($Preformas);
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
                $(document).ready(function(){
                $("#entrega").change(function(event){
                    //calcularPreformas();
                    var id = $("#entrega").find(':selected').val();
                 
                   if(id=="0")
                        {
                            document.calcularPreformas.elaborada.value=0;
                        }
                    $("#cantidad").load('obtener_cantidadPreformas.php?id='+id);
                });

               
            });
         
                   function calcularPreforma(){
                 
                    var cantidad= parseInt(document.calcularPreformas.cantidad.value);
                    var merma =parseInt(document.calcularPreformas.cant_merma.value);
                    var cantPendiente=parseInt(document.calcularPreformas.cant_pendiente.value);
                    var botellaElaborada=parseInt(document.calcularPreformas.elaborada.value);
                    var total=document.calcularPreformas.elaborada.value=cantidad-(merma+cantPendiente);
                 var suma=merma+cantPendiente;
                 if(merma>cantidad || cantPendiente>cantidad || botellaElaborada>cantidad)
                     {
                          $('#mensaje').addClass('error').html('<i class="fa fa-check" aria-hidden="true"></i> El valor debe ser menor a la cantidad entregada ').show(150).delay(3800).hide(150);
                         $("#cant_merma").val("");
                         $("#cant_pendiente").val("");
                         $("#elaborada").val("");
                         
                     }
                       if(cantPendiente>0)
                    {
                       document.calcularPreformas.estatus.value="Incompleta"; 
                    }
                else if (cantPendiente==0) 
                    {
                        document.calcularPreformas.estatus.value="Completada";
                    }
                 

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
                                            <a  class="btn btn-primary btn-sm rounded-s" data-toggle="modal" data-target="#salida_botella"> 
                                                <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col col-xs-12 col-sm-12 col-md-12 col-xl-12 stats-col">
                                    <div class="card sameheight-item stats" data-exclude="xs">
                                        <div class="card-block">
                                            <div class="title-block">
                                                <h4 class="title">
                                                    <center>
                                                        <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-edit"></i> Botella en producción</button>
                                                    </center>
                                                </h4>

                                            </div>
                                            <?php if ($filaEntregaResina>0){ ?>
                                            <div class="table-responsive">
                                                <table id="example" class="table table-striped table-bordered table-hover flip-content" id="tabla" width="100%" cellspacing="0">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Fecha</th>
                                                            <th>Entrega</th>
                                                            <th>Elaboro</th>
                                                            <th>Turno</th>
                                                            <th>Estatus</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php $id=1; while ($row=mysqli_fetch_array($entregaResina)) {  ?>
                                                        <tr>
                                                            <td><?php echo $id ?></td>
                                                            <td><?php echo $row['fecha_produccion'];?></td>
                                                            <td><?php echo $row['nombre'];?></td>
                                                            <td><?php echo $row['entrego'];?></td>
                                                            <td><?php echo $row['turno'];?></td>
                                                            <?php $Estatus=$row['estatus'];?>
                                                            <td><?php if($Estatus=="Incompleta"){?>
                                                                <center><button type="button" class="btn  btn-warning btn-sm rounded-s"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Incompleta</button></center>

                                                                <?php } elseif ($Estatus=="Completada") {?>
                                                                <center><button type="button" class="btn  btn-primary btn-sm rounded-s"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Completada</button></center>

                                                               <?php }?> </td>
                                                            
                                                            <td> 
                                                               
                                                                <a href="reportes/entrega_preformasProduccion.php?Cod=<?php echo base64_encode($row['id_entregaPreformas'])?>">
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


                        </div>
                    </section>

                </article>
                <!-- /.modal -->
                <!-- /.modal -->
                <div class="modal fade" id="salida_botella"  role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="r_salidaPreformas.php" name="calcularPreformas"  method="post">
                                <input type="hidden" name="idRecibe" value="<?php echo $idRecibe; ?>">
                                <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    <center>
                                        <h4 class="modal-title"><i class="fa fa-archive"></i> Preformas</h4> </center> </div>

                                <div class="modal-body">
                                    <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Entrega</label>
                                        <div class="col-sm-10"> 
                                            <select class="form-control form-control-sm  " name="entrega" id="entrega">
                                                <option value="0">Seleccione una opción</option>
                                                <?php while ($row=mysqli_fetch_array($detalle)) { ?>
                                                <?php echo'<OPTION VALUE="'.$row['id_entregaResina'].'">'.$row['Detalle'].'</OPTION>';?>
                                                <?php } ?>
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Cantidad</label>
                                        <div class="col-sm-10"> <select class="form-control form-control-sm " name="cantidad"  id="cantidad" onkeyup="calcularPreforma()"> </select> </div>
                                    </div>
                                      <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Preforma</label>
                                   
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

                                    <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Merma</label>
                                        <div class="col-sm-10"> <input type="number" name="cant_merma" id="cant_merma" class="form-control" placeholder="" required maxlength="50" onkeyup="calcularPreforma()" > </div>
                                    </div>
                                    <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Pendiente</label>
                                        <div class="col-sm-10"> <input type="number" name="cant_pendiente" id="cant_pendiente" class="form-control" onkeyup="calcularPreforma()" placeholder="" required maxlength="50" > </div>
                                    </div>
                                          <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Elaboradas</label>
                                        <div class="col-sm-10"> <input type="text" name="elaborada" id="elaborada" class="form-control"  placeholder="" required maxlength="10"  value="0"   > </div>
                                    </div>
                                               <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Estatus</label>
                                        <div class="col-sm-10"> <input type="text" name="estatus" id="estatus" class="form-control" placeholder=""  required maxlength="10" onkeypress="letras()"   > </div>
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
            </div>
        </div>

        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
        <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    </body>

</html>