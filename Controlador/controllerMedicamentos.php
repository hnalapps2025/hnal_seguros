<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."ModelMedicamentos.php");


$sel =new ModelMedicamentos();
$function = $_GET["function"];
     

        if($function =="insertarMedicamts"){

                    
                $medicamentos = array();
                $medicamentos['iduser']        = $_POST["iduser"];
                $medicamentos['idMedic']       = $_POST["idMedic"];
                $medicamentos['idpresMedca']   = $_POST["idpresMedca"];
                $medicamentos['cantMed']       = $_POST["cantMed"];
                $medicamentos['codSisMx']      = $_POST["codSisMx"];
                $medicamentos['diagMed']       = $_POST["diagMed"];
                $medicamentos['valoriMed']     = $_POST["valoriMed"];
                $medicamentos['desMed']        = $_POST["desMed"];
                $medicamentos['totalm']        = $_POST["totalm"];
                
                
                $ni2 = $sel->InsertMxs($medicamentos);   
                
        }

        else if($function =="insertarMedicamtsAuto"){

                    
                $medicamentos = array();
                $medicamentos['iduser']        = $_POST["iduser"];
                $medicamentos['idMedic']       = $_POST["idMedicAuto"];
                $medicamentos['idpresMedca']   = $_POST["idpresMedcaAuto"];
                $medicamentos['cantMed']       = $_POST["cantMedAuto"];
                $medicamentos['codSisMx']      = $_POST["codSisMxAuto"];
                $medicamentos['diagMed']       = $_POST["diagMedAuto"];
                $medicamentos['valoriMed']     = $_POST["valoriMedAuto"];
                $medicamentos['desMed']        = $_POST["desMedAuto"];
                $medicamentos['totalm']        = $_POST["totalmAuto"];
                
                
                $ni2 = $sel->InsertMxsAuto($medicamentos);   
                
        }
        else if($function =="eliminarMet"){

                    
                $deleteMets = array();
                $deleteMets['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarMts($deleteMets);   
                
        }

        else if($function =="eliminarMetAuto"){

                    
                $deleteMets = array();
                $deleteMets['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarMtsAuto($deleteMets);   
                
        }


 ?>