 <?php 


error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Debes iniciar sesión para continuar.'); window.location='index.php';</script>";  
  exit;
} 

include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");



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
                                <a class="btn btn-success"  href="importar.php"  style="float: right;"><i class="fa fa-file-excel-o"></i> Importar</a>
                                <!--<a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-sm" id="agr2" role="button" aria-expanded="false" 
                                style="float: right;" onclick="LimpiarForm();"><i class="fa fa-edit m-right-xs"></i> Nuevo</a>-->
                                
                                
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
                                          <td><label>Desde:</label></td>
                                          <td><input name="min" id="min" type="text" class="form-control" placeholder="Fecha Inicio" autocomplete="off"></td>
                                          <td><label>&nbsp;&nbsp;Hasta:</label></td>
                                          <td><input name="max" id="max" type="text" class="form-control" placeholder="Fecha final" autocomplete="off"></td>
                                      </tr>
                                  </tbody>
                              </table><br>
                             
                                <div class="alert alert-success alert-dismissible fade in hidden" role="alert" id="alerify">
                                      <button type="button" class="close" ><span aria-hidden="true" id="closealert">×</span>
                                      </button>
                                      <strong id="pacte"></strong>
                                  </div>
                                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagrid"> 
                                              
                                            
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

        
        <div class="modal fade bs-example-modal-smImpExcel" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false">
                    <div class="modal-dialog modal-mg">
                      <div class="modal-content">

                                <div class="modal-header" style="background: #26B99A;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacient">IMPORTAR ARCHIVOS EXCEL</h4>
                                </div>
                            <div class="modal-body">
                                      <form action="Controlador/registro.php?function=ImportDatos" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data" class="formulario form-horizontal form-label-left input_mask">
                                            <div  class="form-group">
                                                <br><br>
                                                <input type="file" name="file" id="file" class="custom-file-input" accept=".xls,.xlsx"><br>
                                                 <button type="submit" id="submit" name="import" class="btn btn-success" style="float: right;" >Importar</button>
                                        
                                            </div>
                                            
                                        
                                      </form>
                                  
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
                                                          <select class="form-control" name="tipoDoc" id="tipoDoc" required="required" tabindex="1" >
                                                            <option value="">-- Seleccionar --</option>                        
                                                            <option value="DNI">DNI</option>
                                                            <option value="Carnet Ext.">Carnet Ext.</option>
                                                            <option value="Pasaporte">Pasaporte</option>
                                                            <option value="CUI">CUI</option>
                                                            <option value="CNV">CNV</option>
                                                            <option value="Otros">Otros</option>
                                                          </select>
                                                        </div>

                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">N° DOC. <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="margin-bottom:0px;">
                                                              <input type="text" class="form-control" name="NroDoc" id="NroDoc" maxlength="11" required="required" tabindex="2" >
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
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">SEXO</label>
                                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="sexo" id="sexo" required="required" tabindex="6">>
                                                                          <option value="">-- Seleccionar --</option>
                                                                          <option value="MASCULINO">MASCULINO</option>
                                                                          <option value="FEMENINO">FEMENINO</option>
                                                                  </select>
                                                          </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">H. CLINICA <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input type="text" class="form-control" name="hclinica" id="hclinica" maxlength="11" required="required" tabindex="6" >
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
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">NOMBRES  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="nombres" id="nombres" tabindex="9" style="text-transform: uppercase;">
                                                        </div>

                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA NAC.  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="date" class="form-control" required="required"  name="FechaNac" tabindex="12" id="FechaNac" onchange="handler(event);"  >
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">AP. PATERNO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required" value="<?php echo $apepa ?>" name="apepa" id="apepa" tabindex="10"  style="text-transform: uppercase;">
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">AP. MATERNO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" value="<?php echo $apema?>" name="apema" id="apema"  tabindex="11" style="text-transform: uppercase;">
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">T. ATENCION</label>
                                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="TipoAtencion" id="TipoAtencion" required="required" tabindex="6">>
                                                                          <option >-- Seleccionar --</option>
                                                                          <option value="EMERGENCIA">EMERGENCIA</option>
                                                                          <option value="REFERIDO">REFERIDO</option>
                                                                  </select>
                                                          </div>
                                                       
                                                      </div>
                                    <br><br>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="RegistrarPac();" style="float: right;margin-bottom: 4%;">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarpre">CERRAR</button>
                                                      
                                           </form>

                                          </div>
                                         
                 

               

                <div class="modal fade bs-example-modal-donafec" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                                <div class="modal-header" style="background:#26b99a;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacient">ELIMINAR REGISTRO</h4>
                                </div>
                                <div class="modal-body">
                        
                                  <form class="" method="POST" id="formEfec">
                                                                       
                                              <div class="form-group">
                                                  <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: center;">DNI</label>                               
                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                     <input type="text" class="form-control" required="required" name="dni" id="dni" style="text-transform: uppercase;">
                                                     <br>
                                                  </div>                     
                                              </div>
                                              <div class="form-group" >
                                                  <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: center;">EDAD</label>
                                                  <div class="col-md-12 col-sm-12 col-xs-12">
                                                       <input type="text" class="form-control" required="required" name="edad" id="edadefec" style="text-transform: uppercase;">
                                                  </div> <br><br>                                   
                                              </div>
                                             
                                  <div class="modal-footer" id="el"> 
                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="insertEfectivo('0');" style="margin-top: 23px;">Guardar</button>                                      
                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraEfec">CERRAR</button>
                                  </div>

                                    
                                  </form>
                                </div>
                                
                         
                           </div>
                    </div>
                </div>


        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>
   