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

$niCer = $sel->consultaRotuloPciente($tipo,$formato,$tipoest);


?>

<!--<div class="modal-header" style="color:black;text-transform: uppercase;text-align: center;">                                   
        <h4 class="modal-title" id="">TRANSFERENCIA</h4>
</div>-->
<table class="table bulk_action" id="tab" border="1">
    <thead>
      <tr class="headings" style="background:#357ab4;color:white;font-size: 10px;">
       
            <th class="column-title" style="width:10%;text-transform: uppercase;text-align: center;font-size:12px;">MUESTRA</th>
            <th class="column-title" style="width:15%;text-transform: uppercase;text-align: center;font-size:12px;">DESCRIPCION</th>
            <th class="column-title" style="width:48%;text-transform: uppercase;text-align: center;font-size:12px;" id="tileUbs">LAMINAS</th>
            <th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;font-size:12px;">OBS LAB</th>
            <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;font-size:12px;">OPCIONES</th>

       
      </tr>
    </thead>

    <tbody>
         <?php  
              
               while($mueCer = $niCer->fetch_assoc()){                                                 
                 ?>

                    <tr class="even pointer">
                        
                  
                      
                      <td style="text-transform: uppercase;font-size:12px;text-align: center;vertical-align: inherit;"><?php echo $mueCer["rotulo"]; ?></td>
                      <td style="font-size:12px;vertical-align: inherit;text-align: center;">
                       
                            <span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                            onclick="editarObservacionRo(<?php echo $mueCer['idRo'].",2,1" ?>)" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfoDescripMacro" 
                            class="btn btn-default btn-xs "> Ver detalle </span> 
                                
                                    
                        </td>
                        
                        
                      <td style="text-transform: uppercase;font-size:9px;vertical-align: inherit;">
                      <?php 
                                
                                
                                
                                $ni2Cer = $sel->consultaDetalleRotulo($mueCer["rotulo"],$tipo,$formato,$tipoest);
                                while($mue2Cer = $ni2Cer->fetch_assoc()){
                                  
                                  $anio = date("Y");
                                    $verChek='';$eliminar='<span style="float: right;"><a title="Eliminar" onclick="EliminarTacoXtaco('.$mue2Cer['id'].')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a></span>';
                                    $chekear='<input  '.$mue2Cer["checkHisto"].' type="checkbox" style="margin-top: 0px;margin-left: 8px;float: right;" id="'.$mue2Cer["id"].'" name="'.$mue2Cer["id"].'"  onclick="registrarUserHisto('.$mue2Cer["id"].','.$iduser.')" ><br>';
                                  
                                    echo '<span style="float: left;">'.$mue2Cer["formatoPatoMac"].'-'.$mue2Cer["correlativo"].' | '.$mue2Cer["UREG"].' | '.date('d/m/Y H:i:s',strtotime($mue2Cer["feModificacion"])).' </span>'.$eliminar;
                                    
                                    if($mue2Cer["inclusion"]=="checked" || $mue2Cer["corte"]=="checked" || $mue2Cer["coloracion"]=="checked" || $mue2Cer["montaje"]=="checked" || $mue2Cer["entrega"]=="checked" ){
                                        $verChek='si';
                                    }
                                    
                                }
                                
                      
                      ?></td>
                       
                     <td style="font-size:12px;text-align: center;vertical-align: inherit;">
                     <?php 
                            if($mueCer["obsMacro"]!=""){
                                     echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                          onclick="editObsMacro('.$mueCer["idRo"].')" data-toggle="modal" data-target=".bs-example-modal-modalResptaMicroLabInfoObslblMacro" class="btn btn-default btn-xs "> Ver detalle </span>';   
                            }
                             
                        
                     ?></td>
                      <td class=" last" style="text-align: center;font-size:12px;vertical-align: inherit;">
                     
                    
                        
                        <div class="btn-group" style="margin-bottom: 5px;">
                                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs" dropdown-toggle="" type="button" aria-expanded="true"> 
                                    <span class="caret"></span> Acciones </button>
                                            <ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
                                               
                                                    <li><a onclick="editarObservacionRo(<?php echo $mueCer['idRo'].",1,0" ?>)" data-toggle="modal" data-target=".bs-example-modal-modalPaquete"><i class="fa fa-edit"></i> Agregar Laminas </a></li>
                                                    <li><a onclick="editarObservacionRo(<?php echo $mueCer['idRo'].",2,1" ?>)"  data-toggle="modal" data-target=".bs-example-modal-modalPaquete"><i class="fa fa-refresh"></i> Editar informe </a></li>
                                                    <li><a onclick="editObsMacro(<?php echo $mueCer['idRo'] ?>)" data-toggle="modal" data-target=".bs-example-modal-modalOsbMacrox"><i class="fa fa-exchange"></i> Obs Laboratorio </a></li>
                                                    <li><a onclick="EliminarObsRerPaxRo(<?php echo $mueCer['idRo'].",'".$mueCer['rotulo']."','".$formato."','".$tipoest ?>')" style="color: red;font-weight: 800;"><i class="fa fa-close"></i>  Eliminar</a></li>
                                                    
                                            
                                            </ul>
                        </div>
                        
                
                       
                       
                      </td>
                       
                    </tr>
         <?php   } ?>
    </tbody>
  </table>
 