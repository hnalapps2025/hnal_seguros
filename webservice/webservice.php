<?php


header('Access-Control-Allow-Origin: *');

//

$id= $_GET['id'];
$tipo= $_GET['tipo'];
//$idSe= $_GET['idSe'];

define("DEBUG", TRUE);

if(DEBUG)
{
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}


$wsdl = 'http://app.sis.gob.pe/sisWSAFI/Service.asmx?wsdl'; 

$params1 = Array(

    "strUsuario" =>"HNAL",
    "strClave" => "45-hnAL@s1s23",
    
    );

    
$options1 = Array(


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


$soap1 = new SoapClient($wsdl, $options1);
$result1 = $soap1->GetSession($params1);
$value1 = json_decode(json_encode($result1), true);
$datos = array();

$datos[] = $value1['GetSessionResult'];




/* SEGUNDO TRAMO */

$idSe= $datos[0];
    
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


//

    $params = Array(

            "intOpcion" =>1,
            "strAutorizacion" => $idSe,
            "strDni" => "09618951",
            "strTipoDocumento" => $tipo,
            "strNroDocumento" => $id,

    );



$soap = new SoapClient($wsdl, $options);
$result = $soap->ConsultarAfiliadoFuaE($params);


$value = json_decode(json_encode($result), true);

$datos = array();

//


$datos[] = $value['ConsultarAfiliadoFuaEResult']['Resultado'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['TipoDocumento'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['NroDocumento'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['ApePaterno'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['ApeMaterno'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['Nombres'];
//$datos[] = $value['ConsultarAfiliadoFuaEResult']['FecAfiliacion'];
$fechaAfiliacion 	 = strtotime($value['ConsultarAfiliadoFuaEResult']['FecAfiliacion']);
$datos[] = date('Y-m-d',$fechaAfiliacion);
$datos[] = $value['ConsultarAfiliadoFuaEResult']['EESS'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['DescEESS'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['EESSUbigeo'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['DescEESSUbigeo'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['Regimen'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['TipoSeguro'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['DescTipoSeguro'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['Contrato'];
//$datos[] = $value['ConsultarAfiliadoFuaEResult']['FecCaducidad'];
$FecCaducidad 	 = strtotime($value['ConsultarAfiliadoFuaEResult']['FecCaducidad']);
$datos[] = date('Y-m-d',$FecCaducidad);
$datos[] = $value['ConsultarAfiliadoFuaEResult']['Estado'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['Tabla'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['IdNumReg'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['Genero'];
//$datos[] = $value['ConsultarAfiliadoFuaEResult']['FecNacimiento'];
$frna 	 = strtotime($value['ConsultarAfiliadoFuaEResult']['FecNacimiento']);
$datos[] = date('Y-m-d',$frna);
$datos[] = $value['ConsultarAfiliadoFuaEResult']['IdUbigeo'];
//$datos[] = $value['ConsultarAfiliadoFuaEResult']['Direccion'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['Disa'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['TipoFormato'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['NroContrato'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['Correlativo'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['IdPlan'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['IdGrupoPoblacional'];
$datos[] = $value['ConsultarAfiliadoFuaEResult']['MsgConfidencial'];


echo json_encode($datos,JSON_UNESCAPED_UNICODE);






//

?>