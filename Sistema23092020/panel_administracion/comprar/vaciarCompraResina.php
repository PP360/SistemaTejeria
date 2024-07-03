<?php
session_start();
unset($_SESSION['contadorResina']);
header("Location: comprar_resina.php")
?>