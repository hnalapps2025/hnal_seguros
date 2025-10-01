<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (CONTROLLER_PATH."conexion.php");
include (MODEL_PATH."global.php");


header('Content-Type: text/html; charset=utf-8');
error_reporting(0);



class ModelInsumos{

                      

					function InsertInsumos($insumos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                        $idIns         = $insumos['idIns'];
                                        $iduser        = $insumos['iduser'];
                                        $idpresInsu    = $insumos['idpresInsu'];
                                        $cant          = $insumos['cant'];
                                        $codSismed     = $insumos['codSismed'] ;
                                        $diag          = $insumos['diag'] ;
                                        $valori        = $insumos['valori'];
                                        $des           = $insumos['des'];
                                        $totali        = $insumos['totali'];
                                

                                    if($idIns!=""){
                                        echo"up";
                                        $stmt = $conn->prepare( "UPDATE `a_insumos` SET `IdUsuario`= ?,`id_prestacion`= ?,`codigo_sismed`= ?,
                                        `cantidad`= ?,`diagnostico`= ?,`valorizacion`= ?,`descripcion`=?,`total`=?
                                        WHERE `idInsumos`= $idIns");                                  
                                        $stmt->bind_param('issisdsd', $iduser, $idpresInsu, $codSismed,$cant,$diag,$valori,$des,$totali);
                                        $stmt->execute();
                                    
                                    }else {
                                        echo"in";
                                        $stmt = $conn->prepare( "INSERT a_insumos(`IdUsuario`, `id_prestacion`, `codigo_sismed`, `cantidad`, `diagnostico`, `valorizacion`, `descripcion`, `total`) 
                                        VALUES (?, ?, ?, ?, ?, ?,?,?)");
                                        $stmt->bind_param('issisdsd', $iduser, $idpresInsu, $codSismed,$cant,$diag,$valori,$des,$totali);
                                        $stmt->execute();	
                                        
                                    }
                    
                            }

                            return $result;

                    }
                    


                    function InsertInsumosAuto($insumos){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {
                        printf("Conexión fallida: %s\n", $conn->connect_error);
                        exit();

                    }else{

                                $idIns         = $insumos['idInsAuto'];
                                $iduser        = $insumos['iduser'];
                                $idpresInsu    = $insumos['idpresInsuAuto'];
                                $cant          = $insumos['cantAuto'];
                                $codSismed     = $insumos['codSismedAuto'] ;
                                $diag          = $insumos['diagAuto'] ;
                                $valori        = $insumos['valoriAuto'];
                                $des           = $insumos['desAuto'];
                                $totali        = $insumos['totaliAuto'];
                        

                            if($idIns!=""){
                                echo"up";
                                $stmt = $conn->prepare( "UPDATE `ac_insumos` SET `IdUsuario`= ?,`id_prestacion`= ?,`codigo_sismed`= ?,
                                `cantidad`= ?,`diagnostico`= ?,`valorizacion`= ?,`descripcion`=?,`total`=?
                                WHERE `idInsumos`= $idIns");                                  
                                $stmt->bind_param('issisdsd', $iduser, $idpresInsu, $codSismed,$cant,$diag,$valori,$des,$totali);
                                $stmt->execute();
                            
                            }else {
                                echo"in";
                                $stmt = $conn->prepare( "INSERT ac_insumos(`IdUsuario`, `id_prestacion`, `codigo_sismed`, `cantidad`, `diagnostico`, `valorizacion`, `descripcion`, `total`) 
                                VALUES (?, ?, ?, ?, ?, ?,?,?)");
                                $stmt->bind_param('issisdsd', $iduser, $idpresInsu, $codSismed,$cant,$diag,$valori,$des,$totali);
                                $stmt->execute();	
                                
                            }
            
                    }

                    return $result;

            }
                    
					function eliminarInsu($deleteIn){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idInsu = $deleteIn['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `a_insumos` WHERE `idInsumos`= ?");
                                                $stmt->bind_param('i', $idInsu);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                    }

                    function eliminarInsuAuto($deleteIn){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {

                            printf("Conexión fallida: %s\n", $conn->connect_error);
                            exit();

                    } else{

                            $idInsu = $deleteIn['id'];
                            $stmt = $conn->prepare( "DELETE FROM `ac_insumos` WHERE `idInsumos`= ?");
                            $stmt->bind_param('i', $idInsu);
                            $stmt->execute();	
                                    
                        }

                        return $result;

                    }

}


?>