 <?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();
$ni = $pac->consultaXGrupoX();

?>  
                                              <table class="table table-bordered bulk_action dataTable no-footer"  id="pac" border="1" style="border: 1px solid white;">
                                                    <thead style="background: #2a3f54;color: white;">
                                                        <tr class="headings" style="font-size: 10px;">
                                                                <th class="column-title" style="width: 4%;text-transform: uppercase;text-align: center;">ID</th>
                                                                <th class="column-title" style="width: 10%;text-transform: uppercase;text-align: center;">AUDITOR</th>
                                                                <th class="column-title" style="width: 20%;text-transform: uppercase;text-align: center;">MES </th>
                                                                <th class="column-title" style="width: 10%;text-transform: uppercase;text-align: center;">CUENTAS IMPORTADAS </th>
                                                                <th class="column-title" style="width: 10%;text-transform: uppercase;text-align: center;">CUENTAS PENDIENTES </th>           
                                                                <th class="column-title" style="width: 20%;text-transform: uppercase;text-align: center;">fECHA GENERADA</th>                                        
                                                                <td class="column-title" style="width: 20%;text-transform: uppercase;text-align: center;">ACCIONES</td>                               
                                                        </tr>
                                                    </thead>
                                                 
                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){                                                 
                                                                ?>

                                                            <tr class="even pointer">
                                                                     
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;color: black;font-size: 11px;"><?php   echo $mue["idRegistro"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;color: black;font-size: 11px;"><?php   echo $mue["user"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: CENTER;color: black;font-size: 11px;"><?php   echo $mue["idRegistro"]."-".$mue["mes"]."-".$mue["anio"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;color: black;font-size: 11px;"><?php  
                                                                       
                                                                       
                                                                       $ni2 = $pac->numCuentasX($mue["idRegistro"]);
                                                                       $cnt3 = mysqli_num_rows($ni2);
                                                                       echo $cnt3;
                                                                       
                                                                       ?></td>
                                                                       <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;color: black;font-size: 11px;"><?php  
                                                                       
                                                                            $ni2 = $pac->numCuentas("0",$mue["idRegistro"]);
                                                                            $cnt3 = mysqli_num_rows($ni2);
                                                                            echo $cnt3;
                                                                       
                                                                       ?></td>
                                                                      <td class="" style="text-transform: uppercase;font-size: 12px;text-align:center;color: black;font-size: 11px;"><?php echo  date('d/m/Y',strtotime($mue["fechaRegistro"])); ?></td>
                                                                      <td class=" " style="font-size: 12px;text-align:center;color: black;">
                                                                      <?php if($rol=="1" || $rol=="3"){?>
                                                                            <a onclick="asignarAudix(<?php echo $mue['idRegistro']; ?>)" data-toggle="modal" data-target=".bs-example-modal-smResponsable" class="btEdit btn btn-success btn-xs"><i class="fa fa-user"></i> Asignar Auditor</a> 
                                                                        <?php } ?>
                                                                        <?php if($iduser==$mue["resposanble"] || $rol=="3" || $rol=="1"){?>
                                                                         <a href="autorizaciones.php?id=<?php echo $mue['idRegistro']; ?>" class="btEdit btn btn-danger btn-xs"><i class="fa fa-upload"></i> Auditar</a>
                                                                         <?php   } ?> 
                                                                         <?php if($rol=="1" || $rol=="3" ){?>
                                                                                <div class="btn-group" style="margin-bottom: 5px;">
                                                                                        <button data-toggle="dropdown" class="btn btn-info dropdown-toggle btn-xs" type="button" aria-expanded="false"> Opciones<span class="caret"></span>
                                                                                        </button>
                                                                                        <ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
                                                                                        <li><a onclick="generTx('<?php echo $mue['idRegistro'].'-'.$mue['mes'].'-'.$mue['anio']; ?>',<?php echo $mue['idRegistro']; ?>)" 
                                                                                    ><i class="fa fa-file"></i>  Generar Txt</a> 
                                                                                        </li>
                                                                                        <li><a href="ExportarTotalGroup.php?id=<?php echo $mue['idRegistro']; ?>" ><i class="fa fa-file-excel-o"></i> Valorización</a> 
                                                                                        </li>
                                                                                        <li> 
                                                                                            <?php 
                                                                                                $nombre_fichero = "C:/wamp64/www/prestacional/txt/".$mue['idRegistro'].'-'.$mue['mes'].'-'.$mue['anio'].".zip";
                                                                                                if (file_exists($nombre_fichero)) {
                                                                                                    echo "<a href='txt/".$mue['idRegistro'].'-'.$mue['mes'].'-'.$mue['anio'].".zip' ><i class='fa fa-folder-open'></i> Descargar Txt</a>";
                                                                                                }
                                                                                            ?>   
                                                                                        </li>
                                                                                        </ul>
                                                                                </div>
                                                                                <?php   } ?>
                                                                       </td>
                                                                     
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>                           

