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
$ni = $pac->consultaXidPacx($id);

while($mue = $ni->fetch_assoc()){ 

    $datospac =  $mue["ApePaterno"]." ".$mue["ApeMaterno"]." ".$mue["Nombres"];
    $NombreX = $mue["ApePaterno"]."_".$mue["ApeMaterno"]."_".$mue["Nombres"]; 
    $hclinic =  $mue["HistoriaClinica"]; 
    $TipoSeguro =  $mue["TipoSeguro"]; 
    $iafa =  $mue["iafa"]; 
    $NroCuenta =  $mue["NroCuenta"]; 
    $edad =  $mue["edad"]; 
    $servicio =  $mue["servicio"]; 
    $diagnostico =  $mue["diagnostico"]; 
    $seguro =  $mue["seguro"]; 
    $fechaIngreso =  $mue["fechaIngreso"]; 
    $fechaCorte =  $mue["fechaCorte"]; 
};


header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Disposition: attachment; filename="LIQ_'.strtoupper($NombreX).'.xls"'); 


?>

<head>
  <meta charset="UTF-8">
  <title> Impresión de N° de Cuenta <?php echo $NroCuenta." del paciente ".$datospac; ?>  </title>
</head>

  <body class="nav-md"  style="font-family: sans-serif;">
  <!--<body class="nav-md"  >-->
    <div class="container body">
      <div class="main_container">
    
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" >
      
                  <div class="row">
                              <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12 ">

                                    <div class="x_panel">
                                          <div class="x_title">
                                          <center>
                                              <img src="http://10.10.4.107:8089/prestacional/images/cabecera.png" width="550" >
                                          </center><br><br><br><br>
                                            <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 15px;">REPORTE DE PRESTACIONES DE SALUD</h2>
                                          
                                            <div class="clearfix"></div>
                                          </div>
                                          <div class="x_content" style="margin-left: 23px;margin-right: 23px;margin-bottom: -21px;">
                                       
                                          <table class="tg">
                                                
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">TIPO DE SEGURO</td>
                                                  <td style="font-size: 10px;text-align: left;" colspan="3"><?php echo $TipoSeguro?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">IAFA</td>
                                                  <td style="font-size: 10px;text-align: left;" colspan="3"><?php echo strtoupper($iafa)?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">N° DE CUENTA</td>
                                                  <td style="font-size: 10px;text-align: left;" colspan="3"><?php echo $NroCuenta?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">APELLIDOS Y <br>NOMBRES</td>
                                                  <td style="font-size: 10px;text-align: left;"><?php echo $datospac; ?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;">EDAD</td>
                                                  <td style="font-size: 10px;text-align: left;"><?php echo $edad?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">SERVICIO</td>
                                                  <td style="font-size: 10px;text-align: left;" colspan="3"><?php echo $servicio?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">DIAGNOSTICO</td>
                                                  <td style="font-size: 10px;text-align: left;" colspan="3"><?php echo $diagnostico?></td>
                                                </tr>
                                               
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">FECHA DE INGRESO</td>
                                                  <td style="font-size: 10px;text-align: left;"><?php
                                                  $fecha = new DateTime($fechaIngreso);
                                                  $fecha_m_d_y = $fecha->format('d-M-Y');
                                                  echo $fecha_m_d_y ?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;">HISTORIA CLINICA</td>
                                                  <td style="font-size: 10px;text-align: left;"><?php echo $hclinic; ?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">FECHA DE ALTA/CORTE</td>
                                                  <td style="font-size: 10px;text-align: left;" colspan="3"><?php 
                                                   $fechaCo = new DateTime($fechaCorte);
                                                   $fechaUY = $fechaCo->format('d-M-Y');
                                                   echo $fechaUY
                                                  ?></td>
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
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                  <td style="font-size: 14px;font-weight: 200;"></td>
                                                </td>
                                              </table>
                                                            
                                          </div>
                                       </div><br><br>


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


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);"  border="1">
                                                    <thead>
                                                         <tr>
                                                            <td style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 14px;border-bottom: 1pt solid #a29e9e;" colspan="5">HOSPITALIZACIÓN - CONSULTAS E INTERCONSULTAS</td>
                                                        </tr>
                                                        <tr class="headings" style="font-size: 10px;background: #d6d8d8;color: black;">
                                                              
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO CPT</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TARIFA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TOTAL</th>                                          
                                                        </tr>
                                                    </thead>
                                                </table>    

<?php 
                                            

$ni = $pac->consultaXidProcedimientos($id,1);

?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" border="1">
                                                    <thead >
                                                    <tr class="headings" style="font-size:0px;background: white;color: white;">
                                                              
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO CPT</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TARIFA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TOTAL</th>                                          
                                                      </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){                                                 
                                                                ?>

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["codigo_cpt"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["descripcion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["cantidad"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["valorizacion"], 2, ".", ""); ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["total"], 2, ".", ""); ?></td>
                                                                      
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>  
                                                <table style="float: right;border: 1px solid black;">
                                                <tr>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="font-weight: bolder">SUBTOTAL:</td>
                                                  <td class="tg-0lax" id="subproc" style="text-align: right;">
                                                        
                                                      <?php 
                                                          $ni = $pac->sumXidProcedure($id,1);
                                                          $mue = $ni->fetch_assoc();
                                                          $totpse = $mue["totalproc"]; 
                                                          echo " S/.".number_format($totpse, 2, ".", ",");
                                                       ?>
                                                  </td>
                                                </tr>
                                              </table>                        


                                        </div>                                                   
                                  </div>
                                </div>
                        </div><br><br>

      



                    <!-- FIN -->
                     <!-- INICIO -->


                    <!-- form color picker --> <br>
                    <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;" >
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                                                                  
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="impro"> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);"  border="1">
                                                    <thead>
                                                        <tr>
                                                            <td style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 14px;border-bottom: 1pt solid #a29e9e;" colspan="5">PROCEDIMIENTOS MEDICO - QUIRÚRGICOS</td>
                                                        </tr>
                                                        <tr class="headings" style="font-size: 10px;background: #d6d8d8;color: black;">
                                                              
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO CPT</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TARIFA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TOTAL</th>                                          
                                                        </tr>
                                                    </thead>
                                                </table>    

<?php 
                                            

$ni = $pac->consultaXidProcedimientos($id,2);

?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);"   border="1">
                                                    <thead >
                                                    <tr class="headings" style="font-size:0px;background: white;color: white;">
                                                              
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO CPT</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TARIFA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TOTAL</th>                                          
                                                      </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){                                                 
                                                                ?>

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["codigo_cpt"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["descripcion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["cantidad"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["valorizacion"], 2, ".", ""); ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["total"], 2, ".", ""); ?></td>
                                                                      
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>  
                                                <table style="float: right;border: 1px solid black;">
                                                <tr>
                                                   <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="font-weight: bolder">SUBTOTAL:</td>
                                                  <td class="tg-0lax" id="subproc" style="text-align: right;">
                                                        
                                                      <?php 
                                                          $ni = $pac->sumXidProcedure($id,2);
                                                          $mue = $ni->fetch_assoc();
                                                          $totpse = $mue["totalproc"]; 
                                                          echo " S/.".number_format($totpse, 2, ".", ",");
                                                       ?>
                                                  </td>
                                                </tr>
                                              </table>                        


                                        </div>                                                   
                                  </div>
                                </div>
                        </div><br><br>

      



                    <!-- FIN -->


                     <!-- INICIO -->


                    <!-- form color picker --><br>
                    <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                                                                  
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="impro"> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);"  border="1">
                                                    <thead>
                                                          <tr>
                                                            <td style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 14px;border-bottom: 1pt solid #a29e9e;" colspan="5">PROCEDIMIENTOS DE PATOLOGIA CLINICA-GENÉTICA - ANATOMIA PATOLOGICA</td>
                                                        </tr>
                                                        <tr class="headings" style="font-size: 10px;background: #d6d8d8;color: black;">
                                                              
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO CPT</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TARIFA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TOTAL</th>                                          
                                                        </tr>
                                                    </thead>
                                                </table>    

<?php 
                                            

$ni = $pac->consultaXidProcedimientos($id,3);

?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);"  border="1">
                                                    <thead >
                                                    <tr class="headings" style="font-size:0px;background: white;color: white;">
                                                              
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO CPT</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TARIFA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TOTAL</th>                                          
                                                      </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){                                                 
                                                                ?>

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["codigo_cpt"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["descripcion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["cantidad"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["valorizacion"], 2, ".", ""); ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["total"], 2, ".", ""); ?></td>
                                                                      
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>  
                                                <table style="float: right;border: 1px solid black;">
                                                <tr>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="font-weight: bolder">SUBTOTAL:</td>
                                                  <td class="tg-0lax" id="subproc" style="text-align: right;">
                                                        
                                                      <?php 
                                                          $ni = $pac->sumXidProcedure($id,3);
                                                          $mue = $ni->fetch_assoc();
                                                          $totpse = $mue["totalproc"]; 
                                                          echo " S/.".number_format($totpse, 2, ".", ",");
                                                       ?>
                                                  </td>
                                                </tr>
                                              </table>                        


                                        </div>                                                   
                                  </div>
                                </div>
                        </div><br><br>

      



                    <!-- FIN -->



                     <!-- INICIO -->


                    <!-- form color picker --> <br>
                    <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                               
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="impro"> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);"  border="1">
                                                    <thead>
                                                         <tr>
                                                            <td style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 14px;border-bottom: 1pt solid #a29e9e;" colspan="5">PROCEDIMIENTOS RADIOLÓGICOS Y RADIOLOGIA INTERVENCIONISTA</td>
                                                        </tr>
                                                        <tr class="headings" style="font-size: 10px;background: #d6d8d8;color: black;">
                                                              
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO CPT</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TARIFA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TOTAL</th>                                          
                                                        </tr>
                                                    </thead>
                                                </table>    

<?php 
                                            

$ni = $pac->consultaXidProcedimientos($id,4);

?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);"  border="1" >
                                                    <thead >
                                                    <tr class="headings" style="font-size:0px;background: white;color: white;">
                                                              
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO CPT</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TARIFA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TOTAL</th>                                          
                                                      </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){                                                 
                                                                ?>

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["codigo_cpt"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["descripcion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["cantidad"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["valorizacion"], 2, ".", ""); ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["total"], 2, ".", ""); ?></td>
                                                                      
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>  
                                                <table style="float: right;border: 1px solid black;">
                                                <tr>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="font-weight: bolder">SUBTOTAL:</td>
                                                  <td class="tg-0lax" id="subproc" style="text-align: right;">
                                                        
                                                      <?php 
                                                          $ni = $pac->sumXidProcedure($id,4);
                                                          $mue = $ni->fetch_assoc();
                                                          $totpse = $mue["totalproc"]; 
                                                          echo " S/.".number_format($totpse, 2, ".", ",");
                                                       ?>
                                                  </td>
                                                </tr>
                                              </table>                        


                                        </div>                                                   
                                  </div>
                                </div>
                        </div><br><br>

      



                    <!-- FIN -->


                    
                     <!-- INICIO -->


                    <!-- form color picker --><br> 
                    <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                                                                
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="impro"> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);" border="1" >
                                                    <thead>
                                                        <tr>
                                                            <td style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 14px;border-bottom: 1pt solid #a29e9e;" colspan="5">PROCEDIMIENTOS BANCO DE SANGRE</td>
                                                        </tr>
                                                        <tr class="headings" style="font-size: 10px;background: #d6d8d8;color: black;">
                                                              
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO CPT</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TARIFA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TOTAL</th>                                          
                                                        </tr>
                                                    </thead>
                                                </table>    

<?php 
                                            

$ni = $pac->consultaXidProcedimientos($id,5);

?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);"  border="1">
                                                    <thead >
                                                    <tr class="headings" style="font-size:0px;background: white;color: white;">
                                                              
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO CPT</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TARIFA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TOTAL</th>                                          
                                                      </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){                                                 
                                                                ?>

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["codigo_cpt"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["descripcion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["cantidad"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["valorizacion"], 2, ".", ""); ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["total"], 2, ".", ""); ?></td>
                                                                      
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>  
                                                <table style="float: right;border: 1px solid black;">
                                                <tr>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="font-weight: bolder">SUBTOTAL:</td>
                                                  <td class="tg-0lax" id="subproc" style="text-align: right;">
                                                        
                                                      <?php 
                                                          $ni = $pac->sumXidProcedure($id,5);
                                                          $mue = $ni->fetch_assoc();
                                                          $totpse = $mue["totalproc"]; 
                                                          echo " S/.".number_format($totpse, 2, ".", ",");
                                                       ?>
                                                  </td>
                                                </tr>
                                              </table>                        


                                        </div>                                                   
                                  </div>
                                </div>
                        </div><br><br>

      



                    <!-- FIN -->



 <!-- form color picker --><br>
                      <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                                                                 
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="imin"> 
<?php                                   

      $ni = $pac->consultaXinsumos($id);

?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);"  border="1">
                                                    <thead >
                                                    <tr>
                                                            <td style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 14px;border-bottom: 1pt solid #a29e9e;" colspan="5">INSUMOS</td>
                                                        </tr>
                                                    <tr class="headings" style="font-size: 10px;background: #d6d8d8;color: black;">
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO CPT</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TARIFA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TOTAL</th>     
                                                                                           
                                                      </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){                                                 
                                                                ?>

                                                            <tr class="even pointer">
                                                                      <td class=" " style="text-transform: uppercase;text-align:center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["codigo_sismed"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:left;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["descripcion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["cantidad"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["valorizacion"], 2, ".", ""); ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["total"], 2, ".", ""); ?></td>
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>
                                              <table style="float: right;border: 1px solid black;">
                                                <tr>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="font-weight: bolder">SUBTOTAL:</td>
                                                  <td class="tg-0lax" id="subins" style="text-align: right;">
                                                        
                                                      <?php 
                                                          $ni = $pac->sumXidinsumos($id);
                                                          $mue = $ni->fetch_assoc();
                                                          $totim = $mue["totalproc"]; 
                                                          echo " S/.".number_format($totim, 2, ".", ",");
                                                       ?>
                                                  </td>
                                                </tr>
                                              </table>             

                                            
                                        </div>                                                   
                                  </div>
                                </div>
                        </div><br><br>

                    <!-- FIN -->

           <!-- form color picker -->  <br>
                        <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;" >
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                                                             
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="immed"> 
<?php

$ni = $pac->consultaXmedicamentos($id);

?>  


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);"  border="1">
                                                    <thead >
                                                        <tr>
                                                            <td style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 14px;border-bottom: 1pt solid #a29e9e;" colspan="5">MEDICAMENTOS</td>
                                                        </tr>
                                                    <tr class="headings" style="font-size: 10px;background: #d6d8d8;color: black;">
                                                              
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CODIGO CPT</th>
                                                              <th class="column-title" style="width: 15%;text-transform: uppercase;text-align: center;">DESCRIPCION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CANTIDAD</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TARIFA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TOTAL</th>     
                                                                                                  
                                                      </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){                                                 
                                                                ?>

                                                            <tr class="even pointer">
                                                                       
                                                                      <td class=" " style="text-transform: uppercase;text-align:center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["codigo_sismed"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:left;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["descripcion"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:center;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["cantidad"]; ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["valorizacion"], 2, ".", ""); ?></td>
                                                                      <td class=" " style="text-transform: uppercase;text-align:right;color: black;font-size: 10px;font-weight: 200;border-bottom: 1pt solid #a29e9e;mso-number-format:'0.00';"><?php echo number_format($mue["total"], 2, ".", ""); ?></td>
                                                                      
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>
                                                <table style="float: right;border: 1px solid black;">
                                                <tr>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="font-weight: bolder">SUBTOTAL:</td>
                                                  <td class="tg-0lax" id="submed" style="text-align: right;">
                                                        
                                                      <?php 
                                                          $ni = $pac->sumXidMed($id);
                                                          $mue = $ni->fetch_assoc();
                                                          $totmed=  $mue["totalproc"];
                                                          echo " S/".number_format($totmed, 2, ".", ",");
                                                       ?>
                                                  </td>
                                                </tr>
                                              </table>                   


                                            
                                        </div>                                                   
                                  </div>
                                </div>
                        </div><br><br><br><br><br><br><br><br><br><br><br><br>
<center>
                          <!--<table>
                                                <tr>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="font-weight: bolder">TOTAL:</td>
                                                  <td class="tg-0lax" id="submed">
                                                        
                                                  <?php 

                                                      $otalee= $totmed + $totim + $totpse;
                                                      echo "S/".$otalee;

                                                      ?>
                                                  </td>
                                                </tr>
                        </table> -->



                           

                                <br><br><br>

                                                
</center>
                                     

                        

                    <!-- FIN -->




                  </div>
                  
                 
        </div>

        <!-- footer content -->
       <?php //include 'Vistas/footer.php';  ?>
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