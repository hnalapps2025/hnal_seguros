<?php 

require './Controlador/conexion.php';
include 'global.php';
header('Content-Type: text/html; charset=utf-8');
error_reporting(0);
date_default_timezone_set("America/Lima");

class Model{


			

				 function InsertFilesUpload($files){

						$db = new Conectar();
						$conn = $db->conexion();
					

        					if ($conn->connect_errno) {
        						printf("Conexión fallida: %s\n", $conn->connect_error);
        						exit();
        
        					}else{
        
        						$iduser = $files['iduser'];
        						$idpaciente = $files['idpaciente'];
        						$namefile = $files['namefile'];
        
        
        						$sql = "INSERT files(`iduser`, `idpaciente`, `namefile`) values('$iduser','$idpaciente','$namefile')";
        						$result = $conn->query($sql);
        										
        					}

							return $result;

					}
					
					function expotarCierre($ux,$inicio,$final){

							$db = new Conectar();
							$conn = $db->conexion();		

							if ($conn->connect_errno) {
								
								printf("Conexión fallida: %s\n", $conn->connect_error);
								exit();

							}else{
                        
                             $ini= $inicio." 00:00:00";
                             $fin= $final." 23:59:59";
                                

								$sql = "SELECT P.`idEm`,(SELECT `nom` FROM `usuarios` WHERE `id` =P.`idUserRegistro`) as pax , P.`nroFua`, P.`historiaClinica`,
                            	   (SELECT `nombre`FROM `tbl_iafas` WHERE `idIa`=P.seguro) AS IAF ,P.`cuenta`, P.`nroAfiliacion`, P.`nombres`, P.`fechaNac`, P.`ApePaterno`, 
                            	   P.`ApeMaterno`, P.`fechaIngreso`, P.`fechaRegistro`,UPPER(status) AS ESX,(SELECT `nombre` FROM `tbl_plansalud` WHERE `idPa` =P.`planSal`) AS PS,
                            	   regServiceCE	FROM `tbl_Emergencias` P WHERE idUserRegistro='$ux' AND `tipoRegistro` = 3 AND fechaRegistro >= '$ini' AND fechaRegistro <='$fin'
                            	   AND P.idEm NOT IN (SELECT idPac FROM `listadoAtencionesCE`) ORDER BY fechaRegistro DESC  "; 
                            	  

								$result = $conn->query($sql);

							}

							return $result;

						}
						
						
						function crearPaqueteCe($ux,$codeMd5,$fchaHoy){

							$db = new Conectar();
							$conn = $db->conexion();		

							if ($conn->connect_errno) {
								
								printf("Conexión fallida: %s\n", $conn->connect_error);
								exit();

							}else{
                        
                             $userAasig="0";
                             $tipoReg= "2";
                             
                                
                                    
                                
                                  /*  $sql = "SELECT idGrupo  FROM `tbl_grupoArchivo` WHERE `idUsuario` ='$ux' AND  date_format(`fechaRegistro`,'%Y-%m-%d') ='$fchaHoy'  AND tipoRegistro='2'  "; 
                                    $veIf = mysqli_query($conn,$sql);
                                    $cnt = mysqli_num_rows($veIf); 
                                    
                                    $sql2 = "SELECT `idEm` FROM `tbl_Emergencias` WHERE `tipoRegistro` ='3' and date_format(`fechaRegistro`,'%Y-%m-%d') = '$fchaHoy'"; 
                                    $veIf2 = mysqli_query($conn,$sql2);
                                    $cnt2 = mysqli_num_rows($veIf2);
                                
                                      if($cnt == 0 && $cnt2 >= 1 ){
                                         $sql = "INSERT INTO `tbl_grupoArchivo`(`idUsuario`, `userAsignado`, `tipoRegistro`, `codeMd5`) VALUES('$ux','$userAasig','$tipoReg','$codeMd5') "; 
        							     $result = $conn->query($sql);
                                      }
                                */
                                
                                $sql = "INSERT INTO `tbl_grupoArchivo`(`idUsuario`, `userAsignado`, `tipoRegistro`, `codeMd5`) VALUES('$ux','$userAasig','$tipoReg','$codeMd5') "; 
        						$result = $conn->query($sql);
                                

							}

							return $result;

						}
						
						
						
						function activeUserPlat($code){

							$db = new Conectar();
							$conn = $db->conexion();		

							if ($conn->connect_errno) {
								
								printf("Conexión fallida: %s\n", $conn->connect_error);
								exit();

							}else{
                        
                             
                                $sql = "UPDATE `usuarios` SET `estado`='ACTIVADO' WHERE `active`='$code'"; 
        						$result = $conn->query($sql);
                                

							}

							return $result;

						}
						
						
						function buscarEmail($emailRecu){

							$db = new Conectar();
							$conn = $db->conexion();		

							if ($conn->connect_errno) {
								
								printf("Conexión fallida: %s\n", $conn->connect_error);
								exit();

							}else{
                        
                             
								$sql = "SELECT `id` FROM `usuarios` WHERE `email`= '$emailRecu'"; 
								$result = $conn->query($sql);

							}

							return $result;

						}
						
						
						function cambiarContrasena($correo,$id){
			        	    
    			         
                            $asunto = "ACCESO A PLATAFORMA SEGUROS - HNAL"; 
                            
                            $cuerpo ='<div style="background-color:#f4f4f4;padding-top:50px;padding-bottom:50px"><div class="adM">
                                </div><table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%;max-width:750px;background-color:#fff">
                                    <thead>
                                        <tr>
                                            <td>
                                                <img src="https://sighap.com/hnal/img/correoBarra2.png" style="width:100%;height:auto" class="CToWUd a6T" data-bit="iit" tabindex="0">
                                                    <div class="a6S" dir="ltr" style="opacity: 0.01; left: 1079px; top: 260px;"><div id=":2qp" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" 
                                                role="button" tabindex="0" aria-label="" jslog="91252; u014N:cOuCgd,Kr2w4b,xr6bB; 
                                                4:WyIjbXNnLWY6MTc2Mzc5OTUxNzMwNzg2ODU2NyIsbnVsbCxbXSxudWxsLG51bGwsbnVsbCxudWxsLG51bGwsbnVsbCxudWxsLG51bGwsbnVsbCxudWxsLG51bGwsbnVsbCxbXSxbXSxbXV0." 
                                                data-tooltip-class="a1V" jsaction="JIbuQc:.CLIENT" data-tooltip="Descargar"><div class="akn"><div class="aSK J-J5-Ji aYr"></div></div></div></div>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="padding:40px 30px 0px 30px;font-size:14px!important;color:#363636;font-family:,sans-serif!important;font-weight:400!important;line-height:1.6!important">
                                                <br>
                                                <p>&nbsp;&nbsp;&nbsp;<strong>RECUPERACION DE CONTRASEÑA: </strong>&nbsp;&nbsp;&nbsp;<a href="https://sighap.com/hnal/contrasena.php?id=2&ide='.$id.'" target="_blank" >CLICK AQUI</span></a></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:30px 30px 40px 30px;font-size:15px;color:#a96ef7;font-family:">
                                                <p><b>&nbsp;&nbsp;&nbsp;Oficina Seguros HNAL </b></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                    
                                </table><div class="yj6qo"></div><div class="adL">
                              </div></div>';
                           
                            $headers = "MIME-Version: 1.0\r\n"; 
                            $headers .= "Content-type: text/html; charset=UTF-8\r\n"; 
                            $headers .= "From: SEGUROS HNAL <ofseguroshnal@gmail.com>\r\n"; 
                            //$headers .= "Bcc: jmgsoluciones@gmail.com\r\n"; 
                            
                              mail($correo,$asunto,$cuerpo,$headers);
                       
			        	}
			        	
						
						function obtenerIdPaqueteCe($ux,$codeMd5){

							$db = new Conectar();
							$conn = $db->conexion();		

							if ($conn->connect_errno) {
								
								printf("Conexión fallida: %s\n", $conn->connect_error);
								exit();

							}else{
                        
                             $userAasig="0";
                             $tipoReg= "2";
                             
                                

								$sql = "SELECT `idGrupo`,idUsuario FROM `tbl_grupoArchivo` WHERE `codeMd5`='$codeMd5'"; 
								//$sql = "SELECT `idGrupo`,idUsuario FROM `tbl_grupoArchivo` WHERE `idUsuario` ='$ux' AND  date_format(`fechaRegistro`,'%Y-%m-%d') ='$fchaHoy' "; 
								echo $sql;
								
								$result = $conn->query($sql);

							}

							return $result;

						}
						
						
						function insertFuasPaqueteCe($idPaq,$idPac,$userReg){

							$db = new Conectar();
							$conn = $db->conexion();		

							if ($conn->connect_errno) {
								
								printf("Conexión fallida: %s\n", $conn->connect_error);
								exit();

							}else{
                        
                             $userAasig="0";
                             $tipoReg= "2";
                             
                                

								$sql = "INSERT INTO `listadoAtencionesCE`(`idPaq`, `idPac`, `userReg`) VALUES ('$idPaq','$idPac','$userReg') "; 
								$result = $conn->query($sql);

							}

							return $result;

						}
						
					
					function EjecutarFechasIngreso(){

            					$db = new Conectar();
            					$conn = $db->conexion();		
            
            					if ($conn->connect_errno) {
            					    printf("Conexión fallida: %s\n", $conn->connect_error);
            					    exit();
            
            					}else{
            
            					        $sql = "SELECT E.`idEm`,E.`fechaIngreso`,date_format(E.`fechaIngreso`,'%Y-%m-%d'),DATE(NOW()),timestampdiff(DAY,date_format(E.`fechaIngreso`,'%Y/%m/%d'),DATE(NOW())) AS estancia,
                                        (SELECT `estancia` FROM `tbl_Emergencias` WHERE `ideNew` =E.idEm) as ESHOS  FROM `tbl_Emergencias` E WHERE E.`feAltaAlt` = ''   ORDER BY E.fechaIngreso DESC";
            					        $result = $conn->query($sql);				
            
            					}
    
    					        return $result;
    
    				}
    				
    				function EjecutarFechaSumaEstancia($id){

            					$db = new Conectar();
            					$conn = $db->conexion();		
            
            					if ($conn->connect_errno) {
            					    printf("Conexión fallida: %s\n", $conn->connect_error);
            					    exit();
            
            					}else{
            
            					        $sql = "SELECT `estancia` FROM `tbl_Emergencias` WHERE `ideNew` ='$id'";
            					        $result = $conn->query($sql);				
            
            					}
    
    					        return $result;
    
    				}
				
					
					function actualizarEstancia($posttrasplante){

					    $db = new Conectar();
					    $conn = $db->conexion();
				

						if ($conn->connect_errno) {
						    printf("Conexión fallida: %s\n", $conn->connect_error);
						    exit();

						}else{

							$id		= $posttrasplante['id'];
							$estancia = $posttrasplante['estancia'];
							
							$sql = "UPDATE `tbl_Emergencias` SET `estancia` ='$estancia' WHERE `idEm`='$id'";
							$result = $conn->query($sql);
											
						}

							
						return $result;

				} 


                    function EjecutarCantidades(){

        					$db = new Conectar();
        					$conn = $db->conexion();		

        					if ($conn->connect_errno) {
        					    printf("Conexión fallida: %s\n", $conn->connect_error);
        					    exit();
        
        					}else{
        
            					$sql = "SELECT COUNT(*) AS CONTEO,grupo FROM tbl_consultaExterna GROUP BY `grupo` order by grupo DESC";
            					$result = $conn->query($sql);				
        
        					}
        
        					return $result;

				    }
				    
				     function EjecutarGrupoFechas(){

        					$db = new Conectar();
        					$conn = $db->conexion();		

        					if ($conn->connect_errno) {
        					    printf("Conexión fallida: %s\n", $conn->connect_error);
        					    exit();
        
        					}else{
        
            					$sql = "SELECT grupo FROM tbl_consultaExterna";
            					$result = $conn->query($sql);				
        
        					}
        
        					return $result;

				    }
				    
				    
				    function fechaMin($grupo){

        					$db = new Conectar();
        					$conn = $db->conexion();		

        					if ($conn->connect_errno) {
        					    printf("Conexión fallida: %s\n", $conn->connect_error);
        					    exit();
        
        					}else{
        
                                
            					$sql = "SELECT `fechaIngreso`,grupo FROM `tbl_consultaExterna` WHERE `grupo`='$grupo' order by fechaIngreso asc  LIMIT 1";
            					$result = $conn->query($sql);				
        
        					}
        
        					return $result;

				    }
				    
				    
				    function fechaMax(){

        					$db = new Conectar();
        					$conn = $db->conexion();		

        					if ($conn->connect_errno) {
        					    printf("Conexión fallida: %s\n", $conn->connect_error);
        					    exit();
        
        					}else{
        					    
                               
            				//	$sql = "SELECT `fechaIngreso`,grupo FROM `tbl_consultaExterna` WHERE `grupo`='$grupo' order by fechaIngreso desc  LIMIT 1";
            				    $sql="SELECT T.grupo,MIN(T.fechaIngreso)AS ME,MAX(T.fechaIngreso) AS MA from tbl_consultaExterna as T GROUP BY grupo  ORDER BY T.`grupo` DESC";    
            					$result = $conn->query($sql);				
        
        					}
        
        					return $result;

				    }
				    

                        function actualizarCant($posttrasplante){
        
        					$db = new Conectar();
        					$conn = $db->conexion();
        				
        
        						if ($conn->connect_errno) {
        						    printf("Conexión fallida: %s\n", $conn->connect_error);
        						    exit();
        
        						}else{
        
        							$grupo	= $posttrasplante['grupo'];
        							$CONTEO = $posttrasplante['CONTEO'];
        							
        							$sql = "UPDATE `tbl_grupoCE` SET `total`='$CONTEO' WHERE `idGrupo`='$grupo'";
        							$result = $conn->query($sql);
        											
        						}
        
        							
        						return $result;
        
        				} 
        				
        				function actualizarMin($posttrasplante){
        
        					$db = new Conectar();
        					$conn = $db->conexion();
        				
        
        						if ($conn->connect_errno) {
        						    printf("Conexión fallida: %s\n", $conn->connect_error);
        						    exit();
        
        						}else{
        
        							$grupo	= $posttrasplante['grupo'];
        							$fechaIngreso = $posttrasplante['fechaIngreso'];
        							
        							$sql = "UPDATE `tbl_grupoCE` SET `fechaMin`='$fechaIngreso' WHERE `idGrupo`='$grupo'";
        							$result = $conn->query($sql);
        											
        						}
        
        							
        						return $result;
        
        				} 
        				
        				
        				function actualizarMax($posttrasplante){
        
        					$db = new Conectar();
        					$conn = $db->conexion();
        				
        
        						if ($conn->connect_errno) {
        						    printf("Conexión fallida: %s\n", $conn->connect_error);
        						    exit();
        
        						}else{
        
        							$grupo	= $posttrasplante['grupo'];
        							$MA = $posttrasplante['MA'];
        							$ME = $posttrasplante['ME'];
        							
        							$sql = "UPDATE `tbl_grupoCE` SET `fechaMax`='$MA',`fechaMin`='$ME' WHERE `idGrupo`='$grupo'";
        							$result = $conn->query($sql);
        											
        						}
        
        							
        						return $result;
        
        				} 

					function InsertFilesCargoEnvio($files){

						$db = new Conectar();
						$conn = $db->conexion();
					

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

					
						$idpaciente = $files['idpaciente'];
						$tipo = $files['tipo'];
						$archivofile = $files['namefile'];

						if($tipo=="envio"){
							$sql = "UPDATE pretrasplante SET `CargoEnvio`='$archivofile' WHERE idPaciente='$idpaciente' ";
							$result = $conn->query($sql);
						}else if($tipo=="apro"){
							$sql = "UPDATE pretrasplante SET `CargoAprobacion`='$archivofile' WHERE idPaciente='$idpaciente' ";
							$result = $conn->query($sql);
						}						
										
					}

							return $result;

					}

					function InsertFilesCargoEnvioPOST($files){

						$db = new Conectar();
						$conn = $db->conexion();
					

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

					
						$idpaciente = $files['idpaciente'];
						$archivofile = $files['namefile'];

						$sql = "UPDATE registropacientes SET `CargoAprobacion`='$archivofile' WHERE NroPaciente='$idpaciente' ";
						$result = $conn->query($sql);
										
										
					}

							return $result;

					}




					function InsertFilesCargoEnvioAmp($files){

						$db = new Conectar();
						$conn = $db->conexion();
					

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

					
						$idpaciente = $files['idpaciente'];
						$tipo = $files['tipo'];
						$archivofile = $files['namefile'];

						if($tipo=="envio"){
							$sql = "UPDATE ampliacion SET `CargoEnvio`='$archivofile' WHERE idPaciente='$idpaciente' ";
							$result = $conn->query($sql);
						}else if($tipo=="apro"){
							$sql = "UPDATE ampliacion SET `CargoAprobacion`='$archivofile' WHERE idPaciente='$idpaciente' ";
							$result = $conn->query($sql);
						}						
										
					}

							return $result;

					}




					function InsertFilesPaciente($filesPac){

						$db = new Conectar();
						$conn = $db->conexion();
					

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

						$idpac = $filesPac['idpac'];
						$archivofile = $filesPac['archivofile'];				

						$sql = "UPDATE registropacientes SET `filesPre`='$archivofile' WHERE NroPaciente='$idpac' ";
						$result = $conn->query($sql);
										
					}

							return $result;

					}



					function InsertFilesPacientePost($filesPac){

						$db = new Conectar();
						$conn = $db->conexion();
					

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

						$idpac = $filesPac['idpac'];
						$archivofile = $filesPac['archivofile'];				

						$sql = "UPDATE registropacientes SET `filesPost`='$archivofile' WHERE NroPaciente='$idpac' ";
						$result = $conn->query($sql);
										
					}

							return $result;

					}


					function InsertFilesPacienteAmp($filesPac){

						$db = new Conectar();
						$conn = $db->conexion();
					

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

						$idpac = $filesPac['idpac'];
						$archivofile = $filesPac['archivofile'];				

						$sql = "UPDATE registropacientes SET `filesAmp`='$archivofile' WHERE NroPaciente='$idpac' ";
						$result = $conn->query($sql);
										
					}

							return $result;

					}




					function DeleteFilesUpload($files){

						$db = new Conectar();
						$conn = $db->conexion();
					

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

						$iduser = $files['iduser'];
						$idpaciente = $files['idpaciente'];
						$etapa = $files['etapa'];
						$namefile = $files['namefile'];


						$sql = "DELETE FROM  files WHERE `iduser`= '$iduser' AND `idpaciente`= '$idpaciente' 
						AND `etapa`= '$etapa' AND `namefile`= '$namefile' ";
						$result = $conn->query($sql);
										
					}

							return $result;

					}



					function HistorialRegistro($historial){

						$db = new Conectar();
						$conn = $db->conexion();
					

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

						$iduser = $historial['id'];
						$idpaciente = $historial['ide'];
						$etapa = $historial['etapa'];

						echo $iduser."<br><br>";
						echo $idpaciente;
						

						$sql = "INSERT INTO `historial`(`IdUser`, `IdPaciente`, `Etapa`) VALUES ('$iduser','$idpaciente','$etapa')";
						$result = $conn->query($sql);
										
					}

							return $result;

					}

					function HistorialRegistroPre($historial){

						$db = new Conectar();
						$conn = $db->conexion();
					

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

						$iduser = $historial['id'];
						$idpaciente = $historial['iduser'];
						$etapa = $historial['etapa'];

						echo $iduser."<br><br>";
						echo $idpaciente;
						

						$sql = "INSERT INTO `historial`(`IdUser`, `IdPaciente`, `Etapa`) VALUES ('$idpaciente','$iduser','$etapa')";
						$result = $conn->query($sql);
										
					}

							return $result;

					}


					function HistorialRegistroPost($historial){

						$db = new Conectar();
						$conn = $db->conexion();
					

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

						$iduser = $historial['id'];
						$idpaciente = $historial['iduser'];
						$etapa = $historial['etapa'];

						$sql = "INSERT INTO `historial`(`IdUser`, `IdPaciente`, `Etapa`) VALUES ('$idpaciente','$iduser','$etapa')";
						$result = $conn->query($sql);
										
					}

							return $result;

				}



				function HistorialRegistroDona($historial){

					$db = new Conectar();
					$conn = $db->conexion();
				

				if ($conn->connect_errno) {
					printf("Conexión fallida: %s\n", $conn->connect_error);
					exit();

				}else{

					$iduser = $historial['id'];
					$idpaciente = $historial['iduser'];
					$etapa = $historial['etapa'];

					$sql = "INSERT INTO `historial`(`IdUser`, `IdPaciente`, `Etapa`) VALUES ('$idpaciente','$iduser','$etapa')";
					$result = $conn->query($sql);
									
					}

						return $result;

				}


				function consultaPdfDonante($id){

					$db = new Conectar();
					$conn = $db->conexion();
				

				if ($conn->connect_errno) {
					printf("Conexión fallida: %s\n", $conn->connect_error);
					exit();

				}else{


					$sql = "SELECT R.Nombres,R.ApePaterno,R.ApeMaterno,D.dni,D.parentesco,D.Nombres AS NombresDo,D.Apellidos,D.edad,D.FechaAcre,D.FechaVenc
					FROM `registropacientes` AS R INNER JOIN donantes AS D ON R.NroPaciente= D.IdPaciente WHERE D.`idDon`='$id'";
					$result = $conn->query($sql);
									
					}

						return $result;

				}


				function consultaUpss(){

					$db = new Conectar();
					$conn = $db->conexion();
				

				if ($conn->connect_errno) {
					printf("Conexión fallida: %s\n", $conn->connect_error);
					exit();

				}else{


					//$sql = "SELECT `upss`,`Diagnostico`,`Cie10`,COUNT(upss) AS NRO,fechaRegistro AS niceDate  FROM `registropacientes` GROUP BY `upss`";
					//$sql = "SELECT upss,Diagnostico,Cie10,fechaRegistro AS niceDate FROM `registropacientes`";
					 //$sql="SELECT `upss`,`Cie10`,`Diagnostico`,`fechaRegistro`,COUNT(Diagnostico) FROM `registropacientes` WHERE `fechaRegistro` BETWEEN '2019-07-01' AND '2019-07-31'  GROUP BY `Cie10`,`Diagnostico`";
					//$sql="SELECT `upss`,`Cie10`,`Diagnostico`,`fechaRegistro` AS niceDate,COUNT(Diagnostico) AS NRO FROM `registropacientes` WHERE `fechaRegistro` GROUP BY `Cie10`,`Diagnostico`";
					$sql = "SELECT upss,Diagnostico,Cie10,fechaRegistro AS niceDate FROM `registropacientes`";
					
					
					$result = $conn->query($sql);
									
					}

						return $result;

				}



				function consultaCie10(){

					$db = new Conectar();
					$conn = $db->conexion();
				

				if ($conn->connect_errno) {
					printf("Conexión fallida: %s\n", $conn->connect_error);
					exit();

				}else{

					//$sql="SELECT `Cie10`,`Diagnostico`,`fechaRegistro`,COUNT(Diagnostico) FROM `registropacientes` WHERE `fechaRegistro` BETWEEN '2019-07-01' AND '2019-07-31' GROUP BY `Cie10`,`Diagnostico`"
					$sql = "SELECT `Diagnostico`,`Cie10`,fechaRegistro AS niceDate  FROM `registropacientes`";
					$result = $conn->query($sql);
									
					}

						return $result;

				}



			   function InsertPaciente($paciente){

					$db = new Conectar();
					$conn = $db->conexion();
					$ide= $paciente['ide'] ; 
					

					$iduser = $paciente['iduser'];
					$ide= $paciente['ide'] ;
					$tipoDoc= $paciente['tipoDoc'] ;
					$NroDoc= $paciente['NroDoc'] ;
					$solipac= $paciente['solipac'];
					$solimedico= $paciente['solimedico'];
					$regimen= $paciente['regimen'];
					$hclinica= $paciente['hclinica'];
					$ippress= $paciente['ippress'] ;
					$sexo= $paciente['sexo'];
					$tipoAf= $paciente['tipoAf'];
					$NroAf= $paciente['NroAf'];
					$nombres= $paciente['nombres'];
					$FechaNac= $paciente['FechaNac'];
					$apepa= $paciente['apepa'];
					$apema= $paciente['apema'];
					$departamento= $paciente['departamento'];
					$fecobertura= $paciente['fecobertura'];
					$cie10= $paciente['cie10'];
					$descri= $paciente['descri'];
					$telefa= $paciente['telefa'];
					$edad= $paciente['edad'];
					$dniMama= $paciente['dniMama'];
					$nombresMama= $paciente['nombresMama'];
					$apeMama= $paciente['apeMama'];
					$dniPapa= $paciente['dniPapa'];
					$nombresPapa= $paciente['nombresPapa'];
					$apePapa= $paciente['apePapa'];
					$correoSolicitud= $paciente['correoSolicitud'];
					$feiniciCobertura= $paciente['feiniciCobertura'];
					$docRespuesta= $paciente['docRespuesta'];
					$feAutoraizacion= $paciente['feAutoraizacion'];
					$cocobertura= $paciente['cocobertura'];
					$coafiliado= $paciente['coafiliado'];
					$observaciones= $paciente['observaciones'];
					$upss = $paciente['upss'];
					$tipoDocPapa = $paciente['tipoDocPapa'];
					$tipoDocMama = $paciente['tipoDocMama'];
					$coses = $paciente['coses'];
					$ObsSeguro = $paciente['ObsSeguro'];
					$fefa = $paciente['fefa'];


					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{
					
						if($ide==""){


							$sql = "INSERT registropacientes(`Ippress`, `FechaSolicitud`, `solimedico`, `TipoDocumento`, `NroDocumento`, `TipoAfiliacion`, `NroAfiliacion`, 
							`Departamento`, `ApePaterno`, `ApeMaterno`, `Nombres`, `FechaNacimiento`, `Edad`, `Sexo`, `Diagnostico`, `Cie10`, `regimen`, `hclinica`,
							`TelefonoFamilia`, `usuario`,`dnimama`, `nombresMama`, `apeMama`, `dniPapa`, `nombresPapa`, `apePapa`, `correoSolicitud`, 
							`feiniciCobertura`, `docRespuesta`, `feAutoraizacion`, `cocobertura`, `coafiliado`, `observaciones`, `upss`, `tipoDocPapa`, `tipoDocMama`,
							 `CondSeguro`, `ObsSeguro`, `FechaFalle`)
							values('$ippress','$solipac','$solimedico','$tipoDoc','$NroDoc','$tipoAf','$NroAf','$departamento','$apepa','$apema',
							'$nombres','$FechaNac','$edad','$sexo','$descri','$cie10','$regimen','$hclinica','$telefa','$iduser','$dniMama','$nombresMama','$apeMama',
							'$dniPapa', '$nombresPapa', '$apePapa', '$correoSolicitud','$feiniciCobertura','$docRespuesta','$feAutoraizacion','$cocobertura','$coafiliado',
							'$observaciones','$upss','$tipoDocPapa','$tipoDocMama','$coses','$ObsSeguro','$fefa')";
												
							$result = $conn->query($sql);

						}else{

							$sql = "UPDATE `registropacientes` SET `Ippress`='$ippress',`FechaSolicitud`='$solipac',`solimedico`='$solimedico',
							`TipoDocumento`='$tipoDoc',`NroDocumento`='$NroDoc',`TipoAfiliacion`='$tipoAf',`NroAfiliacion`='$NroAf',`Departamento`='$departamento',
							`ApePaterno`='$apepa',`ApeMaterno`='$apema',`Nombres`='$nombres',`FechaNacimiento`='$FechaNac',`Edad`='$edad',`Sexo`='$sexo',`Diagnostico`='$descri',
							`Cie10`='$cie10',`regimen`='$regimen',`hclinica`='$hclinica',`TelefonoFamilia`='$telefa',`usuario`='$iduser',`dniMama`='$dniMama',`nombresMama`='$nombresMama'
							,`apeMama`='$apeMama',`dniPapa`='$dniPapa',`nombresPapa`='$nombresPapa',`apePapa`='$apePapa',`correoSolicitud`='$correoSolicitud'
							,`feiniciCobertura`='$feiniciCobertura',`docRespuesta`='$docRespuesta',`feAutoraizacion`='$feAutoraizacion',`cocobertura`='$cocobertura',
							`coafiliado`='$coafiliado',`observaciones`='$observaciones' ,`upss`='$upss' ,`tipoDocPapa`='$tipoDocPapa' ,`tipoDocMama`='$tipoDocMama',
							 `CondSeguro`='$coses' ,`ObsSeguro`='$ObsSeguro' ,`FechaFalle`='$fefa' WHERE `NroPaciente`='$ide' ";

							$result = $conn->query($sql);


							
						}
										
					}

							return $result;

				}
				

				function InsertPre($pretrasplante){

					$db = new Conectar();
					$conn = $db->conexion();
					$id=$pretrasplante['id'];

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

						$sqlRows ="SELECT * FROM pretrasplante WHERE idPaciente=$id";
						$result = $conn->query($sqlRows);						

						if($result->num_rows > 0){

								

								$id=$pretrasplante['id'];
								$iduser=$pretrasplante['iduser'];	
								$tipotras=$pretrasplante['tipotras'];
								$HistCli=$pretrasplante['HistCli'];
								$emailcena=$pretrasplante['emailcena'];
								$fecensol=$pretrasplante['fecensol'];
								$emailcAproFis=$pretrasplante['emailcAproFis'];
								
								$fecaprosol=$pretrasplante['fecaprosol'];									
								$fetras=$pretrasplante['fetras'];
								$lugarTrans=$pretrasplante['lugarTrans'];
								$observaciones=$pretrasplante['observaciones'];


								$fecha = date('Y-m-j');
								$nuevafecha = strtotime ( '+180 day' , strtotime ($fecaprosol) ) ;
								$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

								$fecha1 = new DateTime($fecha);
								$fecha2 = new DateTime($fecaprosol);
								$fechaM = $fecha1->diff($fecha2);				
								$mostrar  = $fechaM->y." años y ".$fechaM->m." meses y ".$fechaM->d." dias";
								
								$calc = $fechaM->m;
								$ditven = $fechaM->d;
								$estadopaciente="";
								if( $fecaprosol !="" && $ditven >= 0 && $calc >= 0 && $calc <= 6){
									$estadopaciente="ACTIVO";
								}else{
									$estadopaciente="INACTIVO";
								}


								$sql = "UPDATE pretrasplante SET `idPaciente`='$id',`usuario`='$iduser',`TipoTrasplante`='$tipotras',`HistoriaClinica`='$HistCli',
								`EmailEnvio`='$emailcena',`EmailApro`='$emailcAproFis',`FechaEnvio`='$fecensol',`FechaApro`='$fecaprosol',
								`Tiempotrascurrido`='$mostrar',`CoberturaPos`='$nuevafecha',`observaciones`='$observaciones' ,`EstadoPaciente`='$estadopaciente' WHERE idPaciente='$id' ";

								$result = $conn->query($sql);
								

						}else{

								

								$id=$pretrasplante['id'];
								$iduser=$pretrasplante['iduser'];	
								$tipotras=$pretrasplante['tipotras'];
								$HistCli=$pretrasplante['HistCli'];
								$emailcena=$pretrasplante['emailcena'];
								$fecensol=$pretrasplante['fecensol'];
								$emailcAproFis=$pretrasplante['emailcAproFis'];
								$fecaprosol=$pretrasplante['fecaprosol'];
								$fetras=$pretrasplante['fetras'];									
								$observaciones=$pretrasplante['observaciones'];
								$emailcAproFis=$pretrasplante['emailcAproFis'];

								$fecha = date('Y-m-j');
								$nuevafecha = strtotime ( '+180 day' , strtotime ($fecaprosol) ) ;
								$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

								$fecha1 = new DateTime($fecha);
								$fecha2 = new DateTime($fecaprosol);
								$fechaM = $fecha1->diff($fecha2);				
								$mostrar  = $fechaM->y." años y ".$fechaM->m." meses y ".$fechaM->d." dias";
								
								$calc = $fechaM->m;
								$ditven = $fechaM->d;
								$estadopaciente="";
								if($fecaprosol !="" && $ditven >= 0 && $calc >= 0 && $calc <= 6){
									$estadopaciente="ACTIVO";
								}else{
									$estadopaciente="INACTIVO";
								}

								
								$sql = "INSERT pretrasplante(`idPaciente`, `usuario`, `TipoTrasplante`, `HistoriaClinica`, `EmailEnvio`, 
								`EmailApro`, `FechaEnvio`, `FechaApro`, `Tiempotrascurrido`, `CoberturaPos`, `observaciones`,`EstadoPaciente`)values('$id','$iduser',
								'$tipotras','$HistCli','$emailcena','$emailcAproFis','$fecensol','$fecaprosol','$mostrar','$nuevafecha','$observaciones','$estadopaciente')";
										
								$result = $conn->query($sql);
							
						}
										
					}

							return $result;

				}

				
				
				function InsertPost($posttrasplante){

					$db = new Conectar();
					$conn = $db->conexion();
					$id=$posttrasplante['id'];

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

						$sqlRows ="SELECT * FROM posttrasplante WHERE idPaciente=$id";
						$result = $conn->query($sqlRows);						

						if($result->num_rows > 0){

								$id=$posttrasplante['id'];
								$iduser=$posttrasplante['iduser'];	
								$oficiopost=$posttrasplante['oficiopost'];
								$fechapost=$posttrasplante['fechapost'];
								$ofiauto=$posttrasplante['ofiauto'];
								$feauto=$posttrasplante['feauto'];	
								$fetras=$posttrasplante['fetras'];
								$lugarTrans=$posttrasplante['lugarTrans'];
								$nrotr=$posttrasplante['nrotr'];
								$optradio=$posttrasplante['optradio'];

								$fecha = date('Y-m-j');
								$nuevafecha = strtotime ( '+730 day' , strtotime ($feauto) ) ;
								$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

								$fecha1 = new DateTime($fecha);
								$fecha2 = new DateTime($feauto);
								$fechaM = $fecha1->diff($fecha2);				
								$mostrar  = $fechaM->y." años y ".$fechaM->m." meses y ".$fechaM->d." dias";



								$sql = "UPDATE posttrasplante SET `idPaciente`='$id',`usuario`='$iduser',
								`oficioaviso`='$oficiopost',`fechaviso`='$fechapost',`oficioauto`='$ofiauto',`Fechaauto`='$feauto'
								,`FechaTras`='$fetras',`LugarTras`='$lugarTrans', `Tiempotrascurrido`='$mostrar' ,`CoberturaPos`='$nuevafecha', `nrotrasplante`='$nrotr' ,
								`tipoTrasplantePost`='$optradio'  WHERE idPaciente='$id' ";
								echo $sql;

								$result = $conn->query($sql);
								

						}else{

								

								$id=$posttrasplante['id'];
								$iduser=$posttrasplante['iduser'];	
								$oficiopost=$posttrasplante['oficiopost'];
								$fechapost=$posttrasplante['fechapost'];
								$ofiauto=$posttrasplante['ofiauto'];
								$feauto=$posttrasplante['feauto'];
								$fetras=$posttrasplante['fetras'];
								$lugarTrans=$posttrasplante['lugarTrans'];
								$nrotr=$posttrasplante['nrotr'];
								$optradio=$posttrasplante['optradio'];



								$fecha = date('Y-m-j');
								$nuevafecha = strtotime ( '+730 day' , strtotime ($feauto) ) ;
								$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

								$fecha1 = new DateTime($fecha);
								$fecha2 = new DateTime($feauto);
								$fechaM = $fecha1->diff($fecha2);				
								$mostrar  = $fechaM->y." años y ".$fechaM->m." meses y ".$fechaM->d." dias";

								$sql = "INSERT posttrasplante(`idPaciente`, `usuario`,`oficioaviso`, `fechaviso`, `oficioauto`, `Fechaauto`, 
								`FechaTras`, `LugarTras`, `Tiempotrascurrido`, `CoberturaPos`, `nrotrasplante`, `tipoTrasplantePost`)values('$id','$iduser',
								'$oficiopost','$fechapost','$ofiauto','$feauto','$fetras','$lugarTrans','$mostrar','$nuevafecha','$nrotr','$optradio')";

echo $sql;
										
								$result = $conn->query($sql);
							
						}
										
					}

							return $result;

				}



				function InsertAmp($amptrasplante){

					$db = new Conectar();
					$conn = $db->conexion();
					$id=$amptrasplante['id'];

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

						$sqlRows ="SELECT * FROM ampliacion WHERE idPaciente=$id";
						$result = $conn->query($sqlRows);						

						if($result->num_rows > 0){

							$id=$amptrasplante['id'];
							$iduser=$amptrasplante['iduser'];	
							$oficiopostAmp=$amptrasplante['oficiopostAmp'];
							$fechaAmp=$amptrasplante['fechaAmp'];
							$ofiautoAmp=$amptrasplante['ofiautoAmp'];
							$feautoAmp=$amptrasplante['feautoAmp'];	
							$fetrasAmp=$amptrasplante['fetrasAmp'];
							$lugarTransAmp=$amptrasplante['lugarTransAmp'];
							$finCob = $amptrasplante['finCob'];


							$sql = "UPDATE ampliacion SET `usuario`='$iduser',
							`oficioaviso`='$oficiopostAmp',`fechaviso`='$fechaAmp',`oficioauto`='$ofiautoAmp',
							`Fechaauto`='$feautoAmp',`FechaTras`='$fetrasAmp',`LugarTras`='$lugarTransAmp', 
							`CoberturaAm`='$finCob'  WHERE idPaciente='$id' ";
//echo $sql;
							$result = $conn->query($sql);
								

						}else{

							$id=$amptrasplante['id'];
							$iduser=$amptrasplante['iduser'];	
							$oficiopostAmp=$amptrasplante['oficiopostAmp'];
							$fechaAmp=$amptrasplante['fechaAmp'];
							$ofiautoAmp=$amptrasplante['ofiautoAmp'];
							$feautoAmp=$amptrasplante['feautoAmp'];	
							$fetrasAmp=$amptrasplante['fetrasAmp'];
							$lugarTransAmp=$amptrasplante['lugarTransAmp'];
							$finCob = $amptrasplante['finCob'];


							$sql = "INSERT ampliacion(`idPaciente`, `usuario`,`oficioaviso`, `fechaviso`, `oficioauto`,
							`Fechaauto`, `FechaTras`, `LugarTras`, `CoberturaAm`)values('$id','$iduser','$oficiopostAmp',
							'$fechaAmp','$ofiautoAmp','$feautoAmp','$fetrasAmp','$lugarTransAmp','$finCob')";
									//	echo $sql;
							$result = $conn->query($sql);
							
						}
										
					}

							return $result;

				}

				

				function InsertDonante($donante){

					$db = new Conectar();
					$conn = $db->conexion();
					$iddon=$donante['iddon'];
					$id=$donante['id'];	

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

						if($iddon==""){

								
								$iduser=$donante['iduser'];
								$dnido = $donante['dnido'];
								$nodona=$donante['nodona'];
								$apedona=$donante['apedona'];
								$edado=$donante['edado'];
								$tipoDona=$donante['tipoDona'];
								$estadona = $donante['estado'];
								$parentesco =$donante['parentesco'];
								$feacre = $donante['feacre'];
								$especifica = $donante['especifica'];
								

								$sql = "INSERT donantes(`idUser`,`dni`, `IdPaciente`, `Nombres`, `Apellidos`, `edad`, `TipoDona`,`estado`,`parentesco`,`FechaAcre`,`especifica`)
								values('$iduser','$dnido','$id','$nodona','$apedona','$edado','$tipoDona','$estadona','$parentesco','$feacre','$especifica')";
										
								$result = $conn->query($sql);				

						}else {
							// 

						//7	$sqlDel = "UPDATE `donantes` SET `FechaVenc`='' WHERE `IdPaciente`='$id'";
							//$resultDel = $conn->query($sqlDel);


							$dnido = $donante['dnido'];
							$nodona=$donante['nodona'];
							$apedona=$donante['apedona'];
							$edado=$donante['edado'];
							$tipoDona=$donante['tipoDona'];
							$estadona=$donante['estado'];
							$parentesco =$donante['parentesco'];
							$feacre = $donante['feacre'];
							$especifica = $donante['especifica'];
							$EstadoAcre = $donante['EstadoAcre'];

							$nuevafecha = strtotime ( '+30 day' , strtotime ($feacre) ) ;
							$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

							$sql = "UPDATE `donantes` SET `Nombres`='$nodona',`Apellidos`='$apedona',`edad`='$edado',
							`TipoDona`='$tipoDona',`estado`='$estadona',`dni`='$dnido' ,`FechaAcre`='$feacre' ,
							`especifica`='$especifica',`FechaVenc`='$nuevafecha',`EstadoAcre`='$EstadoAcre'  WHERE `idDon`='$iddon'";
							
							$result = $conn->query($sql);	

						}
								
						
								
					}




							return $result;

				}


				function InsertUsuarios($usuarios){

					$db = new Conectar();
					$conn = $db->conexion();
					$nomusu=$usuarios['nomusu'];

					if ($conn->connect_errno) {
						printf("Conexión fallida: %s\n", $conn->connect_error);
						exit();

					}else{

						if($nomusu!=""){

							$nomusu =$usuarios['nomusu'];
							$apeusu=$usuarios['apeusu'];
							$emailusu=$usuarios['emailusu'];
							$rolusu=$usuarios['rolusu'] ;
							$userusu=$usuarios['userusu'] ;
							$password=$usuarios['password'];
							$pass= md5($password);
							$estadousu=$usuarios['estadousu'];
							$teleusu= $usuarios['teleusu'];

								$sql = "INSERT usuarios(`user`, `email`, `pass`, `estado`, `rol`, `nom`, `ape`, `cel`)
								values('$userusu','$emailusu','$pass','$estadousu','$rolusu','$nomusu','$apeusu','$teleusu')";
										
								$result = $conn->query($sql);				

						}else {

							$dnido = $donante['dnido'];
							$nodona=$donante['nodona'];
							$apedona=$donante['apedona'];
							$edado=$donante['edado'];
							$tipoDona=$donante['tipoDona'];
							$estadona=$donante['estado'];

							$sql = "UPDATE `donantes` SET `Nombres`='$nodona',`Apellidos`='$apedona',`edad`='$edado',
							`TipoDona`='$tipoDona',`estado`='$estadona',`dni`='$dnido' WHERE `idDon`='$iddon'";
							
							$result = $conn->query($sql);	

						}
								
						
								
					}




							return $result;

				}


				
				function EliminarRegistro($eliminar){

					$db = new Conectar();
					$conn = $db->conexion();
				

						if ($conn->connect_errno) {
						    printf("Conexión fallida: %s\n", $conn->connect_error);
						    exit();

						}else{

							$iduserReg =$eliminar['iduserReg'];
							$iddReg=$eliminar['iddReg'];
							$motivo=$eliminar['motivo'];
							$motivoregistro=$eliminar['motivoregistro'] ;

							$sql = "UPDATE `registropacientes` SET `EstadoRegistro`='ELIMINADO' WHERE `NroPaciente`= '$iddReg'";
							$result = $conn->query($sql);
											
						}

								return $result;

				} 


				function TerminarProcex($eliminar){

					$db = new Conectar();
					$conn = $db->conexion();
				

						if ($conn->connect_errno) {
						    printf("Conexión fallida: %s\n", $conn->connect_error);
						    exit();

						}else{

							$iduserTermino =$eliminar['iduserTermino'];
							$iddTer=$eliminar['iddTer'];
							$feFinProceso=$eliminar['feFinProceso'];
							$motivoFin=$eliminar['motivoFin'];
							$motivofinPr=$eliminar['motivofinPr'];

							$sql = "INSERT `finalproceso`(`IdRegistro`, `IdUser`, `Motivo`, `Descripcion`, `FechaFin`)
							VALUES('$iddTer','$iduserTermino','$motivoFin','$motivofinPr','$feFinProceso')";
							
							$result = $conn->query($sql);
											
						}

								return $result;

				}


				function insertEfectivo($efectivo){

					$db = new Conectar();
					$conn = $db->conexion();
				

						if ($conn->connect_errno) {
						    printf("Conexión fallida: %s\n", $conn->connect_error);
						    exit();

						}else{

							$id =$efectivo['id'];
							$dni =$efectivo['dni'];
							$edad =$efectivo['edad'];
							$iduser =$efectivo['iduser'];
							$iddona =$efectivo['iddona'];

							if($id=="0"){
								$esta="CADAVERICO";
							}else{
								$esta="VIVO";
							}
							
							$sql = "INSERT `donefectivos`(`idUser`, `IdPaciente`,`idDonante`, `dni`, `edad`, `estado`)VALUES('$iduser','$iddona','$id','$dni','$edad','$esta')";
							
							$result = $conn->query($sql);
											
						}

								return $result;

				}


				function deleteRegistro($eliminar){

					$db = new Conectar();
					$conn = $db->conexion();
				

						if ($conn->connect_errno) {
						    printf("Conexión fallida: %s\n", $conn->connect_error);
						    exit();

						}else{

							$iduserReg =$eliminar['iduserReg'];
							$iddReg=$eliminar['iddReg'];
							$motivo=$eliminar['motivo'];
							$motivoregistro=$eliminar['motivoregistro'];

							$sql = "INSERT `deleteregistro`(`IdRegistro`, `IdUser`, `Motivo`, `Descripcion`)VALUES('$iddReg','$iduserReg','$motivo','$motivoregistro')";
							$result = $conn->query($sql);
											
						}

								return $result;

				}



				function InsertarRes($id,$dnires,$cuenta,$nombreres,$apepatres,$apematres,$profesion,$colegiatura,$especialidad,$nrorne){

					$db = new Conectar();
					$conn = $db->conexion();
					$persona= $nombreres." ".$apepatres." ".$apematres;
				

				if ($conn->connect_errno) {
				    printf("Conexión fallida: %s\n", $conn->connect_error);
				    exit();

				}else{
				
					if($id==""){
							
							$sql = "INSERT a_responsableatencion(dni,Nombre,Profesion,Colegiatura,Especialidad,NroRne,cuenta)values('$dnires','$persona','$profesion','$colegiatura','$especialidad','$nrorne','$cuenta')";
							$result = $conn->query($sql);
							echo"Datos guardados correctamente";

					}else{

						$sql = "UPDATE cabregistro SET nro_re='$nro_re',senores='$senores',email='$email',cliente='$cliente',moneda='$moneda',direccion='$direccion',obs='$obs',fe_re='$fe_re',total='$total',iduser='$iduser',boletos='$boletos' ,viajes='$viajes' ,nacionales='$nacionales' ,internacionales='$internacionales' WHERE id_re='$id' ";
						$result = $conn->query($sql);
						
					}
									
				}

						return $result;

				}


				function InsertarCie10($id,$cie10,$cuenta,$descri,$ingreso,$tipoAt){

					$db = new Conectar();
					$conn = $db->conexion();
								

				if ($conn->connect_errno) {
				    printf("Conexión fallida: %s\n", $conn->connect_error);
				    exit();

				}else{
				
					if($id==""){
							
							$sql = "INSERT a_diagnostico(Cie10,Descripcion,IngresoEgreso,Tipo,cuenta)
							values('$cie10','$descri','$ingreso','$tipoAt','$cuenta')";
							$result = $conn->query($sql);
							echo"Datos guardados correctamente";

					}else{

						$sql = "UPDATE cabregistro SET nro_re='$nro_re',senores='$senores',email='$email',cliente='$cliente',moneda='$moneda',direccion='$direccion',obs='$obs',fe_re='$fe_re',total='$total',iduser='$iduser',boletos='$boletos' ,viajes='$viajes' ,nacionales='$nacionales' ,internacionales='$internacionales' WHERE id_re='$id' ";
						$result = $conn->query($sql);
						
					}
									
				}

						return $result;

				}


				
				function InsertCabCobranza($id,$nro_re,$senores,$direccion,$obs,$fe_re,$total,$email,$moneda,$iduser){

					$db = new Conectar();
					$conn = $db->conexion();
				

				if ($conn->connect_errno) {
				    printf("Conexión fallida: %s\n", $conn->connect_error);
				    exit();

				}else{


					if($id==""){

						$sql = "SELECT nro_re,senores,email,moneda,direccion,obs,fe_re,total,iduser FROM cabregistroCo WHERE nro_re='$nro_re'";
						$result = $conn->query($sql);
						
						if ($result->num_rows > 0) {

							$sql = "UPDATE cabregistroCo SET nro_re='$nro_re',senores='$senores',email='$email',moneda='$moneda',direccion='$direccion',obs='$obs',fe_re='$fe_re',total='$total',iduser='$iduser' WHERE nro_re='$nro_re'";
							$result = $conn->query($sql);
								
						}else{

							$sql = "INSERT cabregistroCo(nro_re,senores,email,moneda,direccion,obs,fe_re,total,iduser)values('$nro_re','$senores','$email','$moneda','$direccion','$obs','$fe_re','$total','$iduser')";
							$result = $conn->query($sql);
							
						}
						
						
					}else{

						$sql = "UPDATE cabregistroCo SET nro_re='$nro_re',senores='$senores',email='$email',cliente='$cliente',moneda='$moneda',direccion='$direccion',obs='$obs',fe_re='$fe_re',total='$total',iduser='$iduser' WHERE id_re='$id' ";
						$result = $conn->query($sql);
						
					}
									
				}

						return $result;

				}



				function InsertCabCotizacion($id,$nro_re,$senores,$direccion,$obs,$fe_re,$total,$email,$moneda,$iduser){

					$db = new Conectar();
					$conn = $db->conexion();
				

				if ($conn->connect_errno) {
				    printf("Conexión fallida: %s\n", $conn->connect_error);
				    exit();

				}else{


					if($id==""){

						$sql = "SELECT nro_re,senores,email,moneda,direccion,obs,fe_re,total,iduser FROM cabcotizacion WHERE nro_re='$nro_re'";
						$result = $conn->query($sql);
						
						if ($result->num_rows > 0) {

							$sql = "UPDATE cabcotizacion SET nro_re='$nro_re',senores='$senores',email='$email',moneda='$moneda',direccion='$direccion',obs='$obs',fe_re='$fe_re',total='$total',iduser='$iduser' WHERE nro_re='$nro_re'";
							$result = $conn->query($sql);
								
						}else{

							$sql = "INSERT cabcotizacion(nro_re,senores,email,moneda,direccion,obs,fe_re,total,iduser)values('$nro_re','$senores','$email','$moneda','$direccion','$obs','$fe_re','$total','$iduser')";
							$result = $conn->query($sql);
							
						}
						
						
					}else{

						$sql = "UPDATE cabcotizacion SET nro_re='$nro_re',senores='$senores',email='$email',cliente='$cliente',moneda='$moneda',direccion='$direccion',obs='$obs',fe_re='$fe_re',total='$total',iduser='$iduser' WHERE id_re='$id' ";
						$result = $conn->query($sql);
						
					}
									
				}

						return $result;

				}


				function InsertGuardar($nro_re,$total){

					$db = new Conectar();
					$conn = $db->conexion();
				

						if ($conn->connect_errno) {
						    printf("Conexión fallida: %s\n", $conn->connect_error);
						    exit();

						}else{


							$sql = "UPDATE cabregistro SET total='$total' WHERE nro_re='$nro_re' ";
							$result = $conn->query($sql);
											
						}

								return $result;

				}


				function VistasActual($nro){

					$db = new Conectar();
					$conn = $db->conexion();
				

						if ($conn->connect_errno) {
						    printf("Conexión fallida: %s\n", $conn->connect_error);
						    exit();

						}else{


							$sql = "UPDATE cabcotizacion SET visto='SI' WHERE nro_re='$nro' ";
							$result = $conn->query($sql);
											
						}

								return $result;

				}
	
				
				function EliminarCabregistros($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "DELETE FROM cabregistro WHERE id_re='$id'";
						$result = $conn->query($sql);				
					}

						return $result;
				}


				function EliminarDonantes($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "DELETE FROM donantes WHERE idDon='$id'";
						$result = $conn->query($sql);				
					}

						return $result;
				}
				
				
				function EliminarCabregistrosCo($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "DELETE FROM cabregistroCo WHERE id_re='$id'";
						$result = $conn->query($sql);				
					}

						return $result;
				}


				function EliminarCotiza($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "DELETE FROM cabcotizacion WHERE id_re='$id'";
						$result = $conn->query($sql);				
					}

						return $result;
				}


				function EliminarPaciente($cod){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "UPDATE registropacientes SET Estatus='ELIMINADO' WHERE NroPaciente='$cod'";
						$result = $conn->query($sql);				
					}

						return $result;
				}


				function EliminarEfec($cod){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "DELETE FROM donefectivos WHERE idDon='$cod'";
						$result = $conn->query($sql);				
					}

						return $result;
				}

				function Eliminarcotifilas($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "DELETE FROM listacotizacion WHERE id_li='$id'";
						$result = $conn->query($sql);				
					}

						return $result;
				}

				


				 function InsertFilas($idlis,$cantidad,$descri,$unit,$imp){

					$db = new Conectar();
					$conn = $db->conexion();
				

				if ($conn->connect_errno) {
				    printf("Conexión fallida: %s\n", $conn->connect_error);
				    exit();

				}else{

					$sql = "INSERT listaregistros(nro_re,cant,descripcion,pe_uni,importe)values('$idlis','$cantidad','$descri','$unit','$imp')";
					$result = $conn->query($sql);
									
				}

						return $result;

				}
				
			function InsertFilasCobranza($idlis,$cantidad,$descri,$unit,$imp){

					$db = new Conectar();
					$conn = $db->conexion();
				

				if ($conn->connect_errno) {
				    printf("Conexión fallida: %s\n", $conn->connect_error);
				    exit();

				}else{

					$sql = "INSERT listaregistrosCo(nro_re,cant,descripcion,pe_uni,importe)values('$idlis','$cantidad','$descri','$unit','$imp')";
					$result = $conn->query($sql);
									
				}

						return $result;

				}


			function InsertFilasCotizacion($idlis,$cantidad,$descri,$unit,$imp){

					$db = new Conectar();
					$conn = $db->conexion();
				

				if ($conn->connect_errno) {
				    printf("Conexión fallida: %s\n", $conn->connect_error);
				    exit();

				}else{

					$sql = "INSERT listacotizacion(nro_re,cant,descripcion,pe_uni,importe)values('$idlis','$cantidad','$descri','$unit','$imp')";
					$result = $conn->query($sql);
									
				}

						return $result;

				}




				function consultaReg($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT 	id_re,nro_re,senores,direccion,obs,fe_re,total,email,moneda,boletos,viajes,nacionales,internacionales FROM cabregistro WHERE id_re='$id'";
					$result = $conn->query($sql);				

					}

					return $result;

				}

				function consultaRegCotizacion($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT 	id_re,nro_re,senores,direccion,obs,fe_re,total,email,moneda,boletos,viajes,nacionales,internacionales FROM cabcotizacion WHERE id_re='$id'";
					$result = $conn->query($sql);				

					}

					return $result;

				}
				
				function consultaRegCobranza($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT 	id_re,nro_re,senores,direccion,obs,fe_re,total,email,moneda FROM cabregistroCo WHERE id_re='$id'";
					$result = $conn->query($sql);				

					}

					return $result;

				}

				function consultaItemsDiagnostico($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT * FROM a_diagnostico WHERE cuenta='$id' ORDER BY NroDiagnostico  DESC";
					$result = $conn->query($sql);				

					}

					return $result;

				}
				
				function consultaItemsCobranza($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT id_li,nro_re,cant,descripcion,pe_uni,importe FROM listaregistrosCo WHERE nro_re='$id' ORDER BY id_li DESC";
					$result = $conn->query($sql);				

					}

					return $result;

				}


				function consultaItemsCotizacionMos($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT id_li,nro_re,cant,descripcion,pe_uni,importe FROM listacotizacion WHERE nro_re='$id' ORDER BY id_li DESC";
					$result = $conn->query($sql);				

					}

					return $result;

				}
				
				

				function consulta(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT R.`NroPaciente`, R.`Ippress`,R.`FechaSolicitud`, R.`solimedico`, R.`TipoDocumento`, R.`NroDocumento`,
					 R.`TipoAfiliacion`, R.`NroAfiliacion`, D.departamento, R.`ApePaterno`, R.`ApeMaterno`, R.`Nombres`, R.`FechaNacimiento`, 
					 R.`Edad`, R.`Sexo`, R.`Diagnostico`, R.`Cie10`, R.`NroSolicitud`, R.`regimen`, R.`hclinica`, R.`TelefonoFamilia`, U.nom, 
					 R.`filesPre`, R.`fechaRegistro`, R.`dnimama`, R.`nombresMama`, R.`apeMama`, R.`dniPapa`, R.`nombresPapa`, R.`apePapa`, R.`correoSolicitud`,
					 R.`feiniciCobertura`, R.`docRespuesta`, R.`feAutoraizacion`, R.`cocobertura`, R.`coafiliado`, R.`observaciones` , R.`upss`
					  FROM `registropacientes` AS R 
					  INNER JOIN departamentos AS D ON R.Departamento= D.idDepartamento
					  INNER JOIN usuarios AS U ON R.usuario= U.id
					   WHERE R.Estatus='ACTIVO' ORDER BY R.NroPaciente DESC";
					$result = $conn->query($sql);				

					}

					return $result;
				}


				function consultaTipo($tipo){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT R.NroPaciente,R.Ippress,R.FechaSolicitudPac,R.condicion,R.FechaSolicitudPAC,R.TipoDocumento,
					R.NroDocumento,R.TipoAfiliacion,R.NroAfiliacion,R.Provincia,R.Distrito,R.TiempoTranscurrido,
					R.Direccion,R.ApePaterno,R.ApeMaterno,R.Nombres,R.FechaNacimiento,R.Edad,R.Sexo,R.Diagnostico,
					R.Cie10,R.TelefonoFamilia,R.DniPadre,R.DniMadre,D.departamento,R.NroSolicitud,R.filespre
					FROM registropacientes AS R
					INNER JOIN departamentos AS D ON R.departamento= D.idDepartamento
                    INNER JOIN pretrasplante AS P on R.NroPaciente = P.idPaciente WHERE P.`TipoTrasplante`='$tipo'  ORDER BY R.NroPaciente DESC";
					$result = $conn->query($sql);				

					}

					return $result;
				}



				function consultaUsuariosS(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT * FROM usuarios";
					$result = $conn->query($sql);				

					}

					return $result;
				}


				function consultaFiltrarData(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT R.NroPaciente,R.Ippress,R.FechaSolicitudPac,R.condicion,R.FechaSolicitudPAC,R.TipoDocumento,R.NroDocumento,R.TipoAfiliacion,R.NroAfiliacion,R.Provincia,R.Distrito,
					R.Direccion,R.ApePaterno,R.ApeMaterno,R.Nombres,R.FechaNacimiento,R.Edad,R.Sexo,R.Diagnostico,R.Cie10,R.TelefonoFamilia,R.DniPadre,R.DniMadre,D.departamento,R.NroSolicitud,
					R.TiempoTranscurrido 
					FROM registropacientes AS R INNER JOIN departamentos AS D ON R.departamento= D.idDepartamento";
					$result = $conn->query($sql);				

					}

					return $result;



				}
				
				function numeroRegistros(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT * FROM cabregistro";
					$result = $conn->query($sql);				

					}

					return $result;



				}
				
				function numeroRegistrosAsesor($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT * FROM cabregistro WHERE iduser='$id'";
					$result = $conn->query($sql);				

					}

					return $result;



				}

				function consultaCotizacion(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT C.id_re,C.nro_re,C.senores,C.direccion,C.obs,C.fe_re,C.total,C.moneda,U.user, C.visto
					FROM cabcotizacion AS C
					INNER JOIN usuarios AS U ON C.iduser= U.id";
					$result = $conn->query($sql);				

					}

					return $result;



				}
				
				function consultaCo(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT C.id_re,C.nro_re,C.senores,C.direccion,C.obs,C.fe_re,C.total,C.moneda,U.user FROM cabregistroCo AS C
					INNER JOIN usuarios AS U ON C.iduser= U.id";
					$result = $conn->query($sql);				

					}

					return $result;

				}
				
				function consultaUser($iduser){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT C.id_re,C.nro_re,C.senores,C.direccion,C.obs,C.fe_re,C.total,C.moneda,U.user
					FROM cabregistro AS C
					INNER JOIN usuarios AS U ON C.iduser= U.id WHERE C.iduser='$iduser'";
					$result = $conn->query($sql);				

					}

					
					return $result;

				}


				function consultaUserExport($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT R.NroPaciente, R.Ippress, R.FechaSolicitud,R.solimedico,R.TipoDocumento,R.NroDocumento,
					 R.TipoAfiliacion,R.NroAfiliacion,D.departamento,R.ApePaterno,R.ApeMaterno,R.Nombres,R.FechaNacimiento,
					 R.Edad,R.Sexo,R.Diagnostico,R.Cie10, R.NroSolicitud,R.regimen,R.hclinica,R.TelefonoFamilia, R.dnimama, 
					 R.nombresMama,R.apeMama,R.dniPapa,R.nombresPapa,R.apePapa,R.correoSolicitud,R.feiniciCobertura,R.docRespuesta,
					 R.feAutoraizacion,R.cocobertura,R.coafiliado,R.observaciones  FROM registropacientes AS R
					INNER JOIN departamentos AS D ON R.departamento= D.idDepartamento WHERE NroPaciente='$id'";
					$result = $conn->query($sql);				

					}

					
					return $result;

				}

				function consultaUserExportAll(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT R.NroPaciente, R.Ippress, R.FechaSolicitud,R.solimedico,R.TipoDocumento,R.NroDocumento,
					 R.TipoAfiliacion,R.NroAfiliacion,D.departamento,R.ApePaterno,R.ApeMaterno,R.Nombres,R.FechaNacimiento,
					 R.Edad,R.Sexo,R.Diagnostico,R.Cie10, R.NroSolicitud,R.regimen,R.hclinica,R.TelefonoFamilia, R.dnimama, 
					 R.nombresMama,R.apeMama,R.dniPapa,R.nombresPapa,R.apePapa,R.correoSolicitud,R.feiniciCobertura,R.docRespuesta,
					 R.feAutoraizacion,R.cocobertura,R.coafiliado,R.observaciones  FROM registropacientes AS R
					INNER JOIN departamentos AS D ON R.departamento= D.idDepartamento  WHERE R.Estatus='ACTIVO'";
					$result = $conn->query($sql);				

					}

					
					return $result;

				}


				function consultaUserExportPost($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT PT.oficioauto,PT.Fechaauto,R.NroSolicitud,PT.FechaTras,PT.LugarTras,
					PT.tipoTrasplantePost,PT.fechaviso,PT.oficioaviso,R.ApePaterno,R.ApeMaterno, R.Nombres FROM posttrasplante AS PT
					INNER JOIN registropacientes AS R ON PT.idPaciente= R.NroPaciente  
					WHERE idPaciente='$id'";

					$result = $conn->query($sql);				

					}

					
					return $result;

				}
				
				function consultaUserDon($iduser){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT * FROM donantes WHERE idPaciente='$iduser' ORDER BY idDon DESC";
					$result = $conn->query($sql);				

					}

					
					return $result;

				}

				function consultaUserEfec($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{


						$sqlNum = "SELECT D.idDon,R.dni,R.Nombres,R.Apellidos,R.edad,D.estado 
						FROM donefectivos AS D 
						INNER JOIN donantes AS R ON D.idDonante= R.idDon WHERE R.idPaciente='$id'";
						$resultNum = $conn->query($sqlNum);
						$fil = $resultNum->num_rows ;
						
						if($fil>0){

							$sql = "SELECT D.idDon,R.dni,R.Nombres,R.Apellidos,R.edad,D.estado 
							FROM donefectivos AS D 
							INNER JOIN donantes AS R ON D.idDonante= R.idDon WHERE R.idPaciente='$id'";
							$result = $conn->query($sql);	
						}else {
							$sql = "SELECT idDon,dni,edad,estado FROM donefectivos WHERE idPaciente='$id'";
							$result = $conn->query($sql);	
						}


					}

					
					return $result;

				}



				function consultaUserCotizacion($iduser){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT C.id_re,C.nro_re,C.senores,C.direccion,C.obs,C.fe_re,C.total,C.moneda,U.user, C.visto
					FROM cabcotizacion AS C
					INNER JOIN usuarios AS U ON C.iduser= U.id WHERE C.iduser='$iduser'";
					$result = $conn->query($sql);				

					}

					
					return $result;

				}				
				function consultaUserCobranza($iduser){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT id_re,nro_re,senores,direccion,obs,fe_re,total,moneda FROM cabregistroCo WHERE iduser='$iduser'";
					$result = $conn->query($sql);				

					}

					return $result;

				}
				
				function consultaXmesGrafico($mes,$anio){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT * FROM registropacientes WHERE MONTH(`fechaRegistro`) = $mes AND YEAR(`fechaRegistro`) = $anio";
					$result = $conn->query($sql);				

					}

					return $result;

				}



				function consultaComision(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT * FROM tb_comisiones";
					$result = $conn->query($sql);				

					}

					return $result;

				}

				function consultaFiltrar($id,$desde,$hasta){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT * FROM cabregistro WHERE iduser='$id' AND DATE(fe_re) BETWEEN '$desde' AND '$hasta'";
					$result = $conn->query($sql);				

					}

					return $result;

				}

				function consultaComisionBusc($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT * FROM tb_comisiones WHERE id_co='$id'";
					$result = $conn->query($sql);				

					}

					return $result;

				}

				function paginadorconsultaFiltrar($id,$desde,$hasta,$ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT * FROM cabregistro WHERE iduser='$id' AND DATE(fe_re) BETWEEN '$desde' AND '$hasta' LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}

						return $result;

				}

				function consultaComisionEdit($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT C.medio,C.id_prac,C.tipo_venta,C.cantidad,C.cliente,C.tipo_doc,C.documento,C.itinerario,C.tipo_ser,C.neto,
					C.full,C.apagar,C.pago_pax,C.ganancia,C.com_counter,C.mon_com_counter,C.incentivo,C.mont_total_co_sol,C.mont_total_co_dol,P.nom,P.ape
					FROM tb_comisiones AS C
					INNER JOIN practicantes AS P ON C.id_prac=P.id
					WHERE C.id_co='$id'";
					$result = $conn->query($sql);	


							

					}

					return $result;

				}


				function InsertComisiones($id,$medio,$id_prac,$tipo_venta,$cantidad,$cliente,$tipodoc,$nrodoc,$itinerario,$tiposer,
            					$neto,$full,$apagar,$pagopax,$ganancia,$comcou,$montcou,$incentivo,$montocountersol,$montocounterdol){

					$db = new Conectar();
					$conn = $db->conexion();


				if ($conn->connect_errno) {
				    printf("Conexión fallida: %s\n", $conn->connect_error);
				    exit();

				}else{

					if($id==""){
						
						$sql = "INSERT tb_comisiones(medio,id_prac,tipo_venta,cantidad,cliente,tipo_doc,documento,itinerario,tipo_ser,neto,full,apagar,pago_pax,ganancia,com_counter, mon_com_counter, incentivo, mont_total_co_sol, mont_total_co_dol)
								values('$medio','$id_prac','$tipo_venta','$cantidad','$cliente','$tipodoc','$nrodoc','$itinerario','$tiposer','$neto','$full','$apagar','$pagopax','$ganancia','$comcou','$montcou','$incentivo','$montocountersol','$montocounterdol')";
						$result = $conn->query($sql);
					}else{

							$sql = "UPDATE tb_comisiones SET id_prac='$id_prac',medio='$medio',tipo_venta='$tipo_venta',cantidad='$cantidad',cliente='$cliente',tipo_doc='$tipodoc',documento='$nrodoc',itinerario='$itinerario',tipo_ser='$tiposer',neto='$neto',full='$full',apagar='$apagar',pago_pax='$pagopax',ganancia='$ganancia',com_counter='$comcou',mon_com_counter='$montcou',incentivo='$incentivo',mont_total_co_sol='$montocountersol',mont_total_co_dol='$montocounterdol'
								 WHERE id_co='$id' ";
								$result = $conn->query($sql);
						
						
					}
									
				}

						return $result;

				}

			

				 function InsertNosotros($id,$no,$mi,$vi){

					$db = new Conectar();
					$conn = $db->conexion();
		

				if ($conn->connect_errno) {
				    printf("Conexión fallida: %s\n", $conn->connect_error);
				    exit();

				}else{

					$sql = "UPDATE nosotros SET nosotros='$no',mision='$mi',vision='$vi' WHERE id_no='$id' ";
							$result = $conn->query($sql);
									
					}

						return $result;

				}
				
				
				
				function folletos(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT id_fo,nombre,imagen,fecha FROM folletos ORDER BY id_fo DESC ";
					$result = $conn->query($sql);				

					}

					return $result;

				}

				function folletosEdit($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT id_fo,nombre,imagen,fecha FROM folletos WHERE id_fo='$id' ORDER BY id_fo DESC ";
					$result = $conn->query($sql);				

					}

					return $result;

				}


				

				function consultaPaq($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{
						
						
					$sql = "SELECT R.NroPaciente,R.Ippress,R.FechaSolicitudPac,R.condicion,R.FechaSolicitudPAC,R.TipoDocumento,R.NroDocumento,R.TipoAfiliacion,R.NroAfiliacion,R.Provincia,R.Distrito,
					R.Direccion,R.ApePaterno,R.ApeMaterno,R.Nombres,R.FechaNacimiento,R.Edad,R.Sexo,R.Diagnostico,R.Cie10,R.TelefonoFamilia,R.DniPadre,R.DniMadre,D.departamento,R.NroSolicitud
					FROM registropacientes AS R INNER JOIN departamentos AS D ON R.departamento= D.idDepartamento WHERE R.NroDocumento=$id ";
					$result = $conn->query($sql);				

					}

					return $result;

				}
				
				function EliminarRegistros($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "DELETE FROM listaregistros WHERE id_li='$id'";
						$result = $conn->query($sql);				
					}

						return $result;
				}

				function EliminarRegistrosCo($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "DELETE FROM listaregistrosCo WHERE id_li='$id'";
						$result = $conn->query($sql);				
					}

						return $result;
				}
				
				function EliminarComisiones($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "DELETE FROM tb_comisiones WHERE id_co='$id'";
						$result = $conn->query($sql);				
					}

						return $result;
				}
				
				
				function EliminarFilas($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "DELETE FROM listaregistros WHERE nro_re='$id'";
						$result = $conn->query($sql);				
					}

						return $result;
				}
				
				function EliminarFilasCo($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "DELETE FROM listaregistrosCo WHERE nro_re='$id'";
						$result = $conn->query($sql);				
					}

						return $result;
				}


				function EliminarFilasCotix($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "DELETE FROM listacotizacion WHERE nro_re='$id'";
						$result = $conn->query($sql);				
					}

						return $result;
				}


				function EquipamientoDetGeneral($ser,$ron){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("ConexiÃ³n fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT Z.zona, E.region, G.agencia, R.declara
								FROM  `registro_servicios` AS R
								INNER JOIN inicio AS A ON R.code = A.id_cod
								INNER JOIN zona AS Z ON A.zona = Z.id_zona
								INNER JOIN region AS E ON A.region = E.id_region
								INNER JOIN agencia AS G ON A.agencia = G.id_age
								WHERE A.ronda =  '$ron'
								AND R.ser =  '$ser'
								GROUP BY code";
						        $result = $conn->query($sql);				
					}

						return $result;

				}
				
				
				function EquipamientoDetEx($ex,$ron){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("ConexiÃ³n fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT Z.zona, E.region, G.agencia
								FROM  `registro_extras` AS R
								INNER JOIN inicio AS A ON R.code = A.id_cod
								INNER JOIN zona AS Z ON A.zona = Z.id_zona
								INNER JOIN region AS E ON A.region = E.id_region
								INNER JOIN agencia AS G ON A.agencia = G.id_age
								WHERE A.ronda =  '$ron'
								AND R.doc =  '$ex'
								GROUP BY code";
						        $result = $conn->query($sql);				
					}

						return $result;

				}
				
				function consultaExport($ron,$te){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.ronda, I.id_inicio, I.ronda, U.user, I.id_cod,I.estado, R.region, A.agencia, I.fecha, Z.zona,
					T.mant, T.log, T.serv, T.ext, T.techo, T.interna, T.mob, T.equipo, T.totales, IE.to1, IE.to2, IE.to3,
					IE.to4, IE.puntaje, IE.declara,IE.infra_ext
						FROM inicio AS I
						INNER JOIN usuarios AS U ON I.usuario = U.id
						INNER JOIN region AS R ON I.region = R.id_region
						INNER JOIN agencia AS A ON I.agencia = A.id_age
						INNER JOIN registrototales AS T ON I.id_cod = T.code
						INNER JOIN zona AS Z ON I.zona = Z.id_zona
						INNER JOIN registro_infra_ext AS IE ON I.id_cod = IE.code
						WHERE I.ronda =  '$ron'
						AND IE.infra_ext =  '$te'
						GROUP BY I.id_cod ORDER BY I.id_cod DESC  ";

						$result = $conn->query($sql);				
					}

						return $result;

				}
				

				function consultaExportDocMANT($ron,$te){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.ronda, I.id_inicio, I.ronda, U.user, I.id_cod, I.estado, R.region, A.agencia, I.fecha, Z.zona, T.mant, T.log, T.serv, T.ext, T.techo, T.interna, T.mob, T.equipo, T.totales, IE.to1, IE.to2, IE.to3, IE.to4, IE.puntaje, IE.declara
						FROM inicio AS I
						INNER JOIN usuarios AS U ON I.usuario = U.id
						INNER JOIN region AS R ON I.region = R.id_region
						INNER JOIN agencia AS A ON I.agencia = A.id_age
						INNER JOIN registrototales AS T ON I.id_cod = T.code
						INNER JOIN zona AS Z ON I.zona = Z.id_zona
						INNER JOIN registro_mantenimiento AS IE ON I.id_cod = IE.code
						WHERE I.ronda =  '$ron'
						AND IE.doc =  '$te'
						GROUP BY I.id_cod ORDER BY I.id_inicio DESC ";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function consultaExportLogi($ron,$te){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.ronda, I.id_inicio, I.ronda, U.user, I.id_cod, I.estado, R.region, A.agencia, I.fecha, Z.zona, T.mant, T.log, T.serv, T.ext, T.techo, T.interna, T.mob, T.equipo, T.totales, IE.to1, IE.to2, IE.to3, IE.to4, IE.puntaje, IE.declara
						FROM inicio AS I
						INNER JOIN usuarios AS U ON I.usuario = U.id
						INNER JOIN region AS R ON I.region = R.id_region
						INNER JOIN agencia AS A ON I.agencia = A.id_age
						INNER JOIN registrototales AS T ON I.id_cod = T.code
						INNER JOIN zona AS Z ON I.zona = Z.id_zona
						INNER JOIN registro_logistica AS IE ON I.id_cod = IE.code
						WHERE I.ronda =  '$ron'
						AND IE.logi =  '$te'
						GROUP BY I.id_cod ORDER BY I.id_inicio DESC ";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function consultaExportServi($ron,$te){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.ronda, I.id_inicio, I.ronda, U.user, I.id_cod, I.estado, R.region, A.agencia, I.fecha, Z.zona, T.mant, T.log, T.serv, T.ext, T.techo, T.interna, T.mob, T.equipo, T.totales, IE.to1, IE.to2, IE.to3, IE.to4, IE.puntaje, IE.declara
							FROM inicio AS I
							INNER JOIN usuarios AS U ON I.usuario = U.id
							INNER JOIN region AS R ON I.region = R.id_region
							INNER JOIN agencia AS A ON I.agencia = A.id_age
							INNER JOIN registrototales AS T ON I.id_cod = T.code
							INNER JOIN zona AS Z ON I.zona = Z.id_zona
							INNER JOIN registro_servicios AS IE ON I.id_cod = IE.code
							WHERE I.ronda =  '$ron'
							AND IE.ser =  '$te'
							GROUP BY I.id_cod ORDER BY I.id_inicio DESC  ";

						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				function consultaExrt($ron){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.ronda, I.id_inicio, I.ronda, U.user, I.id_cod,I.estado, R.region, A.agencia, I.fecha, 
					Z.zona, T.mant, T.log, T.serv, T.ext, T.techo, T.interna, T.mob, T.equipo, T.totales,I.direccion,I.jefe_banca,I.gerencia,I.personal
                    FROM inicio AS I 
                    INNER JOIN usuarios AS U ON I.usuario = U.id 
                    INNER JOIN region AS R ON I.region = R.id_region 
                    INNER JOIN agencia AS A ON I.agencia = A.id_age 
                    INNER JOIN registrototales AS T ON I.id_cod = T.code 
                    INNER JOIN zona AS Z ON I.zona = Z.id_zona 
                    WHERE I.ronda = '$ron' ORDER BY I.id_inicio DESC  ";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function consultaExportTecho($ron,$te){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.ronda, I.id_inicio, I.ronda, U.user, I.id_cod, I.estado, R.region, A.agencia, I.fecha, Z.zona, T.mant, T.log, T.serv, T.ext, T.techo, T.interna, T.mob, T.equipo, T.totales, IE.to1, IE.to2, IE.to3, IE.to4, IE.puntaje, IE.declara
							FROM inicio AS I
							INNER JOIN usuarios AS U ON I.usuario = U.id
							INNER JOIN region AS R ON I.region = R.id_region
							INNER JOIN agencia AS A ON I.agencia = A.id_age
							INNER JOIN registrototales AS T ON I.id_cod = T.code
							INNER JOIN zona AS Z ON I.zona = Z.id_zona
							INNER JOIN registro_techo AS IE ON I.id_cod = IE.code
							WHERE I.ronda =  '$ron'
							AND IE.techo =  '$te'
							GROUP BY I.id_cod ORDER BY I.id_inicio DESC  ";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function consultaExportMobili($ron,$te){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.ronda, I.id_inicio, I.ronda, U.user, I.id_cod, I.estado, R.region, A.agencia, I.fecha, Z.zona, T.mant, T.log, T.serv, T.ext, T.techo, T.interna, T.mob, T.equipo, T.totales, IE.to1, IE.to2, IE.to3, IE.to4, IE.puntaje, IE.declara
							FROM inicio AS I
							INNER JOIN usuarios AS U ON I.usuario = U.id
							INNER JOIN region AS R ON I.region = R.id_region
							INNER JOIN agencia AS A ON I.agencia = A.id_age
							INNER JOIN registrototales AS T ON I.id_cod = T.code
							INNER JOIN zona AS Z ON I.zona = Z.id_zona
							INNER JOIN registro_mobiliario AS IE ON I.id_cod = IE.code
							WHERE I.ronda =  '$ron'
							AND IE.mobi =  '$te'
							GROUP BY I.id_cod ORDER BY I.id_inicio DESC  ";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function consultaExportEquipo($ron,$te){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.ronda, I.id_inicio, I.ronda, U.user, I.id_cod, I.estado, R.region, A.agencia, I.fecha, Z.zona, T.mant, T.log, T.serv, T.ext, T.techo, T.interna, T.mob, T.equipo, T.totales, IE.to1, IE.to2, IE.to3, IE.to4, IE.puntaje, IE.declara
							FROM inicio AS I
							INNER JOIN usuarios AS U ON I.usuario = U.id
							INNER JOIN region AS R ON I.region = R.id_region
							INNER JOIN agencia AS A ON I.agencia = A.id_age
							INNER JOIN registrototales AS T ON I.id_cod = T.code
							INNER JOIN zona AS Z ON I.zona = Z.id_zona
							INNER JOIN registro_equipo AS IE ON I.id_cod = IE.code
							WHERE I.ronda =  '$ron'
							AND IE.eq =  '$te'
							GROUP BY I.id_cod ORDER BY I.id_inicio DESC  ";

						$result = $conn->query($sql);				
					}

						return $result;

				}
				
					function consultaExportInterna($ron,$te,$variable){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.ronda, I.id_inicio, I.ronda, U.user, I.id_cod, I.estado, R.region, A.agencia, I.fecha, Z.zona, T.mant, T.log, T.serv, T.ext, T.techo, T.interna, T.mob, T.equipo, T.totales, IE.to1, IE.to2, IE.to3, IE.to4, IE.puntaje, IE.declara
						FROM inicio AS I
						INNER JOIN usuarios AS U ON I.usuario = U.id
						INNER JOIN region AS R ON I.region = R.id_region
						INNER JOIN agencia AS A ON I.agencia = A.id_age
						INNER JOIN registrototales AS T ON I.id_cod = T.code
						INNER JOIN zona AS Z ON I.zona = Z.id_zona
						INNER JOIN registro_infra_int AS IE ON I.id_cod = IE.code
						WHERE I.ronda =  '$ron'
						AND IE.infra_int =  '$te'
						AND IE.variable =  '$variable'  
						GROUP BY I.id_cod ORDER BY I.id_inicio DESC";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function consultaExportInternaG($ron){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.id_inicio, I.ronda, U.user, I.id_cod, I.estado, R.region, A.agencia, I.fecha, Z.zona, T.mant, T.log, T.serv, T.ext, T.techo, T.interna, T.mob, T.equipo, T.totales, IE.to1, IE.to2, IE.to3, IE.to4, IE.puntaje, IE.declara
						FROM inicio AS I
						INNER JOIN usuarios AS U ON I.usuario = U.id
						INNER JOIN region AS R ON I.region = R.id_region
						INNER JOIN agencia AS A ON I.agencia = A.id_age
						INNER JOIN registrototales AS T ON I.id_cod = T.code
						INNER JOIN zona AS Z ON I.zona = Z.id_zona
						INNER JOIN registro_infra_int AS IE ON I.id_cod = IE.code
						WHERE I.ronda =  '$ron' 
						GROUP BY I.id_cod ORDER BY I.id_inicio DESC  ";

						$result = $conn->query($sql);				
					}

						return $result;

				}



				function consultaBuscador($agencia){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.estado,I.estado_chk,I.id_inicio ,I.ronda, U.user, I.id_cod, R.region, A.agencia, I.fecha, Z.zona, T.totales
					FROM inicio AS I
					INNER JOIN usuarios AS U ON I.usuario = U.id
					INNER JOIN region AS R ON I.region = R.id_region
					INNER JOIN agencia AS A ON I.agencia = A.id_age
					INNER JOIN registrototales AS T ON I.id_cod = T.code
					INNER JOIN zona AS Z ON I.zona = Z.id_zona WHERE A.agencia='$agencia'
					ORDER BY I.id_inicio DESC";

						$result = $conn->query($sql);				
					}

						return $result;

				}


				function consultaRonda($ronda){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.estado,I.estado_chk,I.id_inicio ,I.ronda, U.user, I.id_cod, R.region, A.agencia, I.fecha, Z.zona, T.totales
					FROM inicio AS I
					INNER JOIN usuarios AS U ON I.usuario = U.id
					INNER JOIN region AS R ON I.region = R.id_region
					INNER JOIN agencia AS A ON I.agencia = A.id_age
					INNER JOIN registrototales AS T ON I.id_cod = T.code
					INNER JOIN zona AS Z ON I.zona = Z.id_zona WHERE I.ronda='$ronda'
					ORDER BY I.id_inicio DESC";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function consultaRondax($ronda,$ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.estado,I.estado_chk,I.id_inicio , I.ronda,U.user, I.id_cod , R.region , A.agencia , I.fecha , Z.zona, T.totales
					FROM inicio AS I
					INNER JOIN usuarios AS U ON I.usuario = U.id
					INNER JOIN region AS R ON I.region = R.id_region
					INNER JOIN agencia AS A ON I.agencia = A.id_age
					INNER JOIN registrototales AS T ON I.id_cod = T.code
					INNER JOIN zona AS Z ON I.zona = Z.id_zona WHERE I.ronda='$ronda'
					ORDER BY I.id_inicio DESC LIMIT $ini,$final";

						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				function consultaBuscadorx($agencia,$ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.estado,I.estado_chk,I.id_inicio , I.ronda,U.user, I.id_cod , R.region , A.agencia , I.fecha , Z.zona, T.totales
					FROM inicio AS I
					INNER JOIN usuarios AS U ON I.usuario = U.id
					INNER JOIN region AS R ON I.region = R.id_region
					INNER JOIN agencia AS A ON I.agencia = A.id_age
					INNER JOIN registrototales AS T ON I.id_cod = T.code
					INNER JOIN zona AS Z ON I.zona = Z.id_zona WHERE A.agencia='$agencia'
					ORDER BY I.id_inicio DESC LIMIT $ini,$final";

						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				function consultaBuscadorusuario($usuario){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.estado,I.estado_chk,I.id_inicio ,I.ronda, U.user, I.id_cod, R.region, A.agencia, I.fecha, Z.zona, T.totales
					FROM inicio AS I
					INNER JOIN usuarios AS U ON I.usuario = U.id
					INNER JOIN region AS R ON I.region = R.id_region
					INNER JOIN agencia AS A ON I.agencia = A.id_age
					INNER JOIN registrototales AS T ON I.id_cod = T.code
					INNER JOIN zona AS Z ON I.zona = Z.id_zona WHERE U.id ='$usuario'
					ORDER BY I.id_inicio DESC";

						$result = $conn->query($sql);				
					}

						return $result;

				}
				

					function consultaBuscadorxusuario($usuario,$ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.estado,I.estado_chk,I.id_inicio ,I.ronda, U.user, I.id_cod , R.region , A.agencia , I.fecha , Z.zona, T.totales
					FROM inicio AS I
					INNER JOIN usuarios AS U ON I.usuario = U.id
					INNER JOIN region AS R ON I.region = R.id_region
					INNER JOIN agencia AS A ON I.agencia = A.id_age
					INNER JOIN registrototales AS T ON I.id_cod = T.code
					INNER JOIN zona AS Z ON I.zona = Z.id_zona WHERE U.id ='$usuario'
					ORDER BY I.id_inicio DESC LIMIT $ini,$final";

						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				function consultaBuscadorzona($agencia){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.estado,I.estado_chk,I.id_inicio ,I.ronda, U.user, I.id_cod, R.region, A.agencia, I.fecha, Z.zona, T.totales
					FROM inicio AS I
					INNER JOIN usuarios AS U ON I.usuario = U.id
					INNER JOIN region AS R ON I.region = R.id_region
					INNER JOIN agencia AS A ON I.agencia = A.id_age
					INNER JOIN registrototales AS T ON I.id_cod = T.code
					INNER JOIN zona AS Z ON I.zona = Z.id_zona WHERE Z.id_zona='$agencia'
					ORDER BY I.id_inicio DESC";

						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				function consultaBuscadorxzona($agencia,$ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.estado,I.estado_chk,I.id_inicio ,I.ronda, U.user, I.id_cod , R.region , A.agencia , I.fecha , Z.zona, T.totales
					FROM inicio AS I
					INNER JOIN usuarios AS U ON I.usuario = U.id
					INNER JOIN region AS R ON I.region = R.id_region
					INNER JOIN agencia AS A ON I.agencia = A.id_age
					INNER JOIN registrototales AS T ON I.id_cod = T.code
					INNER JOIN zona AS Z ON I.zona = Z.id_zona WHERE Z.id_zona='$agencia'
					ORDER BY I.id_inicio DESC LIMIT $ini,$final";

						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				
				function consultaBuscadorregion($agencia){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.estado,I.estado_chk,I.id_inicio ,I.ronda,U.user, I.id_cod, R.region, A.agencia, I.fecha, Z.zona, T.totales
					FROM inicio AS I
					INNER JOIN usuarios AS U ON I.usuario = U.id
					INNER JOIN region AS R ON I.region = R.id_region
					INNER JOIN agencia AS A ON I.agencia = A.id_age
					INNER JOIN registrototales AS T ON I.id_cod = T.code
					INNER JOIN zona AS Z ON I.zona = Z.id_zona WHERE R.id_region='$agencia'
					ORDER BY I.id_inicio DESC";

						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				function consultaBuscadorxregion($agencia,$ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT I.estado,I.estado_chk,I.id_inicio ,I.ronda, U.user, I.id_cod , R.region , A.agencia , I.fecha , Z.zona, T.totales
					FROM inicio AS I
					INNER JOIN usuarios AS U ON I.usuario = U.id
					INNER JOIN region AS R ON I.region = R.id_region
					INNER JOIN agencia AS A ON I.agencia = A.id_age
					INNER JOIN registrototales AS T ON I.id_cod = T.code
					INNER JOIN zona AS Z ON I.zona = Z.id_zona WHERE R.id_region='$agencia'
					ORDER BY I.id_inicio DESC LIMIT $ini,$final";

						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				
				function consultaAutocomplete(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT * from practicantes ORDER BY id ASC";
						$result = $conn->query($sql);				
					}

						return $result;

				}



				function consultaRegistro($id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT P.id_pa,P.nombre,P.tiempo,P.pre_dol,P.pre_sol,P.imagen,P.descripcion,P.itinerario,C.titulo,C.id_cat
					FROM paquetes AS P 
					INNER JOIN categorias AS C ON P.categoria=C.id_cat WHERE P.id_pa='$id'";
					$result = $conn->query($sql);				

					}

					return $result;

				}


				function consultaUltimo(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT * FROM cabregistro order by id_re DESC limit 1";
					$result = $conn->query($sql);				

					}

					return $result;

				}

				function consultaUltimoCotizacion(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT * FROM cabcotizacion order by id_re DESC limit 1";
					$result = $conn->query($sql);				

					}

					return $result;

				}

				function consultaUltimoCobranza(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

					$sql = "SELECT * FROM cabregistroCo order by id_re DESC limit 1";
					$result = $conn->query($sql);				

					}

					return $result;

				}
				
				
				function consultaAutocompleteCategorias(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT id_cat,titulo from categorias ORDER BY titulo ASC";
						$result = $conn->query($sql);				
					}

						return $result;

				}

				function consultaAgencia($code){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT I.id_inicio AS inicio, U.user, I.id_cod AS code, R.region AS re, A.agencia AS age, 
								I.fecha AS fe, Z.zona
								FROM inicio AS I
								INNER JOIN usuarios AS U ON I.usuario = U.id
								INNER JOIN region AS R ON I.region = R.id_region
								INNER JOIN agencia AS A ON I.agencia = A.id_age
								INNER JOIN zona AS Z ON I.zona = Z.id_zona
								WHERE I.id_cod =  '$code' LIMIT 0 , 30";

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

					$sql = "SELECT R.`NroPaciente`, R.`Ippress`,R.`FechaSolicitud`, R.`solimedico`, R.`TipoDocumento`, R.`NroDocumento`,
					R.`TipoAfiliacion`, R.`NroAfiliacion`, D.departamento, R.`ApePaterno`, R.`ApeMaterno`, R.`Nombres`, R.`FechaNacimiento`, 
					R.`Edad`, R.`Sexo`, R.`Diagnostico`, R.`Cie10`, R.`NroSolicitud`, R.`regimen`, R.`hclinica`, R.`TelefonoFamilia`, U.nom, 
					R.`filesPre`, R.`fechaRegistro`, R.`dnimama`, R.`nombresMama`, R.`apeMama`, R.`dniPapa`, R.`nombresPapa`, R.`apePapa`, R.`correoSolicitud`,
					R.`feiniciCobertura`, R.`docRespuesta`, R.`feAutoraizacion`, R.`cocobertura`, R.`coafiliado`, R.`observaciones` , R.`upss`
					 FROM `registropacientes` AS R 
					 INNER JOIN departamentos AS D ON R.Departamento= D.idDepartamento
					 INNER JOIN usuarios AS U ON R.usuario= U.id
					 WHERE R.Estatus='ACTIVO'	 ORDER BY R.NroPaciente DESC LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}
					
						return $result;

				}


				function paginadorTipoTras($tipo,$ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT R.NroPaciente,R.Ippress,R.FechaSolicitudPac,R.condicion,R.FechaSolicitudPAC,R.TipoDocumento,
					R.NroDocumento,R.TipoAfiliacion,R.NroAfiliacion,R.Provincia,R.Distrito,R.TiempoTranscurrido,
					R.Direccion,R.ApePaterno,R.ApeMaterno,R.Nombres,R.FechaNacimiento,R.Edad,R.Sexo,R.Diagnostico,
					R.Cie10,R.TelefonoFamilia,R.DniPadre,R.DniMadre,D.departamento,R.NroSolicitud,R.filespre
					FROM registropacientes AS R
					INNER JOIN departamentos AS D ON R.departamento= D.idDepartamento
                    INNER JOIN pretrasplante AS P on R.NroPaciente = P.idPaciente WHERE P.`TipoTrasplante`='$tipo' ORDER BY R.NroPaciente DESC LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}
					
						return $result;

				}

				function paginadorUsariosS($ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT * FROM usuarios ORDER BY id DESC LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}
					
						return $result;

				}

				function paginadorFiltrarData($ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT R.NroPaciente,R.Ippress,R.FechaSolicitudPac,R.condicion,R.FechaSolicitudPAC,R.TipoDocumento,R.NroDocumento,R.TipoAfiliacion,R.NroAfiliacion,R.Provincia,R.Distrito,
					R.Direccion,R.ApePaterno,R.ApeMaterno,R.Nombres,R.FechaNacimiento,R.Edad,R.Sexo,R.Diagnostico,R.Cie10,R.TelefonoFamilia,R.DniPadre,R.DniMadre,D.departamento,R.NroSolicitud,
					R.TiempoTranscurrido FROM registropacientes AS R INNER JOIN departamentos AS D ON R.departamento= D.idDepartamento ORDER BY R.NroPaciente DESC LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}
					
						return $result;

				}


				function paginadorPaq($id,$ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT R.NroPaciente,R.Ippress,R.FechaSolicitudPac,R.condicion,R.FechaSolicitudPAC,R.TipoDocumento,R.NroDocumento,R.TipoAfiliacion,R.NroAfiliacion,R.Provincia,R.Distrito,
					R.Direccion,R.ApePaterno,R.ApeMaterno,R.Nombres,R.FechaNacimiento,R.Edad,R.Sexo,R.Diagnostico,R.Cie10,R.TelefonoFamilia,R.DniPadre,R.DniMadre,D.departamento,R.NroSolicitud
					FROM registropacientes AS R INNER JOIN departamentos AS D ON R.departamento= D.idDepartamento WHERE R.NroDocumento=$id ORDER BY R.NroPaciente DESC LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}
				

						return $result;

				}

				function paginadorCotizacion($ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT C.id_re,C.nro_re,C.senores,C.direccion,C.obs,C.fe_re,C.total,C.moneda,U.user, C.visto
					FROM cabcotizacion AS C
					INNER JOIN usuarios AS U ON C.iduser= U.id ORDER BY C.id_re DESC LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}
					/*
									
					$sql = "SELECT C.id_re,C.nro_re,C.senores,C.direccion,C.obs,C.fe_re,C.total,C.moneda,U.user
					FROM cabregistro AS C
					INNER JOIN usuarios AS U ON C.iduser= U.id";
					*/

						return $result;

				}
				
				function paginadorCob($ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT C.id_re,C.nro_re,C.senores,C.direccion,C.obs,C.fe_re,C.total,C.moneda,U.user FROM cabregistroCo AS C
                        INNER JOIN usuarios AS U ON C.iduser= U.id ORDER BY id_re DESC LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}

						return $result;

				}
				
			function paginadorUsers($ini,$final,$iduser){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT C.id_re,C.nro_re,C.senores,C.direccion,C.obs,C.fe_re,C.total,C.moneda,U.user
					FROM cabregistro AS C
					INNER JOIN usuarios AS U ON C.iduser= U.id  WHERE C.iduser='$iduser' ORDER BY C.id_re DESC LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}
					
						return $result;

				}

				function paginadorUsersExport($ini,$final,$id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT R.NroPaciente,R.Ippress, R.FechaSolicitud, R.FechaSolicitudPAC, 
					R.TipoDocumento, R.NroDocumento,R.TipoAfiliacion,R.NroAfiliacion,D.departamento,
					R.ApePaterno,R.ApeMaterno, R.Nombres,R.Edad,R.Sexo,R.Diagnostico,R.Cie10,R.TelefonoFamilia, 
					R.DniPadre,R.DniMadre, P.TipoTrasplante,P.EmailEnvio,P.HistoriaClinica,
					P.FechaEnvio,R.FechaNacimiento
					FROM registropacientes AS R
					INNER JOIN pretrasplante AS P ON R.NroPaciente= P.idPaciente 
					INNER JOIN departamentos AS D ON D.idDepartamento= R.Departamento 
					WHERE R.NroPaciente='$id' LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}
					
						return $result;

				}


				function paginadorUsersExportPost($ini,$final,$id){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT R.NroPaciente,R.Ippress, R.FechaSolicitud, R.FechaSolicitudPAC, 
					R.TipoDocumento, R.NroDocumento,R.TipoAfiliacion,R.NroAfiliacion,D.departamento,
					R.ApePaterno,R.ApeMaterno, R.Nombres,R.Edad,R.Sexo,R.Diagnostico,R.Cie10,R.TelefonoFamilia, 
					R.DniPadre,R.DniMadre, P.TipoTrasplante,P.EmailEnvio,P.HistoriaClinica,
					P.FechaEnvio,R.FechaNacimiento
					FROM registropacientes AS R
					INNER JOIN pretrasplante AS P ON R.NroPaciente= P.idPaciente 
					INNER JOIN departamentos AS D ON D.idDepartamento= R.Departamento 
					WHERE R.NroPaciente='$id' LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}
					
						return $result;

				}



				function paginadorUsersDon($ini,$final,$iduser){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT * FROM donantes WHERE idPaciente='$iduser' ORDER BY idDon DESC LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}
					
						return $result;

				}

				function paginadorUsersCotizacion($ini,$final,$iduser){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT C.id_re,C.nro_re,C.senores,C.direccion,C.obs,C.fe_re,C.total,C.moneda,U.user,C.visto
					FROM cabcotizacion AS C
					INNER JOIN usuarios AS U ON C.iduser= U.id  WHERE C.iduser='$iduser' ORDER BY C.id_re DESC LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}
					/*
									
					$sql = "SELECT C.id_re,C.nro_re,C.senores,C.direccion,C.obs,C.fe_re,C.total,C.moneda,U.user
					FROM cabregistro AS C
					INNER JOIN usuarios AS U ON C.iduser= U.id";
					*/
						return $result;

				}
				
				function paginadorUsersCobranza($ini,$final,$iduser){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT id_re,nro_re,senores,direccion,obs,fe_re,total,moneda FROM cabregistroCo  WHERE iduser='$iduser' ORDER BY id_re DESC LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}

						return $result;

				}

				function paginadorCo($ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT * FROM tb_comisiones ORDER BY id_co DESC LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}

						return $result;

				}

				function paginadorComisionBus($id,$ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT * FROM tb_comisiones WHERE id_co='$id' ORDER BY id_co DESC LIMIT $ini,$final";
					$result = $conn->query($sql);				
					}

						return $result;

				}

				function paginadorExport($ini,$final,$ron){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

					$sql = "SELECT I.ronda, I.id_inicio, I.ronda, U.user, I.id_cod,I.estado, R.region, A.agencia, I.fecha, Z.zona, T.mant, T.log, T.serv, T.ext, T.techo, T.interna, T.mob, T.equipo, T.totales, IE.to1, IE.to2, IE.to3, IE.to4, IE.puntaje, IE.declara
						FROM inicio AS I
						INNER JOIN usuarios AS U ON I.usuario = U.id
						INNER JOIN region AS R ON I.region = R.id_region
						INNER JOIN agencia AS A ON I.agencia = A.id_age
						INNER JOIN registrototales AS T ON I.id_cod = T.code
						INNER JOIN zona AS Z ON I.zona = Z.id_zona
						INNER JOIN registro_infra_ext AS IE ON I.id_cod = IE.code
						WHERE I.ronda =  '$ron'
						AND IE.infra_ext =  '1'
						ORDER BY I.id_inicio DESC LIMIT $ini,$final";
						$result = $conn->query($sql);				
					}

						return $result;

				}

				function consultaLogistica(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT K.user,I.id_reg,U.titulo,I.code,I.declara,I.puntaje,I.piso,I.imagen,I.observacion,I.fecha
						FROM registro_logistica AS I 
						INNER JOIN lista_logistica AS U ON I.logi=U.id_log
						INNER JOIN inicio AS R ON I.code=R.id_cod
						INNER JOIN usuarios AS K ON R.usuario=K.id
						ORDER BY I.id_reg DESC LIMIT 0 , 30";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function paginadorLogi($ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

						$sql = "SELECT K.user,I.id_reg,U.titulo,I.code,I.declara,I.puntaje,I.piso,I.imagen,I.observacion,I.fecha
						FROM registro_logistica AS I 
						INNER JOIN lista_logistica AS U ON I.logi=U.id_log
						INNER JOIN inicio AS R ON I.code=R.id_cod
						INNER JOIN usuarios AS K ON R.usuario=K.id
						ORDER BY I.id_reg DESC LIMIT $ini,$final";
						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				
				function consultaLogisticaCon($buscar){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT K.user,I.id_reg,U.titulo,I.code,I.declara,I.puntaje,I.piso,I.imagen,I.observacion,I.fecha
						FROM registro_logistica AS I 
						INNER JOIN lista_logistica AS U ON I.logi=U.id_log
						INNER JOIN inicio AS R ON I.code=R.id_cod
						INNER JOIN usuarios AS K ON R.usuario=K.id WHERE I.CODE = '$buscar'
						ORDER BY I.id_reg DESC LIMIT 0 , 30";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function paginadorLogiCon($buscar,$ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

						$sql = "SELECT K.user,I.id_reg,U.titulo,I.code,I.declara,I.puntaje,I.piso,I.imagen,I.observacion,I.fecha
						FROM registro_logistica AS I 
						INNER JOIN lista_logistica AS U ON I.logi=U.id_log
						INNER JOIN inicio AS R ON I.code=R.id_cod
						INNER JOIN usuarios AS K ON R.usuario=K.id WHERE I.CODE = '$buscar'
						ORDER BY I.id_reg DESC LIMIT $ini,$final";
						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				function consultaMante(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT K.user, I.id_reg, U.titulo, I.code, I.declara, I.fecha
						FROM registro_mantenimiento AS I
						INNER JOIN doc_mante_periodico AS U ON I.doc = U.id_doc
						INNER JOIN inicio AS R ON I.code = R.id_cod
						INNER JOIN usuarios AS K ON R.usuario = K.id
						ORDER BY I.id_reg DESC 
						LIMIT 0 , 30";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function paginadorMante($ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

						$sql = "SELECT K.user, I.id_reg, U.titulo, I.code, I.declara, I.fecha
						FROM registro_mantenimiento AS I
						INNER JOIN doc_mante_periodico AS U ON I.doc = U.id_doc
						INNER JOIN inicio AS R ON I.code = R.id_cod
						INNER JOIN usuarios AS K ON R.usuario = K.id
						ORDER BY I.id_reg DESC LIMIT $ini,$final";
						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				
				
				function consultaManteCon($buscar){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT K.user, I.id_reg, U.titulo, I.code, I.declara, I.fecha
						FROM registro_mantenimiento AS I
						INNER JOIN doc_mante_periodico AS U ON I.doc = U.id_doc
						INNER JOIN inicio AS R ON I.code = R.id_cod
						INNER JOIN usuarios AS K ON R.usuario = K.id WHERE I.code ='$buscar'
						ORDER BY I.id_reg DESC 
						LIMIT 0 , 30";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function paginadorManteCon($buscar,$ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

						$sql = "SELECT K.user, I.id_reg, U.titulo, I.code, I.declara, I.fecha
						FROM registro_mantenimiento AS I
						INNER JOIN doc_mante_periodico AS U ON I.doc = U.id_doc
						INNER JOIN inicio AS R ON I.code = R.id_cod
						INNER JOIN usuarios AS K ON R.usuario = K.id WHERE I.code ='$buscar'
						ORDER BY I.id_reg DESC LIMIT $ini,$final";
						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				
				
				function consultaServicios(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT K.user, I.id_ser, U.titulo, I.code, I.declara, I.puntaje, I.piso, I.imagen, I.observacion, I.fecha
							FROM registro_servicios AS I
							INNER JOIN lista_servicios AS U ON I.ser = U.id_ser
							INNER JOIN inicio AS R ON I.code = R.id_cod
							INNER JOIN usuarios AS K ON R.usuario = K.id
							ORDER BY I.id_ser DESC 
							LIMIT 0 , 30";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function paginadorServicios($ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

						$sql = "SELECT K.user, I.id_ser, U.titulo, I.code, I.declara, I.puntaje, I.piso, I.imagen, I.observacion, I.fecha
							FROM registro_servicios AS I
							INNER JOIN lista_servicios AS U ON I.ser = U.id_ser
							INNER JOIN inicio AS R ON I.code = R.id_cod
							INNER JOIN usuarios AS K ON R.usuario = K.id
							ORDER BY I.id_ser DESC LIMIT $ini,$final";
						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				function consultaServiciosCon($buscar){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT K.user, I.id_ser, U.titulo, I.code, I.declara, I.puntaje, I.piso, I.imagen, I.observacion, I.fecha
							FROM registro_servicios AS I
							INNER JOIN lista_servicios AS U ON I.ser = U.id_ser
							INNER JOIN inicio AS R ON I.code = R.id_cod
							INNER JOIN usuarios AS K ON R.usuario = K.id WHERE I.code='$buscar'
							ORDER BY I.id_ser DESC 
							LIMIT 0 , 30";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function paginadorServiciosCon($buscar,$ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

						$sql = "SELECT K.user, I.id_ser, U.titulo, I.code, I.declara, I.puntaje, I.piso, I.imagen, I.observacion, I.fecha
							FROM registro_servicios AS I
							INNER JOIN lista_servicios AS U ON I.ser = U.id_ser
							INNER JOIN inicio AS R ON I.code = R.id_cod
							INNER JOIN usuarios AS K ON R.usuario = K.id WHERE I.code='$buscar'
							ORDER BY I.id_ser DESC LIMIT $ini,$final";
						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				
				function consultaExterna(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT K.user, I.id_inext, U.titulo, I.code, I.declara, I.puntaje, I.piso, I.imagen, I.observacion, I.fecha
							FROM registro_infra_ext AS I
							INNER JOIN lista_infra_externa AS U ON I.infra_ext = U.id_inex
							INNER JOIN inicio AS R ON I.code = R.id_cod
							INNER JOIN usuarios AS K ON R.usuario = K.id
							ORDER BY I.id_inext DESC  
							LIMIT 0 , 30";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function paginadorExterna($ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

						$sql = "SELECT K.user, I.id_inext, U.titulo, I.code, I.declara, I.puntaje, I.piso, I.imagen, I.observacion, I.fecha
							FROM registro_infra_ext AS I
							INNER JOIN lista_infra_externa AS U ON I.infra_ext = U.id_inex
							INNER JOIN inicio AS R ON I.code = R.id_cod
							INNER JOIN usuarios AS K ON R.usuario = K.id
							ORDER BY I.id_inext DESC LIMIT $ini,$final";
						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				
				function consultaExternaCon($buscar){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT K.user, I.id_inext, U.titulo, I.code, I.declara, I.puntaje, I.piso, I.imagen, I.observacion, I.fecha
							FROM registro_infra_ext AS I
							INNER JOIN lista_infra_externa AS U ON I.infra_ext = U.id_inex
							INNER JOIN inicio AS R ON I.code = R.id_cod
							INNER JOIN usuarios AS K ON R.usuario = K.id WHERE I.code='$buscar'
							ORDER BY I.id_inext DESC  
							LIMIT 0 , 30";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function paginadorExternaCon($buscar,$ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

						$sql = "SELECT K.user, I.id_inext, U.titulo, I.code, I.declara, I.puntaje, I.piso, I.imagen, I.observacion, I.fecha
							FROM registro_infra_ext AS I
							INNER JOIN lista_infra_externa AS U ON I.infra_ext = U.id_inex
							INNER JOIN inicio AS R ON I.code = R.id_cod
							INNER JOIN usuarios AS K ON R.usuario = K.id WHERE I.code='$buscar'
							ORDER BY I.id_inext DESC LIMIT $ini,$final";
						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				
				function consultaTecho(){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT K.user, I.id_te, U.titulo, I.code, I.declara, I.puntaje, I.piso, I.imagen, I.observacion, I.fecha
						FROM registro_techo AS I
						INNER JOIN lista_techo AS U ON I.techo = U.id_te
						INNER JOIN inicio AS R ON I.code = R.id_cod
						INNER JOIN usuarios AS K ON R.usuario = K.id
						ORDER BY I.id_te DESC   
							LIMIT 0 , 30";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				function paginadorTecho($ini,$final){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();
					}else{

						$sql = "SELECT K.user, I.id_te, U.titulo, I.code, I.declara, I.puntaje, I.piso, I.imagen, I.observacion, I.fecha
						FROM registro_techo AS I
						INNER JOIN lista_techo AS U ON I.techo = U.id_te
						INNER JOIN inicio AS R ON I.code = R.id_cod
						INNER JOIN usuarios AS K ON R.usuario = K.id
						ORDER BY I.id_te DESC LIMIT $ini,$final";
						$result = $conn->query($sql);				
					}

						return $result;

				}
				
				
				function consultaTechoCon($buscar){

					$db = new Conectar();
					$conn = $db->conexion();		

					if ($conn->connect_errno) {
					    printf("Conexión fallida: %s\n", $conn->connect_error);
					    exit();

					}else{

						$sql = "SELECT K.user, I.id_te, U.titulo, I.code, I.declara, I.puntaje, I.piso, I.imagen, I.observacion, I.fecha
						FROM registro_techo AS I
						INNER JOIN lista_techo AS U ON I.techo = U.id_te
						INNER JOIN inicio AS R ON I.code = R.id_cod
						INNER JOIN usuarios AS K ON R.usuario = K.id WHERE I.code='$buscar'
						ORDER BY I.id_te DESC   
							LIMIT 0 , 30";

						$result = $conn->query($sql);				
					}

						return $result;

				}

				
				
				

				function urls_amigables($url) {
				 
				      $url = strtolower($url); 
				      $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ'); 
				      $repl = array('a', 'e', 'i', 'o', 'u', 'n'); 
				      $url = str_replace ($find, $repl, $url); 
				      $find = array(' ', '&', '\r\n', '\n', '+');
				      $url = str_replace ($find, '-', $url);
				      $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/'); 
				      $repl = array('', '-', ''); 
				      $url = preg_replace ($find, $repl, $url);				 
				      return $url;
				 
				}


			
			
			
			

			

}


?>