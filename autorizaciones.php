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
$grupo = $_GET["id"];

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
                               
                                <a class="btn btn-success"  href="importar.php?id=<?php echo $grupo; ?>" style="float: right;" ><i class="fa fa-upload"> </i> Importar</a>
                                
                                
                                
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
                                          <div style="display:none;text-align: center;color: #405467;font-family: century gothic;font-size: 21px;" id="dvloadercpt"><img src="images/loading.gif" />
                                            <br>Espere un momento por favor ..</div>
                                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridAutizaciones"> 
                                              
                                            
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

    

        <div class="modal fade bs-example-modal-smCartas" tabindex="-1" id="myModalIng" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title">REGISTRO DEL PACIENTE</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formCartas" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                    <input type="hidden" name="ide" value="<?php echo $id ?>" id="ide">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
    
                                                      <br>
                                                        <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">DNI <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <div class="input-group" style="margin-bottom:0px;">
                                                            <input type="text" class="form-control" value="" name="NroDoc" id="NroDoc" maxlength="11" required="required" tabindex="1" >
                                                            <span class="input-group-btn">
                                                              <button type="button" class="btn btn-primary" id="externa"><i class="fa fa-search"></i></button>
                                                            </span>
                                                          </div>
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">PACIENTE<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input type="text" class="form-control" name="paciente" id="paciente" required="required" tabindex="2" >
                                                            </div>
                                                          </div>
                                                        
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">F. NAC <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <div class="input-group" style="margin-bottom:0px;">
                                                            <input type="date" class="form-control" name="nac" id="nac" maxlength="11" required="required" tabindex="3" autofocus>
                                                          </div>
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">EDAD<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input type="text" class="form-control" name="edad" id="edad" maxlength="11" readonly="" required="required" tabindex="4" >
                                                            </div>
                                                          </div>
                                                        
                                                      </div>
                                                   
                                                      <div class="form-group">
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA CARTA</label>
                                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                                  <input type="date" class="form-control" name="fecarta" id="fecarta" value="<?php echo date("Y-m-d")?>" maxlength="11" required="required" tabindex="5" max="2100-12-31">
                                                          </div>
                                                        <script>
                                                            $(document).ready(function(){
                                                                $("select[name=iafa]").change(function(){
                                                                          var dat = $('select[name=iafa]').val();
                                                                          $("#tarifa").val(dat); 
                                                                          if(dat!="SALUDPOL"){
                                                                            $( "#monto" ).removeAttr( "readonly", true);
                                                                            $( "#aseguradora").removeAttr( "disabled", true);
                                                                            $( "#poliza" ).removeAttr( "readonly", true);
                                                                          }else{
                                                                            $( "#monto" ).attr( "readonly", true);
                                                                            $( "#aseguradora").attr( "disabled", true);
                                                                            $( "#poliza" ).attr( "readonly", true);
                                                                          }
                                                                          
                                                                      });
                                                              }); 
                                                          </script>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">IAFA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="iafa" id="iafa" required="required" tabindex="6">                        
                                                                      <option value="SALUDPOL">SALUDPOL</option>
                                                                      <option value="SOAT">SOAT</option>
                                                                      <option value="Tarifa (Cat-A)">Tarifa (Cat-A)</option>
                                                                      <option value="Tarifa (Cat-B)">Tarifa (Cat-B)</option>
                                                                    </select>
                                                          </div>
                                                      </div> 
                                                      <div class="form-group">
                                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">CONSULTORIO<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                                <input type="text" class="form-control" required="required"  name="producto" id="producto"  tabindex="7" style="text-transform: uppercase;">
                                                             </div>


                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">TARIFA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="tarifa" id="tarifa" required="required" tabindex="8">>                         
                                                                      <option value="SALUDPOL">SALUDPOL</option>
                                                                      <option value="SOAT">SOAT</option>
                                                                      <option value="FFAA- EJERCITO DEL PERU - FOSPEME">FFAA- EJERCITO DEL PERU - FOSPEME</option>
                                                                      <option value="FFAA - MARINA DE GUERRA - FOSMAR">FFAA - MARINA DE GUERRA - FOSMAR</option>
                                                                      <option value="CARTA DE GARANTIA EPS">CARTA DE GARANTIA EPS</option>
                                                                      <option value="FFAA- AEREA DEL PERU -FOSFAP">FFAA- AEREA DEL PERU -FOSFAP</option>
                                                                    </select>
                                                               </div>
                                                      </div>
                                                      
                                                      <div class="form-group">
                                                      <label class="control-label col-md-2 col-sm-3 col-xs-12" >REFERENCIA</label>
                                                          <div class="col-md-9 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required"  name="refe" id="refe"  tabindex="9" style="text-transform: uppercase;">
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">ASEGURADORA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="aseguradora" id="aseguradora" required="required" tabindex="10" disabled>
                                                                      <option value="">-- Seleccionar --</option>                         
                                                                      <option value="LA POSITIVA">LA POSITIVA</option>
                                                                      <option value="AFOCAT">AFOCAT</option>
                                                                      <option value="RIMAC SEGUROS">RIMAC SEGUROS</option>   
                                                                      <option value="OTROS">OTROS</option>                                                                   
                                                                    </select>
                                                        </div> 
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">POLIZA  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required"  name="poliza" id="poliza"  tabindex="11" style="text-transform: uppercase;" readonly>
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                              <div class="input-group" style="margin-bottom:0px;">
                                                                <input type="text" class="form-control" value="" name="cie10" id="cie10" maxlength="11" required="required" tabindex="12" style="text-transform: uppercase;">
                                                                <span class="input-group-btn">
                                                                  <button type="button" class="btn btn-primary" id="cargarcie10"><i class="fa fa-search"></i></button>
                                                                </span>
                                                              </div>
                                                            </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">DIAGNOSTICO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" readonly name="diagnostico" id="diagnostico" tabindex="13" style="text-transform: uppercase;">
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">F. INICIO VIGENCIA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <input type="date" class="form-control" required="required" max="2100-12-31" value="<?php echo date("Y-m-d")?>" name="feinicio" id="feinicio" tabindex="14" onchange="handler(event);">
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">F. FIN VIGENCIA  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="date" class="form-control" required="required" value="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 360 days"));  ?>" max="2100-12-31" name="fevigencia" id="fevigencia"  tabindex="15" >
                                                          </div>
                                                      </div>
                                                      <div class="form-group" >
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">MONTO AMPLIACION<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                              <input type="text" class="form-control" required="required"  name="monto" id="monto" tabindex="16" readonly>
                                                            </div>
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">NRO CARTA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                              <input type="text" class="form-control" required="required"  name="NroCarta" id="NroCarta"  value="CV004-1401-"  readonly >
                                                            </div>
                                                            <div class="col-md-2 col-sm-12 col-xs-12" style="width: 12%;">
                                                                   <select class="form-control" name="NroCarta2" id="NroCarta2" required="required" >
                                                                      <option value="2020">2020</option>                         
                                                                      <option value="2019">2019</option>
                                                                      <option value="2018">2018</option>
                                                                    </select>
                                                            </div>
                                                            <div class="col-md-1 col-sm-12 col-xs-12">
                                                              <input type="text" class="form-control" required="required"  name="NroCarta3" id="NroCarta3" tabindex="17" >
                                                            </div>
                                                         
                                                      </div>
                                                    
                                    <br><br>
                                                  
                                                      <button type="button" class="btn btn-danger" id="GuardarPacientexE" onclick="RegistrarCartas();" style="float: right;margin-bottom: 4%;" tabindex="18">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarcARX">CERRAR</button>
                                                      
                                           </form>

                        </div>
                      </div>                       
                  </div>
                </div>
              </div> 
          </div>
        </div>
      </div>
    </div>

                          
<!--  INICIO CUENTAS  --> 


<div class="modal fade bs-example-modal-smCuentasAu" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="titleCuen"></h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formCuentas" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                   

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                         
                                                      <div class="form-group">
                                                                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridCuentasAut"> 
                                                  
                                                
                                                                </div>
                                                      </div>    
                                                      
                                           </form>

                </div>

<!-- FIN CUENTAS  -->       


        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>
   