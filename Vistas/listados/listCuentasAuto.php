<?php 


include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();

$id = $_GET["id"];
$es = $_GET["es"];
$grupo = $_GET["grupo"];

$ni = $pac->cartasCuentasAuto($id,$es,$grupo);


?>

                                  <table class="table jambo_table bulk_action"  id="pac3X" border="1" >
                                    <thead>
                                      <tr class="headings" style="font-size: 10px;">
                                        
                                        <th class="column-title" style="width:6%;text-transform: uppercase;text-align: center;">Nro cuenta</th>
                                        <th class="" style="width:8%;text-transform: uppercase;text-align: center;">estado</th>
                                        <th class="" style="width:9%;text-transform: uppercase;text-align: center;">f. ingreso</th>
                                        <th class="" style="width:12%;text-transform: uppercase;text-align: center;">f. alta</th>     
                                                                                                              
                                        <th class="column-title" style="width:6%;text-transform: uppercase;text-align: center;">OPCIONES</th>                                       
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php  
                                             
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>
     
                                                    <tr class="even pointer">
                                                       
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo $mue["IdCuentaAtencion"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php 
                                                          if ($mue["estadoCuenta"]==0){ echo "<strong style='color: red;'>Pendiente</strong>"; } else { echo "<strong style='color: green;'>Terminado</strong>";} ?>
                                                          </td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo date('d/m/Y',strtotime($mue["fecha_ingreso"])); ?></td>
                                                      <td class="" style="text-transform: uppercase;text-align:center;"><?php echo date('d/m/Y',strtotime($mue["fecha_alta"])); ?></td>
                                                                                                                                                                
                                                      <td style="text-align: center;" > 
                                                       <a target="blank" href="editarCuenta.php?id=<?php echo $mue['IdCuentaAtencion']; ?>" class="btEdit btn btn-success btn-xs" title="EDITAR"><i class="fa fa-edit"></i> Auditar</a>
                                                      <!--  <a onclick="EliminaCuentas(<?php echo $mue['idCuenta']; ?>);" class="btEdit btn btn-danger btn-xs" title="ELIMINAR" ><i class="fa fa-close"></i> </a>-->
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