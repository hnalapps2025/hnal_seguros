<?php 

include_once ('config.php');
include (MODEL_PATH."ModelProcedmientos.php");
include (MODEL_PATH."global.php");


$sel = new ModelProcedmientos();
$id = $_GET["id"];

$ni = $sel->consultaEXtesnionIhHq($id);


?>

                <!--<div class="modal-header" style="color:black;text-transform: uppercase;text-align: center;">                                   
                                        <h4 class="modal-title" id="">TRANSFERENCIA</h4>
                                </div>-->
                            <table class="table bulk_action" id="tab" border="1">
                                    <thead>
                                      <tr class="headings" style="background:#357ab4;color:white;font-size: 10px;">
                                        <th class="column-title" style="width:20%;text-transform: uppercase;text-align: center;">DIAGNOSTICO</th>
                                        <th class="column-title" style="width:30%;text-transform: uppercase;text-align: center;">INTERPRETACION</th>
                                        <th class="column-title" style="width:20%;text-transform: uppercase;text-align: center;">COMENTARIO</th>
                                        <th class="column-title" style="width:20%;text-transform: uppercase;text-align: center;">NOTA</th>
                                        <th class="column-title" style="width:10%;text-transform: uppercase;text-align: center;">OPCIONES</th>
                                       
                                      </tr>
                                    </thead>

                                    <tbody>
                                         <?php  
                                              
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>

                                                    <tr class="even pointer">
                                                      <td style="font-size: 10px;text-align: center;" ref="type:text, name:iddon, class:, id:iddon, readonly:readonly"><?php echo strtoupper($mue["dx"]); ?></td>
                                                      <td style="text-transform: uppercase;font-size:10px;"><?php echo strtoupper($mue["inter"]); ?></td>
                                                      <td style="text-transform: uppercase;font-size:10px;text-align: center;"><?php echo strtoupper($mue["comentario"]); ?></td>
                                                      <td style="text-transform: uppercase;font-size:10px;text-align: center;"><?php echo strtoupper($mue["nota"]); ?></td>
                                                      <td class=" last" style="text-align: center;">
                                                        <a title="Eliminar" onclick="EliminaLineasExten('<?php echo $mue['id']; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                                                      </td>
                                                     
                                                    </tr>
                                         <?php } ?>
                                    </tbody>
                                  </table>
 