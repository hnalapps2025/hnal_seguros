 <?php 


include_once ('./../../config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();
$ni2 = $pac->sqlDxHistoria($id);

?>  


                                              <table class="table bulk_action compact dataTable " style="width:100%" id="tbl_dx">
                                                            <thead>
                                                              <tr style="color: white;background: #405467;">
                                                                <th class="tg-0lax">CIE10 + DESCRIPCION </th>
                                                                <th class="tg-0lax" style="width: 48px;">TIPO DX</th>
                                                                 <th class="tg-0lax" style="width: 60px;">
                                                                     <button id="agregar" class="btn btn-success btn-xs" style="margin: -1px;"> + Agregar</button>
                                                                  </th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                              <tr>
                                                                <td class="tg-0lax"></td>
                                                                <td class="tg-0lax"></td>
                                                                <td class="tg-0lax"></td>
                                                              </tr>
                                                              
                                                              <?php 
                                                                    
                                                                     while($mue = $ni2->fetch_assoc()){
                                                                        
                                                                ?>

                                                              
                                                              <tr>
                                                                <td class="tg-0lax" style="font-size: 10px;"><?php   echo $mue["dx"]; ?></td>
                                                                <td class="tg-0lax" style="text-align: center;"><?php   echo $mue["tipoDx"]; ?></td>
                                                                <td class="tg-0lax" style="text-align: center;"><a style="background: #d9534f;border: 1px solid #d9534f;margin: -2px;" class="btn btn-danger btn-xs" 
                                                                        onclick="deleteDxHist(<?php echo $mue["idDxHis"]; ?>)"  title="Eliminar"><i class="fa fa-close"></i></a></td>
                                                              </tr>
                                                              
                                                              <?php } ?>
                                                              
                                                            </tbody>
                                            </table>                           

