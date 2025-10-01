 <?php 


//error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Debes iniciar sesión para continuar.'); window.location='index.php';</script>";  
  exit;
} 

include_once ('./../config.php');
include (MODEL_PATH."ModelProcedmientos.php");
include (MODEL_PATH."global.php");

$grupo= $_GET['grupo']; 
/*
$sel = new ModelProcedmientos();

$ni = $sel->verUserPaquete($grupo);
$mueVer = $ni->fetch_assoc(); */


include 'Vistas/librerias.php';  

?>


<script type="text/javascript">
                            
                          /* $(document).on('keydown', 'body', function(event) {
                               
                                        if(event.keyCode==13){ 
                                           
                                           event.preventDefault();
                                                $("#openNuevo").click();
                                                LimpiarFormEmerCE();
                                           
                                        }
                                        
                                        
                            }); */
                                
                          $(document).ready(function() {
                              
                                        /*$("#text").keyup(function(event) {
                                            if (event.which === 13) {
                                                $("#submit").click();
                                            }
                                        });*/
                                        
                                        
                                        $.getJSON( 'https://sighap.com/hnal/condicionCantidades.php', function ( results ) {
                                            console.log( 'Search Result(s): ', results );
                                    	} );

                                      $(".filter").remove();
                                      var id = getParameterByName('grupo');
                                      verUltimoiD(id);verMiniD(id);
                                      verUserPaquete(id);

                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;


                                var table = $('#pac3EmerCE').DataTable( {
                                                  "bProcessing": true,
                                                  "sAjaxSource": "./Controlador/search.php?function=listConsultaExterna&id=" + id ,
                                                  "bPaginate":true,
                                                  "sPaginationType":"full_numbers",
                                                  
                                                  "iDisplayLength":200,
                                                  "order": [0, "asc" ],
                                                  dom: '<"top"iB>rt<"bottom"flp><"clear">',
                                                  "columnDefs": [
                                                    
                                                    { targets: [0,1,2,4,5,6,9,10,14,20,22,23,24,25,26,27], visible: true,"orderable": true},
                                                    { targets: '_all', visible: false 
                                                    
                                                    },{
                                                      className: "dt-left",
                                                      "targets": [12,14] 
                                                  },{
                                                    className: "dt-right",
                                                    "targets": [] 
                                                  },
                                            //
                                                  {
                                                      className: "dt-center",
                                                      "targets": [0,1,2,3,4,5,6,9,10,20,22,23,24,25,26,27]
                                                  }],
                                                  "aoColumns": [

                                                        { mData: 'opciones' },
                                                        { mData: 'chek' },
                                                        { mData: 'fechaAsignada' },
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
                                                        { mData: 'montoValAtencion' },
                                                        { mData: 'Observaciones' },
                                                        { mData: 'fechaRegistro' },
                                                        { mData: 'fechaUpdate' },
                                                        { mData: 'codPre' },
                                                        { mData: 'dx1' },
                                                        { mData: 'cl1' },
                                                        { mData: 'tpdx1' },
                                                        { mData: 'dx2' },
                                                        { mData: 'cl2' },
                                                        { mData: 'tpdx2' },
                                                        { mData: 'dx3' },
                                                        { mData: 'cl3' },
                                                        { mData: 'tpdx3' },
                                                        { mData: 'dx4' },
                                                        { mData: 'cl4' },
                                                        { mData: 'tpdx4' },
                                                        { mData: 'dx5' },
                                                        { mData: 'cl5' },
                                                        { mData: 'tpdx5' },
                                                        
                                                        
                                                  ],

                                                  //dom: '<fBtip>',
                                                  buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'PacientesRegistrados'+ output,
                                                            exportOptions: {
                                                              columns: [1,2,4,5,6,9,14,20,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43]
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
                                                    
                                                      scrollY: "400px",
                                                      scrollX: true,
                                                      // fin 1 filtro
                                                    
                                                  });
                                      

                                  

                                        $('#pac3EmerCE_filter').addClass('form-group');
                                        $('#pac3EmerCE_filter').css('text-align','left');
                                        $('#pac3EmerCE_filter').css('display','none');
                                       $('.dt-buttons').css('float','right');
                                       // $('.dt-buttons').css('display','none');
                                        $('.dt-buttons').css('margin-top','-13px');
                                        $('#pac3EmerCE_filter label input').addClass('form-control');
                                        $('#pac3EmerCE_length label select').addClass('form-control');

                                        $('#nrofua').on( 'keyup', function () {
                                            table.search( this.value ).draw();
                                        } );
                                        
                                        
                                        $('#hisclic').on( 'keyup', function () {
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
                                <h2 id="tituloVerUser" style="text-transform: uppercase;"><small></small></h2>
                                <!--<button type="button" class="btn btn-success btn-xs">Terminado</button>
                                <button type="button" class="btn btn-warning btn-xs">Pendiente</button>
                                <button type="button" class="btn btn-default btn-xs">Vacio</button>-->
                               <!-- <a class="btn btn-success"  href="imporConsol.php"  style="float: right;"><i class="fa fa-file-excel-o"></i> Importar</a>-->
                               
                                <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-smEmergenciaCE" id="openNuevo" role="button" aria-expanded="false" 
                                style="float: right;" onclick="LimpiarFormEmerCE();"><i class="fa fa-edit m-right-xs"></i> Nuevo Registro</a>
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
                                          <td><label>BUSCAR POR:</label></td>
                                          <td><input name="min" id="nrofua" type="text" class="form-control" placeholder="Nro FUA" ></td>
                                          <td>&nbsp;&nbsp;&nbsp;&nbsp;<input  id="idUltimo" type="hidden" class="form-control"><input  id="idInicio" type="hidden" class="form-control"></td>
                                          <td><input name="min" id="hisclic" type="text" class="form-control" placeholder="Historia clinica" ></td>
                                          <td><label style="margin-left:25px;margin-right: 5px;">ASIGNAR:</label></td>
                                          <td><input name="asgiMed" id="asgiMed" type="date" class="form-control" ></td>
                                          <td>  <!--<p><a class="btn btn-danger" href="#" id="enviar" style="margin-bottom: -9px;">Enviar</a></p>-->
                                          
                                                      <div class="btn-group" style="margin-bottom: 5px;">
                        								<button style="margin-top: 5px;" data-toggle="dropdown" class="btn btn-danger dropdown-toggle" 
                        								type="button" aria-expanded="true"> Opcion <span class="caret"></span>
                        								</button>
                        								<ul role="menu" class="dropdown-menu pull-left" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
                        									<li>
                        									        <a href="#" id="enviar" ><i class="fa fa-edit"></i> Enviar</a>
                        									</li>
                        										<li>
                        										<a onclick="eliminarAsignacionCe(<?php echo $grupo ?>)"><i class="fa fa-trash"></i> Limpiar</a>
                        									</li>
                        										<li>
                        										    <a href="#" id="eliminarCheckMasivo" >X Eliminar Fuas</a>
                        									    </li>
                        								</ul>
                        							</div>
                                        
                                          
                                          </td>
                                           <td><label style="margin-left:25px;margin-right: 5px;">RECEPCIONAR:</label></td>
                                          <td><input name="recepFau" id="recepFau" type="date" class="form-control" ></td>
                                          <td><!--<p><a class="btn btn-danger" href="#" id="enviarRecp" style="margin-bottom: -9px;">Enviar</a>--></p>
                                          
                                           <div class="btn-group" style="margin-bottom:14px;">
                        								<button style="margin-top: 5px;" data-toggle="dropdown" class="btn btn-danger dropdown-toggle" 
                        								type="button" aria-expanded="true"> Opcion <span class="caret"></span>
                        								</button>
                        								<ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
                        									<li>
                        									        <a href="#" id="enviarRecp" ><i class="fa fa-edit"></i> Enviar</a>
                        									</li>
                        										<li>
                        										<a onclick="eliminarRecepcionCe(<?php echo $grupo ?>)"><i class="fa fa-trash"></i> Limpiar</a>
                        									</li>
                        									
                        								</ul>
                        				    </div>
                                          
                                          </td>
                                          
                                      </tr>
                                  </tbody>
                              </table> <br>
                             
                                        <div class="alert alert-success alert-dismissible fade in hidden" role="alert" id="alerify">
                                              <button type="button" class="close" ><span aria-hidden="true" id="closealert">×</span>
                                              </button>
                                              <strong id="pacte"></strong>
                                          </div>
                                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridEmerge"> 
                                            <form id="formid" action="#" method="post">
                                                            <input type="hidden" id="audiAsgt" name="audiAsgt" class="form-control">
                                                            <table class="table jambo_table bulk_action compact"  id="pac3EmerCE" >
                                                                <thead>
                                                
                                                                  <tr class="headings" style="font-size: 10px;">
                                                                         <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">OPCIONES</th>
                                                                         <th class="asg" style="text-transform: uppercase;text-align: center;">ASIGNACION
                                                                         <input type="checkbox" id="alla"/></th>
                                                                         <th class="rey" style="text-transform: uppercase;text-align: center;">RECEPCION
                                                                         <input type="checkbox" id="allr"/></th>
                                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">USUARIO</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">_____NRO_FUA_____</th>
                                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">HISTORIA</th>
                                                                    <th class="column-title"  style="width: 160px;text-transform: uppercase;text-align: center;vertical-align: inherit;">NRO_DOC</th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">______SEGURO______</th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">______ASEGURADORA______</th>
                                                                     <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">_______SERVICIO_______</th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">SEXO</th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">CUENTA</th>
                                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">AFILIACION</th>
                                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">ESTABLECIMIENTO_DE_SALUD</th>                           
                                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">_____APELLIDOS_Y_NOMBRES_PACIENTE_____</th>         
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">FAMILIAR</th>
                                                                       <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">____EDAD____</th>
                                                                       <th class="column-title"  style="width: 160px;text-transform: uppercase;text-align: center;vertical-align: inherit;">_______DESTINO_______</th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">ALTA/REF/CONTRA</th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">_________PABELLON_________</th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">FECHA_INGRESO</th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">FECHA_ALTA</th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">VALOR_MEDIC_INSU</th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">VALOR_PROC_LAB</th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">VALOR_ATENCION</th>
                                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">_______OBSERVACIONES_______</th>
                                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">___REGISTRO___</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">ACTUALIZACION</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">COD_PRES</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">DX_1</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">CL_1</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">TIPO_DX</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">DX_2</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">CL_2</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">TIPO_DX</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">DX_3</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">CL_3</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">TIPO_DX</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">DX_4</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">CL_4</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">TIPO_DX</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">DX_5</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">CL_5</th>
                                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">TIPO_DX</th>
                                                                 
                                                                     
                                                                
                                                                  </tr>
                                                                </thead>
                                                              
                                                              </table>
                                            </form>
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
        
        <div class="modal fade bs-example-modal-smEmergenciaCE" tabindex="-1" id="myModalCeA" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background: #337ab7;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                           
                                    <div class="form-group">
                                          <h4 class="modal-title">REGISTRO PACIENTE CONSULTA EXTERNA</h4>
                                    </div>
                                </div>
                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formPacienteEmergenCE" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                  
                                  <input type="hidden" name="iduserCE" value="<?php echo $iduser ?>" id="iduserCE">
                                  <input type="hidden" name="ideCE" id="ideCE">
                                   <input type="hidden" name="grupo" id="grupo" value="<?php echo $grupo ?>">
                                    <div class="form-group">
                                        
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">N° FUA</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                             <input type="text" class="form-control" name="fuaCE" id="fuaCE" maxlength="16" required="required" tabindex="1" value="6207-" >
                                        </div>
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">HISTORIA</label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                             <input type="text" class="form-control" name="hisCliCE" id="hisCliCE" maxlength="11" required="required" tabindex="2" >
                                        </div> 
                                    </div>
                                 
                                  <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">TIPO DOC</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                          <select class="form-control" name="tipoDocCE" id="tipoDocCE" required="required" tabindex="3" >                   
                                                <option value="DNI">DNI</option>
                                                <option value="Carnet Ext.">Carnet Ext.</option>
                                                <option value="Pasaporte">Pasaporte</option>
                                                <option value="Codigo recien nacido (CUI)">Codigo recien nacido (CUI)</option>
                                                <option value="Doc. Ident. Extranjera">Doc. Ident. Extranjera</option>
                                                <option value="Sin Doc.">Sin Doc.</option>
                                          </select>
                                        </div>

                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">N° DOC. <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                          <div class="input-group" style="margin-bottom:0px;">
                                             <input type="text" class="form-control" name="NroDocCE" id="NroDocCE" maxlength="11" required="required" tabindex="4" >
                                             <span class="input-group-btn">
                                              <button type="button" class="btn btn-primary" id="cargaDniCE"><i class="fa fa-search"></i></button>
                                             </span>
                                                      
                                           </div>
                                        </div> 
                                    </div>
                                     <script>
                                      $(document).ready(function(){
                                          $("select[name=seguros]").change(function(){
                                                    var dat = $('select[name=seguros]').val();
                                                    if(dat=="11"){
                                                      $( "#textSeg" ).removeClass( "hidden");
                                                      $( "#listseg" ).removeClass( "hidden");
                                                     
                                                    }else{
                                                       $( "#textSeg" ).addClass( "hidden");
                                                      $( "#listseg" ).addClass( "hidden");
                                                    }
                                                    
                                                });
                                        });
                                    </script>
                                     <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">NOMBRES  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" required="required" name="nombresCE" id="nombresCE" >
                                      </div>

                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA NAC.  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                          <input type="date" class="form-control" required="required"  name="FechaNacCE" min='2001-01-31' max='2030-12-31' tabindex="122" id="FechaNacCE" onchange="handlerEdad(event);"  >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">AP. PATERNO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" required="required"  name="apepaCE" id="apepaCE" >
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">AP. MATERNO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                          <input type="text" class="form-control" required="required" name="apemaCE" id="apemaCE" >
                                        </div>
                                    </div>
                                   
                                    <div class="form-group hidden">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">SEGURO<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <select class="form-control" name="seguros" id="seguros" required="required" tabindex="" >
                                                           
                                                          </select>
                                                        </div>
                                     
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12 hidden" id="textSeg">ASEGURADORA</label>
                                          <div class="col-md-4 col-sm-12 col-xs-12 hidden" id="listseg">
                                                <select class="form-control" name="listaSeguros" id="listaSeguros" required="required" tabindex=""> 
                                                
                                                </select>
                                            </div>
                                    </div>
                                    <script>
                                         $(document).ready(function(){
                                                
                                                	$( "#ubicacionCE" ).change(function() {
                                                	    var idDis = $("#ubicacionCE").val();	
                                                		cargarCodpre(idDis);
                                                	});
                                                    
                                        });
                                    </script>
                                   
                                    <div class="form-group">
                                             <label class="control-label col-md-2 col-sm-3 col-xs-12">SERVICIO</label>
                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                <select class="form-control" name="ubicacionCE" id="ubicacionCE" required="required" tabindex="5" style="text-transform: uppercase;"> 
                                                </select>
                                                 
                                            </div>
                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">CODIGO_PRES</label>
                                            <div class="col-md-1 col-sm-12 col-xs-12">
                                                <input type="text" class="form-control" required="required" name="coPre" id="coPre"   readonly >
                                            </div>
                                          <label class="control-label col-md-1 col-sm-3 col-xs-12">SEXO</label>
                                          <div class="col-md-2 col-sm-12 col-xs-12" style="width: 155px;">
                                                <select class="form-control" name="sexoCE" id="sexoCE" required="required" tabindex="">
                                                        <option value="">-- Seleccionar --</option>
                                                        <option value="MASCULINO">MASCULINO</option>
                                                        <option value="FEMENINO">FEMENINO</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            
                                     
                                    </div>
                                  
                                    <div class="form-group hidden">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">CUENTA</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12" id="inputel">
                                        <input type="text" class="form-control" required="required" name="cuenta" id="cuenta"  >
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">NRO AF.  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                          <input type="text" class="form-control" required="required" name="NroAf" id="NroAf" >
                                        </div>
                                    </div>
                                    <div class="form-group hidden">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">EESS</label>
                                      <div class="col-md-9 col-sm-12 col-xs-12" id="inputel">
                                        <input type="text" class="form-control" required="required"  name="eess" id="eess" tabindex="17" >
                                      </div>
                                      
                                    </div>
                                   
                                    <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12 hidden" id="telefam">TELF. FAMILIAR</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12 hidden" id="inputel">
                                        <input type="text" class="form-control" required="required" name="telefa" id="telefa"  >
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">EDAD</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                          <input type="text" class="form-control" required="required" name="edadCE" id="edadCE" >
                                        </div>
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">FECHA ATENCION</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12" id="inputel">
                                        <input type="date" class="form-control" required="required" name="feingreCE" id="feingreCE" tabindex="6" >
                                      </div>
                                    </div>
                                    <script>
                                      $(document).ready(function(){
                                          $("select[name=espost]").change(function(){
                                                    var dat = $('select[name=espost]').val();
                                                    if(dat=="1"){
                                                      $( "#idfa" ).removeClass( "hidden");
                                                      $( "#idfa" ).text("F. ALTA");
                                                      $( "#fallecido" ).removeClass( "hidden");
                                                      $( "#viewTextPabellon" ).addClass( "hidden");
                                                      $( "#viewListPabellon" ).addClass( "hidden");
                                                       $( "#idreF" ).addClass( "hidden");
                                                    $( "#inputRef" ).addClass( "hidden");
                                                    }else if(dat=="2"){
                                                      $( "#idfa" ).removeClass( "hidden");
                                                      $( "#idfa" ).text("F. FALLECIDO");
                                                      $( "#fallecido" ).removeClass( "hidden");
                                                       $( "#viewTextPabellon" ).addClass( "hidden");
                                                      $( "#viewListPabellon" ).addClass( "hidden");
                                                        $( "#idreF" ).addClass( "hidden");
                                                    $( "#inputRef" ).addClass( "hidden");
                                                    }else if(dat=="3"){
                                                      $( "#idfa" ).addClass( "hidden");
                                                      $( "#idfa" ).text("PABELLONES");
                                                      $( "#fallecido").addClass( "hidden");
                                                      $( "#viewTextPabellon" ).removeClass( "hidden");
                                                      $( "#viewListPabellon" ).removeClass( "hidden");
                                                      $( "#idreF" ).addClass( "hidden");
                                                      $( "#inputRef" ).addClass( "hidden");
                                                      
                                                       
                                                    }else if(dat=="4"){
                                                      $( "#idreF" ).removeClass( "hidden");
                                                      $( "#idreF" ).text( "N° REFERENCIA");
                                                      $( "#inputRef" ).removeClass( "hidden");
                                                      $( "#idfa" ).addClass( "hidden");
                                                      $( "#fallecido").addClass( "hidden");
                                                      $( "#viewTextPabellon" ).addClass( "hidden");
                                                      $( "#viewListPabellon" ).addClass( "hidden");
                                                    }else if(dat=="5"){
                                                      $( "#idreF" ).removeClass( "hidden");
                                                      $( "#inputRef" ).removeClass( "hidden");
                                                      $( "#idreF" ).text( "N° CONTRAREF.");
                                                      $( "#idfa" ).addClass( "hidden");
                                                      $( "#fallecido").addClass( "hidden");
                                                      $( "#viewTextPabellon" ).addClass( "hidden");
                                                      $( "#viewListPabellon" ).addClass( "hidden");
                                                    }else{
                                                      $( "#idfa" ).addClass( "hidden");
                                                      $( "#fallecido" ).addClass( "hidden");
                                                      $( "#idreF" ).addClass( "hidden");
                                                      $( "#inputRef" ).addClass( "hidden");
                                                      $( "#viewTextPabellon" ).addClass( "hidden");
                                                      $( "#viewListPabellon" ).addClass( "hidden");
                                                    }
                                                    
                                                });
                                        });
                                    </script>
                                  <div class="form-group hidden">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">DESTINO</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                      <select class="form-control" name="espost" id="espost" required="required" >                   
                                                   
                                                  </select>
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12 hidden" id="idfa">F. </label>
                                        <div class="col-md-4 col-sm-12 col-xs-12 hidden" id="fallecido">
                                                  <input type="date" class="form-control" required="required" name="fefa" id="fefa" >
                                      </div>
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12 hidden" id="idreF">NRO REFERIDO</label>
                                        <div class="col-md-4 col-sm-12 col-xs-12 hidden" id="inputRef">
                                                  <input type="text" class="form-control" required="required" name="referido" id="referido" >
                                        </div>
                                        <label for="title" class="col-sm-2 control-label hidden" id="viewTextPabellon">PABELLONES</label>
                                            <div class="col-sm-4 hidden" id="viewListPabellon">
                                                <select class="form-control" name="pabellones" id="pabellones" style="text-transform: uppercase;" required="required" >
                                                </select>
                                            </div>
                                    </div>
                                     <div class="form-group">
                                      
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12 hidden">FECHA ALTA</label>
                                        <div class="col-md-4 col-sm-12 col-xs-12 hidden">
                                          <input type="date" class="form-control" required="required"  name="feAlta" id="feAlta" >
                                        </div>
                                    </div>
                                   <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">VALORIZADO MEDIC-INSU</label>
                                      <div class="col-md-2 col-sm-12 col-xs-12" id="inputel">
                                        <input type="text" class="form-control" required="required" name="monGalCE" id="monGalCE" tabindex="7" >
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">VALORIZADO PROC-LAB</label>
                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                          <input type="text" class="form-control" required="required"  name="montSifCE" id="montSifCE" tabindex="8" >
                                        </div>
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">VALORIZADO ATENCION</label>
                                          <div class="col-md-2 col-sm-12 col-xs-12" id="inputel">
                                            <input type="text" class="form-control" required="required" name="valAte" id="valAte"  readonly >
                                          </div>
                                    </div>
                                    
                                    <!-- INICIO DE AUDITORIA -->
                                    
                                    <?php  if($iduser !="33" && $iduser !="43" && $iduser !="83" && $iduser !="48" && $iduser !="102" && $iduser !="110" && 
                                    $iduser !="98" && $iduser !="99" && $iduser !="111" && $iduser !="94" && $iduser !="16" && $iduser !="118" && $iduser !="54" && $iduser !="61"
                                    && $iduser !="119"  && $iduser !="120" && $iduser !="121" && $iduser !="122" && $iduser !="123" && $iduser !="124" && $iduser !="128"){ ?>
                                    
                                    <div class="form-group">
                                       <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">CIE10_1</label>
                                      <div class="col-md-8 col-sm-12 col-xs-12" id="inputel">
                                        <input type="text" class="form-control" required="required" name="cie10_1x" id="cie10_1x" tabindex="9" style="text-transform: uppercase;" >
                                      </div>
                                      <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                      <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                            <select class="form-control" name="tip1" id="tip1" required="required" tabindex="10">
                                                    <option value="D">D</option>
                                                    <option value="P">P</option>
                                            </select>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">CIE10_2</label>
                                      <div class="col-md-8 col-sm-12 col-xs-12" id="inputel">
                                        <input type="text" class="form-control" required="required" name="cie10_2x" id="cie10_2x" tabindex="11" style="text-transform: uppercase;" >
                                      </div>
                                      <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                      <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                            <select class="form-control" name="tip2" id="tip2" required="required" tabindex="12">
                                                    <option value="D">D</option>
                                                    <option value="P">P</option>
                                            </select>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">CIE10_3</label>
                                      <div class="col-md-8 col-sm-12 col-xs-12" id="inputel">
                                        <input type="text" class="form-control" required="required" name="cie10_3x" id="cie10_3x" tabindex="13" style="text-transform: uppercase;" >
                                      </div>
                                      <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                      <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                            <select class="form-control" name="tip3" id="tip3" required="required" tabindex="14">
                                                    <option value="D">D</option>
                                                    <option value="P">P</option>
                                            </select>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">CIE10_4</label>
                                      <div class="col-md-8 col-sm-12 col-xs-12" id="inputel">
                                        <input type="text" class="form-control" required="required" name="cie10_4x" id="cie10_4x" tabindex="15" style="text-transform: uppercase;" >
                                      </div>
                                      <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                      <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                            <select class="form-control" name="tip4" id="tip4" required="required" tabindex="16">
                                                    <option value="D">D</option>
                                                    <option value="P">P</option>
                                            </select>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">CIE10_5</label>
                                      <div class="col-md-8 col-sm-12 col-xs-12" id="inputel">
                                        <input type="text" class="form-control" required="required" name="cie10_5x" id="cie10_5x" tabindex="17" style="text-transform: uppercase;" >
                                      </div>
                                      <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                      <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                            <select class="form-control" name="tip5" id="tip5" required="required" tabindex="18">
                                                    <option value="D">D</option>
                                                    <option value="P">P</option>
                                            </select>
                                       </div>
                                    </div>
                                    
                                    
                                    <div class="form-group" >
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">OBSERVACIONES</label>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                          <textarea class="form-control" name="obsResCE" id="obsResCE" rows="6" style="text-transform: uppercase;" tabindex="19" ></textarea>
                                        </div>
                                    </div>
                                    
                                   
                                    
                                    <!-- FIN DE PERMISO -->
                                    
                                    <div class="modal-footer">
                                      
                                      <button type="button" class="btn btn-default" id="" onclick="prevForm();"   style="border: 1px solid #9d9d9d;">ANTERIOR</button>
                                      <button type="button" class="btn btn-default" id="" onclick="nextForm();"   style="border: 1px solid #9d9d9d;">SIGUIENTE</button>
                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="RegistrarPacienteEmCE();" tabindex="20" >GUARDAR</button>                                      
                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrar">CERRAR</button>
                                    </div>
                                    
                                     <?php } ?>
                                    
                                    <?php if($rol==2){ ?>
                                     <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" id="GuardateetrPaciente" onclick="RegistrarPacienteEmCETecnico();" tabindex="10" >GUARDAR</button>
                                     </div>
                                    <?php } ?>
                                    
                                </div>
                              </div>
                            </div>
                            </form>
                    </div>
                  </div>
        <!-- FIN EMERFENCIAS -->
        
        
        <!-- FORM GRUPO -->

                <div class="modal fade bs-example-modal-frmGroup" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                                <div class="modal-header" style="background:#26b99a;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="titlePaixk"></h4>
                                </div>
                                <div class="modal-body">
                        
                                  <form class="formulario form-horizontal form-label-left input_mask" method="POST" id="formGp">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                     <input type="hidden" name="ideCod" id="ideCod">         
                                              <div class="form-group">
                                                  <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: center;">CARTA </label>                               
                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                     <input type="text" class="form-control" required="required" name="cartaOficio" id="cartaOficio" style="text-transform: uppercase;">
                                                     <br>
                                                  </div>                     
                                              </div>
                                              <div class="form-group">
                                                  <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: center;">OFICIO</label>                               
                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                     <input type="text" class="form-control" required="required" name="ofix" id="ofix" style="text-transform: uppercase;">
                                                     <br>
                                                  </div>                     
                                              </div>
                                              <div class="form-group" >
                                                  <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: center;">TIPO PNT</label>
                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                              <select class="form-control" name="pnt" id="pnt" required="required" tabindex="1" >
                                                                          <option value="1">TERCERIZADO</option>
                                                                          <option value="2">SUBCOMPONENTE PRESTACIONAL</option>
                                                                </select>
                                                  </div>                             
                                              </div>
                                              <div class="form-group" >
                                                  <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: center;">IAFA</label>
                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                              <select class="form-control" name="tipoSeguro" id="tipoSeguro" required="required" tabindex="1" >
                                                                          <option value="1">SIS</option>
                                                                          <option value="2">FISSAL</option>
                                                                </select>
                                                  </div>                             
                                              </div>
                                              <div class="form-group" >
                                                  <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: center;">OBSERVACION</label>
                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                              <textarea name="obGru" id="obGru" class="form-control" rows="2"></textarea>
                                                  </div>                             
                                              </div>
                                    
                                  </form>
                                </div>
                                <div class="modal-footer" id="el" style="margin-top: 14px;"> 
                                  
                                      <button type="button" class="btn btn-danger" id="RgGroup" onclick="generarCodigo();" >Guardar</button>                                      
                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraEfec">CERRAR</button>
                                  </div>
                                
                         
                           </div>
                    </div>
            </div>



        <!-- CLOSE GRUPO -->
        
        
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
   