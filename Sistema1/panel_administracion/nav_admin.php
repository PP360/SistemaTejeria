<?php
    $url_module_admin = 'http://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';
?>

<style type="text/css">
    ul li a i.rev{ transform: rotate(180deg); margin-right: 15px; }
</style>

<!-- NAV -->
<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <div class="brand">
                <img src="../img/logo_header.png" width="180px" height="100px">
            </div>
            <nav class="menu">
                <ul class="nav metismenu" id="sidebar-menu">
                    <li>
                        <a href="<?php echo "http://" .$_SERVER['HTTP_HOST']. "/Sistema/panel_administracion/principal.php" ?>"><i class="fa fa-home"></i> Principal </a>
                    </li>
                    <li>
                        <a href=""> <i class="fa fa-indent" aria-hidden="true"></i> Materia Prima<i class="fa arrow"></i> </a>
                        <ul>
                            <li> <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/materia_prima/resina.php" ?>"> Resina </a> </li>
                            <li> <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/materia_prima/preformas.php" ?>"> Preformas</a> </li>
                            <li> <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/materia_prima/botella.php" ?>"> Botellas </a> </li>
                            <li> <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/materia_prima/tapas.php" ?>"> Tapas </a> </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/clientes/clientes.php" ?>"> <i class="fa fa-user"></i> Clientes </a>
                    </li>
                    <li>
                        <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/proveedores/proveedores.php" ?>"> <i class="fa fa-truck"></i> Proveedores </a>
                    </li>
                    <li>
                        <a href=""> <i class="fa fa-area-chart"></i> Inventario <i class="fa arrow"></i> </a>
                        <ul>
                            <li> 
                                <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/inventario/resina.php" ?>"> Resina </a> 
                            </li>
                            <li> 
                                <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/inventario/preformas.php" ?>"> Preformas </a> 
                            </li>
                            <li> 
                                <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/inventario/botellas.php" ?>"> Botellas </a> 
                            </li>
                            <li>
                                <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/inventario/tapas.php" ?>"> Tapas </a> 
                            </li>
                        </ul>
                    </li>
                    <li id="bodega" class="">
                        <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/bodega/principal.php" ?>"> <i class="fa fa-archive"></i> Bodega <i class="fa arrow"></i> </a>
                        <ul class="">
                            <li> 
                                <a href=""> <i class="fa fa-sign-out"></i> Salida de Material</a>
                                    <li> 
                                        <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/bodega/salida_resina.php" ?>"> Resina </a> 
                                    </li>
                                    <li>
                                        <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/bodega/salida_preforma.php" ?>"> Preformas </a> 
                                    </li>
                            </li>
                            <li> 
                                <a href=""> <i class="fa fa-bitbucket"></i> Producto Terminado <i class="fa arrow rev"></i></a>
                                <ul>
                                    <li> 
                                        <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/bodega/producto_terminado_preformas.php" ?>"> Preformas </a> 
                                    </li>
                                    <li> 
                                        <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/bodega/producto_terminado_botellas.php" ?>"> Botellas </a> 
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <li id="produccion" class="">
                        <a href=""> <i class="fa fa-gears"></i> Producción <i class="fa arrow"></i> </a>
                        <ul>
                            <li class="">
                                <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/produccion/principal.php"?>"> <i class="fa fa-sign-out"></i> Materia en producción</a>
                            </li>
                            <li class=""> 
                                <a href=""> <i class="fa fa-check-square-o" aria-hidden="true"></i> Producto terminado <i class="fa arrow rev"></i> </a>
                                <ul>
                                    <li> <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/produccion/salida_botellas.php"?>"> Botellas </a> </li>
                                    <li> <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/produccion/salida_preformas.php"?>",php> Preformas </a> </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/reportes/reportes.php" ?>"> <i class="fa fa-file-pdf-o"></i> Reportes </a>
                    </li>
                    <li>
                        <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/usuarios/usuarios.php" ?>"> <i class="fa fa-users"></i> Usuarios </a>
                    </li>
                    <li style="position:fixed; bottom: 0; width:230px; background:#2d363f;">
                        <a href="<?php echo "http://".$_SERVER['HTTP_HOST']."/Sistema/panel_administracion/cerrar_session.php" ?>"> <i class="fa fa-power-off icon"></i> Cerrar Sesión </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>