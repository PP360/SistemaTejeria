<?php
    $enlace=$conexion=mysqli_connect("localhost","root","","p_tejeria")or die("Error al conectar con la base de datos");
    if(!$enlace)
    {
        echo "No se realizó la conexión";
    }
    mysqli_query($conexion,"SET NAMES 'utf8'");
?>