<?php


require 'Modelo/funciones.php';
require 'Modelo/global.php';


$sel =new Model();
$function  = $_GET['function'];

function agregar_zip($dir, $zip) {
    
    if (is_dir($dir)) {
      
      if ($da = opendir($dir)) {
        
        while (($archivo = readdir($da)) !== false) {
         
          if (is_dir($dir . $archivo) && $archivo != "." && $archivo != "..") {
           
            agregar_zip($dir . $archivo . "/", $zip);
  
          } elseif (is_file($dir . $archivo) && $archivo != "." && $archivo != "..") {
          
            $zip->addFile($dir . $archivo, $dir . $archivo);
          }
        }
        
        closedir($da);
      }
    }
  }




if($function=="upload"){

    $uploadDir = 'upload';
    $iduser = $_POST['iduserupload'];
    $idpac = $uploadDir."/".$_POST['iddpac'];
    
    
    if (!file_exists($idpac)) {
        mkdir($idpac, 0777, true);
        
    }
    
    $etapa = $idpac."/".$_POST['etapa'];
    
    
    
    if (!file_exists($etapa)) {
        mkdir($etapa, 0777, true);
    }
    
    
    if (!empty($_FILES)) {
     $tmpFile = $_FILES['file']['tmp_name'];
     $filename = $etapa.'/'. $_FILES['file']['name'];
     move_uploaded_file($tmpFile,$filename);
    }
    
    $files  = array();

    $files['iduser']= $iduser;  
    $files['idpaciente']= $_POST["iddpac"];
    $files['etapa'] =$_POST["etapa"];
    $files['namefile'] = $_FILES['file']['name'];
   
    $ni = $sel->InsertFilesUpload($files);
    
    // CREANDO ZIP
    
    $zip = new ZipArchive();

    
    $dir = "upload/".$files['idpaciente']."/".$files['etapa']."/";
    
    
    $rutaFinal = "repositorio";

    if(!file_exists($rutaFinal)){
    mkdir($rutaFinal);
    }
    $fet = date("d").date("m").date("Y");
    $et = $_POST['etapa'];
    $archivoZip = $files['idpaciente']."-".strtoupper($et). $fet.".zip";

    
    $filesPac  = array();


    $filesPac['idpac']= $_POST["iddpac"];
    $filesPac['archivofile'] = $archivoZip;
  
    $ni = $sel->InsertFilesPaciente($filesPac);


    if ($zip->open($archivoZip, ZIPARCHIVE::CREATE) === true) {
    agregar_zip($dir, $zip);
    $zip->close();


    rename($archivoZip, "$rutaFinal/$archivoZip");

    
    if (file_exists($rutaFinal. "/" . $archivoZip)) {
        echo "<br><br>Proceso Finalizado!! <br/><br/>
                    Descargar: <a href='$rutaFinal/$archivoZip'>$archivoZip</a>";
    } else {
        echo "Error, archivo zip no ha sido creado!!";
        }
    }

}

else if($function=="delete"){

        $iddpac= $_POST["iddpac"];
        $etapa= $_POST["etapa"];
        $parameter= $_POST["file"];
        $somefile = "upload/".$iddpac."/".$etapa."/".$parameter;

        unlink($somefile);

    $files  = array();

    $files['iduser']= $_POST["iduser"]; 
    $files['idpaciente']= $iddpac;
    $files['etapa'] =$etapa;
    $files['namefile'] = $parameter;
   
    $ni = $sel->DeleteFilesUpload($files);

}



?>