 <?php 


error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Esta pagina es solo para usuarios registrados'); window.location='index.php';</script>";  
  exit;
} 

include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();


$id = $_GET["id"];
$ni = $pac->consultaXid($id);





include 'Vistas/librerias.php';  

?>

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
                                <h2 style="text-transform: uppercase;">CUENTAS DEL PACIENTE <small></small></h2>
                                <a href="Cuentas.php?id=<?php echo $id."&cuenta=0"; ?>" class="btn btn-success" id="agr2" style="float: right;" ><i class="fa fa-edit m-right-xs"></i> Agregar Cuenta</a>
                                <div class="clearfix"></div>
                              </div>
                              

                              <div class="x_content">

                               <div class="row hidden">
                                        <div class="col-sm-3">   
                                         <form method="GET">
                                           <div class="input-group">
                                               
                                                <input type="text" class="form-control auto" placeholder="Buscar por Número documento" name="pte" id="pte">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary" id="busc"><i class="fa fa-search"></i> BUSCAR</button>
                                                </span>
                                            </div>
                                         </form>                                        
                                            
                                        </div>
                                       
                                </div>

                                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridTipo"> 


                                              <script type="text/javascript">
                                    
                                    $(document).ready(function() {

                                      var not
                                      $("#notificacion").click(function() {
                                             not = "62933279";
                                            
                                       });                                      
                                                $('#pac').DataTable( {
                                                  "searching": true,
                                                   //"oSearch": {"sSearch": "91214268" },
                                                  "pageLength": 20,
                                                  "order": [[ 0, "desc" ]],
                                                  //"bPaginate": false,
                                                  language: {
                                                        "decimal": "",
                                                        "searchPlaceholder": " ..",
                                                        "emptyTable": "No hay información",
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
                                                  });
                                      

                                        $('#pac_filter').addClass('form-group');
                                        $('#pac_filter label input').addClass('form-control');
                                        $('#pac_length label select').addClass('form-control');
                                        $('#pac_length').css("display", "none");
                                        $('.dataTables_filter').css("float", "left");
                                        $('.dataTables_filter').css("text-align", "left");
                                       
                                    } );
                                </script>
                              <table class="table jambo_table bulk_action"  id="pac">
                                    <thead>
                                        <tr class="headings" style="font-size: 10px;">
                                              <!--<th class="column-title">Id </th>-->
                                              <th class="column-title" style="text-transform: uppercase;width:2%;text-align: center;">Id</th>
                                              <th class="column-title" style="width:4%;text-transform: uppercase;text-align: center;">NRO CUENTA</th>
                                              <th class="column-title" style="width: 4%;text-transform: uppercase;text-align: center;">NRO ATENCION</th>
                                              <th class="column-title" style="width: 4%;text-transform: uppercase;text-align: center;">F. INGRESO</th>                                        
                                              <th class="column-title" style="width: 4%;text-transform: uppercase;text-align: center;">F. ALTA MEDICA</th>
                                              <th class="column-title" style="width: 20%;text-transform: uppercase;text-align: center;">Servicio Egreso</th>
                                              <th class="column-title" style="width:3%;text-transform: uppercase;text-align:center;">CAMA</th>
                                              <th class="column-title" style="width: 7%;text-transform: uppercase;text-align:center;">F. REGISTRO</th>
                                              <th class="column-title" style="width: 5%;text-transform: uppercase;text-align: center;">ACCION</th>                                       
                                      </tr>
                                    </thead>

                                    <tbody>
                                         <?php  
                                              
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>

                                            <tr class="even pointer">
                                                      <td style="text-align: center;"><?php echo $mue["IdCuenta"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo $mue["NroCuenta"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;"><?php   echo $mue["NroAtencion"]; ?></td>
                                                      <td style="text-transform: uppercase;font-size: 12px;text-align: center;"><?php echo $mue["FechaIngreso"]; ?></td>                                                      
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;"><?php echo $mue["FechaAltaMedica"]; ?></td> 
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;"><?php echo $mue["SerEgreso"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;"><?php echo $mue["Cama"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;"><?php echo $mue["FechaRegistro"]; ?></td>
                                                      <td style="text-align: center;" > 
                                                        <a href="Cuentas.php?id=<?php echo $id."&cuenta=".$mue["IdCuenta"]; ?>" class="btEdit btn btn-danger btn-xs"><i class="fa fa-search"></i> Ingresar</a>
                                                      </td>                
                                                      
                                            </tr>
                                         <?php }   ?>
                                    </tbody>
                                  </table>                           



                                </div>
                              </div>
                            </div>
                         </div>


                  
                  </div>
        </div>


        <div class="modal fade bs-example-modal-sm" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
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
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">TIPO DOC <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <select class="form-control" name="tipoDoc" id="tipoDoc" required="required" tabindex="1" readonly >
                                                            <option value="">-- Seleccionar --</option>                        
                                                            <option value="DNI">DNI</option>
                                                            <option value="Carnet Ext.">Carnet Ext.</option>
                                                            <option value="Pasaporte">Pasaporte</option>
                                                            <option value="CUI">CUI</option>
                                                            <option value="Otros">Otros</option>
                                                          </select>
                                                        </div>

                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">N° DOC. <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="margin-bottom:0px;">
                                                              <input type="text" class="form-control" name="NroDoc" id="NroDoc" maxlength="11" required="required" tabindex="2" readonly >
                                                              <span class="input-group-btn hidden">
                                                                <button type="button" class="btn btn-primary" id="cargaDni"><i class="fa fa-search"></i></button>
                                                              </span>
                                                            </div>
                                                          </div>
                                                          <script>
                                                              $("#NroDoc").keyup(function () {
                                                                var value = $(this).val();
                                                                $("#hclinica").val(value);
                                                              }).keyup();
                                                          </script>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">F. SOLICITUD REGISTRO</label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <input type="date" class="form-control"  name="solipac" id="solipac" tabindex="3" value="<?php echo date("Y-m-d")?>" readonly>
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">F. INFORME MEDICO</label>
                                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                                  <input type="date" class="form-control"  name="solimedico" id="solimedico" tabindex="4" readonly>
                                                              </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">REGIMEN<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <select class="form-control" name="regimen" id="regimen" required="required" tabindex="5"  readonly>
                                                            <option value="">-- Seleccionar --</option>                          
                                                            <option value="SIS - SEMICONTRIBUTIVO">SIS - SEMICONTRIBUTIVO</option>
                                                            <option value="SIS - NRUS">SIS - NRUS</option>
                                                            <option value="SIS - SUBSIDIADO">SIS - SUBSIDIADO</option>
                                                            <option value="NO SIS">NO SIS</option>
                                                          </select>
                                                        </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">H. CLINICA <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input type="text" class="form-control" name="hclinica" id="hclinica" maxlength="11" required="required" tabindex="6" readonly>
                                                            </div>
                                                          </div>
                                                      </div>
                                                      <script>
                                                        $(document).ready(function(){
                                                            $("select[name=ippress]").change(function(){
                                                                      var dat = $('select[name=ippress]').val();
                                                                      if(dat=="CONVENIO LOAYZA"){
                                                                        $( "#par" ).addClass( "hidden");
                                                                        $( "#inputel" ).addClass( "hidden");
                                                                        $( "#telefam" ).addClass( "hidden");
                                                                      }else{
                                                                        $( "#par" ).removeClass( "hidden");
                                                                        $( "#inputel" ).removeClass( "hidden");
                                                                        $( "#telefam" ).removeClass( "hidden");
                                                                      }
                                                                      
                                                                  });
                                                          });
                                                      </script>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">IPRESS  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <select class="form-control" name="ippress" id="ippress" required="required" tabindex="5" readonly>
                                                            <option value="16918">16918</option>                      
                                                          </select>
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">SEXO</label>
                                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="sexo" id="sexo" required="required" tabindex="6" readonly> 
                                                                          <option value="">-- Seleccionar --</option>
                                                                          <option value="MASCULINO">MASCULINO</option>
                                                                          <option value="FEMENINO">FEMENINO</option>
                                                                  </select>
                                                              </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">TIPO AF.  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <select class="form-control" name="tipoAf" id="tipoAf" required="required" tabindex="7" readonly>
                                                          </select>
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">NRO AF.  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required"  name="NroAf" id="NroAf" tabindex="8" readonly>
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">NOMBRES  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="nombres" id="nombres" tabindex="9" style="text-transform: uppercase;" readonly>
                                                        </div>

                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA NAC.  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="date" class="form-control" required="required"  name="FechaNac" tabindex="12" id="FechaNac" onchange="handler(event);"  readonly >
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">AP. PATERNO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required" value="<?php echo $apepa ?>" name="apepa" id="apepa" tabindex="10"  style="text-transform: uppercase;" readonly>
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">AP. MATERNO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" value="<?php echo $apema?>" name="apema" id="apema"  tabindex="11" style="text-transform: uppercase;" readonly>
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">DEPARTAMENTO  </label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                              <select class="form-control" name="departamento" id="departamento" required="required" tabindex="13" readonly></select>
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">EDAD</label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" name="edad" id="edad" readonly>
                                                          </div>
                                                      </div>
                                                    
                                          
                                                      <div class="form-group">
                                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10</label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="margin-bottom:0px;">
                                                            <input type="text" class="form-control resulcie10" tabindex="15" name="cie10" id="cie10" maxlength="7"  style="text-transform: uppercase;" required="required" readonly>
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-primary" id="cargarcie10"><i class="fa fa-search"></i></button>
                                                            </span>
                                                          </div>
                                                          </div>

                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">DESCRIPCION</label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="margin-bottom:0px;width: 100%;">
                                                            <input type="text" class="form-control" name="descri" id="descri" readonly="readonly" tabindex="16" readonly>
                                                          </div>
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">UPSS</label>
                                                              <div class="col-md-3 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="upss" id="upss" required="required" tabindex="17" readonly>
                                                                      <option value="">-- Seleccionar --</option>                         
                                                                      <option value="SUIE de Hematologia y TPH">SUIE de Hematologia y TPH</option>
                                                                      <option value="SUIE de Cardiologia y Cirugia cardiovascular">SUIE de Cardiologia y Cirugia cardiovascular</option>
                                                                      <option value="SUAIE Cirugia Pediatrica y Neonatal">SUAIE Cirugia Pediatrica y Neonatal</option>
                                                                      <option value="SUAIE Neurocirugia">SUAIE Neurocirugia</option>
                                                                      <option value="SUAIE Especialidades Pediatricas">SUAIE Especialidades Pediatricas</option>
                                                                      <option value="SUAIE Especialidades Quirurgicas">SUAIE Especialidades Quirurgicas</option>
                                                                      <option value="Servicio de Genetica">Servicio de Genetica</option>
                                                                      <option value="Servicio de Radiologia Intervecionista">Servicio de Radiologia Intervecionista</option>
                                                                      <option value="SUAIEQuemados">SUAIEQuemados</option>
                                                                    </select>
                                                              </div>
                                                              <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA INICIO COBERTURA</label>
                                                              <div class="col-md-4 col-sm-12 col-xs-12">
                                                                  <div class="input-group" style="margin-bottom:0px;">
                                                                        <input type="date" class="form-control" required="required"  name="feiniciCobertura" id="feiniciCobertura" readonly>
                                                                  </div>
                                                                </div>
                                                       
                                                      </div>
                                                    
                                                      
                                                      <div class="form-group" style="display:none;" >
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">TELF. FAMILIAR</label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12" id="inputel">
                                                          <input type="text" class="form-control" required="required"  name="telefa" id="telefa" tabindex="17" >
                                                        </div>
                                                       
                                                      </div>                           
                                                      <br><hr>
                                                      <button type="button" class="btn btn-success hidden" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>
                                                      


                                          </div>
                                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                          <div class="form-group">
                                                  
                                                  <h4 style="text-align: center;">DATOS DE LA MADRE</h4>
                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12">TIPO DOC <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <select class="form-control" name="tipoDocPapa" id="tipoDocPapa" required="required" tabindex="1" >
                                                            <option value="">-- Seleccionar --</option>                        
                                                            <option value="DNI">DNI</option>
                                                            <option value="Carnet Ext.">Carnet Ext.</option>
                                                            <option value="Pasaporte">Pasaporte</option>
                                                            <option value="CUI">CUI</option>
                                                            <option value="Otros">Otros</option> 
                                                          </select>
                                                        </div>  
                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">DNI. <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                      <div class="input-group" style="margin-bottom:0px;">
                                                        <input type="text" class="form-control" name="dniMama" id="dniMama" maxlength="11" required="required" placeholder="Ingresa el DNI"  >
                                                      </div>
                                                    </div>
                                            </div>
                                              <div class="form-group">
                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">NOMBRES</label>
                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <input type="text" class="form-control" required="required" name="nombresMama" id="nombresMama"  style="text-transform: uppercase;" placeholder="Ingresa los Nombres" >
                                                  </div>
                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">APELLIDOS</label>
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                      <input type="text" class="form-control" required="required" name="apeMama" id="apeMama" style="text-transform: uppercase;" placeholder="Ingresa los Apellidos" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                  <hr>
                                                  <h4 style="text-align: center;">DATOS DEL PADRE</h4> 
                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">TIPO DOC <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <select class="form-control" name="tipoDocMama" id="tipoDocMama" required="required" tabindex="1" >
                                                            <option value="">-- Seleccionar --</option>                        
                                                            <option value="DNI">DNI</option>
                                                            <option value="Carnet Ext.">Carnet Ext.</option>
                                                            <option value="Pasaporte">Pasaporte</option>
                                                            <option value="CUI">CUI</option>
                                                            <option value="Otros">Otros</option>
                                                          </select>
                                                        </div>  
                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">DNI. <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                      <div class="input-group" style="margin-bottom:0px;">
                                                        <input type="text" class="form-control" name="dniPapa" id="dniPapa" maxlength="11" required="required"  placeholder="Ingresa el DNI" >
                                                      </div>
                                                    </div>
                                            </div>
                                              <div class="form-group">
                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">NOMBRES</label>
                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <input type="text" class="form-control" required="required" name="nombresPapa" id="nombresPapa"  style="text-transform: uppercase;" placeholder="Ingresa los Nombres" >
                                                  </div>
                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">APELLIDOS</label>
                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                      <input type="text" class="form-control" required="required" name="apePapa" id="apePapa" style="text-transform: uppercase;" placeholder="Ingresa los Apellidos" >
                                                    </div>
                                                </div><br><hr>
                                                <button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idPadres" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>
                                          </div>
                                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                                      
                                                        <div class="form-group"> <br>
                                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">N° CORREO DE SOLICITUD</label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <textarea class="form-control" required="required" name="correoSolicitud" id="correoSolicitud" rows="3" 
                                                            style="text-transform: uppercase;">CORREO ELECTRONICO  N° XXX  -20XX- ESPP-UAD/INSN-SB</textarea>
                                                          </div>
                                                       
                                                              
                                                        </div>
                                                        <div class="form-group"> 
                                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">DOCUMENTO RESPUESTA</label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <textarea class="form-control" required="required" name="docRespuesta" id="docRespuesta" rows="3" style="text-transform: uppercase;"></textarea>
                                                          </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA DE AUTORIZACIÓN</label>
                                                              <div class="col-md-2 col-sm-12 col-xs-12">
                                                                        <div class="input-group" style="margin-bottom:0px;">
                                                                                <input type="date" class="form-control" required="required"  name="feAutoraizacion" id="feAutoraizacion" >
                                                                                <span class="input-group-btn hidden" id="cargX">
                                                                                    <a class="btn btn-primary"  data-toggle="modal" data-target=".bs-example-modal-smuCargoAutoPost"  id="cargoAUploadPostApro">
                                                                                          <i class="fa fa-upload"></i> </a>
                                                                                    <a href="#/eye" target="blank" title="SUBIR ARCHIVO CARGO" class="btn VerCargoRecPost hidden" id="VerCargoRecPost">Ver <i class="fa fa-eye"></i></a>
                                                                                </span>
                                                                                 
                                                                        </div>
                                                                </div>
                                                        </div>
                                                        <div class="form-group">
                                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">CONDICIÓN DE COBERTURA</label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <select class="form-control" name="cocobertura" id="cocobertura" required="required">
                                                              <option value="SOLICITADO">SOLICITADO</option>   
                                                              <option value="APROBADO">APROBADO</option>                            
                                                              <option value="NO APROBADO">NO APROBADO</option>
                                                            </select>
                                                          </div>

                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">CONDICIÓN DE AFILIADO</label>
                                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                              <div class="input-group" style="margin-bottom:0px;">
                                                                <select class="form-control" name="coafiliado" id="coafiliado" required="required">
                                                                    <option value="ACTIVO">ACTIVO</option>                            
                                                                    <option value="DESAFILIADO">DESAFILIADO</option>
                                                                    <option value="FALLECIDO">FALLECIDO</option>
                                                              </select>
                                                            </div>
                                                            </div>
                                                         </div>
                                                        <div class="form-group"> 
                                                          <label class="control-label col-md-3 col-sm-3 col-xs-12">OBSERVACIONES</label>
                                                          <div class="col-md-8 col-sm-12 col-xs-12">
                                                            <textarea class="form-control" required="required" name="observaciones" id="observaciones" rows="3" style="text-transform: uppercase;"></textarea>
                                                          </div>
                                                        </div>
                                                        <div class="form-group hidden" id="subriArchivos">
                                                            <div class="control-label col-md-5 col-sm-3 col-xs-12" style="margin-left: 11px;">
                                                                <a id="uploadAr" data-toggle="modal" data-target=".bs-example-modal-smupload"  
                                                                class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Subir Archivos</a>
                                                            </div>
                                                            
                                                        </div>
                                                              <br><hr>
                                                        <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="RegistrarPaciente();" style="float: right;margin-bottom: 4%;">
                                                        <i class="fa fa-save"></i> GUARDAR</button> 
                                          </div>
                                        </div>
                                      </div>

                                
                                
                                    <div class="modal-footer hidden">
                                    
                                                                            
                                        <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrar">CERRAR</button>
                                    </div>
                                </div>
                              </div>
                            
                              

                            </div>
                            </form>
                    </div>
                  </div>







                
        
                  
                  

                




        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>
   