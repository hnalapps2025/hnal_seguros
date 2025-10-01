<?php 

include_once ('config.php');
include (MODEL_PATH."ModelProcedmientos.php");
include (MODEL_PATH."global.php");
//date_default_timezone_set('America/Lima');

$sel = new ModelProcedmientos();
$id = $_GET["id"];
$tipo = $_GET["tipo"];
$vista = $_GET["vista"];
$formato = $_GET["formato"];
$tipoest = $_GET["tipoest"];

$ni = $sel->consultaRotuloPciente($tipo,$formato,$tipoest);


?>

<!--<div class="modal-header" style="color:black;text-transform: uppercase;text-align: center;">                                   
        <h4 class="modal-title" id="">TRANSFERENCIA</h4>
</div>-->
<table class="table bulk_action" id="tab" border="1">
    <thead>
      <tr class="headings" style="background:#357ab4;color:white;font-size: 10px;">
        <?php if($tipo==1 || $tipo==2 || $tipo==3 || $vista==3 || $vista==4){ ?>  
        <th class="column-title" style="width:10%;text-transform: uppercase;text-align: center;font-size:12px;">MUESTRA</th>
         <?php } if($tipo==1 || $tipo==2  || $tipo==3 || $vista ==3){ ?>  
        <th class="column-title" style="width:15%;text-transform: uppercase;text-align: center;font-size:12px;">DESCRIPCION</th>
          <?php }  if($tipo==1 || $tipo==2 || $tipo==3  || $vista==3 || $vista==4){  ?> 
            
        <th class="column-title" style="width:50%;text-transform: uppercase;text-align: center;font-size:12px;" id="tileUbs">TACOS</th>
      
         
           <th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;font-size:12px;">OBS MACRO</th>
           <?php }  if($vista!=3){ ?>  
        <th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;font-size:12px;" id="tblObsMic">OBS MICROSCOPIA</th>
        <th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;font-size:12px;" id="tblRsptaMic">RSPTA MICROSCOPIA</th>
      <!--  <th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;font-size:12px;">FECHA_REG</th>-->
        <!--<th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;font-size:12px;">FECHA_ACT</th>-->
         <?php }  if($tipo==1 || $tipo==2 || $tipo==3  || $vista==3 || $vista!=4){  ?> 
        <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;font-size:12px;">OPCIONES</th>
         <?php }  ?> 
       
      </tr>
    </thead>

    <tbody>
         <?php  
              
               while($mue = $ni->fetch_assoc()){                                                 
                 ?>

                    <tr class="even pointer">
                        
                      <?php if($tipo==1 || $tipo==2 || $tipo==3 || $vista==3 || $vista==4){ ?>  
                      
                      <td style="text-transform: uppercase;font-size:12px;text-align: center;vertical-align: inherit;"><?php echo $mue["rotulo"]; ?></td>
                     
                      <?php } if($tipo==1 || $tipo==2 || $tipo==3  || $vista==3 ){ ?>  
                      <td style="font-size:12px;vertical-align: inherit;text-align: center;"><?php 
                               // echo $mue["descripcion"]; 
                                
                                
                                if($mue["descripcion"]!="" && $vista==1){
                                         echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                          onclick="editarObservacionRo('.$mue['idRo'].',2,1)" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfoDescripMacro" class="btn btn-default btn-xs "> Ver detalle </span>';   
                                }else if($mue["descMicro"]!="" && $vista==2){
                                    echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                          onclick="editarObservacionRo('.$mue['idRo'].',2,2)" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfoDescripMacro" class="btn btn-default btn-xs "> Ver detalle </span>';   
                                }
                                
                                    
                        ?></td>
                        
                         <?php }  if($tipo==1 || $tipo==2 || $tipo==3 || $vista==3 || $vista==4){ ?>  
                      <td style="text-transform: uppercase;font-size:9px;vertical-align: inherit;">
                      <?php 
                                
                                
                                
                                $ni2 = $sel->consultaDetalleRotulo($mue["rotulo"],$tipo,$formato,$tipoest);
                                while($mue2 = $ni2->fetch_assoc()){
                                  
                                  $anio = date("Y");
                                    $verChek='';$eliminar='<span style="float: right;"><a title="Eliminar" onclick="EliminarTacoXtaco('.$mue2['id'].')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a></span>';
                                    $chekear='<input  '.$mue2["checkHisto"].' type="checkbox" style="margin-top: 0px;margin-left: 8px;float: right;" id="'.$mue2["id"].'" name="'.$mue2["id"].'"  onclick="registrarUserHisto('.$mue2["id"].','.$iduser.')" ><br>';
                                  
                                    if($tipo==3){
                                        echo '<label >'.$mue2["formatoPatoMac"].'-'.$mue2["correlativo"].' | '.$mue2["UREHISTO"].' | '.date('d/m/Y H:i:s',strtotime($mue2["fechaUserHisto"])).'</label>'.$chekear;
                                    } else{
                                        echo '<span style="float: left;">'.$mue2["formatoPatoMac"].'-'.$mue2["correlativo"].' | '.$mue2["UREG"].' | '.date('d/m/Y H:i:s',strtotime($mue2["feModificacion"])).' </span>'.$eliminar;
                                    }
                                    
                                    if($mue2["inclusion"]=="checked" || $mue2["corte"]=="checked" || $mue2["coloracion"]=="checked" || $mue2["montaje"]=="checked" || $mue2["entrega"]=="checked" ){
                                        $verChek='si';
                                    }
                                    
                                }
                                
                      
                      ?></td>
                        <?php }  if($tipo==1 || $tipo==2 || $vista==3 ){ ?>  
                     <td style="font-size:12px;text-align: center;vertical-align: inherit;">
                     <?php 
                            if($mue["obsMacro"]!=""){
                                     echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                          onclick="editObsMacro('.$mue["idRo"].')" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfoObslblMacro" class="btn btn-default btn-xs "> Ver detalle </span>';   
                            }
                             
                        }
                     ?></td>
                      <?php if( $vista!=3 &&  $vista!=4 ){ ?>  
                     <td style="font-size:12px;text-align: center;vertical-align: inherit;" class="verDetailObsM"><?php 
                            //echo $mue["obsMicro"]; 
                            
                               if($mue["obsMicro"]!=""){
                                echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                      onclick="editarObsMicroxRotulo('.$mue["idRo"].')" data-toggle="modal" data-target=".bs-example-modal-modalObslblMicro" class="btn btn-default btn-xs "> Ver detalle </span>';
                               }
                            ?></td>
                     <td style="font-size:12px;text-align: center;vertical-align: inherit;" class="veDetailRspta"><?php 
                    // echo $mue["rsptaMicro"];
                     
                        if($mue["rsptaMicro"]!=""){
                                   echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                              onclick="editarRsptaRo('.$mue["idRo"].')" data-toggle="modal" data-target=".bs-example-modal-modalRsptalblMicro" class="btn btn-default btn-xs "> Ver detalle </span>';     
                        }
                       
                      }
                     ?></td>
                    <!--  <td style="text-transform: uppercase;font-size:12px;text-align: center;vertical-align: inherit;"><?php echo date('d/m/Y H:i:s',strtotime($mue["fechaReg"])) ; ?></td>
                      <td style="text-transform: uppercase;font-size:12px;text-align: center;vertical-align: inherit;"><?php echo date('d/m/Y H:i:s',strtotime($mue["fechaAct"])); ?></td>-->
                   
                      <td class=" last" style="text-align: center;font-size:12px;vertical-align: inherit;">
                   
                    
                        
                        <div class="btn-group" style="margin-bottom: 5px;">
                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs" dropdown-toggle="" type="button" aria-expanded="true"> 
                                    <span class="caret"></span> Acciones </button>
                                            <ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
                                                <?php if($vista==1 ) {?>
                                                    <li><a onclick="editarObservacionRo('<?php echo $mue['idRo'] ?>',1,0)" data-toggle="modal" data-target=".bs-example-modal-modalPaquete"><i class="fa fa-edit"></i> Agregar laminas </a></li>
                                                    <li><a onclick="editarObservacionRo('<?php echo $mue['idRo'] ?>',2,1)"  data-toggle="modal" data-target=".bs-example-modal-modalPaquete"><i class="fa fa-refresh"></i> Editar descripcion </a></li>
                                                    <li><a onclick="editObsMacro('<?php echo $mue['idRo'] ?>')" data-toggle="modal" data-target=".bs-example-modal-modalOsbMacrox"><i class="fa fa-exchange"></i> Obs Macroscopia </a></li>
                                                    <li><a onclick="EliminarObsRerPaxRo('<?php echo $mue['idRo']."','".$mue["rotulo"]."','".$formato."','".$tipoest ?>')" style="color: red;font-weight: 800;"><i class="fa fa-close"></i>  Eliminar</a></li>
                                            <?php } else if($vista==2 ) {?>
                                                    <li><a onclick="editarObservacionRo('<?php echo $mue['idRo'] ?>',2,2)"  data-toggle="modal" data-target=".bs-example-modal-modalPaquete"><i class="fa fa-refresh"></i> Editar descripcion </a></li>
                                                    <li><a onclick="editarObsMicroxRotulo(<?php echo $mue['idRo'] ?>)" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroObsMicro"><i class="fa fa-folder-open"></i> Obs Microscopia </a></li>
                                                    <li><a onclick="editarRsptaRo('<?php echo $mue['idRo'] ?>',2)" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicro"><i class="fa fa-folder-open"></i> Rspta Microscopia </a></li>
                                            <?php }  ?>
                                                    </ul>
                        </div>
                        
                    
                    
                       <!-- <a title="Editar" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" onclick="editarObservacionRo('<?php echo $mue['idRo']; ?>')" 
                        class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                       
                        <a title="Eliminar" onclick="EliminarObsRerPaxRo('<?php echo $mue['idRo']."','".$mue["rotulo"]; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>-->
                     
                       
                     
                      </td>
                       
                    </tr>
         <?php } ?>
    </tbody>
  </table>
 