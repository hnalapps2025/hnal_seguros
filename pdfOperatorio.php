 <?php 


error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Esta pagina es solo para usuarios registrados'); window.location='index.php';</script>";  
  exit;
} 

include_once ('config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();


$id = $_GET["id"];
$ni = $pac->consultaXidPacxReporteOperatorio($id);

while($mue = $ni->fetch_assoc()){ 


    $datospac =  $mue["paciente"]; 
    $hclinic =  $mue["historia"]; 
    $tipc='';
			if($mue["tipoDOc"]==1){
			    	$tipc='DNI';
			}else if($mue["tipoDOc"]==2){
			    	$tipc='CARNET EXT';
			}
			else if($mue["tipoDOc"]==3){
			    	$tipc='PASAPORTE';
			}
			else if($mue["tipoDOc"]==4){
			    	$tipc='CODIGO RECIEN NACIDO (CUI)';
			}
			else if($mue["tipoDOc"]==5){
			    	$tipc='DOC. IDENT. EXTRANJERA';
			}
			else if($mue["tipoDOc"]==6){
			    	$tipc='SIN DOC';
			}
    
    
    $tipodoc =  $tipc;
    $DNI =  $mue["nroDoc"]; 
    $ESPEXC =  $mue["ESPEXC"]; 
    $TipoServici =  $mue["TipoServici"]; 
    $edad =  $mue["edad"]; 
    $SERVINT =  $mue["SERVINT"]; 
    $fechAhoraInicio =  $mue["fechAhoraInicio"];
    $fechaHoraFin  =  $mue["fechaHoraFin"];
    $cirujanoPreo =  $mue["cirujanoPreo"];
    $anesteReporte =  $mue["anesteReporte"];
    $instrumentRepo =  $mue["instrumentRepo"];
    $muestraPatologica =  $mue["muestraPatologica"];
    $compliQirurgica =  $mue["compliQirurgica"];
    $descrReporOpe =  $mue["descrReporOpe"];
    $obserReporOpera =  $mue["obserReporOpera"];
  
    
};


?>
<head>
  <title> Impresión de <?php echo $datospac; ?>  </title>
</head>
<script language="javascript">

function printThis() {
  window.print();
  //self.close();
}
</script>
  <body class="nav-md" onLoad="printThis();" style="font-family: sans-serif;">
  <!--<body class="nav-md"  >-->
    <div class="container body">
      <div class="main_container">
    
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" >
      
                  <div class="row">
                              <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12 ">

                                    <div class="x_panel">
                                          <div class="x_title"><p style="font-size: 11px;float: right;"><?php date_default_timezone_set('America/Lima'); echo date('d/m/Y g:ia');?></p>
                                          <center>
                                              <img src="images/cabecera.png" width="550" > 
                                          </center>
                                            <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 15px;">REPORTE OPERATORIO</h2>
                                          
                                            <div class="clearfix"></div>
                                          </div>
                                          <div class="x_content" style="margin-left: 23px;margin-right: 23px;margin-bottom: -21px;">
                                       
                                          <table class="tg">
                                                
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;"></td>
                                                  <td style="font-size: 10px;" ></td>
                                                  <td style="font-size: 10px;" ></td><td style="font-size: 10px;" ></td>
                                                  <td style="font-size: 10px;" ></td><td style="font-size: 10px;" ></td>
                                                  <td style="font-size: 10px;" ></td><td style="font-size: 10px;" ></td>
                                                  <td style="font-size: 10px;" ></td><td style="font-size: 10px;" ></td>
                                                  <td style="font-size: 10px;" ></td><td style="font-size: 10px;" ></td>
                                                  <td style="font-size: 10px;" ></td><td style="font-size: 10px;" ></td>
                                                  <td  ></td>
                                                </tr>
                                               
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">PACIENTE</td>
                                                  <td style="font-size: 10px;text-transform: uppercase;"><?php echo $datospac; ?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;">HISTORIA</td>
                                                  <td style="font-size: 10px;"><?php echo $hclinic; ?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">TIPO DOC</td>
                                                  <td style="font-size: 10px;text-transform: uppercase;" ><?php echo $tipodoc?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;">ESPECIALIDAD</td>
                                                  <td style="font-size: 10px;"><?php echo strtoupper($ESPEXC); ?></td>
                                                </tr>
                                               
                                               
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">NRO DOC</td>
                                                  <td style="font-size: 10px;"><?php echo $DNI ?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;">TIPO SERVICIO</td>
                                                  <td style="font-size: 10px;"><?php echo strtoupper($TipoServici); ?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: left;">EDAD</td>
                                                  <td style="font-size: 10px;"><?php  echo $edad; ?></td>
                                                   <td style="font-size: 10px;font-weight: bolder;text-align: right;">SERVICIO INTERNAMIENTO</td>
                                                  <td style="font-size: 10px;"><?php echo strtoupper($SERVINT); ?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;">FECHA/HORA<br>INICIO</td>
                                                  <td style="font-size: 10px;"><?php echo date('d/m/Y H:i:s',strtotime($fechAhoraInicio)); ?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;">FECHA/HORA FIN</td>
                                                  <td style="font-size: 10px;"><?php echo date('d/m/Y H:i:s',strtotime($fechaHoraFin)); ?></td>
                                                </tr>
                                                 
                                                
                                              </table>
                                                            
                                          </div>
                                       </div>


                        </div>


                        

                    <!-- INICIO -->

<br>
                    <!-- form color picker --><br>
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                                                                      
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="impro"> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" >
                                                    <thead>
                                                        <!-- <tr>
                                                            <td style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 11px;border-bottom: 1pt solid #a29e9e;" 
                                                            colspan="6">Diagnóstico Pre Operatorio</td>
                                                        </tr>-->
                                                        <tr class="headings" style="font-size: 10px;background: #d6d8d8;color: black;">
                                                             
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: left;">Diagnóstico Pre Operatorio</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TIPO DX</th>
                                                                                               
                                                        </tr>
                                                    </thead>
                                                </table>    

                                                <?php 
                                                                                            
                                                $ni = $pac->pdfReportePreoperatorio($id);
                                                
                                                ?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" >
                                                    
                                                    <tbody>
                                                        <?php while($mue = $ni->fetch_assoc()){
                                                        
                                                                if($mue["tipoDx"]!="un"){
                                                                
                                                                 ?>
                                                                            
                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="width: 15%;text-transform: uppercase;text-align: left;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["dx"]; ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align: center;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["tipoDx"]; ?></td>
                                                            </tr>
                                                        <?php } 
                                                        
                                                        }   ?>
                                                    </tbody>
                                                </table>  
                                        </div>                                                   
                                  </div>
                                </div>
                        </div><br>
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                                                                      
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="impro"> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" >
                                                    <thead>
                                                        <!-- <tr>
                                                            <td style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 11px;border-bottom: 1pt solid #a29e9e;" 
                                                            colspan="6">Diagnóstico Post Operatorio</td>
                                                        </tr>-->
                                                        <tr class="headings" style="font-size: 10px;background: #d6d8d8;color: black;">
                                                             
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: left;">INTERVENCION QUIRURGICA</th>
                                                            
                                                                                               
                                                        </tr>
                                                    </thead>
                                                </table>    

                                                <?php 
                                                                                            
                                                $ni = $pac->pdfReporteeIntervencionQx($id);
                                                
                                                ?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" >
                                                    
                                                    <tbody>
                                                        <?php while($mue = $ni->fetch_assoc()){
                                                        
                                                                if($mue["des"]!="undefined"){
                                                                
                                                                 ?>
                                                                            
                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="width: 15%;text-transform: uppercase;text-align: left;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["des"]; ?></td>
                                                            </tr>
                                                        <?php } 
                                                        
                                                        }   ?>
                                                    </tbody>
                                                </table>  
                                        </div>                                                   
                                  </div>
                                </div>
                        </div>
                    
                        <p style="font-size: 10px;font-weight: bolder;margin-left: 25px;">DESCRIPCION: <br>
                        <center><pre style="font-size:8px;color: black;text-transform: uppercase;border: 1px solid #121212;padding-bottom: 12px;padding-right: 11px;width:92%;
                        display: block;margin-top: -7px;text-align: left;padding-top: 4px;padding-left: 4px;font-family: sans-serif;"><?php echo $descrReporOpe;?></pre></center></p>
                    
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                                                                      
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="impro"> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" >
                                                    <thead>
                                                        <!-- <tr>
                                                            <td style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 11px;border-bottom: 1pt solid #a29e9e;" 
                                                            colspan="6">Diagnóstico Post Operatorio</td>
                                                        </tr>-->
                                                        <tr class="headings" style="font-size: 10px;background: #d6d8d8;color: black;">
                                                             
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: left;">Diagnóstico Post Operatorio</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TIPO DX</th>
                                                                                               
                                                        </tr>
                                                    </thead>
                                                </table>    

                                                <?php 
                                                                                            
                                                $ni = $pac->pdfReportePostoperatorio($id);
                                                
                                                ?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" >
                                                    
                                                    <tbody>
                                                        <?php while($mue = $ni->fetch_assoc()){
                                                        
                                                                if($mue["tipoDx"]!="un"){
                                                                
                                                                 ?>
                                                                            
                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="width: 15%;text-transform: uppercase;text-align: left;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["dx"]; ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align: center;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["tipoDx"]; ?></td>
                                                            </tr>
                                                        <?php } 
                                                        
                                                        }   ?>
                                                    </tbody>
                                                </table>  
                                        </div>                                                   
                                  </div>
                                </div>
                        </div>
                        
                    
                        <p style="font-size: 10px;font-weight: bolder;margin-left: 22px;">COMPLICACION QUIRURGICA:<br> 
                      <!--  <span style="font-size:9px;color: #4a4a4a;text-transform: uppercase;border: 1px solid #121212;padding-bottom: 12px;padding-right: 11px;width:95%;
    display: block;margin-top: 3px;"><?php echo $compliQirurgica;?></span>-->
    <center><pre style="font-size:8px;color: black;text-transform: uppercase;border: 1px solid #121212;padding-bottom: 12px;padding-right: 11px;width:92%;
                        display: block;margin-top: -7px;text-align: left;padding-top: 4px;padding-left: 4px;font-family: sans-serif;"><?php echo $compliQirurgica;?></pre></center></p>
                        
                        <p style="font-size: 10px;font-weight: bolder;margin-left: 22px;">MUESTRA PATOLOGICA:<br> 
                        <!--<span style="font-size:9px;color: #4a4a4a;text-transform: uppercase;border: 1px solid #121212;padding-bottom: 12px;padding-right: 11px;width:95%;
    display: block;margin-top: 3px;"><?php echo $muestraPatologica;?></span>-->
    <center><pre style="font-size:8px;color: black;text-transform: uppercase;border: 1px solid #121212;padding-bottom: 12px;padding-right: 11px;width:92%;
                        display: block;margin-top: -7px;text-align: left;padding-top: 4px;padding-left: 4px;font-family: sans-serif;"><?php echo $muestraPatologica;?></pre></center></p>
                        
                        <p style="font-size: 10px;font-weight: bolder;margin-left: 22px;">OBSERVACIONES:<br> 
                      <!--  <span style="font-size:9px;color: #4a4a4a;text-transform: uppercase;border: 1px solid #121212;padding-bottom: 12px;padding-right: 11px;width:95%;
    display: block;margin-top: 3px;"><?php echo $obserReporOpera;?></span>-->
    <center><pre style="font-size:8px;color: black;text-transform: uppercase;border: 1px solid #121212;padding-bottom: 12px;padding-right: 11px;width:92%;
                        display: block;margin-top: -7px;text-align: left;padding-top: 4px;padding-left: 4px;font-family: sans-serif;"><?php echo $obserReporOpera;?></pre></center></p>
                        
                        <p style="font-size: 10px;font-weight: bolder;margin-left: 22px;">CIRUJANO PRINCIPAL: <span style="font-size: 10px;color: #5e5e5e;text-transform: uppercase;font-family: sans-serif;"><?php echo $cirujanoPreo;?></span></p>
                    
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                                                                      
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="impro"> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" >
                                                    <thead>
                                                       <!--  <tr>
                                                            <td style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 11px;border-bottom: 1pt solid #a29e9e;" 
                                                            colspan="6">CIRUJANOS ASISTENTES</td>
                                                        </tr>-->
                                                        <tr class="headings" style="font-size: 10px;background: #d6d8d8;color: black;">
                                                             
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: left;">CIRUJANOS ASISTENTES</th>
                                                              
                                                                                               
                                                        </tr>
                                                    </thead>
                                                </table>    

                                               <?php 
                                                                                            
                                                $ni = $pac->pdfReporteCirujanosAsistentes($id);
                                                
                                                ?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" >
                                                    
                                                    <tbody>
                                                        <?php while($mue = $ni->fetch_assoc()){
                                                        
                                                                if($mue["des"]!="undefined"){
                                                                
                                                                 ?>
                                                                            
                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="width: 15%;text-transform: uppercase;text-align: left;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["des"]; ?></td>
                                                                      
                                                            </tr>
                                                        <?php } 
                                                        
                                                        }   ?>
                                                    </tbody>
                                                </table>  
                                        </div>                                                   
                                  </div>
                                </div>
                        </div>
                        
                        <p style="font-size: 10px;font-weight: bolder;margin-left: 22px;">ANESTESIOLOGO: <span style="font-size: 10px;color: #6d6a6a;text-transform: uppercase;"><?php echo $anesteReporte;?></span></p>
                        
                        <p style="font-size: 10px;font-weight: bolder;margin-left: 22px;">INSTRUMENTISTA: <span style="font-size: 10px;color: #6d6a6a;text-transform: uppercase;"><?php echo $instrumentRepo;?></span></p>
                    
                        <?php  //if($tipoEval==2){   ?>
                       <!-- <p style="font-size: 11px;font-weight: bolder;margin-left: 22px;">AUDITOR: <span style="font-size: 11px;color: #6d6a6a;text-transform: uppercase;"><?php echo "M.C. ".$auditor;?></span></p>
                        <p style="font-size: 11px;font-weight: bolder;margin-left: 22px;">CMP: <span style="font-size: 11px;color: #6d6a6a;text-transform: uppercase;"><?php echo $cmp;?></span></p>
                        <p style="font-size: 11px;font-weight: bolder;margin-left: 22px;">RNA: <span style="font-size: 11px;color: #6d6a6a;text-transform: uppercase;"><?php echo $rna;?></span></p>-->
                        <?php  //} ?>    
                    <!-- FIN -->
                    


                   
                        </div><br>



                           
</?>
                                     
<br><br><br><br><br><br><br><br>
<center>
    <span >______________________</span>
    <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 9px;width: 200px;margin-top: 4px;">
        <?php
        
       // echo $cirujanoPreo;
        $ciru = explode("|", $cirujanoPreo);
        echo "<span>".$ciru[0]."<br>".$ciru[1]."  ".$ciru[2]."<br>".$ciru[3]."<br></span>"; 
        
        
        ?></h2>
</center>
                        

                    <!-- FIN -->




                  </div>
                  
                 
        </div>

        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>
<style>
@page {
  size: A4;
  margin: 3%;
  padding: 0 0 10%;
}
@media print {
  h3 {
    position: absolute;
    page-break-before: always;
    page-break-after: always;
    bottom: 0;
    right: 0;
  }
  h3::before {
    position: relative;
    bottom: -20px;
    counter-increment: section;
    content: counter(section);
  }
  .print {
    display: none;
  }
</style> 