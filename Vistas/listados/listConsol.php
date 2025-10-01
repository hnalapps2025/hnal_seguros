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
                                     

                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;


                                                $('#pac3').DataTable( {
                                                  "bProcessing": true,
                                                  "sAjaxSource": "./Controlador/search.php?function=listConCpms",
                                                  "bPaginate":true,
                                                  "sPaginationType":"full_numbers",
                                                  "iDisplayLength":10,
                                                  "order": [0, "desc" ],
                                                  "columnDefs": [
                                                    { targets: [0,1,3,4,5,6,7,8,10,12], visible: true},
                                                    { targets: '_all', visible: false 
                                                    
                                                    },{
                                                      className: "dt-left",
                                                      "targets": [5,6] 
                                                  },{
                                                    className: "dt-right",
                                                    "targets": [] 
                                                  },
                                            //
                                                  {
                                                      className: "dt-center",
                                                      "targets": [0,1,2,3,4,7,8,9,10,11,12]
                                                  }],
                                                  "aoColumns": [


                                                        { mData: 'te' },
                                                        { mData: 'auditor' },
                                                        { mData: 'tu'},
                                                        { mData: 'nroFua' },
                                                        { mData: 'nroCuenta' },
                                                        { mData: 'paciente' },
                                                        { mData: 'servicio' },
                                                        { mData: 'F_Ingreso' },
                                                        { mData: 'F_Alta_Medica' },
                                                        { mData: 'F_Alta_Medica2' },
                                                        { mData: 'Historia' },
                                                        { mData: 'GESTION' },
                                                        { mData: 'opciones' },
                                                       
                                                        
                                                  ],

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
                                        $('.dt-buttons').css('margin-top','-54px');
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
                                
                                
                                  <table class="table jambo_table bulk_action compact"  id="pac3" >
                                    <thead>
                                      <tr class="headings" style="font-size: 10px;">
                                        <th class="column-title"  style="text-transform: uppercase;text-align: center;">#</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">AUDITOR</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">ESTADO</th>
                                        <th class="column-title"  style="width: 160px;text-transform: uppercase;text-align: center;">FUA</th>
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">CUENTA</th>
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">PACIENTE</th>
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">SERVICIO</th>
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">INGRESO</th>
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">ALTA_MEDICA</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">F_Alta_Medica2</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">Historia</th>                           
                                        <th class="" style="text-transform: uppercase;text-align: center;">USUARIO_GESTION</th>                           
                                        <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;">OPCIONES</th>
                                         
                                      </tr>
                                    </thead>
                                  
                                  </table>

                                  