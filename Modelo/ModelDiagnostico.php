<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/sis/config.php');
include (CONTROLLER_PATH."conexion.php");
include (MODEL_PATH."global.php");


header('Content-Type: text/html; charset=utf-8');
//error_reporting(0);



class ModelDiagnostico{

                      

					function InsertDiagnostico($diagnostico){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                        $idDx          = $diagnostico['idDx'];
                                        $iduser        = $diagnostico['iduser'];
                                        $idpres        = $diagnostico['idpres'];
                                        $tipoDx        = $diagnostico['tipoDx'] ;
                                        $codDx         = $diagnostico['codDx'] ;
                                        $descripcion   = $diagnostico['descripcion'];
                                

                                    if($idDx!=""){
                                        echo "actual";
                                        $stmt = $conn->prepare( "UPDATE `ac_diagnostico` SET `IdUsuario`= ?,`id_prestacion`= ?,`tipo_diagnostico`=?,`codigo_diagnostico`=?,
                                        `Descripcion_diagnostico`=? WHERE `IdDiagnostico`= $idDx");                                  
                                        $stmt->bind_param('isiss', $iduser, $idpres, $tipoDx,$codDx,$descripcion);
                                        $stmt->execute();
                                    
                                    }else {
                                        
                                        $stmt = $conn->prepare( "INSERT ac_diagnostico (`IdUsuario`, `id_prestacion`, `tipo_diagnostico`, `codigo_diagnostico`, `Descripcion_diagnostico`) 
                                        VALUES (?, ?, ?, ?, ?)");
                                        $stmt->bind_param('isiss', $iduser, $idpres, $tipoDx,$codDx,$descripcion);
                                        $stmt->execute();
                                        printf("Error: %s.\n", $stmt->error);

                                        $stmt->close();	
                                        
                                    }
                    
                            }

                            return $result;

                    }
                    

                    function InsertResposanble($diagnostico){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {
                        printf("Conexión fallida: %s\n", $conn->connect_error);
                        exit();

                    }else{

                    

                                $idcuen         = $diagnostico['idcuen'];
                                $tipodoc        = $diagnostico['tipodoc'];
                                $nrodoc         = $diagnostico['nrodoc'];
                                $apepaterno     = $diagnostico['apepaterno'] ;
                                $apematerno     = $diagnostico['apematerno'] ;
                                $nombres        = $diagnostico['nombres'];
                                $fingreso       = $diagnostico['fingreso'];
                                $fsalta         = $diagnostico['fsalta'];
                                $profesion      = $diagnostico['profesion'];
                                $colegio        = $diagnostico['colegio'];
                                $especialidad   = $diagnostico['especialidad'];
                                $nroregistro    = $diagnostico['nroregistro'];
                                $condicion      = $diagnostico['condicion'];
                                //$estado   = $diagnostico['estado'];
                                
                                $stmt = $conn->prepare( "UPDATE `imp_cuentas` SET `tipo_documento_responsable`= ?,`nro_documento_responsable`= ?,`apellido_paterno_responsable`=?,`apellido_materno_responsable`=?,
                                `nombres_responsable`=?, `fecha_ingreso`=?, `fecha_alta`=?, `profesion_responsable`=?, `nro_colegiatura`=?, `codigo_especialidad`=? , `nro_registro_especialista`=? , `condicion_alta`=? 
                                WHERE `IdCuentaAtencion`= $idcuen");                                  
                                $stmt->bind_param('ssssssssssss', $tipodoc, $nrodoc, $apepaterno,$apematerno,$nombres,$fingreso,$fsalta,$profesion,$colegio,$especialidad,$nroregistro,$condicion);
                                $stmt->execute();
                            
                        
                            
                         }

                             return $result;

                    }



                    function InsertGropuy($diagnostico){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {
                        printf("Conexión fallida: %s\n", $conn->connect_error);
                        exit();

                    }else{


                                $iduser    = $diagnostico['iduser'];
                                $mes       = $diagnostico['mes'];
                                $anio      = $diagnostico['anio'];
                               

                                $consulta3 = "SELECT `idRegistro` FROM `imp_group` WHERE `mes`='$mes' AND `anio`='$anio'";
								$verIf3 = mysqli_query($conn,$consulta3);
								$cnt3 = mysqli_num_rows($verIf3);

                                if($cnt3>0){

                                    echo "1";

                                }else{

                                        $stmt = $conn->prepare( "INSERT INTO `imp_group`(`iduser`, `mes`, `anio`) VALUES  (?, ?, ?)");
                                        $stmt->bind_param('iss', $iduser, $mes, $anio);
                                        $stmt->execute();
                                        $stmt->close();	

                                }                        
                         }

                    }


                    function InsertAuditor($diagnostico){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {
                        printf("Conexión fallida: %s\n", $conn->connect_error);
                        exit();

                    }else{


                            $idgroux    = $diagnostico['idgroux'];
                            $audi       = $diagnostico['audi'];
                            $estado     = $diagnostico['estado'];
                            
                            $stmt = $conn->prepare( "UPDATE `paciente` SET `auditor`= ?,`estado`= ? WHERE `idPac`='$idgroux'");                                  
                            $stmt->bind_param('is',$audi, $estado);
                            $stmt->execute();
                            printf("Error: %s.\n", $stmt->error);
                            $stmt->close();	

                                                          
                         }

                           // return $result;

                    }


                    function InsertTecnico($diagnostico){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {
                        printf("Conexión fallida: %s\n", $conn->connect_error);
                        exit();

                    }else{


                            $idgrouxt = $diagnostico['idgrouxt'];
                            $tecx     = $diagnostico['tecx'];
                            
                            $stmt = $conn->prepare( "UPDATE `paciente` SET `tecnico`= ? WHERE `idPac`='$idgrouxt'");                                  
                            $stmt->bind_param('i',$tecx);
                            $stmt->execute();
                            printf("Error: %s.\n", $stmt->error);
                            $stmt->close();	

                                                          
                         }

                           // return $result;

                    }
                    
                    function InsertEst($diagnostico){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {
                        printf("Conexión fallida: %s\n", $conn->connect_error);
                        exit();

                    }else{


                                $idcuen = $diagnostico['id'];
                                $ex     = "1";

                                $stmt = $conn->prepare( "UPDATE `imp_cuentas` SET  `estadoCuenta`=? WHERE `IdCuentaAtencion`= $idcuen");                                  
                                $stmt->bind_param('s',$ex);
                                $stmt->execute();
                            
                        
                            
                         }

                             return $result;

                    }
                    
					function eliminarDx($deleteDx){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx = $deleteDx['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `ac_diagnostico` WHERE `IdDiagnostico`= ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                    }


}


?>