<?php 


include_once ($_SERVER['DOCUMENT_ROOT'].'/sis/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();


$ext = $_GET["pte"];
$rest = substr($ext, -2);


$ni = $pac->consultaPacients();


?>

<script type="text/javascript">
                                
                                    $(document).ready(function() {

                                      $(".filter").remove();
                                      /*var opt = $("#fecon option").sort(function (a,b) { return a.value.toUpperCase().localeCompare(b.value.toUpperCase()) });
                                      $("#fecon").append(opt);
                                      $("#fecon").find('option:first').attr('selected','selected');
                                      
                                      */

                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;


                                                $('#pac3').DataTable( {
                                                  "searching": true,
                                                  "pageLength": 15,
                                                  "order": [0, "desc" ],
                                                  dom: '<fBtip>',
                                                  buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'PacientesRegistrados'+ output,
                                                            exportOptions: {
                                                              columns: [1,3,4,5,6,7,8,10]
                                                            },
                                                            customize: function(xlsx) {
                                                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                                              $('row[r=2] c', sheet).attr('s', '47');
                                                          }
                                                        }
                                                        
                                                  ],          // 

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

                                                    "deferRender": true,
                                                    initComplete: function() {

                                                      // 1 filtro
                                                      var column2 = this.api().column(1);
                                                      var select2 = $('<select class="form-control filter" style="text-transform: uppercase;"><option value="">Todos</option></select>')
                                                        .appendTo('#fecon')
                                                        .on('change', function() {
                                                          var val = $(this).val();
                                                          column2.search(val).draw()
                                                        });

                                                      var offices= []; 
                                                      column2.data().toArray().forEach(function(s) {
                                                          s = s.split(',');
                                                          s.forEach(function(d) {
                                                            if (!~offices.indexOf(d)) {
                                                              offices.push(d)
                                                              select2.append('<option value="' + d + '">' + d + '</option>');}
                                                          })
                                                      })
                                                      



                                                      // 1 filtro
                                                      var column = this.api().column(2);
                                                      var select = $('<select class="form-control filter" style="text-transform: uppercase;"><option value="">Todos</option></select>')
                                                        .appendTo('#feces')
                                                        .on('change', function() {
                                                          var val = $(this).val();
                                                          column.search(val).draw()
                                                        });

                                                      var offices = []; 
                                                      column.data().toArray().forEach(function(s) {
                                                          s = s.split(',');
                                                          s.forEach(function(d) {
                                                            if (!~offices.indexOf(d)) {
                                                              offices.push(d)
                                                              select.append('<option value="' + d + '">' + d + '</option>');}
                                                          })
                                                      })

                                                      //fin filtro

                                                    } 
                                                      // fin 1 filtro
                                                    
                                                  });
                                      

                                  

                                        $('#pac3_filter').addClass('form-group');
                                        $('#pac3_filter').css('text-align','left');
                                        $('#pac3_filter').css('display','none');
                                       $('.dt-buttons').css('float','right');
                                       // $('.dt-buttons').css('display','none');
                                        $('.dt-buttons').css('margin-top','-57px');
                                        $('#pac3_filter label input').addClass('form-control');
                                        $('#pac3_length label select').addClass('form-control');
                                       
                                    } );


                                    var table = $('#pac3').DataTable();

                                                                                  
                                      $('#serc').on( 'keyup', function () {
                                            table.search( this.value ).draw();
                                        } );


                                        $("#minCie109").datepicker({
                                                "dateFormat": "yy-mm-dd",
                                                "onSelect": function(date) {  
                                                  minDateFilter = new Date(date).getTime();
                                                  console.log(minDateFilter);
                                                  table.draw(); // Redraw the table with the filtered data.
                                                }
                                              }).keyup(function() {
                                                minDateFilter = new Date(this.value).getTime();
                                                table.draw();
                                              });

                                           $("#maxCie109").datepicker({
                                                "dateFormat": "yy-mm-dd",
                                                "onSelect": function(date) {
                                                  maxDateFilter = new Date(date).getTime();
                                                  table.draw();
                                                }
                                              }).keyup(function() {
                                                maxDateFilter = new Date(this.value).getTime();
                                                table.draw();
                                              });

                                             
                                              minDateFilter = "";
                                              maxDateFilter = "";

                                              $.fn.dataTableExt.afnFiltering.push(
                                                function(oSettings, aData, iDataIndex) {
                                                  if (typeof aData._date == 'undefined') {
                                                    aData._date = new Date(aData[9]).getTime(); 
                                                  }

                                                  if (minDateFilter && !isNaN(minDateFilter)) {
                                                    if (aData._date < minDateFilter) {
                                                      return false;
                                                    }
                                                  }

                                                  if (maxDateFilter && !isNaN(maxDateFilter)) {
                                                    if (aData._date > maxDateFilter) {
                                                      return false;
                                                    }
                                                  }

                                                  return true;
                                                }
                                              );

                                </script>
                                
                                
                                  <table class="table jambo_table bulk_action"  id="pac3" >
                                    <thead>
                                      <tr class="headings" style="font-size: 10px;">
                                        <th class="column-title"  style="text-transform: uppercase;text-align: center;">#</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">AUDITOR</th>
                                        <th class="hidden" style="text-transform: uppercase;text-align: center;">ESTADO</th>
                                        <th class="column-title"  style="width: 160px;text-transform: uppercase;text-align: center;">N°_FUA.</th>
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">CUENTA</th>
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">paciente</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">servicio</th>
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">F_Ingreso</th>
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">F_Alta_Medica</th>
                                        <th class="hidden" style="text-transform: uppercase;text-align: center;">F_Alta_Medica2</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">Historia</th>
                                        <!--<th class="" style="text-transform: uppercase;text-align: center;">DNI</th>-->
                              
                                        <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;">OPCIONES</th>
                                         
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php  
                                             
                                               while($mue = $ni->fetch_assoc()){   
                                                
                                                //if($iduser == $mue["idaudi"] ){
                                                    $tu="";
                                                 ?>
                                                 
                                                 <tr class="even pointer">
                                                      <td class="" style="text-transform: uppercase;text-align: center;">
                                                      <?php 
                                                            if($mue["estado"]=="GENERADO"){
                                                                  echo '<a class="btEdit btn btn-warning btn-xs" style="color:#f0ad4e;"> D</a>';
                                                                  $tu="PENDIENTE";
                                                            }
                                                            else if($mue["estado"]=="PENDIENTE"){
                                                              echo '<a class="btEdit btn btn-warning btn-xs" style="color:#f0ad4e;"> D</a>';
                                                              $tu="PENDIENTE";
                                                            }
                                                            else if($mue["estado"]=="ENVIADO"){
                                                              echo '<a class="btEdit btn btn-success btn-xs" style="color:#26b99a;"> D</a>';
                                                              $tu="ENVIADO";
                                                            }
                                                      ?> 
                                                      </td>
                                                      <td class=" " style="text-transform: uppercase;text-align: left;width: 280px;"><?php 
                                                           $niAu = $pac->asignarAuditor($mue["F_Alta_Medica"]);
                                                            while($mueAu = $niAu->fetch_assoc()){
                                                                  if($mueAu["respuesta"]=="si"){
                                                                    echo $mueAu["auditor"]." - "; 
                                                                }
                                                            };
                                                          //  echo $mue["AUDITOR"];
                                                            
                                                       ?></td>
                                                      <td class="hidden" style="text-transform: uppercase;text-align: left;"><?php echo $tu ; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo $mue["nroFua"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo $mue["nroCuenta"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: left;"><?php echo $mue["paciente"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: left;"><?php echo $mue["servicio"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo  date('d/m/Y',strtotime($mue["F_Ingreso"])); ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo  date('d/m/Y',strtotime($mue["F_Alta_Medica"])); ?></td>
                                                      <td class="hidden" style="text-transform: uppercase;text-align: center;"><?php echo  $mue["F_Alta_Medica"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo $mue["Historia"]; ?></td>
                                                      <!--<td class=" " style="text-transform: uppercase;text-align: center;"><?php echo $mue["DNI"]; ?></td>-->
                                                     
                                                      <td style="text-align: center;" > 
                                                           <div class="btn-group" style="margin-bottom: 5px;">
                                                                          <button data-toggle="dropdown" class="btn btn-info dropdown-toggle btn-xs" type="button" aria-expanded="false"> Opciones<span class="caret"></span>
                                                                                        </button>
                                                                  <ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
                                                                      <?php if( $_SESSION['rol']==3 ||  $_SESSION['rol']== 4 ){?>
                                                                     <!-- <li>
                                                                            <a onclick="asignarAudix(<?php echo $mue['idPac']; ?>)" data-toggle="modal" data-target=".bs-example-modal-smResponsableAuditor" ><i class="fa fa-user"></i> Asignar Auditor</a> 
                                                                      </li>-->
                                                                        <?php } ?>

                                                                        <?php if( $_SESSION['rol']== 3 ||  $_SESSION['rol']== 4 ||  $_SESSION['rol'] == 2 ){ // && $iduser == $mue["idaudi"] ){?>
                                                                      <li>
                                                                          <a href="ImportarCuenta.php?id=<?php echo $mue["idPac"]; ?>" ><i class="fa fa-edit"></i> Procesar</a>
                                                                      </li>
                                                                      <?php } ?>
                                                                      <?php if( $_SESSION['rol']==3 ||  $_SESSION['rol']== 4  ){?>
                                                                      <li> 
                                                                      <a onclick="asignarTecx(<?php echo $mue['idPac']; ?>)" data-toggle="modal" data-target=".bs-example-modal-smTecnico" ><i class="fa fa-laptop"></i> Asignar Digitador</a> 
                                                                      </li>
                                                                      <?php } ?>
                                                                  </ul>
                                                        </div>


                                                       </td> 
                                                 </tr>
                                         <?php    
                                         }  ?>
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