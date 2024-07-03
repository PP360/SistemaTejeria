<?php
session_start();
unset($_SESSION['contadorTapas']);
header("Location: comprar_tapas.php")
?>