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
$ni = $pac->consultaXidPacx($id);

while($mue = $ni->fetch_assoc()){ 

  /*idPac`, `nroFua`, `nroCuenta`, `paciente`, `servicio`, `F_Ingreso`, `F_Alta_Medica`, 
  `Historia`, `DNI`, `fe_reg` */


    $datospac =  $mue["paciente"]; 
    $hclinic =  $mue["Historia"]; 
    $nroFua =  $mue["nroFua"]; 
    $NroCuenta =  $mue["nroCuenta"]; 
     
    $DNI =  $mue["DNI"]; 
    $seguro =  $mue["seguro"]; 
    $fechaIngreso =  $mue["F_Ingreso"]; 
    $fechaCorte =  $mue["F_Alta_Medica"]; 
    $observacion =  $mue["observacion"]; 
    
    $codPre =  $mue["codPre"];
    $montogal =  $mue["montogal"]; 
    $montosisfar =  $mue["montosisfar"]; 
    $auditor =  $mue["AUDITOR"];
    $tipoEval =  $mue["tipoEval"]; 
    $cmp =  $mue["cmp"]; 
    $rna =  $mue["rna"];
    
    
    $cie10_1 =  $mue["cie10_1"];
    $dx2 =  $mue["dx2"];
    $dx3 =  $mue["dx3"];
    $dx4 =  $mue["dx4"];
    $dx5 =  $mue["dx5"];
    $dx6 =  $mue["dx6"];
    $dx7 =  $mue["dx7"];
    $dx8 =  $mue["dx8"];
    $dx9 =  $mue["dx9"];
    $dx10 =  $mue["dx10"];
    
    $servicio =  '';
    $denominacion =  '';
    
    
    if($tipoEval=="1"){
        $servicio =  $mue["servicio"];
        $denominacion =  $mue["den"]; 
    } else if($tipoEval=="2"){
        $servicio =  $mue["serEmCe"];
        $denominacion =  $mue["den"]; 
    }else if($tipoEval=="3") {
        
        $servicio =  $mue["servicio"];
        $denominacion =  $mue["den2"]; 
    }
    

    //$servicio =  $mue["servicio"];
    
    
};


?>
<head>
  <title> Impresión de N° de Cuenta <?php echo $NroCuenta." del paciente ".$datospac; ?>  </title>
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
                                            <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 15px;"></h2>
                                          
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
                                               
                                               
                                                  <td style="font-size: 10px;font-weight: bolder;">N° DE CUENTA</td>
                                                  <td style="font-size: 10px;" ><?php echo $NroCuenta?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;">NRO FUA</td>
                                                  <td style="font-size: 10px;"><?php echo $nroFua?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">PACIENTE</td>
                                                  <td style="font-size: 10px;text-transform: uppercase;"><?php echo $datospac; ?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;"></td>
                                                  <td style="font-size: 10px;"></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">SERVICIO</td>
                                                  <td style="font-size: 10px;text-transform: uppercase;" colspan="3"><?php echo $servicio?></td>
                                                </tr>
                                               
                                               
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">FECHA DE INGRESO</td>
                                                  <td style="font-size: 10px;"><?php echo date('d/m/Y',strtotime($fechaIngreso)); ?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;">HISTORIA CLINICA</td>
                                                  <td style="font-size: 10px;"><?php echo $hclinic; ?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">FECHA DE ALTA/CORTE</td>
                                                  <td style="font-size: 10px;" colspan="3"><?php  echo date('d/m/Y',strtotime($fechaCorte));
                                                  ?></td>
                                                </tr>
                                                 <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">CODIGO PRESTACIONAL -<br>DENOMINACION</td>
                                                  <td style="font-size: 10px;" colspan="3"><?php  echo $codPre." - ".strtoupper($denominacion); ?></td>
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
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">DIAGNOSTICOS</td>
                                                  <td style="font-size: 10px;" colspan="3"></td>
                                                </tr>
                                                <?php if($cie10_1!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">1) <?php  echo strtoupper($cie10_1); ?></td></tr>
                                                 <?php } if($dx2!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">2) <?php  echo strtoupper($dx2); ?></td></tr>
                                                <?php } if($dx3!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">3) <?php  echo strtoupper($dx3); ?></td></tr>
                                                <?php } if($dx4!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">4) <?php  echo strtoupper($dx4); ?></td></tr>
                                                <?php } if($dx5!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">5) <?php  echo strtoupper($dx5); ?></td></tr>
                                                 <?php } if($dx6!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">6) <?php  echo strtoupper($dx6); ?></td></tr>
                                                 <?php } if($dx7!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">7) <?php  echo strtoupper($dx7); ?></td></tr>
                                                 <?php } if($dx8!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">8) <?php  echo strtoupper($dx8); ?></td></tr>
                                                 <?php } if($dx9!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">9) <?php  echo strtoupper($dx9); ?></td></tr>
                                                 <?php } if($dx10!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">10) <?php  echo strtoupper($dx10); ?></td></tr>
                                                <?php } ?>
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
                                                
                                              </table>
                                                            
                                          </div>
                                       </div>


                        </div>


                        

                    <!-- INICIO -->


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
                                                         <tr>
                                                            <td style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 14px;border-bottom: 1pt solid #a29e9e;" colspan="6">Reporte de Procedimientos CPT por Cuenta</td>
                                                        </tr>
                                                        <tr class="headings" style="font-size: 10px;background: #d6d8d8;color: black;">
                                                              
                                                            
                                                        <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">PROCEDIMIENTO</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANT</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: right;">PRECIO</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: right;">TOTAL</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">DX</th>                                     
                                                        </tr>
                                                    </thead>
                                                </table>    

                                                <?php 
                                                                                            
                                                $ni = $pac->consultaXidProcedimientos($id);
                                                
                                                ?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" >
                                                    <thead >
                                                        <tr class="headings" style="font-size:0px;background: white;color: white;">
                                                              
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">PROCEDIMIENTO</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANT</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: right;">PRECIO</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: right;">TOTAL</th>  
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: right;">DX</th>                                                                             
                                                      </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php while($mue = $ni->fetch_assoc()){ ?>

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: center;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["codigo_cpt"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["descripcion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:center;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["cantidad"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["valorizacion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["total"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:center;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["dx"]; ?></td>
                                                                      
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>  
                                                <table style="float: right;border: 1px solid black;">
                                                <tr>
                                                
                                                  <td style="font-weight: bolder">TOTAL:</td>
                                                  <td class="tg-0lax" id="subproc">
                                                        
                                                      <?php 
                                                          $ni = $pac->sumXidProcedure($id);
                                                          $mue = $ni->fetch_assoc();
                                                          $totpse = $mue["totalproc"]; 
                                                          echo " S/.".number_format($totpse, 2, ".", ",");
                                                       ?>
                                                  </td>
                                                  <td style="color: white;">----</td>
                                                </tr>
                                              </table>                        


                                        </div>                                                   
                                  </div>
                                </div>
                        </div><br><br>
                         <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                            <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);">
                            
                            <tbody>
                              <tr>
                                <td style="text-align: center;color: black;font-size: 10px;font-weight: 700;border-bottom: 1pt solid #a29e9e;border-right: 1pt solid #a29e9e;">MEDICAMENTOS</td>
                                <td style="text-align: right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $montogal ?></td>
                              </tr>
                              <tr>
                                <td style="text-align: left;color: black;font-size: 10px;font-weight: 700;border-bottom: 1pt solid #a29e9e;border-right: 1pt solid #a29e9e;">LAB/PRO</td>
                                <td style="text-align: right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $montosisfar ?></td>
                              </tr>
                              <tr>
                                <td style="text-align: left;color: black;font-size: 10px;font-weight: 700;border-bottom: 1pt solid #a29e9e;border-right: 1pt solid #a29e9e;">CPMS-AUD</td>
                                <td style="text-align: right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $totpse?></td>
                              </tr>
                              <tr>
                                <td style="text-align: left;color: black;font-size: 10px;font-weight: 700;border-right: 1pt solid #a29e9e;">VALORIZADO</td>
                                <td style="text-align: right;color: black;font-size: 10px;font-weight: 200;"><?php echo $montogal + $montosisfar +  $totpse?></td>
                              </tr>
                            </tbody>
                            </table>
                        </div>
      
                        <p style="font-size: 11px;font-weight: bolder;margin-left: 22px;">OBSERVACIÒN: <span style="font-size: 10px;color: #6d6a6a;text-transform: uppercase;"><?php echo $observacion;?></span></p>
                        <br><br><br>
                        <?php  //if($tipoEval==2){   ?>
                        <p style="font-size: 11px;font-weight: bolder;margin-left: 22px;">AUDITOR: <span style="font-size: 11px;color: #6d6a6a;text-transform: uppercase;"><?php echo "M.C. ".$auditor;?></span></p>
                        <p style="font-size: 11px;font-weight: bolder;margin-left: 22px;">CMP: <span style="font-size: 11px;color: #6d6a6a;text-transform: uppercase;"><?php echo $cmp;?></span></p>
                        <p style="font-size: 11px;font-weight: bolder;margin-left: 22px;">RNA: <span style="font-size: 11px;color: #6d6a6a;text-transform: uppercase;"><?php echo $rna;?></span></p>
                        <?php  //} ?>    
                    <!-- FIN -->
                    


                   
                        </div><br>

                          <!--<table>
                                                <tr>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="font-weight: bolder">TOTAL:</td>
                                                  <td class="tg-0lax" id="submed">
                                                        
                                                  <?php 
// 
                                                      $otalee= $totmed + $totim + $totpse;
                                                      echo "S/".$otalee;

                                                      ?>
                                                  </td>
                                                </tr>
                        </table> -->



                           
</?>
                                     

                        

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