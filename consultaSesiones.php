<?php 

include_once ('config.php');
include (MODEL_PATH."ModelProcedmientos.php");
include (MODEL_PATH."global.php");


$sel = new ModelProcedmientos();
$id = $_GET["id"];

$ni = $sel->consultaSesiones($id);


?>

              
                            <table class="table bulk_action" id="tab" border="1">
                                    <thead>
                                      <tr class="headings" style="background:red;color:white">
                                        <th class="column-title" style="width:1%;text-transform: uppercase;text-align: center;font-size:9px">USUARIO</th>
                                        <th class="column-title" style="width:1%;text-transform: uppercase;text-align: center;font-size:9px">SESION</th>
                                        <th class="column-title" style="width:1%;text-transform: uppercase;text-align: center;font-size:9px">NSP</th>
                                        <th class="column-title" style="width:1%;text-transform: uppercase;text-align: center;font-size:9px">DEVOLUCION</th>
                                        <th class="column-title" style="width:1%;text-transform: uppercase;text-align: center;font-size:9px">REPOGRAMAR</th>
                                        <th class="column-title" style="width:20%;text-transform: uppercase;text-align: center;font-size:9px">OBSERVACIONES</th>  
                                        <th class="column-title" style="text-align: center;width:1%;text-transform: uppercase;font-size:9px">___OPCIONES___</th>
                                       
                                      </tr>
                                    </thead>

                                    <tbody>
                                         <?php  
                                              
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>

                                                    <tr class="even pointer">
                                                      <td style="text-transform: uppercase;font-size:10px;text-align: center;"><?php echo $mue["usars"]; ?></td>
                                                      <td style="font-size: 10px;text-align: center;">
                                                      <?php 
                                                        
                                                        if($mue["sesion"]!=""){
                                                            echo date('d/m/Y',strtotime($mue["sesion"])) ;
                                                        }
// 
                                                        ?>
                                                        
                                                        </td>
                                                        <td style="text-transform: uppercase;font-size:10px;text-align: center;"><?php echo $mue["nsp"]; ?></td>
                                                      <td style="text-transform: uppercase;font-size:10px;text-align: center;"><?php 
                                                        
                                                        if($mue["devolucion"]!=""){
                                                            echo date('d/m/Y',strtotime($mue["devolucion"])) ;
                                                        }
// 
                                                        ?>
                                                        </td>
                                                        <td style="text-transform: uppercase;font-size:10px;text-align: center;"><?php 
                                                        
                                                        if($mue["reprogramar"]!=""){
                                                            echo date('d/m/Y',strtotime($mue["reprogramar"])) ;
                                                        }
// 
                                                        ?>
                                                        </td>
                                                         <td style="text-transform: uppercase;font-size:9px;text-align: left;"><?php echo $mue["observacion"]; ?></td>
                                                      <td class=" last" style="text-align: center;">
                                                        <a title="Editar" onclick="editarSexion('<?php echo $mue['idSe']; ?>')" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
                                                        <a title="Eliminar" onclick="deleteSesions('<?php echo $mue['idSe']; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                                                      </td>
                                                     
                                                    </tr>
                                         <?php } ?>
                                    </tbody>
                                  </table>
 