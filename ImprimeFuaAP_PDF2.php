<?php
session_start();

require 'vendor/autoload.php';
include_once ('config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."ModelProcediminetos.php");
use Dompdf\Dompdf;


// Crear instancia de Dompdf
//$dompdf = new Dompdf();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = isset($_POST['datos']) ? $_POST['datos'] : null;

    $data = json_decode($json, true);

if ($data === null) {
    echo "Error al decodificar JSON: " . json_last_error_msg();
    exit;
}

// Decodificar el JSON
$data = json_decode($json, true);

// Validar que el JSON es válido
if ($data === null) {
    echo "Error al decodificar JSON: " . json_last_error_msg();
    exit;
}

 function Separar_Palabras($palabras,$cantidad)
	{
		$resultado=false;
		$mensaje='';
		$datos=null;
		if(strlen(trim($palabras))>0)
		{
			$porciones=array_unique(explode(" ",trim($palabras)));
			foreach($porciones as $porcion)$filas[]=$porcion;
			$porciones=$filas;
			for($i=1;$i<=$cantidad;$i++)
			{
				if(isset($porciones[$i-1]))
				{
					if($i==$cantidad&&count($porciones)>$cantidad)
					{
						$texto='';
						for($j=$i;$j<=count($porciones);$j++)
							$texto.=$porciones[$j-1].' ';
					}
					else
						$texto=$porciones[$i-1];					
				}
				else
					$texto='';
				$datos[$i-1]=$texto;
			}
			$resultado=true;
		}
		else
			$mensaje='Cadena vacia';
		return ['resultado'=>$resultado,'mensaje'=>$mensaje,'datos'=>$datos];
	}

$datos = json_decode($data, true);

if (isset($datos['datos']) && is_array($datos['datos'])) {
    $datosultimo = $datos['datos']['datosFua'];
    $diagnosticos = $datos['datos']['diagnosticos'];
    $medicamentos = $datos['datos']['medicamentos'];
    $procedimientos = $datos['datos']['procedimientos'];



    //echo "<pre> ";
    //print_r($datosultimo); 
    //echo "</pre>";
	$FuaNumero = $datosultimo['FuaNumero'];
	$AfiliacionDisa = $datosultimo['AfiliacionDisa'];
	$AfiliacionNroFormato = $datosultimo['AfiliacionNroFormato'];
	$AfiliacionTipoFormato = $datosultimo['AfiliacionTipoFormato'];
	$ApellidoMaterno = $datosultimo['ApellidoMaterno'];
	$ApellidoPaterno = $datosultimo['ApellidoPaterno'];
	
	if( $datosultimo['CodigoSIS']==1){
		$CodigoSIS = 2;
	}else if($datosultimo['CodigoSIS']==2) { 
		$CodigoSIS = 3;
	}
	$Colegiatura = $datosultimo['Colegiatura'];
	$CuentaPadre = $datosultimo['CuentaPadre'];
	$DniMedico = $datosultimo['DNIMedico'];
	$EspecialidadEmpleado = $datosultimo['EspecialidadEmpleado'];
	$Establecimiento = $datosultimo['Establecimiento'];
	$EstablecimientoCodigoRenaes = $datosultimo['EstablecimientoCodigoRenaes'];
	$FechaIngreso = $datosultimo['FechaIngreso'];
	$FechaNacimiento = $datosultimo['FechaNacimiento'];
	$datosultimo['FuaPersonalQatiende']==1?$FuaPersonalQatiende1="X":$FuaPersonalQatiende1="";
	$datosultimo['FuaPersonalQatiende']==2?$FuaPersonalQatiende2="X":$FuaPersonalQatiende2="";
	$datosultimo['FuaPersonalQatiende']==3?$FuaPersonalQatiende3="X":$FuaPersonalQatiende3="";
	//$datosultimo['FuaPersonalQatiende']==3? $FuaCodOferFlexible="X":$FuaCodOferFlexible="";

	$datosultimo['FuaAtencionLugar'] ==1?$FuaAtencionLugar1 ="X":$FuaAtencionLugar1="";
	$datosultimo['FuaAtencionLugar'] ==2?$FuaAtencionLugar2 ="X":$FuaAtencionLugar2="";
	 $datosultimo['IdTipoSexo'] ==1?$IdTipoSexoM="X":$IdTipoSexof ="X";
	$FuaCodOferFlexible = $datosultimo['FuaCodOferFlexible'];
	$FuaCodigoPrestacion = $datosultimo['FuaCodigoPrestacion'];
	$FuaDisa = $datosultimo['FuaDisa'];
	$FuaLote = $datosultimo['FuaLote'];
	$FUAVinculado = $datosultimo['FUAVinculado'];
	$HoraIngreso = $datosultimo['HoraIngreso'];
	$IdCuentaAtencionVinculado = $datosultimo['IDCuentaAtencionVinculado'];
	$IdCuentaAtencion = $datosultimo['IdCuentaAtencion'];
	$ServicioMadre = $datosultimo['ServicioMadre'];

	$IdEspecialidad = $datosultimo['IdEspecialidad'];
	if( $datosultimo['IdEstablecimientoOrigen'] != null){
		// $IdEstablecimientoOrigen1="X";
		// $IdEstablecimientoOrigen2="";
		// $IdEstablecimientoOrigen3="";
		$CodRenaesRef= $datosultimo['CodRenaesRef'];
	
	}

	$IdEtnia = $datosultimo['IdEtnia'];
	$IdServicioPadre = $datosultimo['IdServicioPadre'];
	if($datosultimo['IdTipoServicio']== 1 || $datosultimo['IdTipoServicio']== 5 ){
		if($datosultimo['IdEstablecimientoOrigen1'] != null){
			
			$FuaAtencionReferencia  ="X";
			$CodRenaesRef = $datosultimo['CodRenaesRef'];
			$NomEstablecimientoReferencia= $datosultimo['NomEstablecimientoReferencia'];
			$NroReferenciaOrigen=$datosultimo['NroReferenciaOrigen'];
			
		}else{
			$FuaAtencionAmbulatoria = "X";
		}

	}else{
		$FuaAtencionEmergencia = "X";
	}
	$Medico = $datosultimo['Medico'];

	$NombreEspecialidad = $datosultimo['NombreEspecialidad'];
	
	$Separar_Palabras =Separar_Palabras($datosultimo['Nombres'],2);
	if($Separar_Palabras["resultado"])
	{
		$Nombre1=$Separar_Palabras["datos"][0];
		$Nombre2=$Separar_Palabras["datos"][1];
	}
	else{
		$Nombre1=$Nombres;
		$Nombre2="";
	}
	if($datosultimo['IdTipoServicio'] == 5){
		$FechaDiaIngresoHosp = date('d',strtotime($FechaIngresoHosp));
		$FechaMesIngresoHosp = date('m',strtotime($FechaIngresoHosp));
		$FechaAnioIngresoHosp = date('y',strtotime($FechaIngresoHosp));


	}
	$NroDocumento = $datosultimo['NroDocumento'];
	$NroHistoriaClinica = $datosultimo['NroHistoriaClinica'];

	$RneMedico = $datosultimo['RneMedico'];
	$ServicioMadre = $datosultimo['ServicioMadre'];
	$CodigoServicioFUA = $datosultimo['codigoServicioFUA'];
	$Egresado = $datosultimo['egresado'];
	$imagePath = 'images/ministerio_sis.png';
$imgData = base64_encode(file_get_contents($imagePath));

	

$html = " 
<html>
<head>
    <style>
      	h4{
					text-align: center;
				}
				table {
					border-collapse: collapse;
				}
				td {
					font-size: 7px;
					font-family: 'Helvetica';
					border: 0.5px solid #4B4B4C;
					padding: 1px 3px;
				}
				.border_cero{
					border: 0px;
				}
				.left{
					border-left: 0px;
				}
				.right{
					border-right: 0px;
				}
				.top{
					border-top: 0px;
				}
				.bottom{
					border-bottom: 0px;
				}
				.center{
					text-align:center;
				}
				.fw-bold {
					font-weight: bold !important;
				}
				.text-right{
					text-align: right;
				}
				.bg-gray {
					background-color: #E7E7E7 !important; 
				}
				.p-0{
					padding: 0;
				}
    </style>
</head>
<body>
  <table cellspacing='0' width='100%'>
					<tr>
						<td colSpan='8' class='border_cero' style='height:38px'><div style='position:absolute'><img src='data:image/png;base64,{$imgData}' style='width: 280px;' /></div></td>
						<td colSpan='4' class='center border_cero fw-bold' style='font-size: 12px'>ANEXO 1</td>
						<td colSpan='5' class='border_cero'></td>
						<td colSpan='1' class='center border_cero fw-bold '  style='font-size: 9px'><strong>Serv:</strong> ".$ServicioMadre."<br><strong>Cta. Vinculda:</strong> ".$IdCuentaAtencionVinculado."</td>
						<td colSpan='1' class='center border_cero fw-bold '  style='font-size: 9px'><strong>Fe.Em.:</strong> ".date('d/m/Y H:i',time())."<br><strong>Cta.</strong> ".$IdCuentaAtencion."</td>
						<td colSpan='1' class='center border_cero fw-bold ' </td>
					</tr>
					<tr>
						<td colSpan='20' class='center bg-gray fw-bold'>FORMATO ÚNICO DE ATENCIÓN - FUA</td>
					</tr>
					<tr>
						<td rowSpan='3' colSpan='3' class='border_cero'></td>
						<td colSpan='6' class='center bg-gray fw-bold'>NUMERO DE FORMATO</td>
					</tr>
					<tr>
				<td  rowSpan='2'colspan='2' class='center fw-bold'>" . $FuaDisa . "</td>
						<td rowSpan='2' colSpan='2' class='center fw-bold'>".$FuaLote."</td>
						<td rowSpan='2' colSpan='2' class='center fw-bold'>".$FuaNumero."</td>
					</tr>
					<tr>
						<td colSpan='7' class='border_cero' style='height: 3px'></td>
					</tr>
					<tr>
						<td colSpan='20' class='center bg-gray fw-bold'>DE LA INSTITUCIÓN PRESTADORA DE SERVICIOS DE SALUD</td>
					</tr>
					<tr>
						<td colSpan='4' class='center bg-gray fw-bold'>CÓDIGO RENIPRESS DE LA IPRESS</td>
						<td colSpan='16' class='center bg-gray fw-bold'>NOMBRE DE LA IPRESS QUE REALIZA LA ATENCIÓN</td>
					</tr>
					<tr>
						<td colSpan='4' class='center'>".$EstablecimientoCodigoRenaes."</td>
						<td colSpan='16' class='center'>".$Establecimiento."</td>
					</tr>
					<tr>
						<td colSpan='20' class='border_cero' style='height: 3px'></td>
					</tr>
					<tr>
						<td colSpan='3' class='center bg-gray fw-bold'>PERSONAL QUE ATIENDE</td>
						<td colSpan='3' class='center bg-gray fw-bold'>LUGAR DE ATENCIÓN</td>
						<td colSpan='3' class='center bg-gray fw-bold'>ATENCIÓN</td>
						<td colSpan='11' class='center bg-gray fw-bold'>REFERENCIA REALIZADA POR</td>
					</tr>
					<tr>
						<td class='bg-gray'>DE LA IPRESS</td>
						<td style='width: 10px'>".$FuaPersonalQatiende1."</td>
						<td class='bg-gray center'>CÓDIGO DE AISPED</td>
						<td colSpan='2' class='bg-gray'>INTRAMURAL</td>
						<td class='center'>".$FuaAtencionLugar1."</td>
						<td colSpan='2' class='bg-gray'>AMBULATORIA</td>
						<td class='center'>".$FuaAtencionAmbulatoria."</td>
						<td colSpan='3' class='center bg-gray'>CÓD. RENIPRESS</td>
						<td colSpan='6' class='center bg-gray'>NOMBRE DE LA IPRESS</td>
						<td colSpan='2' class='center bg-gray'>N° HOJA DE REFERENCIA</td>
					</tr>
					<tr>
						<td class='bg-gray'>ITINERANTE</td>
						<td>".$FuaPersonalQatiende2."</td>
						<td rowSpan='2'></td>
						<td colSpan='2' class='bg-gray'>EXTRAMURAL</td>
						<td class='center'>".$FuaAtencionLugar2."</td>
						<td colSpan='2' class='bg-gray'>REFERENCIA</td>
						<td class='center'>".$FuaAtencionReferencia."</td>
						<td rowSpan='2' colSpan='3' class='center'>".$CodRenaesRef."</td>
						<td rowSpan='2' colSpan='6' class='center'>".$NomEstablecimientoReferencia."</td>
						<td rowSpan='2' colSpan='2' class='center'>".$NroReferenciaOrigen."</td>
					</tr>
					<tr>
						<td class='bg-gray'>AISPED</td>
						<td>".$FuaPersonalQatiende3."</td>
						<td colSpan='3'></td>
						<td colSpan='2' class='bg-gray'>EMERGENCIA</td>
						<td class='center'>".$IdEstablecimientoOrigen."</td>
					</tr>
				</table>
				<div style=height:3px;></div>
				<table cellspacing='0' width='100%'>
					<tr>
						<td colSpan='19' class='center bg-gray fw-bold'>DEL ASEGURADO / USUARIO</td>
					</tr>
					<tr>
						<td colSpan='5' class='center bg-gray fw-bold'>IDENTIFICACIÓN</td>
						<td rowSpan='3' class='border_cero' style='width:3px'></td>
						<td colSpan='6' class='center bg-gray fw-bold'>CÓDIGO DEL ASEGURADO SIS</td>
						<td rowSpan='9' class='border_cero'>..</td>
						<td colSpan='6' class='center bg-gray fw-bold'>ASEGURADO DE OTRA IAFAS</td>
					</tr>
					<tr>
						<td class='center bg-gray'>TDI</td>
						<td colSpan='4' class='center bg-gray'>N° DOCUMENTO DE IDENTIDAD</td>
						<td colSpan='2' class='center bg-gray'>DIRESA / OTROS</td>
						<td colSpan='4' class='center bg-gray'>NÚMERO</td>
						<td class='center bg-gray'>INSTITUCIÓN</td>
						<td colSpan='5'></td>
					</tr>
					<tr>
						<td class='center'>".$CodigoSIS."</td>
						<td colSpan='4' class='center'>".$NroDocumento."</td>
						<td colSpan='2' class='center'>".$AfiliacionDisa."</td>
						<td colSpan='2' class='center'>".$AfiliacionTipoFormato."</td>
						<td colSpan='2' class='center'>".$AfiliacionNroFormato."</td>
						<td class='center bg-gray'>COD. SEGURO</td>
						<td colSpan='5'></td>
					</tr>
					<tr>
						<td colSpan='19' class='border_cero' style='height: 3px'></td>
					</tr>
					<tr>
						<td colSpan='12' class='center bg-gray fw-bold'>APELLIDO PATERNO</td>
						<td colSpan='6' class='center bg-gray fw-bold'>APELLIDO MATERNO</td>
					</tr>
					<tr>
						<td colSpan='12' class='center'>".$ApellidoPaterno."</td>
						<td colSpan='6' class='center'>".$ApellidoMaterno."</td>
					</tr>
					<tr>
						<td class='border_cero' style='height: 3px'></td>
					</tr>
					<tr>
						<td colSpan='12' class='center bg-gray fw-bold'>PRIMER NOMBRE</td>
						<td colSpan='6' class='center bg-gray fw-bold'>OTROS NOMBRES</td>
					</tr>
					<tr>
						<td colSpan='12' class='center'>".$Nombre1."</td>
						<td colSpan='6' class='center'>".$Nombre2."</td>
					</tr>
					<tr>
						<td colSpan='19' class='border_cero' style='height: 3px'></td>
					</tr>
					<tr>
						<td colSpan='3' class='center bg-gray fw-bold'>SEXO</td>
						<td rowSpan='11' class='border_cero' style='width: 3px'></td>
						<td colSpan='3' class='center bg-gray fw-bold'>FECHA</td>
						<td colSpan='2' class='center bg-gray fw-bold'>DIA</td>
						<td colSpan='2' class='center bg-gray fw-bold'>MES</td>
						<td colSpan='3' class='center bg-gray fw-bold'>AÑO</td>
						<td rowSpan='9' class='border_cero'></td>
						<td class='center bg-gray fw-bold'>N° HISTORIA CLÍNICA</td>
						<td rowSpan='2' class='border_cero' style='width:3px'></td>
						<td colSpan='2' class='center bg-gray fw-bold'>ETNIA</td>
					</tr>
					<tr>
						<td colSpan='2' class='center bg-gray'>MASCULINO</td>
						<td class='center'>".$IdTipoSexoM."</td>
						<td rowSpan='2' colSpan='3' class='center bg-gray'>FECHA PROBABLE DE PARTO / FECHA DE PARTO</td>
						<td rowSpan='2' colSpan='2'></td>
						<td rowSpan='2' colSpan='2'></td>
						<td rowSpan='2' colSpan='3'></td>
						<td rowSpan='2' class='center'>".$NroHistoriaClinica."</td>
						<td rowSpan='2' colSpan='2' class='center'>".$IdEtnia."</td>
					</tr>
					<tr>
						<td colSpan='2' class='center bg-gray'>FEMENINO</td>
						<td class='center'>".$IdTipoSexoF."</td>
					</tr>
					<tr>
						<td colSpan='19' class='border_cero' style='height: 3px'></td>
					</tr>
					<tr>
						<td colSpan='3' class='center bg-gray fw-bold'>SALUD MATERNA</td>
						<td rowSpan='2' colSpan='3' class='center bg-gray'>FECHA DE NACIMIENTO</td>
						<td rowSpan='2' colSpan='2' class='center'>".date('d',strtotime($FechaNacimiento))."</td>
						<td rowSpan='2' colSpan='2' class='center'>".date('m',strtotime($FechaNacimiento))."</td>
						<td rowSpan='2' colSpan='3' class='center'>".date('Y',strtotime($FechaNacimiento))."</td>
						<td colSpan='3' class='center bg-gray'>DNI / CNV / AFILIACIÓN DEL RN 1</td>
						<td style='width:90px'></td>
					</tr>
					<tr>
						<td rowSpan='3' colSpan='2' class='center bg-gray'>GESTANTE</td>
						<td rowSpan='3'></td>
						<td rowSpan='3' colSpan='3' class='center bg-gray'>DNI / CNV / AFILIACIÓN DEL RN 2</td>
						<td rowSpan='3'></td>
					</tr>
					<tr>
						<td colSpan='3' class='border_cero' style='height: 3px'></td>
					</tr>
					<tr>
						<td rowSpan='2' colSpan='3' class='center bg-gray'>FECHA DE FALLECIMIENTO</td>
						<td rowSpan='2' colSpan='2'></td>
						<td rowSpan='2' colSpan='2'></td>
						<td rowSpan='2' colSpan='3'></td>
					</tr>
					<tr>
						<td colSpan='2' class='center bg-gray'>PUERPERA</td>
						<td></td>
						<td colSpan='3' class='center bg-gray'>DNI / CNV / AFILIACIÓN DEL RN 3</td>
						<td></td>
					</tr>
				</table>
				<div style=height:3px;></div>
				<table cellspacing='0' width='100%'>
					<tr>
						<td colSpan='30' class='center bg-gray fw-bold'>DE LA ATENCIÓN</td>
					</tr>
					<tr>
						<td colSpan='30' class='border_cero' style='height: 3px'></td>
					</tr>
					<tr>
						<td colSpan='5' class='center bg-gray fw-bold'>FECHA DE ATENCIÓN</td>
						<td rowSpan='5' class='border_cero' style='width:3px'></td>
						<td rowSpan='2' class='center bg-gray fw-bold'>HORA</td>
						<td rowSpan='5' class='border_cero' style='width:3px'></td>
						<td rowSpan='2' colSpan='4' class='center bg-gray fw-bold'>UPS</td>
						<td rowSpan='5' class='border_cero' style='width:3px'></td>
						<td rowSpan='2' class='center bg-gray fw-bold'>CÓD. PRESTA.</td>
						<td rowSpan='5' class='border_cero' style='width:3px'></td>
						<td rowSpan='2' colSpan='3' class='center bg-gray fw-bold'>CÓD. PRESTACION(ES) ADICIONAL (ES)</td>
						<td rowSpan='7' class='border_cero' style='width:3px'></td>
						<td rowSpan='8' class='center bg-gray fw-bold' style='text-rotate:90;'>HOSPITALIZACIÓN</td>
						<td colSpan='5' class='center bg-gray fw-bold'>FECHA</td>
						<td class='center bg-gray fw-bold'>DÍA</td>
						<td colSpan='2' class='center bg-gray fw-bold'>MES</td>
						<td colSpan='2' class='center bg-gray fw-bold'>AÑO</td>
					</tr>
					<tr>
						<td rowSpan='2' class='center bg-gray'>DIA</td>
						<td rowSpan='2' colSpan='2' class='center bg-gray'>MES</td>
						<td rowSpan='2' colSpan='2' class='center bg-gray'>AÑO</td>
						<td rowSpan='2' colSpan='5' class='center bg-gray'>DE INGRESO</td>
						<td rowSpan='2'></td>
						<td rowSpan='2' colSpan='2'></td>
						<td rowSpan='2' colSpan='2'></td>
					</tr>
					<tr>
						<td rowSpan='3' class='center'>".$HoraIngreso."</td>
						<td rowSpan='3' colSpan='4' class='center'>".$codigoServicioFUA."</td>
						<td rowSpan='3' class='center'>".$FuaCodigoPrestacion."</td>
						<td rowSpan='3' colSpan='3'></td>
					</tr>
					<tr>
						<td rowSpan='2' class='center'>".date('d',strtotime($FechaIngreso))."</td>
						<td rowSpan='2' colSpan='2' class='center'>".date('m',strtotime($FechaIngreso))."</td>
						<td rowSpan='2' colSpan='2' class='center'>".date('Y',strtotime($FechaIngreso))."</td>
						<td colSpan='7' class='border_cero' style='height: 3px'></td>
					</tr>
					<tr>
						<td colSpan='5' class='center bg-gray'>DE ALTA</td>
						<td></td>
						<td colSpan='2'></td>
						<td colSpan='2'></td>
					</tr>
					<tr>
						<td colSpan='10' class='border_cero' style='height: 3px'></td>
					</tr>
					<tr>
						<td rowSpan='2' colSpan='4' class='center bg-gray fw-bold'>REPORTE VINCULADO</td>
						<td colSpan='5' colSpan='6' class='center bg-gray fw-bold'>CÓD. AUTORIZACIÓN</td>
						<td rowSpan='2' class='border_cero' style='width:3px'></td>
						<td colSpan='4' colSpan='7' class='center bg-gray fw-bold'>N° FUA A VINCULAR</td>
						<td rowSpan='2' colSpan='5' class='center bg-gray'>DE CORTE ADMINISTRATIVO</td>
						<td rowSpan='2'></td>
						<td rowSpan='2' colSpan='2'></td>
						<td rowSpan='2' colSpan='2'></td>
					</tr>
					<tr>
						<td colSpan='6'>&nbsp;</td>
						<td colSpan='7' class='center'>".$FUAVinculado."</td>
					</tr>
					<tr>
						<td colSpan='19' class='border_cero' style='height:3px'></td>
					</tr>
					<tr>
						<td colSpan='30' class='center bg-gray fw-bold'>CONCEPTO PRESTACIONAL</td>
					</tr>
					<tr>
						<td rowSpan='2' colSpan='2' class='center bg-gray fw-bold'>ATENCIÓN DIRECTA</td>
						<td rowSpan='2'></td>
						<td rowSpan='2' colSpan='17'></td>
						<td colSpan='10' class='center bg-gray fw-bold'>SEPELIO</td>
					</tr>
					<tr>
						<td rowSpan='2' colSpan='4' class='center bg-gray fw-bold'>NATIMUERTO</td>
						<td rowSpan='2'></td>
						<td rowSpan='2' colSpan='2' class='center bg-gray fw-bold'>OBITO</td>
						<td rowSpan='2'></td>
						<td rowSpan='2' class='center bg-gray fw-bold'>OTRO</td>
						<td rowSpan='2' style='width: 20px'></td>
					</tr>
				</table>
				<div style=height:3px;></div>
				<table cellspacing='0' width='100%'>
					<tr>
						<td colSpan='19' class='center bg-gray fw-bold'>DEL DESTINO DEL ASEGURADO/USUARIO</td>
					</tr>
					<tr>
						<td rowSpan='2' class='center bg-gray'>ALTA</td>
						<td rowSpan='2'></td>
						<td rowSpan='2' class='center bg-gray'>CITA</td>
						<td rowSpan='2' colSpan='2'></td>
						<td rowSpan='2' class='center bg-gray'>HOSPITALIZACIÓN</td>
						<td rowSpan='2'></td>
						<td colSpan='6' class='center bg-gray fw-bold'>REFERIDO</td>
						<td rowSpan='2' class='center bg-gray'>CONTRA<br>RREFERIDO</td>
						<td rowSpan='2'></td>
						<td rowSpan='2' class='center bg-gray'>FALLECIDO</td>
						<td rowSpan='2'></td>
						<td rowSpan='2' class='center bg-gray'>CORTE <br>ADMINIS.</td>
						<td rowSpan='2'></td>
					</tr>
					<tr>
						<td class='center bg-gray'>EMERGENCIA</td>
						<td></td>
						<td class='center bg-gray'>CONSULTA<br> EXTERNA</td>
						<td></td>
						<td class='center bg-gray'>APOYO AL<br> DIAGNÓSTICO</td>
						<td></td>
					</tr>
					<tr>
						<td colSpan='19' class='border_cero' style='height: 3px'></td>
					</tr>
					<tr>
						<td colSpan='19' class='center bg-gray fw-bold'>SE REFIERE / CONTRARREFIERE A:</td>
					</tr>
					<tr>
						<td colSpan='6' class='center bg-gray fw-bold'>CÓDIGO RENAES DE LA IPRESS</td>
						<td colSpan='7' class='center bg-gray fw-bold'>NOMBRE DE LA IPRESS A LA QUE SE REFIERE / CONTRARREFIERE</td>
						<td colSpan='6' class='center bg-gray fw-bold'>N° HOJA DE REFER / CONTRARR.</td>
					</tr>
					<tr>
						<td colSpan='6'>&nbsp;</td>
						<td colSpan='7'></td>
						<td colSpan='6'></td>
					</tr>
				</table>
				<div style=height:3px;></div>
				<table cellspacing='0' width='100%'>
					<tr>
						<td colSpan='22' class='center bg-gray fw-bold'>ACTIVIDADES PREVENTIVAS Y OTROS</td>
						<td rowSpan='10' class='border_cero' style='width: 9px'></td>
						<td colSpan='9' class='center bg-gray fw-bold'>VACUNAS N° DE DOSIS</td>
					</tr>
					<tr>
						<td class='center bg-gray fw-bold' class='center bg-gray'>PESO (Kg)</td>
						<td colSpan='2'></td>
						<td colSpan='2' class='center bg-gray fw-bold' class='center bg-gray'>TALLA (cm)</td>
						<td colSpan='2'></td>
						<td colSpan='3' class='center bg-gray fw-bold' class='center bg-gray'>P.A. (mmHg)</td>
						<td></td>
						<td colSpan='2' class='center bg-gray fw-bold' class='center bg-gray'>IMC (Kg/m2)</td>
						<td colSpan='2'></td>
						<td colSpan='5' class='center bg-gray fw-bold' class='center bg-gray'>P.AB (cm)</td>
						<td colSpan='2'></td>

						<td class='center bg-gray' style='width:10px'>BCG</td>
						<td style='width:20px'></td>
						<td colSpan='2' class='center bg-gray'>INFLUENZA</td>
						<td style='width:20px'></td>
						<td class='center bg-gray'>ANTIAMARILICA</td>
						<td colSpan='3'></td>
					</tr>
					<tr>
						<td colSpan='2' class='center bg-gray fw-bold'>DE LA GESTANTE</td>
						<td rowSpan='8' class='border_cero'></td>
						<td colSpan='6' class='center bg-gray fw-bold'>DEL RECIEN NACIDO</td>
						<td rowSpan='6' class='border_cero' style='width:3px'></td>
						<td colSpan='5' class='center bg-gray fw-bold'>GESTANTE / RN /  NIÑO / ADOLESCENTE / JOVEN Y ADULTO / ADULTO MAYOR</td>
						<td rowSpan='6' class='border_cero' style='width:3px'></td>
						<td colSpan='6' class='center bg-gray fw-bold'>JOVEN Y<br>ADULTO</td>

						<td class='center bg-gray'>DPT</td>
						<td></td>
						<td colSpan='2' class='center bg-gray'>PAROTID</td>
						<td></td>
						<td class='center bg-gray'>ANTINEUMOC</td>
						<td colSpan='3'></td>
					</tr>
					<tr>
						<td class='center bg-gray'>CPN (N°)</td>
						<td style='width:20px'></td>
						<td colSpan='5' class='center bg-gray'>EDAD GEST RN<br> (SEM)</td>
						<td>&nbsp;&nbsp;</td>
						<td class='center bg-gray'>CRED N°</td>
						<td style='width:20px'></td>
						<td rowSpan='5' class='border_cero'></td>
						<td class='center bg-gray'>PAB (cm)</td>
						<td style='width:20px'></td>
						<td colSpan='5' class='center bg-gray fw-bold' class='center bg-gray'>EVALUACIÓN INTEGRAL</td>
						<td colSpan='1' style='width:10px'></td>

						<td class='center bg-gray'>APO</td>
						<td></td>
						<td colSpan='2' class='center bg-gray'>RUBEOLA</td>
						<td></td>
						<td class='center bg-gray'>ANTITETANICA</td>
						<td colSpan='3'></td>
					</tr>
					<tr>
						<td class='center bg-gray'>EDAD GEST</td>
						<td></td>
						<td rowSpan='2' colSpan='2' class='center bg-gray'>APGAR</td>
						<td rowSpan='2' class='center bg-gray fw-bold'>1°</td>
						<td rowSpan='2' style='width:20px'></td>
						<td rowSpan='2' class='center bg-gray fw-bold'>5°</td>
						<td rowSpan='2'></td>
						<td class='center bg-gray'>R.N. PREMATURO</td>
						<td></td>
						<td class='center bg-gray'>TAP/ EEDP<br> o TEPSI</td>
						<td></td>
						<td colSpan='6' class='center bg-gray fw-bold'>ADULTO MAYOR</td>
						
						<td  class='center bg-gray'>ASA</td>
						<td></td>
						<td colSpan='2' class='center bg-gray'>ROTAVIRUS</td>
						<td></td>
						<td class='center bg-gray'>COMPLETAS <br>PARA LA EDAD</td>
						<td colspan='3'></td>
						
					</tr>
					<tr>
						<td class='center bg-gray'>ALTURA UTERINA</td>
						<td></td>
						<td class='center bg-gray'>BAJO PESO AL<br> NACER</td>
						<td></td>
						<td class='center bg-gray'>CONSEJERIA NUTRICIONAL</td>
						<td></td>
						<td colSpan='5' class='center bg-gray'>VACAM</td>
						<td></td>

						<td class='center bg-gray'>SPR</td>
						<td></td>
						<td colSpan='2' class='center bg-gray'>DT ADULTO (N° DOSIS)</td>
						<td></td>
						<td class='center bg-gray'>VPH</td>
						<td colSpan='3'></td>
					</tr>
					<tr>
						<td rowSpan='2' class='center bg-gray'>PARTO VERTICAL</td>
						<td rowSpan='2'></td>
						<td rowSpan='2' colSpan='5' class='center bg-gray'>Corte Tardío de Cordón (2 a 3 min)</td>
						<td rowSpan='2'></td>
						<td rowSpan='2' class='center bg-gray'>ENFER. CONGENITA / SECUELA AL NACER</td>
						<td rowSpan='2'></td>
						<td rowSpan='2' class='center bg-gray'>CONSEJERIA INTEGRAL</td>
						<td rowSpan='2'></td>
						<td rowSpan='2' colSpan='5' class='center bg-gray'>TAMIZAJE DE SALUD MENTAL</td>
						<td colSpan='2'>PAT.</td> 

						<td class='center bg-gray'>SR</td>
						<td></td>
						<td colSpan='2' class='center bg-gray'>IPV</td>
						<td></td>
						<td class='center bg-gray'>OTRA VACUNA</td>
						<td colSpan='1'></td>
					</tr>
					
					<tr>
						<td>NOR.</td>
						<td  class='center bg-gray'>HVB</td>
						<td></td>
						<td  class='center bg-gray'>PENTAVAL</td>
						<td  colSpan='2' ></td>
						<td  colSpan='1' class='center bg-gray'>_________</td>
						<td></td>
					</tr>
					<tr>
						<td rowSpan='2' class='center bg-gray'>CONTROL PUERP (N°)</td>
						<td rowSpan='2'></td>
						<td colSpan='17' class='center bg-gray fw-bold'>TAMIZAJE DE PATOLOGÍAS CRÓNICAS</td>
						
						<td rowSpan='2'  class='center bg-gray' style='width:30px'>GRUPO DE RIESGO HVB</td>
						<td rowSpan='2' colSpan='3'></td>
						<td rowSpan='2' colSpan='5' style='font-size:7px;width:100px'>GRUPO DE RIESGO HVB: 1. TRABAJADOR DE SALUD   2. TRABAJAD. SEXUALES   3. HSH   4. PRIVADO LIBERTAD   5. FF. AA.  6. POLICIA NACIONAL   7. ESTUDIANTES DE SALUD   8. POLITRANFUNDIDOS  9. DROGO DEPENDIENTES</td>
					</tr>
					<tr>
						<td class='center bg-gray'>HB.GLICOSILADA (mg/dL)</td>
						<td colSpan='4'></td>
						<td colSpan='3' class='center bg-gray'>DOSAJE DE ALBUMINA EN ORINA (ug/mL)</td>
						<td colSpan='3'></td>
						<td colSpan='2' class='center bg-gray'>DEPURACION DE CREATININA (mL/min)</td>
						<td colSpan='7'></td>
					</tr>
				</table>
				<div style='height:3px;'></div>
				<table cellspacing='0' width='100%' style='margin-left:-5px'>
					<tr>
						<td rowSpan='9' class='border_cero' style='width:1px'></td>
						<td colSpan='9' class='center bg-gray fw-bold'>DIAGNÓSTICOS</td>
					</tr>
					<tr>
						<td rowSpan='2' class='center bg-gray fw-bold' style='width: 10px'>N°</td>
						<td rowSpan='2' class='center bg-gray fw-bold'>DESCRIPCIÓN</td>
						<td colSpan='4' class='center bg-gray fw-bold'>INGRESO</td>
						<td colSpan='3' class='center bg-gray fw-bold'>EGRESO</td>
					</tr>
					<tr>
						<td class='center bg-gray fw-bold'>P</td>
						<td class='center bg-gray fw-bold'>D</td>
						<td class='center bg-gray fw-bold'>R</td>
						<td class='center bg-gray fw-bold'>CIE - 10</td>
						<td class='center bg-gray fw-bold'>D</td>
						<td class='center bg-gray fw-bold'>R</td>
						<td class='center bg-gray fw-bold'>CIE - 10</td>
					</tr>";
					$i=1;
			if(count($diagnosticos)>0){
				foreach($diagnosticos as $diagnostico){
					$diagnosticoTipo1="";
					$diagnosticoTipo2="";
					$diagnosticoTipo3="";
					if($diagnostico->Tipo=="P"){
						$diagnosticoTipo1="X";
					}
					else if($diagnostico->Tipo=="D"){
						$diagnosticoTipo2="X";
					}
					else if($diagnostico->Tipo=="R"){
						$diagnosticoTipo3="X";
					}
					$html.="
							<tr>
								<td class='center bg-gray'>".$i."</td>
								<td>".$diagnostico->Descripcion."</td>
								<td class='center'>".$diagnosticoTipo1."</td>
								<td class='center'>".$diagnosticoTipo2."</td>
								<td class='center'>".$diagnosticoTipo3."</td>
								<td class='center'>".$diagnostico->codigoCIEsinPto."</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>";
					$i++;
				}
				if(count($diagnosticos)<4){
					for($j=1;$j<=(4-count($diagnosticos));$j++){
						$html.="
						<tr>
							<td class='center bg-gray'>".$i."</td>
							<td></td>
							<td></td>
							
						</tr>";
						$i++;
					}
				}
			}
			else{
				// for($j=1;$j<=6;$j++){
				// 	$html.="
				// 	<tr>
				// 		<td class='center bg-gray'>".$j."</td>
				// 		<td>&nbsp;<br>&nbsp;</td>
				// 		<td></td>
				// 		<td></td>
				// 		<td></td>
				// 		<td></td>
				// 		<td></td>
				// 		<td></td>
				// 		<td></td>
				// 	</tr>";

				// }
			}

					$html .= "
					
					</table>
				<div style=height:3px;></div>
				<table cellspacing='0' width='100%' style='margin-left:-5px'>
					<tr>
						<td rowSpan='4' class='border_cero'></td>
						<td class='center bg-gray fw-bold'>N° DE DNI</td>
						<td colSpan='5' class='center bg-gray fw-bold'>NOMBRE DEL RESPONSABLE DE LA ATENCIÓN</td>
						<td colSpan='2' class='center bg-gray fw-bold'>N° DE COLEGIATURA</td>
					</tr>
					<tr>
						<td class='center'></td>
						<td colSpan='5' class='center'></td>
						<td colSpan='2' class='center'></td>
					</tr>
					<tr>	
						<td class='center bg-gray'>RESPONSABLE DE LA ATENCIÓN</td>
						<td class='center'></td>
						<td class='center bg-gray'>ESPECIALIDAD</td>
						<td></td>
						<td class='center bg-gray'>N° RNE</td>
						<td class='center'></td>
						<td class='center bg-gray'>EGRESADO</td>
						<td></td>
					</tr>
					<tr>
						<td colSpan='8' class='border_cero' style='font-size: 7px'>1. MÉDICO   2. FARMACEUTICO   3. CIRUJANO DENTISTA   4. BIÓLOGO  5. OBSTETRIZ   6. ENFERMERA  7. TRABAJADORA SOCIAL   8. PSICOLOGA  9.TECNOLOGO MEDICO    10.NUTRICION    11. TECNICO ENFERMERIA   12. AUXILIAR DE ENFERMERIA    13. OTRO</td>
					</tr>
				</table>
				<table cellspacing='0' width='100%' style='margin-bottom:15px;'>
					<tr>
						<td rowSpan='6' class='border_cero' style='width: 50px'></td>
						<td rowSpan='5' class='left right top'></td>
						<td rowSpan='6' class='border_cero' style='width: 50px'></td>
						<td class='border_cero' style='width: 20px; height:20px'>FIRMA</td>
					</tr>
					<tr>
						<td class='border_cero'>ASEGURADO</td>
						<td style='width: 20px'></td>
						<td class='border_cero' style='width: 50px'></td>
					</tr>
					<tr>
						<td class='border_cero'>REPRESENTANTE</td>
						<td style='width: 20px'></td>
						<td class='border_cero'></td>
						<td class='left right top'></td>
					</tr>
					<tr>
						<td class='border_cero'>REPRESENTANTE:</td>
					</tr> 
					<tr>
						<td colSpan='3' class='border_cero' style='height:15px;vertical-align: bottom;'>NOMBRES Y APELLIDOS</td>
						<td class='left right top'></td>
					</tr>
					<tr>
						<td class='left right bottom center' style='width:250px'>FIRMA Y SELLO DEL RESPONSABLE DE LA ATENCIÓN</td>
						<td colSpan='3' class='border_cero' style='height:20px;vertical-align: bottom;'>DNI o CE DEL REPRESENTANTE:</td>
						<td class='left right top'></td>
					</tr>
				</table>

				<div style='page-break-after: always;'></div>

				<table cellspacing='0' width='100%'>
						<tr>
							<td rowSpan='2' class='border_cero' style='width:470px'></td>
							<td colSpan='3' class='center bg-gray fw-bold'>FORMATO DE ATENCIÓN  Nº</td>
						</tr>
						<tr>
							<td class='center fw-bold'>".$FuaDisa."</td>
							<td class='center fw-bold'>".$FuaLote."</td>
							<td class='center fw-bold'>".$FuaNumero."</td>
						</tr>
					</table>
					<div style=height:5px;></div>
					<table cellspacing='0' width='100%'>
						<tr>
							<td colSpan='14' class='center bg-gray fw-bold'>PRODUCTOS FARMACEUTICOS / MEDICAMENTOS</td>
						</tr>
						<tr>
							<td class='center bg-gray fw-bold'>CÓDIGO SISMED</td>
							<td class='center bg-gray fw-bold'>NOMBRE <br>(Denominacion,Concentracion,Presentacion,<br>FormaFarmaceutica)</td>
							<td class='center bg-gray fw-bold'>FF</td>
							<td class='center bg-gray fw-bold'>CONCENTR</td>
							<td class='center bg-gray fw-bold'>PRES</td>
							<td class='center bg-gray fw-bold'>ENTR</td>
							<td class='center bg-gray fw-bold'>DX</td>
							<td class='center bg-gray fw-bold'>CÓDIGO SISMED</td>
							<td class='center bg-gray fw-bold'>NOMBRE <br>(Denominacion,Concentracion,Presentacion,<br>FormaFarmaceutica)</td>
							<td class='center bg-gray fw-bold'>FF</td>
							<td class='center bg-gray fw-bold'>CONCENTR</td>
							<td class='center bg-gray fw-bold'>PRES</td>
							<td class='center bg-gray fw-bold'>ENTR</td>
							<td class='center bg-gray fw-bold'>DX</td>
						</tr>";
						$dx="";
			if(isset($diagnosticos[0])){
				$dx= $diagnosticos[0]->codigoCIEsinPto;
			}

			$i=1;
			if(count($medicamentos)>0){
				foreach($medicamentos as $medicamento){
					$html.="
						<tr>
							<td class='center' style='padding: 3px'>".$medicamento->Codigo."</td>
							<td>".$medicamento->Nombre."</td>
							<td></td>
							<td></td>
							<td class='center'>".$medicamento->Cantidad."</td>
							<td class='center'>".$medicamento->Cantidad."</td>
							<td class='center'>".$dx."</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>";
					$i++;
				}
				if(count($medicamentos)<13){
					for($j=1;$j<=(13-count($medicamentos));$j++){
						$html.="
							<tr>
								<td style='padding: 3px'>&nbsp;</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						";
						$i++;
					}
				}
			}
			else{
				for($j=1;$j<=13;$j++){
					$html.="
					<tr>
						<td style='padding: 3px'>&nbsp;</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>";
				}
			}
						$html .="<tr>
						<td colSpan='12' class='border_cero' style='height:5px'></td>
					</tr>
					<tr>
						<td colSpan='14' class='center bg-gray fw-bold'>DISPOSITIVOS MÉDICOS / PRODUCTOS SANITARIOS</td>
					</tr>
					<tr>
						<td class='center bg-gray fw-bold'>CÓDIGO</td>
						<td class='center bg-gray fw-bold'>NOMBRE <br>(Denominacion,Concentracion,Presentacion,<br>Caracteristicas)</td>
						<td class='center bg-gray fw-bold'>FF</td>
						<td class='center bg-gray fw-bold'>CONCENTR</td>
						<td class='center bg-gray fw-bold'>PRES</td>
						<td class='center bg-gray fw-bold'>ENTR</td>
						<td class='center bg-gray fw-bold'>DX</td>
						<td class='center bg-gray fw-bold'>CÓDIGO</td>
						<td class='center bg-gray fw-bold'>NOMBRE <br>(Denominacion,Concentracion,Presentacion,<br>Caracteristicas)</td>
						<td class='center bg-gray fw-bold'>FF</td>
						<td class='center bg-gray fw-bold'>CONCENTR</td>
						<td class='center bg-gray fw-bold'>PRES</td>
						<td class='center bg-gray fw-bold'>ENTR</td>
						<td class='center bg-gray fw-bold'>DX</td>
					</tr>";
					$i=1;
			if(count($insumos)>0){
				foreach($insumos as $insumo){
					$html.="
							<tr>
								<td class='center' style='padding: 3px'>".$insumo->Codigo."</td>
								<td colSpan='2'>".$insumo->Nombre."</td>
								<td></td>
								<td></td>
								<td class='center'>".$insumo->Cantidad."</td>
								<td class='center'>".$insumo->Cantidad."</td>
								<td class='center'>".$dx."</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>";
					$i++;
				}
				if(count($insumos)<13){
					for($j=1;$j<=(13-count($insumos));$j++){
						$html.="
							<tr>
								<td style='padding: 3px'>&nbsp;</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						";
						$i++;
					}
				}
			}
			else{
				for($j=1;$j<=13;$j++){
					$html.="
					<tr>
						<td style='padding: 3px'>&nbsp;</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>";
				}
			}
			$html .= "<tr>
            <td colSpan='12' class='border_cero' style='height:5px'></td>
        </tr>
        <tr>
            <td colSpan='14' class='center bg-gray fw-bold'>PROCEDIMIENTOS/ DIAGNÓSTICO POR IMÁGENES/ LABORATORIO</td>
        </tr>
        <tr>
            <td class='center bg-gray fw-bold'>CÓDIGO</td>
            <td colSpan='2' class='center bg-gray fw-bold'>NOMBRE</td>
            <td class='center bg-gray fw-bold'>IND</td>
            <td class='center bg-gray fw-bold'>EJE</td>
            <td class='center bg-gray fw-bold'>DX</td>
            <td class='center bg-gray fw-bold'>RES</td>
            <td class='center bg-gray fw-bold'>CÓDIGO</td>
            <td colSpan='2' class='center bg-gray fw-bold'>NOMBRE</td>
            <td class='center bg-gray fw-bold'>IND</td>
            <td class='center bg-gray fw-bold'>EJE</td>
            <td class='center bg-gray fw-bold'>DX</td>
            <td class='center bg-gray fw-bold'>RES</td>
        </tr>";

$i = 1; // Contador de filas.
if (count($procedimientos) > 0) {
    foreach (array_chunk($procedimientos, 2) as $procedimientosFila) {
        // Cada "fila" agrupa dos procedimientos del array.
        $html .= "<tr>";

        // Procedimiento 1 (primera columna)
        if (isset($procedimientosFila[0])) {
            $html .= "
                <td class='center' style='padding: 3px'>" . $procedimientosFila[0]['Codigo'] . "</td>
                <td colSpan='2'>" . $procedimientosFila[0]['Nombre'] . "</td>
                <td class='center'>" . $procedimientosFila[0]['Cantidad'] . "</td>
                <td class='center'>" . $procedimientosFila[0]['Cantidad'] . "</td>
                <td class='center'>" . $dx . "</td>
                <td></td>";
        } else {
            $html .= "
                <td style='padding: 3px'>&nbsp;</td>
                <td colSpan='2'></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>";
        }

        // Procedimiento 2 (segunda columna)
        if (isset($procedimientosFila[1])) {
            $html .= "
                <td class='center' style='padding: 3px'>" . $procedimientosFila[1]['Codigo'] . "</td>
                <td colSpan='2'>" . $procedimientosFila[1]['Nombre'] . "</td>
                <td class='center'>" . $procedimientosFila[1]['Cantidad'] . "</td>
                <td class='center'>" . $procedimientosFila[1]['Cantidad'] . "</td>
                <td class='center'>" . $dx . "</td>
                <td></td>";
        } else {
            $html .= "
                <td style='padding: 3px'>&nbsp;</td>
                <td colSpan='2'></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>";
        }

        $html .= "</tr>";
        $i++;
    }

    // Rellena filas vacías si hay menos de 13 procedimientos (hasta llegar a 13 filas).
    $totalProcedimientos = count($procedimientos);
    if ($totalProcedimientos < 13) {
        for ($j = 1; $j <= (13 - ceil($totalProcedimientos / 2)); $j++) {
            $html .= "
            <tr>
                <td style='padding: 3px'>&nbsp;</td>
                <td colSpan='2'></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colSpan='2'></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>";
            $i++;
        }
    }
} else {
    // Rellena todas las filas vacías si no hay procedimientos.
    for ($j = 1; $j <= 13; $j++) {
        $html .= "
        <tr>
            <td style='padding: 3px'>&nbsp;</td>
            <td colSpan='2'></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colSpan='2'></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>";
    }
}
					$html.="</table>
				<div style=height:5px;></div>
				<table cellspacing='0' width='100%'>
					<tr>
						<td colSpan='9' class='center bg-gray fw-bold'>SUB COMPONENTE PRESTACIONAL (PROCEDIMIENTOS)</td>
					</tr>
					<tr>
						<td class='center bg-gray fw-bold'>CÓDIGO</td>
						<td class='center bg-gray fw-bold'>NOMBRE</td>
						<td class='center bg-gray fw-bold'>CARACT</td>
						<td class='center bg-gray fw-bold'>IND/ PRES</td>
						<td class='center bg-gray fw-bold'>EJE/ENTR</td>
						<td class='center bg-gray fw-bold'>DX</td>
						<td class='center bg-gray fw-bold'>RES</td>
						<td class='center bg-gray fw-bold'>N° TICKET</td>
						<td class='center bg-gray fw-bold'>PO</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td colSpan='9' class='center bg-gray fw-bold'>OBSERVACIONES</td>
					</tr>
					<tr>
						<td colSpan='9'>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;</td>
					</tr>
				</table>
				<table cellspacing='0' width='100%' style='margin-bottom:15px;'>
					<tr>
						<td rowSpan='6' class='border_cero' style='width: 50px'></td>
						<td rowSpan='5' class='left right top'></td>
						<td rowSpan='6' class='border_cero' style='width: 50px'></td>
						<td class='border_cero' style='width: 20px; height:20px'>FIRMA</td>
					</tr>
					<tr>
						<td class='border_cero'>ASEGURADO</td>
						<td style='width: 20px'></td>
						<td class='border_cero' style='width: 50px'></td>
					</tr>
					<tr>
						<td class='border_cero'>REPRESENTANTE</td>
						<td style='width: 20px'></td>
						<td class='border_cero'></td>
						<td class='left right top'></td>
					</tr>
					<tr>
						<td class='border_cero'>REPRESENTANTE:</td>
					</tr> 
					<tr>
						<td colSpan='3' class='border_cero' style='height:15px;vertical-align: bottom;'>NOMBRES Y APELLIDOS</td>
						<td class='left right top'></td>
					</tr>
					<tr>
						<td class='left right bottom center' style='width:250px'>Firma y Sello del Responsable de UPSS de apoyo diagnóstico 
						(Procedimiento y/o Farmacia y/o Laboratorio o el que corresponda)
						</td>
						<td colSpan='3' class='border_cero' style='height:20px;vertical-align: bottom;'>DNI o CE DEL REPRESENTANTE:</td>
						<td class='left right top'></td>
					</tr>
				</table>

</body>
</html>";
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('FUA.pdf', ['Attachment' => false]);

} else {
    echo "Error: No se encontró la clave 'datos' o no es un array.";
}


} else {
    http_response_code(400);
    echo "Método no permitido.";
}

?>
