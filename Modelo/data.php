<?php

include_once ($_SERVER['DOCUMENT_ROOT'].'/NoTarifados/config.php');
include (CONTROLLER_PATH."conexion.php");

$db = new Conectar();
$conn = $db->conexion();

$anio = $_GET["id"];

//$sql = "SELECT id as Empid,employee_name as Name,employee_salary as Salary FROM employee LIMIT 20";
$sql = "SELECT `idPac`, `anio`, `r_beneficiario`, `rg_NroDoc`, `rg_Afiliacion`,rg_FechaAtencion,
`rg_NroFua`, `procedimiento`,`montoSolicitado`, `oficioEnvio`,`tipoRegistro`, `docAprob`,
 `estadoAprob`, `fecha`, `montoAprobObser`, `totalAprob`, `oficioLevantam`, `rj`, `fecharj`, 
 `estadoRj` FROM `repo_fissal` WHERE anio= '$anio'  ORDER BY anio ASC LIMIT 20";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$data = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
        $data[] = $rows;
    }

$results = array(
"sEcho" => 1,
"iTotalRecords" => count($data),
"iTotalDisplayRecords" => count($data),
"aaData"=>$data);

echo json_encode($results);

?>