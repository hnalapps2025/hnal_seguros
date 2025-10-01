<?php 

include_once ('config.php');
include (MODEL_PATH."ModelProcedmientos.php");
include (MODEL_PATH."global.php");


$sel = new ModelProcedmientos();
$id = $_GET["id"];

$ni = $sel->consultaObservacionesPciente($id);


?>

                <!--<div class="modal-header" style="color:black;text-transform: uppercase;text-align: center;">                                   
                                        <h4 class="modal-title" id="">TRANSFERENCIA</h4>
                                </div>-->
                            <table class="table bulk_action" id="tab" border="1">
                                    <thead>
                                      <tr class="headings" style="background:#357ab4;color:white;font-size: 10px;">
                                        <th class="column-title" style="width:2%;text-transform: uppercase;text-align: center;">USUARIO</th>
                                        <th class="column-title" style="width:30%;text-transform: uppercase;text-align: center;">OBSERVACION</th>
                                        <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;">FECHA_REG</th>
                                        <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;">FECHA_ACT</th>
                                        <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;">OPCIONES</th>
                                       
                                      </tr>
                                    </thead>

                                    <tbody>
                                         <?php  
                                              
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>

                                                    <tr class="even pointer">
                                                      <td style="font-size: 10px;text-align: center;" ref="type:text, name:iddon, class:, id:iddon, readonly:readonly">
                                                      <?php echo $mue["USOX"] ; ?>
                                                        
                                                        </td>
                                                      <td style="text-transform: uppercase;font-size:10px;"><?php echo $mue["detalles"]; ?></td>
                                                      <td style="text-transform: uppercase;font-size:10px;text-align: center;"><?php echo date('d/m/Y H:i:s',strtotime($mue["fechaRegistro"])) ; ?></td>
                                                      <td style="text-transform: uppercase;font-size:10px;text-align: center;"><?php echo date('d/m/Y H:i:s',strtotime($mue["fechaUpdate"])); ?></td>
                                                      <td class=" last" style="text-align: center;">
                                                    <?php if($iduser==$mue["iduser"]){  ?>
                                                        <a title="Editar" data-toggle="modal" data-target=".bs-example-modal-modalObserv" onclick="editarObservacion('<?php echo $mue['idObs']; ?>')" 
                                                        class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                                       
                                                        <a title="Eliminar" onclick="EliminarObserPax('<?php echo $mue['idObs']; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                                                       <?php } ?>
                                                      </td>
                                                     
                                                    </tr>
                                         <?php } ?>
                                    </tbody>
                                  </table>
 