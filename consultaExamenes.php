<?php 

include_once ('config.php');
include (MODEL_PATH."ModelProcedmientos.php");
include (MODEL_PATH."global.php");


$sel = new ModelProcedmientos();
$id = $_GET["id"];

$ni = $sel->consultaExamenPersona($id);


?>

                <!--<div class="modal-header" style="color:black;text-transform: uppercase;text-align: center;">                                   
                                        <h4 class="modal-title" id="">TRANSFERENCIA</h4>
                                </div>-->
                            <table class="table bulk_action" id="tab" border="1">
                                    <thead>
                                      <tr class="headings" style="background:red;color:white">
                                        <th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;">FECHA</th>
                                        <th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;">NUMERO</th>
                                        <th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;">ESTABLECIMIENTO</th>
                                        <th class="column-title" style="text-align: center;width:1%;text-transform: uppercase;">OPCIONES</th>
                                       
                                      </tr>
                                    </thead>

                                    <tbody>
                                         <?php  
                                              
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>

                                                    <tr class="even pointer">
                                                      <td style="font-size: 11px;text-align: center;" ref="type:text, name:iddon, class:, id:iddon, readonly:readonly">
                                                      <?php 
                                                        
                                                        if($mue["fecha"]!=""){
                                                            echo date('d/m/Y',strtotime($mue["fecha"])) ;
                                                        }
// 
                                                        ?>
                                                        
                                                        </td>
                                                      <td style="text-transform: uppercase;font-size:11px;"><?php echo $mue["nrotransf"]; ?></td>
                                                      <td style="text-transform: uppercase;font-size:11px;"><?php echo $mue["eess"]; ?></td>
                                                      <td class=" last" style="text-align: center;">
                                                        <a title="Eliminar" onclick="EliminarExamen('<?php echo $mue['idTran']; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                                                      </td>
                                                     
                                                    </tr>
                                         <?php } ?>
                                    </tbody>
                                  </table>
 