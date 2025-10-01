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


$ser = $_GET["ser"];
$tipo = $_GET["tipo"];
$user = $_GET["user"];

?>
<head>
  <title> Reporte  </title>
  <?php // include ("Vistas/librerias.php"); ?>
  <!--<meta http-equiv="refresh" content="1">-->
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
  <body class="nav-md" style="font-family: sans-serif;">
  <!--<body class="nav-md"  >-->
    <div class="container body">
      <div class="main_container">
    
        <!-- /top navigation -->

        <!-- page content -->
        <div class="" role="main" >
      
                  <div class="row">
                         

                    <!-- INICIO -->


                    <!-- form color picker -->
                        <div class="col-md-12 col-sm-12 col-xs-12" >
                                <div class="x_panel">
                              
                                  <div class="x_content" style="overflow-y: scroll;height: 550px;">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="impro"> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);width: 100%;border: 1px solid black;border-collapse: collapse"  >
                                                    <thead>
                                                     
                                                        <tr class="headings" style="font-size: 11px;background: #d6d8d8;color: black;border-bottom: 1pt solid #a29e9e;">
                                                              
                                                            
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">FECHA/HORA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">USUARIO</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CUENTA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;PACIENTE&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">TIPO&nbsp;DOC</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">N°&nbsp;DOC</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">REGIMEN</th>                                        
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">PLAN</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">N°&nbsp;AFILIACION</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">AFILIACION</th> 
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CADUCIDAD</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">CAMA</th>
                                                              <th class="column-title" style="width: 2%;text-transform: uppercase;text-align: center;">ESTADO</th> 
                                                        </tr>
                                                    </thead>
                                                   

                                                <?php 
                                                                                            
                                                //sleep(3);
                                                $ni = $pac->consultaVerificarEstadoMasivo($ser,$tipo,$user);
                                                
                                                ?>  
                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){                                                  
                                                                ?>

                                                            <tr class="even pointer">
                                                                                                                                           
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align:center;color: black;font-size:9px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo date('d/m/Y H:i:s',strtotime($mue["fechaRegistro"])); ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align: center;color: black;font-size:9px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["URF"]; ?></td>
                                                                      
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align: center;color: black;font-size:9px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["cuenta"]; ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align: center;color: black;font-size:9px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["ApePaterno"]." ".$mue["ApeMaterno"]." ".$mue["nombres"]; ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align: center;color: black;font-size:9px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   
                                                                    
                                                                      
                                                                        if($mue["tipoDoc"]==1){
                                                                            echo "DNI";
                                                                        }else if($mue["tipoDoc"]==2){
                                                                            echo "CARNET EXT";
                                                                        }else if($mue["tipoDoc"]==3){
                                                                            echo "PASAPORTE";
                                                                        }else if($mue["tipoDoc"]==4){
                                                                            echo "CODIGO UNICO DE IDENTIFICACION (CUI)";
                                                                        }else if($mue["tipoDoc"]==5){
                                                                            echo "DOC. IDENT. EXTRANJERA";
                                                                        }else if($mue["tipoDoc"]==6){
                                                                            echo "SIN DOC";
                                                                        }
                                                                      
                                                                      
                                                                      ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align: center;color:black;font-size:9px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php   echo $mue["DOCE"]; ?></td>
                                                                      

                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align: center;color: black;font-size:9px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["REGI"]; ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align:center;color: black;font-size:9px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php 
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
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align:center;color: black;font-size:9px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php echo $mue["nroAfiliacion"]; ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align:center;color: black;font-size:9px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php 
                                                                                    
                                                                                  if($mue["fechaAfiliacion"]!="1969-12-31"){
                                                                            			 echo date('d/m/Y',strtotime($mue["fechaAfiliacion"])); 
                                                                            		 }  
                                                                                    
                                                                        ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align:center;color: black;font-size:9px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php 
                                                                     
                                                                      if($mue["fechaCaducidad"]!="1969-12-31"){
                                                                    			 echo date('d/m/Y',strtotime($mue["fechaCaducidad"])); 
                                                                        }
                                                                      ?></td>
                                                                       <td class=" " style="width: 2%;text-transform: uppercase;text-align:center;color: black;font-size:9px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php 
                                                                        
                                                                            echo $mue["camHos1"];
                                                                     
                                                                      ?></td>
                                                                      <td class=" " style="width: 2%;text-transform: uppercase;text-align:center;color: black;font-size:9px;font-weight: 200;border-bottom: 1pt solid #a29e9e;"><?php 
                                                                      
                                                                     
                                                                      
                                                                      if($mue["estado"]=="ACTIVO"){
                                                                            echo "<span style='color:green;font-weight: bolder;'>ACTIVO</span>";
                                                                      }else{
                                                                          echo "<span style='color:red;font-weight: bolder;'>CONSULTAR WEB</span>";
                                                                      }
                                                                      
                                                                      
                                                                      ?></td>
                                                                      
                                                            </tr>
                                                        <?php 
                                                        
                                                     //   sleep(1);
                                                        }   ?>
                                                    </tbody>
                                                </table>  
                                               <?php //echo '<script type="text/javascript">alert("Actualizacion masiva correctamente");</script>';  ?>
                                                
                                        
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