<?php 

include_once ('config.php');
include (MODEL_PATH."ModelProcedmientos.php");
include (MODEL_PATH."global.php");


$sel = new ModelProcedmientos();
$id = $_GET["id"];
$tipo = $_GET["tipo"];

$ni = $sel->consultaExamenPersona($id);


?>


<script type="text/javascript">
                    
                    
                     function ordenarSelect(id_componente)
                        {
                          var selectToSort = jQuery('#' + id_componente);
                          var optionActual = selectToSort.val();
                          selectToSort.html(selectToSort.children('option').sort(function (a, b) {
                            return a.text === b.text ? 0 : a.text < b.text ? -1 : 1;
                          })).val(optionActual);
                          
                        }
                    
                    
                          $(document).ready(function() {
                              
                               var tik = getParameterByName('id');
                                    $('#guardarEnCaja').click(function(){
                  
                                          var selected = '';
                                          var caja =$("#refeCaja").val();
                                          var iduserEx =$("#iduserEx").val();
                                            var today = new Date();
                                            var date = today.toISOString().slice(0,10);
                                            var time = today.getHours() + ':' + today.getMinutes() + ':' + today.getSeconds();
                                            var dateTime = date + ' ' + time;
                                          
                                    
                                          if(caja==""){
                                              alert("Debes seleccionar una caja");
                                          }else{
                                    
                                                $('#formidCax input[type=checkbox]').each(function(){
                                                  if (this.checked) {
                                                      selected = $(this).val();
                                    
                                                          $.ajax({
                                                            type: "POST",
                                                            dataType: 'html',
                                                            url: "./Controlador/controllerProcedimientos.php?function=regMasivoCAja",
                                                            data:{ caja:caja,id:selected,user:iduserEx,fechaHoraAsigCaja:dateTime}
                                                        }).done(function(datos){               
                                                             CargarListadoCajas(0,tik);
                                                             $('#pac3grupoArchivo').DataTable().ajax.reload(null, false);
                                                         
                                                            
                                                        });
                                                  }
                                              });
                                              
                                          }   
                                          
                                          //alert("Asignacion correcta");
                                          $.NotificationService.showInfoNotification({
                                                      title:"Mensaje",
                                                      message:"Asignacion correcta"
                                          });
                                          
                                     });
                                      
                                      
                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;
                                              
                                        
                               
                                var to = getParameterByName('tipo');


                                var table = $('#tabCajas').DataTable( {
                                                  "bProcessing": true,
                                                  "sAjaxSource": "./Controlador/search.php?function=listadoCajasModPaquetes&tipo="+<?php echo $tipo ?>,
                                                  "bPaginate":true,
                                                  "sPaginationType":"full_numbers",
                                                  "iDisplayLength":10,
                                                  "order": [0, "desc" ],
                                                  "columnDefs": [
                                                    { targets: [0,1,2,3,4], visible: true},
                                                    { targets: '_all', visible: false 
                                                    
                                                    },{
                                                      className: "dt-left",
                                                      "targets": [3] 
                                                  },{
                                                    className: "dt-right",
                                                    "targets": [] 
                                                  },
                                            //
                                                  {
                                                      className: "dt-center",
                                                      "targets": [0,1,2,4]
                                                  }],
                                                  "aoColumns": [
                                                      
                                                        { mData: 'chk' },
                                                        { mData: 'id' },
                                                        { mData: 'usuario' },
                                                        { mData: 'referencia'},
                                                        { mData: 'opciones' },
                                                       
                                                        
                                                  ],

                                                  dom: '<fBtip>',
                                                  buttons: [
                                                      /*  {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'PacientesRegistrados'+ output,
                                                            exportOptions: {
                                                              columns: [1,3,4,5,6,7,8,10,12,13,14,15,18,19]
                                                            },
                                                            customize: function(xlsx) {
                                                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                                              $('row[r=2] c', sheet).attr('s', '47');
                                                            }
                                                          
                                                        } */
                                                        
                                                  ],          // 

                                                  language: {
                                                        "decimal": "",
                                                        "searchPlaceholder": "Buscar ..",
                                                        "emptyTable": "No hay registros para mostrar",
                                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Cajas",
                                                        "infoEmpty": "Mostrando 0 a 0 de 0 Cajas",
                                                        "infoFiltered": "(Filtrado de _MAX_ total Cajas)",
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
                                                   
                                                    
                                                  });
                                      

                                  

                                        $('#tabCajas_filter').addClass('form-group');
                                        $('#tabCajas_filter').css('text-align','left');
                                        //$('#tabCajas_filter').css('float','left');
                                        $('#tabCajas_filter').css('display','none');
                                        $('.dt-buttons').css('float','right');
                                        $('#tabCajas_paginate').css('width','100%');
                                       
                                       // $('.dt-buttons').css('display','none');
                                        $('.dt-buttons').css('margin-top','-53px');
                                        $('#tabCajas_filter label input').addClass('form-control');
                                        $('#tabCajas_length label select').addClass('form-control');

                                        $('#serc').on( 'keyup', function () {
                                            table.search( this.value ).draw();
                                        } );


                                             
                                              minDateFilter = "";
                                              maxDateFilter = "";

                                        
                                       
                                    } );


                                   // var table = $('#tabCajas').DataTable();

                                                                                  
                                      

                                </script>


                <!--<div class="modal-header" style="color:black;text-transform: uppercase;text-align: center;">                                   
                                        <h4 class="modal-title" id="">TRANSFERENCIA</h4>
                                </div>-->
                    <form id="formidCax" action="#" method="post">
                            <table class="table bulk_action" id="tabCajas" >
                                    <thead>
                                      <tr class="headings" style="background-image: linear-gradient(#43a2ca, #0c76a2);;color:white">
                                        <th class="column-title" style="width:1%;text-transform: uppercase;text-align: center;">#</th>
                                        <th class="column-title" style="width:1%;text-transform: uppercase;text-align: center;">PAQUETE</th>
                                        <th class="column-title" style="width:2%;text-transform: uppercase;text-align: center;">USUARIO</th>
                                        <th class="column-title" style="width:55%;text-transform: uppercase;text-align: center;">OBSERVACION</th>
                                        <th class="column-title" style="text-align: center;width:1%;text-transform: uppercase;">FECHA</th>
                                       
                                      </tr>
                                    </thead>
                            </table>
                    </form>
 