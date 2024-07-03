<?php
session_start();

require_once('../conexion.php');

$usu = $_POST['usu'];
$pass = sha1(md5($_POST['pass']));
$area = $_POST['area'];

$usuario = mysqli_query($conexion,"SELECT * FROM usuarios WHERE usuario = '$usu'");
if(mysqli_num_rows($usuario)<1){
	echo 'usuario';
}else{
	$area2 = mysqli_query($conexion,"SELECT * FROM usuarios WHERE usuario = '$usu' AND id_area = '$area' or id_area = 1");
	if(mysqli_num_rows($area2)<1){
		echo 'area';
	}else{
		$consulta = mysqli_query($conexion,"SELECT * FROM usuarios WHERE usuario = '$usu' AND contrasena = '$pass'");
		if(mysqli_num_rows($consulta)<1){
			echo 'password';
		}else{
			$consulta2 = mysqli_fetch_array($consulta);
			$_SESSION['usuario'] = $consulta2['usuario'];
			$_SESSION['id_area'] = $consulta2['id_area'];
            $_SESSION['id_usuario'] = $consulta2['id_usuario'];
            $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
			echo $area;
		}
	}
}
?>