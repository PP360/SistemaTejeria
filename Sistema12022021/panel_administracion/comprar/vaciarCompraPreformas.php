<?php
session_start();
unset($_SESSION['contadorPreformas']);
header("Location: comprar_preformas.php")
?>