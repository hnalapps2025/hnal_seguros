<?php 


error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Debes iniciar sesión para continuar.'); window.location='index.php';</script>";  
  exit;
} 

include_once ('config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$tic = $_GET["id"];

$sel =new Pacientes();

$tipoEst = $_GET["tipoEst"];
$deFecha = $_GET["deFecha"];
$haFecha = $_GET["haFecha"];


include 'Vistas/librerias.php';  



?>


                    <script type="text/javascript">
                                
                          $(document).ready(function() {
                              
                                    var tipoEst = getParameterByName('tipoEst');
                                    showGraph(tipoEst);
                                       
                          });

                        function showGraph(tipoEst){
                                    {
                                        $.post("./Controlador/search.php?function=rotulosGraphs&tipoEst=" + tipoEst,
                                        function (data)
                                        {
                                        
                                             var name = [];
                                             var marks = [];

                                            var item = $.parseJSON(data);
                                             $.each(item, function (i, valor) {
                                                 
                                                    name.push(valor.rotulo);
                                                    marks.push(valor.ROTA);
                                                    
                                              });
                        
                                            var chartdata = {
                                                labels: name,
                                                datasets: [
                                                    {
                                                        
                                                        label: '.',
                                                        backgroundColor: '#169f85',
                                                        borderColor: '#46d5f1',
                                                        hoverBackgroundColor: '#CCCCCC',
                                                        hoverBorderColor: '#666666',
                                                        data: marks
                                                        
                                                    }
                                                    
                                                ]
                                                
                                            };
                        
                                            Chart.pluginService.register({
                                			beforeRender: function (chart) {
                                				if (chart.config.options.showAllTooltips) {
                                					
                                					chart.pluginTooltips = [];
                                					chart.config.data.datasets.forEach(function (dataset, i) {
                                						chart.getDatasetMeta(i).data.forEach(function (sector, j) {
                                							chart.pluginTooltips.push(new Chart.Tooltip({
                                								_chart: chart.chart,
                                								_chartInstance: chart,
                                								_data: chart.data,
                                								_options: chart.options,
                                								_active: [sector]
                                							}, chart));
                                						});
                                					});
                                
                                					// turn off normal tooltips
                                					chart.options.tooltips.enabled = false;
                                				}
                                			},
                                			afterDraw: function (chart, easing) {
                                				if (chart.config.options.showAllTooltips) {
                                					
                                					if (!chart.allTooltipsOnce) {
                                						if (easing !== 1)
                                							return;
                                						chart.allTooltipsOnce = true;
                                					}
                                
                                					
                                					chart.options.tooltips.enabled = true;
                                					Chart.helpers.each(chart.pluginTooltips, function (tooltip) {
                                						tooltip.initialize();
                                						tooltip.update();
                                						// we don't actually need this since we are not animating tooltips
                                						tooltip.pivot();
                                						tooltip.transition(easing).draw();
                                					});
                                					chart.options.tooltips.enabled = false;
                                				
                                				}
                                			}
                                		})
                                            var graphTarget = $("#graphCanvas");
                        
                                            var barGraph = new Chart(graphTarget, {
                                                type: 'bar',
                                                data: chartdata,
                                                    options: {  
                                                        scales: {
                                                            yAxes: [{
                                                                display: true, 
                                                                stacked: true,
                                                                ticks: {
                                                                        beginAtZero: true,
                                                                        steps: 1,
                                                                        stepValue: 1,
                                                                        max:1600
                                                                }
                                                                
                                                            }]
                                                            
                                                        },
                                                       // showAllTooltips: true
                                                       legend:{
                                                           display:false,
                                                       },
                                                       "animation": {
                                                              "duration": 1,
                                                              "onComplete": function() {
                                                                var chartInstance = this.chart,
                                                                  ctx = chartInstance.ctx;
                                                 
                                                                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                                                                ctx.textAlign = 'center';
                                                                ctx.textBaseline = 'bottom';
                                                                ctx.fillStyle = 'black';
                                                 
                                                                this.data.datasets.forEach(function(dataset, i) {
                                                                  var meta = chartInstance.controller.getDatasetMeta(i);
                                                                  meta.data.forEach(function(bar, index) {
                                                                    var data = dataset.data[index];
                                                                    ctx.fillText(data, bar._model.x, bar._model.y - 5);
                                                                  });
                                                                });
                                                              }
                                                            }
                                                    }
                                            });
                                        });
                                    }
                                }
                    

                    </script>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
      
        <?php include 'Vistas/menu.php';  ?>
        <!-- top navigation -->
        <div class="top_nav">
            <?php //include 'Vistas/usuario.php';  ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            
                    <div class="row tile_count">
                       
                           
                             <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top" style="font-weight: 800;"><i class="fa fa-user"></i> FECHA ACTUAL </span>
                              <div class="count green" style="font-size: 25px;"><?php  echo date("d/m/Y")  ?></div>
                              
                            </div>
                            
                             <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top" style="font-weight: 800;"><i class="fa fa-user"></i> TOTAL </span>
                              <div class="count green"><?php  $nroreg3 = $sel->numeroRegistros($tipoEst,$deFecha,$haFecha); $totalre3 = mysqli_num_rows($nroreg3);
                              echo "<a id='actual' style='color: #1ABB9C;'>".$totalre3."</a>";  ?></div>
                              
                            </div>

                            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top" style="font-weight: 800;"><i class="fa fa-user"></i> TOTAL INMUNOHISTOQUIMICA</span>
                              <div class="count green"><?php  $nroreg31 = $sel->registrosinmunohistoquimica($tipoEst,$deFecha,$haFecha,3); $totalre31 = mysqli_num_rows($nroreg31);
                              echo "<a id='actual' style='color: #1ABB9C;'>".$totalre31."</a>";  ?></div>
                              
                            </div>
                            
                             <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top" style="font-weight: 800;"><i class="fa fa-user"></i>  TOTAL HISTOQUIMICA</span>
                              <div class="count green"><?php  $nroreg32 = $sel->registrosinmunohistoquimica($tipoEst,$deFecha,$haFecha,4); $totalre32 = mysqli_num_rows($nroreg32);
                              echo "<a id='actual' style='color: #1ABB9C;'>".$totalre32."</a>";  ?></div>
                              
                            </div>
                              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top" style="font-weight: 800;"><i class="fa fa-user"></i>  PACIENTE SIS </span>
                              <div class="count green"><?php  $nroreg33 = $sel->registrosFinancia($tipoEst,$deFecha,$haFecha); $totalre33sis = mysqli_num_rows($nroreg33);
                              echo "<a id='actual' style='color: #1ABB9C;'>".$totalre33sis."</a>";  ?></div>
                              
                            </div>
    
                      
                    </div>
                    
                           <table border="0"  >
                                  <tbody>
                                  
                                      <tr>
                                        <form  id="" action="#" method="GET">
                                       <td><label style="margin-left:25px;margin-right: 5px;">Tipo Estudio:</label></td>
                                          <td>
                                              <select class="form-control" style="text-transform: uppercase;" id="tipoEst" name="tipoEst" value="<?php  echo $tipoEst?>">
                                                  <option value="">Todos</option>
                                                  <?php  if($tipoEst==1){  ?>
                                                  <option value="1" selected>PATOLOGIA QUIRURGICA</option>
                                                  <option value="2">CITOLOGIA</option>
                                                  <?php } else if($tipoEst==2){  ?>
                                                   <option value="1">PATOLOGIA QUIRURGICA</option>
                                                  <option value="2" selected>CITOLOGIA</option>
                                                  <?php }else {  ?>
                                                       <option value="1">PATOLOGIA QUIRURGICA</option>
                                                      <option value="2" >CITOLOGIA</option>
                                                  <?php } ?>
                                              </select>
                                          </td>
                                          <td ><label style="margin-left: 14px;">F.recepción:&nbsp;&nbsp;</label></td>
                                          <td ><input name="deFecha" id="deFecha" style="width: 150px;" type="date" class="form-control" placeholder="Desde" autocomplete="off"  value="<?php  echo $deFecha?>"></td>
                                          <td><label>&nbsp;&nbsp;-&nbsp;&nbsp;</label></td>
                                          <td ><input name="haFecha" id="haFecha" type="date" style="width: 150px;" class="form-control" placeholder="Hasta" autocomplete="off" value="<?php  echo $haFecha?>" ></td>                                          
                                            <td style="width: 200px;"><button type="submit" class="btn btn-success" id="sa" style="margin-top: 5px;"><i class="fa fa-search" ></i> Buscar</button>
                                          <a href="./panelControl.php" class="btn btn-default" style="margin-top: 5px;margin-left: -8px;"><i class="fa fa-eraser"></i> Borrar </a>
                                          </td>
                                           </form>
                                      </tr>
                                  </tbody>
                              </table> <br>
                        
                            <!-- MOOO -->
                                
                                <div class="row">
                                          
                                          <div class="col-md-6 col-sm-6 ">
                                            <div class="x_panel">
                                              <div class="x_title">
                                                <h2 style="font-weight: 700;">PROCEDIMIENTOS REALIZADOS</h2>
                                                <div class="clearfix"></div>
                                              </div>
                                              <div class="x_content">
                                                <?php  $proc = $sel->lisProcedimientos($tipoEst,$deFecha,$haFecha); 
                                                       while($nom = $proc->fetch_assoc()){
                                                           
                                                           if($nom['PROC']!=""){
                                                ?>
                                                <div class="widget_summary">
                                                  <div class="w_left w_25">
                                                    <span><?php echo strtoupper($nom['PROC']); ?></span>
                                                  </div>
                                                  <div class="w_center w_55">
                                                    <div class="progress">
                                                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" 
                                                      aria-valuemax="100" style="width:
                                                       <?php 
                                                          
                                                          $cntTar = $sel->countLisProcedimientos($nom['procedimiento'],$tipoEst,$deFecha,$haFecha);
                                                          $totalProc = mysqli_num_rows($cntTar);
                                                          echo  $totalProc."%";
                                                          
                                                          ?>">
                                                        <span class="sr-only">66% Complete</span>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="w_right w_20" style="width: 7%;">
                                                    <span>
                                                      <?php   echo  $totalProc;  ?>
                                                    </span>
                                                  </div><br><br><br>
                                                  <div class="clearfix"></div>
                                                </div>
                                                <?php } 
                                                
                                                } ?>
                                                
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-6 col-sm-6 hidden">
                                            <div class="x_panel">
                                              <div class="x_title">
                                                <h2 style="font-weight: 700;">MUESTRAS RECEPCIONADAS</h2>
                                                <div class="clearfix"></div>
                                              </div>
                                              <div class="x_content">
                                                <?php  $proc = $sel->lisRotulos($tipoEst,$deFecha,$haFecha); 
                                                       while($nom = $proc->fetch_assoc()){
                                                ?>
                                                <div class="widget_summary">
                                                  <div class="w_left w_25">
                                                    <span><?php echo strtoupper($nom['rotulo']); ?></span>
                                                  </div>
                                                  <div class="w_center w_55">
                                                    <div class="progress">
                                                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" 
                                                      aria-valuemax="100" style="width:
                                                       <?php 
                                                                echo  $nom['ROTA']."%";
                                                          ?>">
                                                        <span class="sr-only">66% Complete</span>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <div class="w_right w_20" style="width: 7%;">
                                                    <span>
                                                      <?php   echo  $nom['ROTA'];  ?>
                                                    </span>
                                                  </div><br><br><br>
                                                  <div class="clearfix"></div>
                                                </div>
                                                <?php } ?>
                                                
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md-6 col-sm-6  ">
                                            <div class="x_panel">
                                              <div class="x_title">
                                                <h2 style="font-weight: 700;">MUESTRAS RECEPCIONADAS</h2>
                                                <div class="clearfix"></div>
                                              </div>
                                              <div class="x_content">
                                                    <canvas id="graphCanvas"></canvas>
                                              </div>
                                            </div>
                                          </div>
                                          
                        
                                        </div>
                            
                            
                            <!-- FIN -->
                
            
                  
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
                                        <ul id="myTab" class="nav nav-tabs bar_tabs hidden" role="tablist">
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
                                                                    <input type="text" class="form-control" name="Nxuenta" id="Nxuenta" maxlength="11" required="required" tabindex="1" >
                                                                    <span class="input-group-btn">
                                                                        <button type="button" class="btn btn-primary" id="cargaCuenta"><i class="fa fa-search"></i></button>
                                                                    </span>
                                                                </div>
                                                              </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">H. CLINICA <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input type="text" class="form-control" name="hclinica" id="hclinica" maxlength="11" required="required" tabindex="2"  >
                                                            </div>
                                                          </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12" style="width: 93px;">TIPO DOC<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12" style="width:120px;">
                                                              <select class="form-control" name="tiDocA" id="tiDocA" required="required" tabindex="3">                   
                                                                    <option value="DNI">DNI</option>
                                                                    <option value="Carnet Ext.">Carnet Ext.</option>
                                                                    <option value="Pasaporte">Pasaporte</option>
                                                                    <option value="Codigo recien nacido (CUI)">Codigo recien nacido (CUI)</option>
                                                                    <option value="Doc. Ident. Extranjera">Doc. Ident. Extranjera</option>
                                                                    <option value="Sin Doc.">Sin Doc.</option>
                                                              </select>
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">N° FUA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-3 col-sm-12 col-xs-12">
                                                                <div class="input-group" style="margin-bottom:0px;">
                                                                    <input type="text" class="form-control" name="fua" id="fua" value="16918-22-" maxlength="35" required="required" tabindex="4"  >
                                                                 
                                                                </div>
                                                              </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">N°DOC <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input type="text" class="form-control" name="dni" id="dni" maxlength="11" required="required" tabindex="5"  >
                                                            </div>
                                                          </div>
                                                      </div>
                                                     
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">PACIENTE  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="paciente" id="paciente" tabindex="6" style="text-transform: uppercase;font-size: 11px;" >
                                                        </div>
                                                        <label class="control-label col-md-1 col-sm-3 col-xs-12">PABELLON<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-5 col-sm-12 col-xs-12">
                                                             <select class="form-control" name="servicio" id="servicio" required="required" tabindex="5" style="text-transform: uppercase;"> 
                                                                    </select>
                                                         <!-- <input type="text" class="form-control" required="required"  name="servicio" id="servicio" tabindex="7"  style="text-transform: uppercase;" >-->
                                                        </div>
                                                       
                                                      </div>
                                                     
                                                      <div class="form-group">
                                                       
                                                      </div>
                                                       <script>
                                                             $(document).ready(function(){
                                                                    
                                                                    	$( "#ubiSerHosp" ).change(function() {
                                                                    	    var idDis = $("#ubiSerHosp").val();	
                                                                    		cargarCodpreHospi(idDis);
                                                                    	});
                                                                        
                                                            });
                                                        </script>
                                                      <div class="form-group">
                                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">COD_PRES</label>
                                                                <div class="col-md-1 col-sm-12 col-xs-12">
                                                                    <input type="text" class="form-control" required="required" name="codPreHos" id="codPreHos"  style="width: 55px;"  >
                                                                </div>
                                                                 <label class="control-label col-md-2 col-sm-3 col-xs-12">DENOMINACION</label>
                                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                                    <select class="form-control" name="ubiSerHosp" id="ubiSerHosp" required="required" tabindex="5" style="text-transform: uppercase;"> 
                                                                    </select>
                                                                     
                                                                </div>
                                                                
                                                        </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">F. INGRESO<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <input type="date" class="form-control" required="required"  name="feingreso" id="feingreso" tabindex="8" >
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">F. CORTE/ALTA  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="date" class="form-control" required="required" name="fecorte" id="fecorte"  tabindex="9"  >
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">VALORIZADO MEDIC-INSU<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="montgal" id="montgal" tabindex="10" >
                                                        </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">VALORIZADO PROC-LAB<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12">
                                                            <input type="text" class="form-control" required="required" name="montsifar" id="montsifar"  tabindex="11"  >
                                                          </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12" id="telefam">VALORIZADO ATENCION</label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12" id="inputel">
                                                            <input type="text" class="form-control" required="required" name="valAteAudi" id="valAteAudi" readonly="">
                                                          </div>
                                                      </div>
                                                     
                                                      <div class="form-group">
                                                      <label class="control-label col-md-2 col-sm-3 col-xs-12">OBSERVACIONES DE AUDITORIA</label>
                                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                                          <textarea class="form-control" name="obsCpms" id="obsCpms" rows="6" style="text-transform: uppercase;" tabindex="12"></textarea>
                                                        </div>
                                                      
                                                    </div>
                                                      <!--<div class="form-group">
                                                        <label for="title" class="col-sm-2 control-label">AUDITOR</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control" name="asiAudi" id="asiAudi" style="text-transform: uppercase;" required="required" tabindex="8">
                                                            </select>
                                                        </div>
                                                      </div>-->
                                                     
                                    <br><br>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="RegistrarPac();" style="float: right;margin-bottom: 4%;" tabindex="13">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarpre">CERRAR</button>
                                                      
                                           </form>

                                          </div>
                                         
                 

               

               


        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>
   