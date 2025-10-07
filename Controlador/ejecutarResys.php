<?php 
include_once 'controllerResys.php';
	$resultado=false;
	$mensaje='';
	$datos=null;
	if(isset($_GET["opcionResys"]))
		switch($_GET["opcionResys"])
		{
			case 1:
				if(isset($_GET["IdCuentaAtencion"]))
				{
					$ObtenerDatosCuenta=ObtenerDatosCuenta($_GET["IdCuentaAtencion"]);
					if($ObtenerDatosCuenta["resultado"])
					{
						$datos=$ObtenerDatosCuenta["datos"];
						$resultado=true;
					}
					else
						$mensaje=$ObtenerDatosCuenta["mensaje"];
				}			
				else
					$mensaje="No se Ingreso parametro IdCuentaAtencion";
				break;
			case 2:
				if(isset($_GET["IdOrden"]))
				{
					$InsertarRegistroPatologiaOrden=InsertarRegistroPatologiaOrden($_GET["IdOrden"]);
					if($InsertarRegistroPatologiaOrden["resultado"])
					{
						$datos=$InsertarRegistroPatologiaOrden["datos"];
						$resultado=true;
					}
					else
						$mensaje=$InsertarRegistroPatologiaOrden["mensaje"];
				}			
				else
					$mensaje="No se Ingreso parametro IdCuentaAtencion";
				break;
			case 3:
				$MigrarUsuarios=MigrarUsuarios();
				if($MigrarUsuarios["resultado"])
				{
					$datos=$MigrarUsuarios["datos"];
					$resultado=true;
				}
				else
					$mensaje=$MigrarUsuarios["mensaje"];
				break;
				case 4:
					if(isset($_GET["nroDocumento"])){
						$ObtenerDatosCuentaxOrden=ObtenerDatosCuentaXReceta($_GET["nroSerie"],$_GET["nroDocumento"]);
							if($ObtenerDatosCuentaxOrden["resultado"])
								{
									$datos=$ObtenerDatosCuentaxOrden["datos"];
									$resultado=true;
								}
								else
									$mensaje=$ObtenerDatosCuentaxOrden["mensaje"];

							}else
								
							$mensaje="No se Ingreso parametro Receta";
					break;
				case 5:
						if(isset($_GET["IdEmpleado"])){
							$ObtenerDatosMedicos=buscarDatosMedicoVinculado($_GET["IdEmpleado"]);
								if($ObtenerDatosMedicos["resultado"])
									{
										$datos=$ObtenerDatosMedicos["datos"];
										$resultado=true;
									}
									else
										$mensaje=$ObtenerDatosMedicos["mensaje"];
	
						}else
							$mensaje="No se Ingreso parametro RNE";
							
					break;
					case 6:
						// var_dump($_GET);
								$IdCuentaAtencion=  intval($_GET["IdCuenta"]);
								$IdPuntoCarga= 3;
								$idPersonaTomaLab=  intval($_GET["IdPersonaTomaLab"]);
								$idPersonaRecoge= 	intval($_GET["IdPersonaTomaLab"]);
								$OrdenaPrueba=      $_GET["MediOrdena"];
								$IdMedico=     			intval( $_GET["IdMedico"]);
								$idProductoCPT=     intval($_GET["idProductoCPT"]);
								$idProductoCPT2=     intval($_GET["idProductoCPT2"]);
								$IdOrden =          intval($_GET["IdOrden"]);
								$NroOrdenReceta =   intval($_GET["NroOrdenReceta"]);
								$Fecha=             date('Ymd H:i:s'); // ($_GET["Fecha"]) date('Ymd H:i:s');
								$IdUsuario=         intval($_GET["IdUsuario"]);
								$IdservicioEgreso=    intval($_GET["IdservicioEgreso"]);
								$CantidadProce =      intval($_GET["CantidadProce"]);
								$IdtipoFinanciamiento =      intval($_GET["IdtipoFinanciamiento"]);


								$elemmentos=[ 
									"IdCuentaAtencion" => $IdCuentaAtencion,
									"IdPuntoCarga" =>$IdPuntoCarga,
									"idPersonaTomaLab" =>$idPersonaTomaLab,
									"idPersonaRecoge" => $idPersonaRecoge,
									"OrdenaPrueba" => $OrdenaPrueba,
									"IdMedico"=>$IdMedico,
									"idProductoCPT" =>$idProductoCPT,
									"idProductoCPT2" =>$idProductoCPT2,
									"IDORDENParam" => $IdOrden,
									"NroOrdenReceta" => $NroOrdenReceta,
									"Fecha" => $Fecha,
									"IdUsuario" => $IdUsuario,
									"IdservicioEgreso" => $IdservicioEgreso,
									"CantidadProce" => $CantidadProce,
									"IdtipoFinanciamientoParam" => $IdtipoFinanciamiento


								];
								 //var_dump($elemmentos);
								  //echo exit();

								$CreaMovimientoLaboratorio=CreaMovimientoLaboratorio($elemmentos);
								if($CreaMovimientoLaboratorio["resultado"])
								{
									$datos=$CreaMovimientoLaboratorio["datos"];
									$resultado=true;
								}
								else
									$mensaje=$CreaMovimientoLaboratorio["mensaje"];
									
					break;
					case 7:
							$IdCuentaAtencion=$_GET["IdCuentaAtencion"];


							// $url_produccion="https://app.hospitalloayza.gob.pe";
							$url_produccion="http://resys.hloayza.local";

							// $url_resysLocal = "http://202.15.1.29:8000/";
							 //$url_resysLocal = "http://127.0.0.1:8000/"; // 128
							//$url_produccion="https://app.hospitalloayza.gob.pe";
							$usuario='mlimache';
							$clave='123456';
							$ObtenerFua=ObtenerFua($url_produccion,$usuario,$clave,$IdCuentaAtencion);
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

					break;
					case 8:
						
						if(isset($_GET["IdCuentaAtencion"])){
							$verificarPagos=validarPagosPendientes($_GET["IdCuentaAtencion"],$_GET["IdNumeroMovimiento"]);
								if($verificarPagos["resultado"])
									{
										$datos=$verificarPagos["datos"];
										$resultado=true;
									}
									else
										$mensaje=$verificarPagos["mensaje"];
	
								}else
									
								$mensaje="No se Ingreso parametro Receta";
									
					break;

					case 9:
						
						if(isset($_GET["NroOrdenReceta"])){
							$ObtenerDatosxOrdenReceta=ObtenerDatosxOrdenReceta($_GET["NroOrdenReceta"]);
								if($ObtenerDatosxOrdenReceta["resultado"])
									{
										$datos=$ObtenerDatosxOrdenReceta["datos"];
										$resultado=true;
									}
									else
										$mensaje=$ObtenerDatosxOrdenReceta["mensaje"];
	
								}else
									
								$mensaje="No se Ingreso parametro Receta";
									
					break;

					case 10:
						
							$NumMovimiento=  intval($_GET["NumMovimiento"]);
							$Orden=  intval($_GET["Orden"]);
							$IdCuentaAtencion=  intval($_GET["IdCuentaAtencion"]);
								


							$elemmentos=[ 
							"NumMovimiento" => $NumMovimiento,
							"Orden" => $Orden,
							"IdCuentaAtencion" => $IdCuentaAtencion,
							];
								 //var_dump($elemmentos);
								 //echo exit();

								$actualizaFacturacion=resys_Ap_ActualizarFacturacion($elemmentos);
								if($actualizaFacturacion["resultado"])
								{
									$datos=$actualizaFacturacion["datos"];
									$resultado=true;
								}
								else
									$mensaje=$actualizaFacturacion["mensaje"];
									
					break;
					case 11:
						
						$IdCuentaAtencion=  intval($_GET["IdCuentaAtencion"]);
						$NumMovimiento=  intval($_GET["NumMovimiento"]);
						$NroOrdenMovimiento=  intval($_GET["NroOrdenMovimiento"]);
						$CantidadProce=  intval($_GET["CantidadProce"]);
						$IdProducto=  intval($_GET["ProceEncontrado"]);
						$MedicoAuditor=  intval($_GET["MedicoAuditor"]);
							


						$elemmentos=[ 
						"IdCuentaAtencion" => $IdCuentaAtencion,
						"NumMovimiento" => $NumMovimiento,
						"NroOrdenMovimiento" => $NroOrdenMovimiento,
						"CantidadProce" => $CantidadProce,
						"IdProducto" => $IdProducto,
						"MedicoAuditor"=> $MedicoAuditor
						];
							//  var_dump($elemmentos);
							//  echo exit();

							$actualizaProcedimiento=resys_actualiza_procedAP_enGalenos($elemmentos);
							if($actualizaProcedimiento["resultado"])
							{
								$datos=$actualizaProcedimiento["datos"];
								$resultado=true;
							}
							else
								$mensaje=$actualizaProcedimiento["mensaje"];
								
				break;
				case 12:
					
						
					$IdCuentaAtencion=  intval($_GET["IdCuentaAtencion"]);
					$IdNumMovimiento=  intval($_GET["IdNumMovimiento"]);
					
						


					$elemmentos=[ 
					"IdCuentaAtencion" => $IdCuentaAtencion,
					"IdNumMovimiento" => $IdNumMovimiento,
					
					];
						//  var_dump($elemmentos);
						//  echo exit();

						$actualizaProcedimiento=resys_elimina_registroAP_enGalenos($elemmentos);
						if($actualizaProcedimiento["resultado"])
						{
							$datos=$actualizaProcedimiento["datos"];
							$resultado=true;
						}
						else
							$mensaje=$actualizaProcedimiento["mensaje"];
							
			break;
			case 13:
				// var_dump($_GET);
						$IdCuentaAtencion=  intval($_GET["IdCuenta"]);
						$IdPuntoCarga= 3;
						$idPersonaTomaLab=  intval($_GET["IdPersonaTomaLab"]);
						$idPersonaRecoge= 	intval($_GET["IdPersonaTomaLab"]);
						$OrdenaPrueba=      $_GET["MediOrdena"];
						$IdMedico=     			intval( $_GET["IdMedico"]);
						$idProductoCPT=     intval($_GET["idProductoCPT"]);
						$idProductoCPT2=     intval($_GET["idProductoCPT2"]);
						$CantidadProced2=     intval($_GET["CantidadProced2"]);
						$IdOrden =          intval($_GET["IdOrden"]);
						$NroOrdenReceta =   intval($_GET["NroOrdenReceta"]);
						$Fecha=             date('Ymd H:i:s'); 
						$IdUsuario=         intval($_GET["IdUsuario"]);
						$IdservicioEgreso=    intval($_GET["IdservicioEgreso"]);
						$CantidadProce =      intval($_GET["CantidadProce"]);
						$IdtipoFinanciamiento =      intval($_GET["IdtipoFinanciamiento"]);
						$IdMovimiento =      intval($_GET["IdMovimiento"]);
						$NroOrdenMovimiento =      intval($_GET["NroOrdenMovimiento"]);




						$elemmentos=[ 
							"IdCuentaAtencion" => $IdCuentaAtencion,
							"IdPuntoCarga" =>$IdPuntoCarga,
							"idPersonaTomaLab" =>$idPersonaTomaLab,
							"idPersonaRecoge" => $idPersonaRecoge,
							"OrdenaPrueba" => $OrdenaPrueba,
							"IdMedico"=>$IdMedico,
							"idProductoCPT" =>$idProductoCPT,
							"idProductoCPT2" =>$idProductoCPT2,
							"CantidadProced2" =>$CantidadProced2,
							"IDORDENParam" => $IdOrden,
							"NroOrdenReceta" => $NroOrdenReceta,
							"Fecha" => $Fecha,
							"IdUsuario" => $IdUsuario,
							"IdservicioEgreso" => $IdservicioEgreso,
							"CantidadProce" => $CantidadProce,
							"IdtipoFinanciamientoParam" => $IdtipoFinanciamiento,
							"IdMovimientGenerado"=>$IdMovimiento,
							"NroOrdenMovimiento" =>$NroOrdenMovimiento


						];
						//   var_dump($elemmentos);
						//   echo exit();

						$CreaMovimientoLaboratorio=ActualizaMovimientoLaboratorio($elemmentos);
						if($CreaMovimientoLaboratorio["resultado"])
						{
							$datos=$CreaMovimientoLaboratorio["datos"];
							$resultado=true;
						}
						else
							$mensaje=$CreaMovimientoLaboratorio["mensaje"];
							
			break;
			case 14:
				if(isset($_GET["IdCuentaAtencion"]))
				{
					$ObtenerDatosCuenta=ObtenerDatosFUA($_GET["IdCuentaAtencion"]);
					if($ObtenerDatosCuenta["resultado"])
					{
						$datos=$ObtenerDatosCuenta["datos"];
						$resultado=true;
					}
					else
						$mensaje=$ObtenerDatosCuenta["mensaje"];
				}			
				else
					$mensaje="No se Ingreso parametro IdCuentaAtencion";
				break;
			

				case 20:
					include_once 'conexion.php';
					$conn = Conectar::conexion(); // conexión MySQLi
				
					// Capturar parámetros
					$IdCuentaAtencion   = $_REQUEST['IdCuentaAtencion'] ?? null;
					$NroOrdenMovimiento = $_REQUEST['NroOrdenMovimiento'] ?? null; // del JS
					$IdNumMovimiento    = $_REQUEST['IdNumMovimiento'] ?? null;    // del JS
					$procedimiento      = $_REQUEST['procedimiento'] ?? null;
				
					try {
						// Validar parámetros
						$faltantes = [];
						if (!$IdCuentaAtencion)   $faltantes[] = 'IdCuentaAtencion';
						if (!$NroOrdenMovimiento) $faltantes[] = 'NroOrdenMovimiento';
						if (!$IdNumMovimiento)    $faltantes[] = 'IdNumMovimiento';
						if (!$procedimiento)      $faltantes[] = 'procedimiento';
				
						if (!empty($faltantes)) {
							throw new Exception("Faltan parámetros requeridos: " . implode(", ", $faltantes));
						}
				
						// --- 1) Obtener el último idPato de la cuenta ---
						$sqlGetPato = "SELECT idPato 
									   FROM tbl_registroPacientesPatologia 
									   WHERE IdCuentaAtencion = ? 
									   ORDER BY idPato ASC LIMIT 1";
						$stmtPato = $conn->prepare($sqlGetPato);
						if (!$stmtPato) throw new Exception("Error al preparar sqlGetPato: " . $conn->error);
						$stmtPato->bind_param("i", $IdCuentaAtencion);
						$stmtPato->execute();
						$resultPato = $stmtPato->get_result();
				
						if ($resultPato->num_rows == 0) {
							throw new Exception("No se encontró idPato para IdCuentaAtencion");
						}
				
						$rowPato = $resultPato->fetch_assoc();
						$idPato = $rowPato['idPato'];
				
						// --- 2) Insertar en tbl_apoyo_inmunohistoquimica ---
						$sqlInsert = "INSERT INTO tbl_apoyo_inmunohistoquimica 
									  (IdCuentaAtencion, idPato, NroOrdenMovimiento, IdNumMovimiento, procedimiento, fechaRegistro)
									  VALUES (?, ?, ?, ?, ?, NOW())";
						$stmtInsert = $conn->prepare($sqlInsert);
						if (!$stmtInsert) throw new Exception("Error al preparar sqlInsert: " . $conn->error);
						$stmtInsert->bind_param("iiiii", $IdCuentaAtencion, $idPato, $NroOrdenMovimiento, $IdNumMovimiento, $procedimiento);
						$stmtInsert->execute();
				
						$resultado = true;
						$mensaje   = "Registro guardado en tbl_apoyo_inmunohistoquimica";
						$datos     = [
							"IdCuentaAtencion"   => $IdCuentaAtencion,
							"NroOrdenMovimiento" => $NroOrdenMovimiento,
							"IdNumMovimiento"    => $IdNumMovimiento,
							"idPato"             => $idPato,
							"procedimiento"      => $procedimiento
						];
				
					} catch (Exception $e) {
						$resultado = false;
						$mensaje   = "Error en case 20: " . $e->getMessage();
						$datos     = null;
						error_log($mensaje);
					}
				
					break;
				}
				
				echo json_encode(["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos]);