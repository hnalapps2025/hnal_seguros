<?php
include_once ('../config.php');
include (CONTROLLER_PATH."/conexion.php");
include (MODEL_PATH."/global.php");


//error_reporting(0);
$function = $_GET['function'];
session_start();
$idEditar= $_SESSION['permisoEditarPato'] ?? null;

$conn = new PDO("mysql:host=".DB_SERVER.";charset=utf8;port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


function normaliza($cadena){
    $originales =  'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiionoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtoupper($cadena);
    return utf8_encode($cadena);
}


function asignarAuditor($fecha){

	$db = new Conectar();
	$conn = $db->conexion();		

	if ($conn->connect_errno) {
		printf("Conexión fallida: %s\n", $conn->connect_error);
		exit();

	}else{
	
		$sql = "SELECT IF ('$fecha' BETWEEN E.start AND date_format(date_add(E.end, INTERVAL -1 DAY), '%Y/%m/%d'), 'si','no') AS respuesta, U.user  AS auditor 
		FROM events AS E 
		INNER JOIN usuarios AS U ON E.title=U.id
		WHERE E.observaciones LIKE '%SIS%'";
	    $result = $conn->query($sql);
		//	

	}

	return $result;

}


function registrarEstadoPato($id,$estado){

	$db = new Conectar();
	$conn = $db->conexion();		

	if ($conn->connect_errno) {
		printf("Conexión fallida: %s\n", $conn->connect_error);
		exit();

	}else{
	
		$sql = "UPDATE `tbl_registroPacientesPatologia` SET `estadoRegistro`= '$estado' WHERE `idPato`='$id'";
	    $result = $conn->query($sql);
	

	}

	return $result;

}


if($function=="pacienteDatos"){

	$NroDoc = $_GET['NroDoc'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT P.`idPac`, P.`nroFua`, P.`nroCuenta`, P.`paciente`, P.`servicio`, P.`F_Ingreso`, (SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi`= P.serEgreso ) AS SEI,
		P.`F_Alta_Medica`, P.`Historia`, P.`DNI`,P.observacion, P.`fe_reg`,P.montogal,P.montosisfar,P.valorFinal,(SELECT `descripcion` FROM `codPrestHospi` WHERE `idCod`=P.`denominacion`) as den,
		P.codPre,P.cie10_1,P.tpdx1, P.`dx2`, P.`tpdx2`, P.`dx3`, P.`tpdx3`, P.`dx4`, P.`tpdx4`, P.`dx5`, P.`tpdx5`, P.`denominacion`, P.`codPre`, P.`prioridad`, P.`dx6`, P.`tpdx6`, P.`dx7`, P.`tpdx7`, P.`dx8`, P.`tpdx8`
		, P.`dx9`, P.`tpdx9`, P.`dx10`, P.`tpdx10`FROM `paciente` P WHERE `idPac`= :term " );
		$stmt->execute(array('term' => $NroDoc));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);

			$datos[] =  $row['nroFua'];
			$datos[] =  $row['nroCuenta'];
			$datos[] =  $row['paciente'];
			
            $moAh='';
			if($row["servicio"]==""){
			    $moAh=$row["SEI"];
			}else{
			    $moAh=$row["servicio"];
			}
			
		//	$nestedData['servicio'] 				= strtoupper($moAh);
			
			$datos[] =  strtoupper($moAh);
			$datos[] =  date('d/m/Y',strtotime($row['F_Ingreso']));		
			$datos[] =  date('d/m/Y',strtotime($row['F_Alta_Medica']));
			$datos[] =  $row['Historia'];
			$datos[] =  $row['DNI'];
			$datos[] =  $row['observacion'];
			$datos[] =  $row['montogal'];
			$datos[] =  $row['montosisfar'];
			
			$date1 = new DateTime($row['F_Ingreso']);
            $date2 = new DateTime($row['F_Alta_Medica']);
            $diff = $date1->diff($date2);
            
            $datos[] =  $diff->days + 1 . ' dias ';  
            $datos[] =  $row['valorFinal'];
            $datos[] =  $row['codPre']." - ".$row['den'];
            $datos[] =  $row['cie10_1'];
            $datos[] =  $row['dx2'];
            $datos[] =  $row['dx3'];
            $datos[] =  $row['dx4'];
            $datos[] =  $row['dx5'];
            
            
            $datos[] =  $row['tpdx1'];
            $datos[] =  $row['tpdx2'];
            $datos[] =  $row['tpdx3'];
            $datos[] =  $row['tpdx4'];
            $datos[] =  $row['tpdx5'];
            
            
            $datos[] =  $row['codPre'];
            $datos[] =  $row['denominacion'];
            $datos[] =  $row['prioridad'];
            
            $datos[] =  $row['dx6'];
            $datos[] =  $row['tpdx6'];
            $datos[] =  $row['dx7'];
            $datos[] =  $row['tpdx7'];
            $datos[] =  $row['dx8'];
            $datos[] =  $row['tpdx8'];
            $datos[] =  $row['dx9'];
            $datos[] =  $row['tpdx9'];
            $datos[] =  $row['dx10'];
            $datos[] =  $row['tpdx10'];

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="buscarUltimoRe"){

	$NroDoc = $_GET['NroDoc'];$tipo = $_GET['tipo'];
	
	$datos = array();

	try {
		
		if($tipo!="2"){
		    	$stmt = $conn->prepare("SELECT `idCa` FROM `tbl_Cajas` ORDER BY `idCa` DESC LIMIT 1" );
		}else{
		    	$stmt = $conn->prepare("SELECT `idCa` FROM `tbl_CajasCE` ORDER BY `idCa` DESC LIMIT 1" );
		}
		
	
		$stmt->execute(array());
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);

			$datos[] =  $row['idCa'];
	
		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="cantidadAsig"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT COUNT(*) as tot FROM `tbl_grupoArchivo` WHERE `idCaja` ='$id'" );
		$stmt->execute(array());
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);

			$datos[] =  $row['tot'];
	
		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="buscarArvciv"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `archivado` FROM `tbl_CajasCE` WHERE `idCa` ='$id'" );
		$stmt->execute(array());
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);

			$datos[] =  $row['archivado'];
	
		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

//

else if($function=="listConCpmsReporte"){


	$id = $_GET['id'];
	//$key= $_GET['key']; 
//(SELECT SUM(`total`) FROM `a_procedimientos` WHERE `id_prestacion`=P.idPac) as CPm
	
	try {
			
		$stmt = $conn->prepare("SELECT P.iduser,P.auditor AS idaudi,P.estado,P.`idPac`,(SELECT user from usuarios WHERE id=P.iduser) as GESTION, P.`nroFua`, P.tipoEval,
		P.`nroCuenta`, P.`paciente`, P.`servicio`,(SELECT UPPER(`nombre`) FROM `tipoServicioIngreso` WHERE `idTsi`= P.serEgreso ) AS SEI, UPPER(P.`paciente`) AS PAX, UPPER(P.`servicio`) AS SERV, P.`F_Ingreso`, P.`F_Alta_Medica`,(SELECT user from usuarios WHERE id=P.iduser) as AUDITOR,
		P.valorFinal,P.totalCpms,P.`Historia`, P.`DNI`, P.`montogal`, P.`montosisfar`,P.fe_reg,P.codPre,P.obsCpms,P.fechaEnvioAuditoria  FROM `paciente` AS P
		 INNER JOIN usuarios AS U ON P.iduser = U.id WHERE tipoEval='$id' ORDER BY P.idPac DESC " );
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
			$tu;$te;
			if($row["estado"]=="GENERADO"){
				$te ='<a class="btEdit btn btn-warning btn-xs" style="color:#f0ad4e;">.</a>';
				$tu="PENDIENTE";
			} 
			else if($row["estado"]=="PENDIENTE"){
				$te = '<a class="btEdit btn btn-warning btn-xs" style="color:#f0ad4e;">.</a>';
				$tu="PENDIENTE";
			}
			else if($row["estado"]=="ENVIADO"){
				$te = '<a class="btEdit btn btn-success btn-xs" style="color:#26b99a;">.</a>';
				$tu="ENVIADO";
			}

//

			$audit='';
			/*if($row["idPac"]==598){
					$audit .= strtoupper('AVALVERDE');
			}else{
					$ni = asignarAuditor($row['F_Alta_Medica']);
					while($mue = $ni->fetch_assoc()){
							if($mue["respuesta"]=="si"){ 
									$audit .= strtoupper($mue["auditor"]).', ';
								}
					};
			}*/

//

			$nestedData['te'] 						= $te;
			$nestedData['auditor'] 					= strtoupper($row["AUDITOR"]);
			$nestedData['valorFinal'] 				= $row["totalCpms"];
			$nestedData['valoizao'] 				= round($row["montogal"] + $row["montosisfar"] + $row["totalCpms"], 2);
			$nestedData['tu'] 						= $tu;
			$nestedData['nroFua'] 					= $row["nroFua"];
			$nestedData['codPre'] 					= $row["codPre"];
			$nestedData['obsCpms'] 					= strtoupper($row["obsCpms"]);
			$nestedData['nroCuenta'] 				= $row["nroCuenta"];
			$nestedData['paciente'] 				= strtoupper($row["paciente"]);
			$eservi='';
			if($row["tipoEval"]=="2"){
			    $eservi=$row["SEI"];
			}else if($row["tipoEval"]=="1"){
			     $eservi=$row["SERV"];
			}
			
			$nestedData['servicio'] 				= $eservi;
			$fein='';if($row['F_Ingreso']!=""){$fein=date('d/m/Y',strtotime($row['F_Ingreso']));}
			$feal='';if($row['F_Alta_Medica']!=""){$feal=date('d/m/Y',strtotime($row['F_Alta_Medica']));}
			$nestedData['F_Ingreso']				= $fein;
			$nestedData['F_Alta_Medica']			= $feal;
			$nestedData['fe_reg']			        = date('d/m/Y H:i:s',strtotime($row['fe_reg']));//date('d/m/Y H:i:s',strtotime($row['fe_reg']));
			$nestedData['fechaReporte']			    = date('Y-m-d',strtotime($row['fechaEnvioAuditoria']));//fechaEnvioAuditoria
			$nestedData['F_Alta_Medica2'] 			= $row["F_Alta_Medica"];
			$nestedData['Historia'] 				= $row["Historia"];
			$mgal='';($row["montogal"]!="") ? $mgal=$row["montogal"]:$mgal=''; 
			$msis='';($row["montosisfar"]!="") ? $msis=$row["montosisfar"]:$msis=''; 
			
			$nestedData['montogal'] 				= $mgal;
			$nestedData['montosisfar'] 				= $msis;
			
			$opciones ='';
			if($row['iduser']==$iduser || $rol == 7){
			    	$opciones ='<div class="btn-group" style="margin-bottom: 5px;">

								<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs" type="button" aria-expanded="false"> <span class="caret"></span>
								</button>
								<ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
									<li>
										<a onclick="verImpos('.$row["idPac"].')" data-toggle="modal" data-target=".bs-example-modal-sm" ><i class="fa fa-edit"></i> Editar</a>
									</li>
									<li>
										<a href="ImportarCuenta.php?id='.$row["idPac"].'" ><i class="fa fa-cogs"></i> Procesar</a>
									</li>
										<li>
										<a href="imprimir.php?id='.$row["idPac"].'" target="_blank"><i class="fa fa-file-pdf-o"></i> Imprimir</a>
									</li>
										<li>
										<a onclick="eliminarCpmsHnal('.$row["idPac"].')" style="color: red;font-weight: 800;" ><i class="fa fa-trash"></i> Eliminar</a>
									</li>
									
								</ul>
							</div>';
			}
		
			
			$nestedData['opciones'] 				= $opciones;
			$nestedData['GESTION'] 				= strtoupper($row["GESTION"]);
			//
			
			$data[] = $nestedData;
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}


else if($function=="listRegistroPato"){


	$id = $_GET['id'];
	$buscar= $_GET['buscar']; 
	$tipoEstudio= $_GET['tipoEstudio']; 
	//$key= $_GET['key']; 
//(SELECT SUM(`total`) FROM `a_procedimientos` WHERE `id_prestacion`=P.idPac) as CPm
	
	try {


		if($buscar !=""){
			$con="WHERE corPat='$buscar' OR  nrodoc ='$buscar' OR  paciente LIKE '%$buscar%' ";
		}else if($tipoEstudio !=""){
			$con="WHERE tipoEstudio='$tipoEstudio' AND fechaReg BETWEEN date_sub(now(), interval 2 month)  AND NOW()";
		}else{
			$con="ORDER BY idPato DESC LIMIT 50";
		}
			
		$stmt = $conn->prepare("SELECT `idPato`,`IdNumMovimiento`,`IdCuentaAtencion`,(SELECT UPPER(user) FROM usuarios WHERE id=T.iduser )AS USERO,T.`iduser`, `tipodoc`, `nrodoc`, `paciente`, `edad`, `sexo`, `finaciamiento`, `ipress`,
		`jurisdiccion`, `cuenta`, `historia`,(SELECT `Descripcion` FROM `Servicios` WHERE `IdServ` = T.`servicio`) AS SERO ,`servicio`, `salacama`, `celular`, `nroOrden`, `anio`, T.`fechaReg`, `fechaModificacion`,`nroFactura`,
		(SELECT UPPER(`nombre`) FROM `tbl_tipoEstudio` WHERE idTi=T.tipoEstudio ) AS TIPOES,anaMuestraCito,procedRealCito,(SELECT UPPER(user) FROM usuarios WHERE id=T.idAuditorAsignado )AS USERASIX,
		T.`tipoEstudio`,idReportPdf,(SELECT `NombreCorto` FROM `tbl_tipoEstudioProced` WHERE `idtpo` =T.procedimiento) AS PROCED ,`procedimiento`, `medicoSolicitante`,
		`especialidad`, `fechaRecepcion`,corPat,fechaUltimaRegla,idAuditorAsignado,nomApeConfir,turnOnOff,
		(SELECT categoria FROM tbl_observacionesRotulo WHERE idRegRot= T.idPato LIMIT 1) AS CCATE,fechaHoraCerEspe,
		(SELECT rotulo FROM tbl_observacionesRotulo WHERE idRegRot= T.idPato LIMIT 1) AS CROTU,
		(SELECT tacos FROM tbl_observacionesRotulo WHERE idRegRot= T.idPato LIMIT 1) AS CTACOU,	T.idGeneraInforme,T.idCvinforme,T.fechaidCvinforme    
		FROM `tbl_registroPacientesPatologia` AS T $con " );


		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			

			$nestedData['idPato'] 					= $row["idPato"];
		    $nestedData['cuenta'] 					= $row["cuenta"];
		    
		    if($row["USERO"]!=""){
		        $nestedData['USERO'] 					= $row["USERO"];
		    }else{
		        $nestedData['USERO'] 					= "-";
		    }
			
			if($row["USERASIX"]!=""){
			    $nestedData['USERASIX'] 				= $row["USERASIX"];
			}else{
			    $nestedData['USERASIX'] 				= "-";
			}
			
			
			$nestedData['servicio'] 				= strtoupper($row["SERO"]);
			
			if($row["tipoEstudio"]==1){
			    $nestedData['nroOr'] 				    = $row["anio"]."-".$row["corPat"];
			}else if($row["tipoEstudio"]==2 && $row["procedimiento"]==13){
			    $nestedData['nroOr'] 				    = $row["anio"]."CV-".$row["corPat"];
			}else if($row["tipoEstudio"]==2 && $row["procedimiento"]==19){
			    $nestedData['nroOr'] 				    = $row["anio"]."CE-".$row["corPat"];
			}else{
			    $nestedData['nroOr'] 				    = "-";
			}
			
			
			$format				    = $row["anio"]."-".$row["corPat"];
			$nestedData['nroFactura'] 				= $row["nroFactura"];
			
			if($row["TIPOES"]!=""){
			    $nestedData['tipoEstudio'] 				= $row["TIPOES"];
			}else{
			    $nestedData['tipoEstudio'] 				= "-";
			}
			
			
			$nestedData['procedimiento'] 			= $row["PROCED"];
			$nestedData['medicoSolicitante'] 		= $row["medicoSolicitante"];
			$nestedData['especialidad'] 			= $row["especialidad"];
			
			$ferep='';
			if($row['fechaRecepcion']!=""){
			    	$ferep=date('d/m/Y',strtotime($row['fechaRecepcion']));
			}
			$nestedData['fechaRecepcion'] 			= $ferep;
			$nestedData['filtroFechaRecepcion'] 	= $row['fechaRecepcion'];
			
			$est = '';$estRegis='';$estadoLineal='';
			
			if($row["tipoEstudio"]==1){
			    
			        if($row["idGeneraInforme"] !="" && $row["anaMuestraCito"] =="1" && $row["turnOnOff"] == "0" ){
        			    $est = '<span class="label label-success">Finalizado</span>';
        			    $estRegis='1';$estadoLineal='Finalizado';
        			}else if( $row["anaMuestraCito"] =="2" && $row["procedRealCito"] =="3" && $row["idReportPdf"] !="" && $row["turnOnOff"] == "0"
        			|| $row["anaMuestraCito"] =="2" && $row["procedRealCito"] =="4" && $row["idReportPdf"] !="" && $row["turnOnOff"] == "0"){
        			    $est = '<span class="label label-success">Finalizado</span>';
        			    $estRegis='1';$estadoLineal='Finalizado';
        			}else if($row["nroFactura"] !="" && $row["tipoEstudio"] !="" && $row["procedimiento"] !="" && $row["medicoSolicitante"] !="" && $row["especialidad"] !="" && $row["fechaRecepcion"] !="" ){
        			    $est = '<span class="label label-danger">Pendiente</span>';
        			    $estRegis='3';$estadoLineal='Pendiente';
        			}else if($row["CCATE"] !="" && $row["CROTU"] !="" && $row["CTACOU"] !="" ){
        			    $est = '<span class="label label-warning">En proceso</span>';
        			    $estRegis='2';$estadoLineal='En proceso';			
        			}
			}else {
			    
			        if($row["idCvinforme"] !="" && $row["fechaidCvinforme"] !="" && $row["nomApeConfir"] !="" && $row["turnOnOff"] == "0"){
        			    $est = '<span class="label label-success">Finalizado</span>';
        			    $estRegis='1';$estadoLineal='Finalizado';
        			}else if($row["idGeneraInforme"] !="" && $row["anaMuestraCito"] =="1" && $row["turnOnOff"] == "0" ){
        			    $est = '<span class="label label-success">Finalizado</span>';
        			    $estRegis='1';$estadoLineal='Finalizado';
        			}else if($row["idGeneraInforme"] !="" && $row["anaMuestraCito"] =="2" && $row["procedRealCito"] =="3" && $row["idReportPdf"] !="" && $row["turnOnOff"] == "0"
        			|| $row["idGeneraInforme"] !="" && $row["anaMuestraCito"] =="2" && $row["procedRealCito"] =="4" && $row["idReportPdf"] !="" && $row["turnOnOff"] == "0"){
        			    $est = '<span class="label label-success">Finalizado</span>';
        			    $estRegis='1';$estadoLineal='Finalizado';

        			}else if($row["fechaHoraCerEspe"] !=""){
        			    $est = '<span class="label label-success">Finalizado</span>';
        			    $estRegis='1';$estadoLineal='Finalizado';
        			}else if($row["nroFactura"] !="" && $row["tipoEstudio"] !="" && $row["procedimiento"] !="" && $row["medicoSolicitante"] !="" && $row["especialidad"] !="" && $row["fechaRecepcion"] !="" ){
        			    $est = '<span class="label label-danger">Pendiente</span>';
        			    $estRegis='3';$estadoLineal='Pendiente';
        			}						
        			else if($row["CCATE"] !="" && $row["CROTU"] !="" && $row["CTACOU"] !="" ){
        			    $est = '<span class="label label-warning">En proceso</span>';
        			    $estRegis='2';$estadoLineal='En proceso';
					}
			}
			
			
			//registrarEstadoPato($row["idPato"],$estRegis);
			
			$nestedData['estadoLineal'] 	=$estadoLineal;
			
			$nestedData['estadoRegistro'] 	=$est;
			
			
			$pdfihq ='';$pdfhq ='';$pdfAp='';$pdfCp='';
			
				if($row["tipoEstudio"]==1){
				    
				            if($row["idGeneraInforme"] !="" && $row["anaMuestraCito"] == 2 && $row["procedRealCito"] == 3 ){
                			    $pdfihq ='<a style="color: white;" target="_blank" href="http://seguros.hloayza.local/pdfInmunoHistoquimica.php?id='.$row["idPato"].'"><img style="width: 15px;" src="images/pdf.png"></a>';
                			}else if($row["idGeneraInforme"] !="" && $row["anaMuestraCito"] == 2 && $row["procedRealCito"] == 4 ){
                			    $pdfhq ='<a style="color: white;" target="_blank" href="http://seguros.hloayza.local/pdfHistoquimica.php?id='.$row["idPato"].'"><img style="width: 15px;" src="images/pdf.png"></a>';
                			}
                		
                		
                		   if($row["fechaUltimaRegla"] !=""){
                		       $pdfCp='<a style="color: white;" target="_blank" href="http://seguros.hloayza.local/pdfCervicoVaginal.php?id='.$row["idPato"].'"><img style="width: 15px;" src="images/pdf.png"></a>';
                		   }
                			
                		   
                		   if($row["idGeneraInforme"]!="" && $row["anaMuestraCito"] == 1 || $row["idGeneraInforme"]!="" && $row["anaMuestraCito"] == 2 ){
                		       $pdfAp='<a style="color: white;" target="_blank" href="http://seguros.hloayza.local/pdfAnatomoPatologico.php?id='.$row["idPato"].'"><img style="width: 15px;" src="images/pdf.png"></a>';
                		   }
                			
				}else {
				    
				    
				         	if($row["idGeneraInforme"] !="" && $row["anaMuestraCito"] == 2 && $row["procedRealCito"] == 3 ){
                			    $pdfihq ='<a style="color: white;" target="_blank" href="http://seguros.hloayza.local/pdfInmunoHistoquimica.php?id='.$row["idPato"].'"><img style="width: 15px;" src="images/pdf.png"></a>';
                			}else if($row["idGeneraInforme"] !="" && $row["anaMuestraCito"] == 2 && $row["procedRealCito"] == 4 ){
                			    $pdfhq ='<a style="color: white;" target="_blank" href="http://seguros.hloayza.local/pdfHistoquimica.php?id='.$row["idPato"].'"><img style="width: 15px;" src="images/pdf.png"></a>';
                			}
                		
                		
                		   if($row["idCvinforme"] !=""){
                		       $pdfCp='<a style="color: white;" target="_blank" href="http://seguros.hloayza.local/pdfCervicoVaginal.php?id='.$row["idPato"].'"><img style="width: 15px;" src="images/pdf.png"></a>';
                		   }
                			
                		   
                		   if($row["idGeneraInforme"]!="" && $row["anaMuestraCito"] == 1 || $row["idGeneraInforme"]!="" && $row["anaMuestraCito"] == 2 ){
                		       $pdfAp='<a style="color: white;" target="_blank" href="http://seguros.hloayza.local/pdfAnatomoPatologico.php?id='.$row["idPato"].'"><img style="width: 15px;" src="images/pdf.png"></a>';
                		   }


						   if($row["fechaHoraCerEspe"] !=""){
								$pdfCp='<a style="color: white;" target="_blank" href="http://seguros.hloayza.local/pdfAnatomoPatologico2.php?id='.$row["idPato"].'"><img style="width: 15px;" src="images/pdf.png"></a>';
							}
				        
				    
				}
			
			
			
			
			
			
			$nestedData['informeIHQ'] 			=  $pdfihq;
			$nestedData['informeHQ'] 			=  $pdfhq;
			$nestedData['informeAp'] 			=  $pdfAp;
			$nestedData['informeCp'] 			=  $pdfCp;
			
			
			$nestedData['paciente'] 				= strtoupper($row["paciente"]);
			$nestedData['historia'] 				= $row["historia"];
			$nestedData['IdNumMovimiento'] 				= $row["IdNumMovimiento"];
			$nestedData['IdCuentaAtencion'] 				= $row["IdCuentaAtencion"];
			$fi="";
			if($row["finaciamiento"]==1){
			    	$fi="PARTICULAR";
			}else{
			    $fi="SIS";
			}
			
			$nestedData['finaciamiento'] 				= $fi;
			
			$tipc='';
			if($row["tipodoc"]==1){
			    	$tipc='DNI';
			}else if($row["tipodoc"]==2){
			    	$tipc='CARNET EXT';
			}
			else if($row["tipodoc"]==3){
			    	$tipc='PASAPORTE';
			}
			else if($row["tipodoc"]==4){
			    	$tipc='CODIGO RECIEN NACIDO (CUI)';
			}
			else if($row["tipodoc"]==5){
			    	$tipc='DOC. IDENT. EXTRANJERA';
			}
			else if($row["tipodoc"]==6){
			    	$tipc='SIN DOC';
			}
			
			$nestedData['tipodoc'] 				= $tipc;
		    $nestedData['nrodoc'] 				= $row["nrodoc"];
			$nestedData['fechaReg']			    = date('d/m/Y H:i:s',strtotime($row['fechaReg']));
			$nestedData['fechaModificacion']	= date('d/m/Y H:i:s',strtotime($row['fechaModificacion']));
		
			
			/* <li><a onclick="eliminarRegistroPato('.$row["idPato"].')" style="color: red;font-weight: 800;" ><i class="fa fa-trash"></i> Eliminar</a></li>
			
			*/ 
			
			$editOpci='';
			
			if($row["tipoEstudio"]==1){
			    
				if($row["anaMuestraCito"] == 2 && $row["idReportPdf"] != "" && $row["turnOnOff"] == "0" || $row["anaMuestraCito"] == 1 && $row["idGeneraInforme"] !="" && $row["turnOnOff"] == "0"){
					   /*
					   if($permisoEditarPato == 1 ){
								   $editOpci='<ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
										<li>
										   <a onclick="habilitarRegistroPato('.$row["idPato"].')" style="color: red;font-weight: 800;" ><i class="fa fa-plus"></i> Habilitar</a>
									   </li>
							   </ul>';
					   }
							   */

							   if($idEditar == 30){
									
							   }else{
								$editOpci='
									<ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
										<li>
											<a href="registroInmuno.php?id='.$row["idPato"].'&formato='.$format.'&tipoest='.$row["tipoEstudio"].'">
												<i class="fa fa-edit"></i> Editar
											</a>
										</li>
										<li>
											<a  style="color: red;font-weight: 800;" onclick="deleteRegistro('.$row["idPato"].', \''.$row["IdNumMovimiento"].'\', \''.$row["IdCuentaAtencion"].'\')">
												<i class="fa fa-trash"></i> Eliminar
											</a>
										</li>
									</ul>';

							   }
							   
					   
					   
			   }else {
				 /*  $editOpci='
					   <ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
						   <li>
							   <a href="registroInmuno.php?id='.$row["idPato"].'&formato='.$format.'&tipoest='.$row["tipoEstudio"].'">
								   <i class="fa fa-edit"></i> Editar
							   </a>
						   </li>
						   <li>
							   <a  style="color: red;font-weight: 800;" onclick="deleteRegistro('.$row["idPato"].', \''.$row["IdNumMovimiento"].'\', \''.$row["IdCuentaAtencion"].'\')">
								   <i class="fa fa-trash"></i> Eliminar
							   </a>
						   </li>
					   </ul>'; */
					   if($idEditar == 30){
									
					   }else{
						   $editOpci='
					   <ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
						   <li>
							   <a href="registroInmuno.php?id='.$row["idPato"].'&formato='.$format.'&tipoest='.$row["tipoEstudio"].'">
								   <i class="fa fa-edit"></i> Editar
							   </a>
						   </li>
						   <li>
								<a  style="color: red;font-weight: 800;" onclick="deleteRegistro('.$row["idPato"].', \''.$row["IdNumMovimiento"].'\', \''.$row["IdCuentaAtencion"].'\')">
									<i class="fa fa-trash"></i> Eliminar
								</a>
							</li>
						   
					   </ul>';

					   }
			   }
	   
   			}else{
	   
			   if($row["idCvinforme"] !="" && $row["fechaidCvinforme"] !="" && $row["nomApeConfir"] !=""  && $row["turnOnOff"] == "0"  ){
				   
				/*
					  if($permisoEditarPato == 1 ){
								   $editOpci='<ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
										<li>
										   <a onclick="habilitarRegistroPato('.$row["idPato"].')" style="color: red;font-weight: 800;" ><i class="fa fa-plus"></i> Habilitar</a>
									   </li>
							   </ul>';
					   }
							   */
							  if($idEditar == 30){
									
							  }else{
								  
								  $editOpci='
								  <ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
									  <li>
										  <a href="registroInmuno.php?id='.$row["idPato"].'&formato='.$format.'&tipoest='.$row["tipoEstudio"].'">
											  <i class="fa fa-edit"></i> Editar
										  </a>
									  </li>
									   <li>
											<a  style="color: red;font-weight: 800;" onclick="deleteRegistro('.$row["idPato"].', \''.$row["IdNumMovimiento"].'\', \''.$row["IdCuentaAtencion"].'\')">
												<i class="fa fa-trash"></i> Eliminar
											</a>
										</li>
									  
								  </ul>';

							  }
					   
			   }else {
				  /* $editOpci='
					   <ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
								<li>
								   <a  href="registroInmuno.php?id='.$row["idPato"].'&formato='.$format.'&tipoest='.$row["tipoEstudio"].'" ><i class="fa fa-edit"></i> Editar</a>
							   </li>
							   <li>
							   <a href="#" onclick="deleteRegistro('.$row["idPato"].', \''.$row["IdNumMovimiento"].'\', \''.$row["IdCuentaAtencion"].'\')">
								   <i class="fa fa-trash"></i> Eliminar
							   </a>
						   </li>
					   </ul>'; */
					   if($idEditar == 30){
									
					   }else{
						   $editOpci='
					   <ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
								<li>
								   <a  href="registroInmuno.php?id='.$row["idPato"].'&formato='.$format.'&tipoest='.$row["tipoEstudio"].'" ><i class="fa fa-edit"></i> Editar</a>
							   </li>
							    <li>
									<a  style="color: red;font-weight: 800;" onclick="deleteRegistro('.$row["idPato"].', \''.$row["IdNumMovimiento"].'\', \''.$row["IdCuentaAtencion"].'\')">
										<i class="fa fa-trash"></i> Eliminar
									</a>
								</li>
							   
					   </ul>';

					   }
			   }
  			 }
		
			  
			
		
		
			    	$opciones ='<div class="btn-group" style="margin-bottom: 5px;">

								<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs" type="button" aria-expanded="false"> <span class="caret"></span>
								</button>
								 '.$editOpci.'
							    </div>';
		
		
			
			$nestedData['opciones'] 				= $opciones;
		
			
			$data[] = $nestedData;
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}

else if($function=="listConCpms"){


	 $tipo = $_GET['tipo'];
     $sql="";
     
     if($tipo=="1"){
         $sql="P.tipoEval='1' ";
     }else{
         $sql="P.tipoEval='2' AND P.iduser <> '' ";
     }

	
	try {
			
		$stmt = $conn->prepare("SELECT P.iduser,P.auditor AS idaudi,P.estado,P.`idPac`,(SELECT user from usuarios WHERE id=P.iduser) as GESTION, P.`nroFua`, 
		P.`nroCuenta`, P.`paciente`, P.`servicio`, P.`F_Ingreso`, P.`F_Alta_Medica`,(SELECT user from usuarios WHERE id=P.iduser) as AUDITOR,fileCpms,
		P.valorFinal,P.`Historia`, P.`DNI`, P.`montogal`, P.`montosisfar`,P.fe_reg,P.codPre,P.obsCpms,(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi`= P.serEgreso ) AS SEI 
		FROM `paciente` AS P LEFT JOIN usuarios AS U ON P.iduser = U.id  WHERE $sql ORDER BY P.idPac DESC " );
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
			$tu;$te;
			if($row["estado"]=="GENERADO"){
				$te ='<a class="btEdit btn btn-warning btn-xs" style="color:#f0ad4e;">.</a>';
				$tu="PENDIENTE";
			} 
			else if($row["estado"]=="PENDIENTE"){
				$te = '<a class="btEdit btn btn-warning btn-xs" style="color:#f0ad4e;">.</a>';
				$tu="PENDIENTE";
			}
			else if($row["estado"]=="ENVIADO"){
				$te = '<a class="btEdit btn btn-success btn-xs" style="color:#26b99a;">.</a>';
				$tu="ENVIADO";
			}

//

			$audit='';
			/*if($row["idPac"]==598){
					$audit .= strtoupper('AVALVERDE');
			}else{
					$ni = asignarAuditor($row['F_Alta_Medica']);
					while($mue = $ni->fetch_assoc()){
							if($mue["respuesta"]=="si"){ 
									$audit .= strtoupper($mue["auditor"]).', ';
								}
					};
			}*/

//
            $apre='';
            if($row["fileCpms"]!=""){
                $apre='<a style="color: white;" target="_blank" href="http://seguros.hloayza.local/pdfCPMS/'.$row["fileCpms"].'"><img style="width: 15px;" src="images/pdf.png"></a>';
            }

			$nestedData['adj'] 						= $apre;
			$nestedData['te'] 						= $te;
			$nestedData['auditor'] 					= strtoupper($row["AUDITOR"]);
			$nestedData['valorFinal'] 				= strtoupper($row["valorFinal"]);
			$nestedData['tu'] 						= $tu;
			
			$poe='';
			if(strlen($row["nroFua"])>8){
			        $poe=$row["nroFua"];    
			}
			
			
			$nestedData['nroFua'] 					= $poe;
			$nestedData['codPre'] 					= $row["codPre"];
			$nestedData['obsCpms'] 					= strtoupper($row["obsCpms"]);
			
			$nestedData['nroCuenta'] 				= $row["nroCuenta"];
			$nestedData['paciente'] 				= strtoupper($row["paciente"]);
			$moAh='';
			if($row["servicio"]==""){
			    $moAh=$row["SEI"];
			}else{
			    $moAh=$row["servicio"];
			}
			
			$nestedData['servicio'] 				= strtoupper($moAh);
			$fein='';if($row['F_Ingreso']!=""){$fein=date('d/m/Y',strtotime($row['F_Ingreso']));}
			$feal='';if($row['F_Alta_Medica']!=""){$feal=date('d/m/Y',strtotime($row['F_Alta_Medica']));}
			$nestedData['F_Ingreso']				= $fein;
			$nestedData['F_Alta_Medica']			= $feal;
			$nestedData['fe_reg']			        = date('d/m/Y',strtotime($row['fe_reg']));//date('d/m/Y H:i:s',strtotime($row['fe_reg']));
			$nestedData['fechaReporte']			    = date('Y-m-d',strtotime($row['fe_reg']));
			$nestedData['F_Alta_Medica2'] 			= $row["F_Alta_Medica"];
			$nestedData['Historia'] 				= $row["Historia"];
			$mgal='';($row["montogal"]!="") ? $mgal='S/.'.$row["montogal"]:$mgal=''; 
			$msis='';($row["montosisfar"]!="") ? $msis='S/.'.$row["montosisfar"]:$msis=''; 
			
			$nestedData['montogal'] 				= $mgal;
			$nestedData['montosisfar'] 				= $msis;
			
			
			$opciones ='';
			if($row['iduser']==$iduser || $rol == 7){
			    	$opciones ='<div class="btn-group" style="margin-bottom: 5px;">

								<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs" type="button" aria-expanded="false"> <span class="caret"></span>
								</button>
								<ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
									<li>
										<a onclick="verImpos('.$row["idPac"].')" data-toggle="modal" data-target=".bs-example-modal-sm" ><i class="fa fa-edit"></i> Editar</a>
									</li>
									<li>
										<a href="ImportarCuenta.php?id='.$row["idPac"].'" ><i class="fa fa-cogs"></i> Procesar</a>
									</li>
									<li>
										<a href="imprimir.php?id='.$row["idPac"].'" target="_blank"><i class="fa fa-file-pdf-o"></i> Imprimir</a>
									</li>
										<li>
										<a onclick="eliminarCpmsHnal('.$row["idPac"].')" style="color: red;font-weight: 800;" ><i class="fa fa-trash"></i> Eliminar</a>
									</li>
									
								</ul>
							</div>';
			}
		
			
			$nestedData['opciones'] 				= $opciones;
			$nestedData['GESTION'] 				= strtoupper($row["GESTION"]);
			//
			
			$data[] = $nestedData;
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}
     

else if($function=="listConCpmsAuditoria"){

        
         $tipo = $_GET['tipo'];
         $sql="";$check = $_POST['listAuditorCpms'];
         $estadoCpms = $_POST['estadoCpms'];
         $desdeFech = $_POST['desdeFech'];
         $maxFech = $_POST['maxFech'];
         
         
         
         if($tipo=="1"){
             $sql="WHERE P.tipoEval='1' AND P.iduser <> ''  ";
         }else if($tipo=="2"){
             $sql="WHERE P.tipoEval='2' AND P.iduser <> '' ";
         }else if($tipo=="3"){
             $sql="WHERE P.tipoEval='3' AND P.iduser <> '' ";
         }


		        $where="";
				if(!empty($_REQUEST['search']['value']) ) { 
					$where.=" AND ( P.`nroCuenta` LIKE '%".$_REQUEST['search']['value']."%'";
					$where.=" OR paciente LIKE '%".$_REQUEST['search']['value']."%'";
					$where.=" OR Historia LIKE '%".$_REQUEST['search']['value']."%'";
					$where.=" OR DNI LIKE '%".$_REQUEST['search']['value']."%')";
				}
				
				if(!empty($check)){
					
					$where.=" AND P.iduser = $check";
				
				}
				
				if(!empty($estadoCpms)){
					
					$where.=" AND P.estado = '$estadoCpms'";
				
				}
				
				
				
				if(!empty($desdeFech) && !empty($maxFech)){
					$where=" AND P.fechaEnvioAuditoria BETWEEN '$desdeFech 00:00:00' AND '$maxFech 23:59:59'";
				}
				
				

				$totalRecordsSql = "SELECT COUNT(*) AS TOT,P.iduser,P.auditor AS idaudi,P.estado,P.`idPac`,(SELECT user from usuarios WHERE id=P.iduser) as GESTION, P.`nroFua`, 
                		P.`nroCuenta`,  UPPER(P.`paciente`) AS PAX, UPPER(P.`servicio`) AS SERV,date_format(P.`F_Ingreso`,'%d/%m/%Y') as fein, P.`F_Ingreso`, date_format(P.`F_Alta_Medica`,'%d/%m/%Y') as fealMed,
                		P.`F_Alta_Medica`,(SELECT UPPER(user) from usuarios WHERE id=P.iduser) as AUDITOR,fileCpms, date_format(P.`fe_reg`,'%Y-%m-%d') as fechaReporte,
                		P.valorFinal,P.`Historia`, P.`DNI`, P.`montogal`, P.`montosisfar`,date_format(P.`fe_reg`,'%d/%m/%Y') as rechRe,date_format(P.`fechaEnvioAuditoria`,'%d/%m/%Y') as fetAudit,P.fe_reg,P.codPre,P.obsCpms,
                		(SELECT UPPER(`nombre`) FROM `tipoServicioIngreso` WHERE `idTsi`= P.serEgreso ) AS SEI,'hola' as opciones,'hola' as adj,P.tipoEval,
                		(SELECT `digitado` FROM `tbl_grupoArchivo` WHERE `idGrupo` =(SELECT idPaq FROM listadoAtencionesCE WHERE idPac= P.idEmg)) AS DIGITADO,
                		(SELECT `archivado` FROM `tbl_grupoArchivo` WHERE `idGrupo` =(SELECT idPaq FROM listadoAtencionesCE WHERE idPac= P.idEmg)) AS ARCHIVADO
                		FROM `paciente` AS P LEFT JOIN usuarios AS U ON P.iduser = U.id $sql $where";
                
				$stmt = $conn->prepare($totalRecordsSql);
				$stmt->execute();
				$res = $stmt->fetchAll();
				$totalRecords= 0;
				
				foreach ($res as $key => $value) {
					$totalRecords = $value['TOT'];
				}
				
					  
				$columns = array( 
					
					0 =>'estado',
					1 =>'AUDITOR',
					2 =>'idPac',
					3 =>'nroFua',
					4 =>'nroCuenta',
					5 =>'PAX',
					6 =>'SERV',
                    7 =>'fein',
                    8 =>'fealMed',
					9 =>'F_Alta_Medica',
					10 =>'Historia',
					11 =>'GESTION',
					12 =>'montogal',
					13 =>'montosisfar',
					14 =>'valorFinal',
                    15 =>'fetAudit',
                    16 =>'adj',
					17 =>'opciones',
					18 =>'fechaReporte',
					19 =>'codPre',
					20 =>'obsCpms',
					21 =>'SEI',
					22 =>'tipoEval',
					23 =>'DIGITADO',
					24 =>'ARCHIVADO',
				
				
				);
				

				$sql = "SELECT P.iduser,P.auditor AS idaudi,P.estado,P.`idPac`,(SELECT user from usuarios WHERE id=P.iduser) as GESTION, P.`nroFua`, 
                		P.`nroCuenta`, UPPER(P.`paciente`) AS PAX, UPPER(P.`servicio`) AS SERV,date_format(P.`F_Ingreso`,'%d/%m/%Y') as fein, P.`F_Ingreso`, date_format(P.`F_Alta_Medica`,'%d/%m/%Y') as fealMed,
                		P.`F_Alta_Medica`,(SELECT UPPER(user) from usuarios WHERE id=P.iduser) as AUDITOR,fileCpms, date_format(P.`fe_reg`,'%Y-%m-%d') as fechaReporte,
                		P.valorFinal,P.`Historia`, P.`DNI`, P.`montogal`, P.`montosisfar`,date_format(P.`fe_reg`,'%d/%m/%Y') as rechRe,date_format(P.`fechaEnvioAuditoria`,'%d/%m/%Y') as fetAudit,P.fe_reg,P.codPre,P.obsCpms,
                		(SELECT UPPER(`nombre`) FROM `tipoServicioIngreso`WHERE `idTsi`= P.serEgreso ) AS SEI,'hola' as opciones,'hola' as adj,P.tipoEval,
                		(SELECT `digitado` FROM `tbl_grupoArchivo` WHERE `idGrupo` =(SELECT idPaq FROM listadoAtenciones WHERE idPac= P.idEmg)) AS DIGITADO,
                		(SELECT `archivado` FROM `tbl_grupoArchivo` WHERE `idGrupo` =(SELECT idPaq FROM listadoAtenciones WHERE idPac= P.idEmg)) AS ARCHIVADO    
                		FROM `paciente` AS P LEFT JOIN usuarios AS U ON P.iduser = U.id $sql $where";  // 
				$sql.=" ORDER BY ". $columns[$_REQUEST['order'][0]['column']]." ".$_REQUEST['order'][0]['dir']."  LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']."   ";
                //echo $sql;
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				$json_data = array(

				"draw"            => intval( $_REQUEST['draw'] ),   
				"recordsTotal"    => intval($totalRecords ),  
				"recordsFiltered" => intval($totalRecords),
				"data"            => $result
				);

				echo json_encode($json_data);
	
	

}
        
        else if($function=="busFua"){
        
        	$id = $_GET['id'];
        
        	$r1 = substr($id, 0, 3);
        	$r2 = substr($id, 3,2);
        	$r3 = substr($id, 5,12);
        	$fux = $r1."-".$r2."-".$r3;
        	
        
        
        	$datos = array();
        
        	try {
        		
        		$stmt = $conn->prepare("SELECT FUA_OBSERVADA,`PACIENTE`,FUA_SOLICITADA,FSOLIC,observacionPost,ESTADO,RESULTADO_EVAL,PDF,VALORNUM,orden,fuare,hiEn
        		, `ap`, `bp`, `cp`, `dp`, `ep` FROM `reconsideraciones` 
        		WHERE `FUA_OBSERVADA`= :term LIMIT 1" );
        		$stmt->execute(array('term' => $fux));
        		
        		
        		while($row = $stmt->fetch()) {
        			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
        			
        			$datos[] =  $row['PACIENTE'];
        			$datos[] =  $row['FUA_OBSERVADA'];
        			$datos[] =  $row['FUA_SOLICITADA'];
        			$datos[] =  $row['FSOLIC'];
        			$datos[] =  $row['observacionPost'];
        			$datos[] =  $row['ESTADO'];
        			$datos[] =  $row['RESULTADO_EVAL'];
        			$datos[] =  $row['PDF'];
        			$datos[] =  $row['VALORNUM'];
        			$datos[] =  $row['orden'];
        			$datos[] =  $row['fuare'];
        			$datos[] =  $row['hiEn'];
        			
        			$datos[] =  $row['ap'];
        			$datos[] =  $row['bp'];
        			$datos[] =  $row['cp'];
        			$datos[] =  $row['dp'];
        			$datos[] =  $row['ep'];
        			
        		}
        // 
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos,JSON_UNESCAPED_UNICODE);
        
        }



        else if($function=="cuentaSearch"){
        
        	$id = $_GET['id'];
        
    
        	$datos = array();
        
        	try {
        		
        		$stmt = $conn->prepare("SELECT E.`historiaClinica`,E.`nroDoc`,E.`tipoDoc`,E.`nroFua`,CONCAT(E.`ApePaterno`,' ',E.`ApeMaterno`,' ',E.`nombres`) as PAX,
        		(SELECT `descripcion` FROM `pabellones` WHERE `idPa`=E.`pab1Hos`) as SER,
        		(SELECT montoGalenos FROM tbl_Emergencias WHERE idEm =(SELECT ideNew from tbl_Emergencias where cuentaHsoMod='$id' )) AS SUMGAL,
        		E.`fechaIngreso`,E.`feAltaAlt`,E.`montoGalenos`,E.`montoSisfar`,E.`Observaciones`,E.monTotalCo FROM `tbl_Emergencias` E 
        		WHERE E.`cuentaHsoMod`='$id' OR  E.`cuenta`='$id' AND tipoRegistro='2' ORDER BY E.idEm DESC  LIMIT 1" );
        		$stmt->execute();
        		
        		while($row = $stmt->fetch()) {
        			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
        			
        			$datos[] =  $row['historiaClinica'];
        			$datos[] =  $row['nroDoc'];
        			$datos[] =  $row['tipoDoc'];
        			$datos[] =  $row['nroFua'];
        			$datos[] =  $row['PAX'];
        			$datos[] =  $row['SER'];
        			$ferein = substr($row['fechaIngreso'],0,10); 
        			$datos[] =  $ferein;
        			$datos[] =  $row['feAltaAlt'];
        			$datos[] =  round($row['montoGalenos'] + $row['SUMGAL'], 2);
        			//$datos[] =  $row['SUMGAL'];
        			$datos[] =  $row['montoSisfar'];
        			$datos[] =  $row['Observaciones'];
        			$datos[] =  $row['monTotalCo'];
        			
        		}
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos,JSON_UNESCAPED_UNICODE);
        
        }
        
        else if($function=="buscarDxMorf"){
        
        	$id = $_GET['id'];
        
    
        	$datos = array();
        
        	try {
        		
        		$stmt = $conn->prepare("SELECT descripcion  FROM dx_morfologicos  WHERE  cod_dx = '$id'" );
        		$stmt->execute();
        		
        		while($row = $stmt->fetch()) {
        			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
        			
        			$datos[] =  $row['descripcion'];
        			
        		}
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos,JSON_UNESCAPED_UNICODE);
        
        }
		else if($function=="buscarCodDxMorf"){
        
        	$id = $_GET['id'];
        
    
        	$datos = array();
        
        	try {
        		
        		$stmt = $conn->prepare("SELECT cod_dx  FROM dx_morfologicos  WHERE  descripcion = '$id'" );
        		$stmt->execute();
        		
        		while($row = $stmt->fetch()) {
        			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
        			
        			$datos[] =  $row['cod_dx'];
        			
        		}
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos,JSON_UNESCAPED_UNICODE);
        
        }
		else if($function=="buscarCodDxMorf_informe_cito"){
        
        	$id = $_GET['id'];
        
    
        	$datos = array();
        
        	try {
        		
        		$stmt = $conn->prepare("SELECT cod_dx  FROM dx_morfologicos  WHERE  descripcion = '$id'" );
        		$stmt->execute();
        		
        		while($row = $stmt->fetch()) {
        			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
        			
        			$datos[] =  $row['cod_dx'];
        			
        		}
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos,JSON_UNESCAPED_UNICODE);
        
        }

		else if($function =="buscarServicio"){
			$codCompatible = $_GET['codCompatible'];
				$IdServicio = null;

				try {
					$stmt = $conn->prepare("SELECT `IdServ` FROM `Servicios` WHERE `IdServ`= :codCompatible");
					$stmt->bindParam(':codCompatible', $codCompatible);
					$stmt->execute();
					
					// Obtener un solo valor de la consulta
					$row = $stmt->fetch();
					if ($row) {
						$IdServicio = $row['IdServ'];
					}

				} catch(PDOException $e) {
					echo 'ERROR: ' . $e->getMessage();
				}

				// Devolver solo el valor simple en lugar de un array
				echo json_encode($IdServicio !== null ? (int)$IdServicio : null);
			
		}
		else if($function =="buscarServicioSIGH"){
			$IdServ = $_GET['idServico'];
				$IdServicio = null;
			

				try {
					$stmt = $conn->prepare("SELECT `codCompatible` FROM `Servicios` WHERE `IdServ`= :IdServ");
					$stmt->bindParam(':IdServ', $IdServ);
					$stmt->execute();
					
					// Obtener un solo valor de la consulta
					$row = $stmt->fetch();
					if ($row) {
						$IdServicio = $row['codCompatible'];
					}

				} catch(PDOException $e) {
					echo 'ERROR: ' . $e->getMessage();
				}

				// Devolver solo el valor simple en lugar de un array
				echo json_encode($IdServicio !== null ? (int)$IdServicio : null);
			
		}
		
		else if($function =="obtenerProcexProducto"){
			$idProducto = $_GET['idProducto'];
			$result = null;
		
			try {
				$stmt = $conn->prepare("SELECT `idtpo`, `idTi`,`IdSubTipo` FROM `tbl_tipoEstudioProced` WHERE `codCompatible`= :idProducto");
				$stmt->bindParam(':idProducto', $idProducto);
				$stmt->execute();
				
				// Obtener una fila de la consulta
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($row) {
					if((int)$row['IdSubTipo'] ==0){
						$result = [
							'idProcedimiento' => (int)$row['idtpo'],
							'idTipoEstudio' => 1,
							'idSubProced' => 0
						];
						
					}else if((int)$row['IdSubTipo'] ==1){
						$result = [
							'idProcedimiento' => (int)$row['idtpo'],
							'idTipoEstudio' => 2,
							'idSubProced' => 0
						];

					}else{
						$result = [
							'idProcedimiento' => 19,
							'idTipoEstudio' => 2,
							'idSubProced' => (int)$row['idtpo']
						];

					}
					// $result = [
					// 	'idProcedimiento' => (int)$row['idtpo'],
					// 	'idTipoEstudio' => (int)$row['IdSubTipo'],
					// 	'idSubProced' => (int)$row['IdSubTipo']
					// ];
				}
		
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
			// 'idProcedimiento' => (int)$row['idtpo'],
			// 'idTipoEstudio' => (int)$row['idTi'],
			// 'idSubProced' => (int)$row['IdSubTipo']
		
			// Devolver los resultados como JSON
			echo json_encode($result);
		}
		else if($function=="buscarCorrelPatfParticular"){
        
        	$tipo = $_GET['tipo']; //1
            $proc = $_GET['proc'];//1
            $SubtipoProc = $_GET['SubtipoProc'];//1

			
			// var_dump($SubtipoProc);
			// exit();
    
        	$datos = array();
        
        	try {
        		
        		$squ="";
        		if($tipo==1){
        		    	$squ="SELECT corPat AS CORE FROM `tbl_registroPacientesPatologia` WHERE `tipoEstudio` = '$tipo'  AND anio ='2025' ORDER BY corPat desc LIMIT 1";
        		}else if($tipo==2 ){
					
					// if($tipo==3 ){
					// 	$tipo=2;
					// }

						$squ="SELECT corPat AS CORE FROM `tbl_registroPacientesPatologia` WHERE `tipoEstudio` = '$tipo' AND procedimiento='$proc'  AND anio ='2025' ORDER BY corPat desc LIMIT 1";
					// var_dump($squ);
					// exit();
					
        		} 
				
        		
        		/*if($tipo==1){
        		    	$squ="SELECT COUNT(*) AS CORE FROM `tbl_registroPacientesPatologia` WHERE `tipoEstudio` = '$tipo' ORDER BY nroOrden DESC LIMIT 1";
        		}else if($tipo==2){
        		       $squ="SELECT COUNT(*) AS CORE FROM `tbl_registroPacientesPatologia` WHERE `tipoEstudio` = '$tipo' AND procedimiento='$proc' ORDER BY nroOrden DESC LIMIT 1";
        		} 
        		*/
        		
        		
        		$stmt = $conn->prepare($squ);
        		$stmt->execute();
        		
        		while($row = $stmt->fetch()) {
        			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
        			
        			/*if($tipo==1){
        			        $cor = "4057" + $row['CORE'];    
        			}else if($tipo==2 && $proc=="13"){
        			        $cor = "913" + $row['CORE'];
        			}else if($tipo==2 && $proc=="15"){
        			        $cor = "666" + $row['CORE'];
        			} */
        			
        			if($tipo==1){
        			        $cor = "1" + $row['CORE'];    
        			}else if($tipo==2 && $proc=="13"){
        			        $cor = "1" + $row['CORE'];
        			}else if($tipo==2 && $proc=="19"){
        			        $cor = "1" + $row['CORE'];
        			}
        			
        			
        			$anio = date("Y");
        			$datos[] =  $cor;
        			$datos[] =  $anio."-".$cor;
        			
        			
        		}
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos,JSON_UNESCAPED_UNICODE);
        
        }
        
        
        
        
        
         else if($function=="buscarCorrelPatf"){
        
        	$tipo = $_GET['tipo']; //1
            $proc = $_GET['proc'];//1
    
        	$datos = array();
        
        	try {
        		
        		$squ="";
        		if($tipo==1){
        		    	$squ="SELECT corPat AS CORE FROM `tbl_registroPacientesPatologia` WHERE `tipoEstudio` = '$tipo'  AND anio ='2025' ORDER BY corPat desc LIMIT 1";
        		    	// $squ="SELECT corPat AS CORE FROM `tbl_registroPacientesPatologia` WHERE `tipoEstudio` = '$tipo' ORDER BY idpato desc LIMIT 1";

        		}else if($tipo==2){
        		       $squ="SELECT corPat AS CORE FROM `tbl_registroPacientesPatologia` WHERE `tipoEstudio` = '$tipo' AND procedimiento='$proc'  AND anio ='2025' ORDER BY corPat desc LIMIT 1";
        		    //    $squ="SELECT corPat AS CORE FROM `tbl_registroPacientesPatologia` WHERE `tipoEstudio` = '$tipo' AND procedimiento='$proc' ORDER BY idPato desc LIMIT 1";

        		} 
        		
        		/*if($tipo==1){
        		    	$squ="SELECT COUNT(*) AS CORE FROM `tbl_registroPacientesPatologia` WHERE `tipoEstudio` = '$tipo' ORDER BY nroOrden DESC LIMIT 1";
        		}else if($tipo==2){
        		       $squ="SELECT COUNT(*) AS CORE FROM `tbl_registroPacientesPatologia` WHERE `tipoEstudio` = '$tipo' AND procedimiento='$proc' ORDER BY nroOrden DESC LIMIT 1";
        		} 
        		*/
        		
        		
        		$stmt = $conn->prepare($squ);
        		$stmt->execute();
        		
        		while($row = $stmt->fetch()) {
        			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
        			
        			/*if($tipo==1){
        			        $cor = "4057" + $row['CORE'];    
        			}else if($tipo==2 && $proc=="13"){
        			        $cor = "913" + $row['CORE'];
        			}else if($tipo==2 && $proc=="15"){
        			        $cor = "666" + $row['CORE'];
        			} */
        			
        			if($tipo==1){
        			        $cor = "1" + $row['CORE'];    
        			}else if($tipo==2 && $proc=="13"){
        			        $cor = "1"   + $row['CORE'];
        			}else if($tipo==2 && $proc=="19"){
        			        $cor = "1" + $row['CORE'];
        			}
        			
        			
        			$anio = date("Y");
        			$datos[] =  $cor;
        			$datos[] =  $anio."-".$cor;
        			
        			
        		}
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos,JSON_UNESCAPED_UNICODE);
        
        }
		
		else if($function=="bucarProceFacturado"){

        	$id = $_GET['tipoproced'];
			// var_dump($id);
			// exit();
			// echo "El valor de id es: " . htmlspecialchars($id);

			try {

					$stmt = $conn->prepare("SELECT `CodTarifario` FROM `tbl_tipoEstudioProced` WHERE `idtpo` = :id");
					$stmt->bindParam(':id', $id, PDO::PARAM_INT);
					$stmt->execute();

					// Verificar si la consulta devolvió resultados
					if ($stmt->rowCount() > 0) {
						// Obtener solo el primer resultado
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						// var_dump($row); // Verificar el contenido de $row
						// exit();
						echo json_encode($row['CodTarifario'], JSON_UNESCAPED_UNICODE);
					} else {
						echo json_encode(null, JSON_UNESCAPED_UNICODE);
					}
				
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
        
        }
        else if($function=="cuentaSearchPatologia"){
        
        	$id = $_GET['id'];
        
    
        	$datos = array();
        
        	try {
        		
        		$stmt = $conn->prepare("SELECT E.`historiaClinica`,E.`nroDoc`,E.sexo,CONCAT(E.`ApePaterno`,' ',E.`ApeMaterno`,' ',E.`nombres`) as PAX,E.edad,E.camHos1,
        		(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  E.`tipoSeiN` ) AS SIG,(SELECT `descripcion` FROM `pabellones` WHERE `idPa` = E.pab1Hos) AS PI,
        		regServiceCE AS RECE,E.tipoRegistro  FROM `tbl_Emergencias` E WHERE E.`cuenta`='$id' LIMIT 1" );
        		$stmt->execute();
        		
        		while($row = $stmt->fetch()) {
        			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
        			
        			$datos[] =  $row['historiaClinica'];
        			$datos[] =  $row['sexo'];
        			$datos[] =  $row['PAX'];
        			$verSe='';
        			if($row['tipoRegistro']=="1"){
        			    $verSe=$row['SIG'];   
        			}else if ($row['tipoRegistro']=="2"){
        			     $verSe=$row['PI'];   
        			}else if ($row['tipoRegistro']=="3"){
        			     $verSe=$row['RECE'];   
        			}
        			
        			
        			
        			$datos[] =  $verSe;
        			$datos[] =  $row['edad'];
        			$datos[] =  $row['camHos1'];
        			
        		
        			
        		}
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos,JSON_UNESCAPED_UNICODE);
        
        }
		else if($function =="buscarProcedVinculado"){
			$id = $_POST['procePAt'];
			// echo "El valor de id es: " . htmlspecialchars($id);

			try {
				$stmt = $conn->prepare("SELECT `codCompatible` FROM `tbl_tipoEstudioProced` WHERE `idtpo` = :id");
				$stmt->bindParam(':id', $id, PDO::PARAM_INT); // Usar parámetros preparados
				$stmt->execute();
				
				// Obtener solo el primer resultado
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				
				if ($row) {
					// Devolver solo el valor de 'cmp'
					echo json_encode($row['codCompatible'], JSON_UNESCAPED_UNICODE);
				} else {
					// Si no se encuentra ningún resultado, puedes devolver un mensaje o un valor por defecto
					echo json_encode(null, JSON_UNESCAPED_UNICODE);
				}
			
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
			
		}
		else if($function =="buscarUsuarioVinculado"){
			$id = $_POST['id'];
			// echo "El valor de id es: " . htmlspecialchars($id);

			try {
				$stmt = $conn->prepare("SELECT `codCompatible` FROM `usuarios` WHERE `id` = :id");
				$stmt->bindParam(':id', $id, PDO::PARAM_INT); // Usar parámetros preparados
				$stmt->execute();
				
				// Obtener solo el primer resultado
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				
				if ($row) {
					
					echo json_encode($row['codCompatible'], JSON_UNESCAPED_UNICODE);
				} else {
					// Si no se encuentra ningún resultado, puedes devolver un mensaje o un valor por defecto
					echo json_encode(null, JSON_UNESCAPED_UNICODE);
				}
			
			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
			
		}
		else if($function =="buscarMedicoVinculado"){
				
			$primerNombre = $_POST['primerNombre'];
			$segundoNombre = $_POST['segundoNombre'];
			$primerApellido = $_POST['primerApellido'];
			$segundoApellido = $_POST['segundoApellido'];
			
			try {
				// Ajustamos la consulta para usar OR entre las condiciones
				$sql = "SELECT rne, dni FROM tbl_medicoasistenciales 
						WHERE 
						datos LIKE :primerNombre 
						AND datos LIKE :segundoNombre 
						AND datos LIKE :primerApellido 
						AND datos LIKE :segundoApellido 
						LIMIT 1";
			
				$stmt = $conn->prepare($sql);
				
				// Binding de los valores
				$stmt->bindValue(':primerNombre', '%' . $primerNombre . '%', PDO::PARAM_STR);
				$stmt->bindValue(':segundoNombre', '%' . $segundoNombre . '%', PDO::PARAM_STR);
				$stmt->bindValue(':primerApellido', '%' . $primerApellido . '%', PDO::PARAM_STR);
				$stmt->bindValue(':segundoApellido', '%' . $segundoApellido . '%', PDO::PARAM_STR);
				
				$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
			
				if ($result) {
					// Retornar el resultado si hay coincidencias
					echo json_encode($result, JSON_UNESCAPED_UNICODE);
				} else {
					// Retornar un JSON que indique que no se encontraron resultados
					echo json_encode(['found' => false]);
				}
				
			} catch (PDOException $e) {
				echo json_encode(['error' => $e->getMessage()]); // Retornar el error en JSON
			}
			
			
			
			
			

			
		}
		else if($function=="eliminarRegistro"){
        
        	$id = $_GET['idPato'];
        	

        	$datos = array();
        
        	try {
        		
        		$stmt = $conn->prepare("DELETE  FROM `tbl_registroPacientesPatologia` WHERE `idPato` = '$id'" );
        		//$stmt->execute();
        		if($stmt->execute()){
					$mensaje ='Registro Eliminado';
				}else{
					$mensaje ='No se pudo eliminar el Registro';
				}
        
				
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        
        }
        
        
        else if($function=="registroPatologiaEditar"){
        
        	$id = $_GET['id'];
        
    
        	$datos = array();
        
        	try {
        		
        		$stmt = $conn->prepare("SELECT `tbl_registroPacientesPatologia`.`idPato`, 
												`tbl_registroPacientesPatologia`.`iduser`, 
												`tbl_registroPacientesPatologia`.`tipodoc`, 
												`tbl_registroPacientesPatologia`.`nrodoc`, 
												`tbl_registroPacientesPatologia`.`paciente`,
												`tbl_registroPacientesPatologia`.`edad`,
												`tbl_registroPacientesPatologia`.`sexo`, 
												`tbl_registroPacientesPatologia`.`finaciamiento`,
												`tbl_registroPacientesPatologia`.`ipress`, 
												`tbl_registroPacientesPatologia`.`jurisdiccion`,
												`tbl_registroPacientesPatologia`.`cuenta`, 
												`tbl_registroPacientesPatologia`.`historia`, 
												`tbl_registroPacientesPatologia`.`servicio`,
												`tbl_registroPacientesPatologia`.`salacama`,
												`tbl_registroPacientesPatologia`.`celular`,
												`tbl_registroPacientesPatologia`.`nroOrden`, 
												`tbl_registroPacientesPatologia`.`anio`, 
												`tbl_registroPacientesPatologia`.`fechaReg`, 
												`tbl_registroPacientesPatologia`.`fechaModificacion`, 
												`tbl_registroPacientesPatologia`.`nroFactura`, 
												`tbl_registroPacientesPatologia`.`tipoEstudio`, 
												`tbl_registroPacientesPatologia`.`procedimiento`, 
												`tbl_registroPacientesPatologia`.`medicoSolicitante`, 
												`tbl_registroPacientesPatologia`.`especialidad`, 
												`tbl_registroPacientesPatologia`.`fechaRecepcion`,
												`tbl_registroPacientesPatologia`.`corPat`, 
												`tbl_registroPacientesPatologia`.`anaMuestraCito`, 
												`tbl_registroPacientesPatologia`.`procedRealCito`, 
												`tbl_registroPacientesPatologia`.`medicoSolcit`,
												`tbl_registroPacientesPatologia`.`dxClinicoHi`, 
												`tbl_registroPacientesPatologia`.`interpretacPato`, 
												`tbl_registroPacientesPatologia`.`comentarioPatol`, 
												`tbl_registroPacientesPatologia`.`notaPatol`, 
												`tbl_registroPacientesPatologia`.`idReportPdf`, 
												`tbl_registroPacientesPatologia`.`fechaHoraReport`, 
												`tbl_registroPacientesPatologia`.`fechaUltimaRegla`, 
												`tbl_registroPacientesPatologia`.`listEmbarazo`,
												`tbl_registroPacientesPatologia`.`listMetodoAnti`, 
												`tbl_registroPacientesPatologia`.`listTipoMetodoAntic`, 
												`tbl_registroPacientesPatologia`.`TiempoUso`, 
												`tbl_registroPacientesPatologia`.`listExaGineco`, 
												`tbl_registroPacientesPatologia`.`obsExamenGinec`, 
												`tbl_registroPacientesPatologia`.`calidEspec`, 
												`tbl_registroPacientesPatologia`.`especifiqueCalidadEspec`, 
												`tbl_registroPacientesPatologia`.`clasificacionGen`,
												`tbl_registroPacientesPatologia`.`EspecclasificacionGen`, 
												`tbl_registroPacientesPatologia`.`EspecCelulasEndoCervicales`, 
												`tbl_registroPacientesPatologia`.`celulasEscamosas`, 
												`tbl_registroPacientesPatologia`.`especelulasEscamosas`, 
												`tbl_registroPacientesPatologia`.`celGlandu`, 
												`tbl_registroPacientesPatologia`.`NroOrdenReceta`, 
												`tbl_registroPacientesPatologia`.`espeCelGlandu`, 
												`tbl_registroPacientesPatologia`.`fechaConcySuger`, 
												`tbl_registroPacientesPatologia`.`dxRealizadoLab`, 
												`tbl_registroPacientesPatologia`.`fechalab`, 
												`tbl_registroPacientesPatologia`.`nomObtencionMuestras`, 
												`tbl_registroPacientesPatologia`.`profeCargo`, 
												`tbl_registroPacientesPatologia`.`fechaObtencMuestra`, 
												`tbl_registroPacientesPatologia`.`fechaColoscopia`, 
												`tbl_registroPacientesPatologia`.`especifColoscopia`, 
												`tbl_registroPacientesPatologia`.`dxAnterior`, 
												`tbl_registroPacientesPatologia`.`fechadxAnterior`, 
												`tbl_registroPacientesPatologia`.`exiteNeo_Informe`,
												`tbl_registroPacientesPatologia`.`otrNeoMalig`,
												`tbl_registroPacientesPatologia`.`celulBenignos`, 
												`tbl_registroPacientesPatologia`.`especifTipoOrg`, 
												`tbl_registroPacientesPatologia`.`cambioReactivos`, 
												`tbl_registroPacientesPatologia`.`espeCambioReac`, 
												`tbl_registroPacientesPatologia`.`patronHormonal`, 
												`tbl_registroPacientesPatologia`.`especifPatronHor`, 
												`tbl_registroPacientesPatologia`.`datosResposanble`, 
												`tbl_registroPacientesPatologia`.`colegioResp`, 
												`tbl_registroPacientesPatologia`.`nomApeConfir`,
												`tbl_registroPacientesPatologia`.`colegConfirma`, 
												`tbl_registroPacientesPatologia`.`idAuditorAsignado`, 
												`tbl_registroPacientesPatologia`.`idGeneraInforme`,
												`tbl_registroPacientesPatologia`.`txtAreaConclusiones`, 
												`tbl_registroPacientesPatologia`.`tipoServicoPatl`, 
												`tbl_registroPacientesPatologia`.`selecConvenio`, 
												`tbl_registroPacientesPatologia`.`ipressConvenio`,
												`tbl_registroPacientesPatologia`.`nomApeConfirApepat`, 
												`tbl_registroPacientesPatologia`.`subproc`,
												`tbl_registroPacientesPatologia`.`NroSerie`,
												`tbl_registroPacientesPatologia`.`NroDocumento`,
												`tbl_registroPacientesPatologia`.`CtaVinculada`,
												`tbl_registroPacientesPatologia`.`ServicioCuentaVinculada`,
												`tbl_registroPacientesPatologia`.`NroOrdenVincuBoleta`,
												`tbl_registroPacientesPatologia`.`IdNumMovimiento`,
												`tbl_registroPacientesPatologia`.`NroOrdenMovimiento`,
												`tbl_registroPacientesPatologia`.`cantidadProc`,
												`tbl_registroPacientesPatologia`.`NumeroProced`,
												`tbl_registroPacientesPatologia_Detalle`.`tipoEstudio` as tipoEstudioDetalle,
												`tbl_registroPacientesPatologia_Detalle`.`procedimiento` as procedimientoDetalle,
												`tbl_registroPacientesPatologia_Detalle`.`subproc` as subprocDetalle,
												`tbl_registroPacientesPatologia_Detalle`.`cantidadProc` as cantidadProcDetalle
												
				
        		FROM `tbl_registroPacientesPatologia`
                        LEFT JOIN `tbl_registroPacientesPatologia_Detalle`
                        ON `tbl_registroPacientesPatologia`.`idPato` = `tbl_registroPacientesPatologia_Detalle`.`idPato`
				
				 WHERE `tbl_registroPacientesPatologia`.`idPato` ='$id'  LIMIT 1 " );
        		$stmt->execute();
        		
        		while($row = $stmt->fetch()) {
        			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
        			
        			$datos[] =  $row['tipodoc'];
        			$datos[] =  $row['nrodoc'];
        			$datos[] =  $row['paciente'];
        			$datos[] =  $row['edad'];
        			$datos[] =  $row['sexo'];
        			$datos[] =  $row['finaciamiento'];
        			$datos[] =  $row['ipress'];
        			$datos[] =  $row['jurisdiccion'];
        			$datos[] =  $row['cuenta'];
        			$datos[] =  $row['historia'];//10
        			$datos[] =  $row['servicio'];
        			$datos[] =  $row['salacama'];
        			$datos[] =  $row['celular'];
        			$datos[] =  $row['nroOrden'];
        			$datos[] =  $row['anio'];
        			$datos[] =  $row['nroFactura'];
        			$datos[] =  $row['tipoEstudio'];
        			$datos[] =  $row['procedimiento'];
        			$datos[] =  $row['medicoSolicitante'];
        			$datos[] =  $row['especialidad']; //20
        			$datos[] =  $row['fechaRecepcion'];
        			$datos[] =  $row['corPat'];
        			if($row['corPat']!=""){
        			    	$datos[] =  $row['anio']."-".$row['corPat'];
        			}else{
        			        $datos[] = "-";
        			}
        			
        			
        			$datos[] =  $row['anaMuestraCito'];//23
        			$datos[] =  $row['procedRealCito'];
        			$datos[] =  $row['medicoSolcit'];
        			$datos[] =  $row['dxClinicoHi'];
        			$datos[] =  $row['interpretacPato'];
        			$datos[] =  $row['comentarioPatol'];
        			$datos[] =  $row['notaPatol'];
        			$datos[] =  $row['idPato'];//30
        			$datos[] =  $row['idAuditorAsignado'];//31
        		
        		    $datos[] =  $row['fechaUltimaRegla'];//32
        		    $datos[] =  $row['listEmbarazo'];//33
        		    $datos[] =  $row['listMetodoAnti'];//31
        		    $datos[] =  $row['listTipoMetodoAntic'];//31
        		    $datos[] =  $row['TiempoUso'];//36
        		    $datos[] =  $row['listExaGineco'];//37
        		    $datos[] =  $row['obsExamenGinec'];//38
        		    $datos[] =  $row['calidEspec'];//39
        		    $datos[] =  $row['especifiqueCalidadEspec'];//31
        		    $datos[] =  $row['clasificacionGen'];//31
        		    $datos[] =  $row['EspecclasificacionGen'];//42
        		    $datos[] =  $row['celulasEscamosas'];//43
        		    $datos[] =  $row['especelulasEscamosas'];//44
        		    $datos[] =  $row['celGlandu'];//31
        		    $datos[] =  $row['espeCelGlandu'];//46
        		    $datos[] =  $row['fechaConcySuger'];//31
        		    $datos[] =  $row['dxRealizadoLab'];//31
        		    $datos[] =  $row['fechalab'];//31
        		    $datos[] =  $row['nomObtencionMuestras'];//50
        		    $datos[] =  $row['profeCargo'];//31
        		    $datos[] =  $row['fechaObtencMuestra'];//52
        		    $datos[] =  $row['fechaColoscopia'];//33
        		    $datos[] =  $row['especifColoscopia'];//31
        		    $datos[] =  $row['dxAnterior'];//31
        		    $datos[] =  $row['fechadxAnterior'];//31
        		    $datos[] =  $row['otrNeoMalig'];//31
        		    $datos[] =  $row['celulBenignos'];//31
        		    $datos[] =  $row['especifTipoOrg'];//59
        		    $datos[] =  $row['cambioReactivos'];//31
        		    $datos[] =  $row['espeCambioReac'];//31
        		    $datos[] =  $row['patronHormonal'];//31
        		    $datos[] =  $row['especifPatronHor'];//31
        		    $datos[] =  $row['datosResposanble'];//31
        		    $datos[] =  $row['colegioResp'];//31
        		    $datos[] =  $row['nomApeConfir'];//31
        		    $datos[] =  $row['colegConfirma'];//31
        		    $datos[] =  $row['idGeneraInforme'];//31
        		    $datos[] =  $row['txtAreaConclusiones'];//31
        		    
        		    $datos[] =  $row['tipoServicoPatl']; //70
        		    $datos[] =  $row['selecConvenio'];
        		    $datos[] =  $row['ipressConvenio'];
        		    $datos[] =  $row['nomApeConfirApepat'];
        		    $datos[] =  $row['NroSerie'];//74
        		    $datos[] =  $row['NroDocumento'];//75
        		    $datos[] =  $row['CtaVinculada'];//76
        		    $datos[] =  $row['ServicioCuentaVinculada'];//77
        		    $datos[] =  $row['NroOrdenVincuBoleta'];//78
					$datos[] =  $row['subproc'];//79 
					$datos[] =  $row['IdNumMovimiento'];//80cantidadProc
					$datos[] =  $row['NroOrdenMovimiento'];//81
					$datos[] =  $row['cantidadProc'];//82
					$datos[] =  $row['tipoEstudioDetalle'];//83
					$datos[] =  $row['procedimientoDetalle'];//84
					$datos[] =  $row['subprocDetalle'];//85
					$datos[] =  $row['cantidadProcDetalle'];//86
					$datos[] =  $row['NroOrdenReceta'];//87 NroOrdenReceta 
					$datos[] =  $row['EspecCelulasEndoCervicales']; //88
					$datos['NumeroProced'] =  $row['NumeroProced'];//
					$datos['exiteNeo_Informe'] =  $row['exiteNeo_Informe'];

					
					
        		
        			
        		}
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos,JSON_UNESCAPED_UNICODE);
        
        }
        
        else if($function=="cuentaSearchEspecialidad"){
        
        	$id = $_GET['id'];
        	$por = explode(" | ", $id);

        	$datos = array();
        
        	try {
        		
        		$stmt = $conn->prepare("SELECT `especialidad` FROM `tbl_medicoasistenciales` WHERE `datos` LIKE '%$por[1]%'" );
        		$stmt->execute();
        		
        		while($row = $stmt->fetch()) {
        		    
        			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
        			
        			$datos[] =  $row['especialidad'];
        			
        			
        		}
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos,JSON_UNESCAPED_UNICODE);
        
        }
        
        
         else if($function=="cuentaSearCat"){
        
        	$id = $_GET['id'];
        

        	$datos = array();
        
        	try {
        		
        		$stmt = $conn->prepare("SELECT `IdCategoria` FROM `CategoriaMuestra` WHERE `Descripcion` = '$id'" );
        		$stmt->execute();
        		
        		while($row = $stmt->fetch()) {
        			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
        			
        			$datos[] =  $row['IdCategoria'];
        			
        			
        		}
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos,JSON_UNESCAPED_UNICODE);
        
        }
        
        
        else if($function=="buscarColegiatura"){
        
        	$id = $_GET['id'];
        

        	$datos = array();
        
        	try {
        		
        		$stmt = $conn->prepare("SELECT `cmp` FROM `usuarios` WHERE `id`= '$id'" );
        		$stmt->execute();
        		
        		while($row = $stmt->fetch()) {
        			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
        			
        			$datos[] =  $row['cmp'];
        			
        			
        		}
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos,JSON_UNESCAPED_UNICODE);
        
        }
        
        
        else if($function=="asignarPlantillaPre"){
        
        	$id = $_GET['id'];
        	$tipo = $_GET['tipo'];
            $select ="";
            
        	$datos = array();
        
            if($tipo==1 || $tipo==""){
                $select ="SELECT `Descripcion` FROM `PlantillasAP` WHERE `IdPlantillaAP` ='$id'";
            }else if($tipo==3){
                $select ="SELECT `Descripcion` FROM `PlantillasLab` WHERE `IdPlantillaLab` ='$id'";
            }else {
                $select ="SELECT `Descripcion` FROM `PlantillasAPMicro` WHERE `IdMicro` ='$id'";
            }
        
        	try {
        		
        		$stmt = $conn->prepare($select);
        		$stmt->execute();
        		
        		while($row = $stmt->fetch()) {
        			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
        			
        			$datos[] =  $row['Descripcion'];
        			
        			
        		}
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos,JSON_UNESCAPED_UNICODE);
        
        }



else if($function=="listEmergencias"){



    $tipo = $_GET['tipo'];
    $fi = $_GET['fi'];$ser = $_GET['ser'];
    $pa = $_GET['pa'];
    $des = $_GET['des'];
    $desde = $_GET['desde'];
    $hasta = $_GET['hasta'];
    $buscar = trim($_GET['buscar']);
    $limit='LIMIT 15';
    $sqlConsul="1";
    
    
    
    if($buscar!=""){
        $sqlConsul=" P.`cuenta` ='$buscar' AND P.`tipoRegistro`=$tipo OR P.`cuentaHsoMod`='$buscar' AND P.`tipoRegistro`=$tipo OR P.`historiaClinica`='$buscar' AND P.`tipoRegistro`=$tipo OR 
        P.`nroDoc`='$buscar' AND P.`tipoRegistro`=$tipo OR CONCAT_WS(' ',ApePaterno,ApeMaterno,nombres) LIKE '%$buscar%' AND P.`tipoRegistro`=$tipo";
        $limit='';
    }
    
    if($fi!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.financia='".$fi."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
        $limit='';
    }else
    if($fi!="" && $pa!="" && $des!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.financia='".$fi."' AND P.pab1Hos='".$pa."' AND P.`destino`='".$des."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
        $limit='';
    }else if($fi!="" && $ser!="" && $des!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.financia='".$fi."' AND P.tipoSeiN='".$ser."' AND P.`destino`='".$des."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
        $limit='';
    }
    else if($pa!="" && $des!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.pab1Hos='".$pa."' AND P.`destino`='".$des."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
        $limit='';
    }else if($ser!="" && $des!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.tipoSeiN='".$pa."' AND P.`destino`='".$des."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
        $limit='';
    }
    else if($des!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.`destino`='".$des."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
        $limit='';
    }
    else if($ser!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.`tipoSeiN`='".$ser."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
        $limit='';
    }
    
    else if($pa!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.pab1Hos='".$pa."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
        $limit='';
    }else if($fi!="" && $pa!="" && $des!=""){
        $sqlConsul="P.financia='".$fi."' AND P.pab1Hos='".$pa."' AND P.`destino`='".$des."'";
        $limit='';
    }else if($pa!="" && $des=="666"){
        $sqlConsul="P.pab1Hos='".$pa."' AND P.`destino`=''";
        $limit='';
    }else if($pa!="" && $des!=""){
        $sqlConsul="P.pab1Hos='".$pa."' AND P.`destino`='".$des."'";
        $limit='';
    }
    else if($fi!="" && $ser!="" && $des=="666"){
        $sqlConsul="P.financia='".$fi."' AND P.tipoSeiN='".$ser."' AND P.`destino`=''";
        $limit='';
    }
    else if($fi!="" && $ser!="" && $des!=""){
        $sqlConsul="P.financia='".$fi."' AND P.tipoSeiN='".$ser."' AND P.`destino`='".$des."'";
        $limit='';
    }
    else if($ser!="" && $des=="666"){
        $sqlConsul="P.tipoSeiN='".$ser."' AND P.`destino`=''";
        $limit='';
    }else if($ser!="" && $des!=""){
        $sqlConsul="P.tipoSeiN='".$ser."' AND P.`destino`='".$des."'";
        $limit='';
    }
    else if($fi!="" && $pa!=""){
        $sqlConsul="P.financia='".$fi."' AND P.pab1Hos='".$pa."'";
        $limit='';
    }else if($fi!="" && $ser!=""){
        $sqlConsul="P.financia='".$fi."' AND P.tipoSeiN='".$ser."'";
        $limit='';
    }else if($fi!=""){
        $sqlConsul="P.financia='".$fi."'";
        $limit='';
    }
    
    else if($ser!=""){
        $sqlConsul="P.tipoSeiN='".$ser."'";
        $limit='';
    }
    else if($pa!=""){
        $sqlConsul="P.pab1Hos='".$pa."'";
        $limit='';
    }else if($desde!="" && $hasta!="" && $des=="666"){
        $sqlConsul="P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' AND P.`destino`=''";
        $limit='';
    }else if($des=="666"){
        $sqlConsul="P.`destino`=''";
        $limit='';
    }else if($des!=""){
        $sqlConsul="P.`destino`='".$des."'";
        $limit='';
    }else if($desde!="" && $hasta!="" && $tipo ==2 || $desde!="" && $hasta!="" && $tipo ==1){
        $sqlConsul="P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."'";
        $limit='';
    }else if($desde!="" && $hasta!="" && $tipo ==3){
                $sqlConsul="P.fechaRegistro >='".$desde." 00:00:00' AND fechaRegistro <='".$hasta." 23:59:59'";
                $limit='';
    }
    
    $sqlx ='';
    if($tipo ==1 && $buscar!="" ){
        
        $sqlx ="SELECT P.`idEm`,(SELECT `nom` FROM `usuarios` WHERE `id` =P.`idUserRegistro`) as pax , P.`nroFua`, P.`historiaClinica`, P.`tipoDoc`, P.`nroDoc`,P.idUserRegistro,
	   (SELECT `descripcion` FROM `tipoSeguro` WHERE `idTipo`=P.`seguro`) AS seg,(SELECT `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`seguro`) as ase,
	   (SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacion`) AS ubi,(SELECT `nombre` FROM `tbl_regimen` WHERE `idRe` =P.regim) as REGI ,P.origenEmerMod,
	   (SELECT `nombre`FROM `tbl_iafas` WHERE `idIa`=P.seguro) AS IAF ,P.`sexo`,P.`cuenta` as CNTA,P.cuentaHsoMod as CNTA2 , P.`nroAfiliacion`, P.`eess`, P.`nombres`, P.`fechaNac`, P.`ApePaterno`, P.`ApeMaterno`, P.`teleFam`, P.`edad`,
		(SELECT `decripcion` FROM `tipoDestino` WHERE `idDes` = P.`destino`) AS dest, P.`fechaDestino`, P.`refeContraref`,(SELECT `descripcion` FROM `pabellones` WHERE `idPa`=P.`servicioPabellon`) as pa
		, P.`fechaIngreso`, P.`fechaAlta`, P.`montoGalenos`, P.`montoSisfar`, P.`Observaciones`,(SELECT COUNT(*) FROM `tbl_observacionesPaciente` WHERE `cuenta` = P.`cuenta`) AS SOS, P.`fechaRegistro`, P.`fechaUpdate`, P.`tipoRegistro`,P.envioA,P.estadoA, P.`actras`,
		P.`financia`, P.`regim`, P.`planSal`, P.`tipoSeiN`, P.`feSolAte`,(SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacionDes`) AS ubies, P.`ubicacionDes`, P.`tipoSeiNDes`, P.`feingreAlta`, P.`feAltaAlt`, P.`monTotalCo`, P.`monCarGar`,
		(SELECT `nombre` FROM `financiamiento` WHERE `id` =P.`financia`) as FI,P.`fuaEntre`, P.`fechaFuaEntre`,(SELECT `nombre` FROM `tbl_plansalud` WHERE `idPa` =P.`planSal`) AS PS,
		(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiN` ) AS SIG,(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiNDes` ) AS SI2,fechaAful,
		`origenEmer`, `nroRefEmer`, `eessInicio`,estancia, `subirRef`, `nvaCta`, `ctaHos`, `rsatencion`,(SELECT `nom` FROM `usuarios` WHERE `id` =P.`reciAudit`) as RECAUI, `registraAlta`,liquidador,
		`nroCxref`,(SELECT  `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`segurosAl`) AS SERAL ,P.`destino`,(SELECT `monTotalCo` FROM `tbl_Emergencias` WHERE idEm = P.`ideNew` ) as TUO,
		(SELECT nom FROM usuarios WHERE id= P.idUserLiquida) as LIQUIN,status,prioridad,P.regServiceCE 	 FROM `tbl_Emergencias`  P 
		WHERE $sqlConsul AND origenEmerMod IS NULL OR $sqlConsul AND origenEmerMod=0  ORDER BY P.idEm DESC $limit";
        //monTotalCo
    
        
    }
   else if($tipo ==1 ){
        //destino
        $sqlx ="SELECT P.`idEm`,(SELECT `nom` FROM `usuarios` WHERE `id` =P.`idUserRegistro`) as pax , P.`nroFua`, P.`historiaClinica`, P.`tipoDoc`, P.`nroDoc`,P.idUserRegistro,
	   (SELECT `descripcion` FROM `tipoSeguro` WHERE `idTipo`=P.`seguro`) AS seg,(SELECT `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`seguro`) as ase,
	   (SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacion`) AS ubi,(SELECT `nombre` FROM `tbl_regimen` WHERE `idRe` =P.regim) as REGI ,P.origenEmerMod,
	   (SELECT `nombre`FROM `tbl_iafas` WHERE `idIa`=P.seguro) AS IAF ,P.`sexo`,P.`cuenta` as CNTA,P.cuentaHsoMod as CNTA2 , P.`nroAfiliacion`, P.`eess`, P.`nombres`, P.`fechaNac`, P.`ApePaterno`, P.`ApeMaterno`, P.`teleFam`, P.`edad`,
		(SELECT `decripcion` FROM `tipoDestino` WHERE `idDes` = P.`destino`) AS dest, P.`fechaDestino`, P.`refeContraref`,(SELECT `descripcion` FROM `pabellones` WHERE `idPa`=P.`servicioPabellon`) as pa
		, P.`fechaIngreso`, P.`fechaAlta`, P.`montoGalenos`, P.`montoSisfar`, P.`Observaciones`,(SELECT COUNT(*) FROM `tbl_observacionesPaciente` WHERE `cuenta` = P.`cuenta`) AS SOS, P.`fechaRegistro`, P.`fechaUpdate`, P.`tipoRegistro`,P.envioA,P.estadoA, P.`actras`,
		P.`financia`, P.`regim`, P.`planSal`, P.`tipoSeiN`, P.`feSolAte`,(SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacionDes`) AS ubies, P.`ubicacionDes`, P.`tipoSeiNDes`, P.`feingreAlta`, P.`feAltaAlt`, P.`monTotalCo`, P.`monCarGar`,
		(SELECT `nombre` FROM `financiamiento` WHERE `id` =P.`financia`) as FI,P.`fuaEntre`, P.`fechaFuaEntre`,(SELECT `nombre` FROM `tbl_plansalud` WHERE `idPa` =P.`planSal`) AS PS,
		(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiN` ) AS SIG,(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiNDes` ) AS SI2,fechaAful,
		`origenEmer`, `nroRefEmer`, `eessInicio`,estancia, `subirRef`, `nvaCta`, `ctaHos`, `rsatencion`,(SELECT `nom` FROM `usuarios` WHERE `id` =P.`reciAudit`) as RECAUI, `registraAlta`,liquidador,
		`nroCxref`,(SELECT  `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`segurosAl`) AS SERAL ,P.`destino`,(SELECT `monTotalCo` FROM `tbl_Emergencias` WHERE idEm = P.`ideNew` ) as TUO,
		(SELECT nom FROM usuarios WHERE id= P.idUserLiquida) as LIQUIN,status,prioridad,P.regServiceCE 	 FROM `tbl_Emergencias`  P 
		WHERE P.`tipoRegistro`=$tipo  AND $sqlConsul AND origenEmerMod IS NULL OR  P.`tipoRegistro`=$tipo AND $sqlConsul AND origenEmerMod=0  ORDER BY P.idEm DESC $limit";
        //monTotalCo
    
        
    } else if($tipo ==2 && $buscar!=""){
        
        
        $sqlx ="SELECT P.`idEm`,(SELECT `nom` FROM `usuarios` WHERE `id` =P.`idUserRegistro`) as pax , P.`nroFua`, P.`historiaClinica`, P.`tipoDoc`, P.`nroDoc`,P.idUserRegistro,
	   (SELECT `descripcion` FROM `tipoSeguro` WHERE `idTipo`=P.`seguro`) AS seg,(SELECT `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`seguro`) as ase,
	   (SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacion`) AS ubi,(SELECT `nombre` FROM `tbl_regimen` WHERE `idRe` =P.regim) as REGI ,
	   (SELECT `nombre`FROM `tbl_iafas` WHERE `idIa`=P.seguro) AS IAF ,P.`sexo`,P.`cuenta`, P.`nroAfiliacion`, P.`eess`, P.`nombres`, P.`fechaNac`, P.`ApePaterno`, 
	   P.`ApeMaterno`, P.`teleFam`, P.`edad`,(SELECT `decripcion` FROM `tipoDestino` WHERE `idDes` = P.`destino`) AS dest, P.`fechaDestino`, P.`refeContraref`,
	   (SELECT `descripcion` FROM `pabellones` WHERE `idPa`=P.`servicioPabellon`) as pa, P.`fechaIngreso`, P.`fechaAlta`, P.`montoGalenos`, P.`montoSisfar`, P.`Observaciones`,
	   (SELECT COUNT(*) FROM `tbl_observacionesPaciente` WHERE `cuenta` = P.`cuenta`) AS SOS, P.`fechaRegistro`, P.`fechaUpdate`,P.origenEmerMod, P.`tipoRegistro`,P.envioA,P.estadoA, P.`actras`,
		P.`financia`, P.`regim`, P.`planSal`, P.`tipoSeiN`, P.`feSolAte`,(SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacionDes`) AS ubies, P.`ubicacionDes`, P.`tipoSeiNDes`, P.`feingreAlta`, P.`feAltaAlt`, P.`monTotalCo`, P.`monCarGar`,
		(SELECT `nombre` FROM `financiamiento` WHERE `id` =P.`financia`) as FI,P.`fuaEntre`, P.`fechaFuaEntre`,(SELECT `nombre` FROM `tbl_plansalud` WHERE `idPa` =P.`planSal`) AS PS,
		(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiN` ) AS SIG,(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiNDes` ) AS SI2,
		(SELECT `descripcion` FROM `pabellones` WHERE `idPa` = P.pab1Hos) AS PI,(SELECT `descripcion` FROM `pabellones` WHERE `idPa` = P.pab2Hos) AS PE,camHos2,camHos1,fechaAful,
		`origenEmer`, `nroRefEmer`, `eessInicio`, estancia,`subirRef`, `nvaCta`, `ctaHos`,P.cuentaHsoMod as CNTA,P.`cuenta` as CNTA2, `rsatencion`, (SELECT `nom` FROM `usuarios` WHERE `id` =P.`reciAudit`) as RECAUI, `registraAlta`,liquidador,`nroCxref`,
		(SELECT  `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`segurosAl`) AS SERAL,P.`destino`,(SELECT `monTotalCo` FROM `tbl_Emergencias` WHERE `idEm` = P.`ideNew` ) as TUO,
		(SELECT nom FROM usuarios WHERE id= P.idUserLiquida) as LIQUIN,status, (SELECT  montoGalenos FROM tbl_Emergencias WHERE idEm=P.ideNew) AS M1,(SELECT  montoSisfar FROM tbl_Emergencias WHERE idEm=P.ideNew) AS M2,prioridad,P.regServiceCE 
		FROM `tbl_Emergencias` P  WHERE $sqlConsul OR $sqlConsul AND origenEmerMod IN(1,2)  ORDER BY P.idEm DESC $limit";
       // echo $sqlx;
        
    }else if($tipo ==2){
        
        
        $sqlx ="SELECT P.`idEm`,(SELECT `nom` FROM `usuarios` WHERE `id` =P.`idUserRegistro`) as pax , P.`nroFua`, P.`historiaClinica`, P.`tipoDoc`, P.`nroDoc`,P.idUserRegistro,
	   (SELECT `descripcion` FROM `tipoSeguro` WHERE `idTipo`=P.`seguro`) AS seg,(SELECT `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`seguro`) as ase,
	   (SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacion`) AS ubi,(SELECT `nombre` FROM `tbl_regimen` WHERE `idRe` =P.regim) as REGI ,
	   (SELECT `nombre`FROM `tbl_iafas` WHERE `idIa`=P.seguro) AS IAF ,P.`sexo`,P.`cuenta`, P.`nroAfiliacion`, P.`eess`, P.`nombres`, P.`fechaNac`, P.`ApePaterno`, 
	   P.`ApeMaterno`, P.`teleFam`, P.`edad`,(SELECT `decripcion` FROM `tipoDestino` WHERE `idDes` = P.`destino`) AS dest, P.`fechaDestino`, P.`refeContraref`,
	   (SELECT `descripcion` FROM `pabellones` WHERE `idPa`=P.`servicioPabellon`) as pa, P.`fechaIngreso`, P.`fechaAlta`, P.`montoGalenos`, P.`montoSisfar`, P.`Observaciones`,
	   (SELECT COUNT(*) FROM `tbl_observacionesPaciente` WHERE `cuenta` = P.`cuenta`) AS SOS, P.`fechaRegistro`, P.`fechaUpdate`,P.origenEmerMod, P.`tipoRegistro`,P.envioA,P.estadoA, P.`actras`,
		P.`financia`, P.`regim`, P.`planSal`, P.`tipoSeiN`, P.`feSolAte`,(SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacionDes`) AS ubies, P.`ubicacionDes`, P.`tipoSeiNDes`, P.`feingreAlta`, P.`feAltaAlt`, P.`monTotalCo`, P.`monCarGar`,
		(SELECT `nombre` FROM `financiamiento` WHERE `id` =P.`financia`) as FI,P.`fuaEntre`, P.`fechaFuaEntre`,(SELECT `nombre` FROM `tbl_plansalud` WHERE `idPa` =P.`planSal`) AS PS,
		(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiN` ) AS SIG,(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiNDes` ) AS SI2,
		(SELECT `descripcion` FROM `pabellones` WHERE `idPa` = P.pab1Hos) AS PI,(SELECT `descripcion` FROM `pabellones` WHERE `idPa` = P.pab2Hos) AS PE,camHos2,camHos1,fechaAful,
		`origenEmer`, `nroRefEmer`, `eessInicio`, estancia,`subirRef`, `nvaCta`, `ctaHos`,P.cuentaHsoMod as CNTA,P.`cuenta` as CNTA2, `rsatencion`, (SELECT `nom` FROM `usuarios` WHERE `id` =P.`reciAudit`) as RECAUI, `registraAlta`,liquidador,`nroCxref`,
		(SELECT  `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`segurosAl`) AS SERAL,P.`destino`,(SELECT `monTotalCo` FROM `tbl_Emergencias` WHERE `idEm` = P.`ideNew` ) as TUO,
		(SELECT nom FROM usuarios WHERE id= P.idUserLiquida) as LIQUIN,status, (SELECT  montoGalenos FROM tbl_Emergencias WHERE idEm=P.ideNew) AS M1,(SELECT  montoSisfar FROM tbl_Emergencias WHERE idEm=P.ideNew) AS M2,prioridad,P.regServiceCE 
		FROM `tbl_Emergencias` P  WHERE $sqlConsul AND P.`tipoRegistro`=$tipo OR $sqlConsul AND origenEmerMod IN(1,2)  ORDER BY P.idEm DESC $limit";
       // echo $sqlx;
        
    } else if($tipo ==3 && $buscar!=""){
        
           
        
            $sqlx ="SELECT P.`idEm`,(SELECT `nom` FROM `usuarios` WHERE `id` =P.`idUserRegistro`) as pax , P.`nroFua`, P.`historiaClinica`, P.`tipoDoc`, P.`nroDoc`,
    	   (SELECT `descripcion` FROM `tipoSeguro` WHERE `idTipo`=P.`seguro`) AS seg,(SELECT `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`seguro`) as ase,
    	   (SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacion`) AS ubi,(SELECT `nombre` FROM `tbl_regimen` WHERE `idRe` =P.regim) as REGI ,
    	   (SELECT `nombre`FROM `tbl_iafas` WHERE `idIa`=P.seguro) AS IAF ,P.`sexo`,P.`cuenta`, P.`nroAfiliacion`, P.`eess`, P.`nombres`, P.`fechaNac`, P.`ApePaterno`, 
    	   P.`ApeMaterno`, P.`teleFam`, P.`edad`,(SELECT `decripcion` FROM `tipoDestino` WHERE `idDes` = P.`destino`) AS dest, P.`fechaDestino`, P.`refeContraref`,
    	   (SELECT `descripcion` FROM `pabellones` WHERE `idPa`=P.`servicioPabellon`) as pa,P.idUserRegistro, P.`fechaIngreso`, P.`fechaAlta`, P.`montoGalenos`, P.`montoSisfar`,
    	   P.`Observaciones`,(SELECT COUNT(*) FROM `tbl_observacionesPaciente` WHERE `cuenta` = P.`cuenta`) AS SOS, P.`fechaRegistro`, P.`fechaUpdate`,P.origenEmerMod, P.`tipoRegistro`,P.envioA,P.estadoA, P.`actras`,
    		P.`financia`, P.`regim`, P.`planSal`, P.`tipoSeiN`, P.`feSolAte`,(SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacionDes`) AS ubies, P.`ubicacionDes`, P.`tipoSeiNDes`, P.`feingreAlta`, P.`feAltaAlt`, P.`monTotalCo`, P.`monCarGar`,
    		(SELECT `nombre` FROM `financiamiento` WHERE `id` =P.`financia`) as FI,P.`fuaEntre`, P.`fechaFuaEntre`,(SELECT `nombre` FROM `tbl_plansalud` WHERE `idPa` =P.`planSal`) AS PS,
    		(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiN` ) AS SIG,(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiNDes` ) AS SI2,
    		(SELECT `descripcion` FROM `pabellones` WHERE `idPa` = P.pab1Hos) AS PI,(SELECT `descripcion` FROM `pabellones` WHERE `idPa` = P.pab2Hos) AS PE,camHos2,camHos1,fechaAful,
    		`origenEmer`, `nroRefEmer`, `eessInicio`, estancia,`subirRef`, `nvaCta`, `ctaHos`,P.cuentaHsoMod as CNTA,P.`cuenta` as CNTA2, `rsatencion`, (SELECT `nom` FROM `usuarios` WHERE `id` =P.`reciAudit`) as RECAUI, `registraAlta`,liquidador,`nroCxref`,
    		(SELECT  `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`segurosAl`) AS SERAL,P.`destino`,(SELECT `monTotalCo` FROM `tbl_Emergencias` WHERE `idEm` = P.`ideNew` ) as TUO,
    		(SELECT nom FROM usuarios WHERE id= P.idUserLiquida) as LIQUIN,status, (SELECT  montoGalenos FROM tbl_Emergencias WHERE idEm=P.ideNew) AS M1,(SELECT  montoSisfar FROM tbl_Emergencias WHERE idEm=P.ideNew) AS M2,prioridad,P.regServiceCE 
    		FROM `tbl_Emergencias` P  WHERE  P.`tipoRegistro`=$tipo AND $sqlConsul  ORDER BY P.idEm DESC $limit";
    		
        
    }else if($tipo ==3){
        
     
        
        $sqlx ="SELECT P.`idEm`,(SELECT `nom` FROM `usuarios` WHERE `id` =P.`idUserRegistro`) as pax , P.`nroFua`, P.`historiaClinica`, P.`tipoDoc`, P.`nroDoc`,
	   (SELECT `descripcion` FROM `tipoSeguro` WHERE `idTipo`=P.`seguro`) AS seg,(SELECT `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`seguro`) as ase,
	   (SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacion`) AS ubi,(SELECT `nombre` FROM `tbl_regimen` WHERE `idRe` =P.regim) as REGI ,
	   (SELECT `nombre`FROM `tbl_iafas` WHERE `idIa`=P.seguro) AS IAF ,P.`sexo`,P.`cuenta`, P.`nroAfiliacion`, P.`eess`, P.`nombres`, P.`fechaNac`, P.`ApePaterno`, 
	   P.`ApeMaterno`, P.`teleFam`, P.`edad`,(SELECT `decripcion` FROM `tipoDestino` WHERE `idDes` = P.`destino`) AS dest, P.`fechaDestino`, P.`refeContraref`,
	   (SELECT `descripcion` FROM `pabellones` WHERE `idPa`=P.`servicioPabellon`) as pa,P.idUserRegistro, P.`fechaIngreso`, P.`fechaAlta`, P.`montoGalenos`, P.`montoSisfar`,
	   P.`Observaciones`,(SELECT COUNT(*) FROM `tbl_observacionesPaciente` WHERE `cuenta` = P.`cuenta`) AS SOS, P.`fechaRegistro`, P.`fechaUpdate`,P.origenEmerMod, P.`tipoRegistro`,P.envioA,P.estadoA, P.`actras`,
		P.`financia`, P.`regim`, P.`planSal`, P.`tipoSeiN`, P.`feSolAte`,(SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacionDes`) AS ubies, P.`ubicacionDes`, P.`tipoSeiNDes`, P.`feingreAlta`, P.`feAltaAlt`, P.`monTotalCo`, P.`monCarGar`,
		(SELECT `nombre` FROM `financiamiento` WHERE `id` =P.`financia`) as FI,P.`fuaEntre`, P.`fechaFuaEntre`,(SELECT `nombre` FROM `tbl_plansalud` WHERE `idPa` =P.`planSal`) AS PS,
		(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiN` ) AS SIG,(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiNDes` ) AS SI2,
		(SELECT `descripcion` FROM `pabellones` WHERE `idPa` = P.pab1Hos) AS PI,(SELECT `descripcion` FROM `pabellones` WHERE `idPa` = P.pab2Hos) AS PE,camHos2,camHos1,fechaAful,
		`origenEmer`, `nroRefEmer`, `eessInicio`, estancia,`subirRef`, `nvaCta`, `ctaHos`,P.cuentaHsoMod as CNTA,P.`cuenta` as CNTA2, `rsatencion`, (SELECT `nom` FROM `usuarios` WHERE `id` =P.`reciAudit`) as RECAUI, `registraAlta`,liquidador,`nroCxref`,
		(SELECT  `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`segurosAl`) AS SERAL,P.`destino`,(SELECT `monTotalCo` FROM `tbl_Emergencias` WHERE `idEm` = P.`ideNew` ) as TUO,
		(SELECT nom FROM usuarios WHERE id= P.idUserLiquida) as LIQUIN,status, (SELECT  montoGalenos FROM tbl_Emergencias WHERE idEm=P.ideNew) AS M1,(SELECT  montoSisfar FROM tbl_Emergencias WHERE idEm=P.ideNew) AS M2,prioridad,P.regServiceCE 
		FROM `tbl_Emergencias` P  WHERE  P.`tipoRegistro`=$tipo AND $sqlConsul ORDER BY P.idEm DESC $limit";
       // echo $sqlx;
        
    } 
    
    //echo $sqlx;

       $stmt = $conn->prepare($sqlx);
	   $stmt->execute();


	
	try {
			
		
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['idEm'] 					= $row["idEm"];
		    $nestedData['regServiceCE'] 					= $row["regServiceCE"];
		    
		    $nestedData['prioridad'] 					= $row["prioridad"];
		    
		    $nestedData['M1'] 						= $row["M1"];
		    $nestedData['M2'] 						= $row["M2"];
		    
			$nestedData['idUserRegistro'] 			= strtoupper($row["pax"]);
			$poe='';
			if(strlen($row["nroFua"])>8){
			        $poe=$row["nroFua"];    
			}
			
			
			$nestedData['nroFua'] 					= $poe;
			$tipc='';
			if($row["tipoDoc"]==1){
			    	$tipc='DNI';
			}else if($row["tipoDoc"]==2){
			    	$tipc='CARNET EXT';
			}
			else if($row["tipoDoc"]==3){
			    	$tipc='PASAPORTE';
			}
			else if($row["tipoDoc"]==4){
			    	$tipc='CODIGO RECIEN NACIDO (CUI)';
			}
			else if($row["tipoDoc"]==5){
			    	$tipc='DOC. IDENT. EXTRANJERA';
			}
			else if($row["tipoDoc"]==6){
			    	$tipc='SIN DOC';
			}
			
			
			
			$nestedData['tipoDoc'] 				= $tipc;
			$nestedData['FI'] 					= strtoupper($row["FI"]);
			$nestedData['historiaClinica'] 		= $row["historiaClinica"];
			$stat='';
			if($row["status"]=="ACTIVO" && $row["tipoDoc"]!="6"){
			    $stat='<a style="color:white;font-size: 1px;"><i class="fa fa-check" style="font-size: 18px;color: #26B99A;"></i>ACTIVO</a>';
			}else{
			    $stat='<a style="color: white;font-size: 1px;"><i class="fa fa-close" style="font-size: 18px;color: red;"></i>CONSULTAR</a>';
			}
			$nestedData['status'] 		        = $stat;
			
			//
			$origini='';
			if($row["origenEmer"]=="1"){
			    $origini='DOMICILIO';
			}else if($row["origenEmer"]=="2"){
			    $origini='ACCIDENTE DE TRANSITO';
			}else if($row["origenEmer"]=="3"){
			    $origini='REFERENCIA';
			}
			else if($row["origenEmer"]=="4"){
			    $origini='EMERGENCIA';
			}else if($row["origenEmer"]=="5"){
			    $origini='HOSPITALIZACION';
			}else if($row["origenEmer"]=="6"){
			    $origini='CONSULTA EXTERNA';
			}
			
			
			$nestedData['origenEmer'] 		= $origini;
			$nestedData['nroRefEmer'] 		= $row["nroRefEmer"];
			$nestedData['eessInicio'] 		= $row["eessInicio"];
			$nestedData['subirRef'] 		= $row["subirRef"];
			$nestedData['liquidador'] 		= strtoupper($row["LIQUIN"]);
			$nestedData['CUENSX'] 		    =$row["eess"]; //$row["CUENSX"];
			$nestedData['CUENSX2'] 		    = $row["nroCxref"];//$row["CUENSX2"];
			$nestedData['idUserLiquida'] 	= $row["idUserLiquida"];
			
			$nestedData['CUENSXRef'] 		    = $row["CUENSXRef"];
			$nestedData['CUENSXRef2'] 		    = $row["CUENSXRef2"];
			$nestedData['estancia'] 		    = $row["estancia"];
			$nestedData['monTotalCo'] 				= $row["monTotalCo"];
			$nestedData['TUO'] 		    = $row["TUO"];
			$monToaxp =$row["monTotalCo"] + $row["TUO"];
			
			//$nestedData['totali'] 				= $row["monTotalCo"] + $row["TUO"] ;
			
			$nestedData['totali'] 				= ( $monToaxp !='') ? number_format($monToaxp, 2, ".", ""):"-";
			
			//fechaAlta
			$novo='';
			if($row["nvaCta"]=="1"){
			    $novo='PARTICULAR';
			}else if($row["nvaCta"]=="2"){
			    $novo='SIS';
			}else if($row["nvaCta"]=="3"){
			    $novo='SOAT';
			}else if($row["nvaCta"]=="4"){
			    $novo='MTC';
			}
			$nestedData['nvaCta'] 	 	    = $novo;
			$nestedData['ctaHos'] 		    = $row["ctaHos"];
			$nestedData['rsatencion'] 		= strtoupper($row["rsatencion"]);
			$nestedData['reciAudit'] 		= strtoupper($row["RECAUI"]);
			$nestedData['registraAlta'] 	= $row["registraAlta"];
			$nestedData['nroCxref'] 		= $row["nroCxref"];
			$nestedData['segurosAl'] 		= $row["SERAL"];
			
			
			$nestedData['nroDoc'] 				= $row["nroDoc"];
			
			$ast='';
			    if($row["financia"]==3){
			        $ast=$row["ase"];
			    }else{
			        $ast=strtoupper($row["IAF"]." (".$row["REGI"].")");
			    }
			
			$nestedData['aseguradora'] 			= $row["ase"];
			$nestedData['seguro'] 				= $ast;
			$nestedData['regimen'] 						= $row["REGI"];
			$nestedData['PS'] 						= strtoupper($row["PS"]);
			
			$pao="";$pao2="";
			
			
    			    if($row["tipoRegistro"]==1){
        			    	$pao=strtoupper($row["SI2"]);
        			    	$pao2=strtoupper($row["SIG"]);
        			}else{
        			        
        			        if($row["PI"]!="" && $row["camHos1"]!="" ){
        			             $pao=strtoupper($row["PI"]." | CAMA:".$row["camHos1"]);
        			        }else if($row["PI"]!=""){
        			             $pao=strtoupper($row["PI"]);
        			        }else if($row["camHos1"]!=""){
        			             $pao=strtoupper($row["camHos1"]);
        			        } 
        			        
        			        
        			        if($row["PE"]!="" && $row["camHos2"]!="" ){
        			            $pao2=strtoupper($row["PE"]." | CAMA:".$row["camHos2"]);
        			        }else if($row["PE"]!=""){
        			           $pao2=strtoupper($row["PE"]);  
        			        }else if($row["camHos2"]!=""){
        			           $pao2=strtoupper($row["camHos2"]);
        			        } 
        			    	
        			}
        			
        			
        //	$nestedData['ubicacionDes'] 			= $pao2;
		//	$nestedData['ubicacion'] 				= $pao;
			
			
			
			$nestedData['ubicacionDes'] 			= strtoupper($row["SIG"]);
			$nestedData['ubicacion'] 				= strtoupper($row["SI2"]);
			
			$nestedData['pabellon1'] 				= strtoupper($row["PI"]);
            $nestedData['camaX1'] 				= $row["camHos1"];
            
			$nestedData['pabellon2'] 				= strtoupper($row["PE"]);
			$nestedData['camaX2'] 				= $row["camHos2"];
			
			//ubicacion,ubicacionDes
			$sex='';
			if($row["sexo"]==1){
			        $sex='M';    
			}else{
			    $sex='F';    
			}
			$nestedData['sexo'] 					= $sex;
			
			$nestedData['cuenta2'] 					= $row["CNTA2"];
			
			$nop='';
			if($row["origenEmerMod"]==2 && $row["tipoRegistro"]==2){
			    $nop=$row["CNTA2"];
			}else if($row["origenEmerMod"]==0 && $row["tipoRegistro"]==2){
			    $nop=$row["CNTA2"];
			}else if($row["origenEmerMod"]==1 && $row["tipoRegistro"]==2){
			    $nop=$row["CNTA"];
			}else if($row["tipoRegistro"]==3){
			    $nop=$row["CNTA2"];
			}else{
			    $nop=$row["CNTA"];
			}
			
			$nestedData['cuenta'] 					= $nop;
			$nestedData['actras'] 					= $row["actras"];
			$nestedData['nroAfiliacion'] 			= $row["nroAfiliacion"];
			$nestedData['eess'] 				    = strtoupper($row["eess"]);
			$nestedData['paciente'] 				= strtoupper($row["ApePaterno"]." ".$row["ApeMaterno"]." ".$row["nombres"]);
			$nestedData['teleFam'] 					= $row["teleFam"];
			$nestedData['edad'] 					= strtoupper($row["edad"]);
			$nu="";
			if($row["dest"]!=""){
			    	$nu=$row["dest"];
			}
			$nestedData['destino'] 					= $nu;
			$nestedData['fechaDestino'] 			= $row["fechaDestino"];
			$nestedData['estadoA'] 					= $row["estadoA"];
			$nestedData['refeContraref'] 			= $row["refeContraref"];
			$nestedData['servicioPabellon'] 		= strtoupper($row["pa"]);
			
			$fi='';($row['fechaIngreso']!="") ? $fi=date('d/m/Y H:i:s',strtotime($row['fechaIngreso'])): $fi='-';
			$nestedData['fechaIngreso'] 			= $fi;
			
			$fafil='';($row['fechaAful']!="") ? $fafil=date('d/m/Y',strtotime($row['fechaAful'])): $fafil='-';
			$nestedData['fechaAful'] 				=  $fafil;
		//	feSolAte
			
			$faslat='';($row['feSolAte']!="") ? $faslat=date('d/m/Y',strtotime($row['feSolAte'])): $faslat='-';
			$nestedData['feSolAte'] 				=  $faslat;
			
			
			$fal='';($row['feAltaAlt']!="") ? $fal=date('d/m/Y',strtotime($row['feAltaAlt'])): $fal='-';
			$nestedData['fechaAlta'] 				=  $fal;
			$nestedData['montoGalenos'] 			= strtoupper($row["montoGalenos"]);
			$nestedData['montoSisfar'] 				= $row["montoSisfar"];
			
			
			$nestedData['Observaciones'] 			= strtoupper($row["Observaciones"]);
			$nestedData['fechaRegistro']			= date('d/m/Y H:i:s',strtotime($row['fechaRegistro']));
			$nestedData['fechaReporte']				= date('Y-m-d',strtotime($row['fechaRegistro']));
			$nestedData['fechaUpdate']			    = date('d/m/Y H:i:s',strtotime($row['fechaUpdate']));
			$col='';
			
			$opciones ='';
		/*	if($row["estadoA"]=="on"){
			        $opciones ='';    
			}else{
			    
			    if($row['envioA']=="on"){
			    $col='warning';
    			}else{
    			    $col='success';
    			}
    			$opciones ='<a onclick="verPacienteEmergencia('.$row["idEm"].')" data-toggle="modal" data-target=".bs-example-modal-smEmergencia" class="btn btn-'.$col.' btn-xs" ><i class="fa fa-edit"></i> Editar</a>';
			    
			} */
			
			#b7b7b7
			//$opciones ='<a onclick="verPacienteEmergencia('.$row["idEm"].')" data-toggle="modal" data-target=".bs-example-modal-smEmergencia" class="btn btn-success btn-xs" ><i class="fa fa-edit"></i> Editar</a>';
			$stipc='';$but='';	$color="";
			
    			if($row["destino"] == "1" || $row["destino"] == "9" || $row["destino"] == "11" || $row["destino"] == "2" || $row["destino"] == "10" || $row["destino"] == "4" || $row["destino"] == "12" || $row["destino"] == "13" || $row["destino"] == "14" ){
			        $color="style='background: #b7b7b7;border: 1px solid #b7b7b7;'";
			    
    			}else if($row["financia"]==1){
			            $but='warning';
			            $color="style='background:#fd7805;border: 1px solid #fd7805;'";
			    }else if($row["Observaciones"]!="" || $row["SOS"] >= "1" ){
			     $color="style='background: #fd00b9;border: 1px solid #fd00b9;'";
			    
			    }else if($row["estancia"] >="177") {
			        $stipc='enabled';
			    	$but='danger';
			    }else if($row["destino"]==3 && $row["tipoRegistro"]==1){
			    	$stipc='enabled';
			    	$but='default';
			    }else if($row["financia"]==3 ){
			    	$color="style='background:#36b63d;border: 1px solid #36b63d;color: white;'";
			    	$but='default';
			    } else{
			        	$but='primary';
			    }
			
		
			 
			/* if($row["destino"] == "1" || $row["destino"] == "9" || $row["destino"] == "11" || $row["destino"] == "2" || $row["destino"] == "10" || $row["destino"] == "4" || $row["destino"] == "12" || $row["destino"] == "13" || $row["destino"] == "14" ){
			    $color="style='background: #b7b7b7;border: 1px solid #b7b7b7;'";
			    
			}else if($row["Observaciones"]!="" || $row["SOS"] >= "1" ){
			    $color="style='background: #fd00b9;border: 1px solid #fd00b9;'";
			    
			} */
			
			
			//destino
			$permi='';
			
			if( $tipo == 3 && $row["idUserRegistro"]== $iduser || $iduser== "80" || $iduser== "11" || $iduser== "1"  || $iduser== "12" || $iduser== "87" || $iduser== "88" ){
			    $permi='<li><a onclick="eliminarRegEmerHospi('.$row["idEm"].')" style="color: red;" ><i class="fa fa-trash"></i> Eliminar</a></li>'; 
			}
			
			 if($permisoRegistro != 1){
			
			$opciones ='<div class="btn-group" style="margin-bottom: 5px;">

				<button data-toggle="dropdown" class="btn btn-'.$but.' dropdown-toggle btn-xs" type="button" '.$stipc.' aria-expanded="false" '.$color.'>Opciones <span class="caret"></span>
				</button>
				<ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
					<li>
						<a id="'.$row["idEm"].'" onclick="verPacienteEmergencia('.$row["idEm"].')" data-toggle="modal" data-target=".bs-example-modal-smEmergencia" ><i class="fa fa-edit"></i> Editar</a>
					</li>
				'.$permi.'
				</ul>
			</div>';
			    
			 }
			    
			
				/*  P.idUserRegistro  
				<li>
						<a onclick="eliminarRegEmerHospi('.$row["idEm"].')" style="color: red;" ><i class="fa fa-trash"></i> Eliminar</a>
					</li>
		        */
			
			$nestedData['opciones'] 				= $opciones;
	
	
			
			$data[] = $nestedData;
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}




else if($function=="listCirugias"){
  
    $fiCi = $_GET['fiCi'];
    $serCi = $_GET['serCi'];
    $desde = $_GET['desde'];
    $hasta = $_GET['hasta'];
    $buscar = trim($_GET['buscar']);
    $limit='LIMIT 15';
    $sqlConsul="1";
    
    
    
    if($buscar!=""){
        $sqlConsul=" P.`paciente` LIKE '%$buscar%' OR P.`nroDoc` LIKE '%$buscar%' OR P.`historia` LIKE '%$buscar%'";
        $limit='';
    }
    else if($fiCi !=""){
        $sqlConsul="P.especialidad='".$fiCi."' ";
        $limit='';
    }else if($serCi !="" && $desde!="" && $hasta!=""){
        $sqlConsul="P.`estadoCirugia`='".$serCi."' AND P.fechaIntervencion >='".$desde."' AND fechaIntervencion <='".$hasta."'";
        $limit='';
    }else if($serCi !=""){
        $sqlConsul="P.`estadoCirugia`='".$serCi."'";
        $limit='';
    }else if($desde!="" && $hasta!=""){
        $sqlConsul="P.fechaIntervencion >='".$desde."' AND fechaIntervencion <='".$hasta."'";
        $limit='';
    }
    

        
        $sqlx ="SELECT `idPro`,R.user as USX ,`idUser`,Q.Descripcion AS ESPEXC ,`especialidad`, `tipoDOc`, `nroDoc`, `paciente`, `edad`, `historia`, `celular`, `dx`, `tipoDx`, 
        `dxPrepa`, `tipoDxPrepa`, `procedQx`,A.Descripcion AS ANEST, `tipoAnestesia`,T.Descripcion AS TipoServici, `tipoCirugia`,S.Descripcion AS SERDX ,`servicioDx`,X.Nombre AS SALACI ,`salaCirugia`, 
        `fechaIntervencion`,C.Descripcion AS TURNO, `hora`, `cirugiaIndicadaPor`, `cirujanoPrincipal`, `anestesiologo`,O.descripcion AS SERVINT ,`servicioInterno`,
        U.Descripcion AS URPA, `nroCama`,D.Descripcion AS ESTCI, `estadoCirugia`, `fechaRegistro`, `fechaActualizada` 
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
         WHERE $sqlConsul ORDER BY idPro DESC ";
       
    

       $stmt = $conn->prepare($sqlx);
	   $stmt->execute();

	try {
			
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['idPro'] 			 = $row["idPro"];
		    $nestedData['estado'] 			 = strtoupper($row["ESTCI"]);
		    $nestedData['idUser'] 			 = strtoupper($row["USX"]);
		    $nestedData['especialidad'] 	 = strtoupper($row["ESPEXC"]);
		    $nestedData['tipoDOc'] 			 = $row["tipoDOc"];
		    $nestedData['nroDoc'] 			 = $row["nroDoc"];
		    $nestedData['paciente'] 		 = strtoupper($row["paciente"]);
		    $nestedData['edad'] 			 = $row["edad"];
		    $nestedData['historia'] 		 = $row["historia"];
		    $nestedData['celular'] 			 = $row["celular"];
		    $nestedData['dx'] 			     = strtoupper($row["dx"]);
		    $nestedData['tipoDx'] 			 = $row["tipoDx"];
		    $nestedData['dxPrepa'] 			 = strtoupper($row["dxPrepa"]);
		    $nestedData['tipoDxPrepa'] 		 = $row["tipoDxPrepa"];
		    $nestedData['procedQx'] 		 = strtoupper($row["procedQx"]);
		    $nestedData['tipoAnestesia'] 	 = strtoupper($row["ANEST"]);
		    $nestedData['tipoCirugia'] 		 = strtoupper($row["TipoServici"]);
		    $nestedData['servicioDx'] 		 = strtoupper($row["SERDX"]);
		    $nestedData['salaCirugia'] 		 = strtoupper($row["SALACI"]);
		    $nestedData['fechaIntervencion'] = date('d/m/Y',strtotime($row['fechaIntervencion']));
		    $nestedData['hora'] 			 = strtoupper($row["TURNO"]);
		    $nestedData['cirugiaIndicadaPor']= $row["cirugiaIndicadaPor"];
		    $nestedData['cirujanoPrincipal'] = $row["cirujanoPrincipal"];
		    $nestedData['anestesiologo'] 	 = strtoupper($row["anestesiologo"]);
		    $nestedData['servicioInterno'] 	 = strtoupper($row["SERVINT"]);
		    $nestedData['nroCama'] 			 = strtoupper($row["URPA"]);
		    $nestedData['estadoCirugia'] 	 = strtoupper($row["estadoCirugia"]);
		    $nestedData['fechaRegistro'] 	 = date('d/m/Y H:i:s',strtotime($row['fechaRegistro']));
		    $nestedData['fechaActualizada']  = $row["fechaActualizada"];
		    
		   
			
			$opciones ='';
			$opciones ='<div class="btn-group" style="margin-bottom: 5px;">

				<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs" type="button" aria-expanded="false">Opciones <span class="caret"></span>
				</button>
				<ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
					<li>
						<a href="programacionCirugia.php?id='.$row["idPro"].'" ><i class="fa fa-edit"></i> Editar</a>
					</li>
					<li>
						<a href="reporteOperatorio.php?id='.$row["idPro"].'" ><i class="fa fa-bar-chart"></i> Reporte operatorio</a>
					</li>
                    <li>
						<a onclick="deleteRegCirugia('.$row["idPro"].')" style="color: red;"><i class="fa fa-trash"></i> Eliminar</a>
					</li>
				</ul>
			</div>';
			    
			
			
			$nestedData['opciones'] 				= $opciones;
	
	
			
			$data[] = $nestedData;
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}




else if($function=="listMuestraIndi"){
  
    $formato = $_GET['formato']; 
    $tipoest = $_GET['tipoest'];
	$id = $_GET['id'];

       $stmt = $conn->prepare("SELECT `idMu`, `muestra`, `iduser`, `fechaReg` FROM `tbl_muestraPatologia` WHERE 
	   formato='$formato' AND tipoest='$tipoest' AND idMe='$id' ORDER BY idMu DESC ");
	   $stmt->execute();

	try {
			
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['muestra'] 	= strtoupper($row["muestra"]);
			$nestedData['eli'] 		= '<input type="button" onclick="deleteMuesPato('.$row["idMu"].')" style="background: white;border: 1px solid white;color: red;font-weight: 800;" value="X">';
	
	
			
			$data[] = $nestedData;
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}


else if($function=="listReporteOperatorio"){
  
    $fiCi = $_GET['fiCi'];
    $serCi = $_GET['serCi'];
    $desde = $_GET['desde'];
    $hasta = $_GET['hasta'];
    $buscar = trim($_GET['buscar']);
    $limit='LIMIT 15';
    $sqlConsul="1";
    
    
    
    if($buscar!=""){
        $sqlConsul=" P.`paciente` LIKE '%$buscar%' OR P.`nroDoc` LIKE '%$buscar%' OR P.`historia` LIKE '%$buscar%'";
        $limit='';
    }
    else if($fiCi !=""){
        $sqlConsul="P.especialidad='".$fiCi."' ";
        $limit='';
    }else if($serCi !="" && $desde!="" && $hasta!=""){
        $sqlConsul="P.`estadoCirugia`='".$serCi."' AND P.fechaIntervencion >='".$desde."' AND fechaIntervencion <='".$hasta."'";
        $limit='';
    }else if($serCi !=""){
        $sqlConsul="P.`estadoCirugia`='".$serCi."'";
        $limit='';
    }else if($desde!="" && $hasta!=""){
        $sqlConsul="P.fechaIntervencion >='".$desde."' AND fechaIntervencion <='".$hasta."'";
        $limit='';
    }
    

        
        $sqlx ="SELECT `idPro`,R.user as USX ,`idUser`,Q.Descripcion AS ESPEXC ,`especialidad`, `tipoDOc`, `nroDoc`, `paciente`, `edad`, `historia`, `celular`, `dx`, `tipoDx`, 
        `dxPrepa`, `tipoDxPrepa`, `procedQx`,A.Descripcion AS ANEST, `tipoAnestesia`,T.Descripcion AS TipoServici, `tipoCirugia`,S.Descripcion AS SERDX ,`servicioDx`,X.Nombre AS SALACI ,`salaCirugia`, 
        `fechaIntervencion`,C.Descripcion AS TURNO, `hora`, `cirugiaIndicadaPor`, `cirujanoPrincipal`, `anestesiologo`,O.descripcion AS SERVINT ,`servicioInterno`,
        U.Descripcion AS URPA, `nroCama`,D.Descripcion AS ESTCI, `estadoCirugia`, `fechaRegistro`, `fechaActualizada`,(SELECT UPPER(des) FROM `tbl_intervencionRealizada` WHERE `idRef` = P.idPro ORDER BY fechaRegistro DESC LIMIT 1)  AS INTERQX 
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
         WHERE $sqlConsul ";
       
    

       $stmt = $conn->prepare($sqlx);
	   $stmt->execute();

	try {
			
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['id'] 			 = $row["idPro"];
		    $nestedData['estado'] 			 = strtoupper($row["ESTCI"]);
		    $nestedData['idUser'] 			 = strtoupper($row["USX"]);
		    $nestedData['especialidad'] 	 = strtoupper($row["ESPEXC"]);
		    $tipc='';
			if($row["tipoDOc"]==1){
			    	$tipc='DNI';
			}else if($row["tipoDOc"]==2){
			    	$tipc='CARNET EXT';
			}
			else if($row["tipoDOc"]==3){
			    	$tipc='PASAPORTE';
			}
			else if($row["tipoDOc"]==4){
			    	$tipc='CODIGO RECIEN NACIDO (CUI)';
			}
			else if($row["tipoDOc"]==5){
			    	$tipc='DOC. IDENT. EXTRANJERA';
			}
			else if($row["tipoDOc"]==6){
			    	$tipc='SIN DOC';
			}

		    
		    
		    $nestedData['tipoDOc'] 			 = $tipc;
		    $nestedData['nroDoc'] 			 = $row["nroDoc"];
		    $nestedData['paciente'] 		 = strtoupper($row["paciente"]);
		    $nestedData['edad'] 			 = $row["edad"];
		    $nestedData['historia'] 		 = $row["historia"];
		    $nestedData['celular'] 			 = $row["celular"];
		    
		    $nestedData['pdf'] 			     = '<a style="color: white;" target="_blank" href="pdfOperatorio.php?id='.$row["idPro"].'"><img style="width: 15px;" src="images/pdf.png"></a>';
		    $nestedData['tipoDx'] 			 = $row["tipoDx"];
		    $nestedData['dxPrepa'] 			 = strtoupper($row["dxPrepa"]);
		    $nestedData['tipoDxPrepa'] 		 = $row["tipoDxPrepa"];
		    $nestedData['procedQx'] 		 = strtoupper($row["procedQx"]);
		    $nestedData['tipoAnestesia'] 	 = strtoupper($row["ANEST"]);
		    $nestedData['tipoCirugia'] 		 = strtoupper($row["TipoServici"]);
		    $nestedData['servicioDx'] 		 = strtoupper($row["SERDX"]);
		    $nestedData['salaCirugia'] 		 = strtoupper($row["SALACI"]);
		    $nestedData['fechaIntervencion'] = date('d/m/Y',strtotime($row['fechaIntervencion']));
		    $nestedData['hora'] 			 = strtoupper($row["TURNO"]);
		    $nestedData['cirugiaIndicadaPor']= $row["cirugiaIndicadaPor"];
		    $nestedData['cirujanoPrincipal'] = $row["cirujanoPrincipal"];
		    $nestedData['intervencion'] 	 = substr($row["INTERQX"], 0,40)."...";
		    $nestedData['servicioInterno'] 	 = strtoupper($row["SERVINT"]);
		    $nestedData['ESPEXC'] 			 = strtoupper($row["ESPEXC"]);
		    $nestedData['USX'] 	 = strtoupper($row["USX"]);
		    $nestedData['fechaRegistro'] 	 = date('d/m/Y H:i:s',strtotime($row['fechaRegistro']));
		    $nestedData['fechaActualizada']  = $row["fechaActualizada"];
		    
		   
			
			$opciones ='';
			$opciones ='<div class="btn-group" style="margin-bottom: 5px;">

				<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs" type="button" aria-expanded="false">Opciones <span class="caret"></span>
				</button>
				<ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
					<li>
						<a href="programacionCirugia.php?id='.$row["idPro"].'" ><i class="fa fa-edit"></i> Editar</a>
					</li>
					<li>
						<a href="reporteOperatorio.php?id='.$row["idPro"].'" ><i class="fa fa-bar-chart"></i> Reporte operatorio</a>
					</li>
                    <li>
						<a onclick="deleteRegCirugia('.$row["idPro"].')" style="color: red;"><i class="fa fa-trash"></i> Eliminar</a>
					</li>
				</ul>
			</div>';
			    
			
			
			$nestedData['opciones'] 				= $opciones;
	
	
			
			$data[] = $nestedData;
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}


else if($function=="listEmergencia"){//origenEmer


    $tipo = $_GET['tipo'];
    $fi = $_GET['fi'];$ser = $_GET['ser'];
    $pa = $_GET['pa'];
    $des = $_GET['des'];
    $desde = $_GET['desde'];
    $hasta = $_GET['hasta'];
    $sqlConsul="1";
    
     if($fi!="" && $pa!="" && $des!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.financia='".$fi."' AND P.pab1Hos='".$pa."' AND P.`destino`='".$des."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
    }else if($fi!="" && $ser!="" && $des!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.financia='".$fi."' AND P.tipoSeiN='".$ser."' AND P.`destino`='".$des."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
    }
    
    
    
    else if($pa!="" && $des!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.pab1Hos='".$pa."' AND P.`destino`='".$des."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
    }else if($ser!="" && $des!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.tipoSeiN='".$pa."' AND P.`destino`='".$des."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
    }
    else if($des!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.`destino`='".$des."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
    }
    else if($ser!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.`tipoSeiN`='".$ser."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
    }
    
    else if($pa!="" &&  $desde!="" && $hasta!=""){
        $sqlConsul="P.pab1Hos='".$pa."' AND P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' ";
    }else if($fi!="" && $pa!="" && $des!=""){
        $sqlConsul="P.financia='".$fi."' AND P.pab1Hos='".$pa."' AND P.`destino`='".$des."'";
    }else if($pa!="" && $des=="666"){
        $sqlConsul="P.pab1Hos='".$pa."' AND P.`destino`=''";
    }else if($pa!="" && $des!=""){
        $sqlConsul="P.pab1Hos='".$pa."' AND P.`destino`='".$des."'";
    }
    else if($fi!="" && $ser!="" && $des=="666"){
        $sqlConsul="P.financia='".$fi."' AND P.tipoSeiN='".$ser."' AND P.`destino`=''";
    }
    else if($fi!="" && $ser!="" && $des!=""){
        $sqlConsul="P.financia='".$fi."' AND P.tipoSeiN='".$ser."' AND P.`destino`='".$des."'";
    }
    else if($ser!="" && $des=="666"){
        $sqlConsul="P.tipoSeiN='".$ser."' AND P.`destino`=''";
    }else if($ser!="" && $des!=""){
        $sqlConsul="P.tipoSeiN='".$ser."' AND P.`destino`='".$des."'";
    }
    else if($fi!="" && $pa!=""){
        $sqlConsul="P.financia='".$fi."' AND P.pab1Hos='".$pa."'";
    }else if($fi!="" && $ser!=""){
        $sqlConsul="P.financia='".$fi."' AND P.tipoSeiN='".$ser."'";
    }else if($fi!=""){
        $sqlConsul="P.financia='".$fi."'";    
    }
    
    else if($ser!=""){
        $sqlConsul="P.tipoSeiN='".$ser."'";    
    }
    else if($pa!=""){
        $sqlConsul="P.pab1Hos='".$pa."'";
    }else if($desde!="" && $hasta!="" && $des=="666"){
        $sqlConsul="P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."' AND P.`destino`=''";
    }else if($des=="666"){
        $sqlConsul="P.`destino`=''";
    }else if($des!=""){
        $sqlConsul="P.`destino`='".$des."'";
    }else if($desde!="" && $hasta!=""){
        $sqlConsul="P.feAltaAlt >='".$desde."' AND feAltaAlt <='".$hasta."'";
    }
    
    $where="";
				if( !empty($_REQUEST['search']['value']) ) { 
					$where.=" WHERE  ( Cuenta LIKE '".$_REQUEST['search']['value']."%' )";    
				}

				$totalRecordsSql = "SELECT COUNT(DISTINCT cuenta) as total FROM nt_examenes $where";
				$stmt = $conn->prepare($totalRecordsSql);
				$stmt->execute();
				$res = $stmt->fetchAll();
				$totalRecords=0;
				foreach ($res as $key => $value) {
					$totalRecords = $value['total'];
				}
								  
				$columns = array( 
					
					0 =>'IdOrden',
					1 =>'Cuenta',
					2 =>'Fecha_Ingreso',
					3 =>'Afiliacion_Tipo_Formato',
					4 =>'Afiliacion_Formato',
					5 =>'PACIENTE',
					6 =>'SEREGRE',
					7 =>'ATENCION',
					8 =>'FechaMov',
					9 =>'Codigo',
					10 =>'Nombre' ,
					11 =>'Punto_Carga' ,
					12 =>'Asterisco',
					13 =>'FECHA_LABOR',
					14 =>'COPIA',
					15 =>'ORDEN' ,
					16 =>'RESULTADO' ,
					17 =>'RESPCOPIA' ,
					18 =>'CAJA' ,
					19=>'OBSERVACIONES' ,
					20 =>'Estado' ,
					21 =>'IAFA' ,
					22 =>'RESP_ENVIO' ,
					23 =>'FECHA_ENTREGA' ,
					24 =>'GRUPO_ENVIO' ,
					25 =>'fecha_item' ,
					26 =>'fehca_update' ,
					27 =>'id' ,
					28 =>'revi',
					29 =>'userevi',

				);


				$sql = "SELECT P.`idEm`,(SELECT `nom` FROM `usuarios` WHERE `id` =P.`idUserRegistro`) as pax , P.`nroFua`, P.`historiaClinica`, P.`tipoDoc`, P.`nroDoc`,
        	   (SELECT `descripcion` FROM `tipoSeguro` WHERE `idTipo`=P.`seguro`) AS seg,(SELECT `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`seguro`) as ase,
        	   (SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacion`) AS ubi,(SELECT `nombre` FROM `tbl_regimen` WHERE `idRe` =P.regim) as REGI ,P.origenEmerMod,
        	   (SELECT `nombre`FROM `tbl_iafas` WHERE `idIa`=P.seguro) AS IAF ,P.`sexo`,P.`cuenta` as CNTA,P.cuentaHsoMod as CNTA2 , P.`nroAfiliacion`, P.`eess`, P.`nombres`, P.`fechaNac`, P.`ApePaterno`, P.`ApeMaterno`, P.`teleFam`, P.`edad`,
        		(SELECT `decripcion` FROM `tipoDestino` WHERE `idDes` = P.`destino`) AS dest, P.`fechaDestino`, P.`refeContraref`,(SELECT `descripcion` FROM `pabellones` WHERE `idPa`=P.`servicioPabellon`) as pa
        		, P.`fechaIngreso`, P.`fechaAlta`, P.`montoGalenos`, P.`montoSisfar`, P.`Observaciones`, P.`fechaRegistro`, P.`fechaUpdate`, P.`tipoRegistro`,P.envioA,P.estadoA, P.`actras`,
        		P.`financia`, P.`regim`, P.`planSal`, P.`tipoSeiN`, P.`feSolAte`,(SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacionDes`) AS ubies, P.`ubicacionDes`, P.`tipoSeiNDes`, P.`feingreAlta`, P.`feAltaAlt`, P.`monTotalCo`, P.`monCarGar`,
        		(SELECT `nombre` FROM `financiamiento` WHERE `id` =P.`financia`) as FI,P.`fuaEntre`, P.`fechaFuaEntre`,(SELECT `nombre` FROM `tbl_plansalud` WHERE `idPa` =P.`planSal`) AS PS,
        		(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiN` ) AS SIG,(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi` =  P.`tipoSeiNDes` ) AS SI2,fechaAful,
        		`origenEmer`, `nroRefEmer`, `eessInicio`,estancia, `subirRef`, `nvaCta`, `ctaHos`, `rsatencion`,(SELECT `nom` FROM `usuarios` WHERE `id` =P.`reciAudit`) as RECAUI, `registraAlta`,liquidador,
        		`nroCxref`,(SELECT  `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`segurosAl`) AS SERAL ,P.`destino`,(SELECT `monTotalCo` FROM `tbl_Emergencias` WHERE idEm = P.`ideNew` ) as TUO,
        		(SELECT nom FROM usuarios WHERE id= P.idUserLiquida) as LIQUIN,status,prioridad";

				$sql.="FROM `tbl_Emergencias`  P WHERE P.`tipoRegistro`=1  AND $sqlConsul AND origenEmerMod IS NULL OR  P.`tipoRegistro`=1 AND $sqlConsul AND origenEmerMod=0  ORDER BY P.idEm DESC";
				$sql.=" ORDER BY ". $columns[$_REQUEST['order'][0]['column']]."   ".$_REQUEST['order'][0]['dir']."  LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']."   ";

				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				$json_data = array(

				"draw"            => intval( $_REQUEST['draw'] ),   
				"recordsTotal"    => intval($totalRecords ),  
				"recordsFiltered" => intval($totalRecords),
				"data"            => $result
				);

				echo json_encode($json_data);
    
    
    
    
    

}



else if($function=="listConsultaExterna"){

    $id= $_GET['id']; 
	
	try {
			
		$stmt = $conn->prepare("SELECT P.`idEm`,(SELECT `user` FROM `usuarios` WHERE `id` =P.`idUserRegistro`) as pax , P.`nroFua`, P.`historiaClinica`, P.`tipoDoc`, P.`nroDoc`,
	   (SELECT `descripcion` FROM `tipoSeguro` WHERE `idTipo`=P.`seguro`) AS seg	,(SELECT `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`aseguradora`) as ase,
	   (SELECT `descripcion` FROM `tbl_serviciosCE` WHERE `id`= P.`ubicacion`) AS ubi, (SELECT `fechaAsig` FROM `tbl_grupoCE` WHERE `idGrupo`=P.grupo) as FexAs,
	   (SELECT `fechaRecep` FROM `tbl_grupoCE` WHERE `idGrupo`=P.grupo) as FeRext,
		P.`sexo`, P.`cuenta`, P.`nroAfiliacion`, P.`eess`, P.`nombres`, P.`fechaNac`, P.`ApePaterno`, P.`ApeMaterno`, P.`teleFam`, P.`edad`,
		(SELECT `decripcion` FROM `tipoDestino` WHERE `idDes` = P.`destino`) AS des, P.`fechaDestino`, P.`refeContraref`,(SELECT `descripcion` FROM `pabellones` WHERE `idPa`=P.`servicioPabellon`) as pa
		, P.`fechaIngreso`, P.`fechaAlta`, P.`montoGalenos`, P.`montoSisfar`, P.`Observaciones`, P.`fechaRegistro`, P.`fechaUpdate`, P.`tipoRegistro`, P.`montoValAtencion`,P.fechaAsignada,P.fechaRecepcionada 
		,P.dx1,P.codPre, P.`tpdx1`, P.`dx2`, P.`tpdx2`, P.`dx3`, P.`tpdx3`, P.`dx4`, P.`tpdx4`, P.`dx5`, P.`tpdx5` 	FROM `tbl_consultaExterna` P  WHERE P.grupo= $id ORDER BY P.idEm DESC" );
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['idEm'] 					= $row["idEm"];
			$nestedData['idUserRegistro'] 			= strtoupper($row["pax"]);
			$nestedData['nroFua'] 					= $row["nroFua"];
			$nestedData['historiaClinica'] 			= $row["historiaClinica"];
			$nestedData['nroDoc'] 				= $row["nroDoc"];
			$nestedData['seguro'] 				= strtoupper($row["seg"]);
			$nestedData['aseguradora'] 						= $row["ase"];
			$nestedData['ubicacion'] 					= strtoupper($row["ubi"]);
			$nestedData['sexo'] 						= $row["sexo"];
			$nestedData['cuenta'] 					= $row["cuenta"];
			$nestedData['nroAfiliacion'] 				= $row["nroAfiliacion"];
			$nestedData['eess'] 				= strtoupper($row["eess"]);
			$nestedData['paciente'] 				= strtoupper($row["ApePaterno"]." ".$row["ApeMaterno"]." ".$row["nombres"]);
			$nestedData['teleFam'] 						= $row["teleFam"];
			$nestedData['edad'] 					= strtoupper($row["edad"]);
			$nestedData['destino'] 						= $row["des"];
			$nestedData['fechaDestino'] 					= $row["fechaDestino"];
			$nestedData['refeContraref'] 				= $row["refeContraref"];
			$nestedData['servicioPabellon'] 				= strtoupper($row["pa"]);
			$fi='';($row['fechaIngreso']!="") ? $fi=date('d/m/Y',strtotime($row['fechaIngreso'])): $fi='-';
			$nestedData['fechaIngreso'] 				= $fi;
			$fal='';($row['fechaAlta']!="") ? $fal=date('d/m/Y',strtotime($row['fechaAlta'])): $fal='-';
			$nestedData['fechaAlta'] 						=  $fal;
			$nestedData['montoGalenos'] 					= strtoupper($row["montoGalenos"]);
			$d1 = "";$tp1="";
			if($row["dx1"]!=""){
			    $d1 = explode("-", $row["dx1"]);
			    $tp1=$row["tpdx1"];
			}
			
			$nestedData['dx1'] 				            	= strtoupper($d1[1]);
			$nestedData['cl1'] 				            	= strtoupper($d1[0]);
			$nestedData['tpdx1'] 				            = strtoupper($tp1);
			
			
			$d2 = "";$tp2="";
			if($row["dx2"]!=""){
			    $d2 = explode("-", $row["dx2"]);
			    $tp2=$row["tpdx2"];
			}
			
			$nestedData['dx2'] 				            	= strtoupper($d2[1]);
			$nestedData['cl2'] 				            	= strtoupper($d2[0]);
			$nestedData['tpdx2'] 				            = strtoupper($tp2);
			
			
			
			
			$d3 = "";$tp3="";
			if($row["dx3"]!=""){
			    $d3 = explode("-", $row["dx3"]);
			    $tp3=$row["tpdx3"];
			}
			$nestedData['dx3'] 				            	= strtoupper($d3[1]);
			$nestedData['cl3'] 				            	= strtoupper($d3[0]);
			$nestedData['tpdx3'] 				            = strtoupper($tp3);
			
			
			
			$d4 = "";$tp4="";
			if($row["dx4"]!=""){
			    $d4 = explode("-", $row["dx4"]);
			    $tp4=$row["tpdx4"];
			}
			$nestedData['dx4'] 				            	= strtoupper($d4[1]);
			$nestedData['cl4'] 				            	= strtoupper($d4[0]);
			$nestedData['tpdx4'] 				            = strtoupper($tp4);
			
			
			$d5 = "";$tp5="";
			if($row["dx5"]!=""){
			    $d5 = explode("-", $row["dx5"]);
			    $tp5=$row["tpdx5"];
			}
			$nestedData['dx5'] 				            	= strtoupper($d5[1]);
			$nestedData['cl5'] 				            	= strtoupper($d5[0]);
			$nestedData['tpdx5'] 				            = strtoupper($tp5);
			
			
			
			
			$nestedData['codPre'] 				            = $row["codPre"];
			$nestedData['montoSisfar'] 						= $row["montoSisfar"];
			$nestedData['montoValAtencion'] 				= $row["montoValAtencion"];
			$nestedData['Observaciones'] 					= strtoupper($row["Observaciones"]);
			$nestedData['fechaRegistro']				= date('d/m/Y H:i:s',strtotime($row['fechaRegistro']));
			$nestedData['fechaUpdate']			        = date('d/m/Y H:i:s',strtotime($row['fechaUpdate']));
			$feasi=''; ($row['fechaAsignada']!="") ? $feasi=date('d/m/Y',strtotime($row['fechaAsignada'])) : $feasi='';
			$ferecp=''; ($row['fechaRecepcionada']!="") ? $ferecp=date('d/m/Y',strtotime($row['fechaRecepcionada'])) : $ferecp='';
			
		   /* $nestedData['fechaAsignada']			    = $feasi; */
		    
		    
		    
		    $usAu='';$btnAd='';$usRet='';
		     if($row['fechaAsignada']!='' && $row['fechaRecepcionada']!='' || $row['FexAs'] != "" &&  $row['FeRext'] != "" ){
		         
						$btnAd='<button data-toggle="dropdown" class="btn btn-success dropdown-toggle btn-xs" type="button" aria-expanded="true"> Opciones <span class="caret"></span>
								</button>';
						$usAu = $feasi;$usRet=$ferecp;
			}else if($row['fechaAsignada'] =='' && $row['FexAs'] == ""){
						$usAu='<input type="checkbox" class="allasig" value="'.$row['idEm'].'" name="fuasRec[]" />';	
						$btnAd='<button style="border: 1px solid black;" data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs" type="button" aria-expanded="true"> Opciones <span class="caret"></span>
								</button>';
			}else{
			         $btnAd='<button data-toggle="dropdown" class="btn btn-warning dropdown-toggle btn-xs" type="button" aria-expanded="true"> Opciones <span class="caret"></span>
								</button>';
					$usAu=$feasi;
			}
			
			
			 
		    if($row['fechaRecepcionada']=='' && $row['FeRext']==''){
					$usRet='<input type="checkbox" class="allrecep" value="'.$row['idEm'].'" name="fuasAda[]" />';	
					
			}else{
			        
					$usRet=$ferecp;
			}
			
			
			$as='';$res='';
			
	        if($row['FexAs'] != ""){
	            $as=date('d/m/Y',strtotime($row['FexAs']));
	        }else{
	            $as=$usAu;
	        }
			
			if($row['FeRext'] !=""){
			    $res=date('d/m/Y',strtotime($row['FeRext']));
			}else{
			    $res=$usRet;
			}
			
			
            $nestedData['chek']                         =$as;
            $nestedData['fechaAsignada']			    =$res;
			
			
			$eli='<li><a onclick="eliminarFuaHnal('.$row["idEm"].')"  ><i class="fa fa-trash"></i> Eliminar</a></li>';
			if($iduser == "59" || $iduser == "41" || $iduser == "45" || $iduser == "47"  ){
			    $eli='';
			}
			
			
			$opciones ='<div class="btn-group" style="margin-bottom: 5px;">
								'.$btnAd.'
								<ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
									<li>
										<a onclick="verPacienteEmergenciaCE('.$row["idEm"].')" data-toggle="modal" data-target=".bs-example-modal-smEmergenciaCE" >
		    	                        <i class="fa fa-edit"></i> Editar</a>
									</li>
									
										'.$eli.'
								
									
								</ul>
							</div>';
		
			    /*$opciones ='<a onclick="verPacienteEmergenciaCE('.$row["idEm"].')" data-toggle="modal" data-target=".bs-example-modal-smEmergenciaCE" class="btn btn-success btn-xs" >
		    	<i class="fa fa-edit"></i></a><a class="btn btn-danger btn-xs" onclick="eliminarFuaHnal('.$row["idEm"].')" style="color: white;font-weight: 800;" > X</a>'; */
			
			
			$nestedData['opciones'] 				= $opciones;
	
	
			
			$data[] = $nestedData;
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}





else if($function=="listAtencionesAuditoria"){

    $id= $_GET['id']; 
	$tipo= $_GET['tipo'];
	
	$stmt ="";
	if($tipo=="2"){
	 
	    $stmt = $conn->prepare("SELECT P.`idEm` AS idPac , P.`nroFua`, P.`cuenta` AS nroCuenta ,CONCAT(P.ApePaterno,' ',P.ApeMaterno,' ',P.nombres) AS  paciente ,
	    P.regServiceCE AS SERD, '3' AS tipoEval,P.fechaIngreso AS F_Ingreso, P.feAltaAlt AS F_Alta_Medica,P.historiaClinica AS Historia ,L.idLi,(SELECT fechadigitacioncheck  FROM `tbl_grupoArchivo` WHERE `idGrupo` = '$id'  ) AS FECHADIGI,
	    (SELECT user FROM usuarios WHERE id=L.userReg) AS UOE,P.destino,P.fechaRegistro AS fechaRegistroSitema,P.fechaUpdate AS FETUPD,DATEDIFF (DATE(NOW()),P.`fechaIngreso`) AS ALERT,(SELECT user FROM usuarios WHERE id=L.userLiq) AS USLIQ   
		FROM listadoAtencionesCE AS L  INNER JOIN `tbl_Emergencias` AS P ON L.idPac=P.idEm WHERE L.idPaq='$id' ORDER BY L.`idLi` DESC" );
		
	}else{
	    
	    $stmt = $conn->prepare("SELECT P.`idPac`, P.`nroFua`, P.`nroCuenta`, P.`paciente`,(SELECT UPPER(`nombre`) FROM `tipoServicioIngreso` WHERE `idTsi` = P.`serEgreso`) as SERF
		,P.`servicio`,P.tipoEval ,P.`F_Ingreso`, P.`F_Alta_Medica`, P.`Historia`,L.idLi,(SELECT user FROM usuarios WHERE id=L.userReg) AS UOE,L.fechaRegistroSitema AS fechaRegistroSitema,'-' AS FECHADIGI,
		L.fechaUpdateSistema AS FETUPD,'' AS ALERT,'-' as USLIQ	FROM listadoAtenciones AS L  INNER JOIN `paciente` AS P ON L.idPac=P.idPac WHERE P.estado='ENVIADO' AND L.idPaq='$id' ORDER BY L.`idLi` DESC" );
	}
	
	
	try {
			
	/*	$stmt = $conn->prepare("SELECT P.`idPac`, P.`nroFua`, P.`nroCuenta`, P.`paciente`,(SELECT UPPER(`nombre`) FROM `tipoServicioIngreso` WHERE `idTsi` = P.`serEgreso`) as SERF
		,P.`servicio`,P.tipoEval ,P.`F_Ingreso`, P.`F_Alta_Medica`, P.`Historia`,L.idLi,(SELECT user FROM usuarios WHERE id=L.userReg) AS UOE,L.fechaRegistroSitema 
		FROM listadoAtenciones AS L  INNER JOIN `paciente` AS P ON L.idPac=P.idPac WHERE P.estado='ENVIADO' AND L.idPaq='$id' ORDER BY L.`idLi` DESC" );*/
		
		
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['idPac'] 				= $row["idPac"];
			$nestedData['nroFua'] 				= $row["nroFua"];
			$nestedData['nroCuenta'] 			= $row["nroCuenta"];
			$nestedData['paciente'] 			= $row["paciente"];
			
			
			$chek  = '';
			if($row['USLIQ']==""){
			    	$chek  = '<input type="checkbox" class="allasigPaq" value="'.$row['idLi'].'" name="fuasRec[]" />';
			}else{
			    $chek  =  strtoupper($row['USLIQ']);
			}
			
			
			$nestedData['asignar'] 			=$chek;
			
			$alert="";
			
			if($row["ALERT"]>= 30 && $row["FECHADIGI"]==""){
			    
			    	$alert="<span class='label label-danger' style='background: #fd00b9;border: 1px solid #fd00b9;font-size: 9px;border-radius: 10px;'>Extemporáneo</span>";
			    	
			}else if($row["ALERT"]>= 20){
			    
			    	$alert="<span class='label label-danger' style='font-size: 9px;border-radius: 10px;'>Alerta</span>";
			}
			
			$nestedData['alerta'] 			= $alert;
			
			
			$vetipeval='';$opciones ='';
			if($row["tipoEval"]=='1'){
			    
    			    $vetipeval=$row["servicio"];
    			    $opciones ='<a class="btn btn-danger btn-xs" onclick="eliminarFuaFile('.$row["idLi"].',1)" style="color: white;font-weight: 800;" > X</a>';   
			}else if($row["tipoEval"]=='2'){
    			    $vetipeval=$row["SERF"];
    			    $opciones ='<a class="btn btn-danger btn-xs" onclick="eliminarFuaFile('.$row["idLi"].',1)" style="color: white;font-weight: 800;" > X</a>';   
			}else if($row["tipoEval"]=='3'){
			        $vetipeval=$row["SERD"];
			        /*
			    	if($row['destino'] =="" ){
            			$opciones ='<a class="btn btn-danger btn-xs" onclick="eliminarFuaFile('.$row["idLi"].',2)" style="color: white;font-weight: 800;" > X</a>';    
            		}*/
            		
            		$opciones ='<a class="btn btn-danger btn-xs" onclick="eliminarFuaFile('.$row["idLi"].',2)" style="color: white;font-weight: 800;" > X</a>';   
			    
			}
			
			$nestedData['servicio'] 			= $vetipeval;
			$nestedData['F_Ingreso'] 			= date('d/m/Y',strtotime($row['F_Ingreso']));
			
			$fealt="";
			if($row['F_Alta_Medica']!=""){
			    $fealt="";
			}else{
			    
			}
			$nestedData['F_Alta_Medica'] 		= ($row['F_Alta_Medica']!="") ? date('d/m/Y',strtotime($row['F_Alta_Medica'])): '';
			$nestedData['Historia'] 			= $row["Historia"];
			$nestedData['userReg'] 				= strtoupper($row["UOE"]);
			$fi='';($row['fechaRegistroSitema']!="") ? $fi=date('d/m/Y H:i:s',strtotime($row['fechaRegistroSitema'])): $fi='-';
			$nestedData['fechaRegistroSitema'] 	= $fi;
			$fi2='';($row['FETUPD']!="") ? $fi2=date('d/m/Y H:i:s',strtotime($row['FETUPD'])): $fi2='-';
			$nestedData['FETUPD'] 	= $fi2;
			
			
		
			
			
		    	
		   $nestedData['eliminar'] 				= $opciones;
		
	
	
			
			$data[] = $nestedData;
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}



else if($function=="listReferencias"){

    

	    
	    $stmt = $conn->prepare("SELECT R.`idRef`, (SELECT nom FROM usuarios WHERE id=R.`idUserSolRef`) AS USIA,
	    (SELECT UPPER(`descripcion`) FROM `tbl_tipoDoc` WHERE `idTipo` = R.`tipoDocRef`) AS TIXPOC, R.`NroDocRef`, R.`paxRef`,R.`edadRef`, 
	    (SELECT UPPER(`nombre`) FROM `financiamiento` WHERE `id` =R.iafasRef) AS IAREF ,(SELECT  UPPER(`nombre`) FROM `tbl_plansalud` WHERE `idPa` =R.`tipoSegRef`) AS PLANSAL  
	    ,R.`actrasRef`,(SELECT `NombreUPS` FROM `UPS` WHERE `IdUPS` =R.`servicioOrigenRef`) AS SERORIGEN,(SELECT `NombreUPS` FROM `UPS` WHERE `IdUPS` = R.`servDestRef`) AS SERDEST, 
	   (SELECT `descripcion` FROM `tbl_especialidades` WHERE `id` =R.`especialidadRef`) AS ESPX, (SELECT `CondPac` FROM `CondPac` WHERE `IdCond`=R.`condPcte`)AS CODPAX, 
	   R.fechaRegistro,R.historia,R.estadoRegistro,R.codipres,R.anio,R.cor,R.anulado,R.estadoRefDatRef,R.derivarJefeServ,R.estFinalRef,R.obsEstFinalRef,
	   (SELECT S.IdPrioridad FROM `tbl_signosSintomas`  AS T
	     INNER JOIN SignosSintomas AS S ON T.dx=S.Descripcion
	     WHERE `idRef` =R.`cor` AND dx <>'undefined' AND dx <> ''  ORDER BY S.IdPrioridad ASC LIMIT 1) as Pri FROM `tbl_registroReferencias` AS R ORDER BY R.`idRef` DESC " );
	
	
	
	try {
	
		$stmt->execute();
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['idRef'] 				= $row["idRef"];
		    $nestedData['anulado'] 			    = $row["anulado"];
		    $pri ='';
		    if($row["Pri"]==1){
		        $pri ='<span class="label label-danger" style="font-size: 10px;">Prioridad I</span>';
		    }else if($row["Pri"]==2){
		        $pri ='<span class="label label-danger" style="background: #ff6116;font-size: 10px;">Prioridad II</span>';
		    }else if($row["Pri"]==3){
		        $pri ='<span class="label label-warning" style="font-size: 10px;">Prioridad III</span>';
		    }else if($row["Pri"]==4){
		        $pri ='<span class="label label-success" style="font-size: 10px;">Prioridad IV</span>';
		    }
		    
		    $nestedData['prioridad'] 			= $pri;
		    $nestedData['historia'] 			= $row["historia"];
		    $nestedData['code'] 				= $row["codipres"]."-".$row["anio"]."-".$row["cor"];
			$nestedData['USIA'] 				= strtoupper($row["USIA"]);
			$nestedData['TIXPOC'] 			    = $row["TIXPOC"];
			$nestedData['NroDocRef'] 			= $row["NroDocRef"];
			$nestedData['paxRef'] 			    = strtoupper($row["paxRef"]);
			$nestedData['edadRef'] 			    = $row["edadRef"];
			$nestedData['IAREF'] 			    = $row["IAREF"];
			$nestedData['PLANSAL'] 			    = $row["PLANSAL"];
			$nestedData['actrasRef'] 			= $row["actrasRef"];
			$nestedData['SERORIGEN'] 			= $row["SERORIGEN"];
			$nestedData['SERDEST'] 			    = $row["SERDEST"];
			$nestedData['ESPX'] 			    = $row["ESPX"];
			$nestedData['CODPAX'] 			    = $row["CODPAX"];
			$nestedData['fechaRegistro'] 	    = date('d/m/Y H:i:s',strtotime($row['fechaRegistro']));
			$nestedData['fechaFiltro'] 	        = date('Y-m-d',strtotime($row['fechaRegistro']));
			$nestedData['verPdf'] 			    = '<a target="_blank" href="hojareferencia.php?id='.$row["idRef"].'"><img style="width: 15px;" src="images/pdf.png" title="Ver Referencia"></a>
			<a target="_blank" href="referenciaInst.php?id='.$row["idRef"].'"><img style="width: 15px;" src="images/pdf.png" title="Ver Referencia"></a>';
			
			
			$ObsModal='';
			($row["obsEstFinalRef"]!="") ? $ObsModal='<a class="btn btn-default btn-xs" onclick="verObsPerMed('.$row["idRef"].')" data-toggle="modal" data-target=".bs-example-modal-verObservacion" 
                    			role="button" aria-expanded="false" title="Ver observacion">Ver observación <i class="fa fa-eye"></i></a>' : $ObsModal='-'; 
			$nestedData['verObsPerAudit'] 		= $ObsModal;
			
			$estReg ='';
			/*if($row["estadoRegistro"]==1){ 
			    $estReg ='<a style="font-weight: bolder;color: white;"><span class="label label-warning" style="font-size: 12px;">Pendiente</span></a>';
			    
			}else if($row["estFinalRef"] =="1" ){
			    $estReg ='<a style="font-weight: bolder;color: white;"><span class="label label-success" style="font-size: 12px;">Aprobado</span></a>';
			    
			}else if($row["estFinalRef"] =="2" ){
			    $estReg ='<a style="font-weight: bolder;color: white;"><span class="label label-danger" style="font-size: 12px;">Rechazado</span></a>';
			    
			}else if($row["estFinalRef"] =="3" ){
			    $estReg ='<a style="font-weight: bolder;color: white;"><span class="label label-primary" style="font-size: 12px;">Observado</span></a>';
			    
			}else if($row["estadoRefDatRef"] =="1" && $row["derivarJefeServ"]=="SI"){
			    $estReg ='<a style="font-weight: bolder;color: white;"><span class="label label-success" style="font-size: 12px;background: #b0b2b5;">En evaluación</span></a>';
			    
			}
			else if($row["anulado"] =="1"){
			    $estReg ='<a style="font-weight: bolder;color: white;"><span class="label label-success" style="font-size: 12px;background: black;">Anulado</span></a>';
			    
			} */
			
			
			
			if($row["estadoRegistro"]==1){ 
			    $estReg ='PENDIENTE';
			    
			}else if($row["estFinalRef"] =="1" ){
			    $estReg ='APROBADO';
			    
			}else if($row["estFinalRef"] =="2" ){
			    $estReg ='RECHAZADO';
			    
			}else if($row["estFinalRef"] =="3" ){
			    $estReg ='OBSERVADO';
			    
			}else if($row["estadoRefDatRef"] =="1" && $row["derivarJefeServ"]=="SI"){
			    $estReg ='EN EVALUACION';
			    
			}
			else if($row["anulado"] =="1"){
			    $estReg ='ANULADO';
			    
			}
		
		
			
			$nestedData['estado'] 			    = $estReg;
			$nestedData['archivos'] 			= $row["archivos"];
			$nestedData['obs'] 			        = $row["obs"];
			
			$opciones='';
		
			
			
			$loayza='<a class="btn btn-dark btn-xs" onclick="verEvaluacionRef('.$row["idRef"].')" data-toggle="modal" data-target=".bs-example-modal-historiaNovo" 
			role="button" aria-expanded="false" title="Evaluar referencia"><i class="fa fa-folder-open-o"></i></a>';
			
			$demas ='<a style="background: red;border: 1px solid red;" class="btn btn-danger btn-xs" 
			onclick="eliminarRegReferencias('.$row["idRef"].')" data-toggle="modal" data-target=".bs-example-modal" role="button" aria-expanded="false" title="Anular"><i class="fa fa-close"></i></a>';
			
			if($row["anulado"]!="1"){
			    
			    
			             	if((int)$CODEESS == "6207"){
			             	    
			             	    $opciones='<a class="btn btn-primary btn-xs" onclick="verEditRef('.$row["idRef"].')" data-toggle="modal" data-target=".bs-example-modal-smReferencias" 
                    			role="button" aria-expanded="false" title="Editar solicitud"><i class="fa fa-edit"></i></a><a class="btn btn-default btn-xs" onclick="verHistoriaClinicaPacte('.$row["idRef"].')" data-toggle="modal" data-target=".bs-example-modal-historiaclinicaModal" 
                    			role="button" aria-expanded="false" title="Editar HC"><i class="fa fa-eye"></i></a>'.$loayza;
			    
			                }else{
			                    
			                    $opciones='<a class="btn btn-primary btn-xs" onclick="verEditRef('.$row["idRef"].')" data-toggle="modal" data-target=".bs-example-modal-smReferencias" 
                    			role="button" aria-expanded="false" title="Editar solicitud"><i class="fa fa-edit"></i></a><a class="btn btn-default btn-xs" onclick="verHistoriaClinicaPacte('.$row["idRef"].')" data-toggle="modal" data-target=".bs-example-modal-historiaclinicaModal" 
                    			role="button" aria-expanded="false" title="Editar HC"><i class="fa fa-eye"></i></a>'.$demas;
			                        
			                }
			
			            
			    
			        
			}
			
			$nestedData['buttons'] 			    = $opciones;
		
			$data[] = $nestedData;
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}


else if($function=="listUsuarios"){

    $id= $_GET['id']; 
	$tipo= $_GET['tipo'];
	

	try {
	    $stmt = $conn->prepare("SELECT `id`,`user`,`pass`,`estado`,`nom`,`rol`,`fe_in`,doc FROM `usuarios`  ORDER BY id DESC" );

		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['id'] 				= $row["id"];
		    $nestedData['doc'] 				= $row["doc"];
			$nestedData['user'] 			= strtoupper($row["user"]);
			$nestedData['pass'] 			= "********";
			$est='';
			($row["estado"]=="ACTIVADO" || $row["estado"]=="activado" ) ?  $est='<a style="font-weight: bolder;color: white;"><span class="label label-success">Activado</span></a>' : $est='<a style="font-weight: bolder;color: white;"><span class="label label-danger">Desactivado</span></a>';
			
			$nestedData['estado'] 			=  $est;
			$nestedData['nom'] 			= strtoupper($row["nom"]);
			$nestedData['rol'] 			= $row["rol"];
			$nestedData['fe_in'] 			= date('d/m/Y',strtotime($row['fe_in']));
			

			$opciones ='<a data-toggle="modal" data-target=".bs-example-modal-smUsuarios" class="btn btn-primary btn-xs" onclick="editarUsuarios('.$row["id"].')" style="color: white;" ><i class="fa fa-edit"></i> Editar</a>';
			
		
		   $nestedData['opciones'] 				= $opciones;
		
	
	
			
			$data[] = $nestedData;
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}




else if($function=="reconsideracion"){
///group_concat('-',UPPER(R.DETALLE_OBS),'\r\n -') AS OBS 


	$id = $_GET['id'];
	$anio = $_GET['anio'];
	
	$rsy;($id==1) ? $rsy = 'R.ANIO = "'.$anio.'" AND R.ESTADO ="OBSERVADO" ' : $rsy = 'R.ANIO = "'.$anio.'" AND R.ESTADO ="ENVIADO"';
		
/*

SELECT  R.Id,R.`PERPROD`,R.FATENCION, R.`PACIENTE`,R.`HISTORIA`,trim(R.`FUA_OBSERVADA`) AS FUX,R.`TIPO_OBS`,
		(SELECT COUNT(*) FROM reconsideraciones WHERE TIPO_OBS='PARCIAL' AND FUA_OBSERVADA=R.`FUA_OBSERVADA`) AS PARCIAL,
		(SELECT COUNT(*) FROM reconsideraciones	WHERE TIPO_OBS='TOTAL' AND FUA_OBSERVADA=R.`FUA_OBSERVADA`) AS TOTAL,
		FUA_SOLICITADA,FSOLIC,USUSOLIC,ESTADOEVALU,ESTADO,PDF,VALORNUM,
		group_concat(' - ',UPPER(R.DETALLE_OBS) SEPARATOR '\n') AS OBS,(SELECT `user` FROM `usuarios` WHERE `id`=USUSOLIC) AS US,RESULTADO_EVAL,CODIMPORT
		FROM reconsideraciones AS R WHERE $rsy AND CODIGO_OBS <> '' GROUP BY R.`FUA_OBSERVADA`

--------16-03-203

SELECT  R.Id,R.`PERPROD`,R.FATENCION, R.`PACIENTE`,R.`HISTORIA`,trim(R.`FUA_OBSERVADA`) AS FUX,R.`TIPO_OBS`,R.SERVICIO,
		FUA_SOLICITADA,FSOLIC,USUSOLIC,ESTADOEVALU,ESTADO,PDF,VALORNUM,fileReco, 
		group_concat(' - ',UPPER(R.DETALLE_OBS) SEPARATOR '\n') AS OBS,(SELECT `user` FROM `usuarios` WHERE `id`=USUSOLIC) AS US,RESULTADO_EVAL,CODIMPORT,fuare,hiEn, `ap`, `bp`, `cp`, `dp`, `ep` 
		FROM reconsideraciones AS R GROUP BY R.`FUA_OBSERVADA` 
		
		
SELECT  R.Id,R.`PERPROD`,R.FATENCION, R.`PACIENTE`,R.`HISTORIA`,trim(R.`FUA_OBSERVADA`) AS FUX,R.`TIPO_OBS`,R.SERVICIO,
		FUA_SOLICITADA,FSOLIC,USUSOLIC,ESTADOEVALU,ESTADO,PDF,VALORNUM,fileReco, 
		group_concat(' - ',UPPER(R.DETALLE_OBS) SEPARATOR '\n') AS OBS,(SELECT `user` FROM `usuarios` WHERE `id`=USUSOLIC) AS US,RESULTADO_EVAL,CODIMPORT,fuare,hiEn, `ap`, `bp`, `cp`, `dp`, `ep` 
		FROM reconsideraciones AS  R WHERE R.ANIO ='$anio'  GROUP BY R.`FUA_OBSERVADA`


*/
	try {

		$stmt = $conn->prepare("SELECT  R.Id,R.`PERPROD`,R.FATENCION, R.`PACIENTE`,R.`HISTORIA`,trim(R.`FUA_OBSERVADA`) AS FUX,R.`TIPO_OBS`,R.SERVICIO,
		FUA_SOLICITADA,FSOLIC,USUSOLIC,ESTADOEVALU,ESTADO,PDF,VALORNUM,fileReco, CODIGO_OBS,
		group_concat(' - ',UPPER(R.DETALLE_OBS) SEPARATOR '\n') AS OBS,GROUP_CONCAT(DISTINCT R.DETALLE_OBS SEPARATOR '\n') AS NOP,(SELECT `user` FROM `usuarios` WHERE `id`=USUSOLIC) AS US,RESULTADO_EVAL,CODIMPORT,fuare,hiEn, `ap`, `bp`, `cp`, `dp`, `ep` 
		FROM reconsideraciones AS  R WHERE R.ANIO ='$anio'  GROUP BY R.`FUA_OBSERVADA`" );
		$stmt->execute();
	
		$data = array();

		 //

		while($row = $stmt->fetch()) {
			
			$nestedData=array();
			$obs;
			if($row['ESTADO']=='OBSERVADO'){
				$obs='<span class="label label-danger">Observado</span>';
			}else if($row['ESTADO']=='Pendiente de envio' || $row['ESTADO']=='PENDIENTE DE ENVIO'){
				$obs='<span class="label label-warning">Pendiente de envio</span>';
			}else if($row['ESTADO']=='Enviado' || $row['ESTADO']=='ENVIADO'){
				$obs='<span class="label label-success">Enviado</span>';
			}
			
			$fileReco= '';
			if($row['fileReco']!=''){
			    $fileReco= '<a style="color: white;" target="_blank" href="http://seguros.hloayza.local/pdfRECO/'.$row["fileReco"].'"><img style="width: 15px;" src="images/pdf.png"></a>';
			}
			
			$nestedData['pdfreco'] 			=  $fileReco;
			$nestedData['ESTADO'] 			=  $obs;
			$por = explode("-", $row['FATENCION']);
			$nestedData['FATENCION'] 		= $row['FATENCION'];
			
			$nestedData['ap'] 		= $row['ap'];
			$nestedData['bp'] 		= $row['bp'];
			$nestedData['cp'] 		= $row['cp'];
			$nestedData['dp'] 		= $row['dp'];
			$nestedData['ep'] 		= $row['ep'];
			
			$nestedData['SERVICIO'] 		= $row['SERVICIO'];
			$nestedData['PERPROD'] 			=  $row['PERPROD'];
			$nestedData['PACIENTE'] 		=  $row['PACIENTE'];
			$nestedData['FUA_OBSERVADA'] 	=  $row['FUX'];
			$nestedData['PARCIAL'] 		 	=  $row['TIPO_OBS'];
			$nestedData['TOTAL'] 		 	=  $row['TOTAL'];
			$nestedData['FUA_SOLICITADA'] 	=  $row['FUA_SOLICITADA'];
			$fuo='';($row['fuare']=="on") ? $fuo='SI':$fuo='NO';
			$hio='';($row['hiEn']=="on") ? $hio='SI':$hio='NO';
			$nestedData['fuare'] 	=  $fuo;
			$nestedData['hiEn'] 	=  $hio;
			
			$fs ;
			if($row['FSOLIC']!=''){
				$fs=date("d/m/Y", strtotime($row['FSOLIC']));
			}else{
				$fs='';
			}
			$nestedData['FSOLIC'] 		 	=  $fs;
			$nestedData['AUDITOR'] 		 	=  strtoupper($row['US']);
			$fua  = explode("-", $row['FUX']);

            $fichero = "/home/segurosm/public_html/hnal/pdfReconsideraciones/".$row['FUX'].".pdf";
			$pdf;$wss='';
		     if (file_exists($fichero)){
                                                            
				$pdf='<a style="color: white;" target="_blank" href="http://seguros.hloayza.local/pdfReconsideraciones/'.$row['FUX'].'.pdf"><img style="width: 15px;" src="images/pdf.png"></a>';
				$wss='SI';
				//echo $aprt;
			}else{
				//$pdf=(int)$fua[2];
				$pdf='';$wss='NO';

			}


            $nestedData['pdf'] =   $pdf;

			$usx;
		/*	$op1='<li><a onclick="EditarReonsi('.$fua[0].$fua[1].$fua[2].')" data-toggle="modal" data-target=".bs-example-modal-smReconsideraciones" role="button" 
			aria-expanded="false" title="Editar"><i class="fa fa-edit"></i> Editar </a></li>';
			$op2='<li><a  onclick="AsignarAuditor('.$fua[0].$fua[1].$fua[2].')" data-toggle="modal" data-target=".bs-example-modal-asigMedi" role="button" 
			aria-expanded="false" title="Asignar"><i class="fa fa-paper-plane"></i> Asignar </a></li>';
			$op3='<li><a onclick="AsignarFinanc('.$fua[0].$fua[1].$fua[2].')" data-toggle="modal" data-target=".bs-example-modal-asigPdf" role="button" 
			aria-expanded="false" title="Financiero"><i class="fa fa-bar-chart-o"></i>  Financiero </a></li>';
			$op4='<li><a target="blank" href="imprimirFua.php?id='.$fua[0].$fua[1].$fua[2].'" title="Impresion"><i class="fa fa-print"></i> Impresion </a></li>';*/
			
			$op1='<li><a onclick="EditarReonsi('.$fua[0].$fua[1].$fua[2].')" data-toggle="modal" data-target=".bs-example-modal-smReconsideraciones" role="button" 
			aria-expanded="false" title="Editar"><i class="fa fa-edit"></i> Editar </a></li>';
			$op2='';
			$op3='';
			$op4='';

			if($iduser==40){
				$usx= $op3;
			}else if($rol==2){
				$usx= $op1;
			}else{
				$usx=$op1.$op2.$op3;
			}

		/*	$option='<div class="btn-group">
			<button data-toggle="dropdown" class="btn btn-info dropdown-toggle btn-xs pre" title="ETAPAS" type="button"> Registro 
			<span class="caret"></span>
			</button>
			<ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
					'.$usx.$op4.'
				</ul>
			</div>';*/
			$option='<a class="btn btn-info btn-xs" onclick="EditarReonsi('.$fua[0].$fua[1].$fua[2].')" data-toggle="modal" data-target=".bs-example-modal-smReconsideraciones" role="button" 
			aria-expanded="false" title="Editar"><i class="fa fa-edit"></i> Editar </a>';

//OBS 

			/*    $nestedData['opciones'] =  '<a class="btn btn-primary btn-xs" onclick="EditarReonsi('.$fua[0].$fua[1].$fua[2].')" data-toggle="modal" data-target=".bs-example-modal-smReconsideraciones" role="button" 
													aria-expanded="false" title="Editar"><i class="fa fa-edit"></i>  </a>
													<a class="btn btn-success btn-xs" onclick="AsignarAuditor('.$fua[0].$fua[1].$fua[2].')" data-toggle="modal" data-target=".bs-example-modal-asigMedi" role="button" 
													aria-expanded="false" title="Asignar"><i class="fa fa-paper-plane"></i>  </a>
													<a class="btn btn-warning btn-xs" onclick="AsignarFinanc('.$fua[0].$fua[1].$fua[2].')" data-toggle="modal" data-target=".bs-example-modal-asigPdf" role="button" 
													aria-expanded="false" title="Financiero"><i class="fa fa-bar-chart-o"></i>  </a>';
													*/

			$nestedData['opciones'] 		=  $option;				
			$nestedData['OBS'] 	=  '<p style="font-weight: bolder;font-size: 12px;color: blue;" data-cooltipz-dir="bottom"  
			data-cooltipz-size="large" aria-label="'.$row['OBS'].'" >Observación</p>';//$row['OBS'];
			$rf ;
			if($row['RESULTADO_EVAL']=='Aceptado'){
				$rf='<span class="label label-success">Aceptado</span>';
			}else if($row['RESULTADO_EVAL']=='Rechazado'){
				$rf='<span class="label label-danger">Rechazado</span>';
			}else{
				$rf='';
			}

			$nestedData['RESULTADO_EVAL'] 	=  $rf;
			
			
			$nestedData['CODIGO_OBS'] 	=  $row['CODIGO_OBS'];
			$nestedData['est'] 	=  $row['ESTADO'];
			$nestedData['fin'] 	=  $row['RESULTADO_EVAL'];
			$nestedData['id'] 	=  $row['Id'];
			$nestedData['detalleObx'] 	=   strtoupper($row['NOP']);
			$usAu;

			if($rol!=2){
					if($row['USUSOLIC']=='' || $row['USUSOLIC']=='0'){
						$usAu='<input type="checkbox" value="'.$row['FUX'].'" name="fuasRec[]" /><label></label>';	
					}else{
						$usAu='';	
					}
			}else{
				$usAu='';
			}

			//


			$nestedData['chek'] =  $usAu;

		
			$vae;
			$nestedData['VALORNUM']  =  ($row['VALORNUM']!='') ? $vae ='S/.'.$row['VALORNUM']: $vae='';
			$nestedData['order'] 	 =   $row['CODIMPORT'];
			$nestedData['HISTORIA']  =   $row['HISTORIA'];
			$nestedData['visPdf']  =   $wss;
			
		//
			$data[] = $nestedData;

		}

		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data
		);


	}
		 catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}



else if($function=="listGrupo"){

	$fua = $_GET['fua'];
	$tipoRep = $_GET['tipoRep'];
	$sql ='';
	
	
	
	if($tipoRep=="FUA"){
	    
	     $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,G.fechaAsig,G.fechaRecep,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
        (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`) as grupo ,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G 
        INNER JOIN tbl_consultaExterna AS E ON G.idGrupo=E.grupo
	    WHERE E.nroFua LIKE '%$fua%'  ORDER BY G.idGrupo ASC";
	    
	}else if($tipoRep=="HISTORIA"){
	    
	     $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,G.fechaAsig,G.fechaRecep,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
        (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`) as grupo ,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G 
        INNER JOIN tbl_consultaExterna AS E ON G.idGrupo=E.grupo
	    WHERE E.historiaClinica LIKE '%$fua%'  ORDER BY G.idGrupo ASC";
	}else{
	   
         $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,G.fechaAsig,G.fechaRecep,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
       (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`) as grupo ,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G ORDER BY G.idGrupo DESC LIMIT 13 ";
        
	}
	
	
	/*
	
	
         $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
        (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`) as grupo ,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G ORDER BY G.idGrupo ASC";
	
	
	if($tipoRep=="FUA"){
	    
	     $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
        (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`) as grupo ,
         (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `fechaAsignada` IS NULL AND `grupo`= G.`idGrupo`) as pendi ,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G 
        INNER JOIN tbl_consultaExterna AS E ON G.idGrupo=E.grupo
	    WHERE E.nroFua LIKE '%$fua%'  ORDER BY G.idGrupo ASC";
	    
	}else if($tipoRep=="HISTORIA"){
	    
	     $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
        (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`) as grupo ,
         (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `fechaAsignada` IS NULL AND `grupo`= G.`idGrupo`) as pendi ,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G 
        INNER JOIN tbl_consultaExterna AS E ON G.idGrupo=E.grupo
	    WHERE E.historiaClinica LIKE '%$fua%'  ORDER BY G.idGrupo ASC";
	}else{
	   
         $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
        (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`) as grupo ,
        (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `fechaAsignada` IS NULL AND `grupo`= G.`idGrupo`) as pendi ,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G ORDER BY G.idGrupo ASC";
        
	}
	
	*/
	
	
	
	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['idGrupo'] 						= $row["idGrupo"];
		    $nestedData['usreg'] 						= strtoupper($row["usreg"]);
		    
		    $numero = $row["idGrupo"];
            $numeroConCeros = str_pad($numero, 6, "0", STR_PAD_LEFT);
		    
			$nestedData['code'] 				        = "A".$numeroConCeros;
			$nestedData['paquete'] 				        = strtoupper($row['namePaquete']);
			$nestedData['auditor'] 					    = strtoupper($row["usera"]);
			$nestedData['observacion'] 				    = strtoupper($row["observacion"]);
			$fere="";
			($row['FERE']!="") ? $fere=date('d/m/Y',strtotime($row['FERE'])):$fere="";
		    $fea="";
			($row['FEA']!="") ? $fea=date('d/m/Y',strtotime($row['FEA'])):$fea="";
			$nestedData['pendientes'] 				    = $fere;//$row["pendi"];
			$nestedData['recibido'] 				    = $fea;
			$nestedData['cantidad'] 				    = $row["grupo"];
			$nestedData['fechaRegistro']				= date('d/m/Y H:i:s',strtotime($row['fechaRegistro']));
			$nestedData['fechaUpdate']			        = date('d/m/Y H:i:s',strtotime($row['fechaUpdate']));
			$nestedData['fechaReporte']				    = date('Y-m-d',strtotime($row['fechaRegistro']));
			
			$opciones ='';
		    /*	if($row['idUsuario']==$iduser || $rol == 7){
			    	$opciones ='<a onclick="verGrupos('.$row["idGrupo"].')" data-toggle="modal" data-target=".bs-example-modal-smResponsableAuditor" 
        			class="btn btn-primary btn-xs" ><i class="fa fa-edit"></i> Editar</a>
        			<a class="btn btn-danger btn-xs"  href="consultaExterna.php?grupo='.$row["idGrupo"].'" title="FUA"><i class="fa fa-arrows"></i> Fuas </a>';
			    
			}*/
			
			
			//G.fechaAsig,G.fechaRecep,
			$tip='';$les='';
			if($row["fechaAsig"]=="" && $row["fechaRecep"]=="" && $fere=="" && $fea==""  ){
			    $tip='default';
			    $les='Sin asignar';
			}else if($row["fechaAsig"]!="" && $row["fechaRecep"]!="" || $fere!="" && $fea!="" ){
			    $tip='success';
			    $les='Terminado';
			}
			else {
			    $tip='warning';
			    $les='Pendiente';
			}
			
			
			$nestedData['filtroEstatus']				    = $les;
			$opcion ='<div class="btn-group" style="margin-bottom: 5px;">

								<button data-toggle="dropdown" class="btn btn-'.$tip.' dropdown-toggle btn-xs" type="button" aria-expanded="true"> Acciones <span class="caret"></span>
								</button>
								<ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
									<li>
										<a onclick="verGrupos('.$row["idGrupo"].')" data-toggle="modal" data-target=".bs-example-modal-smResponsableAuditor">
										    <i class="fa fa-edit"></i> Editar</a>
									</li>
									<li>
										<a href="consultaExterna.php?grupo='.$row["idGrupo"].'" title="FUA"><i class="fa fa-arrows"></i> Fuas </a>
									</li>
								
								</ul>
							</div>';
		
			/*$opciones ='<a onclick="verGrupos('.$row["idGrupo"].')" data-toggle="modal" data-target=".bs-example-modal-smResponsableAuditor" 
        			class="btn btn-primary btn-xs" ><i class="fa fa-edit"></i> Editar</a>
        			<a class="btn btn-danger btn-xs"  href="consultaExterna.php?grupo='.$row["idGrupo"].'" title="FUA"><i class="fa fa-arrows"></i> Fuas </a>'; 
        			
        		<li>
					    <a onclick="eliminarPacHnal('.$row["idGrupo"].')"><i class="fa fa-trash"></i> Eliminar</a>
				</li>
									
        	*/
			
			$nestedData['opciones'] 				= $opcion;
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}



else if($function=="listGrupoReporte"){

	$fua = $_GET['fua'];
	$tipoRep = $_GET['tipoRep'];
	$sql ='';
	
	
	
	if($tipoRep=="FUA"){
	    
	     $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
        total as grupo ,G.fechaAsig,G.fechaRecep,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G 
        INNER JOIN tbl_consultaExterna AS E ON G.idGrupo=E.grupo
	    WHERE E.nroFua LIKE '%$fua'  ORDER BY G.idGrupo ASC";
	    
	}else if($tipoRep=="HISTORIA"){
	    
	     $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
        total as grupo ,G.fechaAsig,G.fechaRecep,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G 
        INNER JOIN tbl_consultaExterna AS E ON G.idGrupo=E.grupo
	    WHERE E.historiaClinica LIKE '%$fua%'  ORDER BY G.idGrupo ASC";
	}else{
	   
        /* $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
       (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`) as grupo ,
       (SELECT `fechaIngreso` FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`  order by fechaIngreso asc  LIMIT 1 ) AS fex,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G ORDER BY G.idGrupo ASC ";
        E.fechaIngreso as fex
        */
        
        $sql="SELECT G.idUsuario,U.user as usreg ,(SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,G.`idGrupo`, G.`observacion`, G.`fechaRegistro`,
        E.fechaAsignada as FEA,E.fechaRecepcionada AS FERE,fechaMin AS fex,fechaMax AS fex2, total as grupo ,G.`fechaUpdate`,G.namePaquete,G.fechaAsig,G.fechaRecep  
        FROM tbl_grupoCE AS G INNER JOIN tbl_consultaExterna AS E ON G.idGrupo=E.grupo INNER JOIN usuarios as U ON G.idUsuario = U.id GROUP BY G.idGrupo ASC";
         
        
        /*
        
         (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo` =G.idGrupo and fechaAsignada IS NULL) AS FEA,
         (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo` =G.idGrupo and fechaRecepcionada IS NULL) AS FERE,
        
        $sql="SELECT G.idUsuario,U.user as usreg ,(SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,G.`idGrupo`,
        E.fechaAsignada as FEA,E.fechaRecepcionada AS FERE,  (SELECT `fechaIngreso` FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo` order by fechaIngreso asc  LIMIT 1 ) AS fex,
          (SELECT `fechaIngreso` FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo` order by fechaIngreso desc  LIMIT 1 ) AS fex2
        , G.`observacion`, G.`fechaRegistro`,(SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`) as grupo ,
        G.`fechaUpdate`,G.namePaquete  FROM tbl_grupoCE AS G LEFT JOIN tbl_consultaExterna AS E ON G.idGrupo=E.grupo INNER JOIN usuarios as U ON G.idUsuario = U.id GROUP BY G.idGrupo ASC"; */
        
        
	}
	
	
	/*
	
	
         $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
        (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`) as grupo ,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G ORDER BY G.idGrupo ASC";
	
	
	if($tipoRep=="FUA"){
	    
	     $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
        (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`) as grupo ,
         (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `fechaAsignada` IS NULL AND `grupo`= G.`idGrupo`) as pendi ,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G 
        INNER JOIN tbl_consultaExterna AS E ON G.idGrupo=E.grupo
	    WHERE E.nroFua LIKE '%$fua%'  ORDER BY G.idGrupo ASC";
	    
	}else if($tipoRep=="HISTORIA"){
	    
	     $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
        (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`) as grupo ,
         (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `fechaAsignada` IS NULL AND `grupo`= G.`idGrupo`) as pendi ,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G 
        INNER JOIN tbl_consultaExterna AS E ON G.idGrupo=E.grupo
	    WHERE E.historiaClinica LIKE '%$fua%'  ORDER BY G.idGrupo ASC";
	}else{
	   
         $sql ="SELECT G.idUsuario,G.`idGrupo`,(SELECT `user` FROM `usuarios` WHERE `id` =G.`idUsuario`) as usreg,
        (SELECT `nom` FROM `usuarios` WHERE `id` =G.`idAuditor`) as usera ,
        (SELECT `fechaAsignada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FEA,
        (SELECT `fechaRecepcionada` FROM `tbl_consultaExterna` WHERE `grupo` = G.`idGrupo` LIMIT 1) AS FERE,
        (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `grupo`=G.`idGrupo`) as grupo ,
        (SELECT COUNT(*) FROM `tbl_consultaExterna` WHERE `fechaAsignada` IS NULL AND `grupo`= G.`idGrupo`) as pendi ,
        G.`observacion`, G.`fechaRegistro`, G.`fechaUpdate`,G.namePaquete FROM `tbl_grupoCE` AS G ORDER BY G.idGrupo ASC";
        
	}
	
	*/
	
	
	
	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['idGrupo'] 						= $row["idGrupo"];
		    $nestedData['usreg'] 						= strtoupper($row["usreg"]);
			//$nestedData['code'] 				        = strtoupper(date('dmY',strtotime($row["fechaRegistro"])).$row["idGrupo"]);
			
			 $numero = $row["idGrupo"];
            $numeroConCeros = str_pad($numero, 6, "0", STR_PAD_LEFT);
		    
			$nestedData['code'] 				        = "A".$numeroConCeros;
			$nestedData['paquete'] 				        = strtoupper($row['namePaquete']);
			$nestedData['auditor'] 					    = strtoupper($row["usera"]);
			$nestedData['observacion'] 				    = strtoupper($row["observacion"]);
			$fere="";
			($row['FERE']!="") ? $fere=date('d/m/Y',strtotime($row['FERE'])):$fere="";
		    $fea="";
			($row['FEA']!="") ? $fea=date('d/m/Y',strtotime($row['FEA'])):$fea="";
		
		
		//fechaAsig,G.fechaRecep 
		   $mosfeaA='';$mosfeaRex='';	
		   if($row['fechaAsig']==""){
		       $mosfeaA=$fere;
		   }else{
		       $mosfeaA=date('d/m/Y',strtotime($row['fechaAsig']));
		   }
		   
		    if($row['fechaRecep']==""){
		       $mosfeaRex=$fea;
		   }else{
		       $mosfeaRex=date('d/m/Y',strtotime($row['fechaRecep']));
		   }
		   
			
			$nestedData['pendientes'] 				    = $mosfeaRex;
			$nestedData['recibido'] 				    = $mosfeaA;
			$nestedData['cantidad'] 				    = $row["grupo"];
			$nestedData['fechaRegistro']				= date('d/m/Y H:i:s',strtotime($row['fechaRegistro']));
			$nestedData['fechaUpdate']			        = date('d/m/Y H:i:s',strtotime($row['fechaUpdate']));
			$nestedData['fechaReporte']				    = date('Y-m-d',strtotime($row['fechaRegistro']));
			$rc="";$rc2="";
			if($row['fex']!=""){
			        $rc=date('d/m/Y',strtotime($row['fex']));
			        $rc2=date('d/m/Y',strtotime($row['fex2']));  
			}
			$nestedData['fex']				    = $rc." - ". $rc2;
			
			$opciones ='';
		    /*	if($row['idUsuario']==$iduser || $rol == 7){
			    	$opciones ='<a onclick="verGrupos('.$row["idGrupo"].')" data-toggle="modal" data-target=".bs-example-modal-smResponsableAuditor" 
        			class="btn btn-primary btn-xs" ><i class="fa fa-edit"></i> Editar</a>
        			<a class="btn btn-danger btn-xs"  href="consultaExterna.php?grupo='.$row["idGrupo"].'" title="FUA"><i class="fa fa-arrows"></i> Fuas </a>';
			    
			}*/
				$tip='';$les='';
			if($row["fechaAsig"]=="" && $row["fechaRecep"]=="" && $fere=="" && $fea==""  ){
			    $tip='default';
			    $les='Sin asignar';
			}else if($row["fechaAsig"]!="" && $row["fechaRecep"]!="" || $fere!="" && $fea!="" ){
			    $tip='success';
			    $les='Terminado';
			}
			else {
			    $tip='warning';
			    $les='Pendiente';
			}
			
			
			$nestedData['filtroEstatus']				    = $les;
			$opcion ='<div class="btn-group" style="margin-bottom: 5px;">

								<button data-toggle="dropdown" class="btn btn-'.$tip.' dropdown-toggle btn-xs" type="button" aria-expanded="true"> Acciones <span class="caret"></span>
								</button>
								<ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
									<li>
										<a onclick="verGrupos('.$row["idGrupo"].')" data-toggle="modal" data-target=".bs-example-modal-smResponsableAuditor">
										    <i class="fa fa-edit"></i> Editar</a>
									</li>
									<li>
										<a href="consultaExterna.php?grupo='.$row["idGrupo"].'" title="FUA"><i class="fa fa-arrows"></i> Fuas </a>
									</li>
									<li>
									    <a onclick="eliminarPacHnal('.$row["idGrupo"].')"><i class="fa fa-trash"></i> Eliminar</a>
									</li>
								</ul>
							</div>';
		
			/*$opciones ='<a onclick="verGrupos('.$row["idGrupo"].')" data-toggle="modal" data-target=".bs-example-modal-smResponsableAuditor" 
        			class="btn btn-primary btn-xs" ><i class="fa fa-edit"></i> Editar</a>
        			<a class="btn btn-danger btn-xs"  href="consultaExterna.php?grupo='.$row["idGrupo"].'" title="FUA"><i class="fa fa-arrows"></i> Fuas </a>'; */
			
			$nestedData['opciones'] 				= $opcion;
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}


else if($function=="groupExamens"){

			
				$where="";
				if( !empty($_REQUEST['search']['value']) ) { 
					$where.=" WHERE  ( Cuenta LIKE '".$_REQUEST['search']['value']."%' ";    
					$where.=" OR CONCAT_WS(' ',ApePaterno,ApeMaterno,Primer_Nombre,Segundo_Nombre) LIKE '%".$_REQUEST['search']['value']."%'";
					$where.=" OR revisadoCheck LIKE '%".$_REQUEST['search']['value']."%' )";
				}

				$totalRecordsSql = "SELECT COUNT(DISTINCT cuenta) as total FROM nt_examenes $where";
				$stmt = $conn->prepare($totalRecordsSql);
				$stmt->execute();
				$res = $stmt->fetchAll();
				$totalRecords=0;
				foreach ($res as $key => $value) {
					$totalRecords = $value['total'];
				}
								  
				$columns = array( 
					
					0 =>'IdOrden',
					1 =>'Cuenta',
					2 =>'Fecha_Ingreso',
					3 =>'Afiliacion_Tipo_Formato',
					4 =>'Afiliacion_Formato',
					5 =>'PACIENTE',
					6 =>'SEREGRE',
					7 =>'ATENCION',
					8 =>'FechaMov',
					9 =>'Codigo',
					10 =>'Nombre' ,
					11 =>'Punto_Carga' ,
					12 =>'Asterisco',
					13 =>'FECHA_LABOR',
					14 =>'COPIA',
					15 =>'ORDEN' ,
					16 =>'RESULTADO' ,
					17 =>'RESPCOPIA' ,
					18 =>'CAJA' ,
					19=>'OBSERVACIONES' ,
					20 =>'Estado' ,
					21 =>'IAFA' ,
					22 =>'RESP_ENVIO' ,
					23 =>'FECHA_ENTREGA' ,
					24 =>'GRUPO_ENVIO' ,
					25 =>'fecha_item' ,
					26 =>'fehca_update' ,
					27 =>'id' ,
					28 =>'revi',
					29 =>'userevi',

				);


				$sql = "SELECT `id`, `IdOrden`, `IdProducto`, `Cuenta`, `Fecha_Ingreso`, `Fecha_Egreso`, `Fua_DISA`, `Fua_Lote`, `Fua_Numero`, `Afiliacion_Tipo_Formato`, 
				`Afiliacion_Formato`,CONCAT(`ApePaterno`,' ',`ApeMaterno`,' ',`Primer_Nombre`) PACIENTE,  `SerOrden`, `SerIngreso`, UPPER(SerEgreso) SEREGRE, UPPER(TipoAtencion) ATENCION, `FechaMov`,
				`Proveedor`, `Asterisco`, `Codigo`, `CodigoSIS`, `Nombre`, `Punto_Carga`, `Estado`, `FINANC`, `IAFA`, `TARIFA`, `TIPO_PROVEDOR`, `FECHA_LABOR`, `COPIA`, 
				`ORDEN`, `RESULTADO`, `RESPCOPIA`, `CAJA`, `OBSERVACIONES`, `ESTADO_LINEA`, `IAFA_NUEVO`, `RESP_ENVIO`, `FECHA_ENTREGA`, `GRUPO_ENVIO`, `fecha_item`,
				`fehca_update`, `user`, `fechaImport`,revisadoCheck,IF(revisadoCheck='on', 'SI', '') AS  revi,(SELECT UPPER(user) FROM USUARIOS WHERE id=NT.usrevisadoCheck) AS userevi  ";

				$sql.=" FROM `nt_examenes` AS NT $where GROUP BY Cuenta ";
				$sql.=" ORDER BY ". $columns[$_REQUEST['order'][0]['column']]."   ".$_REQUEST['order'][0]['dir']."  LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']."   ";

				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				$json_data = array(

				"draw"            => intval( $_REQUEST['draw'] ),   
				"recordsTotal"    => intval($totalRecords ),  
				"recordsFiltered" => intval($totalRecords),
				"data"            => $result
				);

				echo json_encode($json_data);
				

}



else if($function=="listGrupoArchivo"){

			    $id =  $_GET['id'];
			    $desdeFech = $_POST['desdeFech'];
                $maxFech = $_POST['maxFech'];
			    $cajaz='';
			    
			    ($id==1) ? $cajaz="tbl_Cajas":$cajaz="tbl_CajasCE";
			    
				$where="";$inner ='';
				$bus=trim($_REQUEST['search']['value']);
				
				if( !empty(trim($_REQUEST['search']['value'])) ) {
				    
				    if($id ==1){
    			        $inner ='INNER JOIN listadoAtenciones AS C ON P.idGrupo = C.idPaq
                                INNER JOIN tbl_Emergencias AS E ON C.idPac=E.idEm';
                                
    			    }else if($id ==2){
    			        $inner ='INNER JOIN listadoAtencionesCE AS C ON P.idGrupo = C.idPaq
                                 INNER JOIN tbl_Emergencias AS E ON C.idPac=E.idEm';
                                
    			    }
    			    
					$where.=" AND  E.cuenta  LIKE '%".trim($_REQUEST['search']['value'])."%'";
					$where.=" OR E.nroFua LIKE '%".$_REQUEST['search']['value']."%'";
					$where.=" OR E.historiaClinica LIKE '%".$_REQUEST['search']['value']."%'";
					$where.=" OR E.nroDoc LIKE '%".$_REQUEST['search']['value']."%'";
					$where.=" OR CONCAT_WS(' ',E.ApePaterno,E.ApeMaterno,E.nombres) LIKE '%".$_REQUEST['search']['value']."%'";
					//$where.=" OR P.idGrupo LIKE '%".$_REQUEST['search']['value']."%'";
					//$where.=" AND E.fechaIngreso BETWEEN '$desdeFech' AND '$maxFech'";

				}
				
				
			    /*if(!empty($desdeFech) && !empty($maxFech)){
			        
			            if($id ==1){
    			        $inner ='INNER JOIN listadoAtenciones AS C ON P.idGrupo = C.idPaq
                                INNER JOIN tbl_Emergencias AS E ON C.idPac=E.idEm';
                                
        			    }else if($id ==2){
        			        $inner ='INNER JOIN listadoAtencionesCE AS C ON P.idGrupo = C.idPaq
                                     INNER JOIN tbl_Emergencias AS E ON C.idPac=E.idEm';
                                    
        			    }
        			    
					    $where.=" AND E.fechaIngreso BETWEEN '$desdeFech' AND '$maxFech'";
					  
				}*/
				

				$totalRecordsSql = "SELECT COUNT(*) AS TOT,P.`idGrupo`,(SELECT UPPER(user) FROM usuarios WHERE id = P.`idUsuario`) as IDUSER ,CONCAT('PAQCE',EXTRACT(YEAR FROM P.fechaRegistro),'-',P.idGrupo) AS PAQ, P.`idCaja`,
				UPPER(P.`observacion`) AS OBS,date_format(P.`fechaRegistro`,'%d/%m/%Y %H:%i:%s') as feRegistro,date_format(P.`fechaUpdate`,'%d/%m/%Y %H:%i:%s') as feUps,P.`fechaRegistro`, P.`fechaUpdate`, P.`total`,
                (SELECT  CONCAT('CAJA',EXTRACT(YEAR FROM C.fechaRegistro),C.idCa) FROM $cajaz AS C WHERE C.`idCa`= P.idCaja) AS CAX, (SELECT UPPER(user) FROM usuarios WHERE id = P.`userAsignado`) as ASI,
                date_format(P.`fechaHoraAsignadoDigitador`,'%d/%m/%Y %H:%i:%s') as feUserasi,(SELECT UPPER(user) FROM usuarios WHERE id = P.`idUsuarioAsigCaja`) as IDUSERCAJA,date_format(P.`fechadigitacioncheck`,'%d/%m/%Y') as feDigita,
                date_format(P.`fechaHoraAsignadoCaja`,'%d/%m/%Y %H:%i:%s') as feUserasiCaja,(SELECT UPPER(user) FROM usuarios WHERE id = P.`liquidador`) as 2liquix,
                (SELECT UPPER(user) FROM usuarios WHERE id = (SELECT idUserLiquida  FROM `tbl_Emergencias` WHERE `idEm` = (SELECT `idPac` FROM listadoAtencionesCE WHERE `idPaq` = P.idGrupo ORDER BY `idPac` DESC LIMIT 1))) as liquix,
                (SELECT UPPER(user) FROM usuarios WHERE id = P.`userAsignaAudi`) as USERASIGAUDI,(SELECT UPPER(user) FROM usuarios WHERE id = P.`userAsignaDigi`) as USERASIGDIGI,date_format(P.fechaDevolucion,'%d/%m/%Y') as DEVOL,
                IF(P.tipoRegistro = 1, (SELECT COUNT(*)  FROM `listadoAtenciones` WHERE `idPaq` =P.`idGrupo`),(SELECT COUNT(*)  FROM `listadoAtencionesCE` WHERE `idPaq` =P.`idGrupo`)) AS QA,
                (SELECT UPPER(user) FROM usuarios WHERE id = P.`userAuditor`) as IDAUDITOR ,date_format(P.`fechaHoraUserAuditor`,'%d/%m/%Y %H:%i:%s') as feHorAud
                FROM `tbl_grupoArchivo` as P 
                $inner
                WHERE P.tipoRegistro='$id' $where";
                //echo  $totalRecordsSql;
				$stmt = $conn->prepare($totalRecordsSql);
				$stmt->execute();
				$res = $stmt->fetchAll();
				$totalRecords= 0;
				//echo $totalRecordsSql;
				foreach ($res as $key => $value) {
					$totalRecords = $value['TOT'];
				}
								  
				$columns = array( 
					
					0 =>'idGrupo',
					1 =>'IDUSER',
					2 =>'PAQ',
					3 =>'CAX',
					4 =>'OBS',
					5 =>'feRegistro',
					6 =>'feUps',
                    7 =>'ASI',
                    8 =>'feUserasi',
                    9 =>'IDUSERCAJA',
                    10 =>'feUserasiCaja',
                    11 =>'feDigita',
                    12 =>'IDAUDITOR',
                    13 =>'feHorAud',
                    14 =>'liquix',
                    14 =>'QA',
                    15 =>'USERASIGAUDI',
                    16 =>'USERASIGDIGI',
                    17 =>'DEVOL',
                   // 18 =>'ALERT',
                    
				);

                
                
				$sql = "SELECT P.`idGrupo`,(SELECT UPPER(user) FROM usuarios WHERE id = P.`idUsuario`) as IDUSER ,
				IF(P.tipoRegistro = 1, CONCAT('PAQEMG',EXTRACT(YEAR FROM P.fechaRegistro),'-',P.idGrupo) , CONCAT('PAQCE',EXTRACT(YEAR FROM P.fechaRegistro),'-',P.idGrupo) ) AS PAQ,P.`idCaja`,
				UPPER(P.`observacion`) AS OBS,date_format(P.`fechaRegistro`,'%d/%m/%Y %H:%i:%s') as feRegistro,date_format(P.`fechaUpdate`,'%d/%m/%Y %H:%i:%s') as feUps,P.`fechaRegistro`, P.`fechaUpdate`, P.`total`,
                (SELECT  CONCAT('CAJA',EXTRACT(YEAR FROM C.fechaRegistro),C.idCa) FROM $cajaz AS C WHERE C.`idCa`= P.idCaja) AS CAX, (SELECT UPPER(user) FROM usuarios WHERE id = P.`userAsignado`) as ASI,
                date_format(P.`fechaHoraAsignadoDigitador`,'%d/%m/%Y %H:%i:%s') as feUserasi,(SELECT UPPER(user) FROM usuarios WHERE id = P.`idUsuarioAsigCaja`) as IDUSERCAJA,date_format(P.`fechadigitacioncheck`,'%d/%m/%Y') as feDigita,
                (SELECT UPPER(user) FROM usuarios WHERE id = P.`liquidador`) as liquix,
                date_format(P.`fechaHoraAsignadoCaja`,'%d/%m/%Y %H:%i:%s') as feUserasiCaja,(SELECT UPPER(user) FROM usuarios WHERE id = (SELECT idUserLiquida  FROM `tbl_Emergencias` WHERE `idEm` = (SELECT `idPac` FROM listadoAtencionesCE WHERE `idPaq` = P.idGrupo ORDER BY `idPac` DESC LIMIT 1))) as 2liquix,
                (SELECT UPPER(user) FROM usuarios WHERE id = P.`userAsignaAudi`) as USERASIGAUDI,(SELECT UPPER(user) FROM usuarios WHERE id = P.`userAsignaDigi`) as USERASIGDIGI,date_format(P.fechaDevolucion,'%d/%m/%Y') as DEVOL,
                IF(P.tipoRegistro = 1, (SELECT COUNT(*)  FROM `listadoAtenciones` WHERE `idPaq` =P.`idGrupo`),(SELECT COUNT(*)  FROM `listadoAtencionesCE` WHERE `idPaq` =P.`idGrupo`)) AS QA,
                (SELECT UPPER(user) FROM usuarios WHERE id = P.`userAuditor`) as IDAUDITOR ,date_format(P.`fechaHoraUserAuditor`,'%d/%m/%Y %H:%i:%s') as feHorAud
                FROM `tbl_grupoArchivo` as P 
                $inner
                WHERE P.tipoRegistro='$id' $where  ";
				$sql.=" ORDER BY ". $columns[$_REQUEST['order'][0]['column']]." ".$_REQUEST['order'][0]['dir']."  LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']."   ";
                //echo $sql;
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				$json_data = array(

				"draw"            => intval( $_REQUEST['draw'] ),   
				"recordsTotal"    => intval($totalRecords ),  
				"recordsFiltered" => intval($totalRecords),
				"data"            => $result
				);

				echo json_encode($json_data);
				

}



else if($function=="listGrupoAtenciones"){

			
				$where="";$tipo = $_GET['tipo'];
				
				
	
				/*if( !empty($_REQUEST['search']['value']) ) { 
					$where.=" AND  ( nroCuenta LIKE '%".$_REQUEST['search']['value']."%'";
					$where.=" OR nroFua LIKE '%".$_REQUEST['search']['value']."%'";
					$where.=" OR paciente LIKE '%".$_REQUEST['search']['value']."%'";
					$where.=" OR Historia LIKE '%".$_REQUEST['search']['value']."%')";
				}
*/

			
				if($tipo!="2"){
				    
				    
				        if( !empty($_REQUEST['search']['value']) ) { 
        					$where.=" AND  ( nroCuenta LIKE '%".$_REQUEST['search']['value']."%'";
        					$where.=" OR nroFua LIKE '%".$_REQUEST['search']['value']."%'";
        					$where.=" OR paciente LIKE '%".$_REQUEST['search']['value']."%'";
        					$where.=" OR Historia LIKE '%".$_REQUEST['search']['value']."%')";
        				}
				    
				    
				    	$totalRecordsSql = "SELECT COUNT(*) AS TOT, P.`idPac`, P.`nroFua`, P.`nroCuenta`, P.`paciente`, P.`servicio`, 
        				date_format(P.`F_Ingreso`,'%d/%m/%Y') AS fechaIngres,date_format(P.`F_Alta_Medica`,'%d/%m/%Y') AS fechaAltMed,P.`F_Ingreso`, P.`F_Alta_Medica`, P.`Historia` FROM `paciente` AS P 
        				WHERE P.estado='ENVIADO' AND P.tipoEval=2 AND P.idPac NOT IN (SELECT `idPac` FROM `listadoAtenciones`) $where";
        						 
        				$sql = "SELECT P.`idPac`, P.`nroFua`, P.`nroCuenta`, P.`paciente`, P.`servicio`,date_format(P.`F_Ingreso`,'%d/%m/%Y') AS fechaIngres,date_format(P.`F_Alta_Medica`,'%d/%m/%Y') AS fechaAltMed,
        				P.`F_Ingreso`, P.`F_Alta_Medica`, P.`Historia` FROM `paciente` AS P WHERE P.estado='ENVIADO' AND P.tipoEval=2 AND P.idPac NOT IN (SELECT `idPac` FROM `listadoAtenciones`) $where";
        					 
				    
				}else{
				        
				        
			        	if( !empty($_REQUEST['search']['value']) ) { 
        					$where.=" AND  ( cuenta LIKE '%".$_REQUEST['search']['value']."%'";
        					$where.=" OR nroFua LIKE '%".$_REQUEST['search']['value']."%'";
        					$where.=" OR CONCAT_WS(' ',ApePaterno,ApeMaterno,nombres) LIKE '%".$_REQUEST['search']['value']."%'";
        					$where.=" OR historiaClinica LIKE '%".$_REQUEST['search']['value']."%')";
        				}
        				
				        $totalRecordsSql = "SELECT COUNT(*) AS TOT, P.`idEm` AS idPac , P.`nroFua`, P.`cuenta` AS nroCuenta ,CONCAT(P.ApePaterno,' ',P.ApeMaterno,' ',P.nombres) AS  paciente ,
				        date_format(P.fechaIngreso,'%d/%m/%Y') AS fechaIngres ,date_format(P.feAltaAlt,'%d/%m/%Y') AS fechaAltMed,P.historiaClinica AS Historia 
				        FROM tbl_Emergencias AS P WHERE P.tipoRegistro='3'  AND  P.idEm NOT IN(SELECT `idPac` FROM `listadoAtencionesCE`)  $where ";
				         
				        $sql = "SELECT P.`idEm` AS idPac , P.`nroFua`, P.`cuenta` AS nroCuenta ,CONCAT(P.ApePaterno,' ',P.ApeMaterno,' ',P.nombres) AS  paciente ,
				        date_format(P.fechaIngreso,'%d/%m/%Y') AS fechaIngres ,date_format(P.feAltaAlt,'%d/%m/%Y') AS fechaAltMed,P.historiaClinica AS Historia 
				        FROM tbl_Emergencias AS P WHERE P.tipoRegistro='3' AND P.idEm NOT IN(SELECT `idPac` FROM `listadoAtencionesCE`)  $where";
				    
				}
						 
						 
				$stmt = $conn->prepare($totalRecordsSql);
				$stmt->execute();
				$res = $stmt->fetchAll();
				$totalRecords= 0;
				 //echo $totalRecordsSql;
				
				foreach ($res as $key => $value) {
					$totalRecords = $value['TOT'];
				}
								  
				$columns = array( 
					
					
				
					0 =>'idPac',
					1 =>'nroFua',
					2 =>'nroCuenta',
					3 =>'paciente',
					4 =>'Historia',
					5 =>'fechaIngres',
					6 =>'fechaAltMed',
                   
				);


				$sql.=" ORDER BY ". $columns[$_REQUEST['order'][0]['column']]." ".$_REQUEST['order'][0]['dir']."  LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']."   ";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				$json_data = array(

				"draw"            => intval( $_REQUEST['draw'] ),   
				"recordsTotal"    => intval($totalRecords ),  
				"recordsFiltered" => intval($totalRecords),
				"data"            => $result
				);

				echo json_encode($json_data);
				

}


else if($function=="listGrupoAtencionesCE"){

			     $tipo =  $_GET['tipo'];	$totalRecordsSql ="";	$sql = "";
			     $desdeFech = $_POST['desdeFech'];
                 $maxFech = $_POST['maxFech'];
			    
				$where="";$wherePost="";
				if(!empty($_REQUEST['search']['value']) ) { 
				   
					$where.=" AND (P.nroCuenta LIKE '%".$_REQUEST['search']['value']."%' ";
					$where.=" OR P.nroFua LIKE '%".$_REQUEST['search']['value']."%'";
					$where.=" OR P.paciente LIKE '%".$_REQUEST['search']['value']."%'";
					$where.=" OR P.Historia LIKE '%".$_REQUEST['search']['value']."%')"; 
				}
            
            
                          if(!empty($desdeFech) && !empty($maxFech)){
        					$where=" AND P.F_Alta_Medica BETWEEN '$desdeFech' AND '$maxFech'";
        				  }else{
        				     $wherePost=" AND P.F_Alta_Medica  BETWEEN '2023-05-01' AND DATE(NOW())"; 
        				  }
                    
            
                if($tipo==1){
                    
                     
                
                    
    			            $totalRecordsSql ="SELECT COUNT(*) AS TOT,P.idPac,P.`nroCuenta`,P.`Historia`,P.`nroFua`,P.`paciente`,P.`servicio`,date_format(P.`F_Ingreso`,'%d/%m/%Y') AS fechaIngres,P.`F_Ingreso`,P.F_Alta_Medica,
    			            date_format(P.`F_Alta_Medica`,'%d/%m/%Y') AS fechaAlts,P.F_Alta_Medica,
    				        (SELECT UPPER(`descripcion`) FROM `pabellones` WHERE `idPa` = P.serEgreso) AS SEREMER 
    				        FROM `paciente` AS P WHERE P.`tipoEval`= $tipo AND P.`iduser` ='0' $where $wherePost";
    			        
    			            $sql = "SELECT P.idPac,P.`nroCuenta`,P.`Historia`,P.`nroFua`,P.`paciente`,P.`servicio`,date_format(P.`F_Ingreso`,'%d/%m/%Y') AS fechaIngres,P.`F_Ingreso`,P.F_Alta_Medica,
    			            date_format(P.`F_Alta_Medica`,'%d/%m/%Y') AS fechaAlts,P.F_Alta_Medica,
    			        	(SELECT UPPER(`descripcion`) FROM `pabellones` WHERE `idPa` = P.serEgreso)  AS SEREMER 
    			        	FROM `paciente` AS P WHERE P.`tipoEval`= $tipo AND P.`iduser` ='0' $where $wherePost";
			        
			        
			        
			    }else  if($tipo==2){
			        
			         
			        
        			        $totalRecordsSql ="SELECT  COUNT(*) AS TOT,P.idPac,P.`nroCuenta`,P.`Historia`,P.`nroFua`,P.`paciente`,P.`servicio`,date_format(P.`F_Ingreso`,'%d/%m/%Y') AS fechaIngres,P.`F_Ingreso`,P.F_Alta_Medica,
        			        date_format(P.`F_Alta_Medica`,'%d/%m/%Y') AS fechaAlts,P.F_Alta_Medica,
        					(SELECT UPPER(`nombre`) FROM `tipoServicioIngreso` WHERE `idTsi`= P.serEgreso) AS SEREMER FROM `paciente` AS P
            			    INNER JOIN tbl_Emergencias AS E ON  P.idEmg=E.idEm
            				WHERE P.`tipoEval`= $tipo AND P.`iduser` ='0' $where AND  E.financia=2 AND P.serEgreso IN('6','7','8') $wherePost";
            				
        			        $sql = "SELECT P.idPac,P.`nroCuenta`,P.`Historia`,P.`nroFua`,P.`paciente`,P.`servicio`,date_format(P.`F_Ingreso`,'%d/%m/%Y') AS fechaIngres,P.`F_Ingreso`,
        			        date_format(P.`F_Alta_Medica`,'%d/%m/%Y') AS fechaAlts,P.F_Alta_Medica,
        					(SELECT UPPER(`nombre`) FROM `tipoServicioIngreso` WHERE `idTsi`= P.serEgreso) AS SEREMER FROM `paciente` AS P
        			        INNER JOIN tbl_Emergencias AS E ON  P.idEmg=E.idEm
        				    WHERE P.`tipoEval`= $tipo AND P.`iduser` ='0' $where AND E.financia=2 AND P.serEgreso IN('6','7','8') $wherePost";
        				    //	echo $sql;
        	    }
        			    
			    else  if($tipo==3){
			        
			      
			       
        			       if(!empty($desdeFech) && !empty($maxFech)){
            					$where=" AND P.fe_reg BETWEEN '$desdeFech' AND '$maxFech'";
            			   }else{
            				    $wherePost=" AND P.fe_reg  BETWEEN '2023-05-01 00:00:00' AND '2023-07-24 23:59:59'";    
            				}
            				
        			        
        			        $totalRecordsSql ="SELECT  COUNT(*) AS TOT,P.idPac,P.`nroCuenta`,P.`Historia`,P.`nroFua`,P.`paciente`,P.`servicio`,date_format(P.`F_Ingreso`,'%d/%m/%Y') AS fechaIngres,P.`F_Ingreso`,P.F_Alta_Medica,
        			        date_format(P.`F_Ingreso`,'%d/%m/%Y') AS fechaAlts,P.F_Alta_Medica, UPPER(P.`servicio`) AS SEREMER FROM `paciente` AS P
            			    INNER JOIN tbl_Emergencias AS E ON  P.idEmg=E.idEm
            				WHERE P.`tipoEval`= $tipo AND P.`iduser` ='0' $where  ";
            				
        			        $sql = "SELECT P.idPac,P.`nroCuenta`,P.`Historia`,P.`nroFua`,P.`paciente`,P.`servicio`,date_format(P.`F_Ingreso`,'%d/%m/%Y') AS fechaIngres,P.`F_Ingreso`,
        			        date_format(P.`F_Ingreso`,'%d/%m/%Y') AS fechaAlts,P.F_Alta_Medica, UPPER(P.`servicio`) AS SEREMER  FROM `paciente` AS P
        			        INNER JOIN tbl_Emergencias AS E ON  P.idEmg=E.idEm
        				    WHERE P.`tipoEval`= $tipo AND P.`iduser` ='0' $where   $wherePost ";
        				    //	echo $sql;
			    }
			    


			/*	$totalRecordsSql = "SELECT COUNT(*) AS TOT,P.idPac,P.`nroCuenta`,P.`Historia`,P.`nroFua`,P.`paciente`,P.`servicio`,date_format(P.`F_Ingreso`,'%d/%m/%Y') AS fechaIngres,P.`F_Ingreso`,
				(SELECT UPPER(`nombre`) FROM `tipoServicioIngreso` WHERE `idTsi`= P.serEgreso) AS SEREMER 
				FROM `paciente` AS P WHERE P.`tipoEval`= $tipo AND P.`iduser` ='0' $where AND P.F_Alta_Medica BETWEEN '2023-05-01' AND '2023-05-31'"; */
				$stmt = $conn->prepare($totalRecordsSql);
				$stmt->execute();
				$res = $stmt->fetchAll();
				$totalRecords= 0;
				 //echo $_REQUEST['search']['value'];
				
				foreach ($res as $key => $value) {
					$totalRecords = $value['TOT'];
				}
								  
				$columns = array( 
					
					
				
					0 =>'idPac',
					1 =>'nroCuenta',
					2 =>'Historia',
					3 =>'nroFua',
					4 =>'paciente',
					5 =>'SEREMER',
					6 =>'fechaAlts',
                   
				);


			/*	$sql = "SELECT P.idPac,P.`nroCuenta`,P.`Historia`,P.`nroFua`,P.`paciente`,P.`servicio`,date_format(P.`F_Ingreso`,'%d/%m/%Y') AS fechaIngres,P.`F_Ingreso`,
					(SELECT UPPER(`nombre`) FROM `tipoServicioIngreso` WHERE `idTsi`= P.serEgreso) AS SEREMER FROM `paciente` AS P
			    INNER JOIN tbl_Emergencias AS E ON  P.idEmg=E.idEm
				WHERE P.`tipoEval`= $tipo AND P.`iduser` ='0' $where AND P.F_Alta_Medica BETWEEN '2023-05-01' AND '2023-05-31' AND E.financia=2";*/
				$sql.=" ORDER BY P.`paciente` ASC  LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']."   ";
				$stmt = $conn->prepare($sql);
				//echo $sql;
				
				$stmt->execute();
				$result = $stmt->fetchAll();
				$json_data = array(

				"draw"            => intval( $_REQUEST['draw'] ),   
				"recordsTotal"    => intval($totalRecords ),  
				"recordsFiltered" => intval($totalRecords),
				"data"            => $result
				);

				echo json_encode($json_data);
				

}


else if($function=="listGrupoArchivoGeneral"){

			    $tipo =  $_GET['tipo'];
			    $inner='';$px='';$tixr='1';
			    	$where="";
			
			    
			    
			    if($tipo == 1){
			            
			            	if( !empty($_REQUEST['search']['value']) ) { 
            					$where.=" AND  ( nroCuenta LIKE '%".$_REQUEST['search']['value']."%')";
            				}
			        
                        $totalRecordsSql = "SELECT COUNT(*) AS TOT,P.`nroFua`, P.`nroCuenta`, P.`paciente`,(SELECT UPPER(`nombre`) FROM `tipoServicioIngreso` WHERE `idTsi` = P.`serEgreso`) as SERF,
        				date_format(P.`F_Ingreso`,'%d/%m/%Y') AS feregs, date_format(P.`F_Alta_Medica`,'%d/%m/%Y') AS fechaAlt, P.`Historia`,CONCAT('PAQEMG',EXTRACT(YEAR FROM G.fechaRegistro),G.idGrupo) AS PAQ,
        				date_format(G.fechaRegistro,'%d/%m/%Y %H:%i:%s') AS FEPAQ,(SELECT UPPER(user) FROM usuarios WHERE id=L.userReg) AS PAUSER,date_format(G.fechaHoraAsignadoCaja,'%d/%m/%Y %H:%i:%s') AS FERECAJA,
        				(SELECT UPPER(user) FROM usuarios WHERE id=G.idUsuarioAsigCaja) AS CAUSER,CONCAT('CA',EXTRACT(YEAR FROM C.fechaRegistro),C.idCa) AS CAXL,P.`servicio`,P.tipoEval,
        				(SELECT UPPER(regServiceCE) FROM tbl_Emergencias WHERE idEm ='L.idPac') AS SECE
                         ,(SELECT UPPER(user) FROM usuarios WHERE id=G.userAsignado) AS USERASIG,date_format(G.fechaHoraAsignadoDigitador,'%d/%m/%Y %H:%i:%s') AS FEHORAASIUSER,
                         date_format(G.fechadigitacioncheck,'%d/%m/%Y') AS FEDIGIT
                        FROM `paciente` AS P  
                        INNER JOIN listadoAtenciones AS L ON L.idPac=P.idPac
                        LEFT JOIN tbl_grupoArchivo AS G ON L.idPaq=G.idGrupo
                        LEFT JOIN tbl_Cajas AS C ON G.idCaja=C.idCa WHERE 1 $where ";
                        
                        
                        $sql = "SELECT  P.`nroFua`, P.`nroCuenta`, P.`paciente`,(SELECT UPPER(`nombre`) FROM `tipoServicioIngreso` WHERE `idTsi` = P.`serEgreso`) as SERF,date_format(P.`F_Ingreso`,'%d/%m/%Y') AS feregs,
        				date_format(P.`F_Alta_Medica`,'%d/%m/%Y') AS fechaAlt, P.`Historia`,CONCAT('PAQEMG',EXTRACT(YEAR FROM G.fechaRegistro),G.idGrupo) AS PAQ,(SELECT UPPER(regServiceCE) FROM tbl_Emergencias WHERE idEm ='L.idPac') AS SECE,
        				date_format(G.fechaRegistro,'%d/%m/%Y %H:%i:%s') AS FEPAQ,(SELECT UPPER(user) FROM usuarios WHERE id=L.userReg) AS PAUSER,date_format(G.fechaHoraAsignadoCaja,'%d/%m/%Y %H:%i:%s' ) AS FERECAJA,
        				(SELECT UPPER(user) FROM usuarios WHERE id=G.idUsuarioAsigCaja) AS CAUSER,CONCAT('CA',EXTRACT(YEAR FROM C.fechaRegistro),C.idCa) AS CAXL
                        ,(SELECT UPPER(user) FROM usuarios WHERE id=G.userAsignado) AS USERASIG,date_format(G.fechaHoraAsignadoDigitador,'%d/%m/%Y %H:%i:%s') AS FEHORAASIUSER,date_format(G.fechadigitacioncheck,'%d/%m/%Y') AS FEDIGIT,
                        P.servicio,P.tipoEval
                        FROM `paciente` AS P  
                        INNER JOIN listadoAtenciones AS L ON L.idPac=P.idPac
                        LEFT JOIN tbl_grupoArchivo AS G ON L.idPaq=G.idGrupo
                        LEFT JOIN tbl_Cajas AS C ON G.idCaja=C.idCa WHERE 1 $where ";          
                                    
                            
			    }else if($tipo == 2){
			            
			                	if( !empty($_REQUEST['search']['value']) ) { 
                    					$where.=" AND  ( P.cuenta LIKE '%".$_REQUEST['search']['value']."%')";
                    				}
			                
			                $totalRecordsSql = "SELECT COUNT(*) AS TOT,P.`nroFua`, P.cuenta AS nroCuenta,CONCAT( P.ApePaterno,' ',P.ApeMaterno,' ',P.nombres)  AS  paciente,'A' as SERF,date_format(P.`fechaIngreso`,'%d/%m/%Y') AS feregs,P.tipoRegistro,'-' AS fechaAlt,
                            P.historiaClinica AS Historia,CONCAT('PAQCE',EXTRACT(YEAR FROM G.fechaRegistro),G.idGrupo) AS PAQ,P.regServiceCE AS SECE,
            				date_format(G.fechaRegistro,'%d/%m/%Y %H:%i:%s') AS FEPAQ,(SELECT UPPER(user) FROM usuarios WHERE id=L.userReg) AS PAUSER,date_format(G.fechaHoraAsignadoCaja,'%d/%m/%Y %H:%i:%s' ) AS FERECAJA,
            				(SELECT UPPER(user) FROM usuarios WHERE id=G.idUsuarioAsigCaja) AS CAUSER,CONCAT('CA',EXTRACT(YEAR FROM C.fechaRegistro),C.idCa) AS CAXL
                            ,(SELECT UPPER(user) FROM usuarios WHERE id=G.userAsignado) AS USERASIG,date_format(G.fechaHoraAsignadoDigitador,'%d/%m/%Y %H:%i:%s') AS FEHORAASIUSER,date_format(G.fechadigitacioncheck,'%d/%m/%Y') AS FEDIGIT,'3' AS tipoEval,
                            '-' AS servicio
                            FROM tbl_Emergencias AS P
                            INNER JOIN listadoAtencionesCE AS L ON L.idPac=P.idEm
                            LEFT JOIN tbl_grupoArchivo AS G ON L.idPaq=G.idGrupo
                            LEFT JOIN tbl_CajasCE AS C ON G.idCaja=C.idCa
                            WHERE P.tipoRegistro=3 $where ";
                    
                    
                            $sql = "SELECT  P.`nroFua`, P.cuenta AS nroCuenta,CONCAT( P.ApePaterno,' ',P.ApeMaterno,' ',P.nombres)  AS  paciente,'A' as SERF,date_format(P.`fechaIngreso`,'%d/%m/%Y') AS feregs,P.tipoRegistro,'-' AS fechaAlt,
                            P.historiaClinica AS Historia,CONCAT('PAQCE',EXTRACT(YEAR FROM G.fechaRegistro),G.idGrupo) AS PAQ,P.regServiceCE AS SECE,
            				date_format(G.fechaRegistro,'%d/%m/%Y %H:%i:%s') AS FEPAQ,(SELECT UPPER(user) FROM usuarios WHERE id=L.userReg) AS PAUSER,date_format(G.fechaHoraAsignadoCaja,'%d/%m/%Y %H:%i:%s' ) AS FERECAJA,
            				(SELECT UPPER(user) FROM usuarios WHERE id=G.idUsuarioAsigCaja) AS CAUSER,CONCAT('CA',EXTRACT(YEAR FROM C.fechaRegistro),C.idCa) AS CAXL
                            ,(SELECT UPPER(user) FROM usuarios WHERE id=G.userAsignado) AS USERASIG,date_format(G.fechaHoraAsignadoDigitador,'%d/%m/%Y %H:%i:%s') AS FEHORAASIUSER,date_format(G.fechadigitacioncheck,'%d/%m/%Y') AS FEDIGIT,'3' AS tipoEval,
                            '-' AS servicio
                            FROM tbl_Emergencias AS P
                            INNER JOIN listadoAtencionesCE AS L ON L.idPac=P.idEm
                            LEFT JOIN tbl_grupoArchivo AS G ON L.idPaq=G.idGrupo
                            LEFT JOIN tbl_CajasCE AS C ON G.idCaja=C.idCa
                            WHERE P.tipoRegistro=3 $where "; 
			        
			    }
			    
			 //echo $sql;

				
				$stmt = $conn->prepare($totalRecordsSql);
				$stmt->execute();
				$res = $stmt->fetchAll();
				$totalRecords= 0;
				
				foreach ($res as $key => $value) {
					$totalRecords = $value['TOT'];
				}
								  
				$columns = array( 
					
					0 =>'nroCuenta',
					1 =>'Historia',
					2 =>'nroFua',
					3 =>'paciente',
					4 =>'SERF',
					5 =>'feregs',
					6 =>'fechaAlt',
                    7 =>'PAQ',
                    8 =>'FEPAQ',
                    9 =>'PAUSER',
                    10 =>'CAUSER',
                    11 =>'FERECAJA',
                    12 =>'CAXL',
                    13 =>'USERASIG',
                    14 =>'FEHORAASIUSER',
                    15 =>'servicio',
                    16 =>'tipoEval',
                    17 =>'FEDIGIT', 
                    
				);

				
	
				$sql.=" ORDER BY  ". $columns[$_REQUEST['order'][0]['column']]."   ".$_REQUEST['order'][0]['dir']."  LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']."   ";
                
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				$json_data = array(

				"draw"            => intval( $_REQUEST['draw'] ),   
				"recordsTotal"    => intval($totalRecords ),  
				"recordsFiltered" => intval($totalRecords),
				"data"            => $result
				);

				echo json_encode($json_data);
				

}

else if($function=="listGrupoCajas"){

			
				$where="";
				if( !empty($_REQUEST['search']['value']) ) { 
					$where.=" WHERE  ( namePaquete LIKE '%".$_REQUEST['search']['value']."%')";
				}

				$totalRecordsSql = "SELECT COUNT(*) AS TOT FROM tbl_Cajas $where";
				$stmt = $conn->prepare($totalRecordsSql);
				$stmt->execute();
				$res = $stmt->fetchAll();
				$totalRecords= 0;
				
				foreach ($res as $key => $value) {
					$totalRecords = $value['TOT'];
				}
								  
				$columns = array( 
					
					0 =>'idCa',
					1 =>'idUsuario',
					2 =>'observacion',
					3 =>'fechaRegistro',
					4 =>'fechaUpdate',
				
				);


				$sql = "SELECT `idCa`, `idUsuario`, `observacion`, `fechaRegistro`, `fechaUpdate`";
				$sql.=" FROM `tbl_Cajas` $where ";
				$sql.=" ORDER BY ". $columns[$_REQUEST['order'][0]['column']]."   ".$_REQUEST['order'][0]['dir']."  LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']."   ";
                //echo $sql;
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				$json_data = array(

				"draw"            => intval( $_REQUEST['draw'] ),   
				"recordsTotal"    => intval($totalRecords ),  
				"recordsFiltered" => intval($totalRecords),
				"data"            => $result
				);

				echo json_encode($json_data);
				

}




else if($function=="listGrupoCajasCE"){


	     $sql ="SELECT C.`idCa`, (SELECT user FROM usuarios WHERE id=C.`idUsuario`) AS UX, C.`observacion`, C.`fechaRegistro`, C.`fechaUpdate`, C.`estado`,
	     (SELECT COUNT(*) FROM `tbl_grupoArchivo` WHERE `idCaja`=C.idCa )AS CTCA,C.archivado FROM `tbl_CajasCE` AS C ORDER BY C.idCa DESC";
	    

	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['idCa'] 				= "CAJA".date('Y',strtotime($row['fechaRegistro']))."-".$row["idCa"];
		    $nestedData['UX'] 					= strtoupper($row["UX"]);
		    $arc='';
		    ($row["archivado"]==1) ? $arc='SI':$arc='NO'; 
			$nestedData['archivado'] 			= $arc;
			$nestedData['cant'] 			= $row["CTCA"];
			$nestedData['fechaRegistro'] 		= date('d/m/Y',strtotime($row['fechaRegistro']));
			$nestedData['fechaUpdate']			= date('d/m/Y',strtotime($row['fechaUpdate']));
			
			
			
			$opcion ='<div class="btn-group" style="margin-bottom: 5px;">

								<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs" type="button" aria-expanded="true"> Acciones <span class="caret"></span>
								</button>
								<ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
									<li>
										<a data-toggle="modal" data-target=".bs-example-modal-modalCrearCaja" onclick="verObserpaCajas('.$row["idCa"].')"><i class="fa fa-briefcase"></i> Observaciones</a>
									</li>
						
									<li>
										<a onclick="liberarCaja('.$row["idCa"].')"><i class="fa fa-trash"></i> Liberar Caja</a>
									</li>
								</ul>
							</div>';
		
		
			
			$nestedData['opciones'] 				= $opcion;
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}



else if($function=="listQuimio"){


	     $sql ="SELECT `idQ`, `paciente`, `historia`, `fua`, `cuenta`, `feAtencion`, `medico`, `feProc`, `nsp`, `devolucion`, `fechaRegistro`, `fechaUpdate`, 
	     `userRegistro` FROM `tbl_quimioterapia`  ORDER BY idQ ASC";
	    

	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['idQ'] 						= $row["idQ"];
		    $nestedData['paciente'] 						= strtoupper($row["paciente"]);
			$nestedData['historia'] 				    = $row["historia"];
			$nestedData['fua'] 				    = $row["fua"];
			$nestedData['cuenta'] 				    = $row["cuenta"];
			$nestedData['feAtencion'] 				= date('d/m/Y',strtotime($row['feAtencion']));
			$nestedData['medico'] 				    = $row["medico"];
			$nestedData['userRegistro'] 				    = $row["userRegistro"];
			
			$nestedData['feProc']				= date('d/m/Y',strtotime($row['feProc']));
			$nestedData['nsp']			        = date('d/m/Y',strtotime($row['nsp']));
			$nestedData['devolucion']			= date('d/m/Y',strtotime($row['devolucion']));
			
			
			$opcion ='<div class="btn-group" style="margin-bottom: 5px;">

								<button data-toggle="dropdown" class="btn btn-'.$tip.' dropdown-toggle btn-xs" type="button" aria-expanded="true"> Acciones <span class="caret"></span>
								</button>
								<ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
									<li>
										<a onclick="verRegistroQuimio('.$row["idQ"].')" data-toggle="modal" data-target=".bs-example-modal-smRegQuim">
										    <i class="fa fa-edit"></i> Editar</a>
									</li>
									<li>
										<a onclick="agregarSesions('.$row["idQ"].')" data-toggle="modal" data-target=".bs-example-modal-smSesiones" title="Sesiones"><i class="fa fa-arrows"></i> Sesiones </a>
									</li>
									<li>
										<a onclick="elimi555narPacHnal('.$row["idQ"].')"><i class="fa fa-trash"></i> Eliminar</a>
									</li>
								</ul>
							</div>';
		
		
			
			$nestedData['opciones'] 				= $opcion;
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}


else if($function=="listadoCajasMod"){


	     $sql ="SELECT `idCa`,(SELECT user FROM usuarios WHERE id=C.idUsuario) as UST,`idUsuario`,CONCAT('CA',EXTRACT(YEAR FROM C.fechaRegistro),C.idCa) AS CAJ, `observacion`, `fechaRegistro`, `fechaUpdate`, `estado` FROM `tbl_Cajas` AS C ORDER BY idCa DESC";
	    

	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['id'] 						= $row["CAJ"];
		    $nestedData['referencia'] 				= strtoupper($row["observacion"]);
		    $nestedData['user'] 				    = strtoupper($row["UST"]);
			$nestedData['total'] 				    = "1";
			$nestedData['opciones'] 				= '<a  style="font-weight: 900;color: white;font-size: 9px;background: red;cursor: pointer;padding: 4px;" onclick="deleteCajas('.$row["idCa"].')">X</a>';
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}


else if($function=="listadoCajasModPaquetes"){
    
        $tipo =  $_GET['tipo'];
    
    
	     $sql ="SELECT A.`idGrupo`,CONCAT('PAQ',EXTRACT(YEAR FROM A.fechaRegistro),'-',A.idGrupo) AS PAQ,(SELECT user FROM usuarios WHERE id=A.idUsuario ) AS RIO , A.`idCaja`, A.`observacion`, A.`fechaRegistro` FROM `tbl_grupoArchivo`  AS A
	     WHERE A.tipoRegistro='$tipo' AND A.`idCaja` ='' OR A.tipoRegistro='$tipo' AND A.idCaja IS NULL ORDER BY A.idGrupo DESC";
	    
	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
			$nestedData['chk'] 						= '<input type="checkbox" class="allasig" value="'.$row['idGrupo'].'" />';
		    $nestedData['id'] 						= $row["PAQ"];
		    $nestedData['usuario'] 					= strtoupper($row["RIO"]);
		    $nestedData['referencia'] 				= strtoupper($row["observacion"]);
			$nestedData['opciones'] 				= date('d/m/Y',strtotime($row['fechaRegistro']));
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}


else if($function=="listadoDesignacion"){


	     $sql ="SELECT D.`id`,(SELECT user FROM usuarios WHERE id=D.`iduser`) AS USERE, D.`rango`, D.`rango2`,(SELECT `descripcion` FROM `tbl_serDesig` WHERE `id`=D.`servicio`) as DSER , D.`correo`, D.`adjunto`,
	     (SELECT user FROM usuarios WHERE id=D.`idresponsable`)  AS USR, D.`fechaReg`, D.`fechaUpdate`,D.observaciones,D.cantidad FROM `tbl_designacion` as D ORDER BY id DESC";
	    

	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['id'] 						= $row["id"];
		    $nestedData['user'] 				    = strtoupper($row["USERE"]);
			$nestedData['rango'] 				    = $row["rango"]."-".$row["rango2"];
			$nestedData['cantidad'] 				= $row["cantidad"];
			$nestedData['servicio'] 				= strtoupper($row["DSER"]);
			$nestedData['correo'] 				    = strtoupper($row["correo"]);
			$ver='';
			if($row["adjunto"]!=""){
			    $ver='<a style="color: white;" target="_blank" href="designacionFuas/'.$row["adjunto"].'"><img style="width:15px;" src="images/pdf.png"></a>';    
			}
			
			$nestedData['adjunto'] 				    = $ver;
			$nestedData['idresponsable'] 			= strtoupper($row["USR"]);
			$nestedData['fechaReg'] 				= date('d/m/Y',strtotime($row['fechaReg']));
			//$nestedData['fechaUpdate']				= date('d/m/Y',strtotime($row['fechaUpdate']));
            $nestedData['observac'] 		    	= strtoupper($row["observaciones"]);
			
			
			$opcion ='<div class="btn-group" style="margin-bottom: 5px;">

								<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs" type="button" aria-expanded="true"> Acciones <span class="caret"></span>
								</button>
								<ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
									<li>
										<a onclick="ediftarDesigFuas('.$row["id"].')" data-toggle="modal" data-target=".bs-example-modal-smRango">
										    <i class="fa fa-edit"></i> Editar</a>
									</li>
									<li>
										<a onclick="deleteDesigFuas('.$row["id"].')"><i class="fa fa-trash"></i> Eliminar</a>
									</li>
								</ul>
							</div>';
		
		
			
			$nestedData['opciones'] 				= $opcion;
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}




else if($function=="sqlDxHistoria"){

    	$id = $_GET['id'];
        
	     $sql ="SELECT `idDxHis`,`dx`,`tipoDx` FROM `tbl_dxHistoria` WHERE `idRef` = '$id'  AND dx <>'undefined' AND dx <> '' ORDER BY idDxHis ASC";
	    

	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['dx'] 	= $row["dx"];
	        $nestedData['tipoDx'] 		= $row["tipoDx"];
		
			$opcion ='<a style="background: #d9534f;border: 1px solid #d9534f;margin: -2px;" class="btn btn-danger btn-xs" 
			onclick="deleteDxHist('.$row["idDxHis"].')"  title="Eliminar"><i class="fa fa-close"></i></a>';
		
		
			
			$nestedData['opciones'] 				= $opcion;
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}





else if($function=="sqlDxPreOperatorio"){

    	$id = $_GET['id'];
        
	     $sql ="SELECT `idDxHis`, `iduser`, `idRef`, `dx`, `tipoDx`, `fechaRegistro` FROM `tbl_dxPreOperatorio` WHERE `idRef`= '$id'  AND dx <>'undefined' AND dx <> '' ORDER BY idDxHis ASC";
	    

	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['dx'] 	= $row["dx"];
	        $nestedData['tipoDx'] 		= $row["tipoDx"];
		
			$opcion ='<a style="background: #d9534f;border: 1px solid #d9534f;margin: -2px;" class="btn btn-danger btn-xs" 
			onclick="deleteDxPreop('.$row["idDxHis"].')"  title="Eliminar"><i class="fa fa-close"></i></a>';
		
		
			
			$nestedData['opciones'] 				= $opcion;
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}



else if($function=="sqlDxPostOperatorio"){

    	$id = $_GET['id'];
        
	     $sql ="SELECT `idDxHis`, `iduser`, `idRef`, `dx`, `tipoDx`, `fechaRegistro` FROM `tbl_DxPostOperatorio` WHERE `idRef`= '$id'  AND dx <>'undefined' AND dx <> '' ORDER BY idDxHis ASC";
	    

	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['dx'] 	= $row["dx"];
	        $nestedData['tipoDx'] 		= $row["tipoDx"];
		
			$opcion ='<a style="background: #d9534f;border: 1px solid #d9534f;margin: -2px;" class="btn btn-danger btn-xs" 
			onclick="deleteDxPostoPer('.$row["idDxHis"].')"  title="Eliminar"><i class="fa fa-close"></i></a>';
		
		
			
			$nestedData['opciones'] 				= $opcion;
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}


else if($function=="sqlDxTratamiento"){

    	$id = $_GET['id'];
        
	     $sql ="SELECT `idDxHis`,`descripcion`,`cant` FROM `tbl_tratHistoria` WHERE `idRef` = '$id'  AND descripcion <>'undefined' AND descripcion <> '' ORDER BY idDxHis ASC";
	    

	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['descripcion'] 	= $row["descripcion"];
	        $nestedData['cant'] 		= $row["cant"];
		
			$opcion ='<a style="background: #d9534f;border: 1px solid #d9534f;margin: -2px;" class="btn btn-danger btn-xs" 
			onclick="deleteTratHist('.$row["idDxHis"].')"  title="Eliminar"><i class="fa fa-close"></i></a>';
		
		
			
			$nestedData['opciones'] 				= $opcion;
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}




else if($function=="sqlExamenesAuxiliares"){

    	$id = $_GET['id'];
    	$tipo = $_GET['tipo'];
        
	     $sql ="SELECT `idDxHis`, `des` FROM `tbl_examenesAuxiliares` WHERE `idRef`='$id' AND `tipo`='$tipo' AND des <>'undefined' AND des <> '' ORDER BY idDxHis ASC";
	    

	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['des'] 	= strtoupper($row["des"]);
			$opcion ='<a style="background: #d9534f;border: 1px solid #d9534f;margin: -2px;" class="btn btn-danger btn-xs" 
			onclick="deleteExamnHist('.$row["idDxHis"].')"  title="Eliminar"><i class="fa fa-close"></i></a>';
		
		
			
			$nestedData['opciones'] 				= $opcion;
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}




else if($function=="sqlSingosSintomas"){

    	$id = $_GET['id'];
	     $sql ="SELECT idDxHis, `idRef`, `dx`,S.IdPrioridad FROM `tbl_signosSintomas`  AS T
	     INNER JOIN SignosSintomas AS S ON T.dx=S.Descripcion
	     WHERE `idRef` ='$id' AND dx <>'undefined' AND dx <> '' ORDER BY S.IdPrioridad ASC";
	    //echo  $sql;

	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['dx'] 	= strtoupper($row["dx"]);
			$opcion ='<a style="background: #d9534f;border: 1px solid #d9534f;margin: -2px;" class="btn btn-danger btn-xs" 
			onclick="deleteSignosSitm('.$row["idDxHis"].')"  title="Eliminar"><i class="fa fa-close"></i></a>';
		
		
			
			$nestedData['opciones'] 				= $opcion;
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}



else if($function=="sqlIntervencionRealizada"){

    	$id = $_GET['id'];
	    $sql ="SELECT `idDxHis`, `des` FROM `tbl_intervencionRealizada` WHERE `idRef`='$id' AND des <>'undefined' AND des <> '' ORDER BY idDxHis ASC";
	    

	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['des'] 	= strtoupper($row["des"]);
			$opcion ='<a style="background: #d9534f;border: 1px solid #d9534f;margin: -2px;" class="btn btn-danger btn-xs" 
			onclick="deleteIntevencReal('.$row["idDxHis"].')"  title="Eliminar"><i class="fa fa-close"></i></a>';
		
		
			
			$nestedData['opciones'] 				= $opcion;
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}



else if($function=="sqlCirujanosAsistentes"){

    	$id = $_GET['id'];
	    $sql ="SELECT `idDxHis`, `des` FROM `tbl_cirujanosAsistentes` WHERE `idRef`='$id' AND des <>'undefined' AND des <> '' ORDER BY idDxHis ASC";
	    

	try {
			
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['des'] 	= strtoupper($row["des"]);
			$opcion ='<a style="background: #d9534f;border: 1px solid #d9534f;margin: -2px;" class="btn btn-danger btn-xs" 
			onclick="deleteCirujAsist('.$row["idDxHis"].')"  title="Eliminar"><i class="fa fa-close"></i></a>';
		
		
			
			$nestedData['opciones'] 				= $opcion;
			
			$data[] = $nestedData;
			
			
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}

else if($function=="listHospi"){


	
	try {
			
		$stmt = $conn->prepare("SELECT P.`idEm`,(SELECT `user` FROM `usuarios` WHERE `id` =P.`idUserRegistro`) as pax , P.`nroFua`, P.`historiaClinica`, P.`tipoDoc`, P.`nroDoc`,
	   (SELECT `descripcion` FROM `tipoSeguro` WHERE `idTipo`=P.`seguro`) AS seg	,(SELECT `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`aseguradora`) as ase,
	   (SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacion`) AS ubi, 
		P.`sexo`, P.`cuenta`, P.`nroAfiliacion`, P.`eess`, P.`nombres`, P.`fechaNac`, P.`ApePaterno`, P.`ApeMaterno`, P.`teleFam`, P.`edad`,
		(SELECT `decripcion` FROM `tipoDestino` WHERE `idDes` = P.`destino`) AS des, P.`fechaDestino`, P.`refeContraref`,(SELECT `descripcion` FROM `pabellones` WHERE `idPa`=P.`servicioPabellon`) as pa
		, P.`fechaIngreso`, P.`fechaAlta`, P.`montoGalenos`, P.`montoSisfar`, P.`Observaciones`, P.`fechaRegistro`, P.`fechaUpdate`, P.`tipoRegistro`,P.envioA,P.estadoA	
		FROM `tbl_Emergencias` P WHERE P.`destino`=3 ORDER BY P.idEm DESC" );
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['idEm'] 						= $row["idEm"];
			$nestedData['idUserRegistro'] 				= strtoupper($row["pax"]);
			$nestedData['nroFua'] 					= $row["nroFua"];
			$nestedData['historiaClinica'] 				= $row["historiaClinica"];
			$nestedData['nroDoc'] 				= $row["nroDoc"];
			$nestedData['seguro'] 				= strtoupper($row["seg"]);
			$nestedData['aseguradora'] 						= $row["ase"];
			$nestedData['ubicacion'] 					= strtoupper($row["ubi"]);
			$nestedData['sexo'] 						= $row["sexo"];
			$nestedData['cuenta'] 					= $row["cuenta"];
			$nestedData['nroAfiliacion'] 				= $row["nroAfiliacion"];
			$nestedData['eess'] 				= strtoupper($row["eess"]);
			$nestedData['paciente'] 				= strtoupper($row["ApePaterno"]." ".$row["ApePaterno"]." ".$row["nombres"]);
			$nestedData['teleFam'] 						= $row["teleFam"];
			$nestedData['edad'] 					= strtoupper($row["edad"]);
			$nestedData['destino'] 						= $row["des"];
			$nestedData['fechaDestino'] 					= $row["fechaDestino"];
			$nestedData['refeContraref'] 				= $row["refeContraref"];
			$nestedData['servicioPabellon'] 				= strtoupper($row["pa"]);
			$fi='';($row['fechaIngreso']!="") ? $fi=date('d/m/Y',strtotime($row['fechaIngreso'])): $fi='-';
			$nestedData['fechaIngreso'] 				= $fi;
			$fal='';($row['fechaAlta']!="") ? $fal=date('d/m/Y',strtotime($row['fechaAlta'])): $fal='-';
			$nestedData['fechaAlta'] 						=  $fal;
			$nestedData['montoGalenos'] 					= strtoupper($row["montoGalenos"]);
			$nestedData['montoSisfar'] 						= $row["montoSisfar"];
			$nestedData['Observaciones'] 					= strtoupper($row["Observaciones"]);
			$nestedData['fechaRegistro']				= date('d/m/Y H:i:s',strtotime($row['fechaRegistro']));
			$nestedData['fechaUpdate']			        = date('d/m/Y H:i:s',strtotime($row['fechaUpdate']));
			$nestedData['estadoA'] 					  = $row["estadoA"];

			
			$col='';
			
		/*	if($row['envioA']=="on"){
			    $col='warning';
			}else{
			    $col='success';
			}
			
			$opciones ='<a onclick="verPacienteHospi('.$row["idEm"].')" data-toggle="modal" data-target=".bs-example-modal-smEmergencia" class="btn btn-'.$col.' btn-xs" ><i class="fa fa-edit"></i> Editar</a>';
			$nestedData['opciones'] 				= $opciones;*/
			
			
	
	
	
		    $opciones ='';
			if($row["estadoA"]=="on"){
			        $opciones ='';    
			}else{
			    
			    if($row['envioA']=="on"){
			         $col='warning';
    			}else{
    			    $col='success';
    			}
    			$opciones ='<a onclick="verPacienteHospi('.$row["idEm"].')" data-toggle="modal" data-target=".bs-example-modal-smEmergencia" class="btn btn-'.$col.' btn-xs" ><i class="fa fa-edit"></i> Editar</a>';
			    
			}
			

		    $nestedData['opciones'] 				= $opciones;
		    
			
			$data[] = $nestedData;
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}


else if($function=="listGeneral"){


	
	try {
			
		$stmt = $conn->prepare("SELECT P.`idEm`,(SELECT `user` FROM `usuarios` WHERE `id` =P.`idUserRegistro`) as pax , P.`nroFua`, P.`historiaClinica`, P.`tipoDoc`, P.`nroDoc`,
	   (SELECT `descripcion` FROM `tipoSeguro` WHERE `idTipo`=P.`seguro`) AS seg	,(SELECT `seguros` FROM `tbl_aseguradoras` WHERE `idAs`=P.`aseguradora`) as ase,
	   (SELECT `descripcion` FROM `tbl_ubicacion` WHERE `idUbi`= P.`ubicacion`) AS ubi, 
		P.`sexo`, P.`cuenta`, P.`nroAfiliacion`, P.`eess`, P.`nombres`, P.`fechaNac`, P.`ApePaterno`, P.`ApeMaterno`, P.`teleFam`, P.`edad`,
		(SELECT `decripcion` FROM `tipoDestino` WHERE `idDes` = P.`destino`) AS des, P.`fechaDestino`, P.`refeContraref`,(SELECT `descripcion` FROM `pabellones` WHERE `idPa`=P.`servicioPabellon`) as pa
		, P.`fechaIngreso`, P.`fechaAlta`, P.`montoGalenos`, P.`montoSisfar`, P.`Observaciones`, P.`fechaRegistro`, P.`fechaUpdate`, P.`tipoRegistro`	FROM `tbl_Emergencias` P ORDER BY P.idEm DESC" );
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			
			
			$nestedData=array();
			
		    $nestedData['idEm'] 						= $row["idEm"];
			$nestedData['idUserRegistro'] 				= strtoupper($row["pax"]);
			$tip="";
			if($row["tipoRegistro"]==1){
			    	$tip="Emergencias";
			}else{
			    	$tip="Hospitalizacion";
			}
			$nestedData['tipoPax'] 					= $tip;
			$nestedData['nroFua'] 					= $row["nroFua"];
			$nestedData['historiaClinica'] 				= $row["historiaClinica"];
			$nestedData['nroDoc'] 				= $row["nroDoc"];
			$nestedData['seguro'] 				= strtoupper($row["seg"]);
			$nestedData['aseguradora'] 						= $row["ase"];
			$nestedData['ubicacion'] 					= strtoupper($row["ubi"]);
			$nestedData['sexo'] 						= $row["sexo"];
			$nestedData['cuenta'] 					= $row["cuenta"];
			$nestedData['nroAfiliacion'] 				= $row["nroAfiliacion"];
			$nestedData['eess'] 				= strtoupper($row["eess"]);
			$nestedData['paciente'] 				= strtoupper($row["ApePaterno"]." ".$row["ApePaterno"]." ".$row["nombres"]);
			$nestedData['teleFam'] 						= $row["teleFam"];
			$nestedData['edad'] 					= strtoupper($row["edad"]);
			$nestedData['destino'] 						= $row["des"];
			$nestedData['fechaDestino'] 					= $row["fechaDestino"];
			$nestedData['refeContraref'] 				= $row["refeContraref"];
			$nestedData['servicioPabellon'] 				= strtoupper($row["pa"]);
			$fi='';($row['fechaIngreso']!="") ? $fi=date('d/m/Y',strtotime($row['fechaIngreso'])): $fi='-';
			$nestedData['fechaIngreso'] 				= $fi;
			$fal='';($row['fechaAlta']!="") ? $fal=date('d/m/Y',strtotime($row['fechaAlta'])): $fal='-';
			$nestedData['fechaAlta'] 						=  $fal;
			$nestedData['montoGalenos'] 					= strtoupper($row["montoGalenos"]);
			$nestedData['montoSisfar'] 						= $row["montoSisfar"];
			$nestedData['Observaciones'] 					= strtoupper($row["Observaciones"]);
			$nestedData['fechaRegistro']				= date('d/m/Y H:i:s',strtotime($row['fechaRegistro']));
			$nestedData['fechaUpdate']			        = date('d/m/Y H:i:s',strtotime($row['fechaUpdate']));
			$opciones ='<a onclick="verPacienteHospi('.$row["idEm"].')" data-toggle="modal" data-target=".bs-example-modal-smEmergencia" class="btn btn-success btn-xs" ><i class="fa fa-edit"></i> Editar</a>';
			$nestedData['opciones'] 				= $opciones;
	
	
			
			$data[] = $nestedData;
		}

		$results = array(

			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data

		);


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}


else if($function=="user"){

//	$gpo = $_GET['gpo'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`,`nom` FROM `usuarios` WHERE `permisos`=1 ORDER BY nom" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$nom= strtoupper($row['nom']);
			
			$datos[] = array('id'=> $id,'nom'=> $nom);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}



else if($function=="userCE"){

	$tipo = $_GET['tipo'];
	$datos = array();
	$sql ='';
	if($tipo==1){
        $sql="SELECT `id`, `nom` FROM `usuarios` WHERE `permisoHospi` ='1' AND estado='ACTIVADO' ORDER BY nom ASC";
    }else if($tipo==2){
       $sql="SELECT `id`, `nom` FROM `usuarios` WHERE `permisoHospi` ='1' AND estado='ACTIVADO' ORDER BY nom ASC";
    }else if($tipo==3){
       $sql="SELECT `id`, `nom` FROM `usuarios` WHERE `permisoCE`=1  AND estado='ACTIVADO' ORDER BY nom ASC";
    }
    

	try {
		
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$nom= strtoupper($row['nom']);
			
			$datos[] = array('id'=> $id,'nom'=> $nom);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}


else if($function=="listCajas"){

//	$gpo = $_GET['gpo'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`,`nom` FROM `usuarios` WHERE  `perArchivo` ='1' OR `perArchivo` ='1,2'  ORDER BY nom ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$nom= strtoupper($row['nom']);
			
			$datos[] = array('id'=> $id,'nom'=> $nom);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}



else if($function=="listAnaMuestra"){

//	$gpo = $_GET['gpo'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdAnalisis`, `Descripcion` FROM `ContAnálisis`" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdAnalisis= $row['IdAnalisis'];
			$Descripcion= strtoupper($row['Descripcion']);
			
			$datos[] = array('IdAnalisis'=> $IdAnalisis,'Descripcion'=> $Descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}



else if($function=="listTipoEstudioHisto"){

//	$gpo = $_GET['gpo'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idTi`, `nombre`, `cat` FROM `tbl_tipoEstudio` WHERE `idTi` IN(3,4)" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idTi= $row['idTi'];
			$nombre= strtoupper($row['nombre']);
			
			$datos[] = array('idTi'=> $idTi,'nombre'=> $nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}




else if($function=="calidEspecList"){

	$tipo = $_GET['tipo'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdTipoDxCU`,`Descripcion` FROM `TipoDxCU` WHERE `IdDxCU`='$tipo' ORDER BY Descripcion ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdTipoDxCU= $row['IdTipoDxCU'];
			$Descripcion= strtoupper($row['Descripcion']);
			
			$datos[] = array('IdTipoDxCU'=> $IdTipoDxCU,'Descripcion'=> $Descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}



else if($function=="clasificacionGen"){

//	$gpo = $_GET['gpo'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdTipoDxCU`,`Descripcion` FROM `TipoDxCU` WHERE `IdDxCU`=2" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdTipoDxCU= $row['IdTipoDxCU'];
			$Descripcion= strtoupper($row['Descripcion']);
			
			$datos[] = array('IdTipoDxCU'=> $IdTipoDxCU,'Descripcion'=> $Descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}

else if($function=="listCajasLiqui"){

//	$gpo = $_GET['gpo'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`,`nom` FROM `usuarios` WHERE `perArchivo` ='2' OR `perArchivo` ='1,2' ORDER BY nom ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$nom= strtoupper($row['nom']);
			
			$datos[] = array('id'=> $id,'nom'=> $nom);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}



else if($function=="listPlantilla"){

 	$tipo = $_GET['tipo'];$sql = $_GET['sql'];$consulta="";
	$datos = array();
     //$consulta="SELECT `IdPlantillaAP` as IDE, `Nombre`, `Descripcion`, `IdSubCategoria` FROM `PlantillasAP` WHERE IdSubCategoria ='$tipo' " ;
    
    if($sql==1){
        $consulta="SELECT `IdPlantillaAP` as IDE, `Nombre`, `Descripcion`, `IdSubCategoria` FROM `PlantillasAP` WHERE IdSubCategoria ='$tipo' " ;
    }else if($sql==2){
        $consulta="SELECT `IdMicro` as IDE, `Nombre`, `Descripcion`,`IdSubCateg` FROM `PlantillasAPMicro` WHERE `IdSubCateg` ='$tipo' " ;
    }else if($sql==3){
        $consulta="SELECT `IdPlantillaLab` as IDE, `Nombre`, `Descripcion`, `IdSubCateg` FROM `PlantillasLab` WHERE `IdSubCateg`='$tipo' " ;
    }else{
        $consulta="SELECT `IdPlantillaAP` as IDE, `Nombre`, `Descripcion`, `IdSubCategoria` FROM `PlantillasAP` WHERE IdSubCategoria ='$tipo' " ;
    }   
    
    //echo $consulta;

	try {
		
		$stmt = $conn->prepare($consulta);
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IDE= $row['IDE'];
			$Nombre= strtoupper($row['Nombre']);
			
			$datos[] = array('IDE'=> $IDE,'Nombre'=> $Nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}




else if($function=="listSubCategoria"){

 	$tipo = $_GET['tipo'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idTe`, `descripcion` FROM `tbl_tejidoOrganoExtraido` WHERE IdCategoria='$tipo' ORDER BY descripcion ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idTe= $row['idTe'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('idTe'=> $idTe,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}




else if($function=="listSistemaReporte"){

	$tipo = $_GET['tipo'];
   $datos = array();

   try {
	   
	   $stmt = $conn->prepare("SELECT `Id`, `ParteSistema` FROM `ParteSistemaRep` WHERE Sistema='$tipo'" );
	   $stmt->execute();
	   
	   
	   while($row = $stmt->fetch()) {
					   
		   $Id= $row['Id'];
		   $ParteSistema= strtoupper($row['ParteSistema']);
		   
		   $datos[] = array('Id'=> $Id,'ParteSistema'=> $ParteSistema);

	   }


   } catch(PDOException $e) {
	   echo 'ERROR: ' . $e->getMessage();
   }

   echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}



else if($function=="listCargarClasificacion"){

	$tipo = $_GET['tipo'];
    $datos = array();

   try {
	   
	   $stmt = $conn->prepare("SELECT `Id`, `Descripcion` FROM `ClasifReporte` WHERE ParteSistema='$tipo' " );
	   $stmt->execute();
	   
	   
	   while($row = $stmt->fetch()) {
					   
		   $Id= $row['Id'];
		   $Descripcion= strtoupper($row['Descripcion']);
		   
		   $datos[] = array('Id'=> $Id,'Descripcion'=> $Descripcion);

	   }


   } catch(PDOException $e) {
	   echo 'ERROR: ' . $e->getMessage();
   }

   echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}

else if($function=="listasCategorias"){

  	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `Descripcion`, `IdTipoEstudio` FROM `CategoriaMuestra` WHERE IdTipoEstudio='$id' ORDER BY Descripcion ASC " );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdTipoEstudio= $row['IdTipoEstudio'];
			$Descripcion= $row['Descripcion'];
			
			$datos[] = array('IdTipoEstudio'=> $IdTipoEstudio,'Descripcion'=> $Descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}



else if($function=="listasHallazago"){

  $datos = array();

  try {
	  
	  $stmt = $conn->prepare("SELECT `Id`, `Sistema` FROM `SistemaReporte` ORDER BY Sistema ASC " );
	  $stmt->execute();
	  
	  
	  while($row = $stmt->fetch()) {
					  
		  $Id= $row['Id'];
		  $Sistema= $row['Sistema'];
		  
		  $datos[] = array('Id'=> $Id,'Sistema'=> $Sistema);

	  }


  } catch(PDOException $e) {
	  echo 'ERROR: ' . $e->getMessage();
  }

  echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}



else if($function=="listAuditx"){

//	$gpo = $_GET['gpo'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`,`nom` FROM `usuarios` WHERE `permisoHospi` ='1' AND estado='ACTIVADO' ORDER BY nom ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$nom= strtoupper($row['nom']);
			
			$datos[] = array('id'=> $id,'nom'=> $nom);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}


else if($function=="pabellones"){

    
    
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idPa`, `descripcion` FROM `pabellones` ORDER BY descripcion ASC");
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idPa= $row['idPa'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('idPa'=> $idPa,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}


else if($function=="estadoCxMot"){

    
    
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdEstado`, `Descripcion` FROM `EstadoCx` ORDER BY `IdEstado` ASC");
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdEstado= $row['IdEstado'];
			$Descripcion= strtoupper($row['Descripcion']);
			
			$datos[] = array('IdEstado'=> $IdEstado,'Descripcion'=> $Descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}




else if($function=="listAnestesiaProg"){

    
    
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdTipoAnestesia`, `Descripcion` FROM `TipoAnestesia` ORDER BY Descripcion ASC");
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdTipoAnestesia= $row['IdTipoAnestesia'];
			$Descripcion= strtoupper($row['Descripcion']);
			
			$datos[] = array('IdTipoAnestesia'=> $IdTipoAnestesia,'Descripcion'=> $Descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}



else if($function=="listCirugiaProg"){

    
    
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdTipoCx`, `Descripcion` FROM `TipoCx` ORDER BY Descripcion ASC");
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdTipoCx= $row['IdTipoCx'];
			$Descripcion= strtoupper($row['Descripcion']);
			
			$datos[] = array('IdTipoCx'=> $IdTipoCx,'Descripcion'=> $Descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}



else if($function=="listServicioQxProg"){

    
    
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdServQx`, `Descripcion` FROM `ServQx` ORDER BY `IdServQx` ASC");
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdServQx= $row['IdServQx'];
			$Descripcion= strtoupper($row['Descripcion']);
			
			$datos[] = array('IdServQx'=> $IdServQx,'Descripcion'=> $Descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}



else if($function=="listSalaCirugia"){

    $tipo = $_GET['tipo'];
    
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdSala`, `Nombre`, `IdServQx` FROM `SalaCx` WHERE `IdServQx` = '$tipo' ORDER BY `Nombre` ASC");
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdSala= $row['IdSala'];
			$Nombre= strtoupper($row['Nombre']);
			
			$datos[] = array('IdSala'=> $IdSala,'Nombre'=> $Nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}


else if($function=="especialidadesCe"){

    
    
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`,`descripcion` FROM `tbl_serviciosCE` ORDER BY descripcion ASC");
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('id'=> $id,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}

else if($function=="serviciosIngreso"){

    
    
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idTsi`, `nombre` FROM `tipoServicioIngreso` ORDER BY `nombre` ASC");
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idTsi= $row['idTsi'];
			$nombre= strtoupper($row['nombre']);
			
			$datos[] = array('idTsi'=> $idTsi,'nombre'=> $nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}




else if($function=="observacionesFua"){

    
    
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idObs`, `descripcion` FROM `tbl_observacionesFua` ORDER BY idObs ASC");
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idObs= $row['idObs'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('idObs'=> $idObs,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}


else if($function=="motivoEmergencias"){

    
    
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`, `descripcion` FROM `motivoEmergencias` ORDER BY descripcion ASC");
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('id'=> $id,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);


}


else if($function=="seguros"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idTipo`, `descripcion` FROM `tipoSeguro` ORDER BY idTipo ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idTipo= $row['idTipo'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('idTipo'=> $idTipo,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="tipoEstPat"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idTi`, `nombre` FROM `tbl_tipoEstudio` WHERE cat=1  ORDER BY idTi ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idTi= $row['idTi'];
			$nombre= $row['nombre'];
			
			$datos[] = array('idTi'=> $idTi,'nombre'=> $nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="cargarUsersAuditorAsignado"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`,`nom`,`codCompatible` FROM `usuarios` WHERE `cargo` = '6' AND `ofAreUnidad` IN(21,22) ORDER BY nom ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$nom= $row['nom'];
			$codCompatible= $row['codCompatible'];
			
			$datos[] = array('id'=> $id,'nom'=> $nom,'codCompatible'=>$codCompatible);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="procePat"){

    $tipo = $_GET['tipo'];
    
	$datos = array();

	try {
		
		// $stmt = $conn->prepare("SELECT `idtpo`, `NombreCorto` FROM `tbl_tipoEstudioProced` WHERE `idTi` ='$tipo' ORDER BY NombreCorto ASC " );
		
		$stmt = $conn->prepare("SELECT `idtpo`,CONCAT('(',`COD_CPMS` ,') ', `NombreCorto`) AS NombreCorto,`CodTarifario` ,`IdSubTipo` FROM `tbl_tipoEstudioProced` WHERE `idTi` ='$tipo' ORDER BY NombreCorto ASC " );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idtpo= $row['idtpo'];
			$NombreCorto= $row['NombreCorto'];
			$CodTarifario= $row['CodTarifario'];
			$IdSubTipo= $row['IdSubTipo'];
			
			$datos[] = array('idtpo'=> $idtpo,'NombreCorto'=> $NombreCorto,'CodTarifario'=>$CodTarifario,'IdSubTipo'=>$IdSubTipo);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="subProcePat"){

    $tipo = $_GET['tipo'];
    
	$datos = array();

	try {
		
		// $stmt = $conn->prepare("SELECT `idtpo`, `NombreCorto` FROM `tbl_tipoEstudioProced` WHERE `idTi` ='$tipo' ORDER BY NombreCorto ASC " );
		
		$stmt = $conn->prepare("SELECT `idtpo`, CONCAT('(',`COD_CPMS` ,') ', `NombreCorto`) AS NombreCorto,`CodTarifario`  FROM `tbl_tipoEstudioProced` WHERE IdSubTipo  ='$tipo' ORDER BY NombreCorto ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idtpo= $row['idtpo'];
			$NombreCorto= $row['NombreCorto'];
			$CodTarifario= $row['CodTarifario'];
			
			$datos[] = array('idtpo'=> $idtpo,'NombreCorto'=> $NombreCorto,'CodTarifario'=>$CodTarifario);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="listNvaCta"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`, `descripcion` FROM `tbl_nvaCta` ORDER BY id ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('id'=> $id,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="ServicioDesignacion"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`, `descripcion` FROM `tbl_serDesig`  ORDER BY descripcion ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('id'=> $id,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="cargarRespirador"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdRespirador`, `NombreRespirador` FROM `TipoRespirador` ORDER BY IdRespirador ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdRespirador= $row['IdRespirador'];
			$NombreRespirador= strtoupper($row['NombreRespirador']);
			
			$datos[] = array('IdRespirador'=> $IdRespirador,'NombreRespirador'=> $NombreRespirador);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}




else if($function=="personalMedico"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdPersonal`, `TipoPersonal` FROM `AtSolicitud` ORDER BY IdPersonal ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdPersonal= $row['IdPersonal'];
			$TipoPersonal= strtoupper($row['TipoPersonal']);
			
			$datos[] = array('IdPersonal'=> $IdPersonal,'TipoPersonal'=> $TipoPersonal);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="tipodoc"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idTipo`, `descripcion` FROM `tbl_tipoDoc`" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idTipo= $row['idTipo'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('idTipo'=> $idTipo,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="listTurno"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdTurno`, `Descripcion` FROM `TurnoCx` ORDER BY IdTurno ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdTurno= $row['IdTurno'];
			$Descripcion= strtoupper($row['Descripcion']);
			
			$datos[] = array('IdTurno'=> $IdTurno,'Descripcion'=> $Descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}





else if($function=="listUrpa"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdServURPA`, `Descripcion`, `IdTipoServicio` FROM `ServURPA` ORDER BY `IdServURPA` ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdServURPA= $row['IdServURPA'];
			$Descripcion= strtoupper($row['Descripcion']);
			
			$datos[] = array('IdServURPA'=> $IdServURPA,'Descripcion'=> $Descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="profesionRefRes"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idP`, `descripcion` FROM `tbl_profesion` ORDER BY descripcion ASC " );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idP= $row['idP'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('idP'=> $idP,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="dispoTransRef"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idDis`, `nombre` FROM `tbl_disponibleTrans`  ORDER BY idDis ASC " );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idDis= $row['idDis'];
			$nombre= strtoupper($row['nombre']);
			
			$datos[] = array('idDis'=> $idDis,'nombre'=> $nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="lisDocs"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdDocAT`, `DocAT` FROM `DocAT`  ORDER BY DocAT ASC " );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdDocAT= $row['IdDocAT'];
			$DocAT= strtoupper($row['DocAT']);
			
			$datos[] = array('IdDocAT'=> $IdDocAT,'DocAT'=> $DocAT);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="financiamiento"){


    $id = $_GET['id'];
    $sqwhe='';
	$datos = array();
	if($id=="SI"){
	    $sqwhe="WHERE id BETWEEN '1' AND '4'";
	}else{
	    $sqwhe="WHERE id BETWEEN '1' AND '2'";
	}



	try {
		
		$stmt = $conn->prepare("SELECT `id`, `nombre` FROM `financiamiento` $sqwhe ORDER BY id ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$nombre= strtoupper($row['nombre']);
			
			$datos[] = array('id'=> $id,'nombre'=> $nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="atencionPacEval"){


   

	try {
		
		$stmt = $conn->prepare("SELECT `id`, `nombre` FROM `financiamiento` ORDER BY id ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$nombre= strtoupper($row['nombre']);
			
			$datos[] = array('id'=> $id,'nombre'=> $nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="motivoRecEval1"){


	$datos = array();
	

	try {
		
		$stmt = $conn->prepare("SELECT `IdMotivo`, `MotivoRef` FROM `MotivoRef` ORDER BY MotivoRef ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdMotivo= $row['IdMotivo'];
			$MotivoRef= strtoupper($row['MotivoRef']);
			
			$datos[] = array('IdMotivo'=> $IdMotivo,'MotivoRef'=> $MotivoRef);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="estadoRefDatRef"){


	$datos = array();
	

	try {
		
		$stmt = $conn->prepare("SELECT `idEst`, `nombres` FROM `estadoReferencia` ORDER BY idEst ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idEst= $row['idEst'];
			$nombres= strtoupper($row['nombres']);
			
			$datos[] = array('idEst'=> $idEst,'nombres'=> $nombres);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="financiamientoRef"){


    
	try {
		
		$stmt = $conn->prepare("SELECT `id`, `nombre` FROM `financiamiento` WHERE tipo= 'NO' ORDER BY id ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$nombre= strtoupper($row['nombre']);
			
			$datos[] = array('id'=> $id,'nombre'=> $nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}





else if($function=="filtrofinancia"){

	try {
		
		$stmt = $conn->prepare("SELECT `id`, `nombre` FROM `financiamiento` ORDER BY nombre ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$nombre= strtoupper($row['nombre']);
			$datos[] = array('id'=> $id,'nombre'=> $nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="filtroAuditorCpms"){

	try {
		
		$stmt = $conn->prepare("SELECT P.`iduser`,UPPER(U.user) AS USER FROM `paciente` as P 
                                INNER JOIN usuarios AS U ON P.iduser=U.id
                                WHERE U.estado='ACTIVADO'
                                GROUP BY P.`iduser` ORDER BY USER ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$iduser= $row['iduser'];
			$USER= strtoupper($row['USER']);
			$datos[] = array('iduser'=> $iduser,'USER'=> $USER);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="iafas"){

    $id = $_GET['id'];
	$datos = array();
	
	if($id=="3" || $id=="4"){
	    $id="1";
	}

	try {
		
		$stmt = $conn->prepare("SELECT `idIa`, `idFi`, `nombre` FROM `tbl_iafas` WHERE `idFi`='$id'  ORDER BY idIa ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idIa= $row['idIa'];
			$nombre= strtoupper($row['nombre']);
			
			$datos[] = array('idIa'=> $idIa,'nombre'=> $nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="aseguradoras"){

   $id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idAs`, `seguros` FROM `tbl_aseguradoras` WHERE idFi='$id' ORDER BY idAs ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idAs= $row['idAs'];
			$seguros= strtoupper($row['seguros']);
			
			$datos[] = array('idAs'=> $idAs,'seguros'=> $seguros);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="condPcte"){

   $id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdCond`, `CondPac` FROM `CondPac` ORDER BY IdCond ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdCond= $row['IdCond'];
			$CondPac= strtoupper($row['CondPac']);
			
			$datos[] = array('IdCond'=> $IdCond,'CondPac'=> $CondPac);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="tipoTransRef"){

   $id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdTransp`, `TipoTransp` FROM `TipoTransp`  ORDER BY IdTransp ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdTransp= $row['IdTransp'];
			$TipoTransp= strtoupper($row['TipoTransp']);
			
			$datos[] = array('IdTransp'=> $IdTransp,'TipoTransp'=> $TipoTransp);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}





else if($function=="motivoRef"){

   $id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdMotivo`, `MotivoRef` FROM `MotivoRef`  ORDER BY IdMotivo ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdMotivo= $row['IdMotivo'];
			$MotivoRef= strtoupper($row['MotivoRef']);
			
			$datos[] = array('IdMotivo'=> $IdMotivo,'MotivoRef'=> $MotivoRef);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}





else if($function=="especialidadRef"){

   $id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`, `descripcion` FROM `tbl_especialidades` ORDER BY descripcion ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('id'=> $id,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="obtenerData"){

     $ser= $_GET['ser'];
     $tipo= $_GET['tipo'];
	$datos = array(); 
	
	$consulSql="";
	// $consulSql ="SELECT `tipoDoc`,TRIM(`nroDoc`) as DOCE FROM `tbl_Emergencias` WHERE tipoSeiN='$ser' AND  nroDoc <>'' AND tipoRegistro ='$tipo' AND `destino`=''  GROUP BY nroDoc";
	
	if($tipo=="1"){
	   $consulSql ="SELECT idEm,`tipoDoc`,TRIM(`nroDoc`) as DOCE FROM `tbl_Emergencias` WHERE tipoSeiN='$ser' AND  tipoRegistro ='$tipo' AND `destino`='' ";
	   
	}else if($tipo=="2"){
    	$consulSql ="SELECT idEm,`tipoDoc`,TRIM(`nroDoc`) as DOCE FROM `tbl_Emergencias` WHERE pab1Hos='$ser' AND  tipoRegistro ='$tipo' AND `destino`='' ";
    }
	
	//echo $consulSql;
	
	try {
		
		$stmt = $conn->prepare($consulSql);
		$stmt->execute();
	
		
		while($row = $stmt->fetch()) {
						
			$tipoDoc= $row['tipoDoc'];
			$DOCE= $row['DOCE'];
			$idEm = $row['idEm'];
			
			
			$datos[] = array('tipoDoc'=> $tipoDoc,'DOCE'=> $DOCE,'idEm'=> $idEm);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="regimen"){

   $id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idRe`, `idIa`, `nombre` FROM `tbl_regimen` WHERE `idIa`='$id' ORDER BY idRe ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idRe= $row['idRe'];
			$nombre= strtoupper($row['nombre']);
			
			$datos[] = array('idRe'=> $idRe,'nombre'=> $nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="plansalud"){

   $id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idPa`, `idRe`, `nombre` FROM `tbl_plansalud` WHERE `idRe`='$id' ORDER BY idPa ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idPa= $row['idPa'];
			$nombre= strtoupper($row['nombre']);
			
			$datos[] = array('idPa'=> $idPa,'nombre'=> $nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}







else if($function=="listDeptos"){

 
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT idDepartamento,departamento FROM departamentos ORDER BY departamento ASC " );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idDepartamento= $row['idDepartamento'];
			$departamento= strtoupper($row['departamento']);
			
			$datos[] = array('idDepartamento'=> $idDepartamento,'departamento'=> $departamento);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}






else if($function=="listProv"){

   $depa = $_POST['depa']; 
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT idProvincia,provincia FROM provincia WHERE idDepartamento='$depa' ORDER BY provincia ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idProvincia= $row['idProvincia'];
			$provincia= strtoupper($row['provincia']);
			
			$datos[] = array('idProvincia'=> $idProvincia,'provincia'=> $provincia);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}






else if($function=="listDist"){

   $pro = $_POST['pro']; 
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT idDistrito,distrito FROM distrito WHERE idProvincia='$pro' ORDER BY distrito ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idDistrito= $row['idDistrito'];
			$distrito= strtoupper($row['distrito']);
			
			$datos[] = array('idDistrito'=> $idDistrito,'distrito'=> $distrito);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}





else if($function=="listTipoAcc"){

   $pro = $_POST['pro']; 
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdTipoAT`, `TipoAccidente` FROM `TipoAccidente` ORDER BY IdTipoAT ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdTipoAT= $row['IdTipoAT'];
			$TipoAccidente= strtoupper($row['TipoAccidente']);
			
			$datos[] = array('IdTipoAT'=> $IdTipoAT,'TipoAccidente'=> $TipoAccidente);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="plansaludGroup"){

   $id = $_GET['id'];
	$datos = array();
	
	if($id==1){
	    $sqp="SELECT `idPa`, `idRe`, `nombre` FROM `tbl_plansalud` WHERE idPa IN(6,7,8,9,10,15) ORDER BY  nombre ASC ";
	}else{
	    $sqp="SELECT `idPa`, `idRe`, `nombre` FROM `tbl_plansalud` WHERE idPa IN(1,2,3,4,5) ORDER BY  nombre ASC ";
	}

	try {
		
		$stmt = $conn->prepare($sqp);
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idPa= $row['idPa'];
			$nombre= strtoupper($row['nombre']);
			
			$datos[] = array('idPa'=> $idPa,'nombre'=> $nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="tipoServicioIngreso"){

   $id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idTsi`, `idSer`, `nombre` FROM `tipoServicioIngreso` WHERE `idSer`='$id' ORDER BY nombre ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idTsi= $row['idTsi'];
			$nombre= strtoupper($row['nombre']);
			
			$datos[] = array('idTsi'=> $idTsi,'nombre'=> $nombre);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="cargarTipoServicioPat"){

   
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT idSer,`descripcion` FROM `tipoServicio`  ORDER BY idSer ASC" );
		$stmt->execute();
		
		
            		while($row = $stmt->fetch()) {
            						
            			$descripcion= $row['descripcion'];
            			$idSer= $row['idSer'];
            			$datos[] = array('descripcion'=> $descripcion,'idSer'=> $idSer);
            
            		}


        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}

	        echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="cargarTipoServicioPatSer"){

   $cat = $_GET['cat'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdServ`,`Descripcion` FROM `Servicios` WHERE `IdTipoServ`='$cat'  ORDER BY Descripcion ASC" );
		$stmt->execute();
		
		
            		while($row = $stmt->fetch()) {
            						
            			$IdServ= $row['IdServ'];
            			$Descripcion= $row['Descripcion'];
            			$datos[] = array('Descripcion'=> $Descripcion,'IdServ'=> $IdServ);
            
            		}


        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}

	        echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="cargarConvenioPatSer"){

   $cat = $_GET['cat'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT C.`IdIpressConv`, I.nombre 
                                FROM `IpressConvenio` AS C
                                INNER JOIN tbl_ipress AS I ON C.IdIPRESS=I.id 
                                WHERE C.`IdConvenio`='$cat' AND C.`IdServ`=3" );
		$stmt->execute();
		
		
            		while($row = $stmt->fetch()) {
            						
            			$IdIpressConv= $row['IdIpressConv'];
            			$nombre= $row['nombre'];
            			$datos[] = array('nombre'=> $nombre,'IdIpressConv'=> $IdIpressConv);
            
            		}


        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}

	        echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="servicioOrigenRef"){

   $id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdUPS`, `CodUPS`, `NombreUPS` FROM `UPS` ORDER BY NombreUPS ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdUPS= $row['IdUPS'];
			$NombreUPS= strtoupper($row['NombreUPS']);
			
			$datos[] = array('IdUPS'=> $IdUPS,'NombreUPS'=> $NombreUPS);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}




else if($function=="servDestRef"){

   $id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdUPS`, `CodUPS`, `NombreUPS` FROM `UPS` ORDER BY NombreUPS ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdUPS= $row['IdUPS'];
			$NombreUPS= strtoupper($row['NombreUPS']);
			
			$datos[] = array('IdUPS'=> $IdUPS,'NombreUPS'=> $NombreUPS);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="cargaEspecialidad"){

   $id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`, `descripcion`, `IdTipoEsp` FROM `tbl_especialidades` ORDER BY `Descripcion` ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('id'=> $id,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}




else if($function=="cargaEspecialidadCiru"){

   $id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdEspQx`, `Descripcion`, `IdEESS` FROM `EspecialidadesQX` ORDER BY `Descripcion` ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$IdEspQx= $row['IdEspQx'];
			$Descripcion= strtoupper($row['Descripcion']);
			
			$datos[] = array('IdEspQx'=> $IdEspQx,'Descripcion'=> $Descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="destinoHospi"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idDes`, `decripcion`, `tipo` FROM `tipoDestino` WHERE `tipo`= 1 ORDER BY idDes ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idDes= $row['idDes'];
			$decripcion= strtoupper($row['decripcion']);
			
			$datos[] = array('idDes'=> $idDes,'decripcion'=> $decripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="destinoConsultaExterna"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idDes`, `decripcion`, `tipo` FROM `tipoDestino` WHERE `tipo`= 3 ORDER BY idDes ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idDes= $row['idDes'];
			$decripcion= strtoupper($row['decripcion']);
			
			$datos[] = array('idDes'=> $idDes,'decripcion'=> $decripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="destinoHospiAsc"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idDes`, `decripcion`, `tipo` FROM `tipoDestino` WHERE `tipo`= 1 ORDER BY decripcion ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idDes= $row['idDes'];
			$decripcion= strtoupper($row['decripcion']);
			
			$datos[] = array('idDes'=> $idDes,'decripcion'=> $decripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="destinoEmer"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idDes`, `decripcion`, `tipo` FROM `tipoDestino` WHERE `tipo`= 1 ORDER BY decripcion ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idDes= $row['idDes'];
			$decripcion= strtoupper($row['decripcion']);
			
			$datos[] = array('idDes'=> $idDes,'decripcion'=> $decripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="reciAuditores"){

    $tik = $_GET['tipo'];$sql='';
    
    if($tik==1){
        $sql="SELECT `id`, `nom` FROM `usuarios` WHERE `permisos` ='9' OR `permisoEmer` ='1' ORDER BY nom ASC";
    }else if($tik==2){
       $sql="SELECT `id`, `nom` FROM `usuarios` WHERE `permisoHospi` ='1' ORDER BY nom ASC";
    }else if($tik==3){
       $sql="SELECT `id`, `nom` FROM `usuarios` WHERE `permisoHospi` ='1' ORDER BY nom ASC";
    }
    
    
	$datos = array();

	try {
		
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$nom= strtoupper($row['nom']);
			
			$datos[] = array('id'=> $id,'nom'=> $nom);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="reciAuditoresHospi"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`, `nom` FROM `usuarios` WHERE `permisoHospi` ='1' ORDER BY nom ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$id= $row['id'];
			$nom= strtoupper($row['nom']);
			
			$datos[] = array('id'=> $id,'nom'=> $nom);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="listActividades"){


	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idAct`,`descripcion` FROM `tbl_actividad` ORDER BY idAct ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idAct= $row['idAct'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('idAct'=> $idAct,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}




else if($function=="listActividadesProc"){

    $id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idProc`,`idAct`,`descripcion` FROM `tbl_actividadProc` WHERE `idAct` ='$id' ORDER BY idProc ASC " );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
						
			$idProc= $row['idProc'];
			$descripcion= strtoupper($row['descripcion']);
			
			$datos[] = array('idProc'=> $idProc,'descripcion'=> $descripcion);

		}


	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="pacienteDatosAuto"){

	$NroDoc = $_GET['NroDoc'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idRegistro`, `idUsuario`, `id_prestacion`, `IdCuentaAtencion`, `nro_documento_autorizacion`,
			`fecha_ingreso`, `fecha_alta`, `tipo_documento_responsable`, `nro_documento_responsable`, `apellido_paterno_responsable`,
			`apellido_materno_responsable`, `nombres_responsable`, `profesion_responsable`, `nro_colegiatura`, `codigo_especialidad`,
			`nro_registro_especialista`, `condicion_alta`, `fechaRegistro`, `estadoCuenta` FROM `imp_cuentas` 
			WHERE `IdCuentaAtencion`= :term "  );
		$stmt->execute(array('term' => $NroDoc));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);

			$datos[] =  $row['tipo_documento_responsable'];
			$datos[] =  $row['nro_documento_responsable'];
			$datos[] =  $row['apellido_paterno_responsable'];
			$datos[] =  $row['apellido_materno_responsable'];
			$datos[] =  $row['nombres_responsable'];		
			$datos[] =  $row['fecha_ingreso'];
			$datos[] =  $row['fecha_alta'];
			$datos[] =  $row['profesion_responsable'];
			$datos[] =  $row['nro_colegiatura'];
			$datos[] =  $row['codigo_especialidad'];
			$datos[] =  $row['nro_registro_especialista'];
			$datos[] =  $row['condicion_alta'];
			$datos[] =  $row['estadoCuenta'];

		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="listPabellon"){

	//$NroDoc = $_GET['NroDoc'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idPa`, `descripcion` FROM `pabellones` ORDER BY descripcion ASC"  );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {
			//sort($datos, SORT_NATURAL | SORT_FLAG_CASE);

	
	        $idPa=$row['idPa'];
			$descripcion=$row['descripcion'];

			$datos[] = array('idPa'=> $idPa,'descripcion'=> $descripcion);

		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="servicioPabellonAuto"){

	$NroDoc = $_GET['NroDoc'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT  `descripcion` FROM `pabellones`	WHERE `descripcion` LIKE :term "  );
		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);

			$datos[] =  $row['descripcion'];
		

		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="cartaGarantia"){

	$NroDoc = $_GET['NroDoc'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idCar`, `nrodoc`, `NroCarta`, `NroCarta2`, `NroCarta3`, `Ampliación`, `Paciente`, `Fecha_Carta`,
		 `IAFA`, `Producto`, `Tarifa`, `Aseguradora`, `Poliza`, `CIE10`, `Diagnostico`, `Fecha_Inicio_Vigencia`, `Fecha_Fin_Vigencia`,
		  `Monto_Ampliacion`, `anio`, `usuario`, `referencia`, `fenac`, `edad`, `motivo` FROM `cartagarantia` WHERE `idCar`= :term " );
		$stmt->execute(array('term' => $NroDoc));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);

			$datos[] =  $row['nrodoc'];
			$datos[] =  $row['NroCarta'];
			$datos[] =  $row['NroCarta2'];
			$datos[] =  $row['NroCarta3'];
			$datos[] =  $row['Paciente'];		
			$datos[] =  $row['Fecha_Carta'];
			$datos[] =  $row['IAFA'];
			$datos[] =  $row['Producto'];
			$datos[] =  $row['Tarifa'];
			$datos[] =  $row['Aseguradora'];
			$datos[] =  $row['Poliza'];
			$datos[] =  $row['CIE10'];
			$datos[] =  $row['Diagnostico'];
			$datos[] =  $row['Fecha_Inicio_Vigencia'];
			$datos[] =  $row['Fecha_Fin_Vigencia'];
			$datos[] =  $row['Monto_Ampliacion'];
			$datos[] =  $row['referencia'];
			$datos[] =  $row['fenac'];
			$datos[] =  $row['edad'];
			$datos[] =  $row['motivo'];
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="apiHorario"){


	header('Content-Type: application/json');
	
	$anio = $_GET['anio'];
	$mes = $_GET['mes'];
	$fecha = $anio.'-'.$mes.'%';

	$datos= array();

		try {
		
			$stmt = $conn->prepare("SELECT MONTH(E.`start`) AS Mes,DAY(E.`start`) AS Dia,E.`start` AS FechaIni,E.`end` AS FechaFin,E.`observaciones` AS IdServicio,'AUDITORIA' AS  NombreServicio,
			(SELECT UPPER(user) FROM usuarios WHERE id=E.title) AS Usuario ,
			(SELECT TRIM(cel) FROM usuarios WHERE id=E.title) AS DNI,(SELECT nom FROM usuarios WHERE id=E.title) AS NombreMedico FROM `events` E	
			WHERE E.start like'$fecha' AND E.`observaciones` LIKE 'SIS%' " );
			$stmt->execute();
			
			
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				

				$datos['datos'][] =  $row;
				
				
			}
	
		} catch(PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
	
		echo json_encode($datos);
	
} 

else if($function=="profesion"){

	//$NroDoc = $_GET['NroDoc']; 
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `tps_IdTipoPersonalSalud`, `tps_Descripcion`,`tps_EsProfesional`, `tps_Abrevia`, `tps_Especialista` FROM `m_tipopersonalsalud` " );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$tps_IdTipoPersonalSalud=$row['tps_IdTipoPersonalSalud'];

			$cat = strlen($tps_IdTipoPersonalSalud);
			if($cat < 2 ){
				$varCom2 = str_pad($tps_IdTipoPersonalSalud, 2, "0", STR_PAD_LEFT);
				$tps_IdTipoPersonalSalud= $varCom2;
				
			}else{

				$tps_IdTipoPersonalSalud=$row['tps_IdTipoPersonalSalud'];	

			}

			$tps_Descripcion=$row['tps_Descripcion'];
			
			$datos[] = array('tps_IdTipoPersonalSalud'=> $tps_IdTipoPersonalSalud, 'tps_Descripcion'=> $tps_Descripcion);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}


else if($function=="verdx"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `codigo_diagnostico` FROM `ac_diagnostico` WHERE `id_prestacion` = :term " );
		$stmt->execute(array('term' => $id));
		
		
		while($row = $stmt->fetch()) {

			$codigo_diagnostico=$row['codigo_diagnostico'];
			
			$datos[] = array('codigo_diagnostico'=> $codigo_diagnostico);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}


else if($function=="listCie10"){


	try {

		$stmt = $conn->prepare("SELECT `id`, `C10_CodDia`, `C10_Descripcion`, `ResolMnisterial`, `fechaUpdate` FROM erh.`m_cie10` WHERE `ResolMnisterial`='RM-230-2020-MINSA'" );
		$stmt->execute();
	
		$data = array();
		while($row = $stmt->fetch()) {
			
			$nestedData=array(); 	

			$nestedData['id'] 					=  $row['id'];
			$nestedData['C10_CodDia'] 		 	=  $row['C10_CodDia'];
			$nestedData['C10_Descripcion'] 		=  $row['C10_Descripcion'];
			$nestedData['ResolMnisterial'] 		=  strtoupper($row['ResolMnisterial']);
				
			$data[] = $nestedData;

		}

		$results = array(
			"sEcho" => 1,
			"iTotalRecords" => count($data),
			"iTotalDisplayRecords" => count($data),
			"aaData"=>$data
		);


	}

		 catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
		//

	}

	echo json_encode($results,JSON_UNESCAPED_UNICODE);

}


else if($function=="especialidad"){

	//$NroDoc = $_GET['NroDoc']; 
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `esp_Descripcion` , `esp_IdEspecialidad` FROM `m_especialidades` ORDER BY esp_Descripcion ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$esp_IdEspecialidad=$row['esp_IdEspecialidad'];
			$cat = strlen($esp_IdEspecialidad);
			if($cat<2 ){
				$varCom2 = str_pad($esp_IdEspecialidad, 2, "0", STR_PAD_LEFT);
				$esp_IdEspecialidad= $varCom2;
				
			}else{

				$esp_IdEspecialidad=$row['esp_IdEspecialidad'];	

			}


			$esp_Descripcion=$row['esp_Descripcion'];

			$datos[] = array('esp_IdEspecialidad'=> $esp_IdEspecialidad, 'esp_Descripcion'=> $esp_Descripcion);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}

else if($function=="selectedPaciente"){

	
	$datos = array();

	try {
		

		$stmt = $conn->prepare("SELECT id,nrodoc,am_paciente,am_iafa,nroCarta,seguroAmb 
		FROM altasmedicas.`am_ambulatoria` WHERE `estado` = 'EN PROCESO' AND idAudit=''" );

		/*

		
		$stmt = $conn->prepare("SELECT A.id,A.nrodoc,A.am_paciente,A.nroCarta,A.seguroAmb,S.cuenta FROM altasmedicas.`am_ambulatoria` AS A
		INNER JOIN altasmedicas.segambulatorio as S ON A.id=S.idReg
		WHERE A.`estado` = 'EN PROCESO' AND idAudit=''" ); */

		$stmt->execute();

	/*	$stmt = $conn->prepare("SELECT A.id,A.nrodoc,A.am_paciente,A.nroCarta,A.seguroAmb,S.cuenta FROM altasmedicas.`am_ambulatoria` AS A
		INNER JOIN altasmedicas.segambulatorio as S ON A.id=S.idReg
		WHERE A.`am_iafa` = 'SOAT' AND A.`estado` = 'EN PROCESO' AND idAudit=''" );
		$stmt->execute();*/
		
		
		while($row = $stmt->fetch()) {

			$paciente=$row['id']."-".$row['am_paciente']." (".$row['am_iafa'].")";
			$datos[] = array('paciente'=> $paciente);

		}

	} catch(PDOException $e) {

		echo 'ERROR: ' . $e->getMessage();

	}

	echo json_encode($datos);

}


else if($function=="auditor"){

	//$NroDoc = $_GET['NroDoc'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`,`nom` FROM `usuarios` WHERE `estado`='ACTIVADO' AND rol=2 ORDER BY nom ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$id=$row['id'];
			$nom=$row['nom'];

			$datos[] = array('id'=> $id, 'nom'=> $nom);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}



else if($function=="auditorQuimio"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`, `tipo`, `auditor`, `dni`, `cmp`, `rne`, `telefono` FROM `auditoresQuimio` WHERE tipo='$id' ORDER BY auditor ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$id=$row['id'];
			$auditor=$row['auditor'];

			$datos[] = array('id'=> $id, 'auditor'=> $auditor);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}


else if($function=="profesionFor"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idP`, `descripcion` FROM `tbl_profesion` ORDER BY descripcion ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$idP=$row['idP'];
			$descripcion=$row['descripcion'];

			$datos[] = array('idP'=> $idP, 'descripcion'=> $descripcion);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}

else if($function=="rotulosGraphs"){

        	
        	$tipoEst = $_GET['tipoEst'];
        	$datos = array();
        	$po = "";
        	if($tipoEst!=""){
        	    $po = "SELECT `rotulo`,count(`rotulo`) AS ROTA FROM `tbl_observacionesRotulo` WHERE tipoEstudio='$tipoEst' GROUP BY `rotulo` ORDER BY ROTA DESC  LIMIT 11";
        	}else{
        	    $po = "SELECT `rotulo`,count(`rotulo`) AS ROTA FROM `tbl_observacionesRotulo` GROUP BY `rotulo` ORDER BY ROTA DESC LIMIT 11";
        	}
        
        	try {
        		
        		$stmt = $conn->prepare($po);
        		$stmt->execute();
        		
        		
        		while($row = $stmt->fetch()) {
        
                           if($row['rotulo']!=""){
                                $rotulo=$row['rotulo'];
                    			$ROTA=$row['ROTA'];
                    
                    			$datos[] = array('rotulo'=> $rotulo, 'ROTA'=> $ROTA); 
                            } 
                            
                          /*  $rotulo=$row['rotulo'];
                    			$ROTA=$row['ROTA'];
                    
                    			$datos[] = array('rotulo'=> $rotulo, 'ROTA'=> $ROTA); */
        			
        		}
        
        	} catch(PDOException $e) {
        		echo 'ERROR: ' . $e->getMessage();
        	}
        
        	echo json_encode($datos);

}



else if($function=="listResultadoHisto"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdRecep`, `Descripcion`, `IdMarcador` FROM `ResRecepIHQ` WHERE `IdMarcador` ='$id' ORDER BY IdRecep  ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$IdRecep=$row['IdRecep'];
			$Descripcion=$row['Descripcion'];

			$datos[] = array('IdRecep'=> $IdRecep, 'Descripcion'=> $Descripcion);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}



else if($function=="listEmbarazo"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdEmbarazo`, `Descripcion` FROM `Embarazo`ORDER BY `IdEmbarazo` ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$IdEmbarazo=$row['IdEmbarazo'];
			$Descripcion=$row['Descripcion'];

			$datos[] = array('IdEmbarazo'=> $IdEmbarazo, 'Descripcion'=> $Descripcion);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}




else if($function=="listMetodoAnticonceptivo"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdUso`, `Descripcion` FROM `UsoMAC` ORDER BY `IdUso` ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$IdUso=$row['IdUso'];
			$Descripcion=$row['Descripcion'];

			$datos[] = array('IdUso'=> $IdUso, 'Descripcion'=> $Descripcion);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}



else if($function=="listTipoMetodoAntic"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdTipoMAC`, `Descripcion` FROM `TipoMAC` ORDER BY `IdTipoMAC` ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$IdTipoMAC=$row['IdTipoMAC'];
			$Descripcion=$row['Descripcion'];

			$datos[] = array('IdTipoMAC'=> $IdTipoMAC, 'Descripcion'=> $Descripcion);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}



else if($function=="listExamenGineco"){

	//$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdExamen`, `Descripcion` FROM `ExamenGinec` ORDER BY `IdExamen` ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$IdExamen=$row['IdExamen'];
			$Descripcion=$row['Descripcion'];

			$datos[] = array('IdExamen'=> $IdExamen, 'Descripcion'=> $Descripcion);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}

else if($function=="listIntensidadTincion"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdIntensidad`, `TipoIntensidad`, `PropTincion` FROM `IntensidadTincion` ORDER BY IdIntensidad ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$IdIntensidad=$row['IdIntensidad'];
			$TipoIntensidad=$row['TipoIntensidad'];

			$datos[] = array('IdIntensidad'=> $IdIntensidad, 'TipoIntensidad'=> $TipoIntensidad);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}




else if($function=="listNucleosPositivos"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdPorcentaje`, `PorcentCelulas`, `PropScore` FROM `PorcentCelPosit` ORDER BY  IdPorcentaje ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$IdPorcentaje=$row['IdPorcentaje'];
			$PorcentCelulas=$row['PorcentCelulas'];

			$datos[] = array('IdPorcentaje'=> $IdPorcentaje, 'PorcentCelulas'=> $PorcentCelulas);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}


else if($function=="cargoOcupa"){

	$id = $_GET['id'];
	
	if($id=="478"){
	    $value="SELECT `Id`, `descripcion` FROM `CargoOcupacion` WHERE Id NOT IN(1,3) ORDER BY descripcion ASC";
	}else{
	    
	    $value="SELECT `Id`, `descripcion` FROM `CargoOcupacion` WHERE Id IN(1,3)";
	}
	
	$datos = array();

	try {
		
		$stmt = $conn->prepare($value);
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$Id=$row['Id'];
			$descripcion=$row['descripcion'];

			$datos[] = array('Id'=> $Id, 'descripcion'=> $descripcion);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}

else if($function=="ofiUnFor"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idOf`, `descripcion` FROM `tbl_ofAreaUnidad` ORDER BY `idOf` ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$idOf=$row['idOf'];
			$descripcion=$row['descripcion'];

			$datos[] = array('idOf'=> $idOf, 'descripcion'=> $descripcion);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}


else if($function=="listArea"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdSubArea`,`SubArea` FROM `Areas`   ORDER BY `SubArea` ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$IdSubArea=$row['IdSubArea'];
			$SubArea=$row['SubArea'];

			$datos[] = array('IdSubArea'=> $IdSubArea, 'SubArea'=> $SubArea);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}

else if($function=="services"){

	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT  `servicio` FROM `repositorio` GROUP BY servicio ORDER BY servicio ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$servicio=$row['servicio'];

			$datos[] = array('servicio'=> $servicio);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}


else if($function=="servicesCE"){

	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`, `descripcion`, `codigo` FROM `tbl_serviciosCE` ORDER BY descripcion ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$id=$row['id'];
			$descripcion=$row['descripcion'];

			$datos[] = array('id'=> $id,'descripcion'=> $descripcion);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}


else if($function=="codPresHos"){

	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idCod`, `descripcion`, `codigo` FROM `codPrestHospi` ORDER BY descripcion ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$idCod=$row['idCod'];
			$descripcion=$row['descripcion'];

			$datos[] = array('idCod'=> $idCod,'descripcion'=> $descripcion);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}


else if($function=="codPresHosCE"){

	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`, `descripcion` FROM `tbl_codigosprestacionalesCE` ORDER BY descripcion ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$id=$row['id'];
			$descripcion=$row['descripcion'];

			$datos[] = array('id'=> $id,'descripcion'=> $descripcion);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}

else if($function=="iafapaciente"){

	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT  `iafa` FROM `repositorio` GROUP BY iafa ORDER BY iafa ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$iafa=$row['iafa'];

			$datos[] = array('iafa'=> $iafa);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}

else if($function=="tecnico"){

	//$NroDoc = $_GET['NroDoc'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `id`,`nom` FROM `usuarios` WHERE `estado`='ACTIVADO' AND rol=5 ORDER BY nom ASC" );
		$stmt->execute();
		
		
		while($row = $stmt->fetch()) {

			$id=$row['id'];
			$nom=$row['nom'];

			$datos[] = array('id'=> $id, 'nom'=> $nom);
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos);

}



else if($function=="cartaCuentx"){

	$NroDoc = $_GET['NroDoc'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idCuenta`, `idprestacion`, `nrocuenta`, `historia`, `fatencion`, `consultorio`, `estado` , `interconsulta`
		FROM `cuentas` WHERE `idCuenta`= :term " );
		$stmt->execute(array('term' => $NroDoc));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);

			$datos[] =  $row['idCuenta'];
			$datos[] =  $row['idprestacion'];
			$datos[] =  $row['nrocuenta'];
			$datos[] =  $row['historia'];
			$datos[] =  $row['fatencion'];		
			$datos[] =  $row['consultorio'];	
			$datos[] =  $row['estado'];
			$datos[] =  $row['interconsulta'];
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="cuentasX"){

	$NroDoc = $_GET['NroDoc'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `Paciente`, `nrodoc`,referencia,Producto FROM `cartagarantia` WHERE `idCar`= :term " );
		$stmt->execute(array('term' => $NroDoc));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);

			$datos[] =  $row['nrodoc'];
			$datos[] =  $row['Paciente'];
			$datos[] =  $row['referencia'];
			$datos[] =  $row['Producto'];

		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="cuentasXAuto"){

	$NroDoc = $_GET['NroDoc'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `apellido_paterno_paciente`, `apellido_materno_paciente`, `nombres_paciente`
		FROM `imp_autorizaciones`
		WHERE nro_documento_autorizacion= :term " );
		$stmt->execute(array('term' => $NroDoc));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);

			$datos[] =  $row['apellido_paterno_paciente'];
			$datos[] =  $row['apellido_materno_paciente'];
			$datos[] =  $row['nombres_paciente'];

		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="VerDiagnostico"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT  `IdDiagnostico`, `IdUsuario`, `id_prestacion`, `tipo_diagnostico`, `codigo_diagnostico`, 
		`Descripcion_diagnostico`, `fechaIngreso` FROM `ac_diagnostico` WHERE IdDiagnostico = :term " );
		$stmt->execute(array('term' => $id));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
			
			$datos[] =  $row['IdDiagnostico'];
			$datos[] =  $row['id_prestacion'];		
			$datos[] =  $row['tipo_diagnostico'];
			$datos[] =  $row['codigo_diagnostico'];
			$datos[] =  $row['Descripcion_diagnostico'];
			
	
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}




else if($function=="VerProcedimiento"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdProcedimiento`, `IdUsuario`, `id_prestacion`, `codigo_cpt`, `cantidad`, `valorizacion` ,`descripcion`	,`total`,dx	
		FROM `a_procedimientos` WHERE IdProcedimiento = :term " );
		$stmt->execute(array('term' => $id));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
			
			$datos[] =  $row['IdProcedimiento'];
			$datos[] =  $row['id_prestacion'];		
			$datos[] =  $row['cantidad'];
			$datos[] =  $row['codigo_cpt'];
			$datos[] =  $row['valorizacion'];
			$datos[] =  $row['descripcion'];
			$datos[] =  $row['total'];
			$datos[] =  $row['dx'];
	
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

else if($function=="VerProcedimientoAuto"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `IdProcedimiento`, `IdUsuario`, `id_prestacion`, `codigo_cpt`, `cantidad`, `valorizacion` ,`descripcion`	,`total`,`dx`	
		FROM `ac_procedimientos` WHERE IdProcedimiento = :term " );
		$stmt->execute(array('term' => $id));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
			
			$datos[] =  $row['IdProcedimiento'];
			$datos[] =  $row['id_prestacion'];		
			$datos[] =  $row['cantidad'];
			$datos[] =  $row['codigo_cpt'];
			$datos[] =  $row['valorizacion'];
			$datos[] =  $row['descripcion'];
			$datos[] =  $row['total'];
			$datos[] =  $row['dx'];
	
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}



else if($function=="VerInsumo"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idInsumos`, `IdUsuario`, `id_prestacion`, `codigo_sismed`, `cantidad`, `diagnostico`, `valorizacion`, `descripcion` , `fechaIngreso` ,`total`
		FROM `a_insumos` WHERE idInsumos = :term " );
		$stmt->execute(array('term' => $id));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
			
			$datos[] =  $row['idInsumos'];
			$datos[] =  $row['id_prestacion'];		
			$datos[] =  $row['codigo_sismed'];
			$datos[] =  $row['cantidad'];
			$datos[] =  $row['diagnostico'];
			$datos[] =  $row['valorizacion'];
			$datos[] =  $row['descripcion'];
			$datos[] =  $row['total'];
			
	
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="VerInsumoAuto"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idInsumos`, `IdUsuario`, `id_prestacion`, `codigo_sismed`, `cantidad`, `diagnostico`, `valorizacion`, `descripcion` , `fechaIngreso` ,`total`
		FROM `ac_insumos` WHERE idInsumos = :term " );
		$stmt->execute(array('term' => $id));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
			
			$datos[] =  $row['idInsumos'];
			$datos[] =  $row['id_prestacion'];		
			$datos[] =  $row['codigo_sismed'];
			$datos[] =  $row['cantidad'];
			$datos[] =  $row['diagnostico'];
			$datos[] =  $row['valorizacion'];
			$datos[] =  $row['descripcion'];
			$datos[] =  $row['total'];
			
	
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="VerMx"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idMed`, `IdUsuario`, `id_prestacion`, `codigo_sismed`, `cantidad`, `diagnostico`, `valorizacion`,`total`,
		 `descripcion`, `fechaIngreso` FROM `a_medicamentos` 
		WHERE idMed = :term " );
		$stmt->execute(array('term' => $id));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
			
			$datos[] =  $row['idMed'];
			$datos[] =  $row['id_prestacion'];		
			$datos[] =  $row['codigo_sismed'];
			$datos[] =  $row['cantidad'];
			$datos[] =  $row['diagnostico'];
			$datos[] =  $row['valorizacion'];
			$datos[] =  $row['descripcion'];
			$datos[] =  $row['total'];
			
	
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}


else if($function=="VerMxAuto"){

	$id = $_GET['id'];
	$datos = array();

	try {
		
		$stmt = $conn->prepare("SELECT `idMed`, `IdUsuario`, `id_prestacion`, `codigo_sismed`, `cantidad`, `diagnostico`, `valorizacion`,`total`,
		 `descripcion`, `fechaIngreso` FROM `ac_medicamentos` 
		WHERE idMed = :term " );
		$stmt->execute(array('term' => $id));
		
		
		while($row = $stmt->fetch()) {
			sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
			
			$datos[] =  $row['idMed'];
			$datos[] =  $row['id_prestacion'];		
			$datos[] =  $row['codigo_sismed'];
			$datos[] =  $row['cantidad'];
			$datos[] =  $row['diagnostico'];
			$datos[] =  $row['valorizacion'];
			$datos[] =  $row['descripcion'];
			$datos[] =  $row['total'];
			
	
		}

	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	echo json_encode($datos,JSON_UNESCAPED_UNICODE);

}

		else if($function=="datPacinx"){

			$id = $_GET['id'];
			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `idRegistro`, `idUsuario`, `id_prestacion`, `IdCuentaAtencion`, `nro_documento_autorizacion`,
				`tipo_documento_paciente`, `nro_documento_paciente`, `apellido_paterno_paciente`, `apellido_materno_paciente`, `nombres_paciente`,
				`nro_historia`, `fecha_nacimiento`, `sexo`, `tipo_atencion`, `fecha_ingreso`, `fecha_alta`, `tipo_documento_responsable`, 
				`nro_documento_responsable`, `apellido_paterno_responsable`, `apellido_materno_responsable`, `nombres_responsable`, `profesion_responsable`,
				`nro_colegiatura`, `codigo_especialidad`, `nro_registro_especialista`, `condicion_alta`, `fechaRegistro` 
				FROM `imp_datospacientes` WHERE  id_prestacion = :term " );
				$stmt->execute(array('term' => $id));
				
				
				while($row = $stmt->fetch()) {
					sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
					
					$datos[] =  $row['IdCuentaAtencion'];
					$datos[] =  $row['nro_documento_autorizacion'];		
					$datos[] =  $row['nro_historia'];
					$datos[] =  $row['tipo_documento_paciente'];
					$datos[] =  $row['nro_documento_paciente'];
					$datos[] =  $row['apellido_paterno_paciente'];
					$datos[] =  $row['apellido_materno_paciente'];
					$datos[] =  $row['nombres_paciente'];
					$datos[] =  $row['fecha_ingreso'];
					$datos[] =  $row['fecha_alta'];
					
			
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos,JSON_UNESCAPED_UNICODE);

		}


		else if($function=="datPacinConsol"){

			$id = $_GET['id'];
			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `idRegistro`, `ApePaterno`, `ApeMaterno`, `FechaNacimiento`, `sexo`, `TipoAtencion`, 
				`HistoriaClinica`, `TIpoDoc`, `NroDoc`, `Nombres`, `fe_in`, `estatus` FROM `regpersona`  WHERE  idRegistro = :term " );
				$stmt->execute(array('term' => $id));
				
				
				while($row = $stmt->fetch()) {
					sort($datos, SORT_NATURAL | SORT_FLAG_CASE);
					
					$datos[] =  $row['ApePaterno'];
					$datos[] =  $row['ApeMaterno'];		
					$datos[] =  $row['FechaNacimiento'];
					$datos[] =  $row['sexo'];
					$datos[] =  $row['TipoAtencion'];
					$datos[] =  $row['HistoriaClinica'];
					$datos[] =  $row['TIpoDoc'];
					$datos[] =  $row['NroDoc'];
					$datos[] =  $row['Nombres'];
					$datos[] =  $row['fe_in'];
					
			
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos,JSON_UNESCAPED_UNICODE);

		}


		else if($function=="cie10"){

			$post = $_GET['cie10'];
			$resultado = str_replace ( ".", '', $post);
			$datos = array();

			try {
				
				$stmt = $conn->prepare('SELECT C10_Descripcion	FROM m_cie10 WHERE C10_CodDia = :term ' );
				$stmt->execute(array('term' => $resultado));
				
				while($row = $stmt->fetch()) {
					$datos[] =  normaliza($row['C10_Descripcion']);
					//$datos[] =  normaliza($row['C10_CodDia']);
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}

		else if($function=="titulo"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare('SELECT `Tipo` FROM `imp_tarsaludpol` WHERE `CodCpt`= :term ' );
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					$datos[] =  normaliza($row['Tipo']);
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}

		else if($function=="cptpolDes"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare('SELECT `CODIGO_CPMS`,`III_nivel`  FROM `sis_cpms` WHERE estado= 1 AND `deno2` = :term ' );
				$stmt->execute(array('term' => $_GET['desCpt']));
				
				while($row = $stmt->fetch()) {
					$datos[] =  $row['CODIGO_CPMS'];
					$datos[] =  $row['III_nivel'];
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}


		else if($function=="bucasrCpt"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare('SELECT  `CODIGO_CPT`, `CODIGO_CPMS`, `deno2`,  `III_nivel`, `fe_reg` FROM `sis_cpms` WHERE `idCpms`=:term ' );
				$stmt->execute(array('term' => $_GET['ide']));
				
				while($row = $stmt->fetch()) {
					$datos[] =  $row['CODIGO_CPMS'];
					$datos[] =  $row['deno2'];
					$datos[] =  $row['III_nivel'];
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}

		else if($function=="cptpol"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare('SELECT `deno2`,`III_nivel`  FROM `sis_cpms` WHERE estado= 1 AND `CODIGO_CPMS`= :term ' );
				$stmt->execute(array('term' => $_GET['codCpt']));
				
				while($row = $stmt->fetch()) {
					$datos[] =  normaliza($row['deno2']);
					$datos[] =  $row['III_nivel'];
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}


		else if($function=="Ins"){


			$datos = array();

			try {
				
				$stmt = $conn->prepare('SELECT `ins_CodIns`, `ins_Nombre`, `ins_Costo` FROM `m_insumos` WHERE ins_CodIns = :term ' );
				$stmt->execute(array('term' => $_GET['codSismed']));
				
				while($row = $stmt->fetch()) {
					$datos[] =  normaliza($row['ins_Nombre']);
					$datos[] =  $row['ins_Costo'];
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);
			

		}


		else if($function=="CarxCuentax"){

			$datos = array();
			//$cuenta= $_GET['Nxuenta'];

			try {
				
				$stmt = $conn->prepare("SELECT `idRi`, `nroFua`, `paciente`, `historiaClinica`, `cuentaEmergencia`, 
				`cuentaHospitalizacion` FROM `tbl_driveH` WHERE `cuentaEmergencia`= :term "); 
				$stmt->execute(array('term' => $_GET['Nxuenta']));
				
				while($row = $stmt->fetch()) {
				    
						$datos[] =  $row['nroFua'];
						$datos[] =  $row['paciente'];
						$datos[] =  $row['historiaClinica'];
					
				}

			} catch(PDOException $e) {

				echo 'ERROR: ' . $e->getMessage();
				
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="cargarInfoDisa"){

			$datos = array();
			//$cuenta= $_GET['Nxuenta'];

			try {
				
				$stmt = $conn->prepare("SELECT `id`, `nombre`, `dpto`, `prov`, `dis`, `disa`, `categoria` FROM `tbl_ipress` WHERE `codigo` LIKE :term "); 
				$stmt->execute(array('term' => '%'.$_GET['datois'].'%'));
				
				while($row = $stmt->fetch()) {
				    
						$datos[] =  $row['id'];
						$datos[] =  $row['nombre'];
						$datos[] =  $row['dpto'];
						$datos[] =  $row['prov'];
						$datos[] =  $row['dis'];
						$datos[] =  $row['disa'];
						$datos[] =  $row['categoria'];
					
				}

			} catch(PDOException $e) {

				echo 'ERROR: ' . $e->getMessage();
				
			}

			echo json_encode($datos);

		}
		
		
		
			
		else if($function=="countEst"){

			$datos = array();
			$datois= $_GET['datois'];

			try {
				
				$stmt = $conn->prepare("SELECT COUNT(*) AS DISO FROM `usuarios` WHERE `codEstab`= '$datois' AND estado='ACTIVADO' "); 
				$stmt->execute();
				
				while($row = $stmt->fetch()) {
				    
						$datos[] =  $row['DISO'];
					
				}

			} catch(PDOException $e) {

				echo 'ERROR: ' . $e->getMessage();
				
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="countDuplicadoCargo"){

			$datos = array();
			$idCargo= $_GET['idCargo'];
            $idEst= $_GET['idEst'];
            
            
			try {
				
				$stmt = $conn->prepare("SELECT COUNT(*) AS DISO FROM `usuarios` WHERE `codEstab`= '$idEst' AND cargo = '$idCargo' AND estado='ACTIVADO'"); 
				$stmt->execute();
				
				while($row = $stmt->fetch()) {
				    
						$datos[] =  $row['DISO'];
				}

			} catch(PDOException $e) {
				    echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
			else if($function=="cargarInfoDisaEEss"){

			$datos = array();
			//$cuenta= $_GET['Nxuenta'];

			try {
				
				$stmt = $conn->prepare("SELECT `id`, `codigo`, `dpto`, `prov`, `dis`, `disa`, `categoria` FROM `tbl_ipress` WHERE `nombre` LIKE :term "); 
				$stmt->execute(array('term' => '%'.$_GET['datois'].'%'));
				
				while($row = $stmt->fetch()) {
				    
						$datos[] =  $row['id'];
						$datos[] =  $row['codigo'];
						$datos[] =  $row['dpto'];
						$datos[] =  $row['prov'];
						$datos[] =  $row['dis'];
						$datos[] =  $row['disa'];
						$datos[] =  $row['categoria'];
					
				}

			} catch(PDOException $e) {

				echo 'ERROR: ' . $e->getMessage();
				
			}

			echo json_encode($datos);

		}

    else if($function=="cargarDeno"){

			$datos = array();
			//$cuenta= $_GET['Nxuenta'];

			try {
				
				$stmt = $conn->prepare("SELECT `idCod` FROM `codPrestHospi` WHERE `codigo`= :term "); 
				
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
				    
						$datos[] =  $row['idCod'];

				}

			} catch(PDOException $e) {

				echo 'ERROR: ' . $e->getMessage();
				
			}

			echo json_encode($datos);

		}
		
		
		 else if($function=="cargarDenoCE"){

			$datos = array();
			//$cuenta= $_GET['Nxuenta'];

			try {
				
				$stmt = $conn->prepare("SELECT `id` FROM `tbl_codigosprestacionalesCE` WHERE `codigo`= :term "); 
				
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
				    
						$datos[] =  $row['id'];

				}

			} catch(PDOException $e) {

				echo 'ERROR: ' . $e->getMessage();
				
			}

			echo json_encode($datos);

		}

        else if($function=="carCodpre"){

			$datos = array();
			$id= $_GET['cod'];

			try {
				
				$stmt = $conn->prepare("SELECT `codigo` FROM `tbl_serviciosCE` WHERE `id`= :term "); 
				$stmt->execute(array('term' => $id));
				
				while($row = $stmt->fetch()) {
				    
						$datos[] =  $row['codigo'];

				}

			} catch(PDOException $e) {

				echo 'ERROR: ' . $e->getMessage();
				
			}

			echo json_encode($datos);

		}
		
		
		 else if($function=="buscarPacix"){

			$datos = array();
			$id= $_GET['id'];

			try {
				
				$stmt = $conn->prepare("SELECT `iduser`,`idPac`, `codPre`,`prioridad`,F_Ingreso,F_Alta_Medica FROM `paciente` WHERE `idPac`= :term "); 
				$stmt->execute(array('term' => $id));
				
				while($row = $stmt->fetch()) {
				    
						$datos[] =  $row['iduser'];
						$datos[] =  $row['idPac'];
						$datos[] =  $row['codPre'];
						$datos[] =  $row['prioridad'];
						$date1 = new DateTime($row['F_Ingreso']);
                        $date2 = new DateTime($row['F_Alta_Medica']);
                        $diff = $date1->diff($date2);
                        $estancia = $diff->days + 1 ;
						$datos[] =  $estancia;

				}

			} catch(PDOException $e) {

				echo 'ERROR: ' . $e->getMessage();
				
			}

			echo json_encode($datos);

		}
		
		else if($function=="buscarReglaCons"){

            $datos = array();
			$codPre= $_GET['codPre'];
			$prioridad= $_GET['prioridad'];
            
            	try {
            		
            		$stmt = $conn->prepare("SELECT C.`codCpms`,'1' AS CNT,S.deno2,S.II_nivel FROM `tbl_reglasConsistencia` as C 
				    INNER JOIN sis_cpms AS S ON C.codCpms=S.CODIGO_CPMS WHERE `codPres`='$codPre' AND `prioridad`='$prioridad'" );
            		$stmt->execute();
            		
            		
            		while($row = $stmt->fetch()) {
            
                		$codCpms=$row['codCpms'];
            			$CNT=$row['CNT'];
            			$deno2=$row['deno2'];
            			$II_nivel=$row['II_nivel'];
            
            			$datos[] = array('codCpms'=> $codCpms, 'CNT'=> $CNT,'deno2'=> $deno2, 'II_nivel'=> $II_nivel);
            			
            		}
            
            	} catch(PDOException $e) {
            		echo 'ERROR: ' . $e->getMessage();
            	}
            
            	echo json_encode($datos);
            
            }
		
		 /*else if($function=="buscarReglaCons"){

			$datos = array();
			$codPre= $_GET['codPre'];
			$prioridad= $_GET['prioridad'];

			try {
				
				$stmt = $conn->prepare("SELECT C.`codCpms`,'1' AS CNT,S.deno2,S.II_nivel FROM `tbl_reglasConsistencia` as C 
				INNER JOIN sis_cpms AS S ON C.codCpms=S.CODIGO_CPMS WHERE `codPres`='$codPre' AND `prioridad`='$prioridad'"); 
				$stmt->execute();
				
				while($row = $stmt->fetch()) {
				    
		
						
					$codCpms=$row['codCpms'];
        			$CNT=$row['CNT'];
        			$deno2=$row['deno2'];
        			$II_nivel=$row['II_nivel'];
        
        			$datos[] = array('codCpms'=> $codCpms, 'CNT'=> $CNT,'deno2'=> $deno2, 'II_nivel'=> $II_nivel);
						
						

				}

			} catch(PDOException $e) {

				echo 'ERROR: ' . $e->getMessage();
				
			}

			echo json_encode($datos);

		}
		*/
		
		
		 else if($function=="carCodpreHospi"){

			$datos = array();
			$id= $_GET['cod'];

			try {
				
				$stmt = $conn->prepare("SELECT `codigo` FROM `codPrestHospi`  WHERE `idCod`= :term "); 
				$stmt->execute(array('term' => $id));
				
				while($row = $stmt->fetch()) {
				    
						$datos[] =  $row['codigo'];

				}

			} catch(PDOException $e) {

				echo 'ERROR: ' . $e->getMessage();
				
			}

			echo json_encode($datos);

		}

else if($function=="carCodpreHospiCE"){

			$datos = array();
			$id= $_GET['cod'];

			try {
				
				$stmt = $conn->prepare("SELECT `codigo` FROM `tbl_codigosprestacionalesCE`  WHERE `id`= :term "); 
				$stmt->execute(array('term' => $id));
				
				while($row = $stmt->fetch()) {
				    
						$datos[] =  $row['codigo'];

				}

			} catch(PDOException $e) {

				echo 'ERROR: ' . $e->getMessage();
				
			}

			echo json_encode($datos);

		}

		
		else if($function=="editaPaci"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT P.`idPac`, P.`iduser`, P.`nroFua`, P.`nroCuenta`, P.`paciente`, 
				P.`servicio`, P.`F_Ingreso`, P.`F_Alta_Medica`, P.`Historia`, P.`DNI`, P.`auditor`, P.`tecnico`, 
				P.`observacion`,P.`estado`, P.`fe_reg`, P.`fe_reg`,P.montogal,P.montosisfar,P.obsCpms,P.valorFinal,P.tipoDoc,P.denominacion,P.codPre,P.prioridad,
				(SELECT `nombre` FROM `tipoServicioIngreso` WHERE `idTsi`= P.serEgreso ) AS SEI	FROM `paciente` P WHERE `idPac` = :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['nroCuenta'];
					$datos[] =  $row['Historia'];
					$datos[] =  $row['nroFua'];
					$datos[] =  $row['DNI'];
					$datos[] =  $row['paciente'];
					$datos[] =  $row['servicio'];
					$datos[] =  $row['F_Ingreso'];
					$datos[] =  $row['F_Alta_Medica'];
				    $datos[] =  $row['auditor'];
				    $datos[] =  $row['montogal'];
				    $datos[] =  $row['montosisfar'];
				    $datos[] =  $row['obsCpms'];
				    $datos[] =  $row['valorFinal'];
				    $datos[] =  $row['tipoDoc'];
				    
				    $datos[] =  $row['denominacion'];
				    $datos[] =  $row['codPre'];
				    $datos[] =  $row['SEI'];
				     $datos[] =  $row['prioridad'];

				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		
		else if($function=="editaUsers"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `user`,`pass`,`estado`,`nom`,`email`,`doc` FROM `usuarios` WHERE `id`= :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['user'];
					$datos[] =  md5($row['pass']);
					$datos[] =  $row['estado'];
					$datos[] =  $row['nom'];
					$datos[] =  $row['email'];
					$datos[] =  $row['doc'];


				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="buscarMarcadList"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `IdMarcador` FROM `MarcadoresIHQ` WHERE `Descripcion` = :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					    $datos[] =  $row['IdMarcador'];
	
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="buscarIntensi"){


			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `PropTincion` FROM `IntensidadTincion` WHERE `IdIntensidad`= :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['PropTincion'];
	
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="verificarCheckedMama"){


            $id= $_GET['id'];
            $p1= $_GET['p1'];
            $p2= $_GET['p2'];
			$datos = array();
			
			$sql="";
			
			if($id=="MSH6" || $id=="MLH1" || $id=="MSH2" || $id=="PMS2"){
			    $sql="SELECT COUNT(*) AS CONI FROM `tbl_detalleRotulo` WHERE `rotulo` = 'COLON' AND checkHisto='checked' AND formatoPatoMac='$p1' AND tipoEstudio='$p2'";
			}else{
			    $sql="SELECT COUNT(*) AS CONI FROM `tbl_detalleRotulo` WHERE `rotulo` = 'MAMA' AND checkHisto='checked' AND formatoPatoMac='$p1' AND tipoEstudio='$p2' 
				OR `rotulo` = 'COLON' AND checkHisto='checked'  AND formatoPatoMac='$p1' AND tipoEstudio='$p2'";
			}

			try {
				
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['CONI'];
	
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="buscarPorceNucle"){


			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `PropScore` FROM `PorcentCelPosit` WHERE `IdPorcentaje` =  :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['PropScore'];
	
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		
		
		else if($function=="editaMarcadorColor"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `marcador`, `resultado`, `resulDepend`, `intesTincion`, `nucleosPos`, `subtotalPun`, `interpretHi` 
				FROM `tbl_crudMarcadores` WHERE `idMar` = :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['marcador'];
				
					if($row['resultado']==""){
					    $datos[] =  $row['resulDepend'];
					}else{
					    $datos[] =  $row['resultado'];
					}
				
					$datos[] =  $row['resulDepend'];
					$datos[] =  $row['intesTincion'];
					$datos[] =  $row['nucleosPos'];
					$datos[] =  $row['subtotalPun'];
					if($row['interpretHi']!=""){
					    $datos[] =  $row['interpretHi'];
					}else{
					    $datos[] =  "-";
					}
					
		
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="buscarIpress"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT  J.Descripcion
				FROM `tbl_ipress` AS I
				INNER JOIN JurisdiccionIPRESS AS J ON I.IdJurisdiccion=J.IdJurisdiccion 
				WHERE `codigo` LIKE :term ");
				$stmt->execute(array('term' => '%'.$_GET['id'].'%'));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['Descripcion'];
					


				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
			else if($function=="editarQuimio"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `idQ`, `paciente`, `historia`, `fua`, `cuenta`, `feAtencion`, `medico`, `feProc`, `nsp`, `devolucion`,
			  `tp1`, `cie10_2`, `tp2`, `cie10_3`, `tp3`, `cie10_4`, `tp4`, `cie10_5`, `tp5`, `tipoDocQui`,
				`tefQuimi`, `segurosQuimi`, `refQuimi`, `fechaNacQuimi`, `edadQuimi`,dniQui,ocupacion FROM `tbl_quimioterapia` WHERE `idQ`= :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['paciente'];
					$datos[] =  $row['historia'];
					$datos[] =  $row['fua'];
					$datos[] =  $row['cuenta'];
					$datos[] =  $row['feAtencion'];
					$datos[] =  $row['medico'];
					$datos[] =  $row['feProc'];
				    $datos[] =  $row['tp1'];
				    $datos[] =  $row['cie10_2'];
				    $datos[] =  $row['tp2'];
				    $datos[] =  $row['cie10_3'];
				    $datos[] =  $row['tp3'];
				    $datos[] =  $row['cie10_4'];
				    $datos[] =  $row['tp4'];
				    $datos[] =  $row['cie10_5'];
				    $datos[] =  $row['tp5'];
				    $datos[] =  $row['tipoDocQui'];
				    $datos[] =  $row['tefQuimi'];
				    $datos[] =  $row['segurosQuimi'];
				    $datos[] =  $row['refQuimi'];
				    $datos[] =  $row['fechaNacQuimi'];
				    $datos[] =  $row['edadQuimi'];
				    $datos[] =  $row['dniQui'];
				    $datos[] =  $row['ocupacion'];
				    
				

				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		else if($function=="editarPaqes"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `userAsignado`, `observacion`,fechaHoraAsignadoDigitador,userAuditor,fechaHoraUserAuditor,userAsignaAudi,userAsignaDigi,liquidador FROM `tbl_grupoArchivo` WHERE `idGrupo` = :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['userAsignado'];
					$datos[] =  $row['observacion'];
					$datos[] =  $row['fechaHoraAsignadoDigitador'];
					$datos[] =  $row['userAuditor'];
					$datos[] =  $row['fechaHoraUserAuditor'];
					$datos[] =  $row['userAsignaAudi'];
					$datos[] =  $row['userAsignaDigi'];
					$datos[] =  $row['liquidador'];

				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
			else if($function=="editarReferencias"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `idRef`, `idUserSolRef`, `tipoDocRef`, `NroDocRef`, `paxRef`, `sexoRef`, `FechaNacRef`, `edadRef`, `iafasRef`, `tipoSegRef`,
				`afiliaRef`, `caduciRef`, `domiRef`, `depaRef`, `provRef`, `disRef`, `actrasRef`, `tipoAccRef`, `lisDocs`, `ingresoReferido`, `idEstabelRef`, `fechaIngresoRef`, 
				`servicioOrigenRef`, `servDestRef`, `especialidadRef`, `motivoRef`, `condPcte`, `tipoTransRef`, `dispoTransRef`, `tipoDocRefRes`, `NroDocRefRes`, `personalResRef`,
				`profesionRefRes`, `colegiaturaRef`, `tipoDocRefResAcompa`, `NroDocRefResAcompa`, `personalResRefAcompa`, `profesionRefResAcompa`, `colegiaturaRefAcompa`,historia,codipres,anio 
				FROM `tbl_registroReferencias` WHERE `idRef`= :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['tipoDocRef'];
					$datos[] =  $row['NroDocRef'];
					$datos[] =  $row['paxRef'];
					$datos[] =  $row['sexoRef'];
					$datos[] =  $row['FechaNacRef'];
					$datos[] =  $row['edadRef'];
					$datos[] =  $row['iafasRef'];
					$datos[] =  $row['tipoSegRef'];
					$datos[] =  $row['afiliaRef'];
					$datos[] =  $row['caduciRef'];
					$datos[] =  $row['domiRef'];
					$datos[] =  $row['depaRef'];
					$datos[] =  $row['provRef'];
					$datos[] =  $row['disRef'];
					$datos[] =  $row['actrasRef'];
					$datos[] =  $row['tipoAccRef'];
					$datos[] =  $row['lisDocs'];
					$datos[] =  $row['ingresoReferido'];
					$datos[] =  $row['idEstabelRef'];
					$datos[] =  $row['fechaIngresoRef'];
					$datos[] =  $row['servicioOrigenRef'];
					$datos[] =  $row['servDestRef'];
					$datos[] =  $row['especialidadRef'];
					$datos[] =  $row['motivoRef'];
					$datos[] =  $row['condPcte'];
					$datos[] =  $row['caduciRef'];
					$datos[] =  $row['tipoTransRef'];
					$datos[] =  $row['dispoTransRef'];
					$datos[] =  $row['tipoDocRefRes'];
					$datos[] =  $row['NroDocRefRes'];
					$datos[] =  $row['personalResRef'];
					$datos[] =  $row['profesionRefRes'];
					$datos[] =  $row['colegiaturaRef'];
					$datos[] =  $row['tipoDocRefResAcompa'];
					$datos[] =  $row['NroDocRefResAcompa'];
					$datos[] =  $row['personalResRefAcompa'];
					$datos[] =  $row['profesionRefResAcompa'];
					$datos[] =  $row['colegiaturaRefAcompa'];
					$datos[] =  $row['historia'];
					$datos[] =  $row['codipres'];
					$datos[] =  $row['anio'];
					

				}
				

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		
		else if($function=="editarHistRefEval"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `especEval1`, `especEval2`, `especEvalDatoRef`, `estadoRefDatRef`, `derivarJefeServ`, `motivoRecEval1`, `especEval3`, `obsJefeServ`, 
				`estadoRefJefeServ`, `motivoRecEval2`, `obsJefeGuardia`, `estadoRefJefeGuardia`, `motivoRecEval3`, `atencionPacEval`, `estFinalRef`, `motivoRecEval4`, `obsEstFinalRef`,
				`paxllegoEstab`, `fechaLlegada`, `cuentaFeLlegada`,codipres,anio,cor,personalMedico,T.accidente,T.chkDocCuenta1,T.chkDocCuenta2,T.chkDocCuenta3,T.chkDocCuenta4,T.chkDocCuenta5,
				
				
				(SELECT CONCAT(U.nom,'|',C.descripcion,'|',P.Denom) 
				FROM usuarios U
				INNER JOIN CargoOcupacion C ON C.id=U.cargo
				INNER JOIN tbl_profesion P ON P.idP=U.idProf
				WHERE U.id=T.iduserPerRef) AS USER1,
				
				(SELECT U.cmp FROM usuarios U WHERE U.id=T.iduserPerRef) AS USER1CMP,
				(SELECT CONCAT(' | RNE:',U.rne) FROM usuarios U WHERE U.id=T.iduserPerRef) AS USER1RNE,
				(SELECT L.descripcion FROM usuarios U INNER JOIN tbl_colegiatura L ON L.idCol=U.idCol WHERE U.id=T.iduserPerRef) AS USER1COLEGIO,
				
				
				
				(SELECT CONCAT(U.nom,'|',U.user,'|',U.rol,'|',U.user,'|',P.Denom,'|',L.descripcion) 
				FROM usuarios U
				INNER JOIN tbl_profesion P ON P.idP=U.idProf
				INNER JOIN tbl_colegiatura L ON L.idCol=U.idCol
				WHERE U.id=T.idJefeServicio) AS USER2,
				
		
				(SELECT U.cmp FROM usuarios U WHERE U.id=T.idJefeServicio) AS USER2CMP,
				(SELECT CONCAT(' | RNE:',U.rne) FROM usuarios U WHERE U.id=T.idJefeServicio) AS USER2RNE,
				(SELECT C.descripcion FROM usuarios U INNER JOIN tbl_especialidades C ON C.id=U.IdEspecialidad WHERE U.id=T.idJefeServicio ) AS USER2DESC,
				

				
				(SELECT CONCAT(U.nom,'|',U.user,'|',U.rol,'|',U.user,'|',P.Denom,'|',L.descripcion)
				FROM usuarios U
				
				INNER JOIN tbl_profesion P ON P.idP=U.idProf
				INNER JOIN tbl_colegiatura L ON L.idCol=U.idCol
				WHERE U.id=T.iduserJefeGuardia) AS USER3,
				
				
				(SELECT U.cmp FROM usuarios U WHERE U.id=T.iduserJefeGuardia) AS USER3CMP,
				(SELECT CONCAT(' | RNE:',U.rne) FROM usuarios U WHERE U.id=T.iduserJefeGuardia) AS USER3RNE,
				(SELECT C.descripcion FROM usuarios U INNER JOIN tbl_especialidades C ON C.id=U.IdEspecialidad WHERE U.id=T.iduserJefeGuardia ) AS USER3DESC,
				
			
			
				(SELECT CONCAT(U.nom,'|',U.user,'|',U.rol,'|',U.user,'|',P.Denom,'|',L.descripcion)
				FROM usuarios U
				INNER JOIN tbl_profesion P ON P.idP=U.idProf
				INNER JOIN tbl_colegiatura L ON L.idCol=U.idCol
				WHERE U.id=T.idMedicoAudi) AS USER4,
				
				
				(SELECT U.cmp FROM usuarios U WHERE U.id=T.idMedicoAudi) AS USER4CMP,
				(SELECT CONCAT(' | RNE:',U.rne) FROM usuarios U WHERE U.id=T.idMedicoAudi) AS USER4RNE,
				(SELECT C.descripcion FROM usuarios U INNER JOIN CargoOcupacion C ON C.Id=U.cargo WHERE U.id=T.idMedicoAudi ) AS USER4DESC,
				
				
	
				(SELECT CONCAT(U.nom,'|',C.descripcion,'|',P.Denom) 
				FROM usuarios U
				INNER JOIN CargoOcupacion C ON C.id=U.cargo
				INNER JOIN tbl_profesion P ON P.idP=U.idProf
				WHERE U.id=T.idPerRef) AS USER5,
				
				(SELECT U.cmp FROM usuarios U WHERE U.id=T.idPerRef) AS USER5CMP,
				(SELECT CONCAT(' | RNE:',U.rne) FROM usuarios U WHERE U.id=T.idPerRef) AS USER5RNE,
				(SELECT L.descripcion FROM usuarios U INNER JOIN tbl_colegiatura L ON L.idCol=U.idCol WHERE U.id=T.idPerRef) AS USER5COLEGIO,
				
				
				(SELECT CONCAT(U.nom,'|',C.descripcion,'|',P.Denom) 
				FROM usuarios U
				INNER JOIN CargoOcupacion C ON C.id=U.cargo
				INNER JOIN tbl_profesion P ON P.idP=U.idProf
				WHERE U.id=T.idPerReFinal) AS USER6, 
				
				(SELECT U.cmp FROM usuarios U WHERE U.id=T.idPerReFinal) AS USER6CMP,
				(SELECT CONCAT(' | RNE:',U.rne) FROM usuarios U WHERE U.id=T.idPerReFinal) AS USER6RNE,
				(SELECT L.descripcion FROM usuarios U INNER JOIN tbl_colegiatura L ON L.idCol=U.idCol WHERE U.id=T.idPerReFinal) AS USER6COLEGIO
				
				FROM `tbl_registroReferencias` T WHERE `idRef`= :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
				    
					
    					$datos[] =  $row['especEval1'];
    					$datos[] =  $row['especEval2'];
    					$datos[] =  $row['especEvalDatoRef'];
    					$datos[] =  $row['estadoRefDatRef'];
    					$datos[] =  $row['derivarJefeServ'];
    					$datos[] =  $row['motivoRecEval1'];
    					$datos[] =  $row['especEval3'];
    					$datos[] =  $row['obsJefeServ'];
    					$datos[] =  $row['estadoRefJefeServ'];
    					$datos[] =  $row['motivoRecEval2'];
    					$datos[] =  $row['obsJefeGuardia'];
    					$datos[] =  $row['estadoRefJefeGuardia'];
    					$datos[] =  $row['motivoRecEval3'];
    					$datos[] =  $row['atencionPacEval'];
    					$datos[] =  $row['estFinalRef'];
    					$datos[] =  $row['motivoRecEval4'];
    					$datos[] =  $row['obsEstFinalRef'];
    					$datos[] =  $row['paxllegoEstab'];
    					$datos[] =  $row['fechaLlegada'];
    					$datos[] =  $row['cuentaFeLlegada'];
    					$datos[] =  $row['codipres'];//20
    					$datos[] =  $row['anio'];
    					$datos[] =  $row['cor'];
    					$datos[] =  $row['personalMedico'];//23
    					
    					$datos[] =  $row['USER1'];//24
    					$datos[] =  $row['USER2'];
    					$datos[] =  $row['USER3'];
    					
    					

    					
    					//MEDICO AUDITOR
    					$datosUser4= explode("|",$row['USER4']);
    					$datos[] =  $datosUser4[4].": ".$datosUser4[0];//27
    					//$datos[] =  $datosUser4[5].":".$datosUser4[1]." | RNA:".$datosUser4[2];//28
    					
    					
    					if($datosUser4[5]!=""){
    					    	$datos[] =  $datosUser4[5].":".$row['USER4CMP'].$row['USER4RNE'];//28
    					}else{
    					    	$datos[] =  "";//28
    					}
    					
    					if($row['USER4DESC']!=""){
    				        $datos[] =  $row['USER4DESC'];//34 USER4DESC    
    				    }else{
    				        $datos[] = '';//29 USER2DESC
    				    }
    				//	$datos[] =  $datosUser4[3];//29
    					//FIN MEDICO AUDITOR
    					
    					//PERSONAL REFERENCIAS
    					
    					$datosUser5= explode("|",$row['USER5']);
    					$datos[] =  $datosUser5[2].": ".$datosUser5[0];//30
    					$datos[] =  $datosUser5[1];
    					//FIN PERSONA REF
    					
    
    					
    		        	//JEFE DE GUARDIA
    					
    					$datosUser3= explode("|",$row['USER3']);//3
    					$datos[] =  $datosUser3[4].": ".$datosUser3[0];//32
    					
    				//	$datos[] =  $datosUser3[5].":".$datosUser3[1]." | RNE:".$datosUser3[2];//33
    					
    					
    					if($datosUser3[5]!=""){
    					    	$datos[] =  $datosUser3[5].":".$row['USER3CMP'].$row['USER3RNE'];//33
    					}else{
    					    	$datos[] =  "";//33
    					}
    					
    					
    					if($row['USER3DESC']!=""){
    				        $datos[] =  $row['USER3DESC'];//34 USER2DESC    
    				    }else{
    				        $datos[] = '';//34 USER2DESC
    				    }
    					
                        // FIN JEFE DE GUARDIA
                        
                        
                        //JEFE DE SERVICIO
    					
    					$datosUser2= explode("|",$row['USER2']);//3
    					$datos[] =  $datosUser2[4].": ".$datosUser2[0];//35
    					
    					if($datosUser2[5]!=""){
    					    	$datos[] =  $datosUser2[5].":".$row['USER2CMP'].$row['USER2RNE'];//36
    					}else{
    					    	$datos[] =  "";//36
    					}
    				
    				    if($row['USER2DESC']!=""){
    				        $datos[] =  $row['USER2DESC'];//37 USER2DESC    
    				    }else{
    				        $datos[] = '';//37 USER2DESC
    				    }
    					
    					
                        // fin JEFE DE SERVICIO
                        
                        
                        //PERSONAL REFERENCIAS
    					
    					$datosUser1= explode("|",$row['USER1']);
    					$datos[] =  $datosUser1[2].": ".$datosUser1[0];//38
    					$datos[] =  $datosUser1[1];//39
    					//FIN PERSONA REF
					
						//PERSONAL REFERENCIAS 222222
    					
    					$datosUser6= explode("|",$row['USER6']);
    					$datos[] =  $datosUser6[2].": ".$datosUser6[0];//40
    					$datos[] =  $datosUser6[1];
    					//FIN PERSONA REF
    					
    					
    					if($row['USER1COLEGIO']!=""){
    					    	$datos[] =  $row['USER1COLEGIO'].":".$row['USER1CMP'].$row['USER1RNE'];//42
    					}else{
    					    	$datos[] =  "";//42
    					}
    					
    					
    					if($row['USER5COLEGIO']!=""){
    					    	$datos[] =  $row['USER5COLEGIO'].":".$row['USER5CMP'].$row['USER5RNE'];//43
    					}else{
    					    	$datos[] =  "";//43
    					}
    				
						if($row['USER6COLEGIO']!=""){
    					    	$datos[] =  $row['USER6COLEGIO'].":".$row['USER6CMP'].$row['USER6RNE'];//44
    					}else{
    					    	$datos[] =  "";//44
    					}
					
					
					$datos[] =  $row['accidente'];
					
					$datos[] =  $row['chkDocCuenta1'];
					$datos[] =  $row['chkDocCuenta2'];
					$datos[] =  $row['chkDocCuenta3'];
					$datos[] =  $row['chkDocCuenta4'];
					$datos[] =  $row['chkDocCuenta5'];
					
					
					
					

				}
				

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="editarReferenciasHistoriaCli"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT  `anamnesis`, `presionArterial`, `temperatura`, `cardiaca`, `respiratoria`, `saturacion`, `oxinoterapia`, 
				`litroMin`, `examenClinico`, `plan`, `notaObservaciones`,`codipres`, `anio`, `cor`,respirador FROM `tbl_registroReferencias` WHERE `idRef` = :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['anamnesis'];
					$datos[] =  $row['presionArterial'];
					$datos[] =  $row['temperatura'];
					$datos[] =  $row['cardiaca'];
					$datos[] =  $row['respiratoria'];
					$datos[] =  $row['saturacion'];
					$datos[] =  $row['oxinoterapia'];
					$datos[] =  $row['litroMin'];
					$datos[] =  $row['examenClinico'];
					$datos[] =  $row['plan'];
					$datos[] =  $row['notaObservaciones'];
					$datos[] =  $row['codipres'];
					$datos[] =  $row['anio'];
					$datos[] =  $row['cor'];
				    $datos[] =  $row['respirador'];
			
				}
				

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		else if($function=="verObsMediAudi"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT obsEstFinalRef FROM `tbl_registroReferencias` WHERE `idRef`= :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['obsEstFinalRef'];
				
			
				}
				

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		
			else if($function=="panelHistoriaClinica"){

			$datos = array();

            $ipress= $_GET['ipres'];
            $anio= $_GET['anio'];
            $id= $_GET['id'];

			try {
				
				/*$stmt = $conn->prepare("SELECT (SELECT `descripcion` FROM `tbl_tipoDoc` WHERE `idTipo`=R.`tipoDocRef`) AS TID,`NroDocRef`,`paxRef`,`sexoRef`,`edadRef`,
				(SELECT `nombre` FROM `tbl_plansalud` WHERE `idPa`=R.tipoSegRef) AS TISE,`actrasRef`,`tipoAccRef`,`condPcte`,historia  
				FROM `tbl_registroReferencias` AS R WHERE `cor` = :term ");*/
				$stmt = $conn->prepare("SELECT (SELECT `descripcion` FROM `tbl_tipoDoc` WHERE `idTipo`=R.`tipoDocRef`) AS TID,`NroDocRef`,`paxRef`,`sexoRef`,`edadRef`,
				(SELECT `nombre` FROM `tbl_plansalud` WHERE `idPa`=R.tipoSegRef) AS TISE,`actrasRef`,`tipoAccRef`,`condPcte`,historia  
				FROM `tbl_registroReferencias` AS R WHERE codipres='$ipress' AND anio='$anio' AND cor='$id' ");
				
				$stmt->execute();
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['paxRef'];
					$datos[] =  $row['TID'];
					$datos[] =  $row['NroDocRef'];
					$datos[] =  $row['edadRef'];
					$sexo='';
					($row['sexoRef']==1) ? $sexo='MASCULINO' : $sexo='FEMENINO';
					$datos[] =  $sexo;
					
					$datos[] =  $row['TISE'];
					$datos[] =  $row['actrasRef'];
					$condPcte ='';
					if($row['condPcte']==1){$condPcte ='ESTABLE';}else if($row['condPcte']==2){$condPcte ='MAL ESTADO';}else if($row['condPcte']==3){$condPcte ='GRAVE';}
					$datos[] =  $condPcte;
					$datos[] =  $row['historia'];

				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		
		else if($function=="verIpress"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `codigo`, `nombre`, `dpto`, `prov`, `dis`, `disa`, `categoria` FROM `tbl_ipress` WHERE `id`= :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['codigo'];
					$datos[] =  $row['nombre'];
					$datos[] =  $row['dpto'];
					$datos[] =  $row['prov'];
					$datos[] =  $row['dis'];
					$datos[] =  $row['disa'];
					$datos[] =  $row['categoria'];
				
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		
		else if($function=="editarFechaDig"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `fechadigitacioncheck`,fechaDevolucion FROM `tbl_grupoArchivo` WHERE `idGrupo` = :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['fechadigitacioncheck'];
					$datos[] =  $row['fechaDevolucion'];

				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="editarObserPaxx"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT  `cuenta`, `detalles`, `fechaRegistro`, `fechaUpdate` FROM `tbl_observacionesPaciente` WHERE `idObs`= :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['cuenta'];
					$datos[] =  $row['detalles'];
		
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
			else if($function=="editarObserCajax"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `detalles` FROM `tbl_observacionesCajas` WHERE `idObs` =  :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					
					$datos[] =  $row['detalles'];
		
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
	    else if($function=="editarActiAudit"){


           
			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT  `idActvidad`, `idProc`, `diagnostico`, `observacion`,`idRegistro` FROM `tbl_listActividades` WHERE `idLiAc` = :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['idActvidad'];
					$datos[] =  $row['idProc'];
					$datos[] =  $row['diagnostico'];
					$datos[] =  $row['observacion'];
					$datos[] =  $row['idRegistro'];
					
		
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="editarObserPaxRo"){

            $tipo = $_GET['tipo'];
			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT (SELECT UPPER(nom) FROM usuarios WHERE id=T.iduser) AS USERDESC,`rotulo`, `tacos`, `descripcion`,categoria,cortesRot,idMuestra,
				idcateg,plantillaApe,descMicro,plantillaMicro,fechaReg,UPPER(idDescripMacro) AS USERDESCR,UPPER(idDescripMicro) AS USMICRO,calidaMuestra,hallazgo,sisReporte,
				clasificacion,existeNeo FROM `tbl_observacionesRotulo` as T WHERE `idRo` = :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['rotulo'];
					$datos[] =  $row['tacos'];
					if($tipo==1){
					    $datos[] =  $row['descripcion'];
					}else if($tipo==2){
					    $datos[] =  $row['descMicro'];
					}else{
					    $datos[] =  $row['descripcion'];
					}
					

					
					$datos[] =  $row['categoria'];
					$datos[] =  $row['cortesRot'];
					$datos[] =  $row['idMuestra'];
					$datos[] =  $row['idcateg'];
					
					if($tipo==1){
					    $datos[] =  $row['plantillaApe'];
					}else if($tipo==2) {
					    $datos[] =  $row['plantillaMicro'];
					}else{
					    $datos[] =  $row['plantillaApe'];
					}
				
				
				    if($tipo==1){
					    $datos[] =  $row['USERDESCR'];
					}else if($tipo==2) {
					    $datos[] =  $row['USMICRO'];
					}else{
					    $datos[] =  $row['USERDESCR'];
					}
					
					
					$datos[] =  $row['calidaMuestra'];
					$datos[] =  $row['hallazgo'];
					$datos[] =  $row['sisReporte'];
					$datos[] =  $row['clasificacion'];
					$datos[] =  $row['existeNeo'];

		
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="editarRsptaMicro"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `rsptaMicro` FROM `tbl_observacionesRotulo` WHERE `idRo` = :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['rsptaMicro'];
				
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		
	else if($function=="editarObsMicro"){

			$datos = array();
			
			$tipo = $_GET['tipo'];
			$sql = "";
			if($tipo==1){
			    $sql="SELECT `obsMircro1` AS OBSLA FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}else if($tipo==2){
			    $sql="SELECT `obsMircro2` AS OBSLA FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}else if($tipo==3){
			    $sql="SELECT `obsMircro3` AS OBSLA FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}else if($tipo==4){
			    $sql="SELECT `obsMircro4` AS OBSLA FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}else if($tipo==5){
			    $sql="SELECT `obsMircro5` AS OBSLA FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}
			

			try {
				
				$stmt = $conn->prepare($sql);
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['OBSLA'];
				
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="editarObsMicroRotu"){

			$datos = array();
			
			//$tipo = $_GET['tipo'];
			$sql = "SELECT `obsMicro` as OBSLA FROM `tbl_observacionesRotulo` WHERE `idRo`  = :term";
		

			try {
				
				$stmt = $conn->prepare($sql);
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['OBSLA'];
				
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
/*	else if($function=="editarObsMicro"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `obsMicro1` FROM `tbl_observacionesRotulo` WHERE `idRo` = :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['obsMicro'];
				
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}*/
		
		else if($function=="editObsMacro"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `obsMacro` FROM `tbl_observacionesRotulo` WHERE `idRo` = :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['obsMacro'];
				
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		
		
		else if($function=="editarRsptaMicroLab"){

			$datos = array();
			
			$tipo = $_GET['tipo'];
			$sql = "";
			if($tipo==1){
			    $sql="SELECT `obsLab1` AS OBSLA FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}else if($tipo==2){
			    $sql="SELECT `obsLab2` AS OBSLA FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}else if($tipo==3){
			    $sql="SELECT `obsLab3` AS OBSLA FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}else if($tipo==4){
			    $sql="SELECT `obsLab4` AS OBSLA FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}else if($tipo==5){
			    $sql="SELECT `obsLab5` AS OBSLA FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}
			

			try {
				
				$stmt = $conn->prepare($sql);
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['OBSLA'];
				
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		
		else if($function=="editarMicroLab"){

			$datos = array();
			$tipo = $_GET['tipo'];
			
			$sql = "";
			if($tipo==1){
			    $sql="SELECT `rsptaLab` AS RSPTALAB FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}else if($tipo==2){
			    $sql="SELECT `rsptaLab2` AS RSPTALAB FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}else if($tipo==3){
			    $sql="SELECT `rsptaLab3` AS RSPTALAB FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}else if($tipo==4){
			    $sql="SELECT `rsptaLab4` AS RSPTALAB FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}else if($tipo==5){
			    $sql="SELECT `rsptaLab5` AS RSPTALAB FROM `tbl_detalleRotulo` WHERE `id` = :term ";
			}
			

			try {
				
				$stmt = $conn->prepare($sql);
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['RSPTALAB'];
				
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		else if($function=="editarDesignacion"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT  `rango`,`rango2`, `servicio`, `correo`, `adjunto`, `idresponsable`,`observaciones`,cantidad FROM `tbl_designacion` WHERE `id`= :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['rango'];
					$datos[] =  $row['servicio'];
					$datos[] =  $row['correo'];
					$datos[] =  $row['adjunto'];
					$datos[] =  $row['idresponsable'];
					$datos[] =  $row['observaciones'];
					$datos[] =  $row['rango2'];
					$datos[] =  $row['cantidad'];

				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="buscarDuplicados"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `idEm` FROM `tbl_consultaExterna` WHERE `nroFua`= :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
				    $va='';
					if($row['idEm']!=""){
					        $va='SI';    
					}
					$datos[] =  $va;

				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		else if($function=="verUserPaquete"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT (SELECT user FROM usuarios WHERE id= G.`idUsuario`) as UA,G.`namePaquete` 
							FROM `tbl_grupoCE` AS G WHERE G.`idGrupo`= :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['UA'];
					$datos[] =  $row['namePaquete'];

				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="consultaEmergencia"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT E.`idEm`, E.`idUserRegistro`, E.`nroFua`, E.`historiaClinica`, E.`tipoDoc`, E.`nroDoc`, E.`seguro`, E.`aseguradora`,
				E.`ubicacion`, E.`sexo`, E.`cuenta`, E.`nroAfiliacion`, E.`eess`, E.`nombres`, E.`fechaNac`, E.`ApePaterno`, E.`ApeMaterno`, E.`teleFam`, E.`edad`, E.`destino`, 
				E.`fechaDestino`, E.`refeContraref`, E.`servicioPabellon`, E.`fechaIngreso`, E.`fechaAlta`, E.`montoGalenos`, E.`montoSisfar`, E.`Observaciones`, E.`fechaRegistro`,
				E.`fechaUpdate`, E.`tipoRegistro`,E.envioA,E.estadoA,E.userRecibe,E.fechaUserRecibe, E.`actras`, E.`financia`, E.`regim`, E.`planSal`, E.`tipoSeiN`, E.`feSolAte`,
				E.`ubicacionDes`, E.`tipoSeiNDes`, E.`feingreAlta`, E.`feAltaAlt`, E.`monTotalCo`, E.`monCarGar`, E.`fuaEntre`, E.`fechaFuaEntre`,E.fechaAful,E.estancia,E.correo,E.`contrasena`, E.`responsable`, E.`cta_hospi`, E.`liquidador`,
				E.origenEmer,E.nroRefEmer,E.eessInicio,E.subirRef,E.nvaCta,E.ctaHos,E.rsatencion,E.reciAudit,E.registraAlta,E.nroCxref,E.segurosAl, E.`cuentaHsoMod`, E.`origenEmerMod`, E.`ubicacionHosX`, E.`tipoSeiNHosx`, E.`essHos`,
				E.`nroRefHZ`, E.`dxDescricon`, E.`feReefHos`, E.`especialidadHos`, E.`pab1Hos`, E.`camHos1`, E.`pab2Hos`, E.`camHos2`, E.`fechaIngreHos`, E.`montoToaxlHos`, E.`aceptarTransf`, E.`listObsFua`, E.fuaRcxHos,E.idUserLiquida
				,E.status,(SELECT  montoGalenos FROM tbl_Emergencias WHERE idEm=E.ideNew) AS M1,(SELECT  montoSisfar FROM tbl_Emergencias WHERE idEm=E.ideNew) AS M2,(SELECT  monTotalCo FROM tbl_Emergencias WHERE idEm=E.ideNew) AS M3,	
				(SELECT  feAltaAlt FROM tbl_Emergencias WHERE idEm=E.ideNew) AS ALTX,E.tipoLiqux,regServiceCE,tipoCita FROM `tbl_Emergencias` E WHERE `idEm`=:term ");
				$stmt->execute(array('term' => $_GET['id']));
				//rsatencion
				while($row = $stmt->fetch()) {
					
				
					$datos[] =  $row['nroFua'];
					$datos[] =  $row['historiaClinica'];
					$datos[] =  $row['tipoDoc'];
					$datos[] =  $row['nroDoc'];
					$datos[] =  $row['seguro'];
					$datos[] =  $row['aseguradora'];
				    $datos[] =  $row['ubicacion'];
				    $datos[] =  $row['sexo'];
					$datos[] =  $row['cuenta'];
					$datos[] =  $row['nroAfiliacion'];
					$datos[] =  $row['eess'];
					$datos[] =  $row['nombres'];
					$datos[] =  $row['fechaNac'];
					$datos[] =  $row['ApePaterno'];
					$datos[] =  $row['ApeMaterno'];
				    $datos[] =  $row['teleFam'];
				    $datos[] =  $row['edad'];
					$datos[] =  $row['destino'];
					$datos[] =  $row['fechaDestino'];
					$datos[] =  $row['refeContraref'];
					$datos[] =  $row['servicioPabellon'];
					$datos[] =  $row['fechaIngreso'];
					$datos[] =  $row['fechaAlta'];
					$datos[] =  $row['montoGalenos'];
				    $datos[] =  $row['montoSisfar'];
				    $datos[] =  $row['Observaciones'];
					$datos[] =  $row['tipoRegistro'];
					$datos[] =  $row['envioA'];
					$datos[] =  $row['estadoA'];
					$datos[] =  $row['fechaUserRecibe'];
					$datos[] =  $row['actras'];
					$datos[] =  $row['financia'];
					$datos[] =  $row['regim'];
					$datos[] =  $row['planSal'];
					$datos[] =  $row['tipoSeiN'];
					$datos[] =  $row['feSolAte'];
					$datos[] =  $row['ubicacionDes'];
					$datos[] =  $row['tipoSeiNDes'];
					$datos[] =  $row['feingreAlta'];
					$datos[] =  $row['feAltaAlt'];
					$datos[] =  $row['monTotalCo'];
					$datos[] =  $row['monCarGar'];
					$datos[] =  $row['fuaEntre'];
					$datos[] =  $row['fechaFuaEntre'];
					$datos[] =  $row['fechaAful'];
					$datos[] =  $row['estancia'];
					$datos[] =  $row['correo'];
					$datos[] =  $row['contrasena'];
					$datos[] =  $row['responsable'];
					$datos[] =  $row['cta_hospi'];
					$datos[] =  $row['liquidador'];
					$datos[] =  $row['origenEmer'];
					$datos[] =  $row['nroRefEmer'];
					$datos[] =  $row['eessInicio'];
					$datos[] =  $row['subirRef'];
					$datos[] =  $row['nvaCta'];
					$datos[] =  $row['ctaHos'];
					$datos[] =  $row['rsatencion'];
					$datos[] =  $row['reciAudit'];
					$datos[] =  $row['registraAlta'];
					$datos[] =  $row['nroCxref'];
					$datos[] =  $row['segurosAl'];
					$datos[] =  $row['cuentaHsoMod'];
					$datos[] =  $row['origenEmerMod'];
					$datos[] =  $row['ubicacionHosX'];
					$datos[] =  $row['tipoSeiNHosx'];
					$datos[] =  $row['essHos'];
					$datos[] =  $row['nroRefHZ'];
					$datos[] =  $row['dxDescricon'];
					$datos[] =  $row['feReefHos'];
					$datos[] =  $row['especialidadHos'];
					$datos[] =  $row['pab1Hos'];
					$datos[] =  $row['camHos1'];
					$datos[] =  $row['pab2Hos'];
					$datos[] =  $row['camHos2'];
					$datos[] =  $row['fechaIngreHos'];
					$datos[] =  $row['montoToaxlHos'];
					$datos[] =  $row['aceptarTransf'];
					$datos[] =  $row['listObsFua'];
					$datos[] =  $row['fuaRcxHos'];
					$datos[] =  $row['idUserLiquida'];
					$datos[] =  $row['status'];
					$datos[] =  $row['M1'];
					$datos[] =  $row['M2'];
					$datos[] =  $row['M3'];
					$datos[] =  $row['ALTX'];
					$datos[] =  $row['tipoLiqux'];
					$datos[] =  $row['regServiceCE'];
					$datos[] =  $row['tipoCita'];
					$datos[] =  $row['fechaRegistro'];
					//
					

				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="consultaExterna"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `idEm`, `idUserRegistro`, `nroFua`, `historiaClinica`, `tipoDoc`, `nroDoc`, `seguro`, `aseguradora`,
				`ubicacion`, `sexo`, `cuenta`, `nroAfiliacion`, `eess`, `nombres`, `fechaNac`, `ApePaterno`, `ApeMaterno`, `teleFam`, `edad`, `destino`, 
				`fechaDestino`, `refeContraref`, `servicioPabellon`, `fechaIngreso`, `fechaAlta`, `montoGalenos`, `montoSisfar`, `Observaciones`, `fechaRegistro`,
				`fechaUpdate`, `tipoRegistro`, `montoValAtencion`, `codPre`,dx1,`tpdx1`, `dx2`, `tpdx2`, `dx3`, `tpdx3`,`dx4`,`tpdx4`, `dx5`, `tpdx5`
				FROM `tbl_consultaExterna` WHERE `idEm`=:term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
				
					$datos[] =  $row['nroFua'];
					$datos[] =  $row['historiaClinica'];
					$datos[] =  $row['tipoDoc'];
					$datos[] =  $row['nroDoc'];
					$datos[] =  $row['seguro'];
					$datos[] =  $row['aseguradora'];
				    $datos[] =  $row['ubicacion'];
				    $datos[] =  $row['sexo'];
					$datos[] =  $row['cuenta'];
					$datos[] =  $row['nroAfiliacion'];
					$datos[] =  $row['eess'];
					$datos[] =  $row['nombres'];
					$datos[] =  $row['fechaNac'];
					$datos[] =  $row['ApePaterno'];
					$datos[] =  $row['ApeMaterno'];
				    $datos[] =  $row['teleFam'];
				    $datos[] =  $row['edad'];
					$datos[] =  $row['destino'];
					$datos[] =  $row['fechaDestino'];
					$datos[] =  $row['refeContraref'];
					$datos[] =  $row['servicioPabellon'];
					$datos[] =  $row['fechaIngreso'];
					$datos[] =  $row['fechaAlta'];
					$datos[] =  $row['montoGalenos'];
				    $datos[] =  $row['montoSisfar'];
				    $datos[] =  $row['Observaciones'];
					$datos[] =  $row['tipoRegistro'];
					$datos[] =  $row['montoValAtencion'];
					$datos[] =  $row['codPre'];
					$datos[] =  $row['dx1'];
					$datos[] =  $row['tpdx1'];
				
				    $datos[] =  $row['dx2'];
					$datos[] =  $row['tpdx2'];
					$datos[] =  $row['dx3'];
					$datos[] =  $row['tpdx3'];
					$datos[] =  $row['dx4'];
					$datos[] =  $row['tpdx4'];
					$datos[] =  $row['dx5'];
					$datos[] =  $row['tpdx5'];
					

				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="idprogramacionCirugia"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `idPro`,R.user as USX ,`idUser`, `especialidad`, `tipoDOc`, `nroDoc`, `paciente`, `edad`, `historia`, `celular`, `dx`, `tipoDx`, 
                `dxPrepa`, `tipoDxPrepa`, `procedQx`,A.Descripcion AS ANEST, `tipoAnestesia`,T.Descripcion AS TipoServici, `tipoCirugia`,S.Descripcion AS SERDX ,`servicioDx`,X.Nombre AS SALACI ,`salaCirugia`, 
                `fechaIntervencion`,C.Descripcion AS TURNO, `hora`, `cirugiaIndicadaPor`, `cirujanoPrincipal`, `anestesiologo`,O.descripcion AS SERVINT ,`servicioInterno`,
                U.Descripcion AS URPA, `nroCama`,D.Descripcion AS ESTCI, `estadoCirugia`, `fechaRegistro`, `fechaActualizada`,P.financiamiento  
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
                 WHERE `idPro`=:term ");
				$stmt->execute(array('term' => $_GET['id']));
				
        				while($row = $stmt->fetch()) {
        					
        				
        					$datos[] 	 = $row["idPro"];
                		    $datos[] 	 = strtoupper($row["ESTCI"]);
                		    $datos[] 	 = strtoupper($row["USX"]);
                		    $datos[] 	 = $row["especialidad"];
                		    $datos[] 	 = $row["tipoDOc"];
                		    $datos[] 	 = $row["nroDoc"];
                		    $datos[] 	 = $row["paciente"];
                		    $datos[] 	 = $row["edad"];
                		    $datos[] 	 = $row["historia"];
                		    $datos[] 	 = $row["celular"];
                		    $datos[] 	 = strtoupper($row["dx"]);
                		    $datos[] 	 = $row["tipoDx"];
                		    $datos[] 	 = strtoupper($row["dxPrepa"]);
                		    $datos[] 	 = $row["tipoDxPrepa"];
                		    $datos[] 	 = strtoupper($row["procedQx"]);
                		    $datos[] 	 = strtoupper($row["tipoAnestesia"]);
                		    $datos[] 	 = $row["tipoCirugia"];
                		    $datos[] 	 = strtoupper($row["servicioDx"]);
                		    $datos[] 	 = strtoupper($row["salaCirugia"]);
                		    $datos[]     = $row['fechaIntervencion'];
                		    $datos[] 	 = $row["hora"];
                		    $datos[]     = $row["cirugiaIndicadaPor"];
                		    $datos[]     = $row["cirujanoPrincipal"];
                		    $datos[] 	 = strtoupper($row["anestesiologo"]);
                		    $datos[] 	 = $row["servicioInterno"];
                		    $datos[] 	 = $row["nroCama"];
                		    $datos[] 	 = $row["estadoCirugia"];
                		    $datos[] 	 = $row["financiamiento"];
                		   
        				}
				

			    } catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
				
				
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="idReporteOperatorio"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `idRe`, `idPac`, `fechAhoraInicio`, `fechaHoraFin`, `descrReporOpe`, `compliQirurgica`, 
				`cirujanoPreo`, `anesteReporte`, `instrumentRepo`, `obserReporOpera`,muestraPatologica FROM `tbl_reporteOperatorio` WHERE `idPac`= :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					
					$datos[] 	 = $row["idPac"];
        		    $datos[] 	 = $row["fechAhoraInicio"];
        		    $datos[] 	 = $row["fechaHoraFin"];
        		    $datos[] 	 = strtoupper($row["descrReporOpe"]);
        		    $datos[] 	 = strtoupper($row["compliQirurgica"]);
        		    $datos[] 	 = strtoupper($row["cirujanoPreo"]);
        		    $datos[] 	 = strtoupper($row["anesteReporte"]);
        		    $datos[] 	 = strtoupper($row["instrumentRepo"]);
        		    $datos[] 	 = strtoupper($row["obserReporOpera"]);
        		    $datos[] 	 = strtoupper($row["muestraPatologica"]);
        		    

				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
	    else if($function=="idReporteOperatorioDat"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `paciente`,`tipoDOc`,`nroDoc`,`historia`,`edad`,(SELECT `nombre` FROM `financiamiento` WHERE `id` = P.financiamiento) AS FINA,
				(SELECT `Descripcion` FROM `EspecialidadesQX` WHERE `IdEspQx` =P.especialidad ) AS ESPE  FROM `tbl_programacionCirugias` AS P WHERE `idPro` = :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					
					$datos[] 	 = $row["paciente"];
					$tpos= '';
					if($row["tipoDOc"]==1){
					    $tpos= 'DNI:';
					}else 	if($row["tipoDOc"]==2){
					    $tpos= 'CARNET EXT:';
					}else 	if($row["tipoDOc"]==3){
					    $tpos= 'PASAPORTE:';
					}else 	if($row["tipoDOc"]==4){
					    $tpos= 'CODIGO UNICO DE IDENTIFICACION (CUI):';
					}else 	if($row["tipoDOc"]==5){
					    $tpos= 'DOC. IDENT. EXTRANJERA:';
					}else 	if($row["tipoDOc"]==6){
					    $tpos= 'SIN DOC:';
					}
					
					
        		    $datos[] 	 = $tpos;
        		    $datos[] 	 = $row["nroDoc"];
        		    $datos[] 	 = $row["historia"];
        		    $datos[] 	 = $row["edad"];
        		    $datos[] 	 = $row["FINA"];
        		    $datos[] 	 = $row["ESPE"];
        

				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="verReferencias"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `idUserSolRef`, `tipoDocRef`, `NroDocRef`, `paxRef`, `sexoRef`, `FechaNacRef`, `edadRef`, `iafasRef`, 
				`tipoSegRef`, `afiliaRef`, `caduciRef`, `domiRef`, `depaRef`, `provRef`, `disRef`, `actrasRef`, `tipoAccRef`, `lisDocs`, `ingresoReferido`, 
				`idEstabelRef`, `fechaIngresoRef`, `servicioOrigenRef`, `servDestRef`, `especialidadRef`, `motivoRef`, `condPcte`, `tipoTransRef`, `dispoTransRef`, 
				`tipoDocRefRes`, `NroDocRefRes`, `personalResRef`, `profesionRefRes`, `colegiaturaRef`, `tipoDocRefResAcompa`, `NroDocRefResAcompa`, `personalResRefAcompa`, 
				`profesionRefResAcompa`, `colegiaturaRefAcompa`, `fechaRegistro`, `fechaActualizacion` FROM `tbl_registroReferencias` WHERE `idRef`=:term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
				
					$datos[] =  $row['nroFua'];
					$datos[] =  $row['historiaClinica'];
					$datos[] =  $row['tipoDoc'];
					$datos[] =  $row['nroDoc'];
					$datos[] =  $row['seguro'];
					$datos[] =  $row['aseguradora'];
				    $datos[] =  $row['ubicacion'];
				    $datos[] =  $row['sexo'];
					$datos[] =  $row['cuenta'];
					$datos[] =  $row['nroAfiliacion'];
					$datos[] =  $row['eess'];
					$datos[] =  $row['nombres'];
					$datos[] =  $row['fechaNac'];
					
					

				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
			else if($function=="consultaGrupos"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `idGrupo`, `idUsuario`, `idAuditor`, `observacion`,namePaquete,fechaAsig,fechaRecep  FROM  `tbl_grupoCE` WHERE `idGrupo`= :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['idAuditor'];
					$datos[] =  $row['observacion'];
					$datos[] =  $row['namePaquete'];
					$datos[] =  $row['fechaAsig'];
					$datos[] =  $row['fechaRecep'];
				
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}

        else if($function=="consultaIdGrupo"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `idEm` FROM `tbl_consultaExterna` WHERE grupo = :term ORDER BY idEm DESC LIMIT 1  ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['idEm'];
				
				
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		else if($function=="consultaCuenta"){



			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `estado` FROM `paciente` WHERE `nroCuenta` = :term ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					 
					if($row['estado']!=""){
					    $datos[] =  $row['estado'];    
					}else{
					    $datos[] =  "NO";
					}
					
				
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		
		
		
		else if($function=="consultaIdGrupoMin"){


			$datos = array();

			try {
				
				$stmt = $conn->prepare("SELECT `idEm` FROM `tbl_consultaExterna` WHERE grupo = :term ORDER BY idEm ASC LIMIT 1  ");
				$stmt->execute(array('term' => $_GET['id']));
				
				while($row = $stmt->fetch()) {
					
					$datos[] =  $row['idEm'];
				
				
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}
		else if($function=="Med"){

			$datos = array();

			try {
				
				$stmt = $conn->prepare('SELECT `med_CodMed`, `med_Nombre`, `med_Costo` FROM `m_medicamento` WHERE med_CodMed = :term ' );
				$stmt->execute(array('term' => $_GET['codSisMx']));
				
				while($row = $stmt->fetch()) {
					$datos[] =  normaliza($row['med_Nombre']);
					$datos[] =  $row['med_Costo'];
				}

			} catch(PDOException $e) {
				echo 'ERROR: ' . $e->getMessage();
			}

			echo json_encode($datos);

		}


		else if($function=="autocie10"){


			if (isset($_GET['term'])){
							$datos = array();
		
							try {
								
								$stmt = $conn->prepare('SELECT `deno2`  FROM `sis_cpms` WHERE `deno2` LIKE :term GROUP BY deno2' );
								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
								
								while($row = $stmt->fetch()) {
									$datos[] =  $row['deno2'];
								}
		
							} catch(PDOException $e) {
								echo 'ERROR: ' . $e->getMessage();
							}
		
							echo json_encode($datos);
			}
		
		}
		
		
			else if($function=="medicoSolicitante"){


            			if (isset($_GET['term'])){
            							$datos = array();
            		
            							try {
            								
            								$stmt = $conn->prepare('SELECT `cmp`,`datos` FROM `tbl_medicoasistenciales` WHERE CONCAT_WS(" ",cmp,datos) LIKE :term' );
            								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
            								
            								while($row = $stmt->fetch()) {
            									$datos[] =  $row['cmp']." | ".$row['datos'];
            								}
            		
            							} catch(PDOException $e) {
            								echo 'ERROR: ' . $e->getMessage();
            							}
            		
            							echo json_encode($datos);
            			}
		
		    }
		    
		    
		    	else if($function=="codigoFor"){


            			if (isset($_GET['term'])){
            							$datos = array();
            		
            							try {
            								
            								$stmt = $conn->prepare('SELECT `codigo` FROM `tbl_ipress` WHERE `codigo` LIKE :term' );
            								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
            								
            								while($row = $stmt->fetch()) {
            									$datos[] =  $row['codigo'];
            								}
            		
            							} catch(PDOException $e) {
            								echo 'ERROR: ' . $e->getMessage();
            							}
            		
            							echo json_encode($datos);
            			}
		
		    }
		    
		    
		    
		    	else if($function=="eesS"){


            			if (isset($_GET['term'])){
            							$datos = array();
            		
            							try {
            								
            								$stmt = $conn->prepare('SELECT `nombre` FROM `tbl_ipress` WHERE `nombre` LIKE :term' );
            								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
            								
            								while($row = $stmt->fetch()) {
            									$datos[] =  $row['nombre'];
            								}
            		
            							} catch(PDOException $e) {
            								echo 'ERROR: ' . $e->getMessage();
            							}
            		
            							echo json_encode($datos);
            			}
		
		    }
		    
		    else if($function=="tejidoOrganMues"){

                        $cat = $_GET['cat'];
            			if (isset($_GET['term'])){
            							$datos = array();
            		
            							try {
            								
            								$stmt = $conn->prepare("SELECT descripcion FROM `tbl_tejidoOrganoExtraido` WHERE IdTipoEstudio='$cat' AND descripcion LIKE :term" );
            								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
            								
            								while($row = $stmt->fetch()) {
            									$datos[] =  $row['descripcion'];
            								}
            		
            							} catch(PDOException $e) {
            								echo 'ERROR: ' . $e->getMessage();
            							}
            		
            							echo json_encode($datos);
            			}
		
		    }
		    
		    
		    else if($function=="tejidoOrgan"){

                        $cat = $_GET['cat'];
            			if (isset($_GET['term'])){
            							$datos = array();
            		
            							try {
            								
            								$stmt = $conn->prepare("SELECT descripcion FROM `tbl_tejidoOrganoExtraido` WHERE IdCategoria='$cat' AND descripcion LIKE :term" );
            								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
            								
            								while($row = $stmt->fetch()) {
            									$datos[] =  $row['descripcion'];
            								}
            		
            							} catch(PDOException $e) {
            								echo 'ERROR: ' . $e->getMessage();
            							}
            		
            							echo json_encode($datos);
            			}
		
		    }
		    
		    
		    else if($function=="listCategoria"){


            			if (isset($_GET['term'])){
            							$datos = array();
            		
            							try {
            								
            								$stmt = $conn->prepare('SELECT `Descripcion`, `IdTipoEstudio` FROM `CategoriaMuestra` WHERE Descripcion LIKE  :term' );
            								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
            								
            								while($row = $stmt->fetch()) {
            									$datos[] =  $row['Descripcion'];
            								}
            		
            							} catch(PDOException $e) {
            								echo 'ERROR: ' . $e->getMessage();
            							}
            		
            							echo json_encode($datos);
            			}
		
		    }
		    
		
		
		
		
			else if($function=="listIpress"){


        			if (isset($_GET['term'])){
        							$datos = array();
        		
        							try {
        								
        								$stmt = $conn->prepare('SELECT codigo,`nombre` FROM `tbl_ipress` WHERE CONCAT_WS(" ",codigo,nombre) LIKE :term ' );
        								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
        								
        								while($row = $stmt->fetch()) {
        									$datos[] =  $row['codigo']." | ".$row['nombre'];
        								
        								}
        		
        							} catch(PDOException $e) {
        								echo 'ERROR: ' . $e->getMessage();
        							}
        		
        							echo json_encode($datos);
        			}
        		
		    }
		    
		    
		    else if($function=="dxDesc"){


        			if (isset($_GET['term'])){
        							$datos = array();
        		
        							try {
        								
        								$stmt = $conn->prepare('SELECT `codigo`,`descripcion` FROM `diagnosticos` WHERE CONCAT_WS(" ",codigo,descripcion) LIKE :term ' );
        								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
        								
        								while($row = $stmt->fetch()) {
        									$datos[] =  $row['codigo']." | ".$row['descripcion'];
        								
        								}
        		
        							} catch(PDOException $e) {
        								echo 'ERROR: ' . $e->getMessage();
        							}
        		
        							echo json_encode($datos);
        			}
        		
		    }
		    
		    else if($function=="listRsatencion"){


        			if (isset($_GET['term'])){
        							$datos = array();
        		
        							try {
        								
        								$stmt = $conn->prepare('SELECT `id`, `datos`, `dni`, `cmp`, `rne`, `especialidad` FROM `tbl_medicoasistenciales` WHERE CONCAT_WS(" ",cmp,datos) LIKE :term ' );
        								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
        								
        								while($row = $stmt->fetch()) {
        									$datos[] =  $row['cmp'].' | '.$row['datos'];
        								
        								}
        		
        							} catch(PDOException $e) {
        								echo 'ERROR: ' . $e->getMessage();
        							}
        		
        							echo json_encode($datos);
        			}
        		
		    }
		
		
		else if($function=="listSerEspecia"){


        			if (isset($_GET['term'])){
        							$datos = array();
        		
        							try {
        								
        								$stmt = $conn->prepare('SELECT `descripcion` FROM `tbl_serviciosCE` WHERE `descripcion` LIKE :term ' );
        								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
        								
        								while($row = $stmt->fetch()) {
        									$datos[] =  strtoupper(normaliza($row['descripcion']));
        								
        								}
        		
        							} catch(PDOException $e) {
        								echo 'ERROR: ' . $e->getMessage();
        							}
        		
        							echo json_encode($datos);
        			}
        		
		    }
		
		else if($function=="listRegistraAlta"){


			if (isset($_GET['term'])){
							$datos = array();
		
							try {
								
								$stmt = $conn->prepare('SELECT `id`, `nom` FROM `usuarios` WHERE `permisos`=4 AND  nom LIKE :term ' );
								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
								
								while($row = $stmt->fetch()) {
									$datos[] =  strtoupper($row['nom']);
								
								}
		
							} catch(PDOException $e) {
								echo 'ERROR: ' . $e->getMessage();
							}
		
							echo json_encode($datos);
			}
		
		}
		
		
		 else if($function=="busquedaDx"){
        
        
        			$datos = array();

                    	try {
                    		//$stmt = $conn->prepare('SELECT `codigo`,`descripcion`,COUNT(*) AS TIPO,tipo AS TBL FROM `diagnosticos` WHERE CONCAT_WS(" ",codigo,descripcion)  LIKE :term' );
                    		$stmt = $conn->prepare('SELECT `codigo`,`descripcion`,tipo AS TBL FROM `diagnosticos` WHERE CONCAT_WS(" ",codigo,descripcion)  LIKE :term' );
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		while($row = $stmt->fetch()) {
                    		    if($row['codigo']!=""){
                    		        $datos[] =  trim($row['TBL'])." - ".$row['codigo']." - ".$row['descripcion'];
                    		    }
                    	
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                    
                    	echo json_encode($datos);
                    
                    	//

        		
        		}
        		
        		
		 else if($function=="cirugiaIndicaPor"){


			$datos = array();

            	try {
            		
            		$stmt = $conn->prepare('SELECT `datos`, `cmp`, `rne`, `especialidad` FROM `tbl_medicoasistenciales` WHERE IdEspecialidad IN(3,4) AND `datos` LIKE :term ORDER BY datos ASC ' );
            		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
            		while($row = $stmt->fetch()) {
            		
            		         $datos[] =  $row['datos']." |CMP:".$row['cmp']." |RNE:".$row['rne']." |ESPECIALIDAD:".$row['especialidad'];
            	
            		}
            
            	} catch(PDOException $e) {
            		echo 'ERROR: ' . $e->getMessage();
            	}
            
            	echo json_encode($datos);
            
		}
		
		
		 else if($function=="cirugiaIndicaPorAll"){


			$datos = array();

            	try {
            		
            		$stmt = $conn->prepare('SELECT `datos`, `cmp`, `rne`, `especialidad` FROM `tbl_medicoasistenciales` WHERE `datos` LIKE :term ORDER BY datos ASC ' );
            		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
            		while($row = $stmt->fetch()) {
            		
            		        $datos[] =  $row['datos']." |CMP:".$row['cmp']." |RNE:".$row['rne']." |ESPECIALIDAD:".$row['especialidad'];
            	
            		}
            
            	} catch(PDOException $e) {
            		echo 'ERROR: ' . $e->getMessage();
            	}
            
            	echo json_encode($datos);
            
		}
        		
        else if($function=="verListbusquedaDx"){
        
        
        			$datos = array();

                    	try {
                    		//$stmt = $conn->prepare('SELECT `codigo`,`descripcion`,COUNT(*) AS TIPO,tipo AS TBL FROM `diagnosticos` WHERE CONCAT_WS(" ",codigo,descripcion)  LIKE :term' );
                    		$stmt = $conn->prepare('SELECT `codigo`,`descripcion`,tipo AS TBL FROM `diagnosticos` WHERE CONCAT_WS(" ",codigo,descripcion)  LIKE :term' );
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		while($row = $stmt->fetch()) {
                    		    if($row['codigo']!=""){
                    		        $datos[] =  $row['codigo']." - ".$row['descripcion'];
                    		    }
                    	
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                    
                    	echo json_encode($datos);
                    
                    	//

        		} 
        		
        		
        else if($function=="verListbusquedaTrat"){
        
        
        			$datos = array();

                    	try {
                    	
                    		$stmt = $conn->prepare('SELECT `Id`, `CodSISMED`, `DescripSISMED`, `Concent`, `Presentacion`, `FormaFarm` FROM `FarmSISMED` 
                    		WHERE CONCAT_WS(" ",CodSISMED,DescripSISMED)  LIKE :term' );
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		while($row = $stmt->fetch()) {
                    		    if($row['CodSISMED']!=""){
                    		        $datos[] =  $row['CodSISMED']." - ".$row['DescripSISMED']." - ".$row['Concent']." - ".$row['Presentacion']." - ".$row['FormaFarm'];
                    		    }
                    	
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                    
                    	echo json_encode($datos);
                    
                    	//

        		
        		} 
        		
        		
        		else if($function=="verListbusquedaProced"){
        
        
        			$datos = array();

                    	try {
                    		
                    		$stmt = $conn->prepare('SELECT `CODIGO_CPMS`,`deno2` FROM `sis_cpms` WHERE CONCAT_WS(" ",CODIGO_CPMS,deno2)  LIKE :term' );
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		while($row = $stmt->fetch()) {
                    		    if($row['CODIGO_CPMS']!=""){
                    		        $datos[] =  $row['CODIGO_CPMS']." - ".$row['deno2'];
                    		    }
                    	
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                   
                    	echo json_encode($datos);
                    	
        		} 

				else if($function=="cptCitoEs"){
        
        
        			$datos = array();

                    	try {
                    		
                    		$stmt = $conn->prepare('SELECT cod_dx FROM dx_morfologicos   WHERE cod_dx LIKE :term' );
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		while($row = $stmt->fetch()) {
                    		
                    		    $datos[] =  $row['cod_dx'];
                    	
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                   
                    	echo json_encode($datos);
                    	
        		} 
				else if($function=="cptCitoEsDescripcion"){
        
        
        			$datos = array();

                    	try {
                    		
                    		$stmt = $conn->prepare('SELECT descripcion FROM dx_morfologicos   WHERE descripcion LIKE :term' );
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		while($row = $stmt->fetch()) {
                    		
                    		    $datos[] =  $row['descripcion'];
                    	
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                   
                    	echo json_encode($datos);
                    	
        		} 
        		
        		
        		else if($function=="verMedicCitologia"){
        
        
        			$datos = array();

                    	try {
                    		
                    		$stmt = $conn->prepare('SELECT `datos` FROM `tbl_medicoasistenciales` WHERE `datos` LIKE :term' );
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		while($row = $stmt->fetch()) {
                    		    
                    		        $datos[] =  $row['datos'];
                    	
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                   
                    	echo json_encode($datos);
                    	
        		} 
        		
        		
        		else if($function=="verListIpress"){
        
        
        			$datos = array();

                    	try {
                    		
                    		$stmt = $conn->prepare('SELECT `nombre` FROM `tbl_ipress` WHERE `nombre`  LIKE :term' );
                    		
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		while($row = $stmt->fetch()) {
                    		    
                    		        $datos[] =  $row['nombre'];
    
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                   
                    	echo json_encode($datos);
                    	
        		} 
        		
        		
        		else if($function=="verListbusquedaMarcad"){
        
                    $cat =  $_GET['cat'];
        			$datos = array();

                    	try {
                    		
                    		$stmt = $conn->prepare("SELECT `Descripcion` FROM `MarcadoresIHQ` WHERE IdTipoEstudio ='$cat' AND `Descripcion` LIKE :term" );
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		while($row = $stmt->fetch()) {
                    		   
                    		        $datos[] =  $row['Descripcion'];
                    		    
                    	
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                    
                    	echo json_encode($datos);
                    
                    	//

        		
        		} 
        		
        		
        	  else if($function=="verListSignosSintomas"){
        
        
        			$datos = array();

                    	try {
                    		
                    		$stmt = $conn->prepare('SELECT `IdSigSint`, `IdPrioridad`, `Descripcion` FROM `SignosSintomas` WHERE Descripcion LIKE :term' );
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		while($row = $stmt->fetch()) {
                    		   
                    		        $datos[] =  $row['Descripcion'];
                    		    
                    	
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                    
                    	echo json_encode($datos);
                    
        		}
        		
        		 else if($function=="buscarUserDigi"){
        
        
        			$datos = array();

                    	try {
                    		
                    		$stmt = $conn->prepare('SELECT nom FROM `usuarios` WHERE `ofAreUnidad` IN (21,22) AND `nom` LIKE :term' );
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		while($row = $stmt->fetch()) {
                    		   
                    		        $datos[] =  $row['nom'];
                    		   
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                    
                    	echo json_encode($datos);
                    
        		}
        		
        		else if($function=="buscarUserDigiRes"){
        
                    $id =  $_GET['id'];
        			$datos = array();

                    	try {
                    		
                    		$stmt = $conn->prepare('SELECT cmp FROM `usuarios` WHERE `ofAreUnidad` IN (21,22) AND `nom` LIKE :term' );
                    		$stmt->execute(array('term' => '%'.$id.'%'));
                    		while($row = $stmt->fetch()) {
                    		   
                    		        $datos[] =  $row['cmp'];
                    		   
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                    
                    	echo json_encode($datos);
                    
        		}
        	
        			else if($function=="buscarUserDigiResCitologia"){
        
                    $id =  $_GET['id'];
        			$datos = array();

                    	try {
                    		
                    		$stmt = $conn->prepare('SELECT `especialidad` FROM `tbl_medicoasistenciales` WHERE `datos` LIKE :term' );
                    		$stmt->execute(array('term' => '%'.$id.'%'));
                    		while($row = $stmt->fetch()) {

                    		        $datos[] =  $row['especialidad'];
                    		   
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                    
                    	echo json_encode($datos);
                    
        		}
        		
        		else if($function=="listMedicoSolcit"){
        
        
        			$datos = array();

                    	try {
                    		
                    		$stmt = $conn->prepare('SELECT `datos` FROM `tbl_medicoasistenciales` WHERE `datos` LIKE :term' );
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		while($row = $stmt->fetch()) {
                    		   
                    		        $datos[] =  $row['datos'];
                    		    
                    	
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                    
                    	echo json_encode($datos);
                    
        		} 


            /*else if($function=="busquedaDx"){
        
        
        			$datos = array();

                    	try {
                    		
                    		$stmt = $conn->prepare('SELECT `codigo`,`descripcion`,COUNT(*) AS TIPO,"DX" AS TBL FROM `diagnosticos` WHERE CONCAT_WS(" ",codigo,descripcion)  LIKE :term 
                            UNION SELECT  `codigo`,`descripcion`,COUNT(*) AS TIPO,"LERH" AS TBL FROM `dx_erh` WHERE CONCAT_WS(" ",codigo,descripcion)  LIKE :term 
                            UNION SELECT  `codigo`,`descripcion`,COUNT(*) AS TIPO,"FISSAL" AS TBL FROM `dx_fissal` WHERE CONCAT_WS(" ",codigo,descripcion)  LIKE :term ' );
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		while($row = $stmt->fetch()) {
                    		    if($row['codigo']!=""){
                    		        $datos[] =  $row['TBL']." | ".$row['codigo']." - ".$row['descripcion'];
                    		    }
                    	
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                    
                    	echo json_encode($datos);
                    
                    	//

        		
        		} */


        /*	else if($function=="busquedaDx"){
        
        
        			$datos = array();

                    	try {
                    		
                    		$stmt = $conn->prepare('SELECT  `codigo`,`descripcion` FROM `diagnosticos` WHERE CONCAT_WS(" ",codigo,descripcion)  LIKE :term ' );
                    		$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
                    		
                    		while($row = $stmt->fetch()) {
                    			$datos[] =  normaliza($row['codigo']." - ".$row['descripcion']);
                    		}
                    
                    	} catch(PDOException $e) {
                    		echo 'ERROR: ' . $e->getMessage();
                    	}
                    
                    	echo json_encode($datos);
                    
                    	//

        		
        		} 
*/

		else if($function=="dxdes"){


			if (isset($_GET['term'])){
							$datos = array();
		
							try {
								
								$stmt = $conn->prepare('SELECT `C10_Descripcion` FROM `m_cie10` 
								WHERE `C10_Descripcion` LIKE :term GROUP BY C10_Descripcion' );
								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
								
								while($row = $stmt->fetch()) {
									$datos[] =  $row['C10_Descripcion'];
									//$datos[] =  $row['CodCpt'];
								
								}
		
							} catch(PDOException $e) {
								echo 'ERROR: ' . $e->getMessage();
							}
		
							echo json_encode($datos);
			}
		
		}

		else if($function=="dxdesTe"){


			if (isset($_GET['term'])){
							$datos = array();
		
							try {
								
								$stmt = $conn->prepare('SELECT C10_CodDia,`C10_Descripcion` FROM `m_cie10` 
								WHERE `C10_Descripcion` LIKE :term GROUP BY C10_Descripcion' );
								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
								
								while($row = $stmt->fetch()) {

									$Dat0 = $row['C10_CodDia'];
									$cat = strlen($Dat0);
                                    if($cat>3){
                                        $Dat0 = substr($Dat0, 0, strlen($Dat0) - 1) . '.' . substr($Dat0, -1) ;
                                    }
									$datos[] =  $Dat0;
									//$datos[] =  $row['CodCpt'];
								
								}
		
							} catch(PDOException $e) {
								echo 'ERROR: ' . $e->getMessage();
							}
		
							echo json_encode($datos);
			}
		
		}

		else if($function=="consultorio"){


			if (isset($_GET['term'])){
							$datos = array();
		
							try {
								
								$stmt = $conn->prepare('SELECT `nombre` FROM `consultorios` 
								WHERE `nombre` LIKE :term ' );
								$stmt->execute(array('term' => '%'.$_GET['term'].'%'));
								
								while($row = $stmt->fetch()) {
									$datos[] =  $row['nombre'];								
								}
		
							} catch(PDOException $e) {
								echo 'ERROR: ' . $e->getMessage();
							}
		
							echo json_encode($datos);
			}
		
		}

?>