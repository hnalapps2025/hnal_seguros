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
                                     
                                     
            
                                    var fuab = getParameterByName('busFua');
                                    var tipoRe = getParameterByName('tipoRep');

                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;


                                var table = $('#tableQuimio').DataTable( {
                                                  "bProcessing": true,
                                                  "sAjaxSource": "./Controlador/search.php?function=listQuimio",
                                                  "bPaginate":true,
                                                  "sPaginationType":"full_numbers",
                                                  "iDisplayLength":10,
                                                  "order": [0, "desc" ],
                                                  "columnDefs": [
                                                    { targets: [1,2,3,4,5,6,7,8,9,10,11], visible: true},
                                                    { targets: '_all', visible: false 
                                                    
                                                    },{
                                                      className: "dt-left",
                                                      "targets": [5] 
                                                  },{
                                                    className: "dt-right",
                                                    "targets": [] 
                                                  },
                                            //
                                                  {
                                                      className: "dt-center",
                                                      "targets": [0,2,3,4,5,6,7,8,9,10,11]
                                                  }],
                                                  "aoColumns": [
                                                        { mData: 'idQ' },
                                                        { mData: 'opciones' },
                                                         { mData: 'userRegistro' },
                                                        { mData: 'paciente' },
                                                        { mData: 'historia'},
                                                        { mData: 'fua' },
                                                        { mData: 'cuenta' },
                                                        { mData: 'feAtencion' },
                                                        { mData: 'medico' },
                                                        { mData: 'feProc' },
                                                        { mData: 'nsp' },
                                                        { mData: 'devolucion' },
                                                        
                                                  ],

                                                  dom: '<lfBtip>',
                                                  buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'PacientesRegistrados'+ output,
                                                            exportOptions: {
                                                              columns: [1,2,3,4,5,6]
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
                                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                                                        "infoEmpty": "Mostrando 0 a 0 de 0 Registros",
                                                        "infoFiltered": "(Filtrado de _MAX_ total Registros)",
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
                                                      var column2 = this.api().column(5);
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
                                                      var column = this.api().column(11);
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
                                                      // 1 filtro
                                                      var columnAS = this.api().column(12);
                                                      var selectAS = $('<select class="form-control filter" style="text-transform: uppercase;"><option value="">Todos</option></select>')
                                                        .appendTo('#filEsta')
                                                        .on('change', function() {
                                                          var valAS = $(this).val();
                                                          columnAS.search(valAS).draw()
                                                        });

                                                      var officesAS = []; 
                                                      columnAS.data().toArray().forEach(function(s) {
                                                          s = s.split(',');
                                                          s.forEach(function(d) {
                                                            if (!~officesAS.indexOf(d)) {
                                                              officesAS.push(d)
                                                              selectAS.append('<option value="' + d + '">' + d + '</option>');}
                                                          })
                                                      })

                                                      //fin filtro

                                                    },
                                                    
                                                      /*scrollY: "450px",
                                                      scrollX: true,*/
                                                      // fin 1 filtro
                                                    
                                                  });
                                      

                                  

                                        $('#tableQuimio_filter').addClass('form-group');
                                        $('#tableQuimio_filter').css('text-align','left');
                                        $('#tableQuimio_filter').css('display','none');
                                        $('#tableQuimio_paginate').css('width','100%');
                                        $('.dt-buttons').css('float','right');
                                       // $('.dt-buttons').css('display','none');
                                        $('.dt-buttons').css('margin-top','0px');
                                        $('#tableQuimio_filter label input').addClass('form-control');
                                        $('#tableQuimio_length label select').addClass('form-control');

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
                                                    aData._date = new Date(aData[11]).getTime(); 
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
                                <h2 style="text-transform: uppercase;">FUAS QUIMIOTERAPIA<small></small></h2>
                                  <!-- <button type="button" class="btn btn-success btn-xs" style="margin-left: 60px;">Terminado</button>
                                <button type="button" class="btn btn-warning btn-xs">Pendiente</button>
                                <button type="button" class="btn btn-default btn-xs">Sin asignacion</button>
                               -->
                               <!-- <a class="btn btn-success"  href="imporConsol.php"  style="float: right;"><i class="fa fa-file-excel-o"></i> Importar</a>-->
                              
                                <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-smRegQuim" id="agr2" role="button" aria-expanded="false" 
                                style="float: right;" onclick="limpiarFromQuimio();"><i class="fa fa-edit m-right-xs"></i> Nuevo Registro</a>
                                  <!--<a href="especial.php" class="btn btn-success"  id="agr2" role="button" style="float: right;" "><i class="fa fa-edit m-right-xs"></i> Importar</a>-->
                               
                                <!--<a href="#" class="dropdown-toggle" data-toggle="modal" data-target=".bs-example-modal-sm" id="agr2" role="button" aria-expanded="false"><i class="fa fa-arrows"></i></a>-->
                                <!--<a href="registrosexcel.php" style="float: right;"><img style="width:30px;" src="<?php echo $path ?>images/excel.png">&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;</a>
                                <a style="float: right;">Exportar a:&nbsp;&nbsp; </a> -->
                                <div class="clearfix"></div>
                              </div>
                              

                              <div class="x_content">
                             
                              <table border="0" class="hidden" >
                                  <tbody>
                                  
                                      <tr>
                                         <form id="" action="#" method="get">
                                              <td><label>Buscar:</label></td>
                                              <td> <select name="tipoRep" id="tipoRep" class="form-control" style="text-transform: uppercase;width: 117px;">
                                                                <option value="FUA">FUA</option>
                                                                <option value="HISTORIA">HISTORIA</option>
                                                        </select>
                                              </td>
                                              <td>
                                                  <div class="input-group" style="margin-bottom: -5px;">
                                                    <input name="busFua" id="busFua" type="text" class="form-control" >
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-primary" id="sa"><i class="fa fa-eraser"></i> Buscar</button>
                                                    </span>
                                                  </div>
                                              </td>
                                          </form>
                                          <td><label style="margin-left:25px;margin-right: 5px;">Estado:</label></td>
                                          <td><p id="filEsta" style="margin: 0 0 -2px;"></p></td>
                                         <td><label style="margin-left:25px;margin-right: 5px;">Auditor:</label></td>
                                          <td><p id="fecon" style="margin: 0 0 -2px;"></p></td>
                                          <td ><label style="margin-left: 14px;">Desde:&nbsp;&nbsp;</label></td>
                                          <td ><input name="minCie109" id="minCie109" style="width: 115px;" type="text" class="form-control" placeholder="Fecha Inicio" autocomplete="off" ></td>
                                          <td><label>&nbsp;&nbsp;Hasta:&nbsp;&nbsp;</label></td>
                                          <td ><input name="maxCie109" id="maxCie109" type="text" style="width: 115px;" class="form-control" placeholder="Fecha final" autocomplete="off" ></td>                                          
                                          <td>&nbsp;
                                        <!--<td><label style="margin-left:25px;margin-right: 5px;">Estado:</label></td>
                                          <td><p id="feces" style="margin: 0 0 -2px;"></p></td>
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
                                            <table class="table jambo_table bulk_action compact"  id="tableQuimio" style="width:100%">
                                                <thead>
                                
                                                  <tr class="headings" style="font-size: 10px;">
                                                        <th class="" style="text-transform: uppercase;text-align: center;">#</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">OPCIONES</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">USUARIO</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">PACIENTE</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">H_CLINICA</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">FUA</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">CUENTA</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">FE_ATENCION</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">MEDICO</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">DNI</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">CIE10</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">TELEFONO</th></th>
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
                                    <h4 class="modal-title">CREAR PAQUETE</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formGAudit" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="idusergru"  id="idusergru" value="<?php echo $iduser ?>">
                                                     <input type="hidden" name="idgroux"  id="idgroux">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab"><br>
                                                   
                                                      <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">PAQUETE</label>
                                                            <div class="col-md-9 col-sm-12 col-xs-12">
                                                                 <input type="text" class="form-control" name="nomPac" style="text-transform: uppercase;" id="nomPac" maxlength="16" required="required" tabindex="1"  >
                                                            </div>
                                                             
                                                      </div>
                                                      <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">AUDITOR</label>
                                                            <div class="col-md-9 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="audiGrupo" id="audiGrupo" required="required" tabindex="2"></select>
                                                            </div>
                                                             
                                                      </div>
                                                      <div class="form-group">
                                                           
                                                             <label class="control-label col-md-2 col-sm-3 col-xs-12">OBSERVACION</label>
                                                              <div class="col-md-9 col-sm-12 col-xs-12">
                                                                 
                                                                  <textarea class="form-control" name="obsGrupo" id="obsGrupo" rows="6" style="text-transform: uppercase;" tabindex="3"></textarea>
                                                              </div>
                                                      </div>
                                    <br><hr>
                                                  
                                                      <button type="button" class="btn btn-danger" id="das" onclick="RegAuditorAsignado();" style="float: right;margin-bottom: 4%;" tabindex="18">GUARDAR</button>                                      
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
     
        
        
       
        
        
        <div class="modal fade bs-example-modal-smRegQuim" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title">REGISTRO DEL PACIENTE</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formPacienteQuimio" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                    <input type="hidden" name="ideQa" id="ideQa">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs hidden" role="tablist">
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
                                                                    <input type="text" class="form-control" name="NxuentaQ" id="NxuentaQ" maxlength="11" required="required" tabindex="6" >
                                                                </div>
                                                              </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12">HISTORIA</label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                              <input type="text" class="form-control" name="hclinicaQ" id="hclinicaQ" maxlength="11" required="required" tabindex="4"  >
                                                          </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12">TIPO_DOC</label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                              <select class="form-control" name="tipoDocQui" id="tipoDocQui" required="required" tabindex="3">                   
                                                                    <option value="DNI">DNI</option>
                                                                    <option value="Carnet Ext.">Carnet Ext.</option>
                                                                    <option value="Pasaporte">Pasaporte</option>
                                                                    <option value="Codigo recien nacido (CUI)">Codigo recien nacido (CUI)</option>
                                                                    <option value="Doc. Ident. Extranjera">Doc. Ident. Extranjera</option>
                                                                    <option value="Sin Doc.">Sin Doc.</option>
                                                              </select>
                                                            </div>
                                                      </div>
                                                      <div class="form-group">
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">N° FUA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-3 col-sm-12 col-xs-12">
                                                                <div class="input-group" style="margin-bottom:0px;">
                                                                    <input type="text" class="form-control" name="qqq" id="qqq" value="6207-22-" style="width:84px;" readonly="readonly" tabindex="6"  >
                                                                 <input type="text" class="form-control" name="fuaQ" id="fuaQ"  style="width: 111px;" required="required" tabindex="6"  >
                                                                </div>
                                                              </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12">DNI</label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                            
                                                              <input type="text" class="form-control" name="dniQuimi" id="dniQuimi" maxlength="11" required="required" tabindex="4"  >
                                                          
                                                          </div>
                                                           <label class="control-label col-md-1 col-sm-3 col-xs-12">TELEFONO<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" name="tefQuimi" id="tefQuimi"  tabindex="12"  >
                                                          </div>
                                                      </div>
                                                     
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">PACIENTE  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="pacienteQ" id="pacienteQ" tabindex="5" style="text-transform: uppercase;" >
                                                        </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 72px;font-size: 11px;">OCUPACION</label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12" style="width:150px;">
                                                              <select class="form-control" name="ocupQui" id="ocupQui" required="required" tabindex="3">                   
                                                                    <option value="">-Seleccionar-</option>
                                                                    <option value="1">ONCOLOGO</option>
                                                                    <option value="2">HEMATOLOGO</option>
                                                              </select>
                                                            </div>
                                                            <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 72px;font-size: 11px;">ATENCION</label>
                                                              <div class="col-md-2 col-sm-12 col-xs-12" style="width:208px;">
                                                                  <select class="form-control" name="atenQuimi" id="atenQuimi" required="required" tabindex="3">                   
                                                                        <option value="">-Seleccionar-</option>
                                                                        <option value="1">HOSPITALIZACION</option>
                                                                        <option value="2">EMERGENCIA</option>
                                                                        <option value="3">CONSULTA EXTERNA</option>
                                                                  </select>
                                                                </div>
                                                       
                                                      </div>
                                                     
                                                      <div class="form-group hidden">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">SERVICIO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="servicio" id="servicio" tabindex="9"  style="text-transform: uppercase;" >
                                                        </div>
                                                       
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">F. ATENCION<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <input type="date" class="form-control" required="required"  name="feAtenQ" id="feAtenQ" tabindex="11" >
                                                        </div>
                                                        <label for="title" class="col-sm-1 control-label">AUDITOR</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control" name="asiAudiQa" id="asiAudiQa" style="text-transform: uppercase;" required="required" tabindex="8">
                                                            </select>
                                                        </div>
                                                      </div>
                                                       <div class="form-group">
                                                           <label class="control-label col-md-2 col-sm-3 col-xs-12">SEGUROS</label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                                 <select class="form-control" name="segurosQuimi" id="segurosQuimi" required="required" tabindex="5">
                                                                          <option value="0">Seleccionar</option>
                                                                          <option value="1">SUBSIDIADO (SIS GRATUITO)</option>
                                                                          <option value="2">SUBSIDIADO (SIS DL 1466)</option>
                                                                          <option value="3">SIS PARA TODOS</option>
                                                                          <option value="4">SIS EMPRENDEDOR</option>
                                                                          <option value="7">SIS INDEPENDIENTE</option>
                                                                          <option value="8">SIS PARA TODOS(D.U. N° 046-2021)</option>
                                                                          <option value="9">SIS MICROEMPRESAS (NRUS)</option>
                                                                          <option value="11">OTROS</option>
                                                                  </select>
                                                            </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12">N°_REF<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-2 col-sm-12 col-xs-12">
                                                                    <input type="text" class="form-control" name="refQuimi" id="refQuimi" maxlength="11" required="required" tabindex="6" >
                                                              </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12">F_NAC</label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                              <input type="date" class="form-control" name="fechaNacQuimi" id="fechaNacQuimi" maxlength="11" required="required" tabindex="4" onchange="handlerEdadQuimio(event);" >
                                                          </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 44px;">EDAD</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12">
                                                              <input type="text" class="form-control" name="edadQuimi" id="edadQuimi" maxlength="11" required="required" tabindex="4" style="width: 100px;font-size: 12px" >
                                                          </div>
                                                      </div>
                                                     
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 1<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-8 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" name="feProcQ" id="feProcQ"  tabindex="12" style="text-transform: uppercase;"  >
                                                          </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip1Qui" id="tip1Qui" required="required" tabindex="">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                        <option value="R">R</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                       <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 2<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-8 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" name="cie102Qui" id="cie102Qui"  tabindex="12"  style="text-transform: uppercase;" >
                                                          </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip2Qui" id="tip2Qui" required="required" tabindex="">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                        <option value="R">R</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                       <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 3<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-8 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" name="cie103Qui" id="cie103Qui"  tabindex="12"  style="text-transform: uppercase;">
                                                          </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip3Qui" id="tip3Qui" required="required" tabindex="">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                        <option value="R">R</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                       <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 4<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-8 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" name="cie104Qui" id="cie104Qui"  tabindex="12" style="text-transform: uppercase;" >
                                                          </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip4Qui" id="tip4Qui" required="required" tabindex="">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                        <option value="R">R</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                       <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 5<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-8 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" name="cie105Qui" id="cie105Qui"  tabindex="12" style="text-transform: uppercase;"  >
                                                          </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip5Qui" id="tip5Qui" required="required" tabindex="">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                        <option value="R">R</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                     
                                    <br><br>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="" onclick="registroQuimi();" style="float: right;margin-bottom: 4%;">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarQuim">CERRAR</button>
                                                      
                                           </form>

                                          </div>
                                         
                 </div>
        </div>
  </div>
  </div>
   </div>
    </div>
         <!-- modal sesiones-->
        
         <div class="modal fade bs-example-modal-smSesiones" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">

                                <div class="modal-header" style="background:red;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacient">FECHAS DE PROCEDIMIENTOS</h4>
                                </div>
                                <div class="modal-body">
                        
                                  <form class="formulario form-horizontal form-label-left input_mask" method="POST" id="formSessions">
                                    <input type="hidden" name="iduserSe"  id="iduserSe" value="<?php echo $iduser; ?>">
                                    <input type="hidden" name="idSes" id="idSes">
                                                 <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" style="text-align: center;margin-top:2px;margin-right: 7px;">SESION</label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                              <input type="date" class="form-control"  name="fechaSesion" id="fechaSesion"  > 
                                                          </div>
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" >NSP</label>
                                                   <div class="col-md-1 col-sm-12 col-xs-12">
                                                        <div class="checkbox" style="margin-bottom:0px;">
                                                          <input type="checkbox" class="form-control" name="nspModal" id="nspModal" tabindex="5" style="width: 20px;margin-left: 1px;margin-top: -6px;">
                                                        </div>
                                                      </div>
                                                     <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: center;margin-top:2px;">DEVOLUCION</label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                              <input type="date" class="form-control"  name="devModal" id="devModal"  > 
                                                          </div>
                                                          <br>
                                                          
                                                 </div>
                                                 <div class="form-group">
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12">OBS</label>
                                                              <div class="col-md-5 col-sm-12 col-xs-12">
                                                                    <textarea class="form-control" name="obsSesion" id="obsSesion" rows="3"></textarea>
                                                               
                                                              </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: center;margin-top:2px;font-size: 12px;">REPROGRAMAR</label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12" style="margin-left: 7px;">
                                                              <input type="date" class="form-control"  name="repoQuimi" id="repoQuimi"  > 
                                                          </div>
                                                </div>
                                                <div class="form-group" style="float: right;margin-top: 20px;">
                                                        <button type="button" class="btn btn-success btn-xs" id="masExamen" onclick="agregarSesionQuimio();"><i class="fa fa-save"></i> Agregar</button>                                      
                                                        <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarSesiones">CERRAR</button> 
                                                                                       
                                                </div>
                                                
                                              <div class="form-group ">
                                                          <div class="table-responsive" id="datExrSesiones" style="float: left;"> 
                                                
                                              
                                                          </div>                                  
                                              </div>
                                      <br>
                                                                     
                                  </form>
                                </div>
                                <div class="modal-footer" id="elFin"> 
                                     
                                  
                                 </div>
                         
                           </div>
                    </div>
                  </div>
        <!-- fin modal sesiones -->

               


        <!-- footer content -->
        
     
       <?php include 'Vistas/footer.php';  ?>
   