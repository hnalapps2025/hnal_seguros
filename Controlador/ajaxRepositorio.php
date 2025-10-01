<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/sis/config.php');
include (CONTROLLER_PATH."conexion.php");


$function = $_GET['function'];

$conn = new PDO("mysql:host=".DB_SERVER.";charset=utf8;port=".DB_PORT.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if($function=="lisRepo"){

	try {
			
		$stmt = $conn->prepare("SELECT R.`idPac`, U.user as usuario, R.`nroCuenta`, R.`Historia`, R.`nroFua`, R.`paciente`, R.iafa,
		R.`F_Ingreso`, R.`F_Alta_Medica`, R.`servicio`, R.`licenciada`, R.`firma`, R.`auditor`, R.`observacion`,
		R.`tecnico` FROM `repositorio` AS R
		LEFT JOIN usuarios AS U ON R.iduser=U.id
		 ORDER BY R.F_Alta_Medica DESC" );
		$stmt->execute();
		
		$data = array();
		while($row = $stmt->fetch()) {
			//
			$nestedData=array(); 
			
			$nestedData['nroCuenta'] 		=  $row['nroCuenta'];
			$nestedData['Historia'] 		=  $row['Historia'];
			$nestedData['iafa'] 			=  $row['iafa'];
			$nestedData['nroFua'] 			=  $row['nroFua'];
			$nestedData['paciente'] 		=  $row['paciente'];
			$nestedData['F_Ingreso'] 		=  date('d/m/Y',strtotime($row['F_Ingreso']));		
			$nestedData['F_Alta_Medica'] 	=  date('d/m/Y',strtotime($row['F_Alta_Medica']));
			$nestedData['F_Alta_Medic']  	=  $row['F_Alta_Medica'];
			$nestedData['servicio'] 	 	=  $row['servicio'];
			$nestedData['usuario'] 	 		=  $row['usuario'];
			$nestedData['auditor'] 	 		=  $row['auditor'];
			$nestedData['observacion'] 	 	=  $row['observacion'];
			
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

//

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

							//
		
							echo json_encode($datos);

			}
		
}

?>