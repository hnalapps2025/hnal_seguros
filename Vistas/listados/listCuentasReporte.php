<?php 


include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");

$pac =new Pacientes();
$ni = $pac->cartasCuentasReporte();

?>

<script type="text/javascript">
                                
                
                                    $(document).ready(function() {

                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;


                                                $('#pac3LisX').DataTable( {
                                                  "searching": true,
                                                  "pageLength": 30,
                                                  "order": [[ 0, "desc" ]],
                                                  dom: '<fBtip>',
                                                  buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'Cuentas_Registradas_'+ output,
                                                            exportOptions: {
                                                              columns: [1, 2, 3,4,5,6,7,8,12]
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

                                                "deferRender": true,
                                                initComplete: function() {

                                                  // 1 filtro
                                                  var column = this.api().column(9);
                                                  var select = $('<select class="form-control filter"><option value="">Seleccionar</option></select>')
                                                    .appendTo('#selectTriggerFilter')
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

                                                  // fin 1 filtro
                                                  // 2 filtro
                                                  var column2 = this.api().column(10);
                                                  var select = $('<select class="form-control filter"><option value="">Seleccionar</option></select>')
                                                    .appendTo('#selectTriggerFilter2')
                                                    .on('change', function() {
                                                      var val = $(this).val();
                                                      column2.search(val).draw()
                                                    });

                                                  var offices = []; 
                                                  column2.data().toArray().forEach(function(s) {
                                                      s = s.split(',');
                                                      s.forEach(function(d) {
                                                        if (!~offices.indexOf(d)) {
                                                          offices.push(d)
                                                          select.append('<option value="' + d + '">' + d + '</option>');}
                                                      })
                                                  }) 

                                                // fin de 2 filtro
                                                    // 3 filtro
                                                    var column3 = this.api().column(11);
                                                    var select = $('<select class="form-control filter"><option value="">Seleccionar</option></select>')
                                                      .appendTo('#selectTriggerFilter3')
                                                      .on('change', function() {
                                                        var val = $(this).val();
                                                        column3.search(val).draw()
                                                      });

                                                    var offices = []; 
                                                    column3.data().toArray().forEach(function(s) {
                                                        s = s.split(',');
                                                        s.forEach(function(d) {
                                                          if (!~offices.indexOf(d)) {
                                                            offices.push(d)
                                                            select.append('<option value="' + d + '">' + d + '</option>');}
                                                        })
                                                    })

                                                    // fin 3 filtro


                                                }

                                            });
                                      
//

                                        $('#pac3LisX_filter').addClass('hidden');
                                        $('#pac3LisX_filter').css('text-align','left');
                                        $('.dt-buttons').css('float','left');
                                        $('.dt-buttons').css('margin-top','-56px');
                                        $('.dt-buttons').css('float','right');
                                        $('#pac3LisX_filter label input').addClass('form-control');
                                        $('#pac3LisX_length label select').addClass('form-control');
                                       

                                        $.fn.dataTable.ext.search.push(
                                            function (settings, data, dataIndex) {
                                                var min = $('#min').datepicker("getDate");
                                                var max = $('#max').datepicker("getDate");
                                                
                                                var startDate = new Date.parse(data[0]);
                                                
                                                
                                                if (min == null && max == null) { return true; }
                                                if (min == null && startDate <= max) { return true;}
                                                if(max == null && startDate >= min) {return true;}
                                                if (startDate <= max && startDate >= min) { return true; }
                                                return false;
                                                
                                                }
                                            );                                
                                            $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
                                            $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
                                            var table = $('#pac3LisX').DataTable();

                                            $('#min, #max').change(function () {
                                                   table.draw();
                                            });

                                    } );

                                  

                                </script>

                                  <table class="table jambo_table bulk_action"  id="pac3LisX" >
                                    <thead>
                                      <tr class="headings" style="font-size: 10px;">
                                        <th class="hidden" style="width:5%;text-transform: uppercase;text-align: center;">#</th>
                                        <th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;">NRO CUENTA</th>
                                        <th class="column-title" style="width:12%;text-transform: uppercase;text-align: center;">NRO AUTORIZACION</th>
                                        <th class="" style="width:5%;text-transform: uppercase;text-align: center;">FECHA INICIO </th>
                                        <th class="" style="width:5%;text-transform: uppercase;text-align: center;">FECHA FIN</th>
                                        <th class="" style="width:17%;text-transform: uppercase;text-align: center;">PACIENTE</th>
                                        <th class="" style="width:5%;text-transform: uppercase;text-align: center;">DNI</th>  
                                        <th class="" style="width:8%;text-transform: uppercase;text-align: center;">FECHA CITA</th>
                                        <th class="hidden" style="width:15%;text-transform: uppercase;text-align: center;">CONSULTORIO</th>
                                        <th class="" style="width:5%;text-transform: uppercase;text-align: center;">ATENDIDO</th> 
                                        <th class="hidden" style="width:5%;text-transform: uppercase;text-align: center;">MES</th>
                                        <th class="" style="width:5%;text-transform: uppercase;text-align: center;">AÑO</th>
                                        <th class="" style="width:5%;text-transform: uppercase;text-align: center;">INTERCONSULTA</th>                                          
                                      </tr>
                                    </thead>
                                  
                                    <tbody>
                                         <?php                                               
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>

                                                    <tr class="even pointer">
                                                        <td class="hidden" style="text-transform: uppercase;text-align: center;"><?php echo $mue["fatencion"]; ?></td>
                                                        <td class=" " style="text-transform: uppercase;text-align: left;"><?php echo $mue["nrocuenta"]; ?></td>
                                                        <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo $mue["NroCarta"].$mue["NroCarta2"].$mue["NroCarta3"]; ?></td>
                                                        <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo date('d/m/Y',strtotime($mue["Fecha_Inicio_Vigencia"])); ?></td>
                                                        <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo date('d/m/Y',strtotime($mue["Fecha_Fin_Vigencia"])); ?></td>
                                                        <td class=" " style="text-transform: uppercase;text-align: left;"><?php echo $mue["Paciente"]; ?></td>
                                                        <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo $mue["nrodoc"]; ?></td>
                                                        <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo date('d/m/Y',strtotime($mue["fatencion"])); ?></td>
                                                        <td class="hidden" style="text-transform: uppercase;text-align: left;"><?php echo $mue["consultorio"]; ?></td>
                                                        <td class=" " style="text-transform: uppercase;;text-align: center;"><?php
                                                                if($mue["estado"]=="on"){
                                                                  echo 'SI';
                                                                }else{
                                                                  echo 'NO';
                                                                }
                                                          ?></td>
                                                          <td class="hidden">
                                                                <?php $mes = date("m", strtotime($mue["fatencion"])); 
                                                                
                                                                      switch($mes){
                                                                          case 1: echo "Enero"; break;
                                                                          case 2: echo "Febrero"; break;
                                                                          case 3: echo "Marzo"; break;
                                                                          case 4: echo "Abril"; break;
                                                                          case 5: echo "Mayo"; break;
                                                                          case 6: echo "Junio"; break;
                                                                          case 7: echo "Julio"; break;
                                                                          case 8: echo "Agosto"; break;
                                                                          case 9: echo "Septiembre"; break;
                                                                          case 10: echo "Octubre"; break;
                                                                          case 11: echo "Noviembre"; break;
                                                                          case 12: echo "Diciembre"; break;
                                                                      }
                                                                
                                                                ?>
                                                                
                                                          </td>
                                                          <td class="" style="text-align:center;">
                                                                <?php $anio = date("Y", strtotime($mue["fatencion"])); echo $anio;?>
                                                          </td>
                                                          <td class="" style="text-align:center;">
                                                                <?php if($mue["interconsulta"]=="on"){ echo "INTERCONSULTA"; }else{ echo "";}?>
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