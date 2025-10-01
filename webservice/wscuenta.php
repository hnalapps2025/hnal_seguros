<?php 

header('Access-Control-Allow-Origin: *');

error_reporting(0);
$cuenta =$_GET['cuenta'];

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://app.hospitalloayza.gob.pe/ws/sis/buscar_paciente_x_cuenta?num_cuenta=".$cuenta,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_SSL_VERIFYPEER => false
    ));
    $response = curl_exec($curl);
   
   /* $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }*/


    $array = json_decode($response, true);
    $am = array();
    
        foreach($array as $obj){
            
          
              $am[] = $obj['NroHistoriaClinica'];
              $am[] = $obj['Descripcion'];
              $am[] = $obj['NroDocumento'];
              $am[] = $obj['ApellidoPaterno'];
              $am[] = $obj['ApellidoMaterno'];
              $am[] = $obj['PrimerNombre'];
              $am[] = $obj['IdTipoSexo'];
              $am[] = $obj['TipoSexo'];//7
              $date = str_replace('/', '-', $obj['FechaNacimiento']);
              $am[] = date('Y-m-d', strtotime($date));
              $am[] = $obj['Edad'];
              $am[] = $obj['NroFua'];
              $am[] = $obj['ConsumoFarmacia'];//11
              $am[] = strtoupper($obj['ServicioIngreso']);
              $am[] = strtoupper($obj['ServicioEgreso']);
              $FechaIngreso = date('Y-m-d H:i', strtotime(str_replace('/', '-', $obj['FechaIngreso'])));
              $am[] = $FechaIngreso;//." 00:00"; //14
             $finge =''; ($obj['FechaEgreso']!="") ? $finge =date('Y-m-d', strtotime(str_replace('/', '-', $obj['FechaEgreso']))) : $finge ='';
              $FechaEgreso = $finge;
              $am[] = $FechaEgreso;
              $am[] = $obj['TipoAtencion'];
              $am[] = $obj['FuaMedico'];
              
            
        }
    
        echo json_encode($am);
//echo $response;
?>