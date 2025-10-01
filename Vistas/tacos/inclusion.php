<?php 

include_once ('./../../config.php');

include (MODEL_PATH."ModelProcedmientos.php");

include (MODEL_PATH."global.php");


$sel = new ModelProcedmientos();

$id = $_GET["id"];
$tipo = $_GET["tipo"];
$formato = $_GET["formato"];
$tipoest = $_GET["tipoest"];

$ni = $sel->consultaRotuloPciente($tipo,$formato,$tipoest);

$acu=0;
 echo '<div class="container">
 <div class="col-sm-12" style="font-size: 10px;">
            <div class="col-sm-1" style="text-align: center;font-weight: 700;">ROTULOS</div>';
             if($tipo == 3){
                echo '<div class="col-sm-6 tileInclTax" style="text-align: center;font-weight: 700;" >LAMINAS</div>';
             }else{
                echo '<div class="col-sm-6 tileInclTax" style="text-align: center;font-weight: 700;" >TACOS</div>';
             }
            echo '<div class="col-sm-1" style="text-align: center;font-weight: 700;">OBSERVACION</div>';
              if($tipo !=3){
                  echo' <div class="col-sm-1" style="text-align: center;font-weight: 700;" id="acordeonObsMic">OBS MICRO</div>
                <div class="col-sm-2" style="text-align: center;font-weight: 700;" id="acordeonRsptaMic">RSPTA MICRO</div>';
              }
           
           echo'<div class="col-sm-1" style="text-align: center;font-weight: 700;">OPCIONES</div>
</div><hr>';
 while($mue = $ni->fetch_assoc()){
     
     echo '<div class="row">
    
                 <div class="col-sm-7" id="'.$mue["idRo"].$id.'" style="">
                 <label class="col-form-label col-md-1 col-sm-3 label-align" 
                 for="first-name" style="margin-top: 4px;font-size: 12px;font-weight: 400;width: 90px;">'.$mue["rotulo"].'</label>';
                 echo'<div class="col-sm-10">';
                 $acu= $acu + 1;
                 $anio = date("Y");
                 $rotl =  "'".$mue["rotulo"]."'";
            
                $ni2 = $sel->consultaDetalleRotulo($mue["rotulo"],$tipo,$formato,$tipoest);
                $ni3 = $sel->consultaDetalleRotulo($mue["rotulo"],$tipo,$formato,$tipoest);
                $ni4 = $sel->consultaDetalleRotulo($mue["rotulo"],$tipo,$formato,$tipoest);
                $ni5 = $sel->consultaDetalleRotulo($mue["rotulo"],$tipo,$formato,$tipoest);
                $ni6 = $sel->consultaDetalleRotulo($mue["rotulo"],$tipo,$formato,$tipoest);
                
                 if($tipo == 1 || $tipo == "3"){
                     
                            while($mue2 = $ni2->fetch_assoc()){
                       
                                    $fin1='';$fin2='';$fin3='';$fin4='';$fin5='';
                                    
                                    
                                    if($mue2["feModInclusion"]!=""){
                                        $fin1=strtoupper($mue2["USERLAB1"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModInclusion"]));
                                    }
                                    
                                    
                                    if($mue2["feModCorte"]!=""){
                                        $fin2=strtoupper($mue2["USERLAB2"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModCorte"]));
                                    }
                                    
                                    if($mue2["feModColor"]!=""){
                                        $fin3=strtoupper($mue2["USERLAB3"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModColor"]));
                                    }
                                    
                                    if($mue2["feModMontaje"]!=""){
                                        $fin4=strtoupper($mue2["USERLAB4"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModMontaje"]));
                                    }
                                    
                                    if($mue2["feModEntrega"]!=""){
                                        $fin5=strtoupper($mue2["USERLAB5"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModEntrega"]));
                                    }
                                   
                       
                                    if($id==1 ){
                                        
                                         echo'<input '.$mue2["inclusion"].' type="checkbox" id="'.$mue2["id"].'11" name="'.$mue2["id"].'11"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',1,1)"  />
                                         <label style="font-weight: 400;font-size: 9px;"  for="scales"> '.$mue2["formatoPatoMac"].'-'.$mue2["correlativo"].'</label>
                                         <span id="user2per" style="font-weight: 100;font-size: 9px;float: right;margin-top: 6px;">'.$fin1.'</span><br>';
                                         
                                    }else if($id==2){
                                         echo'<input '.$mue2["corte"].' type="checkbox" id="'.$mue2["id"].'21" name="'.$mue2["id"].'21"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',2,1)"  />
                                        <label style="font-weight: 400;font-size: 9px;"  for="scales"> '.$mue2["formatoPatoMac"].'-'.$mue2["correlativo"].'</label>
                                        <span id="user2per" style="font-weight: 100;font-size: 9px;float: right;margin-top: 6px;">'.$fin2.'</span><br>';
                                    }else if($id==3){
                                         echo'<input '.$mue2["coloracion"].' type="checkbox" id="'.$mue2["id"].'31" name="'.$mue2["id"].'31"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',3,1)"   />
                                        <label style="font-weight: 400;font-size:9px;"  for="scales"> '.$mue2["formatoPatoMac"].'-'.$mue2["correlativo"].'</label>
                                        <span id="user2per" style="font-weight: 100;font-size:9px;float: right;margin-top: 6px;">'.$fin3.'</span><br>';
                                    }else if($id==4){
                                         echo'<input '.$mue2["montaje"].' type="checkbox" id="'.$mue2["id"].'41" name="'.$mue2["id"].'41"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',4,1)"  />
                                        <label style="font-weight: 400;font-size: 9px;"  for="scales"> '.$mue2["formatoPatoMac"].'-'.$mue2["correlativo"].'</label>
                                        <span id="user2per" style="font-weight: 100;font-size:9px;float: right;margin-top: 6px;">'.$fin4.'</span><br>';
                                    }else if($id==5){
                                         echo'<input '.$mue2["entrega"].' type="checkbox" id="'.$mue2["id"].'51" name="'.$mue2["id"].'51"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',5,1)"  />
                                        <label style="font-weight: 400;font-size:9px;"  for="scales"> '.$mue2["formatoPatoMac"].'-'.$mue2["correlativo"].'</label>
                                        <span id="user2per" style="font-weight: 100;font-size: 9px;float: right;margin-top: 6px;">'.$fin5.'</span><br>';
                                    }
                                  
                    
                            }
                     
                 }else  if($tipo ==2){
                     
                     
                                  while($mue2 = $ni2->fetch_assoc()){
                                      
                                      
                                      
                                      $fin1='';$fin2='';$fin3='';$fin4='';$fin5='';
                                    
                                    
                                        if($mue2["feModInclusion2"]!=""){
                                            $fin1=strtoupper($mue2["USERLAB12"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModInclusion2"]));
                                        }
                                        
                                        
                                        if($mue2["feModCorte2"]!=""){
                                            $fin2=strtoupper($mue2["USERLAB22"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModCorte2"]));
                                        }
                                        
                                        if($mue2["feModColor2"]!=""){
                                            $fin3=strtoupper($mue2["USERLAB32"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModColor2"]));
                                        }
                                        
                                        if($mue2["feModMontaje2"]!=""){
                                            $fin4=strtoupper($mue2["USERLAB42"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModMontaje2"]));
                                        }
                                        
                                        if($mue2["feModEntrega2"]!=""){
                                            $fin5=strtoupper($mue2["USERLAB52"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModEntrega2"]));
                                        }
                                      
                                      
                                      
                                   
                                    if($id==1 ){
                                         echo'<input '.$mue2["inclusion2"].' type="checkbox" id="'.$mue2["id"].'12" name="'.$mue2["id"].'1"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',1,2)"  />
                                         <label style="font-weight: 400;font-size: 9px;"  for="scales"> '.$mue2["formatoPatoMac"].'-'.$mue2["correlativo"].'</label>
                                         <span id="user2per" style="font-weight: 100;font-size: 9px;float: right;margin-top: 6px;">'.$fin1.'</span><br>';
                                    }else if($id==2){
                                         echo'<input '.$mue2["corte2"].' type="checkbox" id="'.$mue2["id"].'22" name="'.$mue2["id"].'2"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',2,2)"  />
                                        <label style="font-weight: 400;font-size: 9px;"  for="scales"> '.$mue2["formatoPatoMac"].'-'.$mue2["correlativo"].'</label>
                                        <span id="user2per" style="font-weight: 100;font-size: 9px;float: right;margin-top: 6px;">'.$fin2.'</span><br>';
                                    }else if($id==3){
                                         echo'<input '.$mue2["coloracion2"].' type="checkbox" id="'.$mue2["id"].'32" name="'.$mue2["id"].'3"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',3,2)"   />
                                        <label style="font-weight: 400;font-size:9px;"  for="scales"> '.$mue2["formatoPatoMac"].'-'.$mue2["correlativo"].'</label>
                                        <span id="user2per" style="font-weight: 100;font-size:9px;float: right;margin-top: 6px;">'.$fin3.'</span><br>';
                                    }else if($id==4){
                                         echo'<input '.$mue2["montaje2"].' type="checkbox" id="'.$mue2["id"].'42" name="'.$mue2["id"].'4"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',4,2)"  />
                                        <label style="font-weight: 400;font-size: 9px;"  for="scales"> '.$mue2["formatoPatoMac"].'-'.$mue2["correlativo"].'</label>
                                        <span id="user2per" style="font-weight: 100;font-size:9px;float: right;margin-top: 6px;">'.$fin4.'</span><br>';
                                    }else if($id==5){
                                         echo'<input '.$mue2["entrega2"].' type="checkbox" id="'.$mue2["id"].'52" name="'.$mue2["id"].'5"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',5,2)"  />
                                        <label style="font-weight: 400;font-size:9px;"  for="scales"> '.$mue2["formatoPatoMac"].'-'.$mue2["correlativo"].'</label>
                                        <span id="user2per" style="font-weight: 100;font-size: 9px;float: right;margin-top: 6px;">'.$fin5.'</span><br>';
                                    }
                                    
                                    
                                    
                                    
                                  
                    
                            }
                     
                 }
                
               
        
                $niUser = $sel->consultaRotuloUser($mue["rotulo"]);
                $mueUser = $niUser->fetch_assoc();
        
                echo ' </div></div> 
                        <div class="col-sm-1" style="text-align: left;">';
                        
                        while($mue4 = $ni4->fetch_assoc()){
                             
                              if($id==1 && $mue4["obsLab1"] !=""){
                                    echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;" 
                                    onclick="editarObservacionRoLabInfo('.$mue4["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalObsLabInfo" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                              }else if($id==2 && $mue4["obsLab2"] !=""){
                                    echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;" 
                                    onclick="editarObservacionRoLabInfo('.$mue4["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalObsLabInfo" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                              }else if($id==3 && $mue4["obsLab3"] !=""){
                                    echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;" 
                                    onclick="editarObservacionRoLabInfo('.$mue4["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalObsLabInfo" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                              }else if($id==4 && $mue4["obsLab4"] !=""){
                                    echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;" 
                                    onclick="editarObservacionRoLabInfo('.$mue4["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalObsLabInfo" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                              }else if($id==5 && $mue4["obsLab5"] !=""){
                                    echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;" 
                                    onclick="editarObservacionRoLabInfo('.$mue4["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalObsLabInfo" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                              }else {
                                  echo '<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: white;" class="btn btn-default btn-xs ">-</span><br>';
                              }
                              

                         }
                    
                        
              if($tipo !=3){
                echo '</div><div class="col-sm-1" style="text-align: left;" class="dentroAcorde1">';
                
                        while($mue6 = $ni6->fetch_assoc()){
                             if($id==1 && $mue6["obsMircro1"] !=""){
                                  echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                  onclick="editarObsMicrox('.$mue6["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfooBX" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                             }else if($id==2 && $mue6["obsMircro2"] !=""){
                                  echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                  onclick="editarObsMicrox('.$mue6["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfooBX" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                             }else if($id==3 && $mue6["obsMircro3"] !=""){
                                  echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                  onclick="editarObsMicrox('.$mue6["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfooBX" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                             }else if($id==4 && $mue6["obsMircro4"] !=""){
                                  echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                  onclick="editarObsMicrox('.$mue6["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfooBX" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                             }else if($id==5 && $mue6["obsMircro5"] !=""){
                                  echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                  onclick="editarObsMicrox('.$mue6["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfooBX" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                             }else{
                                  echo '<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: white;" class="btn btn-default btn-xs ">-</span><br>';
                             }
                         } 
                         
                 echo ' </div><div class="col-sm-2" style="text-align: center;" class="dentroAcorde2">';
                
                        while($mue5 = $ni5->fetch_assoc()){
                             
                             if($id==1 && $mue5["rsptaLab"] !=""){
                                  echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                  onclick="editarRsptaRoLabInfo('.$mue5["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfo" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                             }else if($id==2 && $mue5["rsptaLab2"] !=""){
                                  echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                  onclick="editarRsptaRoLabInfo('.$mue5["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfo" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                             }else if($id==3 && $mue5["rsptaLab3"] !=""){
                                  echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                  onclick="editarRsptaRoLabInfo('.$mue5["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfo" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                             }else if($id==4 && $mue5["rsptaLab4"] !=""){
                                  echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                  onclick="editarRsptaRoLabInfo('.$mue5["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfo" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                             }else if($id==5 && $mue5["rsptaLab5"] !=""){
                                  echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                  onclick="editarRsptaRoLabInfo('.$mue5["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfo" class="btn btn-default btn-xs "> Ver detalle </span><br>';
                             }else{
                                  echo '<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: white;" class="btn btn-default btn-xs ">-</span><br>';
                             }
                               
                             
                         }
                 }
                 echo '</div><div class="col-sm-1"  style="text-align: right;">';
                 
                  while($mue3 = $ni3->fetch_assoc()){
                        
                            
                            if($tipo ==1){
                                
                                 echo' <div class="btn-group" style="margin-bottom: 5px;">
                                                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs" dropdown-toggle="" type="button" aria-expanded="true" style="font-size: 11px;margin-bottom: 1px;"> 
                                                                    <span class="caret"></span> Acciones </button>
                                                                            <ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
                                                                                    <li><a onclick="editarObservacionRoLab('.$mue3["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalObsLab"><i class="fa fa-edit"></i> Obs tacos </a></li>
                                                                                    
                                                                            </ul>
                            </div><br>';
                                
                            }else if($tipo ==2){
                                
                                 echo' <div class="btn-group" style="margin-bottom: 5px;">
                                                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs" dropdown-toggle="" type="button" aria-expanded="true" style="font-size: 11px;margin-bottom: 1px;"> 
                                                                    <span class="caret"></span> Acciones </button>
                                                                            <ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
                                                                                    <li><a onclick="editarObsMicrox('.$mue3["id"].','.$id.')"  data-toggle="modal" data-target=".bs-example-modal-modalObsroLab"><i class="fa fa-refresh"></i> Obs Micro </a></li>
                                                                                    <li><a onclick="editarRsptaRoLab('.$mue3["id"].','.$id.')"  data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLab"><i class="fa fa-refresh"></i> Rspta Micro </a></li>
                                                                            </ul>
                            </div><br>';
                            }else if($tipo ==3){
                                
                                 echo' <div class="btn-group" style="margin-bottom: 5px;">
                                                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs" dropdown-toggle="" type="button" aria-expanded="true" style="font-size: 11px;margin-bottom: 1px;"> 
                                                                    <span class="caret"></span> Acciones </button>
                                                                            <ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
                                                                                    <li><a onclick="editarObservacionRoLab('.$mue3["id"].','.$id.')" data-toggle="modal" data-target=".bs-example-modal-modalObsLab"><i class="fa fa-edit"></i> Obs Laminas </a></li>
                                                                                    
                                                                            </ul>
                            </div><br>';
                                
                            }
                            
                           
                      
                 }
                 
                 
                 
                 echo '</div></div>
                <hr style="margin-top: 6px;margin-bottom: 6px;">';
     
 }
 
 echo '</div>';
 ?>