 <?php 


//error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Esta pagina es solo para usuarios registrados'); window.location='index.php';</script>";  
  exit;
} 

include_once ($_SERVER['DOCUMENT_ROOT'].'/hnal/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();

$user = $_GET["user"];
$desde = $_GET["desde"];
$hasta = $_GET["hasta"];
$id = $_GET["id"];
$ni = $pac->consultaXidPacxMasivo($user,$desde,$hasta,$id);

while($mue = $ni->fetch_assoc()){ 


?>
<head>
  <title> Impresión de N° de Cuenta <?php echo $mue["nroCuenta"]." del paciente ".$mue["paciente"]; ?>  </title>
</head>
<style>
    
    .page_break {
         page-break-before: always;
}
</style>
<script language="javascript">

function printThis() {
  window.print();
  //self.close();
}
</script>
  <body class="nav-md " onLoad="printThis();" style="font-family: sans-serif;">
  <!--<body class="nav-md"  >-->
    <div class="container body page_break">
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
                                                  <td style="font-size: 10px;" ><?php echo $mue["nroCuenta"] ?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;">NRO FUA</td>
                                                  <td style="font-size: 10px;"><?php echo $mue["nroFua"] ?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">PACIENTE</td>
                                                  <td style="font-size: 10px;text-transform: uppercase;"><?php echo $mue["paciente"]; ?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;"></td>
                                                  <td style="font-size: 10px;"></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">SERVICIO</td>
                                                  <td style="font-size: 10px;text-transform: uppercase;" colspan="3"><?php 
                                                   $servicio =  '';
                                                $denominacion =  '';
                                                    
                                                   
                                                  
                                                        if($mue["tipoEval"]=="1"){
                                                            $servicio =  $mue["servicio"];
                                                            $denominacion =  $mue["den"]; 
                                                        } else if($mue["tipoEval"]=="2"){
                                                            $servicio =  $mue["serEmCe"];
                                                            $denominacion =  $mue["den"]; 
                                                        }else if($mue["tipoEval"]=="3") {
                                                            
                                                            $servicio =  $mue["servicio"];
                                                            $denominacion =  $mue["den2"]; 
                                                        }
                                                  
                                                        echo $servicio;
                                                  
                                                  ?></td>
                                                </tr>
                                               
                                               
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">FECHA DE INGRESO</td>
                                                  <td style="font-size: 10px;"><?php echo date('d/m/Y',strtotime($mue["F_Ingreso"] )); ?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;">HISTORIA CLINICA</td>
                                                  <td style="font-size: 10px;"><?php echo $mue["Historia"]; ?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">FECHA DE ALTA/CORTE</td>
                                                  <td style="font-size: 10px;" colspan="3"><?php  echo date('d/m/Y',strtotime($mue["F_Alta_Medica"] ));
                                                  ?></td>
                                                </tr>
                                                 <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">CODIGO PRESTACIONAL -<br>DENOMINACION</td>
                                                  <td style="font-size: 10px;" colspan="3"><?php  echo $mue["codPre"]." - ".strtoupper($denominacion); ?></td>
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
                                                <?php if($mue["cie10_1"]!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">1) <?php  echo strtoupper($mue["cie10_1"]); ?></td></tr>
                                                 <?php } if($mue["dx2"]!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">2) <?php  echo strtoupper($mue["dx2"]); ?></td></tr>
                                                <?php } if($mue["dx3"]!=''){ ?>
                                                <tr><td style="font-size: 9px;font-weight: 200;" colspan="4">3) <?php  echo strtoupper($mue["dx3"]); ?></td></tr>
                                                <?php } if($mue["dx4"]!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">4) <?php  echo strtoupper($mue["dx4"]); ?></td></tr>
                                                <?php } if($mue["dx5"]!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">5) <?php  echo strtoupper($mue["dx5"]); ?></td></tr>
                                                <?php } if($mue["dx6"]!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">6) <?php  echo strtoupper($mue["dx6"]); ?></td></tr>
                                                <?php } if($mue["dx7"]!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">7) <?php  echo strtoupper($mue["dx7"]); ?></td></tr>
                                                <?php } if($mue["dx8"]!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">8) <?php  echo strtoupper($mue["dx8"]); ?></td></tr>
                                                <?php } if($mue["dx9"]!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">9) <?php  echo strtoupper($mue["dx9"]); ?></td></tr>
                                                <?php } if($mue["dx10"]!=''){ ?>
                                                <tr><td style="font-size: 8px;font-weight: 200;" colspan="4">10) <?php  echo strtoupper($mue["dx10"]); ?></td></tr>
                                                <?php } ?>
                                                <tr>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                </td>
                                                <tr>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                </td>
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
                                            

$ni2 = $pac->consultaXidProcedimientos($mue["idPac"]);

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
                                                        <?php  
                                                              
                                                              while($mue2 = $ni2->fetch_assoc()){                                                 
                                                                ?>

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: center;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue2["codigo_cpt"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;font-size:8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue2["descripcion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:center;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue2["cantidad"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue2["valorizacion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue2["total"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:center;color: black;font-size: 8px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue2["dx"]; ?></td>
                                                                      
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>  
                                                <table style="float: right;border: 1px solid black;">
                                                <tr>
                                                
                                                  <td style="font-weight: bolder">TOTAL:</td>
                                                  <td class="tg-0lax" id="subproc">
                                                        
                                                      <?php 
                                                          $ni3 = $pac->sumXidProcedure($mue["idPac"]);
                                                          $mue3 = $ni3->fetch_assoc();
                                                          $totpse = $mue3["totalproc"]; 
                                                          echo " S/.".number_format($totpse, 2, ".", ",");
                                                       ?>
                                                  </td>
                                                  <td style="color: white;">----</td>
                                                </tr>
                                              </table>                        


                                        </div>                                                   
                                  </div>
                                </div>
                        </div>
                        
                   <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                            <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);">
                            
                            <tbody>
                              <tr>
                                <td style="text-align: center;color: black;font-size: 10px;font-weight: 700;border-bottom: 1pt solid #a29e9e;border-right: 1pt solid #a29e9e;">MEDICAMENTOS</td>
                                <td style="text-align: right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["montogal"] ?></td>
                              </tr>
                              <tr>
                                <td style="text-align: left;color: black;font-size: 10px;font-weight: 700;border-bottom: 1pt solid #a29e9e;border-right: 1pt solid #a29e9e;">LAB/PRO</td>
                                <td style="text-align: right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["montosisfar"] ?></td>
                              </tr>
                              <tr>
                                <td style="text-align: left;color: black;font-size: 10px;font-weight: 700;border-bottom: 1pt solid #a29e9e;border-right: 1pt solid #a29e9e;">CPMS-AUD</td>
                                <td style="text-align: right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $totpse?></td>
                              </tr>
                              <tr>
                                <td style="text-align: left;color: black;font-size: 10px;font-weight: 700;border-right: 1pt solid #a29e9e;">VALORIZADO</td>
                                <td style="text-align: right;color: black;font-size: 10px;font-weight: 200;"><?php echo $mue["montogal"] + $mue["montosisfar"] +  $totpse?></td>
                              </tr>
                            </tbody>
                            </table>
                        </div>
      
                        <p style="font-size: 11px;font-weight: bolder;margin-left: 22px;">OBSERVACIÒN: <span style="font-size: 12px;color: #6d6a6a;text-transform: uppercase;"><?php echo $mue["observacion"]; ?></span></p>
                        <br>
                        <?php  //if($tipoEval==2){   ?>
                        <p style="font-size: 11px;font-weight: bolder;margin-left: 22px;">AUDITOR: <span style="font-size: 11px;color: #6d6a6a;text-transform: uppercase;"><?php echo "M.C. ".$mue["AUDITOR"];?></span></p>
                        <p style="font-size: 11px;font-weight: bolder;margin-left: 22px;">CMP: <span style="font-size: 11px;color: #6d6a6a;text-transform: uppercase;"><?php echo $mue["cmp"];?></span></p>
                        <p style="font-size: 11px;font-weight: bolder;margin-left: 22px;">RNA: <span style="font-size: 11px;color: #6d6a6a;text-transform: uppercase;"><?php echo $mue["rna"];?></span></p>
                        <?php  //} ?>      
                        </div><br>



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

<?php }; ?>