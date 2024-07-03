<?php
session_start();
$host  = $_SERVER['HTTP_HOST'];
$uri   = '/Sistema/panel_administracion';

include('./conexion.php');
if(isset($_SESSION['usuario'])==false or isset($_SESSION['id_area'])==false or isset($_SESSION['id_usuario'])==false){
    header("Location: http://$host$uri/error.php");
}
elseif(!($_SESSION['id_area']=='3' || $_SESSION['id_area'] == '1')){
    header("Location: http://$host$uri/error.php");
    session_destroy();
}
$fechaGuardada = $_SESSION["ultimoAcceso"];
$ahora = date("Y-n-j H:i:s"); 
$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 
$self = $_SERVER['PHP_SELF']; 
header("refresh:1200; url=$self");
if($tiempo_transcurrido >=1200) {
    header("Location: http://$host$uri/login.php");
}else { 
	$_SESSION["ultimoAcceso"] = $ahora; 
}

?>