<?php 


require './../Controlador/conexion.php';
$db = new Conectar();
$conn = $db->conexion();




$pro = $_POST['pro']; 
$sql = "SELECT idDistrito,distrito FROM distrito WHERE idProvincia=$pro ORDER BY distrito ASC";
mysqli_set_charset($conn, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($conn, $sql)) die();

$clientes = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
    $idDistrito=$row['idDistrito'];
    $distrito=$row['distrito'];
   
    $clientes[] = array('idDistrito'=> $idDistrito, 'distrito'=> $distrito);

}
    
//desconectamos la base de datos
$close = mysqli_close($conn) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
$json_string = json_encode($clientes);
echo $json_string;

//Si queremos crear un archivo json, sería de esta forma:
/*
$file = 'clientes.json';
file_put_contents($file, $json_string);
*/
    

?>