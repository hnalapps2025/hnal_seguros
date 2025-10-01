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
        <div class="right_col" role="main" style="background: #e8e8e8;">
      
                  <div class="row">
                              <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12 ">

                                    <div class="x_panel">
                                          <div class="x_title">
                                            <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;">DATOS DEL PACIENTE</h2>
                                            
                                            <div class="clearfix"></div>
                                          </div>
                                          <div class="x_content">
                                            <br />
                                          <form class="form-horizontal form-label-left" id="frmDatosPacientes">
                                                  <input type="hidden" class="form-control"  value="<?php echo $iduser ?>" name="iduserDat" id="iduserDat"  >
                                              <div class="form-group">
                                                  <label class="control-label col-md-2 col-sm-3 col-xs-3">ID PRESTACION</label>
                                                  <div class="col-md-3 col-sm-9 col-xs-9">
                                                       <input type="text" class="form-control" id="idPresDatPac" name="idPresDatPac"  value="<?php echo $id ?>" readonly>
                                                  </div>
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-3">N° ATENCION</label>
                                                  <div class="col-md-4 col-sm-9 col-xs-9">
                                                        <input type="text" class="form-control" id="nAtencionDat" name="nAtencionDat" readonly>
                                                  </div>
                                                </div>
                                              <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-3">N° AUTORIZACION</label>
                                                <div class="col-md-3 col-sm-9 col-xs-9">
                                                      <input type="text" class="form-control" id="nAutoDat" name="nAutoDat" readonly>
                                                </div>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">N° HISTORIA</label>
                                                <div class="col-md-4 col-sm-9 col-xs-9">
                                                      <input type="text" class="form-control" id="nHistoriaDat" name="nHistoriaDat" readonly>
                                                </div>
                                              </div>
                                              
                                              <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-3">TIPO DOC.</label>
                                                <div class="col-md-3 col-sm-9 col-xs-9">
                                                      <input type="text" class="form-control" id="tipoDocDat" name="tipoDocDat" readonly>
                                                </div>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">N° DOC.</label>
                                                <div class="col-md-4 col-sm-9 col-xs-9">
                                                        <input type="text" class="form-control" id="nroDocDat" name="nroDocDat" readonly>
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-3">A. PATERNO</label>
                                                <div class="col-md-3 col-sm-9 col-xs-9">
                                                      <input type="text" class="form-control" id="aPaternoDat" name="aPaternoDat" readonly style="font-weight: bolder;">
                                                </div>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">A. MATERNO</label>
                                                <div class="col-md-4 col-sm-9 col-xs-9">
                                                      <input type="text" class="form-control" id="aMaternoDat" name="aMaternoDat" readonly style="font-weight: bolder;">
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-3">NOMBRES</label>
                                                <div class="col-md-3 col-sm-9 col-xs-9">
                                                      <input type="text" class="form-control" id="nombresDat" name="nombresDat" readonly style="font-weight: bolder;">
                                                </div>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">FECHA INGRESO</label>
                                                <div class="col-md-4 col-sm-9 col-xs-9">
                                                        <input type="text" class="form-control" id="fechaIngresoDat" name="fechaIngresoDat" readonly style="font-weight: bolder;">
                                                </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-3">FECHA ALTA</label>
                                                <div class="col-md-3 col-sm-9 col-xs-9">
                                                      <input type="text" class="form-control" id="fechaAltaDat" name="fechaAltaDat" readonly style="font-weight: bolder;">
                                                </div>
                                               
                                              </div>
                                             
                                        <div class="ln_solid"></div>

                                        <div class="form-group hidden">
                                          <div class="col-md-9 col-md-offset-9">
                                            <button class="btn btn-warning" >EDITAR</button>
                                            <button type="submit" class="btn btn-danger">GUARDAR</button>
                                          </div>
                                        </div>

                                      </form>
                                    </div>
                              </div>


                        </div>


                        <!-- form color picker -->
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12">
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
                                                                      <input type="hidden" class="form-control"  value="<?php echo $iduser ?>" name="iduser" id="iduser"  >
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
                                    <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;">Procedimientos</h2>                                                    
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridProcedimientos"> 

                                            
                                        </div>                                                   
                                  </div>
                                </div>
                        </div>

                    <!-- MODAL PROCEDIMIENTOS -->
                    <div class="modal fade bs-example-modal-ModalProc" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                                <div class="modal-dialog modal-lm">
                                  <div class="modal-content">

                                            <div class="modal-header" style="background:#6bb7f7;color: white;text-transform: uppercase;text-align: center;">
                                                <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                                <h4 class="modal-title" id="pacient">AGREGAR PROCEDIMIENTOS</h4>
                                            </div>
                                            <div class="modal-body">
                                    
                                              <form class="form-horizontal form-label-left" method="POST" id="formPrc">
                                                                      <input type="hidden" class="form-control"  value="<?php echo $iduser ?>" name="iduser" id="iduser"  >
                                                                      <input type="hidden" class="form-control"  name="idPr" id="idPr"  >          
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">PRESTACION</label>
                                                                  <div class="col-md-4 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="idpresPro" id="idpresPro" readonly >
                                                                  </div>
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">CANTIDAD</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                          <input type="number" class="form-control"  name="cant" id="cant"  >
                                                                    </div>
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">COD. CPT</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <input type="text" class="form-control"  name="codCpt" id="codCpt"  style="text-transform: uppercase;">
                                                                  </div>
                                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" style="text-align: right;">VALORIZACION</label>
                                                                  <div class="col-md-3 col-sm-12 col-xs-12">
                                                                             <input type="text" class="form-control"  name="valor" id="valor"  >
                                                                    </div>
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">DESCRIPCION</label>
                                                                  <div class="col-md-10 col-sm-12 col-xs-12">
                                                                       <textarea rows="6" cols="10"  class="form-control"  name="desCpt" id="desCpt"  style="text-transform: uppercase;" readonly></textarea>
                                                                      
                                                                  </div>
                                                                 
                                                          </div>
                                                        
                                                
                                              </form>
                                            </div>

                                            <div class="modal-footer" id="el"> 
                                                  <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="insertProc();" >Guardar</button>                                      
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
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridInsumos"> 

                                            
                                        </div>                                                   
                                  </div>
                                </div>
                        </div>

                         <!-- MODAL INSUMOS -->
                    <div class="modal fade bs-example-modal-ModalInsu" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
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
                                                                          <input type="number" class="form-control"  name="cantIn" id="cantIn"  >
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
                                                                 
                                                          </div>
                                                          <div class="form-group">
                                                                  <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: right;">DESCRIPCION</label>
                                                                  <div class="col-md-8 col-sm-12 col-xs-12">
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
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12">
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
                         <div class="modal fade bs-example-modal-ModalMed" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
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
                                                                          <input type="number" class="form-control"  name="cantMed" id="cantMed"  >
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
                <a href="registros.php"  class="btn btn-success"><i class="fa fa-mail-reply-all"></i> Regresar</a>
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