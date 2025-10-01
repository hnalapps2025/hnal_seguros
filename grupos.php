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
<script>



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
                                <h2 style="text-transform: uppercase;">Lista de comsulta externa saludpol <small></small></h2>
                               
                                <a class="btn btn-warning" style="float: right;" class="dropdown-toggle" data-toggle="modal" data-target=".bs-example-modal-smGruX" 
                                id="agr2" role="button" aria-expanded="false"><i class="fa fa-arrows"></i>
                                Crear grupo</a>
                                
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
                                          <div style="display:none;text-align: center;color: #405467;font-family: century gothic;font-size: 21px;" id="dvloadercptGru">
                                              <img src="images/loading.gif" /><br>Espere un momento por favor ..</div>
                                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridGrupods"> 
                                              
                                            
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

    

        <div class="modal fade bs-example-modal-smGruX" tabindex="-1" id="myModalIng" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title">GENERAR GRUPO</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formGropuVal" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
    
                                                      <br>
                                                    
                                                      <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">MES<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-3 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="mes" id="mes" required="required" tabindex="8">>                         
                                                                      <option value="Enero">Enero</option>
                                                                      <option value="Febrero">Febrero</option>
                                                                      <option value="Marzo">Marzo</option>
                                                                      <option value="Abril">Abril</option>
                                                                      <option value="Mayo">Mayo</option>
                                                                      <option value="Junio">Junio</option>
                                                                      <option value="Julio">Julio</option>
                                                                      <option value="Agosto">Agosto</option>
                                                                      <option value="Setiembre">Setiembre</option>
                                                                      <option value="Octubre">Octubre</option>
                                                                      <option value="Noviembre">Noviembre</option>
                                                                      <option value="Diciembre">Diciembre</option>
                                                                      
                                                                    </select>
                                                               </div>
                                                              <label class="control-label col-md-2 col-sm-3 col-xs-12">AÑO<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-3 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="anio" id="anio" required="required" tabindex="8">>                         
                                                                      <option value="2018">2018</option>
                                                                      <option value="2019">2019</option>
                                                                      <option value="2020">2020</option>
                                                                      <option value="2021">2021</option>
                                                                      <option value="2022">2022</option>
                                                                      <option value="2023">2023</option>
                                                                      <option value="2024">2024</option>
                                                                      <option value="2025">2025</option>
                                                                      <option value="2026">2026</option>
                                                                     
                                                                    </select>
                                                               </div>
                                                      </div>
                                                      
                                                      
                                                
                                                    
                                    <br><hr>
                                                  
                                                      <button type="button" class="btn btn-danger" id="das" onclick="RegistrarGroupSr();" style="float: right;margin-bottom: 4%;" tabindex="18">GENERAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="generaARX">CERRAR</button>
                                                      
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
        <div class="modal fade bs-example-modal-smResponsable" tabindex="-1" id="myModalIng" role="dialog" >
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
      </div>
    </div>

     

        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>
   