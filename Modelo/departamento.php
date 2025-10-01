<?php 


require './../Controlador/conexion.php';
$db = new Conectar();
$conn = $db->conexion();


$sql = "SELECT idDepartamento,departamento FROM departamentos ";
mysqli_set_charset($conn, "utf8"); 

if(!$result = mysqli_query($conn, $sql)) die();

$clientes = array(); 

while($row = mysqli_fetch_array($result)) 
{ 
    $idDepartamento=$row['idDepartamento'];
    $departamento=$row['departamento'];
    $clientes[] = array('idDepartamento'=> $idDepartamento, 'departamento'=> $departamento);
 
}
    
$close = mysqli_close($conn) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

$json_string = json_encode($clientes);
echo $json_string;


?>