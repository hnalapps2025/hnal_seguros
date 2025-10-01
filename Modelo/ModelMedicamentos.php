<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (CONTROLLER_PATH."conexion.php");
include (MODEL_PATH."global.php");


header('Content-Type: text/html; charset=utf-8');
error_reporting(0);



class ModelMedicamentos{

                      

					function InsertMxs($medicamentos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                              $iduser       = $medicamentos['iduser'];
                                              $idMedic      = $medicamentos['idMedic'];
                                              $idpresMedca  = $medicamentos['idpresMedca'];
                                              $cantMed      = $medicamentos['cantMed'];
                                              $codSisMx     = $medicamentos['codSisMx'];
                                              $diagMed      = $medicamentos['diagMed'];
                                              $valoriMed    = $medicamentos['valoriMed'];
                                              $desMed       = $medicamentos['desMed'];
                                              $totalm       = $medicamentos['totalm'];
                                

                                    if($idMedic!=""){
                                        
                                        $stmt = $conn->prepare( "UPDATE `a_medicamentos` SET `IdUsuario`= ? ,`id_prestacion`= ? ,`codigo_sismed`= ? ,
                                        `cantidad`= ? ,`diagnostico`= ? ,`valorizacion`= ? ,`descripcion`= ?,`total`= ?  WHERE `idMed`= $idMedic");                                  
                                        $stmt->bind_param('issisdsd', $iduser, $idpresMedca,$codSisMx,$cantMed,$diagMed,$valoriMed,$desMed,$totalm);
                                        $stmt->execute();
                                    
                                    }else {
                                    
                                        $stmt = $conn->prepare( "INSERT a_medicamentos(`IdUsuario`, `id_prestacion`, `codigo_sismed`, `cantidad`, `diagnostico`, `valorizacion`, `descripcion`, `total`) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?,? )");
                                        $stmt->bind_param('issisdsd', $iduser, $idpresMedca, $codSisMx,$cantMed,$diagMed,$valoriMed,$desMed,$totalm);
                                        $stmt->execute();	
                                        
                                    }
                    
                            }

                            return $result;

                    }



                    function InsertMxsAuto($medicamentos){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {
                        printf("Conexión fallida: %s\n", $conn->connect_error);
                        exit();

                    }else{

                                      $iduser       = $medicamentos['iduser'];
                                      $idMedic      = $medicamentos['idMedic'];
                                      $idpresMedca  = $medicamentos['idpresMedca'];
                                      $cantMed      = $medicamentos['cantMed'];
                                      $codSisMx     = $medicamentos['codSisMx'];
                                      $diagMed      = $medicamentos['diagMed'];
                                      $valoriMed    = $medicamentos['valoriMed'];
                                      $desMed       = $medicamentos['desMed'];
                                      $totalm       = $medicamentos['totalm'];
                        

                            if($idMedic!=""){
                                
                                $stmt = $conn->prepare( "UPDATE `ac_medicamentos` SET `IdUsuario`= ? ,`id_prestacion`= ? ,`codigo_sismed`= ? ,
                                `cantidad`= ? ,`diagnostico`= ? ,`valorizacion`= ? ,`descripcion`= ?,`total`= ?  WHERE `idMed`= $idMedic");                                  
                                $stmt->bind_param('issisdsd', $iduser, $idpresMedca,$codSisMx,$cantMed,$diagMed,$valoriMed,$desMed,$totalm);
                                $stmt->execute();
                            
                            }else {
                            
                                $stmt = $conn->prepare( "INSERT ac_medicamentos(`IdUsuario`, `id_prestacion`, `codigo_sismed`, `cantidad`, `diagnostico`, `valorizacion`, `descripcion`, `total`) 
                                VALUES (?, ?, ?, ?, ?, ?, ?,? )");
                                $stmt->bind_param('issisdsd', $iduser, $idpresMedca, $codSisMx,$cantMed,$diagMed,$valoriMed,$desMed,$totalm);
                                $stmt->execute();	
                                
                            }
            
                    }

                    return $result;

            }
                    
                    
					function eliminarMts($deleteMets){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idMts  = $deleteMets['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `a_medicamentos` WHERE `idMed`= ?");
                                                $stmt->bind_param('i', $idMts);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                    }


                    function eliminarMtsAuto($deleteMets){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {

                            printf("Conexión fallida: %s\n", $conn->connect_error);
                            exit();

                    } else{

                            $idMts  = $deleteMets['id'];
                            $stmt = $conn->prepare( "DELETE FROM `ac_medicamentos` WHERE `idMed`= ?");
                            $stmt->bind_param('i', $idMts);
                            $stmt->execute();	
                                    
                        }

                        return $result;

}


}


?>