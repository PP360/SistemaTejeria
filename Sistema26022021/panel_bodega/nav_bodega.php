<?php
    $url_module_admin = 'http://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';
?>

<style type="text/css">
    ul li a i.rev{ transform: rotate(180deg); margin-right: 15px;}
</style>

<!-- NAV_BODEGA -->
<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                <img src="../img/logo_header.png" width="180px" height="100px">
            </div>
            <nav class="menu">
                <ul class="nav metismenu" id="sidebar-menu">
                    <li class="open active">
                        <a href=""> <i class="fa fa-archive"></i> Bodega <i class="fa arrow"></i> </a>
                        <ul>
                            <li class="open"> 
                                <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_bodega/principal.php"  ?>"> <i class="fa fa-sign-out"></i> Salida de Material</a>
                                    <li> <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_bodega/salida_preforma.php" ?>"> Preforma </a> </li>
                                    <li> <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_bodega/salida_resina.php" ?>",php> Resina </a> </li>
                            </li>
                        </ul>
                    </li>
                    <li style="position:fixed; bottom: 0; width:230px; background:#2d363f;">
                        <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/cerrar_session.php" ?>"> <i class="fa fa-power-off icon"></i> Cerrar Sesión </a>
                    </li>


                </ul>
            </nav>
        </div>
    </div>
</aside>