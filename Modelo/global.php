<?php

error_reporting(0);
session_start();
$path = 'https://jmgperu.com/hnal/';
$iduser = $_SESSION['id'];
$rol = $_SESSION['rol'];
$empresa = $_SESSION['nom']." ".$_SESSION['ape'];
$logo = "images/img.jpg";
$EESS = $_SESSION['EESS'];
$CODEESS = $_SESSION['CODEESS'];
$permisoRegistro = $_SESSION['permisoRegistro'];
$permisoEditarPato = $_SESSION['permisoEditarPato'];


?>