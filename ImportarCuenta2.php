 <?php 


//error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Esta pagina es solo para usuarios registrados'); window.location='index.php';</script>";  
  exit;
} 

include_once ('./config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();


$id = $_GET["id"];
$ni = $pac->consultaXid($id);



include 'Vistas/librerias.php';  

?>
<script>
    $( document ).ready(function() {
            $("div:contains('K830')").css("background", "red");
               var id = getParameterByName('id');
             verPacienteX(id);
             
            
             
             aplicaReglaConsistencia(id);
              Cargar1(id);
              cargarPresHospi();
            /* setTimeout(function (){
               alert(id);
            }, 1000);*/
            
            $("#codPreHos").keydown(function(e) {
            if(e.which == 9) {
                         e.preventDefault();
                         cargaDenominacion();
                         $("#ubiSerHosp").focus();   
                }
            });
            
            $("#codPreHos").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                    cargaDenominacion();
                    $("#ubiSerHosp").focus();   
                }
            });
            
            $( "#ubiSerHosp" ).change(function() {
        	    var idDis = $("#ubiSerHosp").val();	
        		cargarCodpreHospi(idDis);
        		
        		
        	});
        	
        	
        	
        /*	$( "#prioAudit" ).change(function() {
        	    $('#dx1').focus();
        	     var id = getParameterByName('id');
        		enviarObservacion(id);
            	aplicaReglaConsistencia(id);
        		
        	});*/
        	
        	 $("#dx1").click(function(){
                var id = getParameterByName('id');
                enviarObservacion(id)
                aplicaReglaConsistencia(id);
            });
            
        	
        	$("#prioAudit").keydown(function(e) {
            if(e.which == 9) {
                         e.preventDefault();
                          var id = getParameterByName('id');
        	              enviarObservacion(id);
        	              aplicaReglaConsistencia(id);
        	               $('#dx1').focus();
                }
            });
            
            $("#prioAudit").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                    var id = getParameterByName('id');
        	        enviarObservacion(id);
        	        aplicaReglaConsistencia(id);
        	         $('#dx1').focus();
                   
                }
                
            });
            
            
    });
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
        <div class="right_col" role="main" style="background: #e8e8e8;">
      
                  <div class="row">
                              <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12 ">

                                    <div class="x_panel">
                                          <div class="x_title">
                                            <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;">DATOS DEL PACIENTE</h2>
                                            <button type="button" class="btn btn-default btn-xs" style="background:#25a5ff;color:white" >PAC</button>
                                            <button type="button" class="btn btn-default btn-xs" style="background:green;color:white">FISSAL</button>
                                            <button type="button" class="btn btn-default btn-xs" style="background:rgb(238 162 54);color:white">LERH</button>
                                            <div class="clearfix"></div>
                                          </div>
                                          <div class="x_content">
                                            <br />
                                          <form class="form-horizontal form-label-left" id="frmDatosPacientes">
                                                  <input type="hidden" class="form-control"  value="<?php echo $iduser ?>" name="iduserDat" id="iduserDat"  >
                                                  <div class="form-group">
                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12">NRO FUA <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input type="text" class="form-control" name="nrofua" id="nrofua" maxlength="21" tabindex="1"  readonly>
                                                            </div>
                                                          </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">N° CUENTA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                                <input type="text" class="form-control" name="NxuentaX" id="NxuentaX" maxlength="11"  tabindex="2" readonly >
                                                          </div>
                                                        
                                                      </div>
                                                     
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">HISTORIA  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="historia" id="historia" tabindex="3" style="text-transform: uppercase;" readonly>
                                                        </div>

                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">DNI  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;" readonly>*</span></label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control"  name="dni" tabindex="4" id="dni"  readonly style="text-transform: uppercase;">
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">PACIENTE  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required" name="pacix" id="pacix" tabindex="5"  style="text-transform: uppercase;" readonly>
                                                        </div>
                                                      
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">SERVICIO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="servicioX" id="servicioX" tabindex="6"  style="text-transform: uppercase;" readonly>
                                                        </div>
                                                      
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA INGRESO<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="feingresoX" id="feingresoX" tabindex="7"  style="text-transform: uppercase;" readonly>
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">FECHA ALTA  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" name="fecorteX" id="fecorteX"  tabindex="8" style="text-transform: uppercase;" readonly>
                                                          </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12" id="diasCont" style="text-align: left;color: red;font-weight: 900;"></label>
                                                      </div>
                                                       <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">VALORIZADO MEDIC-INSU<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="mongale" id="mongale" tabindex="9"  style="text-transform: uppercase;" readonly>
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">VALORIZADO PROC-LAB<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" name="monsisfax" id="monsisfax"  tabindex="10" style="text-transform: uppercase;" readonly>
                                                          </div>
                                                           <label class="control-label col-md-2 col-sm-3 col-xs-12">VALORIZADO ATENCION<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" name="moatio" id="moatio"  tabindex="11" style="text-transform: uppercase;" readonly>
                                                          </div>
                                                      </div>
                                                      <div class="form-group hidden">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">DENOMINACION<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-10 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="deniom" id="deniom" tabindex="12"  style="text-transform: uppercase;" readonly>
                                                        </div>
                                                      
                                                      </div>
                                                      <div class="form-group">
                                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">COD_PRES</label>
                                                                <div class="col-md-1 col-sm-12 col-xs-12">
                                                                    <input type="text" class="form-control" required="required" name="codPreHos" tabindex="12" id="codPreHos"  style="width: 55px;"  >
                                                                </div>
                                                                 <label class="control-label col-md-2 col-sm-3 col-xs-12">DENOMINACION</label>
                                                                <div class="col-md-5 col-sm-12 col-xs-12" >
                                                                    <select class="form-control" name="ubiSerHosp" id="ubiSerHosp" required="required" tabindex="13" style="text-transform: uppercase;"> 
                                                                    </select>
                                                                     
                                                                </div>
                                                                  <div class="col-md-2 col-sm-12 col-xs-12">
                                                                            <select class="form-control" name="prioAudit" id="prioAudit" required="required" tabindex="14" style="text-transform: uppercase;"> 
                                                                                    <option value="0">Seleccionar</option>
                                                                                    <option value="1">I</option>
                                                                                    <option value="2">II</option>
                                                                                    <option value="3">III</option>
                                                                                    <option value="4">IV</option>
                                                                                    
                                                                            </select>
                                                                  </div>
                                                                
                                                        </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 1<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="dx1" id="dx1" tabindex="15"  style="text-transform: uppercase;">
                                                        </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip1" id="tip1" required="required" tabindex="16">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 2<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="dx2" id="dx2" tabindex="17"  style="text-transform: uppercase;">
                                                        </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip2" id="tip2" required="required" tabindex="18">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 3<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="dx3" id="dx3" tabindex="19"  style="text-transform: uppercase;">
                                                        </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip3" id="tip3" required="required" tabindex="20">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 4<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="dx4" id="dx4" tabindex="21"  style="text-transform: uppercase;">
                                                        </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip4" id="tip4" required="required" tabindex="22">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 5<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="dx5" id="dx5" tabindex="23"  style="text-transform: uppercase;">
                                                        </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip5" id="tip5" required="required" tabindex="24">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 6<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="dx6" id="dx6" tabindex="25"  style="text-transform: uppercase;">
                                                        </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip6" id="tip6" required="required" tabindex="26">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 7<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="dx7" id="dx7" tabindex="27"  style="text-transform: uppercase;">
                                                        </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip7" id="tip7" required="required" tabindex="28">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 8<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="dx8" id="dx8" tabindex="29"  style="text-transform: uppercase;">
                                                        </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip8" id="tip8" required="required" tabindex="30">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 9<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="dx9" id="dx9" tabindex="31"  style="text-transform: uppercase;">
                                                        </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip9" id="tip9" required="required" tabindex="32">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CIE10 10<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="dx10" id="dx10" tabindex="33"  style="text-transform: uppercase;">
                                                        </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="width: 35px;">TIPO</label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12" style="width: 80px;">
                                                                <select class="form-control" name="tip10" id="tip10" required="required" tabindex="34">
                                                                        <option value="D">D</option>
                                                                        <option value="P">P</option>
                                                                </select>
                                                           </div>
                                                      </div>
                                                      <div class="form-group" >
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12" style="color: red;">OBSERVACION SIGEPS</label>
                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                                  <textarea class="form-control" rows="3" id="comment" name="comment" style="border: 1px solid red;" maxlength="200"  tabindex="35"></textarea>
                                                                  <label class="col-md-8 col-sm-3 col-xs-12" id="contador" style="color: red;margin-left: -10px;">Máximo 200 caracteres.</label>
                                                          </div>
                                                       
                                                      </div>
                                             
                                        <div class="ln_solid"></div>

                                        <div class="form-group" >
                                          <div class="col-md-9 col-md-offset-9">
                                            
                                            <!--<a href="ImporConsol.php?id=<?php echo $id; ?>" class="btn btn-info btn-xs"><i class="fa fa-cloud-download"></i> Importar</a>-->
                                            <a id="imrpesion" href="imprimir.php?id=<?php echo $id; ?>" target="blank" class="hidden btn btn-default" style="border: 1px solid black;"> <i class="fa fa-file-pdf-o"></i> Imprimir</a>
                                            <a  onclick="enviarObservacion(<?php echo $id; ?>)" id="enviar999" class="btn btn-danger" tabindex="36"> <i class="fa fa-save" ></i> Enviar</a>
                                           <!-- <a href="exportar.php?id=<?php echo $id; ?>" class="btEdit btn btn-success btn-xs"> <i class="fa fa-file-excel-o"></i> Exportar</a>-->
                                          </div>
                                        </div>

                                      </form>
                                    </div>
                              </div>


                        </div>


                        <!-- form color picker -->
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12 hidden">
                                <div class="x_panel">
                                  <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                    <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;">Diagnosticos</h2>                                                    
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridDiagnostico"> 

                                            
                                        </div>                                                   
                                  </div>
                                </div>
                        </div>
                        <!-- MODAL DIAGNOSTICOS -->
                      <div class="modal fade bs-example-modal-ModalDiag" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                                <div class="modal-dialog modal-lm">
                                  <div class="modal-content">

                                            <div class="modal-header" style="background:#6bb7f7;color: white;text-transform: uppercase;text-align: center;">
                                                <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                                <h4 class="modal-title" id="pacient">AGREGAR DIAGNOSTICO</h4>
                                            </div>
                                            <div class="modal-body">
                                    
                                              <form class="form-horizontal form-label-left" method="POST" id="formDx">
                                                                      <input type="hidden" class="form-control"  value="<?php echo $iduser ?>" name="iduserDX" id="iduserDX"  >
                                                                      <input type="hidden" class="form-control"  name="idDx" id="idDx"  >          
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">PRESTACION</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="idpres" id="idpres" readonly >
                                                                  </div>
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">TIPO DX</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12">
                                                                              <select class="form-control" name="tipoDx" id="tipoDx" required="required" tabindex="6">>
                                                                                      <option >-- Seleccionar --</option>
                                                                                      <option value="1">DEFINITIVO</option>
                                                                                      <option value="2">PRESUNTIVO</option>
                                                                                      <option value="3">REPETITIVO</option>
                                                                              </select>
                                                                    </div>
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">COD. DX</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="codDx" id="codDx"  style="text-transform: uppercase;" >
                                                                  </div>
                                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;">DESCRIPCION</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12">
                                                                             <textarea rows="5" class="form-control"  id="descripcion" name="descripcion" readonly></textarea>
                                                                    </div>
                                                          </div>
                                                        
                                                
                                              </form>
                                            </div>

                                            <div class="modal-footer" id="el"> 
                                                  <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="insertDx();" >Guardar</button>                                      
                                                  <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraDx">CERRAR</button>
                                              </div>
                                            
                                    
                                      </div>
                                </div>
                        </div>


                      <!-- FIN MODAL DIAGNOSTICOS -->

                    <!-- INICIO -->


                    <!-- form color picker -->
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                    <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;margin-bottom: -6px;">
                                    PROCEDIMIENTOS CPMS<a style="float: right;border: 1px solid black;color: black;" onclick="clearFrmProc('<?php echo $id ?>');" 
                                                              data-toggle="modal" data-target=".bs-example-modal-ModalProc" class="btEdit btn btn-default btn-xs">+ Agregar</a>  
                                    </h2>
                                                                                  
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagrid1"> 

                                            
                                        </div>                                                   
                                  </div>
                                </div>
                        </div>
                    <!--  FIN TABLE   -->


                     <!-- form color picker -->
                    <!--  <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                    <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;">PROCEDIMIENTOS MEDICO - QUIRÚRGICOS</h2>                                                    
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagrid2"> 

                                            
                                        </div>                                                   
                                  </div>
                                </div>
                        </div> -->
                    <!--  FIN TABLE   -->

                     <!-- form color picker -->
                  <!--    <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                    <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;">PROCEDIMIENTOS DE PATOLOGIA CLINICA-GENÉTICA - ANATOMIA PATOLOGICA</h2>                                                    
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagrid3"> 

                                            
                                        </div>                                                   
                                  </div>
                                </div>
                        </div> -->
                    <!--  FIN TABLE   -->

                     <!-- form color picker -->
                    <!-- <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                    <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;">PROCEDIMIENTOS RADIOLÓGICOS Y RADIOLOGIA INTERVENCIONISTA</h2>                                                    
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagrid4"> 

                                            
                                        </div>                                                   
                                  </div>
                                </div>
                        </div>-->
                    <!--  FIN TABLE   -->
                     <!-- form color picker -->
               <!--      <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                    <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;">PROCEDIMIENTOS BANCO DE SANGRE</h2>                                                    
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagrid5"> 

                                            
                                        </div>                                                   
                                  </div>
                                </div>
                        </div>-->
                    <!--  FIN TABLE   -->
                    <!-- MODAL PROCEDIMIENTOS -->
                    <!--<div class="modal fade bs-example-modal-ModalProc" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >-->

                   
                    <div class="modal fade bs-example-modal-ModalProc" tabindex="-1" id="myModal" role="dialog"  >
                                <div class="modal-dialog modal-lm">
                                  <div class="modal-content">

                                            <div class="modal-header" style="background:#6bb7f7;color: white;text-transform: uppercase;text-align: center;">
                                                <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                                <h4 class="modal-title" id="pacient">AGREGAR PROCEDIMIENTOS</h4>
                                            </div>
                                            <div class="modal-body">
                                    
                                              <form class="form-horizontal form-label-left" method="POST" id="formPrc">

                                              <table style="width: 100%;">
                                              <tbody>
                                                   <tr> 
                                                         
                                                                
                                                  </tr>
                                            
                                              </tbody>
                                              </table>



                                                                      <input type="hidden" class="form-control"  value="<?php echo $iduser ?>" name="iduser" id="iduser"  >
                                                                      <input type="hidden" class="form-control"  name="idPr" id="idPr"  >          
                                                          <div class="form-group ">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12 hidden" style="text-align: right;">PRESTACION</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12 hidden">
                                                                      <input type="text" class="form-control"  name="idpresPro" id="idpresPro" readonly >
                                                                  </div>
                                                                 
                                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">COD. CPMS</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="codCpt" id="codCpt"  style="text-transform: uppercase;">
                                                                  </div>
                                                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;">PRECIO</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                             <input type="text" class="form-control"  name="valor" id="valor"  >
                                                                  </div>
                                                          </div>
                                                          <div class="form-group">
                                                                 
                                                                 <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">DESCRIPCION</label>
                                                                  <div class="col-md-9 col-sm-12 col-xs-12">
                                                                     <textarea rows="7" cols="6"  class="form-control"  name="desCpt" id="desCpt"  style="text-transform: uppercase;" ></textarea>
                                                                       <!--<input type="text" class="form-control"  name="desCpt" id="desCpt"  style="text-transform: uppercase;">-->
                                                                  </div>
                                                          </div>
                                                          <div class="form-group">
                                                               <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">CANTIDAD</label>
                                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                                            <input type="text" class="form-control"  name="cant" id="cant"  tabindex="132">
                                                                      </div>
                                                                 
                                                          </div>
                                                          <div class="form-group">
                                                                 
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">TOTAL</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                             <input type="text" class="form-control"  name="totalp" id="totalp" readonly  >
                                                                  </div>
                                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">DX</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <select class="form-control" name="dx" id="dx" required="required" tabindex="133" > 
                                                                              <option value="1">1</option>
                                                                              <option value="2">2</option>
                                                                              <option value="3">3</option>
                                                                              <option value="4">4</option>
                                                                              <option value="5">5</option>
                                                                              <option value="6">6</option>
                                                                              <option value="7">7</option>
                                                                              <option value="8">8</option>
                                                                              <option value="9">9</option>
                                                                              <option value="10">10</option>

                                                                      </select>
                                                                  </div>
                                                                 
                                                          </div>
                                                        
                                                
                                              </form><br>
                                              <a style="font-weight: bolder;color: white;margin-left: 102px;" onclick="verCpms();" 
                                                              data-toggle="modal" data-target=".bs-example-modal-verCpmsx" class="btEdit btn btn-success btn-xs">+ Busqueda por Cpt, Cpms, Descripción</a> 
                                            </div>
                                                                            

                                            <div class="modal-footer" id="el"> 
                                                  <button type="button" class="btn btn-danger" id="GuardarPaciente1" onclick="insertProc();" tabindex="134" >Guardar</button>                                      
                                                  <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraPrc">CERRAR</button>
                                              </div>
                                            
                                    
                                      </div>
                                </div>
                        </div>


                      <!-- FIN MODAL PROCEDIMIENTOS -->

                      
                      <!-- MODAL PROCEDIMIENTOS -->
                    
                        <div class="modal fade bs-example-modal-verCpmsx" tabindex="-1" id="myModal" role="dialog"  >
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">

                                            <div class="modal-header" style="background:#6bb7f7;color: white;text-transform: uppercase;text-align: center;">
                                                <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                                <h4 class="modal-title" id="pacient">BUSQUEDA</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="vercp"></div>
                                            </div>
                                      </div>
                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraCptms">CERRAR</button>
                                </div>

                        </div>


                      <!-- FIN MODAL PROCEDIMIENTOS -->


                    <!-- FIN -->
 <!-- form color picker -->
                      <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12 hidden">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                    <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;">Insumos</h2>                                                    
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridInsumos"> 

                                            
                                        </div>                                                   
                                  </div>
                                </div>
                        </div>

                         <!-- MODAL INSUMOS -->
                    <div class="modal fade bs-example-modal-ModalInsu" tabindex="-1" id="myModal" role="dialog"  >
                                <div class="modal-dialog modal-lm">
                                  <div class="modal-content">

                                            <div class="modal-header" style="background:#6bb7f7;color: white;text-transform: uppercase;text-align: center;">
                                                <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                                <h4 class="modal-title" id="pacient">AGREGAR INSUMOS</h4>
                                            </div>
                                            <div class="modal-body">
                                    
                                              <form class="form-horizontal form-label-left" method="POST" id="formInsu">
                                                                      <input type="hidden" class="form-control"  value="<?php echo $iduser ?>" name="iduser" id="iduser"  >
                                                                      <input type="hidden" class="form-control"  name="idIns" id="idIns"  >          
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">PRESTACION</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="idpresInsu" id="idpresInsu" readonly >
                                                                  </div>
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">CANTIDAD</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                          <input type="text" class="form-control"  name="cantIn" id="cantIn"  >
                                                                    </div>
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">SISMED</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="codSismed" id="codSismed"  >
                                                                  </div>
                                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;">DIAGNOSTICO</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                             <input type="text" class="form-control"  name="diag" id="diag" style="text-transform: uppercase;" >
                                                                    </div>
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">VALORIZACION</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="valori" id="valori"  >
                                                                  </div>
                                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;">TOTAL</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                             <input type="text" class="form-control"  name="totali" id="totali" readonly  >
                                                                  </div>
                                                                 
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">DESCRIPCION</label>
                                                                  <div class="col-md-9 col-sm-12 col-xs-12">
                                                                              <textarea class="form-control" rows="4" id="des" name="des" readonly></textarea>
                                                                             
                                                                  </div>
                                                                  
                                                          </div>
                                                        
                                                
                                              </form>
                                            </div>

                                            <div class="modal-footer" id="el"> 
                                                  <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="insertInsumos();" >Guardar</button>                                      
                                                  <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraInsu">CERRAR</button>
                                              </div>
                                            
                                    
                                      </div>
                                </div>
                        </div>


                      <!-- FIN MODAL INSUMOS -->

                    <!-- FIN -->

           <!-- form color picker -->
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12 hidden">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                    <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;">Medicamentos</h2>                                                    
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridMedicamentos"> 

                                            
                                        </div>                                                   
                                  </div>
                                </div> <br><br><br><br> <br><br><br><br>
                        </div>

                       

                        <!-- MODAL INSUMOS -->
                         <div class="modal fade bs-example-modal-ModalMed" tabindex="-1" id="myModal" role="dialog"  >
                                <div class="modal-dialog modal-lm">
                                  <div class="modal-content">

                                            <div class="modal-header" style="background:#6bb7f7;color: white;text-transform: uppercase;text-align: center;">
                                                <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                                <h4 class="modal-title" id="pacient">AGREGAR MEDICAMENTOS</h4>
                                            </div>
                                            <div class="modal-body">
                                    
                                              <form class="form-horizontal form-label-left" method="POST" id="formMed">
                                                                      <input type="hidden" class="form-control"  value="<?php echo $iduser ?>" name="iduser" id="iduser"  >
                                                                      <input type="hidden" class="form-control"  name="idMedic" id="idMedic"  >          
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">PRESTACION</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="idpresMedca" id="idpresMedca" readonly >
                                                                  </div>
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">CANTIDAD</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                          <input type="text" class="form-control"  name="cantMed" id="cantMed"  >
                                                                    </div>
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">SISMED</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="codSisMx" id="codSisMx"  >
                                                                  </div>
                                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;">DIAGNOSTICO</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                             <input type="text" class="form-control"  name="diagMed" id="diagMed" style="text-transform: uppercase;"  >
                                                                    </div>
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">VALORIZACION</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="valoriMed" id="valoriMed"  >
                                                                  </div>
                                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;">TOTAL</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                             <input type="text" class="form-control"  name="totalm" id="totalm" readonly  >
                                                                  </div>
                                                                 
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">DESCRIPCION</label>
                                                                  <div class="col-md-8 col-sm-12 col-xs-12">
                                                                              <textarea class="form-control" rows="4" id="desMed" name="desMed" readonly></textarea>
                                                                    </div>
                                                                    
                                                          </div>
                                                        
                                                
                                              </form>
                                            </div>

                                            <div class="modal-footer" id="el"> 
                                                  <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="insertMedics();" >Guardar</button>                                      
                                                  <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraMed">CERRAR</button>
                                              </div>
                                            
                                    
                                      </div>
                                </div>
                        </div>


                      <!-- FIN MODAL INSUMOS -->

                    <!-- FIN -->


<!-- fixed -->

<div id="hiddenMap">
      <div class="toolbar">
            <div id="div_maps">
                <a href="javascript:history.back()"  class="btn btn-success"><i class="fa fa-mail-reply-all"></i> Regresar</a>
            </div>
      </div>
</div> 

<!-- fixed -->


                  </div>
                  
                 
        </div>

        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>
   <style>

#hiddenMap {
width:320px;
margin: 0 0 30px 0;
position:relative;
}
.toolbar {
position: fixed;
z-index: 100;
margin-left:2px;
bottom: 20%;
}

   </style>