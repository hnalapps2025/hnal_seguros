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
$ni = $pac->consultaXinmunohisto($id);

$mue = $ni->fetch_assoc();


?>
<head>
  <title> Vista previa  </title>
</head>
<script language="javascript">

function printThis() {
  window.print();
  //self.close();
}
</script>
  <body class="nav-md" style="font-family: sans-serif;">
  <!--<body class="nav-md"  >-->
    <div class="container body">
      <div class="main_container">
    
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" style="width: 40%;border: 1px solid black;padding: 12px;margin-left: 30%;box-shadow: 4px 8px 13px 5px #8b8282;" >
      
                  <div class="row">
                              <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12 ">

                                    <div class="x_panel">
                                          <div class="x_title"><p style="font-size: 11px;float: right;"><?php date_default_timezone_set('America/Lima'); echo date('d/m/Y g:ia');?></p>
                                          <center>
                                              <img src="images/cabecera.png" width="550" > 
                                          </center><br>
                                            <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 15px;">INFORME CITOLOGIA ESPECIAL</h2>
                                            <span style="float: right;margin-top: -25px;margin-right: 25px;font-size: 15px;"><strong>N° ORDEN:</strong><?php echo $mue["anio"]."-".$mue["corPat"] ?></span>
                                         
                                            <div class="clearfix"></div>
                                          </div>
                                          <div class="x_content" style="margin-left: 23px;margin-right: 23px;margin-bottom: -21px;">
                                       
                                          <table class="tg" style="width: 100%;">
                                                
                                                <tr>
                                                  <td style="font-size: 11px;font-weight: bolder;"></td>
                                                  <td style="font-size: 11px;" ></td>
                                                  <td style="font-size: 11px;" ></td><td style="font-size: 11px;" ></td>
                                                  <td style="font-size: 11px;" ></td><td style="font-size: 11px;" ></td>
                                                  <td style="font-size: 11px;" ></td><td style="font-size: 11px;" ></td>
                                                  <td style="font-size: 11px;" ></td><td style="font-size: 11px;" ></td>
                                                  <td style="font-size: 11px;" ></td><td style="font-size: 11px;" ></td>
                                                  <td style="font-size: 11px;" ></td><td style="font-size: 11px;" ></td>
                                                  <td  ></td>
                                                </tr>
                                               
                                          
                                                <tr>
                                                  <td style="font-size: 11px;font-weight: bolder;">NOMBRES</td>
                                                  <td style="font-size: 11px;text-transform: uppercase;"><?php echo $mue["paciente"]; ?></td>
                                                  <td style="font-size: 11px;font-weight: bolder;text-align: right;">PROCEDENCIA</td>
                                                  <td style="font-size: 11px;"><?php echo $mue["especialidad"] ?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 11px;font-weight: bolder;">ORDEN N°</td>
                                                  <td style="font-size: 11px;text-transform: uppercase;"><?php echo $mue["anio"]."-".$mue["corPat"] ?></td>
                                                  <td style="font-size: 11px;font-weight: bolder;text-align: right;">MED. SOLICITA</td>
                                                  <td style="font-size: 11px;"><?php echo $mue["medicoSolicitante"] ?></td>
                                                </tr>
                                               
                                               
                                                <tr>
                                                  <td style="font-size: 11px;font-weight: bolder;">H. CLINICA</td>
                                                  <td style="font-size: 11px;"><?php echo $mue["historia"]; ?></td>
                                                  <td style="font-size: 11px;font-weight: bolder;text-align: right;">SEXO</td>
                                                  <td style="font-size: 11px;"><?php echo $mue["sexo"]; ?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 11px;font-weight: bolder;">FECHA DE ENVIO</td>
                                                  <td style="font-size: 11px;"><?php  echo date('d/m/Y',strtotime($mue["fechaRecepcion"])); ?></td>
                                                  <td style="font-size: 11px;font-weight: bolder;text-align: right;">EDAD</td>
                                                  <td style="font-size: 11px;"><?php echo $mue["edad"]; ?></td>
                                                </tr>
                                                 
                                                
                                                <tr>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                </tr>
                                               
                                                <tr>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                </tr>
                                                 <tr>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                </tr>
                                                
                                              </table>
                                                            
                                          </div>
                                       </div>


                        </div>


                        

                    <!-- INICIO -->

<br>
                    <!-- form color picker -->
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                                                                      
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="impro"> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="width: 100%;" >
                                                    <thead>
                                                         <tr>
                                                            <td style="text-align: left;float: none;text-transform: uppercase;font-weight: bolder;font-size: 15px;" colspan="6">MUESTRA RECIBIDA</td>
                                                        </tr>
                                                       
                                                    </thead>
                                                </table>    

                                                <?php 
                                                $formate = $mue["anio"]."-".$mue["corPat"];                                 
                                                $ni2 = $pac->consultaXMuestraHisto($formate,$mue["tipoEstudio"]);
                                                
                                                ?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);width: 100%;" >
                                                    
                                                    <tbody>
                                                        <?php while($mue2 = $ni2->fetch_assoc()){ ?>

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;font-size: 11px;font-weight: 200;border-bottom: 1pt solid #a29e9e;">
                                                                          - <?php   echo $mue2["rotulo"]; ?></td>
                                                                      
                                                                      
                                                            </tr>
                                                        <?php }   ?>
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
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id=""> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="width: 100%;" >
                                                    <thead>
                                                         <tr>
                                                            <td style="text-align: left;float: none;text-transform: uppercase;font-weight: bolder;font-size: 15px;" colspan="6">EXAMEN MACROSCOPICO</td>
                                                        </tr>
                                                       
                                                    </thead>
                                                </table>    

                                                <?php 
                                                                                            
                                                $ni3 = $pac->consultaXRotulosPdf($formate,$mue["tipoEstudio"]);
                                                
                                                ?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);width: 100%;" >
                                                    <thead >
                                                        <tr class="headings" style="font-size:11px;">
                                                              
                            
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;"></th>
                                                                                                                                        
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while($mue3 = $ni3->fetch_assoc()){ ?>

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;
                                                                      font-size: 11px;font-weight: 900;border-bottom: 1pt solid #a29e9e;">ROTULADO: <?php echo $mue3["rotulo"]; ?></td>

                                                            </tr>
                                                             <tr class="even pointer">
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;
                                                                      font-size: 11px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo "<pre style='font-family: sans-serif;white-space: pre-wrap;       /* Since CSS 2.1 */
   white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
   white-space: -pre-wrap;      /* Opera 4-6 */
   white-space: -o-pre-wrap;    /* Opera 7 */
   word-wrap: break-word;  '>".$mue3["descripcion"]."</pre>"; ?></td>

                                                            </tr>
                                                        <?php }   ?>
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
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id=""> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="width: 100%;" >
                                                    <thead>
                                                         <tr>
                                                            <td style="text-align: left;float: none;text-transform: uppercase;font-weight: bolder;font-size: 15px;" colspan="6">DIAGNOSTICO MICROSCOPICO</td>
                                                        </tr>
                                                       
                                                    </thead>
                                                </table>    

                                               <?php 
                                                                                            
                                                $ni4 = $pac->consultaXRotulosPdf($formate,$mue["tipoEstudio"]);
                                                
                                                ?> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);width: 100%;" >
                                                    <thead >
                                                        <tr class="headings" style="font-size:10px;">
                                                              
                            
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;"></th>
                                                                                                                                        
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while($mue4 = $ni4->fetch_assoc()){ ?>

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;
                                                                      font-size: 11px;font-weight: 900;border-bottom: 1pt solid #a29e9e;">ROTULADO: <?php echo $mue4["rotulo"]; ?></td>

                                                            </tr>
                                                            <tr class="even pointer">
                                                  
                                                                    <td class=" " style="text-transform: uppercase;text-align: left;color: black;
                                                                    font-size: 11px;font-weight: 900;border-bottom: 1pt solid #a29e9e;">
                                                                    SISTEMA REPORTE: <?php echo $mue4["RE"]."| TEJIDO/ORGANO: ".$mue4["TE"]."| CLASIFICACION: ".$mue4["CLA"] ?>
                                                                    
                                                                  </td>

                                                          </tr>
                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;
                                                                      font-size: 11px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo "<pre style='font-family: sans-serif;white-space: pre-wrap;       /* Since CSS 2.1 */
   white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
   white-space: -pre-wrap;      /* Opera 4-6 */
   white-space: -o-pre-wrap;    /* Opera 7 */
   word-wrap: break-word;  '>".$mue4["descMicro"]."</pre>"; ?></td>

                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>  
                                                

                                        </div>                                                   
                                  </div>
                                </div>
                        </div><br>
                   
                                    
                         <div class="x_panel">
                                         
                                          <div class="x_content" style="margin-left: 23px;margin-right: 23px;">
                                       
                                          <table class="tg">
                                                
                                               
                                                <tr>
                                                  <td style="font-size: 11px;font-weight: bolder;">REPORTADO POR:</td>
                                                  <td style="font-size: 11px;text-transform: uppercase;"><?php echo $mue["USRESPEC"]; ?></td>
                                                  <td style="font-size: 11px;font-weight: bolder;text-align: right;"></td>
                                                  <td style="font-size: 11px;"></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 11px;font-weight: bolder;">FECHA DE REPORTE</td>
                                                  <td style="font-size: 11px;text-transform: uppercase;"><?php 
                                                    if($mue["fechaHoraCerEspe"]!=""){
                                                        echo date('d/m/Y H:i:s',strtotime($mue["fechaHoraCerEspe"]));     
                                                    }
                                                    
                                                    
                                                    ?></td>
                                                  <td style="font-size: 11px;font-weight: bolder;text-align: right;"></td>
                                                  <td style="font-size: 11px;"></td>
                                                </tr>
                                               
                                               
                                               
                                                
                                              </table>
                                                            
                                          </div>
                         </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                        

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