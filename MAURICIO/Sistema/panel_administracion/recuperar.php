<!doctype html>
<html class="no-js" lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Recuperar Contraseña</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <!-- Theme initialization -->
        <script>
            var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {};
            var themeName = themeSettings.themeName || '';
            if (themeName)
            {
                document.write('<link rel="stylesheet" id="theme-style" href="css/app-' + themeName + '.css">');
            }
            else
            {
                document.write('<link rel="stylesheet" id="theme-style" href="css/app.css">');
            }
        </script>
    </head>
    <body>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                     <header class="auth-header">
                        <h1 class="auth-title">
                        <center>
                        <img src="img/logo.png" width="250px" height="160px" alt="">
                        </center>
                         </h1> </header>
                    <div class="auth-content">
                        <p class="text-xs-center"><strong>Recuperar Contraseña</strong></p>
                       
                        <form id="reset-form" action="/index.html" method="GET" novalidate="">
                            <div class="form-group"><i class="fa fa-envelope-o fa-lg"></i> <label for="email1">Email</label> <input type="email" class="form-control underlined" name="email1" id="email1" placeholder="Ingrese su correo electrónico" required> </div>
                            <div class="form-group"> <button type="submit" class="btn btn-block btn-primary">Recuperar</button> </div>
                        </form>
                    </div>
                </div>
                <div class="text-xs-center">
                    <a href="login.php" class="btn btn-secondary rounded btn-sm"> <i class="fa fa-arrow-left"></i> Regresar al Login </a>
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