<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/sis/config.php');
include (MODEL_PATH."ModelDiagnostico.php");


$sel =new ModelDiagnostico();
$function = $_GET["function"];
     

        if($function =="insertDx"){

                    
                $diagnostico = array();
                $diagnostico['iduser']      = $_POST["iduserDX"];
                $diagnostico['idDx']        = $_POST["idDx"];
                $diagnostico['idpres']      = $_POST["idpres"];
                $diagnostico['tipoDx']      = $_POST["tipoDx"];
                $diagnostico['codDx']       = $_POST["codDx"];
                $diagnostico['descripcion'] = $_POST["descripcion"];
                
                
                $ni2 = $sel->InsertDiagnostico($diagnostico);   
                
        }

        else if($function =="insertResposanble"){

                    
                $diagnostico = array();
                $diagnostico['idcuen']      = $_POST["idcuen"];
                $diagnostico['tipodoc']        = $_POST["tipodoc"];
                $diagnostico['nrodoc']      = $_POST["nrodoc"];
                $diagnostico['apepaterno']      = $_POST["apepaterno"];
                $diagnostico['apematerno']       = $_POST["apematerno"];
                $diagnostico['nombres'] = $_POST["nombres"];
                $diagnostico['fingreso'] = $_POST["fingreso"];
                $diagnostico['fsalta'] = $_POST["fsalta"];
                $diagnostico['profesion'] = $_POST["profesion"];
                $diagnostico['colegio'] = $_POST["colegio"];
                $diagnostico['especialidad'] = $_POST["especialidad"];
                $diagnostico['nroregistro'] = $_POST["nroregistro"];
                $diagnostico['condicion'] = $_POST["condicion"];
                $diagnostico['estado'] = $_POST["estado"];
                
                
                $ni2 = $sel->InsertResposanble($diagnostico);   
                
        }


        else if($function =="RegistroGroupAt"){

                    
                $diagnostico = array();
                $diagnostico['iduser']      = $_POST["iduser"];
                $diagnostico['mes']        = $_POST["mes"];
                $diagnostico['anio']      = $_POST["anio"];   
            
                $ni2 = $sel->InsertGropuy($diagnostico);   
                
        }


        else if($function =="Registroaut"){

                    
                $diagnostico = array();
               
                $diagnostico['idgroux']   = $_POST["idgroux"];
                $diagnostico['audi']      = $_POST["audi"];
                if($diagnostico['audi']!=0){
                      $diagnostico['estado']      = "PENDIENTE";
                }else{
                      $diagnostico['estado']      = "GENERADO";
                }
                
            
                $ni2 = $sel->InsertAuditor($diagnostico);   
                
        }

        else if($function =="Registrtex"){

                    
                $diagnostico = array();
               
                $diagnostico['idgrouxt']   = $_POST["idgrouxt"];
                $diagnostico['tecx']      = $_POST["tecx"];   
            
                $ni2 = $sel->InsertTecnico($diagnostico);   
                
        }

        else if($function =="deleteDx"){

                    
                $deleteDx = array();
                $deleteDx['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarDx($deleteDx);   
                
        }

        
 ?>