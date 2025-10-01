<?php

header('Access-Control-Allow-Origin: *');


define("DEBUG", TRUE);

if(DEBUG)
{
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

error_reporting(0);


$wsdl = 'http://app.sis.gob.pe/sisWSAFI/Service.asmx?wsdl'; 

$params = Array(

    "strUsuario" =>"HNAL",
    "strClave" => "45-hnAL@s1s23",//gRXDAPc2
    
    );

    
$options = Array(


	"uri"=> $wsdl,
	"style"=> SOAP_RPC,
	"use"=> SOAP_ENCODED,
	"soap_version"=> SOAP_1_1,
	"cache_wsdl"=> WSDL_CACHE_BOTH,
	"connection_timeout" => 60,
	"trace" => false,
	"encoding" => "UTF-8",
    "exceptions" => false,

);


$soap = new SoapClient($wsdl, $options);
$result = $soap->GetSession($params);
$value = json_decode(json_encode($result), true);
$datos = array();


$datos[] = $value['GetSessionResult'];
echo json_encode($datos,JSON_UNESCAPED_UNICODE); 



?>