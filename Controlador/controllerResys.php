<?php 

/******************PRODUCCION  BASE DATOS GALENODX***************************** */

function ObtenerConexion()
{
	$DB_DSN='sqlsrv:Server=202.15.1.50;Database=SIGH';
	$DB_USER='nrodriguezh';
	$DB_PASSWORD='Hn@l20240ct';
	$resultado=false;
	$mensaje='';
	$conn=null;
	try {
		$conn = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD);
		$resultado=true;
	} catch (Exception $e) {
		$mensaje=$e->getMessage();
	}
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"conn"=>$conn];
}

/** ******************************************** */


/******************** CONEXION  ABASE DE DATOS PRODUCCION MYSQL  */

function ObtenerConexionMySQL()
{
	$DB_DSN='mysql:202.15.1.45;dbname=segurosm_hnal';
	$DB_USER='uaplicativo';
	$DB_PASSWORD='Hnal2019.';
	$resultado=false;
	$mensaje='';
	$conn=null;
	try {
		$conn = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD);
		$resultado=true;
	} catch (Exception $e) {
		$mensaje=$e->getMessage();
	}
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"conn"=>$conn];
}
	

/********************************************************************* */

/******************CONEXION BASE GALENOSX  PRUEBA 128***************************** */
/*
function ObtenerConexion()
{
	$DB_DSN='sqlsrv:Server=192.168.36.128;Database=SIGH';
	$DB_USER='sa';
	$DB_PASSWORD='123456';
	$resultado=false;
	$mensaje='';
	$conn=null;
	try {
		$conn = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD);
		$resultado=true;
	} catch (Exception $e) {
		$mensaje=$e->getMessage();
	}
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"conn"=>$conn];
}
/**************************************** */



/****************** CONEXION BASE LOCAL MYSQL PRUEBA*************** */
/*
function ObtenerConexionMySQL()
{
	$DB_DSN='mysql:host=localhost;dbname=segurosm_hnal';
	$DB_USER='root';
	$DB_PASSWORD='123';
	$resultado=false;
	$mensaje='';
	$conn=null;
	try {
		$conn = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD);
		$resultado=true;
	} catch (Exception $e) {
		$mensaje=$e->getMessage();
	}
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"conn"=>$conn];
}

/************************************************** */

function ObtenerDatosCuenta($IdCuentaAtencion)
{
	$resultado=false;
	$mensaje='';
	$datos=null;
	$ObtenerConexion=ObtenerConexion();
	if($ObtenerConexion['resultado'])
	{
		$conn=$ObtenerConexion['conn'];
		$getReviews = $conn->prepare("SELECT  
										ap.IdCuentaAtencion AS CuentaPadre,
										ap.IdServicioIngreso AS IdServicioPadre,
										sp.Nombre AS NombreServicioPadre, 
										ah.IdCuentaAtencion,
										ah.IdServicioIngreso,  
										ah.IdAtencion, 
										ISNULL(Pacientes.ApellidoPaterno,'') as ApellidoPaterno , 
										ISNULL(Pacientes.ApellidoMaterno,'') as  ApellidoMaterno, 
										ISNULL(Pacientes.SegundoNombre,'') as SegundoNombre,
										ISNULL(Pacientes.PrimerNombre,'') as PrimerNombre , 
										Pacientes.IdDocIdentidad, 
										TiposDocIdentidad.Descripcion AS TipoDocumento, 
										Pacientes.NroDocumento,
										Pacientes.Telefono, 
										Pacientes.IdTipoSexo ,
										Pacientes.NroHistoriaClinica,
										ah.Edad, 
										ah.idFuenteFinanciamiento, 
										FuentesFinanciamiento.Descripcion AS FuenteFinanciamiento, 
										ah.IdServicioEgreso, 
										Servicios.Nombre AS Servicio, 
										Servicios.IdTipoServicio, 
										TiposServicio.Descripcion AS TipoServicio, 
										Servicios.codCompatible
									FROM 
										Atenciones AS ah 
										LEFT JOIN Atenciones AS ap ON ah.IDCuentaAtencionVinculado = ap.IdCuentaAtencion 
										LEFT JOIN Servicios AS sp ON ap.IdServicioIngreso = sp.IdServicio 
										LEFT JOIN Pacientes ON ah.IdPaciente = Pacientes.IdPaciente 
										LEFT JOIN Servicios ON ah.IdServicioIngreso = Servicios.IdServicio 
										LEFT JOIN FuentesFinanciamiento ON ah.idFuenteFinanciamiento = FuentesFinanciamiento.IdFuenteFinanciamiento 
										LEFT JOIN TiposServicio ON Servicios.IdTipoServicio = TiposServicio.IdTipoServicio 
										LEFT JOIN TiposDocIdentidad ON Pacientes.IdDocIdentidad = TiposDocIdentidad.IdDocIdentidad
									WHERE 
										ah.IdCuentaAtencion = ?
									ORDER BY 
										ah.FechaIngreso DESC;");
		if($getReviews->execute([$IdCuentaAtencion]))
		{
			$filas=$getReviews->fetchAll(PDO::FETCH_ASSOC);
			if(count($filas)>0)
			{
				$datos=$filas[0];
				$resultado=true;
			}
			else
				$mensaje='No se encontro Datos para ese IdCuentaAtencion';
		}
		else
			$mensaje=$getReviews->errorInfo()[2];
	}
	else
		$mensaje=$ObtenerConexion['mensaje'];
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];
}
function ObtenerDatosCuentaXReceta($nroSerie,$NroDocumento){
	

	$resultado=false;
	$mensaje='';
	$datos=null;
	// var_dump($nroSerie,$NroDocumento);
	// exit();
	$ObtenerConexion=ObtenerConexion();
	if($ObtenerConexion['resultado'])
	{
		$conn=$ObtenerConexion['conn'];
		$getReviews = $conn->prepare("SELECT TOP 1  ah.IdCuentaAtencion,ah.IdServicioIngreso, FactOrdenServicio.IdOrden,FacturacionServicioDespacho.IdProducto,FacturacionServicioDespacho.Cantidad,
				fcs.Codigo as CodigoProd,fcs.Nombre as NombreProd,ah.IdAtencion,
				ISNULL(Pacientes.ApellidoPaterno,'') AS ApellidoPaterno,
				ISNULL(Pacientes.ApellidoMaterno,'') AS ApellidoMaterno,
				ISNULL(Pacientes.PrimerNombre,'') AS PrimerNombre,
				ISNULL(Pacientes.SegundoNombre,'')AS SegundoNombre,
				Pacientes.IdDocIdentidad, TiposDocIdentidad.Descripcion AS TipoDocumento, Pacientes.NroDocumento, 
				Pacientes.Telefono, Pacientes.NroHistoriaClinica,ah.Edad, ah.idFuenteFinanciamiento, CASE Pacientes.IdTipoSexo WHEN 1 THEN 'M' ELSE 'F' END AS Sexo,FuentesFinanciamiento.Descripcion AS FuenteFinanciamiento, ah.IdServicioEgreso, Servicios.Nombre AS Servicio, 
			 Servicios.IdTipoServicio,TiposServicio.Descripcion AS TipoServicio, Servicios.codCompatible,
			 (  COALESCE(emp.ApellidoPaterno, '') + ' ' + COALESCE(emp.ApellidoMaterno, '')+' '+ COALESCE(emp.Nombres, '')) AS MediOrdena,
					med.IdMedico as IdMediOrdena /*mes.IdEspecialidad as IdEspMedOrdena,UPPER(esp.Nombre) as EspecialidadMediProviene*/
		FROM Atenciones	 as ah LEFT JOIN 
						FactOrdenServicio on ah.IdCuentaAtencion =  FactOrdenServicio.IdCuentaAtencion LEFT JOIN 
						FacturacionServicioDespacho ON FactOrdenServicio.IdOrden=FacturacionServicioDespacho.idOrden LEFT JOIN 
						FactCatalogoServicios as fcs ON FacturacionServicioDespacho.IdProducto=fcs.IdProducto LEFT JOIN
						 Medicos as med ON ah.IdMedicoIngreso = med.IdMedico LEFT JOIN 
						 --MedicosEspecialidad as mes ON med.IdMedico=mes.IdMedico LEFT JOIN 
						 Empleados as emp ON med.IdEmpleado = emp.IdEmpleado LEFT JOIN 
						 --Especialidades as esp ON mes.IdEspecialidad=esp.IdEspecialidad LEFT JOIN 
						 FactOrdenServicioPagos ON FactOrdenServicio.IdOrden = FactOrdenServicioPagos.idOrden LEFT JOIN
						CajaComprobantesPago on FactOrdenServicioPagos.idComprobantePago = CajaComprobantesPago.IdComprobantePago LEFT JOIN 
						
						 Pacientes ON ah.IdPaciente = Pacientes.IdPaciente LEFT JOIN 
                         Servicios ON ah.IdServicioIngreso = Servicios.IdServicio LEFT JOIN 
                         FuentesFinanciamiento ON ah.idFuenteFinanciamiento = FuentesFinanciamiento.IdFuenteFinanciamiento LEFT JOIN 
                         TiposServicio ON Servicios.IdTipoServicio = TiposServicio.IdTipoServicio LEFT JOIN 
                         TiposDocIdentidad ON Pacientes.IdDocIdentidad = TiposDocIdentidad.IdDocIdentidad


	WHERE (CajaComprobantesPago.NroSerie = ? 
       AND CajaComprobantesPago.NroDocumento = ?
       AND CajaComprobantesPago.IdEstadoComprobante = '4'
      
)
 ");
		if($getReviews->execute([$nroSerie,$NroDocumento]))
		{
			$filas=$getReviews->fetchAll(PDO::FETCH_ASSOC);
			
			if(count($filas)>0)
			{
				$datos=$filas;
				$resultado=true;
			}
			else
				$mensaje='No se encontro Datos para esa Receta';
		}
		else
			$mensaje=$getReviews->errorInfo()[2];
	}
	else
		$mensaje=$ObtenerConexion['mensaje'];
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];

}
function ObtenerDatosxOrdenReceta($NroOrdenReceta){
	

	$resultado=false;
	$mensaje='';
	$datos=null;
	$ObtenerConexion=ObtenerConexion();
	if($ObtenerConexion['resultado'])
	{
		$conn=$ObtenerConexion['conn'];
		$getReviews = $conn->prepare("SELECT  
											RecetaCabecera.idReceta,
										RecetaCabecera.IdPuntoCarga,
										RecetaCabecera.idCuentaAtencion,
										RecetaCabecera.idServicioReceta,
										RecetaCabecera.idEstado,
										RecetaCabecera.idMedicoReceta,
										RecetaCabecera.IdMedicoAuditor,
										RecetaDetalle.idItem,
										RecetaDetalle.CantidadPedida as Cantidad,
										FactCatalogoServicios.IdProducto,
										FactCatalogoServicios.Codigo as CodigoProd,
										FactCatalogoServicios.Nombre as NombreProd,
										ISNULL(Pacientes.ApellidoPaterno,'') AS ApellidoPaterno,
										ISNULL(Pacientes.ApellidoMaterno,'') AS ApellidoMaterno,
										ISNULL(Pacientes.PrimerNombre,'') AS PrimerNombre,
										ISNULL(Pacientes.SegundoNombre,'')AS SegundoNombre,
										Pacientes.IdDocIdentidad,
										TiposDocIdentidad.Descripcion AS TipoDocumento,
										Pacientes.NroDocumento, 
										Pacientes.Telefono,
										Pacientes.NroHistoriaClinica,
										ah.Edad, 
										ah.idFuenteFinanciamiento,
										CASE Pacientes.IdTipoSexo WHEN 1 THEN 'M' ELSE 'F' END AS Sexo,
										FuentesFinanciamiento.Descripcion AS FuenteFinanciamiento,
										ah.IdServicioEgreso,
										Servicios.Nombre AS Servicio, 
										Servicios.IdTipoServicio,
										TiposServicio.Descripcion AS TipoServicio,
										Servicios.codCompatible
										
									FROM 
									  RecetaCabecera INNER JOIN
											RecetaDetalle ON RecetaCabecera.idReceta = RecetaDetalle.idReceta INNER JOIN
											FactCatalogoServicios ON RecetaDetalle.idItem=FactCatalogoServicios.IdProducto  LEFT JOIN
											Atenciones  AS ah ON RecetaCabecera.idCuentaAtencion = ah.IdCuentaAtencion LEFT JOIN
											Pacientes ON ah.IdPaciente = Pacientes.IdPaciente LEFT JOIN
											FuentesFinanciamiento ON ah.idFuenteFinanciamiento = FuentesFinanciamiento.IdFuenteFinanciamiento LEFT JOIN 
											Servicios ON ah.IdServicioIngreso = Servicios.IdServicio LEFT JOIN 
											TiposServicio ON Servicios.IdTipoServicio = TiposServicio.IdTipoServicio LEFT JOIN 
											TiposDocIdentidad ON Pacientes.IdDocIdentidad = TiposDocIdentidad.IdDocIdentidad 
									WHERE 
										( RecetaCabecera.idReceta = ?)");
		if($getReviews->execute([$NroOrdenReceta]))
		{
			$filas=$getReviews->fetchAll(PDO::FETCH_ASSOC);
			
			if(count($filas)>0)
			{
				$datos=$filas;
				$resultado=true;
			}
			else
				$mensaje='No se encontro Datos para esta Orden';
		}
		else
			$mensaje=$getReviews->errorInfo()[2];
	}
	else
		$mensaje=$ObtenerConexion['mensaje'];
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];

}
function resys_elimina_registroAP_enGalenos($elemmentos)
{
	$resultado=false;
	$mensaje='';
	$datos=null;
	try{
		$ObtenerConexion=ObtenerConexion();
		if($ObtenerConexion['resultado'])
		{
			$resultado_p='';
			$mensaje_p='';
			$IdMovimiento_p='';
			$IdOrdenMovimiento_p='';
			$tsql = "exec resys_elimina_registroAP_enGalenos ?,?,?,?";
			$getReviews =$ObtenerConexion['conn']->prepare($tsql);
			$getReviews->bindValue(1,$elemmentos["IdCuentaAtencion"],PDO::PARAM_STR);
			$getReviews->bindValue(2,$elemmentos["IdNumMovimiento"],PDO::PARAM_STR);
			$getReviews->bindParam(3,$resultado_p,PDO::PARAM_STR,1);
			$getReviews->bindParam(4,$mensaje_p,PDO::PARAM_STR,200);
			if($getReviews->execute())
			{
				if($resultado_p==1)
				{
					
					$resultado = true;
				}
				else
					$mensaje=$mensaje_p;
			}
			else
				$mensaje=$getReviews->errorInfo()[2];
		}
		else
			$mensaje=$ObtenerConexion['mensaje'];
	} catch(Exception $e){
		$mensaje=$e->getMessage();
	}
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];
}
function validarPagosPendientes($IdCuentaAtencion,$IdNumeroMovimiento){
	

	$resultado=false;
	$mensaje='';
	$datos=null;
	$ObtenerConexion=ObtenerConexion();
	if($ObtenerConexion['resultado'])
	{
		$conn=$ObtenerConexion['conn'];
		$getReviews = $conn->prepare("Select
		 			LabMovimientoLaboratorio.IdMovimiento
					,LabMovimientoLaboratorio.IdOrden
					,LabMovimientoLaboratorio.IdCuentaAtencion 
					,FactOrdenServicioPagos.idOrdenPago
					,CajaComprobantesPago.IdComprobantePago
			From LabMovimientoLaboratorio  LEFT JOIN
					FactOrdenServicio ON LabMovimientoLaboratorio.IdOrden=FactOrdenServicio.IdOrden LEFT JOIN
					FactOrdenServicioPagos ON  FactOrdenServicio.IdOrden = FactOrdenServicioPagos.idOrden LEFT JOIN
					CajaComprobantesPago ON  LabMovimientoLaboratorio.IdCuentaAtencion = CajaComprobantesPago.IdCuentaAtencion
		WHERE (LabMovimientoLaboratorio.IdCuentaAtencion =? and LabMovimientoLaboratorio.IdMovimiento=?)");
		if($getReviews->execute([$IdCuentaAtencion,$IdNumeroMovimiento]))
		{
			$filas=$getReviews->fetchAll(PDO::FETCH_ASSOC);
			
			if(count($filas)>0)
			{
				$datos=$filas;
				$resultado=true;
			}
			else
				$mensaje='No se encontro Datos para este Movimiento';
		}
		else
			$mensaje=$getReviews->errorInfo()[2];
	}
	else
		$mensaje=$ObtenerConexion['mensaje'];
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];

}
function buscarDatosMedicoVinculado($IdEmpleado){
	

	$resultado=false;
	$mensaje='';
	$datos=null;
	$ObtenerConexion=ObtenerConexion();
	if($ObtenerConexion['resultado'])
	{
		$conn=$ObtenerConexion['conn'];
		$getReviews = $conn->prepare("Select Medicos.IdMedico from Empleados INNER JOIN
            	 Medicos on Empleados.IdEmpleado=Medicos.IdEmpleado
			Where Empleados.IdEmpleado = ?");
		if($getReviews->execute([$IdEmpleado]))
		{
			$filas=$getReviews->fetchAll(PDO::FETCH_ASSOC);
			
			if(count($filas)>0)
			{
				$datos=$filas[0];
				$resultado=true;
			}
			else
				$mensaje='No se encontro Datos para IdEmpleado';
		}
		else
			$mensaje=$getReviews->errorInfo()[2];
	}
	else
		$mensaje=$ObtenerConexion['mensaje'];
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];

}


function LeerPagina($url,$tipo,$PostFields,$HttpHeader,$agent='')
{
	$curl=curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL =>$url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST =>$tipo,
	  CURLOPT_HEADER=>1,
	  CURLOPT_SSL_VERIFYPEER=>false
	));
	if($agent!="")curl_setopt($curl, CURLOPT_USERAGENT, $agent);
	if($tipo=='POST'&&count($PostFields)>0) curl_setopt($curl,CURLOPT_POSTFIELDS,http_build_query($PostFields));
	if(count($HttpHeader)>0)curl_setopt($curl,CURLOPT_HTTPHEADER,$HttpHeader);		
	$response =mb_convert_encoding(curl_exec($curl), "UTF-8", "Windows-1252");
	$header_size = curl_getinfo($curl,CURLINFO_HEADER_SIZE);
	$header= substr($response, 0, $header_size);
	$body=substr($response, $header_size);
	curl_close($curl);
	return [$header,$body];
}
	
function BuscarCSRF($body,$nombre,$CaracteresSumar,$CaracterFin)
{
	$pos=strpos($body,$nombre);
	if($pos===false)$pos=0;
	$primeraparte=substr($body,$pos+strlen($nombre)+$CaracteresSumar,strlen($body));			
	$csrfmiddlewaretoken=substr($primeraparte,0,strpos($primeraparte,$CaracterFin)!==false?strpos($primeraparte,$CaracterFin):strlen($primeraparte));
	return $csrfmiddlewaretoken;
}

function ObtieneSesionLoayza($url,$usuario,$clave)
{
	$resultado=false;
	$mensaje='';
	$pagina=null;
	$LeerPagina=LeerPagina($url,'GET',[],[]);
	if(count($LeerPagina)==2)
	{
		$_token=BuscarCSRF($LeerPagina[1],'_token',9,'"');
		if(strlen($_token)>0)
		{
			preg_match_all('/^Set-Cookie:\s*([^;]*)/mi',$LeerPagina[0],$Cookies);
			$LeerPagina2=LeerPagina($url,'POST',["usuario"=>$usuario,"password"=>$clave,"_token"=>$_token],count($Cookies)==2?array('Cookie: '.implode('; ',$Cookies[1])):[]);
			if(count($LeerPagina2)==2)
			{
				preg_match("!\r\n(?:Location|URI): *(.*?) *\r\n!", $LeerPagina2[0], $matches);
				if(strpos($matches[1],"principal"))
				{
					$pagina=$LeerPagina2;
					$resultado=true;
				}
				else
					$mensaje="Usuario o Clave Incorrecta";
			}
			else
				$mensaje='Error al obtener pagina 2';
		}
		else
			$mensaje='No se pudo obtener el _token';
	}
	else
		$mensaje='Error al obtener pagina 1';
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"pagina"=>$pagina];
}

function ObtenerFua($url_resysLocal,$usuario,$clave,$IdCuentaAtencion)
{
	$resultado=false;
	$mensaje='';
	$fua=null;
	try{
		$url=$url_resysLocal."/login";
		$ObtieneSesionLoayza=ObtieneSesionLoayza($url,$usuario,$clave);
		if($ObtieneSesionLoayza['resultado'])
		{
			preg_match_all('/^Set-Cookie:\s*([^;]*)/mi',$ObtieneSesionLoayza['pagina'][0],$Cookies);
			$opts = array(
			  'http'=>array(
				'method'=>"GET",
				'header'=>'Cookie: '.implode('; ',$Cookies[1])
			  )
			);
			$context = stream_context_create($opts);
			$fua=file_get_contents($url_resysLocal."/ws/sa_general/imprime_fua/".$IdCuentaAtencion, false, $context);
			
			$resultado=true;
		}
		else
			$mensaje=$ObtieneSesionLoayza['mensaje'];		
	} catch(Exception $e){
		$mensaje=$e->getMessage();
	}
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"fua"=>$fua];
}

	


	



// function buscarUsuarioVinculadoSIGH($idEmpleado){
	

// 	$resultado=false;
// 	$mensaje='';
// 	$datos=null;
// 	$ObtenerConexion=ObtenerConexion();
// 	if($ObtenerConexion['resultado'])
// 	{
// 		$conn=$ObtenerConexion['conn'];
// 		$getReviews = $conn->prepare("SELECT Medicos.IdMedico
// 				FROM Medicos 
// 			where Medicos.rne = ?");
// 		if($getReviews->execute([$nreMedico]))
// 		{
// 			$filas=$getReviews->fetchAll(PDO::FETCH_ASSOC);
			
// 			if(count($filas)>0)
// 			{
// 				$datos=$filas[0];
// 				$resultado=true;
// 			}
// 			else
// 				$mensaje='No se encontro Datos para RNe Medico';
// 		}
// 		else
// 			$mensaje=$getReviews->errorInfo()[2];
// 	}
// 	else
// 		$mensaje=$ObtenerConexion['mensaje'];
// 	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];

// }
function InsertarRegistroPatologiaOrden($IdOrden)
{
	$resultado=false;
	$mensaje='';
	$datos=null;
	$ObtenerConexion=ObtenerConexion();
	if($ObtenerConexion['resultado'])
	{
		$conn=$ObtenerConexion['conn'];
		$getReviews = $conn->prepare("SELECT DISTINCT     FactOrdenServicio.IdOrden, FactOrdenServicio.IdCuentaAtencion,FactOrdenServicio.idTipoFinanciamiento, FactOrdenServicio.IdUsuario, FactOrdenServicio.FechaCreacion, Pacientes.ApellidoPaterno, Pacientes.ApellidoMaterno, Pacientes.PrimerNombre, 
                         Pacientes.FechaNacimiento, Pacientes.IdDocIdentidad,Pacientes.NroDocumento, Atenciones.Edad,CASE Pacientes.IdTipoSexo WHEN 1 THEN 'M' ELSE 'F' END AS Sexo, Pacientes.IdDocIdentidad, FacturacionServicioDespacho.IdProducto, Pacientes.NroHistoriaClinica, 
                         Servicios.Nombre AS sala, Servicios.IdEspecialidad, Pacientes.Telefono, Servicios.IdTipoServicio,Servicios.IdServicio,Servicios.Nombre as Servicio,Servicios.codCompatible,LabMovimientoLaboratorio.OrdenaPrueba, Especialidades.Nombre AS Especialidad
FROM            FactOrdenServicio INNER JOIN
                         Pacientes ON FactOrdenServicio.IdPaciente = Pacientes.IdPaciente INNER JOIN
						  Atenciones ON FactOrdenServicio.IdCuentaAtencion =Atenciones.IdCuentaAtencion INNER JOIN
                        	
						 FacturacionServicioDespacho ON FactOrdenServicio.IdOrden = FacturacionServicioDespacho.idOrden INNER JOIN
                         Servicios ON FactOrdenServicio.IdServicioPaciente = Servicios.IdServicio INNER JOIN
                         LabMovimientoLaboratorio ON FactOrdenServicio.IdOrden = LabMovimientoLaboratorio.IdOrden INNER JOIN
                         Especialidades ON Servicios.IdEspecialidad = Especialidades.IdEspecialidad
WHERE        (FactOrdenServicio.IdOrden =?)");
		if($getReviews->execute([$IdOrden]))
		{
			$filas=$getReviews->fetchAll(PDO::FETCH_CLASS);
			if(count($filas)>0)
			{
				// var_dump($filas); 
				foreach($filas as $i=>$fila)
				{
					$InsertarRegistroPatologia=InsertarRegistroPatologia($fila);
					if($InsertarRegistroPatologia["resultado"])
					{
						$datos_i=$InsertarRegistroPatologia["datos"];
						$mensaje_i=null;
						$resultado_i=true;
					}
					else
					{
						$datos_i=null;
						$mensaje_i=$InsertarRegistroPatologia["mensaje"];
						$resultado_i=false;
					}
					$filas[$i]->datos=$datos_i;
					$filas[$i]->mensaje=$mensaje_i;
					$filas[$i]->resultado=$resultado_i;
				}
				$datos=$filas;
				$resultado=true;
			}
			else
				$mensaje='No se encontro Datos para ese IdOrden';
		}
		else
			$mensaje=$getReviews->errorInfo()[2];
	}
	else
		$mensaje=$ObtenerConexion['mensaje'];
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];
}
function BuscarTipoServicio($IdTipoServicio,$conn)
{
	$tipoServicoPatl=null;
	foreach($conn->query("select idSer from tipoServicio where codCompatible='$IdTipoServicio'") as $row) $tipoServicoPatl=$row['idSer'];
    return $tipoServicoPatl;
}
function BuscarServicio($codCompatible,$conn)
{
	$servicioPatl=null;
	foreach($conn->query("select IdServ from Servicios where codCompatible='$codCompatible'") as $row) $servicioPatl=$row['IdServ'];
	
    return $servicioPatl;
}

// function BuscarTipoEstudio($tipoEstudio,$conn)
// {
// 	$servicioPatl=null;
// 	foreach($conn->query("select IdServ from Servicios where codCompatible='$codCompatible'") as $row) $servicioPatl=$row['IdServ'];

//     return $servicioPatl;
// }
function BuscarTipoDoc($IdDocIdentidad,$conn)
{
	$idTipoDocPatl=null;
	foreach($conn->query("select idTipo from tbl_tipoDoc where codCompatible='$IdDocIdentidad'") as $row) $idTipoDocPatl=$row['idTipo'];

    return $idTipoDocPatl;
}
function BuscarUsuario($IdUsuario,$conn)
{
	$iduser=1;
	foreach($conn->query("select id from usuarios where codCompatible='$IdUsuario'") as $row) $iduser=$row['id'];
    return $iduser;
}
function InsertarRegistroPatologia($fila)
{
	$resultado=false;
	$mensaje='';
	$datos=null;
	try{
		$ObtenerConexion=ObtenerConexionMySQL();
		if($ObtenerConexion['resultado'])
		{
			$conn=$ObtenerConexion['conn'];
			$getReviews = $conn->prepare("INSERT INTO tbl_registroPacientesPatologia 
	(
		iduser, tipodoc, nrodoc, paciente, edad, sexo, finaciamiento, 
		cuenta, historia, servicio, salacama, celular, 
		anio, tipoServicoPatl,selecConvenio, nroFactura, 
		medicoSolicitante, especialidad, fechaRecepcion, tipoEstudio, 
		procedimiento, corPat, subproc
	)
	VALUES
	(
		?,?,?,?,?,?,?,
		?,?,?,?,?,
		?,?,?,?, 
		?,?,?,?, 
		?,?,?
	)");
			$iduser=BuscarUsuario($fila->IdUsuario,$conn);
			$tipodoc=BuscarTipoDoc($fila->IdDocIdentidad,$conn);
			// $tipodoc =null;
			$edad=null;
			$finaciamiento=$fila->idTipoFinanciamiento;
			$servicio=BuscarServicio($fila->codCompatible,$conn);
			// var_dump($servicio);
			$tipoServicoPatl=BuscarTipoServicio($fila->IdTipoServicio,$conn);
			// $tipoEstudio=BuscarTipoEstudio($fila->IdTipoEstudio,$conn);
			$tipoEstudio=null;
			$procedimiento=null;
			$corPat=null;
			$subproc=null;
			$parametros=[$iduser,$tipodoc,$fila->NroDocumento,$fila->ApellidoPaterno.' '.$fila->ApellidoMaterno.' '.$fila->PrimerNombre,$fila->Edad,$fila->Sexo,$finaciamiento,
				$fila->IdCuentaAtencion,$fila->NroHistoriaClinica,$servicio,substr($fila->sala,0,10),$fila->Telefono,
				date('Y',strtotime($fila->FechaCreacion)),$tipoServicoPatl,1,$fila->IdOrden,
				$fila->OrdenaPrueba,$fila->Especialidad,date('Y-m-d H:i:s',strtotime($fila->FechaCreacion)),$tipoEstudio,
				$procedimiento,$corPat,$subproc];
			if($getReviews->execute($parametros))
			{
				$datos=$conn->lastInsertId();
				$resultado=true;
			}
			else
				$mensaje=$getReviews->errorInfo()[2];
		}
		else
			$mensaje=$ObtenerConexion['mensaje'];
	} catch(Exception $e){
		$mensaje=$e->getMessage();
	}
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];
}
function MigrarUsuarios()
{
	$resultado=false;
	$mensaje='';
	$datos=null;
	try{
		$ObtenerConexionMysql=ObtenerConexionMySQL();
		if($ObtenerConexionMysql['resultado'])
		{
			$getReviews = $ObtenerConexionMysql['conn']->prepare("UPDATE usuarios SET codCompatible=? WHERE doc=?");
			$ObtenerConexion=ObtenerConexion();
			if($ObtenerConexion['resultado'])
			{
				foreach($ObtenerConexion['conn']->query("select IdEmpleado,LTRIM(RTRIM(DNI)) AS DNI from Empleados") as $row)
				{
					$getReviews->execute([$row["IdEmpleado"],$row["DNI"]]);
				}
				$resultado=true;
			}
			else
				$mensaje=$ObtenerConexion['mensaje'];
		}
		else
			$mensaje=$ObtenerConexionMysql['mensaje'];
	} catch(Exception $e){
		$mensaje=$e->getMessage();
	}
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];
}

function resys_Ap_ActualizarFacturacion($elemmentos)
{
	$resultado=false;
	$mensaje='';
	$datos=null;
	try{
		$ObtenerConexion=ObtenerConexion();
		if($ObtenerConexion['resultado'])
		{
			$resultado_p='';
			$mensaje_p='';
			$IdMovimiento_p='';
			$IdOrdenMovimiento_p='';
			$tsql = "exec resys_Ap_ActualizarFacturacion ?,?,?,?,?";
			$getReviews =$ObtenerConexion['conn']->prepare($tsql);
			$getReviews->bindValue(1,$elemmentos["NumMovimiento"],PDO::PARAM_STR);
			$getReviews->bindValue(2,$elemmentos["Orden"],PDO::PARAM_STR);
			$getReviews->bindValue(3,$elemmentos["IdCuentaAtencion"],PDO::PARAM_STR);
			$getReviews->bindParam(4,$resultado_p,PDO::PARAM_STR,1);
			$getReviews->bindParam(5,$mensaje_p,PDO::PARAM_STR,200);
			if($getReviews->execute())
			{
				if($resultado_p==1)
				{
					
					$resultado = true;
				}
				else
					$mensaje=$mensaje_p;
			}
			else
				$mensaje=$getReviews->errorInfo()[2];
		}
		else
			$mensaje=$ObtenerConexion['mensaje'];
	} catch(Exception $e){
		$mensaje=$e->getMessage();
	}
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];
}
function resys_actualiza_procedAP_enGalenos($elemmentos)
{
	$resultado=false;
	$mensaje='';
	$datos=null;
	try{
		$ObtenerConexion=ObtenerConexion();
		if($ObtenerConexion['resultado'])
		{
			$resultado_p='';
			$mensaje_p='';
			$IdMovimiento_p='';
			$IdOrdenMovimiento_p='';
			$tsql = "exec resys_actualiza_procedAP_enGalenos ?,?,?,?,?,?,?,?"; //Agregado
			$getReviews =$ObtenerConexion['conn']->prepare($tsql);
			$getReviews->bindValue(1,$elemmentos["NroOrdenMovimiento"],PDO::PARAM_STR);
			$getReviews->bindValue(2,$elemmentos["IdProducto"],PDO::PARAM_STR);
			$getReviews->bindValue(3,$elemmentos["NumMovimiento"],PDO::PARAM_STR);
			$getReviews->bindValue(4,$elemmentos["CantidadProce"],PDO::PARAM_STR);
			$getReviews->bindValue(5,$elemmentos["IdCuentaAtencion"],PDO::PARAM_STR);
			$getReviews->bindValue(6,$elemmentos["MedicoAuditor"],PDO::PARAM_STR);
			$getReviews->bindParam(7,$resultado_p,PDO::PARAM_STR,1);
			$getReviews->bindParam(8,$mensaje_p,PDO::PARAM_STR,200);
			if($getReviews->execute())
			{
				if($resultado_p==1)
				{
					
					$resultado = true;
				}
				else
					$mensaje=$mensaje_p;
			}
			else
				$mensaje=$getReviews->errorInfo()[2];
		}
		else
			$mensaje=$ObtenerConexion['mensaje'];
	} catch(Exception $e){
		$mensaje=$e->getMessage();
	}
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];
}
function CreaMovimientoLaboratorio($elemmentos)
{
	$resultado=false;
	$mensaje='';
	$datos=null;
	try{
		$ObtenerConexion=ObtenerConexion();
		if($ObtenerConexion['resultado'])
		{
			$resultado_p='';
			$mensaje_p='';
			$IdMovimiento_p='';
			$IdOrdenMovimiento_p='';
			$tsql = "exec rs_crea_movimiento_laboratorio ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
			$getReviews =$ObtenerConexion['conn']->prepare($tsql);
			$getReviews->bindValue(1,$elemmentos["IdCuentaAtencion"],PDO::PARAM_STR);
			$getReviews->bindValue(2,$elemmentos["IdPuntoCarga"],PDO::PARAM_STR);
			$getReviews->bindValue(3,$elemmentos["idPersonaTomaLab"],PDO::PARAM_STR);
			$getReviews->bindValue(4,$elemmentos["idPersonaRecoge"],PDO::PARAM_STR);
			$getReviews->bindValue(5,$elemmentos["OrdenaPrueba"],PDO::PARAM_STR);
			$getReviews->bindValue(6,$elemmentos["IdMedico"],PDO::PARAM_STR);
			$getReviews->bindValue(7,$elemmentos["idProductoCPT"],PDO::PARAM_STR);
			$getReviews->bindValue(8,$elemmentos["idProductoCPT2"],PDO::PARAM_STR);
			$getReviews->bindValue(9,$elemmentos["IDORDENParam"],PDO::PARAM_STR);
			$getReviews->bindValue(10,$elemmentos["NroOrdenReceta"],PDO::PARAM_STR);
			$getReviews->bindValue(11,$elemmentos["Fecha"],PDO::PARAM_STR);
			$getReviews->bindValue(12,$elemmentos["IdUsuario"],PDO::PARAM_STR);
			$getReviews->bindValue(13,$elemmentos["IdservicioEgreso"],PDO::PARAM_STR);
			$getReviews->bindValue(14,$elemmentos["CantidadProce"],PDO::PARAM_STR);
			$getReviews->bindValue(15,$elemmentos["IdtipoFinanciamientoParam"],PDO::PARAM_STR);
			$getReviews->bindParam(16,$resultado_p,PDO::PARAM_STR,1);
			$getReviews->bindParam(17,$mensaje_p,PDO::PARAM_STR,200);
			$getReviews->bindParam(18,$IdMovimiento_p,PDO::PARAM_STR,200);
			$getReviews->bindParam(19,$IdOrdenMovimiento_p,PDO::PARAM_STR,200);
			if($getReviews->execute())
			{
				if($resultado_p==1)
				{
					$datos = [
						'IdMovimiento' => $IdMovimiento_p,
						'IdOrdenMovimiento' => $IdOrdenMovimiento_p
					];
					$resultado = true;
				}
				else
					$mensaje=$mensaje_p;
			}
			else
				$mensaje=$getReviews->errorInfo()[2];
		}
		else
			$mensaje=$ObtenerConexion['mensaje'];
	} catch(Exception $e){
		$mensaje=$e->getMessage();
	}
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];
}
function ActualizaMovimientoLaboratorio($elemmentos)
{
	$resultado=false;
	$mensaje='';
	$datos=null;
	try{
		$ObtenerConexion=ObtenerConexion();
		if($ObtenerConexion['resultado'])
		{
			$resultado_p='';
			$mensaje_p='';
			$IdMovimiento_p='';
			$IdOrdenMovimiento_p='';
			$tsql = "exec rs_actualiza_movimiento_laboratorio ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?";
			$getReviews =$ObtenerConexion['conn']->prepare($tsql);
			$getReviews->bindValue(1,$elemmentos["IdCuentaAtencion"],PDO::PARAM_STR);
			$getReviews->bindValue(2,$elemmentos["IdPuntoCarga"],PDO::PARAM_STR);
			$getReviews->bindValue(3,$elemmentos["idPersonaTomaLab"],PDO::PARAM_STR);
			$getReviews->bindValue(4,$elemmentos["idPersonaRecoge"],PDO::PARAM_STR);
			$getReviews->bindValue(5,$elemmentos["OrdenaPrueba"],PDO::PARAM_STR);
			$getReviews->bindValue(6,$elemmentos["IdMedico"],PDO::PARAM_STR);
			$getReviews->bindValue(7,$elemmentos["idProductoCPT"],PDO::PARAM_STR);
			$getReviews->bindValue(8,$elemmentos["idProductoCPT2"],PDO::PARAM_STR);
			$getReviews->bindValue(9,$elemmentos["CantidadProced2"],PDO::PARAM_STR);
			$getReviews->bindValue(10,$elemmentos["IDORDENParam"],PDO::PARAM_STR);
			$getReviews->bindValue(11,$elemmentos["NroOrdenReceta"],PDO::PARAM_STR);
			$getReviews->bindValue(12,$elemmentos["Fecha"],PDO::PARAM_STR);
			$getReviews->bindValue(13,$elemmentos["IdUsuario"],PDO::PARAM_STR);
			$getReviews->bindValue(14,$elemmentos["IdservicioEgreso"],PDO::PARAM_STR);
			$getReviews->bindValue(15,$elemmentos["CantidadProce"],PDO::PARAM_STR);
			$getReviews->bindValue(16,$elemmentos["IdtipoFinanciamientoParam"],PDO::PARAM_STR);
			$getReviews->bindValue(17,$elemmentos["IdMovimientGenerado"],PDO::PARAM_STR);
			$getReviews->bindValue(18,$elemmentos["NroOrdenMovimiento"],PDO::PARAM_STR);
			$getReviews->bindParam(19,$resultado_p,PDO::PARAM_STR,1);
			$getReviews->bindParam(20,$mensaje_p,PDO::PARAM_STR,200);
			$getReviews->bindParam(21,$IdMovimiento_p,PDO::PARAM_STR,200);
			$getReviews->bindParam(22,$IdOrdenMovimiento_p,PDO::PARAM_STR,200);
			if($getReviews->execute())
			{
				if($resultado_p==1)
				{
					$datos = [
						'IdMovimiento' => $IdMovimiento_p,
						'IdOrdenMovimiento' => $IdOrdenMovimiento_p
					];
					$resultado = true;
				}
				else
					$mensaje=$mensaje_p;
			}
			else
				$mensaje=$getReviews->errorInfo()[2];
		}
		else
			$mensaje=$ObtenerConexion['mensaje'];
	} catch(Exception $e){
		$mensaje=$e->getMessage();
	}
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];
}
function ObtenerDatosFUA($IdCuentaAtencion)
{
	$resultado=false;
	$mensaje='';
	$datos=null;
	$ObtenerConexion=ObtenerConexion();
	if($ObtenerConexion['resultado'])
	{
		$conn=$ObtenerConexion['conn'];
		$getReviews = $conn->prepare("SELECT TOP 1 SIGH_EXTERNA.dbo.SisFuaAtencion.FuaDisa, 
										 SIGH_EXTERNA.dbo.SisFuaAtencion.FuaLote, 
										 SIGH_EXTERNA.dbo.SisFuaAtencion.FuaNumero, 
										 FUAVINCULADO.FuaNumero AS FUAVinculado,
										 SIGH_EXTERNA.dbo.SisFuaAtencion.EstablecimientoCodigoRenaes, 
										 EstablecimientosO.Nombre AS Establecimiento, 
                         				 SIGH_EXTERNA.dbo.SisFuaAtencion.FuaPersonalQatiende, 
										 SIGH_EXTERNA.dbo.SisFuaAtencion.FuaCodOferFlexible, 
										 SIGH_EXTERNA.dbo.SisFuaAtencion.FuaAtencionLugar, 
										 Pacientes.ApellidoPaterno, 
                         				 Pacientes.ApellidoMaterno, 
										 /*RTRIM(LTRIM(Pacientes.PrimerNombre)) PrimerNombre,
										 RTRIM(LTRIM(ISNULL(Pacientes.SegundoNombre, '') + ' ' + ISNULL(Pacientes.TercerNombre, ''))) AS OtrosNombres, */
										 RTRIM(LTRIM(Pacientes.PrimerNombre + ' ' + ISNULL(Pacientes.SegundoNombre, '') + ' ' + ISNULL(Pacientes.TercerNombre, ''))) AS Nombres,
										 Pacientes.NroDocumento, 
                         				 TiposDocIdentidad.CodigoSIS, 
										 Pacientes.NroHistoriaClinica, 
										 Pacientes.IdTipoSexo, 
										 --Pacientes.IdEtnia,
										 HIS_tabetnia.desetni IdEtnia,
										 CONVERT(DATE, Pacientes.FechaNacimiento) AS FechaNacimiento, 
										 Atenciones.IdTipoServicio, 
                         				 SIGH_EXTERNA.dbo.SisFiliaciones.AfiliacionDisa, 
										 SIGH_EXTERNA.dbo.SisFiliaciones.AfiliacionTipoFormato, 
										 SIGH_EXTERNA.dbo.SisFiliaciones.AfiliacionNroFormato, 
										 CONVERT(DATE, Atenciones.FechaIngreso) AS FechaIngreso, 
										 Atenciones.HoraIngreso, 
										 Servicios.codigoServicioFUA, 
										--  AtencionesDatosAdicionales.FuaCodigoPrestacion, 
										SIGH_EXTERNA.dbo.SisFuaAtencion.FuaCodigoPrestacion,
										 AtencionesDatosAdicionales.IdEstablecimientoOrigen, 
										 Establecimientos.Codigo as CodRenaesRef, 
                         				 Establecimientos.Nombre as NomEstablecimientoReferencia, 
										 AtencionesDatosAdicionales.NroReferenciaOrigen, 
										 Empleados.ApellidoPaterno+' '+Empleados.ApellidoMaterno+' '+Empleados.Nombres AS Medico, 
										 Empleados.DNI AS DNIMedico,
										Medicos.Colegiatura as Colegiatura,
										ISNULL(Medicos.rne, '') AS RneMedico,
										Medicos.egresado,
										MedicosEspecialidad.IdEspecialidad,
										Especialidades.Nombre AS NombreEspecialidad,
										TiposEmpleado.Descripcion AS EspecialidadEmpleado,
										 Atenciones.IDCuentaAtencionVinculado, -- fua padre
										ap.IdCuentaAtencion AS CuentaPadre,
										".$IdCuentaAtencion." AS IdCuentaAtencion,
										ap.IdServicioIngreso AS IdServicioPadre,
										sp.Nombre AS ServicioMadre
									FROM SIGH_EXTERNA.dbo.SisFuaAtencion 
									INNER JOIN Atenciones ON SIGH_EXTERNA.dbo.SisFuaAtencion.idCuentaAtencion = Atenciones.IdCuentaAtencion 
									LEFT JOIN Atenciones as ap ON Atenciones.IDCuentaAtencionVinculado = ap.IdCuentaAtencion 
									LEFT JOIN Servicios as sp ON ap.IdServicioIngreso = sp.IdServicio 
									INNER JOIN Servicios ON Atenciones.IdServicioIngreso = Servicios.IdServicio 
									INNER JOIN Pacientes ON Atenciones.IdPaciente = Pacientes.IdPaciente 
									LEFT JOIN TiposDocIdentidad ON Pacientes.IdDocIdentidad = TiposDocIdentidad.IdDocIdentidad 
									INNER JOIN AtencionesDatosAdicionales ON Atenciones.IdAtencion = AtencionesDatosAdicionales.idAtencion 
									INNER JOIN SIGH_EXTERNA.dbo.SisFiliaciones ON AtencionesDatosAdicionales.IdSiaSis = SIGH_EXTERNA.dbo.SisFiliaciones.idSiasis 
									AND AtencionesDatosAdicionales.SisCodigo = SIGH_EXTERNA.dbo.SisFiliaciones.Codigo COLLATE Modern_Spanish_CI_AS 
									LEFT OUTER JOIN Establecimientos ON AtencionesDatosAdicionales.IdEstablecimientoOrigen = Establecimientos.IdEstablecimiento 
									INNER JOIN Establecimientos as EstablecimientosO on SIGH_EXTERNA.dbo.SisFuaAtencion.EstablecimientoCodigoRenaes='000'+EstablecimientosO.Codigo COLLATE SQL_Latin1_General_CP1_CI_AS 
									INNER JOIN Medicos ON ISNULL(Atenciones.IdMedicoEgreso,Atenciones.IdMedicoIngreso)=Medicos.IdMedico 
									LEFT JOIN MedicosEspecialidad ON Medicos.IdMedico=MedicosEspecialidad.IdMedico
									LEFT JOIN Especialidades ON  MedicosEspecialidad.IdEspecialidad=Especialidades.IdEspecialidad
									INNER JOIN Empleados ON Medicos.IdEmpleado = Empleados.IdEmpleado
									LEFT JOIN TiposEmpleado ON Empleados.IdTipoEmpleado = TiposEmpleado.IdTipoEmpleado
									INNER JOIN HIS_tabetnia ON HIS_tabetnia.codetni = Pacientes.IdEtnia
									LEFT JOIN SIGH_EXTERNA.dbo.SisFuaAtencion FUAVINCULADO ON ap.IdCuentaAtencion = FUAVINCULADO.idCuentaAtencion
									WHERE (SIGH_EXTERNA.dbo.SisFuaAtencion.idCuentaAtencion =?)");

			$getReviews->execute([$IdCuentaAtencion]);
			if($getReviews){
				
				$filas=$getReviews->fetchAll(PDO::FETCH_ASSOC);
			if(count($filas)>0)
			{
				$datosFua=$filas[0];
				$resultado=true;

				$medicamentos = $conn->prepare("SELECT FactCatalogoBienesInsumos.Codigo, 
                                                   FactCatalogoBienesInsumos.Nombre, 
                                                   SUM(farmMovimientoDetalle.Cantidad) AS Cantidad
                                            FROM farmMovimientoVentas 
                                            INNER JOIN farmMovimiento ON farmMovimientoVentas.movNumero = farmMovimiento.MovNumero 
                                            AND farmMovimientoVentas.movTipo = farmMovimiento.MovTipo 
                                            INNER JOIN farmMovimientoDetalle 
                                            ON farmMovimiento.MovNumero COLLATE DATABASE_DEFAULT = farmMovimientoDetalle.MovNumero COLLATE DATABASE_DEFAULT 
                                            AND farmMovimiento.MovTipo COLLATE DATABASE_DEFAULT = farmMovimientoDetalle.MovTipo COLLATE DATABASE_DEFAULT
                                            INNER JOIN FactCatalogoBienesInsumos ON farmMovimientoDetalle.idProducto = FactCatalogoBienesInsumos.IdProducto
                                            WHERE (farmMovimiento.idEstadoMovimiento = 1) 
                                            AND (farmMovimientoVentas.idCuentaAtencion = ?)
                                            AND (FactCatalogoBienesInsumos.TipoProducto = 0)
                                            GROUP BY FactCatalogoBienesInsumos.Codigo, FactCatalogoBienesInsumos.Nombre");
				$medicamentos->execute([$IdCuentaAtencion]);
				$medicamentos = $medicamentos->fetchAll(PDO::FETCH_ASSOC);
			
							

				$insumos = $conn->prepare("SELECT FactCatalogoBienesInsumos.Codigo, 
							FactCatalogoBienesInsumos.Nombre, 
							SUM(farmMovimientoDetalle.Cantidad) AS Cantidad
					FROM farmMovimientoVentas 
					INNER JOIN farmMovimiento ON farmMovimientoVentas.movNumero = farmMovimiento.MovNumero 
					AND farmMovimientoVentas.movTipo = farmMovimiento.MovTipo 
					INNER JOIN farmMovimientoDetalle 
					ON farmMovimiento.MovNumero COLLATE DATABASE_DEFAULT = farmMovimientoDetalle.MovNumero COLLATE DATABASE_DEFAULT 
					AND farmMovimiento.MovTipo COLLATE DATABASE_DEFAULT = farmMovimientoDetalle.MovTipo COLLATE DATABASE_DEFAULT
					INNER JOIN FactCatalogoBienesInsumos ON farmMovimientoDetalle.idProducto = FactCatalogoBienesInsumos.IdProducto
					WHERE (farmMovimiento.idEstadoMovimiento = 1) 
					AND (farmMovimientoVentas.idCuentaAtencion = ?)
					AND (FactCatalogoBienesInsumos.TipoProducto = 1)
					GROUP BY FactCatalogoBienesInsumos.Codigo, FactCatalogoBienesInsumos.Nombre");
				$insumos->execute([$IdCuentaAtencion]);
				$insumos = $insumos->fetchAll(PDO::FETCH_ASSOC);

				$diagnosticos = $conn->prepare("SELECT Diagnosticos.Descripcion, 
												 Diagnosticos.codigoCIEsinPto, 
												 SubclasificacionDiagnosticos.Codigo as Tipo
										  FROM AtencionesDiagnosticos 
										  INNER JOIN Diagnosticos ON AtencionesDiagnosticos.IdDiagnostico = Diagnosticos.IdDiagnostico 
										  INNER JOIN Atenciones ON AtencionesDiagnosticos.IdAtencion = Atenciones.IdAtencion 
										  INNER JOIN SubclasificacionDiagnosticos ON AtencionesDiagnosticos.IdSubclasificacionDx = SubclasificacionDiagnosticos.IdSubclasificacionDx
										  WHERE (SubclasificacionDiagnosticos.Codigo IN ('P', 'D', 'R')) 
										  AND (Atenciones.IdCuentaAtencion =?)");
				$diagnosticos->execute([$IdCuentaAtencion]);
				$diagnosticos = $diagnosticos->fetchAll(PDO::FETCH_ASSOC);


				$procedimientos = $conn->prepare("SELECT FactCatalogoServicios.Nombre, 
													FactCatalogoServicios.Codigo, COUNT(*) AS Cantidad
											 FROM FactOrdenServicio 
											 INNER JOIN FacturacionServicioDespacho ON FactOrdenServicio.IdOrden = FacturacionServicioDespacho.idOrden 
											 INNER JOIN FactCatalogoServicios ON FactCatalogoServicios.IdProducto = FacturacionServicioDespacho.IdProducto
											 WHERE (FactOrdenServicio.IdCuentaAtencion =?) 
											 AND (FactOrdenServicio.IdEstadoFacturacion <> 9)
											 GROUP BY FactCatalogoServicios.Nombre, FactCatalogoServicios.Codigo");
				$procedimientos->execute([$IdCuentaAtencion]);
				$procedimientos = $procedimientos->fetchAll(PDO::FETCH_ASSOC);

				// Agrupar los resultados
				$response = [
				
				'datosFua' => $datosFua,
				'medicamentos' => $medicamentos,
				'insumos' => $insumos,
				'diagnosticos'=> $diagnosticos,
				'procedimientos' => $procedimientos
				];



			}
			else
				$mensaje='No se encontro Datos para ese IdCuentaAtencion';
		}
			
	}
		
	else
		$mensaje=$ObtenerConexion['mensaje'];
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$response];
}
	
	
?>