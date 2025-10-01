 <?php 


error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Esta pagina es solo para usuarios registrados'); window.location='index.php';</script>";  
  exit;
} 

include 'Modelo/funciones.php';
require 'Modelo/global.php';


$sel =new Model();


$ni = $sel->consulta();
$registros = 1000000;
$contador = 1;
$pagina = $_GET["pagina"];

if (!$pagina) { 
    $inicio = 0; 
    $pagina = 1; 
} else { 
    $inicio = ($pagina - 1) * $registros; 
} 

$resultados = $sel->paginador($inicio,$registros);  
$total_registros = mysqli_num_rows($ni); 
$total_paginas = ceil($total_registros / $registros);




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
                                <h2 style="text-transform: uppercase;">Lista de pacientes registrados <small></small></h2>
                                <!--<a class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm" id="agr2" role="button" aria-expanded="false" 
                                style="float: right;" onclick="LimpiarForm();"><i class="fa fa-edit m-right-xs"></i> Nuevo Registro</a>
                                <a href="#" class="dropdown-toggle" data-toggle="modal" data-target=".bs-example-modal-sm" id="agr2" role="button" aria-expanded="false"><i class="fa fa-arrows"></i></a>-->
                                <!--<a href="registrosexcel.php" style="float: right;"><img style="width:30px;" src="<?php echo $path ?>images/excel.png">&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;</a>
                                <a style="float: right;">Exportar a:&nbsp;&nbsp; </a> -->
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
                                                        "searchPlaceholder": "Ingrese el texto a buscar",
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
                                       
                                    } );
                                </script>
                              <table class="table jambo_table bulk_action"  id="pac">
                                    <thead>
                                        <tr class="headings" style="font-size: 10px;">
                                              <!--<th class="column-title">Id </th>-->
                                              <th class="column-title" style="text-transform: uppercase;width:2%;">Id</th>
                                              <th class="column-title" style="width:4%;text-transform: uppercase;">DNI</th>
                                              <th class="column-title" style="width: 11%;text-transform: uppercase;">APELLIDOS</th>
                                              <th class="column-title" style="width: 8%;text-transform: uppercase;">NOMBRES</th>                                        
                                              <th class="column-title" style="width: 5%;text-transform: uppercase;">CIE10</th>
                                              <th class="column-title" style="width: 5%;text-transform: uppercase;text-align: center;">CONDICION</th>
                                              <th class="column-title" style="width:3%;text-transform: uppercase;text-align:center;">SEXO</th>
                                              <th class="column-title" style="width: 10%;text-transform: uppercase;text-align:center;">REGIMEN</th>
                                              <th class="column-title" style="width: 6%;text-transform: uppercase;text-align:center;">H. CLINICA</th>
                                              <th class="column-title" style="width: 8%;text-transform: uppercase;text-align:center;">F. AUTORIZACION</th>
                                              <th class="column-title" style="width: 8%;text-transform: uppercase;text-align:center;">CORREO APROB.</th>
                                              <th class="column-title" style="width: 8%;text-transform: uppercase;text-align:center;">INFORME MEDICO.</th>
                                              <th class="column-title" style="width: 5%;text-transform: uppercase;text-align: center;">#</th>                                       
                                      </tr>
                                    </thead>

                                    <tbody>
                                         <?php  
                                              if ($total_registros) {
                                               while($mue = $resultados->fetch_assoc()){                                                 
                                                 ?>

                                            <tr class="even pointer">
                                                      <td class=" "><?php echo $mue["NroPaciente"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;"><?php echo $mue["NroDocumento"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;"><?php   echo $mue["ApePaterno"]. " " .$mue["ApeMaterno"];  ?></td>
                                                      <td style="text-transform: uppercase;font-size: 12px;"><?php echo $mue["Nombres"]; ?></td>                                                      
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;"><?php echo $mue["Cie10"]; ?></td>                                                 
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align: center;">
                                                        <?php $coCobertura = $mue["cocobertura"]; 
                                                        if($coCobertura=="APROBADO"){
                                                            echo "<button type='button' class='btn btn-round btn-success btn-xs'>Aprobado</button>";
                                                        }
                                                        else if($coCobertura=="SOLICITADO"){
                                                          echo "<button type='button' class='btn btn-round btn-warning btn-xs'>Solicitado</button>";
                                                        }else if($coCobertura=="NO APROBADO"){
                                                          echo "<button type='button' class='btn btn-round btn-danger btn-xs'>No aprobado</button>";
                                                      }
                                                        ?>
                                                      </td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;"><?php echo $mue["Sexo"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;"><?php echo $mue["regimen"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;"><?php echo $mue["hclinica"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;"><?php echo $mue["feAutoraizacion"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;">
                                                      <?php $ext  = substr($mue["docRespuesta"],0,6);  ?>
                                                      <a title="<?php echo $mue["docRespuesta"];?>" style="color: blue;font-weight: bolder;cursor: pointer;"><?php echo $ext." ..." ?></a>
                                                     </td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;text-align:center;">
                                                      <a href="<?php echo "repositorio/".$mue["filesPre"]; ?>" style="color: blue;font-weight: bolder;">Informe</a></td>
                                                      <td style="text-align: center;" > 
                                                        <a onclick="verPaciente(<?php echo $mue['NroPaciente']; ?>);" data-toggle="modal" data-target=".bs-example-modal-sm" 
                                                        class="btEdit btn btn-danger btn-xs"><i class="fa fa-search"></i> DATOS</a>
                                                        
                                                      </td>                
                                                      
                                                    </tr>
                                         <?php }
                                                   } 
                                                  mysqli_free_result($ni);  
                                                     ?>
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







                  <div class="modal fade bs-example-modal-sm2" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background: #337ab7;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacient">PRE - TRASPLANTE</h4>
                                </div>
                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formpre" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                
                                  <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                  <input type="hidden" name="idpre" value="" id="idpre">

                                  <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">TIPO TRASPLANTE</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <select class="form-control" name="tipotras" id="tipotras" required="required">
                                          <option value="RENAL">RENAL</option>                            
                                          <option value="HEPATICO">HEPATICO</option>
                                          <option value="TRASPLANTE DE PROGENITORES HEMATOPOYETICOS">TPH</option>
                                          <option value="CORNEA">CORNEA</option>
                                        </select>
                                      </div>

                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">HISTORIA CLINICA</label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                          <div class="input-group" style="margin-bottom:0px;">
                                          <input type="text" class="form-control" value="<?php echo $HistCli ?>" name="HistCli" id="HistCli" maxlength="10" >
                                          <!--<span class="input-group-btn">
                                              <button type="button" class="btn btn-primary" id="cargaDni"><i class="fa fa-search"></i></button>
                                          </span>-->
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group"> 
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">EMAIL (CE N° y año)</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <textarea class="form-control" required="required" name="emailcena" id="emailcena" rows="3"></textarea>
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">F. ENVIO SOLICITUD</label>
                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                              <div class="input-group" style="margin-bottom:0px;">
                                                    <input type="date" class="form-control" required="required" value="<?php echo $fecensol ?>" name="fecensol" id="fecensol" >
                                                    <span class="input-group-btn">
                                                        <a class="btn btn-primary"  data-toggle="modal" data-target=".bs-example-modal-smuCargo"  id="cargoEUpload"><i class="fa fa-upload"></i> Cargo</a>
                                                        <a href="#/eye" target="blank" class="btn VerCargoE hidden">Ver <i class="fa fa-eye"></i></a>
                                                    </span>
                                                   
                                              </div>
                                            </div>
                                          
                                    </div>
                                    <div class="form-group"> 
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">EMAIL APROBACION FISSAL</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <textarea class="form-control" required="required" name="emailcAproFis" id="emailcAproFis" rows="3"></textarea>
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">F. APROB. SOLICITUD</label>
                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <div class="input-group" style="margin-bottom:0px;">
                                                            <input type="date" class="form-control" required="required" value="<?php echo $fecaprosol ?>" name="fecaprosol" id="fecaprosol" >
                                                            <span class="input-group-btn">
                                                                <a class="btn btn-primary" id="cargoEApro"  data-toggle="modal" data-target=".bs-example-modal-smuCargoApro"><i class="fa fa-upload"></i> Cargo</a>
                                                                <a href="#/eye" target="blank" class="btn VerCargoR hidden">Ver <i class="fa fa-eye"></i></a>
                                                            </span>
                                                    </div>
                                            </div>
                                    </div>
                                    <div class="form-group"> 
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">OBSERVACIONES</label>
                                      <div class="col-md-9 col-sm-12 col-xs-12">
                                        <textarea class="form-control" required="required" name="observaciones" id="observaciones" rows="3"></textarea>
                                      </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <div class="control-label col-md-4 col-sm-3 col-xs-12">
                                            <a id="donatPac" data-toggle="modal" data-target=".bs-example-modal-sm5"  class="btn btn-success"><i class="fa fa-arrows"></i> Donantes</a>
                                            <a id="doowewna" data-toggle="modal" data-target=".bs-example-modal-smupload"  class="btn btn-success"><i class="fa fa-cloud-upload"></i> Archivos</a>
                                        </div>
                                        
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default" onclick="LimpiarFormPre();">LIMPIAR</button>
                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="RegistrarPre();">GUARDAR</button>                                      
                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarpre">CERRAR</button>
                                  </div>
                                </div>
                              </div>
                          

                            </div>
                            </form>
                    </div>
                  </div>
        <!-- /page content -->
        <div class="modal fade bs-example-modal-sm3" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background: #337ab7;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacientpost"></h4>
                                </div>
                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formpost" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                
                                  <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                  <input type="hidden" name="idpost" value="<?php echo $idpost ?>" id="idpost">
                                  
                                    <div class="form-group" id="tph" style="display:none;">
                                                      <label class="control-label col-md-7 col-sm-3 col-xs-12" style="font-size: larger;">TIPO DE TRASPLANTE</label><br><br>
                                                      <div class="col-md-10 col-md-offset-2 col-sm-12 col-xs-12">
                                                          <div class="col-md-5 col-sm-12 col-xs-12">
                                                                <label class="form-check-label" for="radio1" style="color: #949292;">
                                                                  <input type="radio" class="form-check-input" id="radio1" name="optradio" value="HERMANO COMPATIBLE PLENO" > HERMANO COMPATIBLE PLENO
                                                                </label>
                                                          </div>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <label class="form-check-label" for="radio2" style="color: #949292;">
                                                              <input type="radio" class="form-check-input" id="radio2" name="optradio" value="HAPLOIDENTICO"> HAPLOIDENTICO
                                                            </label>
                                                          </div>
                                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                              <label class="form-check-label" style="color: #949292;">
                                                                <input type="radio" class="form-check-input" id="radio3" name="optradio" value="AUTOLOGO" > AUTOLOGO
                                                              </label>
                                                            </div>
                                                            <div class="col-md-5 col-md-offset-1 col-sm-12 col-xs-12">
                                                              <label class="form-check-label" style="color: #949292;">
                                                                <input type="radio" class="form-check-input" id="radio4" name="optradio" value="NO EMPARENTADO" > NO EMPARENTADO
                                                              </label>
                                                            </div>
                                                      </div>
                                      </div>
                                      <div class="form-group" id="renal" style="display:none;">
                                                      <label class="control-label col-md-7 col-sm-3 col-xs-12" style="font-size: larger;">TIPO DE TRASPLANTE</label><br><br>
                                                      <div class="col-md-10 col-md-offset-2 col-sm-12 col-xs-12">
                                                          <div class="col-md-5 col-sm-12 col-xs-12">
                                                                <label class="form-check-label" for="radio1" style="color: #949292;">
                                                                  <input type="radio" class="form-check-input" id="radio5" name="optradio" value="VIVO NO RELACIONADO" > VIVO NO RELACIONADO                                                               </label>
                                                          </div>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <label class="form-check-label" for="radio2" style="color: #949292;">
                                                              <input type="radio" class="form-check-input" id="radio6" name="optradio" value="VIVO RELACIONADO"> VIVO RELACIONADO
                                                            </label>
                                                          </div>
                                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                              <label class="form-check-label" style="color: #949292;">
                                                                <input type="radio" class="form-check-input" id="radio7" name="optradio" value="CADAVERICO" > CADAVERICO
                                                              </label>
                                                            </div>
                                                      </div>
                                      </div>
                                      
                                      <br>
                                    <div class="form-group"> 
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">OFICIO | NUMERO</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <textarea class="form-control" required="required" name="oficiopost" id="oficiopost" rows="3"></textarea>
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA AVISO TRAS.</label>
                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                              <input type="date" class="form-control" required="required" value="" name="fechapost" id="fechapost" >
                                          </div>
                                    </div>
                                    <div class="form-group"> 
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">OFICIO N° AUTORIZACION</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <textarea class="form-control" required="required" name="ofiauto" id="ofiauto" rows="3"></textarea>
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">F. AUTORIZACION TRAS</label>
                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                              <input type="date" class="form-control" required="required" value="<?php echo $fecaprosol ?>" name="feauto" id="feauto" >
                                            </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA TRASPLANTE</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="date" class="form-control" required="required" value="<?php echo $fetras ?>" name="fetras" id="fetras" >
                                      </div>
                                      <script>
                                        $(document).ready(function(){
                                                $("select[name=lugarTrans]").change(function(){
                                                    var dat = $('select[name=lugarTrans]').val();
                                                    if(dat=="OTROS"){
                                                      $( "#especiLugar" ).removeClass( "hidden");
                                                      $( "#cajluga" ).removeClass( "hidden");
                                                    }else{
                                                      $( "#especiLugar" ).addClass("hidden");
                                                      $( "#cajluga" ).addClass( "hidden");
                                                    }
                                                    
                                                });
                                        });
                                    </script>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">LUGAR TRASPLANTE</label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                          <select class="form-control" name="lugarTrans" id="lugarTrans" required="required">
                                                  <option value="INSNSB">INSNSB</option>                            
                                                  <option value="ARGENTINA AUSTRAL">ARGENTINA AUSTRAL</option>
                                                  <option value="HOSP. LOAYZA">HOSP. LOAYZA</option>
                                                  <option value="OTROS">OTROS</option>
                                        </select>
                                        </div>
                                        
                                    </div><br>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">NRO. TRASPLANTE</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                   <input type="text" class="form-control" required="required" name="nrotr" id="nrotr" >
                                        </div>  
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12 hidden" id="especiLugar">ESPECIFIQUE LUGAR</label>
                                          <div class="col-md-4 col-sm-12 col-xs-12 hidden" id="cajluga">
                                            <input type="text" class="form-control" required="required" name="esluga" id="esluga" >
                                          </div>
                                    </div>
                                    <br><br>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default" onclick="LimpiarFormPost();">LIMPIAR</button>
                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="RegistrarPost();">GUARDAR</button>                                      
                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarpost">CERRAR</button>
                                  </div>
                                </div>
                              </div>
                            
                              

                            </div>
                            </form>
                    </div>
                  </div>
                  <!-- DODNAES-->
                  <div class="modal fade bs-example-modal-sm5" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background: #337ab7;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacient">DONANTE POSTULANTE</h4>
                                </div>
                              <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formdonante" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                
                                    <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                    <input type="hidden" name="iddona" value="<?php echo $iddona ?>" id="iddona">
                                    <div class="form-group">
                                          <!--<label class="control-label col-md-2 col-sm-3 col-xs-12">DNI</label>
                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                            <input type="text" class="form-control" required="required"  name="dnido" id="dnido" >
                                          </div>-->
                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">DNI. <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                              <div class="input-group" style="margin-bottom:0px;">
                                                <input type="text" class="form-control" name="dnido" id="dnido" maxlength="8" required="required"  >
                                                <span class="input-group-btn hidden">
                                                  <button type="button" class="btn btn-primary" id="cargaDniP"><i class="fa fa-search"></i></button>
                                                </span>
                                              </div>
                                            </div>


                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">ESTADO</label>
                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                  <select class="form-control" name="estadona" id="estadona" required="required">                   
                                                    <option value="INACTIVO">INACTIVO</option>
                                                    <option value="ACTIVO">ACTIVO</option>
                                                  </select>
                                          </div>
                                    </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">NOMBRES</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" required="required" value="<?php echo $nodona ?>" name="nodona" id="nodona"  style="text-transform: uppercase;">
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">APELLIDOS</label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                          <input type="text" class="form-control" required="required" value="<?php echo $apedona?>" name="apedona" id="apedona" style="text-transform: uppercase;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12 " >F. NACIMIENTO</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12 " >
                                        <input type="date" class="form-control" required="required" name="fedot" id="fedot" onchange="handlerDo(event);" >
                                      </div> 
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">EDAD</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" required="required" readonly="readonly" name="edado" id="edado" >
                                      </div>                                         
                                      
                                    </div>
                                  <!--  <label class="control-label col-md-2 col-sm-3 col-xs-12 " >F. NACIMIENTO</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12 " >
                                        <input type="date" class="form-control" required="required" name="feacre" id="feacre" >
                                      </div> 
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">EDAD</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" required="required" readonly="readonly" name="edado" id="edado" >
                                      </div>                                         
                                      
                                    </div>-->
                                    <script>
                                      $(document).ready(function(){
                                          $("select[name=parentesco]").change(function(){
                                                    var datTin = $('select[name=parentesco]').val();
                                                    if(datTin=="OTROS"){
                                                      $( "#espef" ).removeClass( "hidden");
                                                      $( "#divesc" ).removeClass( "hidden");
                                                    }else{
                                                      $( "#espef" ).addClass( "hidden");
                                                      $( "#divesc" ).addClass( "hidden");
                                                    }
                                                    
                                            });
                                        });
                                    </script>
                                    <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12">PARENTESCO</label>
                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                <select class="form-control" name="parentesco" id="parentesco" required="required">
                                                  <option value="PAPA">PAPA</option>                           
                                                  <option value="MAMA">MAMA</option>
                                                  <option value="HERMANO(A)">HERMANO(A)</option>
                                                  <option value="OTROS">OTROS</option>
                                                </select>
                                        </div>
                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">TIPO</label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                <select class="form-control" name="tipoDona" id="tipoDona" required="required">
                                                  <option value="VIVO">VIVO</option>                           
                                                  <option value="CADAVERICO">CADAVERICO</option>
                                                  
                                                </select>
                                        </div>                                     
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12 hidden" id="espef">ESPECIFIQUE</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12 hidden" id="divesc">
                                        <input type="text" class="form-control" required="required" name="especifica" id="especifica" >
                                      </div>
                                      
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" onclick="LimpiarFormDona();">LIMPIAR</button>
                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="RegistrarDona();">GUARDAR</button>                                      
                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrardona">CERRAR</button>
                                  </div>

                                    <div class="table-responsive" id="datagridDona"> 
                                  
                                
                                    </div>
                                    
                                    <!--<div class="form-group">
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA TRAS.</label>
                                      <div class="col-md-3 col-sm-12 col-xs-12">
                                        <input type="date" class="form-control" required="required" value="<?php echo $fetras ?>" name="fetras" id="fetras" >
                                      </div>
                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">LUGAR TRAS</label>
                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                          <input type="text" class="form-control" required="required" value="<?php echo $lugarTrans?>" name="lugarTrans" id="lugarTrans">
                                        </div>
                                    </div>-->
                                    
                                </div>
                              </div>
                            
                              

                            </div>
                            </form>
                    </div>
                  </div>
                  <!-- FIN MODAL -->
                  <div class="modal fade bs-example-modal-smupload" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background:red;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacient">REPOSITORIO DE ARCHIVOS</h4>
                                </div>
                            <div class="modal-body">
                            <link href="./js/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
                            <script src="./js/dropzone/dist/dropzone.js"></script>
                                  <form action="upload.php?function=upload" class="dropzone" method="POST" id="formupload">
                                    <input type="hidden" name="iduserupload"  id="iduserupload">
                                    <input type="hidden" name="iddpac" id="iddpac">
                                    <input type="hidden" name="etapa" id="etapa" value="pre">
                                  </form>
                                 
                                   
                                    <br />
                                    <br />
                                    <br />
                                    <br />
                                </div>
                         
                           </div>
                    </div>
                  </div>
                <!-- FIN MODAL -->

                <!-- FIN MODAL -->
                <div class="modal fade bs-example-modal-smuCargo" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background: royalblue;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacient">SUBIR CARGO DE ENVÍO</h4>
                                </div>
                            <div class="modal-body">
                            <link href="./js/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
                            <script src="./js/dropzone/dist/dropzone.js"></script>
                                  <form action="upload.php?function=cargo" class="dropzone cargo" method="POST" id="formcargo">
                                    <input type="hidden" name="iduseruploadCargo"  id="iduseruploadCargo">
                                    <input type="hidden" name="iddcargo" id="iddcargo">
                                    <input type="hidden" name="tipo" id="tipo" value="envio">
                                  </form>
                                 
                                   
                                    <br />
                                    <br />
                                    <br />
                                    <br />
                                </div>
                         
                           </div>
                    </div>
                  </div>
                <!-- FIN MODAL -->


                 <!-- FIN MODAL -->
                 <div class="modal fade bs-example-modal-smuCargoApro" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background: royalblue;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacient">SUBIR CARGO DE APROBACION</h4>
                                </div>
                            <div class="modal-body">
                            <link href="./js/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
                            <script src="./js/dropzone/dist/dropzone.js"></script>
                                  <form action="upload.php?function=cargo" class="dropzone cargo" method="POST" id="formcargo">
                                    <input type="hidden" name="iduseruploadCargoApro"  id="iduseruploadCargoApro">
                                    <input type="hidden" name="iddcargoApro" id="iddcargoApro">
                                    <input type="hidden" name="tipo" id="tipo" value="apro">
                                  </form>
                                 
                                   
                                    <br />
                                    <br />
                                    <br />
                                    <br />
                                </div>
                         
                           </div>
                    </div>
                  </div>
                <!-- FIN MODAL -->
                
                




        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>
   