<?php 

require 'Modelo/funciones.php';
require 'Modelo/global.php';


$sel =new Model();



$ext = $_GET["pte"];
$rest = substr($ext, -2);



$ni = $sel->consultaUpss();
   
   

?>

<script type="text/javascript">
                                    
                                  
                                    $(document).ready(function() {

                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;

                                                  $('#pacUpss').DataTable( {
                                                    "searching": true,
                                                    "pageLength": 8,
                                                    "order": [[ 0, "desc" ]],
                                                     "bPaginate": true,
                                                     dom: '<fBtip>',
                                                      buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR',
                                                            title: 'REGISTROS-UPSS'+ output,
                                                            exportOptions: {
                                                              columns: [0, 1, 2, 3]
                                                            }
                                                        }
                                                        /*{
                                                            extend: 'pdf',
                                                            title: 'PACIENTESREGISTRADOS'+ output,
                                                            orientation:'landscape',
                                                        }*/
                                                      //'copyHtml5',
                                                      //'excelHtml5'
                                                      
                                                      //'csvHtml5',
                                                      //'pdfHtml5'
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


                                         // $('#pacUpss_filter').addClass('hidden');  
                                          $('#pacUpss_filter label input').addClass('form-control');
                                          $('#pacUpss_length label select').addClass('form-control');
                                        
                                        } );

                                  $(document).ready(function(){
                                        $.fn.dataTable.ext.search.push(
                                        function (settings, data, dataIndex) {
                                            var min = $('#minUpss').datepicker("getDate");
                                            var max = $('#maxUpss').datepicker("getDate");
                                            var startDate = new Date(data[4]);
                                            if (min == null && max == null) { return true; }
                                            if (min == null && startDate <= max) { return true;}
                                            if(max == null && startDate >= min) {return true;}
                                            if (startDate <= max && startDate >= min) { return true; }
                                            return false;
                                        }
                                        );                                
                                            $("#minUpss").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
                                            $("#maxUpss").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
                                            var table = $('#pacUpss').DataTable();

                                            $('#minUpss, #maxUpss').change(function () {
                                              //nuevo cambio
                                                   table.draw();
                                            });
                                        });

                                </script>
                                
                                 
                          <table class="table jambo_table bulk_action"  id="pacUpss" >
                                    <thead>
                                      <tr class="headings" style="font-size:13px;">
                                        <th class="column-title" style="text-transform: uppercase;width:50%;">UPSS</th>
                                        <th class="column-title" style="width:30%;text-transform: uppercase;">DESCRIPCION</th>
                                        <th class="column-title" style="width:10%;text-transform: uppercase;text-align: center;">CIE10</th>
                                        <th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;">N°</th>
                                        <th class="hidden" >FECHA</th>                                      
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php  
                            
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>
                                                    <tr class="even pointer">                                                    
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;"><?php echo $mue["upss"]; ?></td>         
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;"><?php echo $mue["Diagnostico"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;"><?php echo $mue["Cie10"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;"><?php echo "1";//$mue["NRO"]; ?></td>
                                                     
                                                      <td class="hidden" ><?php echo $mue["niceDate"]; ?></td>
                                                      
                                                    </tr>
                                         <?php }
                                                  
                                                  
                                                     ?>
                                    </tbody>
                                  </table>
<br><br><br>
                                  <!-- <style>
                                  .dataTables_length{
                                    display:none;
                                  }
                                  .dataTables_filter {
                                      float: left !important;
                                  }
                                  .dataTables_filter label {
                                      float: left !important;
                                  }

                                  </style> -->