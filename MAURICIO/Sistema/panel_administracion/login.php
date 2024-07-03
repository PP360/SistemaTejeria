<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Tejeria | Envases Plásticos </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="img/logo.png">
        <script src="js/jquery.js"></script>
        <script src="js/config.js"></script>
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <link rel="stylesheet" href="css/app-green.css">
    </head>

    <body>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                    <header class="auth-header">
                        <h1 class="auth-title">
                            <center>
                                <img src="img/logo.png" width="265px" height="160px" alt="">
                            </center>
                        </h1> </header>
                    <div class="auth-content">
                            <div class="form-group">
                                <select class="form-control form-control-sm" name="area" id="area" required>
                                <option value="">Seleccione un Área</option>
                                    <option value="1">Administración</option>
                                    <option value="2">Bodega</option>
                                    <option value="3">Producción</option>                                
                                </select>
                            </div>
                            <div class="form-group"> <i class="fa fa-user fa-lg"></i> <label for="username">Nombre de Usuario</label> <input type="text"  id="usu" class="form-control underlined" name="username"  required> </div>
                            <div class="form-group"> <i class="fa fa-lock fa-lg"></i> <label for="password">Contraseña</label> <input type="password" id="pass" class="form-control underlined" name="password" required> </div>
                           <!--<div class="form-group"> <a href="recuperar.php" class="forgot-btn pull-right">¿Olvido su contraseña?</a> </div>-->
                            <center>
                            <div id="mensaje"></div>
                         </center>
                           <br>
                            <button class="btn btn-block btn-primary" id="ingresar">Iniciar Sesión</button> </div>
                            
                     
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
        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
    </body>

</html>