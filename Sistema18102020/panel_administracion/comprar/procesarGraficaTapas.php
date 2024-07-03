<?php
	include('../conexion.php');
	
	$año = $_POST['añoTapas'];
	
	$enero = mysqli_fetch_array(mysqli_query($conexion,"SELECT SUM(total_compra) AS re FROM compra_tapas WHERE MONTH(fecha_compra)=1 AND YEAR(fecha_compra)='$año'"));
	$febrero = mysqli_fetch_array(mysqli_query($conexion,"SELECT SUM(total_compra) AS re FROM compra_tapas WHERE MONTH(fecha_compra)=2 AND YEAR(fecha_compra)='$año'"));
	$marzo = mysqli_fetch_array(mysqli_query($conexion,"SELECT SUM(total_compra) AS re FROM compra_tapas WHERE MONTH(fecha_compra)=3 AND YEAR(fecha_compra)='$año'"));
	$abril = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total_compra) AS re FROM compra_tapas WHERE MONTH(fecha_compra)=4 AND YEAR(fecha_compra)='$año'"));
	$mayo = mysqli_fetch_array(mysqli_query($conexion,"SELECT SUM(total_compra) AS re FROM compra_tapas WHERE MONTH(fecha_compra)=5 AND YEAR(fecha_compra)='$año'"));
	$junio = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total_compra) AS re FROM compra_tapas WHERE MONTH(fecha_compra)=6 AND YEAR(fecha_compra)='$año'"));
	$julio = mysqli_fetch_array(mysqli_query($conexion, "SELECT SUM(total_compra) AS re FROM compra_tapas WHERE MONTH(fecha_compra)=7 AND YEAR(fecha_compra)='$año'"));
	$agosto = mysqli_fetch_array(mysqli_query($conexion,"SELECT SUM(total_compra) AS re FROM compra_tapas WHERE MONTH(fecha_compra)=8 AND YEAR(fecha_compra)='$año'"));
	$septiembre = mysqli_fetch_array(mysqli_query($conexion,"SELECT SUM(total_compra) AS re FROM compra_tapas WHERE MONTH(fecha_compra)=9 AND YEAR(fecha_compra)='$año'"));
	$octubre = mysqli_fetch_array(mysqli_query($conexion,"SELECT SUM(total_compra) AS re FROM compra_tapas WHERE MONTH(fecha_compra)=10 AND YEAR(fecha_compra)='$año'"));
	$noviembre = mysqli_fetch_array(mysqli_query($conexion,"SELECT SUM(total_compra) AS re FROM compra_tapas WHERE MONTH(fecha_compra)=11 AND YEAR(fecha_compra)='$año'"));
	$diciembre = mysqli_fetch_array(mysqli_query($conexion,"SELECT SUM(total_compra) AS re FROM compra_tapas WHERE MONTH(fecha_compra)=12 AND YEAR(fecha_compra)='$año'"));
	
	$data = array(0 => round($enero['re'],1),
				  1 => round($febrero['re'],1),
				  2 => round($marzo['re'],1),
				  3 => round($abril['re'],1),
				  4 => round($mayo['re'],1),
				  5 => round($junio['re'],1),
				  6 => round($julio['re'],1),
				  7 => round($agosto['re'],1),
				  8 => round($septiembre['re'],1),
				  9 => round($octubre['re'],1),
				  10 => round($noviembre['re'],1),
				  11 => round($diciembre['re'],1)
				  );			 
	echo json_encode($data);
?>