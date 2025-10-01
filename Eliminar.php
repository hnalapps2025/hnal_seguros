<?php

error_reporting(0);
session_start();

if ($_SESSION['loggedin'] == false) {
	
	echo"<script type=\"text/javascript\">alert('Esta pagina es solo para usuarios registrados'); window.location='index.php';</script>";  
	exit;
} 


require 'Modelo/funciones.php';
$sel =new Model();

$tipo=$_POST["tipo"];
$cod = $_POST["cod"];
$tu=$_GET["act"];
$tipos=$_GET["tipo"];
$code = $_GET["id"];
$fila = $_GET["fila"];



          if($tipo=="paciente"){
              $ni = $sel->EliminarPaciente($cod);
           //   echo"<script type=\"text/javascript\">alert('Eliminado.');javascript:history.back(2);</script>";
          }
          else if($tipo=="efectivo"){
                $ni = $sel->EliminarEfec($cod);
          }      
          else if($tipo=="donante"){
            $ni = $sel->EliminarDonantes($cod);
        }   


?>

