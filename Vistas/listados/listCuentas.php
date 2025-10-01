<?php 


include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();


$id = $_GET["id"];
$ni = $pac->cartasCuentas($id);


?>


                                  <table class="table jambo_table bulk_action"  id="pac3X" border="1" >
                                    <thead>
                                      <tr class="headings" style="font-size: 10px;">
                                        <th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;">estado</th>  
                                        <th class="column-title" style="width:6%;text-transform: uppercase;text-align: center;">Nro cuenta</th>
                                        <th class="" style="width:8%;text-transform: uppercase;text-align: center;">historia clinica</th>
                                        <th class="" style="width:9%;text-transform: uppercase;text-align: center;">f. atencion</th>
                                        <th class="" style="width:12%;text-transform: uppercase;text-align: center;">consultorio</th>     
                                                                                                              
                                        <th class="column-title" style="width:6%;text-transform: uppercase;text-align: center;">OPCIONES</th>                                       
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php  
                                             
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>
     
                                                    <tr class="even pointer">
                                                        <td class=" " style="text-transform: uppercase;;text-align: center;">
                                                          <?php
                                                                if($mue["estado"]=="on"){
                                                                  echo  '<button type="button" class="btn btn-round btn-success btn-xs">Atendido</button>';
                                                                }else{
                                                                  echo  '<button type="button" class="btn btn-round btn-danger btn-xs">No atendido</button>';
                                                                }
                                                          ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo $mue["nrocuenta"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo $mue["historia"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo date('d/m/Y',strtotime($mue["fatencion"])); ?></td>
                                                      <td class="" style="text-transform: uppercase;text-align:left;"><?php echo $mue["consultorio"]; ?></td>
                                                                                                                                                                
                                                      <td style="text-align: center;" > 
                                                       <a onclick="editarCuenta(<?php echo $mue['idCuenta']; ?>);" class="btEdit btn btn-info btn-xs" title="EDITAR"  ><i class="fa fa-edit"></i> </a>
                                                        <a onclick="EliminaCuentas(<?php echo $mue['idCuenta']; ?>);" class="btEdit btn btn-danger btn-xs" title="ELIMINAR" ><i class="fa fa-close"></i> </a>                                          
                                                      </td>                
                                                      
                                                    </tr>
                                         <?php }
                                                    
                                                     ?>
                                    </tbody>
                                  </table>

                                  <!--<style>
                                  .dataTables_length{
                                    display:none;
                                  }
                                  .dataTables_filter {
                                      float: left !important;
                                  }
                                  .dataTables_filter label {
                                      float: left !important;
                                  }

                                  </style>-->