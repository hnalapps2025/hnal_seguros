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
            $new_filename = substr($dir,strrpos($dir,'/') + 1);
            $zip->addFile($dir . $archivo, $new_filename. $archivo);
          }
        }
        
        closedir($da);
      }
    }
  }




if($function=="upload"){

    $uploadDir = 'upload';
    $iduser = $_POST['iduserRe'];
    $idpac = $uploadDir."/".$_POST['iddRe'];
    
    
    if (!file_exists($idpac)) {
        mkdir($idpac, 0777, true);
        
    }
    
    
    
    if (!empty($_FILES)) {
     $tmpFile = $_FILES['file']['tmp_name'];
     $filename = $idpac.'/'. $_FILES['file']['name'];
     move_uploaded_file($tmpFile,$filename);
    }
    
    $files  = array();

    $files['iduser']= $iduser;  
    $files['idpaciente']= $_POST['iddRe'];
    $files['namefile'] = $_FILES['file']['name'];
   
    $ni = $sel->InsertFilesUpload($files);
    
    // CREANDO ZIP
    
    $zip = new ZipArchive();    
    $dir = "upload/".$_POST['iddRe']."/";
   
    
    $rutaFinal = "repositorio";
    if(!file_exists($rutaFinal)){
    mkdir($rutaFinal);
    }

    $fet = date("d").date("m").date("Y");
    $archivoZip =$_POST['iddRe']."-". $fet.".zip";

    
    $filesPac  = array();


    $filesPac['idpac']= $_POST['iddRe'];
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
       echo "Descargar: <a href='$rutaFinal/$archivoZip'>$archivoZip</a>";
        }
    }

}


else if($function=="uploadPost"){

  $uploadDir = 'upload';
  $iduser = $_POST['iduseruploadPost'];
  $idpac = $uploadDir."/".$_POST['iddpacPost'];
  
  
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
  $files['idpaciente']= $_POST["iddpacPost"];
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


  $filesPac['idpac']= $_POST["iddpacPost"];
  $filesPac['archivofile'] = $archivoZip;

  $ni = $sel->InsertFilesPacientePost($filesPac);


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


else if($function=="uploadAmp"){

  $uploadDir = 'upload';
  $iduser = $_POST['iduserAmpliacion'];
  $idpac = $uploadDir."/".$_POST['iddAmpliacion'];
  
  
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
  $files['idpaciente']= $_POST["iddAmpliacion"];
  $files['etapa'] =$_POST["etapa"];
  $files['namefile'] = $_FILES['file']['name'];
 
  /// INSERTAR ARCHIOS

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


  $filesPac['idpac']= $_POST["iddAmpliacion"];
  $filesPac['archivofile'] = $archivoZip;

  /// INSERTAR ZIP A BD

  $ni = $sel->InsertFilesPacienteAmp($filesPac);


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



else if($function=="cargo"){


     $tipo = $_POST['tipo'];


    if($tipo=="envio"){
      echo $tipo;
      
      $uploadDir = 'cargo';
      $iddcargo = $_POST['iddcargo'];

      if (!empty($_FILES)) {
       $tmpFile = $_FILES['file']['tmp_name'];
       $filename = $uploadDir.'/'. $_FILES['file']['name'];
       move_uploaded_file($tmpFile,$filename);
      }
    
      $files  = array();    
      $files['iduseruploadCargo']= $_POST['iduseruploadCargo'];
      $files['idpaciente']= $_POST['iddcargo'];
      $files['tipo'] = $tipo;
      $files['namefile'] = $_FILES['file']['name'];
     
      $ni = $sel->InsertFilesCargoEnvio($files); 

    }else if($tipo=="apro"){
      
      echo $tipo;
      $uploadDir = 'cargo';
      $iddcargo = $_POST['iddcargoApro'];

      if (!empty($_FILES)) {
       $tmpFile = $_FILES['file']['tmp_name'];
       $filename = $uploadDir.'/'. $_FILES['file']['name'];
       move_uploaded_file($tmpFile,$filename);
      }
    
      $files  = array();    
      $files['iduseruploadCargo']= $_POST['iduseruploadCargoApro'];
      $files['idpaciente']= $_POST['iddcargoApro'];
      $files['tipo'] = $tipo;
      $files['namefile'] = $_FILES['file']['name'];
     
      $ni = $sel->InsertFilesCargoEnvio($files); 
    }

  
}

else if($function=="cargoPOST"){

   
   $uploadDir = 'cargo';
   $iddcargo = $_POST['iddcargoPost'];

   if (!empty($_FILES)) {
    $tmpFile = $_FILES['file']['tmp_name'];
    $filename = $uploadDir.'/'. $_FILES['file']['name'];
    move_uploaded_file($tmpFile,$filename);
   }
 
   $files  = array();    
   $files['iduser']= $_POST['iduserCar'];
   $files['idpaciente']= $_POST['iddCarg'];
   $files['namefile'] = $_FILES['file']['name'];
  
   $ni = $sel->InsertFilesCargoEnvioPOST($files); 


}



else if($function=="cargoAmp"){


  $tipo = $_POST['tipo'];


 if($tipo=="envio"){
   echo $tipo;
   
   $uploadDir = 'cargo';
   $iddcargo = $_POST['iddEnvioAmp'];

   if (!empty($_FILES)) {
    $tmpFile = $_FILES['file']['tmp_name'];
    $filename = $uploadDir.'/'. $_FILES['file']['name'];
    move_uploaded_file($tmpFile,$filename);
   }
 
   $files  = array();    
   $files['iduseruploadCargo']= $_POST['iduserAmpEnvio'];
   $files['idpaciente']= $_POST['iddEnvioAmp'];
   $files['tipo'] = $tipo;
   $files['namefile'] = $_FILES['file']['name'];
  
   $ni = $sel->InsertFilesCargoEnvioAmp($files); 

 }else if($tipo=="apro"){
   
   echo $tipo;
   $uploadDir = 'cargo';
   $iddcargo = $_POST['iddcargoAmpRex'];

   if (!empty($_FILES)) {
    $tmpFile = $_FILES['file']['tmp_name'];
    $filename = $uploadDir.'/'. $_FILES['file']['name'];
    move_uploaded_file($tmpFile,$filename);
   }
 
   $files  = array();    
   $files['iduseruploadCargo']= $_POST['iduseAmpEx'];
   $files['idpaciente']= $_POST['iddcargoAmpRex'];
   $files['tipo'] = $tipo;
   $files['namefile'] = $_FILES['file']['name'];
  
   $ni = $sel->InsertFilesCargoEnvioAmp($files); 
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