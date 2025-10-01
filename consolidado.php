 <?php 


error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Debes iniciar sesión para continuar.'); window.location='index.php';</script>";  
  exit;
} 


include_once ('./../config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");

include 'Vistas/librerias.php';  

$tipoEv = $_GET['tipo']; 
$tile="";
if($tipoEv==1){
    $tile="HOSPITALIZACION";        
}else if($tipoEv==2){
    $tile="EMERGENCIA";        
}else if($tipoEv==3){
    $tile="CONSULTA EXTERNA";        
}

?>

<style>
    
    table.dataTable tbody tr.selected {
        background-color: #0d4fcd !important;
        color: white;
    }

</style>

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
                              filtroAuditorCpms()
                              
                              $("#montgal").on({
                                      "focus": function(event) {
                                        $(event.target).select();
                                      },
                                      "keyup": function(event) {
                                        $(event.target).val(function(index, value) {
                                          return value.replace(/\D/g, "")
                                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                                            //.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                                        });
                                      }
                                });
                                
                                
                                $("#montsifar").on({
                                      "focus": function(event) {
                                        $(event.target).select();
                                      },
                                      "keyup": function(event) {
                                        $(event.target).val(function(index, value) {
                                          return value.replace(/\D/g, "")
                                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                                            //.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                                        });
                                      }
                                });
                                
                                
                                    
                                    
                                    

                                      $(".filter").remove();
                                      
                                      setTimeout(function (){
                                            ordenarSelect('Nopos');
                                    }, 10000);
                                      
                                     
                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;
                                              
                                        
                               
                          var to = getParameterByName('tipo');var lin ='';
                         
                          if(to=="1"){
                              lin= "ImportarCuenta.php?id=";
                              ar = [0,1,3,4,5,6,7,8,10,12,13,14,15,16,17,18,19];
                              $("#feReso").text("INGRESO");
                          }else if(to=="2"){
                              lin= "ImportarCuenta2.php?id=";
                               ar = [0,1,3,4,5,6,7,8,10,12,13,14,15,16,17,18,19];
                               $("#feReso").text("INGRESO");
                          }else if(to=="3"){
                              lin= "ImportarCuenta3.php?id=";
                               ar = [0,1,3,4,5,6,7,10,12,13,14,15,16,17,18,19];
                               $("#feReso").text("ATENCION");
                          }
                        
                        
                                     $('#pac3').on('dblclick', 'tbody tr', function () {
                                       var row = table.row($(this)).data();
                                         //console.log(row.idPac);
                                         jQuery.noConflict();
                                         
                                         if(to=="1"){
                                                $('#myModalConsolidado').modal("show");
                                                verImpos(row.idPac);
                                          }else if(to=="2"){
                                              $(location).attr('href','ImportarCuenta2.php?id='+row.idPac,'_blank')
                                          }else if(to=="3"){
                                              $(location).attr('href','ImportarCuenta3.php?id='+row.idPac,'_blank')
                                          }
                                          
                                          
                                    }); 

                                var table = $('#pac3').DataTable( {
                                    
                                              
                                                      "bProcessing": true,
                                                      "serverSide": true,
                                                      "order": [[ 2, "desc" ]],                                  
                                                      "sPaginationType":"full_numbers",
                                                      "iDisplayLength": 20,
                                                      "lengthChange": false,
                                                      "dom": '<"top">rt<"bottom"iflp><"clear">',
                                                      "ajax":{
                    
                                                          url : "./Controlador/search.php?function=listConCpmsAuditoria&tipo="+to, // json
                                                          type: "POST",  // type of method   
                                                          data: function(data){
                                                                                
                                                                    var listAuditorCpms = $('#listAuditorCpms').val();
                                                                    data.listAuditorCpms = listAuditorCpms;
                                                                    
                                                                     var estadoCpms = $('#estadoCpms').val();
                                                                     data.estadoCpms = estadoCpms;
                                                                    
                                                                     data.desdeFech = $('#desdeFech').val();
                                                                     data.maxFech = $('#maxFech').val();
                                                                    
                                                                                
                                                            },
                                                          error: function(){  
                                                          }
                    
                                                        },

                                                    
                                                  "columnDefs": [
                                                    { targets: ar, visible: true},
                                                    { targets: '_all', visible: false },
                                                    {
                                                      className: "dt-left",
                                                      "targets": [5,6] 
                                                  },{
                                                    className: "dt-right",
                                                    "targets": [12,13,14] 
                                                  },
                                            //
                                                  {
                                                      className: "dt-center",
                                                      "targets": [0,1,2,3,4,7,8,9,10,11,14,15,16,17,18,19]
                                                  }],
                                                  
                                                  "aoColumns": [

                                                        //{ mData: 'estado' },
                                                        { mData:null,"render": function ( data, type, full, meta ) {
                                                                if(data.estado=="GENERADO"){
                                                                    return '<a class="btEdit btn btn-warning btn-xs" style="color:#f0ad4e;">.</a>';
                                                                }else if(data.estado=="PENDIENTE"){
                                                                    return '<a class="btEdit btn btn-warning btn-xs" style="color:#f0ad4e;">.</a>';
                                                                }else if(data.estado=="ENVIADO"){
                                                                    return '<a class="btEdit btn btn-success btn-xs" style="color:#26b99a;">.</a>';
                                                                }
                                                            }
                                                        },
                                                        { mData: 'AUDITOR' },
                                                        { mData: 'idPac'},
                                                        { mData: 'nroFua' },
                                                        { mData: 'nroCuenta' },
                                                        { mData: 'PAX' },
                                                       // { mData: 'SERV' },
                                                        
                                                        { mData:null,"render": function ( data, type, full, meta ) {
                                                                if(data.tipoEval=="2" ){
                                                                    return data.SEI;
                                                                }else{
                                                                    return data.SERV;
                                                                }
                                                            }
                                                        },
                                                        
                                                        { mData: 'fein' },
                                                        { mData: 'fealMed' },
                                                        { mData: 'F_Alta_Medica' },
                                                        { mData: 'Historia' },
                                                        { mData: 'GESTION' },
                                                        { mData: 'montogal' },
                                                        { mData: 'montosisfar' },
                                                        { mData: 'valorFinal' },
                                                        { mData: 'fetAudit' },
                                                        { mData:null,"render": function ( data, type, full, meta ) {
                                                                //if(data.DIGITADO != null && data.DIGITADO != ""){
                                                                if(data.DIGITADO == "1") {
                                                                    return '<a  style="font-weight: bolder;color: white;" ><i class="fa fa-check" style="font-size: 20px;color: #26b99a;cursor: pointer;"></i></a>';
                                                                }else {
                                                                    return '';
                                                                }
                                                            }
                                                        },
                                                        { mData:null,"render": function ( data, type, full, meta ) {
                                                                //if(data.ARCHIVADO != null && data.ARCHIVADO != ""){
                                                                if(data.ARCHIVADO == "1"){
                                                                    return '<a  style="font-weight: bolder;color: white;" ><i class="fa fa-check" style="font-size: 20px;color: #26b99a;cursor: pointer;"></i></a>';
                                                                }else{
                                                                    return '';
                                                                }
                                                            }
                                                        },
                                                        
                                                        { mData:null,"render": function ( data, type, full, meta ) {
                                                                if(data.fileCpms!="" && data.fileCpms!=null){
                                                                    return '<a style="color: white;" target="_blank" href="./pdfCPMS/'+data.fileCpms+'"><img style="width: 15px;" src="images/pdf.png"></a>';
                                                                }else{
                                                                    return '';
                                                                }
                                                            }
                                                        },
                                                        
                                                        { mData:null,"render": function ( data, type, full, meta ) { 
                                                            
                                                        
                                                            var idus ='<?php echo $iduser ?>';var elim='';
                                                            
                                                            if(idus== "80" || idus== "11" || idus== "1"  || idus== "12" || idus== "87" || idus== "88" ){
                                                                elim='<li><a onclick="eliminarCpmsHnal('+data.idPac+')" style="color: red;font-weight: 800;"><i class="fa fa-close"></i>  Eliminar</a></li>';
                                                            }
                                                        
                                                         
                                                            if(to==1){
                                                                 return '<div class="btn-group" style="margin-bottom: 5px;"><button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs"'
                                                                + 'dropdown-toggle btn-xs" type="button" aria-expanded="true"> <span class="caret"></span> </button>'
                                    							+ '<ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">'
                                    							+ '<li><a onclick="verImpos('+data.idPac+')" title="Editar" data-toggle="modal" data-target=".bs-example-modal-sm" ><i class="fa fa-edit"></i> Editar </a></li>'
                                    							+ '<li><a href="'+lin+data.idPac+'" ><i class="fa fa-cogs"></i> Procesar</a></li>'
                                    							+ '<li><a target="_blank" href="imprimir.php?id='+data.idPac+'" ><i class="fa fa-file-pdf-o"></i> Imprimir</a></li>'
                                    							+ elim +'</ul></div>';
                                                            }else {
                                                                 return '<div class="btn-group" style="margin-bottom: 5px;"><button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs"'
                                                                + 'dropdown-toggle btn-xs" type="button" aria-expanded="true"> <span class="caret"></span> </button>'
                                    							+ '<ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">'
                                    							+ '<li><a href="'+lin+data.idPac+'" ><i class="fa fa-cogs"></i> Procesar</a></li>'
                                    							+ '<li><a target="_blank" href="imprimir.php?id='+data.idPac+'" ><i class="fa fa-file-pdf-o"></i> Imprimir</a></li>'
                                    							+ '<li><a onclick="revertirCEHnal('+data.idPac+')" ><i class="fa fa-retweet"></i>  Revertir</a></li>'
                                    							+ elim +'</ul></div>';
                                                            }
                                                        }},
                                                        
                                                        { mData: 'fechaReporte' },
                                                        { mData: 'codPre' },
                                                        { mData: 'obsCpms' },
                                                    
                                                        
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
                                                    /*initComplete: function() {

                                                      // 1 filtro
                                                      var column2 = this.api().column(1);
                                                      var select2 = $('<select class="form-control filter" id="Nopos" style="text-transform: uppercase;"><option value="">Todos</option></select>')
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

                                                    } */
                                                      // fin 1 filtro
                                                      
                                                      
                                                     
                                                      
                                                    
                                                  });
                                      

                                  

                                        $('#pac3_filter').addClass('form-group');
                                        $('#pac3_filter').css('text-align','left');
                                        $('#pac3_filter').css('display','none');
                                       $('.dt-buttons').css('float','right');
                                       $('#pac3_paginate').css('width','100%');
                                       
                                       // $('.dt-buttons').css('display','none');
                                        $('.dt-buttons').css('margin-top','-53px');
                                        $('#pac3_filter label input').addClass('form-control');
                                        $('#pac3_length label select').addClass('form-control');

                                        $('#busXQeX').on( 'keyup', function () {
                                            table.search( this.value ).draw();
                                        } );


                                     /*   $("#minCie109").datepicker({
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
                                                    aData._date = new Date(aData[17]).getTime(); 
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
                                              );*/
                                              
                                              
                                                $('#listAuditorCpms').change(function(){
                                                     table.draw();
                                                                    
                                                });
                                                
                                                
                                                 $('#estadoCpms').change(function(){
                                                     table.draw();
                                                                    
                                                });
                                                
                                                
                                                $('#desdeFech').change(function(){
                                                     table.draw();
                                                                    
                                                });
                                                
                                                
                                                $('#maxFech').change(function(){
                                                     table.draw();
                                                                    
                                                });
                                                
                                                $('#pac3 tbody').on('click', 'tr', function () {
                                        
                                                      table.$('tr.selected').removeClass('selected');
                                                      $(this).addClass('selected');
                                                  
                                              });
                                       
                                    } );


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
                                <h2 style="text-transform: uppercase;">Lista de pacientes <?php echo $tile; ?><small></small></h2>
                                <button type="button" class="btn btn-success btn-xs">Auditado</button>
                                              <button type="button" class="btn btn-warning btn-xs">Pendiente</button>
                              
                                <div class="clearfix"></div>
                              </div>
                              

                              <div class="x_content ">
                             
                             <table border="0"  >
                                  <tbody>
                                  
                                      <tr>
                                          <td><label>Buscar:</label></td>
                                          <td><input name="busXQeX" id="busXQeX" type="text" class="form-control" placeholder="Cuenta, Historia, Nro Doc, Paciente" style="width: 270px;" ></td>
                                          <td><label style="margin-left:25px;margin-right: 5px;">Usuario:</label></td>
                                          <td> <select id='listAuditorCpms' class="form-control" ></select></td>
                                         
                                          <td><label style="margin-left:25px;margin-right: 5px;">Estado:</label></td>
                                          <td><select id='estadoCpms' class="form-control" >
                                              <option value="">TODOS</option>
                                              <option value="GENERADO">PENDIENTE</option>
                                              <option value="ENVIADO">AUDITADO</option>
                                          </select></td>
                                          <td ><label style="margin-left: 14px;">Desde:&nbsp;&nbsp;</label></td>
                                          <td ><input name="desdeFech" id="desdeFech"  type="date" class="form-control" placeholder="Fecha Inicio" autocomplete="off" ></td>
                                          <td><label>&nbsp;&nbsp;Hasta:&nbsp;&nbsp;</label></td>
                                          <td ><input name="maxFech" id="maxFech" type="date"  class="form-control" placeholder="Fecha final" autocomplete="off" ></td>
                                          <td>&nbsp;</td>
                                          
                                      </tr>
                                  </tbody>
                              </table><br>
                             
                                        <div class="alert alert-success alert-dismissible fade in hidden" role="alert" id="alerify">
                                              <button type="button" class="close" ><span aria-hidden="true" id="closealert">×</span>
                                              </button>
                                              <strong id="pacte"></strong>
                                          </div>
                                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridConso"> 
                                            <table class="table jambo_table bulk_action compact"  id="pac3" >
                                                <thead>
                                                  <tr class="headings" style="font-size: 10px;">
                                                    <th class="column-title"  style="text-transform: uppercase;text-align: center;">#</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">AUDITOR</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">ESTADO</th>
                                                    <th class="column-title"  style="width:120px;text-transform: uppercase;text-align: center;">FUA</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">CUENTA</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">_______PACIENTE_______</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">SERVICIO</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;" id="feReso">INGRESO</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">ALTA_MEDICA</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">F_Alta_Medica2</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">HISTORIA</th>                           
                                                    <th class="" style="text-transform: uppercase;text-align: center;">USUARIO_GESTION</th>    
                                                    <th class="" style="text-transform: uppercase;text-align: center;">GALENOS</th>    
                                                    <th class="" style="text-transform: uppercase;text-align: center;">SISFAR</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">TOTAL</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">FECHA_AUDIT</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">DIGITADO</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">ARCHIVADO</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;">PDF</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;">#</th>
                                                    <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;">COD_PRESTACIONAL</th>
                                                    <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;">COD_PRESTACIONAL</th>
                                                    <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;">OBSERVACION_AUDITORIA</th>
                                                    
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
        <?php 
        
        $tix = $_GET['tipo'];$req ='';
        if($tix ==2){
            $req ='readonly';
        }
        ?>
                                   

        <div class="modal fade bs-example-modal-sm" tabindex="-1" id="myModalConsolidado" role="dialog" >
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
                                                     <input type="hidden" name="tipoEval" value="<?php echo $tipoEv ?>" id="tipoEval">

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
                                                                    <input type="text" class="form-control" name="Nxuenta" id="Nxuenta" maxlength="11" required="required" tabindex="1"  <?php echo $req; ?> >
                                                                    <span class="input-group-btn">
                                                                        <button type="button" class="btn btn-primary" id="cargaCuenta"><i class="fa fa-search"></i></button>
                                                                    </span>
                                                                </div>
                                                              </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">H. CLINICA <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input type="text" class="form-control" name="hclinica" id="hclinica" maxlength="11" required="required" tabindex="2"  <?php echo $req; ?>  >
                                                            </div>
                                                          </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12" style="width: 93px;">TIPO DOC<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12" style="width:120px;">
                                                              <select class="form-control" name="tiDocA" id="tiDocA" required="required" tabindex="3"  <?php echo $req; ?>  style="text-transform: uppercase;">                   
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
                                                                    <input type="text" class="form-control" name="fua" id="fua" required="required" tabindex="4"  <?php echo $req; ?>  >
                                                                 
                                                                </div>
                                                              </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">N°DOC <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input type="text" class="form-control" name="dni" id="dni" maxlength="11" required="required" tabindex="5"  <?php echo $req; ?>  >
                                                            </div>
                                                          </div>
                                                      </div>
                                                     
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">PACIENTE  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="paciente" id="paciente" tabindex="6"  <?php echo $req; ?>  style="text-transform: uppercase;font-size: 12px;font-weight: 700;" >
                                                        </div>
                                                        <?php  
                                                                  if($tix =="1"){
                                                                  
                                                             ?>
                                                        <label class="control-label col-md-1 col-sm-3 col-xs-12">PABELLON<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-5 col-sm-12 col-xs-12">
                                                             <select class="form-control" name="servicio" id="servicio" required="required" tabindex="5" style="text-transform: uppercase;"> 
                                                                    </select>
                                                         
                                                        </div>
                                                       <?php } else{ ?>
                                                                     
                                                       <label class="control-label col-md-2 col-sm-3 col-xs-12">SERVICIO EGRESO</label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                                <input type="text" class="form-control" name="serEgre12" id="serEgre12" maxlength="11" required="required" tabindex="5" style="text-transform: uppercase;"  <?php echo $req; ?>  >
                                                            </div>
                                                       <?php } ?>
                                                       
                                                      </div>
                                                     
                                                      <div class="form-group">
                                                       
                                                      </div>
                                                       <script>
                                                             $(document).ready(function(){
                                                                    
                                                                    	$( "#ubiSerHosp" ).change(function() {
                                                                    	    var idDis = $("#ubiSerHosp").val();	
                                                                    		cargarCodpreHospi(idDis);
                                                                    	});
                                                                        
                                                            });
                                                        </script>
                                                      <div class="form-group">
                                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">COD_PRES</label>
                                                                <div class="col-md-1 col-sm-12 col-xs-12">
                                                                    <input type="text" class="form-control" required="required" name="codPreHos" tabindex="6" id="codPreHos"  style="width: 55px;"  >
                                                                </div>
                                                                 <label class="control-label col-md-2 col-sm-3 col-xs-12">DENOMINACION</label>
                                                                <div class="col-md-7 col-sm-12 col-xs-12">
                                                                    <select class="form-control" name="ubiSerHosp" id="ubiSerHosp" required="required" tabindex="7" style="text-transform: uppercase;"> 
                                                                    </select>
                                                                     
                                                                </div>
                                                                
                                                        </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">F. INGRESO<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                                          <input type="date" class="form-control" required="required"  name="feingreso" id="feingreso" tabindex="8"  <?php echo $req; ?>  >
                                                        </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">F. CORTE/ALTA  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                            <input type="date" class="form-control" required="required" name="fecorte" id="fecorte"  tabindex="9"   <?php echo $req; ?>  >
                                                          </div>
                                                           <?php  
                                                                  if($tix =="2"){
                                                                  
                                                             ?>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">PRIORIDAD <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                                    <select class="form-control" name="prioAudit" id="prioAudit" required="required" tabindex="7" style="text-transform: uppercase;"> 
                                                                            <option value="">Seleccionar</option>
                                                                            <option value="1">I</option>
                                                                            <option value="2">II</option>
                                                                            <option value="3">III</option>
                                                                            <option value="4">IV</option>
                                                                            
                                                                    </select>
                                                          </div>
                                                           <?php  }  ?>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">VALORIZADO MEDIC-INSU<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="montgal" id="montgal" tabindex="10"  <?php echo $req; ?>  >
                                                        </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">VALORIZADO PROC-LAB<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" name="montsifar" id="montsifar"  tabindex="11"  <?php echo $req; ?>   >
                                                          </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">VALORIZADO ATENCION</label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12" id="inputel">
                                                            <input type="text" class="form-control" required="required" name="valAteAudi" id="valAteAudi" readonly="">
                                                          </div>
                                                      </div>
                                                     
                                                      <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">OBSERVACIONES DE AUDITORIA</label>
                                                            <div class="col-md-9 col-sm-12 col-xs-12">
                                                              <textarea class="form-control" name="obsCpms" id="obsCpms" rows="6" style="text-transform: uppercase;" tabindex="12"></textarea>
                                                            </div>
                                                       </div>
                                                       <div class="form-group" >
                                                           <label class="control-label col-md-2 col-sm-3 col-xs-12" id="subAdj" style="font-size: 12px;">SUBIR ARCHIVO</label>
                                                          <div class="col-md-6 col-sm-12 col-xs-12" id="mostrAdj">
                                                                 <input type="file" name="fileCpms" id="fileCpms"  class="form-control" accept=".pdf" style="border: 1px solid white;margin-left: -15px;">
                                                          </div>
                                                        </div>
                                                      <!--<div class="form-group">
                                                        <label for="title" class="col-sm-2 control-label">AUDITOR</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control" name="asiAudi" id="asiAudi" style="text-transform: uppercase;" required="required" tabindex="8">
                                                            </select>
                                                        </div>
                                                      </div>-->
                                                     
                                    <br><br>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="RegistrarPac();" style="float: right;margin-bottom: 4%;" tabindex="13">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarpre">CERRAR</button>
                                                       </div>
                                                     </div>
                                                 </div>
                                              </div>
                                                    
                                         </form>

                                          </div>
                                    </div>   
                   </div>

               

               


        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>
   