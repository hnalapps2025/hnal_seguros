 <?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();
$id = $_GET["id"];
$ni = $pac->consultaidPresta($id);
$idpres= $mue = $ni->fetch_assoc();
$ni = $pac->consultaXinsumosAuto($idpres["id_prestacion"]);

?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" border="1">
                                                    <thead>
                                                    <tr class="headings" style="font-size: 13px;background: #d6d8d8;color: black;">
                                                              <!--<th class="column-title">Id </th>-->
                                                              <!--<th class="column-title" style="text-transform: uppercase;width:2%;text-align: center;">Id</th>
                                                              <th class="column-title" style="width:4%;text-transform: uppercase;text-align: center;">ID PRESTACION</th>-->
                                                              <th class="column-title" style="width: 4%;text-transform: uppercase;text-align: center;">CODIGO SISMED</th>
                                                              <th class="column-title" style="width: 12%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 4%;text-transform: uppercase;text-align:center;">VALORIZACION</th>
                                                              <th class="column-title" style="width: 5%;text-transform: uppercase;text-align:center;">TOTAL</th>
                                                              <th class="column-title" style="width: 4%;text-transform: uppercase;text-align: center;">DX</th>
                                                              <th class="column-title" style="width: 5%;text-transform: uppercase;text-align: center;">ACCION</th>
                                                              <th class="column-title" style="width: 1%;text-align: center;"><a onclick="clearFrmInsuAuto('<?php echo $idpres['id_prestacion'] ?>');" 
                                                              data-toggle="modal" data-target=".bs-example-modal-ModalInsu" class="btEdit btn btn-success btn-xs">+ Agregar</a></th>                               
                                                      </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){     
                                                                if($mue["valorizacion"]=="0.00"){
                                                                  echo ' <tr class="even pointer" style="background: red;">';
                                                                }else{
                                                                  echo ' <tr class="even pointer">';
                                                                }                                            
                                                                ?>

                                                           
                                                                      
                                                                      <!--<td class=" " style="text-transform: uppercase;text-align: center;color: black;font-size: 10px;"><?php echo $mue["idInsumos"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;color: black;font-size: 10px;"><?php   echo $mue["id_prestacion"]; ?></td>-->
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;color: black;font-size: 10px;"><?php echo $mue["codigo_sismed"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:left;color: black;font-size: 10px;"><?php echo $mue["descripcion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;color: black;font-size: 10px;"><?php echo $mue["cantidad"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:right;color: black;font-size: 10px;"><?php echo "S/.".$mue["valorizacion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:right;color: black;font-size: 10px;"><?php echo "S/.".$mue["total"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;color: black;font-size: 10px;"><?php  echo $mue["diagnostico"]; ?></td>
                                                                      <td style="text-align: center;" > 
                                                                        <a onclick="verInsumosAuto(<?php echo $mue['idInsumos']; ?>);" data-toggle="modal" data-target=".bs-example-modal-ModalInsu" class="btEdit btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                                                        <a onclick="EliminarInsuAuto(<?php echo $mue['idInsumos']; ?>);" class="btEdit btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
                                                                      </td>     
                                                                      <td></td>                
                                                                      
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>                           
                                                <table style="float: right;" class="hidden">
                                                <tr>
                                                
                                                  <td style="font-weight: bolder;color: black;">SUBTOTAL: </td>
                                                  <td class="tg-0lax" id="subproc" style="color: black;font-size: 17px;">
                                                        
                                                       <?php 
                                                          $ni = $pac->sumXidinsumos($id);
                                                          $mue = $ni->fetch_assoc();
                                                          $totim = $mue["totalproc"]; 
                                                          echo "S/. ".number_format($totim, 2, ".", ",");
                                                       ?>
                                                  </td>
                                                </tr>
                                              </table>   

