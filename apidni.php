<?php 


error_reporting(0);
$dni =$_GET['dni'];

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://apiperu.dev/api/dni/".$dni."?api_token=efea7dd0ff3e4ac0eda1ff7829e6da934a2ac19f3052cc85b90509827d517e2f",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
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
            
          
              $am[] = $obj['nombres'];
              $am[] = $obj['apellido_paterno'];
              $am[] = $obj['apellido_materno'];
              $am[] = $obj['nombre_completo'];
              
            
        }
    
        echo json_encode($am);
//echo $response;
?>