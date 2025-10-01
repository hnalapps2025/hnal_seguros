<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."ModelInsumos.php");


$sel =new ModelInsumos();
$function = $_GET["function"];
     

        if($function =="insertarInsumos"){

                    
                $insumos = array();
                $insumos['iduser']      = $_POST["iduser"];
                $insumos['idIns']       = $_POST["idIns"];
                $insumos['idpresInsu']  = $_POST["idpresInsu"];
                $insumos['cant']        = $_POST["cantIn"];
                $insumos['codSismed']   = $_POST["codSismed"];
                $insumos['diag']        = $_POST["diag"];
                $insumos['valori']      = $_POST["valori"];
                $insumos['des']         = $_POST["des"];
                $insumos['totali']         = $_POST["totali"];
                
                echo"up";
                $ni2 = $sel->InsertInsumos($insumos);   
                
        }
        else if($function =="insertarInsumosAuto"){

                    
                $insumos = array();
                $insumos['iduser']      = $_POST["iduser"];
                $insumos['idInsAuto']       = $_POST["idInsAuto"];
                $insumos['idpresInsuAuto']  = $_POST["idpresInsuAuto"];
                $insumos['cantAuto']        = $_POST["cantInAuto"];
                $insumos['codSismedAuto']   = $_POST["codSismedAuto"];
                $insumos['diagAuto']        = $_POST["diagAuto"];
                $insumos['valoriAuto']      = $_POST["valoriAuto"];
                $insumos['desAuto']         = $_POST["desAuto"];
                $insumos['totaliAuto']         = $_POST["totaliAuto"];
                
                
                $ni2 = $sel->InsertInsumosAuto($insumos);   
                
        }
        else if($function =="eliminarIn"){

                    
                $deleteIn = array();
                $deleteIn['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarInsu($deleteIn);   
                
        }

        else if($function =="eliminarInAuto"){

                    
                $deleteIn = array();
                $deleteIn['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarInsuAuto($deleteIn);   
                
        }


 ?>