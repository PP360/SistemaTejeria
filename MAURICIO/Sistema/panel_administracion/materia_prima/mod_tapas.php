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
$id=base64_decode($_GET['id']);
$query="SELECT * FROM tapas where id_tapa='$id'";
$tapas=mysqli_query($conexion,$query);


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
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        })

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
            <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <article class="content items-list-page">
                <section class="section">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="card-title-block">
                                        <h3 class="title">
                                            <form action="actuali_tapas.php" method="post">
                                                <?php while ($row=mysqli_fetch_array($tapas)) { ?>
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <center>
                                                    <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-archive"></i> Actualizar tapa de :  <?php echo $row['tamano'];?> </button>
                                                </center>
                                                </h3> 
                                                </div>
                                    <section class="example">
                                        <nav class="text-xs-right">
                                                <center>
                                                    <div class="card card-block sameheight-item">
                                                           <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Unidad</label>
                                                                    <div class="col-sm-6"> <input type="text" name="unidad_medida" id="unidad_medida" class="form-control" placeholder="" required maxlength="10" onkeypress="letras()" value="<?php echo $row['unidad_medida']; ?>"> </div>
                                                                </div>
                                                <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Presentación</label>
                                                  <div class="col-sm-6">
                                                        <select class="form-control form-control-sm" name="presentacion" id="presentacion">
                                                            <option value="<?php echo $row['Presentacion']; ?>"><?php echo $row['Presentacion']; ?></option>
                                                            <option value="0">Seleccione un tipo de presentación</option>
                                                            <option value="Cuello Corto">Cuello Corto</option>
                                                            <option value="Cuello Normal">Cuello Normal</option>
                                                            <option value="Licorera">Licorera</option>
                                                        </select>
                                                </div>
                                                </div>
                                                                          <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Concepto</label>
                                                                            <div class="col-sm-6"> <input type="text" name="tamano" id="tamano" class="form-control" placeholder="" required maxlength="50" value="<?php echo $row['tamano']; ?>" > </div>
                                                                        </div>
                                                                           <div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Precio</label>
                                                                            <div class="col-sm-6"> <input type="text" name="precio" id="precio" class="form-control" placeholder="" required maxlength="10" onkeypress="return onKeyDecimal(event,this);" value="<?php echo $row['precio']; ?>"  > </div>
                                                                        </div>
                                                <div class="form-group row"> <label for="inputmillarxcaja" class="col-sm-2 form-control-label">Precio x Caja</label>
                                                    <div class="col-sm-6"> <input type="text" name="millarxcaja" id="millarxcaja" value="<?php echo $row['millarcaja']; ?>" class="form-control" placeholder="" required maxlength="10" onkeypress="return onKeyDecimal(event,this);"> </div>
                                                    </div>
                                                </div>

                                                        <button type="submit" class="btn btn-oval btn-primary"> <i class="fa fa-refresh" aria-hidden="true"></i> Actualizar</button>
                                                         </form>
                                                          <?php } ?>
                                                        <a href="tapas.php">
                                                            <button class="btn btn-oval btn-danger"><i class="fa fa-times" aria-hidden="true" ></i> Cancelar</button>
                                                        </a>
                                                    </div>
                                                    
       
                                                 
                                                </center>

                                          
                                    </section>
                                </div>
                            </div>
            </article>
            </article>

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
</body>

</html>