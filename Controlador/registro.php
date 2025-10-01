
<?php 

include_once ('./../config.php');
include (MODEL_PATH."pacientes.php");


$sel =new Pacientes();

$function = $_GET["function"];
     
     
if($function =="RegistroPacx"){

            
          $pacienteX = array();

          $pacienteX['iduser'] = $_POST["iduser"];
          $pacienteX['ide'] = $_POST["ide"];
          $pacienteX['Nxuenta'] = $_POST["Nxuenta"];
          $pacienteX['hclinica'] =$_POST["hclinica"];
          $pacienteX['fua']= $_POST["fua"];
          $pacienteX['dni']= $_POST["dni"];
          $pacienteX['paciente']= $_POST["paciente"];
          $pacienteX['servicio'] = $_POST["servicio"];
          $pacienteX['feingreso']= $_POST["feingreso"];
          $pacienteX['fecorte']= $_POST["fecorte"]; 
          $pacienteX['montgal']= $_POST["montgal"];
          $pacienteX['montsifar']= $_POST["montsifar"]; 
          $pacienteX['obsCpms']= $_POST["obsCpms"];
          $pacienteX['valAteAudi']= $_POST["valAteAudi"];
          $pacienteX['tiDocA']= $_POST["tiDocA"];
          $pacienteX['ubiSerHosp']= $_POST["ubiSerHosp"];
          $pacienteX['codPreHos']= $_POST["codPreHos"];
          $pacienteX['tipoEval']= $_POST["tipoEval"];
          
        
          $tmpFile = $_FILES['fileCpms']['tmp_name'];
          $filename = '../pdfCPMS/'. $_FILES['fileCpms']['name'];
          move_uploaded_file($tmpFile,$filename);

          $pacienteX['fileCpms']    = $_FILES['fileCpms']['name'];
          $pacienteX['prioAudit']= $_POST["prioAudit"];
        
          $ni2 = $sel->InsertPaciente($pacienteX);   
         
}

     
     
else if($function =="registroQuimio"){

            
          $pacienteX = array();

          $pacienteX['iduser'] = $_POST["iduser"];
          $pacienteX['ideQa'] = $_POST["ideQa"];
          $pacienteX['NxuentaQ'] = $_POST["NxuentaQ"];
          $pacienteX['hclinicaQ'] =$_POST["hclinicaQ"];
          $pacienteX['fuaQ']= $_POST["fuaQ"];
          $pacienteX['nspQ']= $_POST["nspQ"];
          $pacienteX['pacienteQ']= $_POST["pacienteQ"];
          $pacienteX['feAtenQ'] = $_POST["feAtenQ"];
          $pacienteX['feProcQ']= $_POST["feProcQ"];
          $pacienteX['asiAudiQa']= $_POST["asiAudiQa"]; 
          $pacienteX['devoQ']= $_POST["devoQ"];
          
          $pacienteX['tipoDocQui']= $_POST["tipoDocQui"];
          $pacienteX['tefQuimi']= $_POST["tefQuimi"];
          $pacienteX['segurosQuimi']= $_POST["segurosQuimi"];
          $pacienteX['refQuimi']= $_POST["refQuimi"];
          $pacienteX['fechaNacQuimi']= $_POST["fechaNacQuimi"];
          $pacienteX['edadQuimi']= $_POST["edadQuimi"];
          $pacienteX['tip1Qui']= $_POST["tip1Qui"];
          $pacienteX['cie102Qui']= $_POST["cie102Qui"];
          $pacienteX['tip2Qui']= $_POST["tip2Qui"];
          $pacienteX['cie103Qui']= $_POST["cie103Qui"];
          $pacienteX['tip3Qui']= $_POST["tip3Qui"];
          $pacienteX['cie104Qui']= $_POST["cie104Qui"];
          $pacienteX['tip4Qui']= $_POST["tip4Qui"];
          $pacienteX['cie105Qui']= $_POST["cie105Qui"];
          $pacienteX['tip5Qui']= $_POST["tip5Qui"];
          $pacienteX['dniQuimi']= $_POST["dniQuimi"];
           $pacienteX['ocupQui']= $_POST["ocupQui"];
          
       
        
          $ni2 = $sel->insertPaxQuimio($pacienteX);   
         
}



     
else if($function =="registroCajx"){

            
          $pacienteX = array();

          $pacienteX['iduserEx'] = $_POST["iduserEx"];
          $pacienteX['refeCaja'] = $_POST["refeCaja"];
          
        
          $ni2 = $sel->insertPaxCajas($pacienteX);   
         
}



else if($function =="RegistroPacxAltas"){

            
        $pacienteX = array();

        $pacienteX['iduser'] = $_POST["iduser"];
        $pacienteX['ide'] = $_POST["ide"];
        $pacienteX['Nxuenta'] = $_POST["Nxuenta"];
        $pacienteX['hclinica'] =$_POST["hclinica"];
        $pacienteX['fua']= $_POST["fua"];
        $pacienteX['iafa']= $_POST["iafa"];
        $pacienteX['paciente']= $_POST["paciente"];
        $pacienteX['servicio'] = $_POST["servicio"];
        $pacienteX['feingreso']= $_POST["feingreso"];
        $pacienteX['fecorte']= $_POST["fecorte"];
       
        
              
        $ni2 = $sel->InsertPacienteAltas($pacienteX);   
       
}

else if($function =="RegistrObs"){

            
        $pacienteX = array();

       
        $pacienteX['id'] = $_GET["ide"];
        $pacienteX['obs'] = $_GET["obs"];
        $pacienteX['dx1'] = $_GET["dx1"];
        $pacienteX['dx2'] = $_GET["dx2"];
        $pacienteX['dx3'] = $_GET["dx3"];
        $pacienteX['dx4'] = $_GET["dx4"];
        $pacienteX['dx5'] = $_GET["dx5"];
        
        $pacienteX['dx6'] = $_GET["dx6"];
        $pacienteX['dx7'] = $_GET["dx7"];
        $pacienteX['dx8'] = $_GET["dx8"];
        $pacienteX['dx9'] = $_GET["dx9"];
        $pacienteX['dx10'] = $_GET["dx10"];
        
        $pacienteX['tip1'] = $_GET["tip1"];
        $pacienteX['tip2'] = $_GET["tip2"];
        $pacienteX['tip3'] = $_GET["tip3"];
        $pacienteX['tip4'] = $_GET["tip4"];
        $pacienteX['tip5'] = $_GET["tip5"];
        
        $pacienteX['tip6'] = $_GET["tip6"];
        $pacienteX['tip7'] = $_GET["tip7"];
        $pacienteX['tip8'] = $_GET["tip8"];
        $pacienteX['tip9'] = $_GET["tip9"];
        $pacienteX['tip10'] = $_GET["tip10"];
        
        
        $pacienteX['codPreHos'] = $_GET["codPreHos"];
        $pacienteX['ubiSerHosp'] = $_GET["ubiSerHosp"];
        $pacienteX['prioAudit'] = $_GET["prioAudit"];
        
        $pacienteX['estado'] = "ENVIADO";
       
        $ni2 = $sel->InserObs($pacienteX);   
       
}


else if($function =="RegistrObsEmer"){

            
        $pacienteX = array();

       
        $pacienteX['id'] = $_GET["ide"];
        $pacienteX['obs'] = $_GET["obs"];
        $pacienteX['dx1'] = $_GET["dx1"];
        $pacienteX['dx2'] = $_GET["dx2"];
        $pacienteX['dx3'] = $_GET["dx3"];
        $pacienteX['dx4'] = $_GET["dx4"];
        $pacienteX['dx5'] = $_GET["dx5"];
        
         $pacienteX['dx6'] = $_GET["dx6"];
         $pacienteX['dx7'] = $_GET["dx7"];
         $pacienteX['dx8'] = $_GET["dx8"];
         $pacienteX['dx9'] = $_GET["dx9"];
         $pacienteX['dx10'] = $_GET["dx10"];
             
        
        $pacienteX['tip1'] = $_GET["tip1"];
        $pacienteX['tip2'] = $_GET["tip2"];
        $pacienteX['tip3'] = $_GET["tip3"];
        $pacienteX['tip4'] = $_GET["tip4"];
        $pacienteX['tip5'] = $_GET["tip5"];
        
        $pacienteX['tip6'] = $_GET["tip6"];
        $pacienteX['tip7'] = $_GET["tip7"];
        $pacienteX['tip8'] = $_GET["tip8"];
        $pacienteX['tip9'] = $_GET["tip9"];
        $pacienteX['tip10'] = $_GET["tip10"];
        
        
        $pacienteX['codPreHos'] = $_GET["codPreHos"];
        $pacienteX['ubiSerHosp'] = $_GET["ubiSerHosp"];
        $pacienteX['prioAudit'] = $_GET["prioAudit"];
        
        $pacienteX['estado'] = "ENVIADO";
       
        $ni2 = $sel->InserObsEmer($pacienteX);   
       
}


else if($function =="eliminarRegCarta"){

        $eliminarReg = array();
        $eliminarReg['id'] = $_POST["id"];            
        
        $ni2 = $sel->eliminarRegsitCarta($eliminarReg);   
    
}




 ?>