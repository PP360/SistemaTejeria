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
$query="SELECT * FROM clientes";
$clientes=mysqli_query($conexion,$query);
$filas=mysqli_num_rows($clientes);
?>
<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Clientes | Tejeria Envases Plásticos </title>
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
            $(window).load(function() {
                $(".loader").fadeOut("slow");
            });
            
        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz#123456789',.";
            especiales = "8-37-39-46";

            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
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
                    <div class="title-block">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="title">
                                    Clientes
                                    <a  class="btn btn-primary btn-sm rounded-s" data-toggle="modal" data-target="#registroCliente"> 
                                        <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                                    </a>
                                    <a href="../reportes/clientes.php"><button title="Lista de clientes" class="btn   btn-sm rounded-s btn-danger test"> <i class="fa fa-file-pdf-o  fa-lg"></i></button></a>
                                </h3>
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
                                                    <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-users"></i> Listado de clientes</button>
                                                </center>

                                            </h3> </div>
                                        <section class="example">
                                            <div class="table-responsive">
                                                <table id="example" class="table table-striped table-bordered table-hover flip-content" id="tabla" width="100%" cellspacing="0">
                                                    <thead class="thead-inverse">
                                                        <tr>
                                                           <th>No</th>
                                                            <th>Nombre</th>
                                                            <th>RFC</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php $id=1; while ($row=mysqli_fetch_array($clientes)) { ?>
                                                        <tr>
                                                           <td><?php echo $id ?></td>
                                                            <td><?php echo $row['nombre_cliente'];?></td>
                                                            <td><?php echo $row['rfc'];?></td>
                                                            <td> <a href="../clientes/mod_cliente.php?id=<?php echo base64_encode($row['id_cliente'])?>">
                                                                <button type="button" class="btn btn-primary btn-sm rounded-s"><i class="fa fa-pencil"></i></button>
                                                                </a><a onclick=" return eliminar();" href="../clientes/elim_cliente.php?id=<?php echo base64_encode($row['id_cliente'])?>">
                                                                <button type="button"  class=" btn msg-cond btn-danger btn-sm rounded-s"><i class="fa fa-trash"></i></button>
                                                                </a>
                                                                <a href="../clientes/detalle_cliente.php?id=<?php echo base64_encode($row['id_cliente'])?>">
                                                                <button type="button" class="btn btn-primary btn-sm rounded-s"><i class="fa fa-user"></i></button>
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
                    <div class="title-block">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="title">
                                    Clientes
                                    <a  class="btn btn-primary btn-sm rounded-s" data-toggle="modal" data-target="#registroCliente"> 
                                        <i class="fa fa-plus" aria-hidden="true"></i> Nuevo
                                    </a>

                                </h3>
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
                                                    <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-users"></i> Listado de clientes</button>
                                                </center>

                                            </h3> </div>
                                        <section class="">

                                            <center>
                                                <h5> <i class="fa fa-close" aria-hidden="true"></i> No se han agregado clientes al sistema, puedes agregar uno dando clic en  <a  class="btn btn-primary btn-sm rounded-s" data-toggle="modal" data-target="#registroCliente"> 
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

                <!-- /.modalRegistro -->
                <div class="modal fade" id="registroCliente" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <center>
                                    <h4 class="modal-title"><i class="fa fa-user"></i> Nuevo cliente</h4> 
                                </center>
                            </div>
                            <form action="r_cliente.php" method="post" >
                                <div class="modal-body">


                                    <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Nombre</label>
                                        <div class="col-sm-10"> <input type="text" name="nombre_cliente" id="nombre" class="form-control" placeholder="" autofocus  maxlength="50">  </div>
                                    </div>
                                       <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">RFC</label>
                                        <div class="col-sm-10"> <input type="text" name="rfc" id="rfc" class="form-control" placeholder="" autofocus  maxlength="50">  </div>
                                    </div>
                                    <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Dirección</label>
                                        <div class="col-sm-10"> <input type="text" name="direccion" id="direccion" class="form-control" placeholder=""  maxlength="50"></div>
                                    </div>
                                    <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Email</label>
                                        <div class="col-sm-10"> <input type="email" name="email" id="email" class="form-control" placeholder=""  maxlength="50"> </div>
                                    </div>
                                    <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Teléfono</label>
                                        <div class="col-sm-10"> <input type="text" name="telefono" id="telefono" class="form-control" placeholder=""  maxlength="15" onkeypress="numeros()" > </div>
                                    </div>
                                    <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Celular</label>
                                        <div class="col-sm-10"> <input type="text" name="celular" id="celular" class="form-control" placeholder=""  maxlength="15" onkeypress="numeros(event)"> </div>
                                    </div>


                                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-oval btn-primary" > <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                                    <button type="submit" class="btn btn-oval btn-primary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>

                                    <!--<button type="button" class="btn btn-oval btn-secondary" data-dismiss="modal">Cerrar</button>-->
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
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
        <script src="../js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    </body>

</html>
