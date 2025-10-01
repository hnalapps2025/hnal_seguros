<?php 

include_once ('config.php');
include (MODEL_PATH."ModelProcedmientos.php");
include (MODEL_PATH."global.php");


$sel = new ModelProcedmientos();
//$id = $_GET["id"];

$formato = $_GET["formato"];
$tipoest = $_GET["tipoest"];
$id = $_GET["id"];

$ni = $sel->consultaMarcadoresHisto($formato,$tipoest,$id);

?>
                <!--<div class="modal-header" style="color:black;text-transform: uppercase;text-align: center;">                                   
                                        <h4 class="modal-title" id="">TRANSFERENCIA</h4>
                                </div>-->
                            <table class="" id="tab" border="1">
                                    <thead>
                                      <tr class="headings" style="background:#357ab4;color:white;font-size: 10px;">
                                        <th class="column-title" style="width:1%;text-transform: uppercase;text-align: center;">MARCADOR</th>
                                        <th class="column-title" style="width:18%;text-transform: uppercase;text-align: center;">RESULTADO</th>
                                        <th class="column-title" style="width:10%;text-transform: uppercase;text-align: center;">OPCIONES</th>
                                       
                                      </tr>
                                    </thead>

                                    <tbody>
                                         <?php  
                                               while($mue = $ni->fetch_assoc()){
                                                   
                                                 ?>

                                                    <tr class="even pointer">
                                                      <td style="font-size: 10px;text-align: center;vertical-align: inherit;" ref="type:text, name:iddon, class:, id:iddon, readonly:readonly"><?php echo strtoupper($mue["marcador"]); ?></td>
                                                      <td style="font-size:10px;text-align: center;vertical-align: inherit;"><br>
                                                            <?php 
                                                                if($mue["resultado"]!="" || $mue["interpretHi"]!="" || $mue["resulDepend"]!="" ){
                                                                    echo'<span id="user2per" style="font-weight: 100;font-size: 11px;margin-bottom:6px;border: 1px solid white;color: #73879C;"  
                                                                    onclick="editarMarcadorColoracion('.$mue['idMar'].')"  data-toggle="modal" data-target=".bs-example-modal-modalMarcadorColor" 
                                                                    class="btn btn-default btn-xs "> Ver detalle </span>';    
                                                                }
                                                                
                                                            ?>
                                                            
                                                            
                                                      </td>
                                                      <td class=" last" style="text-align: center;vertical-align: inherit;">
                                                            <a title="Editar" data-toggle="modal" data-target=".bs-example-modal-modalRegistroMarcador" 
                                                                onclick="editarMarcadorColoracion('<?php echo $mue['idMar']; ?>')" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                                            <!--<a title="Eliminar" onclick="EliminarMarcad('<?php echo $mue['idMar']; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>-->
                                                      </td>
                                                    </tr>
                                         <?php } ?>
                                    </tbody>
                                  </table>
 