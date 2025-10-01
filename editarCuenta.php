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
$ni2 = $pac->consultaXidCuentaX($id);
$paxC = $ni2->fetch_assoc();


include 'Vistas/librerias.php';  

?>

  <body class="nav-md" style="overflow-x: hidden;">
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
                              <div class="col-md-12 col-sm-12 col-xs-12 ">

                                    <div class="x_panel">
                                          <div class="x_title">
                                          
                                            <h2 style="float: none;text-transform: uppercase;"><strong>NRO CUENTA:</strong>
                                            <?php echo $id."<strong style='margin-left:40px;'>DNI: </strong>".$paxC["nro_documento_paciente"]."<strong style='margin-left:40px;'>
                                            PACIENTE: </strong>".$paxC["apellido_paterno_paciente"]." ".$paxC["apellido_materno_paciente"]." ".$paxC["nombres_paciente"]." <strong style='margin-left: 100px;'> 
                                            REFERENCIA: </strong> <a style='cursor: pointer;' title='".$paxC["referencia"]."'>".$paxC["referencia"]."</a>"; ?></h2>
                                            <div class="clearfix"></div>
                                          </div>
                                          <div class="x_content">                                            
                                       <form class="form-horizontal form-label-left" id="frmDatosResponx">
                                          <input type="hidden" class="form-control" name="idcuen" id="idcuen" value="<?php echo $id; ?>">
                                          <h2 style="font-weight: bolder;">DATOS RESPONSABLE DE ATENCION MEDICA</h2><hr>
                                              <div class="form-group"> 
                                                  <label class="control-label col-md-1 col-sm-3 col-xs-12">TIPO DOC.</label>
                                                            <div class="col-md-1 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="tipodoc" id="tipodoc" required="required" tabindex="1">>
                                                                          <option >-- Seleccionar --</option>
                                                                          <option value="1">DNI</option>
                                                                          <option value="2">CARNET EXTRANJERIA</option>
                                                                  </select>
                                                  </div>
                                                  <label class="control-label col-md-1 col-sm-3 col-xs-12">NRO DOC.</label>
                                                  <div class="col-md-1 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="margin-bottom:0px;">
                                                                <input type="text" class="form-control" name="nrodoc" id="nrodoc" maxlength="11"  tabindex="2" style="width: 150px;">
                                                              <span class="input-group-btn">
                                                                <button type="button" class="btn btn-primary" id="cargaDniAuto"><i class="fa fa-search"></i></button>
                                                              </span>
                                                            </div>
                                                  </div>
                                                  <label class="control-label col-md-1 col-sm-3 col-xs-12" style="margin-left: 40px;">AP. PATERNO</label>
                                                            <div class="col-md-1 col-sm-12 col-xs-12">
                                                                <input type="text" class="form-control" name="apepaterno" id="apepaterno" maxlength="11"  tabindex="3"  >
                                                          </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12">AP. MATERNO</label>
                                                            <div class="col-md-1 col-sm-12 col-xs-12">
                                                                <input type="text" class="form-control" name="apematerno" id="apematerno" maxlength="11"  tabindex="4"  >
                                                          </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12">NOMBRES</label>
                                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                                <input type="text" class="form-control" name="nombres" id="nombres" maxlength="11"  tabindex="5"  >
                                                          </div>
                                                  </div>
                                                  <div class="form-group">
                                                        <label class="control-label col-md-1 col-sm-3 col-xs-12" >F. INGRESO <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-1 col-sm-12 col-xs-12">
                                                              <div class="input-group" style="margin-bottom:0px;">
                                                                  <input type="date" class="form-control" name="fingreso" id="fingreso"   tabindex="6"  >
                                                              </div>
                                                        </div>

                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12">F. ALTA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="margin-bottom:0px;">
                                                                <input type="date" class="form-control" name="fsalta" id="fsalta" maxlength="11"  tabindex="7"  >
                                                            </div>
                                                          </div>
                                                         
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" style="margin-left: 37px;">PROFESION</label>
                                                            <div class="col-md-1 col-sm-12 col-xs-12">
                                                              <select class="form-control" name="profesion" id="profesion" required="required" tabindex="8"></select>
                                                            </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12">COLEGIATURA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-1 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="margin-bottom:0px;">
                                                                <input type="text" class="form-control" name="colegio" id="colegio" maxlength="11"  tabindex="9"  >
                                                            </div>
                                                          </div>
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12">ESPECIALIDAD<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="margin-bottom:0px;">
                                                                <select class="form-control" style="text-transform: uppercase;" name="especialidad" id="especialidad" required="required" tabindex="10"></select>
                                                            </div>
                                                          </div>                                                        
                                                        
                                                      </div>
                                                   
                                                      <div class="form-group">
                                                           <label class="control-label col-md-1 col-sm-3 col-xs-12">RNE<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-1 col-sm-12 col-xs-12">
                                                                <div class="input-group" style="margin-bottom:0px;">
                                                                    <input type="text" class="form-control" name="nroregistro" id="nroregistro" maxlength="11"  tabindex="2"  >
                                                                </div>
                                                          </div>
                                                          
                                                          <label class="control-label col-md-1 col-sm-3 col-xs-12" >CONDICION</label>
                                                            <div class="col-md-1 col-sm-12 col-xs-12" style="width: 170px;">
                                                                  <select class="form-control" name="condicion" id="condicion" required="required" tabindex="12">>
                                                                          <option >-- Seleccionar --</option>
                                                                          <option value="1">ALTA</option>
                                                                          
                                                                  </select>
                                                          </div>
                                                          <!--<label class="control-label col-md-1 col-sm-3 col-xs-12" style="color: red;">ESTADO CUENTA</label>
                                                            <div class="col-md-1 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="estado" id="estado" required="required" tabindex="13">>
                                                                      
                                                                          <option value="0">PENDIENTE</option>
                                                                          <option value="1">TERMINADO</option>
                                                                  </select>
                                                          </div>-->
                                                          <div class="col-md-1 col-sm-12 col-xs-12">
                                                            <!--<a onclick="guardarResponsable(<?php echo $id; ?>)>" class="btEdit btn btn-danger"> <i class="fa fa-save"></i> Actualizar datos</a>-->
                                                            <button type="button" style="margin-left: 42px;" class="btn btn-danger" onclick="guardarResponsable(<?php echo $id; ?>)">
                                                            <i class="fa fa-save"></i>  Actualizar </button>
                                                          </div>
                                                         
                                                        </div>
                                                     
                                                     
                                                
                                                       
                                                  
                                                    </form>      
                                        <div class="ln_solid"></div>

                                        <div class="form-group">
                                          <div class="col-md-9 col-md-offset-5 hidden">
                                            <!--<a onclick="guardarResponsable(<?php echo $id; ?>)>" class="btEdit btn btn-danger"> <i class="fa fa-save"></i> Actualizar datos</a>-->
                                            <button type="button" class="btn btn-danger" onclick="guardarResponsable(<?php echo $id; ?>)"><i class="fa fa-save"></i>  Actualizar datos</button>
                                          </div>
                                        </div>

                                     
                                    </div>
                              </div>


                        </div>


                        <!-- form color picker -->
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12 ">
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
                                                                             <textarea rows="5" class="form-control"  id="descripcion" name="descripcion" ></textarea>
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
                                    <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;">PROCEDIMIENTOS</h2>                                                    
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="autoProc"> 

                                            
                                        </div>                                                   
                                  </div>
                                </div>
                        </div>
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
                                    
                                              <form class="form-horizontal form-label-left" method="POST" id="formPrcAuto">
                                                                      <input type="hidden" class="form-control"  value="<?php echo $iduser ?>" name="iduser" id="iduser"  >
                                                                      <input type="hidden" class="form-control"  name="idPrAuto" id="idPrAuto"  >          
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">PRESTACION</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="idpresProAuto" id="idpresProAuto" readonly >
                                                                  </div>
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">CANTIDAD</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                          <input type="text" class="form-control"  name="cantAuto" id="cantAuto"  tabindex="2">
                                                                    </div>
                                                          </div>
                                                          <div class="form-group">
                                                                 
                                                                 <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">DESCRIPCION</label>
                                                                  <div class="col-md-9 col-sm-12 col-xs-12">
                                                                     <textarea rows="7" cols="6"  class="form-control"  name="desCptAuto" id="desCptAuto"  style="text-transform: uppercase;" ></textarea>
                                                                       <!--<input type="text" class="form-control"  name="desCpt" id="desCpt"  style="text-transform: uppercase;">-->
                                                                  </div>
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">COD. CPT</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="codCptAuto" id="codCptAuto"  style="text-transform: uppercase;">
                                                                  </div>
                                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;">VALORIZACION</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                             <input type="text" class="form-control"  name="valorAuto" id="valorAuto"  >
                                                                  </div>
                                                          </div>
                                                          <div class="form-group">
                                                                 
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">TOTAL</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                             <input type="text" class="form-control"  name="totalpAuto" id="totalpAuto" readonly  >
                                                                  </div>
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">DX</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12">
                                                                              <select class="form-control" name="dx" id="dx" required="required" tabindex="6">>
                                                                                  
                                                                              </select>
                                                                    </div>
                                                                 
                                                          </div>
                                                        
                                                
                                              </form>
                                            </div>

                                            <div class="modal-footer" id="el"> 
                                                  <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="insertProcAuto();" tabindex="3" >Guardar</button>                                      
                                                  <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraPrc">CERRAR</button>
                                              </div>
                                            
                                    
                                      </div>
                                </div>
                        </div>


                      <!-- FIN MODAL PROCEDIMIENTOS -->



                    <!-- FIN -->
 <!-- form color picker -->
                      <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                    <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;">Insumos</h2>                                                    
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridInsumosAuto"> 

                                            
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
                                    
                                              <form class="form-horizontal form-label-left" method="POST" id="formInsuAuto">
                                                                      <input type="hidden" class="form-control"  value="<?php echo $iduser ?>" name="iduser" id="iduser"  >
                                                                      <input type="hidden" class="form-control"  name="idInsAuto" id="idInsAuto"  >          
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">PRESTACION</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="idpresInsuAuto" id="idpresInsuAuto" readonly >
                                                                  </div>
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">CANTIDAD</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                          <input type="text" class="form-control"  name="cantInAuto" id="cantInAuto"  >
                                                                    </div>
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">SISMED</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="codSismedAuto" id="codSismedAuto"  >
                                                                  </div>
                                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">DX</label>
                                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                                              <select class="form-control" name="diagAuto" id="diagAuto" required="required" tabindex="6">>
                                                                                  
                                                                              </select>
                                                                    </div>
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">VALORIZACION</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="valoriAuto" id="valoriAuto" readonly >
                                                                  </div>
                                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;">TOTAL</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                             <input type="text" class="form-control"  name="totaliAuto" id="totaliAuto" readonly  >
                                                                  </div>
                                                                 
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">DESCRIPCION</label>
                                                                  <div class="col-md-9 col-sm-12 col-xs-12">
                                                                              <textarea class="form-control" rows="4" id="desAuto" name="desAuto" readonly></textarea>
                                                                             
                                                                  </div>
                                                                  
                                                          </div>
                                                        
                                                
                                              </form>
                                            </div>

                                            <div class="modal-footer" id="el"> 
                                                  <button type="button" class="btn btn-danger" id="GuardarPacientese" onclick="insertInsumosAuto();" >Guardar</button>                                      
                                                  <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraInsu">CERRAR</button>
                                              </div>
                                            
                                    
                                      </div>
                                </div>
                        </div>


                      <!-- FIN MODAL INSUMOS -->

                    <!-- FIN -->

           <!-- form color picker -->
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                    <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;">Medicamentos</h2>                                                    
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridMedicamentosAuto"> 

                                            
                                        </div>                                                   
                                  </div>
                                </div> <br><br><br>
                        </div>

                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12 ">
                                <div class="x_panel">
                                 
                                  <div class="col-md-offset-5 x_content">
                                       <button type="button" style="margin-left: 42px;" class="btn btn-danger" onclick="actualEstado(<?php echo $id; ?>)">
                                                            <i class="fa fa-send"></i>  ENVIAR </button>                                                 
                                  </div>
                                </div>
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
                                    
                                              <form class="form-horizontal form-label-left" method="POST" id="formMedAuto">
                                                                      <input type="hidden" class="form-control"  value="<?php echo $iduser ?>" name="iduser" id="iduser"  >
                                                                      <input type="hidden" class="form-control"  name="idMedicAuto" id="idMedicAuto"  >          
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">PRESTACION</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="idpresMedcaAuto" id="idpresMedcaAuto" readonly >
                                                                  </div>
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">CANTIDAD</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                          <input type="text" class="form-control"  name="cantMedAuto" id="cantMedAuto"  >
                                                                    </div>
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">SISMED</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="codSisMxAuto" id="codSisMxAuto"  >
                                                                  </div>
                                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">DX</label>
                                                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                                                              <select class="form-control" name="diagMedAuto" id="diagMedAuto" required="required" tabindex="6">>
                                                                                  
                                                                              </select>
                                                                    </div>
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">VALORIZACION</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="valoriMedAuto" id="valoriMedAuto"  >
                                                                  </div>
                                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;">TOTAL</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                             <input type="text" class="form-control"  name="totalmAuto" id="totalmAuto" readonly  >
                                                                  </div>
                                                                 
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">DESCRIPCION</label>
                                                                  <div class="col-md-8 col-sm-12 col-xs-12">
                                                                              <textarea class="form-control" rows="4" id="desMedAuto" name="desMedAuto" readonly></textarea>
                                                                    </div>
                                                                    
                                                          </div>
                                                        
                                                
                                              </form>
                                            </div>

                                            <div class="modal-footer" id="el"> 
                                                  <button type="button" class="btn btn-danger" id="GuardarPaciente45" onclick="insertMedicsAuto();" >Guardar</button>                                      
                                                  <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraMed">CERRAR</button>
                                              </div>
                                            
                                    
                                      </div>
                                </div>
                        </div>


                      <!-- FIN MODAL INSUMOS -->

                    <!-- FIN -->


<!-- fixed -->
<!--
<div id="hiddenMap">
      <div class="toolbar">
            <div id="div_maps">
                <a href="autorizaciones.php"  class="btn btn-success"><i class="fa fa-mail-reply-all"></i> Regresar</a>
            </div>
      </div>
</div> -->

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