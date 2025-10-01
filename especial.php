<?php

error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Debes iniciar sesión para continuar.'); window.location='index.php';</script>";  
  exit;
} 

include_once ($_SERVER['DOCUMENT_ROOT'].'/sis/config.php');
include (CONTROLLER_PATH."conexion.php");
include (MODEL_PATH."global.php");
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

$pres= $_GET["id"];

if (isset($_POST["import"]))
{
    

  $db = new Conectar();
  $conn = $db->conexion();
    
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);

        $sheetCount = count($Reader->sheets());

                for($i=0;$i< $sheetCount;$i++)
                {
                    //
                        if($i==0){

                            $Reader->ChangeSheet($i);
                    
                                foreach ($Reader as $Row)
                                {
                                    
                                                                    
                                                $Dat0  = mysqli_real_escape_string($conn,$Row[0]);
                                                $Dat1  = mysqli_real_escape_string($conn,$Row[1]);
                                                $Dat2  = mysqli_real_escape_string($conn,$Row[2]);
                                                $Dat3  = mysqli_real_escape_string($conn,$Row[3]);
                                                $Dat4  = mysqli_real_escape_string($conn,$Row[4]);
                                                $Dat5  = mysqli_real_escape_string($conn,$Row[5]);
                                                $Dat6  = mysqli_real_escape_string($conn,$Row[6]);
                                                $pax   = $Dat3." ".$Dat4." ".$Dat5." ".$Dat6;
                                                $Dat14 = mysqli_real_escape_string($conn,$Row[14]);
                                                $Dat17 = mysqli_real_escape_string($conn,$Row[17]);
                                                $Dat19 = mysqli_real_escape_string($conn,$Row[19]);
                                                $Dat30 = mysqli_real_escape_string($conn,$Row[30]);

                                              /*  $Dat7 = mysqli_real_escape_string($conn,$Row[7]);
                                                $Dat8 = mysqli_real_escape_string($conn,$Row[8]);
                                                $Dat9 = mysqli_real_escape_string($conn,$Row[9]);
                                                $Dat10 = mysqli_real_escape_string($conn,$Row[10]);*/
                                            
                                                if($Dat0!=""){

                                                    $consulta = "SELECT `idPac`, `iduser`, `nroCuenta`, `Historia`, `nroFua` FROM `repositorio` WHERE `nroCuenta`='$Dat2'";
                                                    $verIf = mysqli_query($conn,$consulta);
                                                    $cnt = mysqli_num_rows($verIf);
                                                   // echo $cnt;

                                                    if($cnt == 0){
    
                                                            $query = "INSERT INTO `repositorio`( `iduser`, `nroCuenta`, `Historia`, `nroFua`,
                                                            `paciente`,iafa, `F_Ingreso`, `F_Alta_Medica`, `servicio`) VALUES 
                                                            ('".$iduser."','".$Dat2."','".$Dat0."','".$Dat1."','".$pax."','".$Dat14."','".$Dat17."'
                                                            ,'".$Dat19."','".$Dat30."')";
                                                           $result = mysqli_query($conn, $query);
                                                        
                
                                                            if (!empty($result)) {
                                                                    $type = "success";
                                                                    $message = "Datos de Excel importados correctamente a la base de datos";
                                                            } else {
                                                                    echo $query;
                                                                    $type = "error";
                                                                    $message = "Problema al importar datos de Excel";
                                                                
                                                            }
    
                                                    }else{

                                                                $query = "UPDATE `repositorio` SET `F_Ingreso`='$Dat17',`F_Alta_Medica`='$Dat19' WHERE `nroCuenta` ='$Dat2'";
                                                                $result = mysqli_query($conn, $query);
                                                            

                                                            $type = "success";
                                                            $message = "Datos de Excel importados correctamente a la base de datos";

                                                    }



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
    <h2>Importar tu archivo excel</h2>
    
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
    
         <div style="margin-top: 5%;">
         <center><a href="repositorio.php" class="btn-success"><- REGRESAR</a></center>
         </div>
            

</body>
</html>