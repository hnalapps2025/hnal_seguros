<?php

error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Debes iniciar sesión para continuar.'); window.location='index.php';</script>";  
  exit;
} 

include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (CONTROLLER_PATH."conexion.php");
include (MODEL_PATH."global.php");
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');



$inicio= $_POST["min"];
$fin= $_POST["max"];

$db = new Conectar();
$conn = $db->conexion();

if (isset($_POST["import"]))
{


  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'temp/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);

        $sheetCount = count($Reader->sheets());

                for($i=0;$i< $sheetCount;$i++)
                {
                    
                        if($i==0){

                            $Reader->ChangeSheet($i);
                    
                                    foreach ($Reader as $Row)
                                    {
                                                       
                                    
                                            $Dat0  = mysqli_real_escape_string($conn,$Row[0]);
                                            $Dat1  = mysqli_real_escape_string($conn,$Row[1]);
                                            $Dat2  = mysqli_real_escape_string($conn,$Row[2]);
                                            $Dat4  = mysqli_real_escape_string($conn,$Row[4]);
                                            $Dat5  = mysqli_real_escape_string($conn,$Row[5]);
                                            $Dat6  = mysqli_real_escape_string($conn,$Row[6]);
                                            $Dat7  = mysqli_real_escape_string($conn,$Row[7]);
                                            $Dat8  = mysqli_real_escape_string($conn,$Row[8]);
                                            $Dat9  = mysqli_real_escape_string($conn,$Row[9]);
                                            $Dat10 = mysqli_real_escape_string($conn,$Row[10]);
                                            $Dat11 = mysqli_real_escape_string($conn,$Row[11]);
                                            $Dat12 = mysqli_real_escape_string($conn,$Row[12]);
                                           
                                            

                                            $roTs= substr($Dat0, 0, 11);
                                            $roTsa= substr($Dat0, -12);
                                            $roTsanio= substr($roTsa, 0, 4);
                                            $enTer = substr($roTsa, -8);

                                            $paciente = $Row[6]." ".$Row[7]." ".$Row[8];

                                            $a1 = explode("-", $Dat1);
                                            $Datq = $a1[2]."-".$a1[0]."-".$a1[1];

                                            $a2 = explode("-", $Dat2);
                                            $Datq2 = $a2[2]."-".$a2[0]."-".$a2[1];
                                            
                                            $a3 = explode("-", $Dat9);
                                            $Datq3 = $a3[2]."-".$a3[0]."-".$a3[1];
// 

                                            
                                            $sqlNum = "SELECT `idCar` FROM `cartagarantia` WHERE `NroCarta2`='$roTsanio' AND NroCarta3='$enTer'";
                                            $resultNum = $conn->query($sqlNum);
                                            $fil = $resultNum->num_rows ;
                                            $count = 1;

                                            if($fil==0){

                                                    $query = "INSERT INTO `cartagarantia`( `nrodoc`, `NroCarta`, `NroCarta2`, `NroCarta3`,
                                                    `Paciente`, `Fecha_Carta`,`CIE10`,`Fecha_Inicio_Vigencia`,`Fecha_Fin_Vigencia`, `referencia`) 
                                                    VALUES ('".$Dat5."','".$roTs."','".$roTsanio."','".$enTer."','".$paciente."','".$Datq3."','".$Dat4."',
                                                    '".$Datq."','".$Datq2."','".$Dat10."')";

                                                    $result = mysqli_query($conn, $query);
                                                   
                                                
                                                    if (!empty($result)) {
                                                    //    echo $count ++ ."<br><br>" ;
                                                        $type = "success";
                                                        $message = "Datos de Excel importados correctamente a la base de datos";
                                                    } else {
                                                        $type = "error";
                                                        $message = "Problema al importar datos de Excel";
                                                    }

                                            }      

                                    }

                         }

                         if($i==1){

                            $Reader->ChangeSheet($i);
                    
                                    foreach ($Reader as $Row)
                                    {
                                                       
                                    
                                            $Dat0  = mysqli_real_escape_string($conn,$Row[0]);
                                            $Dat1  = mysqli_real_escape_string($conn,$Row[1]);
                                            $Dat2  = mysqli_real_escape_string($conn,$Row[2]);
                                            $Dat4  = mysqli_real_escape_string($conn,$Row[4]);
                                            $Dat5  = mysqli_real_escape_string($conn,$Row[5]);
                                            $Dat6  = mysqli_real_escape_string($conn,$Row[6]);
                                            $Dat7  = mysqli_real_escape_string($conn,$Row[7]);
                                            $Dat8  = mysqli_real_escape_string($conn,$Row[8]);
                                            $Dat9  = mysqli_real_escape_string($conn,$Row[9]);
                                            $Dat10 = mysqli_real_escape_string($conn,$Row[10]);
                                            $Dat11 = mysqli_real_escape_string($conn,$Row[11]);
                                            $Dat12 = mysqli_real_escape_string($conn,$Row[12]);




                                            $roTsa= substr($Dat1, -12);
                                            $roTsanio= substr($roTsa, 0, 4);
                                            $enTer = substr($roTsa, -8);

                                            $a3 = explode("-", $Dat10);
                                            $Datq3 = $a3[2]."-".$a3[0]."-".$a3[1];

                                            $sqlNum = "SELECT `idCar` FROM `cartagarantia` WHERE `NroCarta2`='$roTsanio' AND NroCarta3='$enTer'";
                                            $resultNum = $conn->query($sqlNum);
                                            $row = $resultNum->fetch_assoc();
                                            $idpre =$row["idCar"];
                                            //$fil = $resultNum->num_rows ;

                                            $count = 1;
                                    
                                            $query = "INSERT INTO `cuentas`( `idprestacion`, `nrocuenta`, `historia`, `fatencion`,
                                              `estado`)VALUES ('".$idpre."','".$Dat0."','".$Dat6."','".$Datq3."','".$Dat12."')";
                                           // echo $query."<br>";

                                            $result = mysqli_query($conn, $query);
                                           
                                        
                                            if (!empty($result)) {
                                               // echo $count ++ ."<br><br>" ;
                                                $type = "success";
                                                $message = "Datos de Excel importados correctamente a la base de datos";
                                            } else {
                                                $type = "error";
                                                $message = "Problema al importar datos de Excel";
                                            }



                                    }

                         }





                }            
        
         }
  }

  
  else
  { 
        $type = "error";
        $message = "Debe seleccionar un archivo excel";
  }



?>

<!DOCTYPE html>
<html>    
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >

<style>    
body {
	font-family: Arial;
	text-align: center;
}

.outer-container {
	background: #F0F0F0;
	border: #e0dfdf 1px solid;
	padding: 40px 20px;
	border-radius: 2px;
}

.btn-submit {
	background: #ff0d0d;
    border: #ff0d0d 1px solid;
    border-radius: 2px;
	color: #f0f0f0;
	cursor: pointer;
    padding: 5px 20px;
    font-size:0.9em;
}

.btn-success {
	background: white;
    border: black 1px solid;
    border-radius: 2px;
    color: black;
    cursor: pointer;
    padding: 13px 39px;
    font-size: 0.9em;
    text-decoration: none;
}
.tutorial-table {
    margin-top: 40px;
    font-size: 0.8em;
	border-collapse: collapse;
	width: 100%;
}

.tutorial-table th {
    background: #f0f0f0;
    border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.tutorial-table td {
    background: #FFF;
	border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
    padding: 10px;
    margin-top: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
</head>

<body>
    <h2><br></h2>
    
    <div class="outer-container">
        <form action="" method="post"  name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <input type="file" name="file" id="file" accept=".xls,.xlsx" style="width: 20%;">
                <button type="submit" id="submit" name="import"  class="btn-submit">Importar</button>
            </div>
        
        </form>
        
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?>
    
    </div>
          
         <br><br><br><br><br><br><br>
            <center><a href="cartas.php" class="btn-success"><- REGRESAR</a></center>

</body>
</html>