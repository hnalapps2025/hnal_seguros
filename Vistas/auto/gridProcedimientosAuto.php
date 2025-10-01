 <?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();
$id = $_GET["id"];
$ni = $pac->consultaidPresta($id);
$idpres= $mue = $ni->fetch_assoc();
$ni = $pac->consultaXidProcedimientosAuto($idpres["id_prestacion"]);

?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" border="1">
                                                    <thead>
                                                    <tr class="headings" style="font-size: 13px;background: #d6d8d8;color: black;">
                                                              <!--<th class="column-title">Id </th>-->
                                                              <!--<th class="column-title" style="text-transform: uppercase;width:2%;text-align: center;">Id</th>
                                                              <th class="column-title" style="width:4%;text-transform: uppercase;text-align: center;">ID PRESTACION</th>-->
                                                              <th class="column-title" style="width: 4%;text-transform: uppercase;text-align: center;">CODIGO CPT</th>
                                                              <th class="column-title" style="width: 12%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">VALORIZACION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TOTAL</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">DX</th>
                                                              <th class="column-title" style="width: 5%;text-transform: uppercase;text-align: center;">ACCION</th>           
                                                              <th class="column-title" style="width: 1%;text-align: center;"><a onclick="clearFrmProcAuto('<?php echo $idpres['id_prestacion'] ?>');" 
                                                              data-toggle="modal" data-target=".bs-example-modal-ModalProc" class="btEdit btn btn-success btn-xs">+ Agregar</a></th>                                            
                                                      </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){                                                 
                                                                ?>

                                                            <tr class="even pointer">
                                                                      <!--<td style="text-transform: uppercase;text-align: center;color: black;font-size: 10px;"><?php echo $mue["IdProcedimiento"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align: center;color: black;font-size: 10px;"><?php echo $mue["id_prestacion"]; ?></td>-->
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;color: black;font-size: 10px;"><?php   echo $mue["codigo_cpt"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: left;color: black;font-size: 10px;"><?php   echo $mue["descripcion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;color: black;font-size: 10px;"><?php echo $mue["cantidad"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:right;color: black;font-size: 10px;"><?php echo "S/.".$mue["valorizacion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:right;color: black;font-size: 10px;"><?php echo "S/.".$mue["total"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;color: black;font-size: 10px;"><?php echo $mue["dx"]; ?></td>
                                                                      <td style="text-align: center;" > 
                                                                        <a onclick="verProcedimientoAuto(<?php echo $mue['IdProcedimiento']; ?>);" data-toggle="modal" data-target=".bs-example-modal-ModalProc" class="btEdit btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                                                        <a onclick="EliminarPrAuto(<?php echo $mue['IdProcedimiento']; ?>);" class="btEdit btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                                                                      </td>                 
                                                                      <td></td>
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>                           

