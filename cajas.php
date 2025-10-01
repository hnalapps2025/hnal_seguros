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
                                              ((''+month).length < 2 ? '0' : '') + month + '/' +
                                              ((''+day).length < 2 ? '0' : '') + day;


                                var table = $('#pac3grupoCajas').DataTable( {
                                                

                                                  "bProcessing": true,
                                                  "serverSide": true,
                                                  "order": [[ 0, "desc" ]],                                  
                                                  "sPaginationType":"full_numbers",
                                                  "iDisplayLength": 25,
                                                  "lengthChange": false,
                                                  'serverMethod': 'post',
                                                  "dom": '<"top">rt<"bottom"iflp><"clear">',
                                                  "ajax":{
                                                      url :  "./Controlador/search.php?function=listGrupoCajas",
                                                    },
                                                  "columnDefs": [
                                                    { targets: [0,1,2,3,5,6], visible: true},
                                                    { targets: '_all', visible: false 
                                                    
                                                    },{
                                                      className: "dt-left",
                                                      "targets": [5] 
                                                  },{
                                                    className: "dt-right",
                                                    "targets": [] 
                                                  },
                                                  {
                                                      className: "dt-center",
                                                      "targets": [0,2,3,4,5,6]
                                                  }],
                                                  
                                                  "aoColumns": [
                                                        { mData: 'idCa' },
                                                        { mData: 'idUsuario' },
                                                        { mData: 'observacion' },
                                                        { mData: 'fechaRegistro'},
                                                        { mData: 'fechaUpdate' },
                                                        { mData: 'namePaquete' },
                                                        { mData: 'total' },
                                                      
                                                  ],

                                                  dom: '<lfBtip>',
                                                  buttons: [
                                                        /*{
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'PacientesRegistrados'+ output,
                                                            exportOptions: {
                                                              columns: [2,3,4,5,6,7,8,9]
                                                            },
                                                            customize: function(xlsx) {
                                                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                                              $('row[r=2] c', sheet).attr('s', '47');
                                                          }
                                                        }*/
                                                        
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

                                                    "deferRender": true
                                                    
                                                    
                                                      /*scrollY: "450px",
                                                        scrollX: true,*/
                                                      // fin 1 filtro
                                                    
                                                  });
                                      
                                  

                                        $('#pac3grupoCajas_filter').addClass('form-group');
                                        $('#pac3grupoCajas_filter').css('text-align','left');
                                        $('#pac3grupoCajas_filter').css('display','none');
                                        $('#pac3grupoCajas_paginate').css('width','100%');
                                        $('.dt-buttons').css('float','right');
                                       // $('.dt-buttons').css('display','none');
                                        $('.dt-buttons').css('margin-top','0px');
                                        $('#pac3grupoCajas_filter label input').addClass('form-control');
                                        $('#pac3grupoCajas_length label select').addClass('form-control');

                                        $('#serc').on( 'keyup', function () {
                                            table.search( this.value ).draw();
                                        } );


                                    
                                            
                                       
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
                                <h2 style="text-transform: uppercase;">REGISTRO DE CAJAS<small></small></h2>
                                 <!--<button type="button" class="btn btn-success btn-xs" style="margin-left: 60px;">Terminado</button>
                                <button type="button" class="btn btn-warning btn-xs">Pendiente</button>
                                <button type="button" class="btn btn-default btn-xs">Sin asignacion</button>-->
                                <!--<button type="button" class="btn btn-success btn-xs">Enviado</button>
                                              <button type="button" class="btn btn-warning btn-xs">Pendiente</button>-->
                               <!-- <a class="btn btn-success"  href="imporConsol.php"  style="float: right;"><i class="fa fa-file-excel-o"></i> Importar</a>-->
                              
                              <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalCrearCaja" id="agr2" role="button" aria-expanded="false" 
                                style="float: right;background: #fd00b9;border: 1px solid #fd00b9;" onclick="limpiarFromGrupo();"><i class="fa fa-edit m-right-xs"></i> Nuevo Registro</a>
                                  <!--<a href="especial.php" class="btn btn-success"  id="agr2" role="button" style="float: right;" "><i class="fa fa-edit m-right-xs"></i> Importar</a>-->
                               
                                <!--<a href="#" class="dropdown-toggle" data-toggle="modal" data-target=".bs-example-modal-sm" id="agr2" role="button" aria-expanded="false"><i class="fa fa-arrows"></i></a>-->
                                <!--<a href="registrosexcel.php" style="float: right;"><img style="width:30px;" src="<?php echo $path ?>images/excel.png">&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;</a>
                                <a style="float: right;">Exportar a:&nbsp;&nbsp; </a> -->
                                <div class="clearfix"></div>
                              </div>
                              

                              <div class="x_content">
                             
                              <table border="0" style="display:none;" >
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
                              </table> 
                             
                                        <div class="alert alert-success alert-dismissible fade in hidden" role="alert" id="alerify">
                                              <button type="button" class="close" ><span aria-hidden="true" id="closealert">×</span>
                                              </button>
                                              <strong id="pacte"></strong>
                                          </div>
                                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridEmerge"> 
                                            <table class="table jambo_table bulk_action compact"  id="pac3grupoCajas" style="width:100%">
                                                <thead>
                                
                                                  <tr class="headings" style="font-size: 10px;">
                                                        <th class="" style="text-transform: uppercase;text-align: center;">#</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">OPCIONES</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">CAJA</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">USUARIO</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">TOTAL</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">FECHA_REGISTRO</th>
                                                        <th class="" style="text-transform: uppercase;text-align: center;">FECHA_ACTUALIZACION</th>
                                                        
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
          <div class="modal fade bs-example-modal-modalCrearCaja" tabindex="-1" id="myModalIng" role="dialog" >
                    <div class="modal-dialog modal-lg" style="width: 30%;">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title">APERTURAR CAJA</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formCajas" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser"  id="iduser" value="<?php echo $iduser ?>">
                                                     <input type="hidden" name="idCaja"  id="idCaja">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab"><br>
                                                   
                                                      
                                                      <div class="form-group">
                                                           
                                                             <label class="control-label col-md-2 col-sm-3 col-xs-12">DETALLE</label>
                                                              <div class="col-md-9 col-sm-12 col-xs-12">
                                                                 
                                                                  <textarea class="form-control" name="obsCaja" id="obsCaja" rows="6" style="text-transform: uppercase;" tabindex="3"></textarea>
                                                              </div>
                                                      </div>
                                                      
                                    <br><hr>
                                                  
                                                      <button type="button" class="btn btn-danger" id="das" onclick="RegistroCaja();" style="float: right;margin-bottom: 4%;" tabindex="18">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarModalCaja">CERRAR</button>
                                                      
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
   