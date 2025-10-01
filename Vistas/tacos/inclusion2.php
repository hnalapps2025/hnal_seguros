<?php 

include_once ('./../../config.php');
include (MODEL_PATH."ModelProcedmientos.php");
include (MODEL_PATH."global.php");


$sel = new ModelProcedmientos();
$id = $_GET["id"];

$ni = $sel->consultaRotuloPciente($id);

$acu=0;
 echo '<div class="container">';

 while($mue = $ni->fetch_assoc()){
     
     echo '<div class="row justify-content-md-center"><div class="col-sm-10" id="'.$mue["idRo"].$id.'"><label class="col-form-label col-md-1 col-sm-3 label-align" 
     for="first-name" style="margin-top: 4px;font-size: 12px;font-weight: 400;width: 90px;">'.$mue["rotulo"].'</label>';
     echo'<div class="col-sm-8">';
     $acu= $acu + 1;
     $anio = date("Y");
     $rotl =  "'".$mue["rotulo"]."'";
            
                $ni2 = $sel->consultaDetalleRotulo($mue["rotulo"]);
                while($mue2 = $ni2->fetch_assoc()){
                       
                        if($id==1){
                             echo'<input '.$mue2["inclusion"].' type="checkbox" id="'.$mue2["id"].'1" name="'.$mue2["id"].'1"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',1)"  />
                             <label style="font-weight: 400;margin-right: 30px;font-size: 10px;"  for="scales"> '.$anio.'-8292-'.$mue2["correlativo"].'</label>
                             <span id="user2per" style="font-weight: 100;font-size: 10px;float: right;margin-top: 6px;">'.strtoupper($mue2["USERLAB"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModificacion"])).'</span><br>';
                        }else if($id==2){
                             echo'<input '.$mue2["corte"].' type="checkbox" id="'.$mue2["id"].'2" name="'.$mue2["id"].'2"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',2)"  />
                            <label style="font-weight: 400;margin-right: 30px;font-size: 10px;"  for="scales"> '.$anio.'-8292-'.$mue2["correlativo"].'</label>
                            <span id="user2per" style="font-weight: 100;font-size: 10px;float: right;margin-top: 6px;">'.strtoupper($mue2["USERLAB"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModificacion"])).'</span><br>';
                        }else if($id==3){
                             echo'<input '.$mue2["coloracion"].' type="checkbox" id="'.$mue2["id"].'3" name="'.$mue2["id"].'3"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',3)"   />
                            <label style="font-weight: 400;margin-right: 30px;font-size: 10px;"  for="scales"> '.$anio.'-8292-'.$mue2["correlativo"].'</label>
                            <span id="user2per" style="font-weight: 100;font-size: 10px;float: right;margin-top: 6px;">'.strtoupper($mue2["USERLAB"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModificacion"])).'</span><br>';
                        }else if($id==4){
                             echo'<input '.$mue2["montaje"].' type="checkbox" id="'.$mue2["id"].'4" name="'.$mue2["id"].'4"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',4)"  />
                            <label style="font-weight: 400;margin-right: 30px;font-size: 10px;"  for="scales"> '.$anio.'-8292-'.$mue2["correlativo"].'</label>
                            <span id="user2per" style="font-weight: 100;font-size: 10px;float: right;margin-top: 6px;">'.strtoupper($mue2["USERLAB"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModificacion"])).'</span><br>';
                        }else if($id==5){
                             echo'<input '.$mue2["entrega"].' type="checkbox" id="'.$mue2["id"].'5" name="'.$mue2["id"].'5"  onclick="registrarAuditoriaRotulos('.$iduser.','.$mue2["id"].','.$rotl.',5)"  />
                            <label style="font-weight: 400;margin-right: 30px;font-size: 10px;"  for="scales"> '.$anio.'-8292-'.$mue2["correlativo"].'</label>
                            <span id="user2per" style="font-weight: 100;font-size: 10px;float: right;margin-top: 6px;">'.strtoupper($mue2["USERLAB"]).' | FECHA MODIFICACION: '.date('d/m/Y H:i:s',strtotime($mue2["feModificacion"])).'</span><br>';
                        }
                      
        
                }
        
                $niUser = $sel->consultaRotuloUser($mue["rotulo"]);
                $mueUser = $niUser->fetch_assoc();
        
                echo ' </div></div> 
                        <div class="col-sm-2">
                             <div class="button-total text-left" style="margin-top: 20px">
                                 <a title="Editar" id="btnDisabled'.$mue["idRo"].$id.'" onclick="disabledButton('.$mue["idRo"].$id.')" class="btn btn-default btn-xs hidden" style="border: 1px solid black;"><i class="fa fa-edit"></i> Modificar </a>
                                 <a title="Editar" id="btnEnabled'.$mue["idRo"].$id.'" onclick="enabledButton('.$mue["idRo"].$id.')" class="btn btn-danger btn-xs " style="background: #4d6a95;border: 1px solid  #4d6a95;"><i class="fa fa-save"></i> Guardar </a>
                            </div>
                
                    </div>
                </div>
                <hr style="margin-top: 6px;margin-bottom: 6px;">';
     
 }
 
 echo '</div>';
 
 
?>

    