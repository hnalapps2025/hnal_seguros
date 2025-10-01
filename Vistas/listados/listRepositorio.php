<?php 


include_once ($_SERVER['DOCUMENT_ROOT'].'/sis/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();
// 


?>

<script type="text/javascript">
                                
                                    $(document).ready(function() {

                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;


                                        var table = $('#pac3').DataTable( {
                                                    /*  "scrollY":"600px",
                                                    "scrollCollapse": true,*/
                                                  "bProcessing": true,
                                                    "sAjaxSource": "./Controlador/ajaxRepositorio.php?function=lisRepo",
                                                    "bPaginate":true,
                                                    "sPaginationType":"full_numbers",
                                                    "iDisplayLength": 25,
                                                    "order": [[  7, "desc" ]],
                                                    dom: '<fBtip>',
                                                    "columnDefs": [
                                                      { targets: [0,1,2,3,4,5,6,8], visible: true},
                                                      { targets: '_all', visible: false },
                                                      {
                                                           className: "dt-left",
                                                           "targets": [4,7,8]  
                                                      },
                                                      {
                                                           className: "dt-center",
                                                           "targets": [ 0,1,2,3,5,6]
                                                      }],
                                                    "aoColumns": [

                                                        { mData: 'nroCuenta' } ,
                                                        { mData: 'Historia' },
                                                        { mData: 'iafa' },
                                                        { mData: 'nroFua' },
                                                        { mData: 'paciente' },
                                                        { mData: 'F_Ingreso' },
                                                        { mData: 'F_Alta_Medica' },
                                                        { mData: 'F_Alta_Medic' },
                                                        { mData: 'servicio' },
                                                        { mData: 'usuario' },
                                                        { mData: 'auditor' },
                                                        { mData: 'observacion' }


                                                    ],  
                                                    buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'PacientesRegistrados'+ output,
                                                            exportOptions: {
                                                              columns: [0,1,2,3,4,5,6,8,9,10,11]
                                                            },
                                                            customize: function(xlsx) {
                                                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                                              $('row[r=2] c', sheet).attr('s', '47');
                                                          }
                                                        }
                                                        //
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
                                                      var column = this.api().column(2);
                                                      var select = $('<select class="form-control filter" style="text-transform: uppercase;"><option value="">Todos</option></select>')
                                                        .appendTo('#feconIafa')
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
                                                      
                                                    } 
                                                      // fin 1 filtro
                                                    
                                                  });
                                      
                                            $('#pac3_filter').addClass('form-group');
                                            $('#pac3_filter').css('text-align','left');
                                            $('#pac3_filter').css('display','none');
                                            $('#pac3_paginate').css('width','615px');
                                            $('.dt-buttons').css('float','right');
                                            $('.dt-buttons').css('margin-top','-57px');
                                            $('#pac3_filter label input').addClass('form-control');
                                            $('#pac3_length label select').addClass('form-control');
                                            

                                            var table = $('#pac3').DataTable();

                                            
                                            $('#bsux').on( 'keyup', function () {
                                                  table.search( this.value ).draw();
                                            });



                                            $("#minCie10").datepicker({
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

                                              $("#maxCie10").datepicker({
                                                "dateFormat": "yy-mm-dd",
                                                "onSelect": function(date) {
                                                  maxDateFilter = new Date(date).getTime();
                                                  console.log(maxDateFilter);
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
                                                    aData._date = new Date(aData[7]).getTime(); 
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

                                    } );

                                </script>
                                
                                
                                  <table class="table jambo_table bulk_action compact"  id="pac3" >
                                    <thead>
                                      <tr class="headings" style="font-size: 10px;">
                                    
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">N°CUENTA</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">N°_HISTORIA</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">IAFA</th>
                                        <th class="column-title"  style="text-transform: uppercase;text-align: center;">N°_FUA</th>
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">PACIENTE</th>
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">FECHA_INGRESO</th>
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">FECHA_ALTA_MEDICA</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">fecx</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">SERVICIO</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">USUARIO</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">AUDITOR</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">OBSERVACION</th>
                                        
                                         
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                        
                                    </tbody>
                                  </table>

                               