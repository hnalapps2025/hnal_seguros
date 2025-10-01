 <?php 


//error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Debes iniciar sesión para continuar.'); window.location='index.php';</script>";  
  exit;
} 

include_once ('./../config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");

include 'Vistas/librerias.php';  

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


                                var table = $('#pac3Emer').DataTable( {
                                                  "bProcessing": true,
                                                  "sAjaxSource": "./Controlador/search.php?function=listHospi",
                                                  "bPaginate":true,
                                                  "sPaginationType":"full_numbers",
                                                  "iDisplayLength":10,
                                                  "order": [0, "desc" ],
                                                  "columnDefs": [
                                                    { targets: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24], visible: true},
                                                    { targets: '_all', visible: false 
                                                    
                                                    },{
                                                      className: "dt-left",
                                                      "targets": [] 
                                                  },{
                                                    className: "dt-right",
                                                    "targets": [] 
                                                  },
                                            //
                                                  {
                                                      className: "dt-center",
                                                      "targets": [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]
                                                  }],
                                                  "aoColumns": [

                                                        { mData: 'opciones' },
                                                        { mData: 'idUserRegistro' },
                                                        { mData: 'nroFua'},
                                                        { mData: 'historiaClinica' },
                                                        { mData: 'nroDoc' },
                                                        { mData: 'seguro' },
                                                        { mData: 'aseguradora' },
                                                        { mData: 'ubicacion' },
                                                        { mData: 'sexo' },
                                                        { mData: 'cuenta' },
                                                        { mData: 'nroAfiliacion' },
                                                        { mData: 'eess' },
                                                        { mData: 'paciente' },
                                                        { mData: 'teleFam' },
                                                        { mData: 'edad' },
                                                        { mData: 'destino' },
                                                        { mData: 'fechaDestino'},            
                                                        { mData: 'servicioPabellon'},    
                                                        { mData: 'fechaIngreso'},
                                                        { mData: 'fechaAlta' },
                                                        { mData: 'montoGalenos' },
                                                        { mData: 'montoSisfar' },
                                                        { mData: 'Observaciones' },
                                                        { mData: 'fechaRegistro' },
                                                        { mData: 'fechaUpdate' }
                                                        
                                                  ],

                                                  dom: '<fBtip>',
                                                  buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'PacientesRegistrados'+ output,
                                                            exportOptions: {
                                                              columns: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]
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

                                                    },
                                                    
                                                      scrollY: "450px",
                                                      scrollX: true,
                                                      // fin 1 filtro
                                                    
                                                  });
                                      

                                  

                                        $('#pac3Emer_filter').addClass('form-group');
                                        $('#pac3Emer_filter').css('text-align','left');
                                        $('#pac3Emer_filter').css('display','none');
                                       $('.dt-buttons').css('float','right');
                                       // $('.dt-buttons').css('display','none');
                                        $('.dt-buttons').css('margin-top','-54px');
                                        $('#pac3Emer_filter label input').addClass('form-control');
                                        $('#pac3Emer_length label select').addClass('form-control');

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
                                            
                                       
                                    });


                                   // var table = $('#pac3').DataTable();

                                                                                  
                                      

                                </script>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
      
        <?php include 'Vistas/menu.php';  ?>
        <!-- top navigation -->
        <div class="top_nav">
            <?php include 'Vistas/usuario.php';  ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
      
                  <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2 style="text-transform: uppercase;">PACIENTES EN HOSPITALIZACION <small></small></h2>
                                <!--<button type="button" class="btn btn-success btn-xs">Enviado</button>
                                              <button type="button" class="btn btn-warning btn-xs">Pendiente</button>-->
                               <!-- <a class="btn btn-success"  href="imporConsol.php"  style="float: right;"><i class="fa fa-file-excel-o"></i> Importar</a>-->
                              
                                <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-smEmergencia" id="agr2" role="button" aria-expanded="false" 
                                style="float: right;" onclick="LimpiarFormHospi();"><i class="fa fa-edit m-right-xs"></i> Nuevo Registro</a>
                                  <!--<a href="especial.php" class="btn btn-success"  id="agr2" role="button" style="float: right;" "><i class="fa fa-edit m-right-xs"></i> Importar</a>-->
                              
                                
                                <!--<a href="#" class="dropdown-toggle" data-toggle="modal" data-target=".bs-example-modal-sm" id="agr2" role="button" aria-expanded="false"><i class="fa fa-arrows"></i></a>-->
                                <!--<a href="registrosexcel.php" style="float: right;"><img style="width:30px;" src="<?php echo $path ?>images/excel.png">&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;</a>
                                <a style="float: right;">Exportar a:&nbsp;&nbsp; </a> -->
                                <div class="clearfix"></div>
                              </div>
                              

                              <div class="x_content">
                             
                              <table border="0"  >
                                  <tbody>
                                  
                                      <tr>
                                          <td><label>Buscar:</label></td>
                                          <td><input name="min" id="serc" type="text" class="form-control" placeholder="Columnas" autocomplete="off"></td>
                                         <!-- <td><label style="margin-left:25px;margin-right: 5px;">Usuario:</label></td>
                                          <td><p id="fecon" style="margin: 0 0 -2px;"></p></td>
                                          <td><label style="margin-left:25px;margin-right: 5px;">Estado:</label></td>
                                          <td><p id="feces" style="margin: 0 0 -2px;"></p></td>
                                          <td ><label style="margin-left: 14px;">Desde:&nbsp;&nbsp;</label></td>
                                          <td ><input name="minCie109" id="minCie109" style="width: 115px;" type="text" class="form-control" placeholder="Fecha Inicio" autocomplete="off" ></td>
                                          <td><label>&nbsp;&nbsp;Hasta:&nbsp;&nbsp;</label></td>
                                          <td ><input name="maxCie109" id="maxCie109" type="text" style="width: 115px;" class="form-control" placeholder="Fecha final" autocomplete="off" ></td>                                          
                                          <td>&nbsp;
                                              
                                          </td>-->
                                          
                                      </tr>
                                  </tbody>
                              </table> <br>
                             
                                        <div class="alert alert-success alert-dismissible fade in hidden" role="alert" id="alerify">
                                              <button type="button" class="close" ><span aria-hidden="true" id="closealert">×</span>
                                              </button>
                                              <strong id="pacte"></strong>
                                          </div>
                                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridEmerge"> 
                                            <table class="table jambo_table bulk_action compact"  id="pac3Emer" >
                                                <thead>
                                
                                                  <tr class="headings" style="font-size: 10px;">
                                                         <th class="" style="text-transform: uppercase;text-align: center;">OPCIONES</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">USUARIO</th>
                                                     <th class="" style="text-transform: uppercase;text-align: center;">_____NRO_FUA_____</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">HISTORIA</th>
                                                    <th class="column-title"  style="width: 160px;text-transform: uppercase;text-align: center;">DOC</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">______SEGURO______</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">______ASEGURADORA______</th>
                                                     <th class="column-title" style="text-transform: uppercase;text-align: center;">UBICACION</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">SEXO</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">CUENTA</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">AFILIACION</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">ESTABLECIMIENTO_DE_SALUD</th>                           
                                                    <th class="" style="text-transform: uppercase;text-align: center;">_____APELLIDOS_Y_NOMBRES_PACIENTE_____</th>         
                                                     <th class="" style="text-transform: uppercase;text-align: center;">FAMILIAR</th>
                                                       <th class="" style="text-transform: uppercase;text-align: center;">____EDAD____</th>
                                                       <th class="column-title"  style="width: 160px;text-transform: uppercase;text-align: center;">_______DESTINO_______</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">ALTA/REF/CONTRA</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">_________PABELLON_________</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">FECHA_INGRESO</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">FECHA_ALTA</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">MONTO_GALENOS</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">MONTO_SISFAR</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">_______OBSERVACIONES_______</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">___REGISTRO___</th>
                                                     <th class="" style="text-transform: uppercase;text-align: center;">ACTUALIZACION</th>
                                                
                                                  </tr>
                                                </thead>
                                              
                                              </table>
                                            
                                            </div><br><br>
                                            <div class="row hidden">
                                                  <div class="col-sm-2">   
                                                      <a href="ExportarGeneral.php" class="btn btn-success" ><i class="fa fa-download"></i> Exportar EXCEL</a>                                         
                                                  </div>
                                                
                                              </div>
                              </div>
                            </div>
                         </div>


                  
                  </div>
        </div>

        
          <!-- INICIO -->
          <div class="modal fade bs-example-modal-smResponsableAuditor" tabindex="-1" id="myModalIng" role="dialog" >
                    <div class="modal-dialog modal-lg" style="width: 30%;">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title">ASIGNAR AUDITOR</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formGAudit" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="idgroux"  id="idgroux">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab"><br>
                                                   
                                                      <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">AUDITOR<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-9 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="audi" id="audi" required="required" tabindex="8"></select>
                                                               </div>
                                                      </div>
                                    <br><hr>
                                                  
                                                      <button type="button" class="btn btn-danger" id="das" onclick="RegistrarAuditor();" style="float: right;margin-bottom: 4%;" tabindex="18">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="generaAudi">CERRAR</button>
                                                      
                             </form>

                        </div>
                      </div>                       
                  </div>
                </div>
              </div> 
          </div>
        </div>
        <!--FIN GRUPO -->

           <!-- INICIO -->
           <div class="modal fade bs-example-modal-smTecnico" tabindex="-1" id="myModalIng" role="dialog" >
                    <div class="modal-dialog modal-lg" style="width: 30%;">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title">ASIGNAR TECNICO</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formTecx" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="idgrouxt"  id="idgrouxt">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab"><br>
                                                   
                                                      <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">TECNICO<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-9 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="tecx" id="tecx" required="required" tabindex="8"></select>
                                                               </div>
                                                      </div>
                                          <br><hr>
                                                  
                                                      <button type="button" class="btn btn-danger" id="das" onclick="RegistrarTecnico();" style="float: right;margin-bottom: 4%;" tabindex="18">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="generaTedf">CERRAR</button>
                                                      
                             </form>

                        </div>
                      </div>                       
                  </div>
                </div>
              </div> 
          </div>
        </div>
        <!--FIN GRUPO -->
        <!-- EMERGENCIAS -->
        
        <div class="modal fade bs-example-modal-smEmergencia" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background: #337ab7;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                           
                                    <div class="form-group">
                                          <h4 class="modal-title">REGISTRO PACIENTE HOSPITALIZACION</h4>
                                    </div>
                                </div>
                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formPacienteEmergen" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                  
                                  <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                  <input type="hidden" name="ide" id="ide">
                                  <input type="hidden" name="tipoReg" id="tipoReg" >
                                  
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                  <li role="presentation" class="active" id="idDat"><a href="#tab_content1u" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">DATOS DE INGRESO</a>
                                  </li>
                                   <li role="presentation" class="" id="idDat2"><a href="#tab_content2" id="home-tab2" role="tab" data-toggle="tab" aria-expanded="true">DATOS DEL USUARIO</a>
                                  </li>
                                  <li role="presentation" class="" id="idPad"><a href="#tab_content3" id="profile-tab" role="tab"   data-toggle="tab" aria-expanded="false" tabindex="13" >DATOS DE LA ATENCION</a>
                                  </li>
                                  <li role="presentation" class="" id="idArch"><a href="#tab_content4" id="profile-tab2"  role="tab"  data-toggle="tab" aria-expanded="false" tabindex="26">DATOS DEL ALTA</a>
                                  </li>
                                </ul>
                                        <div id="myTabContent" class="tab-content">
                                             <script>
                                                                  $(document).ready(function(){
                                                                      $("select[name=origenEmerMod]").change(function(){
                                                                                var dat = $('select[name=origenEmerMod]').val();
                                                                               
                                                                                
                                                                                if(dat=="1" ){
                                                                                    
                                                                                    $( "#viewEmerg" ).removeClass( "hidden");
                                                                                    $( "#viewConsulExter" ).addClass( "hidden");
                                                                                    
                                                                                    
                                                                                }else{
                                                                                     $( "#viewEmerg" ).addClass( "hidden");
                                                                                    $( "#viewConsulExter" ).removeClass( "hidden");
                                                                                }
                                                                                
                                                                            });
                                                                            
                                                                            $("select[name=origenEmer]").change(function(){
                                                                                var dateSA = $('select[name=origenEmer]').val();
                                                                               
                                                                                
                                                                                if(dateSA=="3" ){
                                                                                    
                                                                                     $( "#titleRefHis" ).removeClass( "hidden");
                                                                                     $( "#txtNroReHis" ).removeClass( "hidden");
                                                                                     $( "#estableRefIni" ).removeClass( "hidden");
                            
                                                                                }else{
                                                                                     $( "#titleRefHis" ).addClass( "hidden");
                                                                                     $( "#txtNroReHis" ).addClass( "hidden");
                                                                                     $( "#estableRefIni" ).addClass( "hidden");
                                                                                     $("#nroRefEmer").val("");
                                                                                     $("#eessInicio").val("");
                                                                                     
                                                                                }
                                                                                
                                                                            });
                                                                    });
                                                                </script>
                                                   <div role="tabpanel" class="tab-pane fade active in" id="tab_content1u" aria-labelledby="home-tab">  <br>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">CUENTA HOSP.</label>
                                                                      <div class="col-md-3 col-sm-12 col-xs-12" id="inputelcu">
                                                                        <input type="text" class="form-control" required="required" name="cuentaHsoMod" id="cuentaHsoMod" tabindex="1" >
                                                                      </div>
                                                                   
                                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12">ORIGEN</label>
                                                                     <div class="col-md-3 col-sm-12 col-xs-12">
                                                                              <select class="form-control" name="origenEmerMod" id="origenEmerMod" required="required" tabindex="3" >                   
                                                                                     <option value="">Seleccionar</option>
                                                                                     <option value="1">EMERGENCIA</option>
                                                                                     <option value="2">CONSULTA EXTERNA</option>
                                                                              </select>
                                                                     </div> 
                                                                </div>
                                                                <div class="form-group hidden" id="viewEmerg">
                                                                     <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-size: 12px;">TIPO SERVICIO</label>
                                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                                                <select class="form-control" name="ubicacionHosx" id="ubicacionHosx" required="required" tabindex="22">
                                                                                            <option value="">Seleccionar</option>
                                                                                            <option value="1">ADULTO</option>
                                                                                            <option value="2">COVID</option>
                                                                                            <option value="3">MATERNO</option>
                                                                                </select>
                                                                            </div>
                                                                     <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-size: 12px;">SERVICIO INGRESO</label>
                                                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                                                            <select class="form-control" name="tipoSeiNHospx" id="tipoSeiNHospx" required="required" tabindex="23"> 
                                                                                        
                                                                            </select>
                                                                        </div>
                                                                </div>
                                                                <div class="hidden" id="viewConsulExter">
                                                                     <div class="form-group">
                                                                                
                                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">NRO REFERENCIA</label>
                                                                                  <div class="col-md-3 col-sm-12 col-xs-12" id="inputelcu">
                                                                                    <input type="text" class="form-control" required="required" name="cuenta" id="cuenta" tabindex="1" >
                                                                                  </div>
                                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">FECHA REF.</label>
                                                                                  <div class="col-md-3 col-sm-12 col-xs-12" id="inputelcu">
                                                                                    <input type="date" class="form-control" required="required" name="cuenta" id="cuenta" tabindex="1" >
                                                                                  </div>
                                                                               
                                                                                
                                                                     </div>
                                                                      <div class="form-group">
                                                                                
                                                                                <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">DX</label>
                                                                                  <div class="col-md-3 col-sm-12 col-xs-12" id="inputelcu">
                                                                                    <input type="text" class="form-control" required="required" name="cuenta" id="cuenta" tabindex="1" >
                                                                                  </div>
                                                                               
                                                                               <label class="control-label col-md-2 col-sm-3 col-xs-12">ESPECIALIDAD</label>
                                                                                 <div class="col-md-3 col-sm-12 col-xs-12">
                                                                                          <select class="form-control" name="origenEmer" id="origenEmer" required="required" tabindex="3" >                   
                                                                                                 <option value="">Seleccionar</option>
                                                                                                 <option value="1">EMERGENCIA</option>
                                                                                                 <option value="2">CONSULTA EXTERNA</option>
                                                                                          </select>
                                                                                 </div>
                                                                     </div>
                                                                     
                                                                     
                                                                        
                                                                </div>
                                                                
                                                                
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab"><br>
                                                                
                                                                 <div class="form-group">
                                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">CUENTA HOSP.</label>
                                                                      <div class="col-md-3 col-sm-12 col-xs-12" id="inputelcu">
                                                                        <input type="text" class="form-control" required="required" name="cuenta" id="cuenta" tabindex="1" >
                                                                      </div>
                                                                   
                                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12">ORIGEN</label>
                                                                     <div class="col-md-3 col-sm-12 col-xs-12">
                                                                              <select class="form-control" name="origenEmer" id="origenEmer" required="required" tabindex="3" >                   
                                                                                     <option value="">Seleccionar</option>
                                                                                     <option value="1">EMERGENCIA</option>
                                                                                     <option value="2">CONSULTA EXTERNA</option>
                                                                              </select>
                                                                     </div>
                                                                </div>
                                                            
                                                               
                                                                
                                                                <div class="form-group hidden" id="estableRefIni">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">EESS REF.</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12" >
                                                                    <input type="text" class="form-control" required="required"  name="eessInicio" id="eessInicio" tabindex="38" >
                                                                  </div>
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12"  style="font-size: 13px;width: 94px;">SUBIR REF.</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12" id="" style="margin-left:-19px;">
                                                                        <input type="file" name="subirRef" id="subirRef"  class="form-control" accept=".pdf" style="border: 1px solid white;">
                                                                  </div>
                                                                  
                                                                </div>
                                                               
                                                              <div class="form-group">
                                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12">TIPO DOC</label>
                                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <select class="form-control" name="tipoDoc" id="tipoDoc" required="required" tabindex="3" >                   
                                                                            
                                                                      </select>
                                                                    </div>
                            
                                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" id="mosNrodoc">N° DOC. <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                                    <div class="col-md-4 col-sm-12 col-xs-12" id="verNrodc">
                                                                      <div class="input-group" style="margin-bottom:0px;">
                                                                         <input type="text" class="form-control" name="NroDoc" id="NroDoc" maxlength="11" required="required" tabindex="4" >
                                                                         <span class="input-group-btn">
                                                                            <button type="button" class="btn btn-primary" id="cargaDni"><i class="fa fa-search"></i></button>
                                                                         </span>
                                                                                  
                                                                       </div>
                                                                    </div> 
                                                                </div>
                                                                 <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">NOMBRES  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                    <input type="text" class="form-control" required="required" name="nombres" id="nombres" tabindex="5">
                                                                  </div>
                            
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA NAC.  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                                      <input type="date" class="form-control" required="required"  name="FechaNac" min='2001-01-31' max='2030-12-31' tabindex="6" id="FechaNac" onchange="handler(event);"  >
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">AP. PATERNO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                    <input type="text" class="form-control" required="required"  name="apepa" id="apepa" tabindex="7" >
                                                                  </div>
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">AP. MATERNO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control" required="required" name="apema" id="apema"  tabindex="8">
                                                                    </div>
                                                                </div>
                                                               
                                                                <div class="form-group">
                                                                 
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">EDAD</label>
                                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control" required="required" name="edad" id="edad" tabindex="9"  >
                                                                    </div>
                                                                     <label class="control-label col-md-2 col-sm-3 col-xs-12">SEXO</label>
                                                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                                                            <select class="form-control" name="sexo" id="sexo" required="required" tabindex="10">>
                                                                                    <option value="">-- Seleccionar --</option>
                                                                                    <option value="1">MASCULINO</option>
                                                                                    <option value="2">FEMENINO</option>
                                                                            </select>
                                                                        </div>
                                                                </div>
                                                                  <script>
                                                                  $(document).ready(function(){
                                                                      $("select[name=cns]").change(function(){
                                                                                var dat = $('select[name=cns]').val();
                                                                               
                                                                                
                                                                                if(dat=="SC" ){
                                                                                    
                                                                                    $( "#txtRs" ).addClass( "hidden");
                                                                                    $( "#campRes" ).addClass( "hidden");
                                                                                    
                                                                                    
                                                                                }else{
                                                                                     $( "#txtRs" ).removeClass( "hidden");
                                                                                    $( "#campRes" ).removeClass( "hidden");
                                                                                }
                                                                                
                                                                            });
                                                                    });
                                                                </script>
                                                                 <div class="form-group">
                                                                         <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">TELF. FAMILIAR</label>
                                                                          <div class="col-md-2 col-sm-12 col-xs-12" id="inputel345">
                                                                            <input type="text" class="form-control" required="required" name="telefa" id="telefa" tabindex="11" >
                                                                          </div>
                                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">CONTRASEÑA</label>
                                                                          <div class="col-md-2 col-sm-12 col-xs-12" id="inputel09">
                                                                            <select class="form-control" name="cns" id="cns" required="required" tabindex="10">>
                                                                                    <option value="">-- Seleccionar --</option>
                                                                                    <option value="SC">S/C</option>
                                                                                    <option value="CC">C/C</option>
                                                                            </select>
                                                                          </div>
                                                                           <label class="control-label col-md-1 col-sm-3 col-xs-12 hidden" id="txtRs">RESPONSABLE</label>
                                                                           <div class="col-md-2 col-sm-12 col-xs-12 hidden" id="campRes" style="margin-left: 31px;">
                                                                            <input type="text" class="form-control" required="required" name="respbl" id="respbl" tabindex="11" >
                                                                          </div>
                                                                 </div>
                                                                
                                                    </div>
                                        </div>
                                            
                                        
                                    </div>
                                                  
                                    
                                     
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default hidden" onclick="LimpiarForm();">LIMPIAR</button>
                                      <button type="button" class="btn btn-danger" id="guardarEmege" onclick="RegistrarPacienteEm();">GUARDAR</button>                                      
                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrar">CERRAR</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </form>
                    </div>
                  </div>
        <!-- FIN EMERFENCIAS -->

        <div class="modal fade bs-example-modal-sm" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title">REGISTRO DEL PACIENTE</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formPaciente" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                    <input type="hidden" name="ide" value="<?php echo $id ?>" id="ide">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                          <li role="presentation" class="active" id="idDat"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">DATOS</a>
                                          </li>
                                          <li role="presentation" class="hidden" id="idPad"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">PADRES</a>
                                          </li>
                                          <li role="presentation" class="hidden" id="idArch"><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">ARCHIVOS</a>
                                          </li>
                                          <li role="presentation" style="float: right;" class="MostrarCo hidden" id="MosPac">
                                          </li>
                                        </ul>
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">                                           
                                                      <br>
                                                      
                                                      <div class="form-group">
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">N° CUENTA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-3 col-sm-12 col-xs-12">
                                                                <div class="input-group" style="margin-bottom:0px;">
                                                                    <input type="text" class="form-control" name="Nxuenta" id="Nxuenta" maxlength="11" required="required" tabindex="6" >
                                                                    <span class="input-group-btn">
                                                                        <button type="button" class="btn btn-primary" id="cargaCuenta"><i class="fa fa-search"></i></button>
                                                                    </span>
                                                                </div>
                                                              </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">H. CLINICA <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input type="text" class="form-control" name="hclinica" id="hclinica" maxlength="11" required="required" tabindex="4"  >
                                                            </div>
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">N° FUA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-3 col-sm-12 col-xs-12">
                                                                <div class="input-group" style="margin-bottom:0px;">
                                                                    <input type="text" class="form-control" name="fua" id="fua" value="16918-22-" maxlength="35" required="required" tabindex="6"  >
                                                                 
                                                                </div>
                                                              </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">DNI <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input type="text" class="form-control" name="dni" id="dni" maxlength="11" required="required" tabindex="4"  >
                                                            </div>
                                                          </div>
                                                      </div>
                                                     
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">PACIENTE  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="paciente" id="paciente" tabindex="5" style="text-transform: uppercase;" >
                                                        </div>

                                                       
                                                      </div>
                                                     
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">SERVICIO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="servicio" id="servicio" tabindex="9"  style="text-transform: uppercase;" >
                                                        </div>
                                                       
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">F. INGRESO<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <input type="date" class="form-control" required="required"  name="feingreso" id="feingreso" tabindex="11" >
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">F. CORTE/ALTA  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="date" class="form-control" required="required" name="fecorte" id="fecorte"  tabindex="12"  >
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="title" class="col-sm-2 control-label">AUDITOR</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control" name="asiAudi" id="asiAudi" style="text-transform: uppercase;" required="required" tabindex="8">
                                                            </select>
                                                        </div>
                                                      </div>
                                                     
                                    <br><br>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="RegistrarPac();" style="float: right;margin-bottom: 4%;">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarpre">CERRAR</button>
                                                      
                                           </form>

                                          </div>
                                         
                 

               

               


        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>
   