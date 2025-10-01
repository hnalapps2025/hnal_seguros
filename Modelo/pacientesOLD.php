<?php 

include_once ('./../config.php');
include (CONTROLLER_PATH."conexion.php");
include (MODEL_PATH."global.php");


header('Content-Type: text/html; charset=utf-8');
error_reporting(0);
date_default_timezone_set('America/Lima');


class Pacientes{


					function consultaPacients(){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT P.auditor AS idaudi,P.estado,P.`idPac`,(SELECT user from usuarios WHERE id=P.iduser) as GESTION, P.`nroFua`, P.`nroCuenta`, P.`paciente`, P.`servicio`, P.`F_Ingreso`, P.`F_Alta_Medica`,
						(SELECT user from usuarios WHERE id=P.auditor) as AUDITOR,(SELECT user from usuarios WHERE id=P.tecnico) AS TECNICO,
						 P.`Historia`, P.`DNI` 
						 FROM `paciente` AS P
						 LEFT JOIN USUARIOS AS U ON P.iduser = U.id ORDER BY P.idPac DESC";
						
					      $result = $conn->query($sql);				

						}

						return $result;

					}
					
					function notificacionesCount($idAuditorAsignado,$estadoRegistro,$tipoEstudio){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
							$sql = "SELECT idPato FROM `tbl_registroPacientesPatologia` WHERE idAuditorAsignado='$idAuditorAsignado' AND `estadoRegistro`='$estadoRegistro' AND `tipoEstudio`='$tipoEstudio'";
						
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					
					function numeroRegistros($tipo,$desde,$hasta){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
    							printf("Conexión fallida: %s\n", $conn->connect_error);
    							exit();

						}else{
						
				
                        $where='';
						    
						   if($tipo!="" &&  $desde!="" && $hasta!=""  ){
						        $where = "WHERE `tipoEstudio`= '$tipo' AND `fechaRecepcion` BETWEEN '$desde' AND '$hasta' ";
						    }else if($tipo!="" ){
            				    $where = "WHERE `tipoEstudio`= '$tipo' ";
						    }else if($desde!="" && $hasta!="" ){
						        $where = "WHERE `fechaRecepcion` BETWEEN '$desde' AND '$hasta' ";
						    }
						
        					      $sql = "SELECT * FROM `tbl_registroPacientesPatologia` $where ";
        					      $result = $conn->query($sql);

						}

						return $result;

					}
					
					function registrosinmunohistoquimica($tipo,$desde,$hasta,$vari){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
    							printf("Conexión fallida: %s\n", $conn->connect_error);
    							exit();

						}else{
						    
						            
                                   $where='';
            						    
            						    if($tipo!="" &&  $desde!="" && $hasta!=""  ){
            						        $where = "AND `tipoEstudio`= '$tipo' AND `fechaRecepcion` BETWEEN '$desde' AND '$hasta' ";
            						    }else if($tipo!="" ){
            						        $where = "AND `tipoEstudio`= '$tipo' ";
            						    }else if($desde!="" && $hasta!="" ){
            						        $where = "AND `fechaRecepcion` BETWEEN '$desde' AND '$hasta' ";
            						    }
						
        					      $sql = "SELECT * FROM `tbl_registroPacientesPatologia` WHERE `procedRealCito` = '$vari' $where";
        					      $result = $conn->query($sql);

						}

						return $result;

					}

                    
                    
                    function registrosFinancia($tipo,$desde,$hasta){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
    							printf("Conexión fallida: %s\n", $conn->connect_error);
    							exit();

						}else{
						    
                                    $where='';
        						    if($tipo!="" &&  $desde!="" && $hasta!=""){
        						        $where = "AND `tipoEstudio`= '$tipo' AND `fechaRecepcion` BETWEEN '$desde' AND '$hasta' ";
        						    }else if($tipo!="" ){
            						        $where = "AND `tipoEstudio`= '$tipo' ";
            						    }else if($desde!="" && $hasta!="" ){
            						        $where = "AND `fechaRecepcion` BETWEEN '$desde' AND '$hasta' ";
            						    }
        						    
        						    
        						    
						
        					      $sql = "SELECT * FROM `tbl_registroPacientesPatologia` WHERE `finaciamiento`= 2 $where";
        					      $result = $conn->query($sql);

						}

						return $result;

					}
					
					
					 function lisProcedimientos($tipo,$desde,$hasta){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
    							printf("Conexión fallida: %s\n", $conn->connect_error);
    							exit();

						}else{
						    
                                    $where='';
        						    if($tipo!="" &&  $desde!="" && $hasta!=""){
        						        $where = "WHERE `tipoEstudio`= '$tipo' AND `fechaRecepcion` BETWEEN '$desde' AND '$hasta' ";
        						    }else if($tipo!="" ){
        						        $where = "WHERE `tipoEstudio`= '$tipo' ";
        						    }else if($desde!="" && $hasta!="" ){
        						        $where = "WHERE `fechaRecepcion` BETWEEN '$desde' AND '$hasta' ";
        						    }
        						    
						
        					      $sql = "SELECT `procedimiento`,(SELECT NombreCorto FROM tbl_tipoEstudioProced WHERE idtpo=T.procedimiento) AS PROC,COUNT(procedimiento) AS CANTI
        					      FROM `tbl_registroPacientesPatologia` AS T $where GROUP BY PROC ORDER BY CANTI DESC";
        					      $result = $conn->query($sql);

						}

						return $result;

					}
					
					
					function lisRotulos($tipo,$desde,$hasta){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
    							printf("Conexión fallida: %s\n", $conn->connect_error);
    							exit();

						}else{
						    
                                    $where='';
        						    if($tipo!="" &&  $desde!="" && $hasta!=""){
        						        $where = "WHERE `tipoEstudio`= '$tipo' AND `fechaRecepcion` BETWEEN '$desde' AND '$hasta' ";
        						    }else if($tipo!="" ){
        						        $where = "WHERE tipoEstudio='$tipo' ";
        						    }else if($desde!="" && $hasta!="" ){
        						        $where = "WHERE `fechaRecepcion` BETWEEN '$desde' AND '$hasta' ";
        						    }
        						    
						
        					      $sql = "SELECT `rotulo`,count(`rotulo`) AS ROTA FROM `tbl_observacionesRotulo`  $where  GROUP BY `rotulo`";
        					      $result = $conn->query($sql);

						}

						return $result;

					}


                        function countLisProcedimientos($tipo,$uno,$desde,$hasta){
        
        						$db = new Conectar();
        						$conn = $db->conexion();		
        
        						if ($conn->connect_errno) {
            							printf("Conexión fallida: %s\n", $conn->connect_error);
            							exit();
        
        						}else{
        						    
                                            $where='';
                						    if($uno!="" &&  $desde!="" && $hasta!=""){
                						        $where = "AND `tipoEstudio`= '$uno' AND `fechaRecepcion` BETWEEN '$desde' AND '$hasta' ";
                						    }else if($uno!="" ){
        						                $where = "AND `tipoEstudio`= '$uno' ";
                						    }else if($desde!="" && $hasta!="" ){
                						        $where = "AND `fechaRecepcion` BETWEEN '$desde' AND '$hasta' ";
                						    }
                						    
                						    
                						   
                					      $sql = "SELECT * FROM `tbl_registroPacientesPatologia` WHERE `procedimiento`= '$tipo' $where ";
                					      $result = $conn->query($sql);
        
        						}
        
        						return $result;
        
        					}




					function exportaCalendar($min,$max){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT E.id,UPPER(U.user) AS title, E.start,date_add(E.end, INTERVAL -1 DAY) as end, 
						E.color ,E.observaciones,E.fechaEntrega,E.recepcion,(SELECT user FROM USUARIOS WHERE id=E.idGest) AS idgex 
						FROM events AS E 
						INNER JOIN usuarios AS U ON E.title=U.id
						WHERE E.start BETWEEN '$min' AND '$max'
						ORDER BY U.user ASC";
						
					      $result = $conn->query($sql);				

						}

						return $result;

					}


					function consultaReposi(){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
							$sql = "SELECT `idPac`, `iduser`, `nroCuenta`, `Historia`, `nroFua`, `paciente`, 
							`F_Ingreso`, `F_Alta_Medica`, `servicio`, `licenciada`, `firma`, `auditor`, `observacion`,
							`tecnico`, `fe_reg` FROM `repositorio` ORDER BY F_Alta_Medica DESC ";
						
					      $result = $conn->query($sql);				

						}

						return $result;

					}


               /* function verUserPaquete($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
							$sql = "SELECT (SELECT user FROM usuarios WHERE id= G.`idUsuario`) as UA,G.`namePaquete` 
							FROM `tbl_grupoCE` AS G WHERE G.`idGrupo`='$id' ";
						
					        $result = $conn->query($sql);				

						}

						return $result;

					}*/
					
					
					 function verUserCierreConfirmacion($user,$fechaHoy){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
							$sql = "SELECT COUNT(*) AS CNT FROM `tbl_grupoArchivo` WHERE `idUsuario` ='$user' AND  date_format(`fechaRegistro`,'%Y-%m-%d') ='$fechaHoy'  AND tipoRegistro='2' ";
					        $result = $conn->query($sql);				

						}

						return $result;

					}


					function asignarAuditor($fecha){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
							/*$sql = "SELECT IF ('$fecha' BETWEEN E.start AND E.end, 'si','no') AS respuesta,U.user  AS auditor 
							FROM events AS E 
							INNER JOIN usuarios AS U ON E.title=U.id";*/

							$sql="SELECT IF ('$fecha' BETWEEN E.start AND date_format(date_add(E.end, INTERVAL -1 DAY), '%Y/%m/%d'), 'si','no') AS respuesta,U.user  AS auditor 
							FROM events AS E 
							INNER JOIN usuarios AS U ON E.title=U.id";
						
					        $result = $conn->query($sql);

						}

						return $result;

					}



					function consultaCatalogoCpms(){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `idCpms`, `APO_ID`, `CODIGO_CPT`, `deno1`, `CODIGO_CPMS`, `deno2`, `II_nivel`, `III_nivel` FROM `sis_cpms` WHERE estado = 1";
						
					      $result = $conn->query($sql);				

						}

						return $result;

					}
					
					
						function consultaPacientesAuditados(){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT P.`idPac`, P.`nroFua`, P.`nroCuenta`, P.`paciente`, P.`servicio`, P.`F_Ingreso`, P.`F_Alta_Medica`, P.`Historia` FROM `paciente` AS P 
						 WHERE P.estado='ENVIADO' AND P.tipoEval=2 AND P.idPac NOT IN (SELECT `idPac` FROM `listadoAtenciones`)";
						
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					function InserObs($diagnostico){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {
                        printf("Conexión fallida: %s\n", $conn->connect_error);
                        exit();

                    }else{


                            $id     = $diagnostico['id'];
                            $obs    = $diagnostico['obs'];
							$estado = $diagnostico['estado'];
							$dx1   = $diagnostico['dx1'];
							$dx2   = $diagnostico['dx2'];
							$dx3   = $diagnostico['dx3'];
							$dx4   = $diagnostico['dx4'];
							$dx5   = $diagnostico['dx5'];
							
							$dx6   = $diagnostico['dx6'];
							$dx7   = $diagnostico['dx7'];
							$dx8   = $diagnostico['dx8'];
							$dx9   = $diagnostico['dx9'];
							$dx10   = $diagnostico['dx10'];
							
							
							$tip1   = $diagnostico['tip1'];
							$tip2   = $diagnostico['tip2'];
							$tip3   = $diagnostico['tip3'];
							$tip4   = $diagnostico['tip4'];
							$tip5   = $diagnostico['tip5'];
							
							$tip6   = $diagnostico['tip6'];
							$tip7   = $diagnostico['tip7'];
							$tip8   = $diagnostico['tip8'];
							$tip9   = $diagnostico['tip9'];
							$tip10   = $diagnostico['tip10'];
							
							$codPreHos   = $diagnostico['codPreHos'];
							$ubiSerHosp   = $diagnostico['ubiSerHosp'];
							$prioAudit   = $diagnostico['prioAudit'];
							
							date_default_timezone_set('America/Lima');
							$fechaEnvioAuditoria   = date("Y-m-d H:i:s");
						
                            
                            $stmt = $conn->prepare( "UPDATE `paciente` SET `observacion`= ?,`estado`= ?,`cie10_1`= ?,`tpdx1`=?,`dx2`=?,`tpdx2`=?,`dx3`=?,`tpdx3`=?,`dx4`=?,
                            `tpdx4`=?,`dx5`=?,`tpdx5`=?,fechaEnvioAuditoria = ?,denominacion = ?,codPre= ?,prioridad= ?,`dx6`=?,`tpdx6`=?,`dx7`=?,`tpdx7`=?,`dx8`=?,`tpdx8`=?,`dx9`=?,`tpdx9`=?,`dx10`=?,`tpdx10`=?  WHERE `idPac`='$id'");                                  
                            $stmt->bind_param('sssssssssssssissssssssssss',$obs, $estado,$dx1,$tip1,$dx2,$tip2,$dx3,$tip3,$dx4,$tip4,$dx5,$tip5,$fechaEnvioAuditoria,$ubiSerHosp,$codPreHos,$prioAudit,$dx6,$tip6,$dx7,$tip7,$dx8,$tip8,$dx9,$tip9,$dx10,$tip10);
                            $stmt->execute();
                            printf("Error: %s.\n", $stmt->error);
                            $stmt->close();	

                                                          
                         }

                           // return $result;

                    }
                    
                    
                    function InserObsEmer($diagnostico){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {
                        printf("Conexión fallida: %s\n", $conn->connect_error);
                        exit();

                    }else{


                            $id     = $diagnostico['id'];
                            $obs    = $diagnostico['obs'];
							$estado = $diagnostico['estado'];
							$dx1   = $diagnostico['dx1'];
							$dx2   = $diagnostico['dx2'];
							$dx3   = $diagnostico['dx3'];
							$dx4   = $diagnostico['dx4'];
							$dx5   = $diagnostico['dx5'];
							
							$dx6   = $diagnostico['dx6'];
							$dx7   = $diagnostico['dx7'];
							$dx8   = $diagnostico['dx8'];
							$dx9   = $diagnostico['dx9'];
							$dx10   = $diagnostico['dx10'];
							
							
							$tip1   = $diagnostico['tip1'];
							$tip2   = $diagnostico['tip2'];
							$tip3   = $diagnostico['tip3'];
							$tip4   = $diagnostico['tip4'];
							$tip5   = $diagnostico['tip5'];
							
							$tip6   = $diagnostico['tip6'];
							$tip7   = $diagnostico['tip7'];
							$tip8   = $diagnostico['tip8'];
							$tip9   = $diagnostico['tip9'];
							$tip10   = $diagnostico['tip10'];
							
							
							$codPreHos   = $diagnostico['codPreHos'];
							$ubiSerHosp   = $diagnostico['ubiSerHosp'];
							$prioAudit   = $diagnostico['prioAudit'];
							
							date_default_timezone_set('America/Lima');
							$fechaEnvioAuditoria   = date("Y-m-d H:i:s");
						
                            
                            $stmt = $conn->prepare( "UPDATE `paciente` SET `observacion`= ?,`estado`= ?,`cie10_1`= ?,`tpdx1`=?,`dx2`=?,`tpdx2`=?,`dx3`=?,`tpdx3`=?,`dx4`=?,
                            `tpdx4`=?,`dx5`=?,`tpdx5`=?,fechaEnvioAuditoria = ?,`dx6`=?,`tpdx6`=?,`dx7`=?,`tpdx7`=?,`dx8`=?,`tpdx8`=?,`dx9`=?,`tpdx9`=?,`dx10`=?,`tpdx10`=?  WHERE `idPac`='$id'");                                  
                            $stmt->bind_param('sssssssssssssssssssssss',$obs, $estado,$dx1,$tip1,$dx2,$tip2,$dx3,$tip3,$dx4,$tip4,$dx5,$tip5,$fechaEnvioAuditoria,$dx6,$tip6,$dx7,$tip7,$dx8,$tip8,$dx9,$tip9,$dx10,$tip10);
                            $stmt->execute();
                            printf("Error: %s.\n", $stmt->error);
                            $stmt->close();	

                                                          
                         }

                           // return $result;

                    }
                    
                    
                    
					function consultaXvencer(){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `NroCarta`,`NroCarta2`,`NroCarta3`,`Paciente` FROM cartagarantia WHERE `Fecha_Fin_Vigencia` between curdate() and date_add(curdate(), interval 30 day)";
						$result = $conn->query($sql);				

						}

						return $result;

					}

					function cartasGarantiaWhere($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `nrocuenta` FROM `cuentas` WHERE `idprestacion`= '$id'";
						
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					function autorizaciones($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `idRegistro`, `idUsuario`, `nro_documento_autorizacion`, `tipo_documento_paciente`, `nro_documento_paciente`,
						 `apellido_paterno_paciente`, `apellido_materno_paciente`, `nombres_paciente`, `nro_historia`, `fecha_nacimiento`, `sexo`, 
						 `tipo_atencion`, `fechaRegistro` FROM `imp_autorizaciones` WHERE grupo='$id' ORDER BY idRegistro DESC";
					      $result = $conn->query($sql);				

						}

						return $result;

					}


					/* INICIO GENERADOR DE TXT */

					function generarTxtAtencionCliente($grupo){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT I.id_prestacion,A.`idRegistro`, A.`idUsuario`, A.`nro_documento_autorizacion`, A.`tipo_documento_paciente`,
						A.`nro_documento_paciente`, A.`apellido_paterno_paciente`, A.`apellido_materno_paciente`, A.`nombres_paciente`,
						A.`nro_historia`, A.`fecha_nacimiento`, A.`sexo`, A.`tipo_atencion`, A.`fechaRegistro` ,
						I.`IdCuentaAtencion`, I.`nro_documento_autorizacion`, I.`fecha_ingreso`, I.`fecha_alta`, I.`tipo_documento_responsable`,
						I.`nro_documento_responsable`, I.`apellido_paterno_responsable`, I.`apellido_materno_responsable`,
						I.`nombres_responsable`, I.`profesion_responsable`, I.`nro_colegiatura`, I.`codigo_especialidad`,
						I.`nro_registro_especialista`, I.`condicion_alta`
						 FROM `imp_autorizaciones` AS A
						 INNER JOIN imp_cuentas AS I ON A.nro_documento_autorizacion=I.nro_documento_autorizacion
						 WHERE I.grupo='$grupo' GROUP BY I.id_prestacion";
					    $result = $conn->query($sql);				

						}

						return $result;

					}


					function generarTxtDx($grupo){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
							$sql = "SELECT A.`id_prestacion`, A.`tipo_diagnostico`, 
							A.`codigo_diagnostico`, A.`Descripcion_diagnostico` 
							FROM `ac_diagnostico` AS A
							INNER JOIN imp_cuentas AS I ON A.id_prestacion=I.id_prestacion
							WHERE I.grupo = '$grupo'";
							$result = $conn->query($sql);				
						
						}

						return $result;

					}


					function generarTxtCpt($grupo){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT A.`IdProcedimiento`, A.`IdUsuario`, A.`id_prestacion`, A.`codigo_cpt`, A.`cantidad`, 
						A.`valorizacion`, A.`descripcion`, A.`fechaIngreso`, A.`total`, A.`dx` 
						FROM `ac_procedimientos`AS A
						INNER JOIN imp_cuentas AS I ON A.id_prestacion=I.id_prestacion
						WHERE I.grupo = '$grupo'";
						
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					
					function generarTxtFarmacia($grupo){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT  A.`id_prestacion`, A.`codigo_sismed`, A.`cantidad`, A.`diagnostico`, A.`total` 
						 FROM `ac_insumos` AS A
						INNER JOIN imp_cuentas AS I ON A.id_prestacion=I.id_prestacion
						WHERE I.grupo = '$grupo'
						 UNION ALL
						 SELECT  AE.`id_prestacion`, AE.`codigo_sismed`, AE.`cantidad`, AE.`diagnostico`, AE.`total` 
						 FROM `ac_medicamentos` AS AE
						 INNER JOIN imp_cuentas AS I ON AE.id_prestacion=I.id_prestacion
						 WHERE I.grupo = '$grupo'";
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					/* FIN GENERADOR DE TXT */

					function cartasCuentas($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						  $sql = "SELECT `idCuenta`, `idprestacion`, `nrocuenta`, `historia`, `fatencion`, `consultorio`, `estado` 
						  FROM `cuentas` WHERE idprestacion='$id' ORDER BY idCuenta DESC";
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					

					function exportarTotalesGroup($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						  $sql = "SELECT `nro_documento_autorizacion`,`apellido_paterno_paciente`,`apellido_materno_paciente`,`nombres_paciente` 
						  FROM `imp_autorizaciones` WHERE `grupo`='$id' ORDER BY idRegistro DESC";
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					function exportarTotalesCuentas($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						  $sql = "SELECT `IdCuentaAtencion` FROM `imp_cuentas` WHERE `nro_documento_autorizacion`='$id'";
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					function sumTotalCpt($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						  $sql = "SELECT SUM(P.total) AS Total,c.id_prestacion FROM imp_autorizaciones AS A
						  INNER JOIN imp_cuentas AS C ON A.nro_documento_autorizacion=C.nro_documento_autorizacion
						  INNER JOIN ac_procedimientos AS P ON C.id_prestacion=P.id_prestacion
						  WHERE C.nro_documento_autorizacion='$id'";

					      $result = $conn->query($sql);				

						}

						return $result;

					}

					function sumTotalIns($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						  $sql = "SELECT SUM(P.total) AS Total,c.id_prestacion FROM imp_autorizaciones AS A
						  INNER JOIN imp_cuentas AS C ON A.nro_documento_autorizacion=C.nro_documento_autorizacion
						  INNER JOIN ac_insumos AS P ON C.id_prestacion=P.id_prestacion
						  WHERE C.nro_documento_autorizacion='$id'";

					      $result = $conn->query($sql);				

						}

						return $result;

					}


					function sumTotalMed($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						  $sql = "SELECT SUM(P.total) AS Total,c.id_prestacion FROM imp_autorizaciones AS A
						  INNER JOIN imp_cuentas AS C ON A.nro_documento_autorizacion=C.nro_documento_autorizacion
						  INNER JOIN ac_medicamentos AS P ON C.id_prestacion=P.id_prestacion
						  WHERE C.nro_documento_autorizacion='$id'";

					      $result = $conn->query($sql);				

						}

						return $result;

					}


					function consultaXGrupoX(){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						  $sql = "SELECT I.`idRegistro`, I.`iduser`, I.`mes`, I.`anio`, I.`fechaRegistro`,U.user ,I.resposanble,U.rol
						  FROM `imp_group` AS I
						  LEFT JOIN usuarios AS U ON I.resposanble=U.id";
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					function numCuentas($es,$grupo){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						  $sql = "SELECT `idRegistro` FROM `imp_cuentas` WHERE `estadoCuenta`='$es' AND `grupo`='$grupo'";
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					function numCuentasX($grupo){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						  $sql = "SELECT `idRegistro` FROM `imp_cuentas` WHERE `grupo`='$grupo'";
					      $result = $conn->query($sql);				

						}

						return $result;

					}
					

					function nroCuentas($id,$grupo){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						  $sql = "SELECT `idRegistro` FROM `imp_cuentas` WHERE `nro_documento_autorizacion`='$id' AND grupo='$grupo'";
						  //echo $sql;
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					function nroCuentasPendientes($id,$es,$grupo){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						  $sql = "SELECT `idRegistro` FROM `imp_cuentas` WHERE `nro_documento_autorizacion`='$id' AND estadoCuenta='$es' AND grupo='$grupo'";
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					function cartasCuentasAuto($id,$es,$grupo){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						  $sql = "SELECT `idRegistro`, `idUsuario`, `id_prestacion`, `IdCuentaAtencion`, `nro_documento_autorizacion`, `fecha_ingreso`, `fecha_alta`,
						   `tipo_documento_responsable`, `nro_documento_responsable`, `apellido_paterno_responsable`, `apellido_materno_responsable`, `nombres_responsable`, 
						  `profesion_responsable`, `nro_colegiatura`, `codigo_especialidad`, `nro_registro_especialista`, `condicion_alta`, `fechaRegistro` ,estadoCuenta
						  FROM `imp_cuentas` WHERE `nro_documento_autorizacion`='$id' AND estadoCuenta='$es' AND grupo='$grupo' ORDER BY idRegistro DESC";
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					function cartasCuentasReporte(){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						  $sql = "SELECT `nrodoc`, `NroCarta`, `NroCarta2`, `NroCarta3`, `Ampliación`, `Paciente`, `Fecha_Carta`, C.interconsulta,
						  `IAFA`, `Producto`, `Tarifa`, `Aseguradora`, `Poliza`, `CIE10`, `Diagnostico`, `Fecha_Inicio_Vigencia`,C.estado,
						   `Fecha_Fin_Vigencia`, `Monto_Ampliacion`, `anio`, `usuario`, `referencia`, `fenac`, `edad` ,C.nrocuenta,C.fatencion,C.consultorio
						   FROM `cartagarantia` AS G
						   INNER JOIN cuentas AS C ON G.idCar=C.idprestacion";
					      $result = $conn->query($sql);				

						}

						return $result;

					}

					function paginador($ini,$final){

						$db = new Conectar();
						$conn = $db->conexion();		
	
						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();
						}else{
	
						$sql = "SELECT 	`idRegistro`, `cuenta`, `ApePaterno`, `ApeMaterno`, `FechaNacimiento`,
						 `sexo`, `TipoAtencion`, `HistoriaClinica`, `TIpoDoc`, `NroDoc`, `Nombres`, `fe_in`, `estatus` FROM `regpersona` WHERE estatus='ACTIVO' LIMIT $ini,$final";
						$result = $conn->query($sql);				
						}
						
							return $result;
	
					}
					
			
			
					function consultaXid($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `IdDiagnostico`, `IdUsuario`, `id_prestacion`, `tipo_diagnostico`, `codigo_diagnostico`, `Descripcion_diagnostico`, `fechaIngreso` , `total`
						FROM `a_diagnostico` WHERE id_prestacion='$id'";
						$result = $conn->query($sql);				

						}

						return $result;

					}

					function consultaXidCuentaX($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT A.`tipo_documento_paciente`, A.`nro_documento_paciente`, A.`apellido_paterno_paciente`, A.`apellido_materno_paciente`,
						 A.`nombres_paciente`, A.`nro_historia`, A.`fecha_nacimiento`, A.`sexo`, A.`tipo_atencion`,
						 I.`id_prestacion`, I.`IdCuentaAtencion`, I.`nro_documento_autorizacion`, I.`fecha_ingreso`, I.`fecha_alta`, I.`tipo_documento_responsable`, 
						 I.`nro_documento_responsable`, I.`apellido_paterno_responsable`, I.`apellido_materno_responsable`, I.`nombres_responsable`, 
						 I.`profesion_responsable`, I.`nro_colegiatura`, I.`codigo_especialidad`, I.`nro_registro_especialista`, I.`condicion_alta`,G.referencia
						FROM `imp_autorizaciones` AS A
						LEFT JOIN imp_cuentas AS I ON A.nro_documento_autorizacion=I.nro_documento_autorizacion
						LEFT JOIN cuentas AS C ON I.IdCuentaAtencion=C.nrocuenta
						LEFT JOIN cartagarantia AS G ON C.idprestacion=G.idCar
						WHERE I.IdCuentaAtencion='$id'";
						$result = $conn->query($sql);				

						}

						return $result;

					}


					function consultaXidDx($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `IdDiagnostico`, `IdUsuario`, `id_prestacion`, `tipo_diagnostico`, `codigo_diagnostico`, `Descripcion_diagnostico`, `fechaIngreso`,U.user
						FROM `ac_diagnostico` AS P
						INNER JOIN usuarios AS U ON P.IdUsuario= U.id
						WHERE id_prestacion='$id'";
						$result = $conn->query($sql);				

						}

						return $result;

					}


					function consultaidPresta($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `id_prestacion` FROM `imp_cuentas` WHERE `IdCuentaAtencion`='$id'";
						$result = $conn->query($sql);				

						}

						return $result;

					}

					function consultaXidPacx($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT P.`idPac`, P.`nroFua`, P.`nroCuenta`, P.`paciente`, P.`servicio`, P.`F_Ingreso`, P.`F_Alta_Medica`, 
								P.`Historia`, P.`DNI`,P.observacion, P.`fe_reg`,(SELECT `descripcion` FROM `codPrestHospi` WHERE `idCod`=P.`denominacion`) as den,
								(SELECT `descripcion` FROM `tbl_codigosprestacionalesCE` WHERE `codigo` = P.`codPre`) as den2,
								P.`codPre`,P.montogal,P.montosisfar,(SELECT UPPER(nom) FROM usuarios WHERE id=P.iduser ) AS AUDITOR ,
								P.cie10_1,P.dx2,P.dx3,P.dx4,P.dx5,P.dx6,P.dx7,P.dx8,P.dx9,P.dx10,(SELECT cmp FROM usuarios WHERE id=P.iduser ) AS cmp ,(SELECT rna FROM usuarios WHERE id=P.iduser ) AS rna ,
								P.tipoEval,(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` = P.serEgreso) as serEmCe  FROM `paciente` P WHERE P.`idPac` = '$id'";
								$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function consultaXinmunohisto($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT `idPato`, `iduser`, `tipodoc`, `nrodoc`, `paciente`, `edad`, `sexo`, `finaciamiento`, `ipress`,
								`jurisdiccion`, `cuenta`, `historia`, `servicio`, `salacama`, `celular`, `nroOrden`, `anio`, `fechaReg`, 
								`fechaModificacion`, `nroFactura`, `tipoEstudio`, `procedimiento`, `medicoSolicitante`, `especialidad`,(SELECT nom FROM usuarios WHERE id=T.nomApeConfirApepat) AS USRE2,
								`fechaRecepcion`, `corPat`, `anaMuestraCito`, `procedRealCito`,(SELECT nom FROM usuarios WHERE id= T.medicoSolcit) AS MEDSOCI, `medicoSolcit`, `dxClinicoHi`, `interpretacPato`,
								(SELECT nom FROM usuarios WHERE id=T.idReportPdf) AS USRE3,(SELECT nom FROM usuarios WHERE id=T.idAuditorAsignado) AS USRESPEC,
								`comentarioPatol`, `notaPatol`,(SELECT nom FROM usuarios WHERE id=T.idGeneraInforme) AS USRE,idReportPdf,fechaHoraReport,
								fechaidGeneraInforme,fechaidReportPdf,fechaHoraCerEspe,
								(SELECT descripcion from tbl_cptsCitologia WHERE CODE =(SELECT idRo FROM tbl_observacionesRotulo WHERE  idRegRot='$id') )  as DXI 
								 FROM `tbl_registroPacientesPatologia` AS T WHERE `idPato` = '$id'";
								 
								 $result = $conn->query($sql);				

						}

						return $result;

					}
					
					function consultaXDescripcionMacro($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT O.descripcion,(SELECT  `anio` FROM `tbl_registroPacientesPatologia` WHERE idPato = O.idRegRot)  AS NIO,
								 (SELECT  `corPat` FROM `tbl_registroPacientesPatologia` WHERE idPato = O.idRegRot)  AS CORPA,
								 (SELECT  `paciente` FROM `tbl_registroPacientesPatologia` WHERE idPato = O.idRegRot)  AS PAX
								 FROM `tbl_observacionesRotulo` AS O WHERE `idRo` = '$id'";
								 
								 $result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function consultaXMuestraHisto($formate,$tipoest){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT `rotulo` FROM `tbl_observacionesRotulo` WHERE `formatoPatoMac`= '$formate' AND  `tipoEstudio` = '$tipoest'";
								$result = $conn->query($sql);				

						}

						return $result;

					}
					
					function consultaXMarcador($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT `idMar`, `iduser`, `marcador`, `resultado`, `fechaReg`, `fechaActualiza`,
								`resulDepend`, `intesTincion`, `nucleosPos`, `subtotalPun`, `interpretHi` FROM `tbl_crudMarcadores` WHERE idPrin='$id'";
								$result = $conn->query($sql);				

						}

						return $result;

					}
					
					function consultaXRotulosPdf($forma,$tipoest){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT O.`rotulo`,O.`descripcion`,O.`descMicro`,
								(SELECT `Sistema` FROM `SistemaReporte` WHERE Id=O.hallazgo) as RE,
								(SELECT `ParteSistema` FROM `ParteSistemaRep` WHERE Id=O.sisReporte) as TE,
								(SELECT `Descripcion` FROM `ClasifReporte` WHERE Id=O.clasificacion) as CLA,
								(SELECT descripcion from tbl_cptsCitologia WHERE CODE =
								(SELECT idRo FROM tbl_observacionesRotulo WHERE  `formatoPatoMac`='$forma' AND  `tipoEstudio`='$tipoest') )  as DXI 
								 FROM `tbl_observacionesRotulo` as O WHERE O.`formatoPatoMac`='$forma' AND  O.`tipoEstudio`='$tipoest'";
								
								$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function consultaXidPacxReporteOperatorio($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT `idPro`,R.user as USX ,P.`idUser`,Q.Descripcion AS ESPEXC ,`especialidad`, `tipoDOc`, `nroDoc`, `paciente`, `edad`, `historia`, `celular`, `dx`, `tipoDx`, 
                                `dxPrepa`, `tipoDxPrepa`, `procedQx`,A.Descripcion AS ANEST, `tipoAnestesia`,T.Descripcion AS TipoServici, `tipoCirugia`,S.Descripcion AS SERDX ,`servicioDx`,X.Nombre AS SALACI ,`salaCirugia`, 
                                `fechaIntervencion`,C.Descripcion AS TURNO, `hora`, `cirugiaIndicadaPor`, `cirujanoPrincipal`, `anestesiologo`,O.descripcion AS SERVINT ,`servicioInterno`,
                                U.Descripcion AS URPA, `nroCama`,D.Descripcion AS ESTCI, `estadoCirugia`, P.`fechaRegistro`, P.`fechaActualizada`,RO.fechAhoraInicio,RO.fechaHoraFin,RO.cirujanoPreo,RO.anesteReporte,RO.descrReporOpe,
                                RO.instrumentRepo,RO.muestraPatologica,RO.compliQirurgica,RO.obserReporOpera
                                 FROM `tbl_programacionCirugias` AS P
                                 INNER JOIN TipoCx AS T  ON P.tipoCirugia=T.IdTipoCx
                                 INNER JOIN TurnoCx AS C ON P.hora=C.IdTurno
                                 INNER JOIN TipoAnestesia AS A ON P.tipoAnestesia=A.IdTipoAnestesia
                                 INNER JOIN ServQx AS  S ON P.servicioDx= S.IdServQx
                                 INNER JOIN SalaCx AS X ON P.salaCirugia= X.IdSala
                                 INNER JOIN ServURPA AS U ON P.nroCama=U.IdServURPA
                                 INNER JOIN pabellones AS O ON P.servicioInterno=O.idPa
                                 INNER JOIN EstadoCx AS D ON P.estadoCirugia= D.IdEstado
                                 INNER JOIN usuarios AS R ON P.idUser= R.id
                                 INNER JOIN EspecialidadesQX AS Q ON P.especialidad=Q.IdEspQx 
                                 INNER JOIN tbl_reporteOperatorio AS RO ON P.idPro=RO.idPac 
                                 WHERE P.`idPro` = '$id'";
								$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function mostrarPdfCervicoVaginal($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT `idPato`, `iduser`, `tipodoc`, `nrodoc`, `paciente`, `edad`, `sexo`, `finaciamiento`, `ipress`, `jurisdiccion`, `cuenta`, `historia`,
								`servicio`, `salacama`, `celular`, `nroOrden`, `anio`, `fechaReg`, `fechaModificacion`, `nroFactura`, `tipoEstudio`, `procedimiento`, `medicoSolicitante`,
								`especialidad`, `fechaRecepcion`, `corPat`, `anaMuestraCito`, `procedRealCito`, `medicoSolcit`, `dxClinicoHi`, `interpretacPato`, `comentarioPatol`,
								`notaPatol`, `idReportPdf`, `fechaHoraReport`,`fechaUltimaRegla`, `listEmbarazo`, `listMetodoAnti`, `listTipoMetodoAntic`, `TiempoUso`, `listExaGineco`,
								`obsExamenGinec`,(SELECT UPPER(`Descripcion`) FROM `TipoDxCU` WHERE IdTipoDxCU = T.`calidEspec`) AS CE,`calidEspec`, `especifiqueCalidadEspec`,
								(SELECT UPPER(`Descripcion`) FROM `TipoDxCU` WHERE IdTipoDxCU = T.`clasificacionGen`) AS CG,clasificacionGen, 
								`EspecclasificacionGen`,(SELECT UPPER(`Descripcion`) FROM `TipoDxCU` WHERE IdTipoDxCU = T.`celulasEscamosas`) AS CES, `celulasEscamosas`,
								`especelulasEscamosas`, `celGlandu`,(SELECT UPPER(`Descripcion`) FROM `TipoDxCU` WHERE IdTipoDxCU = T.`celGlandu`) AS AE,
								`espeCelGlandu`, `fechaConcySuger`, `dxRealizadoLab`, `fechalab`, `nomObtencionMuestras`, `profeCargo`, `fechaObtencMuestra`, `fechaColoscopia`,
								`especifColoscopia`, `dxAnterior`, `fechadxAnterior`, `otrNeoMalig`,(SELECT UPPER(`Descripcion`) FROM `TipoDxCU` WHERE IdTipoDxCU = T.`celulBenignos`) AS CBE,
								`celulBenignos`,idCvinforme,fechaidCvinforme,txtAreaConclusiones,
								`especifTipoOrg`, `cambioReactivos`, (SELECT UPPER(`Descripcion`) FROM `TipoDxCU` WHERE IdTipoDxCU = T.`cambioReactivos`) AS CRE,
								`espeCambioReac`, (SELECT UPPER(`Descripcion`) FROM `TipoDxCU` WHERE IdTipoDxCU = T.`patronHormonal`) AS PH,
								`patronHormonal`, `especifPatronHor`, `datosResposanble`, `colegioResp`, (SELECT upper(nom) FROM usuarios WHERE id=T.nomApeConfir ) AS MAPTO,`nomApeConfir`, `colegConfirma` 
								FROM `tbl_registroPacientesPatologia` as T
								WHERE `idPato` = $id";
								$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function sqlPdfHojaReferencia($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT `idRef`, `idUserSolRef`, `tipoDocRef`, `NroDocRef`, `paxRef`, `sexoRef`, `FechaNacRef`, `edadRef`, `iafasRef`,
								`tipoSegRef`, `afiliaRef`, `caduciRef`, `domiRef`, `depaRef`, `provRef`, `disRef`, `actrasRef`, `tipoAccRef`, `lisDocs`,
								`ingresoReferido`, `idEstabelRef`, `fechaIngresoRef`, `servicioOrigenRef`, `servDestRef`, `especialidadRef`, `motivoRef`,
								`condPcte`, `tipoTransRef`, `dispoTransRef`, `tipoDocRefRes`, `NroDocRefRes`, `personalResRef`, `profesionRefRes`, `colegiaturaRef`,
								`tipoDocRefResAcompa`, `NroDocRefResAcompa`, `personalResRefAcompa`, `profesionRefResAcompa`, `colegiaturaRefAcompa`, `fechaRegistro`,
								`fechaActualizacion`, `historia`, `estadoRegistro`, `anamnesis`, `presionArterial`, `temperatura`, `cardiaca`, `respiratoria`,
								`saturacion`, `oxinoterapia`, `litroMin`, `examenClinico`, `plan`, `notaObservaciones`, `codipres`, `anio`, `cor`, `especEval1`,
								`especEval2`, `especEvalDatoRef`, `estadoRefDatRef`, `derivarJefeServ`, `motivoRecEval1`, `especEval3`, `obsJefeServ`, `estadoRefJefeServ`, 
								`motivoRecEval2`, `obsJefeGuardia`, `estadoRefJefeGuardia`, `motivoRecEval3`, `atencionPacEval`, `estFinalRef`, `motivoRecEval4`,
								`obsEstFinalRef`, `paxllegoEstab`, `fechaLlegada`, `cuentaFeLlegada`, `anulado`, `respirador`, `personalMedico`, `iduserPerRef`,
								`idJefeServicio`, `iduserJefeGuardia`, `idMedicoAudi`, `idPerRef`, `idPerReFinal`, `accidente`, `chkDocCuenta1`, `chkDocCuenta2`,
								`chkDocCuenta3`, `chkDocCuenta4`, `chkDocCuenta5`, 
								(SELECT  `departamento` FROM `departamentos` WHERE `idDepartamento`= R.depaRef) AS DTO,
								(SELECT `provincia` FROM `provincia` WHERE `idProvincia`=R.provRef) AS PROV, 
								(SELECT `distrito` FROM `distrito` WHERE `idDistrito`=R.disRef) AS DIST,
								(SELECT nom FROM usuarios WHERE id=R.idUserSolRef) AS USEREG,
								(SELECT  `NombreUPS` FROM `UPS` WHERE IdUPS=R.servicioOrigenRef ) AS SERORI,
								(SELECT  `NombreUPS` FROM `UPS` WHERE IdUPS=R.servDestRef ) AS SERFIN,
								(SELECT `MotivoRef` FROM `MotivoRef` WHERE IdMotivo=R.motivoRef) AS MOTREF,
								(SELECT `descripcion` FROM `tbl_especialidades` WHERE id=R.especialidadRef) AS ESDES,
								(SELECT `CondPac` FROM `CondPac` WHERE IdCond=R.condPcte) AS CONPAX,
								(SELECT `TipoTransp` FROM `TipoTransp` WHERE IdTransp=R.tipoTransRef) AS TIPOTRX,
								(SELECT `codigo` FROM `tbl_ipress` WHERE `id`=R.idEstabelRef) AS IPRE,
								(SELECT `nombre` FROM `tbl_ipress` WHERE `id`=R.idEstabelRef) AS DESIPRE,
								(SELECT `descripcion` FROM `tbl_profesion` WHERE `idP`=R.profesionRefRes) AS PROF2,
								(SELECT `descripcion` FROM `tbl_profesion` WHERE `idP`=R.profesionRefResAcompa) AS PROF3
								FROM `tbl_registroReferencias` AS R 
								
								WHERE `idRef` = '$id'";
								$result = $conn->query($sql);				

						}

						return $result;

					}
					//
					
				  function consultaExamenesAux($id,$tipo){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT `idDxHis`, `des` FROM `tbl_examenesAuxiliares` WHERE `idRef`='$id' AND `tipo`='$tipo' AND des <>'undefined' AND des <> '' ORDER BY idDxHis ASC";
								$result = $conn->query($sql);				

						}

						return $result;

					}
					
					function consultaDiagnosticoPdf($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT `idDxHis`,`dx`,`tipoDx` FROM `tbl_dxHistoria` WHERE `idRef` = '$id'  AND dx <>'undefined' AND dx <> '' ORDER BY idDxHis ASC";
								$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function consultaTratamientoPdf($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT `idDxHis`,`descripcion`,`cant` FROM `tbl_tratHistoria` WHERE `idRef` = '$id'  AND descripcion <>'undefined' AND descripcion <> '' ORDER BY idDxHis ASC";
								$result = $conn->query($sql);				

						}

						return $result;

					}
					
					function consultaXidRegistroReferencias($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT `idRef`, `idUserSolRef`, `tipoDocRef`, `NroDocRef`, `paxRef`, `sexoRef`, `FechaNacRef`, `edadRef`, `iafasRef`,
								`tipoSegRef`, `afiliaRef`, `caduciRef`, `domiRef`, `depaRef`, `provRef`, `disRef`, `actrasRef`, `tipoAccRef`, `lisDocs`,
								`ingresoReferido`, `idEstabelRef`, `fechaIngresoRef`, `servicioOrigenRef`, `servDestRef`, `especialidadRef`, `motivoRef`,
								`condPcte`, `tipoTransRef`, `dispoTransRef`, `tipoDocRefRes`, `NroDocRefRes`, `personalResRef`, `profesionRefRes`, `colegiaturaRef`,
								`tipoDocRefResAcompa`, `NroDocRefResAcompa`, `personalResRefAcompa`, `profesionRefResAcompa`, `colegiaturaRefAcompa`, `fechaRegistro`,
								`fechaActualizacion`, `historia`, `estadoRegistro`, `anamnesis`, `presionArterial`, `temperatura`, `cardiaca`, `respiratoria`,
								`saturacion`, `oxinoterapia`, `litroMin`, `examenClinico`, `plan`, `notaObservaciones`, `codipres`, `anio`, `cor`, `especEval1`,
								`especEval2`, `especEvalDatoRef`, `estadoRefDatRef`, `derivarJefeServ`, `motivoRecEval1`, `especEval3`, `obsJefeServ`, `estadoRefJefeServ`, 
								`motivoRecEval2`, `obsJefeGuardia`, `estadoRefJefeGuardia`, `motivoRecEval3`, `atencionPacEval`, `estFinalRef`, `motivoRecEval4`,
								`obsEstFinalRef`, `paxllegoEstab`, `fechaLlegada`, `cuentaFeLlegada`, `anulado`, `respirador`, `personalMedico`, `iduserPerRef`,
								`idJefeServicio`, `iduserJefeGuardia`, `idMedicoAudi`, `idPerRef`, `idPerReFinal`, `accidente`, `chkDocCuenta1`, `chkDocCuenta2`,
								`chkDocCuenta3`, `chkDocCuenta4`, `chkDocCuenta5`, 
								(SELECT  `departamento` FROM `departamentos` WHERE `idDepartamento`= R.depaRef) AS DTO,
								(SELECT `provincia` FROM `provincia` WHERE `idProvincia`=R.provRef) AS PROV, 
								(SELECT `distrito` FROM `distrito` WHERE `idDistrito`=R.disRef) AS DIST,
								(SELECT nom FROM usuarios WHERE id=R.idUserSolRef) AS USEREG
								FROM `tbl_registroReferencias` AS R 
								
								WHERE `idRef` = '$id'";
								$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function consultaXidPacxMasivo($user,$desde,$hasta,$id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						    $sqlVal="";
						    $desde= $desde." 00:00:00";
						    $hasta= $hasta." 23:59:59";
						    
						    if($user!=""){
						        $sqlVal="P.iduser=(SELECT id FROM `usuarios` WHERE `user` ='$user')  AND P.`fechaEnvioAuditoria` >= '$desde' AND P.`fechaEnvioAuditoria` <= '$hasta' AND tipoEval='$id' ORDER BY P.fe_reg ASC ";
						    }else{
						        $sqlVal="P.`fechaEnvioAuditoria` >= '$desde' AND P.`fechaEnvioAuditoria` <= '$hasta' AND tipoEval='$id' ORDER BY P.fe_reg ASC ";
						    }
						
								$sql = "SELECT P.`idPac`, P.`nroFua`, P.`nroCuenta`, P.`paciente`, P.`servicio`, P.`F_Ingreso`, P.`F_Alta_Medica`, 
								P.`Historia`, P.`DNI`,P.observacion, P.`fe_reg`,(SELECT `descripcion` FROM `codPrestHospi` WHERE `idCod`=P.`denominacion`) as den,
								P.`codPre`,P.montogal,P.montosisfar,(SELECT UPPER(nom) FROM usuarios WHERE id=P.iduser ) AS AUDITOR ,
								P.cie10_1,P.dx2,P.dx3,P.dx4,P.dx5,P.dx6,P.dx7,P.dx8,P.dx9,P.dx10,(SELECT cmp FROM usuarios WHERE id=P.iduser ) AS cmp ,(SELECT rna FROM usuarios WHERE id=P.iduser ) AS rna ,
								P.tipoEval  FROM `paciente` P WHERE $sqlVal ";
								$result = $conn->query($sql);				

						}

						return $result;

					}

					
					function consultaXnROSis($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
								$sql = "SELECT E.`cuenta`,E.`historiaClinica`,E.`ApePaterno`,E.`ApeMaterno`,E.`nombres`,E.`tipoDoc`,E.`nroDoc`,
								(SELECT UPPER(`nombre`) FROM `tipoServicioIngreso` WHERE `idTsi`=E.`tipoSeiN`) AS SERV,E.`fechaIngreso` 
								FROM `tbl_Emergencias` AS E WHERE E.`nroDoc` ='$id' ORDER BY E.`nroDoc` DESC LIMIT 1";
								$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function consultaVerificarEstadoMasivo($ser,$tipo,$user){

						$db = new Conectar();
						$conn = $db->conexion();
						
						
						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						    
						    	if($tipo=="1"){
                            	   $sql ="SELECT E.idEm,E.`tipoDoc`,TRIM(E.`nroDoc`) as DOCE,E.cuenta,E.ApePaterno,E.ApeMaterno,E.nombres,(SELECT `nombre` FROM `tbl_regimen` WHERE `idRe`=V.`regimen`) AS REGI,
                            	   (SELECT user FROM usuarios WHERE id=V.`iduser`) as URF, V.`regimen`, V.`plan`, V.`nroAfiliacion`, V.`fechaAfiliacion`, V.`fechaCaducidad`, V.`estado`, V.`fechaRegistro`,E.camHos1 FROM `tbl_Emergencias` AS E 
                            	   INNER JOIN validacionSis AS V ON E.`idEm`=V.idEm
                            	   WHERE E.tipoSeiN='$ser' AND  E.tipoRegistro ='$tipo' AND E.`destino`='' AND V.iduser='$user'  AND V.`fechaRegistro` >= DATE_SUB(NOW(),INTERVAL 1 HOUR) ORDER BY V.id DESC ";
                            	   
                            	}else if($tipo=="2"){
                                   $sql ="SELECT E.idEm,E.`tipoDoc`,TRIM(E.`nroDoc`) as DOCE,E.cuenta,E.ApePaterno,E.ApeMaterno,E.nombres,(SELECT `nombre` FROM `tbl_regimen` WHERE `idRe`=V.`regimen`) AS REGI,
                            	   (SELECT user FROM usuarios WHERE id=V.`iduser`) as URF, V.`regimen`, V.`plan`, V.`nroAfiliacion`, V.`fechaAfiliacion`, V.`fechaCaducidad`, V.`estado`, V.`fechaRegistro`,E.camHos1 FROM `tbl_Emergencias` AS E 
                            	   INNER JOIN validacionSis AS V ON E.`idEm`=V.idEm
                            	   WHERE E.pab1Hos='$ser' AND  E.tipoRegistro ='$tipo' AND E.`destino`='' AND V.iduser='$user'  AND V.`fechaRegistro` >= DATE_SUB(NOW(),INTERVAL 1 HOUR)  ORDER BY V.id DESC";
                                }
						
								$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function consultaXidProcedimientos($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT P.IdProcedimiento,P.IdUsuario, P.id_prestacion, P.codigo_cpt, P.cantidad, P.valorizacion, P.descripcion,P.fechaIngreso,P.total,U.user,P.dx
						FROM `a_procedimientos` AS P 
						LEFT JOIN usuarios AS U ON P.IdUsuario= U.id
						WHERE P.id_prestacion='$id' ORDER BY  P.descripcion ASC";
						$result = $conn->query($sql);				

						}

						return $result;

					}
					
					function pdfReportePreoperatorio($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT  `dx`, `tipoDx` FROM `tbl_dxPreOperatorio` WHERE `idRef` ='$id' ORDER BY dx ASC";
						$result = $conn->query($sql);				

						}

						return $result;

					}
					
					function pdfsignosXsintomasRef($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `dx` FROM `tbl_signosSintomas` WHERE `idRef`='$id' ORDER BY dx ASC";
						$result = $conn->query($sql);				

						}

						return $result;

					}
					
					function pdfDiagnosticoRef($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `dx`,`tipoDx` FROM `tbl_dxHistoria` WHERE `idRef` ='$id' ORDER BY dx ASC";
						$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function pdfTratamientoRef($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `descripcion`,`cant` FROM `tbl_tratHistoria` WHERE `idRef`='$id' ORDER BY descripcion ASC";
						$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function pdfExamenesAuxiliares($id,$tipo){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `des` FROM `tbl_examenesAuxiliares` WHERE `idRef`='$id' AND `tipo`='$tipo'  ORDER BY des ASC";
						$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					
				
					function pdfReportePostoperatorio($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT  `dx`, `tipoDx` FROM `tbl_DxPostOperatorio` WHERE `idRef` ='$id' ORDER BY dx ASC";
						$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function pdfReporteeIntervencionQx($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT  `des` FROM `tbl_intervencionRealizada` WHERE `idRef` ='$id' ORDER BY des ASC";
						$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function pdfReporteCirujanosAsistentes($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `des` FROM `tbl_cirujanosAsistentes` WHERE `idRef` = '$id' ORDER BY des ASC";
						$result = $conn->query($sql);				

						}

						return $result;

					}
					
					
					function sqlDxHistoria($id){

    						$db = new Conectar();
    						$conn = $db->conexion();		

    						if ($conn->connect_errno) {
    							printf("Conexión fallida: %s\n", $conn->connect_error);
    							exit();
    
    						}else{
    						
        						$sql = "SELECT `idDxHis`,`dx`,`tipoDx` FROM `tbl_dxHistoria` WHERE `idRef` = '$id'  AND dx <>'undefined' AND dx <> '' ORDER BY idDxHis ASC";
        						$result = $conn->query($sql);				
    
    						}
    
    						return $result;

					}


                  function sqlDxTratamiento($id){

    						$db = new Conectar();
    						$conn = $db->conexion();		

    						if ($conn->connect_errno) {
    							printf("Conexión fallida: %s\n", $conn->connect_error);
    							exit();
    
    						}else{
    						
        						$sql = "SELECT `idDxHis`,`descripcion`,`cant` FROM `tbl_tratHistoria` WHERE `idRef` = '$id'  AND descripcion <>'undefined' AND descripcion <> '' ORDER BY idDxHis ASC";
        						$result = $conn->query($sql);				
    
    						}
    
    						return $result;

					}
					
					function sqlExamenesAuxiliares($id,$tipo){

    						$db = new Conectar();
    						$conn = $db->conexion();		

    						if ($conn->connect_errno) {
    							printf("Conexión fallida: %s\n", $conn->connect_error);
    							exit();
    
    						}else{
    						
        						$sql = "SELECT `idDxHis`, `des` FROM `tbl_examenesAuxiliares` WHERE `idRef`='$id' AND `tipo`='$tipo' AND des <>'undefined' AND des <> '' ORDER BY idDxHis ASC";
        						$result = $conn->query($sql);				
    
    						}
    
    						return $result;

					}
					

                	function consultaWebSis($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT P.`id`,(SELECT user FROM usuarios WHERE id=P.`iduser`) AS USEAS ,P.nroDoc,(SELECT `nombre` FROM `tbl_regimen` WHERE `idRe`=P.`regimen`) AS REGI,
						P.plan , P.`nroAfiliacion`, P.`fechaAfiliacion`, P.`fechaCaducidad`, P.`estado`, P.`fechaRegistro` FROM `validacionSis` AS P WHERE P.nroDoc='$id' ORDER BY  P.id DESC";
						$result = $conn->query($sql);				

						}

						return $result;

					}

					function consultaXidProcedimientosAuto($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT P.IdProcedimiento,P.IdUsuario, P.id_prestacion, P.codigo_cpt, P.cantidad, P.valorizacion, P.descripcion,P.fechaIngreso,P.total,U.user,P.dx
						FROM `ac_procedimientos` AS P 
						INNER JOIN usuarios AS U ON P.IdUsuario= U.id
						WHERE P.id_prestacion='$id' ORDER BY  P.descripcion ASC";
						$result = $conn->query($sql);				

						}

						return $result;

					}



					function sumXidProcedure($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT SUM(P.total) AS totalproc FROM `a_procedimientos` AS P WHERE P.id_prestacion='$id' ";
						$result = $conn->query($sql);				

						}

						return $result;

					}
					
					//UPDATE `paciente` SET `totalCpms`=[value-34] WHERE `idPac`=
					
						function updateMontoCpms($id,$monto){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
    						$sql = "UPDATE `paciente` SET `totalCpms`='$monto' WHERE `idPac`='$id' ";
    						$result = $conn->query($sql);				

						}

						return $result;

					}

					function sumXidinsumos($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT SUM(`total`) AS totalproc FROM `a_insumos` WHERE `id_prestacion`='$id'";
						$result = $conn->query($sql);				

						}

						return $result;

					}


					function consulNotarifados($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `Idprod`, `IdUsuario`, `id_prestacion`, `codigo_cpt`, `cantidad`, `valorizacion`,
						 `descripcion`, `fechaIngreso`, `total` FROM `a_notarifados` WHERE `id_prestacion`='$id'";
						$result = $conn->query($sql);				

						}

						return $result;

					}

					function sumXNotari($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT SUM(`total`) AS totalproc FROM `a_notarifados` WHERE `id_prestacion`='$id'";
						$result = $conn->query($sql);				

						}

						return $result;

					}

					function sumXidMed($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT SUM(`total`) AS totalproc FROM `a_medicamentos` WHERE `id_prestacion`='$id'";
						$result = $conn->query($sql);				

						}

						return $result;

					}

				/*	function consultaXinsumos($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT `idInsumos`, `IdUsuario`, `id_prestacion`, `codigo_sismed`, `cantidad`, `diagnostico`, `valorizacion`, `descripcion`, `fechaIngreso` , `total`
						FROM `a_insumos` WHERE id_prestacion='$id' ORDER BY  idInsumos DESC";
						$result = $conn->query($sql);				

						}

						return $result;

					}*/


					function consultaXinsumos($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT I.`idInsumos`, I.`IdUsuario`, I.`id_prestacion`,I. `codigo_sismed`, I.`cantidad`, I.`diagnostico`, I.`valorizacion`, I.`descripcion`, I.`fechaIngreso` , I.`total`,U.user
						FROM `a_insumos` AS I
						INNER JOIN usuarios AS U ON I.IdUsuario= U.id
						WHERE I.id_prestacion='$id' ORDER BY  I.`descripcion` aSC";
						$result = $conn->query($sql);				

						}

						return $result;

					}


					function consultaXinsumosAuto($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT I.`idInsumos`, I.`IdUsuario`, I.`id_prestacion`,I. `codigo_sismed`, I.`cantidad`, I.`diagnostico`, I.`valorizacion`, I.`descripcion`, I.`fechaIngreso` , I.`total`,U.user
						FROM `ac_insumos` AS I
						INNER JOIN usuarios AS U ON I.IdUsuario= U.id
						WHERE I.id_prestacion='$id' ORDER BY  I.`descripcion` aSC";
						$result = $conn->query($sql);				

						}

						return $result;

					}

					function consultaXmedicamentos($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT I.`idMed`, I.`IdUsuario`, I.`id_prestacion`, I.`codigo_sismed`, I.`cantidad`, I.`diagnostico`, I.`valorizacion`, I.`descripcion`, I.`fechaIngreso` , I.`total`,U.user
						FROM `a_medicamentos` AS I
						INNER JOIN usuarios AS U ON I.IdUsuario= U.id
						WHERE I.id_prestacion='$id' ORDER BY  I.`descripcion` ASC";
						$result = $conn->query($sql);				

						}

						return $result;

					}

					function consultaXmedicamentosAuto($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
						$sql = "SELECT I.`idMed`, I.`IdUsuario`, I.`id_prestacion`, I.`codigo_sismed`, I.`cantidad`, I.`diagnostico`, I.`valorizacion`, I.`descripcion`, I.`fechaIngreso` , I.`total`,U.user
						FROM `ac_medicamentos` AS I
						INNER JOIN usuarios AS U ON I.IdUsuario= U.id
						WHERE I.id_prestacion='$id' ORDER BY  I.`descripcion` ASC";
						$result = $conn->query($sql);				

						}

						return $result;

					}

			
					function InsertPaciente($pacienteX){

						$db = new Conectar();
						$conn = $db->conexion();

						$ide= $pacienteX['ide'];
						$iduser = $pacienteX['iduser'];					
						$Nxuenta = $pacienteX['Nxuenta'];
						$hclinica = $pacienteX['hclinica'];
						
						$extraerFua = explode("-",$pacienteX['fua']);
                                      
                        $fua ='';
                        if($extraerFua[2]!=''){
                            $disa= str_pad($extraerFua[0],8, "0", STR_PAD_LEFT);
                            $lote= $extraerFua[1];
                            $numo= str_pad($extraerFua[2],8, "0", STR_PAD_LEFT);
                            $fua = $disa.'-'.$lote.'-'.$numo;
                        }else{
                            $fua = "6207-24-";
                        }
						
						
						
						//$fua = $pacienteX['fua'];
						
						
						$dni = $pacienteX['dni'];
						$paciente = $pacienteX['paciente'];
						$servicio = $pacienteX['servicio'] ;
						$feingreso = $pacienteX['feingreso'];
						$fecorte = $pacienteX['fecorte'];
					    $asiAudi = $pacienteX['asiAudi'];
					    $montgal = $pacienteX['montgal'];
                        $montsifar = $pacienteX['montsifar']; 
					    $obsCpms = $pacienteX['obsCpms'];
	                    $valAteAudi= $pacienteX['valAteAudi'];
	                    $tiDocA= $pacienteX['tiDocA'];
	                    $ubiSerHosp= $pacienteX['ubiSerHosp'];
	                    $codPreHos= $pacienteX['codPreHos'];
	                    $fileCpms= $pacienteX['fileCpms'];
	                    $prioAudit= $pacienteX['prioAudit'];
	                    
	                    
	                    $tipoEval= "";
	                    
	                    if($pacienteX['tipoEval']=="0"){
	                        $tipoEval= "1";
	                    }else{
	                        $tipoEval= $pacienteX['tipoEval'];
	                    }
	
						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();
	
						}else{
						    
						
							if($ide==""){
	

										$consulta = "SELECT * FROM `paciente` WHERE `nroCuenta`='$Nxuenta' OR nroFua='$fua'";
									    //$consulta = "SELECT * FROM `paciente` WHERE nroFua LIKE '%$fua%' AND tipoEval=1";
										$verIf = mysqli_query($conn,$consulta);
										$cnt = mysqli_num_rows($verIf);

										if($cnt > 0 ){
												echo "1";
										}else{

											$sql = "INSERT INTO `paciente`(iduser,`nroFua`, `nroCuenta`, `paciente`, `servicio`,
											`F_Ingreso`, `F_Alta_Medica`, `Historia`, `DNI`,estado,montogal,montosisfar,obsCpms,valorFinal,tipoDoc,denominacion,codPre,fileCpms,tipoEval,prioridad) 
											VALUES($iduser,'$fua','$Nxuenta','$paciente','$servicio','$feingreso','$fecorte','$hclinica','$dni','GENERADO','$montgal','$montsifar','$obsCpms',
											'$valAteAudi','$tiDocA','$ubiSerHosp','$codPreHos','$fileCpms','$tipoEval','$prioAudit')";
											 $result = $conn->query($sql);
											 echo "2";
											
										}

							}else{
	
	
	                                        if($fileCpms!=''){
	                                            
	                                            $sql = "UPDATE `paciente` SET `iduser`='$iduser',`NroCuenta`='$Nxuenta',`Historia`='$hclinica',nroFua='$fua',DNI='$dni',
                								paciente='$paciente',`servicio`='$servicio',`F_Ingreso`='$feingreso',`F_Alta_Medica`='$fecorte',`montogal`='$montgal',`montosisfar`='$montsifar'
                								,`obsCpms`='$obsCpms',`valorFinal`='$valAteAudi',`tipoDoc`='$tiDocA',`denominacion`='$ubiSerHosp',`codPre`='$codPreHos',`fileCpms`='$fileCpms'
                								,`tipoEval`='$tipoEval',`prioridad`='$prioAudit' WHERE `idPac`='$ide' ";
                								
	                                        }else{
	                                            
	                                            $sql = "UPDATE `paciente` SET `iduser`='$iduser',`NroCuenta`='$Nxuenta',`Historia`='$hclinica',nroFua='$fua',DNI='$dni',
                								paciente='$paciente',`servicio`='$servicio',`F_Ingreso`='$feingreso',`F_Alta_Medica`='$fecorte',`montogal`='$montgal',`montosisfar`='$montsifar'
                								,`obsCpms`='$obsCpms',`valorFinal`='$valAteAudi',`tipoDoc`='$tiDocA',`denominacion`='$ubiSerHosp',`codPre`='$codPreHos',`tipoEval`='$tipoEval'
                								,`prioridad`='$prioAudit'  WHERE `idPac`='$ide' ";
	                                            
	                                        }
	
								
								//echo $sql;
								
								
								$result = $conn->query($sql);
	
							}
											
						}
	
								return $result;
	
					}
					
					
					
					function insertPaxQuimio($pacienteX){

						$db = new Conectar();
						$conn = $db->conexion();

						
						$iduser = $pacienteX['iduser'];
						$ideQa= $pacienteX['ideQa'];
						$NxuentaQ = $pacienteX['NxuentaQ'];
						$hclinicaQ = $pacienteX['hclinicaQ'];
						$fuaQ = $pacienteX['fuaQ'];
						$nspQ = $pacienteX['nspQ'];
						$pacienteQ = $pacienteX['pacienteQ'];
						$feAtenQ = $pacienteX['feAtenQ'] ;
						$feProcQ = $pacienteX['feProcQ'];
						$asiAudiQa = $pacienteX['asiAudiQa'];
					    $devoQ = $pacienteX['devoQ'];
					    
					    
					    
					    
					      $tipoDocQui = $pacienteX['tipoDocQui'];
                          $tefQuimi = $pacienteX['tefQuimi'];
                          $segurosQuimi = $pacienteX['segurosQuimi'];
                          $refQuimi = $pacienteX['refQuimi'];
                          $fechaNacQuimi = $pacienteX['fechaNacQuimi'];
                          $edadQuimi= $pacienteX['edadQuimi'];
                          $tip1Qui = $pacienteX['tip1Qui'];
                          $cie102Qui = $pacienteX['cie102Qui'];
                          $tip2Qui = $pacienteX['tip2Qui'];
                          $cie103Qui = $pacienteX['cie103Qui'];
                          $tip3Qui = $pacienteX['tip3Qui'];
                          $cie104Qui = $pacienteX['cie104Qui'];
                          $tip4Qui = $pacienteX['tip4Qui'];
                          $cie105Qui = $pacienteX['cie105Qui'];
                          $tip5Qui = $pacienteX['tip5Qui'];
                          $dniQuimi = $pacienteX['dniQuimi'];
					      $ocupQui = $pacienteX['ocupQui'];
					  
	
						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();
	
						}else{
						
							if($ideQa==""){
	

										$consulta = "SELECT * FROM `tbl_quimioterapia` WHERE `cuenta`=$NxuentaQ ";
										$verIf = mysqli_query($conn,$consulta);
										$cnt = mysqli_num_rows($verIf);

										if($cnt >= 1){
												echo "1";
										}else{

											$sql = "INSERT INTO `tbl_quimioterapia`(`paciente`, `historia`, `fua`, `cuenta`, `feAtencion`, `medico`, `feProc`, `nsp`, `devolucion`,`userRegistro`, 
											`tp1`, `cie10_2`, `tp2`, `cie10_3`, `tp3`, `cie10_4`, `tp4`, `cie10_5`, `tp5`, `tipoDocQui`, `tefQuimi`, `segurosQuimi`, `refQuimi`, `fechaNacQuimi`, `edadQuimi`, `dniQui`, `ocupacion`) 
											VALUES('$pacienteQ','$hclinicaQ','$fuaQ','$NxuentaQ','$feAtenQ','$asiAudiQa','$feProcQ','$nspQ','$devoQ','$iduser','$tip1Qui','$cie102Qui','$tip2Qui','$cie103Qui','$tip3Qui',
											'$cie104Qui','$tip4Qui','$cie105Qui','$tip5Qui','$tipoDocQui','$tefQuimi','$segurosQuimi','$refQuimi','$fechaNacQuimi','$edadQuimi','$dniQuimi','$ocupQui')";
																								
											    $result = $conn->query($sql);
											    echo $sql;
											
										}

							}else{
	
								$sql = "UPDATE `tbl_quimioterapia` SET `paciente`='$pacienteQ',`historia`='$hclinicaQ',`fua`='$fuaQ',`cuenta`='$NxuentaQ',`feAtencion`='$feAtenQ',`medico`='$asiAudiQa',`feProc`='$feProcQ',
								`nsp`='$nspQ',`devolucion`='$devoQ',`tp1`='$tip1Qui',`cie10_2`='$cie102Qui',`tp2`='$tip2Qui',`cie10_3`='$cie103Qui',`tp3`='$tip3Qui',`cie10_4`='$cie104Qui',`tp4`='$tip4Qui',
								`cie10_5`='$cie105Qui',`tp5`='$tip5Qui',`tipoDocQui`='$tipoDocQui',`tefQuimi`='$tefQuimi',`segurosQuimi`='$segurosQuimi',`refQuimi`='$refQuimi',`fechaNacQuimi`='$fechaNacQuimi',
								`edadQuimi`='$edadQuimi',`dniQui`='$dniQuimi',`ocupacion`='$ocupQui' WHERE `idQ`='$ideQa' ";
								//echo $sql;
								$result = $conn->query($sql);
	
							}
											
						}
	
								return $result;
	
					}
					
					
					
					
						function insertPaxCajas($pacienteX){

						$db = new Conectar();
						$conn = $db->conexion();

						$iduserEx= $pacienteX['iduserEx'];
						$refeCaja = $pacienteX['refeCaja'];					
                        $estado ='1';
						
	
						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();
	
						}else{
							
							$sql = "INSERT INTO `tbl_Cajas`(`idUsuario`, `observacion`,`estado`) VALUES($iduserEx,'$refeCaja','$estado')";										
							$result = $conn->query($sql);
					
											
						}
	
								return $result;
	
					}

					function InsertPacienteAltas($pacienteX){

						$db = new Conectar();
						$conn = $db->conexion();

						$ide= $pacienteX['ide'];
						$iduser = $pacienteX['iduser'];					
						$Nxuenta = $pacienteX['Nxuenta'];
						$hclinica = $pacienteX['hclinica'];
						$fua = $pacienteX['fua'];
						$iafa = $pacienteX['iafa'];
						$paciente = $pacienteX['paciente'];
						$servicio = $pacienteX['servicio'] ;
						$feingreso = $pacienteX['feingreso'];
						$fecorte = $pacienteX['fecorte'];
					    $montgal= $pacienteX['montgal'];
                        $montsifar = $pacienteX['montsifar'];
	
						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();
	
						}else{
							
							$consulta = "SELECT `idPac`, `iduser`, `nroCuenta`, `Historia`, `nroFua` FROM `repositorio` WHERE `nroCuenta`='$Nxuenta'";
							$verIf = mysqli_query($conn,$consulta);
							$cnt = mysqli_num_rows($verIf);
							//echo $cnt;

							if($cnt == 0){

									$sql = "INSERT INTO `repositorio`(`iduser`, `nroCuenta`,
									`Historia`, `nroFua`, `paciente`, `iafa`, `F_Ingreso`, `F_Alta_Medica`, 
									`servicio`) VALUES($iduser,'$Nxuenta','$hclinica','$fua',
									'$paciente','$iafa','$feingreso','$fecorte','$servicio')";										
									$result = $conn->query($sql);
							}else{
								echo "1";
							}
								
											
						}
	
								return $result;
	
					}



					
					function InsertCartas($pacienteX){

						$db = new Conectar();
						$conn = $db->conexion();

						$ide= $pacienteX['ide'];
						$iduser = $pacienteX['iduser'];					
						$NroCarta = $pacienteX['NroCarta'];
						$NroCarta2 = $pacienteX['NroCarta2'];
						$NroCarta3= str_pad($pacienteX['NroCarta3'],8, "0", STR_PAD_LEFT); 
						$NroDoc = $pacienteX['NroDoc'];
						$paciente = $pacienteX['paciente'];
						$fecarta = $pacienteX['fecarta'];
						$iafa = $pacienteX['iafa'];
						$producto = $pacienteX['producto'];
						$tarifa = $pacienteX['tarifa'];
						$aseguradora = $pacienteX['aseguradora'] ;
						$poliza = $pacienteX['poliza'];
						$cie10 = $pacienteX['cie10'];
						$diagnostico = $pacienteX['diagnostico'];
						$feinicio = $pacienteX['feinicio'];
						$fevigencia = $pacienteX['fevigencia'];
						$monto = $pacienteX['monto'];
						$refe = $pacienteX['refe'];
						$nac = $pacienteX['nac'];
						$edad = $pacienteX['edad'];
						$motivo = $pacienteX['motivo'];
						$anio = date("Y");
									
	
						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();
	
						}else{
						
							if($ide==""){
	

								$consulta3 = "SELECT idCar FROM `cartagarantia` WHERE `NroCarta2`='$NroCarta2' AND  NroCarta3='$NroCarta3'";
								$verIf3 = mysqli_query($conn,$consulta3);
								$cnt3 = mysqli_num_rows($verIf3);

								   if($cnt3 > 0){
											echo "1";
									}else{
										$sql = "INSERT INTO `cartagarantia`(`nrodoc`,NroCarta,NroCarta2,NroCarta3,`Paciente`,`Fecha_Carta`, `IAFA`, `Producto`, `Tarifa`, `Aseguradora`, 
										`Poliza`, `CIE10`, `Diagnostico`, `Fecha_Inicio_Vigencia`, `Fecha_Fin_Vigencia`, `Monto_Ampliacion`, `anio`, `usuario`, `referencia`, `fenac`, `edad`, `motivo`) 
										VALUES('$NroDoc','$NroCarta','$NroCarta2','$NroCarta3','$paciente','$fecarta','$iafa','$producto','$tarifa','$aseguradora','$poliza','$cie10','$diagnostico'
										,'$feinicio','$fevigencia','$monto','$anio','$iduser','$refe','$nac','$edad','$motivo')";													
										$result = $conn->query($sql);
										echo "SI";
									}
								
								
								
	
							}else{
	
								$sql = "UPDATE `cartagarantia` SET `nrodoc`='$NroDoc',`NroCarta`='$NroCarta',`NroCarta2`='$NroCarta2',`NroCarta3`='$NroCarta3',`Paciente`='$paciente',`Fecha_Carta`='$fecarta',`IAFA`='$iafa',
								`Producto`='$producto',`Tarifa`='$tarifa',`Aseguradora`='$aseguradora',`Poliza`='$poliza',`CIE10`='$cie10',`diagnostico`='$diagnostico',
								`Fecha_Inicio_Vigencia`='$feinicio',`Fecha_Fin_Vigencia`='$fevigencia',`Monto_Ampliacion`='$monto',`usuario`='$iduser',`referencia`='$refe',`fenac`='$nac',`edad`='$edad',`motivo`='$motivo'
								WHERE `idCar`='$ide' ";
								$result = $conn->query($sql);
								echo "ACTUAL";
	
							}
											
						}
	
								return $result;
	
					}



					function InsertCuentas($pacienteX){

						$db = new Conectar();
						$conn = $db->conexion();

						$iduser = $pacienteX['iduser'];					
						$ideC = $pacienteX['ideC'];
						$idCuenta = $pacienteX['idCuenta'];
						$nrocuenta = $pacienteX['nrocuenta'];
						$hclinica = $pacienteX['hclinica'];
						$feat = $pacienteX['feat'];
						$productoX = $pacienteX['productoX'];
						$at = $pacienteX['at'];
						$inter = $pacienteX['inter'];	
	
						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();
	
						}else{
						
							if($idCuenta==""){
	

								$consulta3 = "SELECT `idCuenta` FROM `cuentas` WHERE `nrocuenta`='$nrocuenta' ";
								$verIf3 = mysqli_query($conn,$consulta3);
								$cnt3 = mysqli_num_rows($verIf3);

								   if($cnt3 > 0){
											echo "1";
									}else{
										$sql = "INSERT INTO `cuentas`(`idprestacion`, `nrocuenta`, `historia`, `fatencion`, `consultorio`, `estado`,interconsulta) 
										VALUES('$ideC','$nrocuenta','$hclinica','$feat','$productoX','$at','$inter')";													
										$result = $conn->query($sql);
										
									}
							
	
							}else{
	
								$sql = "UPDATE `cuentas` SET `nrocuenta`='$nrocuenta',`historia`='$hclinica',`fatencion`='$feat',`consultorio`='$productoX',
								`estado`='$at',`interconsulta`='$inter' WHERE `idCuenta`='$idCuenta' ";
								$result = $conn->query($sql);
							
	
							}
											
						}
	
								return $result;
	
					}


					function UpdatePaXTotales($totales){

						$db = new Conectar();
						$conn = $db->conexion();

						$ide= $totales['ide'];				
						$totHospi = $totales['totHospi'];
						$totMed = $totales['totMed'];
						$totPat = $totales['totPat'];
						$totRadio = $totales['totRadio'];
						$totBank = $totales['totBank'];
						$totInsumos = $totales['totInsumos'];
						$totMedx = $totales['totMedx'];
						$totGeneral = $totales['totGeneral'];
		
	
						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();
	
						}else{
							


							$consulta3 = "SELECT `idTo`, `idPac` FROM `totalespac` WHERE `idPac`='$ide' ";
							$verIf3 = mysqli_query($conn,$consulta3);
							$cnt3 = mysqli_num_rows($verIf3);

							if($cnt3>0){
								
								$sql = "UPDATE `totalespac` SET `totHospi`='$totHospi',`totMed`='$totMed',`totPat`='$totPat',
								`totRadio`='$totRadio',`totBank`='$totBank',`totInsumos`='$totInsumos',`totMedx`='$totMedx',
								`totGeneral`='$totGeneral' WHERE `idPac`='$ide' ";
								$result = $conn->query($sql);

							}else{

								  $sql = "INSERT INTO `totalespac`(`idPac`, `totHospi`, `totMed`, `totPat`, `totRadio`, `totBank`,
								 `totInsumos`, `totMedx`, `totGeneral`) VALUES ('$ide','$totHospi','$totMed','$totPat','$totRadio',
								 '$totBank','$totInsumos','$totMedx','$totGeneral')";													
							  	 $result = $conn->query($sql);

							}
	
								return $result;
	
					}


				}

				function eliminarRegsit($eliminarReg){

					$db = new Conectar();
					$conn = $db->conexion();

				if ($conn->connect_errno) {

						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

				} else{

						$idRt  = $eliminarReg['id'];
						$idEl  = 0 ;
						$stmt = $conn->prepare( "UPDATE `regpaciente` SET `cuenta`= ? WHERE `idRegistro`= $idRt");
						$stmt->bind_param('i', $idEl);
						$stmt->execute();	
								
					}

					return $result;

				}

				function updateEstatus($pacienteX){

					$db = new Conectar();
					$conn = $db->conexion();

				if ($conn->connect_errno) {

						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

				} else{

						$ide  = $pacienteX['ide'];
						$estado  = $pacienteX['estado'];

						$stmt = $conn->prepare( "UPDATE `cuentas` SET `estado`= ? WHERE `idCuenta`= $ide");
						$stmt->bind_param('s', $estado);
						$stmt->execute();	
								
					}

					return $result;

				}


				function eliminarRegsitCarta($eliminarReg){

					$db = new Conectar();
					$conn = $db->conexion();

				if ($conn->connect_errno) {

						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

				} else{

						$idRt  = $eliminarReg['id'];
						$stmt = $conn->prepare( "DELETE FROM `cartagarantia` WHERE `idCar`= ?");
						$stmt->bind_param('i', $idRt);
						$stmt->execute();	
								
					}

				 

					return $result;

				}
				
				
				function eliminXy($eliminarReg){

					$db = new Conectar();
					$conn = $db->conexion();

				if ($conn->connect_errno) {

						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

				} else{

						$idRt  = $eliminarReg['id'];
						$stmt = $conn->prepare( "DELETE FROM `cuentas` WHERE `idCuenta`= ?");
						$stmt->bind_param('i', $idRt);
						$stmt->execute();	
								
					}

				 

					return $result;

				}



}


?>