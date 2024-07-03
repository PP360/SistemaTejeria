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
$query="SELECT * FROM clientes where id_cliente='$id'";
$cliente=mysqli_query($conexion,$query);

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
            <div class="sidebar-overlay" id="sidebar-overlay"></div>
            <article class="content items-list-page">
                <section class="section">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="card-title-block">
                                        <h3 class="title">
                                                <?php while ($row=mysqli_fetch_array($cliente)) { ?>
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <center>
                                                    <button type="button" class="btn btn-primary btn-sm btn-block"> <i class="fa fa-users"></i> Datos de:  <?php echo $row['nombre_cliente'];?> </button>
                                                </center>
                                                </h3> </div>
                                    <section class="example">
                                        <nav class="text-xs-right">
                                                <center>
                                                    <div class="card card-block sameheight-item">
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 form-control-label">Nombre</label>
                                                            <div class="col-sm-4">
                                                                <input type="text" disabled name="nombre_cliente" id="nombre" class="form-control" placeholder="" autofocus required maxlength="50" value="<?php echo $row['nombre_cliente'];?>" onkeypress="return soloLetras(event)"> </div>
                                                        </div>
                                                         <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 form-control-label">RFC</label>
                                                            <div class="col-sm-4">
                                                                <input type="text" disabled name="nombre_cliente" id="nombre" class="form-control" placeholder="" autofocus required maxlength="50" value="<?php echo $row['rfc'];?>" onkeypress="return soloLetras(event)"> </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 form-control-label">Dirección</label>
                                                            <div class="col-sm-4">
                                                                <input type="text" disabled name="direccion" id="direccion" class="form-control" placeholder="" required maxlength="50" value="<?php echo $row['direccion'];?>" onkeypress="return soloLetras(event)">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 form-control-label">Email</label>
                                                            <div class="col-sm-4">
                                                                <input type="email" disabled name="email" id="email" class="form-control" placeholder="" required maxlength="50" value="<?php echo $row['email'];?>"> </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 form-control-label">Teléfono</label>
                                                            <div class="col-sm-4">
                                                                <input type="text" disabled name="telefono" id="telefono" class="form-control" placeholder="" required maxlength="15" value="<?php echo $row['telefono'];?>" onkeypress="numeros()"> </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 form-control-label">Celular</label>
                                                            <div class="col-sm-4">
                                                                <input type="text" disabled name="celular" id="celular" class="form-control" placeholder="" required maxlength="15" value="<?php echo $row['celular'];?>" onkeypress="numeros()"> </div>
                                                        </div>
   
                                                   <?php } ?>
                                                        <a href="clientes.php">
                                                            <button class="btn btn-oval btn-danger"><i class="fa fa-arrow-left" aria-hidden="true" ></i> Regresar</button>
                                                        </a>
                                                    </div>
                                                  
                                                </center>

                                          
                                    </section>
                                </div>
                            </div>
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
