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

                            function ordenarSelect(id_componente)
                            {
                              var selectToSort = jQuery('#' + id_componente);
                              var optionActual = selectToSort.val();
                              selectToSort.html(selectToSort.children('option').sort(function (a, b) {
                                return a.text === b.text ? 0 : a.text < b.text ? -1 : 1;
                              })).val(optionActual);
                              
                            }
                            
                                
                          $(document).ready(function() {
                              
                                        
                                     setTimeout(function (){
                                    //        ordenarSelect('selFeco');
                                    }, 3000);

                                      $(".filter").remove();
                                     
                                     $.getJSON( 'https://segurosmedic.com/hnal/condicionCantidades.php', function ( results ) {
                                            console.log( 'Search Result(s): ', results );
                                    	} );
            
                                    var fuab = getParameterByName('busFua');
                                    var tipoRe = getParameterByName('tipoRep');

                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length < 2 ? '0' : '') + month + '/' +
                                              ((''+day).length < 2 ? '0' : '') + day;


                                var table = $('#pac3grupo').DataTable( {
                                                  "bProcessing": true,
                                                  "sAjaxSource": "./Controlador/search.php?function=listGrupoReporte&fua="+fuab+"&tipoRep="+tipoRe,
                                                  "bPaginate":true,
                                                  "sPaginationType":"full_numbers",
                                                  "iDisplayLength":13,
                                                  "order": [0, "desc" ],
                                                  "columnDefs": [
                                                    { targets: [1,2,3,5,6,7,8,9,13], visible: true},
                                                    { targets: '_all', visible: false 
                                                    
                                                    },{
                                                      className: "dt-left",
                                                      "targets": [5,9] 
                                                  },{
                                                    className: "dt-right",
                                                    "targets": [] 
                                                  },
                                            //
                                                  {
                                                      className: "dt-center",
                                                      "targets": [0,2,3,4,5,6,7,8,9,10,13]
                                                  }],
                                                  "aoColumns": [
                                                        { mData: 'idGrupo' },
                                                        { mData: 'opciones' },
                                                        { mData: 'code' },
                                                        { mData: 'usreg' },
                                                        { mData: 'paquete'},
                                                        { mData: 'auditor' },
                                                        { mData: 'cantidad' },
                                                        { mData: 'recibido' },
                                                        { mData: 'pendientes' },
                                                        { mData: 'observacion' },
                                                        { mData: 'fechaRegistro' },
                                                        { mData: 'fechaReporte' },
                                                        { mData: 'filtroEstatus' },
                                                        { mData: 'fex' },
                                                        
                                                  ],

                                                  dom: '<lfBtip>',
                                                  buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'PacientesRegistrados'+ output,
                                                            exportOptions: {
                                                              columns: [2,3,4,5,6,7,8,9,13]
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
                                                      var select2 = $('<select class="form-control filter" style="text-transform: uppercase;" id="selFeco"><option value="">Todos</option></select>')
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
                                      

                                  

                                        $('#pac3grupo_filter').addClass('form-group');
                                        $('#pac3grupo_filter').css('text-align','left');
                                        $('#pac3grupo_filter').css('display','none');
                                        $('#pac3grupo_paginate').css('width','100%');
                                        $('.dt-buttons').css('float','right');
                                       // $('.dt-buttons').css('display','none');
                                        $('.dt-buttons').css('margin-top','0px');
                                        $('#pac3grupo_filter label input').addClass('form-control');
                                        $('#pac3grupo_length label select').addClass('form-control');

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
                                <h2 style="text-transform: uppercase;">PAQUETES<small></small></h2>
                                 <button type="button" class="btn btn-success btn-xs" style="margin-left: 60px;">Terminado</button>
                                <button type="button" class="btn btn-warning btn-xs">Pendiente</button>
                                <button type="button" class="btn btn-default btn-xs">Sin asignacion</button>
                                <!--<button type="button" class="btn btn-success btn-xs">Enviado</button>
                                              <button type="button" class="btn btn-warning btn-xs">Pendiente</button>-->
                               <!-- <a class="btn btn-success"  href="imporConsol.php"  style="float: right;"><i class="fa fa-file-excel-o"></i> Importar</a>-->
                              
                             <!-- <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-smResponsableAuditor" id="agr2" role="button" aria-expanded="false" 
                                style="float: right;background: #fd00b9;border: 1px solid #fd00b9;" onclick="limpiarFromGrupo();"><i class="fa fa-edit m-right-xs"></i> Nuevo Registro</a>-->
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
                                            <table class="table jambo_table bulk_action compact"  id="pac3grupo" style="width:100%">
                                                <thead>
                                
                                                  <tr class="headings" style="font-size: 10px;">
                                                        <th class="" style="text-transform: uppercase;text-align: center;">#</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">OPCIONES</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">PAQUETE</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">USUARIO</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">PAQUETE</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">AUDITOR_ASIGNADO</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">TOTAL</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">FECHA_ASIGNADA</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">FECHA_RECEPCION</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">OBSERVACION</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">___REGISTRO___</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">FECHA_REPORTE</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">ESTADO</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">FECHA_REGISTRO_FUA</th>
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
                                                   
                                                      <div class="form-group hidden">
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
                                                      <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-size: 10px;">FECHA ASIGNACION</label>
                                                            <div class="col-md-9 col-sm-12 col-xs-12">
                                                                 <input type="date" class="form-control" name="feAsg" id="feAsg" maxlength="16" required="required" tabindex="4"  >
                                                            </div>
                                                             
                                                      </div>
                                                      <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-size: 10px;">FECHA RECEPCION</label>
                                                            <div class="col-md-9 col-sm-12 col-xs-12">
                                                                 <input type="date" class="form-control" name="feRexc" id="feRexc" maxlength="16" required="required" tabindex="5"  >
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
   