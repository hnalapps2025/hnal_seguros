<?php 

include_once ('config.php');
include (MODEL_PATH."ModelProcedmientos.php");
include (MODEL_PATH."global.php");


$sel = new ModelProcedmientos();
$id = $_GET["id"];

$ni = $sel->consultaCptsCitologia($id);


?>

                <!--<div class="modal-header" style="color:black;text-transform: uppercase;text-align: center;">                                   
                                        <h4 class="modal-title" id="">TRANSFERENCIA</h4>
                                </div>-->
                            <table class="table bulk_action" id="tab" border="1">
                                    <thead>
                                      <tr class="headings" style="background:#357ab4;color:white;font-size: 10px;">
                                        <th class="column-title" style="width:2%;text-transform: uppercase;text-align: center;">CIE-0</th>
                                        <th class="column-title" style="width:30%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                        <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;">TIPO DX</th>
                                        <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;">ELIMINAR</th>
                                       
                                      </tr>
                                    </thead>

                                    <tbody>
                                         <?php  
                                              
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>

                                                    <tr class="even pointer">
                                                      <td style="font-size: 10px;text-align: center;" ref="type:text, name:iddon, class:, id:iddon, readonly:readonly">
                                                      <?php echo $mue["cpt"] ; ?>
                                                        
                                                        </td>
                                                      <td style="text-transform: uppercase;font-size:10px;"><?php echo $mue["descripcion"]; ?></td>
                                                      <td style="text-transform: uppercase;font-size:10px;text-align: center;"><?php echo $mue["tipo"] ; ?></td>
                                                     
                                                      <td class=" last" style="text-align: center;">
                          
                                                        <a title="Eliminar" onclick="EliminarRegCitoEspec(<?php echo $mue['id'].','.$mue['code']; ?>)" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                                                       
                                                      </td>
                                                     
                                                    </tr>
                                         <?php } ?>
                                    </tbody>
                                  </table>
 