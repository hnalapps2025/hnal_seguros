<?php 
include_once('controllerResysFua.php');
$resultado=false;
$mensaje='';
$datos=null;

$IdCuentaAtencion=$_GET["IdCuentaAtencion"];
 //var_dump($IdCuentaAtencion);
 //exit();
//  $url_produccion="https://app.hospitalloayza.gob.pe";
$url_resysLocal = "http://resys.hloayza.local";
//http://resys.hloayza.local/ws/sa_general/imprime_fua_ap/5904960
// $url_resysLocal = "http://192.168.36.121:8585/"; // 128
$usuario='mlimache';
$clave='123456';
$ObtenerFua=ObtenerFua($url_resysLocal,$usuario,$clave,$IdCuentaAtencion);
if($ObtenerFua["resultado"])
{
   $datos=$ObtenerFua["fua"];
   $resultado=true;
}
else
   $mensaje=$ObtenerFua["mensaje"];

if($resultado)
{
   $fileLocation=$IdCuentaAtencion.".xlsx";
   file_put_contents($fileLocation,$ObtenerFua["fua"]);
   header('Content-Description: File Transfer');
   header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
   header("Content-Disposition: attachment; filename=\"".basename($fileLocation)."\"");
   header("Content-Transfer-Encoding: binary");
   header("Expires: 0");
   header("Pragma: public");
   header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
   readfile($fileLocation);
   //echo json_encode(["resultado" => true, "mensaje" => "", "archivo" => $fileLocation]);
}
else
   echo json_encode(["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos]);
?>