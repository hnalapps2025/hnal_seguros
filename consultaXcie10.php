<?php 

require 'Modelo/funciones.php';
require 'Modelo/global.php';


$sel =new Model();



$ext = $_GET["pte"];
$rest = substr($ext, -2);



$ni = $sel->consultaCie10();
   
   

?>

<script type="text/javascript">
                                    
                                  
                                    $(document).ready(function() {
                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;
                                                                            
                                              $('#pacCie10').DataTable( {
                                                    "searching": true,
                                                    //"oSearch": {"sSearch": "91214268" },
                                                    "pageLength":8,
                                                    "order": [[ 0, "desc" ]],
                                                     "bPaginate": true,
                                                     dom: '<fBtip>',
                                                      buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR',
                                                            title: 'REGISTROS-CIE10'+ output,
                                                            exportOptions: {
                                                              columns: [0, 1, 2]
                                                            },
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


                                         // $('#pacCie10_filter').addClass('hidden');
                                         // $('.dataTables_info').addClass('hidden');
                                         // $('.dataTables_paginate').addClass('hidden');
                                          $('#pacCie10_filter label input').addClass('form-control');
                                          $('#pacCie10_length label select').addClass('form-control');
                                        
                                        } );

                                  $(document).ready(function(){
                                        $.fn.dataTable.ext.search.push(
                                        function (settings, data, dataIndex) {
                                            var min = $('#minCie10').datepicker("getDate");
                                            var max = $('#maxCie10').datepicker("getDate");
                                            var startDate = new Date(data[3]);
                                            if (min == null && max == null) { return true; }
                                            if (min == null && startDate <= max) { return true;}
                                            if(max == null && startDate >= min) {return true;}
                                            if (startDate <= max && startDate >= min) { return true; }
                                            return false;
                                        }
                                        );                                
                                            $("#minCie10").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
                                            $("#maxCie10").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
                                            var table = $('#pacCie10').DataTable();

                                            $('#minCie10, #maxCie10').change(function () {
                                              //nuevo cambio
                                                   table.draw();
                                            });
                                        });

                                </script>
                                
                                 
                          <table class="table jambo_table bulk_action"  id="pacCie10" >
                                    <thead>
                                      <tr class="headings" style="font-size:13px;">
                                      <th class="column-title" style="width:10%;text-transform: uppercase;text-align: center;">CIE10</th>
                                        <th class="column-title" style="width:40%;text-transform: uppercase;">DESCRIPCION</th>
                                        <th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;">N°</th>
                                        <th class="hidden" >FECHA</th>                                      
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php  
                            
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>
                                                    <tr class="even pointer">                                                           
                                                    <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;"><?php echo $mue["Cie10"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;"><?php echo $mue["Diagnostico"]; ?></td>
                                                      
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;"><?php echo "1";//$mue["NRO"];  ?></td>
                                                      
                                                      <td class="hidden" ><?php echo $mue["niceDate"]; ?></td>
                                                      
                                                    </tr>
                                         <?php }
                                                  
                                                  
                                                     ?>
                                    </tbody>
                                  </table>

                                  <style>
                                  .dataTables_length{
                                    display:none;
                                  }
                                  .dataTables_filter {
                                      float: left !important;
                                  }
                                  .dataTables_filter label {
                                      float: left !important;
                                  }

                                  </style>