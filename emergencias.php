<?php 
    
 
    
//error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Debes iniciar sesión para continuar.'); window.location='index.php';</script>";  
  exit;
} 

date_default_timezone_set('America/Lima');
include_once ('config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");

include 'Vistas/librerias.php';  
/*
$fchaHoy = date("Y-m-d");
$sel = new Pacientes();

$ni = $sel->verUserCierreConfirmacion($iduser,$fchaHoy);
$mueVer = $ni->fetch_assoc(); 
echo $mueVer["CNT"];*/

?>
<style>
    
    table.dataTable tbody tr.selected {
        background-color: #0d4fcd !important;
        color: white;
    }

</style>

<script type="text/javascript">
                               
                $(document).ready(function() {
                              
                               $("#monGal").on({
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
                                
                                
                                $("#montSif").on({
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
                                
                                
                                        $('#pac3Emer').on('dblclick', 'tbody tr', function () {
                  
                                              jQuery.noConflict();
                                              var row = table.row($(this)).data();
                                            
                                              $('#myModalsmEmergencia').modal("show");
                                              verPacienteEmergencia(row.idEm);
                                                 
                                                 
                                        });
                                        
                                
                                    
                                    
                                     /*  $('#pac3Emer tbody').on('click', 'tr', function () {
                                        
                                                      table.$('tr.selected').removeClass('selected');
                                                      $(this).addClass('selected');
                                                  
                                      });
                                    
                                    
                                       $('#pac3Emer').on('click', 'tr', function () {
                                        var name = $('td', this).eq(2).text();
                                        jQuery.noConflict();
                                        $('#myModalsmEmergencia').modal("show");
                                        alert(name);
                                    }); */
                                    


                                    filtroCargarPabellonesHos();
                                    
                                    filtroFinanciamento();
                                    filtroCargarServiciosIngreso();
                                    filtroCargarEspecialidadCE();
                                    var tipo = getParameterByName('tipo');
                                    filtroDestinos(tipo);
                                    var fi = getParameterByName('fi');
                                    var pa = getParameterByName('pa');
                                    var des = getParameterByName('des');
                                    var desde = getParameterByName('desde');
                                    var hasta = getParameterByName('hasta');
                                    var ser = getParameterByName('ser');
                                    var buscar = getParameterByName('buscar');
                                    
                                        setTimeout(function (){
                                                $("#fi").val(fi);$("#pa").val(pa);$("#des").val(des);$("#ser").val(ser);$("#buscar").val(buscar)
                                        }, 2000);
                                    
                                    var ar ='';var titleExcel ='';var exce='';
                                        if(tipo==1){
                                            ar = [0,1,2,3,4,5,6,7,10,11,12,13,14,15,16,17,18,19,20,21,30,31,34,35,46,48,50,52];
                                            exce=[1,2,3,4,5,6,10,11,12,13,14,15,16,17,18,19,20,21,30,31,34,35,46,48,50,52]
                                            titleExcel ='ReporteEmergencia-';
                                        }else if(tipo==2){
                                            ar = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,22,23,24,25,26,30,31,33,34,35,36,40,46,48,50,52]
                                            exce=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,22,23,24,25,26,30,31,33,34,35,36,40,46,48,50,52];
                                            titleExcel ='ReporteHospitalizacion-';
                                        }else if(tipo==3){
                                            ar = [0,1,2,3,4,5,6,7,13,14,15,17,30,31,46,48,51,52]
                                            exce=[1,2,3,4,5,6,7,13,14,15,17,30,31,46,48,51,52];
                                            titleExcel ='ReporteConsultaExterna-';
                                        }
                                        
                                    

                                      $(".filter").remove();

                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;

                                   
                                var table = $('#pac3Emer').DataTable( {
                                    
                                                  "bProcessing": true,
                                                  "sAjaxSource": "./Controlador/search.php?function=listEmergencias&tipo=" + tipo+"&fi="+fi+"&pa="+pa+"&des="+des+"&desde="+desde+"&hasta="+hasta+"&ser="+ser+"&buscar="+buscar,
                                                  "bPaginate":true,
                                                  "sPaginationType":"full_numbers",
                                                  "iDisplayLength":15,
                                                  "order": [0, "desc" ],
                                                  "columnDefs": [
                                                    { targets: ar, visible: true},
                                                    { targets: '_all', visible: false},
                                                    {
                                                      className: "dt-left",
                                                      "targets": [5] 
                                                  },{
                                                    className: "dt-right",
                                                    "targets": [] 
                                                  },
                                                  {
                                                      className: "dt-center",
                                                      "targets": [1,2,3,4,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,51,52]
                                                  }],
                                                  "aoColumns": [

                                                        { mData: 'opciones' },
                                                        { mData: 'status' },
                                                        { mData: 'cuenta' },
                                                        { mData: 'historiaClinica' },
                                                        { mData: 'nroFua'},
                                                        { mData: 'paciente'},
                                                        { mData: 'tipoDoc' },
                                                        { mData: 'nroDoc' },
                                                        { mData: 'sexo' },//8
                                                        { mData: 'edad' },
                                                        { mData: 'origenEmer' },//10
                                                        { mData: 'actras' },
                                                        { mData: 'FI' },
                                                        { mData: 'seguro' },
                                                        { mData: 'PS' },
                                                        { mData: 'fechaAful' },
                                                        { mData: 'feSolAte' },
                                                        { mData: 'fechaIngreso'},
                                                        { mData: 'fechaAlta' },
                                                        { mData: 'estancia' },//19
                                                        { mData: 'ubicacionDes' },
                                                        { mData: 'ubicacion' },
                                                        { mData: 'pabellon1' },
                                                        { mData: 'camaX1' },
                                                        { mData: 'pabellon2' },
                                                        { mData: 'camaX2' },
                                                        { mData: 'destino' },
                                                        { mData: 'M1' },
                                                        { mData: 'M2' },
                                                        { mData: 'TUO' },//29
                                                        { mData: 'montoGalenos' },
                                                        { mData: 'montoSisfar' },
                                                        { mData: 'monTotalCo' },
                                                        { mData: 'TUO' },
                                                        { mData: 'totali' },
                                                        { mData: 'rsatencion' },
                                                        { mData: 'reciAudit' },
                                                        { mData: 'segurosAl' },//37 
                                                        { mData: 'CUENSXRef' },
                                                        { mData: 'CUENSXRef2' },
                                                        { mData: 'CUENSX' },
                                                        { mData: 'CUENSX2' },
                                                        { mData: 'eessInicio' },//42
                                                        { mData: 'nvaCta' },
                                                        { mData: 'cuenta2' },
                                                        { mData: 'ctaHos' },
                                                        { mData: 'idUserRegistro' },
                                                        { mData: 'registraAlta' },
                                                        { mData: 'liquidador' },
                                                        { mData: 'fechaReporte' },//49
                                                        { mData: 'prioridad' },
                                                        { mData: 'regServiceCE' },
                                                        { mData: 'fechaRegistro' },
                                                       
                                                  ],

                                                  dom: '<fBtip>',
                                                  buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: titleExcel + output,
                                                            exportOptions: {
                                                              columns: exce
                                                            },
                                                            customize: function(xlsx) {
                                                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                                              $('row[r=2] c', sheet).attr('s', '47');
                                                          }
                                                          
                                                        } 
                                                        
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
                                                    /*  var column2 = this.api().column(11);
                                                      var select2 = $('<select class="form-control filter" style="text-transform: uppercase;"><option value="">Todos</option></select>')
                                                        .appendTo('#fenancia')
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
                                                      var column = this.api().column(21);
                                                      var select = $('<select class="form-control filter" style="text-transform: uppercase;"><option value="">TODOS</option></select>')
                                                        .appendTo('#pabellonFiltro')
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
                                                      var column33 = this.api().column(25);
                                                      var select33 = $('<select class="form-control filter" style="text-transform: uppercase;"><option value="">TODOS</option></select>')
                                                        .appendTo('#destinxoFiltro')
                                                        .on('change', function() {
                                                          var val33 = $(this).val();
                                                          column33.search(val33).draw()
                                                        });

                                                      var offices33 = []; 
                                                      column33.data().toArray().forEach(function(s) {
                                                          s = s.split(',');
                                                          s.forEach(function(d) {
                                                            if (!~offices33.indexOf(d)) {
                                                              offices33.push(d)
                                                              select33.append('<option value="' + d + '">' + d + '</option>');}
                                                          })
                                                      })
                                                        */
                                                      //fin filtro

                                                    },
                                                    
                                                      scrollY: "550px",
                                                      scrollX: true,
                                                      // fin 1 filtro
                                                    
                                                  });
                                      
                                      
                                      
                                     

                                        if(<?php echo $rol ?> =="5"){
                                             $('.dt-buttons').addClass('hidden');
                                        }

                                  

                                        $('#pac3Emer_filter').addClass('form-group');
                                        $('#pac3Emer_filter').css('text-align','left');
                                        $('#pac3Emer_filter').css('display','none');
                                        $('#pac3Emer_paginate').css('width','100%');
                                        $('.dt-buttons').css('float','right');
                                        $('.dt-buttons').css('margin-top','-18px');
                                        $('#pac3Emer_filter label input').addClass('form-control');
                                        $('#pac3Emer_length label select').addClass('form-control');

                                        $('#serc').on( 'keyup', function () {
                                            table.search( this.value ).draw();
                                        });
                                    
                                

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
                                                    aData._date = new Date(aData[49]).getTime(); 
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
                                              
                                              
                                             $('#pac3Emer tbody').on('click', 'tr', function () {
                                        
                                                      table.$('tr.selected').removeClass('selected');
                                                      $(this).addClass('selected');
                                                  
                                              });
                                              
                                              
                                                
                                         
                                       
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
                                  
                                   <?php $titlex ='';$tihocon='';
                                          $fi = $_GET['fi'];
                                          $pa = $_GET['pa'];
                                          $des = $_GET['des'];
                                          $desde = $_GET['desde'];
                                          $hasta = $_GET['hasta'];
                                          $tix = $_GET['tipo'];
                                          
                                          if($tix =="2"){
                                              $titlex ='HOSPITALIZACION';
                                              $tihocon='CUENTA HOSP.';
                                          }else if($tix =="1") {
                                              $titlex ='EMERGENCIA';
                                              $tihocon='CUENTA EMERG';
                                          }else if($tix =="3") {
                                              $titlex ='CONSULTA EXTERNA';
                                              $tihocon='CUENTA CE';
                                              
                                          }
                                          
                                        ?>
                                        
                                <h2 style="text-transform: uppercase;">ATENCIONES DE <?php echo  $titlex; ?> <small></small></h2>
                             
                                <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-smEmergencia" id="agr2" role="button" aria-expanded="false" 
                                style="float: right;" onclick="LimpiarFormEmer();"><i class="fa fa-edit m-right-xs"></i> Nuevo Registro</a>
                                
                              
                                <div class="clearfix"></div>
                              </div>
                              

                              <div class="x_content">
                             
                              <table border="0"  >
                                  <tbody>
                                  
                                      <tr>
                                          <form  id="" action="#" method="GET">
                                          <td><label>Buscar:</label></td>
                                          <td><input name="buscar" id="buscar" type="text" class="form-control" placeholder="Nro cuenta, Historia, Nro doc, Apellidos y nombres" autocomplete="off"></td>
                                          
                                             <input name="tipo" id="tipo" type="hidden" value="<?php echo $tix; ?>">
                                             <?php if($tix =="1"){ ?>
                                             <td><label style="margin-left:25px;margin-right: 5px;">Financia:</label></td>
                                              <td><select class="form-control" name="fi" id="fi"  tabindex="5"></select></td>
                                         
                                             <td><label style="margin-left:25px;margin-right: 5px;">Servicio:</label></td>
                                             <td><select class="form-control" name="ser" id="ser"  tabindex="5" style="width:180px;" ></select></td>
                                           <?php } else if($tix =="2") { ?>
                                                  <td><label style="margin-left:25px;margin-right: 5px;">Pabellon:</label></td>
                                                   <td><select class="form-control" name="pa" id="pa"  style="width:180px;" tabindex="5"></select></td>
                                          <?php } else if($tix =="3") { ?>
                                                    <td><label style="margin-left:25px;margin-right: 5px;">Especialidad:</label></td>
                                                   <td><select class="form-control" name="espe" id="espe" style="width:180px;"  tabindex="5"></select></td>
                                          <?php }  ?>
                                          <td><label style="margin-left:25px;margin-right: 5px;">Destino:</label></td>
                                          <td><select class="form-control" name="des" id="des"  tabindex="5"></select></td>
                                          
                                          <td ><label style="margin-left: 14px;">Desde:&nbsp;&nbsp;</label></td>
                                          <td ><input name="desde" id="desde" style="width: 115px;" type="date" value="<?php echo $desde ?>" class="form-control" placeholder="Fecha Inicio" autocomplete="off" ></td>
                                          <td><label>&nbsp;&nbsp;Hasta:&nbsp;&nbsp;</label></td>
                                          <td ><input name="hasta" id="hasta" type="date" style="width: 115px;" class="form-control" value="<?php echo $hasta ?>" placeholder="Fecha final" autocomplete="off" ></td>                                          
                                          <td style="width: 100px;"><button type="submit" class="btn btn-success" id="sa" style="margin-top: 5px;"><i class="fa fa-search"></i></button>
                                          <a href="./emergencias.php?tipo=<?php echo $tix ?>" class="btn btn-default" style="margin-top: 5px;margin-left: -8px;"><i class="fa fa-eraser"></i> </a>
                                         <!-- <a class="btn btn-warning" style="margin-top: 5px;margin-left: -8px;"><i class="fa fa-list"></i> </a>-->
                                          </td>
                                           </form>
                                          
                                          
                                           
                                      </tr>
                                       <?php if($tix =="3"){ ?>
                                          <tr id="cierreReport">
                                               <form class="form-inline" action="exportarCierre.php" method="POST" name="frmErrlImport" id="frmExrrrcelImport" enctype="multipart/form-data">
                                                   <input name="ux" id="ux" value="<?php echo $iduser ?>" type="hidden">
                                                   <td><label style="margin-left: 25px;">Desde: </label></td>
                                                   <td><input name="min" id="min" type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" placeholder="Fecha Inicio" autocomplete="off" readonly=""></td>
                                                   <td style="text-align: right;"><label >Hasta: </label></td>
                                                   <td><input name="max" id="max" type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" placeholder="Fecha final" autocomplete="off" readonly=""></td>
                                                   <td><button type="submit" name="procesar" id="cierreRegistro" class="btn btn-warning" style="margin-top: 5px;float: right;">
                                                       <i class="fa fa-file-excel-o"></i> Exportar cierre</button>
                                                    </td>
                                                </form>
                                                   
                                          </tr>
                                       <?php }  ?>
                                       <script type="text/javascript">
                                       (function() {
                                         var form = document.getElementById('frmExrrrcelImport');
                                         form.addEventListener('submit', function(event) {
                                           if (!confirm('Estas seguro de generar paquete ?')) {
                                             event.preventDefault();
                                           }
                                         }, false);
                                       })();
                                     </script>
                                  </tbody>
                              </table> <br>
                             
                                        <div class="alert alert-success alert-dismissible fade in hidden" role="alert" id="alerify">
                                              <button type="button" class="close" ><span aria-hidden="true" id="closealert">×</span>
                                              </button>
                                              <strong id="pacte"></strong>
                                          </div>
                                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridEmerge"> 
                                            <table class="table jambo_table bulk_action compact"  id="pac3Emer" style="width:100%" >
                                                <thead>
                                                 <tr class="headings" style="font-size: 10px;">
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">OPCIONES</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">ESTADO</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">CUENTA</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">HISTORIA</th>
                                                    <th class="column-title" style="text-transform:uppercase;text-align: center;vertical-align: inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N°&nbsp;&nbsp;FUA&nbsp;/&nbsp;N°&nbsp;&nbsp;CARTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">
                                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PACIENTE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>  
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">TIPO DOC</th>
                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">NRO DOC</th>
                                                    <th class="column-title"  style="width: 160px;text-transform: uppercase;text-align: center;vertical-align: inherit;">SEXO</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">&nbsp;&nbsp;&nbsp;&nbsp;EDAD&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">PROCEDENCIA</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">ACCID TRANSITO</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">FINANCIAMIENTO</th>
                                                
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IAFAS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                     <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PLAN&nbsp;&nbsp;SALUD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                     <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">F.&nbsp;&nbsp;AFILIACION</th>
                                                     <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">F.&nbsp;&nbsp;CADUCIDAD</th>
                                                    <?php  if($tix =="3"){ ?>
                                                        <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">FECHA&nbsp;&nbsp;ATENCION</th>
                                                     <?php } else { ?>
                                                        <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">FECHA&nbsp;&nbsp;INGRESO</th>
                                                     <?php }  ?>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">FECHA&nbsp;&nbsp;ALTA</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">ESTANCIA</th>
                                                     <?php $toles ='';$toles2="";$tie="";$ti2="";$th2="";
                                         
                                          
                                                          if($tix =="2"){
                                                              $toles ="CONSUMO&nbsp;&nbsp;HOSPI.";
                                                              $toles2 ="CONSUMO&nbsp;&nbsp;EMG.";
                                                              $tie="PAB. INGRESO | CAMA";
                                                              $ti2="PAB. EGRESO | CAMA";
                                                              $th2="HOSP.";
                                                          }else{
                                                             
                                                              $toles ="CONSUMO&nbsp;&nbsp;EMG.";
                                                              $toles2 ="CONSUMO&nbsp;&nbsp;HOSPI.";
                                                              
                                                          }
                                                          
                                                          $tie="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Serv&nbsp;&nbsp;Egreso&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                                          $ti2="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Serv&nbsp;&nbsp;Ingreso&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                                          
                                                        ?>
                                                                  
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;"><?php echo $ti2 ?></th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;"><?php echo $tie ?></th>                           
                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">PAB. INGRESO</th>
                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">CAMA</th>
                                                      <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">PAB. EGRESO</th>
                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">CAMA</th>
                                                     <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">DESTINO</th>
                                                     <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">M.&nbsp;&nbsp;GALENOS&nbsp;&nbsp;EMERG.</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">M.&nbsp;&nbsp;SISFAR&nbsp;&nbsp;EMERG.</th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">CONSUMO&nbsp;&nbsp;EMG.</th>
                                                    
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">M.&nbsp;&nbsp;GALENOS&nbsp;&nbsp;<?php echo $th2 ?></th>
                                                    <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">M.&nbsp;&nbsp;SISFAR&nbsp;&nbsp;<?php echo $th2 ?></th>
                                                     
                                                       <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;"><?php echo $toles ?></th>
                                                       <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;"><?php echo $toles2 ?></th>
                                                       
                                                       
                                                       
                                                        <th class="column-title" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">CONSUMO&nbsp;&nbsp;TOTAL.</th>
                                                        
                                                      
                                                       <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RESPONSABLE&nbsp;&nbsp;ATENCION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                  
                                                     
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AUDITOR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">ASEGURADORA</th>
                                                   
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EE.SS&nbsp;&nbsp;REF.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">NRO_REF.</th>
                                                      <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EE.SS&nbsp;&nbsp;CONTRARREF.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">NRO_CONTRARREF.</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">ESTABLECIMIENTO_REFERENCIA</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">NVO&nbsp;&nbsp;FINANC.</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">CTA&nbsp;&nbsp;EMERG.</th>
                                                   <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">CTA&nbsp;&nbsp;HOSP.</th>
                                                   
                                                   <?php  if($tix =="3"){ ?>
                                                        <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REGISTRADOR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                     <?php } else { ?>
                                                       <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REG.&nbsp;&nbsp;INGRESO.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                     <?php }  ?>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REGISTRÓ_ALTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LIQUIDADOR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                     
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">FECHA_REPORTE</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">PRIORIDAD</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">SERVICIO</th>
                                                    <th class="" style="text-transform: uppercase;text-align: center;vertical-align: inherit;">FECHA_REGISTRO</th>
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
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1167" aria-labelledby="home-tab"><br>
                                                   
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
                                          <div role="tabpanel" class="tab-pane fade active in" id="ta_content1" aria-labelledby="home-tab"><br>
                                                   
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
        
        
        <div class="modal fade bs-example-modal-smEmergencia" tabindex="-1" id="myModalsmEmergencia" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background: #337ab7;color: white;text-transform: uppercase;text-align: center;">
                                          <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                          <h4 class="modal-title" style="font-weight: 800;">REGISTRO PACIENTE <?php echo $titlex; ?> </h4>
                                </div>
                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formPacienteEmergen" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                  
                                  <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                  <input type="hidden" name="ide" id="ide">
                                  <input type="hidden" name="tipoReg" id="tipoReg" >
                                  
                     <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <?php 
                                    
                                  
                                   
                                    if($tix =="2"){  ?>
                                  <li role="presentation" class="" id="idDatIngere">
                                      <a href="#tab_content1u" id="house-tab" role="tab" data-toggle="tab" aria-expanded="true" style="padding: 6px 5px;">DATOS DE INGRESO</a>
                                  </li>
                                  <?php } ?>
                                  <li role="presentation" class="active" id="idDat"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true" style="padding: 6px 5px">DATOS DEL USUARIO</a>
                                  </li>
                                  <li role="presentation" class="" id="idPad"><a href="#tab_content2" id="profile-tab"    role="tab"   data-toggle="tab" aria-expanded="false" tabindex="13" style="padding: 6px 5px;" >DATOS DE LA ATENCION</a>
                                  </li>
                                  <li role="presentation" class="" id="idArch"><a href="#tab_content3" id="profile-tab2"  role="tab"  data-toggle="tab" aria-expanded="false" tabindex="26" style="padding: 6px 5px;">DATOS DEL ALTA</a>
                                  </li>
                                  <div class="btn-group" style="margin-top:2px;float: right;">
                                                <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle  btn-xs" type="button" aria-expanded="false">Acciones <span class="caret"></span>
                                                </button>
                                                <ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
                                                  <li>
                                                    <a onclick="validarSis()"><i class="fa fa-check-square-o"></i> Validar SIS</a>
                                                  </li>
                                                  <li>
                                                    <a id="reporteSis" target="_blank"><i class="fa fa-file-pdf-o"></i> Imprimir Reporte</a>
                                                  </li>
                                                  <li>
                                                    <a onclick="eraseAlta()" ><i class="fa fa-eraser"></i> Limpiar Datos Alta</a>
                                                  </li>
                                                  
                                                                                                    
                                                   
                                                </ul>
                                    </div>
                                </ul>
                        <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade" id="tab_content1u" aria-labelledby="house-tab">  <br>
                                                    
                                                 <div class="form-group hidden" id="acptTra">
                                                              <label class="control-label col-md-2 col-sm-3 col-xs-12" >ACEPTAR TRANSF.</label>
                                                              <div class="col-md-3 col-sm-12 col-xs-12">
                                                                    <input type="checkbox" class="form-control" name="aceptarTransf" id="aceptarTransf" tabindex="1" style="width: 20px;margin-left: 1px;margin-top:-2px;">
                                                              </div>
                                                </div>    
                                                <div class="form-group">
                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12 hidden" id="cHps">CUENTA HOSP.</label>
                                                      <div class="col-md-3 col-sm-12 col-xs-12 hidden" id="inpuCunx">
                                                        <input type="text" class="form-control" required="required" name="cuentaHsoMod" id="cuentaHsoMod" tabindex="2" >
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
                                                     <label class="control-label col-md-2 col-sm-3 col-xs-12" >TIPO SERVICIO</label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                                <select class="form-control" name="ubicacionHosX" id="ubicacionHosX" required="required" tabindex="4">
                                                                            <option value="">Seleccionar</option>
                                                                            <option value="1">ADULTO</option>
                                                                            <option value="2">COVID</option>
                                                                            <option value="3">MATERNO</option>
                                                                </select>
                                                            </div>
                                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-size: 12px;">SERVICIO INGRESO</label>
                                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <select class="form-control" name="tipoSeiNHosx" id="tipoSeiNHosx" required="required" tabindex="5"> 
                                                            </select>
                                                       </div>
                                                </div>
                                                <div class="hidden" id="viewEmergFeinf">
                                                        <div class="form-group">
                                                         <label class="control-label col-md-2 col-sm-3 col-xs-12" >FECHA INGRESO</label>
                                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                                    <input type="datetime-local" class="form-control" required="required" name="fechaIngreHos" id="fechaIngreHos" tabindex="6" >
                                                                </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12" >FECHA ALTA</label>
                                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                                <input type="date" class="form-control" name="montoToaxlHos" id="montoToaxlHos" tabindex="7" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group" id="">
                                                              <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">MONTO GALENOS</label>
                                                              <div class="col-md-2 col-sm-12 col-xs-12" id="inputel555">
                                                                <input type="text" class="form-control" required="required" name="monGalHosNu" id="monGalHosNu" tabindex="62" readonly>
                                                              </div>
                                                              <label class="control-label col-md-2 col-sm-3 col-xs-12">MONTO SISFAR</label>
                                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                                  <input type="text" class="form-control" required="required"  name="montSifHosNu" id="montSifHosNu" tabindex="63" readonly >
                                                                </div>
                                                                 <label class="control-label col-md-2 col-sm-3 col-xs-12">CONSUMO EMERG</label>
                                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                                  <input type="text" class="form-control" required="required"  name="monTotalCoHosNu" id="monTotalCoHosNu" readonly >
                                                                </div>
                                                            </div>
                                                       
                                                </div>
                                                 <div class="form-group hidden" id="obsFuaHo">
                                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" >FUA RECIBIDO</label>
                                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <input type="checkbox" class="form-control" name="fuaRcxHos" id="fuaRcxHos" tabindex="8" style="width: 20px;margin-left: 1px;margin-top:-2px;">
                                                      </div>
                                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-size: 12px;">OBSERVACIONES FUA</label>
                                                      <div class="col-md-5 col-sm-12 col-xs-12">
                                                            <select class="form-control" name="listObsFua" id="listObsFua" required="required" tabindex="9"> 
                                                            </select>
                                                       </div>
                                                 </div>
                                                <div class="hidden" id="viewConsulExter">
                                                     <div class="form-group">
                                                                
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">EESS REF.</label>
                                                                  <div class="col-md-6 col-sm-12 col-xs-12" id="inputelcu">
                                                                    <input type="text" class="form-control" required="required" name="essHos" id="essHos" tabindex="10" >
                                                                  </div>
                                                                  <label class="control-label col-md-1 col-sm-3 col-xs-12" id="telefam">N° REF.</label>
                                                                  <div class="col-md-2 col-sm-12 col-xs-12" id="inputelcu">
                                                                    <input type="text" class="form-control" required="required" name="nroRefHZ" id="nroRefHZ" tabindex="11" >
                                                                  </div>
                                                                 
                                                               
                                                                
                                                     </div>
                                                      <div class="form-group">
                                                                
                                                                <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">DX</label>
                                                                  <div class="col-md-9 col-sm-12 col-xs-12" id="inputelcu">
                                                                    <input type="text" class="form-control" required="required" name="dxDescricon" id="dxDescricon" tabindex="12" >
                                                                  </div>
                                                              
                                                     </div>
                                                       <div class="form-group">
                                                                
                                                                 <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">FECHA REF.</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12" id="inputelcu">
                                                                    <input type="date" class="form-control" required="required" name="feReefHos" id="feReefHos" tabindex="13" >
                                                                  </div>
                                                               
                                                               <label class="control-label col-md-2 col-sm-3 col-xs-12">ESPECIALIDAD</label>
                                                                 <div class="col-md-4 col-sm-12 col-xs-12">
                                                                          <select class="form-control" name="especialidadHos" id="especialidadHos" required="required" tabindex="14" > 
                                                                          </select>
                                                                 </div>
                                                     </div>
                                                     
                                                     
                                                        
                                                </div>
                                                
                                                
                                    </div>
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">                                           
                                          <br>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telcEmerHs"><?php echo $tihocon; ?></label>
                                          <div class="col-md-3 col-sm-12 col-xs-12" id="inputelcu">
                                            <input type="text" class="form-control" required="required" name="cuenta" id="cuenta" tabindex="15" >
                                          </div>
                                       
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">HISTORIA</label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                             <input type="text" class="form-control" name="hisCli" id="hisCli" maxlength="11" required="required" tabindex="16"  >
                                        </div> 
                                    </div>
                                 <script>
                                      $(document).ready(function(){
                                          
                                             $("select[name=origenEmerMod]").change(function(){
                                                    var dat = $('select[name=origenEmerMod]').val();
                                                   
                                                    
                                                    if(dat=="1" ){
                                                        
                                                        $( "#viewEmerg" ).removeClass( "hidden");
                                                        $( "#viewConsulExter" ).addClass( "hidden");
                                                        $( "#viewEmergFeinf" ).removeClass( "hidden");
                                                        $("#telcEmerHs").text("CUENTA EMERG");
                                                        
                                                    }else{
                                                         $( "#viewEmerg" ).addClass( "hidden");
                                                        $( "#viewConsulExter" ).removeClass( "hidden");
                                                        $( "#viewEmergFeinf" ).addClass( "hidden");
                                                        $("#telcEmerHs").text("CUENTA HOSP");
                                                        
                                                    }
                                                    
                                                });
                                          
                                          
                                          $("select[name=tipoDoc]").change(function(){
                                              
                                                    var dat = $('select[name=tipoDoc]').val();
                                                   
                                                    
                                                    if(dat=="6" ){
                                                        
                                                       $("#NroDoc").removeAttr('maxlength');
                                                       $("#NroDoc").addClass('hidden');
                                                       $( "#mosNrodoctitle" ).addClass( "hidden");
                                                       $( "#verNrodctlie" ).addClass( "hidden");
                                                       $("#NroDoc").val("");
                                                        
                                                        
                                                    }else if(dat==1 || dat==4){
                                                          
                                                         $("#NroDoc").attr('maxlength','8');
                                                         $("#NroDoc").removeClass('hidden');
                                                         $( "#mosNrodoctitle" ).removeClass( "hidden");
                                                         $( "#verNrodctlie" ).removeClass( "hidden");
                                                          $("#NroDoc").val("");
                                                         
                                                    }else if(dat==2  || dat==3){
                                                        
                                                         $("#NroDoc").attr('maxlength','9');
                                                         $("#NroDoc").removeClass('hidden');
                                                         $( "#mosNrodoctitle" ).removeClass( "hidden");
                                                         $( "#verNrodctlie" ).removeClass( "hidden");
                                                          $("#NroDoc").val("");
                                                         
                                                    } else{
                                                         $("#NroDoc").removeAttr('maxlength');
                                                         $("#NroDoc").removeClass('hidden');
                                                         $( "#mosNrodoctitle" ).removeClass( "hidden");
                                                         $( "#verNrodctlie" ).removeClass( "hidden");
                                                          $("#NroDoc").val("");
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
                                    <?php if($tix !="3"){ ?>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">PROCEDENCIA</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                          <select class="form-control" name="origenEmer" id="origenEmer" required="required" tabindex="17"  >                   
                                                <option value="">Seleccionar</option>
                                                
                                                 <option value="2">ACCIDENTE DE TRANSITO</option>
                                                  <option value="6">CONSULTA EXTERNA</option>
                                                  <option value="1">DOMICILIO</option>
                                                   <option value="4">EMERGENCIA</option>
                                                    <option value="5">HOSPITALIZACION</option>
                                                  <option value="3">REFERENCIA</option>
                                                  
                                                   
                                          </select>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12 hidden" id="titleRefHis">NRO REFERENCIA</label>
                                        <div class="col-md-4 col-sm-12 col-xs-12 hidden" id="txtNroReHis">
                                             <input type="text" class="form-control" name="nroRefEmer" id="nroRefEmer" maxlength="11" required="required" tabindex="18"  >
                                        </div>
                                      
                                    </div>
                                    <?php } ?>
                                    <div class="form-group hidden" id="estableRefIni">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">EESS REF.</label>
                                      <div class="col-md-4 col-sm-12 col-xs-12" >
                                        <input type="text" class="form-control" required="required"  name="eessInicio" id="eessInicio" tabindex="19" >
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12"  style="font-size: 13px;width: 94px;">SUBIR REF.</label>
                                      <div class="col-md-4 col-sm-12 col-xs-12" id="" style="margin-left:-19px;">
                                            <input type="file" name="subirRef" id="subirRef"  class="form-control" accept=".pdf" style="border: 1px solid white;" tabindex="20">
                                      </div>
                                      
                                    </div>
                                     <?php if($tix =="3"){ ?>
                                 <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" id="mosNrodoc">N° FUA</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12" id="verNrodc">
                                          <div class="input-group" style="margin-bottom:0px;">
                                             <input type="text" class="form-control" name="nroFuaInter" id="nroFuaInter" required="required" tabindex="22"   >
                                           </div>
                                        </div> 
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12 hidden">TIPO CITA</label>
                                        <div class="col-md-4 col-sm-12 col-xs-12 hidden">
                                          <select class="form-control" name="tipocita" id="tipocita" required="required" tabindex="21" >                   
                                                <option value="">Seleccionar</option>
                                                <option value="1">HOJA REFERENCIA</option>
                                                <option value="2">INTERCONSULTA</option>
                                          </select>
                                        </div>

                                       
                                 </div>
                                 <?php } ?>
                                  <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">TIPO DOC</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                          <select class="form-control" name="tipoDoc" id="tipoDoc" required="required" tabindex="21" >                   
                                                
                                          </select>
                                        </div>

                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" id="mosNrodoctitle">N° DOC. <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                        <div class="col-md-4 col-sm-12 col-xs-12" id="verNrodctlie">
                                          <div class="input-group" style="margin-bottom:0px;">
                                             <input type="text" class="form-control" name="NroDoc" id="NroDoc" required="required" tabindex="22"   >
                                             <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary" id="cargaDni"><i class="fa fa-search"></i></button>
                                             </span>
                                                      
                                           </div>
                                        </div> 
                                 </div>
                               
                                    <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">AP. PATERNO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" required="required"  name="apepa" id="apepa" tabindex="23"  >
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">AP. MATERNO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                          <input type="text" class="form-control" required="required" name="apema" id="apema"  tabindex="24" >
                                        </div>
                                    </div>
                                     <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">NOMBRES  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" required="required" name="nombres" id="nombres" tabindex="25"  >
                                      </div>

                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA NAC.  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                          <input type="date" class="form-control" required="required"  name="FechaNac" min='2001-01-31' max='2030-12-31' tabindex="26" id="FechaNac"   >
                                        </div>
                                    </div>
                                    
                                   
                                    <div class="form-group">
                                     
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">EDAD</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                          <input type="text" class="form-control" required="required" name="edad" id="edad" tabindex="27"  maxlength="3" >
                                        </div>
                                         <label class="control-label col-md-2 col-sm-3 col-xs-12">SEXO</label>
                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                <select class="form-control" name="sexo" id="sexo" required="required" tabindex="28"   >
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
                                    <?php if($tix !="3"){ ?>
                                     <div class="form-group">
                                             <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">TELF. FAMILIAR</label>
                                              <div class="col-md-2 col-sm-12 col-xs-12" id="inputel345">
                                                <input type="text" class="form-control" required="required" name="telefa" id="telefa" tabindex="29" >
                                              </div>
                                              <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">CONTRASEÑA</label>
                                              <div class="col-md-2 col-sm-12 col-xs-12" id="inputel09">
                                                <select class="form-control" name="cns" id="cns" required="required" tabindex="30">>
                                                        <option value="">-- Seleccionar --</option>
                                                        <option value="SC">S/C</option>
                                                        <option value="CC">C/C</option>
                                                </select>
                                              </div>
                                               <label class="control-label col-md-1 col-sm-3 col-xs-12 hidden" id="txtRs">RESPONSABLE</label>
                                               <div class="col-md-2 col-sm-12 col-xs-12 hidden" id="campRes" style="margin-left: 31px;">
                                                <input type="text" class="form-control" required="required" name="respbl" id="respbl" tabindex="31" >
                                              </div>
                                     </div>
                                     
                                    <?php } ?>
                                </div>
                                 <script>
                                      $(document).ready(function(){
                                          $("select[name=financia]").change(function(){
                                                    var dat = $('select[name=financia]').val();
                                                    var at = $('select[name=actras]').val();
                                                    
                                                    
                                                    if(dat=="1" && at=="NO" ){
                                                        
                                                                
                                                                $( "#txtLi" ).text( "REG.ALTA");
                                                                $( "#tixLiq" ).addClass( "hidden");
                                                                $( "#muesNroAfil" ).removeClass( "hidden");
                                                                $( "#datoNroAf" ).removeClass( "hidden");
                                                                $( "#feNuevas" ).removeClass( "hidden");
                                                                $( "#coreoAuto" ).removeClass( "hidden");
                                                                $( "#mostraCampo" ).removeClass( "hidden");
                                                                $( "#subAdj" ).addClass( "hidden");
                                                                $( "#mostrAdj" ).addClass( "hidden");
                                                                $( "#feRtU" ).removeClass( "hidden");
                                                                $( "#fetOp" ).removeClass( "hidden");
                                                                $( "#coreoAuto" ).addClass( "hidden");
                                                                $( "#mostraCampo" ).addClass( "hidden");
                                                                $( "#moFuaxi" ).addClass( "hidden");
                                                                $( "#txtSegu" ).text( "IAFAS");
                                                                $( "#iafReg" ).removeClass( "hidden");
                                                                $( "#verReg" ).removeClass( "hidden");
                                                                $( "#verRegList" ).removeClass( "hidden");
                                                                $( "#verPlanSald" ).removeClass( "hidden");
                                                                $( "#verPlaList" ).removeClass( "hidden");
                                                                $("#msTfuaGaran").text("N° FUA");
                                                                $( "#msTfuaGaran" ).addClass( "hidden");
                                                                $( "#verMonGar" ).addClass( "hidden");
                                                                $( "#ters" ).text( "FECHA INGRESO");
                                                                $( "#inputel" ).addClass( "hidden");
                                                                $( "#iafRegSeg" ).addClass( "hidden");
                                                                $( "#montosAlo" ).removeClass( "hidden");
                                                                $( "#rowRaTEN" ).addClass( "hidden");
                                                                $( "#txtLi" ).addClass( "hidden");
                                                                $( "#divCehck" ).addClass( "hidden");
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                $( "#feRtU" ).addClass( "hidden");
                                                                $( "#fetOp" ).addClass( "hidden");
                                                                $( "#divPrio" ).removeClass( "hidden");  
                                                                  
                                                                
                                                        
                                                    }else if(dat=="2" && at=="NO" ){
                                                        
                                                         $( "#txtLi" ).text( "LIQUIDA");
                                                                 $( "#tixLiq" ).removeClass( "hidden");
                                                                $( "#muesNroAfil" ).removeClass( "hidden");
                                                                $( "#datoNroAf" ).removeClass( "hidden");
                                                                $( "#feNuevas" ).removeClass( "hidden");
                                                                $( "#coreoAuto" ).removeClass( "hidden");
                                                                $( "#mostraCampo" ).removeClass( "hidden");
                                                                $( "#subAdj" ).removeClass( "hidden");
                                                                $( "#mostrAdj" ).removeClass( "hidden");
                                                                $( "#feRtU" ).addClass( "hidden");
                                                                $( "#fetOp" ).addClass( "hidden");
                                                                $( "#txtSegu" ).text( "IAFAS");
                                                                $( "#iafReg" ).removeClass( "hidden");
                                                                $( "#verReg" ).removeClass( "hidden");
                                                                $( "#verRegList" ).removeClass( "hidden");
                                                                $( "#verPlanSald" ).removeClass( "hidden");
                                                                $( "#verPlaList" ).removeClass( "hidden");
                                                                $("#msTfuaGaran").text("N° FUA");
                                                                $( "#verMonGar" ).addClass( "hidden");
                                                                $( "#ters" ).text( "FECHA INGRESO");
                                                                $( "#msTfuaGaran" ).removeClass( "hidden");
                                                                $( "#moFuaxi" ).removeClass( "hidden");
                                                                $( "#emailAuto" ).addClass( "hidden");
                                                                $( "#coreoAuto" ).addClass( "hidden");
                                                                $( "#subAdj" ).addClass( "hidden");
                                                                $( "#mostrAdj" ).addClass( "hidden");
                                                                $( "#monCarGar" ).addClass( "hidden");
                                                                $( "#iafRegSeg" ).addClass( "hidden");
                                                                $( "#montosAlo" ).removeClass( "hidden");
                                                                $( "#rowRaTEN" ).removeClass( "hidden");
                                                                $( "#txtLi" ).removeClass( "hidden");
                                                                $( "#divCehck" ).removeClass( "hidden");
                                                                $( "#teleEssa" ).removeClass( "hidden");
                                                                $( "#rowRaTEN" ).removeClass( "hidden");
                                                                $kj = $("#fua").val();
                                                                if($kj==""){
                                                                     $("#fua").val("6207-23-");
                                                                }
                                                                $( "#divPrio" ).addClass( "hidden"); 
                                                                
                                                        
                                                    }else if(dat=="4" && at=="SI" ){
                                                        
                                                        
                                                         $( "#txtLi" ).text( "LIQUIDA");
                                                                $( "#tixLiq" ).removeClass( "hidden");
                                                                $( "#muesNroAfil" ).addClass( "hidden");
                                                                $( "#datoNroAf" ).addClass( "hidden");
                                                                $( "#feNuevas" ).addClass( "hidden");
                                                                $( "#coreoAuto" ).addClass( "hidden");
                                                                $( "#mostraCampo" ).addClass( "hidden");
                                                                $( "#subAdj" ).addClass( "hidden");
                                                                $( "#mostrAdj" ).addClass( "hidden");
                                                                $( "#feRtU" ).removeClass( "hidden");
                                                                $( "#fetOp" ).removeClass( "hidden");
                                                                $( "#feRtU" ).text( "FECHA SOLICITUD");
                                                                $( "#iafReg" ).removeClass( "hidden");
                                                                $( "#ters" ).text( "FECHA INGRESO");
                                                                $( "#msTfuaGaran" ).removeClass( "hidden");
                                                                $( "#moFuaxi" ).removeClass( "hidden");
                                                                $( "#tituloFux" ).text( "EXP. ENTREGADO");
                                                                $( "#inputel" ).removeClass( "hidden");
                                                                 $( "#monCarGar" ).removeClass( "hidden");
                                                                 $( "#iafRegSeg" ).addClass( "hidden");
                                                                 $( "#txtSegu" ).text( "IAFAS");
                                                                $( "#verReg" ).removeClass( "hidden");
                                                                $( "#verRegList" ).removeClass( "hidden");
                                                                $( "#verPlanSald" ).removeClass( "hidden");
                                                                $( "#verPlaList" ).removeClass( "hidden"); 
                                                                $( "#montosAlo" ).removeClass( "hidden");
                                                                $( "#rowRaTEN" ).removeClass( "hidden");
                                                                $( "#txtLi" ).removeClass( "hidden");
                                                                $( "#divCehck" ).removeClass( "hidden");
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                $( "#rowRaTEN" ).addClass( "hidden");
                                                                $("#msTfuaGaran").text("N° CARTA");
                                                                $("#fua").val("");
                                                                // cargarSeguros();
                                                              $( "#divPrio" ).addClass( "hidden"); 
                                                                
                                                                
                                                             
                                                                 
                                                        
                                                    }else if(dat=="3" && at=="SI"   ){
                                                        
                                                         $( "#txtLi" ).text( "LIQUIDA");
                                                        $( "#tixLiq" ).removeClass( "hidden");
                                                                $( "#muesNroAfil" ).addClass( "hidden");
                                                                $( "#datoNroAf" ).addClass( "hidden");
                                                                $( "#feNuevas" ).addClass( "hidden");
                                                                $( "#coreoAuto" ).addClass( "hidden");
                                                                $( "#mostraCampo" ).addClass( "hidden");
                                                                $( "#subAdj" ).addClass( "hidden");
                                                                $( "#mostrAdj" ).addClass( "hidden");
                                                                $( "#feRtU" ).removeClass( "hidden");
                                                                $( "#fetOp" ).removeClass( "hidden");
                                                                $( "#txtSegu" ).text( "IAFAS");
                                                                $( "#verReg" ).removeClass( "hidden");
                                                                $( "#verRegList" ).removeClass( "hidden");
                                                                $( "#verPlanSald" ).removeClass( "hidden");
                                                                $( "#verPlaList" ).removeClass( "hidden");
                                                                $("#msTfuaGaran").text("N° CARTA");
                                                                $("#fua").val("");
                                                                $( "#verMonGar" ).removeClass( "hidden");
                                                                $( "#ters" ).text( "FECHA INGRESO");
                                                                $( "#iafReg" ).removeClass( "hidden");
                                                                $( "#msTfuaGaran" ).removeClass( "hidden");
                                                                $( "#moFuaxi" ).removeClass( "hidden");
                                                                $( "#tituloFux" ).text( "EXP. ENTREGADO");
                                                                $( "#inputel" ).removeClass( "hidden");
                                                                $( "#monCarGar" ).removeClass( "hidden");
                                                                $( "#iafRegSeg" ).removeClass( "hidden");
                                                                $( "#montosAlo" ).removeClass( "hidden");
                                                                $( "#rowRaTEN" ).removeClass( "hidden");
                                                                $( "#txtLi" ).removeClass( "hidden");
                                                                $( "#divCehck" ).removeClass( "hidden");
                                                                 $( "#feRtU" ).text( "FECHA REPORTE");
                                                                
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                $( "#rowRaTEN" ).addClass( "hidden");
                                                               // cargarSeguros();teleEssa
                                                                $( "#divPrio" ).addClass( "hidden"); 
                                                                
                                                         
                                                    }else if(dat=="2" && at=="SI" ){
                                                        
                                                         $( "#txtLi" ).text( "LIQUIDA");
                                                        $( "#tixLiq" ).removeClass( "hidden");
                                                                $( "#muesNroAfil" ).removeClass( "hidden");
                                                                $( "#datoNroAf" ).removeClass( "hidden");
                                                                $( "#feNuevas" ).removeClass( "hidden");
                                                                $( "#coreoAuto" ).removeClass( "hidden");
                                                                $( "#mostraCampo" ).removeClass( "hidden");
                                                                $( "#subAdj" ).removeClass( "hidden");
                                                                $( "#mostrAdj" ).removeClass( "hidden");
                                                                $( "#feRtU" ).addClass( "hidden");
                                                                $( "#fetOp" ).addClass( "hidden");
                                                                $( "#txtSegu" ).text( "IAFAS");
                                                                $( "#iafReg" ).removeClass( "hidden");
                                                                $( "#verReg" ).removeClass( "hidden");
                                                                $( "#verRegList" ).removeClass( "hidden");
                                                                $( "#verPlanSald" ).removeClass( "hidden");
                                                                $( "#verPlaList" ).removeClass( "hidden");
                                                                $("#msTfuaGaran").text("N° FUA");
                                                                 $("#msTfuaGaran").removeClass("hidden");
                                                                $( "#verMonGar" ).addClass( "hidden");
                                                                $( "#ters" ).text( "FECHA INGRESO");
                                                                $( "#moFuaxi" ).removeClass( "hidden");
                                                                $( "#emailAuto" ).removeClass( "hidden");
                                                                $( "#iafRegSeg" ).addClass( "hidden");
                                                                $( "#inputel" ).addClass( "hidden");
                                                                $( "#montosAlo" ).removeClass( "hidden");
                                                                $( "#rowRaTEN" ).removeClass( "hidden");
                                                                $( "#txtLi" ).removeClass( "hidden");
                                                                $( "#divCehck" ).removeClass( "hidden");
                                                                $( "#teleEssa" ).removeClass( "hidden");
                                                                $( "#rowRaTEN" ).removeClass( "hidden");
                                                               
                                                                $kj = $("#fua").val();
                                                                if($kj==""){
                                                                     $("#fua").val("6207-23-");
                                                                }
                                                                $( "#divPrio" ).addClass( "hidden"); 
                                                    }else if(dat=="1" && at=="SI" ){
                                                        
                                                         $( "#txtLi" ).text( "REG.ALTA");
                                                        $( "#tixLiq" ).addClass( "hidden");
                                                                
                                                                
                                                                //$("#fua").val("6207-23-");
                                                                $kj = $("#fua").val();
                                                                if($kj==""){
                                                                     $("#fua").val("6207-23-");
                                                                }
                                                                $( "#muesNroAfil" ).removeClass( "hidden");
                                                                $( "#datoNroAf" ).removeClass( "hidden");
                                                                $( "#feNuevas" ).removeClass( "hidden");
                                                                $( "#coreoAuto" ).removeClass( "hidden");
                                                                $( "#mostraCampo" ).removeClass( "hidden");
                                                                $( "#subAdj" ).addClass( "hidden");
                                                                $( "#mostrAdj" ).addClass( "hidden");
                                                                $( "#feRtU" ).removeClass( "hidden");
                                                                $( "#fetOp" ).removeClass( "hidden");
                                                                $( "#coreoAuto" ).addClass( "hidden");
                                                                $( "#mostraCampo" ).addClass( "hidden");
                                                                $( "#moFuaxi" ).addClass( "hidden");
                                                                $( "#txtSegu" ).text( "IAFAS");
                                                                $( "#iafReg" ).removeClass( "hidden");
                                                                $( "#verReg" ).removeClass( "hidden");
                                                                $( "#verRegList" ).removeClass( "hidden");
                                                                $( "#verPlanSald" ).removeClass( "hidden");
                                                                $( "#verPlaList" ).removeClass( "hidden");
                                                                $("#msTfuaGaran").text("N° FUA");
                                                                $( "#msTfuaGaran" ).addClass( "hidden");
                                                                $( "#verMonGar" ).addClass( "hidden");
                                                                $( "#ters" ).text( "FECHA INGRESO");
                                                                $( "#inputel" ).addClass( "hidden");
                                                                $( "#iafRegSeg" ).addClass( "hidden");
                                                                $( "#montosAlo" ).removeClass( "hidden");
                                                                $( "#rowRaTEN" ).addClass( "hidden");
                                                                $( "#txtLi" ).removeClass( "hidden");
                                                                $( "#divCehck" ).removeClass( "hidden");
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                $( "#feRtU" ).addClass( "hidden");
                                                                $( "#fetOp" ).addClass( "hidden");
                                                                $( "#feRtU" ).text( "FECHA REPORTE");
                                                                $( "#divPrio" ).removeClass( "hidden"); 
                                                                            
                                                        
                                                    }/*else{
                                                        
                                                                $( "#muesNroAfil" ).removeClass( "hidden");
                                                                $( "#datoNroAf" ).removeClass( "hidden");
                                                                $( "#feNuevas" ).removeClass( "hidden");
                                                                $( "#coreoAuto" ).removeClass( "hidden");
                                                                $( "#mostraCampo" ).removeClass( "hidden");
                                                                $( "#subAdj" ).removeClass( "hidden");
                                                                $( "#mostrAdj" ).removeClass( "hidden");
                                                        
                                                    }*/
                                                    
                                                });
                                                
                                                
                                              $("#actras").change(function() {
                                                  
                                                        var idDis = $("#actras").val();
                                                       
                                                          $("#financia").html('');
                                                          cargarFinanciamento(0,idDis);    
                                                        
                                                        
                                                 });
                                                 
                                        });
                                    </script>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab"><br>
                                <input type="hidden" name="regWebSis" id="regWebSis" >
                                <input type="hidden" name="planWebSis" id="planWebSis" >
                                <?php if($tix !="3"){   ?>
                                    <div class="form-group" id="accMost">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" style="margin-top: -10px;font-size: 12px;">ACCIDENTE TRANSITO</label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                            
                                                            
                                                          <select class="form-control" name="actras" id="actras" required="required" tabindex="32" >
                                                                    <option value="">Seleccionar</option>
                                                                    <option value="SI">SI</option>
                                                                     <option value="NO">NO</option>
                                                          </select>
                                                        </div>
                                     
                                          <label class="control-label col-md-2 col-sm-3 col-xs-12" >FINANCIAMIENTO</label>
                                          <div class="col-md-3 col-sm-12 col-xs-12 " id="">
                                                <select class="form-control" name="financia" id="financia" required="required" tabindex="33">
                                                    
                                                </select>
                                          </div>
                                          <div class="col-md-2 col-sm-12 col-xs-12 hidden" id="divPrio">
                                                <select class="form-control" name="prioridad" id="prioridad" required="required" tabindex="41"> 
                                                    <option value="0">PRIORIDAD</option>
                                                    <option value="I">I</option>
                                                    <option value="II">II</option>
                                                    <option value="III">III</option>
                                                    <option value="IV">IV</option>
                                                </select>
                                        </div>
                                    </div>
                                    
                                    <?php  }  ?>
                                    <script>
                                      $(document).ready(function(){
                                          
                                       /*   
                                          $("select[name=financia]").change(function(){
                                                    var dat = $('select[name=financia]').val();
                                                    
                                                    if(dat=="1" || dat=="2"){
                                                        
                                                        $( "#txtSegu" ).text( "IAFAS");
                                                        $( "#iafReg" ).removeClass( "hidden");
                                                        $( "#verReg" ).removeClass( "hidden");
                                                        $( "#verRegList" ).removeClass( "hidden");
                                                       $( "#verPlanSald" ).removeClass( "hidden");
                                                       $( "#verPlaList" ).removeClass( "hidden");
                                                       $("#msTfuaGaran").text("N° FUA");
                                                           $( "#verMonGar" ).addClass( "hidden");
                                                           $( "#ters" ).text( "FECHA INGRESO");
                                                      
                                                    }else  if(dat=="3" ){
                                                        
                                                        $( "#txtSegu" ).text( "ASEGURADORA");
                                                        $( "#verReg" ).addClass( "hidden");
                                                        $( "#verRegList" ).addClass( "hidden");
                                                       $( "#verPlanSald" ).addClass( "hidden");
                                                       $( "#verPlaList" ).addClass( "hidden");
                                                       $("#msTfuaGaran").text("N° CARTA");
                                                       $( "#verMonGar" ).removeClass( "hidden");
                                                       $( "#ters" ).text( "FECHA INGRESO");
                                                       
                                                      
                                                    }else{
                                                         $( "#iafReg" ).addClass( "hidden");
                                                         $( "#ters" ).text( "FECHA INGRESO");
                                                    }
                                                    
                                                   
                                                    
                                                }); */
                                                
                                                
                                            $("select[name=seguros]").change(function(){
                                                
                                                    var fi = $('#financia').val();
                                                    var at = $('#actras').val();
                                                    var se = $('#seguros').val();
                                                   
                                                    var regWebSis = $('#regWebSis').val();
                                                    var planWebSis = $('#planWebSis').val();
                                                    
                                                    
                                                    if(se=="13"){
                                                        
                                                                    if(regWebSis=="1"){
                                                                  
                                                                                setTimeout(function (){
                                                                                        cargarRegimen(8,13);
                                                                                },500);
                                                                                
                                                                                
                                                                                if(planWebSis=="05"){
                                                                                      cargarPlanSalud(21,8)
                                                                                }else if(planWebSis=="01"){
                                                                                      cargarPlanSalud(22,8)
                                                                                }
                                                                           
                                                                 
                                                                    }else if(regWebSis=="2"){
                                                                            
                                                                                 setTimeout(function (){
                                                                                        cargarRegimen(9,13);
                                                                                 },500);
                                                                             
                                                                                if(planWebSis=="02"){
                                                                                  cargarPlanSalud(23,9)
                                                                                }else if(planWebSis=="03"){
                                                                                      cargarPlanSalud(24,9)
                                                                                }else if(planWebSis=="04"){
                                                                                      cargarPlanSalud(25,9)
                                                                                }
                                                                    }
                                                        
                                                    }
                                                    else if(se=="1"){
                                                       
                                                        
                                                                    if(regWebSis=="1"){
                                                                  
                                                                                setTimeout(function (){
                                                                                        cargarRegimen(1,1);
                                                                                },500);
                                                                                
                                                                                
                                                                                if(planWebSis=="05"){
                                                                                      cargarPlanSalud(1,1)
                                                                                }else if(planWebSis=="01"){
                                                                                      cargarPlanSalud(2,1)
                                                                                }
                                                                       
                                                                 
                                                                    }else if(regWebSis=="2"){
                                                                            
                                                                                 setTimeout(function (){
                                                                                        cargarRegimen(2,1);
                                                                                 },500);
                                                                             
                                                                                if(planWebSis=="02"){
                                                                                  cargarPlanSalud(3,2)
                                                                                  
                                                                                }else if(planWebSis=="03"){
                                                                                  cargarPlanSalud(4,2)
                                                                                  
                                                                                }else if(planWebSis=="04"){
                                                                                  cargarPlanSalud(5,2)
                                                                                }
                                                                    }
                                                        
                                                    }
                                                    
                                                    else if(se=="2"){
                                                            
                                                            cargarRegimen(0,se);
                                                            
                                                    }
                                                    
                                                    
                                                
                                                    
                                                    
                                                    if(at=="SI" && fi=="3" && se=="1" || at=="SI" && fi=="4" && se=="1" || at=="SI" && fi=="2" && se=="13" || at=="SI" && fi=="1" && se=="1" 
                                                     || at=="NO" && fi=="2" && se=="13" || at=="NO" && fi=="1" && se=="1" || se=="1"){
                                                        
                                                            $( "#datoNroAf" ).removeClass( "hidden");
                                                            $( "#muesNroAfil" ).removeClass( "hidden");
                                                            $( "#feNuevas" ).removeClass( "hidden");
                                                        
                                                    } else{
                                                           $( "#datoNroAf" ).addClass( "hidden");
                                                           $( "#muesNroAfil" ).addClass( "hidden");
                                                           $( "#feNuevas" ).addClass( "hidden");
                                                    }
                                                    
                                                });
                                                
                                                
                                                
                                        });
                                    </script>
                                     <div class="form-group hidden" id="iafRegSeg">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" id="txtSeguAl">ASEGURADORA</label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <select class="form-control" name="segurosAl" id="segurosAl" required="required" tabindex="34" >
                                                          </select>
                                                        </div>
                                     
                                      
                                    </div>
                                    <div class="form-group hidden" id="iafReg">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" id="txtSegu"></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <select class="form-control" name="seguros" id="seguros" required="required" tabindex="35" >
                                                           
                                                          </select>
                                                        </div>
                                     
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" id="verReg">REGIMEN</label>
                                          <div class="col-md-4 col-sm-12 col-xs-12 " id="verRegList">
                                                <select class="form-control" name="regim" id="regim" required="required" tabindex="36"> 
                                                
                                                </select>
                                            </div>
                                    </div>
                                   
                                     <div class="form-group">
                                         <label class="control-label col-md-2 col-sm-3 col-xs-12 " id="verPlanSald">PLAN DE SALUD</label>
                                          <div class="col-md-3 col-sm-12 col-xs-12" id="verPlaList">
                                                <select class="form-control" name="planSal" id="planSal" required="required" tabindex="37"> 
                                                            
                                                </select>
                                            </div>
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" id="muesNroAfil">NRO AFIL</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12" id="datoNroAf">
                                          <input type="text" class="form-control" required="required" name="NroAf" id="NroAf" tabindex="38">
                                        </div>
                                 
                                    </div>
                                     <div class="form-group" id="feNuevas">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-size: 12px;">FECHA AFILIACION</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                          <input type="date" class="form-control" required="required"  name="fechaAful" id="fechaAful" tabindex="39" >
                                        </div>
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-size: 12px;">FECHA CADUCIDAD</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                          <input type="date" class="form-control" required="required"  name="feSolAte" id="feSolAte" tabindex="40"  >
                                        </div>
                                         <div class="col-md-2 col-sm-12 col-xs-12">
                                                <select class="form-control" name="statusRegPax" id="statusRegPax" required="required" tabindex="41"> 
                                                    <option value="">ESTADO</option>
                                                    <option value="ACTIVO">ACTIVO</option>
                                                    <option value="ANULADO">ANULADO</option>
                                                    <option value="CANCELADO">CANCELADO</option>
                                                    <option value="SUSPENDIDO">SUSPENDIDO</option>
                                                </select>
                                        </div>
                                    </div>
                                    
                                    <?php if($tix =="1"){ ?>
                                    
                                    <div class="form-group">
                                         <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-size: 12px;">TIPO SERVICIO</label>
                                              <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <select class="form-control" name="ubicacion" id="ubicacion" required="required" tabindex="42">
                                                                <option value="">Seleccionar</option>
                                                                <option value="1">ADULTO</option>
                                                                <option value="2">COVID</option>
                                                                <option value="3">MATERNO</option>
                                                    </select>
                                                </div>
                                         <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-size: 12px;">SERVICIO INGRESO</label>
                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                <select class="form-control" name="tipoSeiN" id="tipoSeiN" required="required" tabindex="43"> 
                                                            
                                                </select>
                                            </div>
                                       
                                 
                                    </div>
                                    <?php } else if($tix =="2"){  ?>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" >PAB. INGRESO</label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <select class="form-control" name="pab1Hos" id="pab1Hos" required="required" tabindex="44" >
                                                                    
                                                          </select>
                                                        </div>
                                     
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" >CAMA INGRESO</label>
                                          <div class="col-md-3 col-sm-12 col-xs-12 " id="">
                                               <input class="form-control" id="camHos1"  name="camHos1" tabindex="45">
                                            </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" >SERVICIO</label>
                                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                                            <input class="form-control" id="serEspecia"  name="serEspecia" tabindex="45" style="text-transform: uppercase;">
                                                        </div>
                                    </div>
                                    <?php } ?>
                                  <div class="form-group">
                                      <?php 
                                      $tiao='FECHA ATENCION';
                                      if($tix !="3"){  
                                            $tiao='FECHA INGRESO';
                                      }?>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" id="ters" style="font-size: 12px;"><?php echo $tiao ?></label>
                                      <div class="col-md-3 col-sm-12 col-xs-12" id="ters2">
                                        <input type="datetime-local" class="form-control" required="required" name="feingre" id="feingre" tabindex="46" onchange="handlerDias(event);" onkeydown="return false">
                                      </div>
                                    
                                       <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-size: 12px;" id="feRtU">FECHA REPORTE</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12" id="fetOp">
                                                <div class="input-group" style="margin-bottom:0px;">
                                                     <input type="datetime-local" class="form-control" required="required"  name="feAlta" id="feAlta" tabindex="47">
                                                     <span class="input-group-btn">
                                                            <button type="button" class="btn btn-success" id="XXXX"><i class="fa fa-file-excel-o"></i> Ver reporte</button>
                                                     </span>
                                                </div>
                                        </div>
                                     
                                       
                                    </div>
                                       <?php if($tix !="3"){ ?>
                                    <div class="form-group">
                                       <label class="control-label col-md-2 col-sm-3 col-xs-12" id="" style="font-size: 12px;">ESTANCIA (dias)</label>
                                      <div class="col-md-2 col-sm-12 col-xs-12" id="">
                                        <input type="text" class="form-control" required="required" name="estaDias" id="estaDias" tabindex="48" readonly>
                                         
                                      </div>
                                     
                                       <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-size: 12px;" id="coreoAuto">CORREO AUTORIZACION</label>
                                        <div class="col-md-5 col-sm-12 col-xs-12" id="mostraCampo">
                                          <input type="email" class="form-control" required="required"  name="emailAuto" id="emailAuto" tabindex="49">
                                        </div>

                                    </div>
                                     <div class="form-group" >
                                       <label class="control-label col-md-2 col-sm-3 col-xs-12" id="subAdj" style="font-size: 12px;">SUBIR ARCHIVO</label>
                                      <div class="col-md-6 col-sm-12 col-xs-12" id="mostrAdj">
                                             <input type="file" name="file" id="file"  class="form-control" accept=".pdf" style="border: 1px solid white;" tabindex="50">
                                      </div>
                                    </div>
                                       <?php } ?>
                                     <div class="form-group" >
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">
                                          <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalObserv" id="examPx" 
                                          onclick="verObserpac();"><i class="fa fa-plus"></i> Observaciones </a></label>
                                        <div class="col-md-10 col-sm-12 col-xs-12">
                                            <textarea class="form-control" name="obsRes" id="obsRes" rows="3" style="text-transform: uppercase;" tabindex="70" readonly ></textarea><br>
                                            <div class="table-responsive" id="datExrObs" style="float: left;"> </div>
                                        </div>
                                      
                                    </div>
                                    
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab"><br>
                                <?php if($tix !="3"){ ?>
                                    <div class="form-group">
                                       <label class="control-label col-md-2 col-sm-3 col-xs-12" id="msTfuaGaran">N° FUA</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12" id="moFuaxi">
                                             <input type="text" class="form-control" name="fua" id="fua" maxlength="30" required="required" tabindex="51"  >
                                             <input type="hidden" class="form-control" name="validarFua" id="validarFua"   >
                                        </div>
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" id="verMonGar">MONTO CARTA</label>
                                          <div class="col-md-2 col-sm-12 col-xs-12" id="inputel">
                                            <input type="text" class="form-control" required="required" name="monCarGar" id="monCarGar" tabindex="52" >
                                          </div>
                                        
                                    </div>
                                    <?php }  ?>
                                    <script>
                                      $(document).ready(function(){
                                          
                                          $("select[name=espost]").change(function(){
                                              
                                                    var dat = $('select[name=espost]').val();
                                                    var fin = $("#financia").val();
                                                    var actras = $("#actras").val();
                                                    
                                                    
                                                   // if(dat=="1" && fin=="1" || dat=="2" && fin=="1" || dat=="11" && fin=="1" || dat=="4" && fin=="1"){
                                                    if(dat=="1" && fin=="1"  ){
                                                              $( "#idfa" ).addClass( "hidden");
                                                              $( "#idfa" ).text("ALTA_MEDICA");
                                                              $( "#fallecido" ).addClass( "hidden");
                                                              $( "#viewTextPabellon" ).addClass( "hidden");
                                                              $( "#viewListPabellon" ).addClass( "hidden");
                                                              $( "#idreF" ).addClass( "hidden");
                                                              $( "#inputRef" ).addClass( "hidden");
                                                              $( "#btnTrans" ).addClass( "hidden");
                                                             // $( "#fuanEtk" ).removeClass( "hidden");
                                                              $( "#idFCuen" ).addClass( "hidden");
                                                              $( "#inpCuenx" ).addClass( "hidden");
                                                              $( "#teleEssa" ).addClass( "hidden");
                                                            //   $( "#txtitleAudi" ).removeClass( "hidden");
                                                             // $( "#txtValorAudi" ).removeClass( "hidden");
                                                              $( "#fuanEtk" ).addClass( "hidden");
                                                              
                                                               $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $( "#nroCxref" ).val("");
                                                                  //$( "#montSif" ).val("");
                                                              
                                                    //  $( "#btnRefeAgre" ).removeClass( "hidden");
                                                           
                                                    } else if(dat=="1" && fin=="2" || dat=="12" && fin=="2" ){
                                                              $( "#idfa" ).addClass( "hidden");
                                                              $( "#idfa" ).text("ALTA_MEDICA");
                                                              $( "#fallecido" ).addClass( "hidden");
                                                              $( "#viewTextPabellon" ).addClass( "hidden");
                                                             $( "#viewListPabellon" ).addClass( "hidden");
                                                              $( "#idreF" ).addClass( "hidden");
                                                              $( "#inputRef" ).addClass( "hidden");
                                                              $( "#btnTrans" ).addClass( "hidden");
                                                              $( "#idFCuen" ).addClass( "hidden");
                                                              $( "#inpCuenx" ).addClass( "hidden");
                                                              $( "#teleEssa" ).removeClass( "hidden");
                                                              $( "#titleEss" ).text("EESS CONTRAREF.");
                                                              $( "#fuanEtk" ).removeClass( "hidden");
                                                              $( "#txtitleAudi" ).removeClass( "hidden");
                                                              $( "#txtValorAudi" ).removeClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                            $( "#btnRefeAgre" ).addClass( "hidden");
                                                            
                                                            $kj = $("#nroCxref").val();
                                                                if($kj==""){
                                                                     $("#nroCxref").val("6207-");
                                                                }
                                                                 // $( "#montSif" ).val("");
                                                            
                                                    }else if(dat=="10" && fin=="1" || dat=="12" && fin=="1" ){
                                                              $( "#idfa" ).addClass( "hidden");
                                                              $( "#idfa" ).text("ALTA_MEDICA");
                                                              $( "#fallecido" ).addClass( "hidden");
                                                              $( "#viewTextPabellon" ).addClass( "hidden");
                                                              $( "#viewListPabellon" ).addClass( "hidden");
                                                              $( "#idreF" ).addClass( "hidden");
                                                              $( "#inputRef" ).addClass( "hidden");
                                                              $( "#btnTrans" ).addClass( "hidden");
                                                              $( "#idFCuen" ).addClass( "hidden");
                                                              $( "#inpCuenx" ).addClass( "hidden");
                                                              $( "#teleEssa" ).addClass( "hidden");
                                                              $( "#btnRefeAgre" ).addClass( "hidden");
                                                              $( "#fuanEtk" ).addClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $( "#nroCxref" ).val(""); // $( "#montSif" ).val("");
                                                             
                                                           
                                                    }else if(dat=="2" && fin=="4" ){
                                                        
                                                              $( "#idfa" ).removeClass( "hidden");
                                                              $( "#idfa" ).text("F. FALLECIDO");
                                                              $( "#fallecido" ).removeClass( "hidden");
                                                             $( "#viewTextPabellon" ).addClass( "hidden");
                                                              $( "#viewListPabellon" ).addClass( "hidden");
                                                              $( "#idreF" ).addClass( "hidden");
                                                              $( "#inputRef" ).addClass( "hidden");
                                                              $( "#btnTrans" ).addClass( "hidden");
                                                              $( "#idFCuen" ).addClass( "hidden");
                                                              $( "#inpCuenx" ).addClass( "hidden");
                                                              $( "#teleEssa" ).addClass( "hidden");
                                                              $( "#btnRefeAgre" ).addClass( "hidden");
                                                              $( "#fuanEtk" ).removeClass( "hidden");
                                                              $( "#txtitleAudi" ).removeClass( "hidden");
                                                              $( "#txtValorAudi" ).removeClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $( "#nroCxref" ).val(""); // $( "#montSif" ).val("");
                                                      
                                                    }else if(dat=="2" && fin=="3" ){
                                                        
                                                              $( "#idfa" ).removeClass( "hidden");
                                                              $( "#idfa" ).text("F. FALLECIDO");
                                                              $( "#fallecido" ).removeClass( "hidden");
                                                              $( "#viewTextPabellon" ).addClass( "hidden");
                                                             $( "#viewListPabellon" ).addClass( "hidden");
                                                              $( "#idreF" ).addClass( "hidden");
                                                              $( "#inputRef" ).addClass( "hidden");
                                                              $( "#btnTrans" ).addClass( "hidden");
                                                              $( "#idFCuen" ).addClass( "hidden");
                                                              $( "#inpCuenx" ).addClass( "hidden");
                                                              $( "#teleEssa" ).addClass( "hidden");
                                                              $( "#btnRefeAgre" ).addClass( "hidden");
                                                              $( "#fuanEtk" ).removeClass( "hidden");
                                                              $( "#txtitleAudi" ).removeClass( "hidden");
                                                              $( "#txtValorAudi" ).removeClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $( "#nroCxref" ).val("");
                                                             //  $( "#montSif" ).val("");
                                                      
                                                    }else if(dat=="2" && fin=="2" ){
                                                        
                                                              $( "#idfa" ).removeClass( "hidden");
                                                              $( "#idfa" ).text("F. FALLECIDO");
                                                              $( "#fallecido" ).removeClass( "hidden");
                                                             $( "#viewTextPabellon" ).addClass( "hidden");
                                                             $( "#viewListPabellon" ).addClass( "hidden");
                                                              $( "#idreF" ).addClass( "hidden");
                                                              $( "#inputRef" ).addClass( "hidden");
                                                              $( "#btnTrans" ).addClass( "hidden");
                                                              $( "#idFCuen" ).addClass( "hidden");
                                                              $( "#inpCuenx" ).addClass( "hidden");
                                                              $( "#teleEssa" ).addClass( "hidden");
                                                              $( "#btnRefeAgre" ).addClass( "hidden");
                                                              $( "#fuanEtk" ).removeClass( "hidden");
                                                              $( "#txtitleAudi" ).removeClass( "hidden");
                                                              $( "#txtValorAudi" ).removeClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $( "#nroCxref" ).val(""); // $( "#montSif" ).val("");
                                                      
                                                    }else if(dat=="2" && fin=="1" ){
                                                        
                                                              $( "#idfa" ).removeClass( "hidden");
                                                              $( "#idfa" ).text("F. FALLECIDO");
                                                              $( "#fallecido" ).removeClass( "hidden");
                                                             $( "#viewTextPabellon" ).addClass( "hidden");
                                                             $( "#viewListPabellon" ).addClass( "hidden");
                                                              $( "#idreF" ).addClass( "hidden");
                                                              $( "#inputRef" ).addClass( "hidden");
                                                              $( "#btnTrans" ).addClass( "hidden");
                                                              $( "#idFCuen" ).addClass( "hidden");
                                                              $( "#inpCuenx" ).addClass( "hidden");
                                                              $( "#teleEssa" ).addClass( "hidden");
                                                              $( "#btnRefeAgre" ).addClass( "hidden");
                                                              $( "#fuanEtk" ).addClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $( "#nroCxref" ).val(""); // $( "#montSif" ).val("");
                                                             
                                                      
                                                    }else if(dat=="11" && fin=="4"){
                                                        
                                                               $( "#idreF" ).removeClass( "hidden");
                                                               $( "#idreF" ).text("MOTIVO");
                                                               $( "#inputRef" ).removeClass( "hidden");
                                                               $( "#idfa" ).addClass( "hidden");
                                                               $( "#fallecido").addClass( "hidden");
                                                               $( "#viewTextPabellon" ).addClass( "hidden");
                                                              $( "#viewListPabellon" ).addClass( "hidden");
                                                               $( "#btnTrans" ).addClass( "hidden");
                                                               $( "#idFCuen" ).addClass( "hidden");
                                                               $( "#inpCuenx" ).addClass( "hidden");
                                                               $( "#teleEssa" ).addClass( "hidden");
                                                               $( "#btnRefeAgre" ).addClass( "hidden");
                                                               $( "#fuanEtk" ).removeClass( "hidden");
                                                               $( "#txtitleAudi" ).removeClass( "hidden");
                                                               $( "#txtValorAudi" ).removeClass( "hidden");
                                                               $( "#titleNvaCxt" ).removeClass( "hidden");
                                                               $( "#inpNvaCta" ).removeClass( "hidden");
                                                               $( "#nroCxref" ).val("");  //$( "#montSif" ).val("");
                                                      
                                                    }else if(dat=="11" && fin=="3"){
                                                        
                                                               $( "#idreF" ).removeClass( "hidden");
                                                               $( "#idreF" ).text("MOTIVO");
                                                               $( "#inputRef" ).removeClass( "hidden");
                                                               $( "#idfa" ).addClass( "hidden");
                                                               $( "#fallecido").addClass( "hidden");
                                                              $( "#viewTextPabellon" ).addClass( "hidden");
                                                               $( "#viewListPabellon" ).addClass( "hidden");
                                                               $( "#btnTrans" ).addClass( "hidden");
                                                               $( "#idFCuen" ).addClass( "hidden");
                                                               $( "#inpCuenx" ).addClass( "hidden");
                                                               $( "#teleEssa" ).addClass( "hidden");
                                                               $( "#btnRefeAgre" ).addClass( "hidden");
                                                               $( "#fuanEtk" ).removeClass( "hidden");
                                                               $( "#txtitleAudi" ).removeClass( "hidden");
                                                               $( "#txtValorAudi" ).removeClass( "hidden");
                                                               $( "#titleNvaCxt" ).removeClass( "hidden");
                                                               $( "#inpNvaCta" ).removeClass( "hidden");
                                                               $( "#nroCxref" ).val(""); // $( "#montSif" ).val("");
                                                              
                                                      
                                                    }else if(dat=="11" && fin=="2"){
                                                        
                                                               $( "#idreF" ).removeClass( "hidden");
                                                               $( "#idreF" ).text("MOTIVO");
                                                               $( "#inputRef" ).removeClass( "hidden");
                                                               $( "#idfa" ).addClass( "hidden");
                                                               $( "#fallecido").addClass( "hidden");
                                                               $( "#viewTextPabellon" ).addClass( "hidden");
                                                               $( "#viewListPabellon" ).addClass( "hidden");
                                                               $( "#btnTrans" ).addClass( "hidden");
                                                               $( "#idFCuen" ).addClass( "hidden");
                                                               $( "#inpCuenx" ).addClass( "hidden");
                                                               $( "#teleEssa" ).addClass( "hidden");
                                                               $( "#btnRefeAgre" ).addClass( "hidden");
                                                               $( "#fuanEtk" ).removeClass( "hidden");
                                                               $( "#txtitleAudi" ).removeClass( "hidden");
                                                               $( "#txtValorAudi" ).removeClass( "hidden");
                                                               $( "#titleNvaCxt" ).removeClass( "hidden");
                                                               $( "#inpNvaCta" ).removeClass( "hidden");
                                                               $( "#nroCxref" ).val("");
                                                      
                                                    }else if(dat=="11" && fin=="1"){
                                                        
                                                               $( "#idreF" ).removeClass( "hidden");
                                                               $( "#idreF" ).text("MOTIVO");
                                                               $( "#inputRef" ).removeClass( "hidden");
                                                               $( "#idfa" ).addClass( "hidden");
                                                               $( "#fallecido").addClass( "hidden");
                                                               $( "#viewTextPabellon" ).addClass( "hidden");
                                                              $( "#viewListPabellon" ).addClass( "hidden");
                                                               $( "#btnTrans" ).addClass( "hidden");
                                                               $( "#idFCuen" ).addClass( "hidden");
                                                               $( "#inpCuenx" ).addClass( "hidden");
                                                               $( "#teleEssa" ).addClass( "hidden");
                                                               $( "#btnRefeAgre" ).addClass( "hidden");
                                                               $( "#fuanEtk" ).addClass( "hidden");
                                                                 $( "#titleNvaCxt" ).removeClass( "hidden");
                                                               $( "#inpNvaCta" ).removeClass( "hidden");
                                                               $( "#nroCxref" ).val("");
                                                              
                                                      
                                                    }else if(dat=="3" && fin=="4"){
                                                              $( "#idfa" ).addClass( "hidden");
                                                              $( "#idfa" ).text("PABELLON");
                                                              $( "#fallecido").addClass( "hidden");
                                                             $( "#viewTextPabellon" ).removeClass( "hidden");
                                                             $( "#viewListPabellon" ).removeClass( "hidden");
                                                              $( "#idreF" ).addClass( "hidden");
                                                              $( "#inputRef" ).addClass( "hidden");
                                                              $( "#btnTrans" ).addClass( "hidden");
                                                              $( "#fuanEtk" ).removeClass( "hidden");
                                                              $( "#idFCuen" ).removeClass( "hidden");
                                                              $( "#inpCuenx" ).removeClass( "hidden");
                                                              $( "#teleEssa" ).addClass( "hidden");
                                                              $( "#btnRefeAgre" ).addClass( "hidden");
                                                              $( "#txtitleAudi" ).addClass( "hidden");
                                                              $( "#txtValorAudi" ).addClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $( "#nroCxref" ).val("");  //$( "#montSif" ).val("0");
                                                              
                                                       
                                                    }else if(dat=="3" && fin=="3"){
                                                              $( "#idfa" ).addClass( "hidden");
                                                              $( "#idfa" ).text("PABELLON");
                                                              $( "#fallecido").addClass( "hidden");
                                                              $( "#viewTextPabellon" ).removeClass( "hidden");
                                                              $( "#viewListPabellon" ).removeClass( "hidden");
                                                              $( "#idreF" ).addClass( "hidden");
                                                              $( "#inputRef" ).addClass( "hidden");
                                                              $( "#btnTrans" ).addClass( "hidden");
                                                              $( "#fuanEtk" ).removeClass( "hidden");
                                                              $( "#idFCuen" ).removeClass( "hidden");
                                                              $( "#inpCuenx" ).removeClass( "hidden");
                                                              $( "#teleEssa" ).addClass( "hidden");
                                                              $( "#btnRefeAgre" ).addClass( "hidden");
                                                              $( "#txtitleAudi" ).addClass( "hidden");
                                                              $( "#txtValorAudi" ).addClass( "hidden");
                                                               $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden"); // $( "#montSif" ).val("0");
                                                               $( "#nroCxref" ).val("");
                                                       
                                                    }else if(dat=="3" && fin=="2"){
                                                              $( "#idfa" ).addClass( "hidden");
                                                              $( "#idfa" ).text("PABELLON");
                                                              $( "#fallecido").addClass( "hidden");
                                                              $( "#viewTextPabellon" ).removeClass( "hidden");
                                                              $( "#viewListPabellon" ).removeClass( "hidden");
                                                              $( "#idreF" ).addClass( "hidden");
                                                              $( "#inputRef" ).addClass( "hidden");
                                                              $( "#btnTrans" ).addClass( "hidden");
                                                              $( "#fuanEtk" ).removeClass( "hidden");
                                                              $( "#idFCuen" ).removeClass( "hidden");
                                                              $( "#inpCuenx" ).removeClass( "hidden");
                                                              $( "#teleEssa" ).addClass( "hidden");
                                                              $( "#btnRefeAgre" ).addClass( "hidden");
                                                              $( "#txtitleAudi" ).addClass( "hidden");
                                                              $( "#txtValorAudi" ).addClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $( "#nroCxref" ).val("");  //$( "#montSif" ).val("0");
                                                              
                                                       
                                                    }else if(dat=="3" && fin=="1"){
                                                              $( "#idfa" ).addClass( "hidden");
                                                              $( "#idfa" ).text("PABELLON");
                                                              $( "#fallecido").addClass( "hidden");
                                                              $( "#viewTextPabellon" ).removeClass( "hidden");
                                                              $( "#viewListPabellon" ).removeClass( "hidden");
                                                              $( "#idreF" ).addClass( "hidden");
                                                              $( "#inputRef" ).addClass( "hidden");
                                                              $( "#btnTrans" ).addClass( "hidden");
                                                              $( "#idFCuen" ).removeClass( "hidden");
                                                              $( "#inpCuenx" ).removeClass( "hidden");
                                                              $( "#teleEssa" ).addClass( "hidden");
                                                              $( "#btnRefeAgre" ).addClass( "hidden");
                                                              $( "#fuanEtk" ).addClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $( "#nroCxref" ).val(""); // $( "#montSif" ).val("0");
                                                              
                                                       
                                                    }else if(dat=="3"){
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#idfa" ).text("PABELLON");
                                                                $( "#fallecido").addClass( "hidden");
                                                                $( "#viewTextPabellon" ).addClass( "hidden");
                                                                $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#idreF" ).addClass( "hidden");
                                                                $( "#inputRef" ).addClass( "hidden");
                                                                $( "#btnTrans" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).removeClass( "hidden");
                                                                $( "#idFCuen" ).removeClass( "hidden");
                                                                $( "#inpCuenx" ).removeClass( "hidden");
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                $( "#btnRefeAgre" ).addClass( "hidden");
                                                                 $( "#txtitleAudi" ).removeClass( "hidden");
                                                              $( "#txtValorAudi" ).removeClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $( "#nroCxref" ).val("");  //$( "#montSif" ).val("0");
                                                      
                                                    }else if(dat=="4" && fin=="4"){
                                                      
                                                                $( "#btnRefeAgre" ).removeClass( "hidden");
                                                                $( "#inputRef" ).addClass( "hidden");
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#fallecido").addClass( "hidden");
                                                                $( "#viewTextPabellon" ).addClass( "hidden");
                                                                $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#btnTrans" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).removeClass( "hidden");
                                                                $( "#idFCuen" ).addClass( "hidden");
                                                                $( "#inpCuenx" ).addClass( "hidden");
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                $( "#txtitleAudi" ).removeClass( "hidden");
                                                                $( "#txtValorAudi" ).removeClass( "hidden");
                                                                  $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                                $( "#nroCxref" ).val(""); 
                                                               // $( "#montSif" ).val("");
                                                      
                                                    }else if(dat=="4" && fin=="3"){
                                                      
                                                                $( "#btnRefeAgre" ).removeClass( "hidden");
                                                                $( "#inputRef" ).addClass( "hidden");
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#fallecido").addClass( "hidden");
                                                                $( "#viewTextPabellon" ).addClass( "hidden");
                                                                $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#btnTrans" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).removeClass( "hidden");
                                                                $( "#idFCuen" ).addClass( "hidden");
                                                                $( "#inpCuenx" ).addClass( "hidden");
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                $( "#txtitleAudi" ).removeClass( "hidden");
                                                                $( "#txtValorAudi" ).removeClass( "hidden");
                                                                  $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $( "#nroCxref" ).val(""); // $( "#montSif" ).val("");
                                                      
                                                    }else if(dat=="4" && fin=="2"){
                                                      
                                                                $( "#btnRefeAgre" ).removeClass( "hidden");
                                                                $( "#inputRef" ).addClass( "hidden");
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#fallecido").addClass( "hidden");
                                                                $( "#viewTextPabellon" ).addClass( "hidden");
                                                                $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#btnTrans" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).removeClass( "hidden");
                                                                $( "#idFCuen" ).addClass( "hidden");
                                                                $( "#inpCuenx" ).addClass( "hidden");
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                $( "#txtitleAudi" ).removeClass( "hidden");
                                                                $( "#txtValorAudi" ).removeClass( "hidden");
                                                                  $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $( "#nroCxref" ).val("");  //$( "#montSif" ).val("");
                                                                
                                                      
                                                    }else if(dat=="4" && fin=="1"){
                                                      
                                                                $( "#btnRefeAgre" ).removeClass( "hidden");
                                                                $( "#inputRef" ).addClass( "hidden");
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#fallecido").addClass( "hidden");
                                                                $( "#viewTextPabellon" ).addClass( "hidden");
                                                                $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#btnTrans" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).addClass( "hidden");
                                                                $( "#idFCuen" ).addClass( "hidden");
                                                                $( "#inpCuenx" ).addClass( "hidden");
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                 $( "#txtitleAudi" ).removeClass( "hidden");
                                                              $( "#txtValorAudi" ).removeClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                                $("#nroCxref").val("");  //$( "#montSif" ).val("");
                                                      
                                                    }else if(dat=="5" && fin=="4"){
                                                                $( "#idreF" ).removeClass( "hidden");
                                                                $( "#inputRef" ).removeClass( "hidden");
                                                                $( "#idreF" ).text( "N° CONTRAREF.");
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#fallecido").addClass( "hidden");
                                                                $( "#viewTextPabellon" ).addClass( "hidden");
                                                                $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#btnTrans" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).removeClass( "hidden");
                                                                $( "#idFCuen" ).addClass( "hidden");
                                                                $( "#inpCuenx" ).addClass( "hidden");
                                                                $( "#teleEssa" ).removeClass( "hidden");
                                                                $( "#btnRefeAgre" ).addClass( "hidden");
                                                                $( "#txtitleAudi" ).removeClass( "hidden");
                                                                $( "#txtValorAudi" ).removeClass( "hidden");
                                                                  $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $("#nroCxref").val(""); // $( "#montSif" ).val("");
                                                              
                                                    }else if(dat=="5" && fin=="3"){
                                                                $( "#idreF" ).removeClass( "hidden");
                                                                $( "#inputRef" ).removeClass( "hidden");
                                                                $( "#idreF" ).text( "N° CONTRAREF.");
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#fallecido").addClass( "hidden");
                                                                $( "#viewTextPabellon" ).addClass( "hidden");
                                                               $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#btnTrans" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).removeClass( "hidden");
                                                                $( "#idFCuen" ).addClass( "hidden");
                                                                $( "#inpCuenx" ).addClass( "hidden");
                                                                $( "#teleEssa" ).removeClass( "hidden");
                                                                $( "#btnRefeAgre" ).addClass( "hidden");
                                                                $( "#txtitleAudi" ).removeClass( "hidden");
                                                                $( "#txtValorAudi" ).removeClass( "hidden");
                                                                  $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $("#nroCxref").val("");  //$( "#montSif" ).val("");
                                                              
                                                    }else if(dat=="5" && fin=="2"){
                                                                $( "#idreF" ).removeClass( "hidden");
                                                                $( "#inputRef" ).removeClass( "hidden");
                                                                $( "#idreF" ).text( "N° CONTRAREF.");
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#fallecido").addClass( "hidden");
                                                                $( "#viewTextPabellon" ).addClass( "hidden");
                                                                $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#btnTrans" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).removeClass( "hidden");
                                                                $( "#idFCuen" ).addClass( "hidden");
                                                                $( "#inpCuenx" ).addClass( "hidden");
                                                                $( "#teleEssa" ).removeClass( "hidden");
                                                                $( "#btnRefeAgre" ).addClass( "hidden");
                                                                $( "#txtitleAudi" ).removeClass( "hidden");
                                                                $( "#txtValorAudi" ).removeClass( "hidden");
                                                                  $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $("#nroCxref").val("");  //$( "#montSif" ).val("");
                                                              
                                                    }else if(dat=="5" && fin=="1"){
                                                                $( "#idreF" ).removeClass( "hidden");
                                                                $( "#inputRef" ).removeClass( "hidden");
                                                                $( "#idreF" ).text( "N° CONTRAREF.");
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#fallecido").addClass( "hidden");
                                                               $( "#viewTextPabellon" ).addClass( "hidden");
                                                                $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#btnTrans" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).addClass( "hidden");
                                                                $( "#idFCuen" ).addClass( "hidden");
                                                                $( "#inpCuenx" ).addClass( "hidden");
                                                                $( "#teleEssa" ).removeClass( "hidden");
                                                                $( "#btnRefeAgre" ).addClass( "hidden");
                                                                  $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $("#nroCxref").val("");  //$( "#montSif" ).val("");
                                                               
                                                    }  else if(dat=="9" && fin=="4"){
                                                                $( "#btnTrans" ).removeClass( "hidden");
                                                                $( "#inputRef" ).addClass( "hidden");
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#fallecido").addClass( "hidden");
                                                             $( "#viewTextPabellon" ).addClass( "hidden");
                                                                $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#idreF" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).removeClass( "hidden");
                                                                $( "#idFCuen" ).addClass( "hidden");
                                                                $( "#inpCuenx" ).addClass( "hidden");
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                $( "#btnRefeAgre" ).addClass( "hidden");
                                                                 $( "#txtitleAudi" ).removeClass( "hidden");
                                                              $( "#txtValorAudi" ).removeClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $("#nroCxref").val(""); // $( "#montSif" ).val("");
                                                       
                                                    }else if(dat=="9" && fin=="3"){
                                                                $( "#btnTrans" ).removeClass( "hidden");
                                                                $( "#inputRef" ).addClass( "hidden");
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#fallecido").addClass( "hidden");
                                                               $( "#viewTextPabellon" ).addClass( "hidden");
                                                                $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#idreF" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).removeClass( "hidden");
                                                                $( "#idFCuen" ).addClass( "hidden");
                                                                $( "#inpCuenx" ).addClass( "hidden");
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                $( "#btnRefeAgre" ).addClass( "hidden");
                                                                 $( "#txtitleAudi" ).removeClass( "hidden");
                                                              $( "#txtValorAudi" ).removeClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $("#nroCxref").val(""); // $( "#montSif" ).val("");
                                                       
                                                    }
                                                    else if(dat=="9" && fin=="2"){
                                                                $( "#btnTrans" ).removeClass( "hidden");
                                                                $( "#inputRef" ).addClass( "hidden");
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#fallecido").addClass( "hidden");
                                                                $( "#viewTextPabellon" ).addClass( "hidden");
                                                                $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#idreF" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).removeClass( "hidden");
                                                                $( "#idFCuen" ).addClass( "hidden");
                                                                $( "#inpCuenx" ).addClass( "hidden");
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                $( "#btnRefeAgre" ).addClass( "hidden");
                                                                $( "#txtitleAudi" ).removeClass( "hidden");
                                                                $( "#txtValorAudi" ).removeClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $kj = $("#nroCxref").val();
                                                                if($kj==""){
                                                                     $("#nroCxref").val("6207-");
                                                                }
                                                                // $( "#montSif" ).val("");
                                                       
                                                    }else if(dat=="9" && fin=="1"){
                                                                $( "#btnTrans" ).removeClass( "hidden");
                                                                $( "#inputRef" ).addClass( "hidden");
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#fallecido").addClass( "hidden");
                                                               $( "#viewTextPabellon" ).addClass( "hidden");
                                                                $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#idreF" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).addClass( "hidden");
                                                                $( "#idFCuen" ).addClass( "hidden");
                                                                $( "#inpCuenx" ).addClass( "hidden");
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                $( "#btnRefeAgre" ).addClass( "hidden");
                                                                $( "#txtitleAudi" ).removeClass( "hidden");
                                                                $( "#txtValorAudi" ).removeClass( "hidden");
                                                                  $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                                $("#nroCxref").val("");//$( "#montSif" ).val("");
                                                       
                                                    } else{
                                                                $( "#idfa" ).addClass( "hidden");
                                                                $( "#fallecido" ).addClass( "hidden");
                                                                $( "#idreF" ).addClass( "hidden");
                                                                $( "#inputRef" ).addClass( "hidden");
                                                               $( "#viewTextPabellon" ).addClass( "hidden");
                                                                $( "#viewListPabellon" ).addClass( "hidden");
                                                                $( "#btnTrans" ).addClass( "hidden");
                                                                $( "#fuanEtk" ).removeClass( "hidden");
                                                                $( "#idFCuen" ).addClass( "hidden");
                                                                $( "#inpCuenx" ).addClass( "hidden");
                                                                $( "#teleEssa" ).addClass( "hidden");
                                                                $( "#btnRefeAgre" ).addClass( "hidden");
                                                                $( "#txtitleAudi" ).removeClass( "hidden");
                                                                $( "#txtValorAudi" ).removeClass( "hidden");
                                                                $( "#titleNvaCxt" ).addClass( "hidden");
                                                               $( "#inpNvaCta" ).addClass( "hidden");
                                                               $("#nroCxref").val("");//$( "#montSif" ).val("");
                                                    }
                                                    
                                                });
                                        });
                                    </script>
                                   <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">DESTINO</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                      <select class="form-control" name="espost" id="espost" required="required" tabindex="53">                   
                                                   
                                                  </select>
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12 hidden" id="idfa">F. </label>
                                        <div class="col-md-4 col-sm-12 col-xs-12 hidden" id="fallecido">
                                                  <input type="date" class="form-control" required="required" name="fefa" id="fefa" tabindex="54">
                                      </div>
                                            <label class="control-label col-md-1 col-sm-3 col-xs-12 hidden" id="idreF">NRO REFERIDO</label>
                                            <div class="col-md-3 col-sm-12 col-xs-12 hidden" id="inputRef">
                                                     
                                                       <select class="form-control" name="referido" id="referido" style="text-transform: uppercase;" required="required" tabindex="55">
                                                         </select>
                                            </div>
                                            <label class="control-label col-md-1 col-sm-3 col-xs-12 hidden" style="font-size: 11px;" id="titleNvaCxt">NVO FINANC.</label>
                                            <div class="col-md-2 col-sm-12 col-xs-12 hidden" id="inpNvaCta">
                                                       <select class="form-control" name="nvaCta" id="nvaCta" style="text-transform: uppercase;" required="required" tabindex="56">
                                                         </select>
                                            </div>
                                            <label for="title" class="col-sm-1 control-label hidden" id="viewTextPabellon">PABELLON</label>
                                            <div class="col-sm-3 hidden" id="viewListPabellon">
                                                <select class="form-control" name="pabellones" id="pabellones" style="text-transform: uppercase;" required="required" tabindex="57">
                                                </select>
                                            </div>
                                        
                                             <div class="col-sm-4 hidden" id="btnTrans">
                                                 <a class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-smExamenx" id="examPx"  
                                                     onclick="verExmaen();"><i class="fa fa-medkit"></i>  Agregar Fecha y Nro contrareferencia</a>
                                            </div>
                                             <div class="col-sm-4 hidden" id="btnRefeAgre">
                                                 <a class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-smRefex" id="examPx" 
                                                     onclick="verExmaenRef();"><i class="fa fa-medkit"></i>  Agregar Nro referencia y EESS</a>
                                            </div>
                                            <label class="control-label col-md-1 col-sm-3 col-xs-12 hidden" id="idFCuen">CTA&nbsp;HOSPI</label>
                                            <div class="col-md-2 col-sm-12 col-xs-12 hidden" id="inpCuenx">
                                                      <input type="text" class="form-control" required="required" name="ctaHos" id="ctaHos" tabindex="30">
                                            </div>
                                           
                                    </div>
                                    <?php $mto=""; if($tix =="1"){ $mto="MONTO TOTAL"; ?>
                                    <div class="form-group">
                                         <label class="control-label col-md-2 col-sm-3 col-xs-12">TIPO SERVICIO</label>
                                              <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <select class="form-control" name="ubicacionDes" id="ubicacionDes" required="required" tabindex="58">
                                                                <option value="">Seleccionar</option>
                                                                <option value="1">ADULTO</option>
                                                                <option value="2">COVID</option>
                                                                <option value="3">MATERNO</option>
                                                    </select>
                                                </div>
                                         <label class="control-label col-md-2 col-sm-3 col-xs-12">SERVICIO EGRESO</label>
                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                <select class="form-control" name="tipoSeiNDes" id="tipoSeiNDes" required="required" tabindex="59"> 
                                                            
                                                </select>
                                            </div>
                                       
                                 
                                    </div>
                                    <?php } else if($tix =="2"){ $mto="CONSUMO HOSP"; ?>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" >PAB. EGRESO</label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <select class="form-control" name="pab2Hos" id="pab2Hos" required="required" tabindex="60" >
                                                                   
                                                          </select>
                                                        </div>
                                     
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" >CAMA EGRESO</label>
                                          <div class="col-md-3 col-sm-12 col-xs-12 " id="">
                                               <input class="form-control" id="camHos2"  name="camHos2" >
                                            </div>
                                    </div>
                                    <?php } if($tix !="3") {?>
                                     <div class="form-group">
                                     <!-- <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">FECHA INGRESO</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12" id="inputel">
                                        <input type="date" class="form-control" required="required" name="feingreAlta" id="feingreAlta" tabindex="17" >
                                      </div>-->
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA ALTA</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                          <input type="date" class="form-control" required="required"  name="feAltaAlt" id="feAltaAlt" tabindex="61"  onchange="handlerDiasAlta(event);" onkeydown="return false">
                                        </div>
                                    </div>
                                    <?php }  ?>
                                   <div class="form-group" id="montosAlo">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">MONTO GALENOS</label>
                                      <div class="col-md-2 col-sm-12 col-xs-12" id="inputel555">
                                        <input type="text" class="form-control" required="required" name="monGal" id="monGal" tabindex="62" >
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">MONTO SISFAR</label>
                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                          <input type="text" class="form-control" required="required"  name="montSif" id="montSif" tabindex="63"  >
                                        </div>
                                         <label class="control-label col-md-2 col-sm-3 col-xs-12"><?php echo $mto; ?></label>
                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                          <input type="text" class="form-control" required="required"  name="monTotalCo" id="monTotalCo" readonly >
                                        </div>
                                    </div>
                                     <?php  if($tix !="3"){ ?>
                                     <div class="form-group" id="teleEssa">
                                          <label class="control-label col-md-2 col-sm-3 col-xs-12" id="titleEss" >EESS</label>
                                          <div class="col-md-6 col-sm-12 col-xs-12" id="inputel99">
                                            <input type="text" class="form-control" required="required"  name="eess" id="eess" tabindex="64" >
                                          </div>
                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">NRO CONTRAREF.</label>
                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                              <input type="text" class="form-control" required="required"  name="nroCxref" id="nroCxref" tabindex="65" >
                                            </div>
                                      
                                    </div>
                                   <?php  } ?>
                                 <!--  <div class="form-group">
                                             
                                              <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">LIQUIDADOR</label>
                                              <div class="col-md-3 col-sm-12 col-xs-12" id="inputel34">
                                                <select class="form-control" name="liquidador" id="liquidador" required="required" tabindex="10">>
                                                        <option value="">-- Seleccionar --</option>
                                                        <option value="3">USUARIO 1</option>
                                                        <option value="C/C">USUARIO 2</option>
                                                </select>
                                              </div>
                                     </div>-->
                                      <div class="form-group" id="rowRaTEN">
                                           <label class="control-label col-md-2 col-sm-3 col-xs-12" >RESP. ATENCION</label>
                                           <div class="col-md-7 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="rsatencion" id="rsatencion" tabindex="66" >
                                           </div>
                                     
                                      </div>
                                       <?php  if($tix !="3"){ ?>
                                      <div class="form-group hidden" id="fuanEtk">
                                              <label class="control-label col-md-2 col-sm-3 col-xs-12" id="tituloFux">FUA ENTREGADO</label>
                                              <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <select class="form-control" name="fuaEntre" id="fuaEntre" required="required" tabindex="67"  >
                                                                <option value="">Seleccionar</option>
                                                                <option value="SI">SI</option>
                                                                <option value="NO">NO</option>
                                                                
                                                    </select>
                                                </div>
                                         <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA ENTREGA</label>
                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                <input type="date" class="form-control" required="required" name="fechaFuaEntre" id="fechaFuaEntre" tabindex="68" >
                                            </div>
                                            <label class="control-label col-md-1 col-sm-3 col-xs-12" id="txtitleAudi">AUDITOR</label>
                                              <div class="col-md-3 col-sm-12 col-xs-12" id="txtValorAudi">
                                                    <select class="form-control" name="reciAudit" id="reciAudit" required="required" tabindex="69"></select>
                                                </div>
                                       
                                    </div>
                                   <?php } ?>
                                    
                                    <div class="form-group ">
                                         <?php if($tix =="1"){ ?>
                                       <label class="control-label col-md-2 col-sm-3 col-xs-12 hidden" >RECEP. ALTA</label>
                                       <div class="col-md-6 col-sm-12 col-xs-12 hidden">
                                                    <input type="text" class="form-control" required="required"  name="registraAlta" id="registraAlta" tabindex="71" >
                                       </div>
                                           
                                   <?php } if($tix =="1" || $tix =="2" || $tix =="3"){ ?>
                                            
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" id="txtLi" >LIQUIDA</label>
                                      <div class="col-md-1 col-sm-12 col-xs-12" id="divCehck">
                                        <div class="checkbox" style="margin-bottom:0px;">
                                          <input type="checkbox" class="form-control" name="liquIx" id="liquIx" tabindex="72" style="width: 20px;margin-left: 1px;margin-top: -6px;">
                                          <input type="hidden" name="idUserLiquida" id="idUserLiquida"   >
                                        </div>
                                      </div>
                                       <?php } if($tix =="1"){  ?>
                                       
                                       <div id="tixLiq">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">TIPO DE LIQUIDACION</label>
                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                        <select class="form-control" name="tipoLiqux" id="tipoLiqux" required="required" tabindex="53">
                                                                <option value="">Seleccionar</option>
                                                                <option value="H.CLINICA">H.CLINICA</option>
                                                                <option value="PAPELETA ALTA">PAPELETA ALTA</option>
                                                                <option value="CONTRASEÑA">CONTRASEÑA</option>
                                                                <option value="DEPURACION">DEPURACION</option>
                                                                <option value="HOSPITALIZACION">HOSPITALIZACION</option>
                                                                <option value="FUA RECUPERADO">FUA RECUPERADO</option>
                                                        </select>
                                                  </div>
                                       </div>
                                      
                                      
                                       <?php } ?>
                                    </div>
                                      
                                    </div>
                                    <!-- 4 PESTAÑA -->
                                    
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="house-tab">  <br>
                                    
                                    
                                            <form class="formulario form-horizontal form-label-left input_mask" method="POST" id="frmActividadAuditoria">
                                                 
                                                <input type="hidden" name="idActividad" id="idActividad" >
                                                
                                                <div class="form-group " id="">
                                                     <label class="control-label col-md-2 col-sm-3 col-xs-12" >ACTIVIDAD</label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                                <select class="form-control" name="actividadAudit" id="actividadAudit" required="required" tabindex="4">
                                                                           
                                                                </select>
                                                            </div>
                                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" style="font-size: 12px;" >DETALLE</label>
                                                      <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <select class="form-control" name="proceAuditoria" id="proceAuditoria" required="required" tabindex="4">
                                                                          
                                                                </select>
                                                       </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                 <label class="control-label col-md-2 col-sm-3 col-xs-12" >DIAGNOSTICO</label>
                                                        <div class="col-md-10 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" name="dxAudito" id="dxAudito" tabindex="6" style="text-transform: uppercase;" >
                                                        </div>
                                                </div>
                                                       
                                               
                                                 <div class="form-group " id="">
                                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" >OBSERVACIONES</label>
                                                      <div class="col-md-10 col-sm-12 col-xs-12">
                                                            <textarea class="form-control" name="observAuditForm" id="observAuditForm" rows="4" style="text-transform: uppercase;" ></textarea>
                                                      </div>
                                                     
                                                 </div>
                                                  
                                                 
                                            </form>
                                            <div class="form-group " id="">
                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                         <button type="button" class="btn btn-success btn-xs" id="guardarActAudit" onclick="agregarActividaAuditoria();" style="float: right;">
                                                             <i class="fa fa-save"></i> GUARDAR</button>
                                                      </div>
                                                 </div>
                                                  <div class="form-group " id="">
                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="table-responsive" id="datAuditObs" style="float: left;"> </div>
                                                      </div>
                                                 </div>
                                                 
                                   
                                                
                                    </div>
                                    
                                    <!-- FIN DE 4 PESTAÑA -->
                                     
                                </div>
                                
                        </div>
                        
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default hidden" onclick="LimpiarForm();">LIMPIAR</button>
                                      
                                      <?php if($permisoRegistro != 1){ ?>
                                      <button type="button" class="btn btn-danger " id="guardarEmege" onclick="RegistrarPacienteEm();">GUARDAR</button>
                                      <?php }  ?>
                                      <button type="button" class="btn btn-danger hidden" style="background: #48a502;border: 1px solid #48a502;"  id="butonAudit">FUA AUDITADA</button>
                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrar">CERRAR</button>
                                    </div>
                                
                            </div>
                          </div>
                        </form>
                    </div>
                  </div>
                 </div>
        <!-- FIN EMERFENCIAS -->
        
        <!-- modal tranferencia-->
        
         <div class="modal fade bs-example-modal-smExamenx" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">

                                <div class="modal-header" style="background:red;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacient">CONTRAREFERENCIA</h4>
                                </div>
                                <div class="modal-body">
                        
                                  <form class="formulario form-horizontal form-label-left input_mask" method="POST" id="formExamenx">
                                    <input type="hidden" name="iduserEx"  id="iduserEx" value="<?php echo $iduser; ?>">
                                    <input type="hidden" name="iddEx" id="iddEx">
                                                 <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" style="text-align: center;margin-top:2px;">FECHA</label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12" style="margin-left: 30px;">
                                                              <input type="date" class="form-control"  name="fechaex" id="fechaex"  > 
                                                          </div>
                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: center;margin-top: 2px;">NUMERO</label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12" >
                                                              <input type="text" class="form-control"  name="nrotrans" id="nrotrans" value="6207-" > 
                                                          </div>
                                                          <br>
                                                          
                                                 </div>
                                                 <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" >EESS</label>
                                                          <div class="col-md-10 col-sm-12 col-xs-12"  style="margin-left: 34px;">
                                                              <input type="text" class="form-control"  name="eessRefModal" id="eessRefModal" > 
                                                          </div>
                                                          <br>
                                                 </div>
                                                  <div class="form-group hidden">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" >COD. RENIPRESS</label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12" style="margin-left:36px;">
                                                              <input type="text" class="form-control"  name="codeReni" id="codeReni" > 
                                                          </div>
                                                          <br>
                                                 </div>
                                                <div class="form-group" style="float: right;margin-top: 20px;">
                                                        <button type="button" class="btn btn-success btn-xs" id="masExamen" onclick="agregarExamen();"><i class="fa fa-save"></i> Agregar</button>                                      
                                                        <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarExamen">CERRAR</button>
                                                </div>
                                              <div class="form-group ">
                                                      <div class="table-responsive" id="datExr" style="float: left;"> 
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
        <!-- fin modal trasnferencia -->
        <!-- modal OBSERVACIONES-->
        
         <div class="modal fade bs-example-modal-modalObserv" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">

                                <div class="modal-header" style="background:red;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacient">OBSERVACIONES</h4>
                                </div>
                                <div class="modal-body">
                        
                                  <form class="formulario form-horizontal form-label-left input_mask" method="POST" id="formObsePax">
                                    <input type="hidden" name="iduserObsaPax"  id="iduserObsaPax" value="<?php echo $iduser; ?>">
                                    <input type="hidden" name="idPaObs" id="idPaObs">
                                    <input type="hidden" name="ids" id="ids">
                                    <input type="hidden" name="codeXcuenta" id="codeXcuenta">
                                                 
                                                 <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" style="font-size: 12px;">OBSERVACION</label>
                                                          <div class="col-md-10 col-sm-12 col-xs-12"  style="margin-left: 46px;">
                                                              <textarea class="form-control"  name="obsPaix" id="obsPaix" rows="3" style="text-transform: uppercase;"></textarea>
                                                          </div>
                                                          <br>
                                                 </div>
                                                 
                                                <div class="form-group" style="float: right;margin-top: 20px;">
                                                        <button type="button" class="btn btn-success btn-xs" id="masExamen" onclick="agregarObsevPax();"><i class="fa fa-save"></i> Agregar</button>                                      
                                                        <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraObsverPax">CERRAR</button>
                                                </div>
                                              

                                  </form>
                                </div>
                               
                           </div>
                    </div>
                  </div>
        <!-- fin modal OBSERVACIONES -->
         <!-- MODAL PROCEDIMIENTOS -->
                    
                        <div class="modal fade bs-example-modal-verAtencionesAuditoriaCE" tabindex="-1" id="myModal" role="dialog"  >
                                <div class="modal-dialog modal-lg" style="width: 1100px;">
                                  <div class="modal-content">

                                            <div class="modal-header" style="background:#6bb7f7;color: white;text-transform: uppercase;text-align: center;">
                                                <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                                <h4 class="modal-title" id="pacient">ASIGNACION</h4>
                                            </div>
                                            <div class="modal-body">
                                               
                                                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="verAtencionesSinAuditor"></div><br>
                                            </div>
                                            
                                      </div>
                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraModlAgrs">CERRAR</button>
                                </div>

                        </div>


                      <!-- FIN MODAL PROCEDIMIENTOS -->
                      
                      <!-- MODAL VER MASIVO -->
                    
                        <div class="modal fade bs-example-modal-verEstadoMasivoModal" tabindex="-1" id="myModal" role="dialog"  >
                                <div class="modal-dialog modal-lg" style="width: 1100px;">
                                  <div class="modal-content">

                                            <div class="modal-header" style="background:#6bb7f7;color: white;text-transform: uppercase;text-align: center;">
                                                <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                                <h4 class="modal-title" id="pacient">ACREDITACION MASIVA</h4>
                                            </div>
                                            <div class="modal-body" style="padding: 0px;">
                                               
                                              <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="verEstadoMasivo"></div><br>
                                              <!--<iframe  height="550" width="1090" id="verEstadoMasivo" style="border: 1px solid white;"></iframe> -->
                                            </div>
                                            
                                      </div>
                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraModlAgrs">CERRAR</button>
                                </div>

                        </div>


                      <!-- FIN MODAL PROCEDIMIENTOS -->
         <!-- modal referencia-->
        
         <div class="modal fade bs-example-modal-smRefex" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">

                                <div class="modal-header" style="background:red;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacient">REFERENCIA</h4>
                                </div>
                                <div class="modal-body">
                        
                                  <form class="formulario form-horizontal form-label-left input_mask" method="POST" id="formExamenxRefs">
                                    <input type="hidden" name="iduserEx"  id="iduserEx" value="<?php echo $iduser; ?>">
                                    <input type="hidden" name="iddExRef" id="iddExRef">
                                                 <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" >FECHA</label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12" style="margin-left: 31px;">
                                                              <input type="date" class="form-control"  name="fechaexRef" id="fechaexRef"  > 
                                                          </div>
                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" >NUMERO</label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12" >
                                                              <input type="text" class="form-control"  name="nrotransFeR" id="nrotransFeR" value="6207-" > 
                                                          </div>
                                                          <br>
                                                 </div>
                                                 <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" >EESS</label>
                                                          <div class="col-md-10 col-sm-12 col-xs-12"  style="margin-left: 34px;">
                                                              <input type="text" class="form-control"  name="eesRef" id="eesRef" > 
                                                          </div>
                                                          <br>
                                                 </div>
                                                  <div class="form-group hidden">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" >COD. RENIPRESS</label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12" style="margin-left:36px;">
                                                              <input type="text" class="form-control"  name="codeReni" id="codeReni" > 
                                                          </div>
                                                          <br>
                                                 </div>
                                                <div class="form-group" style="float: right;margin-top: 20px;">
                                                            <button type="button" class="btn btn-success btn-xs" id="masExamesn" onclick="agregarExamenRef();"><i class="fa fa-save"></i> Agregar</button>                                      
                                                        <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarExamenRef">CERRAR</button>
                                                </div>
                                              <div class="form-group ">
                                                      <div class="table-responsive" id="datExrRef" style="float: left;"> 
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
        <!-- fin modal trasnferencia -->
        
          <!-- modal tranferencia-->
        
         <div class="modal fade bs-example-modal-smMotivo" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                    <div class="modal-dialog modal-m" style="width: 450px;">
                      <div class="modal-content">

                                <div class="modal-header" style="background:red;color: white;text-transform: uppercase;text-align: center;">
                                     <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                     <h4 class="modal-title" id="motAlertM">MOTIVO</h4>
                                </div>
                                <div class="modal-body">
                        
                                  <form class="formulario form-horizontal form-label-left input_mask" method="POST" id="frmMotivo">
                                       <input type="hidden" name="iduserMo"  id="iduserMo" value="<?php echo $iduser; ?>">
                                       <input type="hidden" name="idMo" id="idMo">
                                                 <div class="form-group" id="sccMot">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" style="text-align: center;margin-top:2px;">MOTIVO</label>
                                                          <div class="col-md-10 col-sm-12 col-xs-12" style="margin-left: 30px;">
                                                               <textarea class="form-control"  name="motivoHabiBoton" id="motivoHabiBoton" rows="3" style="text-transform: uppercase;"></textarea>
                                                          </div>
                                                          
                                                 </div>
                                                 <div class="form-group hidden" id="txtAlert">
                                                     <center><h1 style="font-size: 17px;color: black;">Para continuar con el registro debe revertir la auditoria.</h1></center> 
                                                 </div>
                                                
                                                <div class="form-group" style="float: right;margin-top: 20px;" id="btnGuarMo">
                                                        <button type="button" class="btn btn-danger" id="masExamen" onclick="insertMotivoUserFecha();"><i class="fa fa-save"></i> Guardar</button>                                      
                                                        <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraMotivo">CERRAR</button>
                                                </div>
                                  </form>
                                </div>
                                
                           </div>
                    </div>
                  </div>
        <!-- fin modal trasnferencia -->

        <div class="modal fade bs-example-modal-sm" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color:white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color:white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title">REGISTRO DEL PACIENTE</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formPaciente" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                    <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                    <input type="hidden" name="ide" value="<?php echo $id ?>" id="ide">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1111" aria-labelledby="home-tab">                                           
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
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12" id="">N° FUA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-3 col-sm-12 col-xs-12">
                                                                <div class="input-group" style="margin-bottom:0px;">
                                                                    <input type="text" class="form-control" name="fua" id="fua"  maxlength="35" required="required" tabindex="6"  >
                                                                 
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
   