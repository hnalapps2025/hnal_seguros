 <?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();
$id = $_GET["id"];
$ni = $pac->consultaidPresta($id);
$idpres= $mue = $ni->fetch_assoc();
$ni = $pac->consultaXidDx($idpres["id_prestacion"]);

?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" border="1">
                                                    <thead>
                                                        <tr class="headings" style="font-size: 10px;background: #d6d8d8;color: black;">
                                                              <!--<th class="column-title">Id </th>-->
                                                              <!--<th class="column-title" style="text-transform: uppercase;width:2%;text-align: center;">Id</th>
                                                              <th class="column-title" style="width:4%;text-transform: uppercase;text-align: center;">ID PRESTACION</th>-->
                                                              
                                                              <th class="column-title" style="width: 4%;text-transform: uppercase;text-align: center;">CODIGO</th>                                        
                                                              <th class="column-title" style="width: 9%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 4%;text-transform: uppercase;text-align: center;">TIPO DIAGNOSTICO</th>
                                                              <th class="column-title" style="width: 3%;text-transform: uppercase;text-align: center;">USUARIO</th>
                                                              <th class="column-title" style="width: 5%;text-transform: uppercase;text-align: center;">ACCION</th>
                                                              <th class="column-title" style="width: 1%;text-align: center;"><a onclick="clearFrmDx('<?php echo $idpres['id_prestacion'] ?>');" 
                                                              data-toggle="modal" data-target=".bs-example-modal-ModalDiag" class="btEdit btn btn-success btn-xs">+ Agregar</a></th>                                      
                                                      </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){                                                 
                                                                ?>

                                                            <tr class="even pointer">
                                                                      <!--<td style="text-transform: uppercase;text-align: center;color: black;font-size: 10px;"><?php echo $mue["IdDiagnostico"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align: center;color: black;font-size: 10px;"><?php echo $mue["id_prestacion"]; ?></td>-->
                                                                     
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;color: black;font-size: 10px;"><?php echo $mue["codigo_diagnostico"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:left;color: black;font-size: 10px;"><?php echo $mue["Descripcion_diagnostico"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;color: black;font-size: 10px;"><?php   
                                                                           $tipDiag = $mue["tipo_diagnostico"]; 
                                                                            if($tipDiag=="1"){
                                                                                echo "DEFINITIVO";
                                                                            }else if($tipDiag=="2"){
                                                                                echo "PRESUNTIVO";
                                                                          }else{
                                                                                echo "REPETITIVO";
                                                                          }
                                                                          ?>
                                                                      </td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;color: black;font-size: 10px;"><?php echo $mue["user"]; ?></td>
                                                                      <td style="text-align: center;" > 
                                                                        <a onclick="verDiagnostico(<?php echo $mue['IdDiagnostico']; ?>);" data-toggle="modal" data-target=".bs-example-modal-ModalDiag" class="btEdit btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                                                        <a onclick="EliminarDx(<?php echo $mue['IdDiagnostico']; ?>);" class="btEdit btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                                                                      </td>    
                                                                      <td></td>            
                                                                      
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>                           

