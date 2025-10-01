<?php 
// function ObtenerConexion()
// {
// 	$DB_DSN='sqlsrv:Server=192.168.36.128;Database=SIGH';
// 	$DB_USER='sa';
// 	$DB_PASSWORD='123456';
// 	$resultado=false;
// 	$mensaje='';
// 	$conn=null;
// 	try {
// 		$conn = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD);
// 		$resultado=true;
// 	} catch (Exception $e) {
// 		$mensaje=$e->getMessage();
// 	}
// 	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"conn"=>$conn];
// }
// function CreaMovimientoLaboratorio($elemmentos)
// {
// 	$resultado=false;
// 	$mensaje='';
// 	$datos=null;
// 	try{
// 		$ObtenerConexion=ObtenerConexion();
// 		if($ObtenerConexion['resultado'])
// 		{
// 			$resultado_p='';
// 			$mensaje_p='';
// 			$IdMovimiento_p='';
// 			$tsql = "exec rs_crea_movimiento_laboratorio ?,?,?,?,?,?,?,?,?,?,?,?,?";
// 			$getReviews =$ObtenerConexion['conn']->prepare($tsql);
// 			$getReviews->bindValue(1,$elemmentos["IdCuentaAtencion"],PDO::PARAM_STR);
// 			$getReviews->bindValue(2,$elemmentos["IdPuntoCarga"],PDO::PARAM_STR);
// 			$getReviews->bindValue(3,$elemmentos["idPersonaTomaLab"],PDO::PARAM_STR);
// 			$getReviews->bindValue(4,$elemmentos["idPersonaRecoge"],PDO::PARAM_STR);
// 			$getReviews->bindValue(5,$elemmentos["OrdenaPrueba"],PDO::PARAM_STR);
// 			$getReviews->bindValue(6,$elemmentos["IdMedico"],PDO::PARAM_STR);
// 			// $getReviews->bindValue(5,$elemmentos["idEspecialidadOrdenaPrueba"],PDO::PARAM_STR);
// 			$getReviews->bindValue(7,$elemmentos["idProductoCPT"],PDO::PARAM_STR);
// 			$getReviews->bindValue(8,$elemmentos["Fecha"],PDO::PARAM_STR);
// 			$getReviews->bindValue(9,$elemmentos["IdUsuario"],PDO::PARAM_STR);
// 			$getReviews->bindValue(10,$elemmentos["IdservicioEgreso"],PDO::PARAM_STR);
// 			$getReviews->bindParam(11,$resultado_p,PDO::PARAM_STR,1);
// 			$getReviews->bindParam(12,$mensaje_p,PDO::PARAM_STR,200);
// 			$getReviews->bindParam(13,$IdMovimiento_p,PDO::PARAM_STR,200);
// 			if($getReviews->execute())
// 			{
// 				if($resultado_p==1)
// 				{
// 					$datos=$IdMovimiento_p;
// 					$resultado=true;
// 				}
// 				else
// 					$mensaje=$mensaje_p;
// 			}
// 			else
// 				$mensaje=$getReviews->errorInfo()[2];
// 		}
// 		else
// 			$mensaje=$ObtenerConexion['mensaje'];
// 	} catch(Exception $e){
// 		$mensaje=$e->getMessage();
// 	}
// 	return ["resultado"=>$resultado,"mensaje"=>$mensaje,"datos"=>$datos];
// }
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