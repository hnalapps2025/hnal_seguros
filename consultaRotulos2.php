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
         <th class="column-title" style="width:10%;text-transform: uppercase;text-align: center;font-size:12px;">MUESTRA</th>
         <th class="column-title" style="width:50%;text-transform: uppercase;text-align: center;font-size:12px;" id="tileUbs">TACOS</th>
      </tr>
    </thead>

    <tbody>
         <?php  
              
               while($mue = $ni->fetch_assoc()){                                                 
                 ?>

                    <tr class="even pointer">
                        
                      
                      <td style="text-transform: uppercase;font-size:12px;text-align: center;vertical-align: inherit;"><?php echo $mue["rotulo"]; ?></td>
                      <td style="text-transform: uppercase;font-size:9px;vertical-align: inherit;">
                      <?php 
                                
                                
                                
                                $ni2 = $sel->consultaDetalleRotulo($mue["rotulo"],$tipo,$formato,$tipoest);
                                while($mue2 = $ni2->fetch_assoc()){
                                  $f1 ='';
                                  
                                  if($mue2["fechaUserHisto"]!=""){
                                      $f1=' | '.$mue2["UREHISTO"].' | '.date('d/m/Y H:i:s',strtotime($mue2["fechaUserHisto"]));
                                  }
                                  
                                  $anio = date("Y");
                                    $verChek='';$eliminar='<span style="float: right;"><a title="Eliminar" onclick="EliminarTacoXtaco('.$mue2['id'].')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a></span>';
                                    $chekear='<input  '.$mue2["checkHisto"].' type="checkbox" style="margin-top: 0px;margin-left: 8px;float: right;" id="'.$mue2["id"].'" name="'.$mue2["id"].'"  onclick="registrarUserHisto('.$mue2["id"].','.$iduser.',2)" ><br>';
                                  
                                     echo '<label >'.$mue2["formatoPatoMac"].'-'.$mue2["correlativo"].$f1.'</label>'.$chekear;
                                    
                                   
                                    
                                }
                                
                      
                      ?>
                      </td>
                        
                       
                    </tr>
         <?php } ?>
    </tbody>
  </table>
 