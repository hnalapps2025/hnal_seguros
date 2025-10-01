<?php 


include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();


$id = $_GET["id"];
$rest = substr($ext, -2);


$ni = $pac->autorizaciones($id);


?>

<script type="text/javascript">
                                
                                    $(document).ready(function() {


                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;


                                                $('#pac3Auto').DataTable( {
                                                  "searching": true,
                                                  "pageLength": 100000,
                                                  "order": [[ 0, "desc" ]],
                                                  dom: '<fBtip>',
                                                  buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'PacientesRegistrados'+ output,
                                                            exportOptions: {
                                                              columns: [0,1,2,3,4,5,6,7,8,9]
                                                            },
                                                            customize: function(xlsx) {
                                                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                                              $('row[r=2] c', sheet).attr('s', '47');
                                                          }
                                                        }
                                                        
                                                  ],                                                     
                                                  language: {
                                                        "decimal": "",
                                                        "searchPlaceholder": "Columna ..",
                                                        "emptyTable": "No hay registros para mostrar",
                                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                                                        "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                                                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                                                        "infoPostFix": "",
                                                        "thousands": ",",
                                                        "lengthMenu": "Mostrar _MENU_ filas",
                                                        "loadingRecords": "Cargando...",
                                                        "processing": "Procesando...",
                                                        "search": "Buscar por: ",
                                                        "zeroRecords": "Sin resultados encontrados",
                                                        "paginate": {
                                                            "first": "Primero",
                                                            "last": "Ultimo",
                                                            "next": "Siguiente",
                                                            "previous": "Anterior"
                                                        }
                                                    },
                                                    
                                                  });
                                      

                                        $('#pac3Auto_filter').addClass('form-group');
                                        $('#pac3Auto_filter').css('text-align','left');
                                        $('#pac3Auto_filter').css('float','left');
                                        $('.dt-buttons').css('display','none');
                                        $('#pac3Auto_filter label input').addClass('form-control');
                                        $('#pac3Auto_length label select').addClass('form-control');
                                       
                                    } );


                                    $(document).ready(function(){
                                        $.fn.dataTable.ext.search.push(
                                          function (settings, data, dataIndex) {
                                              var min = $('#min').datepicker("getDate");
                                              var max = $('#max').datepicker("getDate");
                                              var startDate = new Date(data[23]);
                                              if (min == null && max == null) { return true; }
                                              if (min == null && startDate <= max) { return true;}
                                              if(max == null && startDate >= min) {return true;}
                                              if (startDate <= max && startDate >= min) { return true; }
                                              return false;
                                              }
                                        );                                
                                            $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
                                            $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
                                            var table = $('#pac3').DataTable();

                                            $('#min, #max').change(function () {
                                              //nuevo cambio    
                                                   table.draw();
                                            });
                                        });

                                </script>
                           
                                  <table class="table jambo_table bulk_action"  id="pac3Auto" >
                                    <thead>
                                      <tr class="headings" style="font-size: 10px;">
                                        <th class="column-title " style="text-align:center">#</th>
                                        <th class="column-title" style="width:15%;text-transform: uppercase;text-align: center;">Nro Carta</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">DNI</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">Paciente</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">historia</th>     
                                        <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;">cuentas</th>
                                        <th class="column-title" style="width:12%;text-transform: uppercase;text-align: center;">cuentas pendientes</th> 
                                        <th class="column-title" style="width:12%;text-transform: uppercase;text-align: center;">cuentas ENVIADAS</th> 
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">F. nac</th>                               
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">sexo</th> 
                                        <!--<th class="column-title" style="text-transform: uppercase;text-align: center;">Errores</th>     -->
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php  
                                             
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>
    
                                                    <tr class="even pointer">
                                                      <td class="" style="text-transform: uppercase;text-align: center;">
                                                          <?php 
                                                           $ni3 = $pac->nroCuentasPendientes($mue["nro_documento_autorizacion"],"0",$id);
                                                           $cnt33 = mysqli_num_rows($ni3);
                                                           if($cnt33>0){
                                                              echo '<button type="button" class="btn btn-danger btn-xs" style="color: red;">#</button>';
                                                           }else{
                                                              echo '<button type="button" class="btn btn-success btn-xs" style="color: #26b99a;">#</button>';
                                                           }
                                                          ?>
                                                      
                                                      </td>
                                                      
                                                      <td class=" " style="text-transform: uppercase;text-align: center;">
                                                      <a onclick="verCuentasAuto('<?php echo $mue['nro_documento_autorizacion']; ?>','0',<?php echo $id ?>);" data-toggle="modal" data-target=".bs-example-modal-smCuentasAu"
                                                       style="cursor: pointer;text-decoration: underline;font-weight: bolder;"  ><?php echo $mue["nro_documento_autorizacion"]; ?> </a>
                                                      </td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo $mue["nro_documento_paciente"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: left;"><?php echo $mue["apellido_paterno_paciente"]." ".$mue["apellido_materno_paciente"]." ".$mue["nombres_paciente"]; ?></td>
                                                      <td class="" style="text-transform: uppercase;text-align: center;"><?php echo $mue["nro_historia"]; ?></td>
                                                      <td class="" style="text-transform: uppercase;text-align: center;font-weight: bolder;"><?php 

                                                      
                                                            $ni2 = $pac->nroCuentas($mue["nro_documento_autorizacion"],$id);
                                                            $cnt3 = mysqli_num_rows($ni2);
                                                            echo $cnt3;
                                                       
                                                       ?></td>
                                                       <td class="" style="text-transform: uppercase;text-align: center;font-weight: bolder;"><?php 

                                                      
                                                        $ni3 = $pac->nroCuentasPendientes($mue["nro_documento_autorizacion"],"0",$id);
                                                        $cnt33 = mysqli_num_rows($ni3);
                                                        echo $cnt33;

                                                        ?></td>
                                                         <td class="" style="text-transform: uppercase;text-align: center;font-weight: bolder;"><?php 
                                                       
                                                          $ni3 = $pac->nroCuentasPendientes($mue["nro_documento_autorizacion"],"1",$id);
                                                          $cnt33 = mysqli_num_rows($ni3);


                                                          ?>
                                                          <a onclick="verCuentasAuto('<?php echo $mue['nro_documento_autorizacion']; ?>','1',<?php echo $id ?>);" data-toggle="modal" 
                                                          data-target=".bs-example-modal-smCuentasAu"  style="cursor: pointer;text-decoration: underline;font-weight: bolder;" >
                                                          <?php echo $cnt33; ?></a>
                                                          
                                                          </td>
                                                      <td class=" " style="text-transform: uppercase;;text-align: center;"><?php echo date('d/m/Y',strtotime($mue["fecha_nacimiento"])); ?></td>
                                                      <td class=" " style="text-transform: uppercase;;text-align: center;"><?php 
                                                      
                                                        if($mue["sexo"]==1){
                                                          echo 'MASCULINO';
                                                        }else{
                                                          echo 'FEMENINO';
                                                        } ?></td>
                                                        <!--<td class=" " style="text-transform: uppercase;;text-align: center;">
                                                        32</td>-->
                                                      <!-- <td style="text-align: center;" > 
                                                       <a onclick="verRegistro(<?php echo $mue['idCar']; ?>);" data-toggle="modal" data-target=".bs-example-modal-smCartas" 
                                                        class="btEdit btn btn-info btn-xs" title="EDITAR"  ><i class="fa fa-edit"></i> </a>
                                                       <a onclick="verCuentasAuto('<?php echo $mue['nro_documento_autorizacion']; ?>');" data-toggle="modal" data-target=".bs-example-modal-smCuentasAu" 
                                                        class="btEdit btn btn-success btn-xs" title="CUENTAS"  ><i class="fa fa-bar-chart"></i> </a>
                                                     
                                                                    
                                                            <a onclick="EliminarRegisCarta(<?php echo $mue['idCar']; ?>);" class="btEdit btn btn-danger btn-xs" title="ELIMINAR" ><i class="fa fa-close"></i> </a>
                                          
                                                      </td>                -->
                                                      
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