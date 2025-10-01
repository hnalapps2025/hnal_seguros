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

$ReporteDesde = $_GET['desde'] ?? null;
$ReporteHasta = $_GET['hasta'] ?? null;
$fecha_hoy = date('Y-m-d');

?>
<head>
  <title> Impresión  </title>
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
                                          <center>
                                              <img src="images/cabecera.png" width="550" > 
                                          </center><br>
                                          
                                           
                                         
                                            <div class="clearfix"></div>
                                          </div>
                                          <div class="x_content" style="margin-left: 23px;margin-right: 23px;margin-bottom: -21px;">
                                       
                                          
                                                            
                                          </div>
                                       </div>


                        </div>


                        

                
                    <!-- form color picker --><br>
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                                                                      
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="impro"> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="width: 100%;" >
                                                    <thead>
                                                       
                                                       
                                                    </thead>
                                                </table>    

                                                <?php 
                                                $formate = $mue["anio"]."-".$mue["corPat"];                                 
                                                $ni2 = $pac->consultaXMuestraHisto($formate,$mue["tipoEstudio"]);
                                                
                                                ?>  


                                              <table class="table jambo_table bulk_action" border="1" id="pac" style="border-collapse: collapse;width: 100%;" >
                                                    
                                                    <tbody>
                                                        <?php while($mue2 = $ni2->fetch_assoc()){ ?>

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;font-size: 11px;font-weight: 200;">- <?php   echo $mue2["rotulo"]; ?></td>
                                                                      
                                                                      
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
                                                            <td style="text-align: left;float: none;text-transform: uppercase;font-weight: bolder;font-size: 15px;" colspan="6">RESULTADO DE REPORTE</td>
                                                        </tr>
                                                       
                                                    </thead>
                                                </table>    

                                                <?php 
                                                
                                                $fecha_hoy = date('Y-m-d');
                                                                                            
                                                $ni3 = $pac->consultaReportePunciones(2,$ReporteDesde,$ReporteHasta);

                                                
                                                ?>  


                                              <table class="table jambo_table bulk_action"  border="1" id="pac" style="width: 100%;border-collapse: collapse;" >
                                                    <thead >
                                                    <tr>
                                                      <th colspan="8"></th> 
                                                      <th colspan="1" style="text-align: center; font-size: 12px; font-weight: bold; background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 5px;">
                                                        AÑO
                                                      </th>
                                                      <th colspan="1"><?php  echo date('Y'); ?></th>
                                                    </tr>

                                                    <tr>
                                                      <th colspan="12" style="text-align: center; font-size: 14px; font-weight: bold; background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 5px;">
                                                        DEPARTAMENTO DE ANATOMIA PATOLÓGICA REGISTRO DE LIQUIDOS ORGÁNICOS Y PUNCIONES
                                                      </th>
                                                    </tr>
                                                    <tr class="headings" style="font-size:7px;">
                                                        <th class="column-title"  rowspan="2" style="width: 2%;text-transform: uppercase;text-align: center;font-size: 10px;">COD. REGISTRO</th>
                                                        <th class="column-title"  rowspan="2" style="width: 2%;text-transform: uppercase;text-align: center;font-size: 10px;">APELLIDOS Y NOMBRES</th>
                                                        
                                                        
                                                        <th class="column-title"  rowspan="2" style="width: 2%;text-transform: uppercase;text-align: center;font-size: 10px;">FECHA RECEP</th>

                                                        <th class="column-title"  rowspan="2" style="width: 2%;text-transform: uppercase;text-align: center;font-size: 10px;">MUESTRA</th>
                                                        <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;font-size: 10px;">BX</th>
                                                        <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;font-size: 10px;">PIEZA QX</th>
                                                        <th class="column-title"  rowspan="2" style="width: 2%;text-transform: uppercase;text-align: center;font-size: 10px;"> MEDICO RESPONSABLE</th>
                                                      
                                                      
                                                        <th class="column-title"  rowspan="2" style="width: 15%;text-transform: uppercase;text-align: center;font-size: 10px;">RECOGIÒ RESULTADO</th>
                                                        <th class="column-title"  rowspan="2" style="width: 15%;text-transform: uppercase;text-align: center;font-size: 10px;"> FECHA</th>
                                                        <th class="column-title"  rowspan="2" style="width: 15%;text-transform: uppercase;text-align: center;font-size: 10px;">DNI</th>
                                                    </tr>
                                                    
                                                   
                                                    </thead>
                                                    <tbody>
                                                        <?php while($mue3 = $ni3->fetch_assoc()){ ?>

                                                          <tr class="even pointer">
                                                            <td class=" " style="text-transform: uppercase; text-align: left; color: black;font-size: 14px; font-weight: bold; max-width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; padding: 8px;">
                                                                <?php echo $mue3["corPat"]; ?>
                                                            </td>
                                                            <td class=" " style="text-transform: uppercase; text-align: left; color: black; font-size: 10px; font-weight: 200; max-width: 250px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; padding: 8px;">
                                                                <?php echo $mue3["paciente"]; ?>
                                                            </td>
                                                            <td class=" " style="text-transform: uppercase; text-align: left; color: black; font-size: 8px; font-weight: 200; max-width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; padding: 8px;">
                                                                <?php echo $mue3["fecha"]; ?>
                                                            </td>
                                                            
                                                            <td class=" " style="text-transform: uppercase; text-align: left; color: black; font-size: 8px; font-weight: 200; max-width: 100px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; padding: 10px;">
                                                                <?php  echo $mue3["muestra"];?>
                                                            </td>
                                                            <td style="text-transform: uppercase; text-align: center; vertical-align: middle; color: black; font-size: 8px; font-weight: 200; max-width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; padding: 8px;">
                                                              <?= in_array($mue3["subproc"], [ 17]) ? "X" : "" ?></td>                                                                      

                                                            <td style="text-transform: uppercase; text-align: center; vertical-align: middle; color: black; font-size: 8px; font-weight: 200; max-width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; padding: 8px;"> 
                                                              <?= in_array($mue3["procedimiento"], [ ]) ? "X" : "" ?></td>  
                                                            <td class=" " style="text-transform: uppercase; text-align: left; color: black; font-size: 8px; font-weight: 200; max-width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; padding: 8px;">
                                                                <?php echo $mue3["auditor"]; ?>
                                                            </td>
                                                            <td class=" " style="text-transform: uppercase; text-align: left; color: black; font-size: 15px; font-weight: 200; max-width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; padding: 8px;">
                                                                <?php ?>
                                                            </td>
                                                            <td class=" " style="text-transform: uppercase; text-align: left; color: black; font-size: 8px; font-weight: 200; max-width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; padding: 8px;">
                                                                <?php ?>
                                                            </td>
                                                            <td class=" " style="text-transform: uppercase; text-align: left; color: black; font-size: 8px; font-weight: 200; max-width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; padding: 8px;">
                                                                <?php ?>
                                                            </td>
                                                            
                                                            
                                                            </td>
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
                                  
                                </div>
                        </div>
                        <br>
                        
                        <?php if($mue["comentarioPatol"]!="") { ?>
                   <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                                                                      
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id=""> 


                                              <table class="table jambo_table bulk_action" id="pac" style="width: 100%;" >
                                                    <thead>
                                                         <tr>
                                                            <td style="text-align: left;float: none;text-transform: uppercase;font-weight: bolder;font-size: 15px;" colspan="6">COMENTARIO</td>
                                                        </tr>
                                                       
                                                    </thead>
                                                </table>    

                                               


                                              <table class="table jambo_table bulk_action" border="1"  id="pac" style="border-collapse: collapse;width: 100%;" >
                                                    
                                                    <tbody>
                                                       

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;font-size: 11px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php 
                                                                      echo "<pre style='font-family: sans-serif;white-space: pre-wrap;       /* Since CSS 2.1 */
                            white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
                            white-space: -pre-wrap;      /* Opera 4-6 */
                            white-space: -o-pre-wrap;    /* Opera 7 */
                            word-wrap: break-word; '>".$mue["comentarioPatol"]."<br>".$mue["CNM"]."</pre>" ?></td>
                                                                     
                                                                
                                                                      
                                                            </tr>
                                                        
                                                    </tbody>
                                                </table>  
                                                

                                        </div>                                                   
                                  </div>
                                </div>
                        </div><br>
                        <?php } if($mue["notaPatol"]!="") { ?>
                                     
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
                                                            <td style="text-align: left;float: none;text-transform: uppercase;font-weight: bolder;font-size: 15px;" colspan="6">NOTA</td>
                                                        </tr>
                                                       
                                                    </thead>
                                                </table>    

                                                

                                              <table class="table jambo_table bulk_action"  border="1" id="pac" style="border-collapse: collapse;width: 100%;" >
                                                    
                                                    <tbody>
                                                       

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;font-size: 11px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php  
                                                                      echo "<pre style='white-space: pre-wrap;       /* Since CSS 2.1 */
                                                                              white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
                                                                              white-space: -pre-wrap;      /* Opera 4-6 */
                                                                              white-space: -o-pre-wrap;    /* Opera 7 */
                                                                              word-wrap: break-word; '>".$mue["notaPatol"]."<br>".$mue["NOA"]."</pre>" ?></td>
                                                                     
                                                                
                                                                      
                                                            </tr>
                                                        
                                                    </tbody>
                                                </table>  
                                                

                                        </div>                                                   
                                  </div>
                                </div>
                        </div>
                         <?php }  ?>
                         <br>
                         <div class="x_panel">
                                         
                                          <div class="x_content" style="margin-left: 23px;margin-right: 23px;">
                                       
                                          <table class="tg">
                                                
                                                <!--
                                                 <tr>
                                                   <td style="font-size: 11px;font-weight: bolder;">REPORTADO POR:</td>
                                                   <td style="font-size: 11px;text-transform: uppercase;"><?php echo $mue["USRE3"]; ?></td>
                                                   <td style="font-size: 11px;font-weight: bolder;text-align: right;"></td>
                                                   <td style="font-size: 11px;"></td>
                                                 </tr>
                                           -->
                                                 <tr>
                                                   <td style="font-size: 11px;font-weight: bolder;">FECHA DE REPORTE</td>
                                                   
                                                   <td style="font-size: 11px;text-transform: uppercase;"><?php date_default_timezone_set('America/Lima'); echo date('d/m/Y g:ia');?></td>
                                                   <td style="font-size: 11px;font-weight: bolder;text-align: right;"></td>
                                                   <td style="font-size: 11px;"></td>
                                                 </tr>
                                                
                                                
                                                
                                                 
                                               </table>
                                                            
                                          </div>
                         </div>
                        

                    <!-- FIN -->
                  </div>
                  
                 
        </div>

        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>
<style>
@page {
  size: A4 landscape;
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