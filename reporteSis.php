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
$ni = $pac->consultaXnROSis($id);

while($mue = $ni->fetch_assoc()){ 

  /*SELECT `cuenta`,`historiaClinica`,`ApePaterno`,`ApeMaterno`,`nombres`,`tipoDoc`,`nroDoc`,`servicioPabellon`,`fechaIngreso`  */


    $cuenta =  $mue["cuenta"]; 
    $historiaClinica =  $mue["historiaClinica"]; 
    $paciente =  $mue["ApePaterno"].' '.$mue["ApeMaterno"].' '.$mue["nombres"]; 
    $tipoDoc =  ""; 
    if($mue["tipoDoc"]=="1"){
        $tipoDoc = "DNI";
    }else  if($mue["tipoDoc"]=="2"){
        $tipoDoc = "CARNET EXT";
    }else  if($mue["tipoDoc"]=="3"){
        $tipoDoc = "PASAPORTE";
    }else  if($mue["tipoDoc"]=="4"){
        $tipoDoc = "CODIGO RECIEN NACIDO (CUI)";
    }else  if($mue["tipoDoc"]=="5"){
        $tipoDoc = "DOC. IDENT. EXTRANJERA";
    }else  if($mue["tipoDoc"]=="6"){
        $tipoDoc = "SIN DOC";
    }
    $nroDoc =  $mue["nroDoc"]; 
    $servicioPabellon =  $mue["SERV"]; 
    $fechaIngreso =  $mue["fechaIngreso"]; 


};




?>
<head>
  <title> Impresión de N° de Cuenta <?php echo $cuenta." del paciente ".$paciente; ?>  </title>
</head>
<script language="javascript">

function printThis() {
  window.print();
  //self.close();
}
</script>

<style>
  .reptesis {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
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
                                          <div class="x_title"><p style="font-size: 11px;float: right;"><?php //date_default_timezone_set('America/Lima'); echo date('d/m/Y g:ia');?></p>
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
                                                  <td style="font-size: 10px;" ><?php echo $cuenta?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;">H. CLINICA</td>
                                                  <td style="font-size: 10px;"><?php echo $historiaClinica ?></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">PACIENTE</td>
                                                  <td style="font-size: 10px;text-transform: uppercase;"><?php echo $paciente; ?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;"></td>
                                                  <td style="font-size: 10px;"></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">TIPO DOC</td>
                                                  <td style="font-size: 10px;text-transform: uppercase;"><?php echo $tipoDoc; ?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;">NRO DOC</td>
                                                  <td style="font-size: 10px;"><?php echo $nroDoc?></td>
                                                 
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">FECHA DE INGRESO</td>
                                                  <td style="font-size: 10px;"><?php echo date('d/m/Y H:i:s',strtotime($fechaIngreso)); ?></td>
                                                  <td style="font-size: 10px;font-weight: bolder;text-align: right;"> </td>
                                                  <td style="font-size: 10px;"></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 10px;font-weight: bolder;">SERVICIO DE INGRESO</td>
                                                  <td style="font-size: 10px;" colspan="3"><?php  echo$servicioPabellon;?></td>
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


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);width: 100%;border: 1px solid black;border-collapse: collapse"  >
                                                    <thead>
                                                         <tr>
                                                            <td style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 14px;border-bottom: 1pt solid #a29e9e;" 
                                                            colspan="8">Reporte de acreditaciones</td>
                                                        </tr>
                                                        <tr class="headings" style="font-size: 9px;background: #d6d8d8;color: black;border-bottom: 1pt solid #a29e9e;">
                                                              
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">FECHA/HORA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">USUARIO</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">REGIMEN</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">PLAN</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">NRO AFILIACION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">AFILIACION</th> 
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CADUCIDAD</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">ESTADO</th> 
                                                        </tr>
                                                    </thead>
                                                   

                                                <?php 
                                                                                            
                                                
                                                $ni = $pac->consultaWebSis($id);
                                                
                                                ?>  
                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){                                                 
                                                                ?>

                                                            <tr class="even pointer">
                                                                                                                                           
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align:center;color: black;font-size: 7px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo date('d/m/Y H:i:s',strtotime($mue["fechaRegistro"])); ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align: center;color: black;font-size: 7px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["USEAS"]; ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align: center;color: black;font-size: 7px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["REGI"]; ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align:center;color: black;font-size: 7px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php 
                                                                            //echo $mue["plan"]; 
                                                                            if($mue["plan"]=="05"){
                                                                    				echo 'SOLO PEAS (SIS PARA TODOS)';
                                                                    		 }else if($mue["plan"]=="01"){
                                                                    				echo 'PEAS Y COMPLEMENTARIO (SIS GRATUITO)';
                                                                    		 }else if($mue["plan"]=="02"){
                                                                    				echo 'PEAS Y COMPLEMENTARIO (SIS INDEPENDIENTE)';
                                                                    		 }else if($mue["plan"]=="03"){
                                                                    				echo 'SOLO PEAS (SIS MICROEMPRESAS)';
                                                                    		 }else if($mue["plan"]=="04"){
                                                                    				echo 'PEAS Y COMPLEMENTARIO (SIS EMPRENDEDOR)';
                                                                    		 }
                                                                            
                                                                            ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align:center;color: black;font-size: 7px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["nroAfiliacion"]; ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align:center;color: black;font-size: 7px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php 
                                                                                    
                                                                                  if($mue["fechaAfiliacion"]!="1969-12-31"){
                                                                            			 echo date('d/m/Y',strtotime($mue["fechaAfiliacion"])); 
                                                                            		 }  
                                                                                    
                                                                        ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align:center;color: black;font-size: 7px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php 
                                                                     
                                                                      if($mue["fechaCaducidad"]!="1969-12-31"){
                                                                    			 echo date('d/m/Y',strtotime($mue["fechaCaducidad"])); 
                                                                    		 }
                                                                      ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align:center;color: black;font-size: 7px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["estado"]; ?></td>
                                                                      
                                                            </tr>
                                                        <?php }   ?>
                                                    </tbody>
                                                </table>  
                                        
                                        </div>                                                   
                                  </div>
                                </div>
                        </div><br><br>
                        
                    <!-- FIN -->
                    


                   
                        </div><br>

                          <!--<table>
                                                <tr>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="color: white;"></td>
                                                  <td style="font-weight: bolder">TOTAL:</td>
                                                  <td class="tg-0lax" id="submed">

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