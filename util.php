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
                    
                        if($i==0){

                            $Reader->ChangeSheet($i);
                    
                                foreach ($Reader as $Row)
                                {
                                    
                                
                                    
                                                $Dat0 = mysqli_real_escape_string($conn,$Row[0]);
                                                $Dat1 = mysqli_real_escape_string($conn,$Row[1]);
                                                $Dat2 = mysqli_real_escape_string($conn,$Row[2]);
                                                $Dat3 = mysqli_real_escape_string($conn,$Row[3]);
                                                $Dat4 = mysqli_real_escape_string($conn,$Row[4]);
                                                $Dat5 = mysqli_real_escape_string($conn,$Row[5]);
                                                $Dat6 = mysqli_real_escape_string($conn,$Row[6]);
                
                                                        
                                                $query = "INSERT INTO `sis_cpms`(`APO_ID`, `CODIGO_CPT`, `deno1`, `CODIGO_CPMS`, `deno2`, `II_nivel`,
                                                 `III_nivel`) VALUES ('".$Dat0."','".$Dat1."','".$Dat2."','".$Dat3."','".$Dat4."','".$Dat5."','".$Dat6."')";
                                                $result = mysqli_query($conn, $query);
                                                
                                                if (!empty($result)) {
                                                    $type = "success";
                                                    $message = "Datos de Excel importados correctamente a la base de datos";
                                                } else {
                                                    echo $query."<br>";
                                                    $type = "error";
                                                    $message = "Problema al importar datos de Excel a_procedimientos";
                                                    
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
         <center><a href="ImportarCuenta.php?id=<?php echo $pres;?>" class="btn-success"><- REGRESAR</a></center>
         </div>
            

</body>
</html>