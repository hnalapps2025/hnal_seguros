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
	$DB_USER='csaravia';
	$DB_PASSWORD='csaravia2020';
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

function sumar($a,$b)
{
	$resultado=false;
	$mensaje='';
	$datos=null;
	try{
		$datos=$a+$b;
		$resultado=true;
	} catch(Exception $e){
		$mensaje=$e->getMessage();
	}
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
			
			$fua=file_get_contents($url_resysLocal."/ws/sa_general/imprime_fua_ap/".$IdCuentaAtencion, false, $context);
			// var_dump($fua);
			// exit();
			
			$resultado=true;
		}
		else
			$mensaje=$ObtieneSesionLoayza['mensaje'];		
	} catch(Exception $e){
		$mensaje=$e->getMessage();
	}
	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"fua"=>$fua];
}